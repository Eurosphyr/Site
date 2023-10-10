<?php
function adicionarRecursoParaUsuariosLogados()
{
    include "funcoes.php";
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();

    // Verifique se o usuário está autenticado
    if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
        // ID do usuário da sessão
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : null;
        $userEmail = isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : null;
        $userTelefone = isset($_SESSION['userTelefone']) ? $_SESSION['userTelefone'] : null;

        echo "
            <doctype html>
            <html lang='pt-br'>
            <head>
                <meta charset='utf-8'>
                <title>Alterar Dados</title>
            </head>
            <body>
            <div class='container'>
                <div class='cabecalho'>
                    <img class='logo' src='../img/Logos.svg' />
                    <a class='b' href='index.php'>HOME</a>
                    <a class='b' href='ec-sobre.php'>SOBRE</a>
                    <a class='b' href='ec-telacompra.php'>COMPRAR</a>
                    <a href='ec-carrinho.php'><img class='carrinho' src='../img/cart.png' /></a>
                    <a href='perfil.php'><img class='perfil' src='../img/user.png' /></a>
                </div>";
            
        // Verificar se as variáveis são definidas antes de usá-las
        if ($userId !== null && $userName !== null && $userEmail !== null && $userTelefone !== null) {
            echo "
            Nome: $userName<br>
            Email: $userEmail<br>
            Telefone: $userTelefone<br>
            ";

            // Formulário para atualizar informações
            echo "
            <form action='../php/alterar_dados.php' method='POST'>
                <input type='hidden' name='id_usuario' value='$userId'>
                <label for='nome'>Novo Nome:</label>
                <input type='text' id='nome' name='novo_nome' required><br>

                <label for='email'>Novo Email:</label>
                <input type='email' id='email' name='novo_email' required><br>

                <label for='telefone'>Novo Telefone:</label>
                <input type='tel' id='telefone' name='novo_telefone' required><br>

                <input type='submit' value='Atualizar Informações'>
                <input type='reset' value='Limpar'>
            </form>
            <form action='../php/funcoes.php' method='POST'>
                <input type='hidden' name='acao' value='logout'>
                <button type='submit'>Logout</button>
            </form>

            ";
        } else {
            echo "As informações do usuário não estão definidas na sessão.";
        }
    } else {
        header('Location: ../html/ec-login.php');
        exit;
    }
}
