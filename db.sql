CREATE DATABASE db_escola;

USE db_escola;

CREATE TABLE tb_alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL,
    genero VARCHAR(20) NOT NULL,
    dataNascimento DATETIME NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL
);

CREATE TABLE tb_professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    endereco VARCHAR(45) NOT NULL,
    formacao VARCHAR(45) NOT NULL,
    status TINYINT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL
);

CREATE TABLE tb_user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile VARCHAR(20) NOT NULL
);

CREATE TABLE tb_categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE tb_cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cargaHoraria VARCHAR(50) NOT NULL,
    descricao VARCHAR(100)  NOT NULL,
    status TINYINT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES tb_categorias(id)
);
