<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <title>MIPRON</title>
    <link rel="icon" href="../img/Logos.svg" />
  </head>
  <body>
    <div class="container"><?php include "../php/funcoes.php";
  session_start(); 
  exibirConteudoComBaseNoPapel();?>
        </div>
      </div>
      <div class="esquerda">
        <div class="dentro-esquerda"></div>
      </div>
      <div class="direita">
        <div class="dentro-direita"></div>
      </div>
      <div class="centro">
        <div class="dentro">
          <div class="desc-produto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam vel ratione impedit dolorem. Eum quisquam, distinctio corporis sequi, tenetur maxime in explicabo saepe, quidem quod laboriosam neque cumque magni possimus.</div>
          <div class="produto"></div>
          <div class="centralizar" align="center"><a class="bt-comprar" href="ec-telacompra.php">COMPRAR</a></div>
          
        </div>
      </div>
      <div class="baixo">
        <div class="logo1">
          <img class="fotoL" src="../img/Logos.svg" />
        </div>
        <div class="escritaLogo1">
          <div class="escritaL">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
            laoreet lobortis pellentesque. Vivamus ut dolor vel tortor tempor
            aliquet pulvinar sed sem.
          </div>
        </div>
        <div class="diferencial">
          <img class="fotoL" src="../img/Logos.svg" />
        </div>
        <div class="escritaDiferencial">
          <div class="escritaD">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
            laoreet lobortis pellentesque. Vivamus ut dolor vel tortor tempor
            aliquet pulvinar sed sem.
          </div>
        </div>
        <div class="fimBaixo"></div>
      </div>
    </div>
    <script src="../php/script.js"></script>
  </body>
</html>
