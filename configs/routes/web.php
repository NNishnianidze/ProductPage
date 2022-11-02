<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\AddController;
use App\Controllers\DeleteController;
use App\Router;

return function (Router $router) {
    $router->get('/', [HomeController::class, 'renderIndex']);
    $router->post('/', [HomeController::class, 'getNextData']);
    $router->get('/add', [AddController::class, 'renderIndex']);
    $router->post('/add', [AddController::class, 'addProduct']);
    $router->post('/delete', [DeleteController::class, 'deleteProducts']);
};
