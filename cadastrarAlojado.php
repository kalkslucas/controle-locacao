<?php
include_once 'conexao.php';
$conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
  $conectar->beginTransaction();
  $nome = filter_var($_POST['nome']);
  $email = filter_var($_POST['email']);
  $telefone1 = filter_var($_POST['telefone1']);
  $telefone2 = filter_var($_POST['telefone2']);
  $cargo = filter_var($_POST['cargo']);
  $setor = filter_var($_POST['setor']);
  $unidade = filter_var($_POST['unidade']);
  $vincularLocacao = !empty(filter_var($_POST['id_locacao'])) ? filter_var($_POST['id_locacao']) : NULL;

  $sqlGestor = "SELECT id_gestor FROM locacao WHERE idlocacao = :id_locacao";
  $consulta = $conectar->prepare($sqlGestor);
  $consulta->bindParam(":id_locacao", $vincularLocacao, PDO::PARAM_INT);
  $consulta->execute();
  $idGestor = $consulta->fetch(PDO::FETCH_ASSOC);

  $gestor = $idGestor['id_gestor'];

  $queryAlojado = "INSERT INTO alojado (nome, email, telefone_1, telefone_2, cargo, setor, unidade, id_locacao, id_gestor) VALUES (:nome, :email, :telefone1, :telefone2, :cargo, :setor, :unidade, :id_locacao, :id_gestor)";


  $insert = $conectar->prepare($queryAlojado);
  $insert->bindParam(':nome', $nome, PDO::PARAM_STR);
  $insert->bindParam(':email', $email, PDO::PARAM_STR);
  $insert->bindParam(':telefone1', $telefone1, PDO::PARAM_STR);
  $insert->bindParam(':telefone2', $telefone2, PDO::PARAM_STR);
  $insert->bindParam(':cargo', $cargo, PDO::PARAM_STR);
  $insert->bindParam(':setor', $setor, PDO::PARAM_STR);
  $insert->bindParam(':unidade', $unidade, PDO::PARAM_STR);
  $insert->bindParam(':id_locacao', $vincularLocacao, PDO::PARAM_INT);
  $insert->bindParam(':id_gestor', $gestor, PDO::PARAM_INT);
  $insert->execute();


  $conectar->commit();

  header('Location: visualizar-alojados.php');

} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
