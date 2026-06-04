<?php
require_once __DIR__ . '/../src/LiteraryClub/Services/Db.php';
require_once __DIR__ . '/../src/LiteraryClub/Models/ActiveRecordEntity.php';
require_once __DIR__ . '/../src/LiteraryClub/Models/Book.php';

use LiteraryClub\Models\Book;

$books = Book::findAll();
console.log($books);
echo "<pre>";
var_dump($books);
echo "</pre>";