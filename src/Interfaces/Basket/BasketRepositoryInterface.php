<?php

namespace App\Interfaces\Basket;

interface BasketRepositoryInterface
{

    public function find($id, $lockMode = null, $lockVersion = null);

    public function findOneBy(array $criteria, array $orderBy = null);

}
