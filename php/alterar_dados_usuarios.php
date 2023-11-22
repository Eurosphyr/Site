<?php
include "funcoes.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {

    $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

    if ($userId !== null) {
        try {
            
            $userId = !empty($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
            $novoNome = $_POST['novo_nome'];
            $novoEmail = $_POST['novo_email'];
            $novoTelefone = $_POST['novo_telefone'];

            
            $conn = conectarAoBanco();

            if (!$conn) {
                throw new Exception("Falha na conexão com o banco de dados.");
            }

            
            $sql = "UPDATE tbl_usuario SET nome = :novoNome, email = :novoEmail, telefone = :novoTelefone WHERE id_usuario = :userId";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':novoNome', $novoNome);
            $stmt->bindParam(':novoEmail', $novoEmail);
            $stmt->bindParam(':novoTelefone', $novoTelefone);

            if ($stmt->execute()) {
                echo "Dados atualizados com sucesso!";
                session_destroy();
                header('Location: ../html/ec-login.php');
                exit;
            } else {
                throw new Exception("Erro ao atualizar os dados.");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "ID do usuário não encontrado.";
    }
} else {
    header('Location: ../html/ec-login.php');
    exit;
}
