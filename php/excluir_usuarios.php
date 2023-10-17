<?php
// Certifique-se de ter incluído as configurações do banco de dados e estabelecido uma conexão com o banco de dados.
include "funcoes.php";
$conn = conectarAoBanco();
if (isset($_GET['id_usuario']) && isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    // Recuperando o ID do usuário a ser excluído
    $id_usuario = $_GET['id_usuario'];

    // SQL para excluir o usuário
    $sql = "DELETE FROM tbl_usuario WHERE id_usuario = :id_usuario";

    try {
        // Preparar a consulta
        $stmt = $conn->prepare($sql);

        // Vincular o parâmetro
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

        // Executar a consulta
        if ($stmt->execute()) {
            echo "Usuário excluído com sucesso.";
            header("Location: ../html/ec-crud_usuarios.php");
        } else {
            echo "Erro ao excluir o usuário.";
        }
    } catch (PDOException $e) {
        echo "Erro na consulta: " . $e->getMessage();
    }
}

// Certifique-se de fechar a conexão com o banco de dados após a conclusão.
$conn = null;
?>
