<?php
$idLocacao = filter_var($_GET["idlocacao"], FILTER_SANITIZE_NUMBER_INT);
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Gerar Conta</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="./assets/css/gerar-conta.css">
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

  <main class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow-lg mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="card-title text-center display-4">Cadastro de Conta</h3>
                <form action="gerarConta.php" method="post">
                  <div class="mt-1">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label id="tipoDespesa" class="d-inline">Tipo de conta</label>
                          <select class="form-select" name="tipoDespesa" id="tipoDespesa" required>
                            <option value="">---</option>
                            <option value="ENERGIA">Energia</option>
                            <option value="ÁGUA">Água</option>
                            <option value="INTERNET">Internet</option>
                            <option value="CONDOMÍNIO">Condomínio</option>
                            <option value="IPTU">IPTU</option>
                            <option value="IMPOSTO DE RENDA">Imposto de Renda</option>
                          </select>
                      </div>
                      <div class="col-md-3">
                        <label id="empresa" class="d-inline">Empresa</label>
                        <input id="empresa" name="empresa" class="form-control" type="text" placeholder="Digite o nome da empresa" required>
                      </div>
                      <div class="col-md-3">
                        <label id="titular" class="d-inline">Titular</label>
                          <input id="titular" name="titular" class="form-control" type="text" placeholder="Digite o nome do titular da conta" required>
                      </div>
                      <div class="col-md-3">
                        <label id="parcela" class="d-inline">Parcela</label>
                        <input id="parcela" name="parcela" class="form-control" type="number" placeholder="Digite qual o número da parcela" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label id="numInstalacao" class="d-inline">Número da Instalação</label>
                        <input id="numInstalacao" name="numInstalacao" class="form-control" type="text" placeholder="Digite o n° da instalação">
                      </div>
                      <div class="col-md-3">
                        <label id="consumoVelocidade" class="d-inline">Consumo/Velocidade</label>
                          <input id="consumoVelocidade" name="consumoVelocidade" class="form-control" type="number" placeholder="36m³, 40kWh, 500MB">
                      </div>
                      <div class="col-md-3">
                        <label id="valorConta" class="d-inline">Valor da Conta</label>
                          <input id="valorConta" name="valorConta" class="form-control" type="text" placeholder="Ex: 9999.99" required>
                      </div>
                      <div class="col-md-3">
                        <label id="dataVencimento" class="d-inline">Data de Vencimento</label>
                          <input id="dataVencimento" name="dataVencimento" class="form-control" type="date" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-12">
                        <label id="vincularLocacao" class="d-inline">Vincular a Locação</label>
                        <select class="form-select" name="vincularLocacao" id="vincularLocacao" required>
                          <?php
                          include_once 'conexao.php';
                          try {
                            $queryLocacaoAtual = "SELECT lc.idlocacao, e.rua, e.numero, e.bairro, e.cidade, e.estado, e.cep, g.nome as gestor 
                                                  from alojado a 
                                                  inner join locacao lc
                                                  on a.id_locacao = lc.idlocacao
                                                  inner join endereco e
                                                  on lc.id_endereco = e.idendereco
                                                  inner join gestor g
                                                  on a.id_gestor = g.idgestor
                                                  where lc.idlocacao = :idlocacao
                                                  order by lc.idlocacao asc";
                            $consultaLocacaoAtual = $conectar->prepare($queryLocacaoAtual);
                            $consultaLocacaoAtual->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
                            $consultaLocacaoAtual->execute();
                            $linhaLocacaoAtual = $consultaLocacaoAtual->fetch(PDO::FETCH_ASSOC);

                            echo "<option value=''>Nenhuma</option>";

                            if($linhaLocacaoAtual){
                              echo "<option value='$linhaLocacaoAtual[idlocacao]' selected>$linhaLocacaoAtual[idlocacao] | $linhaLocacaoAtual[rua], $linhaLocacaoAtual[numero], $linhaLocacaoAtual[bairro], $linhaLocacaoAtual[cidade] - $linhaLocacaoAtual[estado] | $linhaLocacaoAtual[gestor]";
                              $idLocacaoAtual = $linhaLocacaoAtual["idlocacao"];
                            } else {
                              $idLocacaoAtual = null;
                            } 
                              $queryLista = "SELECT lc.idlocacao, e.rua, e.numero, e.bairro, e.cidade, e.estado, e.cep, g.nome as gestor 
                                                FROM locacao lc 
                                                INNER JOIN endereco e ON lc.id_endereco = e.idendereco 
                                                INNER JOIN gestor g ON lc.id_gestor = g.idgestor
                                                ";
                              if($idLocacaoAtual){
                                $queryLista .= "WHERE lc.idlocacao != :idLocacaoAtual
                                                ORDER BY lc.idlocacao asc";
                              } else {
                                $queryLista .= "ORDER BY lc.idlocacao asc";
                              }
                              $consulta = $conectar->prepare($queryLista);

                              if($idLocacaoAtual){
                                $consulta->bindParam(":idLocacaoAtual",$idLocacaoAtual, PDO::PARAM_INT);
                              }
                              
                              $consulta->execute();

                              while($linhaLocacao = $consulta->fetch(PDO::FETCH_ASSOC)){
                                echo "<option value='$linhaLocacao[idlocacao]'>$linhaLocacao[idlocacao] | $linhaLocacao[rua], $linhaLocacao[numero], $linhaLocacao[bairro], $linhaLocacao[cidade] - $linhaLocacao[estado] | $linhaLocacao[gestor]";
                              }                         
                          } catch (PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                          }

                          echo "</select>";
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class="col text-center">
                    <a href="./ver-locacao.php?idlocacao=<?=$idLocacao?>" class="text-center btn btn-danger">Voltar</a>
                    <input class="btn btn-laranja" type="submit" value="Cadastrar Conta">
                  </div>
                  

                  <label class="d-flex mt-3" id="enviarLocacao">
                    
                  </label>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </main>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <script src="assets/js/validarMoeda.js" defer></script>
</body>
</html>

<?php else: header('Location: login.php');endif;?>