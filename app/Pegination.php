<?php

declare(strict_types=1);

namespace App;

class Pegination
{
    public function __construct(
        private DB $db
    ) {
    }

    public function getProducts(int $pageNow): array
    {
        // changes Number of Cards on Home - Product list page
        $perPage = 20;

        $start = ($pageNow - 1) * $perPage;
        $end = $perPage;

        $products = $this->db->parseDB($start, $end);

        return $products;
    }
}
