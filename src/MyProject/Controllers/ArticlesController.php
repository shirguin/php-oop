<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;

class ArticlesController
{
    private $view;

    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

    public function view($articleId)
    {
        $result = $this->db->query(
            'SELECT * FROM `articles` WHERE id = :id;',
            [':id' => $articleId], Article::class
        );

        if ($result === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $authorId = $result[0]->getId();

        $result2 = $this->db->query(
            'SELECT * FROM `users` WHERE id = :id;',
            [':id' => $authorId], User::class
        );

        $this->view->renderHtml('articles/view.php', ['article' => $result[0], 'author' => $result2[0]]);
    }
}