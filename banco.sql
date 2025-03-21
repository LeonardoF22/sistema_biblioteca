CREATE DATABASE sistema_biblioteca;
USE sistema_biblioteca;
CREATE TABLE tb_usuarios(
	Id_usuario INT AUTO_INCREMENT PRIMARY KEY,
	Nome VARCHAR(100),
	Ra INT,
	Data_ingresso DATE,
	Telefone VARCHAR(30),
	Curso VARCHAR(30)
) ;

CREATE TABLE tb_livros(
	Id_livro INT AUTO_INCREMENT PRIMARY KEY,
    Numero INT,
	Titulo VARCHAR(100),
	Autor VARCHAR(100),
	Ano_publicacao INT,
	Categoria VARCHAR(30),
	qtde_exemplares INT
);

CREATE TABLE tb_emprestimos(
	Id_emprestimo INT AUTO_INCREMENT PRIMARY KEY,
	Data_emprestimo DATE,
	Data_devolucao DATE,
    Id_usuario INT,
    Id_livro INT,
    FOREIGN KEY (Id_usuario) REFERENCES tb_usuarios(Id_usuario),
    FOREIGN KEY (Id_livro) REFERENCES tb_livros(Id_livro)
);
