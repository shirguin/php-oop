<?php
namespace MyProject\Models\Users;
class User
{
    //Переписать класс под ORM
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}