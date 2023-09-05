<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Articles\Article;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\Forbidden;

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
            throw new NotFoundException();
        }

        if ($this->user === null){
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()){
            throw new Forbidden('Для доступа к этой странице необходимы права администратора');
        }

        if (!empty($_POST)){
            try {
                $article->updateFromArray($_POST);
            }catch (InvalidArgumentException $e){
                $this->view->renderHtml('articles/edit.php', ['error'=>$e->getMessage(), 'article'=>$article]);
                return;
            }
            header('Location:/articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article'=>$article]);
    }

    public function add(): void
    {
        /* $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
        var_dump($article); */

        if ($this->user === null){
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()){
            throw new Forbidden('Для добавления статьи нужно обладать правами Администратора');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }
    
            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
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