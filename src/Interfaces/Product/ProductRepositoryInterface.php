<?php

namespace App\Interfaces\Product;

use App\Entity\Product;

interface ProductRepositoryInterface
{
    public function add(Product $entity, bool $flush = false): void;

    public function find($id, $lockMode = null, $lockVersion = null);

    public function findAll();

    public function remove(Product $entity, bool $flush = false): void;
}
