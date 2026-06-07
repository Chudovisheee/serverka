<?php
require_once 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$channel_id = (int)$_POST['channel_id'];
$hashtag_id = (int)$_POST['hashtag_id'];
$field_input = $_POST['field_id'];
$new_field_name = trim($_POST['new_field_name']);
$description = trim($_POST['description']);
$save_flag = isset($_POST['save_flag']) ? 1 : 0;

if ($channel_id <= 0 || $hashtag_id <= 0 || empty($description)) {
    die("Ошибка: заполните все обязательные поля.");
}

$check = $conn->query("SELECT id FROM channels WHERE id = $channel_id");
if ($check->num_rows == 0) die("Ошибка: канал не существует.");
$check = $conn->query("SELECT id FROM hashtags WHERE id = $hashtag_id");
if ($check->num_rows == 0) die("Ошибка: хэштег не существует.");

if ($field_input === 'new' && !empty($new_field_name)) {
    $stmt = $conn->prepare("INSERT INTO fields (name) VALUES (?)");
    $stmt->bind_param("s", $new_field_name);
    $stmt->execute();
    $field_id = $stmt->insert_id;
    $stmt->close();
    
    $conn->query("INSERT IGNORE INTO hashtag_field (hashtag_id, field_id) VALUES ($hashtag_id, $field_id)");
} elseif (is_numeric($field_input) && $field_input > 0) {
    $field_id = (int)$field_input;
    $conn->query("INSERT IGNORE INTO hashtag_field (hashtag_id, field_id) VALUES ($hashtag_id, $field_id)");
}

$stmt = $conn->prepare("INSERT INTO messages (hashtag_id, user_id, channel_id, description, `save`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiisi", $hashtag_id, $user_id, $channel_id, $description, $save_flag);

if ($stmt->execute()) {
    echo "✅ Сообщение добавлено! <a href='index.php'>Вернуться</a>";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>