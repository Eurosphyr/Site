<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("funcoes.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = conectarAoBanco();

    // Verifique se a senha e a confirmação da senha são iguais
    if ($_POST['senha'] === $_POST['confirmar_senha']) {
        $senha = $_POST['senha']; // Use hash para armazenar a senha com segurança

        // Use placeholders para evitar SQL Injection
        $query = "INSERT INTO tbl_usuario (nome, senha, email, telefone";
        $values = " VALUES (:nome, :senha, :email, :telefone";
        
        session_start();
        if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario']) {
            $query .= ", endereco_rua, endereco_bairro, endereco_num, endereco_cidade, endereco_estado";
            $values .= ", :endereco_rua, :endereco_bairro, :endereco_num, :endereco_cidade, :endereco_estado";
        }
        
        $query .= ")";
        $values .= ")";
        
        $stmt = $conn->prepare($query . $values);

        // Associe os valores aos placeholders
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':telefone', $_POST['telefone']);
        
        if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario']) {
            $stmt->bindParam(':endereco_rua', $_POST['endereco_rua']);
            $stmt->bindParam(':endereco_bairro', $_POST['endereco_bairro']);
            $stmt->bindParam(':endereco_num', $_POST['endereco_num']);
            $stmt->bindParam(':endereco_cidade', $_POST['endereco_cidade']);
            $stmt->bindParam(':endereco_estado', $_POST['endereco_estado']);
        }

        // Execute a consulta
        if ($stmt->execute()) {
            // Inserção bem-sucedida
            echo "Usuário cadastrado com sucesso!";
            header("Location: ../html/perfil.php");
        } else {
            // Se a inserção falhar, você pode lidar com isso de acordo com sua lógica
            echo "Erro ao cadastrar o usuário.";
        }
    } else {
        // As senhas não correspondem, você pode lidar com isso de acordo com sua lógica
        echo "As senhas não correspondem.";
    }
}
?>
