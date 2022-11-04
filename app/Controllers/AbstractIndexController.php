<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\ViewNotFoundException;
use Twig\Environment as Twig;

abstract class AbstractIndexController
{
    public function __construct(
        private Twig $twig,
    ) {
    }

    public function renderIndex(): string
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            return $this->twig->render('index.php', ['requestUri' => $_SERVER['REQUEST_URI']]);
        };
        $_SERVER['REQUEST_URI'];
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $uri = end($uri);
        $uri = explode('?', $uri);
        $uri = end($uri);

        $view = $uri . '.php';
        $viewPath = VIEW_PATH . '/' . $view;

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
            return $this->twig->render('404.php');
        }

        $options['requestUri'] = $_SERVER['REQUEST_URI'];

        return $this->twig->render($view, ['requestUri' => $_SERVER['REQUEST_URI']]);
    }
}
