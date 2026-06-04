<?php
$basePath = '/php/kyrsach_literary_club/public';

// Подключение к БД напрямую
$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

$greeting = "Привет!";
$currentTime = date("H:i:s");

include __DIR__ . '/page_start.php';
?>

<h2><?= $greeting ?></h2>
<p>Время: <?= $currentTime ?></p>

<div class="book-list">
    <?php foreach ($books as $book): ?>
        <div class="book-card">
            <h4><?= htmlspecialchars($book['name']) ?></h4>
            <span class="price"><?= $book['price'] ?> ₽</span>
            <a href="<?= $basePath ?>/book_detail.php?id=<?= $book['id'] ?>">Подробнее</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/page_end.php'; ?>