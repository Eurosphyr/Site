<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho</title>
  <link rel="stylesheet" href="../css/carrinho.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <div class="cabecalho">
      <img class="logo" src="../img/Logos.svg" />
      <a class="b" href="index.php">HOME</a>
      <a class="b" href="ec-sobre.php">SOBRE</a>
      <a class="b" href="ec-telacompra.php">COMPRAR</a>
      <a href="ec-carrinho.php"><img class="carrinho" src="../img/cart.png" /></a>
      <a href="perfil.php"><img class="perfil" src="../img/user.png" /></a>
    </div>
    <div class="apresentacao">
      <img class="foto-ca" src="../img/cart_circle.png" />
      <div class="escrita-ca">
        <div class="reta1"></div>
        <p class="carrinho">Carrinho</p>
        <div class="reta2"></div>
      </div>
    </div>
    <div class="produtos">
      <p class="font escrita-p">Produto</p>
      <p class="font escrita-v">Valor</p>
      <p class="font escrita-q">Quant</p>
      <p class="font escrita-t">Total</p>
      <div class="prod1 oculto">
        <div class="desing-p">
          <div class="ft-prod"></div>
          <p class="nm-prod">Nome do produto</p>
        </div>
        <div class="desing-v">
          <p class="v-prod">R$</p>
        </div>
        <div class="desing-v">
          <button onclick="diminuirValor(0)">-</button>
          <input class="q-prod" id="input-0" type="number" value="1" readonly />
          <button onclick="aumentarValor(0)">+</button>
        </div>
        <div class="desing-t">
          <p class="v-prod">R$</p>
        </div>
        <a class="retirar" href="">+</a>
      </div>
      <div class="prod1 oculto">
        <div class="desing-p">
          <div class="ft-prod"></div>
          <p class="nm-prod">Nome do produto</p>
        </div>
        <div class="desing-v">
          <p class="v-prod">R$</p>
        </div>
        <div class="desing-v">
          <button onclick="diminuirValor(1)">-</button>
          <input class="q-prod" id="input-1" type="number" value="1" readonly />
          <button onclick="aumentarValor(1)">+</button>
        </div>
        <div class="desing-t">
          <p class="v-prod">R$</p>
        </div>
        <a class="retirar" href="">+</a>
      </div>
      <div class="prod1 oculto">
        <div class="desing-p">
          <div class="ft-prod"></div>
          <p class="nm-prod">Nome do produto</p>
        </div>
        <div class="desing-v">
          <p class="v-prod">R$</p>
        </div>
        <div class="desing-v">
          <button onclick="diminuirValor(2)">-</button>
          <input class="q-prod" id="input-2" type="number" value="1" readonly />
          <button onclick="aumentarValor(2)">+</button>
        </div>
        <div class="desing-t">
          <p class="v-prod">R$</p>
        </div>
        <a class="retirar" href="">+</a>
      </div>
      <div class="valores">
        <p class="escrita">Subtotal: R$</p>
        <p class="escrita">Frete: R$</p>
        <p class="escrita">Total: R$</p>
      </div>
    </div>
    <div class="pagar">
      <div class="baixo">
        <a class="voltar" href="">Continuar comprando</a>
        <form action="../php/funcoes.php" method="POST">
          <input class="comprar" type="submit" value="Comprar" />
        </form>
      </div>
    </div>
  </div>
  <script>
    const input = document.getElementById("meuInput");

    function aumentarValor(index) {
      const input = document.getElementById(`input-${index}`);
      input.value = parseInt(input.value) + 1;
      mostrarOcultarProdutos();
    }

    function diminuirValor(index) {
      const input = document.getElementById(`input-${index}`);
      const valorAtual = parseInt(input.value);
      if (valorAtual > 0) {
        input.value = valorAtual - 1;
      }
      mostrarOcultarProdutos();
    }


    function mostrarProdutos() {
      const produtos = document.querySelectorAll(".prod1");
      const valorInput = parseInt(input.value);

      if (valorInput > 0) {
        produtos.forEach((produto) => {
          produto.classList.remove("oculto");
        });
      } else {
        produtos.forEach((produto) => {
          produto.classList.add("oculto");
        });
      }
    }
  </script>
</body>

</html>