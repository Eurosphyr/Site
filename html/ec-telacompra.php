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
    <div class="cabecalho">
      <img class="logo" src="../img/Logos.svg" />
      <a class="b" href="index.php">HOME</a>
      <a class="b" href="ec-sobre.php">SOBRE</a>
      <a class="b" href="ec-telacompra.php">COMPRAR</a>
      <a href="ec-login.php"><img class="perfil" src="../img/user.png" /></a>
      <a href="ec-carrinho.php"><img class="carrinho" src="../img/cart.png" /></a>
      <a href="perfil.php"><img class="perfil" src="../img/user.png" /></a>
    </div>
    <div class="ft-prod1 imagem-wrapper">
      <div class="zoom"><img class="prod" id="zoomImg" src="../img/mousepad.png" onclick="proximaImagem()" /></div>

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
        <a href="ec-carrinho.php" class="bt-comprar tipo2">Adicionar ao carrinho</a>
        <a href="">
          <p class="tipo2">Comprar agora</p>
        </a>
      </div>
    </div>
    <div class="imgs-prod">
      <div class="setas">
        <img id="seta-esquerda" class="setas seta-esquerda" src="../img/seta_esquerda.svg" alt="Seta Esquerda" onclick="imagemAnterior()" />
        <img class="prod2" src="../img/mousepad_front.png" />
        <img class="prod2" src="../img/mousepad.png" />
        <img class="prod2" src="../img/mini_mousepad.png" />
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
  </script>
</body>

</html>