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
        exibirConteudoComBaseNoPapel();?>
      <div class="sobre">
        <div class="apresentacao">Sobre Nós</div>
        <div class="linha"></div>
      </div>
      <div class="part-img1">
        <div class="imagem1"></div>
      </div>
      <div class="escrita1">
        <div class="escritaL">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
          laoreet lobortis pellentesque. Vivamus ut dolor vel tortor tempor
          aliquet pulvinar sed sem.
        </div>
      </div>
      <div class="part-img2">
        <div class="imagem2"></div>
      </div>
      <div class="escrita2">
        <div class="escritaD">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
          laoreet lobortis pellentesque. Vivamus ut dolor vel tortor tempor
          aliquet pulvinar sed sem.
        </div>
      </div>
      <div class="part-banner">
        <div class="banner"></div>
      </div>
    </div>
  </body>
</html>
