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
  <link rel="stylesheet" href="./assets/css/cadastrar-locacao.css">
  <link href="./assets/css/bootstrap.min.css">
</head>

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
        <label class="infoUser border rounded d-flex flex-column align-items-center">
          <p class=""> <?= $nomeUser; ?></p>
          <p class=""> <?= $perfilUser; ?></p>
        </label>
        <a class="btn btn-danger m-auto mx-2" href="logout.php">Sair</a>
      </div>
    </div>
  </nav>

  <main class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow-lg mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="card-title text-center display-4">Cadastro de Locação</h3>
                <form action="cadastrarLocacao.php" enctype="multipart/form-data" method="post">
                  <div class="mt-1">
                    <label id="ftc">
                      FTC
                      <input 
                        id="ftc"
                        name="ftc" 
                        class="form-control" 
                        type="text" 
                        placeholder="Ex: 00-00"
                        required
                      />
                    </label>

                    <label id="gestor">
                      Gestor
                      <select class="form-select" name="gestor" id="gestor" required>
                        <option value="">Selecione o gestor</option>
                        <?php
                        include_once 'conexao.php';
                        try {
                          $query = "SELECT idgestor, nome FROM gestor";
                          $consulta = $conectar->query($query);

                          while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='$linha[idgestor]'>$linha[nome]</option>";
                          }
                        } catch (PDOException $e) {
                          echo 'Error: ' . $e->getMessage();
                        }
                        ?>
                      </select>
                    </label>

                    <label id="locador">
                      Locador
                      <select class="form-select" name="locador" id="locador" required>
                        <option value="">Selecione o locador</option>
                        <?php
                        include_once 'conexao.php';
                        try {
                          $query = "SELECT idlocador, nome FROM locador";
                          $consulta = $conectar->query($query);

                          while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='$linha[idlocador]'>$linha[nome]</option>";
                          }
                        } catch (PDOException $e) {
                          echo 'Error: ' . $e->getMessage();
                        }
                        ?>
                      </select>
                    </label>

                    <label id="status">
                      Status
                      <select class="form-select" name="situacao" id="situacao" required>
                        <option value="">Selecione o status</option>
                        <option value="ATIVO">Ativo</option>
                        <option value="ADITIVO">Aditivo</option>
                        <option value="PENDENTE">Pendente</option>
                        <option value="EM TRAMITAÇÃO">Em tramitação</option>
                        <option value="INATIVO">Inativo</option>
                      </select>
                    </label>

                    <label id="vistoriaEntrada">
                      Vistoria de Entrada
                      <input 
                        id="vistoriaEntrada" 
                        name="vistoriaEntrada" 
                        class="form-control" 
                        type="date" 
                        placeholder="dd/mm/aaaa"
                        required
                      />
                    </label>

                    <label id="vistoriaSaida">
                      Vistoria de Saída
                      <input 
                        id="vistoriaSaida" 
                        name="vistoriaSaida" 
                        class="form-control" 
                        type="date" 
                        placeholder="dd/mm/aaaa"
                        required
                      />
                    </label>

                    <label id="centroCusto">
                      Centro de Custo
                      <input 
                        id="centroCusto"
                        name="centroCusto" 
                        class="form-control" 
                        type="text" 
                        placeholder="Ex: 00-00"
                        required
                      />
                    </label>

                    <label id="cepLocacao">
                      CEP
                      <input 
                        id="cep" 
                        name="cep" 
                        class="form-control" 
                        type="text" 
                        placeholder="Digite o CEP do Endereço"
                        required
                      />
                    </label>

                    <label id="enderecoLocacao">
                      Endereço
                      <input 
                        id="rua" 
                        name="rua" 
                        class="form-control" 
                        type="text" 
                        placeholder="Nome da Rua, Avenida, Travessa..."
                        required
                      />
                    </label>

                    <label id="numEndLocacao">
                      Numero
                      <input 
                        id="numero" 
                        name="numero" 
                        class="form-control" 
                        type="text" 
                        placeholder="Ex: 00 ou S/N"
                        required
                      />
                    </label>

                    <label id="compEndLocacao">
                      Complemento
                      <input 
                        id="complemento" 
                        name="complemento" 
                        class="form-control" 
                        type="text" 
                        placeholder="Casa, Bloco, Apto, Quadra, Lote..."
                        required
                      />
                    </label>

                    <label id="bairroLocacao">
                      Bairro
                      <input 
                        id="bairro" 
                        name="bairro" 
                        class="form-control" 
                        type="text"
                        required
                      />
                    </label>

                    <label id="cidadeLocacao">
                    Cidade
                      <input
                        id="cidade"
                        name="cidade"
                        class="form-control"
                        type="text"
                        required
                      />
                    </label>

                    <label id="estadoLocacao">
                    Estado
                      <select class="form-select" id="uf" name="uf" required>
                        <option value="">--</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MG">MG</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="PR">PR</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="RS">RS</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                      </select>
                    </label>

                    <label id="inicioLocacao">
                      Início da Locação
                      <input 
                        id="inicioLocacao" 
                        name="inicioLocacao" 
                        class="form-control" 
                        type="date" 
                        placeholder="dd/mm/aaaa"
                        required
                      />
                    </label>

                    <label id="fimLocacao">
                      Término da Locação
                      <input 
                        id="terminoLocacao" 
                        name="terminoLocacao" 
                        class="form-control" 
                        type="date" 
                        placeholder="dd/mm/aaaa"
                        required
                      />
                    </label>

                    <label id="observacoes" class="d-block mt-1">
                      Observações
                    </label>
                    <textarea
                      id="observacoes" 
                      name="observacoes" 
                      class="mt-2 form-control"
                      rows="5"
                      required 
                      >
                    </textarea>

                    <label id="valorAluguel">
                      Valor do Aluguel
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input 
                          id="valorAluguel" 
                          name="valorAluguel" 
                          class="form-control" 
                          type="text" 
                          aria-label="Valor do Aluguel"
                          required
                        />
                      </div>
                    </label>
                    <label id="imagensLocacao">
                      Adicionar Fotos e Documentos
                      <input 
                        id="anexo_foto_docs" 
                        name="anexo_foto_docs[]" 
                        class="form-control" 
                        type="file" 
                        multiple
                      />
                    </label>
                  </div>

                  <label class="d-flex mt-3" id="enviarLocacao" for="enviarLocacao">
                    <input 
                      class="btn btn-laranja" 
                      type="submit" 
                      value="Cadastrar Locação"
                    />
                  </label>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   
    <!-- Modal -->
    <!-- Modal de Confirmação -->
    <div class="modal fade" id="msgCadastroRealizado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro Concluído!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            O cadastro foi realizado com sucesso.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <a href="visualizar-locacoes.php" class="btn btn-primary">Ver Locações</a>
          </div>
        </div>
      </div>
    </div>


    <div class="row justify-content-end">
      <div class="col-lg-1 col-md-2 col-sm-12 mb-4">
        <a href="./visualizar-locacoes.php" class="text-center btn btn-danger btn-modal w-100">Voltar</a>
      </div>
    </div>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="assets/js/validarMoeda.js" defer></script>
</body>

</html>

<?php else: header('Location: login.php');endif;?>