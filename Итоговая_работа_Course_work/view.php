<?php
require_once 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1;


$sql = "
    SELECT 
        m.id,
        m.description,
        m.created_at,
        m.save,
        h.name AS hashtag_name,
        c.name AS channel_name,
        c.like AS channel_like,
        f.name AS field_name
    FROM messages m
    JOIN hashtags h ON m.hashtag_id = h.id
    JOIN channels c ON m.channel_id = c.id
    JOIN hashtag_field hf ON h.id = hf.hashtag_id
    JOIN fields f ON hf.field_id = f.id
    WHERE 
        (c.like = 1) 
        OR (c.like = 0 AND m.save = 0)
        OR (m.user_id = $user_id)
    ORDER BY f.name, m.created_at DESC
";

$result = $conn->query($sql);

// Группировка по областям знаний
$grouped = [];
while ($row = $result->fetch_assoc()) {
    $field = $row['field_name'];
    if (!isset($grouped[$field])) {
        $grouped[$field] = [];
    }
    $grouped[$field][] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>#сортер - Все сообщения</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .field-block { margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; border-radius: 8px; }
        .field-title { font-size: 24px; font-weight: bold; margin-bottom: 15px; color: #007bff; }
        .message { margin-bottom: 12px; padding: 10px; background: #f9f9f9; border-left: 4px solid #28a745; }
        .meta { font-size: 12px; color: #666; margin-bottom: 5px; }
        .private-badge { background: #ffc107; color: #000; padding: 2px 6px; font-size: 11px; border-radius: 4px; }
        .channel-badge { background: #17a2b8; color: white; padding: 2px 6px; font-size: 11px; border-radius: 4px; }
        .add-link { display: inline-block; margin-bottom: 20px; padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <a href="index.php" class="add-link">➕ Добавить новое сообщение</a>
    
    <h1>📂 Сообщения по областям знаний</h1>
    
    <?php if (empty($grouped)): ?>
        <p>Пока нет сообщений.</p>
    <?php else: ?>
        <?php foreach ($grouped as $fieldName => $messages): ?>
            <div class="field-block">
                <div class="field-title">📖 <?= htmlspecialchars($fieldName) ?></div>
                <?php foreach ($messages as $msg): ?>
                    <div class="message">
                        <div class="meta">
                            <span class="channel-badge">📢 <?= htmlspecialchars($msg['channel_name']) ?></span>
                            &nbsp;|&nbsp;
                            <span>🏷️ #<?= htmlspecialchars($msg['hashtag_name']) ?></span>
                            &nbsp;|&nbsp;
                            <span>🕒 <?= $msg['created_at'] ?></span>
                            <?php if ($msg['save']): ?>
                                &nbsp;|&nbsp;<span class="private-badge">🔒 Личное (видите только вы)</span>
                            <?php endif; ?>
                        </div>
                        <div><?= nl2br(htmlspecialchars($msg['description'])) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>