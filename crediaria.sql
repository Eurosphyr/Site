-- Query que mostra id do produto, nome do produto, preço e fornecedor.
SELECT 
    p.id_produto,
    p.nome_produto,
    p.preco,
    f.nome_fornecedor
FROM 
    tbl_produto p
JOIN 
    tbl_fornecedor f ON p.fornecedor = f.id_fornecedor;

-- Query que mostra id,nome e preço dos produtos do ramo Higienização.
SELECT 
    p.id_produto,
    p.nome_produto,
    p.preco
FROM 
    tbl_produto p
JOIN 
    tbl_fornecedor f ON p.fornecedor = f.id_fornecedor
WHERE 
    f.ramo_atuacao = 'Higienização';

-- Query da quantidade de pedidos feitos por Osvaldo Pereira
SELECT 
    c.nome_cliente,
    COUNT(*) AS quantidade_pedidos
FROM 
    tbl_pedido pd
JOIN 
    tbl_cliente c ON pd.cliente = c.id_cliente
WHERE 
    c.nome_cliente = 'Osvaldo Pereira'
GROUP BY 
    c.nome_cliente;

-- Query que mostra o id do pedido, nome do produto, preço, qtde,e nome do cliente.
SELECT 
    pd.id_pedido,
    pr.nome_produto,
    pr.preco,
    pd.quantidade,
    c.nome_cliente
FROM 
    tbl_pedido pd
JOIN 
    tbl_cliente c ON pd.cliente = c.id_cliente
JOIN 
    tbl_produto pr ON pd.produto = pr.id_produto;


-- Query que mostra o total monetário de todos os pedidos realizados.

SELECT 
    SUM(pr.preco * pd.quantidade) AS total_pedido
FROM 
    tbl_pedido pd
JOIN 
    tbl_produto pr ON pd.produto = pr.id_produto;




