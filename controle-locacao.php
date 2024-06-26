<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario'])): 
?>

<?php 
  include_once 'conexao.php';
  $sql = "SELECT COUNT(*) AS QUANT_LOCACOES FROM locacao";
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
          <li class="nav-item dropdown">
            <a class="nav-link" href="./controle-locacao.php">
              Gestão de Locação
            </a>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Em construção...</a>
          </li>
        </ul>
        <div class="user d-flex text-center">
          <label class="infoUser border rounded d-flex flex-column align-items-center me-auto">
            <p class=""> <?= $nomeUser; ?></p>
            <p class=""> <?= $perfilUser; ?></p>
          </label>
          <a class="btn btn-danger m-auto mx-2" href="logout.php">Sair</a>
        </div>
      </div>
    </div>
  </nav>
  
  <header class="fixed text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <div class="container-fluid">
      <div class="row">
        <div class="col"><a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Locações</a></div>
        <div class="col"><a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Locadores</a></div>
        <div class="col"><a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Gestores</a></div>
        <div class="col"><a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Alojados</a></div>
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Cotações</a></div>
        <div class="col"><a href="visualizar-ftc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FTCs</a></div>
      </div>
    </div>
  </header>


  <main class="container-fluid">
    <div class="info-cards row py-3">
      <div class="col d-flex text-center">
          <div class="card w-100">
            <div class="card-body d-flex flex-column justify-content-around align-items-center">
              <h5 class="card-title">Quantidade de Locações Realizadas</h5>
              <?php
                $sql = "SELECT COUNT(*) AS QUANT_LOCACOES FROM locacao";
                $consulta = $conectar->query($sql);
                
                if($linha = $consulta->rowCount() > 0) {
                  while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    echo "<p class='display-3'>$linha[QUANT_LOCACOES]</p>
                          <p class='card-text'>Locações</p>";
                  } 
                } else {
                  echo "<p class='display-5'>0</p>";
                }
                
              ?>
              
            </div>
          </div>


          <div class="card w-100">
            <div class="card-body d-flex flex-column justify-content-around align-items-center">
              <h5 class="card-title">Situações das Locações</h5>
              <div class="table-responsive">
              <?php
                echo "<table class='table table-borderless w-75 m-2'>";
                $sql = "SELECT situacao, count(situacao) as quantidade from locacao group by situacao";
                $consultaSituacao = $conectar->query($sql);
                if($linha = $consultaSituacao->rowCount() > 0) {
                  while($linha = $consultaSituacao->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr class='text-center'>
                            <td class='h5'>$linha[quantidade]</td>
                            <td>$linha[situacao]</td>
                          </tr>";
                  }
                } else {
                  echo "<tr class='text-center'>
                          <td> Sem locações cadastradas </td>
                        </tr>";  
                }
                echo "</table>";
              ?>
              </div>
            </div>
          </div>
      </div>
    </div>

      <div class="info-cards row py-3">
        <div class="col text-center">
          <div class="card w-100">
            <div class="card-body d-flex flex-column justify-content-around">
              <h5 class="card-title">Próximas contas a vencer</h5>
              <div class="table-responsive">
              <?php
                echo "<table class='table table-borderless'>
                          <tr>
                            <th>Tipo da Despesa</th>
                            <th>Número da Locação</th>
                            <th>Valor</th>
                            <th>Data de vencimento</th>
                          </tr>";
                $sql = "SELECT tipo_despesa, l.idlocacao, valor_mes, vencimento FROM despesas d inner join locacao l on d.id_locacao = l.idlocacao WHERE VENCIMENTO BETWEEN CURRENT_DATE and DATE_ADD(CURRENT_DATE, INTERVAL 5 day) and situacao_conta = 0";
                $consultaContaAVencer = $conectar->query($sql);
                if($linha = $consultaContaAVencer->rowCount() > 0) {
                  while($linha = $consultaContaAVencer->fetch(PDO::FETCH_ASSOC)){
                    $valorMes = number_format($linha['valor_mes'], 2, ',', '.');
                    $vencimento = DateTime::createFromFormat('Y-m-d', $linha['vencimento'])->format('d/m/Y');
                    echo "
                          <tr>
                            <td>$linha[tipo_despesa]</td>
                            <td>$linha[idlocacao]</td>
                            <td>R$ $valorMes</td>
                            <td>$vencimento</td>
                          </tr>";
                  }
                } else {
                  echo "<tr class='text-center'>
                    <td colspan='4'>Sem contas a vencer nos próximos 5 dias</td>
                  </tr>";
                }
                echo "</table>";
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="info-cards row py-3">
        <div class="col text-center">
          <div class="card w-100">
            <div class="card-body d-flex flex-column justify-content-around">
              <h5 class="card-title">Próximas locações a vencer</h5>
              <div class="table-responsive">
              <?php
                echo "<table class='table table-borderless'>
                          <tr>
                            <th>Número da Locação</th>
                            <th>Gestor Responsável</th>
                            <th>Endereço</th>
                            <th>Data de fechamento</th>
                          </tr>";
                $sql = "SELECT lc.idlocacao, lc.termino_locacao, g.nome as gestor, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep FROM locacao lc 
                inner join gestor g on lc.id_gestor = g.idgestor
                inner join endereco e on lc.id_endereco = e.idendereco 
                WHERE lc.termino_locacao BETWEEN CURRENT_DATE and DATE_ADD(CURRENT_DATE, INTERVAL 60 day)";
                $consultaLocacaoAVencer = $conectar->query($sql);
                if($linha = $consultaLocacaoAVencer->rowCount() > 0) {
                  while($linha = $consultaLocacaoAVencer->fetch(PDO::FETCH_ASSOC)){
                    $terminoLocacao = DateTime::createFromFormat('Y-m-d', $linha['termino_locacao'])->format('d/m/Y');
                    echo "
                          <tr>
                            <td>$linha[idlocacao]</td>
                            <td>$linha[gestor]</td>
                            <td>$linha[rua], $linha[numero] $linha[complemento] - $linha[bairro], $linha[cidade] - $linha[estado] - $linha[cep]</td>
                            <td>$terminoLocacao</td>
                          </tr>";
                  }
                } else {
                  echo "<tr class='text-center'>
                    <td colspan='4'>Sem locações a vencer nos próximos 60 dias</td>
                  </tr>";
                }
                echo "</table>";
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<?php else: header('Location: login.php');endif;?>