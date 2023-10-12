<?php
// ec-carrinho.php
session_start();
include "../php/funcoes.php";

$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;
$produtoId = isset($_GET['produto_id']) ? $_GET['produto_id'] : null;
$produtoNome = isset($_GET['produto_nome']) ? urldecode($_GET['produto_nome']) : null;
$produtoPreco = isset($_GET['produto_preco']) ? floatval($_GET['produto_preco']) : null;

$conn = conectarAoBanco();

if (!$conn) {
  die("Falha na conexão com o banco de dados.");
}

// Recupere todos os produtos
$produtos = recuperarProdutos();

$subtotal = 0;
$produtosJSON = isset($_GET['produtos']) ? $_GET['produtos'] : null;
$produtosNoCarrinho = [];

if ($produtosJSON) {
  $produtosNoCarrinho = json_decode(urldecode($produtosJSON), true);
}


$produtosNoCarrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : [];



if (isset($_GET['produto_id'], $_GET['produto_nome'], $_GET['produto_preco'])) {
  $produtoId = $_GET['produto_id'];
  $produtoNome = $_GET['produto_nome'];
  $produtoPreco = floatval($_GET['produto_preco']);

  // Adicione o produto ao carrinho
  if (isset($produtosNoCarrinho[$produtoId])) {
    // Se o produto já estiver no carrinho, aumente a quantidade
    $produtosNoCarrinho[$produtoId]['quantidade']++;
  } else {
    // Se o produto não estiver no carrinho, adicione-o ao carrinho
    $produtosNoCarrinho[$produtoId] = [
      'nome' => $produtoNome,
      'preco' => $produtoPreco,
      'quantidade' => 1,
    ];
  }

  // Atualize a sessão com o carrinho atualizado
  $_SESSION['carrinho'] = $produtosNoCarrinho;

  // Redirecione o usuário de volta para a página de compra
  header("Location: ec-telacompra.php");
  exit();
}
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
        setarCookies(); 
        exibirConteudoComBaseNoPapel();?>
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
      <form id="formulario-pagamento" action="ec-telapag.php" method="get" style="display: none;">
        <input type="hidden" name="subtotal" id="input-subtotal" value="">
        <input type="hidden" name="total" id="input-total" value="">
      </form>

      <a href="#" id="botao-pagar" class="comprar" onclick="enviarFormularioPagamento(); return false;">Pagar</a>



    </div>

    <script>
      const input = document.getElementById("meuInput");
      let subtotal = 0;
      let total = 0;

      function atualizarTotais() {
        subtotal = 0;


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

        const botaoPagar = document.getElementById("botao-pagar");
        if (subtotal > 0) {
          botaoPagar.style.display = "block";
        } else {
          botaoPagar.style.display = "none";
        }
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

      function atualizarCarrinhoNaInterface() {
        var carrinhoContainer = document.getElementById("carrinho");

        // Limpe o conteúdo atual do carrinho
        carrinhoContainer.innerHTML = "";

        // Preencha o carrinho com os produtos
        carrinho.forEach(function(produto) {
          var produtoDiv = document.createElement("div");
          produtoDiv.classList.add("produto-no-carrinho");

          var nomeDiv = document.createElement("div");
          nomeDiv.textContent = "Nome: " + produto.nome;

          var precoDiv = document.createElement("div");
          precoDiv.textContent = "Preço: R$ " + produto.preco.toFixed(2);

          var quantidadeDiv = document.createElement("div");
          quantidadeDiv.textContent = "Quantidade: " + produto.quantidade;

          produtoDiv.appendChild(nomeDiv);
          produtoDiv.appendChild(precoDiv);
          produtoDiv.appendChild(quantidadeDiv);

          carrinhoContainer.appendChild(produtoDiv);
        });
      }



      function enviarFormularioPagamento() {
        // Defina os valores de subtotal e total nos campos do formulário
        document.getElementById("input-subtotal").value = subtotal.toFixed(2);
        document.getElementById("input-total").value = total.toFixed(2);

        // Envie o formulário
        document.getElementById("formulario-pagamento").submit();
      }


      mostrarProdutos();
    </script>
</body>

</html>