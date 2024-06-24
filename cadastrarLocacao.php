<?php
/*
function enviarArquivos($error, $size, $name, $tmp_name, $idLocacao){
  include 'conexao.php';

  if ($error) {
    die('Falha ao enviar o arquivo');
  }

  if ($size > 67108864) {
    die('Arquivo muito grande!! Máximo 64MB');
  }
  $pasta = 'assets/docs/';
  $nomeDoArquivo = $name;
  $novoNomeDoArq = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

  $path = $pasta . $novoNomeDoArq . '.' . $extensao;

  if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'pdf') {
    die('Tipo de arquivo não aceito');
  }

  $deu_certo = move_uploaded_file($tmp_name, $path);
  if ($deu_certo) {
    $inserirArquivo = $conectar->prepare("INSERT INTO anexos (nome_arquivo, path, id_locacao) VALUES (:nome_arquivo, :path, :idlocacao)");
    $inserirArquivo->bindParam(":nome_arquivo", $nomeDoArquivo, PDO::PARAM_STR);
    $inserirArquivo->bindParam(":path", $path, PDO::PARAM_STR);
    $inserirArquivo->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
    $inserirArquivo->execute();
    return true;
  } else {
    return false;
  }
}
  */


function gerarAluguel($inicioLocacao, $terminoLocacao, $locador, $valorAluguel, $idLocacao){
  include 'conexao.php';
  $start_date = $inicioLocacao;
  $end_date = $terminoLocacao;
  

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
  $locador = filter_var($_POST['locador']);
  $situacao = filter_var($_POST['situacao']);
  $cep = filter_var($_POST['cep']);
  $rua = filter_var($_POST['rua']);
  $numero = filter_var($_POST['numero']);
  $complemento = filter_var($_POST['complemento']);
  $bairro = filter_var($_POST['bairro']);
  $cidade = filter_var($_POST['cidade']);
  $estado = filter_var($_POST['uf']);
  $inicioLocacao = filter_var($_POST['inicioLocacao']);
  $terminoLocacao = filter_var($_POST['terminoLocacao']);
  $valorAluguel = filter_var($_POST['valorAluguel']);
  $observacoes = filter_var($_POST['observacoes']);

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

  $queryLocacao = "INSERT INTO locacao (ftc, situacao, inicio_locacao, termino_locacao, observacoes, id_gestor, id_locador, id_endereco) VALUES (:ftc, :situacao, :inicio_locacao, :termino_locacao, :observacoes, :gestor, :locador, :idEndereco)";
  $insertLocacao = $conectar->prepare($queryLocacao);
  $insertLocacao->bindParam(':ftc', $ftc, PDO::PARAM_STR);
  $insertLocacao->bindParam(':situacao', $situacao, PDO::PARAM_STR);
  $insertLocacao->bindParam(':inicio_locacao', $inicioLocacao, PDO::PARAM_STR);
  $insertLocacao->bindParam(':termino_locacao', $terminoLocacao, PDO::PARAM_STR);
  $insertLocacao->bindParam(':observacoes', $observacoes, PDO::PARAM_STR);
  $insertLocacao->bindParam(':gestor', $gestor, PDO::PARAM_INT);
  $insertLocacao->bindParam(':locador', $locador, PDO::PARAM_INT);
  $insertLocacao->bindParam(':idEndereco', $idEndereco, PDO::PARAM_INT);
  $insertLocacao->execute();

  $idLocacao = $conectar->lastInsertId();
  $conectar->commit();

  if (isset($_FILES['anexo_foto_docs'])) {
    $arquivos = $_FILES['anexo_foto_docs'];
    $tudo_certo = true;
    foreach ($arquivos['name'] as $index => $arq) {
      $deu_certo = enviarArquivos($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index], $idLocacao);
      if (!$deu_certo) {
        $tudo_certo = false;
      }
    }
    if ($tudo_certo) {
      echo '<p>Todos os arquivos foram enviados com sucesso!</p>';
    } else {
      echo '<p>Falha ao enviar um ou mais arquivos</p>';
    }
    return true;
  } else {
    return false;
  }

  if(isset($_POST['valorAluguel'])) {
    gerarAluguel($inicioLocacao, $terminoLocacao, $locador, $valorAluguel, $idLocacao);
  }
  
  header('Location: visualizar-locacoes.php');

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
