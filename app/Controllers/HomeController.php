<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DB;
use App\Pegination;
use Twig\Environment as Twig;

class HomeController
{
    public function __construct(
        private Twig $twig,
        private DB $db,
        private Pegination $paging
    ) {
    }

    public function renderIndex(): string
    {
        $requestUri = '/';

        $products = $this->paging->getProducts(1);
        return $this->twig->render('index.php', ['requestUri' => $requestUri, 'products' => $products]);
    }

    public function getNextData(): void
    {
        if (isset($_POST['getData'])) {
            $start = (int) $_POST['start'];
            $products = $this->paging->getProducts($start);
            $response = '';

            foreach ($products as $product) {
                match ($product['productType']) {
                    'DVD' =>
                    $response .= '
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <input name="' . $product['id'] . '" value="' . $product['productType'] . '" class="delete-checkbox position-absolute top-0 start-0 translate-middle form-check-input mt-4 ms-4 justify-content-start" type="checkbox">

                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>' . $product['productType'] . '' . $product['id'] . '</li>
                            <li>' . $product['name'] . '</li>
                            <li>' . $product['price'] . '</li>
                            <li>Size: ' . $product['size'] . '}MB</li>
                            </ul>
                        </div>
                    </div>
                </div>',

                    'Book' =>
                    $response .= '
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <input name="' . $product['id'] . '" value="' . $product['productType'] . '" class="delete-checkbox position-absolute top-0 start-0 translate-middle form-check-input mt-4 ms-4 justify-content-start" type="checkbox">

                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>' . $product['productType'] . '' . $product['id'] . '</li>
                            <li>' . $product['name'] . '</li>
                            <li>' . $product['price'] . '</li>
                            <li>Weight: ' . $product['weight'] . 'KG</li>
                            </ul>
                        </div>
                    </div>
                </div>',

                    'Furniture' =>
                    $response .= '
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <input name="' . $product['id'] . '" value="' . $product['productType'] . '" class="delete-checkbox position-absolute top-0 start-0 translate-middle form-check-input mt-4 ms-4 justify-content-start" type="checkbox">

                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>' . $product['productType'] . '' . $product['id'] . '</li>
                            <li>' . $product['name'] . '</li>
                            <li>' . $product['price'] . '</li>
                            <li>Dimension: ' . $product['height'] . 'x' . $product['width'] . 'x' . $product['length'] . '</li>
                            </ul>
                        </div>
                    </div>
                </div>',
                };
            }

            exit($response);
        } else {
            exit('reachedMax');
        }
    }
}
