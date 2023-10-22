<?php

include '../php/funcoes.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = conectarAoBanco();

$email = "";
$senha = "";
$paramCodigo = "";
$codigo = "";

if (isset($_POST['codigo']) && isset($_POST['email'])) {
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
} else {
    header("Location: Esqueci.php");
    exit();
}

// Verifica se o código e a nova senha foram enviados.
if (isset($_POST['novaSenha']) && isset($_POST['paramCodigo'])) {
    $senha = $_POST['novaSenha'];
    $paramCodigo = $_POST['paramCodigo'];
} else {
    header("Location: ec_trocarsenha.php");
    exit();
}

// Atualiza a senha do usuário no banco de dados.
$update = $conn->prepare("UPDATE tbl_usuario SET senha = :novaSenha WHERE email = :email");
$update->bindParam(':novaSenha', $senha, PDO::PARAM_STR);
$update->bindParam(':email', $email, PDO::PARAM_STR);
$update->execute();

// Aviso de mudança de senha.
$html = "<h1>Olá!</h1><br><h3>Sua senha foi modificada, caso não reconheça essa mudança, 
por favor entre em contato conosco imediatamente.</h3><br>";
enviaEmail($email, "Mudança de senha", $html);
?>
