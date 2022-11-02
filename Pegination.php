<?php

declare(strict_types=1);

namespace App;

use App\DB;

class Pegination
{
    protected array $data;
    protected float $totalPages;

    public function getProducts(): array
    {
        $db = new DB;

        $perPage = 26;
        $this->totalPages = $db->getTotalPages($perPage);

        $pageNow = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($pageNow - 1) * $perPage;
        $end = $perPage;

        $this->data = $db->parseDB($start, $end);

        return $this->data;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }
}
