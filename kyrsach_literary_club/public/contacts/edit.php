<?php
$basePath = '/php/kyrsach_literary_club/public';
$id = $_GET['id'] ?? 0;

$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = $_POST['surname'] ?? '';
    $name = $_POST['name'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $comment = $_POST['comment'] ?? '';
    
    $stmt = $pdo->prepare("UPDATE contacts SET surname=?, name=?, lastname=?, gender=?, birth_date=?, phone=?, address=?, email=?, comment=? WHERE id=?");
    $stmt->execute([$surname, $name, $lastname, $gender, $birth_date, $phone, $address, $email, $comment, $id]);
    $success = true;
    $message = 'Участник обновлён!';
    
    // Обновим данные для отображения
    $contact = ['surname' => $surname, 'name' => $name, 'lastname' => $lastname, 'gender' => $gender, 'birth_date' => $birth_date, 'phone' => $phone, 'address' => $address, 'email' => $email, 'comment' => $comment];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать участника</title>
    <link rel="stylesheet" href="<?= $basePath ?>/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
    <div class="logo"><i class="fas fa-book-open"></i> Три точки</div>
    <nav>
        <a href="<?= $basePath ?>/main.php">Главная</a>
        <a href="<?= $basePath ?>/books_direct.php">Книги</a>
        <a href="<?= $basePath ?>/contacts/index.php">Участники</a>
    </nav>
</header>
<main>

<h1>✏️ Редактировать участника</h1>

<?php if ($message): ?>
    <div class="<?= $success ? 'success' : 'error' ?>"><?= $message ?></div>
<?php endif; ?>

<?php if (!$contact): ?>
    <p>Участник не найден</p>
    <a href="<?= $basePath ?>/contacts/index.php">← Вернуться</a>
<?php else: ?>
    <form method="POST">
        <div class="form-group"><label>Фамилия *</label><input type="text" name="surname" value="<?= htmlspecialchars($contact['surname']) ?>" required></div>
        <div class="form-group"><label>Имя *</label><input type="text" name="name" value="<?= htmlspecialchars($contact['name']) ?>" required></div>
        <div class="form-group"><label>Отчество</label><input type="text" name="lastname" value="<?= htmlspecialchars($contact['lastname']) ?>"></div>
        <div class="form-group">
            <label>Пол</label>
            <select name="gender">
                <option value="мужской" <?= $contact['gender'] == 'мужской' ? 'selected' : '' ?>>мужской</option>
                <option value="женский" <?= $contact['gender'] == 'женский' ? 'selected' : '' ?>>женский</option>
            </select>
        </div>
        <div class="form-group"><label>Дата рождения *</label><input type="date" name="birth_date" value="<?= $contact['birth_date'] ?>" required></div>
        <div class="form-group"><label>Телефон</label><input type="text" name="phone" value="<?= htmlspecialchars($contact['phone']) ?>"></div>
        <div class="form-group"><label>Адрес</label><input type="text" name="address" value="<?= htmlspecialchars($contact['address']) ?>"></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>"></div>
        <div class="form-group"><label>Комментарий</label><textarea name="comment" rows="3"><?= htmlspecialchars($contact['comment']) ?></textarea></div>
        <button type="submit" class="btn-save">💾 Сохранить</button>
        <a href="<?= $basePath ?>/contacts/index.php" class="btn-cancel">Отмена</a>
    </form>
<?php endif; ?>

</main>
<footer>
    <p>Литературный клуб "Три точки"</p>
</footer>
</body>
</html>