<?php // Inclua o arquivo de conexão
include "funcoes.php";

// Conecte-se ao banco de dados
$conn = conectarAoBanco();

if (!$conn) {
    die("Falha na conexão com o banco de dados.");
}

// Consulta SQL para recuperar os produtos
$sql = "SELECT * FROM produtos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agora, $produtos contém os dados dos produtos do banco de dados
