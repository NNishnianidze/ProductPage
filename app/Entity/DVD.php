<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('DVD')]
#[HasLifecycleCallbacks]
class DVD extends Products
{
    #[Column]
    private int $size;

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): DVD
    {
        $this->size = $size;

        return $this;
    }
}
