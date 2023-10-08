<?php
include "funcoes.php";

$conn = conectarAoBanco();
$params = [
    ':nome' => $_POST['nome'],
    ':descricao' => $_POST['descricao'],
    ':preco' => $_POST['preco'],
    ':codigovisual' => $_POST['codigovisual'],
    ':custo' => $_POST['custo'],
    ':margem_lucro' => $_POST['margem_lucro'],
    ':icms' => $_POST['icms'],
    ':imagem' => $_POST['imagem'],
    ':cor' => $_POST['cor'],
    ':categoria' => $_POST['categoria']
];
$sql = "INSERT INTO tbl_produto(
        nome, descricao, preco, codigovisual, custo, margem_lucro, icms, imagem, cor, categoria)
        VALUES (
        :nome, :descricao, :preco, :codigovisual, :custo, :margem_lucro, :icms, :imagem, :cor, :categoria
        )";

$stmt = $conn->prepare($sql);
$stmt->execute($params);

header("Location: ../html/crud.php");
exit();
