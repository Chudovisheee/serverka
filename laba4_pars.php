<?php
class MathParser {
    private $expression;
    private $position;
    private $constants = [
        'π' => M_PI,
        'pi' => M_PI,
        'e' => M_E
    ];
    
    public function evaluate($expression) {
        // Заменяем константы
        foreach ($this->constants as $const => $value) {
            $expression = str_replace($const, (string)$value, $expression);
        }
        
        // Заменяем символы функций
        $expression = str_replace('√', 'sqrt', $expression);
        
        $this->expression = str_replace(' ', '', $expression);
        $this->position = 0;
        
        $result = $this->parseExpression();
        
        if ($this->position < strlen($this->expression)) {
            throw new Exception('Неожиданный символ: ' . $this->expression[$this->position]);
        }
        
        return $result;
    }
    
    private function parseExpression() {
        $value = $this->parseTerm();
        
        while ($this->position < strlen($this->expression)) {
            $char = $this->expression[$this->position];
            
            if ($char == '+') {
                $this->position++;
                $value += $this->parseTerm();
            } elseif ($char == '-') {
                $this->position++;
                $value -= $this->parseTerm();
            } else {
                break;
            }
        }
        
        return $value;
    }
    
    private function parseTerm() {
        $value = $this->parseFactor();
        
        while ($this->position < strlen($this->expression)) {
            $char = $this->expression[$this->position];
            
            if ($char == '*') {
                $this->position++;
                $value *= $this->parseFactor();
            } elseif ($char == '/') {
                $this->position++;
                $divisor = $this->parseFactor();
                if ($divisor == 0) {
                    throw new Exception('Деление на ноль');
                }
                $value /= $divisor;
            } else {
                break;
            }
        }
        
        return $value;
    }
    
    private function parseFactor() {
        if ($this->position >= strlen($this->expression)) {
            throw new Exception('Неожиданный конец выражения');
        }
        
        $char = $this->expression[$this->position];
        
        // Отрицательные числа
        if ($char == '-') {
            $this->position++;
            return -$this->parseFactor();
        }
        
        // Скобки
        if ($char == '(') {
            $this->position++;
            $value = $this->parseExpression();
            
            if ($this->position >= strlen($this->expression) || $this->expression[$this->position] != ')') {
                throw new Exception('Отсутствует закрывающая скобка');
            }
            $this->position++;
            
            if ($this->position < strlen($this->expression) && $this->expression[$this->position] == '^') {
                $this->position++;
                $exponent = $this->parseFactor();
                $value = pow($value, $exponent);
            }
            
            return $value;
        }
        
        // Функции: sqrt, ln, log, fact
        if (preg_match('/^(sqrt|ln|log|fact)/', substr($this->expression, $this->position), $matches)) {
            $func = $matches[1];
            $this->position += strlen($func);
            
            if ($this->position >= strlen($this->expression) || $this->expression[$this->position] != '(') {
                throw new Exception("После функции $func ожидается скобка");
            }
            $this->position++;
            $arg = $this->parseExpression();
            
            if ($this->position >= strlen($this->expression) || $this->expression[$this->position] != ')') {
                throw new Exception("Отсутствует закрывающая скобка для функции $func");
            }
            $this->position++;
            
            switch ($func) {
                case 'sqrt':
                    if ($arg < 0) throw new Exception('Корень из отрицательного числа');
                    return sqrt($arg);
                case 'ln':
                    if ($arg <= 0) throw new Exception('ln(x) определён только для x > 0');
                    return log($arg);
                case 'log':
                    if ($arg <= 0) throw new Exception('log(x) определён только для x > 0');
                    return log10($arg);
                case 'fact':
                    if ($arg < 0 || floor($arg) != $arg) throw new Exception('Факториал определён только для целых неотрицательных чисел');
                    return $this->factorial($arg);
                default:
                    throw new Exception("Неизвестная функция: $func");
            }
        }
        
        // Числа
        if (preg_match('/^(\d+(?:\.\d+)?)/', substr($this->expression, $this->position), $matches)) {
            $num = $matches[1];
            $this->position += strlen($num);
            $value = (float)$num;
            
            if ($this->position < strlen($this->expression) && $this->expression[$this->position] == '^') {
                $this->position++;
                $exponent = $this->parseFactor();
                $value = pow($value, $exponent);
            }
            
            return $value;
        }
        
        throw new Exception('Неожиданный символ: ' . $char);
    }
    
    private function factorial($n) {
        if ($n == 0 || $n == 1) return 1;
        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }
}
?>