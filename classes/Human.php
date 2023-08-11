<?php
abstract class HumanAbstract
{
    private $name;
    public function __construct(string $name){
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    abstract public function getGreeting():string;
    abstract public function getMyNameIs():string;

    public function introduceYourself():string
    {
        return $this->getGreeting() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '.';
    }
}

class RussianHuman extends HumanAbstract
{
    private $value;

    public function getGreeting():string
    {
        return 'Привет';
    }
    public function getMyNameIs():string
    {
        return 'Меня зовут';
    }
}

class EnglishHuman extends HumanAbstract
{
    private $value;

    public function getGreeting():string
    {
        return 'Hellow';
    }
    public function getMyNameIs():string
    {
        return 'My name is';
    }
}

$human_1 = new RussianHuman('Алексей');
echo $human_1->introduceYourself();
echo '<br>';

$human_2 = new EnglishHuman('Mishel');
echo $human_2->introduceYourself();
echo '<br>';