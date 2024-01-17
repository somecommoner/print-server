<?php 

namespace App;

class App {

  //private $Logger = new Logger($_SETTINGS['LOGDIR']);
  private $Routes = [];
  private $URL;
  private $Query;
  private $POST = [];
  private $GET = [];

  function __construct() {
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->URL = explode("/", substr($url, 1));
    $query = $_SERVER["QUERY_STRING"];
    $query = explode("&", $query);
    foreach ($query as $pair) {
      $pair = explode("=", $pair);
      $this->Query[$pair[0]] = $pair[1];
    }
    foreach ($_POST as $key => $value) {
      $this->POST[$key] = $value;
    }
    foreach ($_GET as $key => $value) {
      $this->GET[$key] = $value;
    }

  }

  public function post($url, $function, $auth=0) {

    $this->Routes[] = new Route('POST', $url, $function, $auth);
  }

  public function get($url, $function, $auth=0) {

    $this->Routes[] = new Route('GET', $url, $function, $auth);
  }

  public function delete($url, $function, $auth=0) {

    $this->Routes[] = new Route('DELETE', $url, $function, $auth);
  }

  public function route() {
   
    foreach ($this->Routes as $Route) {

      $response = $Route->Check($this->URL, $this->Query);

      if ($response === 401) {

        header("Location: /login");

      } else if ($response !== 404) {

        $Route->go(array_merge($response, $this->GET, $this->POST));
        exit;
        
      }

    }

    \App\Error("404");
  }

}