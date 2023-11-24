<?php

// mostra erros do php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("../php/funcoes.php");

// calcula hoje
$hoje = date('Y-m-d');
// calcula ontem
$ontem = date('Y-m-d', strtotime('-1 day', strtotime($hoje)));

echo "
     <form action='' method='POST'>
      Data inicial<br><input type='date' name='datai' value='$ontem'><br>
      Data final<br><input type='date' name='dataf' value='$hoje'><br>
      <br>
      <input type='radio' name='formato' value='html' checked> Mostrar na tela (HTML)<br>
      <input type='radio' name='formato' value='pdf'> Gerar PDF<br>
      <br>
      <input type='checkbox' name='previsualizar'> Pré-visualizar após gerar (apenas se Gerar PDF estiver selecionado)<br>
      <br>
      <input type='submit' value='Gerar'>
     </form> ";

echo "<br><br>";
echo "<a href='index.php'>Voltar</a>";     

if ($_POST) {
  // faz conexao 
  $conn = conectarAoBanco();

  $datai = $_POST['datai'];
  $dataf = $_POST['dataf'];
  $formato = isset($_POST['formato']) ? $_POST['formato'] : 'html';
  $previsualizar = isset($_POST['previsualizar']);

  $SQLCompra =
    "SELECT compra.id_compra, compra.data, usuario.nome, 
      SUM(carrinho.quantidade * produto.preco) AS total  
FROM tbl_compra AS compra
INNER JOIN tbl_usuario AS usuario ON compra.id_usuario = usuario.id_usuario 
INNER JOIN tbl_carrinho AS carrinho ON carrinho.id_compra = compra.id_compra
INNER JOIN tbl_produto AS produto ON produto.id_produto = carrinho.id_produto 
WHERE 
   compra.data >= :datai AND compra.data <= :dataf AND 
   compra.status = 'PAGO'  
GROUP BY 
   compra.id_compra, compra.data, usuario.nome 
ORDER BY 
   compra.data";

  $SQLItensCompra =
    "SELECT tbl_produto.descricao, tbl_carrinho.quantidade, tbl_produto.preco, 
  tbl_carrinho.quantidade * tbl_produto.preco AS subtotal
FROM tbl_carrinho  
INNER JOIN tbl_produto ON tbl_produto.id_produto = tbl_carrinho.id_produto 
WHERE 
tbl_carrinho.id_compra = :id_compra   
ORDER BY 
tbl_produto.descricao";

  // formata valores em reais 
  setlocale(LC_ALL, 'pt_BR.utf-8',);

  $html = "<html>";

  $compra = $conn->prepare($SQLCompra);
  $compra->execute(['datai' => $datai, 'dataf' => $dataf]);
  $itens_compra = $conn->prepare($SQLItensCompra);

  $timestamp = date('Ymd_His');
  $pdfFileName = "relatorios/relatorio_$timestamp.pdf";

  while ($linha_compra = $compra->fetch()) {
    $id_compra = $linha_compra['id_compra'];
    $data = $linha_compra['data'];
    $cliente = $linha_compra['nome'];
    $total = number_format($linha_compra['total'], 2, ',', '.');

    $html .= "ID: $id_compra<br>";
    $html .= "Data: $data<br>";
    $html .= "Usuario: $cliente<br>";
    $html .= "Total (R$): $total<br><br>";

    $itens_compra->execute(['id_compra' => $linha_compra['id_compra']]);

    $html .= "Detalhes do Pedido:<br>";
    $html .= "Produto | Quantidade | Valor Unitário (R$) | Subtotal (R$)<br>";

    while ($linha_itens_compra = $itens_compra->fetch()) {
      $produto = $linha_itens_compra['descricao'];
      $qtd = $linha_itens_compra['quantidade'];
      $unit = number_format($linha_itens_compra['preco'], 2, ',', '.');
      $subtotal = number_format($linha_itens_compra['subtotal'], 2, ',', '.');

      $html .= "$produto | $qtd | $unit | $subtotal<br>";
    }

    $html .= "<br>";
  }

  $html .= "</html>";

  if ($formato == 'html') {
    // Mostrar na tela (HTML)
    echo $html;
  } elseif ($formato == 'pdf') {
    // Gerar PDF
    if (CriaPDF('Relatório de Vendas', $html, $pdfFileName)) {
      echo 'Gerado com sucesso';
      if ($previsualizar) {
        // Pré-visualizar após gerar PDF
        header('Location: ' . $pdfFileName);
        exit;
      }
    } else {
      echo 'Erro ao gerar';
    }
  }
}
?>
