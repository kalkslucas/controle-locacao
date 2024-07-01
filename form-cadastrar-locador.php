<?php 
require 'verificaUsuario.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )): 
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Controle de Locação - Cadastrar Locador</title>

    <link rel="stylesheet" href="assets/css/padrao-paginas.css" />
    <link rel="stylesheet" href="assets/css/btn-custom.css" />
    <link rel="stylesheet" href="./assets/css/cadastrar-locador.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <script src="assets/js/buscaCep.js"></script>
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

    <main class="container-fluid">
      <div class="row justify-content-center">
        <div class="col">
          <div class="card shadow-lg mt-3 mb-3">
            <div class="row">
              <div class="col-md-12">
                <div class="card-body">
                  <h3 class="card-title text-center display-4">
                    Cadastro de Locador
                  </h3>
                  <form action="cadastrarLocador.php" method="post">
                    <div class="row mb-3">
                      <div class="col-md-2">
                        <label id="nomeLocador" class="d-inline">Nome do Locador</label>
                          <input
                            id="nome"
                            name="nome"
                            class="form-control"
                            type="text"
                            placeholder="Digite o nome completo"
                            required
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="cpfCnpj" class="d-inline">CPF/CNPJ</label>
                          <input
                            id="cpfCnpj"
                            name="cpfCnpj"
                            class="form-control"
                            type="text"
                            placeholder="Digite somente os números"
                            required
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="email" class="d-inline">E-mail</label>
                          <input
                            id="email"
                            name="email"
                            class="form-control"
                            type="email"
                            placeholder="Ex: abc@ultra.eng.br OU abc@gmail.com"
                            required
                          />
                      </div>
                      <div class="col-md-2">
                        <label for="responsavel" class="d-inline">Nome do Responsável</label>
                        <input type="text" name="responsavel" id="responsavel" placeholder="Digite o nome do responsável" class="form-control">
                      </div>
                      <div class="col-md-2">
                        <label id="telefone1" class="d-inline">Telefone de Contato 1</label>
                          <input
                            id="telefone1"
                            name="telefone1"
                            class="form-control"
                            type="text"
                            placeholder="Ex: 3198765432"
                            required
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="telefone2" class="d-inline">Telefone de Contato 2</label>
                          <input
                            id="telefone2"
                            name="telefone2"
                            class="form-control"
                            type="text"
                            placeholder="Ex: 31987654321"
                          />
                      </div>
                    </div>
                      
                    <div class="row mb-3">
                      <div class="col-md-2">
                        <label id="cepLocador" class="d-inline">CEP</label>
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
                        <label id="enderecoLocador" class="d-inline">Endereço</label>
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
                        <label id="numEndLocador" class="d-inline">Numero</label>
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
                      <label id="compEndLocador" class="d-inline">Complemento</label>
                        <input
                          id="complemento"
                          name="complemento"
                          class="form-control"
                          type="text"
                          placeholder="Casa, Bloco, Apto, Quadra, Lote..."
                        />
                      </div>
                      <div class="col-md-2">
                        <label id="bairroLocador" class="d-inline">Bairro</label>
                          <input
                            id="bairro"
                            name="bairro"
                            class="form-control"
                            type="text"
                            required
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="cidadeLocador" class="d-inline">Cidade</label>
                          <input
                            id="cidade"
                            name="cidade"
                            class="form-control"
                            type="text"
                            required
                          />
                      </div>
                      <div class="col-md-1">
                        <label id="estadoLocador" class="d-inline">Estado</label>
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
                      <div class="col-md-2">
                        <label id="formaPagamento" class="d-inline">Forma de Pagamento</label>
                          <select name="formaPagamento" id="formaPagamento" class="form-select">
                            <option value="">Selecione a forma de pagamento</option>
                            <option value="BOLETO">BOLETO</option>
                            <option value="PIX">PIX</option>
                            <option value="TED">TED</option>
                          </select>
                      </div>
                      <div class="col-md-2">
                        <label id="bancoLocador" class="d-inline">Banco</label>
                          <input
                            id="banco"
                            name="banco"
                            class="form-control"
                            type="text"
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="numAgenciaLocador" class="d-inline">Agência</label>
                          <input
                            id="agencia"
                            name="agencia"
                            class="form-control"
                            type="text"
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="numContaBancoLocador" class="d-inline">Conta</label>
                          <input
                            id="conta"
                            name="conta"
                            class="form-control"
                            type="text"
                          />
                      </div>
                      <div class="col-md-2">
                        <label id="tipoContaBancoLocador" class="d-inline">Tipo da Conta</label>
                          <select class="form-select" name="tipoConta" id="tipoConta">
                            <option value="">Selecione o tipo de conta</option>
                            <option value="CONTA CORRENTE">Conta Corrente</option>
                            <option value="CONTA POUPANÇA">Conta Poupança</option>
                            <option value="CONTA DE PAGAMENTOS">
                              Conta de Pagamento
                            </option>
                          </select>
                      </div>
                      <div class="col-md-2">
                        <label id="pixContaBancoLocador" class="d-inline">PIX</label>
                          <input id="pix" name="pix" class="form-control" type="text"/>
                      </div>
                    </div>                    

                    <div class="row mb-3">
                      <div class="col text-center">
                        <input class="btn btn-laranja" type="submit" value="Cadastrar Locador"/>
                        <a href="./visualizar-locadores.php" class="text-center btn btn-danger">Voltar</a>
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

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>


<?php else: header('Location: login.php');endif;?>