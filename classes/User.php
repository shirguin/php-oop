<?php
class User
{

    private $role;
    private static $count = 0;
    private $name;

    public function __construct(string $role, string $name)
    {
        $this->role = $role;
        $this->name = $name;
        self::$count++;
    }

    public static function createAdmin($name)
    {
        return new self('admin', $name);
    }

    public static function getCount(): int
    {
        return self::$count;
    }
}

$admin = User::createAdmin('Иван');
echo 'счетчик равен: ' . User::getCount();
$user = new User('user', 'Петр');
echo 'счетчик равен: ' . User::getCount();