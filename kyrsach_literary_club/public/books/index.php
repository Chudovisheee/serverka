<?php
$basePath = '/php/kyrsach_literary_club/public';
$title = 'Все книги';
include __DIR__ . '/../page_start.php';
?>

<h1><i class="fas fa-book"></i> Все книги</h1>

<div class="book-list">
    <?php foreach ($books as $book): ?>
        <div class="book-card">
            <h4><?= htmlspecialchars($book->getName()) ?></h4>
            <span class="price"><?= $book->getPrice() ?> ₽</span>
            <a href="<?= $basePath ?>/index.php?route=books/<?= $book->getId() ?>">Подробнее →</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../page_end.php'; ?>