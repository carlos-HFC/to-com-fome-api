<?php
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'POST':
    echo "THIS IS A POST METHOD";
    break;
  case 'PUT':
    echo "THIS IS A PUT METHOD";
    break;
  case 'DELETE':
    echo "THIS IS A DELETE METHOD";
    break;
  case 'GET':
  default:
    echo "THIS IS A GET METHOD";
    break;
}
