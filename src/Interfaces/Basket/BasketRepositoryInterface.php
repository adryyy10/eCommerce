<?php

namespace App\Interfaces\Basket;

use App\Entity\Basket;

interface BasketRepositoryInterface
{
    public function add(Basket $entity, bool $flush = false): void;

    public function find($id, $lockMode = null, $lockVersion = null);

    public function findAll();

    public function findOneBy(array $criteria, array $orderBy = null);

    public function flush(): void;

}
