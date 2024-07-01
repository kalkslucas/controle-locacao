<?php 
$idLocador = filter_var($_GET['idlocador'], FILTER_SANITIZE_NUMBER_INT);
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Locador <?= $idLocador?></title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    label {
      width: 100%;
    }
  </style>
</head>
<?php
include_once "conexao.php";
$idLocador = filter_var($_GET['idlocador'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT nome, responsavel, forma_pagamento, cpf_cnpj, email, banco, agencia, conta, tipo_conta, pix, telefone_1, telefone_2, rua, numero, complemento, bairro, cidade, estado, cep
  from locador l
  inner join endereco e
  on l.id_endereco = e.idendereco
  where idlocador = '$idLocador'";
$consulta = $conectar->query($sql);
$linha = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<body class="page">
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="./assets/img/navbar-logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link" href="./controle-locacao.php">
              Gestão de Locação
            </a>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Em construção...</a>
          </li>
        </ul>
        <div class="user d-flex text-center">
          <label class="infoUser border rounded d-flex flex-column align-items-center me-auto">
            <p class=""> <?= $nomeUser; ?></p>
            <p class=""> <?= $perfilUser; ?></p>
          </label>
          <a class="btn btn-danger m-auto mx-2" href="logout.php">Sair</a>
        </div>
      </div>
    </div>
  </nav>

  <header class="fixed text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <div class="container-fluid">
      <div class="row">
        <div class="col"><a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Locações</a></div>
        <div class="col"><a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Locadores</a></div>
        <div class="col"><a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Gestores</a></div>
        <div class="col"><a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Alojados</a></div>
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FSCs</a></div>
        <div class="col"><a href="visualizar-ftc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FTCs</a></div>
      </div>
    </div>
  </header>

  <main class="container-fluid">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body m-4 rounded shadow-lg">
                <h3 class="card-title text-center">Ficha do Locador</h3>
                <form method="get">
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label id="cpf_cnpj">CPF | CNPJ</label>
                        <input id="cpf_cnpj" name="cpf_cnpj" class="form-control" type="text" value="<?= $linha['cpf_cnpj'] ?>" aria-label="<?= $linha['cpf_cnpj'] ?>" disabled readonly> 
                    </div>
                    <div class="col-md-3">
                      <label id="nome">Nome do Locador</label>
                        <input id="nome" name="nome" class="form-control" type="text" value="<?= $linha['nome'] ?>" aria-label="<?= $linha['nome'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="responsavel">Nome do Responsável</label>
                        <input id="responsavel" name="responsavel" class="form-control" type="text" value="<?= $linha['responsavel'] ?>" aria-label="<?= $linha['responsavel'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="email">E-mail</label>
                        <input id="email" name="email" class="form-control" type="mail" value="<?= $linha['email'] ?>" aria-label="<?= $linha['email'] ?>"disabled readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-2">
                      <label id="banco">Banco</label>
                      <input id="banco" name="banco" class="form-control" type="text" value="<?= $linha['banco'] ?>" aria-label="<?= $linha['banco'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="agencia">Agência</label>
                      <input id="agencia" name="agencia" class="form-control" type="text" value="<?= $linha['agencia'] ?>" aria-label="<?= $linha['agencia'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="conta">Conta</label>
                        <input id="conta" name="conta" class="form-control" type="text" value="<?= $linha['conta'] ?>" aria-label="<?= $linha['conta'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="tipo_conta">Tipo de Conta</label>
                        <input id="tipo_conta" name="tipo_conta" class="form-control" type="text" value="<?= $linha['tipo_conta'] ?>" aria-label="<?= $linha['tipo_conta'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="pix">PIX</label>
                        <input id="pix" name="pix" class="form-control" type="text" value="<?= $linha['pix'] ?>" aria-label="<?= $linha['pix'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="formaPagamento">Forma de Pagamento</label>
                        <input type="text" name="formaPagamento" id="formaPagamento" class="form-control" value="<?=$linha['forma_pagamento']?>"disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-1">
                      <label id="cep" for="cep">CEP</label>
                        <input id="cep" name="cep"  class="form-control" type="text" value="<?= $linha['cep'] ?>" aria-label="<?= $linha['cep'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="endereco" for="endereco">Endereço</label>
                        <input  id="rua" name="rua" class="form-control" type="text" value="<?= $linha['rua'] ?>" aria-label="<?= $linha['rua'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-1">
                      <label id="numero" for="numero">Número</label>
                        <input id="numero" name="numero" class="form-control" type="text" value="<?= $linha['numero'] ?>" aria-label="<?= $linha['numero'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-1">
                      <label id="complemento" for="complemento">Complemento</label>
                        <input id="complemento" name="complemento" class="form-control" type="text" value="<?= $linha['complemento'] ?>" aria-label="<?= $linha['complemento'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="bairro" for="bairro">Bairro</label>
                        <input id="bairro" name="bairro" class="form-control" type="text" value="<?= $linha['bairro'] ?>" aria-label="<?= $linha['bairro'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="cidade" for="cidade">Cidade</label>
                      <input id="cidade" name="cidade" class="form-control" type="text" value="<?= $linha['cidade'] ?>" aria-label="<?= $linha['cidade'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-2">
                      <label id="estado" for="estado">Estado</label>
                        <input id="estado" name="estado" class="form-control" type="text" value="<?= $linha['estado'] ?>" aria-label="<?= $linha['estado'] ?>"disabled readonly>
                    </div>
                  </div>

                  <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-md-3">
                      <label id="telefone_1">Telefone</label>
                      <input id="telefone_1" name="telefone_1" class="form-control" type="text" value="<?= $linha['telefone_1'] ?>" aria-label="<?= $linha['telefone_1'] ?>"disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label id="telefone_2">Celular</label>
                      <input id="telefone_2" name="telefone_2" class="form-control" type="text" value="<?= $linha['telefone_2'] ?>" aria-label="<?= $linha['telefone_2'] ?>"disabled readonly>
                    </div>
                  </div>

                  <div class="col-sm-12 text-center">
                    <a href="./ver-locacao.php?idlocacao=<?=$idLocacao?>" class="btn btn-danger">Voltar</a>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>