<?php

interface CalculateSquare
{
    public function calculateSquare():float;
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

    public function calculateSquare():float
    {
        return $this->x * $this->y;
    }
}

class Square
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
class Circle implements CalculateSquare
{
    const PI=3.1416;
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

/* $circle1 = new Circle(2.5);
var_dump($circle1 instanceof Circle);
var_dump($circle1 instanceof Rectangle);
var_dump($circle1 instanceof CalculateSquare); */

$objects = [
    new Square(5),
    new Rectangle(2,4),
    new Circle(5)
];

foreach ($objects as $object) {
    if($object instanceof CalculateSquare){
        echo 'Объект класса ' .get_class($object) . ' реализует интерфейс CalculateSquare. Площадь: ' . $object->calculateSquare();
        echo '<br>'; 
    }else{
        echo 'Объект класса ' .get_class($object) . ' не реализует интерфейс CalculateSquare.';
        echo '<br>';
    }
}