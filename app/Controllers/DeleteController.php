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
    ) {
    }

    public function deleteProducts()
    {
        if (empty($_POST)) {
            http_response_code(302);
            header('Location: /');
            exit();
        }

        foreach ($_POST as $id => $productType) {
            $id = (string) $id;
            $this->db->deleteProduct($id, $productType);
        }

        http_response_code(302);
        header('Location: /');
    }
}
