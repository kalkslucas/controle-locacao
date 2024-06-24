<?php
include 'enviarArquivos.php';
include 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();
  $transactionActive = true; // Flag to track transaction state


  $idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
  $ftc = filter_input(INPUT_POST, 'ftc');
  $gestor = filter_input(INPUT_POST, 'gestor', FILTER_SANITIZE_NUMBER_INT);
  $situacao = filter_input(INPUT_POST, 'situacao');
  $inicioLocacao = filter_input(INPUT_POST, 'inicioLocacao');
  $fimLocacao = filter_input(INPUT_POST, 'fimLocacao');
  $vistoriaEntrada = filter_input(INPUT_POST, 'vistoriaEntrada');
  $vistoriaSaida = filter_input(INPUT_POST, 'vistoriaSaida');
  $observacoes = filter_input(INPUT_POST, 'observacoes');
  $locador = filter_input(INPUT_POST, 'locador', FILTER_SANITIZE_NUMBER_INT);
  $rua = filter_input(INPUT_POST, 'rua');
  $numero = filter_input(INPUT_POST, 'numero');
  $complemento = filter_input(INPUT_POST, 'complemento');
  $bairro = filter_input(INPUT_POST, 'bairro');
  $cidade = filter_input(INPUT_POST, 'cidade');
  $estado = filter_input(INPUT_POST, 'estado');
  $cep = filter_input(INPUT_POST, 'cep');

  $update = $conectar->prepare("UPDATE locacao SET ftc = :ftc, id_gestor = :gestor, situacao = :situacao, inicio_locacao = :inicioLocacao, termino_locacao = :fimLocacao, vistoria_entrada = :vistoriaEntrada, vistoria_saida = :vistoriaSaida observacoes = :observacoes, id_locador = :locador WHERE idlocacao = :idlocacao");

  $update->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
  $update->bindParam(":ftc", $ftc, PDO::PARAM_STR);
  $update->bindParam(":gestor", $gestor, PDO::PARAM_INT);
  $update->bindParam(":situacao", $situacao, PDO::PARAM_STR);
  $update->bindParam(":inicioLocacao", $inicioLocacao, PDO::PARAM_STR);
  $update->bindParam(":fimLocacao", $fimLocacao, PDO::PARAM_STR);
  $update->bindParam(":vistoriaEntrada", $vistoriaEntrada, PDO::PARAM_STR);
  $update->bindParam(":vistoriaSaida", $vistoriaSaida, PDO::PARAM_STR);
  $update->bindParam(":observacoes", $observacoes, PDO::PARAM_STR);
  $update->bindParam(":locador", $locador, PDO::PARAM_INT);
  $update->execute();

  $conectar->commit();

  $conectar->beginTransaction();

  $updateEndereco = $conectar->prepare("UPDATE endereco SET rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE idendereco = (SELECT id_endereco FROM locacao WHERE idlocacao = :idlocacao)");

  $updateEndereco->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
  $updateEndereco->bindParam(":rua", $rua, PDO::PARAM_STR);
  $updateEndereco->bindParam(":numero", $numero, PDO::PARAM_STR);
  $updateEndereco->bindParam(":complemento", $complemento, PDO::PARAM_STR);
  $updateEndereco->bindParam(":bairro", $bairro, PDO::PARAM_STR);
  $updateEndereco->bindParam(":cidade", $cidade, PDO::PARAM_STR);
  $updateEndereco->bindParam(":estado", $estado, PDO::PARAM_STR);
  $updateEndereco->bindParam(":cep", $cep, PDO::PARAM_STR);
  $updateEndereco->execute();

  $conectar->commit();
  $transactionActive = false; // Set flag to false as commit was successful


  if (isset($_FILES['anexo_foto_docs']) && $_FILES['anexo_foto_docs']['error'][0] != UPLOAD_ERR_NO_FILE) {
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
  }
  header('Location: visualizar-locacoes.php');
} catch (PDOException $e) {
  if (isset($transactionActive) && $transactionActive) {
    $conectar->rollBack();
  }
  echo 'Erro :' . $e->getMessage();
}
