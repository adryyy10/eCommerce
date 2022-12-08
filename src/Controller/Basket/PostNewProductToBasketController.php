<?php

namespace App\Controller\Basket;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostNewProductToBasketController extends AbstractController
{

    /**
     * @Route("/add-product-to-basket", name="app_shop_add_product_basket")
     */
    public function addProductToBasket()
    {
        dd("HEHE");
    }

}
