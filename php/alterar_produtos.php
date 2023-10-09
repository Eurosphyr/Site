<?php
include "funcoes.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conecte-se ao banco de dados
    $conn = conectarAoBanco();
    
    // Obtenha os dados do formulário
    $id_produto = $_POST['id_produto'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $excluido = isset($_POST['excluido']) ? 1 : 0;
    $preco = $_POST['preco'];
    if (isset($_POST['data_exclusao']) && !empty($_POST['data_exclusao'])) {
        $data_exclusao = $_POST['data_exclusao']; // Aqui, $data_exclusao é uma string no formato "YYYY-MM-DD HH:MI:SS"
    } else {
        $data_exclusao = null;
    }
    $codigovisual = $_POST['codigovisual'];
    $custo = $_POST['custo'];
    $margem_lucro = $_POST['margem_lucro'];
    $icms = $_POST['icms'];
    $imagem = $_POST['imagem'];
    $cor = $_POST['cor'];
    $categoria = $_POST['categoria'];
    $query = "UPDATE tbl_produto SET nome = :nome, descricao = :descricao, excluido = :excluido, preco = :preco, data_exclusao = :data_exclusao, codigovisual = :codigovisual, custo = :custo, margem_lucro = :margem_lucro, icms = :icms, imagem = :imagem, cor = :cor, categoria = :categoria WHERE id_produto = :id_produto";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
    $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
    if ($data_exclusao !== null) {
        $stmt->bindParam(':data_exclusao', $data_exclusao, PDO::PARAM_STR);
    } else {
        $stmt->bindValue(':data_exclusao', null, PDO::PARAM_NULL);
    }
    $stmt->bindParam(':codigovisual', $codigovisual, PDO::PARAM_STR);
    $stmt->bindParam(':custo', $custo, PDO::PARAM_INT);
    $stmt->bindParam(':margem_lucro', $margem_lucro, PDO::PARAM_INT);
    $stmt->bindParam(':icms', $icms, PDO::PARAM_INT);
    $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
    $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o produto.";
    }
}
?>
