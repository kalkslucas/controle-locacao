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
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT lc.idlocacao, lc.ftc, g.nome as gestor, lc.situacao, DATE_FORMAT(inicio_locacao, '%d/%m/%Y') as inicio_locacao, DATE_FORMAT(termino_locacao,'%d/%m/%Y') as termino_locacao, l.nome as locador, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep, d.valor_mes
  from locacao lc
  inner join endereco e
  on lc.id_endereco = e.idendereco
  inner join gestor g
  on lc.id_gestor = g.idgestor
  inner join despesas d
  on d.id_locacao = lc.idlocacao
  inner join locador l
  on lc.id_locador = l.idlocador
  where idlocacao = '$idLocacao' and tipo_despesa = 'ALUGUEL'";
$consulta = $conectar->query($sql);
$linha = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<body class="page">
  <nav class="navbar navbar-expand-md bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="./assets/img/navbar-logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestão de Locação
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./controle-locacao.php">Início</a></li>
              <li><a class="dropdown-item" href="./visualizar-locacoes.php">Visualizar Locações</a></li>
              <li><a class="dropdown-item" href="./cadastrar-pessoa.php">Cadastro de Pessoas</a></li>
              <li><a class="dropdown-item" href="./cadastrar-locador.php">Cadastro de Locadores</a></li>
              <li><a class="dropdown-item" href="./cadastrar-locacao.php">Cadastro de Locações</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Em construção...</a>
          </li>
        </ul>
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
                <form action="editarLocacao.php" method="post">
                  <label id="idlocador">
                    Código Locação
                    <input type="text" id="idLocacao" name="idLocacao" value="<?= $linha['idlocacao'] ?>" aria-label="<?= $linha['idlocacao'] ?>" disabled readonly>
                  </label>
                  <table class="table table-borderless">
                    <tr>
                      <td>
                        <label id="ftc">
                          FTC
                          <input id="ftc" name="ftc" class="form-control" type="text" value="<?= $linha['ftc'] ?>" aria-label="<?= $linha['ftc'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="gestor" for="gestor">
                          Gestor
                          <input id="gestor" name="gestor" class="form-control" type="text" value="<?= $linha['gestor'] ?>" aria-label="<?= $linha['gestor'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="situacao" for="status">
                          Status
                          <input id="situacao" name="situacao" class="form-control" type="text" value="<?= $linha['situacao'] ?>" aria-label="<?= $linha['situacao'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="inicioLocacao" for="inicioLocacao">
                          Início da Locação
                          <input id="inicioLocacao" class="form-control" type="text" value="<?= $linha['inicio_locacao'] ?>" aria-label="<?= $linha['inicio_locacao'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="fimLocacao" for="fimLocacao">
                          Término da Locação
                          <input id="fimLocacao" class="form-control" type="text" value="<?= $linha['termino_locacao'] ?>" aria-label="<?= $linha['termino_locacao'] ?>">
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2">
                        <label style="width:100%;" id="endereco" for="endereco">
                          Locador
                          <input  id="locador" name="locador" class="form-control" type="text" value="<?= $linha['locador'] ?>" aria-label="<?= $linha['locador'] ?>">
                        </label>
                      </td>

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
                    </tr>
                  

                      

                    <tr>
                      <td>
                        <label id="complemento" for="complemento">
                          Complemento
                          <input id="complemento" name="complemento" class="form-control" type="text" value="<?= $linha['complemento'] ?>" aria-label="<?= $linha['complemento'] ?>">
                        </label>
                      </td>

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

                      <td>
                        <label id="cep" for="cep">
                          CEP
                          <input id="cep" name="cep"  class="form-control" type="text" value="<?= $linha['cep'] ?>" aria-label="<?= $linha['cep'] ?>">
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label id="valorAluguel" for="valorAluguel">
                        Valor do Aluguel
                          <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input id="valorAluguel" class="form-control" type="text" value="<?= $linha['valor_mes'] ?>" aria-label="<?= $linha['valor_mes'] ?>">
                          </div>
                        </label>
                      </td>

                      <td colspan="4" class="text-end">
                        <br>
                        <label style="width: 25%;" id="enviar">
                          <input class="form-control btn btn-success" type="submit" value="Confirmar Edição">
                        </label>
                      </td>
                    </tr>
                  </table>

                  <div class="btns">
                    
                  </div>
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