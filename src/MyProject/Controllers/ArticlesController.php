<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticlesController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view($articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }
}