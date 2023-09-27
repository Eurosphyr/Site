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
      <img class="logo" src="../img/Logos.svg" />
      <a class="b" href="index.php">HOME</a>
      <a class="b" href="ec-sobre.php">SOBRE</a>
      <a class="b" href="ec-telacompra.php">COMPRAR</a>
      <a href="ec-login.php"><img class="perfil" src="../img/user.png" /></a>
      <a href="ec-carrinho.php"><img class="carrinho" src="../img/cart.png" /></a>
    </div>
  </div>
  <div class="container_geral">
    <div class="perfil">
      <img class="foto" src="../img/User.svg" />
      <div class="dados">

      </div>
    </div>
    <form action="../php/alterar_dados.php" method="POST">
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
        <div class="senha">
          <label for="senha"></label>
          <input type="password" id="senha" name="senha" placeholder="Senha" />
        </div>
        <div class="telefone">
          <label for="telefone"></label>
          <input type="tel" id="telefone" name="telefone" placeholder="Telefone" />
        </div>
        <br />
        <div class="centered-text">
          <input type="submit" class="bt-altera_dados" value="Alterar Dados"></input>
        </div>
      </div>
    </form>
  </div>
</body>

</html>