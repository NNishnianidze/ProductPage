<?php

declare(strict_types=1);

namespace App;

use App\Entity\DVD;
use App\Entity\Book;
use App\Entity\Furniture;
use App\Entity\Products;
use Doctrine\ORM\EntityManager;

class DB
{
    private array $data;

    public function __construct(
        private EntityManager $entityManager,
    ) {
    }

    public function createProduct(string $productType, array $postData)
    {
        $function = 'create' . $productType;
        $this->$function($postData);
    }

    public function createDVD(array $postData): void
    {
        $dvd = new DVD;

        $dvd
            ->setName($postData['name'])
            ->setProductType('DVD')
            ->setPrice($postData['price'])
            ->setSize($postData['size']);

        $this->entityManager->persist($dvd);
        $this->entityManager->flush();
    }

    public function createBook(array $postData): void
    {
        $book = new Book;

        $book
            ->setName($postData['name'])
            ->setProductType('Book')
            ->setPrice($postData['price'])
            ->setWeight($postData['weight']);

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function createFurniture(array $postData): void
    {
        $furniture = new Furniture;

        $furniture
            ->setName($postData['name'])
            ->setProductType('Furniture')
            ->setPrice($postData['price'])
            ->setHeight($postData['height'])
            ->setWidth($postData['width'])
            ->setLength($postData['length']);

        $this->entityManager->persist($furniture);
        $this->entityManager->flush();
    }

    public function parseDB(int $start, int $end)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select('p')
            ->from(Products::class, 'p')
            ->orderBy('p.id')
            ->setFirstResult($start)
            ->setMaxResults($end);

        $query = $queryBuilder->getQuery();

        $this->data = $query->getArrayResult();

        return $this->data;
    }

    public function deleteProduct(int $id, string $productType)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->delete(Products::class, 'p')
            ->where('p.id = :id')
            ->andWhere('p.productType = :productType')
            ->setParameter('id', $id)
            ->setParameter('productType', $productType);

        $query = $queryBuilder->getQuery();

        $query->execute();
    }
}
