<?php

namespace App\Controller\Product;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetController extends AbstractController
{

    /**
     * @route("/products", methods={"GET"}, name="app_ecommerce_get_products")
     * 
     * @return Response
     */
    public function getProducts(ManagerRegistry $doctrine): Response
    {

        $products = $doctrine->getRepository(Product::class)->findAll();

        return $this->render('products.html.twig', [
            'products' => $products
        ]);

    }

}
