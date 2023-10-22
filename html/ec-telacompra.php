<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/telacompra.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <title>MIPRON</title>
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <?php
    include "../php/funcoes.php";
    session_start();
    setarCookies();
    exibirConteudoComBaseNoPapel();
    $conn = conectarAoBanco();
    ?>
    <form action="ec-carrinho.php" method="get" id="productForm">
      <input type="hidden" name="id_produto" value="" id="id_produto_input">
      <input type="submit" value="COMPRAR" class="b1">
    </form>
    <div class="b2">COMPRAR</div>
    <div class="prod-1">
      <p>MOUSE PAD</p>
      <div class="bola-1">
        <div class="cima">
          <img class="prods" src="../img/mousepad.png">
          <div class="imagens-1">
            <img class="exemplos" src="../img/mousepad.png">
            <img class="exemplos" src="../img/mousepad.png">
            <img class="exemplos" src="../img/mousepad.png">
          </div>
        </div>
        <div class="desc-prod1">
          <p class="texto">O Mouse Pad Premium é a escolha ideal para gamers, profissionais de design e qualquer pessoa
            que valorize o desempenho e a estética.
            Melhore a sua precisão nos jogos, simplifique o seu fluxo de trabalho e dê um toque de classe ao seu espaço
            de trabalho com o nosso mouse pad.
          </p>
        </div>
      </div>
    </div>
    <div class="prod-2">
      <p>CADERNETA</p>
      <div class="bola-1">
        <div class="cima">
          <img class="prods" src="../img/mousepad.png">
          <div class="imagens-1">
            <img class="exemplos" src="../img/mousepad.png">
            <img class="exemplos" src="../img/mousepad.png">
            <img class="exemplos" src="../img/mousepad.png">
          </div>
        </div>
        <div class="desc-prod1">
          <p class="texto">O Mouse Pad Premium é a escolha ideal para gamers, profissionais de design e qualquer pessoa
            que valorize o desempenho e a estética.
            Melhore a sua precisão nos jogos, simplifique o seu fluxo de trabalho e dê um toque de classe ao seu espaço
            de trabalho com o nosso mouse pad.
          </p>
        </div>
      </div>
    </div>
    <div class="desc-1">
      <div class="opc-1">
        <p class="desc">OPÇÕES</p>
        <div class="linha"></div>
        <div class="curso">
          <p class="cursos">Cursos</p>
          <div class="curso1">
            <label class="l1">Info</label>
            <input type="radio" name="opcao" value="1" onclick="updateProductId(1)">
          </div>
          <div class="curso1">
            <label class="l2">Eletro</label>
            <input type="radio" name="opcao" value="2" onclick="updateProductId(2)">
          </div>
          <div class="curso1">
            <label class="l3">Mec</label>
            <input type="radio" name="opcao" value="3" onclick="updateProductId(3)">
          </div>
        </div>
        <div class="cores">
          <p class="cursos">Cores</p>
          <label>Escolha</label>
          <input type="color">
        </div>
      </div>
    </div>
    <div class="desc-2">
      <div class="opc-1">
        <p class="desc">OPÇÕES</p>
        <div class="linha"></div>
        <div class="curso">
          <p class="cursos">Cursos</p>
          <div class="curso1">
            <label class="l1">Info</label>
            <input type="radio" name="opcao" value="1">
          </div>
          <div class="curso1">
            <label class="l2">Eletro</label>
            <input type="radio" name="opcao" value="2">
          </div>
          <div class="curso1">
            <label class="l3">Mec</label>
            <input type="radio" name="opcao" value="3">
          </div>
          <div class="curso1">
            <label class="l4">Viva CTI</label>
            <input type="radio" name="opcao" value="4">
          </div>
          <div class="cores">
            <p class="cursos">Cores</p>
            <label>Escolha</label>
            <input type="color">
          </div>
        </div>
      </div>
      <div class="suporte">
        <div class="redes">Test</div>
      </div>
    </div>
    <script>
      function updateProductId(value) {
        document.getElementById("id_produto_input").value = value;
      }
    </script>
</body>

</html>