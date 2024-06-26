<?php 
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Editar Locação <?=$idLocacao ?></title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/f8c979c0bf.js" crossorigin="anonymous"></script>
</head>
<?php
include_once "conexao.php";
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT lc.idlocacao, lc.ftc, g.nome as gestor, l.nome as locador, lc.situacao, inicio_locacao, termino_locacao, vistoria_entrada,vistoria_saida, observacoes, cc.nome as centro_custo, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep, lc.id_gestor, lc.id_locador, lc.id_centro_custo
  from locacao lc
  inner join endereco e
  on lc.id_endereco = e.idendereco
  inner join gestor g
  on lc.id_gestor = g.idgestor
  inner join locador l
  on lc.id_locador = l.idlocador
  inner join centro_custo cc
  on lc.id_centro_custo = cc.idcentrocusto
  where idlocacao = :idlocacao";
$consulta = $conectar->prepare($sql);
$consulta->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
$consulta->execute();
$linha = $consulta->fetch(PDO::FETCH_ASSOC);

function formatDate($date) {
  return $date ? DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d') : '';
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
    <a href="deletarLocacao.php?idlocacao=<?=$idLocacao?>" class='btn btn-danger text-end'><span>Deletar Locação<i class='fa-solid fa-xmark px-2'></i></span></a>
    <div class="row justify-content-center">
      <div class="col">
        <div class="card mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body m-4 rounded shadow-lg">
                <h3 class="card-title text-center">Ficha da Locação</h3>
                <form action="editarLocacao.php?idlocacao=<?= $idLocacao?>" enctype="multipart/form-data" method="post">
                <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="ftc">FTC</label>
                      <input type="text" id="ftc" name="ftc" class="form-control" value="<?= $linha['ftc'] ?>">
                    </div>
                    <div class="col-md-4">
                      <label for="gestor">Gestor</label>
                      <select class="form-select" name="gestor" id="gestor" required>
                        <option value="<?= $linha['id_gestor']?>"><?= $linha['gestor']?></option>
                        <?php
                        include_once 'conexao.php';
                        try {
                          $query = "SELECT idgestor, nome FROM gestor";
                          $consulta = $conectar->query($query);

                          while($linhaGestor = $consulta->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='$linhaGestor[idgestor]'>$linhaGestor[nome]</option>";
                          }
                        } catch (PDOException $e) {
                          echo 'Error: ' . $e->getMessage();
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="locador">Locador</label>
                      <select class="form-select" name="locador" id="locador" required>
                        <option value="<?=$linha['id_locador'] ?>"><?= $linha['locador']?></option>
                        <?php
                        include_once 'conexao.php';
                        try {
                          $query = "SELECT idlocador, nome FROM locador";
                          $consulta = $conectar->query($query);

                          while($linhaLocador = $consulta->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='$linhaLocador[idlocador]'>$linhaLocador[nome]</option>";
                          }
                        } catch (PDOException $e) {
                          echo 'Error: ' . $e->getMessage();
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <?php
                  $sqlStatusAtual = "SELECT situacao FROM locacao WHERE idlocacao = $idLocacao";
                  $consultaStatusAtual = $conectar->query($sqlStatusAtual);

                  if($consultaStatusAtual->rowCount() > 0){
                    $linhaStatusAtual = $consultaStatusAtual->fetch(PDO::FETCH_ASSOC);
                    $statusAtual = $linhaStatusAtual["situacao"];
                  }
                  $sqlStatus = "SHOW COLUMNS FROM locacao LIKE 'situacao'";
                  $consultaStatus = $conectar->query($sqlStatus);

                  if( $consultaStatus->rowCount() > 0){
                    $linhaStatus = $consultaStatus->fetch(PDO::FETCH_ASSOC);
                    $enumValues = $linhaStatus['Type'];

                    // Limpar a string para obter os valores ENUM
                    $enumValues = str_replace("enum('", "", $enumValues);
                    $enumValues = str_replace("')", "", $enumValues);
                    $enumValues = explode("','", $enumValues);
                  } else {
                    echo "Nenhum resultado encontrado";
                  }
                  ?>
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="situacao">Status</label>
                      <?php
                      // Gerar o HTML para o elemento <select>
                        echo '<select class="form-select" name="situacao" id="situacao" required>';
                        echo "<option value='$statusAtual'>$statusAtual</option>";
                        foreach ($enumValues as $value) {
                          if($value != $statusAtual){
                            echo '<option value="' . $value . '">' . $value . '</option>';
                          }
                        }
                        echo '</select>';
                      ?>
                    </div>
                    <div class="col-md-4">
                      <label for="inicioLocacao">Início da Locação</label>
                      <input type="date" id="inicioLocacao" name="inicioLocacao" class="form-control" value="<?= formatDate($linha['inicio_locacao']) ?>" >
                    </div>
                    <div class="col-md-4">
                      <label for="fimLocacao">Término da Locação</label>
                      <input type="date" id="fimLocacao" name="fimLocacao" class="form-control" value="<?= formatDate($linha['termino_locacao']) ?>" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="centroCusto">Centro de Custo</label>
                      <select id="centroCusto" name="centroCusto" class="form-select" required>
                        <option value="<?= $linha['id_centro_custo'] ?>"><?= $linha['centro_custo']?></option>
                        <?php
                          $queryCC = "SELECT idcentrocusto, nome FROM centro_custo";
                          $consultaCC = $conectar->query($queryCC);

                          while($linhaCC = $consultaCC->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='$linhaCC[idcentrocusto]'>$linhaCC[nome]</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="vistoriaEntrada">Vistoria de Entrada</label>
                      <input type="date" id="vistoriaEntrada" name="vistoriaEntrada" class="form-control" value="<?= formatDate($linha['vistoria_entrada']) ?>" >
                    </div>
                    <div class="col-md-4">
                      <label for="vistoriaSaida">Vistoria de Saída</label>
                      <input type="date" id="vistoriaSaida" name="vistoriaSaida" class="form-control" value="<?= formatDate($linha['vistoria_saida']) ?>" >
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
                      <input type="text" id="valorAluguel" name="" class="form-control" value="<?= $valorAluguel ?>" disabled readonly>
                    </div>
                    <div class="col-md-8">
                      <label for="observacoes">Observações</label>
                      <textarea id="observacoes" name="observacoes" class="form-control" value="<?= $linha['observacoes'] ?>"  rows="5">
                        <?= $linha['observacoes'] ?>
                      </textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label for="rua">Rua</label>
                      <input type="text" id="rua" name="rua" class="form-control" value="<?= $linha['rua']?>" >
                    </div>
                    <div class="col-md-3">
                      <label for="numero">Número</label>
                      <input type="text" id="numero" name="numero" class="form-control" value="<?= $linha['numero']?>" >
                    </div>
                    <div class="col-md-3">
                      <label for="complemento">Complemento</label>
                      <input type="text" id="complemento" name="complemento" class="form-control" value="<?= $linha['complemento']?>" >
                    </div>
                    <div class="col-md-3">
                      <label for="bairro">Bairro</label>
                      <input type="text" id="bairro" name="bairro" class="form-control" value="<?=$linha['bairro'] ?>" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="cidade">Cidade</label>
                      <input type="text" id="cidade" name="cidade" class="form-control" value="<?= $linha['cidade'] ?>" >
                    </div>
                    <div class="col-md-4">
                      <label for="estado">Estado</label>
                      <input type="text" id="estado" name="estado" class="form-control" value="<?= $linha['estado'] ?>" >
                    </div>
                    <div class="col-md-4">
                      <label for="cep">CEP</label>
                      <input type="text" id="cep" name="cep" class="form-control" value="<?= $linha['cep'] ?>" >
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
                                            <th>Visualizar Anexo</th>
                                            <th>Deletar Anexo</th>
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
                                        <td>$linhaAnexo[nome_arquivo]</td>
                                        <td>$dataUpload</td>
                                        <td><a a target='_blank' class='btn btn-primary' href='$linhaAnexo[path]'><i class='fa-solid fa-eye'></i></a></td>
                                        <td><a href='deletarArquivos.php?idanexo=$linhaAnexo[idanexo]&idlocacao=$linha[idlocacao]' class='btn btn-danger'><i class='fa-solid fa-xmark'></i></a></td>
                                      </tr>";
                              }
                            } else {
                              echo 'Erro ao executar a consulta de anexos!';
                            }
                            echo '</tbody>
                                </table>';
                          ?>
                      </div>
                      <input 
                        id="anexo_foto_docs" 
                        name="anexo_foto_docs[]" 
                        class="form-control mt-2" 
                        type="file" 
                        multiple
                      />
                    </div>
                  </div>
                  <div class="col text-center">
                    <a href="visualizar-locacoes.php" class="btn btn-danger btn-custom">Voltar</a>
                    <input type="submit" class='btn btn-success' value="Editar"></input>
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