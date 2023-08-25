<?php
return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' =>[\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/delete/(\d+)$~' =>[\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^articles/add$~' =>[\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^users/register$~' =>[\MyProject\Controllers\UsersController::class, 'signUp'],

];