<?php
include "funcoes.php";

$conn = conectarAoBanco();

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeImagem = $_FILES["imagem"]["name"];
    $tipoImagem = $_FILES["imagem"]["type"];
    $tamanhoImagem = $_FILES["imagem"]["size"];
    $dadosImagem = file_get_contents($_FILES["imagem"]["tmp_name"]);

    // Defina o caminho onde deseja armazenar a imagem no servidor
    $caminhoDiretorio = "../img/";
    $caminhoImagem = $caminhoDiretorio . $nomeImagem;

    // Verifique se o arquivo é uma imagem válido (opcional)
    $permitirTipos = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($tipoImagem, $permitirTipos)) {
        echo "Somente imagens JPEG, PNG e GIF são permitidas.";
        exit();
    }

    // Verifique se o tamanho do arquivo é aceitável (opcional)
    if ($tamanhoImagem > 3000000) { // 3 MB
        echo "A imagem é muito grande. O tamanho máximo permitido é 3 MB.";
        exit();
    }

    // Mova a imagem para o diretório desejado no servidor
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoImagem)) {
        // A imagem foi carregada com sucesso, agora você pode inserir os dados no banco de dados
        $params = [
            ':nome' => $_POST['nome'],
            ':descricao' => $_POST['descricao'],
            ':preco' => $_POST['preco'],
            ':codigovisual' => $_POST['codigovisual'],
            ':custo' => $_POST['custo'],
            ':margem_lucro' => $_POST['margem_lucro'],
            ':icms' => $_POST['icms'],
            ':imagem' => $caminhoImagem, // Salve o caminho da imagem no banco de dados
            ':cor' => $_POST['cor'],
            ':categoria' => $_POST['categoria']
        ];
        $sql = "INSERT INTO tbl_produto(
                nome, descricao, preco, codigovisual, custo, margem_lucro, icms, imagem, cor, categoria)
                VALUES (
                :nome, :descricao, :preco, :codigovisual, :custo, :margem_lucro, :icms, :imagem, :cor, :categoria
                )";

        $stmt = $conn->prepare($sql);
        if ($stmt->execute($params)) {
            header("Location: ../html/crud.php");
            exit();
        } else {
            echo "Erro ao inserir o produto no banco de dados.";
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
}
?>
