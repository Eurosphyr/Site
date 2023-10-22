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
    excluirCookie('userId');
    excluirCookie('userName');
    excluirCookie('userEmail');

    // Encerre a sessão
    session_unset();
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

  // Verifica se o usuário já está logado com base nos cookies
  if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
    // Se o usuário já está logado, redirecione para a página de perfil
    header('Location: ../html/ec-perfil.php');
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $conn = conectarAoBanco();

    if (!$conn) {
      throw new Exception("Falha na conexão com o banco de dados.");
    }

    $sql = "SELECT * FROM tbl_usuario WHERE email = :email AND senha = :senha AND desativado = false";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
      // Dados do usuário encontrados
      $userData = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($userData['desativado'] == true) {
        throw new Exception("Sua conta foi desativada. Entre em contato com o administrador.");
      }

      if ($userData['tipo_usuario'] == 1) {
        // O usuário é um administrador
        $_SESSION['tipo_usuario'] = true;
      } else {
        // O usuário não é um administrador
        $_SESSION['tipo_usuario'] = false;
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recuperar_senha'])) {
        $email = $_POST['email'];

        if (verificaEmail($email)) {
          $novaSenha = geraSenha(8, true, true, false); // Gera uma nova senha aleatória
          $assunto = "Recuperação de Senha";
          $mensagem = "Sua nova senha é: $novaSenha";

          // Tente enviar o e-mail para o usuário
          $enviado = enviaEmail($email, $assunto, $mensagem);

          if ($enviado) {
            // Atualize a senha do usuário no banco de dados aqui
            // ...
            // Exiba uma mensagem para o usuário informando que a nova senha foi enviada por e-mail
            echo "Uma nova senha foi enviada para o seu e-mail. Verifique sua caixa de entrada.";
          } else {
            // Se houver um erro no envio do e-mail, exiba uma mensagem de erro para o usuário
            echo "Houve um problema ao enviar o e-mail. Por favor, tente novamente mais tarde.";
          }
        } else {
          // Se o e-mail não existir no banco de dados, informe ao usuário que o e-mail não está registrado
          echo "O e-mail fornecido não está registrado. Verifique se o e-mail está correto ou registre uma nova conta.";
        }
      }

      // Defina outras informações do usuário na sessão
      $_SESSION['sessaoConectado'] = true;
      $_SESSION['userId'] = $userData['id_usuario'];
      $_SESSION['userName'] = $userData['nome'];
      $_SESSION['userEmail'] = $userData['email'];
      $_SESSION['userTelefone'] = $userData['telefone'];

      // Verifique se o usuário marcou "Lembrar sempre"
      $lembrarUsuario = isset($_POST['lembrar']) ? true : false;

      if ($lembrarUsuario) {
        // Defina os cookies com base nos dados do usuário e tempo de expiração
        setcookie('lembrar_usuario', true, time() + 3600 * 24 * 7); // Expira em uma semana
        setcookie('userId', $userData['id_usuario'], time() + 3600 * 24 * 7);
        setcookie('userName', $userData['nome'], time() + 3600 * 24 * 7);
        setcookie('userEmail', $userData['email'], time() + 3600 * 24 * 7);
      }

      // Redirecione com base no papel do usuário
      if ($_SESSION['tipo_usuario']) {
        header('Location: ../html/index.php');
        exibirConteudoComBaseNoPapel(); // Página de administrador
      } else {
        header('Location: ../html/index.php');
        exibirConteudoComBaseNoPapel(); // Página de perfil do usuário comum
      }
      exit;
    } else {
      throw new Exception("Credenciais inválidas. Por favor, tente novamente.");
    }
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
        <div class='baixo'><a href='ec-esqueci.php'>Esqueci a senha</a></div>
      </div>
    </div>
  </body>
  <script>
  const senha = document.getElementById('senha');
        const mostrarSenha = document.getElementById('mostrar-senha');
      
        mostrarSenha.addEventListener('click', function (e) {
          senha.type = mostrarSenha.checked ? 'text' : 'password';
        });
  </script>
</html>
";
}


function DefineCookie($paramNome, $paramValor, $paramMinutos)
{
  setcookie($paramNome, $paramValor, time() + $paramMinutos * 60);
}

function lerCookie($nome)
{
  if (isset($_COOKIE[$nome])) {
    return $_COOKIE[$nome];
  }
  return null;
}

function excluirCookie($nome)
{
  if (isset($_COOKIE[$nome])) {
    setcookie($nome, '', time() - 3600, '/');
  }
}

function setarCookies()
{
  if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] === true) {
    // Obtenha os valores da sessão que você deseja armazenar em cookies
    $userId = $_SESSION['userId'];
    $userName = $_SESSION['userName'];
    $userEmail = $_SESSION['userEmail'];

    // Defina cookies com os valores da sessão
    defineCookie('userId', $userId, 3600); // Exemplo: cookie expira em 1 hora
    defineCookie('userName', $userName, 3600); // Exemplo: cookie expira em 1 hora
    defineCookie('userEmail', $userEmail, 3600); // Exemplo: cookie expira em 1 hora
  } else {
    // O usuário não está conectado
    // Exclua os cookies definindo o tempo de expiração no passado
    excluirCookie('userId');
    excluirCookie('userName');
    excluirCookie('userEmail');
  }
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
    echo "<th>Quantidade</th>";
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
        $quantidade = $row['quantidade'];
        $excluido_texto = $excluido ? 'Excluído' : 'Não Excluído';

        echo "<tr>";
        echo "<td>" . $id_produto . "</td>";
        echo "<td>" . $nome . "</td>";
        echo "<td>" . $descricao . "</td>";
        echo "<td>" . $excluido_texto . "</td>";
        echo "<td>" . $preco . "</td>";
        echo "<td>" . $data_exclusao . "</td>";
        echo "<td>" . $codigovisual . "</td>";
        echo "<td>" . $custo . "</td>";
        echo "<td>" . $margem_lucro . "</td>";
        echo "<td>" . $icms . "</td>";
        echo "<td><img src='$imagem' alt='Imagem do Produto' class='imagem-pequena'></td>";
        echo "<td>" . $cor . "</td>";
        echo "<td>" . $categoria . "</td>";
        echo "<td>" . $quantidade . "</td>";
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

function crud_usuarios()
{
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  $conn = conectarAoBanco();
  $query = "SELECT * FROM tbl_usuario ORDER BY id_usuario ASC";
  $result = $conn->query($query);

  if ($result) {
    echo "<table id='tabela'>";
    echo "<tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Senha</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Rua</th>
            <th>Bairro</th>
            <th>Número</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Tipo de Usuário</th>
            <th>Desativado</th>
            <th colspan='3'>Ações</th>
          </tr>";

    if ($result->rowCount() > 0) {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id_usuario = $row['id_usuario'];
        $nome = $row['nome'];
        $senha = $row['senha'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $rua = $row['endereco_rua'];
        $bairro = $row['endereco_bairro'];
        $numero = $row['endereco_num'];
        $cidade = $row['endereco_cidade'];
        $estado = $row['endereco_estado'];
        $tipo_usuario = $row['tipo_usuario'];
        $desativado = $row['desativado'];

        $texto_usuario = $tipo_usuario ? 'Administrador' : 'Usuário Comum';
        $texto_desativado = $desativado ? 'Desativado' : 'Não Desativado';

        echo "<tr>";
        echo "<td>" . $id_usuario . "</td>";
        echo "<td>" . $nome . "</td>";
        echo "<td>" . $senha . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td>" . $telefone . "</td>";
        echo "<td>" . $rua . "</td>";
        echo "<td>" . $bairro . "</td>";
        echo "<td>" . $numero . "</td>";
        echo "<td>" . $cidade . "</td>";
        echo "<td>" . $estado . "</td>";
        echo "<td>" . $texto_usuario . "</td>";
        echo "<td>" . $texto_desativado . "</td>";
        echo "<td><a href='../html/ec-cadastro.php'><img src='../img/adicionar.png' alt='Adicionar' width='30'></a></td>";
        echo "<td><a href='../php/excluir_usuarios.php?id_usuario=" . $id_usuario . "&acao=excluir'><img src='../img/excluir.png' alt='Excluir' width='30'></a></td>";
        echo "<td><a href='../php/alterar_usuarios.php?id_usuario=" . $id_usuario . "&acao=alterar'><img src='../img/alterar.png' alt='Alterar' width='30'></a></td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Nenhum resultado encontrado.";
    }
  }
}

// funcoes.php

function recuperarProdutos()
{
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

function exibirConteudoComBaseNoPapel()
{
  if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === true) {
    // O usuário é um administrador
    echo "
      <div class='cabecalho'>
        <img class='logo' src='../img/Logos.svg' />
        <a class='b' href='index.php'><input type = 'button' class='b' value='HOME'></a>
        <a class='b' href='ec-sobre.php'><input type = 'button' class='b' value='SOBRE'></a>
        <a class='b' href='ec-telacompra.php'><input type = 'button' class='b' value='COMPRAR'></a>
        <a class='b' href='ec-crud.php'><input type = 'button' class='b' value='CRUD PRODUTOS'></a>
        <a class='b' href='ec-crud_usuarios.php'><input type = 'button' class='b' value='CRUD USUÁRIOS'></a>
        <a href='ec-carrinho.php'><img class='carrinho' src='../img/cart.png' alt='Carrinho' /></a>
        <a href='ec-perfil.php'><img class='perfil' src='../img/user.png' alt='Perfil' /></a>
      </div>
      ";
  } else {
    // O usuário não é um administrador
    echo "
      <div class='cabecalho'>
        <img class='logo' src='../img/Logos.svg' />
        <a class='b' href='index.php'><input type = 'button' class='b' value='HOME'></a>
        <a class='b' href='ec-sobre.php'><input type = 'button' class='b' value='SOBRE'></a>
        <a class='b' href='ec-telacompra.php'><input type = 'button' class='b' value='COMPRAR'></a>
        <a href='ec-carrinho.php'><img class='carrinho' src='../img/cart.png' alt='Carrinho' /></a>
        <a href='ec-perfil.php'><img class='perfil' src='../img/user.png' alt='Perfil' /></a>
      </div>
      ";
  }
}

function enviaEmail(
  $pEmailDestino,
  $pAssunto,
  $pHtml,
  $pUsuario = "mipron@projetoscti.com.br",
  $pSenha = "M1pr0n2023",
  $pSMTP = "smtp.projetoscti.com.br"
) {

  // Troque o usuário e a senha se necessário.
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  require "PHPMailer/PHPMailer.php";
  require "PHPMailer/Exception.php";
  require "PHPMailer/SMTP.php";

  try {

    // Cria uma instância do PHPMailer
    echo "<br>Tentando enviar para $pEmailDestino...";
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Servidor SMTP
    $mail->isSMTP();
    $mail->Host = $pSMTP;
    $mail->SMTPAuth = true;      // Requer autenticação com o servidor
    $mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    $mail->Port = 587;
    $mail->Username = $pUsuario;
    $mail->Password = $pSenha;
    $mail->setFrom($pUsuario, "Suporte de senhas");
    $mail->addAddress($pEmailDestino, "Usuario");
    $mail->isHTML(true);
    $mail->Subject = $pAssunto;
    $mail->Body = $pHtml;
    $enviado = $mail->send();

    if (!$enviado) {
      echo "<br>Erro: " . $mail->ErrorInfo;
    } else {
      echo "<br><b>Enviado!</b>";
    }
    return $enviado;
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}


function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
  //$lmin = 'abcdefghijklmnopqrstuvwxyz';
  $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $num = '1234567890';
  $simb = '!@#$%*-';
  $retorno = '';
  $caracteres = '';

  //$caracteres .= $lmin;
  if ($maiusculas) $caracteres .= $lmai;
  if ($numeros) $caracteres .= $num;
  if ($simbolos) $caracteres .= $simb;

  $len = strlen($caracteres);
  for ($n = 1; $n <= $tamanho; $n++) {
    $rand = mt_rand(1, $len);
    $retorno .= $caracteres[$rand - 1];
  }
  return $retorno;
}

function verificaEmail($paramEmail)
{
  $conn = conectarAoBanco();
  $select = $conn->query("SELECT email FROM tbl_usuario");
  while ($row = $select->fetch()) {
    $varEmail = $row['email'];
    if ($paramEmail == $varEmail) {
      return true;
    }
  }
  return false;
}

function ValorSQL($pConn, $pSQL)
{
  $linhas = $pConn->query($pSQL)->fetch();

  if ($linhas > 0) {
    return $linhas[0];
  } else {
    return "0";
  }
}

function ExecutaSQL($paramConn, $paramSQL)
{
  $linhas = $paramConn->exec($paramSQL);

  if ($linhas > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}
function carrinhoCompras($conn)
{
  $existe = 0;
  $codigoCompra = 0;
  $statusCompra = 'Pendente';
  $session_id = session_id();

  // Verifica se existe compra associada ao session_id
  $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_compratmp WHERE sessao = :sessao");
  $stmt->bindParam(':sessao', $session_id);
  $stmt->execute();
  $result = $stmt->fetchColumn();
  $existe = intval($result) == 1;

  // Cria ou recupera o código da compra
  if (!$existe) {
    $dataHoje = date('Y-m-d');
    ExecutaSQL($conn, "INSERT INTO tbl_compra (id_usuario, status, data) VALUES (NULL, '$statusCompra', '$dataHoje')");
    $codigoCompra = $conn->lastInsertId();
    ExecutaSQL($conn, "INSERT INTO tbl_compratmp (id_compra, sessao) VALUES ($codigoCompra, '$session_id')");
  } else {
    $codigoCompra = intval(ValorSQL($conn, "SELECT id_compra FROM tbl_compratmp WHERE sessao = '$session_id'"));
    $statusCompra = ValorSQL($conn, "SELECT status FROM tbl_compra WHERE id_compra = $codigoCompra");
  }

  // Verifica se o carrinho foi chamado por COMPRAR, EXCLUIR ou FECHAR
  if ($_GET) {
    if (isset($_GET['operacao']) && isset($_GET['id_produto'])) {
      $operacao = $_GET['operacao'];
      $id_produto = $_GET['id_produto'];
      $quantidade = intval(ValorSQL($conn, "SELECT quantidade FROM tbl_carrinho WHERE id_compra = $codigoCompra AND id_produto = $id_produto"));
      if ($operacao === 'incluir') {
        if ($quantidade === 0) {
          ExecutaSQL($conn, "INSERT INTO tbl_carrinho (id_compra, id_produto, quantidade) VALUES ($codigoCompra, $id_produto, 1)");
        } else {
          ExecutaSQL($conn, "UPDATE tbl_carrinho SET quantidade = quantidade + 1 WHERE id_compra = $codigoCompra AND id_produto = $id_produto");
        }
      } else if ($operacao === 'excluir') {
        if ($quantidade <= 1) {
          ExecutaSQL($conn, "DELETE FROM tbl_carrinho WHERE id_compra = $codigoCompra AND id_produto = $id_produto");
        } else {
          ExecutaSQL($conn, "UPDATE tbl_carrinho SET quantidade = quantidade - 1 WHERE id_compra = $codigoCompra AND id_produto = $id_produto");
        }
      } else if ($operacao === 'fechar') {
        // Adicione o código necessário para fechar a compra aqui
      }
    }
  }


  // Mostra os itens do carrinho e o total
  $output = '';

  $output .= "<br><strong>Compras até o momento...</strong><br>
    <table border='1'>
    <tr>
      <td>Produto</td>
      <td>Descrição</td>
      <td>Qtd</td>
      <td>\$ unit</td>
      <td>\$ sub</td>
      <td></td>
    </tr>";

  $sql = "SELECT p.id_produto, 
                p.descricao as descprod, 
                c.quantidade, 
                p.preco, 
                p.preco * c.quantidade as sub  
          FROM tbl_produto p
          INNER JOIN tbl_carrinho c ON p.id_produto = c.id_produto 
          WHERE c.id_compra = $codigoCompra  
          ORDER BY p.descricao ";

  $select = $conn->query($sql);

  $carrinhoProdutos = '';
  while ($linha = $select->fetch()) {
    $id_produto = $linha['id_produto'];
    $nome_produto = $linha['nome'];
    $descProd = $linha['descprod'];
    $quant = $linha['quantidade'];
    $vunit = $linha['preco'];
    $sub = $linha['sub'];
    $imagem = $linha['imagem'];
    

    $carrinhoProdutos .= "<tr>
        <td>$nome_produto</td>
        <td>$descProd</td>
        <td>$quant</td>
        <td>$vunit</td>
        <td>$sub</td>
        <td>$imagem</td>
        <td><a href='carrinho.php?operacao=incluir&id_produto=$id_produto'>Incluir</a></td>
        <td><a href='carrinho.php?operacao=excluir&id_produto=$id_produto'>Excluir</a></td>
      </tr>";
  }

  $output .= $carrinhoProdutos;
  $output .= "</table>";

  $total = ValorSQL($conn, "SELECT SUM(p.preco * c.quantidade) FROM tbl_produto p INNER JOIN tbl_carrinho c ON p.id_produto = c.id_produto WHERE c.id_compra = $codigoCompra");

  $statusCompraHTML = "Status da compra: $statusCompra<br>";
  $totalHTML = "Total: $total <br><br>";

  $fecharCarrinhoHTML = "";
  if ($statusCompra === 'Pendente' && isset($_SESSION['sessaoLogin']) && $_SESSION['sessaoLogin'] !== '') {
    $fecharCarrinhoHTML = "<a href='carrinho.php?operacao=fechar&id_produto=0'>Fechar o carrinho</a>";
  }

  $output .= $statusCompraHTML;
  $output .= $totalHTML;
  $output .= "<br><a href='index.php'>Home</a>";

  return array('carrinhoHTML' => $output, 'total' => $total);
}

