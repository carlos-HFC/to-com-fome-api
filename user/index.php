<?php
require("../_helpers/index.php");
require("../_config/connection.php");
require("../dao/donnation.php");
require("../dao/news.php");
require("../dao/role.php");
require("../dao/typeDonnation.php");
require("../dao/typeFood.php");
require("../dao/typeNews.php");
require("../dao/user.php");

session_start();

$donnationDao = new Donnation();
$newsDao = new News();
$typeNewsDao = new TypeNews();
$userDao = new User();

$donnation = $donnationDao->countAll();
$money = $donnationDao->countDonnationByMoney();
$food = $donnationDao->countDonnationByFood();
$companies = $userDao->countCompanies();
$farmers = $userDao->countFarmers();
$voluntaries = $userDao->countVoluntaries();

echo siteHead("To Com Fome | Usuário");
echo headerLogged($donnation['total']);

$profile = $userDao->findById($_SESSION['userId']);
$experienceToNextLevel = experienceToNextLevel(intval($profile['level']));
$currentExperience = round(intval($profile['experience'] * 100)) / $experienceToNextLevel;

$result = null;
$error = null;

if ($_POST) {
  try {
    $message = $_POST['n_message'];
    $typeNewsId = $_POST['n_type'];
    $userId = $_SESSION['userId'];

    $data = (object) array(
      "message" => $message,
      "userId" => $userId,
      "typeNewsId" => $typeNewsId,
    );

    $result = $newsDao->create($data);

    if ($result) {
      header("Location: ./");
      die();
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}
?>

<main class="conteudo">
  <div class="container-fluid text-center">
    <div class="row">
      <div class="col-1 bg-tela-secundario vh-100 p-0 d-flex flex-column menu-Lateral">
        <div class="m-0 btn-menu">
          <div class="bg-tela-terciario">
            <a href="../user">
              <img src="../img/Menu_selecionado.webp" alt="Icone Menu" class="p-3 svg-menu-selecionado " />
            </a>
          </div>
          <?php if ($_SESSION['userRole'] != "Voluntário") : ?>
            <div class="bg-menu-deselecionado">
              <a href="../donnation">
                <img src="../img/Doacao_deselecionado.webp" alt="Icone Doação" class="p-3" />
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div>
          <p><a href="../_helpers/logout.php?locale=../login" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover corBranco h5 p-3">Sair</a></p>
        </div>
      </div>

      <div class="col-8 bg-tela-terciario pb-5">
        <div class="row">
          <h2 class="mt-4 fs-1">
            <?= $_SESSION['userName'] ?>
          </h2>

          <div>
            <div class="d-flex justify-content-center gap-1 m-0">
              <p class="m-0 fs-5">
                <?= $profile['address'] ?>
              </p>
            </div>

            <div class="d-flex justify-content-center gap-1 mb-2">
              <p class="m-0 fs-5">
                <?= $profile['district'] . "," ?>
              </p>
              <p class="m-0 fs-5">
                <?= $profile['city'] ?>
              </p>
            </div>

            <div class="col-5 d-flex justify-content-center align-items-center gap-1 mx-auto pt-1 mb-5 border-top">
              <img src="../img/Tempo.svg" alt="icone relogo">
              <p class="m-0">Seg a Dom. 08 as 19h</p>
            </div>
          </div>

          <?php if ($_SESSION['userRole'] != 'Voluntário') : ?>
            <div class="col-6 mx-auto mb-3">
              <header class="experience__bar">
                <div class="d-flex align-items-center p-2">
                  <div style="width: <?= $currentExperience ?>%"></div>
                  <span class="current__experience" style="left: 50%">
                    <p class="corBranco m-0">
                      <?= $profile['level'] ?>
                    </p>
                  </span>
                </div>
              </header>
            </div>
          <?php endif; ?>
        </div>

        <div class="row">
          <div class="text-start">
            <h3 class="ms-5 me-5 mb-0 fs-5 p-3">Historico de doações recebidas</h3>
            <?php if ($_SESSION['userRole'] == "Voluntário") : ?>
              <img src="../img/img-historico-voluntario.webp" alt="Imagem historico de doações" class="tamanho-img-historico rounded-4 ps-5">
            <?php else : ?>
              <img src="../img/img-historico.webp" alt="Imagem historico de doações" class="tamanho-img-historico rounded-4 ps-5">
            <?php endif ?>
          </div>

          <?php if ($_SESSION['userRole'] == 'Voluntário') : ?>
            <form class="text-start" method="POST">
              <div class="col-5 d-flex justify-content-between">
                <h3 class="ms-5 me-5 mb-0 fs-5 p-3 d-inline-flex">Publique uma notícia</h3>

                <div class="d-flex justify-content-center align-items-center gap-1 d-inline-flex">
                  <button type="submit" class="btn btn-cinza corBranco">Enviar
                    <img src="../img/Enviar.webp" alt="icone adicionar imagem">
                  </button>
                </div>
              </div>

              <div class="row mx-auto ps-5">
                <div class="col-5 p-0 mb-3">
                  <textarea class="form-control bg-bd-campo-primario corCinza rounded-4 mt-1 p-3" name="n_message" id="mensagem" rows="5" placeholder="Mensagem:"></textarea>
                </div>

                <div class="col-4 text-start d-flex align-items-center ms-4">
                  <div class="row d-inline-flex gap-1 ">
                    <?php foreach ($typeNewsDao->findAll() as $typeNews) : ?>
                      <div class="form-check pe-0">
                        <input class="form-check-input bg-bd-campo-primario" type="radio" name="n_type" id="<?= $typeNews->name ?>" value="<?= $typeNews->id ?>">
                        <label class="form-check-label ps-1 <?= $typeNews->name == 'Agradecimento' ? "border-verde" : ($typeNews->name == 'Aviso' ? "border-azul" : "border-vermelho") ?>" for="<?= $typeNews->name ?>">
                          <?= $typeNews->name ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </form>
          <?php endif; ?>

          <div>
            <h3 class="text-start ms-5 mb-0 fs-5 p-3">Fotos das últimas ações</h3>
            <div class="row ps-5">
              <div class="col-6">
                <div class="bg-Mural h-100 rounded-4">
                  <div class="d-flex h-100 align-items-center">
                    <div class="col-4 d-flex justify-content-center align-items-center gap-1 mx-auto">
                      <button type="button" class="btn btn-branco corCinza">Adicionar foto
                        <img src="../img/Add_Img.webp" alt="icone adicionar imagem">
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-3">
                <img src="../img/img3.webp" alt=" Imagem marmita" class="tamanho-img rounded-4">
                <div class="row">
                  <div class="col d-flex justify-content-end align-items-center gap-1 align-items-center mt-0 me-5">
                    <p class="d-inline-flex mb-0 corCinza">25</p>
                    <img src="../img/Coracao.svg" alt="Imagem marmita">
                  </div>
                </div>
              </div>

              <div class="col-3">
                <img src="../img/img1.webp" alt="Imagem marmita" class="tamanho-img rounded-4">
                <div class="row">
                  <div class="col d-flex justify-content-end align-items-center gap-1 align-items-center mt-0 me-5">
                    <p class="d-inline-flex mb-0 corCinza">16</p>
                    <img src="../img/Coracao.svg" alt="Imagem marmita">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-2 bg-tela-terciario">
        <div class="row d-flex justify-content-center">
          <div class="col-7 corBranco bg-tela-secundario rounded-3 p-2 m-3">
            <p class="m-0">Voluntários totais</p>
            <p class="m-0 h3">
              <?= $voluntaries['total'] ?>
            </p>
          </div>

          <div class="col-7 corBranco bg-tela-secundario rounded-3 p-2 mb-3">
            <p class="m-0">Empresas totais</p>
            <p class="m-0 h3">
              <?= $companies['total'] ?>
            </p>
          </div>

          <div class="col-7 corBranco bg-tela-secundario rounded-3 p-2 mb-4">
            <p class="m-0">Agricultores totais</p>
            <p class="m-0 h3">
              <?= $farmers['total'] ?>
            </p>
          </div>

          <div class="col-9 corCinza bg-VComida rounded-3 p-2 mb-4">
            <p class="m-0 fs-3">
              <?= number_format($food['value'], 1, ",", ".") . " KG" ?>
            </p>
            <p class="m-0">Comida recebida</p>
          </div>

          <div class="col-9 corCinza bg-VDoado rounded-3 p-2 mb-3">
            <p class="m-0 fs-3">
              <?= "R$ " . number_format($money['value'], 2, ",", ".") ?>
            </p>
            <p class="m-0">Valor recebido</p>
          </div>

          <div class="col-11 corCinza border-top">
            <p class="h4 m-3">Mural de Noticias</p>
          </div>

          <?php foreach ($newsDao->getLast() as $news) : ?>
            <div class="col-10 text-start corCinza bg-Mural rounded-3 p-3 mb-3">
              <p class="mb-2 fonte-0 ps-2 h-75 <?= $news->type == 'Agradecimento' ? "border-verde" : ($news->type == 'Aviso' ? "border-azul" : "border-vermelho") ?>">
                <?= $news->message ?>
              </p>
              <p class="m-0 fonte-1 ps-3">
                <?= $news->user ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-2 justify-content-center bg-tela-secundario">
        <div class="row">
          <div class="col d-flex align-items-center justify-content-center bg-tela-primario">
            <p class="corBranco h3 m-2 d-inline-flex">2</p>
            <img src="../img/Gold.webp" alt="Imagem gold">
          </div>

          <div class="mt-4">
            <img src="../img/Selo4.webp" alt="Imagem Selo">
            <p class="corBranco h4">
              <?= $_SESSION['userRole'] ?>
            </p>
          </div>

          <div class="mt-4">
            <img src="../img/Selo3.webp" alt="Imagem Selo">
            <p class="corBranco h4">
              <?= $_SESSION['userRole'] ?>
            </p>
          </div>

          <div class="mt-4">
            <img src="../img/Selo2.webp" alt="Imagem Selo">
            <p class="corBranco h4">
              <?= $_SESSION['userRole'] ?>
            </p>
          </div>

          <div class="mt-4">
            <img src="../img/Selo1.webp" alt="Imagem Selo">
            <p class="corBranco h4">
              <?= $_SESSION['userRole'] ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>