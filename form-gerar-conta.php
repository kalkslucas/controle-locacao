<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="assets/css/padrao-paginas.css">
  <link rel="stylesheet" href="assets/css/btn-custom.css">
  <link rel="stylesheet" href="./assets/css/gerar-conta.css">
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
                <h3 class="card-title text-center display-4">Cadastro de Conta</h3>
                <form action="gerarConta.php" method="post">
                  <div class="mt-1">
                    <label id="tipoConta" for="tipoConta">
                      Tipo de conta
                      <select class="form-select" name="tipoConta" id="tipoConta">
                        <option value="">---</option>
                        <option value="ATIVO">Energia</option>
                        <option value="ATIVO">Água</option>
                        <option value="ATIVO">Internet</option>
                        <option value="ATIVO">Condomínio</option>
                      </select>
                    </label>
  
                    <label id="empresa" for="empresa">
                      Empresa
                      <input id="empresa" name="empresa" class="form-control" type="text" placeholder="Digite o nome da empresa">
                    </label>
  
                    <label id="titular" for="titular">
                      Titular
                      <input id="titular" name="titular" class="form-control" type="text" placeholder="Digite o nome do titular da conta">
                    </label>
                    
                    <label id="numInstalacao" for="numInstalacao">
                      Número da Instalação
                      <input id="numInstalacao" name="numInstalacao" class="form-control" type="text" placeholder="Digite o n° da instalação">
                    </label>
                    
                    <label id="consumoVelocidade" for="consumoVelocidade">
                      Consumo/Velocidade
                      <input id="consumoVelocidade" name="consumoVelocidade" class="form-control" type="text" placeholder="Nome da Rua, Avenida, Travessa...">
                    </label>

                    <label id="valorConta" for="valorConta">
                      Valor da Conta
                      <input id="valorConta" name="valorConta" class="form-control" type="text" placeholder="Ex: 00 ou S/N">
                    </label>

                    <label id="dataVencimento" for="dataVencimento">
                      Data de Vencimento
                      <input id="dataVencimento" name="dataVencimento" class="form-control" type="text" placeholder="Casa, Bloco, Apto, Quadra, Lote...">
                    </label>

                    <label id="vincularLocacao" for="vincularLocacao">
                      Vincular a Locação
                      <select class="form-select" name="status" id="status">
                        <option value="">---</option>
                        <option value="ATIVO">Energia</option>
                        <option value="ATIVO">Água</option>
                        <option value="ATIVO">Internet</option>
                        <option value="ATIVO">Condomínio</option>
                      </select>
                    </label>

                    
                  </div>
                  

                  <label class="d-flex mt-3" id="enviarLocacao" for="enviarLocacao">
                    <input class="btn btn-laranja" type="submit" value="Cadastrar Conta">
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