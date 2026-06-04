<?php
$title = 'Редактирование профиля';
include __DIR__ . '/../page_start.php';
?>

<h1><i class="fas fa-user-edit"></i> Редактирование профиля</h1>

<?php if (isset($_GET['success'])): ?>
    <div class="success"><i class="fas fa-check-circle"></i> Профиль успешно обновлен!</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="profile-form">
    <div class="avatar-section">
        <img src="<?= $basePath ?>/uploads/<?= $user->getAvatar() ?>" 
             onerror="this.src='<?= $basePath ?>/images/default-avatar.png'" 
             class="profile-avatar">
        <div class="form-group">
            <label><i class="fas fa-camera"></i> Сменить аватар</label>
            <input type="file" name="avatar" accept="image/*">
        </div>
    </div>
    
    <div class="form-group">
        <label><i class="fas fa-user"></i> Никнейм</label>
        <input type="text" name="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>" required>
    </div>
    
    <div class="form-group">
        <label><i class="fas fa-envelope"></i> Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
    </div>
    
    <div class="form-group">
        <label><i class="fas fa-pen"></i> О себе</label>
        <textarea name="bio" rows="5"><?= htmlspecialchars($user->getBio()) ?></textarea>
    </div>
    
    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Сохранить изменения</button>
</form>

<?php include __DIR__ . '/../page_end.php'; ?>