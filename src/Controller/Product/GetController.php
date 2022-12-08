<?php

namespace App\Controller\Product;

use App\Interfaces\Basket\BasketRepositoryInterface;
use App\Interfaces\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetController extends AbstractController
{

    /**
     * @route("/products", methods={"GET"}, name="app_ecommerce_get_products")
     * 
     * @param ProductRepositoryInterface $productRepository
     * 
     * @return Response
     */
    public function getProducts(ProductRepositoryInterface $productRepository, BasketRepositoryInterface $basketRepository): Response
    {
        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $products = $productRepository->findAll();

        /** Obtain basket (if we are logged and have it one) */
        if (!empty($this->getUser())) {
            $basket = $basketRepository->findOneBy(["userId" => $this->getUser()->getId()]);
        }

        return $this->render('shop/products.html.twig', [
            'products' => $products,
            'basket'   => !empty($basket) ? $basket : null
        ]);

    }

    /**
     * @route("/product/{id}", methods={"GET"}, name="app_ecommerce_get_product")
     * 
     * @param ProductRepositoryInterface $productRepository
     * 
     * @return Response
     */
    public function getProduct(
        int $id, 
        ProductRepositoryInterface $productRepository,
        BasketRepositoryInterface $basketRepository): Response
    {
        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $product = $productRepository->find($id);

        /** If we don't find the product, throw EntityNotFoundException */
        if (empty($product)) {
            throw new EntityNotFoundException("Product not found");
        }

        /** Obtain basket (if we are logged and have it one) */
        if (!empty($this->getUser())) {
            $basket = $basketRepository->findOneBy(["userId" => $this->getUser()->getId()]);
        }

        return $this->render('shop/product.html.twig', [
            'product' => $product,
            'basket'   => !empty($basket) ? $basket : null
        ]);

    }

}
