<?php
$basePath = '/php/kyrsach_literary_club/public';

$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY id DESC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Участники клуба</title>
    <link rel="stylesheet" href="<?= $basePath ?>/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="<?= $basePath ?>/images/logo.png" alt="Лого" height="50">
        Три точки
    </div>
    <nav>
        <a href="<?= $basePath ?>/"><i class="fas fa-home"></i> Главная</a>
        <a href="<?= $basePath ?>/books_direct.php"><i class="fas fa-book"></i> Книги</a>
        <a href="<?= $basePath ?>/contacts"><i class="fas fa-address-book"></i> Участники</a>
        <a href="<?= $basePath ?>/profile/edit"><i class="fas fa-user"></i> Профиль</a>
        <a href="<?= $basePath ?>/stats"><i class="fas fa-chart-line"></i> Статистика</a>
        <a href="<?= $basePath ?>/feedback"><i class="fas fa-envelope"></i> Обратная связь</a>
        <a href="<?= $basePath ?>/cart"><i class="fas fa-shopping-cart"></i> Корзина</a>
        <a href="<?= $basePath ?>/hello/Друг"><i class="fas fa-hand-peace"></i> Привет</a>
        <a href="<?= $basePath ?>/bye/Друг"><i class="fas fa-waveform"></i> Пока</a>
    </nav>
</header>
<main>

<h1><i class="fas fa-address-book"></i> Участники книжного клуба</h1>

<p><a href="<?= $basePath ?>/contacts/add.php" class="btn-add">➕ Добавить участника</a></p>

<table class="contacts-table">
    <thead>
        <tr>
            <th>ID</th><th>Фамилия</th><th>Имя</th><th>Пол</th><th>Дата рождения</th><th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($contacts)): ?>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= $contact['id'] ?></td>
                    <td><?= htmlspecialchars($contact['surname']) ?></td>
                    <td><?= htmlspecialchars($contact['name']) ?></td>
                    <td><?= $contact['gender'] ?></td>
                    <td><?= $contact['birth_date'] ?></td>
                    <td>
                        <a href="<?= $basePath ?>/contacts/edit.php?id=<?= $contact['id'] ?>">✏️</a>
                        <a href="<?= $basePath ?>/contacts/delete.php?id=<?= $contact['id'] ?>" onclick="return confirm('Удалить?')">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Нет участников</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</main>
<footer>
    <p>Литературный клуб "Три точки"</p>
</footer>
</body>
</html>