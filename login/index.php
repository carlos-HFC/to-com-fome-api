<?php
require("../_helpers/index.php");
require("../_config/connection.php");
require("../dao/auth.php");
echo siteHead("Login");

$auth = new Auth();

$result = null;
$error = null;

if ($_POST) {
  try {
    $email = $_POST['u_email'];
    $password = $_POST['u_password'];

    $data = (object) array(
      "email" => $email,
      "password" => $password
    );

    $rs = $auth->login($data);

    if ($rs) {
      $_SESSION['userName'] = $rs['name'];
      $_SESSION['userEmail'] = $rs['email'];
      $_SESSION['userRole'] = $rs['role'];
      $result = $rs;
      header("Location: ../user");
      die();
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

?>

<section class="container mt-5">
  <?php if ($_POST && !is_null($error)) : ?>
    <?= $error ? $error : "Erro desconhecido" ?>
  <?php endif; ?>

  <?php var_dump($result) ?>
  <br />
  <?php var_dump($_SESSION) ?>

  <div class="row">
    <div class="col">
      <h1>Login</h1>
    </div>
  </div>

  <form method="POST">
    <div class="row mb-3">
      <div class="col">
        <label for="u_email" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="u_email" id="u_email" />
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <label for="u_password" class="form-label">Senha</label>
        <input type="password" class="form-control" name="u_password" id="u_password" />
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <button type="submit" class="btn btn-primary">
          Salvar
        </button>
      </div>
    </div>
  </form>
</section>