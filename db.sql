drop schema if exists `DBweb3`;

-- creacion de la base de datos
create schema if not exists `DBweb3` default character set utf8 collate utf8_sapanish_ci;

-- selecionamos la DB para trabajar sobre ella
USE `DBweb3`;

-- Crear un tabla

CREATE TABLE `user`( id int not null auto_increment primary key,
`nombre` text not null,
`edad` text not null,
`email` text,
`telefono` text
) engine=Innodb default charset=utf8;


