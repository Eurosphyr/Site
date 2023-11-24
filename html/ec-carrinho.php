<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
include "../php/funcoes.php";
$session_id = session_id();
$conn = conectarAoBanco();
// Verificar se a conexão com o banco de dados foi estabelecida
if (!$conn) {
  die("Falha na conexão com o banco de dados.");
}

// Obter o ID do usuário da sessão
$id_usuario = null;
if (isset($_SESSION['userId'])) {
  $id_usuario = $_SESSION['userId'];
}

// Código PHP para inserir o produto no carrinho
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produto'])) {
  // Verificar se a sessão do usuário existe e está definida
  if ($id_usuario) {
    $id_produto = $_GET['id_produto'];
    $statusCompra = 'Pendente';
    $dataHoje = date('Y-m-d H:i:s');


    $conn->beginTransaction();

    try {
      $stmt = $conn->prepare("INSERT INTO tbl_compra (id_usuario, status, data) VALUES (:id_usuario, :statusCompra, :dataHoje)");
      $stmt->execute(array(':id_usuario' => $id_usuario, ':statusCompra' => $statusCompra, ':dataHoje' => $dataHoje));
      $codigoCompra = $conn->lastInsertId();

      $stmt = $conn->prepare("INSERT INTO tbl_compratmp (id_compra, sessao) VALUES (:codigoCompra, :session_id)");
      $stmt->execute(array(':codigoCompra' => $codigoCompra, ':session_id' => $session_id));

      $stmt = $conn->prepare("INSERT INTO tbl_carrinho (id_compra, id_produto, quantidade) VALUES (:codigoCompra, :id_produto, 1)");
      $stmt->execute(array(':codigoCompra' => $codigoCompra, ':id_produto' => $id_produto));

      $conn->commit();
    } catch (PDOException $e) {
      $conn->rollBack();
      echo '<script>alert("Erro ao inserir produto no carrinho"); window.location.href = "../html/ec-telacompra.php";</script>';
    }

    header("Location: ec-carrinho.php");
    exit;
  }
}

if (!$conn) {
  die("Falha na conexão com o banco de dados.");
}
// ...

function aumentarQuantidadeProduto($idProduto, $quantidade, $session_id)
{
  global $conn;

  $sql_update = "UPDATE tbl_carrinho 
                SET quantidade = quantidade + :quantidade 
                WHERE id_produto = :id_produto 
                AND id_compra IN (SELECT id_compra FROM tbl_compratmp WHERE sessao = :session_id)";

  $stmt_update = $conn->prepare($sql_update);
  $stmt_update->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
  $stmt_update->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);
  $stmt_update->bindParam(':session_id', $session_id, PDO::PARAM_STR);

  if ($stmt_update->execute() === TRUE) {
  } else {
    echo '<script>alert("Erro ao aumentar quantidade do produto!"); window.location.href = "../html/ec-carrinho.php";</script>';
  }
}

function obterQuantidadeProduto($idProduto, $session_id)
{
  global $conn;

  $sql_select_quantidade = "SELECT quantidade 
                            FROM tbl_carrinho 
                            WHERE id_produto = :id_produto 
                            AND id_compra IN (SELECT id_compra FROM tbl_compratmp WHERE sessao = :session_id)";

  $stmt_select_quantidade = $conn->prepare($sql_select_quantidade);
  $stmt_select_quantidade->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);
  $stmt_select_quantidade->bindParam(':session_id', $session_id, PDO::PARAM_STR);
  $stmt_select_quantidade->execute();

  $quantidade = $stmt_select_quantidade->fetchColumn();
  return $quantidade;
}

function diminuirQuantidadeProduto($idProduto, $quantidade, $session_id)
{
  global $conn;

  $sql_update = "UPDATE tbl_carrinho 
                SET quantidade = GREATEST(0, quantidade - :quantidade)
                WHERE id_produto = :id_produto 
                AND id_compra IN (SELECT id_compra FROM tbl_compratmp WHERE sessao = :session_id)";

  $stmt_update = $conn->prepare($sql_update);
  $stmt_update->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
  $stmt_update->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);
  $stmt_update->bindParam(':session_id', $session_id, PDO::PARAM_STR);

  if ($stmt_update->execute() === TRUE) {
    // Obtenha a nova quantidade após o update
    $novaQuantidade = obterQuantidadeProduto($idProduto, $session_id);

    // Remover o produto se a quantidade for menor ou igual a zero
    if ($novaQuantidade <= 0) {
      $sql_delete = "DELETE FROM tbl_carrinho 
                    WHERE id_produto = :id_produto 
                    AND id_compra IN (SELECT id_compra FROM tbl_compratmp WHERE sessao = :session_id)";
      $stmt_delete = $conn->prepare($sql_delete);
      $stmt_delete->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);
      $stmt_delete->bindParam(':session_id', $session_id, PDO::PARAM_STR);
      $stmt_delete->execute();
    }
  } else {
    echo '<script>alert("Erro ao diminuir quantidade do produto"); window.location.href = "../html/ec-carrinho.php";</script>';
  }
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aumentar_quantidade']) && isset($_POST['id_produto']) && isset($_POST['quantidade'])) {
  $id_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : null;
  $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 0;
  $session_id = session_id();

  if ($id_produto && $quantidade > 0) {
    aumentarQuantidadeProduto($id_produto, $quantidade, $session_id);
  }
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['diminuir_quantidade']) && isset($_POST['id_produto']) && isset($_POST['quantidade'])) {
  $id_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : null;
  $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 0;
  $session_id = session_id();

  if ($id_produto) {
    diminuirQuantidadeProduto($id_produto, $quantidade, $session_id);
  }
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['limpar_carrinho'])) {
  $session_id = session_id();
  $id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : null;

  $conn->beginTransaction();

  try {

    if ($id_usuario !== null) {
      $stmt_clear_compra = $conn->prepare("DELETE FROM tbl_compra WHERE id_usuario = :id_usuario");
      $stmt_clear_compra->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
      $stmt_clear_compra->execute();
    }
    $sql_clear_cart = "DELETE tbl_carrinho 
                       FROM tbl_carrinho 
                       INNER JOIN tbl_compratmp ON tbl_carrinho.id_compra = tbl_compratmp.id_compra
                       WHERE tbl_compratmp.sessao = :session_id";

    $stmt_clear_cart = $conn->prepare($sql_clear_cart);
    $stmt_clear_cart->bindParam(':session_id', $session_id, PDO::PARAM_STR);
    $stmt_clear_cart->execute();

    $stmt_clear_temp = $conn->prepare("DELETE FROM tbl_compratmp WHERE sessao = :session_id");
    $stmt_clear_temp->bindParam(':session_id', $session_id, PDO::PARAM_STR);
    $stmt_clear_temp->execute();

    $stmt_clear_compra = $conn->prepare("DELETE FROM tbl_compra WHERE id_usuario = :id_usuario");
    $stmt_clear_compra->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_clear_compra->execute();

    $conn->commit();

    header("Location: ec-carrinho.php");
    exit;
  } catch (PDOException $e) {
    $conn->rollBack();
    echo '<script>alert("Erro!"); window.location.href = "../html/ec-carrinho.php";</script>';
  }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho</title>
  <link rel="stylesheet" href="../css/carrinho.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="stylesheet" href="../css/rodape.css" />
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <a id="topo"></a>
    <?php
    setarCookies();
    exibirConteudoComBaseNoPapel();
    ?>
    <div class="apresentacao">
      <img class="foto-ca" src="../img/cart_circle.svg" />
      <div class="escrita-ca">
        <div class="reta1"></div>
        <p class="carrinho">Carrinho</p>
        <div class="reta2"></div>
      </div>
    </div>
    <div class="produtos">
      <p class="font escrita-p">Produto</p>
      <p class="font escrita-v">Valor</p>
      <p class="font escrita-q">Quant</p>
      <?php
      // Código PHP para obter os produtos do carrinho
      $stmt = $conn->prepare("SELECT * FROM tbl_carrinho WHERE id_compra IN (SELECT id_compra FROM tbl_compratmp WHERE sessao = :session_id)");
      $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
      $stmt->execute();
      $produtos_no_carrinho = $stmt->fetchAll();

      $subtotal = 0;
      $total = 0;
      // Se houver produtos no carrinho, exiba-os na seção HTML
      if ($produtos_no_carrinho) {
        foreach ($produtos_no_carrinho as $produto) {
          $id_produto = $produto['id_produto'];
          $quantidade = $produto['quantidade'];
          $id_compra = $produto['id_compra'];
          // Busque informações adicionais sobre o produto no banco de dados
          $stmt = $conn->prepare("SELECT * FROM tbl_produto WHERE id_produto = :id_produto");
          $stmt->bindParam(':id_produto', $id_produto);
          $stmt->execute();
          $dados_produto = $stmt->fetch();

          $nome_produto = $dados_produto['nome'];
          $vunit = $dados_produto['preco'];
          $imagem = $dados_produto['imagem'];
          $subtotal += $vunit * $quantidade;
          $total += $vunit * $quantidade;

          echo "<div class='prod1'>
        <div class='desing-p'>
            <div class='ft-prod'><img src='$imagem' alt='imagem_produto' class='ft-prod'></div>
            <p class='nm-prod'>$nome_produto</p>
        </div>
        <div class='desing-v'>
            <p class='v-prod'>R$" . number_format($vunit, 2) . "</p>
        </div>
        <div class='desing-v'>
        <form method='POST' action=''>
            <input type='hidden' name='id_produto' value='$id_produto'>
            <input type='hidden' name='quantidade' value='1'>
            <button type='submit' name='diminuir_quantidade'>-</button>
        </form>
            <input class='q-prod' id='input-$id_produto' type='number' value='$quantidade' readonly data-valor='$vunit' />";
          // Botão para aumentar a quantidade do produto
          echo "<form method='POST' action=''>
        <input type='hidden' name='id_produto' value='$id_produto'>
        <input type='hidden' name='quantidade' value='1'>
        <button type='submit' name='aumentar_quantidade'>+</button>
        </form>";
          echo "</div>
        <div class='desing-t'>
            <p class='v-prod'>R$" . number_format($vunit * $quantidade, 2) . "</p>
        </div>
        <form method='POST' action=''>
            <input type='hidden' name='id_produto' value='$id_produto'>
            <input type='hidden' name='quantidade' value='1'>
            <button type='submit' name='diminuir_quantidade' class='retirar'>Remover</button>
        </form>
    </div>";
        }
      } else {
        // Caso não haja produtos no carrinho, exiba uma mensagem apropriada
        echo "<p class=''>Não há produtos no carrinho.</p>";
      }
      ?>
      <div class='valores'>
        <p class='escrita' id='subtotal'>Subtotal: R$<?php echo number_format($subtotal, 2); ?></p>
        <p class='escrita' id='total'>Total: R$<?php echo number_format($total, 2); ?></p>
      </div>
      <form id="formulario-pagamento" action="ec-telapag.php" method="get" style="display: none;">
        <input type="hidden" name="subtotal" id="input-subtotal" value="<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?>">
        <input type="hidden" name="total" id="input-total" value="<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?>">
        <input type="hidden" name="id_compra" id="input-id-compra" value="<?php echo isset($id_compra); ?>">
        <button type="submit" id="btn-submit" style="display: none;"></button>
      </form>
      <button onclick="atualizarEEnviarFormularioPagamento()" class="pagar">Pagar</button>
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
  <script>
    function atualizarEEnviarFormularioPagamento() {
      var totalElement = document.getElementById('total');
      var total = totalElement.textContent.replace('Total: R$', '');
      enviarFormularioPagamento(total);
    }

    function enviarFormularioPagamento(total) {
      var totalFormatted = parseFloat(total).toFixed(2);
      var idCompra = "<?php echo isset($id_compra) ? $id_compra : ''; ?>"

      document.getElementById("input-subtotal").value = totalFormatted;
      document.getElementById("input-total").value = totalFormatted;
      document.getElementById("input-id-compra").value = idCompra;
      document.getElementById("formulario-pagamento").submit();
    }


    function limparCarrinho() {
      var id_usuario = <?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : 'null'; ?>;

      if (confirm('Tem certeza que deseja limpar o carrinho?')) {
        window.location.href = 'ec-carrinho.php?limpar_carrinho=true&id_usuario=' + id_usuario;
      }
    }
  </script>
</body>

</html>