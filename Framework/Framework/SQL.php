<?php

namespace App;

class SQL {

  private $host;
  private $dbname;
  private $username;
  private $password;
  private $charset = "utf8";

  private $pdo;

  function __construct() {

    global $_settings;
    $this->host = $_settings['DB_HOST'];
    $this->dbname = $_settings['DB_NAME'];
    $this->username = $_settings['DB_USER'];
    $this->password = $_settings['DB_PASS'];
    $this->StartConn();
  }

  function StartConn () {
    
    $options = [
      \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
      \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";

    try {
       $this->pdo = new \PDO($dsn, $this->username, $this->password, $options);
    } catch (\PDOException $e) {
        \App\Error("Failed to connect to db");
        //throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

  }

  function Query($query, $values=NULL) {

    try {

      $stmt = $this->pdo->prepare($query);
      if ($values !== NULL) 
        $stmt->execute($values);
      else
      	$stmt->execute();

    } catch (\PDOException $e) {

    	return false;
    
    }

    $result = $stmt->fetchAll();

    if ($stmt->rowCount() > 0) {
    
      return $result;
    
    } else {
    
      return false;
    
    }

  }
}