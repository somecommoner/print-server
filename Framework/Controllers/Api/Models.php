<?php

namespace App\Controllers\API\Models;

function getFiles() {
    $data = [];
    
    $dir = __DIR__."/../../Private/Models";
    $files = scandir($dir);
    foreach ($files as $file) {
        if (mb_substr($file, 0, 1) != ".")
            $data[] = ["model_name" => $file];
    }
    return $data;
}


function get($vars) {

    \App\Response(getFiles());
}

function delete($vars) {

    $file = $vars['model_name'];
    $dir = __DIR__."/../../Private/Models";

    unlink($dir."/".$file);
    
    \App\Response::Success();
}

function upload($vars) {
    if (!isset($_FILES['model_file']['name']))
        \App\Response::Error();

    if ((mb_substr($_FILES['model_file']['name'], 0, 1) == ".") || (mb_substr($_FILES['model_file']['name'], 0, 1) == "/"))
        \App\Response::Error();

    if (!str_ends_with($_FILES['model_file']['name'], ".gcode"))
        \App\Response::Error();

    $name = $_FILES['model_file']['name'];
    $new_name = substr($_FILES['model_file']['name'], 0, -5);
    
    $dir = __DIR__."/../../Private/Models/";
    $dest = $dir.".temp/".$name;
    move_uploaded_file($_FILES['model_file']['tmp_name'], $dest);


    exec('up3dtranscode box '.$dest.' '.$dir.$new_name."umc".' 223 20 150 0.05', $output, $retval);

    unlink($dest);

    foreach ($output as $line) {
        if (str_contains(strtolower($line), "error")) {
            unlink($dir.$new_name."umc");
            \App\Response::Error($line);
        }
    }
    
    \App\Redirect("/models");

}