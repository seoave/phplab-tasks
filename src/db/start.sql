CREATE DATABASE homework

CREATE TABLE `colors` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`color` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`)
)

CREATE TABLE `types` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)

CREATE TABLE `products` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`price` FLOAT(10,2) UNSIGNED NOT NULL,
	`width` INT(10) UNSIGNED NOT NULL,
	`height` INT(10) UNSIGNED NOT NULL,
	`type_id` INT(10) UNSIGNED NOT NULL,
	`color_id` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
   FOREIGN KEY (`type_id`) REFERENCES types (id),
   FOREIGN KEY (`color_id`) REFERENCES colors (id)
)

INSERT INTO colors (color) VALUES ('steel') ;
INSERT INTO colors (color) VALUES ('gold') ;
INSERT INTO colors (color) VALUES ('green') ;
INSERT INTO colors (color) VALUES ('red') ;
INSERT INTO colors (color) VALUES ('black') ;
INSERT INTO types (type) VALUES ('electric') ;
INSERT INTO types (type) VALUES ('water') ;
INSERT INTO types (type) VALUES ('dry') ;
INSERT INTO types (type) VALUES ('air') ;
INSERT INTO products (name,price,width,height,type_id,color_id) VALUES ('product1',500,500,400,1,1) ;
INSERT INTO products (name,price,width,height,type_id,color_id) VALUES ('product2',800,500,700,2,2) ;
INSERT INTO products (name,price,width,height,type_id,color_id) VALUES ('product3',1000,700,700,3,4) ;
INSERT INTO products (name,price,width,height,type_id,color_id) VALUES ('product4',1100,800,500,3,3) ;
INSERT INTO products (name,price,width,height,type_id,color_id) VALUES ('product5',1200,900,700,4,4) ;