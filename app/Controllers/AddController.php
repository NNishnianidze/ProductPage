<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DB;
use App\Exceptions\ViewNotFoundException;
use Valitron\Validator;
use Twig\Environment as Twig;

class AddController
{
    private array $errors = [];

    public function __construct(
        private DB $db,
        private Twig $twig,
    ) {
    }

    public function renderIndex(): string
    {
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        }

        if (!empty($errors)) {
            unset($_SESSION['errors']);
            session_destroy();
            return $this->twig->render('add.php', ['requestUri' => '/add', 'errors' => $errors]);
        }

        return $this->twig->render('add.php', ['requestUri' => '/add']);
    }

    public function addProduct()
    {
        $productType = $_POST['productType'];
        $function = 'validate' . $productType;

        $validate = $this->$function($_POST, $productType);

        if (!$validate) {
            $_SESSION['errors'] = $this->errors;
            header('Location: /add');
            exit;
        }

        http_response_code(302);
        header('Location: /');
    }

    public function validateDVD(array $postData, string $productType): bool
    {
        $v = new Validator($postData);

        $v->rule('required', ['sku', 'name', 'price', 'productType', 'size']);
        $v->rules([
            'alphaNum'      => ['name', 'sku'],
            'numeric'       => 'price',
            'integer'       => 'size',
        ]);
        $v->rule(
            fn ($field, $value, $params, $fields) => $this->db->validateId($value),
            'sku'
        )->message('Product with the given SKU already exists');

        if (!$v->validate()) {
            $this->errors = $v->errors();
            return false;
        }

        $postData['size'] = (int) $postData['size'];
        $postData['price'] = (float) $postData['price'];

        $this->db->createProduct($productType, $postData);
        return true;
    }

    public function validateBook(array $postData, string $productType): bool
    {
        $v = new Validator($postData);

        $v->rule('required', ['sku', 'name', 'price', 'productType', 'weight']);
        $v->rules([
            'alphaNum'      => ['name', 'sku'],
            'numeric'       => ['weight', 'price'],
        ]);
        $v->rule(
            fn ($field, $value, array $params, array $fields) => $this->db->validateId($value),
            'sku'
        )->message('Product with the given SKU already exists');

        if (!$v->validate()) {
            $this->errors = $v->errors();
            return false;
        }

        $postData['weight'] = (float) $postData['weight'];
        $postData['price'] = (float) $postData['price'];

        $this->db->createProduct($productType, $postData);
        return true;
    }

    public function validateFurniture(array $postData, string $productType): bool
    {
        $v = new Validator($postData);

        $v->rule('required', ['sku', 'name', 'price', 'productType', 'height', 'width', 'length']);
        $v->rule('requiredWith', 'height', ['width', 'length']);
        $v->rule('requiredWith', 'width', ['height', 'length']);
        $v->rule('requiredWith', 'length', ['height', 'width']);
        $v->rules([
            'alphaNum'      => ['name', 'sku'],
            'numeric'       => ['price', 'height', 'width', 'length']
        ]);
        $v->rule(
            fn ($field, $value, $params, $fields) => $this->db->validateId($value),
            'sku'
        )->message('Product with the given SKU already exists');

        if (!$v->validate()) {
            $this->errors = $v->errors();
            return false;
        }

        $postData['height'] = (float) $postData['height'];
        $postData['width'] = (float) $postData['width'];
        $postData['length'] = (float) $postData['length'];
        $postData['price'] = (float) $postData['price'];

        $this->db->createProduct($productType, $postData);
        return true;
    }
}
