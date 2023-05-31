<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../../_helpers/index.php");
require("../../_config/connection.php");
require("../../dao/typeDonnation.php");

$typeDonnationDao = new TypeDonnation();

$result = array();
$method = $_SERVER['REQUEST_METHOD'];
$json = file_get_contents("php://input");
$data = json_decode($json);

switch ($method) {
  case 'POST':
    try {
      validEmptyObject($data);

      $typeDonnation = $data->name;
      $rs = $typeDonnationDao->create($typeDonnation);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Tipo de doação inserida com sucesso."
      );
      http_response_code(201);
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
  case 'PATCH':
  case 'PUT':
    try {
      validId();
      validEmptyObject($data);

      $id = $_GET["id"];
      $typeDonnation = $data->name;
      $rs = $typeDonnationDao->update($id, $typeDonnation);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Tipo de doação editada com sucesso."
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
  case 'DELETE':
    try {
      validId();

      $id = $_GET['id'];
      $rs = $typeDonnationDao->delete($id);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Tipo de doação deletada com sucesso."
      );
      http_response_code(204);
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
  case 'GET':
  default:
    try {
      $id = null;
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $typeDonnationDao->findById($id);
      } else {
        $result = $typeDonnationDao->findAll();
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
}
