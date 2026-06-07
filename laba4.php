<?php
require_once __DIR__ . '/trig_functions.php';
require_once __DIR__ . '/laba4_pars.php';

function getExpressionFromFile(): string {
    $root = $_SERVER['DOCUMENT_ROOT'];
    $filePath = $root . '/php/Task/expression.txt';
    if (file_exists($filePath)) {
        return trim(file_get_contents($filePath));
    }
    return '';
}

$result = null;
$error = null;
$expression = '';

// 1. Если это POST-запрос — вычисляем и делаем редирект
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    
    // Подготовка и проверка
    $expressionForCheck = str_replace(['×', '÷', 'π', 'e', '√', 'ln', 'log', 'fact', 'sin', 'cos', 'tan', 'cot'],
                                       ['*', '/', '3.1415926535', '2.718281828', 'sqrt', 'ln', 'log', 'fact', 'sin', 'cos', 'tan', 'cot'],
                                       $expression);
    
    if (!preg_match('/^[0-9+\-*\/\^().%sqrtlnlogfactsincostan\s]+$/i', $expressionForCheck)) {
        $error = 'Выражение содержит недопустимые символы';
    } else {
        $expression = str_replace(['×', '÷'], ['*', '/'], $expression);
        try {
            $parser = new MathParser();
            $result = $parser->evaluate($expression);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    
    if ($result !== null) {
        header('Location: laba4.php?result=' . urlencode($result) . '&expression=' . urlencode($expression));
        exit;
    } else {
        $displayValue = '';
        $expression = '';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['result'])) {
        $displayValue = $_GET['result'];
        $expression = $_GET['expression'] ?? '';
    } elseif (isset($_GET['expression'])) {
        $expression = $_GET['expression'];
        $displayValue = '';
    } else {
        $expression = getExpressionFromFile();
        $displayValue = '';
    }
} else {
    $displayValue = '';
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор с тригонометрией</title>
    <link rel="stylesheet" href="laba4.css">
</head>
<body>
    <div class="calculator">
        <div class="display">
            <form method="POST" id="calculatorForm" action="laba4.php">
                <input type="text" name="expression" id="display" value="<?php echo htmlspecialchars($displayValue ?: $expression); ?>" readonly>
                <input type="hidden" name="submitted" value="1">
            </form>
        </div>
        
        <div class="buttons">
            <div class="row">
                <button type="button" class="btn memory" data-value="pi">π</button>
                <button type="button" class="btn memory" data-value="e">e</button>
                <button type="button" class="btn fn" data-fn="sin">sin</button>
                <button type="button" class="btn fn" data-fn="cos">cos</button>
                <button type="button" class="btn fn" data-fn="tan">tan</button>
                <button type="button" class="btn fn" data-fn="cot">cot</button>
            </div>
            <div class="row">
                <button type="button" class="btn" data-char="(">(</button>
                <button type="button" class="btn" data-char=")">)</button>
                <button type="button" class="btn" data-char="^">^</button>
                <button type="button" class="btn op" data-char="/">÷</button>
                <button type="button" class="btn op" data-char="*">×</button>
                <button type="button" class="btn clear" id="clear">C</button>
            </div>
            <div class="row">
                <button type="button" class="btn num" data-char="7">7</button>
                <button type="button" class="btn num" data-char="8">8</button>
                <button type="button" class="btn num" data-char="9">9</button>
                <button type="button" class="btn op" data-char="-">-</button>
                <button type="button" class="btn op" data-char="+">+</button>
                <button type="button" class="btn equals" id="equals">=</button>
            </div>
            <div class="row">
                <button type="button" class="btn num" data-char="4">4</button>
                <button type="button" class="btn num" data-char="5">5</button>
                <button type="button" class="btn num" data-char="6">6</button>
                <button type="button" class="btn fn" data-fn="sqrt">√</button>
                <button type="button" class="btn fn" data-fn="ln">ln</button>
                <button type="button" class="btn fn" data-fn="log">log</button>
            </div>
            <div class="row">
                <button type="button" class="btn num" data-char="1">1</button>
                <button type="button" class="btn num" data-char="2">2</button>
                <button type="button" class="btn num" data-char="3">3</button>
                <button type="button" class="btn" data-char=".">.</button>
                <button type="button" class="btn fn" data-fn="fact">n!</button>
                <button type="button" class="btn backspace" id="backspace">⌫</button>
            </div>
            <div class="row">
                <button type="button" class="btn zero num" data-char="0">0</button>
            </div>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error">Ошибка: <?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
    </div>

    <script src="laba4.js"></script>
</body>
</html>