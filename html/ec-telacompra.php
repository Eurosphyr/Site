<?php
// ec-telacompra.php

include "../php/funcoes.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = conectarAoBanco();

if (isset($_POST['id_produto'])) {
    $id_produto = $_POST['id_produto'];

    // Consulta para obter o caminho da imagem com base no ID do produto
    $query = "SELECT imagem FROM tbl_produto WHERE id_produto = :id_produto";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $imagem = $row['imagem'];

    echo $imagem;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/telacompra.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <title>MIPRON</title>
    <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
    <div class="container">
        <?php
        session_start();
        setarCookies();
        exibirConteudoComBaseNoPapel();
        ?>
        <form action="ec-carrinho.php" method="get" id="productForm">
            <input type="hidden" name="id_produto" value="" id="id_produto_input">
            <input type="submit" value="COMPRAR" class="b1">
        </form>
        <div class="b2">ESGOTADO!!!</div>
        <div class="prod-1">
            <p>CADERNETAS</p>
            <div class="bola-1">
                <div class="cima">
                    <img class="prods" src="../img/Caderneta_Branca.jpg">
                </div>
                <div class="desc-prod1">
                    <p class="texto">Você gosta de escrever, desenhar ou simplesmente anotar suas ideias? Então você vai adorar a nossa caderneta sem estampa, uma amiga fiel para seus momentos de criatividade. Ela tem uma capa resistente e elegante, que protege suas páginas de qualquer dano. Ela também tem 40 folhas de papel de ótima qualidade, que oferecem muito espaço para você expressar seus pensamentos, sentimentos e projetos. Além disso, ela é leve e compacta, ideal para levar na bolsa ou na mochila. Nossa caderneta sem estampa é perfeita para quem busca simplicidade e praticidade no dia a dia. Você pode usá-la no trabalho, na escola ou onde quiser, para organizar suas tarefas e inspirações. Com ela, você sempre terá suas anotações à mão, prontas para serem consultadas ou compartilhadas.
                    </p>
                </div>
            </div>
        </div>
        <div class="prod-2">
            <p>MOUSEPADS</p>
            <div class="bola-1">
                <div class="cima">
                    <img class="prods" src="">
                </div>
                <div class="desc-prod1">
                    <p class="texto">O Mouse Pad Premium é a escolha ideal para gamers, profissionais de design e qualquer pessoa que valorize o desempenho e a estética. Melhore a sua precisão nos jogos, simplifique o seu fluxo de trabalho e dê um toque de classe ao seu espaço de trabalho com o nosso mouse pad.
                    </p>
                </div>
            </div>
        </div>
        <div class="desc-1">
            <div class="opc-1 cadernetas">
                <p class="desc">OPÇÕES</p>
                <div class="linha"></div>
                <div class="curso">
                    <p class="cursos">Cursos</p>
                    <div class="curso1">
                        <label class="l">Branca</label>
                        <input type="radio" name="opcao" value="8" onclick="updateProductId(8)">
                    </div>
                    <div class="curso1">
                        <label class="l">Preta</label>
                        <input type="radio" name="opcao" value="9" onclick="updateProductId(9)">
                    </div>
                </div>
            </div>
        </div>
        <div class="desc-2">
            <div class="opc-1 mousepads">
                <p class="desc">OPÇÕES</p>
                <div class="linha"></div>
                <div class="curso">
                    <p class="cursos">Cursos</p>
                    <div class="curso1">
                        <label class="l">Info</label>
                        <input type="radio" name="opcao">
                    </div>
                    <div class="curso1">
                        <label class="l">Eletro</label>
                        <input type="radio" name="opcao">
                    </div>
                    <div class="curso1">
                        <label class="l">Mec</label>
                        <input type="radio" name="opcao">
                    </div>
                    <div class="curso1">
                        <label class="l">Viva CTI</label>
                        <input type="radio" name="opcao">
                    </div>
                </div>
            </div>
            <div class="suporte">
                <div class="redes"></div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".cadernetas input[type='radio']").change(function () {
                var id_produto = $(this).val();
                $.ajax({
                    url: 'ec-telacompra.php',
                    type: 'post',
                    data: {
                        id_produto: parseInt(id_produto) // Converta para inteiro usando parseInt
                    },
                    success: function (response) {
                        $('.prod-1 .prods').attr('src', response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $(".mousepads input[type='radio']").change(function () {
                var id_produto = $(this).val();
                $.ajax({
                    url: 'ec-telacompra.php',
                    type: 'post',
                    data: {
                        id_produto: parseInt(id_produto) // Converta para inteiro usando parseInt
                    },
                    success: function (response) {
                        $('.prod-2 .prods').attr('src', response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        function updateProductId(value) {
            document.getElementById("id_produto_input").value = parseInt(value); // Use parseInt para converter para inteiro
        }
    </script>
</body>

</html>
