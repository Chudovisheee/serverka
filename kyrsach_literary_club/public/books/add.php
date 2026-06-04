<?php
$title = 'Добавление книги';
include __DIR__ . '/../page_start.php';
?>

<h1>➕ Добавление новой книги</h1>

<form method="POST" enctype="multipart/form-data" class="edit-form">
    <div class="form-group">
        <label>📖 Название книги *</label>
        <input type="text" name="name" required>
    </div>
    
    <div class="form-group">
        <label>✍️ ID автора *</label>
        <input type="number" name="author_id" value="1" required>
    </div>
    
    <div class="form-group">
        <label>💰 Цена (₽)</label>
        <input type="number" step="0.01" name="price" value="0">
    </div>
    
    <div class="form-group">
        <label>🖼️ Обложка</label>
        <input type="file" name="cover" accept="image/*">
    </div>
    
    <div class="form-group">
        <label>📝 Описание *</label>
        <textarea name="text" rows="10" required></textarea>
    </div>
    
    <button type="submit" class="btn-save">💾 Добавить книгу</button>
    <a href="<?= $basePath ?>" class="btn-cancel">❌ Отмена</a>
</form>

<?php include __DIR__ . '/../page_end.php'; ?>