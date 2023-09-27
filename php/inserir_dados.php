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
        $query = "INSERT INTO tbl_usuario (nome, senha, email, telefone) VALUES (:nome, :senha, :email, :telefone)";
        $stmt = $conn->prepare($query);

        // Associe os valores aos placeholders
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':telefone', $_POST['telefone']);

        // Execute a consulta
        if ($stmt->execute()) {
            // Inserção bem-sucedida
            echo "Usuário cadastrado com sucesso!";
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
