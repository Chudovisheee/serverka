<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уравнения</title>
    <link rel="stylesheet" href="laba1.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <div class="logo-placeholder">
                <img src="images/logo.png" alt="МосПолитех">
            </div>
        </div>
        <div class="work-title">
            3 Лаба - Лепорская Диана
        </div>
        <div style="width: 100px;"></div>
    </div>
    <div class="main">
            <?php

            function computeExpression($expr) {
                $operators = ['+', '-', '*', '/'];
                $opPos = -1;
                $operator = null;
                
                foreach ($operators as $op) {
                    $pos = strpos($expr, $op);
                    if ($pos !== false && $pos > 0) {
                        $opPos = $pos;
                        $operator = $op;
                        break;
                    }
                }
                
                if ($operator === null) {
                    return is_numeric($expr) ? (float)$expr : false;
                }
                
                $left = substr($expr, 0, $opPos);
                $right = substr($expr, $opPos + 1);
                
                if (!is_numeric($left) || !is_numeric($right)) {
                    return false;
                }
                
                $a = (float)$left;
                $b = (float)$right;
                
                switch ($operator) {
                    case '+': return $a + $b;
                    case '-': return $a - $b;
                    case '*': return $a * $b;
                    case '/': 
                        if ($b == 0) return false;
                        return $a / $b;
                    default: return false;
                }
            }

            function solveEquation($equation) {
                $equation = str_replace(' ', '', $equation);
                
                $parts = explode('=', $equation);
                if (count($parts) != 2) {
                    return "Ошибка: уравнение должно содержать один знак '='";
                }
                $left = $parts[0];
                $right = $parts[1];
                
                if (stripos($left, 'X') === false && stripos($right, 'X') !== false) {
                    $temp = $left;
                    $left = $right;
                    $right = $temp;
                }
                
                $rightVal = computeExpression($right);
                if ($rightVal === false) {
                    return "Ошибка: правая часть должна быть числом или простым выражением (например, 4+3)";
                }
                
                $operators = ['+', '-', '*', '/'];
                $opPos = -1;
                $operator = null;
                foreach ($operators as $op) {
                    $pos = strpos($left, $op);
                    if ($pos !== false) {
                        $opPos = $pos;
                        $operator = $op;
                        break;
                    }
                }
                
                if ($operator !== null) {
                    $leftPart = substr($left, 0, $opPos);
                    $rightPart = substr($left, $opPos + 1);
                    
                    $hasXLeft = stripos($leftPart, 'X') !== false;
                    $hasXRight = stripos($rightPart, 'X') !== false;
                    
                    if ($hasXLeft && $hasXRight) {
                        return "Ошибка: X не может быть одновременно слева и справа от оператора";
                    }
                    if (!$hasXLeft && !$hasXRight) {
                        return "Ошибка: в левой части уравнения отсутствует X";
                    }
                    
                    $num1 = $hasXLeft ? null : (float)$leftPart;
                    $num2 = $hasXRight ? null : (float)$rightPart;
                    
                    if ($hasXLeft) {
                        switch ($operator) {
                            case '+': $x = $rightVal - $num2; break;
                            case '-': $x = $rightVal + $num2; break;
                            case '*': $x = $rightVal / $num2; break;
                            case '/': 
                                if ($num2 == 0) return "Ошибка: деление на ноль";
                                $x = $rightVal * $num2; 
                                break;
                            default: return "Ошибка: неизвестный оператор";
                        }
                    } else {
                        switch ($operator) {
                            case '+': $x = $rightVal - $num1; break;
                            case '-': $x = $num1 - $rightVal; break;
                            case '*': $x = $rightVal / $num1; break;
                            case '/': 
                                if ($rightVal == 0) return "Ошибка: деление на ноль";
                                $x = $num1 / $rightVal; 
                                break;
                            default: return "Ошибка: неизвестный оператор";
                        }
                    }
                    return $x;
                } else {
                    if (strcasecmp($left, 'X') == 0) {
                        return $rightVal;
                    }
                    if (strcasecmp($right, 'X') == 0) {
                        if (!is_numeric($left)) {
                            return "Ошибка: левая часть должна быть числом";
                        }
                        return (float)$left;
                    }
                    return "Ошибка: неверный формат уравнения (X не найден)";
                }
            }

            $tests = [
                "X + 3 = 7",
            ];

            foreach ($tests as $test) {
                $res = solveEquation($test);
                echo "$test -> ";
                if (is_numeric($res)) echo "X = $res\n";
                else echo "$res\n";
                echo "\n";
            }
            ?>
    <img src='images/shema.png'>
    </div>
    <div class="footer">
        Задание для самостоятельной работы
    </div>

</body>
</html>
