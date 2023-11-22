<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("util.php");
$conn = conectarAoBanco();
if ($_POST) {
    if ($_SESSION['codigo'] == $_POST['paramCodigo']) {
        $select = $conn->prepare("SELECT nome FROM tbl_usuario WHERE email = :email");
        $select->bindParam(':email', $_GET['email']);
        $select->execute();
        $nome = $select->fetch()['nome'];
        $update = $conn->prepare("UPDATE tbl_usuario SET senha = :novaSenha WHERE email = :email");
        $update->bindParam(':novaSenha', $_POST['novaSenha']);
        $update->bindParam(':email', $_GET['email']);
        $update->execute();

        unset($update);
        unset($conn);
        unset($_SESSION['codigo']);



        $html = "<h1>Olá, $nome!</h1><br><h3>Sua senha foi modificada, caso não reconheça essa mudança, por favor entre em contato</h3><br>";

        enviaEmail($_GET['email'], "Usuário", "Mudança de senha", $html);

        header("Location: ec-login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Alterar Senha</title>
    <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
    <form action="" method="post" class="formulario" name="frmAlterarSenha">
        <h1>Mudança de senha</h1>
        <br>
        <div class="textfield">
            <input type="text" id="email" name="paramCodigo" placeholder="Código enviado por E-mail" required />
            <br><br><br>
        </div>
        <div class="textfield">
            <input type="text" id="senha" name="novaSenha" placeholder="Nova senha" required />
            <br><br><br>
        </div>
        <button type="submit" name="submit" value="Enviar" class="botoes">Enviar</button>
    </form>
</body>

</html>