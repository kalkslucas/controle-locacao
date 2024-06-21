<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<?php
include_once "conexao.php";
$iddespesa = filter_var($_GET['iddespesa'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT tipo_despesa, empresa, titular, num_instalacao, consumo_velocidade, valor_mes, DATE_FORMAT(vencimento, '%d/%m/%Y') as vencimento, parcela from despesas where iddespesa = '$iddespesa'";
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

  <header class="fixed text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none">Locações</a>
    <a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none">Locadores</a>
    <a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none">Gestores</a>
    <a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none">Alojados</a>
    <a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none">Despesas</a>
    <a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none">FSCs</a>
  </header>

  <main class="container-fluid">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body m-4 rounded shadow-lg">
                <h3 class="card-title text-center">Ficha da Locação</h3>
                <form enctype="multipart/form-data" action="pagarDespesa.php?iddespesa=<?=$iddespesa?>" method="post">
                <table class="table table-borderless">
                    <tr>
                      <td>
                        <label id="tipo_despesa">
                          Tipo da despesa
                          <input id="tipo_despesa" name="tipo_despesa" class="form-control" type="text" value="<?= $linha['tipo_despesa'] ?>" aria-label="<?= $linha['tipo_despesa'] ?>" readonly>
                        </label>
                      </td>
                      <td>
                        <label id="empresa">
                          Empresa
                          <input id="empresa" name="empresa" class="form-control" type="text" value="<?= $linha['empresa'] ?>" aria-label="<?= $linha['empresa'] ?>" readonly>
                        </label>
                      </td>
                      <td colspan="2">
                        <label id="titular" style="width: 100%;">
                          Titular
                          <input id="titular" name="titular" class="form-control" type="text" value="<?= $linha['titular'] ?>" aria-label="<?= $linha['titular'] ?>" readonly>
                        </label>
                      </td>
                    </tr>
                    
                    <tr>
                    <?php
                      if($linha['tipo_despesa'] == 'ÁGUA' || $linha['tipo_despesa'] == 'ENERGIA' || $linha['tipo_despesa'] == 'INTERNET') {
                        echo "<td>
                                <label id='num_instalacao'>
                                  Número da Instalação
                                  <input id='num_instalacao' name='num_instalacao' class='form-control' type='text' value='$linha[num_instalacao]' aria-label='$linha[num_instalacao]'>
                                </label>
                              </td>
                              <td>
                                <label id='consumo_velocidade'>
                                  Consumo/Velocidade
                                  <input id='consumo_velocidade' name='consumo_velocidade' class='form-control' type='text' value='$linha[consumo_velocidade]' aria-label='$linha[consumo_velocidade]'>
                                </label>
                              </td>";
                      } else {
                        echo "<td class='d-none'>
                                <label id='num_instalacao'>
                                  Número da Instalação
                                  <input id='num_instalacao' name='num_instalacao' class='form-control' type='text' value='<?= $linha[num_instalacao] ?>' aria-label='<?= $linha[num_instalacao] ?>'>
                                </label>
                              </td>
                              <td class='d-none'>
                                <label id='consumo_velocidade'>
                                  Consumo/Velocidade
                                  <input id='consumo_velocidade' name='consumo_velocidade' class='form-control' type='text' value='<?= $linha[consumo_velocidade] ?>' aria-label='<?= $linha[consumo_velocidade] ?>'>
                                </label>
                              </td>";
                      }
                      ?>
                      <td>
                        <label id="valor_mes">
                          Valor da conta
                          <input id="valor_mes" name="valor_mes" class="form-control" type="text" value="<?= $linha['valor_mes'] ?>" aria-label="<?= $linha['valor_mes'] ?>" readonly>
                        </label>
                      </td>
                      <td>
                        <label id="vencimento">
                          Data de Vencimento
                          <input id="vencimento" name="vencimento" class="form-control" type="text" value="<?= $linha['vencimento'] ?>" aria-label="<?= $linha['vencimento'] ?>" readonly>
                        </label>
                      </td>
                      <td>
                        <label id="parcela">
                          Parcela
                          <input id="parcela" name="parcela" class="form-control" type="text" value="<?= $linha['parcela'] ?>" aria-label="<?= $linha['parcela'] ?>" readonly>
                        </label>
                      </td>
                    </tr>

                    <tr>

                      
                      <td colspan="2">
                        <label id="anexo_contas">
                          Visualizar Anexos
                          <input id="anexo_contas" name="anexo_contas" class="form-control" type="file" required>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="5" class="text-end">
                        <br>
                        <label style="width: 25%;" id="enviar">
                          <input class="form-control btn btn-success" type="submit" value="Confirmar Pagamento">
                        </label>
                      </td>
                    </tr>
                  </table>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-end">
      <div class="col-md-1 col-sm-12 mb-4">
        <a href="./visualizar-despesas.php" class="btn btn-danger btn-modal w-100">Voltar</a>
      </div>
    </div>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>