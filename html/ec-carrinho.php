<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrinho</title>
    <link rel="stylesheet" href="../css/carrinho.css" />
  </head>
  <body>
    <div class="container">
      <div class="cabecalho">
        <img class="logo" src="logo-MIPRON.jpeg" />
        <input class="b" type="button" value="HOME" />
        <input class="b" type="button" value="SOBRE" />
        <input class="b" type="button" value="COMPRAR" />
        <a href=""><img class="perfil" src="../img/user.png" /></a>
        <a href=""><img class="carrinho" src="../img/cart.png" /></a>
        <a href=""><img class="opcao" src="../img/menu.png" /></a>
      </div>
      <div class="apresentacao">
        <img class="foto-ca" src="cart_circle.png" />
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
        <div class="prod1">
          <div class="desing-p">
            <div class="ft-prod"></div>
            <p class="nm-prod">Nome do produto</p>
          </div>
          <div class="desing-v">
            <p class="v-prod">R$</p>
          </div>
          <div class="desing-v">
            <a href="">-</a>
            <input class="q-prod" type="number" value="1" />
            <a href="">+</a>
          </div>
          <div class="desing-t">
            <p class="v-prod">R$</p>
          </div>
          <a class="retirar" href="">+</a>
        </div>
        <div class="prod1">
          <div class="desing-p">
            <div class="ft-prod"></div>
            <p class="nm-prod">Nome do produto</p>
          </div>
          <div class="desing-v">
            <p class="v-prod">R$</p>
          </div>
          <div class="desing-v">
            <a href="">-</a>
            <input class="q-prod" type="number" value="1" />
            <a href="">+</a>
          </div>
          <div class="desing-t">
            <p class="v-prod">R$</p>
          </div>
          <a class="retirar" href="">+</a>
        </div>
        <div class="prod1">
          <div class="desing-p">
            <div class="ft-prod"></div>
            <p class="nm-prod">Nome do produto</p>
          </div>
          <div class="desing-v">
            <p class="v-prod">R$</p>
          </div>
          <div class="desing-v">
            <a href="">-</a>
            <input class="q-prod" type="number" value="1" />
            <a href="">+</a>
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
          <input class="comprar" type="button" value="Comprar" />
        </div>
      </div>
    </div>
  </body>
</html>