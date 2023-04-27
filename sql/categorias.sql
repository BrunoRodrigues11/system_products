CREATE DATABASE bgg_technologies;

CREATE TABLE categoria(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(100)
)ENGINE = innodb;

CREATE TABLE vendedor(
    cod INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    enderco VARCHAR(100) NOT NULL,
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
    unidade_medida CHAR(2) NOT NULL,
    id_categoria INT NOT NULL   
)ENGINE = innodb;

ALTER TABLE produtos ADD CONSTRAINT fk_categoria_id FOREIGN KEY (id_categoria) REFERENCES categoria(id);

CREATE TABLE itens_vendas(
    cod INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cod_produto INT NOT NULL,
    numero_venda INT NOT NULL,
    quant_vendida INT
)ENGINE = innodb;

ALTER TABLE itens_vendas ADD CONSTRAINT fk_produtos_cod FOREIGN KEY(cod_produto) REFERENCES produtos(cod);
ALTER TABLE itens_vendas ADD CONSTRAINT fk_vendas_num FOREIGN KEY (numero_venda) REFERENCES vendas(numero);