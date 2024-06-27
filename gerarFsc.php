<?php
include_once 'enviarArquivos.php';
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();

  $numeroFsc = filter_var($_POST['numeroFsc']);
  $validadeFsc = filter_var($_POST['validadeFsc']);
  $vincularLocacao = filter_var($_POST['vincularLocacao']);

  $query = "INSERT INTO fsc (numero_fsc, validade, id_locacao) VALUES (:numeroFsc, :validade, :vincularLocacao)";

  $insert = $conectar->prepare($query);
  $insert->bindParam(":numeroFsc", $numeroFsc, PDO::PARAM_STR);
  $insert->bindParam(":validade", $validadeFsc, PDO::PARAM_STR);
  $insert->bindParam(":vincularLocacao", $vincularLocacao, PDO::PARAM_INT);
  $insert->execute();

  $idFsc = $conectar->lastInsertId();
  $conectar->commit();
  
  if (isset($_FILES['anexoFsc']) && $_FILES['anexoFsc']['error'][0] != UPLOAD_ERR_NO_FILE) {
    $arquivos = $_FILES['anexoFsc'];
    $tudo_certo = true;
    foreach ($arquivos['name'] as $index => $arq) {
      $deu_certo = enviarArquivos($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index], NULL, $idFsc, NULL);
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
  header('Location: visualizar-fsc.php');
  

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
?>