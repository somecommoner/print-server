<?php

namespace App\Controllers\API\Users;

function get() {
 
  \App\Response(SelectUsers());

}

function post($variables) {

  $id = $variables['id'];

  if (!isset($variables['permissions']) || !isset($variables['username']) || !isset($variables['email']) || !isset($variables['active']))
    \App\Response::Error('Post parameters not supplied.');

  $SQL = new \App\SQL;

  $SQL->Query("UPDATE users SET permissions=?, active=?, username=?, email=? WHERE user_id=?", [$variables['permissions'], $variables['active'], $variables['username'], $variables['email'], $id]);

  \App\Response(SelectUsers($id)[0]);
}

function delete($variables) {

  (new \App\SQL)->Query("DELETE FROM users WHERE user_id=?",[$variables['id']]);

  \App\Response::Success();

}

function modify($variables) {

  $SQL = new \App\SQL;

  //Change username
  if (isset($variables['username'])) {

    if ($variables['username'] === "") $variables['username'] = $_SESSION['username'];

    if ($variables['username'] == $_SESSION['username']) \App\Response::Error("Username must be different.");

    if (!$SQL->Query("SELECT * FROM users WHERE username=?", [$variables['username']])) {

      $SQL->Query("UPDATE users SET username=? WHERE user_id=?", [$variables['username'], $_SESSION['user_id']]);

      $_SESSION['username'] = $variables['username'];

      \App\Response::Success();

    } else 
      \App\Response::Error("Username is already taken.");

  //Change password
  } elseif (isset($variables['current-password']) && isset($variables['password'])) {

    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $variables['password']))
      \App\Response::Error("Password does not meet complexity requirements");

    if (false === $SQL->Query("SELECT * FROM users WHERE user_id=? and password_hash=?", [$_SESSION['user_id'], \App\Auth\hash_password($variables['current-password'])]))
      \App\Response::Error("Incorrect current password.");

    if (false !== $SQL->Query("UPDATE users SET password_hash=? WHERE user_id=?", [\App\Auth\hash_password($variables['password']), $_SESSION['user_id']]))
      \App\Response::Success();
    else
      \App\Response::Error("Unable to save new password.");

  //Change email
  } elseif (isset($variables['email'])) {

    if ($variables['email'] === "") $variables['email'] = $_SESSION['email'];

    if ($variables['email'] == $_SESSION['email']) \App\Response::Error("Email must be different.");
    
    if (!$SQL->Query("SELECT * FROM users WHERE email=?", [$variables['email']])) {

      $SQL->Query("UPDATE users SET email=? WHERE user_id=?", [$variables['email'], $_SESSION['user_id']]);

      $_SESSION['email'] = $variables['email'];

      \App\Response::Success();

    } else 
      \App\Response::Error("Email is already taken.");

  } else
    \App\Response::Error("Invalid request.");

}

function SelectUsers($id=false) {
  if (!$id)
    $results = (new \App\SQL)->Query("SELECT user_id, active, permissions, username, email, acct_created, last_login, invited_by_id FROM users");
  else
    $results = (new \App\SQL)->Query("SELECT user_id, active, permissions, username, email, acct_created, last_login, invited_by_id FROM users WHERE user_id=?", [$id]);

  $data = [];
  foreach ($results as $result) {
    $user = [];
    foreach ($result as $key => $value) {

      if ($key == "acct_created") {

        $user['acct_created'] = substr($value, 0, -7);

      } else if ($key == "last_login") {

        $user['last_login'] = substr($value, 0, -7);

      } else if ($key == "invited_by_id") {
        
        $query = (new \App\SQL)->Query("SELECT username FROM users WHERE user_id=?", [$value]);
        if ($query !== false)
          $user['invited_by_user'] = $query[0]['username'];
        else 
          $user['invited_by_user'] = $value;
          
      } else {
        $user[$key] = $value;
      }
    }
    $data[] = $user;
  }

  return $data;
}