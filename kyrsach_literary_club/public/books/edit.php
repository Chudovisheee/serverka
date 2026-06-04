<?php
$title = 'Редактирование книги';
include __DIR__ . '/../page_start.php';
?>

<h1>✏️ Редактирование книги</h1>

<form method="POST" enctype="multipart/form-data" class="edit-form">
    <div class="form-group">
        <label>📖 Название книги</label>
        <input type="text" name="name" value="<?= htmlspecialchars($book->getName()) ?>" required>
    </div>
    
    <div class="form-group">
        <label>✍️ Автор (ID)</label>
        <input type="number" name="author_id" value="<?= $book->getAuthorId() ?>" required>
    </div>
    
    <div class="form-group">
        <label>💰 Цена (₽)</label>
        <input type="number" step="0.01" name="price" value="<?= $book->getPrice() ?>">
    </div>
    
    <div class="form-group">
        <label>🖼️ Обложка</label>
        <input type="file" name="cover" accept="image/*">
        <?php if ($book->getCover() != 'default-cover.jpg'): ?>
            <p>Текущая: <img src="<?= $basePath ?>/uploads/<?= $book->getCover() ?>" width="50"></p>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label>📝 Описание</label>
        <textarea name="text" rows="10" required><?= htmlspecialchars($book->getText()) ?></textarea>
    </div>
    
    <button type="submit" class="btn-save">💾 Сохранить</button>
    <a href="<?= $basePath ?>/books/<?= $book->getId() ?>" class="btn-cancel">❌ Отмена</a>
</form>

<?php include __DIR__ . '/../page_end.php'; ?>