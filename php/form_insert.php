<!DOCTYPE html>
<html>

<head>
    <title>Formulário de Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/crud.css">
    <link rel="icon" href="../img/Logos.svg">
</head>

<body>
    <h2>Formulário de Produto</h2>
    <form action="adicionar_produtos.php" method="POST" enctype="multipart/form-data">
        <label for="id_produto"></label>
        <input type="hidden" id="id_produto" name="id_produto"><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco"><br><br>

        <label for="codigovisual">Código Visual:</label>
        <input type="text" id="codigovisual" name="codigovisual"><br><br>

        <label for="custo">Custo:</label>
        <input type="text" id="custo" name="custo"><br><br>

        <label for="margem_lucro">Margem de Lucro:</label>
        <input type="text" id="margem_lucro" name="margem_lucro"><br><br>

        <label for="icms">ICMS:</label>
        <input type="text" id="icms" name="icms"><br><br>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem"><br><br>

        <label for="cor">Cor:</label>
        <input type="text" id="cor" name="cor"><br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria"><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade"><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>