<?php

namespace App\Controllers\Account;

function index($vars) {
  \App\Page::View('User/Account.php', $vars);
}