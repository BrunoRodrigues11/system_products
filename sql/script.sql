CREATE DATABASE bgg_technologies;
USE bgg_technologies;

CREATE TABLE categoria(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(100)
)ENGINE = innodb;

CREATE TABLE vendedor(
    cod INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    cidade varchar(100) not NULL,
    estado CHAR(2) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    parc_comissao NUMERIC NOT NULL
)ENGINE = innodb;

CREATE TABLE cliente(
    codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    telefone VARCHAR(11) not null,
    limite_cred NUMERIC NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    estado CHAR(2) NOT NULL
)ENGINE = innodb;

CREATE TABLE vendas(
    numero int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    data DATE NOT NULL,
    prazo_entrega VARCHAR(100) NOT NULL,
    cond_pagto VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    cod_cliente INT NOT NULL,
    cod_vendedor INT NOT NULL
)ENGINE = innodb;

ALTER TABLE vendas ADD CONSTRAINT fk_cliente FOREIGN KEY (cod_cliente) REFERENCES cliente(codigo);
ALTER TABLE vendas ADD CONSTRAINT fk_vendedor FOREIGN KEY (cod_vendedor) REFERENCES vendedor(cod);

CREATE TABLE produtos(
    cod INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    preco NUMERIC NOT NULL,
    qtd_estoque INT NOT NULL,
    qtd_estoque_min INT NOT NULL,    
    unidade_medida CHAR(2) NOT NULL,
    id_categoria INT NOT NULL   
)ENGINE = innodb;

ALTER TABLE produtos ADD CONSTRAINT fk_categoria_id FOREIGN KEY (id_categoria) REFERENCES categoria(id);

CREATE TABLE itens_vendas(
    cod INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cod_produto INT NOT NULL,
    numero_venda INT NOT NULL,
    quant_vendida INT,
    subtotal INT NOT NULL
)ENGINE = innodb;

ALTER TABLE itens_vendas ADD CONSTRAINT fk_produtos_cod FOREIGN KEY(cod_produto) REFERENCES produtos(cod);
ALTER TABLE itens_vendas ADD CONSTRAINT fk_vendas_num FOREIGN KEY (numero_venda) REFERENCES vendas(numero);

CREATE VIEW cont_prod AS 
    SELECT count(*) AS qtde_prod FROM produtos;

CREATE VIEW cont_prod_cat AS 
    SELECT c.descricao AS categoria, count(p.id_categoria) AS qtde_prod 
    FROM produtos p 
    INNER JOIN categoria c ON p.id_categoria = c.id
    GROUP BY c.descricao;

CREATE VIEW list_estoque_min AS 
    SELECT p.nome AS Produto, p.qtd_estoque AS qtd_estoque, p.qtd_estoque_min AS qtd_estoque_min 
    FROM produtos p 
    WHERE p.qtd_estoque = p.qtd_estoque_min;

CREATE VIEW list_estoque_zero AS 
    SELECT p.cod AS cod, p.nome AS nome, p.preco AS preco, p.qtd_estoque AS qtd_estoque, p.unidade_medida AS unidade_medida, p.id_categoria AS id_categoria 
    FROM produtos p 
    WHERE p.qtd_estoque <= 0;

CREATE VIEW list_itens_venda AS 
    SELECT iv.cod AS num_item, iv.numero_venda AS numero_venda, p.cod AS cod, p.nome AS nome, p.unidade_medida AS unidade_medida, p.preco AS preco, iv.quant_vendida AS quant_vendida, p.preco* iv.quant_vendida AS total 
    FROM itens_vendas iv 
    INNER JOIN produtos p ON p.cod = iv.cod_produto
    ORDER BY iv.cod ASC;

CREATE VIEW list_prod_cat AS 
    SELECT p.cod AS cod, p.nome AS nome, p.preco AS preco, p.qtd_estoque AS qtd_estoque, p.qtd_estoque_min AS qtd_estoque_min, p.unidade_medida AS unidade_medida, p.id_categoria AS id_categoria, c.descricao AS categoria 
    FROM categoria c 
    INNER JOIN produtos p ON c.id = p.id_categoria
    ORDER BY p.cod ASC;

CREATE VIEW qtde_estoque_min AS 
    SELECT count(*) AS qtde 
    FROM list_estoque_min;

CREATE VIEW qtde_estoque_total AS 
    SELECT sum(p.qtd_estoque) AS qtde 
    FROM produtos p;

CREATE VIEW qtde_estoque_zero AS 
    SELECT count(*) AS qtde 
    FROM list_estoque_zero;

INSERT INTO `categoria` (`id`, `descricao`) VALUES
(1, 'Eletrônicos'),
(2, 'Eletrodoméstico'),
(3, 'Brinquedos'),
(4, 'Limpeza'),
(5, 'Alimentos'),
(6, 'Frutas'),
(7, 'Automotivo'),
(8, 'Açougue');

INSERT INTO `vendedor` (`cod`, `nome`, `endereco`, `cidade`, `estado`, `telefone`, `parc_comissao`) VALUES
(1, 'Lionel Messi', 'Rua das Lendas', 'Itapetininga', 'SP', '15999999999', '20'),
(2, 'Cristiano Ronaldo', 'Rua das Lendas', 'Itapetininga', 'SP', '15999999999', '20'),
(3, 'Ronaldinho', 'Rua das Lendas', 'Itapetininga', 'SP', '15999999999', '20'),
(4, 'Kaká', 'Rua das Lendas', 'Itapetininga', 'SP', '15999999999', '20');

INSERT INTO `cliente` (`codigo`, `nome`, `endereco`, `telefone`, `limite_cred`, `cidade`, `email`, `cpf`, `estado`) VALUES
(1, 'Bruno Rodrigues', 'Rua do Sol', '15999999999', '50000', 'Itapetininga', 'bruno@tech.com', '46850075810', 'SP'),
(2, 'Gabriel Santos', 'Rua da Lua', '15999999999', '50000', 'Tatuí', 'Gabi@tech.com', '12345678912', 'SP'),
(3, 'Guilherme Gameplays', 'Rua de Marte', '15999999999', '50000', 'Itapetininga', 'Gui@tech.com', '12345678915', 'SP');

INSERT INTO `produtos` (`cod`, `nome`, `preco`, `qtd_estoque`, `qtd_estoque_min`, `unidade_medida`, `id_categoria`) VALUES
(1, 'Smartphone Samsung Galaxy S20 FE', '2200', 365, 250, 'UN', 1),
(2, 'Geladeira Consul', '2000', 2001, 2000, 'UN', 2),
(3, 'Sabão em pó OMO', '5', 400, 500, 'UN', 4),
(4, 'Iphone 100 PRO MAX SUPER', '10000', 199, 200, 'UN', 1),
(5, 'Fogão Consul', '1900', 999, 5000, 'UN', 2),
(6, 'Pneu aro 17', '250', 96, 50, 'UN', 7),
(7, 'Carrinho Hotwheels', '10', 995, 500, 'UN', 3),
(8, 'Bicicleta', '1000', 250, 200, 'UN', 3),
(9, 'Micro ondas Consul', '500', 520, 200, 'UN', 2),
(10, 'Maçã', '3', 1000, 500, 'UN', 6),
(11, 'Arroz ', '15', 1000, 500, 'UN', 5),
(12, 'Smartwatch Haylou', '500', 150, 100, 'UN', 1);

INSERT INTO `vendas` (`numero`, `data`, `prazo_entrega`, `cond_pagto`, `total`, `cod_cliente`, `cod_vendedor`) VALUES
(1, '2023-06-06', '2023-06-06', 'credito', 2205, 1, 1),
(2, '2023-06-06', '2023-06-06', 'pix', 13900, 2, 2),
(3, '2023-06-06', '2023-06-07', 'pix', 22000, 1, 1),
(4, '2023-06-06', '2023-06-07', 'dinheiro', 110000, 3, 3),
(5, '2023-06-06', '2023-06-09', 'credito', 22000, 2, 4),
(6, '2023-06-06', '2023-06-07', 'credito', 3955, 1, 1),
(7, '2023-06-06', '2023-06-10', 'credito', 50, 3, 2),
(8, '2023-06-06', '2023-06-10', 'credito', 50, 3, 2),
(9, '2023-06-06', '2023-06-10', 'credito', 1000, 2, 2),
(10, '2023-06-06', '2023-06-06', 'pix', 22000, 1, 1),
(11, '2023-06-06', '2023-06-06', 'pix', 2200, 1, 1),
(12, '2023-06-06', '2023-06-06', 'pix', 110000, 1, 1),
(13, '2023-06-06', '2023-06-06', 'pix', 250, 2, 2),
(14, '2023-06-06', '2023-06-07', 'pix', 107800, 1, 1),
(15, '2023-06-06', '2023-06-07', 'pix', 0, 1, 1),
(16, '2023-06-06', '2023-06-07', 'pix', 2000, 2, 1),
(17, '2023-06-06', '2023-06-08', 'pix', 110000, 2, 4),
(18, '2023-06-06', '2023-06-06', 'pix', 2200, 1, 1),
(19, '2023-06-06', '2023-06-06', 'pix', 2200, 1, 1),
(20, '2023-06-06', '2023-06-07', 'pix', 26400, 1, 1),
(21, '2023-06-07', '2023-06-07', 'pix', 26400, 1, 1),
(22, '2023-06-06', '2023-06-06', 'pix', 245, 3, 2),
(25, '2023-06-09', '2023-06-12', 'credito', 2200, 1, 3),
(26, '2023-06-07', '2023-06-09', 'pix', 6600, 1, 1);

INSERT INTO `itens_vendas` (`cod`, `cod_produto`, `numero_venda`, `quant_vendida`, `subtotal`) VALUES
(1, 3, 1, 1, 5),
(2, 1, 1, 1, 2200),
(3, 4, 2, 1, 10000),
(4, 2, 2, 1, 2000),
(5, 5, 2, 1, 1900),
(6, 1, 3, 10, 22000),
(7, 1, 4, 50, 110000),
(8, 1, 5, 10, 22000),
(9, 3, 6, 1, 5),
(10, 2, 6, 1, 2000),
(11, 5, 6, 1, 1900),
(12, 7, 6, 5, 50),
(13, 3, 7, 10, 50),
(14, 6, 9, 4, 1000),
(15, 1, 10, 10, 22000),
(16, 1, 11, 1, 2200),
(17, 1, 12, 50, 110000),
(18, 3, 13, 50, 250),
(19, 1, 14, 49, 107800),
(20, 2, 16, 1, 2000),
(21, 1, 17, 50, 110000),
(22, 1, 18, 1, 2200),
(23, 1, 19, 1, 2200),
(24, 1, 20, 12, 26400),
(25, 1, 21, 12, 26400),
(26, 3, 22, 49, 245),
(27, 1, 25, 1, 2200),
(28, 1, 26, 1, 2200),
(29, 1, 26, 1, 2200),
(30, 1, 26, 1, 2200);