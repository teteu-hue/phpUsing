CREATE DATABASE biblioteca;
show databases;
use biblioteca;

SELECT * FROM Genero;
SELECT * FROM Livro;
SELECT * FROM Editora;
SELECT * FROM Assunto;

DROP TABLE Livro;
DROP TABLE Genero;
DROP TABLE Editora;

-- tabela de livros ************************************
CREATE TABLE Genero(
	id_genero SERIAL PRIMARY KEY,
    nome_genero VARCHAR(50) NOT NULL
);

CREATE TABLE Editora(
	id_editora SERIAL PRIMARY KEY,
    nome_editora VARCHAR(55) NOT NULL
);

CREATE TABLE Livro(
	id_livro SERIAL PRIMARY KEY,
    titulo VARCHAR(45) NOT NULL,
    descricao VARCHAR(60) NOT NULL,
    codigo_de_barras VARCHAR(13) NOT NULL,
    local_armazenado VARCHAR (6) NOT NULL,
    id_genero INT NOT NULL,
    id_editora INT NOT NULL,
    id_assunto INT NOT NULL,
    FOREIGN KEY (id_genero) 
    REFERENCES Genero(id_genero),
    FOREIGN KEY (id_editora)
    REFERENCES Editora(id_editora)
);

CREATE TABLE Assunto(
	id_assunto SERIAL PRIMARY KEY,
    nome_assunto VARCHAR (22) NOT NULL
);

CREATE TABLE Livro_assunto(
    id_assunto INT NOT NULL,
    id_Livro INT NOT NULL,
	FOREIGN KEY (id_assunto) REFERENCES Assunto(id_assunto),
    FOREIGN KEY (id_livro) REFERENCES Livro(id_livro)
);
-- ***********************************

-- tabela de empréstimo
CREATE TABLE Emprestimo(
	id_emprestimo SERIAL PRIMARY KEY,
    data_emprestimo DATETIME NOT NULL,
    data_devolucao DATE NOT NULL,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_livro) 
    REFERENCES Livro(id_livro),
    FOREIGN KEY (id_pessoa)
    REFERENCES Pessoa(id_pessoa)
);

CREATE TABLE Devolucao(
	id_devolucao SERIAL PRIMARY KEY,
    data_devolucao_real DATE,
    FOREIGN KEY (id_emprestimo) 
    REFERENCES Emprestimo(id_emprestimo)
);
-- ****************************

-- tabela pessoa que será associado tanto em cliente quanto em funcionário
CREATE TABLE Pessoa(
	id_pessoa SERIAL PRIMARY KEY,
    nome_pessoa VARCHAR (45) NOT NULL,
    idade INT (3) NOT NULL,
    rg VARCHAR (12) NOT NULL,
    cpf VARCHAR (14) NOT NULL,
    data_nascimento DATE NOT NULL,
    id_contato INT NULL,
    FOREIGN KEY (id_contato) REFERENCES Contato(id_contato)
);

-- tabela cliente
CREATE TABLE Cliente(
	id_cliente SERIAL PRIMARY KEY,
    matricula VARCHAR (45) NOT NULL,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES Pessoa(id_pessoa)
);

-- tabela funcionário
CREATE TABLE Funcionario(
	id_funcionario SERIAL PRIMARY KEY,
    cod_interno VARCHAR (30) NOT NULL,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_pessoa) 
    REFERENCES Pessoa(id_pessoa)
);

-- ***************************

-- tabela de endereco
CREATE TABLE Endereco(
	id_endereco SERIAL PRIMARY KEY,
    logradouro VARCHAR (45) NOT NULL,
    numero INT (4) NOT NULL,
    complemento VARCHAR (45) NOT NULL,
    cep VARCHAR (8) NOT NULL
);
-- tabela que é usado para relacionar Pessoa com Endereço
-- Um endereço pode ter muitas pessoas
-- Uma pessoa pode ter muitos endereços
CREATE TABLE Pessoa_has_Endereco(
	FOREIGN KEY (id_pessoa) 
    REFERENCES Pessoa(id_pessoa),
    FOREIGN KEY (id_endereco) 
    REFERENCES Endereco(id_endereco)
);
-- tabela de contato
-- toda pessoa só poderá ter um meio de contato no website
CREATE TABLE Contato(
	id_contato SERIAL PRIMARY KEY,
    email VARCHAR (40) NOT NULL,
    telefone VARCHAR (11) NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES Pessoa(id_pessoa)
);

-- tabela de usuario, será utilizada para logar no website
CREATE TABLE Usuario(
	id_usuario SERIAL NOT NULL,
    id_pessoa INT,
	senha VARCHAR (45) NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES Pessoa(id_pessoa)
); 

INSERT INTO Genero(nome_genero) 
VALUES 
    ("Historia"),
    ("Artes"),
    ("Administracao"),
    ("Biologia"),
    ("Ficcao"),
    ("Comercio"),
    ("Informatica"),
    ("Lingua Inglesa"),
    ("Psicologia"),
    ("Matematica"),
    ("Quimica"),
    ("Musica"),
    ("Sociologia"),
    ("Urbanizacao"),
    ("Marketing"),
    ("Religiao"),
    ("Ciencias"),
    ("Fisica"),
    ("Portugues"),
    ("Redacao");
