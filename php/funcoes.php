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
      header('Location: ../html/perfil.php');
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
        $_SESSION['userId'] = $userData['id_usuario'];
        $_SESSION['userName'] = $userData['nome'];
        $_SESSION['userEmail'] = $userData['email'];
        $_SESSION['userTelefone'] = $userData['telefone'];

        // Redirecione para a página de perfil
        header('Location: ../html/perfil.php');
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

function crud()
{
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  $conn = conectarAoBanco();
  $query = "SELECT * FROM tbl_produto ORDER BY id_produto ASC";
  $result = $conn->query($query);

  if ($result) {
    echo "<table id='tabela'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nome</th>";
    echo "<th>Descrição</th>";
    echo "<th>Excluido</th>";
    echo "<th>Preço</th>";
    echo "<th>Data de Exclusão</th>";
    echo "<th>Código Visual</th>";
    echo "<th>Custo</th>";
    echo "<th>Margem de Lucro</th>";
    echo "<th>ICMS</th>";
    echo "<th>Imagem</th>";
    echo "<th>Cor</th>";
    echo "<th>Categoria</th>";
    echo "<th colspan='3'>Ações</th>";
    echo "</tr>";

    if ($result->rowCount() > 0) {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id_produto = $row['id_produto'];
        $nome = $row['nome'];
        $descricao = $row['descricao'];
        $excluido = $row['excluido'];
        $preco = $row['preco'];
        $data_exclusao = $row['data_exclusao'];
        $codigovisual = $row['codigovisual'];
        $custo = $row['custo'];
        $margem_lucro = $row['margem_lucro'];
        $icms = $row['icms'];
        $imagem = $row['imagem'];
        $cor = $row['cor'];
        $categoria = $row['categoria'];

        echo "<tr>";
        echo "<td>" . $id_produto . "</td>";
        echo "<td>" . $nome . "</td>";
        echo "<td>" . $descricao . "</td>";
        echo "<td>" . $excluido . "</td>";
        echo "<td>" . $preco . "</td>";
        echo "<td>" . $data_exclusao . "</td>";
        echo "<td>" . $codigovisual . "</td>";
        echo "<td>" . $custo . "</td>";
        echo "<td>" . $margem_lucro . "</td>";
        echo "<td>" . $icms . "</td>";
        echo "<td>" . $imagem . "</td>";
        echo "<td>" . $cor . "</td>";
        echo "<td>" . $categoria . "</td>";
        echo "<td><a href='../php/form_insert.php?acao=adicionar'><img src='../img/adicionar.png' alt='Adicionar' width='30'></a></td>";
        echo "<td><a href='../php/excluir.php?id=" . $id_produto . "&acao=excluir'><img src='../img/excluir.png' alt='Excluir' width='30'></a></td>";
        echo "<td><a href='../php/alterar.php?id=" . $id_produto . "&acao=alterar'><img src='../img/alterar.png' alt='Alterar' width='30'></a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhum registro encontrado.</p>";
}

} else {
echo "Erro ao executar a query.";
}
}

// funcoes.php

function recuperarProdutos() {
  // Conecte-se ao banco de dados
  $conn = conectarAoBanco();

  if (!$conn) {
      die("Falha na conexão com o banco de dados.");
  }

  // Consulta SQL para recuperar todos os produtos
  $sql = "SELECT * FROM tbl_produto";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $produtos;
}

function calcularTotalPedido($carrinho, $produtos)
{
    $totalPedido = 0;

    foreach ($carrinho as $produtoId => $quantidade) {
     
        if (isset($produtos[$produtoId])) {
            $precoProduto = $produtos[$produtoId]['preco'];
            $totalProduto = $precoProduto * $quantidade;
            $totalPedido += $totalProduto;
        }
    }

    return $totalPedido;
}

