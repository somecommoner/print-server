<?php

namespace App\DB;

use function App\Redirect;

function Setup() {

  if (Users())
    \App\Error("create tables");
    \App\Redirect("/");

}

function tableExists($SQL, $table) {

  try {
   $result = $SQL->Query("SELECT 1 FROM $table LIMIT 1");
  } catch (\PDOException $e) {
    return false;
  }

  return $result !== false;

}

function anyTables($SQL) {

  try {
   $result = $SQL->Query("SHOW TABLES");
  } catch (\PDOException $e) {
    return false;
  }

  return $result !== false;

}