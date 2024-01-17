<?php

namespace App\Controllers\Home;

function index($vars) {
    \App\Page::View('Home.php', $vars);
}