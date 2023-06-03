<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../../_helpers/index.php");
require("../../_config/connection.php");
require("../../dao/news.php");
require("../../dao/user.php");
require("../../dao/typeNews.php");

$newsDao = new News();

$result = array();
$method = $_SERVER['REQUEST_METHOD'];
$json = file_get_contents("php://input");
$data = json_decode($json);

switch ($method) {
  case 'POST':
    try {
      validEmptyObject($data);

      $rs = $newsDao->create($data);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Notícia cadastrada com sucesso."
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
      $rs = $newsDao->update($id, $data);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Notícia editada com sucesso."
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
      $rs = $newsDao->delete($id);

      if (!$rs) {
        unexpectedError();
      }

      $result = array(
        "message" => "Notícia deletada com sucesso."
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
        $result = $newsDao->findById($id);
      } else {
        $userId = isset($_GET['userId']) ? $_GET['userId'] : null;
        $typeNewsId = isset($_GET['typeNewsId']) ? $_GET['typeNewsId'] : null;
        $result = $newsDao->findAll($userId, $typeNewsId);
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
