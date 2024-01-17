<?php

namespace App;

function Error($message="") {
  include(__DIR__.'/../Pages/Error.php');
  exit;
}