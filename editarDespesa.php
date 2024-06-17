<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $iddespesa = filter_var($_GET['iddespesa'], FILTER_SANITIZE_NUMBER_INT);
  $tipo_despesa = filter_var($_POST['tipo_despesa']);
  $empresa = filter_var($_POST['empresa']);
  $titular = filter_var($_POST['titular']);
  $num_instalacao = filter_var($_POST['num_instalacao']);
  $consumo_velocidade = filter_var($_POST['consumo_velocidade']);
  $valor_mes = filter_var($_POST['valor_mes']);
  $vencimento = filter_var($_POST['vencimento']);
  $anexo_contas = filter_var($_POST['anexo_contas']);

  $update = $conectar->prepare("UPDATE despesas SET tipo_despesa = :tipo_despesa, empresa = :empresa, titular = :titular, num_instalacao = :num_instalacao, consumo_velocidade = :consumo_velocidade, valor_mes = :valor_mes, vencimento = :vencimento, anexo_contas = :anexo_contas WHERE iddespesa = :iddespesa");

  $update->bindParam(":iddespesa", $iddespesa, PDO::PARAM_INT);
  $update->bindParam(":tipo_despesa", $tipo_despesa, PDO::PARAM_STR);
  $update->bindParam(":empresa", $empresa, PDO::PARAM_STR);
  $update->bindParam(":titular", $titular, PDO::PARAM_STR);
  $update->bindParam(":num_instalacao", $num_instalacao, PDO::PARAM_STR);
  $update->bindParam(":consumo_velocidade", $consumo_velocidade, PDO::PARAM_STR);
  $update->bindParam(":valor_mes", $valor_mes, PDO::PARAM_STR);
  $update->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
  $update->bindParam(":anexo_contas", $anexo_contas);
  $update->execute();

  $conectar->commit();
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
