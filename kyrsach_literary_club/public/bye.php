<?php
$title = 'До свидания';
include __DIR__ . '/page_start.php';
?>

<div class="greeting-box">
    <h1>👋 Пока, <?= htmlspecialchars($name) ?>!</h1>
    <p>Ждем тебя снова в нашем книжном клубе!</p>
    <a href="<?= $basePath ?>">Вернуться на главную</a>
</div>

<?php include __DIR__ . '/page_end.php'; ?>