create schema produtos;

INSERT INTO produtos.produtos (cod_prod, loj_prod, desc_prod, dt_inclui_prod, preco_prod) VALUES (170, 2, 'leite condensado mococa', '2010-12-30', 45.400)

UPDATE produtos.produtos t SET t.preco_prod = 95.400 WHERE t.cod_prod = 170 AND t.loj_prod = 2

SELECT t.* FROM produtos.produtos t LIMIT 100

SELECT t.loj_prod, max(t.dt_inclui_prod), min(t.dt_inclui_prod) FROM produtos.produtos t group by t.loj_prod

SELECT count(*) as total_produtos FROM produtos.produtos

SELECT count(*) as total_produtos FROM produtos.produtos where desc_prod LIKE 'L%'

SELECT sum(t.preco_prod) as valor_total_produtos_por_loja FROM produtos.produtos t group by t.loj_prod

SELECT sum(t.preco_prod) as valor_maior FROM produtos.produtos t where t.preco_prod > 100.000 group by t.loj_prod



SELECT l.loj_prod as cod_loja,
       l.desc_loj as desc_loja,
       p.loj_prod as loja_prod,
       p.desc_prod as desc_prod,
       p.preco_prod as preco_prod,
       e.qtd_prod as qtd_prod
FROM lojas l
         inner join produto p on p.loj_prod = l.loj_prod
         inner join estoque e on e.loj_prod = l.loj_prod
WHERE l.loj_prod = 1 group by p.preco_prod




SELECT  p.loj_prod as loja_prod,
        p.desc_prod as desc_prod,
        p.preco_prod as preco_prod,
        e.qtd_prod as qtd_prod
FROM estoque e
         right join produtos p on e.cod_prod = p.cod_prod




SELECT  p.loj_prod as loja_prod,
        p.desc_prod as desc_prod,
        p.preco_prod as preco_prod,
        e.qtd_prod as qtd_prod
FROM estoque e
         left join produtos p on e.cod_prod = p.cod_prod
