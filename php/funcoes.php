<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
function logout()
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'logout') {
    // Destruir a sessão
    session_destroy();

    // Redirecionar para a página de login
    header('Location: ../html/ec-login.php');
    exit;
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'logout') {
  logout(); // Chame a função logout()
}
function obterProdutos()
{
  $conn = conectarAoBanco();

  $stmt = $conn->prepare("SELECT * FROM tbl_produto WHERE excluido = false");
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function inutilizar_produto()
{
  $id = $_GET['id'];

  $sql = "UPDATE FROM tbl_produto SET excluido = true WHERE id = :id_produto";
  $update = conectarAoBanco()->prepare($sql);
  $update->execute(array(':id_produto' => $id));

  $params = [
    ':id_produto' => $id
  ];

  if ($update->execute($params)) {
    header('Location: ../html/ec-carrinho.php');
  } else {
    echo "Erro ao inserir o registro: " . $update->errorInfo()[2];
  }
}

function excluir_produto()
{
  $id = $_GET['id'];

  $sql = "DELETE FROM tbl_carrinho WHERE id = :id_produto";
  $delete = conectarAoBanco()->prepare($sql);
  $delete->execute(array(':id_produto' => $id));

  $params = [
    ':id_produto' => $id
  ];

  if ($delete->execute($params)) {
    header('Location: ../html/ec-carrinho.php');
  } else {
    echo "Erro ao inserir o registro: " . $delete->errorInfo()[2];
  }
}

function pesquisa()
{
  if (isset($_POST['termo_pesquisa'])) {
    $varNome = $_POST['termo_pesquisa'];

    $sql = "SELECT * FROM tbl_produto 
            WHERE nome LIKE '%$varNome%'   
            ORDER BY nome";

    $select = conectarAoBanco()->prepare($sql);
    $select->execute();
    $result = $select->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>"; // Abra a tabela aqui

    foreach ($result as $row) {
      echo "<tr>";
      echo "<td>" . $row['nome'] . "</td>";
      echo "</tr>";
    }

    echo "</table>"; // Feche a tabela aqui
  }

  echo "
  <div class='imagem'>
  <img src='../img/lupa.png' alt='Imagem' id='imagem'>
</div>
<div id='barra-pesquisa' class='barra'>
  <form action='' method='post'>
      <input type='text' id='pesquisa' name='termo_pesquisa'>
      <input type='submit' value='Pesquisar'>
  </form>
</div>
  ";
}
function login()
{
  session_start();

  try {
    if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
      // Se o usuário já está logado, redirecione para a página de perfil
      header('Location: perfil.php');
      exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      $conn = conectarAoBanco();

      if (!$conn) {
        throw new Exception("Falha na conexão com o banco de dados.");
      }

      $sql = "SELECT * FROM tbl_usuario WHERE email = :email AND senha = :senha";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':senha', $senha);
      $stmt->execute();

      if ($stmt->rowCount() == 1) {
        // Dados do usuário encontrados
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Armazene os dados do usuário na sessão
        $_SESSION['sessaoConectado'] = true;
        $_SESSION['userId'] = $userData['id'];
        $_SESSION['userName'] = $userData['nome'];
        $_SESSION['userEmail'] = $userData['email'];
        $_SESSION['userTelefone'] = $userData['telefone'];

        // Redirecione para a página de perfil
        header('Location: perfil.php');
        exit;
      } else {
        throw new Exception("Credenciais inválidas. Por favor, tente novamente.");
      }
    }
  } catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
  }

  echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
      <head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title>Login</title>
        <link rel='stylesheet' href='../css/cadastro.css' />
        <link rel='icon' href='../img/Logos.svg' />
      </head>
      <body>
        <div class='container'>
          <div class='menu'>
            <div class='cadastro'>Faça seu Login</div>
            <form action='' method='POST'>
              <label for='email' class='em'>Email</label>
              <input id='email' class='escrita' type='text' name='email' required>
              <label for='senha' class='se'>Senha</label>
              <input id='senha' class='escrita' type='password' name='senha' required>
              <label for='lembrar' class='salvar'>Lembrar sempre</label>
              <input id='lembrar' class='checked' type='checkbox'><br>
              <label for='mostrar-senha' class='mostrar'>Mostrar senha</label>
              <input id='mostrar-senha' class='checked' type='checkbox'>
              <div class='centralizar' align='center'>
                <input class='bt' type='submit' value='Confirmar'>
              </div>
            </form>
            <div class='baixo'><a href='ec-cadastro.php'>Criar conta</a></div>
            <div class='baixo'><a href='#'>Esqueci a senha</a></div>
          </div>
        </div>
        <script>
        const senha = document.getElementById('senha');
        const mostrarSenha = document.getElementById('mostrar-senha');
      
        mostrarSenha.addEventListener('click', function (e) {
          senha.type = mostrarSenha.checked ? 'text' : 'password';
        });
      </script>
      </body>
    </html>
  ";
}
function login_sessao()
{
  session_start();

  // login que veio do form
  $login = $_POST['login'];
  $senha = $_POST['senha'];
  $eh_admin = false;

  if ($login <> '') {
    DefineCookie('loginCookie', $login, 60);
    $_SESSION['sessaoConectado'] = funcaoLogin($login, $senha, $eh_admin);
    $_SESSION['sessaoAdmin']     = $eh_admin;
  }

  header('Location: ../html/login.php');
}

function funcaoLogin($paramLogin, $paramSenha, &$paramAdmin)
{
  $paramAdmin = ($paramLogin == 'admin' and
    $paramSenha == 'admin');
  // vc tb poderia procurar numa tabela de usuarios pra 
  // validar o usuario, eqto isso, .......
  return true;  // ...........todos sao validos!

}

function DefineCookie($paramNome, $paramValor, $paramMinutos)
{
  echo "Cookie: $paramNome Valor: $paramValor";
  setcookie($paramNome, $paramValor, time() + $paramMinutos * 60);
}
