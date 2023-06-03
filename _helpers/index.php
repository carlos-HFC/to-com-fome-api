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

function headerLogged($donnation)
{
  session_start();

  if (empty($_SESSION['userName'])) {
    header("Location: ../login");
    die();
  }

  return <<<HTML
    <header class="cabecalho">
      <nav class="navbar bg-tela-secundario">
        <div class="container-fluid">

          <a class="navbar" href="#">
            <img src="../img/Logo.svg" alt="Logo" width="70" height="70" class="d-inline-block align-text-top ms-5 me-4">
          </a>

          <div class="col">
            <h1 class="corBranco m-0">Olá, {$_SESSION['userName']}!</h1>
          </div>

          <div class="text-end">
            <div class="row ">
              <h2 class="corBranco m-0">{$donnation}</h2>
              <p class="corBranco m-0">Doações</p>
            </div>
          </div>

          <img src="../img/Olho_nav.svg" alt="Icone olho" class="ms-3 me-5" />
        </div>
        </div>
      </nav>
    </header>
  HTML;
}

function siteHead(string $title)
{
  session_start();

  return <<<HTML
    <!DOCTYPE html>
      <html lang="pt">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>{$title}</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
          <link rel="stylesheet" href="../css/styles.css">
        </head>
  HTML;
}

function experienceToNextLevel($currentExperience) {
  return $currentExperience * 15;
}