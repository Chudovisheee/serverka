<?php
$root = $_SERVER['DOCUMENT_ROOT'];
echo "DOCUMENT_ROOT = " . $root . "<br>";
$file = $root . '/php/Task/expression.txt';
echo "Проверяем файл: " . $file . "<br>";
if (file_exists($file)) {
    echo "Файл существует. Содержимое: " . file_get_contents($file);
} else {
    echo "Файл НЕ НАЙДЕН!<br>";
    // Попробуем альтернативный путь
    $alt = __DIR__ . '/../Task/expression.txt';
    echo "Проверяем альтернативный путь: " . $alt . "<br>";
    if (file_exists($alt)) {
        echo "Найден! Содержимое: " . file_get_contents($alt);
    } else {
        echo "Не найден и там.";
    }
}
?>