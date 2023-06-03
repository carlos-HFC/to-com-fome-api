<?php
require("../_helpers/index.php");
require("../_config/connection.php");
require("../dao/auth.php");
require("../dao/donnation.php");
require("../dao/news.php");
echo siteHead("Home Logado");

$donnationDao = new Donnation();
$newsDao = new News();

$donnnation = $donnationDao->countAll();

echo headerLogged($donnation['total']);

$result = null;
$error = null;

?>

<section class="container mt-5">
  <div class="row">
    <div class="col">
      <h1>Usuário logado</h1>
    </div>
  </div>

  <?php var_dump($_SESSION) ?>

  <?php foreach ($newsDao->getLast() as $news) : ?>
    <div>
      <p>
        <?= $news->user ?>
      </p>
      <p>
        <?= $news->type ?>
      </p>
      <p>
        <?= $news->message ?>
      </p>
    </div>
    <br /><br />
  <?php endforeach; ?>

  <a href="../_helpers/logout.php?locale=../login" class="btn btn-primary">
    Sair
  </a>
</section>