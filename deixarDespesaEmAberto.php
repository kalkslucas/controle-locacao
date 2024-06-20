<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $iddespesa = filter_var($_GET['iddespesa'], FILTER_SANITIZE_NUMBER_INT);
  $agora = null;

  $sql = "SELECT ANEXO_CONTAS FROM despesas where iddespesa = '$iddespesa'";
  $arquivo = $conectar->query($sql);
  $fetch = $arquivo->fetch(PDO::FETCH_ASSOC);

  if(unlink($fetch['ANEXO_CONTAS'])) {
    $sqlDelete = "DELETE FROM despesas WHERE iddespesa = '$iddespesa'";
    $delete = $conectar->query($sqlDelete);
  }

  $update = $conectar->prepare("UPDATE despesas SET situacao_conta = :situacao_conta, data_pagamento_conta = :data_pagamento_conta WHERE iddespesa = :iddespesa");

  $situacao_conta = 0;
  $update->bindParam(":iddespesa", $iddespesa, PDO::PARAM_INT);
  $update->bindParam(":situacao_conta", $situacao_conta, PDO::PARAM_INT);
  $update->bindParam(":data_pagamento_conta", $agora, PDO::PARAM_STR);
  $update->execute();

  $conectar->commit();

  header('Location: visualizar-despesas.php');
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
