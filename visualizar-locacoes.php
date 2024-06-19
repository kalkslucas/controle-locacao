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
  <link rel="stylesheet" href="assets/css/visualizar-locacao.css">
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
      </div>
      <div class="user px-2 d-flex text-center">
        <label class="infoUser border d-flex flex-column align-items-center">
          <p class=""> <?= $nomeUser; ?></p>
          <p class=""> <?= $perfilUser; ?></p>
        </label>
      </div>
      <a class="btn btn-outline-danger" href="logout.php">Sair</a>
    </div>
  </nav>

  <div class="text-end p-2">
    <a href='./form-cadastrar-locacao.php' class='btn btn-warning'>Cadastrar Locação</a>
    <a href='./controle-locacao.php' class='btn btn-danger'>Voltar a página inicial</a>
  </div>

  <main class="container-fluid">
    
    <div class="row justify-content-center">
      <?php
      include_once "conexao.php";
      try {
        //query sql de consulta
        $sql = "SELECT ftc, idlocacao, nome, rua, numero, complemento, bairro, cidade, estado, cep 
        FROM locacao l 
        inner join gestor g 
        on l.id_gestor = g.idgestor 
        inner join endereco e 
        on l.id_endereco = e.idendereco";
        //execução da instrução sql
        $consulta = $conectar->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          //Imprime o cabeçalho da tabela e o link para novo cadastro
          echo "<div class='col d-flex justify-content-center'>
            <div class='card'>
              <div class='card-body'>
                <h5 class='card-title'>Locação $linha[ftc]</h5>
                <p class='card-text'>
                  $linha[rua], $linha[numero], $linha[complemento]
                  <br>
                  $linha[bairro] - $linha[cidade] - $linha[estado]
                </p>
                <div class='card-btns'>
                  <a href='./ver-locacao.php?idlocacao=$linha[idlocacao]' class='btn btn-laranja'>Ver locação</a>
                  <a href='./form-editar-locacao.php?idlocacao=$linha[idlocacao]' class='btn btn-laranja'>Editar locação</a>
                </div>
              </div>
            </div>
          </div>";
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      ?>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>