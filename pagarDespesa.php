<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $iddespesa = filter_var($_GET['iddespesa'], FILTER_SANITIZE_NUMBER_INT);
  $anexo_contas = filter_var($_FILES['anexo_contas']);
  $agora = (new DateTime('now'))->format('Y-m-d H:i:s');

  if(isset($_FILES['anexo_contas'])){
    $arquivo = $_FILES['anexo_contas'];
  
    if(is_uploaded_file($arquivo['error'])){
      die('Falha ao enviar o arquivo');
    }
  
    if(is_uploaded_file($arquivo['size']) > 8388608){
      die('Arquivo muito grande!! Máximo 8MB');
    }
    $pasta = 'assets/docs/';
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArq = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    $path = $pasta.$novoNomeDoArq.'.'.$extensao;
  
    if($extensao != 'jpg' && $extensao != 'png' && $extensao != 'pdf'){
      die('Tipo de arquivo não aceito');
    }
  
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
    if($deu_certo){
      $updateArquivo = $conectar->query("UPDATE despesas SET anexo_contas = '$path' WHERE iddespesa = '$iddespesa'");
      $updateArquivo->execute();
      echo "Arquivo enviado!";
    } else {
      echo "Falha ao enviar arquivo!";
    }
  } else {
    echo "Favor anexar o comprovante";
  }

  $update = $conectar->prepare("UPDATE despesas SET situacao_conta = :situacao_conta, data_pagamento_conta = :data_pagamento_conta WHERE iddespesa = :iddespesa");

  $situacao_conta = 1;
  $update->bindParam(":iddespesa", $iddespesa, PDO::PARAM_INT);
  $update->bindParam(":situacao_conta", $situacao_conta, PDO::PARAM_INT);
  $update->bindParam(":data_pagamento_conta", $agora, PDO::PARAM_STR);
  $update->execute();

  $conectar->commit();
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
