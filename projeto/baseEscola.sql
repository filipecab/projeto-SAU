CREATE DATABASE ok_curso;

CREATE TABLE ok_curso.aluno ( 
  cod_matricula int not null, 
  des_nome varchar(250),
  cod_genero char(1),
  num_cep char(8),
  des_email varchar(100), 
  cod_curso int,
  PRIMARY KEY (cod_matricula),
  FOREIGN KEY (num_cep) REFERENCES endereco(num_cep),
  FOREIGN KEY (cod_curso) REFERENCES curso(cod_curso)
);

CREATE TABLE ok_curso.endereco ( 
    num_cep CHAR(8) NOT NULL,  
    des_logradouro VARCHAR(100),  
    des_rua VARCHAR(50),  
    des_bairro VARCHAR(80),  
    cod_cidade INT,  
    PRIMARY KEY (num_cep),  
    FOREIGN KEY (cod_cidade) REFERENCES cidade(cod_cidade)
);

CREATE TABLE ok_curso.cidade (
  cod_cidade int not null,
  nom_cidade varchar(80),
  sig_uf char(2),
  PRIMARY KEY (cod_cidade)
);


CREATE TABLE ok_curso.curso(
  cod_curso int not null,
  nom_curso varchar(30),
  num_cargahoraria int,
  cod_turno int,
  PRIMARY KEY (cod_curso),
  FOREIGN KEY (cod_turno) REFERENCES turno(cod_turno)
);

CREATE TABLE ok_curso.turno(
  cod_turno int not null,
  turno char(1),
  PRIMARY KEY (cod_turno)
);




CREATE OR REPLACE VIEW cid_aluno
AS SELECT c.nom_cidade, a.des_nome 
FROM aluno a INNER JOIN endereco e
ON (a.num_cep = e.num_cep)
INNER JOIN cidade c
ON (e.cod_cidade = c.cod_cidade);

SELECT * FROM cid_aluno;


