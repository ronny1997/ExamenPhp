CREATE USER 'adminCom'@'localhost' IDENTIFIED BY 'A10214!!';
GRANT SELECT ON `usuarios`.`reguistro` TO 'adminCom'@'localhost';
GRANT SELECT ON `usuarios`.`comentario` TO 'adminCom'@'localhost';