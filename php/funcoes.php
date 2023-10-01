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
  while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "
      <tr>
        <td>" . $linha['nome'] . "</td>
        <td>" . $linha['email'] . "</td>
        <td>" . $linha['telefone'] . "</td>
        <td>.</td>
      </tr>
      ";
  }
  echo "
  </table>
  ";
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

function excluir_produto(){
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

function pesquisa(){
  if (isset($_POST['varNome'])) {
    $varNome = $_POST['varNome'];
} else {
    $varNome = "";
}

$sql = " SELECT * FROM tbl_produto 
         WHERE (nome LIKE '%$varNome%')   
         ORDER BY nome ";

$select = conectarAoBanco()->query($sql);

echo "<form action='' name='frmPesq' method='post'>
      Digite o nome ou parte<br>
      <input type='text' name='nome'>
      <input type='submit' value='Pesquisar'>
     </form><br>";
}



function login()
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
    session_start();

    // Verificar se o usuário já está conectado
    if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
        // Usuário já está conectado, redirecione-o para a página inicial ou outra página
        header('Location: ../html/index.php');
        exit;
    }

    // Verificar se o formulário de login foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter o email e senha do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Conectar ao banco de dados (substitua com suas próprias configurações)
        $conn = conectarAoBanco();

        // Verificar a conexão com o banco de dados
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . $conn->errorInfo()[2]);
        }

        // Consulta SQL para verificar as credenciais no banco de dados
        $sql = "SELECT * FROM tbl_usuario WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // As credenciais são válidas, conecte o usuário
            $_SESSION['sessaoConectado'] = true;

            // Redirecione para a página de sucesso ou página inicial
            header('Location: ../html/index.php');
            exit;
        } else {
            // Credenciais inválidas, exiba uma mensagem de erro
            echo "Credenciais inválidas. Por favor, tente novamente.";
        }

        // Feche a conexão com o banco de dados
        $conn = null;
    }

    echo "
    <!DOCTYPE html>
    <html lang='en'>
      <head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title>Login</title>
        <link rel='stylesheet' href='../css/cadastro.css' />
        <link rel='icon' href='../img/Logos.svg' />
        <script src='../php/script.js'></script>
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





function logout(){
  session_start(); 
  $_SESSION['sessaoConectado']=false; 
  $_SESSION['sessaoAdmin']=false; 

  header('Location: ../html/login.php');
}

function login_sessao(){
  session_start();   

  // login que veio do form
  $login = $_POST['login'];
  $senha = $_POST['senha'];
  $eh_admin = false;

  if ($login<>'') {
      DefineCookie('loginCookie', $login, 60); 
      $_SESSION['sessaoConectado'] = funcaoLogin($login,$senha,$eh_admin); 
      $_SESSION['sessaoAdmin']     = $eh_admin;   
  }
     
  header('Location: ../html/login.php');
}

function funcaoLogin ($paramLogin, $paramSenha, &$paramAdmin)  
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

