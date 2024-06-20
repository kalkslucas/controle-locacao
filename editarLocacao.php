<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
  $ftc = filter_var($_POST['ftc']);
  $gestor = filter_var($_POST['gestor']);
  $situacao = filter_var($_POST['situacao']);
  $inicioLocacao = DateTime::createFromFormat('d/m/Y', $_POST['inicioLocacao'])->format('Y-m-d');
  $fimLocacao = DateTime::createFromFormat('d/m/Y', $_POST['fimLocacao'])->format('Y-m-d');
  $observacoes = filter_var($_POST['observacoes']);
  $locador = filter_var($_POST['locador']);
  $rua = filter_var($_POST['rua']);
  $numero = filter_var($_POST['numero']);
  $complemento = filter_var($_POST['complemento']);
  $bairro = filter_var($_POST['bairro']);
  $cidade = filter_var($_POST['cidade']);
  $estado = filter_var($_POST['estado']);
  $cep = filter_var($_POST['cep']);
  $valorAluguel = filter_var($_POST['valorAluguel']);

  $update = $conectar->prepare("UPDATE locacao lc INNER JOIN endereco e ON lc.id_endereco = e.idendereco INNER JOIN gestor g on lc.id_gestor = g.idgestor inner join despesas d on d.id_locacao = lc.idlocacao inner join locador l on lc.id_locador = l.idlocador SET lc.ftc = :ftc, g.nome = :gestor, situacao = :situacao, inicio_locacao = :inicioLocacao, termino_locacao = :fimLocacao, observacoes = :observacoes, l.nome = :locador, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, d.valor_mes = :valorAluguel WHERE lc.idlocacao = :idlocacao");

  $update->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
  $update->bindParam(":ftc", $ftc, PDO::PARAM_STR);
  $update->bindParam(":gestor", $gestor, PDO::PARAM_STR);
  $update->bindParam(":situacao", $situacao, PDO::PARAM_STR);
  $update->bindParam(":inicioLocacao", $inicioLocacao, PDO::PARAM_STR);
  $update->bindParam(":fimLocacao", $fimLocacao, PDO::PARAM_STR);
  $update->bindParam(':observacoes', $observacoes, PDO::PARAM_STR);
  $update->bindParam(":locador", $locador, PDO::PARAM_STR);
  $update->bindParam(":rua", $rua, PDO::PARAM_STR);
  $update->bindParam(":numero", $numero, PDO::PARAM_STR);
  $update->bindParam(":complemento", $complemento, PDO::PARAM_STR);
  $update->bindParam(":bairro", $bairro, PDO::PARAM_STR);
  $update->bindParam(":cidade", $cidade, PDO::PARAM_STR);
  $update->bindParam(":estado", $estado, PDO::PARAM_STR);
  $update->bindParam(":cep", $cep, PDO::PARAM_STR);
  $update->bindParam(":valorAluguel", $valorAluguel, PDO::PARAM_STR);
  $update->execute();

  $conectar->commit();

  header('Location: visualizar-locacoes.php');
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
