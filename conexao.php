<?php

session_start();

global $conectar;

$dsn = 'mysql:host=localhost;dbname=controle_locacao;charset=utf8mb4';
$username = "root";
$password = "root";
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'];


try {
  //Conecta ao banco de dados
  $conectar = new PDO($dsn, $username, $password, $options);
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  //Caso ocorra erro de conexão com o banco, exibe essa mensagem
  echo 'Falha ao conectar ao banco de dados: ' . $e->getMessage();
}
