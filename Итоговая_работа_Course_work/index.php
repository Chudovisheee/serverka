<?php
require_once 'config.php';
session_start();

$_SESSION['user_id'] = $_SESSION['user_id'] ?? 1;

$channels = $conn->query("SELECT id, name FROM channels ORDER BY name");
$hashtags = $conn->query("SELECT id, name FROM hashtags ORDER BY name");
$fields = $conn->query("SELECT id, name FROM fields ORDER BY name");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>#сортер - Добавление сообщения</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 150px; }
        select, textarea, input[type="text"] { width: 300px; padding: 5px; }
        textarea { height: 80px; }
        button { padding: 8px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>➕ Новое сообщение</h2>
    <form action="add_message.php" method="post">
        <div class="form-group">
            <label>Канал:</label>
            <select name="channel_id" required>
                <option value="">-- Выберите канал --</option>
                <?php while ($row = $channels->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Хэштег (#):</label>
            <select name="hashtag_id" required>
                <option value="">-- Выберите хэштег --</option>
                <?php while ($row = $hashtags->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>">#<?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Область знаний:</label>
            <select name="field_id">
                <option value="new">-- Создать новую область --</option>
                <?php while ($row = $fields->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="new_field_name" placeholder="Название новой области">
        </div>

        <div class="form-group">
            <label>Текст сообщения:</label>
            <textarea name="description" required></textarea>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="save_flag" value="1">
                Сохранить лично (не показывать другим)
            </label>
        </div>

        <button type="submit">Отправить</button>
    </form>
    <a href="view.php">📋 Посмотреть все сообщения (сортировка по областям)</
</body>
</html>