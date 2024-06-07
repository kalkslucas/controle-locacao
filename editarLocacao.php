<?php
include_once 'conexao.php';
try {
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->beginTransaction();


  $idLocacao = filter_var($_POST['idLocacao']);
  $ftc = filter_var($_POST['ftc']);
  $gestor = filter_var($_POST['gestor']);
  $situacao = filter_var($_POST['situacao']);
  $inicioLocacao = filter_var($_POST['inicioLocacao']);
  $fimLocacao = filter_var($_POST['fimLocacao']);
  $locador = filter_var($_POST['locador']);
  $rua = filter_var($_POST['rua']);
  $numero = filter_var($_POST['numero']);
  $complemento = filter_var($_POST['complemento']);
  $bairro = filter_var($_POST['bairro']);
  $cidade = filter_var($_POST['cidade']);
  $estado = filter_var($_POST['estado']);
  $cep = filter_var($_POST['cep']);
  $valorAluguel = filter_var($_POST['valorAluguel']);


  $update = $conectar->prepare("UPDATE locacao lc INNER JOIN endereco e ON lC.id_endereco = e.idendereco INNER JOIN SET gestor g on lc.id_gestor = g.idgestor inner join despesas d on d.id_locacao = lc.idlocacao inner join locador l on lc.id_locador = l.idlocador SET nome = :nome, cpf_cnpj = :cpf_cnpj, email = :email, banco = :banco, agencia = :agencia, conta = :conta, tipo_conta = :tipo_conta, pix = :pix, telefone_1 = :telefone_1, telefone_2 = :telefone_2, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE idlocador = :idlocador");

  $update->bindParam(":idlocador", $idLocador, PDO::PARAM_INT);
  $update->bindParam(":nome", $nome, PDO::PARAM_STR);
  $update->bindParam(":cpf_cnpj", $cpf_cnpj, PDO::PARAM_STR);
  $update->bindParam(":email", $email, PDO::PARAM_STR);
  $update->bindParam(":banco", $banco, PDO::PARAM_STR);
  $update->bindParam(":agencia", $agencia, PDO::PARAM_STR);
  $update->bindParam(":conta", $conta, PDO::PARAM_STR);
  $update->bindParam(":tipo_conta", $tipo_conta, PDO::PARAM_STR);
  $update->bindParam(":pix", $pix, PDO::PARAM_STR);
  $update->bindParam(":telefone_1", $telefone_1, PDO::PARAM_STR);
  $update->bindParam(":telefone_2", $telefone_2, PDO::PARAM_STR);
  $update->bindParam(":rua", $rua, PDO::PARAM_STR);
  $update->bindParam(":numero", $numero, PDO::PARAM_STR);
  $update->bindParam(":complemento", $complemento, PDO::PARAM_STR);
  $update->bindParam(":bairro", $bairro, PDO::PARAM_STR);
  $update->bindParam(":cidade", $cidade, PDO::PARAM_STR);
  $update->bindParam(":estado", $estado, PDO::PARAM_STR);
  $update->bindParam(":cep", $cep, PDO::PARAM_STR);
  $update->execute();

  $conectar->commit();
} catch (PDOException $e) {
  $conectar->rollBack();
  echo 'Erro :' . $e->getMessage();
}
