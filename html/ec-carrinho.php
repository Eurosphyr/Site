<?php
// ec-carrinho.php
include "../php/funcoes.php";

// Conecte-se ao banco de dados
$conn = conectarAoBanco();

if (!$conn) {
  die("Falha na conexão com o banco de dados.");
}

// Recupere todos os produtos
$produtos = recuperarProdutos();

$subtotal = 0;
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
    <div class="cabecalho">
      <img class="logo" src="../img/Logos.svg" />
      <a class="b" href="index.php">HOME</a>
      <a class="b" href="ec-sobre.php">SOBRE</a>
      <a class="b" href="ec-telacompra.php">COMPRAR</a>
      <a href="ec-carrinho.php"><img class="carrinho" src="../img/cart.png" /></a>
      <a href="perfil.php"><img class="perfil" src="../img/user.png" /></a>
    </div>
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
      foreach ($produtos as $index => $produto) :
        $produtoId = $produto['id_produto'];
        $nomeProduto = $produto['nome'];
        $precoProduto = $produto['preco'];
        $quantidadeProduto = isset($_SESSION['carrinho'][$index]) ? $_SESSION['carrinho'][$index] : 0;
        $totalProduto = $precoProduto * $quantidadeProduto;
        $subtotal += $totalProduto;
      ?>
        <div class="prod1">
          <div class="desing-p">
            <div class="ft-prod"></div>
            <p class="nm-prod"><?= $nomeProduto; ?></p>
          </div>
          <div class="desing-v">
            <p class="v-prod">R$<?= number_format($precoProduto, 2); ?></p>
          </div>
          <div class="desing-v">
            <button onclick="diminuirValor(<?= $index; ?>)">-</button>
            <input class="q-prod" id="input-<?= $index; ?>" type="number" value="<?= $quantidadeProduto; ?>" readonly data-valor="<?= $precoProduto; ?>" />
            <button onclick="aumentarValor(<?= $index; ?>)">+</button>
          </div>
          <div class="desing-t">
            <p class="v-prod">R$<?= number_format($totalProduto, 2); ?></p>
          </div>
          <a class="retirar" href="#" onclick="removerProduto(<?= $index; ?>)">Remover</a>
        </div>
      <?php
      endforeach;
      ?>

      <div class="valores">
        <p class="escrita" id="subtotal">Subtotal: R$0.00</p>
        <p class="escrita" id="total">Total: R$0.00</p>
      </div>

    </div>

    <script>
      const input = document.getElementById("meuInput");

      // Defina a taxa de frete (pode ser calculada dinamicamente se necessário)

      // Atualize o subtotal e o total
      let subtotal = 0;
      let total = 0;

      function atualizarTotais() {
        subtotal = 0;

        // Atualize o subtotal com base nos valores individuais dos produtos
        const produtos = document.querySelectorAll(".prod1");
        produtos.forEach((produto, index) => {
          const input = document.getElementById(`input-${index}`);
          const valorProduto = parseFloat(input.getAttribute("data-valor"));
          const quantidade = parseInt(input.value);
          subtotal += valorProduto * quantidade;
        });

        // Atualize o total somando o subtotal e o frete
        total = subtotal;

        // Atualize os elementos HTML correspondentes
        document.getElementById("subtotal").textContent = `Subtotal: R$${subtotal.toFixed(2)}`;
        document.getElementById("total").textContent = `Total: R$${total.toFixed(2)}`;
      }

      function aumentarValor(index) {
        const input = document.getElementById(`input-${index}`);
        input.value = parseInt(input.value) + 1;
        atualizarCarrinho(index, parseInt(input.value));
        atualizarTotais();
      }

      function diminuirValor(index) {
        const input = document.getElementById(`input-${index}`);
        const valorAtual = parseInt(input.value);
        if (valorAtual > 0) {
          input.value = valorAtual - 1;
          atualizarCarrinho(index, parseInt(input.value));
          atualizarTotais();
        }
      }

      function removerProduto(index) {
        const input = document.getElementById(`input-${index}`);
        input.value = 0;
        mostrarOcultarProdutos();
        atualizarCarrinho(index, 0);
        atualizarTotais();
      }

      function atualizarCarrinho(index, quantidade) {
        const produtoId = <?= $produtos[$index]['id_produto']; ?>;
        const formData = new FormData();
        formData.append('action', 'atualizarQuantidade');
        formData.append('produtoId', produtoId);
        formData.append('quantidade', quantidade);

        fetch('ec-carrinho.php', {
            method: 'POST',
            body: formData
          }).then(response => response.text())
          .then(data => {
            // Atualize o subtotal, frete e total aqui (se necessário)
          });
      }

      // Chame a função de atualização de totais inicialmente
      atualizarTotais();


      // Adicione aqui a lógica para calcular o frete e o total

      function mostrarProdutos() {
        const produtos = document.querySelectorAll(".prod1");
        const valorInput = parseInt(input.value);

        if (valorInput > 0) {
          produtos.forEach((produto) => {
            produto.classList.remove("oculto");
          });
        } else {
          produtos.forEach((produto) => {
            produto.classList.add("oculto");
          });
        }
      }

      mostrarProdutos();
    </script>
</body>

</html>