<?php
namespace LiteraryClub\Controllers;

use LiteraryClub\Models\Book;
use LiteraryClub\Models\User;
use LiteraryClub\View\View;

class BooksController
{
    private $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../public');
    }
    
    public function view(int $id)
    {
        $book = Book::getById($id);
        if (!$book) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        $this->view->renderHtml('books/view.php', [
            'book' => $book,
            'title' => $book->getName()
        ]);
    }
    
    public function edit(int $bookId)
    {
        session_start();
        if (($_SESSION['role'] ?? 'user') !== 'admin') {
            header('Location: /kyrsach_literary_club/public/books/' . $bookId);
            return;
        }
        
        $book = Book::getById($bookId);
        if ($book === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book->setName($_POST['name'] ?? '');
            $book->setText($_POST['text'] ?? '');
            $book->setPrice((float)($_POST['price'] ?? 0));
            $book->setAuthorId((int)($_POST['author_id'] ?? 1));
            
            if (!empty($_FILES['cover']['name'])) {
                $uploadDir = __DIR__ . '/../../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $fileName = time() . '_' . basename($_FILES['cover']['name']);
                move_uploaded_file($_FILES['cover']['tmp_name'], $uploadDir . $fileName);
                $book->setCover($fileName);
            }
            
            $book->save();
            header('Location: /kyrsach_literary_club/public/books/' . $book->getId());
            return;
        }
        
        $this->view->renderHtml('books/edit.php', [
            'book' => $book,
            'title' => 'Редактирование книги'
        ]);
    }
    
    public function add()
    {
        session_start();
        if (($_SESSION['role'] ?? 'user') !== 'admin') {
            header('Location: /kyrsach_literary_club/public/');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = new Book();
            $book->setName($_POST['name'] ?? '');
            $book->setText($_POST['text'] ?? '');
            $book->setPrice((float)($_POST['price'] ?? 0));
            $book->setAuthorId((int)($_POST['author_id'] ?? 1));
            $book->save();
            header('Location: /kyrsach_literary_club/public/books/' . $book->getId());
            return;
        }
        
        $this->view->renderHtml('books/add.php', ['title' => 'Добавление книги']);
    }
    
    public function delete(int $bookId)
    {
        session_start();
        if (($_SESSION['role'] ?? 'user') !== 'admin') {
            header('Location: /kyrsach_literary_club/public/books/' . $bookId);
            return;
        }
        
        $book = Book::getById($bookId);
        if ($book) {
            $book->delete();
        }
        header('Location: /kyrsach_literary_club/public/');
    }
}