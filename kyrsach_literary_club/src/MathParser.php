<?php
class MathParser {
    private $expression;
    private $position;
    
    public function evaluate($expression) {
        $expression = str_replace(['π', 'pi', 'e'], [M_PI, M_PI, M_E], $expression);
        $expression = str_replace('√', 'sqrt', $expression);
        $this->expression = str_replace(' ', '', $expression);
        $this->position = 0;
        $result = $this->parseExpression();
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
            } else break;
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
            } else break;
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
            return $value;
        }
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
                case 'sqrt': return sqrt($arg);
                case 'ln': return log($arg);
                case 'log': return log10($arg);
                case 'fact': return $this->factorial($arg);
            }
        }
        if (preg_match('/^(\d+(?:\.\d+)?)/', substr($this->expression, $this->position), $matches)) {
            $num = $matches[1];
            $this->position += strlen($num);
            return (float)$num;
        }
        throw new Exception('Неожиданный символ: ' . $char);
    }
    
    private function factorial($n) {
        if ($n == 0 || $n == 1) return 1;
        $result = 1;
        for ($i = 2; $i <= $n; $i++) $result *= $i;
        return $result;
    }
}