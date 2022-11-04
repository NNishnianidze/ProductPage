<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigParserExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('getProducts', [$this, 'getProducts']),
        ];
    }

    public function getProducts()
    {
        return 'Yes';
    }
}
