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

  <header class="fixed text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none">Locações</a>
    <a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none">Locadores</a>
    <a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none">Gestores</a>
    <a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none">Alojados</a>
    <a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none">Despesas</a>
    <a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none">FSCs</a>
  </header>

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
                      <input id="numeroFsc" name="numeroFsc" class="form-control" type="text" placeholder="Digite o número da FSC" required>
                    </label>
  
                    <label id="validadeFsc">
                      Validade
                      <input id="validadeFsc" name="validadeFsc" class="form-control" type="date" placeholder="Digite a data final de validade" required>
                    </label>
<!-- 
                    <label id="anexoFsc">
                      Anexo de Contratos
                      <input type="file" class="form-control" name="anexoFsc" id="anexoFsc" multiple required>
                    </label>
-->
                    <label id="vincularLocacao">
                      Vincular a Locação
                      <select class="form-select" name="vincularLocacao" id="vincularLocacao" required>
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
  
                  


  <script src="./assets/js/bootstrap.bundle.min.js" defer></script>

  <!--Modal de Confirmação-->
  <div class="modal fade" id="msgCadastroRealizado" tabindex="-1" aria-labelledby="msgCadastroRealizadoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="msgCadastroRealizadoLabel">Cadastro Concluído!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            O cadastro foi realizado com sucesso.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <a href="visualizar-locacoes.php" class="btn btn-primary">Ver Locações</a>
          </div>
        </div>
      </div>
    </div>    
    
    
</body>
</html>

<?php else: header('Location: login.php');endif;?>