<?php

try {
  //Conecta ao banco de dados
  $conectar = new PDO("mysql:host=localhost;dbname=controle_locacao", "root", "root");
} catch (PDOException $e) {
  //Caso ocorra erro de conexão com o banco, exibe essa mensagem
  echo 'Falha ao conectar ao banco de dados: ' . $e->getMessage();
}
