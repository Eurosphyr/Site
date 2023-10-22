<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
include "../php/funcoes.php";

$conn = conectarAoBanco();
// Certifique-se de que a conexão com o banco de dados foi estabelecida
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produto'])) {
  $id_produto = intval($_GET['id_produto']);

  // Use o ID do produto para pesquisar no banco de dados
  $conn = conectarAoBanco();
  $stmt = $conn->prepare("SELECT * FROM tbl_produto WHERE id_produto = :id");
  $stmt->bindParam(':id', $id_produto);
  $stmt->execute();
  $produto = $stmt->fetch();

  // Verifique se a consulta encontrou um produto
  if ($produto) {
    // Use os dados do produto conforme necessário
    $id_produto = $produto['id_produto'];
    $nome_produto = $produto['nome'];
    $vunit = $produto['preco'];
    $quant = 1;
    $imagem = $produto['imagem'];
    $total = $vunit * $quant;
    // ... e assim por diante
  }
}

if (!$conn) {
  die("Falha na conexão com o banco de dados.");
}

if (isset($_POST['action']) && $_POST['action'] === 'atualizarQuantidade') {
  $id_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : null;
  $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;

  // Adicione o código para atualizar a quantidade do produto no carrinho aqui
  if ($id_produto !== null && $quantidade !== null) {
    if ($quantidade === 0) {
      $codigoCompra = 1; // Defina o valor adequado para $codigoCompra
      ExecutaSQL($conn, "DELETE FROM tbl_carrinho WHERE fk_cod_produto = $id_produto AND fk_cod_compra = $codigoCompra");
    } else {
      $codigoCompra = 1; // Defina o valor adequado para $codigoCompra
      ExecutaSQL($conn, "UPDATE tbl_carrinho SET quantidade = $quantidade WHERE fk_cod_produto = $id_produto AND fk_cod_compra = $codigoCompra");
    }
  }
}


// Chamada da função carrinhoCompras
carrinhoCompras($conn);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho</title>
  <link rel="stylesheet" href="../css/carrinho.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <?php
    $conn = conectarAoBanco();
    setarCookies();
    exibirConteudoComBaseNoPapel(); ?>
    <div class="apresentacao">
      <img class="foto-ca" src="../img/cart_circle.png" />
      <div class="escrita-ca">
        <div class="reta1"></div>
        <p class="carrinho">Carrinho</p>
        <div class="reta2"></div>
      </div>
    </div>


    <div class="produtos">
      <p class="font escrita-p">Produto</p>
      <p class="font escrita-v">Valor</p>
      <p class="font escrita-q">Quant</p>
      <p class="font escrita-t">Total</p>

      <?php
      if (isset($id_produto) && isset($vunit) && isset($nome_produto) && isset($quant) && isset($imagem)) {
        echo "<div class='prod1'>
            <div class='desing-p'>
                <div class='ft-prod'><img src='$imagem' alt='imagem_produto' class='ft-prod'></div>
                <p class='nm-prod'>$nome_produto</p>
            </div>
            <div class='desing-v'>
                <p class='v-prod'>R$" . number_format($vunit, 2) . "</p>
            </div>
            <div class='desing-v'>
                <button onclick='diminuirQuantidade($id_produto)'>-</button>
                <input class='q-prod' id='input-$id_produto' type='number' value='$quant' readonly data-valor='$vunit' />
                <button onclick='adicionarQuantidade($id_produto)'>+</button>
            </div>
            <div class='desing-t'>
                <p class='v-prod'>R$" . number_format($total, 2) . "</p>
            </div>
            <a class='retirar' href='#' onclick='removerProduto($id_produto)'>Remover</a>
        </div>";
      } else {
        echo "<p class=''>Não há produtos no carrinho.</p>";
      }
      ?>

      <div class="valores">
        <p class="escrita" id="subtotal">Subtotal: R$<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?></p>
        <p class="escrita" id="total">Total: R$<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?></p>
      </div>
      <form id="formulario-pagamento" action="ec-telapag.php" method="get" style="display: none;">
        <input type="hidden" name="subtotal" id="input-subtotal" value="<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?>">
        <input type="hidden" name="total" id="input-total" value="<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?>">
        <button type="submit" id="btn-submit" style="display: none;"></button>
      </form>
      <button onclick="atualizarEEnviarFormularioPagamento()" class="pagar">Pagar</button>
    </div>
  </div>
  <script>
    function atualizarEEnviarFormularioPagamento() {
      var totalElement = document.getElementById('total');
      var total = totalElement.textContent.replace('Total: R$', '');
      enviarFormularioPagamento(total);
    }

    function enviarFormularioPagamento(total) {
      var totalFormatted = parseFloat(total).toFixed(2);

      document.getElementById("input-subtotal").value = totalFormatted;
      document.getElementById("input-total").value = totalFormatted;
      document.getElementById("formulario-pagamento").submit();
    }

    function adicionarQuantidade(id_produto) {
      var input = document.getElementById('input-' + id_produto);
      if (input) {
        var valor = input.getAttribute('data-valor');
        var quantidade = parseInt(input.value);
        quantidade++;
        input.value = quantidade;
        atualizarTotal(id_produto, quantidade, valor);
      } else {
        console.error('Elemento não encontrado.');
      }
    }

    function diminuirQuantidade(id_produto) {
      var input = document.getElementById('input-' + id_produto);
      if (input) {
        var valor = input.getAttribute('data-valor');
        var quantidade = parseInt(input.value);
        if (quantidade > 0) {
          quantidade--;
          input.value = quantidade;
          atualizarTotal(id_produto, quantidade, valor);
        }
      } else {
        console.error('Elemento não encontrado.');
      }
    }

    function atualizarTotal(id_produto, quantidade, valorUnitario) {
      var totalElement = document.getElementById('total');
      var subtotalElement = document.getElementById('subtotal');
      var total = parseFloat(quantidade) * parseFloat(valorUnitario);

      totalElement.textContent = "Total: R$" + total.toFixed(2);
      subtotalElement.textContent = "Subtotal: R$" + total.toFixed(2);
    }
  </script>
</body>

</html>