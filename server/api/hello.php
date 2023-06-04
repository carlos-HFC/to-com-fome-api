<?php
header("Access-Control-Allow-Origin: *");

require("../../_config/connection.php");

$conn = new Connection();

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
    try {
      $result = array(
        "message" => $conn->getConexao()
      );

      http_response_code(200);
      echo json_encode($result);
    } catch (Exception $err) {
      $result = array(
        "message" => $err->getMessage(),
      );
      $e = !is_null($err->getCode()) ? $err->getCode() : 400;
      http_response_code($e);
      echo json_encode($result);
    }

    die();
}
