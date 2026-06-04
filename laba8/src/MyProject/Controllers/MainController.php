<?php

namespace MyProject\Controllers;

use MyProject\View\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../www');
    }

    public function main()
    {
        $articles = [
            ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
            ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        ];
        $this->view->renderHtml('main.php', [
            'articles' => $articles,
            'title' => 'Мой блог'
        ]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('hello.php', [
            'name' => $name,
            'title' => 'Страница приветствия'
        ]);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('bye.php', [
            'name' => $name
            // title не передан — будет "Мой блог"
        ]);
    }
}