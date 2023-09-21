<?php
// Make this in a function to connect in the databas
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
      <th>Endereço</th>
      <th>Cidade</th>
    </tr>
    ";
  while ($linha = pg_fetch_assoc($result)) {
    echo "
      <tr>
        <td>" . $linha['nome'] . "</td>
        <td>" . $linha['email'] . "</td>
        <td>" . $linha['telefone'] . "</td>
        <td>" . $linha['endereco'] . "</td>
        <td>" . $linha['cidade'] . "</td>
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

  $query = "SELECT * FROM tbl_";
  $result = $conn->query($query);

  if (!$result) {
    echo "Error in SQL query.";
    exit;
  }

  return $result;
}

function altera_dados()
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = conectarAoBanco();

    $linha = [
      'nome'      => $_POST['nome'],
      'email'     => $_POST['email'],
      'telefone'  => $_POST['telefone'],
      'endereco'  => $_POST['endereco']
    ];

    $sql = "INSERT INTO aluno (nome, email, telefone, endereco)  
              VALUES (:nome, :email, :telefone, :endereco)";

    $update = $conn->prepare($sql);


    $update->execute($linha);


    header('Location: index.php');
  } else {

    echo "Form not submitted!";
  }
}

function excluirDados()
{
  $id = $_GET['id'];

  $sql = "DELETE FROM miguel WHERE id = :id";
  $delete = conectarAoBanco()->prepare($sql);
  $delete->execute(array(':id' => $id));

  $params = [
    ':id' => $id
  ];

  if ($delete->execute($params)) {
    header('Location: index.php');
  } else {
    echo "Erro ao inserir o registro: " . $delete->errorInfo()[2];
  }
}
