CREATE DATABASE `bd-blog`;
USE `bd-blog`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','user') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) 
VALUES (NULL, 'admin', 'admin@gmail.com', '1', 'admin', 'hash1', 'token1', CURRENT_TIMESTAMP);

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) 
VALUES (NULL, 'user', 'user@gmail.com', '1', 'user', 'hash2', 'token2', CURRENT_TIMESTAMP);

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`) 
VALUES (NULL, '1', 'Статья №1', 'Текст первой статьи', CURRENT_TIMESTAMP);

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`) 
VALUES (NULL, '1', 'Статья №2', 'Текст второй статьи', CURRENT_TIMESTAMP);