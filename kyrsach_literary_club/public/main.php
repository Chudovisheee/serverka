<?php
$title = 'Главная - Три точки';
include __DIR__ . '/page_start.php';
?>

<div class="welcome">
    <h2><?= $greeting ?></h2>
    <p>⏰ Текущее время: <?= $currentTime ?></p>
    <p>📚 Добро пожаловать в литературный клуб "Три точки"!</p>
</div>

<div class="featured-books">
    <h3>🔥 Популярные книги</h3>
    <div class="book-list">
        <!-- Тут будет список книг из БД -->
        <div class="book-card">
            <h4>Мастер и Маргарита</h4>
            <p>Михаил Булгаков</p>
            <span class="price">599 ₽</span>
            <a href="/php/kyrsach_literary_club/public/books/1">Подробнее →</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/page_end.php'; ?>