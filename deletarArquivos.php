<?php
include 'conexao.php';
$sql = "SELECT * FROM anexos where iddespesa = '$iddespesa'";
$arquivo = $conectar->query($sql);
$fetch = $arquivo->fetch(PDO::FETCH_ASSOC);

if(unlink($fetch['ANEXO_CONTAS'])) {
  $sqlDelete = "DELETE FROM despesas WHERE iddespesa = '$iddespesa'";
  $delete = $conectar->query($sqlDelete);
}