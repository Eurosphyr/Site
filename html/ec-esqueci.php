<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Esqueci</title>
    <link rel="stylesheet" href="../css/sobre.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <link rel="icon" href="../img/Logos.svg" />
  </head>
  <body>
    <?php include '../php/funcoes.php';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $conn = conectarAoBanco();

        $email = "";

        if (isset($_POST['email'])) {
          $email = $_POST['email'];
        }
        else{
            header('Location: ../html/ec-esqueci.php');
        }

        if(verificaEmail($email)){
            $cod = geraSenha();
            $mostrar = "<h1>Senha: $cod</h1>";
            enviaEmail($email,"Código para recuperar senha",$mostrar);
            header("Location: ../html/ec-trocarsenha.php?codigo=$cod&email=$email");
        }
        else{
            header('Location: ../html/ec-esqueci.php');
        }
        ?>
  </body>
</html>
