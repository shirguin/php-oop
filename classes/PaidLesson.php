<?php
require_once 'Lesson.php';

class PaidLesson extends Lesson
{
    private $price;

    public function __construct(string $title, string $text, string $homework, float $price)
    {
        parent::__construct($title, $text, $homework);
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->title = $price;
    }
}

$paidLesson1 = new PaidLesson('Урок о наследовании в PHP', 'Лол, кек, чебурек', 'Ложитесь спать, утро вечера мудренее', 99.9);
var_dump($paidLesson1);