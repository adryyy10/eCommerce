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

    public ProductRepositoryInterface $productRepository;
    public BasketRepositoryInterface $basketRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository, 
        BasketRepositoryInterface $basketRepository
    ) {
        $this->productRepository = $productRepository;
        $this->basketRepository = $basketRepository;
    }

    /**
     * @route("/products", methods={"GET"}, name="app_ecommerce_get_products")
     * 
     * @param ProductRepositoryInterface $productRepository
     * 
     * @return Response
     */
    public function getProducts(): Response
    {
        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $products = $this->productRepository->findAll();

        /** Obtain basket (if we are logged and have it one) */
        if (!empty($this->getUser())) {
            $basket = $this->basketRepository->findOneBy(["userId" => $this->getUser()->getId()]);
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
    public function getProduct(int $id): Response
    {
        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $product = $this->productRepository->find($id);

        /** If we don't find the product, throw EntityNotFoundException */
        if (empty($product)) {
            throw new EntityNotFoundException("Product not found");
        }

        /** Obtain basket (if we are logged and have it one) */
        if (!empty($this->getUser())) {
            $basket = $this->basketRepository->findOneBy(["userId" => $this->getUser()->getId()]);
        }

        return $this->render('shop/product.html.twig', [
            'product' => $product,
            'basket'   => !empty($basket) ? $basket : null
        ]);

    }

}
