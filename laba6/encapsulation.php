<?php

class Cat
{
    private $name;
    private $color; 

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function sayHello(): string
    {
        return 'Мяу! Меня зовут ' . $this->getName() . '. Я ' . $this->getColor() . ' цвета.';
    }
}

$cat1 = new Cat('Барсик', 'рыжего');
$cat2 = new Cat('Мурка', 'чёрного');
$cat3 = new Cat('Снежок', 'белого');

echo $cat1->sayHello() . "\n";
echo $cat2->sayHello() . "\n";
echo $cat3->sayHello() . "\n";

$cat1->setName('Барсик Великий');
$cat1->setColor('золотистого');
echo "\nПосле переименования:\n";
echo $cat1->sayHello() . "\n";

?>