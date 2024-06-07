<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/controle-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="page">
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="./assets/img/navbar-logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./controle-locacao.html" role="button">
              Gestão de Locação
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Em construção...</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container-fluid">
    <div class="row py-3">
      <div class="col-12">
        <div class="menu d-flex flex-row justify-content-around">
          <a href="visualizar-locacoes.php" class="d-block btn btn-warning">Locações</a>
          <a href="visualizar-locadores.php" class="d-block btn btn-warning">Locadores</a>
          <a href="" class="d-block btn btn-warning">Gestores</a>
          <a href="" class="d-block btn btn-warning">Alojados</a>
          <a href="" class="d-block btn btn-warning">Despesas</a>
          <a href="" class="d-block btn btn-warning">FSCs</a>
        </div>
      </div>
    </div>


    <div class="info-cards row py-3">
      <div class="col d-flex justify-content-center">
        <div class="card">
          <div class="card-body d-flex flex-column justify-content-around align-items-center">
            <h5 class="card-title">Quantidade de Locações Realizadas</h5>
            <p class="display-5">8</p>
            <p class="card-text">Locações</p>
          </div>
        </div>
      </div>
      <div class="col d-flex justify-content-center">
        <div class="card">
          <div class="card-body d-flex flex-column justify-content-around align-items-center">
            <h5 class="card-title">Situações das Locações</h5>
            <p class="text-center">5 Ativos</p>
            <p class="text-center">3 Inativos</p>
            <p class="text-center">8 Pendentes</p>
          </div>
        </div>
      </div>
      <div class="col d-flex justify-content-center">
        <div class="card">
          <div class="card-body d-flex flex-column justify-content-around align-items-center">
            <h5 class="card-title">Quantidade de Locações Realizadas</h5>
            <p class="display-5">8</p>
            <p class="card-text">Locações</p>
          </div>
        </div>
      </div>

    </div>
  </main>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>