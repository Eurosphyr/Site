<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nós</title>
  <link type="text/css" rel="stylesheet" href="../css/sobre.css" />
  <link type="text/css" rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="stylesheet" href="../css/rodape.css" />
  <link rel="icon" href="../img/Logos.svg">
</head>

<body>
  <div class="container">
    <a id="topo"></a>
    <?php
    include("../php/funcoes.php");
    session_start();
    setarCookies();
    exibirConteudoComBaseNoPapel();
    ?>
    <div class="sobre">
      <div class="s">
        <div class="tSN">Nós</div>
        <div class="tSP">Professores</div>
        <div class="tSSN">Somos</div>
      </div>
    </div>
    <div class="part-img2">
      <div class="imagem2"></div>
    </div>
    <div class="escrita2">
      <div class="escritaD">
        A logo da MIPRON baseia se na
        tendência mais que atual do
        minimalismo objetivo,
        que atualmente é a técnica mais
        dominante no meio da web design
        que trata se no
        desenvolvimento da logo a partir
        das letras da marca,
        transformando as letras da
        marca numa logomarca única e
        que demarque nosso símbolo para
        todos que o
        verem, sem nos confundirem com
        outras empresas. Para manter o
        objetivo
        minimalista aplicamos o positivo e
        negativo com o preto em branco
        que se aplicou
        facilmente sob nossa palheta de
        cores selecionada.
      </div>
    </div>
    <div class="part-banner">
      <div class="banner"></div>
    </div>
    <div class="grupo">
      <p class="nos">Grupo de Desenvolvedores</p>
      <div class="p1">
        <img class="imagemf" src="p1.jpeg">
        <p>Miguel Angelo de Lima Godoi - Gerente Financeiro / Email: miguel.godoi@unesp.br</p>
      </div>
      <div class="p2">
        <img class="imagemf" src="p2.jpeg">
        <p>Mizael Martins Barreto - Gerente de Marketing / Email: mizael.martins@unesp.br</p>
      </div>
      <div class="p3">
        <img class="imagemf" src="p3.jpeg">
        <p>Nicole dos Santos Quadros - Gerente de Qualidade / Email: n.quadros@unesp.br</p>
      </div>
      <div class="p4">
        <img class="imagemf" src="p4.jpeg">
        <p>Pedro Augusto de Oliveira Galdino Ribeiro - Líder / Email: paog.ribeiro@unesp.br</p>
      </div>
      <div class="p5">
        <img class="imagemf" src="p5.jpeg">
        <p>Richard Walace de Oliveira Camargo - Líder Técnico e Gerente de Produção / Email: rwo.camargo@unesp.br</p>
      </div>
    </div>
  </div>
  <div class="rodape">
    <div class="most">
      <div class="redes">
        <img src="../img/Mipron.png" alt="Logo MIPRON">
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
    <div class="menu">
      <p class="menuT">Menu</p>
      <div class="menud">
        <a href="index.php">
          <p class="vt">Home</p>
        </a>
        <a href="ec-sobre.php">
          <p class="vt">Sobre</p>
        </a>
        <a href="ec-telacompra.php">
          <p class="vt">Comprar</p>
        </a>
        <a href="#topo"><img width="100" src="../img/seta_cima.png"></a>
      </div>
    </div>
  </div>
</body>
</html>
