<?php
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

  echo 'Cadastro Concluído!';

  $conectar->commit();
} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  // Log the error
  error_log('Error: ' . $e->getMessage(), 0);
}
?>
