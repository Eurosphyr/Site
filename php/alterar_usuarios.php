<?php
include "funcoes.php";
$id_usuario = $_GET['id_usuario'];

// Verifique se há um id_usuario na URL
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Conecte-se ao banco de dados e recupere os dados do usuário com base no ID
    $conn = conectarAoBanco();
    $query = "SELECT * FROM tbl_usuario WHERE id_usuario = :id_usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    // Verifique se o usuário existe
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $nome = $row['nome'];
        $email = $row['email'];
        $senha = $row['senha'];
        $telefone = $row['telefone'];
        $endereco_rua = $row['endereco_rua'];
        $endereco_num = $row['endereco_num'];
        $endereco_bairro = $row['endereco_bairro'];
        $endereco_cidade = $row['endereco_cidade'];
        $endereco_estado = $row['endereco_estado'];
        $tipo_usuario = $row['tipo_usuario'];
        $desativado = $row['desativado'];
        

        // Resto do código HTML para exibir o formulário com os valores das variáveis
    } else {
        echo "Usuário não encontrado.";
         // Ou outra ação apropriada
    }
} else {
    echo "ID não informado.";
     // Ou outra ação apropriada
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulário de Usuários</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/crud.css">
    <link rel="icon" href="../img/Logos.svg">
</head>

<body>
    <h2>Formulário de Usuários</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome do usuário" value="<?php echo $nome ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email do usuário" value="<?php echo $email ?>">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Senha do usuário" value="<?php echo $senha ?>">
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone do usuário" value="<?php echo $telefone ?>">
        <label for="endereco_rua">Endereço:</label>
        <input type="text" id="endereco_rua" name="endereco_rua" placeholder="Rua do usuário" value="<?php echo $endereco_rua ?>">
        <label for="endereco_bairro">Bairro:</label>
        <input type="text" id="endereco_bairro" name="endereco_bairro" placeholder="Bairro do usuário" value="<?php echo $endereco_bairro ?>">
        <label for="endereco_num">Número:</label>
        <input type="text" id="endereco_num" name="endereco_num" placeholder="Número do usuário" value="<?php echo $endereco_num ?>">
        <label for="endereco_cidade">Cidade:</label>
        <input type="text" id="endereco_cidade" name="endereco_cidade" placeholder="Cidade do usuário" value="<?php echo $endereco_cidade ?>">
        <label for="endereco_estado">Estado:</label>
        <input type="text" id="endereco_estado" name="endereco_estado" placeholder="Estado do usuário" value="<?php echo $endereco_estado ?>">
        <label for="tipo_usuario">Administrador:</label>
        <input type="checkbox" id="tipo_usuario" name="tipo_usuario" placeholder="Tipo de usuário" value="1" <?php if ($tipo_usuario == 1) echo 'checked'; ?>><br>
        <label for="desativado">Desativado:</label>
        <input type="checkbox" id="desativado" name="desativado" placeholder="Desativado" value="1" <?php if ($desativado == 1) echo 'checked'; ?>><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>