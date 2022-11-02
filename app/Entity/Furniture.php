<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('Furniture')]
#[HasLifecycleCallbacks]
class Furniture extends Products
{
    #[Column]
    private float $height;

    #[Column]
    private float $width;

    #[Column]
    private float $length;

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): Furniture
    {
        $this->height = $height;

        return $this;
    }

    public function getWidht(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): Furniture
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setLength(float $length): Furniture
    {
        $this->length = $length;

        return $this;
    }
}
