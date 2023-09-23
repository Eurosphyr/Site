<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tela Pagamento</title>
    <link rel="stylesheet" href="../css/telapag.css" />
  </head>
  <body>
    <div class="fundo"></div>
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
      <div class="tipo">
        <p>Selecione o tipo de pagamentento</p>
        <div>
          <div class="volta">
            <input type="radio" name="tipoP" />
            <label>Pix</label>
          </div>
          <div class="volta">
            <input type="radio" name="tipoP" />
            <label>Cartão de Débito</label>
          </div>
          <div class="volta">
            <input type="radio" name="tipoP" />
            <label>Cartão de Crédito</label>
          </div>
        </div>
      </div>
      <div class="pagar">
        <div class="formas-p">
          <div class="padrao">
            <p class="esp">Entrega padrão</p>
            <p class="esp">R$0,00</p>
          </div>
          <div class="premium">
            <p class="esp">Entrega premium</p>
            <p class="esp">R$3,99</p>
          </div>
          <div class="linha"></div>
          <div class="total">
            <p class="esp"><strong>Total</strong></p>
            <p class="esp">R$12,00</p>
          </div>
          <input class="bt-compra" type="button" value="PAGAR" />
        </div>
        <div class="desc-prod">Descriçao</div>
        <div class="desc">
          fnasmfnm, fmnasnfamsnfm, fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl,
          fhasfhsffjajf fnasmfnm, fmnasnfamsnfm, fmasfmas,fnasmfnm,
          fnsakfjassfklfjasfkl, fhasfhsffjajfs fnasmfnm, fmnasnfamsnfm,
          fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl, fhasfhsffjajfs fnasmfnm,
          fmnasnfamsnfm, fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl, fhasfhsffjajfs
          fnasmfnm, fmnasnfamsnfm, fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl,
          fhasfhsffjajfs fnasmfnm, fmnasnfamsnfm, fmasfmas,fnasmfnm,
          fnsakfjassfklfjasfkl, fhasfhsffjajfs fnasmfnm, fmnasnfamsnfm,
          fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl, fhasfhsffjajfs fnasmfnm,
          fmnasnfamsnfm, fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl, fhasfhsffjajfs
          fnasmfnm, fmnasnfamsnfm, fmasfmas,fnasmfnm, fnsakfjassfklfjasfkl,
          fhasfhsffjajfs
        </div>
      </div>
      <div class="endereco">
        <div class="endereco-d">
          <p class="preto">Selecione seu endereço</p>
          <input type="text" placeholder="Endereço" />
          <input type="text" placeholder="CEP" />
          <input type="text" placeholder="Complemento" />
        </div>
      </div>
      <div class="produto">
        <div class="contorno">
          <img class="img1" src="image 27 (1).png" />
          <div class="mais-imgs">
            <img class="img2" src="image 26 (1).png" />
            <img class="img2" src="image 26 (1).png" />
            <img class="img2" src="image 26 (1).png" />
          </div>
        </div>
      </div>
    </div>
  </body>
</html>