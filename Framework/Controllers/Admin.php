<?php

namespace App\Controllers\Admin;

function users($vars) {

  \App\Page::View('Admin/Users.php', $vars);

}