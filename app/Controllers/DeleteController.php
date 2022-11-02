<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DB;
use Twig\Environment as Twig;

class DeleteController
{
    public function __construct(
        private Twig $twig,
        private DB $db,
        private HomeController $homeContoller,
    ) {
    }

    public function deleteProducts(): string
    {
        if (empty($_POST)) {
            return $this->homeContoller->renderIndex();
        }

        foreach ($_POST as $id => $productType) {
            $this->db->deleteProduct($id, $productType);
        }

        return $this->homeContoller->renderIndex();
    }
}
