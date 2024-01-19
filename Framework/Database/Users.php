<?php

namespace App\DB;

function Users() {

  $SQL = new \App\SQL();

  if (anyTables($SQL)) {
    return;
  }

  $table = "users";
  if (!tableExists($SQL, $table)) {
    try {

      $sql = "CREATE table $table(
      user_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
      active TINYINT ( 1 ) NOT NULL,
      permissions INT ( 5 ) NOT NULL,
      username VARCHAR( 50 ) NOT NULL UNIQUE,
      email VARCHAR( 50 ) NOT NULL UNIQUE,
      password_hash VARCHAR( 100 ) NOT NULL,
      acct_created DATETIME( 6 ) NOT NULL,
      last_login DATETIME( 6 ) NOT NULL,
      invited_by_id INT ( 10 ) NOT NULL) 
      ENGINE=InnoDB AUTO_INCREMENT=1000;" ;
      $SQL->Query($sql);

    } catch(\PDOException $e) {
        echo $e->getMessage();
    }
  }

  $table = "user_sessions";
  if (!tableExists($SQL, $table)) {
    try {

      $sql = "CREATE table $table(
      user_id int( 10 ) PRIMARY KEY,
      session_id VARCHAR ( 100 ) NOT NULL, 
      last_active VARCHAR ( 50 ) NOT NULL,
      user_ip VARCHAR ( 50 ) NOT NULL);" ;
      $SQL->Query($sql);

    } catch(\PDOException $e) {
        echo $e->getMessage();
    }
  }

  $table = "user_invites";
  if (!tableExists($SQL, $table)) {
    try {

      $sql = "CREATE table $table(
      invites_email VARCHAR( 50 ) NOT NULL,
      invites_token VARCHAR ( 100 ) NOT NULL, 
      sent_time VARCHAR ( 50 ) NOT NULL,
      invited_by INT ( 10 ) NOT NULL);" ;
      $SQL->Query($sql);

    } catch(\PDOException $e) {
        echo $e->getMessage();
    }
  }

  $table = "user_reset";
  if (!tableExists($SQL, $table)) {
    try {
      $sql = "CREATE table $table(
      user_id int( 10 ) NOT NULL UNIQUE,
      reset_token VARCHAR ( 100 ) NOT NULL,
      sent_time VARCHAR ( 50 ) NOT NULL);";
      $SQL->Query($sql);

    } catch(\PDOException $e) {
        echo $e->getMessage();
    }
  }

  if ($SQL->Query("SELECT * FROM users WHERE username=?", [getenv('ADMIN_USERNAME')]) === false) {

    $query = "INSERT INTO users (permissions, active, username, email, password_hash, acct_created, last_login, invited_by_id) VALUES (?,?,?,?,?,?,?,?)";
    $values = [5, 1, getenv('ADMIN_USERNAME'), "admin@lul.nz", \App\Auth\hash_password(getenv('ADMIN_PASSWORD')), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 1000];
    $result = $SQL->Query($query, $values);

    return true;

  } else return false;

}