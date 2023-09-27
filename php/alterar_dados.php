<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("funcoes.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = conectarAoBanco();

    $linha = [
        'nome'      => $_POST['nome'],
        'email'     => $_POST['email'],
        'senha'     => $_POST['senha'], // Se você pretende atualizar a senha, lembre-se de hash novamente
        'telefone'  => $_POST['telefone']
    ];

    // Use uma instrução SQL correta para a atualização
    $sql = "UPDATE tbl_usuario SET nome = :nome, email = :email, senha = :senha, telefone = :telefone WHERE id = :id";

    $update = $conn->prepare($sql);

    // Você precisa passar o ID do usuário que está sendo atualizado
    // Você pode obter o ID do usuário da sessão ou de algum outro lugar // Substitua 1 pelo ID correto

    $update->execute($linha);

    header('Location: ../html/perfil.php');
} else {
    echo "Form not submitted!";
}
?>
