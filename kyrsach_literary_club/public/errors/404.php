<?php
$title = 'Страница не найдена';
include __DIR__ . '/../page_start.php';
?>

<div class="error-404">
    <i class="fas fa-search" style="font-size: 80px; color: #F4A0B5;"></i>
    <h1>404</h1>
    <h2><i class="fas fa-face-frown"></i> Страница не найдена</h2>
    <p>К сожалению, запрашиваемая страница не существует.</p>
    <a href="<?= $basePath ?>" class="btn"><i class="fas fa-home"></i> Вернуться на главную</a>
</div>

<?php include __DIR__ . '/../page_end.php'; ?>