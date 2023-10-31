<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include("../php/funcoes.php");
session_start();

//Verifica se email foi enviado.
if ($_POST) {
    $email = $_POST['email'];

    if (verificaEmail($email)) {
        $_SESSION['codigo'] = geraSenha();
        $html = "<h1>Olá!</h1><br><h3>Seu código de recuperação de senha é: " . $_SESSION['codigo'] . "</h3><br>";
        enviaEmail($email, "Usuário", "Código de recuperação de senha", $html);

        header("Location:ec-trocarsenha.php?email=$email");
        exit();
    } else {
        header("Location: ec-esqueci.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <meta charset="utf-8" />
    <title>Esqueci a senha</title>
    <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
    <form action="" method="post" class="formulario" name="frmEsqueci">
        <h1>Insira seu email:</h1>
        <br />

        <div class="textfield">
            <input type="email" name="email" placeholder="Email"  required>
            <br />
        </div>

        <button type="submit" name="submit" value="Enviar" class="botoes">Enviar</button>
    </form>
</body>

</html>