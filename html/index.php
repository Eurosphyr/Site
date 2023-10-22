<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <title>MIPRON</title>
    <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
    <div class="container">
        <?php include "../php/funcoes.php";
        session_start();
        setarCookies();
        exibirConteudoComBaseNoPapel(); ?>
        <div class="esquerda">
            <div class="dentro-esquerda"></div>
        </div>
        <div class="direita">
            <div class="dentro-direita"></div>
        </div>
        <div class="centro">
            <div class="dentro">
                <div class="desc-produto">Teste</div>
                <div class="produto"></div>
                <a href="ec-telacompra.php"><button class="bt-comprar">COMPRAR</button></a>
            </div>
        </div>
        <div class="baixo">
            <div class="logo1">
                <a name="baixo"><img class="fotoL" src="logo-MIPRON.jpeg"></a>
            </div>
            <div class="escritaLogo1">
                <div class="escritaL">Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.
                    Vestibulum laoreet lobortis pellentesque.
                    Vivamus ut dolor vel tortor tempor aliquet pulvinar sed sem.
                </div>
            </div>
            <div class="diferencial">
                <img class="fotoL" src="logo-MIPRON.jpeg">
            </div>
            <div class="escritaDiferencial">
                <div class="escritaD">Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.
                    Vestibulum laoreet lobortis pellentesque.
                    Vivamus ut dolor vel tortor tempor aliquet pulvinar sed sem.
                </div>
            </div>
            <div class="fimBaixo">
                Teste
            </div>
        </div>
    </div>
</body>

</html>