<?php
include 'conexao.php';
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);

if($idLocacao){
  try {
    $conectar->beginTransaction();

    $sql = "SELECT * FROM anexos where id_locacao = :idlocacao";
    $stmt = $conectar->prepare($sql);
    $stmt->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
    $stmt->execute();
    $anexos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($anexos as $anexo){
      if(file_exists($anexo['path']) && !unlink($anexo['path'])){
        throw new Exception("Falha ao deletar o arquivo: $anexo[path]");
      }
    }

    $sqlRetirarAlojado = "UPDATE alojado SET id_locacao = NULL WHERE id_locacao = :idlocacao";
    $retirarAlojado = $conectar->prepare($sqlRetirarAlojado);
    $retirarAlojado->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
    $retirarAlojado->execute();

    $sqlDeletarDespesas = "DELETE FROM despesas WHERE id_locacao = :idlocacao";
    $deletarDespesas = $conectar->prepare($sqlDeletarDespesas);
    $deletarDespesas->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
    $deletarDespesas->execute();
    
    $sqlDeletarFsc = "DELETE FROM fsc WHERE id_locacao = :idlocacao";
    $deletarFsc = $conectar->prepare($sqlDeletarFsc);
    $deletarFsc->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
    $deletarFsc->execute();

    $sqlDeleteAnexo = "DELETE FROM anexos WHERE id_locacao = :idlocacao";
    $deleteAnexo = $conectar->prepare($sqlDeleteAnexo);
    $deleteAnexo->bindParam(":idlocacao", $idLocacao,pdo::PARAM_INT);
    $deleteAnexo->execute();

    $sqlDeleteLocacao = "DELETE FROM locacao WHERE idlocacao = :idlocacao";
    $deleteLocacao = $conectar->prepare($sqlDeleteLocacao);
    $deleteLocacao->bindParam(":idlocacao", $idLocacao,PDO::PARAM_INT);
    $deleteLocacao->execute();

    $conectar->commit();

    header("Location: visualizar-locacoes.php");
    exit;
  } catch (Exception $e) {
    $conectar->rollBack();
    echo "Falha ao deletar a locação ou anexos: " . $e->getMessage();
  }
}else{
  echo "Parâmetros inválidos!";
}

