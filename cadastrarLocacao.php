<?php
function gerarAluguel($inicioLocacao, $fimLocacao, $locador, $valorAluguel, $idLocacao){
  include 'conexao.php';
  $start_date = $inicioLocacao;
  $end_date = $fimLocacao;

  $interval = new DateInterval('P1M');

  $dateStart = new DateTime($start_date);
  $dateEnd = new DateTime($end_date);

  $difference = $dateStart->diff($dateEnd);
  
  $num_payments = ($difference->y * 12) + $difference->m;

  for($i = 1; $i <= $num_payments; $i++){
    $payment_date = $dateStart->format('Y-m-d');

    $inserirAluguel = $conectar->prepare("INSERT INTO despesas (tipo_despesa, empresa, titular, valor_mes, vencimento, parcela, id_locacao) VALUES ('ALUGUEL', :empresa, :titular, :valor_mes, :vencimento, :parcela, :id_locacao)");
    $inserirAluguel->bindParam(":empresa",$locador,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":titular",$locador,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":valor_mes",$valorAluguel,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":vencimento",$payment_date,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":parcela",$i,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":id_locacao",$idLocacao,PDO::PARAM_INT);
    $inserirAluguel->execute();

    $dateStart->add($interval);
  }
}
include 'enviarArquivos.php';
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();
  //locacao's variables
  $ftc = filter_var($_POST['ftc']);
  $gestor = filter_var($_POST['gestor']);
  $locador = filter_var($_POST['locador'], FILTER_SANITIZE_NUMBER_INT);
  $situacao = filter_var($_POST['situacao']);
  $centroCusto = filter_var($_POST['centroCusto']);
  $cep = filter_var($_POST['cep']);
  $rua = filter_var($_POST['rua']);
  $numero = filter_var($_POST['numero']);
  $complemento = filter_var($_POST['complemento']);
  $bairro = filter_var($_POST['bairro']);
  $cidade = filter_var($_POST['cidade']);
  $estado = filter_var($_POST['uf']);
  $inicioLocacao = !empty(filter_input(INPUT_POST, 'inicioLocacao')) ? filter_input(INPUT_POST, 'inicioLocacao') : NULL;
  $fimLocacao = !empty(filter_input(INPUT_POST, 'fimLocacao')) ? filter_input(INPUT_POST, 'fimLocacao') : NULL;
  $vistoriaEntrada = !empty(filter_input(INPUT_POST, 'vistoriaEntrada')) ? filter_input(INPUT_POST, 'vistoriaEntrada') : NULL;
  $vistoriaSaida = !empty(filter_input(INPUT_POST, 'vistoriaSaida')) ? filter_input(INPUT_POST, 'vistoriaSaida') : NULL;
  $valorAluguel = filter_var($_POST['valorAluguel']);
  $observacoes = filter_var($_POST['observacoes']);
  $qtdQuartos = filter_var($_POST['qtd_quartos']);
  $qtdBanheiros = filter_var($_POST['qtd_banheiros']);
  $qtdVagasGaragem = filter_var($_POST['qtd_vagas_garagem']);

  $valorAluguel = str_replace(',','.', $valorAluguel);

  $queryEndereco = "INSERT INTO endereco (tipo_endereco, rua, numero, complemento, bairro, cidade, estado, cep) VALUES ('LOCACAO', :rua, :numero, :complemento, :bairro, :cidade, :estado, :cep)";
  $insertEndereco = $conectar->prepare($queryEndereco);
  $insertEndereco->bindParam(':rua', $rua, PDO::PARAM_STR);
  $insertEndereco->bindParam(':numero', $numero, PDO::PARAM_STR);
  $insertEndereco->bindParam(':complemento', $complemento, PDO::PARAM_STR);
  $insertEndereco->bindParam(':bairro', $bairro, PDO::PARAM_STR);
  $insertEndereco->bindParam(':cidade', $cidade, PDO::PARAM_STR);
  $insertEndereco->bindParam(':estado', $estado, PDO::PARAM_STR);
  $insertEndereco->bindParam(':cep', $cep, PDO::PARAM_STR);
  $insertEndereco->execute();

  $idEndereco = $conectar->lastInsertId(); // Get the last inserted ID
  $conectar->commit();

  $conectar->beginTransaction();

  $queryLocacao = "INSERT INTO locacao (ftc, situacao, id_centro_custo, inicio_locacao, termino_locacao, vistoria_entrada, vistoria_saida, observacoes, qtd_quartos, qtd_banheiros, qtd_vagas_garagem, id_gestor, id_locador, id_endereco) VALUES (:ftc, :situacao, :centroCusto, :inicio_locacao, :termino_locacao, :vistoriaEntrada, :vistoriaSaida, :observacoes, :qtd_quartos, :qtd_banheiros, :qtd_vagas_garagem, :gestor, :locador, :idEndereco)";
  $insertLocacao = $conectar->prepare($queryLocacao);
  $insertLocacao->bindParam(':ftc', $ftc, PDO::PARAM_STR);
  $insertLocacao->bindParam(':situacao', $situacao, PDO::PARAM_STR);
  $insertLocacao->bindParam(':centroCusto', $centroCusto, PDO::PARAM_INT);
  $insertLocacao->bindParam(':inicio_locacao', $inicioLocacao, PDO::PARAM_STR);
  $insertLocacao->bindParam(':termino_locacao', $fimLocacao, PDO::PARAM_STR);
  $insertLocacao->bindParam(':vistoriaEntrada', $vistoriaEntrada, PDO::PARAM_STR);
  $insertLocacao->bindParam(':vistoriaSaida', $vistoriaSaida, PDO::PARAM_STR);
  $insertLocacao->bindParam(':observacoes', $observacoes, PDO::PARAM_STR);
  $insertLocacao->bindParam(':qtd_quartos', $qtdQuartos, PDO::PARAM_INT);
  $insertLocacao->bindParam(':qtd_banheiros', $qtdBanheiros, PDO::PARAM_INT);
  $insertLocacao->bindParam(':qtd_vagas_garagem', $qtdVagasGaragem, PDO::PARAM_INT);
  $insertLocacao->bindParam(':gestor', $gestor, PDO::PARAM_INT);
  $insertLocacao->bindParam(':locador', $locador, PDO::PARAM_INT);
  $insertLocacao->bindParam(':idEndereco', $idEndereco, PDO::PARAM_INT);
  $insertLocacao->execute();

  $idLocacao = $conectar->lastInsertId();
  $conectar->commit();

  if (isset($_FILES['anexo_foto_docs']) && $_FILES['anexo_foto_docs']['error'][0] != UPLOAD_ERR_NO_FILE) {
    $arquivos = $_FILES['anexo_foto_docs'];
    $tudo_certo = true;
    foreach ($arquivos['name'] as $index => $arq) {
      $deu_certo = enviarArquivos($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index], $idLocacao, NULL, NULL);
      if (!$deu_certo) {
        $tudo_certo = false;
      }
    }
    if ($tudo_certo) {
      echo '<p>Todos os arquivos foram enviados com sucesso!</p>';
    } else {
      echo '<p>Falha ao enviar um ou mais arquivos</p>';
    }
  }

  $queryNomeLocador = "SELECT nome FROM locador WHERE idlocador = :idlocador";
  $consultaNomeLocador = $conectar->prepare($queryNomeLocador);
  $consultaNomeLocador->bindParam(":idlocador",$locador, PDO::PARAM_INT);
  $consultaNomeLocador->execute();
  $linhaNomeLocador = $consultaNomeLocador->fetch(PDO::FETCH_ASSOC);
  $nomeLocador = $linhaNomeLocador["nome"];


  if(isset($_POST['valorAluguel'])) {
    gerarAluguel($inicioLocacao, $fimLocacao, $nomeLocador, $valorAluguel, $idLocacao);
  }
  
  header('Location: visualizar-locacoes.php');

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
