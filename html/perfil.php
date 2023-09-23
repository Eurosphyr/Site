<!DOCTYPE html>
<html lang="pt-bt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <link rel="icon" href="Logos.svg" />
    <title>Perfil</title>
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
    </div>
    <div class="container_geral">
      <div class="perfil">
        <img class="foto" src="User.svg" />
        <div class="dados">
          <!--
            Aqui vai ser puxado os dados do banco de dados
          -->
        </div>
      </div>
      <form action="../php/funcoes.php" method="POST">
        <div class="alterar_dados">
          <div class="nome">
            <label for="nome"></label>
            <input type="text" id="nome" name="nome" placeholder="Nome" />
          </div>
          <br />
          <div class="email">
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="Email" />
          </div>
          <br />
          <div class="telefone">
            <label for="telefone"></label>
            <input
              type="tel"
              id="telefone"
              name="telefone"
              placeholder="Telefone"
            />
          </div>
          <br />
          <div class="endereco">
            <label for="endereco"></label>
            <input
              type="text"
              id="endereco"
              name="endereco"
              placeholder="Endereço"
            />
          </div>
          <br />
          <div class="cidade">
            <label for="cidade"></label>
            <input type="text" id="cidade" name="cidade" placeholder="Cidade" />
          </div>
          <br />
          <div class="centered-text">
            <button class="bt-altera_dados">ALTERAR DADOS</button>
          </div>
        </div>
      </form>
    </div>

    <!-- <script src="script.js"></script> -->
  </body>
</html>