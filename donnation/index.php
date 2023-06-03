<?php
require("../_helpers/index.php");
require("../_config/connection.php");
require("../dao/donnation.php");
require("../dao/typeDonnation.php");
require("../dao/typeFood.php");
require("../dao/role.php");
require("../dao/user.php");
echo siteHead("To Com Fome | Doação");

$donnationDao = new Donnation();
$typeDonnationDao = new TypeDonnation();
$typeFoodDao = new TypeFood();
$userDao = new User();

$profile = $userDao->findById($_SESSION['userId']);

$result = null;
$res = null;
$error = null;

if ($_POST) {
  $type = $_POST['d_type'];
  $value = $_POST['d_value'];
  $typeFood = $_POST['d_typeFood'];

  try {
    if ($type == 'dinheiro') {
      $data = (object) array(
        "userId" => intval($_SESSION['userId']),
        "value" => floatval($value),
        "typeDonnationId" => 1
      );
    } else {
      $data = (object) array(
        "userId" => intval($_SESSION['userId']),
        "value" => floatval($value),
        "typeDonnationId" => 2,
        "typeFoodId" => $typeFood,
      );
    }

    $result = $donnationDao->create($data);

    if ($result) {
      $experienceToNextLevel = experienceToNextLevel($profile['level']);
      $finalExperience = intval($profile['experience'] + 15);

      if ($finalExperience >= $experienceToNextLevel) {
        $finalExperience = $finalExperience - $experienceToNextLevel;

        $data = (object) array(
          "experience" => intval($finalExperience),
          "level" => intval($profile['level'] + 1)
        );
      } else {
        $data = (object) array(
          "experience" => intval($finalExperience)
        );
      }

      $res = $userDao->update($_SESSION['userId'], $data);

      header("Location: ../user");
      die();
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

$donnation = $donnationDao->countAll();
echo headerLogged($donnation['total']);
?>

<?php if ($_POST && !is_null($error)) : ?>
  <?= $error ? $error : "Erro desconhecido" ?>
<?php endif; ?>

<main class="conteudo">
  <div class="container-fluid text-center ">
    <div class="row">
      <div class="col-1 bg-tela-secundario vh-100 p-0 d-flex flex-column menu-Lateral">
        <div class="m-0 btn-menu">
          <div class="bg-menu-deselecionado">
            <a href="../user">
              <img src="../img/Menu_deselecionado.webp" alt="Icone Menu" class="p-3  " />
            </a>
          </div>
          <?php if ($_SESSION['userRole'] != "Voluntário") : ?>
            <div class="bg-tela-terciario">
              <a href="../donnation">
                <img src="../img/Doacao_selecionado.webp" alt="Icone Doação" class="p-3 svg-menu-selecionado" />
              </a>
            </div>
          <?php endif; ?>
        </div>

        <div>
          <p><a href="../_helpers/logout.php?locale=../login" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover corBranco h5 p-3">Sair</a></p>
        </div>
      </div>

      <div class="col">
        <h2 class="m-3 mb-5 h1">Doação</h2>

        <?= var_dump($result); ?>
        <?= var_dump($res); ?>

        <div class="row pt-5 d-flex justify-content-center">
          <div class="col-5 border-end">
            <form method="POST">
              <input type="hidden" name="d_type" value="dinheiro">
              <p class="h1 m-5">Doação em dinheiro</p>

              <div class="col-6 d-grid mx-auto ps-0 mb-3 input-group-lg">
                <label for="inputDoado" class="text-start ms-4">Digite o valor $ a ser doado</label>
                <input type="number" id="inputDoado" class="form-control bg-bd-campo-primario corCinza rounded-5 mt-1" aria-labelledby="doado" placeholder="R$" name="d_value" required>
              </div>

              <div class="d-grid gap-2 col-2 mx-auto">
                <button type="submit" class="btn btn-cinza mt-5 mb-5 rounded-5 btn-lg" data-bs-toggle="button">Doe</button>
              </div>
            </form>
          </div>

          <div class="col-5">
            <form method="POST">
              <input type="hidden" name="d_type" value="alimento">
              <p class="h1 m-5">Doação em alimento</p>

              <div class="col-6 d-grid mx-auto ps-0 mb-3 input-group-lg">
                <label for="inputAlimento" class="text-start ms-4">Digite a quantidade em KG</label>
                <input type="text" id="inputAlimento" class="form-control bg-bd-campo-primario corCinza rounded-5 mt-1" aria-labelledby="alimento" placeholder="Kg" name="d_value" required>
              </div>

              <div class="col-5 text-start mx-auto">
                <div class="row d-inline-flex">
                  <?php foreach ($typeFoodDao->findAll() as $typeFood) : ?>
                    <div class="form-check mb-1">
                      <input class="form-check-input" type="radio" name="d_typeFood" id="<?= $typeFood->name ?>" value="<?= $typeFood->id ?>">
                      <label class="form-check-label" for="<?= $typeFood->name ?>">
                        <?= $typeFood->name ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="d-grid gap-2 col-2 mx-auto">
                <button type="submit" class="btn btn-cinza mt-5 mb-5 rounded-5 btn-lg" data-bs-toggle="button">Doe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>