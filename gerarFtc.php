<?php
include_once 'enviarArquivos.php';
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();

  $numero_ftc = filter_var($_POST['numero_ftc']);
  $descricao = filter_var($_POST['descricao']);
  $data_criacao = date('Y-m-d H:i:s', time());
  $vincularLocacao = filter_var($_POST['vincularLocacao']);

  $query = "INSERT INTO ftc (numero_ftc, data_criacao, descricao, id_locacao) VALUES (:numero_ftc, :data_criacao, :descricao, :vincularLocacao)";

  $insert = $conectar->prepare($query);
  $insert->bindParam(":numero_ftc", $numero_ftc, PDO::PARAM_STR);
  $insert->bindParam(":data_criacao", $data_criacao, PDO::PARAM_STR);
  $insert->bindParam(":descricao", $descricao, PDO::PARAM_STR);
  $insert->bindParam(":vincularLocacao", $vincularLocacao, PDO::PARAM_INT);
  $insert->execute();

  $conectar->commit();
  
  if (isset($_FILES['anexoFtc']) && $_FILES['anexoFtc']['error'][0] != UPLOAD_ERR_NO_FILE) {
    $arquivos = $_FILES['anexoFtc'];
    $tudo_certo = true;
    foreach ($arquivos['name'] as $index => $arq) {
      $deu_certo = enviarArquivos($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index], $vincularLocacao, NULL);
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
  header('Location: visualizar-ftc.php');
  

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
?>