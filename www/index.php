<?php
use MyProject\Models\Users\UsersAuthService;
//Автозагрузка нужных классов
/* spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
}); */

/* spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
}); */

/* $author = new \MyProject\Models\Users\User('Иван');
$article = new \MyProject\Models\Articles\Article('Заголовок', 'Текст', $author);
var_dump($article); */

/* $controller = new \MyProject\Controllers\MainController();
if (!empty($_GET['name'])){
    $controller->sayHellow($_GET['name']);
}else{
    $controller->main();
} */

/* $route = $_GET['route'] ?? '';

$pattern = '~^hello/(.*)$~';
preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \MyProject\Controllers\MainController();
    $controller->sayHello($matches[1]);
    return;
}

$pattern = '~^$~';
preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \MyProject\Controllers\MainController();
    $controller->main();
    return;
}

echo 'Страница не найдена'; */

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . $className . '.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        /*         echo 'Страница не найдена!';
                return; */
        //Бросаем исключение
        throw new \MyProject\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\MyProject\Exceptions\DbException $e) {
    //echo $e->getMessage();
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage(), 500]);
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage(), 404]);
}catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
}catch (MyProject\Exceptions\Forbidden $e){
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage(), 'user'=>UsersAuthService::getUserByToken()], 403);
}