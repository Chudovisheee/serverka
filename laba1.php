<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello, World! - Динамическая страница</title>
    <link rel="stylesheet" href="laba1.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <div class="logo-placeholder">
                <img src="images/logo.png" alt="МосПолитех">
            </div>
        </div>
        <div class="work-title">
            Лабораторная работа: «Hello, World!»
        </div>
        <div style="width: 100px;"></div>
    </div>
    <div class="main">
        <div class="dynamic-box">
            <?php
                date_default_timezone_set('Europe/Moscow');
                $current_time = date("H:i:s d.m.Y");
                $greeting = "Hello, World!";
                
                $hour = date("H");
                if ($hour < 12) {
                    $time_msg = "Доброе утро!";
                } elseif ($hour < 18) {
                    $time_msg = "Добрый день!";
                } else {
                    $time_msg = "Добрый вечер!";
                }
            ?>
            <h1><?php echo $greeting; ?></h1>
            <div class="info">
                Время генерации страницы: <?php echo $current_time; ?><br>
                <?php echo $time_msg; ?> Рады вас видеть на курсе серверной разработки!
            </div>
        </div>
    </div>
    <div class="footer">
        Задание для самостоятельной работы
    </div>

</body>
</html>