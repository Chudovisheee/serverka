<?php
$basePath = '/php/kyrsach_literary_club/public';

$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM books");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $books = [];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все книги</title>
    <link rel="stylesheet" href="<?= $basePath ?>/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="<?= $basePath ?>/images/logo.png" alt="Лого" height="50">
        Три точки
    </div>
    <nav>
        <a href="<?= $basePath ?>/"><i class="fas fa-home"></i> Главная</a>
        <a href="<?= $basePath ?>/books_direct.php"><i class="fas fa-book"></i> Книги</a>
        <a href="<?= $basePath ?>/contacts"><i class="fas fa-address-book"></i> Участники</a>
        <a href="<?= $basePath ?>/profile/edit"><i class="fas fa-user"></i> Профиль</a>
        <a href="<?= $basePath ?>/stats"><i class="fas fa-chart-line"></i> Статистика</a>
        <a href="<?= $basePath ?>/feedback"><i class="fas fa-envelope"></i> Обратная связь</a>
        <a href="<?= $basePath ?>/cart"><i class="fas fa-shopping-cart"></i> Корзина</a>
        <a href="<?= $basePath ?>/hello/Друг"><i class="fas fa-hand-peace"></i> Привет</a>
        <a href="<?= $basePath ?>/bye/Друг"><i class="fas fa-waveform"></i> Пока</a>
    </nav>
</header>
<main>

<h1><i class="fas fa-book"></i> Все книги</h1>

<div class="book-list">
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $book): ?>
            <div class="book-card">
                <h4><?= htmlspecialchars($book['name']) ?></h4>
                <p>Автор: Админ</p>
                <span class="price"><?= $book['price'] ?> ₽</span>
                <a href="<?= $basePath ?>/book_detail.php?id=<?= $book['id'] ?>"><i class="fas fa-eye"></i> Подробнее →</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>😢 Книг пока нет</p>
    <?php endif; ?>
</div>

</main>
<footer>
    <p><i class="fas fa-copyright"></i> 2026 Литературный клуб "Три точки"</p>
</footer>
</body>
</html>