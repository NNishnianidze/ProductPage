<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\ViewNotFoundException;
use Twig\Environment as Twig;

abstract class AbstractIndexController
{
    public function __construct(
        private Twig $twig
    ) {
    }

    public function renderIndex(): string
    {
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        }

        $uri = explode('/', $_SERVER['REQUEST_URI'])[1];

        $view = $uri . '.php';
        $viewPath = VIEW_PATH . '/' . $view;

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
            return $this->twig->render('404.php');
        }

        if (!empty($errors)) {
            unset($_SESSION['errors']);
            session_destroy();
            return $this->twig->render($view, ['requestUri' => $_SERVER['REQUEST_URI'], 'errors' => $errors]);
        }

        return $this->twig->render($view, ['requestUri' => $_SERVER['REQUEST_URI']]);
    }
}
