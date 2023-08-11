<?php
class Post
{
    private $title;
    private $text;

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function setText(string $text): void
    {
        $this->title = $text;
    }
}