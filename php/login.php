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
            echo "
<div class='formulario'>
    <form action='../php/alterar_dados.php' method='POST'>
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
        } else {
            echo "As informações do usuário não estão definidas na sessão.";
        }
    } else {
        header('Location: ../html/ec-login.php');
        exit;
    }
}
