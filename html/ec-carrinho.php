<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
include "../php/funcoes.php";

$conn = conectarAoBanco();

// Certifique-se de que a conexão com o banco de dados foi estabelecida
// Código PHP para inserir o produto no carrinho
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produto'])) {
  $id_produto = $_GET['id_produto'];
  $statusCompra = 'Pendente';
  $dataHoje = date('Y-m-d');
  $session_id = session_id();

  $conn->beginTransaction();

  try {
    $stmt = $conn->prepare("INSERT INTO tbl_compra (id_usuario, status, data) VALUES (NULL, :statusCompra, :dataHoje)");
    $stmt->execute(array(':statusCompra' => $statusCompra, ':dataHoje' => $dataHoje));
    $codigoCompra = $conn->lastInsertId();

    $stmt = $conn->prepare("INSERT INTO tbl_compratmp (id_compra, sessao) VALUES (:codigoCompra, :session_id)");
    $stmt->execute(array(':codigoCompra' => $codigoCompra, ':session_id' => $session_id));

    $stmt = $conn->prepare("INSERT INTO tbl_carrinho (id_compra, id_produto, quantidade) VALUES (:codigoCompra, :id_produto, 1)");
    $stmt->execute(array(':codigoCompra' => $codigoCompra, ':id_produto' => $id_produto));

    $conn->commit();
  } catch (PDOException $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
  }

  header("Location: ec-carrinho.php");
  exit;
}

if (!$conn) {
  die("Falha na conexão com o banco de dados.");
}
function aumentarQuantidadeProduto($idProduto, $quantidade)
{
  global $conn;

  // Atualize a quantidade na tabela de produtos
  $sql = "UPDATE tbl_carrinho SET quantidade = quantidade + :quantidade WHERE id_produto = :id_produto";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
  $stmt->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);

  if ($stmt->execute() === TRUE) {
    echo "Quantidade de produto atualizada com sucesso!";
  } else {
    echo "Erro ao atualizar a quantidade do produto: " . $stmt->errorInfo(); // Adicionado para mostrar informações detalhadas do erro
  }
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aumentar_quantidade']) && isset($_POST['id_produto']) && isset($_POST['quantidade'])) {
  $id_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : null;
  $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 0;

  if ($id_produto && $quantidade > 0) {
    aumentarQuantidadeProduto($id_produto, $quantidade);
  }
}

function diminuirQuantidadeProduto($idProduto, $quantidade)
{
  global $conn;

  // Atualize a quantidade na tabela de produtos
  $sql = "UPDATE tbl_carrinho SET quantidade = quantidade - :quantidade WHERE id_produto = :id_produto";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
  $stmt->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);

  if ($stmt->execute() === TRUE) {
    echo "Quantidade de produto diminuída com sucesso!";
  } else {
    echo "Erro ao diminuir a quantidade do produto: " . $stmt->errorInfo(); // Adicionado para mostrar informações detalhadas do erro
  }
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['diminuir_quantidade']) && isset($_POST['id_produto']) && isset($_POST['quantidade'])) {
  $id_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : null;
  $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 0;

  if ($id_produto && $quantidade > 0) {
    diminuirQuantidadeProduto($id_produto, $quantidade);
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['limpar_carrinho'])) {
  $conn->beginTransaction();

  try {
    // Limpar a tabela do carrinho
    $conn->exec("DELETE FROM tbl_carrinho");

    // Limpar a tabela temporária de compra
    $conn->exec("DELETE FROM tbl_compratmp");

    // Limpar a tabela de compra
    $conn->exec("DELETE FROM tbl_compra");

    $conn->commit();

    header("Location: ec-carrinho.php");
    exit;
  } catch (PDOException $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
  }
}

carrinhoCompras($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho</title>
  <link rel="stylesheet" href="../css/carrinho.css" />
  <link rel="stylesheet" href="../css/cabecalho.css" />
  <link rel="icon" href="../img/Logos.svg" />
</head>

<body>
  <div class="container">
    <?php
    setarCookies();
    exibirConteudoComBaseNoPapel();
    ?>
    <div class="apresentacao">
      <img class="foto-ca" src="../img/cart_circle.png" />
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
      $stmt = $conn->query("SELECT * FROM tbl_carrinho");
      $produtos_no_carrinho = $stmt->fetchAll();

      $subtotal = 0;
      $total = 0;
      // Se houver produtos no carrinho, exiba-os na seção HTML
      if ($produtos_no_carrinho) {
        foreach ($produtos_no_carrinho as $produto) {
          $id_produto = $produto['id_produto'];
          $quantidade = $produto['quantidade'];
          // Busque informações adicionais sobre o produto no banco de dados
          $stmt = $conn->prepare("SELECT * FROM tbl_produto WHERE id_produto = :id_produto");
          $stmt->bindParam(':id_produto', $id_produto);
          $stmt->execute();
          $dados_produto = $stmt->fetch();

          $nome_produto = $dados_produto['nome']; // Supondo que o nome do produto está na coluna 'nome'
          $vunit = $dados_produto['preco']; // Supondo que o preço do produto está na coluna 'preco'
          $imagem = $dados_produto['imagem']; // Supondo que o caminho da imagem está na coluna 'imagem'
          $subtotal += $vunit * $quantidade;
          $total += $vunit * $quantidade;
          // Seção HTML para exibir detalhes do produto no carrinho
          echo "<div class='prod1'>
            <div class='desing-p'>
                <div class='ft-prod'><img src='$imagem' alt='imagem_produto' class='ft-prod'></div>
                <p class='nm-prod'>$nome_produto</p>
            </div>
            <div class='desing-v'>
                <p class='v-prod'>R$" . number_format($vunit, 2) . "</p>
            </div>
            <div class='desing-v'>
            <form method='post' action=''>
                <input type='hidden' name='id_produto' value='$id_produto'>
                <input type='hidden' name='quantidade' value='1'>
                <button type='submit' name='diminuir_quantidade'>-</button>
            </form>
                <input class='q-prod' id='input-$id_produto' type='number' value='$quantidade' readonly data-valor='$vunit' />";
          // Botão para aumentar a quantidade do produto
          echo "<form method='post' action=''>
            <input type='hidden' name='id_produto' value='$id_produto'>
            <input type='hidden' name='quantidade' value='1'>
            <button type='submit' name='aumentar_quantidade'>+</button>
            </form>";
          echo "</div>
            <div class='desing-t'>
                <p class='v-prod'>R$" . number_format($vunit * $quantidade, 2) . "</p>
            </div>
            <a class='retirar' href='#' onclick='removerProduto($id_produto)'>Remover</a>
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
        <button type="submit" id="btn-submit" style="display: none;"></button>
      </form>
      <button onclick="atualizarEEnviarFormularioPagamento()" class="pagar">Pagar</button>
      <button onclick="limparCarrinho()" class="limpar">Limpar Carrinho</button>
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

      document.getElementById("input-subtotal").value = totalFormatted;
      document.getElementById("input-total").value = totalFormatted;
      document.getElementById("formulario-pagamento").submit();
    }
  </script>
</body>

</html>