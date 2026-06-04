<?php
$basePath = '/php/laba10/www';
include __DIR__ . '/../page_start.php';
?>

    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p><strong>Автор:</strong> <?= $article->getAuthor()->getNickname() ?></p>
    
    <p><a href="/php/laba10/www/articles/<?= $article->getId() ?>/edit">Редактировать статью</a></p>

<?php include __DIR__ . '/../page_end.php'; ?>