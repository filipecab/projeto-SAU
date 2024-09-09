-- 1º Aberta
-- 2º Encripta SHA 256

SHOW VARIABLES LIKE 'character_set%';

CREATE TABLE usuario(
	des_login VARCHAR(20) NOT NULL,
	des_senha VARCHAR(64) NOT NULL,
	primary key (des_login)
);

INSERT INTO usuario (des_login, des_senha)
VALUES (
	'admin',
	SHA2('admin',256)
);

select * from usuario;

select SHA2('admin',256);