<?php
namespace LiteraryClub\Controllers;

use LiteraryClub\View\View;

class MainController
{
    private $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../public');
    }
    
    public function main()
    {
        date_default_timezone_set('Europe/Moscow');
        $hour = date('H');
        if ($hour < 12) $greeting = "🌅 Доброе утро!";
        elseif ($hour < 18) $greeting = "☀️ Добрый день!";
        else $greeting = "🌙 Добрый вечер!";
        $currentTime = date("H:i:s d.m.Y");
        
        $this->view->renderHtml('main.php', [
            'greeting' => $greeting,
            'currentTime' => $currentTime,
            'title' => 'Главная - Три точки'
        ]);
    }
    
    public function sayHello(string $name)
    {
        $this->view->renderHtml('hello.php', ['name' => $name, 'title' => 'Приветствие']);
    }
    
    public function sayBye(string $name)
    {
        $this->view->renderHtml('bye.php', ['name' => $name, 'title' => 'До свидания']);
    }
    
    public function stats()
    {
        function solveEquation($equation) {
            $parts = explode('=', str_replace(' ', '', $equation));
            if (count($parts) != 2) return null;
            $left = $parts[0];
            $right = (float)$parts[1];
            if (strpos($left, 'X') !== false) {
                $operators = ['+', '-', '*', '/'];
                foreach ($operators as $op) {
                    $pos = strpos($left, $op);
                    if ($pos !== false) {
                        $num = (float)substr($left, $pos + 1);
                        switch ($op) {
                            case '+': return $right - $num;
                            case '-': return $right + $num;
                            case '*': return $right / $num;
                            case '/': return $right * $num;
                        }
                    }
                }
                return $right;
            }
            return null;
        }
        
        $stats = [
            'avg_rating' => solveEquation("X + 0.5 = 4.5") ?? 4.0,
            'total_books' => solveEquation("X - 5 = 15") ?? 20,
            'active_members' => solveEquation("X / 2 = 25") ?? 50
        ];
        
        $this->view->renderHtml('stats.php', ['stats' => $stats, 'title' => 'Статистика клуба']);
    }
    
    public function feedback()
    {
        $this->view->renderHtml('feedback.php', ['title' => 'Обратная связь']);
    }
}