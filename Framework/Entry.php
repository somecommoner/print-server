<?php

date_default_timezone_set('Pacific/Auckland');

if (session_status() == PHP_SESSION_NONE)
  session_start();

error_reporting(E_ERROR | E_PARSE);

require(__DIR__."/Config.php");

try {
  _require_all(__DIR__.'/Framework');
  _require_all(__DIR__.'/Controllers');
  _require_all(__DIR__.'/Database');
  _require_all(__DIR__.'/Vendor');
} catch (\Throwable $t) {
  try {
    require_once(__DIR__."/Framework/Error.php");
    \App\Error($t->getMessage()." at ".$t->getFile().":".$t->getLine()."\n");
    exit;
  } catch (\Throwable $t) {
    echo $t->getMessage()." at ".$t->getFile().":".$t->getLine()."\n";
    exit;
  }
}

function _require_all($dir, $depth=0) {

  if ($depth > 5 )
    return;

  foreach (glob("$dir/*") as $path) {

    if (preg_match('/\.php$/', $path))
      require_once $path;

    elseif (is_dir($path))
      _require_all($path, $depth+1);

  }

}

$App = new \App\App;

require_once __DIR__ .'/Routes.php';

$App->route();