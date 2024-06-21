<?php
include 'conexao.php';
$idAnexo = filter_var($_GET['idanexo']);
$idLocacao = filter_var($_GET['idlocacao']); 
$sql = "SELECT * FROM anexos where idanexo = '$idAnexo'";
$arquivo = $conectar->query($sql);
$fetch = $arquivo->fetch(PDO::FETCH_ASSOC);

if(unlink($fetch['path'])) {
  $sqlDelete = "DELETE FROM anexos WHERE idanexo = '$idAnexo'";
  $delete = $conectar->query($sqlDelete);
  header("Location: form-editar-locacao.php?idlocacao=$idLocacao");
}