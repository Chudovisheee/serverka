<?php
// Обработка POST запроса
$result = null;
$error = null;
$expression = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    
    // Заменяем символы для математических операций
    $expressionForCheck = str_replace(['×', '÷', 'π', 'e', '√', 'ln', 'log', 'fact'], ['*', '/', '3.14159', '2.71828', 'sqrt', 'ln', 'log', 'fact'], $expression);
    
    // Проверка на валидные символы
    if (!preg_match('/^[0-9+\-*\/\^().%sqrtlnlogfact\s]+$/i', $expressionForCheck)) {
        $error = 'Выражение содержит недопустимые символы';
    } else {
        // Заменяем символы для вычислений
        $expression = str_replace(['×', '÷'], ['*', '/'], $expression);
        
        try {
            require_once 'laba4_pars.php';
            $parser = new MathParser();
            $result = $parser->evaluate($expression);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    
    // Если есть результат - редирект с GET параметром
    if ($result !== null) {
        header('Location: laba4.php?result=' . urlencode($result) . '&expression=' . urlencode($expression));
        exit;
    }
}

// Получаем результат из GET параметра
$displayValue = '';
if (isset($_GET['result'])) {
    $displayValue = $_GET['result'];
    $expression = $_GET['expression'] ?? '';
} elseif (isset($_GET['expression'])) {
    $expression = $_GET['expression'];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор с бонусными функциями</title>
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
                <button type="button" class="btn fn" data-fn="sqrt">√</button>
                <button type="button" class="btn fn" data-fn="ln">ln</button>
                <button type="button" class="btn fn" data-fn="log">log</button>
                <button type="button" class="btn fn" data-fn="fact">n!</button>
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
                <button type="button" class="btn fn" data-fn="pow2">x²</button>
                <button type="button" class="btn fn" data-fn="pow3">x³</button>
                <button type="button" class="btn fn" data-fn="powx">xʸ</button>
            </div>
            <div class="row">
                <button type="button" class="btn num" data-char="1">1</button>
                <button type="button" class="btn num" data-char="2">2</button>
                <button type="button" class="btn num" data-char="3">3</button>
                <button type="button" class="btn" data-char=".">.</button>
                <button type="button" class="btn fn" data-fn="neg">±</button>
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