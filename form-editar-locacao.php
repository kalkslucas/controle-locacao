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
$idLocacao = filter_var($_GET['idlocacao'], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT lc.idlocacao, lc.ftc, g.nome as gestor, lc.situacao, DATE_FORMAT(inicio_locacao, '%d/%m/%Y') as inicio_locacao, DATE_FORMAT(termino_locacao,'%d/%m/%Y') as termino_locacao, DATE_FORMAT(vistoria_entrada, '%d/%m/%Y') as vistoria_entrada, DATE_FORMAT(vistoria_saida, '%d/%m/%Y') as vistoria_saida, observacoes, l.nome as locador, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep
  from locacao lc
  inner join endereco e
  on lc.id_endereco = e.idendereco
  inner join gestor g
  on lc.id_gestor = g.idgestor
  inner join locador l
  on lc.id_locador = l.idlocador
  where idlocacao = '$idLocacao'";
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

  <header class="fixed text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none">Locações</a>
    <a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none">Locadores</a>
    <a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none">Gestores</a>
    <a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none">Alojados</a>
    <a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none">Despesas</a>
    <a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none">FSCs</a>
  </header>

  <main class="container-fluid">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body m-4 rounded shadow-lg">
                <h3 class="card-title text-center">Ficha da Locação</h3>
                <form action="editarLocacao.php?idlocacao=<?= $linha['idlocacao'] ?>" method="post">
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
                          <input id="inicioLocacao" name="inicioLocacao" class="form-control" type="text" value="<?= $linha['inicio_locacao'] ?>" aria-label="<?= $linha['inicio_locacao'] ?>">
                        </label>
                      </td>
                      <td>
                        <label id="fimLocacao" for="fimLocacao">
                          Término da Locação
                          <input id="fimLocacao" name="fimLocacao" class="form-control" type="text" value="<?= $linha['termino_locacao'] ?>" aria-label="<?= $linha['termino_locacao'] ?>">
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
                            <input id="valorAluguel" name="valorAluguel" class="form-control" type="text">
                          </div>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="5">
                        <label id="observacoes" class="d-block mt-1">
                        Observação
                        </label>
                        <textarea
                          id="observacoes" 
                          name="observacoes" 
                          class="mt-2 form-control"
                          rows="5"
                          >
                          <?php echo $linha['observacoes'] ?>
                        </textarea>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="5" class="text-end">
                        <br>
                        <label style="width: 25%;" id="enviar">
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