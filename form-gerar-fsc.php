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
  <link rel="stylesheet" href="./assets/css/gerar-fsc.css">
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
      <div class="user d-flex text-center">
        <label class="infoUser border d-flex flex-column align-items-center">
          <p class=""> <?= $nomeUser; ?></p>
          <p class=""> <?= $perfilUser; ?></p>
        </label>
        <a class="btn btn-outline-danger" href="logout.php">Sair</a>
      </div>
    </div>
  </nav>

  <main class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow-lg mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="card-title text-center display-4">Cadastro de FSC</h3>
                <form action="gerarFsc.php" method="post">
                  <div class="mt-1">  
                    <label id="numeroFsc">
                      Número FSC
                      <input id="numeroFsc" name="numeroFsc" class="form-control" type="text" placeholder="Digite o número da FSC">
                    </label>
  
                    <label id="validadeFsc">
                      Validade
                      <input id="validadeFsc" name="validadeFsc" class="form-control" type="date" placeholder="Digite a data final de validade">
                    </label>
<!-- 
                    <label id="anexoFsc">
                      Anexo de Contratos
                      <input type="file" class="form-control" name="anexoFsc" id="anexoFsc" multiple>
                    </label>
-->
                    <label id="vincularLocacao">
                      Vincular a Locação
                      <select class="form-select" name="vincularLocacao" id="vincularLocacao">
                        <option value="">---</option>
                        <?php
                          include_once 'conexao.php';
                          try {
                            $query = "SELECT idlocacao, ftc, rua, numero, bairro, cidade, estado, cep, nome FROM locacao l INNER JOIN endereco e ON l.id_endereco = e.idendereco INNER JOIN gestor g ON l.id_gestor = g.idgestor";

                            $consulta = $conectar->query($query);
                            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                              echo "<option value='$linha[idlocacao]'>$linha[ftc] | $linha[rua], $linha[numero], $linha[bairro], $linha[cidade] - $linha[estado] | $linha[nome]";
                            }
                          } catch (PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                            // Log the error
                            error_log('Error: ' . $e->getMessage(), 0);
                          }
                        ?>
                      </select>
                    </label>
                  </div>
                  

                  <label class="d-flex mt-3" id="enviarLocacao">
                    <input class="btn btn-laranja" type="submit" value="Cadastrar FSC">
                  </label>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-end">
      <div class="col-lg-1 col-md-2 col-sm-12 mb-4">
        <a href="./visualizar-fsc.php" class="text-center btn btn-danger w-100">Voltar</a>
      </div>
    </div>
    
  </main>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <script src="assets/js/validarMoeda.js" defer></script>
</body>
</html>

<?php else: header('Location: login.php');endif;?>