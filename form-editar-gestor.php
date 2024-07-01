<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Editar Gestor</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<?php
include_once "conexao.php";
$idGestor = filter_var($_GET['idgestor'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT nome, email, cargo, setor, unidade, telefone_1, telefone_2 from gestor where idgestor = '$idGestor'";
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
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FSCs</a></div>
        <div class="col"><a href="visualizar-ftc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FTCs</a></div>
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
                <form action="editarGestor.php?idgestor=<?=$idGestor?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-3">
                      <label id="nome">Nome</label>
                      <input id="nome" name="nome" class="form-control" value="<?= $linha['nome']?>" type="text" placeholder="Digite o nome completo" required>
                    </div>
                    <div class="col-md-3">
                      <label id="cargo">Cargo</label>
                      <input id="cargo" name="cargo" class="form-control" value="<?= $linha['cargo']?>" type="text" placeholder="Ex: Gerente Administrativo" required>
                    </div>
                    <div class="col-md-3">
                      <label id="setor">Setor</label>
                      <input id="setor" name="setor" class="form-control" value="<?= $linha['setor']?>" type="text" placeholder="Ex: Obras" required>
                    </div>
                    <div class="col-md-3">
                      <label id="unidade">Unidade</label>
                      <input id="unidade" name="unidade" class="form-control" value="<?= $linha['unidade']?>" type="text" placeholder="Ex: Sede" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label id="email">E-mail</label>
                      <input id="email" name="email" class="form-control" value="<?= $linha['email']?>" type="email" placeholder="Ex: abc@ultra.eng.br OU abc@gmail.com">
                    </div>
                    <div class="col-md-4">
                      <label id="telefone1">Telefone 1</label>
                      <input id="telefone1" name="telefone1" class="form-control" value="<?= $linha['telefone_1']?>" type="text" placeholder="Ex: 3198765432" required>
                    </div>
                    <div class="col-md-4">
                      <label id="telefone2">Telefone 2</label>
                      <input id="telefone2" name="telefone2" class="form-control" value="<?= $linha['telefone_2']?>" type="text" placeholder="Ex: 31987654321">
                    </div>
                  </div>
              
                  <div class="col text-center">
                    <a href="./visualizar-gestores.php" class="btn btn-danger">Voltar</a>
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

<?php else: header('Location: login.php');endif;?>