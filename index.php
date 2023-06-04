<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>To Com Fome | Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-tela-secundario">
      <div class="container-fluid ">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="navbar-brand" href="#">
                <img src="img/Logo.svg" alt="Logo" width="70" height="70" class="d-inline-block align-text-top ms-5">
              </a>
            </li>
          </ul>
          <ul class="navbar-nav justify-content-between align-items-center gap-2 me-4">
            <li class="nav-item ">
              <a class="nav-link text-white" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Sobre nós</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Aplicativo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Contato</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold active" href="./login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="bg-tela-home d-flex justify-content-center">
      <div class="img-cozinha">
        <img src="img/img_home.webp" alt="Mesa de cozinha" class="img_home p-5">

        <div class="col-5 text-center container-text top-50 start-50 translate-middle">
          <h3 class="h1 pb-3 corMarrom">Faça parte deste projeto!</h3>
          <p class="h3 pb-3">Tô com fome é uma solução tecnológica que trabalha em prol da luta de combate à fome no Brasil!</p>
          <a class="col-6 fw-bold mx-auto btn-marrom rounded-5 pe-5 ps-5 p-2" href="./login">Cadastre-se!</a>
        </div>
      </div>
    </div>


    <div class="bg-tela-primario text-center">
      <h3 class="corBege h2 p-0 pt-5 pb-5">Um projeto onde toda a sociedade partipa!</h3>

      <div class="row mw-100 p-0 gap-5 justify-content-center m-0">
        <div class="col-3 bg-grad-marrom rounded-4 p-4">
          <div class="col-4 bg-bege rounded-circle p-4 mx-auto">
            <img src="./img/iconEmpresa.webp" alt="icon agriculto" class="tamanho-Icon">
          </div>
          <p class="corBege h4">Empresa</p>
        </div>

        <div class="col-3 bg-grad-marrom rounded-4 p-4">
          <div class="col-4 bg-bege rounded-circle p-4 mx-auto">
            <img src="img/iconAgricultor.webp" alt="icon Empresa" class="tamanho-Icon">
          </div>
          <p class="corBege h4">Agricultor</p>
        </div>

        <div class="col-3 bg-grad-marrom rounded-4 p-4">
          <div class="col-4 bg-bege rounded-circle p-4 mx-auto">
            <img src="img/iconVoluntario.webp" alt="icon Voluntario" class="tamanho-Icon">
          </div>
          <p class="corBege h4">Voluntário</p>
        </div>
      </div>

      <div class="col-2 mx-auto pt-5 pb-5">
        <a href="./login" class="btn-link">
          <p class="corMarrom h5 bg-bege rounded-5 p-3">
            Participe!
          </p>
        </a>
      </div>
    </div>


    <div class="bg-tela-primario">
      <h3 class="corBege h2 p-0 pt-5 pb-5 text-center">Um projeto onde toda a sociedade participa!</h3>

      <div class="bg-tela-home p-5">
        <div class="row mw-100 justify-content-center align-items-center mx-auto">
          <div class="col-5 p-0">
            <img src="./img/mobile.webp" alt="modelo do app">
          </div>

          <div class="col-6 p-0">
            <p class="col-4 corBranco h3 text-center mx-auto m-0 pb-4">É só baixar, colocar seu nome e localizar o voluntário mais próximo</p>
            <div class="text-center">
              <img src="./img/platafroma.webp" alt="imagem da google play e app store">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-tela-primario ">
      <h3 class="corBege h2 p-0 pt-5 pb-5 text-center m-0">Empresas que encampam essa luta conosco!</h3>
    </div>

    <div class="bg-tela-secundario p-5">
      <div class="row mw-100 p-5 gap-5 justify-content-center align-items-center m-0">
        <div class="col-3">
          <img src="./img/microsoft_logo.webp" alt="logo microsoft">
        </div>

        <div class="col-3">
          <img src="./img/KraftHeinz_logo.webp" alt="logo kraftheinz">
        </div>

        <div class="col-3">
          <img src="./img/cacaFome_logo.webp" alt="logo caça fome">
        </div>
      </div>
    </div>

    <div class="bg-tela-primario p-5">
      <h3 class="corBege h2 p-0 pt-5 pb-5 text-center m-0">Entre em contato conosco!</h3>

      <div class="col-4 mx-auto pb-5">
        <form action="">
          <div class="row">
            <div class="col">
              <input type="email" id="inputEmail" class="form-control bg-bd-campo-primario corCinza m-0 " aria-labelledby="email" placeholder="EMAIL:">
            </div>

            <div class="col-3 d-grid mx-auto ps-0">
              <button type="submit" class="btn btn-branco">Enviar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="bg-tela-secundario p-4 text-center ">
    <p class="corBrancoSemBold">Feito por Ritter Humboldt - Copyright &copy; 2023 - Todos os direitos reservados</p>
  </footer>

</body>

</html>