<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" href="../css/crud.css">
  <link rel="stylesheet" href="../css/cabecalho.css">
  <link rel="icon" href="../img/Logos.svg">
</head>

<body>
  <?php
  include("../php/funcoes.php");
  session_start();
  exibirConteudoComBaseNoPapel();
  crud();
  ?>
  </table>
</body>

</html>