<?php

namespace App\Auth;


function Check() {

  $SQL = new \App\SQL;

  if (isset($_SESSION['user_id']) && isset($_SESSION['permissions']) && isset($_SESSION['username']) && 
      isset($_SESSION['email']) && isset($_SESSION['password_hash']) && isset($_SESSION['acct_created']) &&
      isset($_SESSION['last_login']) && isset($_SESSION['invited_by_id'])) {

    if (false !== $result = $SQL->Query("SELECT * FROM user_sessions WHERE user_id=?", [$_SESSION['user_id']])) {

      if (session_id() === $result[0]['session_id'] && $result[0]['user_ip'] === GetIP()) {

        $SQL->Query("UPDATE user_sessions SET last_active=? WHERE user_id=?", [time(), $_SESSION['user_id']]);

        return $_SESSION['permissions'];

      } else {
        logout();
        return 0;
      }
    } else {
      return 0;
    }
  } else {
    return 0;
  }

}

function isAdmin() {
  if ($_SESSION['permissions'] >= 5)
    return true;
  else
    return false;
}

function login($username, $password) {

  $SQL = new \App\SQL;

  if (false !== $result = $SQL->Query("SELECT * FROM users WHERE username=? AND password_hash=? AND active=1", [$username,hash_password($password)])) {

    $SQL->Query("UPDATE users SET last_login=? WHERE user_id=?", [date("Y-m-d H:i:s"), $result[0]['user_id']]);

    if (create_session($result[0]))
      \App\Redirect("/");

    exit;

  } else if (false !== $result = $SQL->Query("SELECT * FROM users WHERE email=? AND password_hash=? AND active=1", [$username,hash_password($password)])) { 

    $SQL->Query("UPDATE users SET last_login=? WHERE user_id=?", [date("Y-m-d H:i:s"), $result[0]['user_id']]);

    if (create_session($result[0])) {
      \App\Redirect("/");
    }

    exit;

  } else {

    $query = ["result" => "false",
              "message" => urlencode("Incorrect Username or Password")];

    \App\Redirect("/login", $query);
  
  }

}

function logout() {

  session_destroy();
  session_start();

  \App\Redirect("/login");
  exit;

}

function create_session($query) {

  $SQL = new \App\SQL;

  foreach ($query as $key => $value) {
    $_SESSION[$key] = $value;
  }

  $SQL->Query("DELETE FROM user_sessions WHERE user_id=?", [$_SESSION['user_id']]);
  if (false === $SQL->Query("INSERT INTO user_sessions (user_id, session_id, last_active, user_ip) VALUES (?,?,?,?)", [$_SESSION['user_id'], session_id(), time(), GetIP()])) {
    \App\Error("Failed to create session");
    return false;
  } else {
    return true;
  }

}

function hash_password($password) {
  return substr(crypt($password,'$6$rounds=5000$8k-m^5DYzKC@9RE=$'),32);
}

function GetIP() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
  } else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
  }

  return $ip;
}