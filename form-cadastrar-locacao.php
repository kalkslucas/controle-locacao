<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Cadastrar Locação</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="./assets/css/cadastrar-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="./assets/js/buscaCep.js"></script>

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
        <div class="col"><a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">Cotações</a></div>
        <div class="col"><a href="visualizar-ftc.php" class="text-bg-secondary mt-auto text-decoration-none text-center d-block p-2">FTCs</a></div>
      </div>
    </div>
  </header>

  <main class="container-fluid px-5">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow-lg mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="card-title text-center display-4">Cadastro de Locação</h3>
                <form action="cadastrarLocacao.php" enctype="multipart/form-data" method="post">
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label id="gestor" class="d-inline">Gestor</label>
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
                      </div>
                      <div class="col-md-3">
                        <label id="locador" class="d-inline">Locador</label>
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
                      </div>
                      <div class="col-md-2">
                        <label id="status" class="d-inline">Status</label>
                        <select class="form-select" name="situacao" id="situacao" required>
                          <option value="">Selecione o status</option>
                          <option value="ATIVO">ATIVO</option>
                          <option value="ADITIVO">ADITIVO</option>
                          <option value="PENDENTE">PENDENTE</option>
                          <option value="EM TRAMITAÇÃO">EM TRAMITAÇÃO</option>
                          <option value="INATIVO">INATIVO</option>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label id="centroCusto" class="d-inline">Centro de Custo</label>
                        <select id="centroCusto" name="centroCusto" class="form-select" required>
                          <option value="">Selecione um centro de custo</option>
                          <?php
                            $queryCC = "SELECT idcentrocusto, nome FROM centro_custo";
                            $consultaCC = $conectar->query($queryCC);
                            while($linhaCC = $consultaCC->fetch(PDO::FETCH_ASSOC)){
                              echo "<option value='$linhaCC[idcentrocusto]'>$linhaCC[nome]</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label id="vistoriaEntrada" class="d-inline">Vistoria de Entrada</label>
                        <input 
                          id="vistoriaEntrada" 
                          name="vistoriaEntrada" 
                          class="form-control" 
                          type="date" 
                        />
                      </div>
                      <div class="col-md-3">
                        <label id="vistoriaSaida" class="d-inline">Vistoria de Saída</label>
                        <input 
                          id="vistoriaSaida" 
                          name="vistoriaSaida" 
                          class="form-control" 
                          type="date" 
                        />
                      </div>
                      <div class="col-md-3">
                        <label id="inicioLocacao" class="d-inline">Início da Locação</label>
                        <input 
                          id="inicioLocacao" 
                          name="inicioLocacao" 
                          class="form-control" 
                          type="date" 
                          required
                        />
                      </div>
                      <div class="col-md-3">
                        <label id="fimLocacao" class="d-inline">Término da Locação</label>
                        <input 
                          id="fimLocacao" 
                          name="fimLocacao" 
                          class="form-control" 
                          type="date" 
                          required
                        />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-2">
                        <label id="cepLocacao">CEP</label>
                        <input 
                          id="cep" 
                          name="cep" 
                          class="form-control" 
                          type="text" 
                          placeholder="Digite o CEP do Endereço"
                          size="10" 
                          maxlength="9"
                          onblur="pesquisacep(this.value);"
                          required
                        />
                      </div>
                      <div class="col-md-3">
                        <label id="enderecoLocacao">Endereço</label>
                        <input 
                          id="rua" 
                          name="rua" 
                          class="form-control" 
                          type="text" 
                          placeholder="Nome da Rua, Avenida, Travessa..."
                          required
                        />
                      </div>
                      <div class="col-md-1">
                        <label id="numEndLocacao" class="d-inline">Numero</label>
                        <input 
                          id="numero" 
                          name="numero" 
                          class="form-control" 
                          type="text" 
                          placeholder="Ex: 00 ou S/N"
                          required
                        />
                      </div>
                      <div class="col-md-1">
                        <label id="compEndLocacao" class="d-inline">Complemento</label>
                        <input 
                          id="complemento" 
                          name="complemento" 
                          class="form-control" 
                          type="text" 
                          placeholder="Casa, Bloco, Apto, Quadra, Lote..."
                          required
                        />
                      </div>
                      <div class="col-md-2">
                        <label id="bairroLocacao">Bairro</label>
                        <input 
                          id="bairro" 
                          name="bairro" 
                          class="form-control" 
                          type="text"
                          required
                        />
                      </div>
                      <div class="col-md-2">
                        <label id="cidadeLocacao">Cidade</label>
                        <input
                          id="cidade"
                          name="cidade"
                          class="form-control"
                          type="text"
                          required
                        />
                      </div>
                      <div class="col-md-1">
                        <label id="estadoLocacao" class="d-inline">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
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
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col">
                        <label id="observacoes" class="d-inline mt-1">Observações</label>
                        <textarea
                          id="observacoes" 
                          name="observacoes" 
                          class="mt-2 form-control"
                          rows="5"
                          required 
                          >
                        </textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-1">
                        <label for="qtd_quartos" class="d-inline">Quantidade de Quartos</label>
                        <input type="number" name="qtd_quartos" id="qtd_quartos" class="form-control" required>
                      </div>
                      <div class="col-md-1">
                        <label for="qtd_banheiros" class="d-inline">Quantidade de Banheiros</label>
                        <input type="number" name="qtd_banheiros" id="qtd_banheiros" class="form-control" required>
                      </div>
                      <div class="col-md-1">
                        <label for="qtd_vagas_garagem" class="d-inline">Vagas de Garagem</label>
                        <input type="number" name="qtd_vagas_garagem" id="qtd_vagas_garagem" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label id="valorAluguel">Valor do Aluguel</label>
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
                      </div>
                      <div class="col-md-3">
                        <label id="imagensLocacao" class="d-inline">Adicionar Fotos e Documentos</label>
                        <input 
                          id="anexo_foto_docs" 
                          name="anexo_foto_docs[]" 
                          class="form-control" 
                          type="file" 
                          multiple
                        />
                      </div>
                    </div>

                  <div class="row mb-3">
                    <div class="col text-center">
                    <a href="./visualizar-locacoes.php" class="text-center btn btn-danger">Voltar</a>
                      <input 
                        class="btn btn-laranja" 
                        type="submit" 
                        value="Cadastrar Locação"
                      />
                    </div>
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