<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();

  //locador's variables
  $nome = filter_var($_POST['nome']);
  $cpfCnpj = filter_var($_POST['cpfCnpj']);
  $email = filter_var($_POST['email']);
  $responsavel = filter_var($_POST['responsavel']);
  $telefone1 = filter_var($_POST['telefone1']);
  $telefone2 = filter_var($_POST['telefone2']);
  $cep = filter_var($_POST['cep']);
  $rua = filter_var($_POST['rua']);
  $numero = filter_var($_POST['numero']);
  $complemento = filter_var($_POST['complemento']);
  $bairro = filter_var($_POST['bairro']);
  $cidade = filter_var($_POST['cidade']);
  $estado = filter_var($_POST['uf']);
  $formaPagamento = filter_var($_POST['formaPagamento']);
  $banco = filter_var($_POST['banco']);
  $agencia = filter_var($_POST['agencia']);
  $conta = filter_var($_POST['conta']);
  $tipoConta = filter_var($_POST['tipoConta']);
  $pix = filter_var($_POST['pix']);

  // Insert into endereco table
  $queryEndereco = "INSERT INTO endereco (tipo_endereco, rua, numero, complemento, bairro, cidade, estado, cep) VALUES ('ESCRITORIO', :rua, :numero, :complemento, :bairro, :cidade, :estado, :cep)";
  $insertEndereco = $conectar->prepare($queryEndereco);
  $insertEndereco->bindParam(':rua', $rua, PDO::PARAM_STR);
  $insertEndereco->bindParam(':numero', $numero, PDO::PARAM_STR);
  $insertEndereco->bindParam(':complemento', $complemento, PDO::PARAM_STR);
  $insertEndereco->bindParam(':bairro', $bairro, PDO::PARAM_STR);
  $insertEndereco->bindParam(':cidade', $cidade, PDO::PARAM_STR);
  $insertEndereco->bindParam(':estado', $estado, PDO::PARAM_STR);
  $insertEndereco->bindParam(':cep', $cep, PDO::PARAM_STR);
  $insertEndereco->execute();

  // Insert into locador table
  $idEndereco = $conectar->lastInsertId(); // Get the last inserted ID
  $queryLocador = "INSERT INTO locador (nome, cpf_cnpj, email, responsavel, telefone_1, telefone_2, forma_pagamento, banco, agencia, conta, tipo_conta, pix, id_endereco) VALUES (:nome, :cpfCnpj, :email, :responsavel, :telefone1, :telefone2, :formaPagamento, :banco, :agencia, :conta, :tipo_conta, :pix, :idEndereco)";
  $insertLocador = $conectar->prepare($queryLocador);
  $insertLocador->bindParam(':nome', $nome, PDO::PARAM_STR);
  $insertLocador->bindParam(':cpfCnpj', $cpfCnpj, PDO::PARAM_STR);
  $insertLocador->bindParam(':email', $email, PDO::PARAM_STR);
  $insertLocador->bindParam(':responsavel', $responsavel, PDO::PARAM_STR);
  $insertLocador->bindParam(':telefone1', $telefone1, PDO::PARAM_STR);
  $insertLocador->bindParam(':telefone2', $telefone2, PDO::PARAM_STR);
  $insertLocador->bindParam(':formaPagamento', $formaPagamento, PDO::PARAM_STR);
  $insertLocador->bindParam(':banco', $banco, PDO::PARAM_STR);
  $insertLocador->bindParam(':agencia', $agencia, PDO::PARAM_STR);
  $insertLocador->bindParam(':conta', $conta, PDO::PARAM_STR);
  $insertLocador->bindParam(':tipo_conta', $tipoConta, PDO::PARAM_STR);
  $insertLocador->bindParam(':pix', $pix, PDO::PARAM_STR);
  $insertLocador->bindParam(':idEndereco', $idEndereco, PDO::PARAM_INT);
  $insertLocador->execute();

  $conectar->commit();

  header('Location: visualizar-locadores.php');

} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
