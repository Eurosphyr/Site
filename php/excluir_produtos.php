<?php
include 'funcoes.php';

$conn = conectarAoBanco();

if (isset($_GET['id'])) {
  $id_produto = $_GET['id'];

  $sql = "DELETE FROM tbl_produto WHERE id_produto = :id";

  $delete = $conn->prepare($sql);
  $delete->bindParam(':id', $id_produto, PDO::PARAM_INT);

  if ($delete->execute()) {
    header('Location: ../html/ec-crud.php');
  } else {
    echo "Erro ao excluir o registro: " . $delete->errorInfo()[2];
  }
} else {
  echo "ID do produto não fornecido.";
}
