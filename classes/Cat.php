<?php

class Cat
{
    private $name;
    private $color;
    public $weight;

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function SayHello()
    {
        echo ('Привет, меня зовут ' . $this->name . ' и мой цвет ' . $this->color . '.');
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setColor(string $color)
    {
        $this->name = $color;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}

$cat1 = new Cat('Барсик', 'серый');
$cat1->weight = 3.5;

$cat1->SayHello();
echo $cat1->getColor();

$cat2 = new Cat('Мурка', 'черный');
$cat2->weight = 4;

$cat2->SayHello();