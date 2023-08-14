<?php
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
    echo 'Страница не найдена!';
    return;
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);