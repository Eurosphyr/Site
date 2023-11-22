<?php
include "funcoes.php";

$conn = conectarAoBanco();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeImagem = $_FILES["imagem"]["name"];
    $tipoImagem = $_FILES["imagem"]["type"];
    $tamanhoImagem = $_FILES["imagem"]["size"];
    $dadosImagem = file_get_contents($_FILES["imagem"]["tmp_name"]);


    $caminhoDiretorio = "../img/";
    $caminhoImagem = $caminhoDiretorio . $nomeImagem;


    $permitirTipos = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($tipoImagem, $permitirTipos)) {
        echo "Somente imagens JPEG, PNG e GIF são permitidas.";
        exit();
    }


    if ($tamanhoImagem > 3000000) { 
        echo "A imagem é muito grande. O tamanho máximo permitido é 3 MB.";
        exit();
    }


    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoImagem)) {

        $params = [
            ':nome' => $_POST['nome'],
            ':descricao' => $_POST['descricao'],
            ':preco' => $_POST['preco'],
            ':codigovisual' => $_POST['codigovisual'],
            ':custo' => $_POST['custo'],
            ':margem_lucro' => $_POST['margem_lucro'],
            ':icms' => $_POST['icms'],
            ':imagem' => $caminhoImagem,
            ':cor' => $_POST['cor'],
            ':categoria' => $_POST['categoria'],
            ':quantidade' => $_POST['quantidade']
        ];
        $sql = "INSERT INTO tbl_produto(
                nome, descricao, preco, codigovisual, custo, margem_lucro, icms, imagem, cor, categoria, quantidade)
                VALUES (
                :nome, :descricao, :preco, :codigovisual, :custo, :margem_lucro, :icms, :imagem, :cor, :categoria, :quantidade
                )";

        $stmt = $conn->prepare($sql);
        if ($stmt->execute($params)) {
            header("Location: ../html/ec-crud.php");
            exit();
        } else {
            echo "Erro ao inserir o produto no banco de dados.";
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
}
