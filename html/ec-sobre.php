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
      <div class="f">
        <img class="setaL" id="setaL" src="../img/seta_esquerda.png" alt="Seta Esquerda">
        <div class="nos">
          <div class="dl d" id="f1">
            <img class="ft" src="../img/fotos/p1.jpeg">
          </div>
          <div class="dm d" id="f2">
            <img class="ft" src="../img/fotos/p2.jpeg">
          </div>
          <div class="d3 d" id="f3">
            <img class="ft" src="../img/fotos/p3.jpeg">
          </div>
          <div class="dm d" id="f4">
            <img class="ft" src="../img/fotos/p4.jpeg">
          </div>
          <div class="dl d" id="f5">
            <img class="ft" src="../img/fotos/p5.jpeg">
          </div>
        </div>
        <div class="prof">
          <div class="pl d" id="p1">
            <img class="ft" src="../img/fotos/pcastro.jpeg" alt="Professor Castro">
          </div>
          <div class="pm d" id="p2">
            <img class="ft" src="../img/fotos/pdebora.jpeg" alt="Professora Débora">
          </div>
          <div class="p3 d" id="p3">
            <img class="ft" src="../img/fotos/pjose.jpeg" alt="Professor José">
          </div>
          <div class="pm d" id="p4">
            <img class="ft" src="../img/fotos/pjovita.jpeg" alt="Professora Jovita">
          </div>
          <div class="pl d" id="p5">
            <img class="ft" src="../img/fotos/pcabello.jpg" alt="Professor Cabello">
          </div>
        </div>
        <div class="somos">
          <div class="sms1 smsf1">
            <img src="../img/logo-MIPRON.jpeg" class="logo-s" alt="Logo MIPRON">
          </div>
          <div class="sms1 smst">
            <p class="t2" align="center">Nossa Logo</p>
            <p class="txt1">
              O logotipo da MIPRON reflete a tendência atual
              do minimalismo objetivo, que é amplamente dominante no design web.
              Nossa abordagem para desenvolver o logotipo é transformar as
              letras da marca em uma logomarca única que seja facilmente identificável e
              distinta de outras empresas. Para manter o estilo minimalista,
              usamos variações em preto e branco que se integram perfeitamente
              à nossa paleta de cores escolhida.</p>
          </div>
          <div class="sms1 smsf2">
            <img src="../img/fotos/Vivacti.png" class="logo-v" alt="Logo Vivacti">
          </div>
          <div class="sms1 sms">
            <p class="t2" align="center">Quem somos?</p>
            <p class="txt2">
              A marca MIPRON tem suas raízes profundas na identidade
              de seus fundadores: MI para Mizael e Miguel, P para Pedro,
              R para Richard e N para Nicole. A inclusão da letra O foi
              uma decisão estratégica para conferir à marca um tom e uma
              sonoridade mais tecnológica, o que a torna autêntica e
              sintonizada com os avanços tecnológicos. Isso é reflexo do
              compromisso da MIPRON em manter uma identidade singular
              que ressoa com a era digital e incorpora a essência de seus criadores.</p>
          </div>
        </div>
        <img class="setaR" id="setaR" src="../img/seta_direita.png" alt="Seta Direita">
      </div>
      <div class="explic1">
        <div class="sobreD sobreD1">
          <p class="sob"><strong>Nome: </strong>Miguel Angelo de Lima Godoi</p>
          <p class="sob"><strong>Função: </strong>Gerente Financeiro</p>
        </div>
        <div class="sobreD sobreD2">
          <p class="sob"><strong>Nome: </strong>Mizael Martins Barreto</p>
          <p class="sob"><strong>Função: </strong>Gerente de Marketing</p>
        </div>
        <div class="sobreD sobreD3">
          <p class="sob"><strong>Nome: </strong>Nicole dos Santos Quadroz</p>
          <p class="sob"><strong>Função: </strong>Gerente de Qualidade</p>
        </div>
        <div class="sobreD sobreD4">
          <p class="sob"><strong>Nome: </strong>Pedro Augusto de Oliveira Galdino Ribeiro</p>
          <p class="sob"><strong>Função: </strong>Gerente Geral</p>
        </div>
        <div class="sobreD sobreD5">
          <p class="sob"><strong>Nome: </strong>Richard Walace de Oliveira Camargo</p>
          <p class="sob"><strong>Função: </strong>Gerente de Produção e Gerente Técnico</p>
        </div>
      </div>
      <div class="explic2">
        <div class="sobreP sobreP1">
          <p class="sob"><strong>Nome: </strong>André Luiz Ferraz Castro</p>
          <p class="sob"><strong>Matéria: </strong>Cordenador do Curso</p>
        </div>
        <div class="sobreP sobreP2">
          <p class="sob"><strong>Nome: </strong>Debora Barbosa Aires</p>
          <p class="sob"><strong>Matéria: </strong>Aplicativos I</p>
        </div>
        <div class="sobreP sobreP3">
          <p class="sob"><strong>Nome: </strong>José Vieira Junior</p>
          <p class="sob"><strong>Matéria: </strong>Banco de Dados</p>
        </div>
        <div class="sobreP sobreP4">
          <p class="sob"><strong>Nome: </strong>Jovita Mercedes Hojas Baenas</p>
          <p class="sob"><strong>Matéria: </strong>Gestão de Negócios</p>
        </div>
        <div class="sobreP sobreP5">
          <p class="sob"><strong>Nome: </strong>Marcelo Cabello Peres</p>
          <p class="sob"><strong>Matéria: </strong>PHP</p>
        </div>
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
  <script src="../php/jstst1.js"></script>
  <script src="../php/jstst2.js"></script>
  <script src="../php/jstst3.js"></script>
  </div>
</body>

</html>