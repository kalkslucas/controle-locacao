<?php

require 'conexao.php';
if(isset($_SESSION['idusuario']) && !empty( $_SESSION['idusuario'] )){
  require_once 'usuario.class.php';
  $user = new Usuario();

  $listLogged = $user->logged($_SESSION['idusuario']);

  $nomeUser = $listLogged['nome'];
  $perfilUser = $listLogged['perfil'];
} else {
  header('Location: login.php');
}

