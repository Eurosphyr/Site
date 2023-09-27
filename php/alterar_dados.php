<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("funcoes.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = conectarAoBanco();

    $linha = [
        'id_usuario'    => $_POST['id_usuario'], // Make sure you have an input field for the user's ID
        'nome'          => $_POST['nome'],
        'email'         => $_POST['email'],
        'senha'         => $_POST['senha'],
        'telefone'      => $_POST['telefone']
    ];

    
    $query = "UPDATE tbl_usuario SET nome = :nome, email = :email, senha = :senha, telefone = :telefone WHERE id_usuario = :id_usuario";

    $update = $conn->prepare($query);

    $update->execute($linha);

    header('Location: ../html/perfil.php');
} else {
    echo "Form not submitted!";
}
?>
