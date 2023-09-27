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
          <input class="escrita" type="text" name="email" />
          
          <label class="se">Senha</label>
          <input class="escrita" type="password" name="senha" />
          
          <label class="Cse">Confirmar Senha</label>
          <input class="escrita" type="password" name="confirmar_senha" />

          <!-- Adicione campos nome e telefone aqui -->
          <label class="nm">Nome</label>
          <input class="escrita" type="text" name="nome" />
          
          <label class="tel">Telefone</label>
          <input class="escrita" type="text" name="telefone" />
          <div class="centralizar" align="center">
            <input class="bt" type="submit" value="Confirmar" />
          </div>
         
        </form>
        <div class="baixo"><a href="ec-login.php">Já possuo conta</a></div>
      </div>
    </div>
  </body>
</html>
