<?php
class Usuario {
  public function login($usuario, $senha) {

    global $conectar;
    $query = "SELECT * FROM users WHERE usuario = :usuario AND senha = :senha";

    $query = $conectar->prepare($query);

    $query->bindValue(":usuario", $usuario);
    $query->bindValue(":senha", md5($senha));
    $query->execute();

    if($query->rowCount() == 1) {
      $dado = $query->fetch(PDO::FETCH_ASSOC);

      $_SESSION['idusuario'] = $dado['idusuario'];

      return true;
    } else {
      return false;
    }
  }

  public function logged($idUsuario) {
    global $conectar;

    $infoUser = array();
    $query = "SELECT nome, perfil FROM users WHERE idusuario = :idUsuario";
    $query = $conectar->prepare($query);
    $query->bindValue(":idUsuario", $idUsuario);
    $query->execute();

    if($query->rowCount() > 0) {
      $infoUser = $query->fetch(PDO::FETCH_ASSOC);
    }

    return $infoUser;
  }
}

