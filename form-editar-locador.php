<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="assets/css/ver-locador.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<?php
include_once "conexao.php";
$idLocador = filter_var($_GET['idlocador'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT idlocador, nome, cpf_cnpj, email, banco, agencia, conta, tipo_conta, pix, telefone_1, telefone_2, rua, numero, complemento, bairro, cidade, estado, cep
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
      </div>
      <div class="user d-flex text-center">
        <label class="infoUser border d-flex flex-column align-items-center">
          <p class=""> <?= $nomeUser; ?></p>
          <p class=""> <?= $perfilUser; ?></p>
        </label>
        <a class="btn btn-outline-danger" href="logout.php">Sair</a>
      </div>
    </div>
  </nav>

  <main class="container-fluid">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card mt-3 mb-3">
          <div class="row">
            <div class="col-md-4">
              <div class="img-container">
                <img src="./assets/img/imovel-1.jpg" class="img-fluid" alt="imagem principal da locação">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-laranja btn-modal" data-bs-toggle="modal" data-bs-target="#modalFotos">
                  Ver fotos da locação
                </button>

                <!-- Modal -->
                <div class="modal fade modal-xl" id="modalFotos" tabindex="-1" aria-labelledby="modalFotos" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <img class="img-fluid mb-2" src="./assets/img/imovel-modal-1.jpg" alt="">
                        <img class="img-fluid mb-2" src="./assets/img/imovel-modal-2.jpg" alt="">
                        <img class="img-fluid mb-2" src="./assets/img/imovel-modal-3.jpg" alt="">
                        <img class="img-fluid mb-2" src="./assets/img/imovel-modal-4.jpg" alt="">
                        <img class="img-fluid mb-2" src="./assets/img/imovel-modal-5.jpg" alt="">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body m-4 rounded shadow-lg">
                <h3 class="card-title text-center">Ficha da Locação</h3>
                <form action="editarLocador.php?idlocador=<?= $linha['idlocador']?>" method="post">
                  <table class="table table-borderless">
                    <tr>
                      <td>
                        <label id="cpf_cnpj">
                          CPF | CNPJ
                          <input id="cpf_cnpj" name="cpf_cnpj" class="form-control" type="text" value="<?= $linha['cpf_cnpj'] ?>" aria-label="<?= $linha['cpf_cnpj'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="nome">
                          Nome
                          <input id="nome" name="nome" class="form-control" type="text" value="<?= $linha['nome'] ?>" aria-label="<?= $linha['nome'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="email">
                          E-mail
                          <input id="email" name="email" class="form-control" type="mail" value="<?= $linha['email'] ?>" aria-label="<?= $linha['email'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="banco">
                          Banco
                          <input id="banco" name="banco" class="form-control" type="text" value="<?= $linha['banco'] ?>" aria-label="<?= $linha['banco'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="agencia">
                          Agência
                          <input id="agencia" name="agencia" class="form-control" type="text" value="<?= $linha['agencia'] ?>" aria-label="<?= $linha['agencia'] ?>">
                        </label>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>
                        <label id="conta">
                          Conta
                          <input id="conta" name="conta" class="form-control" type="text" value="<?= $linha['conta'] ?>" aria-label="<?= $linha['conta'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="tipo_conta">
                          Tipo de Conta
                          <input id="tipo_conta" name="tipo_conta" class="form-control" type="text" value="<?= $linha['tipo_conta'] ?>" aria-label="<?= $linha['tipo_conta'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="pix">
                          PIX
                          <input id="pix" name="pix" class="form-control" type="text" value="<?= $linha['pix'] ?>" aria-label="<?= $linha['pix'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="telefone_1">
                          Telefone
                          <input id="telefone_1" name="telefone_1" class="form-control" type="text" value="<?= $linha['telefone_1'] ?>" aria-label="<?= $linha['telefone_1'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="telefone_2">
                          Celular
                          <input id="telefone_2" name="telefone_2" class="form-control" type="text" value="<?= $linha['telefone_2'] ?>" aria-label="<?= $linha['telefone_2'] ?>">
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2">
                        <label style="width:100%;" id="endereco" for="endereco">
                          Endereço
                          <input  id="rua" name="rua" class="form-control" type="text" value="<?= $linha['rua'] ?>" aria-label="<?= $linha['rua'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="numero" for="numero">
                          Numero
                          <input id="numero" name="numero" class="form-control" type="text" value="<?= $linha['numero'] ?>" aria-label="<?= $linha['numero'] ?>">
                        </label>
                      </td>

                      <td>
                        <label id="complemento" for="complemento">
                          Complemento
                          <input id="complemento" name="complemento" class="form-control" type="text" value="<?= $linha['complemento'] ?>" aria-label="<?= $linha['complemento'] ?>">
                        </label>
                      </td>

                      <td>
                        <label id="cep" for="cep">
                          CEP
                          <input id="cep" name="cep"  class="form-control" type="text" value="<?= $linha['cep'] ?>" aria-label="<?= $linha['cep'] ?>">
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label id="bairro" for="bairro">
                          Bairro
                          <input id="bairro" name="bairro" class="form-control" type="text" value="<?= $linha['bairro'] ?>" aria-label="<?= $linha['bairro'] ?>">
                        </label>
                      </td>
                      
                      <td>
                        <label id="cidade" for="cidade">
                          Cidade
                          <input id="cidade" name="cidade" class="form-control" type="text" value="<?= $linha['cidade'] ?>" aria-label="<?= $linha['cidade'] ?>">
                        </label>
                      </td>

                      <td>
                        <label id="estado" for="estado">
                          Estado
                          <input id="estado" name="estado" class="form-control" type="text" value="<?= $linha['estado'] ?>" aria-label="<?= $linha['estado'] ?>">
                        </label>
                      </td>

                      <td colspan="2">
                        <br>
                        <label style="width: 100%;" id="enviar">
                          <input class="form-control btn btn-success" type="submit" value="Confirmar Edição">
                        </label>
                      </td>  
                    </tr>
                  </table>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-end">
      <div class="col-md-1 col-sm-12 mb-4">
        <a href="./visualizar-locacoes.php" class="btn btn-danger btn-modal w-100">Voltar</a>
      </div>
    </div>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>