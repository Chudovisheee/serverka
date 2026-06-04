<?php
require_once __DIR__ . '/../../src/MathParser.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expression = $_POST['expression'] ?? '0';
    try {
        $parser = new MathParser();
        $result = $parser->evaluate($expression);
        header('Location: /kyrsach_literary_club/public/cart?total=' . urlencode($result));
    } catch (Exception $e) {
        header('Location: /kyrsach_literary_club/public/cart?error=' . urlencode($e->getMessage()));
    }
    exit;
}

header('Location: /kyrsach_literary_club/public/cart');