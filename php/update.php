<?php
// Certifique-se de ter incluído as configurações do banco de dados e estabelecido uma conexão com o banco de dados.
include "funcoes.php";
$conn = conectarAoBanco();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperando os dados do formulário
    $id_usuario = !empty($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco_rua = $_POST['endereco_rua'];
    $endereco_num = $_POST['endereco_num'];
    $endereco_bairro = $_POST['endereco_bairro'];
    $endereco_cidade = $_POST['endereco_cidade'];
    $endereco_estado = $_POST['endereco_estado'];
    $tipo_usuario = isset($_POST['tipo_usuario']) ? 1 : 0;
    $desativado = isset($_POST['desativado']) ? 1 : 0;
     // Se a caixa de seleção foi marcada, defina 1; caso contrário, defina 0.

    // SQL para atualizar os dados do usuário
    $sql = "UPDATE tbl_usuario SET 
            nome = :nome,
            email = :email,
            senha = :senha,
            telefone = :telefone,
            endereco_rua = :endereco_rua,
            endereco_num = :endereco_num,
            endereco_bairro = :endereco_bairro,
            endereco_cidade = :endereco_cidade,
            endereco_estado = :endereco_estado,
            tipo_usuario = :tipo_usuario,
            desativado = :desativado
            WHERE id_usuario = :id_usuario";

    try {
        // Preparar a consulta
        $stmt = $conn->prepare($sql);

        // Vincular os parâmetros
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':endereco_rua', $endereco_rua, PDO::PARAM_STR);
        $stmt->bindParam(':endereco_num', $endereco_num, PDO::PARAM_STR);
        $stmt->bindParam(':endereco_bairro', $endereco_bairro, PDO::PARAM_STR);
        $stmt->bindParam(':endereco_cidade', $endereco_cidade, PDO::PARAM_STR);
        $stmt->bindParam(':endereco_estado', $endereco_estado, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario, PDO::PARAM_BOOL);
        $stmt->bindParam(':desativado', $desativado, PDO::PARAM_BOOL);

        // Executar a consulta
        if ($stmt->execute()) {
            echo "Dados do usuário atualizados com sucesso.";
            header("Location: ../html/crud_usuarios.php");
        } else {
            echo "Erro ao atualizar os dados do usuário.";
        }
    } catch (PDOException $e) {
        echo "Erro na consulta: " . $e->getMessage();
    }
}

// Certifique-se de fechar a conexão com o banco de dados após a conclusão.
$conn = null;
?>
