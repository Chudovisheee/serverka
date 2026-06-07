<?php
function calculateTrig(string $funcName, float $degrees): float
{
    $radians = deg2rad($degrees);
    switch ($funcName) {
        case 'sin': return sin($radians);
        case 'cos': return cos($radians);
        case 'tan': return tan($radians);
        case 'cot':
            $tan = tan($radians);
            if ($tan == 0) throw new InvalidArgumentException("cot({$degrees}) не определён");
            return 1 / $tan;
        default:
            throw new InvalidArgumentException("Функция '$funcName' не поддерживается");
    }
}