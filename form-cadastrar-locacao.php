<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="./assets/css/cadastrar-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestão de Locação
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./controle-locacao.php">Início</a></li>
              <li><a class="dropdown-item" href="./visualizar-locacoes.php">Visualizar Locações</a></li>
              <li><a class="dropdown-item" href="./cadastrar-pessoa.php">Cadastro de Pessoas</a></li>
              <li><a class="dropdown-item" href="./cadastrar-locador.php">Cadastro de Locadores</a></li>
              <li><a class="dropdown-item" href="./cadastrar-locacao.php">Cadastro de Locações</a></li>
              <li><a class="dropdown-item" href="./gerar-conta.php">Gerar conta</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Em construção...</a>
          </li>
        </ul>
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
                <form action="cadastrarLocacao.php" method="post">
                  <div class="mt-1">
                    <label id="ftc">
                      FTC
                      <input 
                        id="ftc"
                        name="ftc" 
                        class="form-control" 
                        type="text" 
                        placeholder="Ex: 00-00"
                      />
                    </label>

                    <label id="gestor">
                      Gestor
                      <select class="form-select" name="gestor" id="gestor">
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
                      Gestor
                      <select class="form-select" name="locador" id="locador">
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
                      <select class="form-select" name="situacao" id="situacao">
                        <option value="">Selecione o status</option>
                        <option value="ATIVO">Ativo</option>
                        <option value="ADITIVO">Aditivo</option>
                        <option value="PENDENTE">Pendente</option>
                        <option value="EM TRAMITAÇÃO">Em tramitação</option>
                        <option value="INATIVO">Inativo</option>
                      </select>
                    </label>

                    <label id="cepLocacao">
                      CEP
                      <input 
                        id="cep" 
                        name="cep" 
                        class="form-control" 
                        type="text" 
                        placeholder="Digite o CEP do Endereço"
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
                      />
                    </label>

                    <label id="bairroLocacao">
                      Bairro
                      <input 
                        id="bairro" 
                        name="bairro" 
                        class="form-control" 
                        type="text"
                      />
                    </label>

                    <label id="cidadeLocacao">
                    Cidade
                      <input
                        id="cidade"
                        name="cidade"
                        class="form-control"
                        type="text"
                      />
                    </label>

                    <label id="estadoLocacao">
                    Estado
                      <select class="form-select" id="uf" name="uf">
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
                      />
                    </label>
                    <!-- 
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
                        />
                      </div>
                    </label>
                    -->
                    <!--
                    <label id="imagensLocacao">
                      Adicionar Fotos de Vistoria
                      <input 
                        id="imagensLocacao" 
                        name="imagensLocacao" 
                        class="form-control" 
                        type="file" 
                        multiple
                      />
                    </label>

                    <label id="contratosLocacao">
                      Adicionar Contratos
                      <input 
                        id="contratosLocacao" 
                        name="contratosLocacao" 
                        class="form-control" 
                        type="file" 
                        multiple
                      />
                    </label>
                      -->
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

    <div class="row justify-content-end">
      <div class="col-lg-1 col-md-2 col-sm-12 mb-4">
        <a href="./visualizar-locacoes.html" class="text-center btn btn-danger btn-modal w-100">Voltar</a>
      </div>
    </div>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="assets/js/validarMoeda.js" defer></script>
</body>

</html>