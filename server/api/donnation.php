<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../../_helpers/index.php");
require("../../_config/connection.php");
require("../../dao/donnation.php");
require("../../dao/user.php");
require("../../dao/typeDonnation.php");
require("../../dao/typeFood.php");

$donnationDao = new Donnation();

$result = array();
$method = $_SERVER['REQUEST_METHOD'];
$json = file_get_contents("php://input");
$data = json_decode($json);

switch ($method) {
  case 'POST':
    try {
      validEmptyObject($data);

      $rs = $donnationDao->create($data);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Doação cadastrada com sucesso."
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
      $rs = $donnationDao->update($id, $data);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Doação editada com sucesso."
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
      $rs = $donnationDao->delete($id);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Doação deletada com sucesso."
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
        $result = $donnationDao->findById($id);
      } else {
        $userId = isset($_GET['userId']) ? $_GET['userId'] : null;
        $typeDonnationId = isset($_GET['typeDonnationId']) ? $_GET['typeDonnationId'] : null;
        $typeFoodId = isset($_GET['typeFoodId']) ? $_GET['typeFoodId'] : null;
        $result = $donnationDao->findAll($userId, $typeDonnationId, $typeFoodId);
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
