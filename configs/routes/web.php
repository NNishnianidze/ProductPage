<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\AddController;
use App\Router;

return function (Router $router) {
    $router->get('/', [HomeController::class, 'index']);
    $router->post('/', [HomeController::class, 'deleteProducts']);
    $router->get('/add', [AddController::class, 'index']);
    $router->post('/add', [AddController::class, 'addProduct']);
};
