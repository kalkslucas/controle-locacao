<?php
include 'enviarArquivos.php';
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();
  $transactionActive = true; // Flag to track transaction state


  $idalojado = filter_var($_GET['idalojado'], FILTER_SANITIZE_NUMBER_INT);
  $nome = filter_var($_POST['nome']);
  $email = filter_var($_POST['email']);
  $cargo = filter_var($_POST['cargo']);
  $setor = filter_var($_POST['setor']);
  $unidade = filter_var($_POST['unidade']);
  $telefone_1 = filter_var($_POST['telefone_1']);
  $telefone_2 = filter_var($_POST['telefone_2']);
  $vincularLocacao = filter_var($_POST['id_locacao']);

  $sqlGestor = "SELECT id_gestor FROM locacao WHERE idlocacao = :id_locacao";
  $consulta = $conectar->prepare($sqlGestor);
  $consulta->bindParam(":id_locacao", $vincularLocacao, PDO::PARAM_INT);
  $consulta->execute();
  $idGestor = $consulta->fetch(PDO::FETCH_ASSOC);

  $gestor = $idGestor['id_gestor'];
  

  $update = $conectar->prepare("UPDATE alojado SET nome = :nome, email = :email, cargo = :cargo, setor = :setor, unidade = :unidade, telefone_1 = :telefone_1, telefone_2 = :telefone_2, id_locacao = :id_locacao, id_gestor = :id_gestor WHERE idalojado = :idalojado");

  $update->bindParam(":idalojado", $idalojado, PDO::PARAM_INT);
  $update->bindParam(":nome", $nome, PDO::PARAM_STR);
  $update->bindParam(":email", $email, PDO::PARAM_STR);
  $update->bindParam(":cargo", $cargo, PDO::PARAM_STR);
  $update->bindParam(":setor", $setor, PDO::PARAM_STR);
  $update->bindParam(":unidade", $unidade, PDO::PARAM_STR);
  $update->bindParam(":telefone_1", $telefone_1, PDO::PARAM_STR);
  $update->bindParam(":telefone_2", $telefone_2, PDO::PARAM_STR);
  $update->bindParam(':id_locacao', $vincularLocacao, PDO::PARAM_INT);
  $update->bindParam(':id_gestor', $gestor, PDO::PARAM_INT);
  $update->execute();

  $conectar->commit();

  $transactionActive = false; // Set flag to false as commit was successful


  if (isset($_FILES['anexo_foto_docs']) && $_FILES['anexo_foto_docs']['error'][0] != UPLOAD_ERR_NO_FILE) {
    $arquivos = $_FILES['anexo_foto_docs'];
    $tudo_certo = true;
    foreach ($arquivos['name'] as $index => $arq) {
      $deu_certo = enviarArquivos($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index], NULL, NULL, $idalojado);
      if (!$deu_certo) {
        $tudo_certo = false;
      }
    }
    if ($tudo_certo) {
      echo '<p>Todos os arquivos foram enviados com sucesso!</p>';
    } else {
      echo '<p>Falha ao enviar um ou mais arquivos</p>';
    }
  }
  header('Location: visualizar-alojados.php');
} catch (PDOException $e) {
  if (isset($transactionActive) && $transactionActive) {
    $conectar->rollBack();
  }
  echo 'Erro :' . $e->getMessage();
}
