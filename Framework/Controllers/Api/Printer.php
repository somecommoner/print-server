<?php

namespace App\Controllers\API\Printer;

function startPrint($vars) {
    
}

function updateModifiers($vars) {
    
}

function status($vars) {

    exec('sudo up3dstatus', $output, $retval);
    $data = [];
    $values = explode(";", $output[0]);
    $data["machine"] = $values[0];
    $data["program"] = $values[1];
    $data["system"] = $values[2];
    $data["temp"] = $values[3];
    $data["layer"] = $values[4];
    $data["height"] = $values[5];
    $data["percent"] = $values[6];
    $data["time"] = $values[7];

    \App\Response($data);

}

function extrude($vars) {

}

function intrude($vars) {
    
}

function stopPrint($vars) {
    
}
