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

  <header class="fixed text-bg-secondary border-top border-bottom p-2 mb-3 d-flex flex-row justify-content-around">
    <a href="visualizar-locacoes.php" class="text-bg-secondary mt-auto text-decoration-none">Locações</a>
    <a href="visualizar-locadores.php" class="text-bg-secondary mt-auto text-decoration-none">Locadores</a>
    <a href="visualizar-gestores.php" class="text-bg-secondary mt-auto text-decoration-none">Gestores</a>
    <a href="visualizar-alojados.php" class="text-bg-secondary mt-auto text-decoration-none">Alojados</a>
    <a href="visualizar-despesas.php" class="text-bg-secondary mt-auto text-decoration-none">Despesas</a>
    <a href="visualizar-fsc.php" class="text-bg-secondary mt-auto text-decoration-none">FSCs</a>
  </header>

    <main class="container">
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
                    <div class="pb-1">
                      <label id="nomeLocador">
                        Nome do Locador
                        <input
                          id="nome"
                          name="nome"
                          class="form-control"
                          type="text"
                          placeholder="Digite o nome completo"
                          required
                        />
                      </label>

                      <label id="cpfCnpj">
                        CPF/CNPJ
                        <input
                          id="cpfCnpj"
                          name="cpfCnpj"
                          class="form-control"
                          type="text"
                          placeholder="Digite somente os números"
                          required
                        />
                      </label>

                      <label id="email">
                        E-mail
                        <input
                          id="email"
                          name="email"
                          class="form-control"
                          type="email"
                          placeholder="Ex: abc@ultra.eng.br OU abc@gmail.com"
                          required
                        />
                      </label>

                      <label id="telefone1">
                        Telefone Fixo
                        <input
                          id="telefone1"
                          name="telefone1"
                          class="form-control"
                          type="text"
                          placeholder="Ex: 3198765432"
                          required
                        />
                      </label>

                      <label id="telefone2">
                        Telefone Celular
                        <input
                          id="telefone2"
                          name="telefone2"
                          class="form-control"
                          type="text"
                          placeholder="Ex: 31987654321"
                          required
                        />
                      </label>

                      <label id="cepLocador">
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

                      <label id="enderecoLocador">
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

                      <label id="numEndLocador">
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

                      <label id="compEndLocador">
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

                      <label id="bairroLocador">
                        Bairro
                        <input
                          id="bairro"
                          name="bairro"
                          class="form-control"
                          type="text"
                          required
                        />
                      </label>

                      <label id="cidadeLocador">
                        Cidade
                        <input
                          id="cidade"
                          name="cidade"
                          class="form-control"
                          type="text"
                          required
                        />
                      </label>

                      <label id="estadoLocador">
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

                      <label id="bancoLocador">
                        Banco
                        <input
                          id="banco"
                          name="banco"
                          class="form-control"
                          type="text"
                          required
                        />
                      </label>
                      <label id="numAgenciaLocador">
                        Agência
                        <input
                          id="agencia"
                          name="agencia"
                          class="form-control"
                          type="text"
                          required
                        />
                      </label>
                      <label id="numContaBancoLocador">
                        Conta
                        <input
                          id="conta"
                          name="conta"
                          class="form-control"
                          type="text"
                          required
                        />
                      </label>
                      <label id="tipoContaBancoLocador">
                        Tipo da Conta
                        <select
                          class="form-select"
                          name="tipoConta"
                          id="tipoConta"
                          required
                        >
                          <option value="">--</option>
                          <option value="CONTA CORRENTE">Conta Corrente</option>
                          <option value="CONTA POUPANÇA">Conta Poupança</option>
                          <option value="CONTA DE PAGAMENTOS">
                            Conta de Pagamento
                          </option>
                        </select>
                      </label>
                      <label id="pixContaBancoLocador">
                        PIX
                        <input
                          id="pix"
                          name="pix"
                          class="form-control"
                          type="text"
                          required
                        />
                      </label>
                    </div>

                    <label class="d-flex mt-3" id="enviarLocacao">
                      <input
                        class="btn btn-laranja"
                        type="submit"
                        value="Cadastrar Locador"
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
          <a
            href="./visualizar-locadores.php"
            class="text-center btn btn-danger btn-modal w-100"
            >Voltar</a
          >
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