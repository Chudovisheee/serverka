CREATE DATABASE IF NOT EXISTS contact_book;
USE contact_book;

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100),
    gender ENUM('мужской', 'женский') NOT NULL,
    birth_date DATE NOT NULL,contactscontactscontactsid
    phone VARCHAR(20),
    address TEXT,
    email VARCHAR(100),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contacts (surname, name, lastname, gender, birth_date, phone, address, email, comment) VALUES
('Иванов', 'Иван', 'Иванович', 'мужской', '1990-05-15', '+7-123-456-7890', 'ул. Пушкина, д.10', 'ivan@example.com', 'Коллега'),
('Петрова', 'Мария', 'Сергеевна', 'женский', '1985-08-22', '+7-234-567-8901', 'ул. Лермонтова, д.5', 'maria@example.com', 'Клиент'),
('Сидоров', 'Алексей', 'Викторович', 'мужской', '2000-03-10', '+7-345-678-9012', 'ул. Гоголя, д.7', 'alex@example.com', 'Партнер');