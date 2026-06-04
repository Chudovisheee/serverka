<?php
$basePath = '/php/kyrsach_literary_club/public';
$id = $_GET['id'] ?? 0;

if (!$id) {
    header('Location: ' . $basePath . '/books_direct.php');
    exit;
}

$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    header('Location: ' . $basePath . '/books_direct.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($book['name']) ?></title>
    <link rel="stylesheet" href="<?= $basePath ?>/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
    <div class="logo">
        <i class="fas fa-book-open"></i>
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

<div class="book-detail">
    <div class="book-cover-large">
        <img src="<?= $basePath ?>/uploads/<?= $book['cover'] ?>" 
             onerror="this.src='<?= $basePath ?>/images/default-cover.png'">
    </div>
    <div class="book-info">
        <h1><i class="fas fa-book"></i> <?= htmlspecialchars($book['name']) ?></h1>
        <p class="author"><i class="fas fa-user-pen"></i> Автор: Админ</p>
        <p class="price"><i class="fas fa-tag"></i> Цена: <?= $book['price'] ?> ₽</p>
        <div class="description">
            <h3><i class="fas fa-align-left"></i> Описание:</h3>
            <p><?= nl2br(htmlspecialchars($book['text'])) ?></p>
        </div>
        <a href="<?= $basePath ?>/cart/index.php?add=<?= $book['id'] ?>" class="btn-buy"><i class="fas fa-shopping-cart"></i> Добавить в корзину</a>
    </div>
</div>

</main>
<footer>
    <p><i class="fas fa-copyright"></i> 2024 Литературный клуб "Три точки"</p>
</footer>
</body>
</html>