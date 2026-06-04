<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticlesController
{
    private $view;
    private $basePath;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../www');
        $this->basePath = '/php/laba10/www';
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'basePath' => $this->basePath
        ]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article->setName($_POST['name'] ?? '');
            $article->setText($_POST['text'] ?? '');
            $article->save();

            header('Location: ' . $this->basePath . '/articles/' . $article->getId());
            return;
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article,
            'basePath' => $this->basePath
        ]);
    }

    public function add(): void
    {
        $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');
        $article->save();

        var_dump($article);
    }
}