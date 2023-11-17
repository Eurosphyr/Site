<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../php/funcoes.php';
session_start();
$conn = conectarAoBanco();

// Recupere os valores do subtotal, total e id_compra da query string
$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;
$id_compra = isset($_GET['id_compra']) ? $_GET['id_compra'] : null;
$mensagem = "";
echo "<!DOCTYPE html>
<html lang='pt-br'>

<head>
  <meta charset='UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />
  <title>Tela Pagamento</title>
  <link rel='stylesheet' href='../css/telapag.css' />
  <link rel='stylesheet' href='../css/cabecalho.css' />
  <link rel='icon' href='../img/Logos.svg' />
</head>

<body>
  <div class='fundo'></div>";
setarCookies();
exibirConteudoComBaseNoPapel();
echo "
  <div class='container'>
    <div class='tipo'>
      <div>
      </div>
    </div>
    <div class='pagar'>
      <div class='formas-p'>
        <div class='padrao'>
          <p class='esp'>Pagamento em fichas</p>
        </div>
        <div class='linha'></div>
        <div class='total'>
          <!-- Exiba os valores do subtotal e total na tela de pagamento -->
          <p class='esp'><strong>Total</strong></p>
          <p class='esp'>R$" . number_format($total, 2) . "</p>
        </div>
        <!-- Mensagem de confirmação e redirecionamento -->
        <?php echo $mensagem; ?>
        <!-- Formulário para enviar os parâmetros -->
        <form action='' method='GET'>
          <input type='hidden' name='id_compra' value='" . $id_compra . "'>
          <input type='hidden' name='total' value='" . $total . "'>
          <button type='submit' class='bt-compra' name='pagar' value='pagar'>PAGAR</button>
        </form>
      </div>
    </div>
  </div>
  <script>
  function disableScroll() {
    // Pegue a posição atual da barra de rolagem
    var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
    // Adicione estilos à tag <body> para desativar a rolagem
    document.body.style.position = 'fixed';
    document.body.style.top = -scrollPos + 'px';
}
  disableScroll()
  </script>
</body>

</html>";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['total']) && isset($_GET['id_compra']) && isset($_GET['pagar'])) {
  if (isset($_GET['id_compra'])) {
    $sql = "UPDATE tbl_compra SET status = 'PAGO' WHERE id_compra = :id_compra";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
    if ($stmt->execute()) {
      // Remover os dados da tbl_carrinho e tbl_compratmp
      $sql_delete_carrinho = "DELETE FROM tbl_carrinho WHERE id_compra = :id_compra";
      $stmt_delete_carrinho = $conn->prepare($sql_delete_carrinho);
      $stmt_delete_carrinho->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
      $stmt_delete_carrinho->execute();

      $sql_delete_compratmp = "DELETE FROM tbl_compratmp WHERE id_compra = :id_compra";
      $stmt_delete_compratmp = $conn->prepare($sql_delete_compratmp);
      $stmt_delete_compratmp->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
      $stmt_delete_compratmp->execute();

      echo "<script>
        setTimeout(function() {
          alert('Pagamento confirmado. Redirecionando para a página inicial.');
          window.location.href = 'index.php';
        }, 2000);
      </script>";
      exit();
    } else {
      $mensagem = "Houve um problema ao processar o pagamento. Tente novamente mais tarde.";
    }
  } else {
    $mensagem = "Erro: ID da compra não encontrado.";
  }
}

