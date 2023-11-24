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
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/telacompra.css" />
    <link rel="stylesheet" href="../css/cabecalho.css" />
    <link rel="stylesheet" href="../css/rodape.css" />
    <title>MIPRON</title>
    <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
    <div class="container">
        <a id="topo"></a>
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
                    <img class="prods" src="../img/Mousepad_Viva.jpg">
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
        </div>
        <div class="rodape">
            <div class="most">
                <div class="redes">
                    <img src="../img/Mipron.png" alt="Logo MIPRON">
                    <span class="background">
                        <span class="social-media-buttons">
                            <span class="social-media-button">
                                <a href="https://www.instagram.com/mipron_startup/"><img src="../img/instagram.png" alt="Instagram"></a>
                            </span>
                        </span>
                    </span>
                </div>
                <div class="mebros">
                    <p class="desen">Desenvolvedores</p>
                    <div class="traco1"></div>
                    <p class="p">Miguel Angelo de Lima Godoi - Gerente Financeiro / Email: miguel.godoi@unesp.br</p>
                    <p class="p">Mizael Martins Barreto - Gerente de Marketing / Email: mizael.martins@unesp.br</p>
                    <p class="p">Nicole dos Santos Quadros - Gerente de Qualidade / Email: n.quadros@unesp.br</p>
                    <p class="p">Pedro Augusto de Oliveira Galdino Ribeiro - Líder / Email: paog.ribeiro@unesp.br</p>
                    <p class="p">Richard Walace de Oliveira Camargo - Líder Técnico e Gerente de Produção / Email:
                        rwo.camargo@unesp.br</p>
                </div>
            </div>
            <div class="menu">
                <p class="menuT">Menu</p>
                <div class="menud">
                    <a href="index.php">
                        <p class="vt">Home</p>
                    </a>
                    <a href="ec-sobre.php">
                        <p class="vt">Sobre</p>
                    </a>
                    <a href="ec-telacompra.php">
                        <p class="vt">Comprar</p>
                    </a>
                    <a href="#topo"><img width="100" src="../img/seta_cima.png"></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".cadernetas input[type='radio']").change(function() {
                var id_produto = $(this).val();
                $.ajax({
                    url: 'ec-telacompra.php',
                    type: 'post',
                    data: {
                        id_produto: parseInt(id_produto) // Converta para inteiro usando parseInt
                    },
                    success: function(response) {
                        $('.prod-1 .prods').attr('src', response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        function updateProductId(value) {
            document.getElementById("id_produto_input").value = parseInt(value);
             // Use parseInt para converter para inteiro
        }
    </script>
</body>

</html>