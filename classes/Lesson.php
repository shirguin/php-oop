<?php
require_once 'Post.php';

class Lesson extends Post
{
    private $homework;

    public function __construct(string $title, string $text, string $homework)
    {
        parent::__construct($title, $text);
        $this->homework = $homework;
    }

    public function getHomework(): string
    {
        return $this->homework;
    }
    public function setHomework(string $homework): void
    {
        $this->title = $homework;
    }
}

$lesson = new Lesson('Заголовок', 'Текст', 'Домашка');
echo 'Название урока: ' . $lesson->getTitle();
//var_dump($lesson);