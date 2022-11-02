<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('Book')]
#[HasLifecycleCallbacks]
class Book extends Products
{
    #[Column(type: Types::DECIMAL, precision: 13, scale: 3)]
    private float $weight;

    public function getweight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): Book
    {
        $this->weight = $weight;

        return $this;
    }
}
