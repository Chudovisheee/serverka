<?php
namespace LiteraryClub\Controllers;

use LiteraryClub\View\View;

require_once __DIR__ . '/../../MathParser.php';

class CartController
{
    private $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../public');
    }
    
    public function index()
    {
        $total = $_GET['total'] ?? null;
        $this->view->renderHtml('cart/index.php', [
            'total' => $total,
            'title' => 'Корзина'
        ]);
    }
    
    public function calculate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $expression = $_POST['expression'] ?? '0';
            try {
                $parser = new \MathParser();
                $result = $parser->evaluate($expression);
                header('Location: /php/kyrsach_literary_club/public/index.php?route=cart&total=' . urlencode($result));
            } catch (\Exception $e) {
                header('Location: /php/kyrsach_literary_club/public/index.php?route=cart&error=' . urlencode($e->getMessage()));
            }
            exit;
        }
        header('Location: /php/kyrsach_literary_club/public/index.php?route=cart');
    }
}