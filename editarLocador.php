<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $idLocador = filter_var($_GET['idlocador'], FILTER_SANITIZE_NUMBER_INT);
  $cpf_cnpj = filter_var($_POST['cpf_cnpj']);
  $nome = filter_var($_POST['nome']);
  $email = filter_var($_POST['email']);
  $responsavel = filter_var($_POST['responsavel']);
  $banco = filter_var($_POST['banco']);
  $agencia = filter_var($_POST['agencia']);
  $conta = filter_var($_POST['conta']);
  $tipo_conta = filter_var($_POST['tipo_conta']);
  $pix = filter_var($_POST['pix']);
  $telefone_1 = filter_var($_POST['telefone_1']);
  $telefone_2 = filter_var($_POST['telefone_2']);
  $rua = filter_var($_POST['rua']);
  $numero = filter_var($_POST['numero']);
  $complemento = filter_var($_POST['complemento']);
  $bairro = filter_var($_POST['bairro']);
  $cidade = filter_var($_POST['cidade']);
  $estado = filter_var($_POST['estado']);
  $formaPagamento = filter_var($_POST['formaPagamento']);
  $cep = filter_var($_POST['cep']);



  $update = $conectar->prepare("UPDATE locador l INNER JOIN endereco e ON l.id_endereco = e.idendereco SET nome = :nome, cpf_cnpj = :cpf_cnpj, email = :email, responsavel = :responsavel, banco = :banco, agencia = :agencia, conta = :conta, tipo_conta = :tipo_conta, pix = :pix, telefone_1 = :telefone_1, telefone_2 = :telefone_2, forma_pagamento = :formaPagamento, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE idlocador = :idlocador");

  $update->bindParam(":idlocador", $idLocador, PDO::PARAM_INT);
  $update->bindParam(":nome", $nome, PDO::PARAM_STR);
  $update->bindParam(":cpf_cnpj", $cpf_cnpj, PDO::PARAM_STR);
  $update->bindParam(":email", $email, PDO::PARAM_STR);
  $update->bindParam(':responsavel', $responsavel, PDO::PARAM_STR);
  $update->bindParam(":banco", $banco, PDO::PARAM_STR);
  $update->bindParam(":agencia", $agencia, PDO::PARAM_STR);
  $update->bindParam(":conta", $conta, PDO::PARAM_STR);
  $update->bindParam(":tipo_conta", $tipo_conta, PDO::PARAM_STR);
  $update->bindParam(":pix", $pix, PDO::PARAM_STR);
  $update->bindParam(":telefone_1", $telefone_1, PDO::PARAM_STR);
  $update->bindParam(":telefone_2", $telefone_2, PDO::PARAM_STR);
  $update->bindParam(':formaPagamento', $formaPagamento, PDO::PARAM_STR);
  $update->bindParam(":rua", $rua, PDO::PARAM_STR);
  $update->bindParam(":numero", $numero, PDO::PARAM_STR);
  $update->bindParam(":complemento", $complemento, PDO::PARAM_STR);
  $update->bindParam(":bairro", $bairro, PDO::PARAM_STR);
  $update->bindParam(":cidade", $cidade, PDO::PARAM_STR);
  $update->bindParam(":estado", $estado, PDO::PARAM_STR);
  $update->bindParam(":cep", $cep, PDO::PARAM_STR);
  $update->execute();

  $conectar->commit();

  header('Location: visualizar-locadores.php');
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
