<?php

namespace App\Controller\Product;

use App\Interfaces\Product\ProductRepositoryInterface;
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
    public function getProducts(ProductRepositoryInterface $productRepository): Response
    {
        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $products = $productRepository->findAll();

        return $this->render('shop/products.html.twig', [
            'products' => $products
        ]);

    }

    /**
     * @route("/product/{id}", methods={"GET"}, name="app_ecommerce_get_product")
     * 
     * @param ProductRepositoryInterface $productRepository
     * 
     * @return Response
     */
    public function getProduct(int $id, ProductRepositoryInterface $productRepository): Response
    {
        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $product = $productRepository->find($id);

        return $this->render('shop/product.html.twig', [
            'product' => $product
        ]);

    }

}
