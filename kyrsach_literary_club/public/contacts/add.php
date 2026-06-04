<?php
$basePath = '/php/kyrsach_literary_club/public';

$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    
    $surname = $_POST['surname'] ?? '';
    $name = $_POST['name'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $comment = $_POST['comment'] ?? '';
    
    if (empty($surname) || empty($name) || empty($birth_date)) {
        $message = 'Заполните обязательные поля';
    } else {
        $stmt = $pdo->prepare("INSERT INTO contacts (surname, name, lastname, gender, birth_date, phone, address, email, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$surname, $name, $lastname, $gender, $birth_date, $phone, $address, $email, $comment]);
        $success = true;
        $message = 'Участник добавлен!';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить участника</title>
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

<h1>➕ Добавить участника</h1>

<?php if ($message): ?>
    <div class="<?= $success ? 'success' : 'error' ?>"><?= $message ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <p><a href="<?= $basePath ?>/contacts/index.php">← Вернуться к списку</a></p>
<?php else: ?>
    <form method="POST">
        <div class="form-group"><label>Фамилия *</label><input type="text" name="surname" required></div>
        <div class="form-group"><label>Имя *</label><input type="text" name="name" required></div>
        <div class="form-group"><label>Отчество</label><input type="text" name="lastname"></div>
        <div class="form-group">
            <label>Пол</label>
            <select name="gender">
                <option value="мужской">мужской</option>
                <option value="женский">женский</option>
            </select>
        </div>
        <div class="form-group"><label>Дата рождения *</label><input type="date" name="birth_date" required></div>
        <div class="form-group"><label>Телефон</label><input type="text" name="phone"></div>
        <div class="form-group"><label>Адрес</label><input type="text" name="address"></div>
        <div class="form-group"><label>Email</label><input type="email" name="email"></div>
        <div class="form-group"><label>Комментарий</label><textarea name="comment" rows="3"></textarea></div>
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