<?php

namespace App\Controllers\Login;

function index($vars) {
  if (\App\Auth\check() > 0) {
    \App\Redirect("/");
    exit;
  }

  \App\Page::View('Auth/Login.php', $vars);

}

function check() {

  if (isset($_POST['username']) && isset($_POST['password'])) {
    index(\App\Auth\Login($_POST['username'], $_POST['password']));
  } else {
    \App\Redirect("/login");
    exit;
  }
}

function logout() {

  session_destroy();
  session_start();

  \App\Redirect("/login");
}