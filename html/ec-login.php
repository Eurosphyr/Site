<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../css/cadastro.css" />
    <link rel="icon" href="../img/Logos.svg" />
  </head>
  <body>
    <div class="container">
      <div class="menu">
        <div class="cadastro">Faça seu Login</div>
        <form action="../php/funcoes.php" method="POST">
        <label class="em">Email</label>
        <input class="escrita" type="text" />
        <label class="se">Senha</label>
        <input class="escrita" type="password" />
        <label class="salvar"
          >Lembrar sempre</label
        >
        <input class="checked" type="checkbox" />
        <div class="centralizar" align="center">
        <input class="bt" type="submit" value="Confirmar" />
        </div>
        </form>
        <div class="baixo"><a href="ec-cadastro.php">Criar conta</a></div>
        <div class="baixo"><a href="#">Esqueci a senha</a></div>
      </div>
      
    </div>
  </body>
</html>
