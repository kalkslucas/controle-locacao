<?php
include_once 'conexao.php';
$conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
  $conectar->beginTransaction();
  $tipoPessoa = filter_var($_POST['tipoPessoa']);
  $nome = filter_var($_POST['nome']);
  $email = filter_var($_POST['email']);
  $telefone1 = filter_var($_POST['telefone1']);
  $telefone2 = filter_var($_POST['telefone2']);
  $cargo = filter_var($_POST['cargo']);
  $setor = filter_var($_POST['setor']);
  $unidade = filter_var($_POST['unidade']);

  $queryGestor = "INSERT INTO gestor (nome, email, telefone_1, telefone_2, cargo, setor, unidade) VALUES (:nome, :email, :telefone1, :telefone2, :cargo, :setor, :unidade)";
  $queryAlojado = "INSERT INTO alojado (nome, email, telefone_1, telefone_2, cargo, setor, unidade) VALUES (:nome, :email, :telefone1, :telefone2, :cargo, :setor, :unidade)";

  if ($tipoPessoa === 'gestor') {
    $insert = $conectar->prepare($queryGestor);
    $insert->bindParam(':nome', $nome, PDO::PARAM_STR);
    $insert->bindParam(':email', $email, PDO::PARAM_STR);
    $insert->bindParam(':telefone1', $telefone1, PDO::PARAM_STR);
    $insert->bindParam(':telefone2', $telefone2, PDO::PARAM_STR);
    $insert->bindParam(':cargo', $cargo, PDO::PARAM_STR);
    $insert->bindParam(':setor', $setor, PDO::PARAM_STR);
    $insert->bindParam(':unidade', $unidade, PDO::PARAM_STR);
    $insert->execute();
  } else if ($tipoPessoa === 'alojado') {
    $insert = $conectar->prepare($queryAlojado);
    $insert->bindParam(':nome', $nome, PDO::PARAM_STR);
    $insert->bindParam(':email', $email, PDO::PARAM_STR);
    $insert->bindParam(':telefone1', $telefone1, PDO::PARAM_STR);
    $insert->bindParam(':telefone2', $telefone2, PDO::PARAM_STR);
    $insert->bindParam(':cargo', $cargo, PDO::PARAM_STR);
    $insert->bindParam(':setor', $setor, PDO::PARAM_STR);
    $insert->bindParam(':unidade', $unidade, PDO::PARAM_STR);
    $insert->execute();
  }

  $conectar->commit();

  header('Location: visualizar-gestores.php');

} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
