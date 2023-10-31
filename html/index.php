<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/index.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <title>MIPRON</title>
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <?php include "../php/funcoes.php";
    session_start();
    setarCookies();
    exibirConteudoComBaseNoPapel(); ?>
    <div class="esquerda">
      <div class="dentro-esquerda">
        <p class="desc-1"></p>
        <img class="cti" src="../img/Produtos.png" alt="Cadernetas">
      </div>
    </div>
    <div class="direita">
      <div class="dentro-direita">
        <p class="desc-1"></p>
        <img class="cti" src="../img/Mousepad_Viva.jpg" alt="Mousepads">
      </div>
    </div>
    <div class="centro">
      <div class="dentro">
        <div class="desc-produto">
        </div>
        <div class="produto">
        <div class="video-container">
        <iframe class="video" src="https://www.youtube.com/embed/mcVC4B5c1zM" title="Apresentação MIPRON" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
        </div>
      </div>
    </div>
    <div class="baixo">
      <div class="logo1">
        <a name="baixo"><img class="fotoL" src="../img/Logos.svg" alt="Logo Mipron"></a>
      </div>
      <div class="escritaLogo1">
        <div class="escritaL">
          A marca MIPRON foi concebida com base nas iniciais de seus fundadores - MI para Mizael e Miguel, P para Pedro, R para Richard e N para Nicole. A adição da letra O foi feita para conferir à marca um tom e uma sonoridade mais tecnológica, resultando em um tom autêntico.
        </div>
      </div>
      <div class="diferencial">
        <img class="fotoL" src="../img/Logos.svg" alt="Logo Mipron">
      </div>
      <div class="escritaDiferencial">
        <div class="escritaD"> A logo da MIPRON segue a tendência atual do minimalismo objetivo, que é amplamente empregado no design web contemporâneo. Esta abordagem consiste no desenvolvimento da logomarca a partir das letras da própria marca.
        </div>
      </div>
    </div>
  </div>
  <script>
    var images = ["../img/Caderneta_Branca.jpg", "../img/Caderneta_Preta.jpg", "../img/Logos.svg"];
    var currentImage = 0;

    function changeImage() {
      var imgElement = document.querySelector('.prodF');
      currentImage = (currentImage + 1) % images.length;
      imgElement.src = images[currentImage];
    }
  </script>
</body>

</html>