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
  <script src="https://kit.fontawesome.com/f8c979c0bf.js" crossorigin="anonymous"></script>
</head>
<?php
include_once "conexao.php";
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT lc.idlocacao, lc.ftc, g.nome as gestor, lc.situacao, inicio_locacao, termino_locacao, vistoria_entrada, vistoria_saida, observacoes, qtd_quartos, qtd_banheiros, qtd_vagas_garagem, lc.id_locador as locador, cc.nome as centro_custo, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep
  from locacao lc
  inner join endereco e
  on lc.id_endereco = e.idendereco
  inner join gestor g
  on lc.id_gestor = g.idgestor
  inner join locador l
  on lc.id_locador = l.idlocador
  inner join centro_custo cc
  on lc.id_centro_custo = cc.idcentrocusto
  where idlocacao = :idLocacao";
$consulta = $conectar->prepare($sql);
$consulta->bindParam(":idLocacao", $idLocacao, PDO::PARAM_INT);
$consulta->execute();
$linha = $consulta->fetch(PDO::FETCH_ASSOC);

function formatDate($date) {
  return $date ? DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y') : '';
}

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
                      <div class="border rounded" style="padding:6px 12px; background-color: #e8ecef;" aria-readonly="true">
                        <?php
                          $sqlFsc = "SELECT numero_fsc FROM fsc WHERE id_locacao = :id_locacao";
                          $consultaFsc = $conectar->prepare($sqlFsc);
                          $consultaFsc->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                          $consultaFsc->execute();
                          if($consultaFsc){
                            if($linhaFsc = $consultaFsc->rowCount()>0){
                              while($linhaFsc = $consultaFsc->fetch(PDO::FETCH_ASSOC)){
                                echo "<p class='mb-1'>$linhaFsc[numero_fsc]</p>";
                              }
                            } else {
                                echo "FSC não encontrada";
                            }
                          } else {
                            echo "Erro ao realizar a consulta de FSCs";
                          }
                        ?>
                      </div>
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
                      <input type="text" id="inicioLocacao" name="inicioLocacao" class="form-control" value="<?= formatDate($linha['inicio_locacao']) ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="fimLocacao">Término da Locação</label>
                      <input type="text" id="fimLocacao" name="fimLocacao" class="form-control" value="<?= formatDate($linha['termino_locacao']) ?>" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="centroCusto">Centro de Custo</label>
                      <input type="text" id="centroCusto" name="centroCusto" class="form-control" value="<?= $linha['centro_custo'] ?>" disabled readonly>
                      
                    </div>
                    <div class="col-md-4">
                      <label for="vistoriaEntrada">Vistoria de Entrada</label>
                      <input type="text" id="vistoriaEntrada" name="vistoriaEntrada" class="form-control" value="<?= formatDate($linha['vistoria_entrada']) ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="vistoriaSaida">Vistoria de Saída</label>
                      <input type="text" id="vistoriaSaida" name="vistoriaSaida" class="form-control" value="<?= formatDate($linha['vistoria_saida']) ?>" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-12">
                      <label for="observacoes">Observações</label>
                      <div id="observacoes" name="observacoes" class="border rounded" style="padding:6px 12px; background-color: #e8ecef;" aria-readonly="true">
                        <p><?= $linha['observacoes'] ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                      <label for="valorInternet">Valor da Internet</label>
                      <?php
                        $sqlValor = "SELECT * FROM despesas WHERE id_locacao = :id_locacao AND tipo_despesa = 'INTERNET'";
                        $consultaValor = $conectar->prepare($sqlValor);
                        $consultaValor->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaValor->execute();
                        $linhaValor = $consultaValor->fetch(PDO::FETCH_ASSOC);
                        $valorInternet = $linhaValor ? 'R$ ' . number_format($linhaValor['VALOR_MES'], 2, ',', '.') : 'Não encontrado';
                      ?>
                      <input type="text" name="valorInternet" id="valorInternet" class="form-control" value="<?= $valorInternet ?>" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label for="valorEnergia">Valor da Energia</label>
                      <?php
                        $sqlValor = "SELECT AVG(valor_mes) as valor_mes FROM despesas WHERE id_locacao = :id_locacao AND tipo_despesa = 'ENERGIA'";
                        $consultaValor = $conectar->prepare($sqlValor);
                        $consultaValor->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaValor->execute();
                        $linhaValor = $consultaValor->fetch(PDO::FETCH_ASSOC);
                        $valorEnergia = $linhaValor ? 'R$ ' . number_format($linhaValor['valor_mes'], 2, ',', '.') : 'Não encontrado';
                      ?>
                      <input type="text" name="valorEnergia" id="valorEnergia" class="form-control" value="<?= $valorEnergia ?>" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label for="valorAgua">Valor da Água</label>
                      <?php
                        $sqlValor = "SELECT AVG(valor_mes) as valor_mes FROM despesas WHERE id_locacao = :id_locacao AND tipo_despesa = 'ÁGUA'";
                        $consultaValor = $conectar->prepare($sqlValor);
                        $consultaValor->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaValor->execute();
                        $linhaValor = $consultaValor->fetch(PDO::FETCH_ASSOC);
                        $valorAgua = $linhaValor ? 'R$ ' . number_format($linhaValor['valor_mes'], 2, ',', '.') : 'Não encontrado';
                      ?>
                      <input type="text" name="valorAgua" id="valorAgua" class="form-control" value="<?= $valorAgua ?>" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label for="valorCondominio">Valor do Condomínio</label>
                      <?php
                        $sqlValor = "SELECT * FROM despesas WHERE id_locacao = :id_locacao AND tipo_despesa = 'CONDOMÍNIO'";
                        $consultaValor = $conectar->prepare($sqlValor);
                        $consultaValor->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaValor->execute();
                        $linhaValor = $consultaValor->fetch(PDO::FETCH_ASSOC);
                        $valorCondominio = $linhaValor ? 'R$ ' . number_format($linhaValor['VALOR_MES'], 2, ',', '.') : 'Não encontrado';
                      ?>
                      <input type="text" name="valorCondominio" id="valorCondominio" class="form-control" value="<?= $valorCondominio ?>" disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label for="valorIPTU">Valor do IPTU</label>
                      <?php
                        $sqlValor = "SELECT * FROM despesas WHERE id_locacao = :id_locacao AND tipo_despesa = 'IPTU'";
                        $consultaValor = $conectar->prepare($sqlValor);
                        $consultaValor->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                        $consultaValor->execute();
                        $linhaValor = $consultaValor->fetch(PDO::FETCH_ASSOC);
                        $valorIPTU = $linhaValor ? 'R$ ' . number_format($linhaValor['VALOR_MES'], 2, ',', '.') : 'Não encontrado';
                      ?>
                      <input type="text" name="valorIPTU" id="valorIPTU" class="form-control" value="<?= $valorIPTU ?>" disabled readonly>
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
                      <a href="ver-locador.php?idlocador=<?=$linha['locador'] ?>" class="form-control btn btn-laranja">Ver locador</a>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="qtd_quartos" class="d-inline">Quantidade de Quartos</label>
                      <input type="number" name="qtd_quartos" id="qtd_quartos" value="<?= $linha['qtd_quartos'] ?>" class="form-control" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="qtd_banheiros" class="d-inline">Quantidade de Banheiros</label>
                      <input type="number" name="qtd_banheiros" id="qtd_banheiros" value="<?= $linha['qtd_banheiros'] ?>" class="form-control" disabled readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="qtd_vagas_garagem" class="d-inline">Vagas de Garagem</label>
                      <input type="number" name="qtd_vagas_garagem" id="qtd_vagas_garagem" value="<?= $linha['qtd_vagas_garagem'] ?>" class="form-control" disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-12">
                      <label for="listaAditivo"><h4>Aditivos</h4></label>
                      <div class="px-4 pt-2 border rounded">
                        <?php
                          echo"<table class='table table-borderless table-responsive'>
                                <thead>
                                  <tr class='text-center'>
                                    <th>Data de Criação</th>
                                    <th>Descrição</th>
                                    <th>Duração Ampliada</th>
                                    <th>Data Inicial</th>
                                    <th>Data Final</th>
                                  </tr>
                                </thead>";
                          $sqlAditivo = "SELECT descricao, aluguel, data_inicio, data_fim, data_criacao FROM aditivo WHERE id_locacao = :idlocacao";
                          $consultaAditivo = $conectar->prepare($sqlAditivo);
                          $consultaAditivo->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
                          $consultaAditivo->execute();

                          if($consultaAditivo){
                            if($linhaAditivo = $consultaAditivo->rowCount() > 0){
                              while($linhaAditivo = $consultaAditivo->fetch(PDO::FETCH_ASSOC)){
                                if($linhaAditivo['aluguel'] === 1){
                                  $aluguel = "SIM";
                                } else {
                                  $aluguel = "NÃO";
                                }
                                $data_inicio = formatDate($linhaAditivo['data_inicio']);
                                $data_fim = formatDate($linhaAditivo['data_fim']);
                                echo "<tbody>
                                        <tr class='text-center'>
                                          <td>$linhaAditivo[data_criacao]</td>
                                          <td>$linhaAditivo[descricao]</td>
                                          <td>$aluguel</td>
                                          <td>$data_inicio</td>
                                          <td>$data_fim</td>
                                        </tr>";
                              }
                            } else {
                              echo "<tr class='text-center'>
                                      <td colspan='5'>Sem aditivos para esse imóvel</td>
                                    </tr>";
                            }
                          } else {
                            echo 'Erro ao executar a consulta de aditivos!';
                          }
                          echo "</tbody>
                              </table>";
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-12">
                      <label for="listaAlojados"><h4>Alojados da locação</h4></label>
                      <div class="px-4 pt-2 border rounded">
                        <?php
                          echo"<table class='table table-borderless table-responsive'>
                                      <thead>
                                        <tr class='text-center disabledBgColor'>
                                          <th>Nome</th>
                                          <th>Cargo</th>
                                          <th>Telefone</th>
                                        </tr>
                                      </thead>";
                          $sqlAlojados = "SELECT nome, cargo, telefone_1 FROM alojado WHERE id_locacao = :id_locacao";
                          $consulta = $conectar->prepare($sqlAlojados);
                          $consulta->bindParam(":id_locacao", $idLocacao, PDO::PARAM_INT);
                          $consulta->execute();

                          if($consulta){
                            if($linhaAlojados = $consulta->rowCount()>0){
                              while($linhaAlojados = $consulta->fetch(PDO::FETCH_ASSOC)){
                                echo "<tbody>
                                        <tr class='text-center'>
                                          <td>$linhaAlojados[nome]</td>
                                          <td>$linhaAlojados[cargo]</td>
                                          <td>$linhaAlojados[telefone_1]</td>
                                        </tr>";
                              }
                            } else {
                              echo "<tr class='text-center'>
                                      <td colspan='3'>Sem alojados para esse imóvel</td>
                                    </tr>";
                            }
                          } else {
                            echo 'Erro ao executar a consulta de alojados!';
                          }
                          echo "</tbody>
                              </table>";
                        ?>
                      </div>
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
                          $sqlAnexo = "SELECT * FROM anexos WHERE id_locacao = '$idLocacao'";
                          $consulta = $conectar->query($sqlAnexo);
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
                    <a href="visualizar-locacoes.php" class="btn btn-danger btn-custom">Voltar</a>
                    <a class='btn btn-laranja' href='./visualizar-despesas-locacao.php?idlocacao=<?=$linha["idlocacao"]?>'>Ver Despesas</a>
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
