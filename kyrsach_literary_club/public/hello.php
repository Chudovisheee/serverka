<?php
$title = 'Приветствие';
include __DIR__ . '/page_start.php';
?>

<div class="greeting-box">
    <i class="fas fa-hand-peace" style="font-size: 64px; color: #F4A0B5;"></i>
    <h1>Привет, <?= htmlspecialchars($name) ?>!</h1>
    <p><i class="fas fa-book-reader"></i> Рады видеть тебя в нашем книжном клубе!</p>
    <a href="<?= $basePath ?>" class="btn"><i class="fas fa-arrow-left"></i> Вернуться на главную</a>
</div>

<?php include __DIR__ . '/page_end.php'; ?>