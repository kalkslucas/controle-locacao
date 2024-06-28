<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Gerar FSC</title>

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

  <main class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow-lg mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="card-title text-center display-4">Cadastro de FSC</h3>
                <form action="gerarFsc.php" enctype="multipart/form-data" method="post">
                  <div class="mt-1">
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label id="numeroFsc" class="d-inline">Número FSC</label>
                        <input id="numeroFsc" name="numeroFsc" class="form-control" type="text" placeholder="Digite o número da FSC" required>
                      </div>
                      <div class="col-md-4">
                        <label id="validadeFsc" class="d-inline">Validade</label>
                        <input id="validadeFsc" name="validadeFsc" class="form-control" type="date" placeholder="Digite a data final de validade" required>
                      </div>
                      <div class="col-md-4">
                        <label id="anexoFsc" class="d-inline">Anexo de Contratos</label>
                        <input type="file" class="form-control" name="anexoFsc[]" id="anexoFsc" multiple required>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="form-floating">
                          <textarea class="form-control" name="descricao" id="descricao" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                          <label for="floatingTextarea" class="ps-3">Descrição</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-md-12">    
                        <label id="vincularLocacao">Vincular a Locação</label>
                          <select class="form-select" name="vincularLocacao" id="vincularLocacao" required>
                            <option value="">---</option>
                            <?php
                              include_once 'conexao.php';
                              try {
                                $query = "SELECT idlocacao, rua, numero, bairro, cidade, estado, cep, nome FROM locacao l INNER JOIN endereco e ON l.id_endereco = e.idendereco INNER JOIN gestor g ON l.id_gestor = g.idgestor order by idlocacao asc";

                                $consulta = $conectar->query($query);
                                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                                  echo "<option value='$linha[idlocacao]'>$linha[idlocacao] | $linha[rua], $linha[numero], $linha[bairro], $linha[cidade] - $linha[estado] | $linha[nome]";
                                }
                              } catch (PDOException $e) {
                                echo 'Error: ' . $e->getMessage();
                                // Log the error
                                error_log('Error: ' . $e->getMessage(), 0);
                              }
                            ?>
                        </select>
                      </div>
                    </div>
                  </div>
                    
                    
                    <div class="col text-center">
                      <a href="./visualizar-fsc.php" class="text-center btn btn-danger">Voltar</a>
                      <input class="btn btn-laranja" type="submit" value="Cadastrar FSC">
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