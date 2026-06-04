<?php
$host = 'localhost';
$dbname = 'literary_club';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    echo "✅ Подключение к БД успешно!<br>";
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM books");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📚 Количество книг в БД: " . $result['count'] . "<br>";
    
    $stmt = $pdo->query("SELECT * FROM books");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<pre>";
    print_r($books);
    echo "</pre>";
    
} catch (PDOException $e) {
    echo "❌ Ошибка: " . $e->getMessage();
}
?>