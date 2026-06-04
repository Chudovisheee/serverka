CREATE DATABASE IF NOT EXISTS literary_club;
USE literary_club;

-- Таблица пользователей (лаба 9)
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nickname` VARCHAR(128) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `is_confirmed` BOOLEAN DEFAULT FALSE,
    `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    `password_hash` VARCHAR(255) NOT NULL,
    `auth_token` VARCHAR(255),
    `avatar` VARCHAR(255) DEFAULT 'default-avatar.png',
    `bio` TEXT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Таблица книг (лабы 7-10)
CREATE TABLE `books` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `author_id` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `text` TEXT NOT NULL,
    `price` DECIMAL(10,2) DEFAULT 0,
    `cover` VARCHAR(255) DEFAULT 'default-cover.jpg',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`)
);

-- Таблица контактов (лаба 5)
CREATE TABLE `contacts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `surname` VARCHAR(100) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `lastname` VARCHAR(100),
    `gender` ENUM('мужской', 'женский') NOT NULL,
    `birth_date` DATE NOT NULL,
    `phone` VARCHAR(20),
    `address` TEXT,
    `email` VARCHAR(100),
    `comment` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Таблица отзывов
CREATE TABLE `reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `book_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `rating` INT CHECK (rating BETWEEN 1 AND 5),
    `comment` TEXT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

-- Тестовые данные
INSERT INTO `users` (`nickname`, `email`, `is_confirmed`, `role`, `password_hash`) VALUES
('admin', 'admin@club.ru', 1, 'admin', 'hash1'),
('booklover', 'lover@club.ru', 1, 'user', 'hash2');

INSERT INTO `books` (`author_id`, `name`, `text`, `price`) VALUES
(1, 'Мастер и Маргарита', 'Роман Михаила Булгакова о визите дьявола в Москву...', 599.00),
(1, 'Преступление и наказание', 'Роман Фёдора Достоевского о студенте Раскольникове...', 499.00);

INSERT INTO `contacts` (`surname`, `name`, `gender`, `birth_date`) VALUES
('Иванов', 'Иван', 'мужской', '1990-05-15'),
('Петрова', 'Мария', 'женский', '1985-08-22');