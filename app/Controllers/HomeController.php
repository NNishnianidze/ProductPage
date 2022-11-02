<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DB;
use App\Pegination;
use Twig\Environment as Twig;

class HomeController extends AbstractIndexController
{
    public function index(Twig $twig, ?array $options = []): string
    {
        // TODO: Implement Infinite Scroll
        $requestUri = explode('?', $_SERVER['REQUEST_URI'])[0];

        $paging = new Pegination;
        $products = $paging->getProducts();

        $totalPages = $paging->getTotalPages();

        return $twig->render('index.php', ['requestUri' => $requestUri, 'products' => $products, 'totalPages' => $totalPages]);
    }

    public function deleteProducts(Twig $twig)
    {
        if (empty($_POST)) {
            return $this->index($twig);
        }

        $db = new DB;

        $products = $_POST;

        foreach ($_POST as $id => $productType) {
            $db->deleteProduct($id, $productType);
        }

        return $this->index($twig);
    }
}
