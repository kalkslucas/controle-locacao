<?php
include 'conexao.php';
$idAnexo = filter_var($_GET['idanexo']);
$idLocacao = filter_var($_GET['idlocacao']); 
$sql = "SELECT * FROM anexos where idanexo = '$idAnexo'";
$arquivo = $conectar->query($sql);
$fetch = $arquivo->fetch(PDO::FETCH_ASSOC);

if(unlink($fetch['path'])) {
  $sqlDeleteAnexo = "DELETE FROM anexos WHERE idanexo = '$idAnexo'";
  $deleteAnexo = $conectar->query($sqlDeleteAnexo);
}

$sqlDeleteLocacao = "DELETE FROM locacao WHERE idlocacao = '$idLocacao'";
$deleteLocacao = $conectar->query($sqlDeleteLocacao);

header("Location: visualizar-locacoes.php");