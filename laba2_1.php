<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Feedback form - Лепорская Диана Алексеевна</title>
    <link rel="stylesheet" href="laba2_1.css">
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="images/logo.png" 
             alt="МосПолитех">
    </div>
    <h1>Форма обратной связи</h1>
    <form action="https://httpbin.org/post" method="POST" target="_blank">
        <label>Имя пользователя:</label>
        <input type="text" name="name" required>

        <label>E-mail пользователя:</label>
        <input type="email" name="email" required>

        <label>Тип обращения:</label>
        <select name="type" required>
            <option value="жалоба">Жалоба</option>
            <option value="предложение">Предложение</option>
            <option value="благодарность">Благодарность</option>
        </select>

        <label>Текст обращения:</label>
        <textarea name="message" rows="5" required></textarea>

        <label>Вариант ответа:</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="response[]" value="sms"> СМС</label>
            <label><input type="checkbox" name="response[]" value="email"> E-mail</label>
        </div>

        <button type="submit">Отправить</button>
        <a href="laba2_2.php" class="link">Перейти на 2 страницу</a>
    </form>
    <footer>
        Задание для самостоятельной работы «Feedback form»
    </footer>
</div>
</body>
</html>