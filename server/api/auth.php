<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../../_helpers/index.php");
require("../../_config/connection.php");
require("../../dao/auth.php");

$authDao = new Auth();

$json = file_get_contents("php://input");
$data = json_decode($json);

try {
  validEmptyObject($data);

  $result = $authDao->login($data);

  if (!$result) {
    unexpectedError();
  }

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
