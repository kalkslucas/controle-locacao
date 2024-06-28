<?php
function gerarAluguel($inicioLocacao, $fimLocacao, $locador, $idLocacao){
  include 'conexao.php';
  $start_date = $inicioLocacao;
  $end_date = $fimLocacao;

  $interval = new DateInterval('P1M');

  $dateStart = new DateTime($start_date);
  $dateEnd = new DateTime($end_date);

  $difference = $dateStart->diff($dateEnd);
  
  $num_payments = ($difference->y * 12) + $difference->m;

  $queryParcelaEValorMes = "SELECT max(PARCELA) as parcela_final, max(valor_mes) as valor_mes FROM despesas where id_locacao = :id_locacao";
  $consultaParcelaEValor = $conectar->prepare($queryParcelaEValorMes);
  $consultaParcelaEValor->bindParam(":id_locacao", $idLocacao);
  $consultaParcelaEValor->execute();
  $linhaParcelaFinal = $consultaParcelaEValor->fetch(PDO::FETCH_ASSOC);
  $parcelaFinal = $linhaParcelaFinal["parcela_final"];
  $valorMes = $linhaParcelaFinal["valor_mes"];


  for($i = 1; $i <= $num_payments; $i++){
    $payment_date = $dateStart->format('Y-m-d');

    $novaParcela = $parcelaFinal + $i;

    $inserirAluguel = $conectar->prepare("INSERT INTO despesas (tipo_despesa, empresa, titular, valor_mes, vencimento, parcela, id_locacao) VALUES ('ALUGUEL', :empresa, :titular, :valor_mes, :vencimento, :parcela, :id_locacao)");
    $inserirAluguel->bindParam(":empresa",$locador,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":titular",$locador,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":valor_mes",$valorMes,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":vencimento",$payment_date,PDO::PARAM_STR);
    $inserirAluguel->bindParam(":parcela",$novaParcela,PDO::PARAM_STR);
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
  $aluguel = filter_var($_POST['aluguel'], FILTER_SANITIZE_NUMBER_INT);
  $data_inicio = !empty(filter_input(INPUT_POST, 'data_inicio')) ? filter_input(INPUT_POST, 'data_inicio') : NULL;
  $data_fim = !empty(filter_input(INPUT_POST, 'data_fim')) ? filter_input(INPUT_POST, 'data_fim') : NULL;
  $descricao = filter_var($_POST['descricao']);
  $data_criacao = date('Y-m-d H:i:s', time());
  $id_locacao = filter_var($_POST['id_locacao']);

  $valorAluguel = str_replace(',','.', $valorAluguel);

  $queryAditivo = "INSERT INTO aditivo (descricao, aluguel, data_inicio, data_fim, data_criacao, id_locacao) VALUES (:descricao, :aluguel, :data_inicio, :data_fim, :data_criacao, :id_locacao)";
  $insertAditivo = $conectar->prepare($queryAditivo);
  $insertAditivo->bindParam(":descricao", $descricao, PDO::PARAM_STR);
  $insertAditivo->bindParam(":aluguel", $aluguel, PDO::PARAM_INT);
  $insertAditivo->bindParam(":data_inicio",$data_inicio,PDO::PARAM_STR);
  $insertAditivo->bindParam(":data_fim",$data_fim,PDO::PARAM_STR);
  $insertAditivo->bindParam(":data_criacao",$data_criacao,PDO::PARAM_STR);
  $insertAditivo->bindParam(":id_locacao",$id_locacao,PDO::PARAM_INT);
  $insertAditivo->execute();

  $conectar->commit();

  if (isset($_FILES['anexo_foto_docs']) && $_FILES['anexo_foto_docs']['error'][0] != UPLOAD_ERR_NO_FILE) {
    $arquivos = $_FILES['anexo_foto_docs'];
    $tudo_certo = true;
    foreach ($arquivos['name'] as $index => $arq) {
      $deu_certo = enviarArquivos($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index], $id_locacao, NULL);
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

  $queryNomeLocador = "SELECT nome FROM locador WHERE idlocador = (SELECT id_locador from locacao where idlocacao = :id_locacao)";
  $consultaNomeLocador = $conectar->prepare($queryNomeLocador);
  $consultaNomeLocador->bindParam(":id_locacao", $id_locacao, PDO::PARAM_INT);
  $consultaNomeLocador->execute();
  $linhaNomeLocador = $consultaNomeLocador->fetch(PDO::FETCH_ASSOC);
  $nomeLocador = $linhaNomeLocador["nome"];


  if($aluguel = 1) {
    gerarAluguel($data_inicio, $data_fim, $nomeLocador, $id_locacao);
  }
  
  header('Location: visualizar-locacoes.php');

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
