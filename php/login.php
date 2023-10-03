<?php
function adicionarRecursoParaUsuariosLogados()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    if (!isset($_SESSION['sessaoConectado']) || $_SESSION['sessaoConectado'] !== true) {
        // O usuário não está logado, redirecione-o para a página de login
        header('Location: ../html/ec-login.php');
        exit;
    }

    $userId = $_SESSION['userId'];
    $userName = $_SESSION['userName'];
    $userEmail = $_SESSION['userEmail'];
    $userTelefone = $_SESSION['userTelefone'];

    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <link rel='stylesheet' href='../css/style.css' />
      <link rel='stylesheet' href='../css/cabecalho.css' />
      <link rel='icon' href='../img/Logos.svg' />
      <title>Perfil</title>
    </head>
    <body>
      <div class='container'>
        <div class='cabecalho'>
          <img class='logo' src='../img/Logos.svg' />
          <a class='b' href='index.php'>HOME</a>
          <a class='b' href='ec-sobre.php'>SOBRE</a>
          <a class='b' href='ec-telacompra.php'>COMPRAR</a>
          <a href='../html/ec-login.php'><img class='perfil' src='../img/user.png' /></a>
          <a href='../html/ec-carrinho.php'><img class='carrinho' src='../img/cart.png' /></a>
          <a href='../html/perfil.php'><img class='perfil' src='../img/user.png' /></a>
        </div>
      </div>
      <div class='container_geral'>
        <div class='perfil'>
          <img class='foto' src='../img/User.svg' />
          <div class='dados'>
          <table>
            <tr>
              <td>Nome:</td>
              <td>$userName</td>
            </tr>
            <tr>
              <td>Email:</td>
              <td>$userEmail</td>
            </tr>
            <tr>
              <td>Telefone:</td>
              <td>$userTelefone</td>
            </tr>
          </table>
          <div class='centralizar' align='center'>
          <form action='../php/funcoes.php' method='POST'>
            <input type='hidden' name='acao' value='logout'>
            <input type='submit' class='bt' name='logoutButton' id='logoutButton' value='logout'></input>
          </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
  ";
}
