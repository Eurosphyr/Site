<?php
// Recupere os valores do subtotal e total da query string
$subTotal = isset($_GET['subtotal']) ? floatval($_GET['subtotal']) : 0;
$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tela Pagamento</title>
    <link rel="stylesheet" href="../css/telapag.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <link rel="icon" href="../img/Logos.svg" />
</head>
<body>
    <div class="fundo"></div>
    <div class="container">
        <div class="cabecalho">
            <img class="logo" src="../img/Logos.svg" />
            <a class="b" href="index.php">HOME</a>
            <a class="b" href="ec-sobre.php">SOBRE</a>
            <a class="b" href="ec-telacompra.php">COMPRAR</a>
            <a href="ec-carrinho.php"><img class="carrinho" src="../img/cart.png" alt="Carrinho" /></a>
            <a href="perfil.php"><img class="perfil" src="../img/user.png" alt="Perfil" /></a>
        </div>
        <div class="tipo">
            <p>Selecione o tipo de pagamento</p>
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
                    <!-- Exiba os valores do subtotal e total na tela de pagamento -->
                    <p class="esp"><strong>Total</strong></p>
                    <p class="esp">R$<?= number_format($total, 2); ?></p>
                </div>
                <a class="bt-compra" href="processar-pagamento.php?subtotal=<?= $subTotal ?>&total=<?= $total ?>">PAGAR</a>
            </div>
            <div class="desc-prod">Descrição</div>
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
                <img class="img1" src="../img/mousepad.png" />
                <div class="mais-imgs">
                    <img class="img2" src="../img/mousepad.png" alt="Produto" />
                    <img class="img2" src="../img/mousepad.png " alt="Produto" />
                    <img class="img2" src="../img/mousepad.png" alt="Produto" />
                </div>
            </div>
        </div>
    </div>
</body>
</html>
