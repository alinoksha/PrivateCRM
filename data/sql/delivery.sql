CREATE DATABASE IF NOT EXISTS `delivery` ;
USE `delivery`;

CREATE TABLE IF NOT EXISTS `client`(
    `id` int(10) unsigned AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `surname` varchar(255) NOT NULL,
    `patronymic` varchar(255),
    `phone` char(10) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`phone`)
);

CREATE TABLE IF NOT EXISTS `diet`(
    `id` int(10) unsigned AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`name`)
);

CREATE TABLE IF NOT EXISTS `schedule`(
    `id` int(10) unsigned AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`name`)
);

CREATE TABLE IF NOT EXISTS `order`(
    `id` int(10) unsigned AUTO_INCREMENT,
    `date` timestamp DEFAULT CURRENT_TIMESTAMP,
    `start` date NOT NULL,
    `end` date NOT NULL,
    `weekday` int(7) unsigned NOT NULL,
    `comment` text,
    `client_id` int(10) unsigned NOT NULL,
    `schedule_id` int(10) unsigned NOT NULL,
    `diet_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`client_id`) REFERENCES `client`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`schedule_id`) REFERENCES `schedule`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`diet_id`) REFERENCES `diet`(`id`) ON DELETE CASCADE
);

INSERT INTO `diet` (`name`) VALUES ('Спорт'), ('Баланс'), ('Премиум');

INSERT INTO `schedule` (`name`) VALUES ('Ежедневная'), ('Через день на один день питания'), ('Через день на 2 дня питания');
