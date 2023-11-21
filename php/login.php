<?php
function adicionarRecursoParaUsuariosLogados()
{
    include "funcoes.php";
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();
    exibirConteudoComBaseNoPapel();

    // Verifique se o usuário está autenticado
    if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
        // ID do usuário da sessão
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : null;
        $userEmail = isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : null;
        $userTelefone = isset($_SESSION['userTelefone']) ? $_SESSION['userTelefone'] : null;

        // Verificar se as variáveis são definidas antes de usá-las
        if ($userId !== null && $userName !== null && $userEmail !== null && $userTelefone !== null) {
            echo "<div class='informacao-usuario nome-usuario'>Nome: $userName</div>";
            echo "<div class='informacao-usuario email-usuario'>Email: $userEmail</div>";
            echo "<div class='informacao-usuario telefone-usuario'>Telefone: $userTelefone</div>";

            // Formulário para atualizar informações
            echo "<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <title>Perfil</title>
    <link rel='stylesheet' href='../css/rodape.css'>
    <link rel='stylesheet' href='../css/cabecalho.css'>
    <link rel='icon' href='../img/Logos.svg'>
</head>
<body>
<a id='topo'></a>
<div class='formulario'>
    <form action='../php/alterar_dados_usuarios.php' method='POST'>
        <input type='hidden' name='id_usuario' value='$userId'>
        <div class='campo'>
            <label for='nome'>Novo Nome:</label>
            <input type='text' id='nome' name='novo_nome' required>
        </div>

        <div class='campo'>
            <label for 'email'>Novo Email:</label>
            <input type='email' id='email' name='novo_email' required>
        </div>

        <div class='campo'>
            <label for='telefone'>Novo Telefone:</label>
            <input type='tel' id='telefone' name='novo_telefone' required>
        </div>

        <div class='botoes'>
            <input type='submit' value='Atualizar Informações'><br><br>
            <input type='reset' value='Limpar'>
        </div>
    </form>
</div>

<div class='logout-form'>
    <form action='../php/funcoes.php' method='POST'>
        <input type='hidden' name='acao' value='logout'>
        <button type='submit'>Logout</button>
    </form>
</div>
";
            echo '<div class="rodape">
<div class="most">
    <div class="redes">
        <img src="../img/Mipron.png" alt="Logo MIPRON">
        <span class="background">
            <span class="social-media-buttons">
                <span class="social-media-button">
                    <a href="https://www.instagram.com/mipron_startup/"><img src="../img/instagram.png" alt="Instagram"></a>
                </span>
            </span>
        </span>
    </div>
    <div class="mebros">
        <p class="desen">Desenvolvedores</p>
        <div class="traco1"></div>
        <p class="p">Miguel Angelo de Lima Godoi - Gerente Financeiro / Email: miguel.godoi@unesp.br</p>
        <p class="p">Mizael Martins Barreto - Gerente de Marketing / Email: mizael.martins@unesp.br</p>
        <p class="p">Nicole dos Santos Quadros - Gerente de Qualidade / Email: n.quadros@unesp.br</p>
        <p class="p">Pedro Augusto de Oliveira Galdino Ribeiro - Líder / Email: paog.ribeiro@unesp.br</p>
        <p class="p">Richard Walace de Oliveira Camargo - Líder Técnico e Gerente de Produção / Email: rwo.camargo@unesp.br</p>
    </div>
</div>
<div class="menu">
    <p class="menuT">Menu</p>
    <div class="menud">
        <a href="index.php">
            <p class="vt">Home</p>
        </a>
        <a href="ec-sobre.php">
            <p class="vt">Sobre</p>
        </a>
        <a href="ec-telaproduto.php">
            <p class="vt">Comprar</p>
        </a>
        <a href="#topo"><img width="100" src="../img/seta_cima.png"></a>
    </div>
</div>
</div>'
            ;
            echo "</body></html>";
        } else {
            echo "As informações do usuário não estão definidas na sessão.";
        }
    } else {
        header('Location: ../html/ec-login.php');
        exit;
    }
}
