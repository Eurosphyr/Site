<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("funcoes.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = conectarAoBanco();

    if (empty($_POST['nome']) || empty($_POST['senha']) || empty($_POST['confirmar_senha']) || empty($_POST['email']) || empty($_POST['telefone'])) {
        echo '<script>alert("Preencha todos os campos!"); window.location.href = "../html/ec-cadastro.php";</script>';
    } else {
        if ($_POST['senha'] === $_POST['confirmar_senha']) {
            $senha = $_POST['senha'];
            $tipo_usuario = false;

            $query = "INSERT INTO tbl_usuario (nome, senha, email, telefone, tipo_usuario";
            $values = " VALUES (:nome, :senha, :email, :telefone, :tipo_usuario";

            session_start();
            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario']) {
                $query .= ", endereco_rua, endereco_bairro, endereco_num, endereco_cidade, endereco_estado, tipo_usuario, desativado";
                $values .= ", :endereco_rua, :endereco_bairro, :endereco_num, :endereco_cidade, :endereco_estado, :tipo_usuario, false";
            }

            $query .= ")";
            $values .= ")";

            $sql = $query . $values;

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':telefone', $_POST['telefone']);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario, PDO::PARAM_BOOL);

            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario']) {
                $stmt->bindParam(':endereco_rua', $_POST['endereco_rua']);
                $stmt->bindParam(':endereco_bairro', $_POST['endereco_bairro']);
                $stmt->bindParam(':endereco_num', $_POST['endereco_num']);
                $stmt->bindParam(':endereco_cidade', $_POST['endereco_cidade']);
                $stmt->bindParam(':endereco_estado', $_POST['endereco_estado']);
                $stmt->bindParam(':tipo_usuario', $tipo_usuario, PDO::PARAM_BOOL);
                $stmt->bindParam(':desativado', $desativado, PDO::PARAM_BOOL);

            }

            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
                header("Location: ../html/index.php");
            } else {
                echo '<script>alert("Erro ao cadastrar"); window.location.href = "../html/ec-cadastro.php";</>';
            }
        } else {
            echo '<script>alert("As senhas não correspondem!"); window.location.href = "../html/ec-cadastro.php";</script>';
        }
    }
}
?>