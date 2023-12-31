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
    $codigovisual = $_POST['codigovisual'];
    $custo = $_POST['custo'];
    $margem_lucro = $_POST['margem_lucro'];
    $icms = $_POST['icms'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_POST['imagem'];

    // Verifique se a data_exclusao foi definida no formulário
    if (isset($_POST['data_exclusao']) && !empty($_POST['data_exclusao'])) {
        $data_exclusao = $_POST['data_exclusao']; // Aqui, $data_exclusao é uma string no formato "YYYY-MM-DD HH:MI:SS"
    } else {
        $data_exclusao = null;
    }

    // Verifique se o formulário enviou uma imagem
    if ($_FILES["imagem"]["size"] > 0) {
        $nomeImagem = $_FILES["imagem"]["name"];
        $tipoImagem = $_FILES["imagem"]["type"];
        $tamanhoImagem = $_FILES["imagem"]["size"];
        $caminhoDiretorio = "../img/";
        $caminhoImagem = $caminhoDiretorio . $nomeImagem;

        // Verifique se o arquivo é uma imagem válida
        $permitirTipos = array("image/jpeg", "image/png", "image/gif");
        if (!in_array($tipoImagem, $permitirTipos)) {
            echo "Somente imagens JPEG, PNG e GIF são permitidas.";
            exit();
        }

        // Verifique se o tamanho do arquivo é aceitável
        if ($tamanhoImagem > 3000000) { // 3 MB
            echo "A imagem é muito grande. O tamanho máximo permitido é 3 MB.";
            exit();
        }

        // Mova a imagem para o diretório desejado no servidor
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoImagem)) {
            // A imagem foi carregada com sucesso
            $imagem = $caminhoImagem;
        } else {
            echo "Erro ao fazer o upload da imagem.";
            exit();
        }
    } else {
        // Se o formulário não enviou uma nova imagem, mantenha a imagem existente
        $imagem = $_POST['imagem_existente'];
    }

    // Prepare e execute a consulta SQL
    $query = "UPDATE tbl_produto SET nome = :nome, descricao = :descricao, excluido = :excluido, preco = :preco, data_exclusao = :data_exclusao, codigovisual = :codigovisual, custo = :custo, margem_lucro = :margem_lucro, icms = :icms, imagem = :imagem, quantidade = :quantidade WHERE id_produto = :id_produto";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':excluido', $excluido, PDO::PARAM_BOOL);
    $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
    $stmt->bindParam(':data_exclusao', $data_exclusao, PDO::PARAM_STR);
    $stmt->bindParam(':codigovisual', $codigovisual, PDO::PARAM_STR);
    $stmt->bindParam(':custo', $custo, PDO::PARAM_INT);
    $stmt->bindParam(':margem_lucro', $margem_lucro, PDO::PARAM_INT);
    $stmt->bindParam(':icms', $icms, PDO::PARAM_INT);
    $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
    $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso.";
        header("Location: ../html/ec-crud.php");
    } else {
        echo "Erro ao atualizar o produto.";
    }
}
