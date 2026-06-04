<?php
$basePath = '/php/kyrsach_literary_club/public';
$title = $book->getName();
include __DIR__ . '/../page_start.php';
?>

<div class="book-detail">
    <div class="book-info">
        <h1><?= htmlspecialchars($book->getName()) ?></h1>
        <p class="price">💰 Цена: <?= $book->getPrice() ?> ₽</p>
        <p>📖 Описание:</p>
        <p><?= nl2br(htmlspecialchars($book->getText())) ?></p>
    </div>
</div>

<?php include __DIR__ . '/../page_end.php'; ?>