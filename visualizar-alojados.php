<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Alojados</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/visualizar-locadores.css">
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
    <a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none">Locações</a>
    <a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none">Locadores</a>
    <a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none">Gestores</a>
    <a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none">Alojados</a>
    <a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none">Despesas</a>
    <a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none">FSCs</a>
  </header>

  <div class="hstack gap-1 px-2 mb-3">
    <a href='./form-cadastrar-pessoa.php' class='btn btn-warning'>Cadastrar Alojado</a>
    <a href='./controle-locacao.php' class='btn btn-danger'>Voltar a página inicial</a>
    <form action="" class="d-flex ms-auto">
      <input type="text" name="filtrar" id="filtrar" placeholder="Pesquisar" class="form-control me-2" aria-label="Pesquisar" value="<?php if(isset($_GET['filtrar'])) echo $_GET['filtrar']?>">
      <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  </div>

  <main class="container-fluid">
    <div class="row p-3 justify-content-center">
      <div class="col-12">
        <?php
        echo "
                <div class='table-responsive'>
                  <table class='table table-borderless'>
                    <thead>
                      <tr class='text-center'>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                      </tr>
                    </thead>
                    <tbody>";
        ?>

        <?php
          include_once "conexao.php";
          try {
            if(!isset($_GET['filtrar'])){
              //query sql de consulta
              $sql = 'SELECT idalojado, nome, email, telefone_1 FROM alojado';
              //execução da instrução sql
              $consulta = $conectar->query($sql);
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo "  <tr class='text-center'>
                          <td>$linha[nome]</td>
                          <td>$linha[email]</td>
                          <td>$linha[telefone_1]</td>
                          <td><a href='./ver-alojado.php?idalojado=$linha[idalojado]' class='btn btn-laranja'>Ver dados</a></td>
                          <td><a href='./form-editar-alojado.php?idalojado=$linha[idalojado]' class='btn btn-laranja'>Editar dados</a></td>
                        </tr>
                ";
              }
            } else {
              $filtrar = filter_var($_GET['filtrar']);
              $sql = "SELECT idalojado, nome, email, telefone_1 
              FROM alojado
              WHERE nome like CONCAT('%',:filtrar,'%')
              ";
              $consulta = $conectar->prepare($sql);
              $consulta->bindParam(":filtrar", $filtrar, PDO::PARAM_STR);
              $consulta->execute();
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo "  <tr class='text-center'>
                          <td>$linha[nome]</td>
                          <td>$linha[email]</td>
                          <td>$linha[telefone_1]</td>
                          <td><a href='./ver-alojado.php?idalojado=$linha[idalojado]' class='btn btn-laranja'>Ver dados</a></td>
                          <td><a href='./form-editar-alojado.php?idalojado=$linha[idalojado]' class='btn btn-laranja'>Editar dados</a></td>
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
                  </table>
                </div>";
        ?>
      </div> 
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>