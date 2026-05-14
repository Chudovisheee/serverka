<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат get_headers</title>
    <link rel="stylesheet" href="laba2_2.css">
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="images/logo.png" 
             alt="МосПолитех">
    </div>
    <h1>Результат работы функции get_headers()</h1>
    <p>HTTP-заголовки сайта <strong></strong>:</p>
    <textarea readonly><?php
        $url = "https://httpbin.org/post";
        $headers = @get_headers($url);
        if ($headers === false) {
            echo "Не удалось получить заголовки. Проверьте интернет или allow_url_fopen.";
        } else {
            echo implode("\n", $headers);
        }
    ?></textarea>
    <br>
    <a href="laba2_1.php" class="back-link">← Вернуться на форму</a>
    <footer>
        Задание для самостоятельной работы «Feedback form»
    </footer>
</div>
</body>
</html>