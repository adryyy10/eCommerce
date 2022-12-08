<?php

namespace App\Controller\Basket;

use App\Interfaces\Basket\BasketRepositoryInterface;
use App\Interfaces\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostNewProductToBasketController extends AbstractController
{

    /**
     * @Route("/add-product-to-basket/{basketId}/{productId}", name="app_shop_add_product_basket")
     */
    public function addProductToBasket(
        int $productId, 
        int $basketId,
        ProductRepositoryInterface $productRepository,
        BasketRepositoryInterface $basketRepository
    ) {
        $basket     = $basketRepository->find($basketId);
        $product    = $productRepository->find($productId);

        /** Add new product to basket + update total amount */
        $basket->addProduct($product);
        $basket->setAmount($basket->getAmount() + $product->getPrice());
        $basketRepository->flush();

        return $this->redirectToRoute('app_ecommerce_get_products');
    }

}
