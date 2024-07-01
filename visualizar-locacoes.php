<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Locações</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/menu.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/visualizar-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/f8c979c0bf.js" crossorigin="anonymous"></script>
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
        <div class="col"><a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Despesas</a></div>
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FSCs</a></div>
        <div class="col"><a href="visualizar-ftc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FTCs</a></div>
      </div>
    </div>
  </header>

  <div class="menu page hstack gap-1 px-2 mb-3">
    <a href='./form-cadastrar-locacao.php' class='btn btn-warning'>Cadastrar Locação</a>
    <a href='./form-gerar-aditivo.php' class='btn btn-primary'>Gerar Aditivo</a>
    <form action="" class="d-flex ms-auto">
      <input type="text" name="filtrar" id="filtrar" placeholder="Pesquisar" class="form-control me-2" aria-label="Pesquisar" value="<?php if(isset($_GET['filtrar'])) echo $_GET['filtrar']?>">
      <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  </div>

  <main class="container-fluid">
    <div class="row p-3 justify-content-center">
      <?php
      include_once "conexao.php";
      try {
        //query sql de consulta
        if(!isset($_GET['filtrar'])) {
          $sql = "SELECT situacao, idlocacao, g.nome as gestor, l.nome as locador, responsavel, rua, numero, complemento, bairro, cidade, estado, cep 
          FROM locacao lc 
          inner join gestor g 
          on lc.id_gestor = g.idgestor 
          inner join endereco e 
          on lc.id_endereco = e.idendereco
          inner join locador l
          on lc.id_locador = l.idlocador
          order by idlocacao asc";
          //execução da instrução sql
          $consulta = $conectar->query($sql);
          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            //Imprime o cabeçalho da tabela e o link para novo cadastro
            echo "<div class='col d-flex justify-content-center'>
              <div class='card'>
                <div class='card-body'>
                  <h5 class='card-title'>Locação $linha[idlocacao]</h5>
                  <p class='card-text'>
                    Situação: <strong>$linha[situacao]</strong>
                    <br>
                    Locador: <strong>$linha[locador]</strong>
                    <br>
                    Responsável: <strong>$linha[responsavel]</strong>
                    <br>
                    Gestor: <strong>$linha[gestor]</strong>
                    <br>
                    $linha[rua], $linha[numero], $linha[complemento],
                    $linha[bairro] - $linha[cidade] - $linha[estado]
                  </p>
                  <div class='card-btns'>
                    <a href='./ver-locacao.php?idlocacao=$linha[idlocacao]' class='btn btn-laranja'>Ver Locação</a>
                    <a href='./form-editar-locacao.php?idlocacao=$linha[idlocacao]' class='btn btn-laranja'>Editar Locação</a>
                  </div>
                </div>
              </div>
            </div>";
          }
        } else {
          $filtrar = filter_var($_GET['filtrar']);
          $sql = "SELECT situacao, idlocacao, g.nome as gestor, l.nome as locador, rua, numero, complemento, bairro, cidade, estado, cep 
          FROM locacao lc 
          inner join gestor g 
          on lc.id_gestor = g.idgestor 
          inner join endereco e 
          on lc.id_endereco = e.idendereco
          inner join locador l
          on lc.id_locador = l.idlocador
          where idlocacao like CONCAT('%', :filtrar, '%')
          or situacao like CONCAT('%', :filtrar, '%')
          or g.nome like CONCAT('%', :filtrar, '%')
          or l.nome like CONCAT('%', :filtrar, '%')
          or rua like CONCAT('%', :filtrar, '%')
          or numero like CONCAT('%', :filtrar, '%')
          or complemento like CONCAT('%', :filtrar, '%')
          or bairro like CONCAT('%', :filtrar, '%')
          or cidade like CONCAT('%', :filtrar, '%')
          or estado like CONCAT('%', :filtrar, '%')
          or cep like CONCAT('%', :filtrar, '%')
          order by idlocacao asc";
          //execução da instrução sql
          $consulta = $conectar->prepare($sql);
          $consulta->bindParam(":filtrar", $filtrar, PDO::PARAM_STR);
          $consulta->execute();
          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            //Imprime o cabeçalho da tabela e o link para novo cadastro
            echo "<div class='col d-flex justify-content-center'>
              <div class='card'>
                <div class='card-body'>
                  <h5 class='card-title'>Locação $linha[idlocacao]</h5>
                  <p class='card-text'>
                    Situação: <strong>$linha[situacao]</strong>
                    <br>
                    Locador: <strong>$linha[locador]</strong>
                    <br>
                    Gestor: <strong>$linha[gestor]</strong>
                    <br>
                    $linha[rua], $linha[numero], $linha[complemento],
                    $linha[bairro] - $linha[cidade] - $linha[estado]
                  </p>
                  <div class='card-btns'>
                    <a href='./ver-locacao.php?idlocacao=$linha[idlocacao]' class='btn btn-laranja'>Ver Locação</a>
                    <a href='./form-editar-locacao.php?idlocacao=$linha[idlocacao]' class='btn btn-laranja'>Editar Locação</a>
                  </div>
                </div>
              </div>
            </div>";
          }
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      ?>
    </div>
  </main>

  <footer class="page p-3 fixed-bottom">
    <div class="col text-end">
      <a href='./controle-locacao.php' class='btn btn-danger'>Voltar a página inicial</a>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>