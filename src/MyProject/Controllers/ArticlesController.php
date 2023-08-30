<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Exceptions\NotFoundException;

class ArticlesController extends AbstractController
{
    public function view($articleId)
    {
        $article = Article::getById($articleId);

        //Рефлектор API
/*         $reflector = new \ReflectionObject($article);
        $properties = $reflector->getProperties();
        $propertiesNames = [];
        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName();
        }
        var_dump($propertiesNames);

        return; */

        if ($article === null) {
/*             $this->view->renderHtml('errors/404.php', [], 404);
            return; */
            throw new NotFoundException();
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function edit($articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
/*             $this->view->renderHtml('errors/404.php', [], 404);
            return; */
            throw new NotFoundException();
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }

    public function add(): void
    {
        $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
        var_dump($article);
    }

    public function delete(int $id): void
    {
        $article = Article::getById($id);

        if ($article) {
            $article->delete();
            echo 'Статья удалена';
        } else {
            echo 'Статьи с таким id не существует';
        }
    }
}