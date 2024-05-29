<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Locação - Inicio</title>

  <link rel="stylesheet" href="./assets/css/cadastrar-locacao.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="page">
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.html"><img src="./assets/img/navbar-logo.png" alt=""></a>
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
              <li><a class="dropdown-item" href="./controle-locacao.html">Início</a></li>
              <li><a class="dropdown-item" href="./visualizar-locacoes.html">Visualizar Locações</a></li>
              <li><a class="dropdown-item" href="./cadastrar-pessoa.html">Cadastro de Pessoas</a></li>
              <li><a class="dropdown-item" href="./cadastrar-endereco.html">Cadastro de Endereço</a></li>
              <li><a class="dropdown-item" href="./cadastrar-locacao.html">Cadastro de Locações</a></li>   
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
                <form action="post">
                  <h2 class="mb-3">Dados do Locador</h2>
                  <div class="border-bottom pb-1">
                    <label id="nomeLocador" for="nomeLocador">
                      Nome do Locador
                      <input id="nomeLocador" class="form-control" type="text" placeholder="Digite o nome completo">
                    </label>
  
                    <label id="cpfCnpj" for="cpfCnpj">
                      CPF/CNPJ
                      <input id="cpfCnpj" class="form-control" type="text" placeholder="Digite somente os números">
                    </label>
                    
                    <label id="emailLocador" for="emailLocador">
                      E-mail
                      <input id="emailLocador" class="form-control" type="email" placeholder="Ex: abc@ultra.eng.br OU abc@gmail.com">
                    </label>

                    <label id="telefone1" for="telefone1">
                      Telefone Fixo
                      <input id="telefone1" class="form-control" type="text" placeholder="Ex: 3198765432">
                    </label>
  
                    <label id="telefone2" for="telefone2">
                      Telefone Celular
                      <input id="telefone2" class="form-control" type="text" placeholder="Ex: 31987654321">
                    </label>

                    <label id="cepLocador" for="cepLocador">
                      CEP
                      <input id="cepLocador" name="cepLocador" class="form-control" type="text" placeholder="Digite o CEP do Endereço">
                    </label>
                    
                    <label id="enderecoLocador" for="enderecoLocador">
                      Endereço
                      <input id="enderecoLocador" name="enderecoLocador" class="form-control" type="text" placeholder="Nome da Rua, Avenida, Travessa...">
                    </label>
  
                    <label id="numEndLocador" for="numEndLocador">
                      Numero
                      <input id="numEndLocador" name="numEndLocador" class="form-control" type="text" placeholder="Ex: 00 ou S/N">
                    </label>
  
                    <label id="compEndLocador" for="compEndLocador">
                      Complemento
                      <input id="compEndLocador" name="compEndLocador" class="form-control" type="text" placeholder="Casa, Bloco, Apto, Quadra, Lote...">
                    </label>
  
                    <label id="bairroLocador" for="bairroLocador">
                      Bairro
                      <input id="bairroLocador" name="bairro" class="form-control" type="text">
                    </label>
  
                    <label id="cidadeLocador" for="cidadeLocador">
                      Cidade
                      <input id="cidadeLocador" name="cidadeLocador"  class="form-control" type="text">
                    </label>
  
                    <label id="estadoLocador" for="estadoLocador">
                      Estado
                      <select class="form-select" id="UF" name="UF">
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

                    <label id="bancoLocador" for="bancoLocador">
                      Banco
                      <input id="bancoLocador" name="bancoLocador" class="form-control" type="text">
                    </label>
                    <label id="numAgenciaLocador" for="numAgenciaLocador">
                      Agência
                      <input id="numAgenciaLocador" name="numAgenciaLocador" class="form-control" type="text">
                    </label>
                    <label id="numContaBancoLocador" for="numContaBancoLocador">
                      Conta
                      <input id="numContaBancoLocador" name="numContaBancoLocador" class="form-control" type="text">
                    </label>
                    <label id="tipoContaBancoLocador" for="tipoContaBancoLocador">
                      Tipo da Conta
                      <select class="form-select" name="tipoContaBancoLocador" id="tipoContaBancoLocador">
                        <option value="">--</option>
                        <option value="ATIVO">Conta Corrente</option>
                        <option value="ATIVO">Conta Poupança</option>
                        <option value="ATIVO">Conta de Pagamento</option>
                      </select>  
                    </label>
                    <label id="pixContaBancoLocador" for="pixContaBancoLocador">
                      PIX
                      <input id="pixContaBancoLocador" name="pixContaBancoLocador" class="form-control" type="text">
                    </label>
                  </div>

                  <h2 class="my-3">Dados do Imóvel</h2>
                  <div class="mt-1">
                    <label id="ftc" for="ftc">
                      FTC
                      <input id="ftc" class="form-control" type="text" placeholder="Ex: 00-00">
                    </label>
  
                    <label id="gestor" for="gestor">
                      Gestor
                      <input id="gestor" class="form-control" type="text" placeholder="Digite o nome completo">
                    </label>
  
                    <label id="status" for="status">
                      Status
                      <select class="form-select" name="status" id="status">
                        <option value="">--</option>
                        <option value="ATIVO">Ativo</option>
                        <option value="ATIVO">Aditivo</option>
                        <option value="ATIVO">Pendente</option>
                        <option value="ATIVO">Em tramitação</option>
                      </select>                    
                    </label>
                    
                    <label id="cepLocacao" for="cepLocacao">
                      CEP
                      <input id="cepLocacao" name="cepLocacao" class="form-control" type="text" placeholder="Digite o CEP do Endereço">
                    </label>
                    
                    <label id="enderecoLocacao" for="enderecoLocacao">
                      Endereço
                      <input id="enderecoLocacao" name="enderecoLocacao" class="form-control" type="text" placeholder="Nome da Rua, Avenida, Travessa...">
                    </label>

                    <label id="numEndLocacao" for="numEndLocacao">
                      Numero
                      <input id="numEndLocacao" name="numEndLocacao" class="form-control" type="text" placeholder="Ex: 00 ou S/N">
                    </label>

                    <label id="compEndLocacao" for="compEndLocacao">
                      Complemento
                      <input id="compEndLocacao" name="compEndLocacao" class="form-control" type="text" placeholder="Casa, Bloco, Apto, Quadra, Lote...">
                    </label>

                    <label id="bairroLocacao" for="bairroLocacao">
                      Bairro
                      <input id="bairroLocacao" name="bairroLocacao" class="form-control" type="text">
                    </label>

                    <label id="cidadeLocacao" for="cidadeLocacao">
                      Cidade
                      <input id="cidadeLocacao" name="cidadeLocacao" class="form-control" type="text">
                    </label>

                    <label id="estadoLocacao" for="estadoLocacao">
                      Estado
                      <select class="form-select" id="UF" name="UF">
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
  
                    <label id="inicioLocacao" for="inicioLocacao">
                      Início da Locação
                      <input id="inicioLocacao" class="form-control" type="date" placeholder="dd/mm/aaaa">
                    </label>
  
                    <label id="fimLocacao" for="fimLocacao">
                      Término da Locação
                      <input id="fimLocacao" class="form-control" type="date" placeholder="dd/mm/aaaa">
                    </label>
  
                    <label id="valorAluguel" for="valorAluguel">
                      Valor do Aluguel
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input id="valorAluguel" class="form-control" type="text"  aria-label="Valor do Aluguel">
                      </div>
                    </label>
  
                    <label id="imagensLocacao" for="imagensLocacao">
                      Adicionar Fotos de Vistoria
                      <input class="form-control" type="file" name="imagensLocacao" id="imagensLocacao" multiple>
                    </label>
  
                    <label id="contratosLocacao" for="contratosLocacao">
                      Adicionar Contratos
                      <input class="form-control" type="file" name="contratosLocacao" id="contratosLocacao" multiple>
                    </label>
                  </div>
                  

                  <label class="d-flex mt-3" id="enviarLocacao" for="enviarLocacao">
                    <input class="btn btn-laranja" type="submit" value="Cadastrar Locação">
                  </label>
                </form>

                <?php
                  include_once "conexao.php";
                  try {
                    $nome = filter_var($_POST['nome']);
                    $conta = filter_var($_POST['conta']);
                    $insert = $conectar->prepare("INSERT INTO login (nome, conta) VALUES(:nome, :conta)");
                    $insert->bindParam(':nome', $nome);
                    $insert->bindParam(':conta', $conta);
                    $insert->execute();
                    
                  } catch(PDOException $e){
                    echo 'Erro :' .$e->getMessage();
                  } finally {
                    echo '
                      <script language="javascript">
                        alert("Cadastro realizado")
                      </script>
                    ';
                  }
                ?>

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