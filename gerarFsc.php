<?php
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

  $conectar->commit();
  
  header('Location: visualizar-fsc.php');
  

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
?>