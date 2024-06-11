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
  <link rel="stylesheet" href="assets/css/cadastrar-pessoa.css">
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

  <main class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow-lg mt-3 mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="card-title text-center display-4">Cadastro de Pessoas</h3>
                <form action="cadastrarPessoa.php" method="post">
                  <label id="tipoPessoa">
                    Classificação da Pessoa
                    <select class="form-select" name="tipoPessoa" id="tipoPessoa">
                      <option selected>---</option>
                      <option value="alojado">Alojado</option>
                      <option value="gestor">Gestor</option>
                    </select>
                  </label>

                  <label id="nomePessoa">
                    Nome
                    <input id="nome" name="nome" class="form-control" type="text" placeholder="Digite o nome completo">
                  </label>
                  
                  <label id="email">
                    E-mail
                    <input id="email" name="email" class="form-control" type="email" placeholder="Ex: abc@ultra.eng.br OU abc@gmail.com">
                  </label>

                  <label id="telefone1">
                    Telefone 1
                    <input id="telefone1" name="telefone1" class="form-control" type="text" placeholder="Ex: 3198765432">
                  </label>

                  <label id="telefone2">
                    Telefone 2
                    <input id="telefone2" name="telefone2" class="form-control" type="text" placeholder="Ex: 31987654321">
                  </label>

                  <label id="cargo">
                    Cargo
                    <input id="cargo" name="cargo" class="form-control" type="text" placeholder="Ex: Gerente Administrativo">
                  </label>

                  <label id="setor">
                    Setor
                    <input id="setor" name="setor" class="form-control" type="text" placeholder="Ex: Obras">
                  </label>

                  <label id="unidade">
                    Unidade
                    <input id="unidade" name="unidade" class="form-control" type="text" placeholder="Ex: Sede">
                  </label>

                  <label class="d-flex mt-3" id="enviar">
                    <input class="btn btn-laranja" type="submit" value="Cadastrar Pessoa">
                  </label>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-md-1 col-sm-12 mb-4">
        <a href="./visualizar-locacoes.html" class="btn btn-danger btn-modal w-auto">Voltar</a>
      </div>
    </div>
  </main>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php else: header('Location: login.php');endif;?>