<?php
include 'conexao.php';
$idAnexo = filter_var($_GET['idanexo']);
$idLocacao = filter_var($_GET['idlocacao']);
$idAlojado = filter_var($_GET['idalojado']);
$sql = "SELECT * FROM anexos where idanexo = '$idAnexo'";
$arquivo = $conectar->query($sql);
$fetch = $arquivo->fetch(PDO::FETCH_ASSOC);

if(unlink($fetch['path'])) {
  $sqlDelete = "DELETE FROM anexos WHERE idanexo = '$idAnexo'";
  $delete = $conectar->query($sqlDelete);
  if(!empty($idLocacao)){
    header("Location: form-editar-locacao.php?idlocacao=$idLocacao");
  } else if(!empty($idAlojado)){
    header("Location: form-editar-alojado.php?idalojado=$idAlojado");
  }
  
}