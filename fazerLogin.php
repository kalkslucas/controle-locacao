<?php
include_once("conexao.php");
try {
  if(isset($_POST["usuario"]) && !empty($_POST["usuario"]) && isset($_POST["senha"]) && !empty($_POST["senha"])) {
    require 'conexao.php';
    require 'usuario.class.php';

    $user = new Usuario();

    $usuario = addslashes($_POST["usuario"]);
    $senha = addslashes($_POST["senha"]);

    if($user->login($usuario, $senha) == true) {
      if(isset($_SESSION['idusuario'])){
        header('Location: index.php');
      } else {
        header('Location: login.php');
      }
    } else {
      header("Location: login.php");
    }
  }  
} catch (PDOException $e) {
  echo 'Erro :' . $e->getMessage();
}


