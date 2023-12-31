<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("../php/funcoes.php");
$conn = conectarAoBanco();

if ($_POST) { //Verifica se a nova senha e o código foram enviados.
    if ($_SESSION['codigo'] == $_POST['paramCodigo']) { //Verifica se o código enviado é igual ao código gerado.
        //Atualiza a senha do usuário no banco de dados.
        $update = $conn->prepare("UPDATE tbl_usuario SET senha = :novaSenha WHERE email = :email");
        $update->bindParam(':novaSenha', $_POST['novaSenha'], PDO::PARAM_STR);
        $update->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
        $update->execute();

        unset($update);
        unset($conn);
        unset($_SESSION['codigo']);

        //Aviso de mudança de senha.
        $html = "<h1>Olá!</h1><br><h3>Sua senha foi modificada, caso não reconheça essa mudança, por favor entre em contato</h3><br>";
        enviaEmail($_GET['email'], "Nome Usuário", "Alteração de senha", $html);

        header("Location: ec-login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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