<?php
function conectarAoBanco()
{
  $host = "pgsql.projetoscti.com.br";
  $port = "5432";
  $dbname = "projetoscti27";
  $user = "projetoscti27";
  $password = "721643";

  try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
    exit;
  }
}

function mostrarTabela($result)
{
  echo "
  <table border='1'>
    <tr>
      <th>Nome</th>
      <th>Email</th>
      <th>Telefone</th>
    </tr>
    ";
  while ($linha = pg_fetch_assoc($result)) {
    echo "
      <tr>
        <td>" . $linha['nome'] . "</td>
        <td>" . $linha['email'] . "</td>
        <td>" . $linha['telefone'] . "</td>
      </tr>
      ";
  }
  echo "
  </table>
  ";
}

function consultarDados()
{
  $conn = conectarAoBanco();

  $query = "SELECT * FROM tbl_produto";
  $result = $conn->query($query);

  if (!$result) {
    echo "Error in SQL query.";
    exit;
  }

  return $result;
}
function inserir_dados()
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = conectarAoBanco();

    $linha = [
      'nome'      => $_POST['nome'],
      'email'     => $_POST['email'],
      'senha'  => $_POST['senha'],
      'telefone'  => $_POST['telefone']
    ];

    $sql = "INSERT INTO tbl_usuario (nome, email, senha, telefone)  
              VALUES (:nome, :email, :senha, :telefone)";

    $insert = $conn->prepare($sql);
  }
}


function altera_dados()
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = conectarAoBanco();

    $linha = [
      'nome'      => $_POST['nome'],
      'email'     => $_POST['email'],
      'senha'  => $_POST['senha'],
      'telefone'  => $_POST['telefone']
    ];

    $sql = "INSERT INTO tbl_usuario (nome, email, senha, telefone)  
              VALUES (:nome, :email, :senha, :telefone)";

    $update = $conn->prepare($sql);


    $update->execute($linha);


    header('Location: perfil.html');
  } else {

    echo "Form not submitted!";
  }
}

function excluirDados()
{
  $id = $_GET['id'];

  $sql = "DELETE FROM tbl_usuario WHERE id = :id";
  $delete = conectarAoBanco()->prepare($sql);
  $delete->execute(array(':id' => $id));

  $params = [
    ':id' => $id
  ];

  if ($delete->execute($params)) {
    header('Location: perfil.html');
  } else {
    echo "Erro ao inserir o registro: " . $delete->errorInfo()[2];
  }
}
