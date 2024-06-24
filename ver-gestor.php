<?php 
$idgestor = filter_var($_GET['idgestor'], FILTER_SANITIZE_NUMBER_INT);
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Gestor <?=$idgestor ?></title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<?php
include_once "conexao.php";
$idgestor = filter_var($_GET['idgestor'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT nome, email, cargo, setor, unidade, telefone_1, telefone_2 from gestor where idgestor = '$idgestor'";
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
                <form method="get">
                <table class="table table-borderless">
                    <tr>
                      <td>
                        <label id="nome">
                          Nome
                          <input id="nome" class="form-control" type="text" value="<?= $linha['nome'] ?>" aria-label="<?= $linha['nome'] ?>"disabled readonly>
                        </label>
                      </td>
                      <td>
                        <label id="email">
                          E-mail
                          <input id="email" class="form-control" type="mail" value="<?= $linha['email'] ?>" aria-label="<?= $linha['email'] ?>"disabled readonly>
                        </label>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>
                        <label id="conta">
                          Cargo
                          <input id="cargo" class="form-control" type="text" value="<?= $linha['cargo'] ?>" aria-label="<?= $linha['cargo'] ?>"disabled readonly>
                        </label>
                      </td>
                      <td>
                        <label id="tipo_conta">
                          Setor
                          <input id="tipo_conta" class="form-control" type="text" value="<?= $linha['setor'] ?>" aria-label="<?= $linha['setor'] ?>"disabled readonly>
                        </label>
                      </td>
                      <td>
                        <label id="pix">
                          Unidade
                          <input id="pix" class="form-control" type="text" value="<?= $linha['unidade'] ?>" aria-label="<?= $linha['unidade'] ?>"disabled readonly>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label id="telefone_1">
                          Telefone
                          <input id="telefone_1" class="form-control" type="text" value="<?= $linha['telefone_1'] ?>" aria-label="<?= $linha['telefone_1'] ?>"disabled readonly>
                        </label>
                      </td>
                      <td>
                        <label id="telefone_2">
                          Celular
                          <input id="telefone_2" class="form-control" type="text" value="<?= $linha['telefone_2'] ?>" aria-label="<?= $linha['telefone_2'] ?>"disabled readonly>
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
        <a href="./visualizar-gestores.php" class="btn btn-danger btn-modal w-100">Voltar</a>
      </div>
    </div>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>