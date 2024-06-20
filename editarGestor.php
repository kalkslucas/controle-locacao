<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $idgestor = filter_var($_GET['idgestor'], FILTER_SANITIZE_NUMBER_INT);
  $nome = filter_var($_POST['nome']);
  $email = filter_var($_POST['email']);
  $cargo = filter_var($_POST['cargo']);
  $setor = filter_var($_POST['setor']);
  $unidade = filter_var($_POST['unidade']);
  $telefone_1 = filter_var($_POST['telefone_1']);
  $telefone_2 = filter_var($_POST['telefone_2']);
  

  $update = $conectar->prepare("UPDATE gestor SET nome = :nome, email = :email, cargo = :cargo, setor = :setor, unidade = :unidade, telefone_1 = :telefone_1, telefone_2 = :telefone_2 WHERE idgestor = :idgestor");

  $update->bindParam(":idgestor", $idgestor, PDO::PARAM_INT);
  $update->bindParam(":nome", $nome, PDO::PARAM_STR);
  $update->bindParam(":email", $email, PDO::PARAM_STR);
  $update->bindParam(":cargo", $cargo, PDO::PARAM_STR);
  $update->bindParam(":setor", $setor, PDO::PARAM_STR);
  $update->bindParam(":unidade", $unidade, PDO::PARAM_STR);
  $update->bindParam(":telefone_1", $telefone_1, PDO::PARAM_STR);
  $update->bindParam(":telefone_2", $telefone_2, PDO::PARAM_STR);
  $update->execute();

  $conectar->commit();

  header('Location: visualizar-gestores.php');
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
