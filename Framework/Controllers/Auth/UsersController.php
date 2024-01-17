<?php

namespace App\Controllers\Users;


function get_create($vars) {

  $SQL = new \App\SQL;

  if (false !== $result = $SQL->Query('SELECT * FROM user_invites WHERE invites_token=?', [$vars['token']])) {

    \App\Page::View('Auth/Create.php', $vars);

  } else {
    \App\Error("Invalid token");
  }

}

function get_change_password($vars) {

  $SQL = new \App\SQL;

  if (false !== $result = $SQL->Query('SELECT * FROM user_reset WHERE reset_token=?', [$vars['token']])) {

    \App\Page::View('Auth/Reset.php');
 
  } else {
    \App\Error("Invalid token");
}

}

function post_change_password($vars) {

  $SQL = new \App\SQL;

  if (false === $result = $SQL->Query('SELECT * FROM user_reset WHERE reset_token=?', [$vars['token']])) {
    \App\Error("Invalid token");
  }

  if (!isset($vars['password'])) {
    $query = ["result" => "false", "message" => urlencode("No password supplied")];
    \App\Redirect("/reset/{$vars['token']}", $query);
  }

  if (false !== $SQL->Query('SELECT * FROM users WHERE password_hash=? AND user_id=?', [\App\Auth\hash_password($vars['password']), $result[0]['user_id']])) {
    $query = ["result" => "false", "message" => urlencode("New password must be different from current")];
    \App\Redirect("/reset/{$vars['token']}", $query);
  }

  if (false !== $SQL->Query("UPDATE users SET password_hash=? WHERE user_id=?", [\App\Auth\hash_password($vars['password']), $result[0]['user_id']])) {
    $SQL->Query("DELETE FROM user_reset WHERE reset_token=?",[$vars['token']]);

    $query = ["result" => "true", "message" => urlencode("Password successfully reset.")];
    \App\Redirect("/login", $query);
  } else {
    $query = ["result" => "false", "message" => urlencode("An error occured")];
    \App\Redirect("/reset/{$vars['token']}", $query);
  }

}

function post_create($vars) {

  $SQL = new \App\SQL;

  if (false !== $result = $SQL->Query('SELECT * FROM user_invites WHERE invites_token=?', [$vars['token']])) {

    if (!isset($vars['username'])) {
      $query = ["result" => "false", "message" => urlencode("No username supplied.")];
      \App\Redirect("/create/{$vars['token']}", $query);
    } else if (!isset($vars['password'])) {
      $query = ["result" => "false", "message" => urlencode("No password supplied.")];
      \App\Redirect("/create/{$vars['token']}", $query);
    } else if (false !== $SQL->Query("SELECT * from users WHERE username=?", [$vars['username']])) {
      $query = ["result" => "false", "message" => urlencode("Username already taken.")];
      \App\Redirect("/create/{$vars['token']}", $query);
    } else if (!preg_match('/^(?=.*\d).{8,}$/', $vars['password'])) {
      $query = ["result" => "false", "message" => urlencode("Password does not meet complexity requirements.")];
      \App\Redirect("/create/{$vars['token']}", $query);
    }

    if (false !== $result = $SQL->Query('SELECT * FROM user_invites WHERE invites_token=?', [$vars['token']])) {

      $query = "INSERT INTO users (permissions, active, username, email, password_hash, acct_created, last_login, invited_by_id) VALUES (?,?,?,?,?,?,?,?)";
      $values = [1, 1, $vars['username'], $result[0]['invites_email'], \App\Auth\hash_password($vars['password']), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $result[0]['invited_by']];
      $result = $SQL->Query($query, $values);

      $SQL->Query("DELETE FROM user_invites WHERE invites_token=?",[$vars['token']]);

      $query = ["result" => "true", "message" => urlencode("Account created successfully.")];
      \App\Redirect("/login", $query);
      
    } else {
      \App\Error("Failed to create account");
    }

  } else {
    \App\Error("Invalid token");
  }

  if (false !== $result = $SQL->Query('SELECT * FROM user_invites WHERE invites_token=?', [$vars['token']]) && isset($vars['username']) && isset($vars['password'])) {

    $query = "INSERT INTO users (permissions, active, username, email, password_hash, acct_created, last_login, invited_by_id) VALUES (?,?,?,?,?,?,?)";
    $values = [1, 1, $vars['username'], $result['invites_email'], \App\Auth\hash_password($vars['password']), time(), 0, $result['invited_by']];
    $result = $SQL->Query($query, $values);
    
  } else {
    \App\Error("invalid token");
  }

}

function invite($vars) {

  $SQL = new \App\SQL;

  if (!isset($vars['email'])) {
    $query = ["result" => "false", "message" => urlencode("No username supplied.")];
    \App\Redirect("/invite", $query);
  }

  if (false !== $SQL->Query("SELECT * from users WHERE email=?", [$vars['email']])) {
    $query = ["result" => "false", "message" => urlencode("Email already in use.")];
    \App\Redirect("/invite", $query);
  }

  if (false !== $SQL->Query("SELECT * from user_invites WHERE invites_email=?", [$vars['email']])) {
    $query = ["result" => "false", "message" => urlencode("User has pending invite.")];
    \App\Redirect("/invite", $query);
  }

  $token = \App\UUID();

  //add to database
  if (false !== $SQL->Query("INSERT INTO user_invites (invites_email, invites_token, sent_time, invited_by) VALUES (?,?,?,?)", [$vars['email'], $token, time(), $_SESSION['user_id']])) {

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    global $_settings;

    try {
      $mail->isSMTP();

      $mail->Host       = $_settings['SMTP_HOST'];
      $mail->Port       = $_settings['SMTP_PORT'];


      $mail->setFrom('no-reply@'.$_settings['URL'], $_settings['TITLE']);
      $mail->addAddress($vars['email']);

      $mail->DKIM_domain = 'lul.nz';
      $mail->DKIM_private = __DIR__.'/../../Private/mail.private';
      $mail->DKIM_selector = 'mail';
      $mail->DKIM_passphrase = '';
      $mail->DKIM_identity = $mail->From;

      $mail->isHTML(true);
      $mail->Subject = 'Invite to '.$_settings['URL'];
      $mail->Body    = "<h2>".$_settings['TITLE']."</h2>Visit the following link to create an account:<br><br>https://".$_settings['URL']."/create/$token";
      $mail->AltBody = $_settings['TITLE']."
      
      To create an account please visit the following link:

      https://".$_settings['URL']."/create/$token";
      $mail->send();
      $query = ["result" => "true", "message" => urlencode("Invite sent successfully.")];
      \App\Redirect("/invite", $query);
    } catch (\Exception $e) {
      $query = ["result" => "false", "message" => urlencode("An error occured.")];
      \App\Redirect("/invite", $query);
    }
  } else {
    $query = ["result" => "false", "message" => urlencode("Failed to create token.")];
    \App\Redirect("/invite", $query);
  }

}

function invite_page($vars) {
  \App\Page::View('Auth/Invite.php', $vars);

}

function reset_page($vars) {
  \App\Page::View('Auth/Reset.php', $vars);

}

function reset($vars) {

  $SQL = new \App\SQL;

  if (!isset($vars['email'])) {
    $query = ["result" => "false", "message" => urlencode("No email supplied.")];
    \App\Redirect("/reset", $query);
  }

  if (false !== $result = $SQL->Query("SELECT * FROM users WHERE email=? AND active=?", [$vars['email'], 1])) {

    $SQL->Query("DELETE FROM user_reset WHERE user_id=?", [$result['user_id']]);

    $token = \App\UUID();

    if (false !== $SQL->Query("INSERT INTO user_reset (user_id, reset_token, sent_time) VALUES (?,?,?)", [$result[0]['user_id'], $token, time()])) {

      $mail = new \PHPMailer\PHPMailer\PHPMailer();

      global $_settings;

      try {
        $mail->isSMTP();
        $mail->Host       = $_settings['SMTP_HOST'];
        $mail->Port       = $_settings['SMTP_PORT'];

        $mail->setFrom('no-reply@'.$_settings['URL'], $_settings['TITLE']);
        $mail->addAddress($vars['email']);

        $mail->DKIM_domain = 'lul.nz';
        $mail->DKIM_private = __DIR__.'/../../Private/mail.private';
        $mail->DKIM_selector = 'mail';
        $mail->DKIM_passphrase = '';
        $mail->DKIM_identity = $mail->From;

        $mail->isHTML(true);
        $mail->Subject = "Password reset for ".$_settings['URL'];
        $mail->Body    = "<h2>".$_settings['TITLE']."</h2><ph>Please visit the following link to reset your password:<br><br>https://".$_settings['URL']."/reset/$token</p>";
        $mail->AltBody = $_settings['TITLE']."
        
        Please visit the following link to reset your password:

        https://".$_settings['URL']."/reset/$token";
        $mail->send();
        $query = ["result" => "true", "message" => urlencode("Please allow 1-2 minutes for delivery and check your spam folder if it hasn't arrived.")];
        \App\Redirect("/reset", $query);
      } catch (\Exception $e) {
        $query = ["result" => "false", "message" => urlencode("An error occured")];
        \App\Redirect("/reset", $query);
      }
    } else {
      $query = ["result" => "false", "message" => urlencode("Couldn't create token.")];
      \App\Redirect("/reset", $query);
    }

  } else {
    $query = ["result" => "true", "message" => urlencode("Please allow 1-2 minutes for delivery and check your spam folder if it hasn't arrived.")];
    \App\Redirect("/reset", $query);
  }

}