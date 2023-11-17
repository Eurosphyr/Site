<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link type="text/css" rel="stylesheet" href="../css/index.css">
  <link type="text/css" rel="stylesheet" href="../css/cabecalho.css">
  <title>Mipron</title>
  <link rel="icon" href="../img/Logos.svg">

</head>

<body>
  <div class="container">
    <?php 
    include("../php/funcoes.php");
    setarCookies();
    exibirConteudoComBaseNoPapel();
    ?>
    <div class="centro">
      <div class="prods">
        <img class="setaL" id="setaL" src="../img/seta_esquerda.png" alt="Seta Esquerda">
        <div class="meio1" id="meio1">
          <div class="textdesc">
            <p class="text1">MousePadGamer</p>
            <p class="text2">Um texto meio aleatório e chamativo</p>
          </div>
          <img class="imagem" src="../img/Mousepad_Viva.jpg" alt="Mousepad Viva" class="prod">
        </div>
        <div class="meio2" id="meio2">
          <div class="textdesc">
            <p class="text1">Caderneta</p>
            <p class="text2">Um texto muito aleatório e chamativo</p>
          </div>
          <img class="imagem" src="../img/Caderneta_Preta.jpg" alt="Caderneta Preta" class="prod">
        </div>
        <img class="setaR" id="setaR" src="../img/seta_direita.png" alt="Seta Direita">
      </div>
    </div>
    <div class="baixo">
      <div class="p-2">
        <img class="imagem2" src="../img/Caderneta_Branca.jpg" alt="Caderneta Branca">
        <iframe src="https://www.youtube.com/embed/mcVC4B5c1zM?si=klTZMep_9E02peG2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
        </iframe>
        <img class="imagem2" src="../img/Mousepad_Viva.jpg" alt="Mousepad Viva">
        <div class="luz"></div>
      </div>
    </div>
    <div class="rodape">
      <div class="most">
        <div class="redes">
          <img src="../img/logo-MIPRON.jpeg" alt="Logo MIPRON">
          <span class="background">
            <span class="social-media-buttons">
              <span class="social-media-button">
                <a href="https://www.instagram.com/mipron_startup/"><img src="../img/instagram.png" alt="Instagram"></a>
              </span>
            </span>
          </span>
        </div>
        <div class="mebros">
          <p class="desen">Desenvolvedores</p>
          <div class="traco1"></div>
          <p class="p">Miguel Angelo de Lima Godoi - Gerente Financeiro / Email: miguel.godoi@unesp.br</p>
          <p class="p">Mizael Martins Barreto - Gerente de Marketing / Email: mizael.martins@unesp.br</p>
          <p class="p">Nicole dos Santos Quadros - Gerente de Qualidade / Email: n.quadros@unesp.br</p>
          <p class="p">Pedro Augusto de Oliveira Galdino Ribeiro - Líder / Email: paog.ribeiro@unesp.br</p>
          <p class="p">Richard Walace de Oliveira Camargo - Líder Técnico e Gerente de Produção / Email:
            rwo.camargo@unesp.br</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    var sR = document.getElementById("setaR");
    var sL = document.getElementById("setaL");
    var class1 = document.querySelector(".meio1");
    var class2 = document.querySelector(".meio2");
    var visivel = false;

    function clicarR() {
      if (visivel == false) {
        class2.style.opacity = "1";
        class1.style.opacity = "0";
      } else {
        class1.style.opacity = "1";
        class2.style.opacity = "0";
      }
      visivel = !visivel;
    }

    function clicarL() {
      if (visivel == false) {
        class2.style.opacity = "1";
        class1.style.opacity = "0";
      } else {
        class1.style.opacity = "1";
        class2.style.opacity = "0";
      }
      visivel = !visivel;
    }
    sR.addEventListener("click", clicarR);
    sL.addEventListener("click", clicarL);
  </script>
</body>

</html>