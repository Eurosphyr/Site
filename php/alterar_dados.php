<?php

include "funcoes.php";
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();

    // Verifique se o usuário está autenticado
    if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
        // ID do usuário da sessão
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

        if ($userId !== null) {
            // Obtenha os novos dados do formulário
            $novoNome = $_POST['novo_nome'];
            $novoEmail = $_POST['novo_email'];
            $novoTelefone = $_POST['novo_telefone'];
            $novaSenha = $_POST['nova_senha'];
            $confirmarNovaSenha = $_POST['confirmar_nova_senha'];
            $novaRua = $_POST['nova_rua'];
            $novoNum = $_POST['novo_num'];
            $novoBairro = $_POST['novo_bairro'];
            $novaCidade = $_POST['nova_cidade'];
            $novoEstado = $_POST['novo_estado'];
            $novoTipo = $_POST['novo_tipo'];

            // Conecte-se ao banco de dados
            $conn = conectarAoBanco();

            if (!$conn) {
                echo "Falha na conexão com o banco de dados.";
                return;
            }

            // Atualize os dados do usuário no banco de dados
            $sql = "UPDATE tbl_usuario SET nome = :novoNome, email = :novoEmail, senha = :novaSenha, telefone = :novoTelefone, endereco_rua = :nova_rua, endereco_num = :novo_num, endereco_bairro = :novo_bairro, endereco_cidade = :nova_cidade, endereco_estado = :novo_estado, tipo_usuario = :novo_tipo   WHERE id_usuario = :userId";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':novoNome', $novoNome);
            $stmt->bindParam(':novoEmail', $novoEmail);
            $stmt->bindParam(':novaSenha', $novaSenha);
            $stmt->bindParam(':novoTelefone', $novoTelefone);
            $stmt->bindParam(':nova_rua', $novaRua);
            $stmt->bindParam(':novo_num', $novoNum);
            $stmt->bindParam(':novo_bairro', $novoBairro);
            $stmt->bindParam(':nova_cidade', $novaCidade);
            $stmt->bindParam(':novo_estado', $novoEstado);
            $stmt->bindParam(':novo_tipo', $novoTipo);
            $stmt->bindParam(':userId', $userId);

            if ($stmt->execute()) {
                echo "Dados atualizados com sucesso!";
                session_destroy();
                header('Location: ../html/ec-login.php');
                exit;
            } else {
                echo "Erro ao atualizar os dados.";
            }
        } else {
            echo "ID do usuário não encontrado.";
        }
    } else {
        header('Location: ../html/ec-login.php');
        exit;
    }
