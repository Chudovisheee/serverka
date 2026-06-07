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
        foreach ($this->constants as $const => $value) {
            $expression = str_replace($const, (string)$value, $expression);
        }
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
                if ($divisor == 0) throw new Exception('Деление на ноль');
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
        
        if ($char == '-') {
            $this->position++;
            return -$this->parseFactor();
        }
        
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
        
        // Добавляем поддержку тригонометрических функций
        if (preg_match('/^(sin|cos|tan|cot|sqrt|ln|log|fact)/', substr($this->expression, $this->position), $matches)) {
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
            
            // Тригонометрические функции (угол в градусах)
            if (in_array($func, ['sin', 'cos', 'tan', 'cot'])) {
                // Предполагается, что функция calculateTrig уже подключена (в laba4.php)
                if (!function_exists('calculateTrig')) {
                    throw new Exception("Функция calculateTrig не найдена");
                }
                return calculateTrig($func, $arg);
            }
            
            // Остальные функции
            switch ($func) {
                case 'sqrt': return sqrt($arg);
                case 'ln':   return log($arg);
                case 'log':  return log10($arg);
                case 'fact': return $this->factorial($arg);
                default: throw new Exception("Неизвестная функция: $func");
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