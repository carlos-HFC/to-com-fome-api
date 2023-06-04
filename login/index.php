<?php
require("../_helpers/index.php");
require("../_helpers/latlong.php");
require("../_config/connection.php");
require("../dao/auth.php");
require("../dao/role.php");
require("../dao/user.php");
echo siteHead("To Com Fome | Login");

$authDao = new Auth();
$latlongDao = new LatLong();
$roleDao = new Role();
$userDao = new User();

$res = null;
$result = null;
$error = null;

try {
  $roles = $roleDao->findAll();
} catch (Exception $err) {
  header("Location: ../index.php");
  die();
}

if ($_POST) {
  $type = $_POST['u_type'];
  $roleId = $_POST['u_roleId'];
  $name = $_POST['u_name'];
  $document = str_replace([".", "/", "-"], "", $_POST['u_document']);
  $phone = str_replace(["(", ")", " ", "-"], "", $_POST['u_phone']);
  $cep = $_POST['u_cep'];
  $address = $_POST['u_address'];
  $district = $_POST['u_district'];
  $number = $_POST['u_number'];
  $city = $_POST['u_city'];
  $uf = $_POST['u_uf'];
  $email = $_POST['u_email'];
  $password = $_POST['u_password'];

  try {
    if ($type == 'login') {
      $data = (object) array(
        "email" => $email,
        "password" => $password
      );

      $result = $authDao->login($data);

      if ($result) {
        $_SESSION['userId'] = $result['id'];
        $_SESSION['userName'] = $result['name'];
        $_SESSION['userEmail'] = $result['email'];
        $_SESSION['userRole'] = $result['role'];
        header("Location: ../user");
        die();
      }
    } else {
      $data = (object) array(
        "email" => $email,
        "password" => $password,
        "roleId" => $roleId,
        "name" => $name,
        "document" => $document,
        "phone" => $phone,
        "cep" => $cep,
        "address" => !empty($number) ? $address . ", " . $number : $address,
        "district" => $district,
        "number" => $number,
        "city" => $city,
        "uf" => $uf,
      );

      if ($roleId == 3) {
        $res = $latlongDao->getLatLong($address)[0];

        $data->latitude = (float)number_format($res->lat, 7);
        $data->longitude = (float)number_format($res->lon, 7);
      }

      $result = $userDao->create($data);

      if ($result) {
        header("Location: ../user");
        die();
      }
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}
?>

<body class="bg-tela-primario cabecalho">
  <header>
    <nav class="navbar bg-tela-secundario">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
          <img src="../img/Logo.svg" alt="Logo" width="70" height="70" class="d-inline-block align-text-top ms-5">
        </a>
      </div>
    </nav>
  </header>

  <main>
    <div class="p-5 vh-100">
      <div class="container-fluid text-center p-2">
        <div class="row align-items-center bg-tela-secundario rounded-5">

          <!-- FORM de Cadastro -->
          <div class="col bg-white p-0 rounded-start-5">
            <div class="container">
              <form method="POST" class="row justify-content-center">
                <input type="hidden" name="u_type" value="cadastro">

                <div class="col-6 align-self-center">
                  <h2 class="mt-4 mb-4">CADASTE-SE</h2>

                  <select class="form-select bg-bd-campo-primario corCinza" name="u_roleId" aria-label="Selecione o tipo de Cadastro" required>
                    <option selected value="">TIPO DE CADASTRO</option>

                    <?php foreach ($roles as $role) : ?>
                      <option value="<?= $role->id ?>">
                        <?= mb_strtoupper($role->name) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                  <input type="text" name="u_name" class="form-control text-center bg-bd-campo-primario corCinza mt-3 mb-3 " aria-labelledby="Nome" placeholder="NOME" required>

                  <input type="text" name="u_document" class="form-control text-center bg-bd-campo-primario corCinza mt-3 mb-3 " aria-labelledby="Documento" placeholder="CNPJ / CPF" required onkeydown="mask(this, 'document')" maxlength="18">

                  <input type="text" name="u_phone" class="form-control text-center bg-bd-campo-primario corCinza mt-3 " aria-labelledby="telefone" placeholder="TELEFONE" required onkeydown="mask(this, 'phone')" maxlength="15">

                  <div class="row">
                    <div class="col">
                      <input type="text" name="u_cep" class="form-control text-center bg-bd-campo-primario corCinza mt-3 mb-3" aria-labelledby="cep" placeholder="CEP" required onkeydown="mask(this, 'cep')" maxlength="9">
                    </div>

                    <div class="col-4 d-grid mx-auto ps-0">
                      <button type='button' class='btn btn-cinza mt-3 mb-3' onclick="getCep()">BUSCAR</button>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <input type="text" name="u_address" class="form-control text-center bg-bd-campo-primario corCinza " aria-labelledby="endereco" placeholder="ENDEREÇO" required>
                    </div>

                    <div class="col-4 d-grid mx-auto ps-0">
                      <input type="text" name="u_number" class="form-control text-center bg-bd-campo-primario corCinza" aria-labelledby="numero" placeholder="Nº">
                    </div>
                  </div>

                  <input type="text" name="u_district" class="form-control text-center bg-bd-campo-primario corCinza mt-3 " aria-labelledby="bairro" placeholder="BAIRRO" required>

                  <div class="row">
                    <div class="col">
                      <input type="text" name="u_city" class="form-control text-center bg-bd-campo-primario corCinza mt-3 mb-3" aria-labelledby="cidade" placeholder="CIDADE" required>
                    </div>

                    <div class="col-4 ps-0">
                      <input type="text" name="u_uf" class="form-control text-center bg-bd-campo-primario corCinza mt-3 mb-3" aria-labelledby="uf" placeholder="UF" required>
                    </div>
                  </div>

                  <input type="email" name="u_email" class="form-control text-center bg-bd-campo-primario corCinza mb-3 " aria-labelledby="email" placeholder="EMAIL" required>

                  <input type="password" name="u_password" class="form-control text-center bg-bd-campo-primario corCinza mt-3" aria-labelledby="Senha" placeholder="SENHA" required>

                  <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-cinza mt-4 mb-4">CADASTRAR</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- FORM de Login -->
          <div class="col p-0">
            <div class="container">
              <form method="POST" class="row justify-content-center">
                <input type="hidden" name="u_type" value="login">

                <div class="col-6">
                  <h2 class="corBranco mt-5 mb-5">LOGIN</h2>

                  <input type="email" name="u_email" class="form-control text-center bg-transparent border-2 corBranco mt-5 mb-3" aria-labelledby="Email" placeholder="EMAIL" required>

                  <input type="password" name="u_password" class="form-control text-center bg-transparent border-2 corBranco mt-3 mb-3" aria-labelledby="Senha" placeholder="SENHA" required>

                  <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-branco mt-4 mb-5">ENTRAR</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    async function getCep() {
      const cep = document.querySelector("[name=u_cep]").value
      const url = `http://viacep.com.br/ws/${cep}/json`

      const res = await fetch(url)

      const response = await res.json()

      document.querySelector("[name=u_address]").value = response.logradouro
      document.querySelector("[name=u_district]").value = response.bairro
      document.querySelector("[name=u_city]").value = response.localidade
      document.querySelector("[name=u_uf]").value = response.uf
    }

    function mask(target, field) {
      let value = target.value

      switch (field) {
        case 'cep':
          target.value = value.replace(/\D/g, "")
            .replace(/(\d{5})(\d)/, "$1-$2")
            .replace(/(-\d{3})\d+?$/, "$1");
          break;
        case 'phone':
          if (value.length === 15) {
            target.value = value.replace(/\D/g, "")
              .replace(/(\d{2})(\d)/, "($1) $2")
              .replace(/(\d{5})(\d)/, "$1-$2")
              .replace(/(-\d{4})\d+?$/, "$1");
          } else {
            target.value = value.replace(/\D/g, "")
              .replace(/(\d{2})(\d)/, "($1) $2")
              .replace(/(\d{4})(\d)/, "$1-$2")
              .replace(/(-\d{4})\d+?$/, "$1");
          }
          break
        case 'document':
          if (value.length > 14) {
            target.value = value.replace(/\D/g, "")
              .replace(/(\d{2})(\d)/, "$1.$2")
              .replace(/(\d{3})(\d)/, "$1.$2")
              .replace(/(\d{3})(\d)/, "$1/$2")
              .replace(/(\d{4})(\d)/, "$1-$2")
              .replace(/(-\d{2})\d+?$/, "$1");
          } else {
            target.value = value.replace(/\D/g, "")
              .replace(/(\d{3})(\d)/, "$1.$2")
              .replace(/(\d{3})(\d)/, "$1.$2")
              .replace(/(\d{3})(\d{1,2})/, "$1-$2")
              .replace(/(-\d{2})\d+?$/, "$1");
          }
          break
        default:
          break;
      }
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>