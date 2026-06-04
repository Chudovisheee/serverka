<?php
$basePath = '/php/laba10/www';
include __DIR__ . '/../page_start.php';
?>

<h1>Редактирование статьи</h1>

<form method="POST" action="<?= $basePath ?>/articles/<?= $article->getId() ?>/edit">
    <div>
        <label>Название статьи:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($article->getName()) ?>" style="width: 100%;">
    </div>
    <br>
    <div>
        <label>Текст статьи:</label><br>
        <textarea name="text" rows="10" style="width: 100%;"><?= htmlspecialchars($article->getText()) ?></textarea>
    </div>
    <br>
    <button type="submit">Сохранить</button>
    <a href="<?= $basePath ?>/articles/<?= $article->getId() ?>">Отмена</a>
</form>

<?php include __DIR__ . '/../page_end.php'; ?>