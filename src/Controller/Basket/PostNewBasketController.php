<?php

namespace App\Controller\Basket;

use App\Entity\Basket;
use App\Interfaces\Basket\BasketRepositoryInterface;
use App\Interfaces\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostNewBasketController extends AbstractController
{

    /**
     * 
     * @Route("/add-basket", methods={"POST"}, name="app_shop_add_basket")
     * 
     */
    public function createBasket(
        BasketRepositoryInterface $basketRepository,
        ProductRepositoryInterface $productRepository
        )
    {
        dd("JUAS");
        /** Check if we already have an existing Basket */
        $userId = $this->getUser()->getId();
        $basket = $basketRepository->findOneBy(["userId" => $userId]);

        /** If we have a basket, redirect to add product to basket */
        if (!empty($basket)) {
            return $this->redirectToRoute('/add-product-to-basket');
        }

        /** If the basket was empty, create a new one */
        $basket = new Basket($userId);

        /** Find the product */
        $product = $productRepository->find($productId);
        if (empty($product)) {
            throw new EntityNotFoundException("Product not found");
        }

        $basket->addProduct($product);

        return $this->redirectToRoute('basket/' . $basket->getId());
    }

}
