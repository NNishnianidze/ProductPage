<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\ViewNotFoundException;
use Twig\Environment as Twig;

abstract class AbstractIndexController
{
    public function index(Twig $twig, ?array $options = []): string
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            return $twig->render('index.php', ['requestUri' => $_SERVER['REQUEST_URI']]);
        };
        $_SERVER['REQUEST_URI'];
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $uri = end($uri);

        $view = $uri . '.php';
        $viewPath = VIEW_PATH . '/' . $view;

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        $options['requestUri'] = $_SERVER['REQUEST_URI'];

        return $twig->render($view, $options);
    }
}
