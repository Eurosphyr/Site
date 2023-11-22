<?php
include "funcoes.php";
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    $conn = conectarAoBanco();
    $query = "SELECT * FROM tbl_produto WHERE id_produto = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nome = $row['nome'];
        $descricao = $row['descricao'];
        $excluido = $row['excluido'];
        $preco = $row['preco'];
        $data_exclusao = $row['data_exclusao'];
        $codigovisual = $row['codigovisual'];
        $custo = $row['custo'];
        $margem_lucro = $row['margem_lucro'];
        $icms = $row['icms'];
        $imagem = $row['imagem'];
        $cor = $row['cor'];
        $categoria = $row['categoria'];
        $quantidade = $row['quantidade'];
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Editar Produto</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <link rel="stylesheet" href="../css/crud.css">
            <link rel="icon" href="../img/Logos.svg">
        </head>

        <body>
            <h1>Editar Produto</h1>
            <form action="alterar_produtos.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao"><?php echo $descricao; ?></textarea><br>
                <label for="excluido">Excluído:</label>
                <input type="checkbox" name="excluido" value="1" <?php if ($excluido == 1) echo 'checked'; ?>><br>
                <label for="preco">Preço:</label>
                <input type="text" name="preco" value="<?php echo $preco; ?>"><br>
                <label for="data_exclusao">Data de Exclusão:</label>
                <input type="datetime-local" name="data_exclusao" value="<?php echo $data_exclusao; ?>"><br>
                <label for="codigovisual">Código Visual:</label>
                <input type="text" name="codigovisual" value="<?php echo $codigovisual; ?>"><br>
                <label for="custo">Custo:</label>
                <input type="text" name="custo" value="<?php echo $custo; ?>"><br>
                <label for="margem_lucro">Margem de Lucro:</label>
                <input type="text" name="margem_lucro" value="<?php echo $margem_lucro; ?>"><br>
                <label for="icms">ICMS:</label>
                <input type="text" name="icms" value="<?php echo $icms; ?>"><br>
                <label for="imagem">Imagem:</label>
                <input type="file" name="imagem" value="<?php echo "<img src='$imagem' alt='Imagem do Produto'>" ?>"><br>
                <label for="cor">Cor:</label>
                <input type="text" name="cor" value="<?php echo $cor; ?>"><br>
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria" value="<?php echo $categoria; ?>"><br>
                <label for="quantidade">Quantidade:</label>
                <input type="text" name="quantidade" value="<?php echo $quantidade; ?>"><br>
                <input type="hidden" name="imagem_existente" value="<?php echo $imagem; ?>">
                <input type="submit" value="Salvar Alterações">
            </form>
        </body>

        </html>
<?php
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID do produto não fornecido.";
}
?>