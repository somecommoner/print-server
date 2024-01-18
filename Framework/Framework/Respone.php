<?php

namespace App;

//
// All responses will have:
//
// result: Success/Error
// error: string (only with Error)
// message: string (optional)
// data: []
//


class Response {
  public static function Error ($error=false) {

    $return['result'] = 'error';
    if ($error !== false) $return['error'] = $error;

    echo json_encode($return);
    exit;

  }

  public static function Success ($message=false) {

    $return['result'] = 'success';
    if ($message !== false) $return['message'] = $message;

    echo json_encode($return);
    exit;

  }
}

function Response ($data) {

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data);
  exit;

}