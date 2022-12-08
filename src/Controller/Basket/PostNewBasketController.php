<?php

namespace App\Controller\Basket;

use App\Entity\Basket;
use App\Interfaces\Basket\BasketRepositoryInterface;
use App\Interfaces\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostNewBasketController extends AbstractController
{

    /**
     * @Route("/add-basket/{productId}", name="app_shop_add_basket")
     * 
     * @param int $productId
     * @param BasketRepositoryInterface $basketRepository
     * @param ProductRepositoryInterface $productRepository
     * 
     */
    public function createBasket(
        int $productId,
        BasketRepositoryInterface $basketRepository,
        ProductRepositoryInterface $productRepository
        )
    {
        /** Check if we already have an existing Basket */
        $userId = $this->getUser()->getId();
        $basket = $basketRepository->findOneBy(["userId" => $userId]);

        /** If we have a basket, redirect to add product to basket */
        if (!empty($basket)) {
            return $this->redirectToRoute('app_shop_add_product_basket', [
                'productId' => $productId,
                'basketId'  => $basket->getId()
            ]);
        }

        /** If the basket was empty, create a new one */
        $basket = new Basket($userId);

        /** Find the product */
        $product = $productRepository->find($productId);
        if (empty($product)) {
            throw new EntityNotFoundException("Product not found");
        }

        /** Add new product to the new Basket */
        $basket->addProduct($product);
        $basket->setAmount($product->getPrice());

        /** Persist + flush in DB */
        $basketRepository->add($basket, true);

        return $this->redirectToRoute('app_shop_get_basket', [
            'id' => $basket->getId()
        ]);
    }

}
