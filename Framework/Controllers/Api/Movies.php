<?php

namespace App\Controllers\API\Movies;

function Download($vars) {
 
    if (!isset($vars['id'])) {
        \App\Response::Error("No Movie ID supplied.");
    }

}

function Browse($vars) {

    

}
