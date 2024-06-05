<?php
include_once ("conexao.php");
try {
$conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conectar->beginTransaction();

$tipoDespesa = filter_var($_POST["tipoDespesa"]);
$empresa = filter_var($_POST["empresa"]);
$titular = filter_var($_POST["titular"]);
$numInstalacao = filter_var($_POST["numInstalacao"]);
$consumoVelocidade = filter_var($_POST["consumoVelocidade"]);
$valorConta = filter_var($_POST["valorConta"]);
$dataVencimento = filter_var($_POST["dataVencimento"]);
$vincularLocacao = filter_var($_POST["vincularLocacao"]);

$query = "INSERT INTO despesas (tipo_despesa, empresa, titular, num_instalacao, consumo_velocidade, valor_mes, vencimento, id_locacao) VALUES (:tipoDespesa, :empresa, :titular, :numInstalacao, :consumoVelocidade, :valorConta, :dataVencimento, :vincularLocacao)";

$insert = $conectar->prepare($query);
$insert->bindParam(":tipoDespesa", $tipoDespesa, PDO::PARAM_STR);
$insert->bindParam(":empresa", $empresa, PDO::PARAM_STR);
$insert->bindParam(":titular", $titular, PDO::PARAM_STR);
$insert->bindParam(":numInstalacao", $numInstalacao, PDO::PARAM_STR);
$insert->bindParam(":consumoVelocidade", $consumoVelocidade, PDO::PARAM_STR);
$insert->bindParam(":valorConta", $valorConta, PDO::PARAM_STR);
$insert->bindParam(":dataVencimento", $dataVencimento, PDO::PARAM_STR);
$insert->bindParam(":vincularLocacao", $vincularLocacao, PDO::PARAM_INT);
$insert->execute();

$conectar->commit();
} catch (PDOException $e) {
  echo "Error: ". $e->getMessage();

  error_log("Error: ". $e->getMessage());
}

?>