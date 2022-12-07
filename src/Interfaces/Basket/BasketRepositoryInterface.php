<?php

namespace App\Interfaces\Basket;

interface BasketRepositoryInterface
{

    public function findOneBy(array $criteria, array $orderBy = null);

}
