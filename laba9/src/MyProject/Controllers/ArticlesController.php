<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;

class ArticlesController
{
    /** @var View */
    private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../www');
        $this->db = new Db();
    }

    public function view(int $articleId)
    {
        $result = $this->db->query(
            'SELECT * FROM `articles` WHERE id = :id;',
            [':id' => $articleId],
            Article::class
        );

        if ($result === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article = $result[0];
        
        // Получаем автора статьи
        $authorResult = $this->db->query(
        'SELECT * FROM `users` WHERE id = :id;',
        [':id' => $article->getAuthorId()]
        // можно не указывать класс — будет stdClass, но это ок
        );

        $author = $authorResult[0] ?? null;
        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'author' => $author
        ]);
    }
}