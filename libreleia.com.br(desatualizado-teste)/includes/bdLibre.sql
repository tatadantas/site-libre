CREATE DATABASE bdLibre;
USE bdLibre;

CREATE TABLE usuarios(

id_cadastro int AUTO_INCREMENT PRIMARY KEY,
email_cadastro VARCHAR(60) NOT NULL UNIQUE,
nome_cadastro VARCHAR(35) NOT NULL,
username_cadastro VARCHAR (20) NOT NULL UNIQUE, 
telefone_cadastro VARCHAR (15) NOT NULL UNIQUE,
data_nasc_cadastro DATE NOT NULL,
senha_cadastro VARCHAR(30) NOT NULL,
data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP /*data de crição da conta*/

);

 SELECT * FROM usuarios;

 CREATE TABLE livros (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        autor VARCHAR(255) NOT NULL,
        descricao TEXT,
        capa VARCHAR(255),
        arquivo VARCHAR(255) NOT NULL,
        data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );