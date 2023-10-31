<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nós</title>
  <link rel="stylesheet" href="../css/sobre.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <?php include '../php/funcoes.php';
    session_start();
    exibirConteudoComBaseNoPapel(); ?>
    <div class="sobre">
      <div class="apresentacao">Sobre Nós</div>
      <div class="linha"></div>
    </div>
    <div class="part-img1">
      <div class="imagem1">
        <div class="logo">
          <img src="../img/Logos.svg" alt="Logo" class="imagem1" />
        </div>
      </div>
    </div>
    <div class="escrita1">
      <div class="escritaL">
        A marca MIPRON foi criada a partir
        das iniciais de seus fundadores MI
        para Mizael e
        Miguel, P para Pedro, R para
        Richard e N para Nicole, a letra O
        foi inserida para dar
        a marca o tom e sonoridade mais
        tecnológico, deste modo a marca
        ganha um tom
        autêntico com uma sonoridade
        mais tecnológica.
      </div>
    </div>
    <div class="part-img2">
      <div class="imagem2">
        <div class="logo">
          <img src="../img/Logos.svg" alt="Logo"  class="imagem2"/>
        </div>
      </div>
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
      <div class="banner">
        <img src="../img/banner.jpg" alt="Banner" class="banner" />
      </div>
    </div>
    <div class="grupo">
      <p class="nos">Grupo de Desenvolvedores</p>
      <div class="p1">
        <img class="imagemf" src="../img/fotos/Miguel.jpg">
        <p>Miguel Angelo de Lima Godoi - Gerente Financeiro / Email: miguel.godoi@unesp.br</p>
      </div>
      <div class="p2">
        <img class="imagemf" src="../img/fotos/Mizael.jpg">
        <p>Mizael Martins Barreto - Gerente de Marketing / Email: mizael.martins@unesp.br</p>
      </div>
      <div class="p3">
        <img class="imagemf" src="../img/fotos/Nicole.jpg">
        <p>Nicole dos Santos Quadros - Gerente de Qualidade / Email: n.quadros@unesp.br</p>
      </div>
      <div class="p4">
        <img class="imagemf" src="../img/fotos/Pedro.jpg">
        <p>Pedro Augusto de Oliveira Galdino Ribeiro - Líder / Email: paog.ribeiro@unesp.br</p>
      </div>
      <div class="p5">
        <img class="imagemf" src="../img/fotos/Richard.jpg">
        <p>Richard Walace de Oliveira Camargo - Líder Técnico e Gerente de Produção / Email: rwo.camargo@unesp.br</p>
      </div>
    </div>
    <div class="professores">
      <p class="nos">Orientadores</p>
      <div class="p1">
        <img class="imagemf" src="../img/fotos/Debora.jpeg">
        <p>Debora Barbosa Aires - Aplicativos I / Email: debora.aires@unesp.br</p>
      </div>
      <div class="p2">
        <img class="imagemf" src="../img/fotos/Jose.jpeg">
        <p>José Vieira Junior - Banco de Dados / Email: vieira.junior@unesp.br</p>
      </div>
      <div class="p3">
        <img class="imagemf" src="../img/fotos/Jovita.jpeg">
        <p>Jovita Mercedes Hojas Baenas - Gestão de Negócios / Email: jovita.baenas@unesp.br</p>
      </div>
      <div class="p4">
        <img class="imagemf" src="../img/fotos/Cabello.jpg">
        <p>Marcelo Cabello Peres - PHP / Email: marcelo.peres@unesp.br</p>
      </div>
    </div>
  </div>
</body>

</html