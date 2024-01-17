<?php 

namespace App;

function Redirect($url, $args=false) {

  if (is_array($args)) {

    $query = "";

    foreach ($args as $key => $value) {
      if ($query == "")
        $query .= "?";
      else
        $query .= "&";
      $query .= "$key=$value";
    }

    header("Location: $url$query");
    exit;
  }

  header("Location: $url");
  exit;
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

function Message($vars) {
  if ($vars["result"] === "true") {
    echo '<div class="pb-2 text-success">'.$vars['message'].'</div>';
  } else if ($vars["result"] === "false") {
    echo '<div class="pb-2 text-danger">'.$vars['message'].'</div>';
  } 
}

class Page {
  public static function View($path, $vars=[]) {

      if ($path == null) {
          \App\Error("Page not supplied");
      }

      try {
          global $_settings; 
          require($_SERVER['DOCUMENT_ROOT']."/../Pages/".$path);
          exit;

      } catch (\Throwable $t) {
          \App\Error($t->getMessage()." at ".$t->getFile().":".$t->getLine()."\n");
          exit;
      }     

  }

}

class Time {
  public static function Days($value) {
    return 86400 * $value;
  }

  public static function Hours($value) {
    return 3600 * $value;
  }

  public static function Mins($value) {
    return 60 * $value;
  }
}

function UUID() {
  return bin2hex(random_bytes(16));
}