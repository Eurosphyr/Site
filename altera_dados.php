<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conexao.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $conn = conectarAoBanco();

  $linha = [
    'nome'      => $_POST['nome'],
    'email'     => $_POST['email'],
    'telefone'  => $_POST['telefone'],
    'endereco'  => $_POST['endereco']
  ];

  $sql = "INSERT INTO aluno (nome, email, telefone, endereco)  
            VALUES (:nome, :email, :telefone, :endereco)";

  $update = $conn->prepare($sql);


  $update->execute($linha);


  header('Location: index.php');
} else {

  echo "Form not submitted!";
}
