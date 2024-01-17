<?php 

namespace App;

class Route {

  private $Sections;
  private $Method;
  private $Function;
  private $Auth;

  private $Variables = [];
  
  public function __construct($Method, $URL, $Function, $Auth=0) {
    $this->Sections = explode("/", substr($URL, 1));
    $this->Method = $Method;
    $this->Function = $Function;
    $this->Auth = $Auth;

    $this->SetVariables();

  }

  public function SetVariables() {
    foreach ($this->Sections as &$section) {
      $matches = [];
      if (preg_match('/^{.*}$/', $section)) {
        $this->Variables[] = preg_replace("/[{}]/", "", $section);
        $section = ".*";
      } else {
        $this->Variables[] = null;
      }
    }
  }

  public function Check($url, $query) {

    $response = [];

    if ($this->Method !== $_SERVER['REQUEST_METHOD'])
      return 404;

    if (count($url) === 1 && count($this->Sections) === 1 && $url !== $this->Sections)
      return 404;

    if (count($url) != count($this->Sections))
      return 404;

    for ($i = 0; $i < count($url); $i++) {

      if (!preg_match("/".$this->Sections[$i]."/", $url[$i]))
        return 404;

      if ($this->Variables[$i] !== null)
        $response[$this->Variables[$i]] = $url[$i];
    }

    foreach ($query as $key => $value) {
      $response[$key] = $value;
    }

    if (!$this->Auth())
      return 401;

    return $response;

  }

  public function Auth() { 

    if (Auth\Check() >= $this->Auth)
      return true;
    else
      return false;

  }

  public function go($variables) { 
    if (function_exists($this->Function)) {
      try {
        call_user_func($this->Function, $variables);
      } catch (\Throwable $t) {
        \App\Error($t->getMessage()." at ".$t->getFile().":".$t->getLine()."\n");
      }
    } else {
      \App\Error("Route function does not exist: {$this->Function}");
    }
  }

  public function GetMethod() { return $this->Method; }

}
