<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DB;
use Valitron\Validator;
use Twig\Environment as Twig;

class AddController extends AbstractIndexController
{
    public function __construct(
        private DB $db,
        private Twig $twig,
        private array $errors = [],
        private HomeController $homeController
    ) {
        parent::__construct($this->twig);
    }

    public function addProduct(): string
    {
        $productType = $_POST['productType'];
        $function = 'validate' . $productType;

        if (!$this->$function($_POST, $productType)) {
            return $this->twig->render('add.php', ['requestUri' => '/add', 'errors' => $this->errors]);
        }

        return $this->homeController->renderIndex();
    }

    public function validateDVD(array $postData, string $productType)
    {
        $v = new Validator($postData);

        $v->rule('required', ['name', 'price', 'productType', 'size']);
        $v->rules([
            'alphaNum'      => 'name',
            'numeric'       => 'price',
            'integer'       => 'size',
        ]);

        if (!$v->validate()) {
            $this->errors = $v->errors();
            return false;
        }

        $postData['size'] = (int) $postData['size'];
        $postData['price'] = (float) $postData['price'];

        $this->db->createProduct($productType, $postData);
    }

    public function validateBook(array $postData, string $productType)
    {
        $v = new Validator($postData);

        $v->rule('required', ['name', 'price', 'productType', 'weight']);
        $v->rules([
            'alphaNum'      => 'name',
            'numeric'       => ['weight', 'price'],
        ]);

        if (!$v->validate()) {
            $this->errors = $v->errors();
            return false;
        }

        $postData['weight'] = (float) $postData['weight'];
        $postData['price'] = (float) $postData['price'];

        $this->db->createProduct($productType, $postData);
    }

    public function validateFurniture(array $postData, string $productType)
    {
        $v = new Validator($postData);

        $v->rule('required', ['name', 'price', 'productType', 'height', 'width', 'length']);
        $v->rule('requiredWith', 'height', ['width', 'length']);
        $v->rule('requiredWith', 'width', ['height', 'length']);
        $v->rule('requiredWith', 'length', ['height', 'width']);
        $v->rules([
            'alphaNum'      => 'name',
            'numeric'       => ['price', 'height', 'width', 'length']
        ]);

        if (!$v->validate()) {
            $this->errors = $v->errors();
            return false;
        }

        $postData['height'] = (float) $postData['height'];
        $postData['width'] = (float) $postData['width'];
        $postData['length'] = (float) $postData['length'];
        $postData['price'] = (float) $postData['price'];

        $this->db->createProduct($productType, $postData);
    }
}
