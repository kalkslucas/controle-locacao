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
  <title>Controle de Locação - Despesas da Locação <?=$idLocacao ?></title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/visualizar-locadores.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/f8c979c0bf.js" crossorigin="anonymous"></script>
</head>
<?php
  $idLocacao = filter_var($_GET["idlocacao"], FILTER_SANITIZE_NUMBER_INT);
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
        <div class="col"><a href="visualizar-ftc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FTCs</a></div>
      </div>
    </div>
  </header>

  <div class="hstack gap-1 px-2 mb-3">
    <a href='./form-gerar-conta.php' class='btn btn-warning'>Cadastrar Despesa</a>
    <a href='./controle-locacao.php' class='btn btn-danger'>Voltar a página inicial</a>
    <form action="" class="d-flex ms-auto">
      <input type="hidden" name="idlocacao" value="<?=$idLocacao?>">
      <a href="./visualizar-despesas-locacao.php?idlocacao=<?=$idLocacao?>" class="btn btn-primary me-2"><i class="fa-solid fa-trash"></i></a>
      <input type="text" name="filtrar" id="filtrar" placeholder="Pesquisar" class="form-control me-2" aria-label="Pesquisar" value="<?php if(isset($_GET['filtrar'])) echo $_GET['filtrar']?>">
      <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  </div>

  <main class="container-fluid">
    <div class="row p-3 justify-content-center">
      <div class="col-12">
        <div class="p-2 table-responsive">
        <?php
        echo "
              <h3>Contas pagas</h3>
                  <table class='table table-borderless table-responsive'>
                    <thead>
                      <tr class='text-center'>
                        <th>Tipo da Despesa</th>
                        <th>Número da Locação</th>
                        <th>Titular</th>
                        <th>Parcela</th>
                        <th>Valor</th>
                        <th>Data de Vencimento</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Abrir Conta</th>
                      </tr>
                    </thead>
                    <tbody>";
        ?>

        <?php
          include_once "conexao.php";
          try {
            $idLocacao = filter_var($_GET["idlocacao"], FILTER_SANITIZE_NUMBER_INT);
            if(!isset($_GET['filtrar'])){
              //query sql de consulta
              $sql = "SELECT iddespesa, tipo_despesa, titular, valor_mes, DATE_FORMAT(vencimento, '%d/%m/%Y') as vencimento, parcela FROM despesas WHERE situacao_conta = 1 and id_locacao = '$idLocacao'";
              //execução da instrução sql
              $consulta = $conectar->query($sql);
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $valor_mes = number_format($linha['valor_mes'], 2, ",", ".");
                echo "  <tr class='text-center'>
                          <td>$linha[tipo_despesa]</td>
                          <td>$linha[id_locacao]</td>
                          <td>$linha[titular]</td>
                          <td>$linha[parcela]</td>
                          <td>R$ $valor_mes</td>
                          <td>$linha[vencimento]</td>
                          <td><a href='./ver-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-primary p-2'><i class='fa-solid fa-eye fa-xl'></i></a></td>
                          <td><a href='./form-editar-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-laranja p-2'><i class='fa-solid fa-pencil fa-xl'></i></a></td>
                          <td><a href='./form-abrir-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-danger p-2'><i class='fa-solid fa-hand-holding-dollar fa-xl'></i></a></td>
                        </tr>
                ";
              }
            } else {
              $filtrar = filter_var($_GET['filtrar']);
              $sql = "SELECT iddespesa, tipo_despesa, titular, valor_mes, DATE_FORMAT(vencimento, '%d/%m/%Y') as vencimento, parcela 
              FROM despesas 
              WHERE situacao_conta = 1
              and id_locacao = :idlocacao
              and tipo_despesa like CONCAT('%',:filtrar,'%')
              or titular like CONCAT('%',:filtrar,'%')
              or vencimento like CONCAT('%',:filtrar,'%')";
              $consulta = $conectar->prepare($sql);
              $consulta->bindParam(":filtrar", $filtrar, PDO::PARAM_STR);
              $consulta->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
              $consulta->execute();
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $valor_mes = number_format($linha['valor_mes'], 2, ",", ".");
                echo "  
                        <tr class='text-center'>
                          <td>$linha[tipo_despesa]</td>
                          <td>$linha[id_locacao]</td>
                          <td>$linha[titular]</td>
                          <td>$linha[parcela]</td>
                          <td>R$ $valor_mes</td>
                          <td>$linha[vencimento]</td>
                          <td><a href='./ver-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-primary p-2'><i class='fa-solid fa-eye fa-xl'></i></a></td>
                          <td><a href='./form-editar-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-laranja p-2'><i class='fa-solid fa-pencil fa-xl'></i></a></td>
                          <td><a href='./form-abrir-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-danger p-2'><i class='fa-solid fa-hand-holding-dollar fa-xl'></i></a></td>
                        </tr>
                ";
              }

            }
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
        ?>

        <?php
          echo"
                    </tbody>  
                  </table>";
        ?>
        </div>
      </div> 
    </div>



    <div class="row p-3 justify-content-center">
      <div class="col-12">
        <div class="p-2 table-responsive">
        <?php
        echo "
              <h3>Contas em aberto</h3>
                  <table class='table table-borderless table-responsive'>
                    <thead>
                      <tr class='text-center'>
                        <th>Tipo da Despesa</th>
                        <th>Número da Locação</th>
                        <th>Titular</th>
                        <th>Parcela</th>
                        <th>Valor</th>
                        <th>Data de Vencimento</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Pagar Conta</th>
                      </tr>
                    </thead>
                    <tbody>";
        ?>

        <?php
          include_once "conexao.php";
          try {
            if(!isset($_GET["filtrar"])){
              //query sql de consulta
              $sql = "SELECT iddespesa, tipo_despesa, titular, valor_mes, DATE_FORMAT(vencimento, '%d/%m/%Y') as vencimento, parcela, id_locacao FROM despesas WHERE situacao_conta = 0 and id_locacao = '$idLocacao'";
              //execução da instrução sql
              $consulta = $conectar->query($sql);
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $valor_mes = number_format($linha['valor_mes'], 2, ",", ".");
                echo "  <tr class='text-center'>
                          <td>$linha[tipo_despesa]</td>
                          <td>$linha[id_locacao]</td>
                          <td>$linha[titular]</td>
                          <td>$linha[parcela]</td>
                          <td>R$ $valor_mes</td>
                          <td>$linha[vencimento]</td>
                          <td><a href='./ver-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-primary p-2'><i class='fa-solid fa-eye fa-xl'></i></a></td>
                          <td><a href='./form-editar-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-laranja p-2'><i class='fa-solid fa-pencil fa-xl'></i></a></td>
                          <td><a href='./form-pagar-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-success p-2'><i class='fa-solid fa-money-bill-transfer fa-xl'></i></a></td>
                        </tr>
                ";
              }
            } else {
              $filtrar = filter_var($_GET['filtrar']);
              $sql = "SELECT iddespesa, tipo_despesa, titular, valor_mes, DATE_FORMAT(vencimento, '%d/%m/%Y') as vencimento, parcela, id_locacao 
              FROM despesas 
              WHERE situacao_conta = 0
              and id_locacao = :idlocacao
              and tipo_despesa like CONCAT('%',:filtrar,'%')
              or titular like CONCAT('%',:filtrar,'%')
              or vencimento like CONCAT('%',:filtrar,'%')";
              $consulta = $conectar->prepare($sql);
              $consulta->bindParam(":filtrar", $filtrar, PDO::PARAM_STR);
              $consulta->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
              $consulta->execute();
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $valor_mes = number_format($linha['valor_mes'], 2, ",", ".");
                echo "  
                        <tr class='text-center'>
                          <td>$linha[tipo_despesa]</td>
                          <td>$linha[id_locacao]</td>
                          <td>$linha[titular]</td>
                          <td>$linha[parcela]</td>
                          <td>R$ $valor_mes</td>
                          <td>$linha[vencimento]</td>
                          <td><a href='./ver-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-primary p-2'><i class='fa-solid fa-eye fa-xl'></i></a></td>
                          <td><a href='./form-editar-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-laranja p-2'><i class='fa-solid fa-pencil fa-xl'></i></a></td>
                          <td><a href='./form-pagar-despesa.php?iddespesa=$linha[iddespesa]' class='btn btn-success p-2'><i class='fa-solid fa-money-bill-transfer fa-xl'></i></a></td>
                        </tr>
                ";
              }
            }
            
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
        ?>

        <?php
          echo"
                    </tbody>  
                  </table>";
        ?>
        </div>
      </div> 
    </div>

    <div class="row justify-content-end">
      <div class="col-md-1 col-sm-12 mb-4">
        <?php
          echo "<a href='./ver-locacao.php?idlocacao=$idLocacao' class='btn btn-danger btn-modal w-100'>Voltar</a>";
        ?>
      </div>
    </div>
  </main>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>