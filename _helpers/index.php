<?php
function validId()
{
  if (empty($_GET['id'])) {
    $result = array(
      "message" => "Você precisa especificar o ID"
    );
    http_response_code(400);
    echo json_encode($result);
    die();
  }
}

function validEmptyObject($data)
{
  if (count(get_object_vars($data)) == 0) {
    $result = array(
      "message" => "Não há dados para processar"
    );
    http_response_code(400);
    echo json_encode($result);
    die();
  }
}

function unexpectedError()
{
  $result = array(
    "message" => "Erro inesperado"
  );
  http_response_code(400);
  echo json_encode($result);
  die();
}