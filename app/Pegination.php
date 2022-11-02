<?php

declare(strict_types=1);

namespace App;

class Pegination
{
    protected array $products;
    protected int $totalPages;

    public function getProducts(): array
    {
        $db = new DB;

        // changes Number of Cards of Pordact list page
        $perPage = 16;
        $this->totalPages = $db->getTotalPages($perPage);

        $pageNow = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($pageNow - 1) * $perPage;
        $end = $perPage;

        $this->products = $db->parseDB($start, $end);

        return $this->products;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }
}
