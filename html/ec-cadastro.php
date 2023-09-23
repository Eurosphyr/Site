<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/cadastro.css" />
  </head>
  <body>
    <div class="container">
      <div class="menu">
        <div class="cadastro">Cadastre-se</div>
        <form action="../php/funcoes.php" method="POST">
        <label class="em">Email</label>
        <input class="escrita" type="text" />
        <label class="se">Senha</label>
        <input class="escrita" type="password" />
        <label class="Cse">Confirmar Senha</label>
        <input class="escrita" type="text" />
        <input class="bt" type="submit" value="Confirmar" />
        <div class="baixo"><a href="ec-login.php">Ja possuo conta</a></div>
        </form>
      </div>
    </div>
  </body>
</html>
