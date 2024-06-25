<?php 
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario'])): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Locação <?=$idLocacao ?></title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    label {
      width: 100%;
    }
  </style>

</head>
<?php
include_once "conexao.php";
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT lc.idlocacao, lc.ftc, lc.centro_custo, g.nome as gestor, lc.situacao, DATE_FORMAT(inicio_locacao, '%d/%m/%Y') as inicio_locacao, DATE_FORMAT(termino_locacao,'%d/%m/%Y') as termino_locacao, DATE_FORMAT(vistoria_entrada, '%d/%m/%Y') as vistoria_entrada, DATE_FORMAT(vistoria_saida, '%d/%m/%Y') as vistoria_saida, observacoes, lc.id_locador as locador, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep
  from locacao lc
  inner join endereco e
  on lc.id_endereco = e.idendereco
  inner join gestor g
  on lc.id_gestor = g.idgestor
  inner join locador l
  on lc.id_locador = l.idlocador
  where idlocacao = :idLocacao";
$consulta = $conectar->prepare($sql);
$consulta->bindParam(":idLocacao", $idLocacao, PDO::PARAM_INT);
$consulta->execute();
$linha = $consulta->fetch(PDO::FETCH_ASSOC);

if($linha === false){
  echo "<p>Locação não encontrada</p>";
}
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
                <h3 class="card-title text-center">Ficha da Locação</h3>
                <form method="get">
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="ftc">FTC</label>
                      <input type="text" id="ftc" name="ftc" class="form-control" value="<?= $linha['ftc'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="fsc">FSC</label>
                      <?php
                        $sqlFsc = "SELECT numero_fsc FROM fsc WHERE id_locacao = :id_locacao";
                        $consultaFsc = $conectar->prepare($sqlFsc);
                        $consultaFsc->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaFsc->execute();
                        $linhaFsc = $consultaFsc->fetch(PDO::FETCH_ASSOC);
                        $fscValue = $linhaFsc ? $linhaFsc['numero_fsc'] . '' : 'FSC não encontrada';
                      ?>
                      <input type="text" id="fsc" name="fsc" class="form-control" value="<?= $fscValue ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="gestor">Gestor</label>
                      <input type="text" id="gestor" name="gestor" class="form-control" value="<?= $linha['gestor'] ?>" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="situacao">Status</label>
                      <input type="text" id="situacao" name="situacao" class="form-control" value="<?= $linha['situacao'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="inicioLocacao">Início da Locação</label>
                      <input type="text" id="inicioLocacao" name="inicioLocacao" class="form-control" value="<?= $linha['inicio_locacao'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="fimLocacao">Término da Locação</label>
                      <input type="text" id="fimLocacao" name="fimLocacao" class="form-control" value="<?= $linha['termino_locacao'] ?>" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="centroCusto">Centro de Custo</label>
                      <input type="text" id="centroCusto" name="centroCusto" class="form-control" value="<?= $linha['centro_custo'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="vistoriaEntrada">Vistoria de Entrada</label>
                      <input type="text" id="vistoriaEntrada" name="vistoriaEntrada" class="form-control" value="<?= $linha['vistoria_entrada'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="vistoriaSaida">Vistoria de Saída</label>
                      <input type="text" id="vistoriaSaida" name="vistoriaSaida" class="form-control" value="<?= $linha['vistoria_saida'] ?>" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="valorAluguel">Valor do Aluguel</label>
                      <?php
                        $sqlValor = "SELECT * FROM despesas WHERE id_locacao = :id_locacao AND tipo_despesa = 'ALUGUEL'";
                        $consultaValor = $conectar->prepare($sqlValor);
                        $consultaValor->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaValor->execute();
                        $linhaValor = $consultaValor->fetch(PDO::FETCH_ASSOC);
                        $valorAluguel = $linhaValor ? 'R$ ' . number_format($linhaValor['VALOR_MES'], 2, ',', '.') : 'Não encontrado';
                      ?>
                      <input type="text" id="valorAluguel" name="valorAluguel" class="form-control" value="<?= $valorAluguel ?>" disabled readonly>
                    </div>
                    <div class="col-md-8">
                      <label for="observacoes">Observações</label>
                      <textarea id="observacoes" name="observacoes" class="form-control" value="<?= $linha['observacoes'] ?>" disabled readonly rows="5">
                        <?= $linha['observacoes'] ?>
                      </textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-8">
                      <label for="endereco">Endereço</label>
                      <input type="text" id="endereco" name="endereco" class="form-control" value="<?= $linha['rua'] . ", " . $linha['numero'] . " - " . $linha['complemento'] . " - " . $linha['bairro'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="cidade">Cidade</label>
                      <input type="text" id="cidade" name="cidade" class="form-control" value="<?= $linha['cidade'] ?>" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="estado">Estado</label>
                      <input type="text" id="estado" name="estado" class="form-control" value="<?= $linha['estado'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="cep">CEP</label>
                      <input type="text" id="cep" name="cep" class="form-control" value="<?= $linha['cep'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="locador">Locador</label>
                      <?php
                        $sqlLocador = "SELECT nome FROM locador WHERE idlocador = :idlocador";
                        $consultaLocador = $conectar->prepare($sqlLocador);
                        $consultaLocador->bindParam(":idlocador", $linha['locador'], PDO::PARAM_INT);
                        $consultaLocador->execute();
                        $linhaLocador = $consultaLocador->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <input type="text" id="locador" name="locador" class="form-control" value="<?= $linhaLocador['nome'] ?>" disabled readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-12">
                      <h4>Anexos</h4>
                      <div class="border p-2">
                        <?php
                        echo "<table id='tabelaAnexos' class='table table-borderless'>
                                        <thead>
                                          <tr class='text-center'>
                                            <th>Visualização</th>
                                            <th>Arquivo</th>
                                            <th>Data de Envio</th>
                                          </tr>
                                        </thead>
                                        <tbody>";


                          $sqlAnexo = "SELECT * FROM anexos WHERE id_locacao = '$idLocacao'";
                          $consulta = $conectar->query($sqlAnexo);
                          if($consulta){
                            while($linhaAnexo = $consulta->fetch(PDO::FETCH_ASSOC)){
                              $dataUpload = date('d/m/Y H:i:s', strtotime($linhaAnexo['data_upload']));
                                echo "<tr class='text-center'>
                                        <td class='preview'><img width='100vw' src='$linhaAnexo[path]'</td>
                                        <td><a target='_blank' href='$linhaAnexo[path]'>$linhaAnexo[nome_arquivo]</a></td>
                                        <td>$dataUpload</td>
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
                    <a class='btn btn-laranja' href='./visualizar-despesas-locacao.php?idlocacao=<?=$linha["idlocacao"]?>'>Ver Despesas</a>
                    <a href="visualizar-locacoes.php" class="btn btn-danger btn-custom">Voltar</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HVXTZ/xOgyc6bD/gfu+VjdlH6nx9nB2mJGnsK8z6oP7kzF23V6UgKov5ChY1N+JO" crossorigin="anonymous"></script>
  <script src="./assets/js/imageOrDocument.js"></script>
</body>

</html>
<?php else: header("Location:login.php"); endif; ?>
