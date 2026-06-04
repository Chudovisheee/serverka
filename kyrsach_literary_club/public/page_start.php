<?php
$basePath = '/php/kyrsach_literary_club/public';
$title = $title ?? 'Литературный клуб "Три точки"';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
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