<?php

namespace App\Controllers\Print;

function home($vars) {
    \App\Page::View('Home.php', $vars);
}

function models($vars) {

    \App\Page::View('Models.php', $vars);
}