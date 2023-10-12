<?php
include "../php/funcoes.php";
$produtoId = 3;
$produtoNome = "Mousepad Azul";
$precoProduto = 6.00;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tela de Compra</title>
  <link rel="stylesheet" href="../css/telacompra.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="icon" href="../img/Logos.svg" />
  <script src="../php/script.js"></script>
</head>

<body>
  <div class="container">
    <div class="nada"></div>
    <?php
    session_start();
    setarCookies();
    exibirConteudoComBaseNoPapel(); ?>
    </div>
    <div class="ft-prod1 imagem-wrapper">
      <div class="zoom"><img class="prod" id="zoomImg" src="../img/mousepad.png" alt="Mousepad" onclick="proximaImagem()" /></div>

    </div>
    <div class="desc">
      <p class="titulo-prod">Mousepad Preto</p>
      <p class="desc-prod">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
        ante leo, tempus quis dignissim at, ullamcorper at quam. Mauris
        eleifend congue lectus ac luctus.
      </p>
    </div>
    <div class="compra-prod">
      <div class="compra">
        <p class="preco">R$5,99</p>
        <?php $produtoId = 3; ?>
        <a href="ec-carrinho.php" onclick="adicionarAoCarrinho(<?= $produtoId ?>, '<?= $produtoNome ?>', <?= $precoProduto ?>)">Adicionar ao Carrinho</a>
        <a href="">
          <input type="hidden" id="produtos-carrinho" name="produtos-carrinho" value="">

          <p class="tipo2">Comprar agora</p>
        </a>
      </div>
    </div>
    <div class="imgs-prod">
      <div class="setas">
        <img id="seta-esquerda" class="setas seta-esquerda" src="../img/seta_esquerda.svg" alt="Seta Esquerda" onclick="imagemAnterior()" />
        <img class="prod2" src="../img/mousepad_front.png" alt="Mousepad Frente" />
        <img class="prod2" src="../img/mousepad.png" alt="Mousepad" />
        <img class="prod2" src="../img/mini_mousepad.png" alt="Mini Mousepad" />
        <img id="seta-direita" class="setas seta-direita" src="../img/seta_direita.svg" alt="Seta Direita" onclick="proximaImagem()" />
      </div>


    </div>
    <div class="esp">
      <p>Especificações Técnicas</p>
      <p class="desc-esp">
        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
        posuere cubilia curae; Nam efficitur in lorem quis vulputate. Praesent
        iaculis, sapien at dapibus luctus, lorem nisi ultrices arcu, eget
        finibus ipsum arcu eget nibh. Vestibulum cursus nec ante id facilisis.
        Fusce nec rutrum velit. Quisque nunc massa, porttitor nec nibh sed,
        tincidunt lacinia felis. Mauris ornare lectus mi, quis sagittis libero
        consequat at. Aliquam interdum risus sit amet mi faucibus luctus.
        Aenean tincidunt justo at pulvinar faucibus.
      </p>
    </div>
    <div class="video">
      <p>Video do produto</p>
      <iframe class="video-css" src="https://www.youtube.com/embed/faoDlV3YlFE" title="Star Wars: Duel of The Fates | EPIC VERSION (Remastered V2)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </iframe>
    </div>
  </div>
  <script>
    var imagens = [
      "../img/mousepad.png",
      "../img/mousepad_front.png",
      "../img/mini_mousepad.png"
    ];

    var imagemAtual = 0;

    function exibirImagemAtual() {
      var imagemPrincipal = document.getElementById('zoomImg');
      imagemPrincipal.src = imagens[imagemAtual];
    }

    function proximaImagem() {
      imagemAtual = (imagemAtual + 1) % imagens.length;
      exibirImagemAtual();
    }

    function imagemAnterior() {
      imagemAtual = (imagemAtual - 1 + imagens.length) % imagens.length;
      exibirImagemAtual();
    }

    exibirImagemAtual();

    const carrinho = [];
    let totalCarrinho = 0;

    function adicionarAoCarrinho(nomeProduto, precoProduto) {
      carrinho.push({
        nome: nomeProduto,
        preco: precoProduto
      });
      totalCarrinho += precoProduto;
      atualizarCarrinho();

      // Crie uma lista de produtos em formato JSON
      const listaProdutosJSON = JSON.stringify(carrinho);

      // Atualize o valor do campo de entrada oculto com a lista de produtos
      document.getElementById("produtos-carrinho").value = listaProdutosJSON;
    }

    function atualizarCarrinho() {
      const itensCarrinho = document.getElementById("itens-carrinho");
      const totalCarrinhoElement = document.getElementById("total-carrinho");

      itensCarrinho.innerHTML = "";
      carrinho.forEach(item => {
        const li = document.createElement("li");
        li.textContent = `${item.nome} - R$ ${item.preco.toFixed(2)}`;
        itensCarrinho.appendChild(li);
      });

      totalCarrinhoElement.textContent = totalCarrinho.toFixed(2);
    }

    function verCarrinho() {
      // Redirecione o usuário para ec-carrinho.php com os produtos no carrinho na URL
      const listaProdutosJSON = document.getElementById("produtos-carrinho").value;
      window.location.href = `ec-carrinho.php?produtos=${encodeURIComponent(listaProdutosJSON)}`;
    }
    // Função para adicionar um produto ao carrinho
    function adicionarAoCarrinho(idProduto, nomeProduto, precoProduto) {
      // Verifique se o produto já está no carrinho
      var produtoExistente = carrinho.find(item => item.id === idProduto);
      if (produtoExistente) {
        produtoExistente.quantidade++;
      } else {
        carrinho.push({
          id: idProduto,
          nome: nomeProduto,
          preco: precoProduto,
          quantidade: 1
        });
      }

      totalCarrinho += precoProduto;
      atualizarCarrinho();
    }
  </script>
</body>

</html>