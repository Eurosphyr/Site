<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link rel="stylesheet" href="../css/cadastro.css" />
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <?php
    include "../php/funcoes.php";
    ?>
    <div class="menu">
      <div class="cadastro">Cadastre-se</div>
      <form action="../php/inserir_dados.php" method="POST" onsubmit="return validarFormulario()">
        <label class="nm">Nome</label>
        <input class="escrita" type="text" name="nome" />

        <label class="em">Email</label>
        <input class="escrita" type="text" name="email" />

        <label class="tel">Telefone</label>
        <input class="escrita" type="text" name="telefone" />

        <label class="se">Senha</label>
        <input class="escrita" type="password" name="senha" />

        <label class="Cse">Confirmar Senha</label>
        <input class="escrita" type="password" name="confirmar_senha" />

        <?php
        session_start();
        if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario']) {
        ?>
          <label class="rua">Rua</label>
          <input class="escrita" type="text" name="endereco_rua" />

          <label class="num">Número</label>
          <input class="escrita" type="text" name="endereco_num" />

          <label class="bai">Bairro</label>
          <input class="escrita" type="text" name="endereco_bairro" />

          <label class="cid">Cidade</label>
          <input class="escrita" type="text" name="endereco_cidade" />

          <label class="est">Estado</label>
          <input class="escrita" type="text" name="endereco_estado" />

          <label class="tp">Administrador</label>
          <input class="escrita" type="checkbox" name="tipo_usuario" />

        <?php
        }
        ?>

        <div class="centralizar" align="center">
          <input class="bt" type="submit" value="Confirmar" />
        </div>

      </form>
      <div class="baixo"><a href="ec-login.php">Já possuo conta</a></div>
    </div>
  </div>
  <script>
    function validarFormulario() {
      var inputs = document.querySelectorAll('.escrita');
      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value.trim() === '') {
          alert('Preencha todos os campos!');
          return false;
        }
      }
      return true;
    }
  </script>
</body>

</html>