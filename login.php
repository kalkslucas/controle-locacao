<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UltraEase</title>
  <!--Custom CSS and Bootstrap 5 CSS-->
  <link rel="stylesheet" href="assets/css/login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
  <main class="container-fluid">
    <div id="ultra-container">
      <img src="assets/img/logo-ease.svg" alt="ultra-img" class="ultra-img">
    </div>
    <div id="login-container">
      <div id="form-container">
        <form action="fazerLogin.php" method="POST">
          <label class="w-100 my-1" for="login">
            <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Login">
          </label>
          <label class="w-100 my-1" for="password">
            <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha">
          </label>
          <input class="mt-2 w-100 btn btn-danger" type="submit" value="Entrar">
        </form>
      </div>
    </div>
  </main>
</body>
</html>