<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('Products')]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'product', type: 'string')]
#[DiscriminatorMap(['DVD' => DVD::class, 'Book' => Book::class, 'Furniture' => Furniture::class])]
#[HasLifecycleCallbacks]
class Products
{
    #[Id, Column(type: 'string')]
    private string $id;

    #[Column]
    protected string $name;

    #[Column(name: 'product_type')]
    protected string $productType;

    #[Column(type: Types::DECIMAL, precision: 13, scale: 2)]
    protected float $price;

    #[Column(name: 'created_at')]
    protected \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    protected \DateTime $updatedAt;

    public function __construct()
    {
        $this->dvd = new ArrayCollection();
        $this->book = new ArrayCollection();
        $this->furniture = new ArrayCollection();
    }

    public function setId(string $id): Products
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    #[PrePersist, PreUpdate]
    public function prePersist(LifecycleEventArgs $args): void
    {
        if (!isset($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }

        $this->updatedAt = new \DateTime();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Products
    {
        $this->name = $name;

        return $this;
    }

    public function getProductType(): string
    {
        return $this->productType;
    }

    public function setProductType(string $productType): Products
    {
        $this->productType = $productType;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): Products
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): Products
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): Products
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
