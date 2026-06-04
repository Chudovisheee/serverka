<?php
$title = 'Обратная связь';
include __DIR__ . '/page_start.php';
?>

<div class="feedback-form">
    <h2><i class="fas fa-envelope"></i> Написать нам</h2>
    <form action="https://httpbin.org/post" method="POST" target="_blank">
        <div class="form-group">
            <label><i class="fas fa-user"></i> Ваше имя *</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label><i class="fas fa-envelope"></i> Email *</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label><i class="fas fa-tag"></i> Тип обращения</label>
            <select name="type">
                <option value="question">❓ Вопрос</option>
                <option value="suggestion">💡 Предложение</option>
                <option value="complaint">⚠️ Жалоба</option>
                <option value="thanks">❤️ Благодарность</option>
            </select>
        </div>
        <div class="form-group">
            <label><i class="fas fa-comment"></i> Текст сообщения *</label>
            <textarea name="message" rows="5" required></textarea>
        </div>
        <div class="form-group checkbox-group">
            <label><i class="fas fa-reply-all"></i> Хочу получить ответ:</label>
            <label><input type="checkbox" name="response[]" value="email"> <i class="fas fa-envelope"></i> На email</label>
            <label><input type="checkbox" name="response[]" value="sms"> <i class="fas fa-phone"></i> По SMS</label>
        </div>
        <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Отправить</button>
    </form>
</div>

<?php include __DIR__ . '/page_end.php'; ?>