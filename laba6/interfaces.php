<?php

interface CalculateSquare
{
    public function calculateSquare(): float;
}

class Circle implements CalculateSquare
{
    const PI = 3.1416;
    
    private $r;
    
    public function __construct(float $r)
    {
        $this->r = $r;
    }
    
    public function calculateSquare(): float
    {
        return self::PI * ($this->r ** 2);
    }
}

class Rectangle implements CalculateSquare
{
    private $x;
    private $y;
    
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    
    public function calculateSquare(): float
    {
        return $this->x * $this->y;
    }
}

class Square implements CalculateSquare
{
    private $x;
    
    public function __construct(float $x)
    {
        $this->x = $x;
    }
    
    public function calculateSquare(): float
    {
        return $this->x ** 2;
    }
}

class Triangle
{
    private $base;
    private $height;
    
    public function __construct(float $base, float $height)
    {
        $this->base = $base;
        $this->height = $height;
    }
    
    public function calculateArea(): float
    {
        return 0.5 * $this->base * $this->height;
    }
}

function printSquareInfo($object): void
{
    $className = get_class($object);
    
    if ($object instanceof CalculateSquare) {
        $square = $object->calculateSquare();
        echo "Объект класса {$className}. Площадь: " . round($square, 2) . "\n";
    } else {
        echo "Объект класса {$className} не реализует интерфейс CalculateSquare.\n";
    }
}

$objects = [
    new Circle(5),
    new Rectangle(4, 6),
    new Square(4),
    new Triangle(3, 4)
];

foreach ($objects as $object) {
    printSquareInfo($object);
}

?>