<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario'])): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Editar Despesa</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php
include_once "conexao.php";
$iddespesa = filter_var($_GET['iddespesa'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT tipo_despesa, empresa, titular, num_instalacao, consumo_velocidade, valor_mes, DATE_FORMAT(vencimento, '%d/%m/%Y') as vencimento, anexo_contas, parcela, situacao_conta FROM despesas WHERE iddespesa = '$iddespesa'";
$consulta = $conectar->query($sql);
$linha = $consulta->fetch(PDO::FETCH_ASSOC);
?>

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
        <div class="col"><a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Despesas</a></div>
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FSCs</a></div>
      </div>
    </div>
  </header>

  <main class="container-fluid">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body m-4 rounded shadow-lg">
                <h3 class="card-title text-center">Ficha da Locação</h3>
                <form enctype="multipart/form-data" action="editarDespesa.php?iddespesa=<?=$iddespesa?>" method="post">
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label id="tipo_despesa">Tipo da despesa</label>
                      <input id="tipo_despesa" name="tipo_despesa" class="form-control" type="text" value="<?= $linha['tipo_despesa'] ?>" aria-label="<?= $linha['tipo_despesa'] ?>">
                    </div>
                    <div class="col-md-4">
                      <label id="empresa">Empresa</label>
                      <input id="empresa" name="empresa" class="form-control" type="text" value="<?= $linha['empresa'] ?>" aria-label="<?= $linha['empresa'] ?>">
                    </div>
                    <div class="col-md-4">
                      <label id="titular">Titular</label>
                      <input id="titular" name="titular" class="form-control" type="text" value="<?= $linha['titular'] ?>" aria-label="<?= $linha['titular'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <?php if($linha['tipo_despesa'] == 'ÁGUA' || $linha['tipo_despesa'] == 'ENERGIA' || $linha['tipo_despesa'] == 'INTERNET'): ?>
                    <div class='col-md-2'>
                      <label id='num_instalacao'>Número da Instalação</label>
                      <input id='num_instalacao' name='num_instalacao' class='form-control' type='text' value='<?=$linha['num_instalacao']?>' aria-label='$linha[num_instalacao]'>
                    </div>
                    <div class='col-md-2'>
                      <label id='consumo_velocidade'>Consumo/Velocidade</label>
                      <input id='consumo_velocidade' name='consumo_velocidade' class='form-control' type='text' value='<?= $linha['consumo_velocidade']?>' aria-label='$linha[consumo_velocidade]'>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-2">
                      <label id="valor_mes">Valor da conta</label>
                      <input id="valor_mes" name="valor_mes" class="form-control" type="text" value="<?="R$ " . number_format($linha['valor_mes'], 2, ",",".") ?>" aria-label=<?="R$ " .  number_format($linha['valor_mes'], 2, ",",".") ?>">
                    </div>
                    <div class="col-md-2">
                      <label id="vencimento">Data de Vencimento</label>
                        <?php 
                          $vencimento = DateTime::createFromFormat('d/m/Y', $linha['vencimento'])->format('Y-m-d');
                        ?>
                        <input type="date" id="vencimento" name="vencimento" class="form-control" value="<?= $vencimento ?>">
                    </div>
                    <?php if($linha['situacao_conta'] == 1): ?>
                      <div class="col-md-2" colspan="2">
                        <label id="anexo_contas">Visualizar Anexo</label>
                        <div id='anexo_contas' name='anexo_contas' aria-label='$linha[anexo_contas]'><a target='_blank' href='<?= $linha['anexo_contas']?>' class='w-100 btn btn-secondary text-decoration-none text-white'>Comprovante de Pagamento</a></div>
                      </div>
                    <?php endif; ?>
                  </div>
                  
                  <div class="col text-center">
                    <a href="./visualizar-despesas.php" class="btn btn-danger">Voltar</a>
                    <input class="btn btn-success" type="submit" value="Confirmar Edição">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php'); endif; ?>
