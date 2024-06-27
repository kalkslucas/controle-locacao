<?php 
$idalojado = filter_var($_GET['idalojado'], FILTER_SANITIZE_NUMBER_INT);
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Alojado <?= $idalojado?></title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/f8c979c0bf.js" crossorigin="anonymous"></script>
</head>
<?php
include_once "conexao.php";
$idalojado = filter_var($_GET['idalojado'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT nome as alojado, email, cargo, setor, unidade, telefone_1, telefone_2, id_locacao, id_gestor
from alojado a
where idalojado = :idalojado";
$consulta = $conectar->prepare($sql);
$consulta->bindParam(":idalojado", $idalojado, PDO::PARAM_INT);
$consulta->execute();
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
        <div class="col"><a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Despesas</a></div>
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FSCs</a></div>
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
                <h3 class="card-title text-center">Ficha do Alojado</h3>
                <form method="get">
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label id="nome">Nome</label>
                      <input id="nome" name="nome" class="form-control" value="<?= $linha['alojado']?>" type="text" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="cargo">Cargo</label>
                      <input id="cargo" name="cargo" class="form-control" value="<?= $linha['cargo']?>" type="text" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="setor">Setor</label>
                      <input id="setor" name="setor" class="form-control" value="<?= $linha['setor']?>" type="text" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="unidade">Unidade</label>
                      <input id="unidade" name="unidade" class="form-control" value="<?= $linha['unidade']?>" type="text" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label id="email">E-mail</label>
                      <input id="email" name="email" class="form-control" value="<?= $linha['email']?>" type="email" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="telefone1">Telefone 1</label>
                      <input id="telefone1" name="telefone1" class="form-control" value="<?= $linha['telefone_1']?>" type="text" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="telefone2">Telefone 2</label>
                      <input id="telefone2" name="telefone2" class="form-control" value="<?= $linha['telefone_2']?>" type="text" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <?php
                        $sqlLocacao = "SELECT idlocacao FROM locacao WHERE idlocacao = :id_locacao";
                        $consulta = $conectar->prepare($sqlLocacao);
                        $consulta->bindParam(":id_locacao", $linha['id_locacao']);
                        $consulta->execute();
                        $linhaLocacao = $consulta->fetch(PDO::FETCH_ASSOC);
                        $locacao = $linhaLocacao ? "$linhaLocacao[idlocacao]" : 'Sem locação vinculada';
                      ?>
                      <label id="telefone2">Vinculado a Locação</label>
                      <input id="telefone2" name="telefone2" class="form-control" value="<?= $locacao ?>" type="text" disabled readonly>
                    </div>
                    <div class="col-md-2">
                    <?php
                        $sqlGestor = "SELECT nome FROM gestor WHERE idgestor = :id_gestor";
                        $consulta = $conectar->prepare($sqlGestor);
                        $consulta->bindParam(":id_gestor", $linha['id_gestor']);
                        $consulta->execute();
                        $linhaGestor = $consulta->fetch(PDO::FETCH_ASSOC);
                        $gestor = $linhaGestor ? "$linhaGestor[nome]" : 'Sem gestor responsável';
                      ?>
                      <label id="telefone2">Gestor Responsável</label>
                      <input id="telefone2" name="telefone2" class="form-control" value="<?= $gestor ?>" type="text" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-12">
                      <h4>Anexos</h4>
                      <div class="border p-2">
                        <?php
                        echo "<table id='tabelaAnexos' class='table table-borderless table-responsive'>
                                <thead>
                                  <tr class='text-center'>
                                    <th>Visualização</th>
                                    <th>Arquivo</th>
                                    <th>Data de Envio</th>
                                    <th>Visualizar Anexo</th>
                                  </tr>
                                </thead>
                                <tbody>";
                          $sqlAnexo = "SELECT * FROM anexos WHERE id_alojado = :idalojado";
                          $consulta = $conectar->prepare($sqlAnexo);
                          $consulta->bindParam(":idalojado", $idalojado);
                          $consulta->execute();
                          if($consulta){
                            if($linhaAnexo = $consulta->rowCount()>0){
                              while($linhaAnexo = $consulta->fetch(PDO::FETCH_ASSOC)){
                                $dataUpload = date('d/m/Y H:i:s', strtotime($linhaAnexo['data_upload']));
                                  echo "
                                        <tr class='text-center'>
                                          <td class='preview'><img width='100vw' src='$linhaAnexo[path]'</td>
                                          <td>$linhaAnexo[nome_arquivo]</td>
                                          <td>$dataUpload</td>
                                          <td><a a target='_blank' class='btn btn-primary' href='$linhaAnexo[path]'><i class='fa-solid fa-eye'></i></a></td>
                                        </tr>";
                                }
                              } else {
                                echo "
                                      <tr class='text-center'>
                                        <td colspan='4' class='p-3'>Nenhum arquivo anexado!!</td>
                                      </tr>";
                              }
                            } else {
                              echo 'Erro ao executar a consulta de anexos!';
                            }
                            echo '</tbody>
                                </table>';
                          ?>
                      </div>
                    </div>
                  </div>
              
                  <div class="col text-center">
                    <a href="./visualizar-alojados.php" class="btn btn-danger">Voltar</a>
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
  <script src="./assets/js/imageOrDocument.js"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>