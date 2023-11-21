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
      echo '<script>alert("Erro na conexão com o banco de dados"); window.location.href = "../html/ec-login.php";</script>';
    }

    $sql = "SELECT * FROM tbl_usuario WHERE email = :email AND senha = :senha AND desativado = false";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
      // Dados do usuário encontrados
      $userData = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($userData['tipo_usuario'] == 1) {
        // O usuário é um administrador
        $_SESSION['tipo_usuario'] = true;
      } else {
        // O usuário não é um administrador
        $_SESSION['tipo_usuario'] = false;
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
        exibirConteudoComBaseNoPapel(); 
      } else {
        header('Location: ../html/index.php');
        exibirConteudoComBaseNoPapel();
      }
      exit;
    } else {
      echo '<script>alert("Credenciais inválidas ou conta desativada. Por favor, tente novamente.");
      window.location.href = "../html/ec-login.php";
      </script>';
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
        <div class='baixo'><a href='index.php'>Voltar</a></div>
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
        echo "<td><a href='../php/excluir_produtos.php?id=" . $id_produto . "&acao=excluir'><img src='../img/excluir.png' alt='Excluir' width='30'></a></td>";
        echo "<td><a href='../php/alterar_dados_produtos.php?id=" . $id_produto . "&acao=alterar'><img src='../img/alterar.png' alt='Alterar' width='30'></a></td>";
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
        <a href= 'index.php'><img class='logo' src='../img/Logos.svg' alt='Logo' /></a>
        <a href='index.php'><input type = 'button' class='b' value='HOME'></a>
        <a  href='ec-sobre.php'><input type = 'button' class='b' value='SOBRE'></a>
        <a  href='ec-telacompra.php'><input type = 'button' class='b' value='COMPRAR'></a>
        <a  href='ec-crud.php'><input type = 'button' class='b' value='CRUD PRODUTOS'></a>
        <a  href='ec-crud_usuarios.php'><input type = 'button' class='b' value='CRUD USUÁRIOS'></a>
        <a  href='ec-carrinho.php'><img class='carrinho' src='../img/cart.png' alt='Carrinho' /></a>
        <a  href='ec-perfil.php'><img class='perfil' src='../img/user.png' alt='Perfil' /></a>
      </div>
      ";
  } else {
    // O usuário não é um administrador
    echo "
      <div class='cabecalho'>
        <a href= 'index.php'><img class='logo' src='../img/Logos.svg' alt='Logo' /></a>
        <a  href='index.php'><input type = 'button' class='b' value='HOME'></a>
        <a  href='ec-sobre.php'><input type = 'button' class='b' value='SOBRE'></a>
        <a  href='ec-telacompra.php'><input type = 'button' class='b' value='COMPRAR'></a>
        <a  href='ec-carrinho.php'><img class='carrinho' src='../img/cart.png' alt='Carrinho' /></a>
        <a  href='ec-perfil.php'><img class='perfil' src='../img/user.png' alt='Perfil' /></a>
      </div>
      ";
  }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function enviaEmail($pDestinatario, $pNome, $pAssunto, $pHtml)
{
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/SMTP.php';

  //Variaveis de configuração do email(DEVE SER ALTERADO)
  $pRemetente = "mipron@projetoscti.com.br";
  $pSenha = "M1#pr0n2023";
  $pSMTP = "smtp.projetoscti.com.br";

  //Configuração do PHP, para exibir erros
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  try {
    $mail = new PHPMailer(); //Instancia a classe PHPMailer

    //Configuração do servidor de email
    $mail->IsSMTP(); //Define que a mensagem será SMTP
    $mail->Host = $pSMTP; //Endereço do servidor SMTP
    $mail->SMTPAuth = true; //Autenticação SMTP    
    $mail->SMTPSecure = 'tls'; //Tipo de segurança
    $mail->Port = 587; //Porta de comunicação SMTP
    $mail->Username = $pRemetente; //Usuário do servidor SMTP
    $mail->Password = $pSenha; //Senha do servidor SMTP
    $mail->SMTPDebug = 2; //Habilita o debug do SMTP
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verificar_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    ); //Permite que o PHPMailer aceite certificados SSL não confiáveis

    //Configuração dos emails do remetente e do destinatário
    $mail->setFrom($pRemetente, 'Mipron'); //email do remetente
    $mail->addReplyTo($pUsuario); //Email para respossta, caso não queira que o usuário responda, coloque no.reply@...
    $mail->addAddress($pDestinatario, $pNome); //email do destinatário

    //Conteúdo do email
    $mail->IsHTML(true); //Se o email vai ser em HTML ou não 
    $mail->Subject = $pAssunto; //O assunto do email
    $mail->Body = $pHtml; //O conteúdo(corpo) do email em HTML
    $mail->CharSet = 'UTF-8'; //Codificação do email
    $mail->AltBody = 'seu email nao suporta html'; //Uma mensagem avisando destinatário que o seu email não suporta HTML
    $enviado = $mail->Send(); //Envia o email

    //Verifica se o email foi enviado
    if ($enviado) {
      echo "E-mail enviado com sucesso!";
    } else {
      echo "Não foi possível enviar o e-mail.";
      echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
    }

    //Execeções da biblioteca PHPMailer e do PHP(Instaciamento da classe exception)
  } catch (Exception $e) {
    echo $e->errorMessage(); //mensagens de erro do PHPMailer 
  } catch (\Exception $e) {
    echo $e->getMessage(); //mensagens de erro do PHP
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

function CriaPDF($paramTitulo, $paramHtml, $paramArquivoPDF)
{
  $arq = false;
  try {
    require "fpdf/html_table.php";
    // abre classe fpdf estendida com recurso que converte <table> em pdf

    $pdf = new PDF();
    // cria um novo objeto $pdf da classe 'pdf' que estende 'fpdf' em 'html_table.php'
    $pdf->AddPage();  // cria uma pagina vazia
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Write(5, $paramTitulo);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->WriteHTML($paramHtml); // renderiza $html na pagina vazia
    ob_end_clean();
    // fpdf requer tela vazia, essa instrucao 
    // libera a tela antes do output

    // gerando um arquivo 
    $pdf->Output($paramArquivoPDF, 'F');
    // gerando um download 
    $pdf->Output('D', $paramArquivoPDF);  // disponibiliza o pdf gerado pra download
    $arq = true;
  } catch (Exception $e) {
    echo $e->getMessage(); // erros da aplicação - gerais
  }
  return $arq;
}
