<?php
function enviarArquivos($error, $size, $name, $tmp_name, $idLocacao, $idAlojado){
  include 'conexao.php';

  if ($error) {
    die('Falha ao enviar o arquivo');
  }

  if ($size > 67108864) {
    die('Arquivo muito grande!! Máximo 64MB');
  }
  $pasta = 'assets/docs/';
  $nomeDoArquivo = $name;
  $novoNomeDoArq = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

  $path = $pasta . $novoNomeDoArq . '.' . $extensao;

  if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'pdf') {
    die('Tipo de arquivo não aceito');
  }

  $deu_certo = move_uploaded_file($tmp_name, $path);
  if ($deu_certo) {
    global $conectar;
    $inserirArquivo = $conectar->prepare("INSERT INTO anexos (nome_arquivo, path, id_locacao, id_alojado) VALUES (:nome_arquivo, :path, :idlocacao, :idalojado)");
    $inserirArquivo->bindParam(":nome_arquivo", $nomeDoArquivo, PDO::PARAM_STR);
    $inserirArquivo->bindParam(":path", $path, PDO::PARAM_STR);
    $inserirArquivo->bindParam(":idlocacao", $idLocacao, PDO::PARAM_INT);
    $inserirArquivo->bindParam(":idalojado", $idAlojado, PDO::PARAM_INT);
    $inserirArquivo->execute();
    return true;
  } else {
    return false;
  }
}