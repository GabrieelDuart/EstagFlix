
CREATE DATABASE IF NOT EXISTS login;
USE login;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`usuario_id`)
);

INSERT INTO usuario (usuario, senha)
SELECT 'admin', MD5('admin')
FROM DUAL
WHERE NOT EXISTS (
    SELECT *
    FROM usuario
);