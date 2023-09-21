<?php

$host = "pgsql.projetoscti.com.br";
$port = "5432";
$dbname = "tbl_aluno";
$user = "seu_usuario";
$password = "sua_senha";

try {
  $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Error connecting to the database: " . $e->getMessage();
  exit;
}

function conectarAoBanco()
{
  global $conn;
  return $conn;
}

function consultarDados()
{
  $conn = conectarAoBanco();

  $query = "SELECT * FROM sua_tabela";
  $result = $conn->query($query);

  if (!$result) {
    echo "Error in SQL query.";
    exit;
  }

  return $result;
}
