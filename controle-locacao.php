<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario'])): 
?>

<?php 
  include_once 'conexao.php';
  $sql = "SELECT COUNT(*) AS QUANT_LOCACOES FROM LOCACAO";
  $consulta = $conectar->query($sql);
  $linha = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/controle-locacao.css">
  <link href="./assets/css/bootstrap.min.css">
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
          <li class="nav-item dropdown">
            <a class="nav-link" href="./controle-locacao.php">
              Gestão de Locação
            </a>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Em construção...</a>
          </li>
        </ul>
      </div>
      <div class="user d-flex text-center">
        <label class="infoUser border rounded d-flex flex-column align-items-center">
          <p class=""> <?= $nomeUser; ?></p>
          <p class=""> <?= $perfilUser; ?></p>
        </label>
        <a class="btn btn-danger m-auto mx-2" href="logout.php">Sair</a>
      </div>
    </div>
  </nav>
  
  <header class="text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none">Locações</a>
    <a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none">Locadores</a>
    <a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none">Gestores</a>
    <a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none">Alojados</a>
    <a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none">Despesas</a>
    <a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none">FSCs</a>
  </header>


  <main class="container-fluid">
    <div class="info-cards row py-3">
      <div class="col d-flex justify-content-center">
        <div class="card">
          <div class="card-body d-flex flex-column justify-content-around align-items-center">
            <h5 class="card-title">Quantidade de Locações Realizadas</h5>
            <?php
              $sql = "SELECT COUNT(*) AS QUANT_LOCACOES FROM LOCACAO";
              $consulta = $conectar->query($sql);
              
              if($linha = $consulta->rowCount() > 0) {
                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

                  echo "
                  <p class='display-5'>$linha[QUANT_LOCACOES]</p>
                  <p class='card-text'>Locações</p>
                  ";
                } 
              } else {
                echo "<p class='display-5'>0</p>";
              }
              
            ?>
            
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


<?php else: header('Location: login.php');endif;?>