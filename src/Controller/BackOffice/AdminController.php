<?php

namespace App\Controller\BackOffice;

use App\Interfaces\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", methods={"GET"}, name="app_ecommerce_get_listing_admin")
     * 
     * @param ProductRepositoryInterface $productRepository
     * 
     * @return Response
     */
    public function listing(ProductRepositoryInterface $productRepository): Response
    {
        /** If we are not ROLE_SUPER_ADMIN, we redirect to shopping products */
        try {
            $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'User tried to access admin without having ROLE_SUPER_ADMIN');
        } catch (AccessDeniedException $e) {
            return $this->redirectToRoute('app_ecommerce_get_products');
        }

        /** Obtain all products with ProductRepositoryInterface throught DIP */
        $products = $productRepository->findAll();

        return $this->render('backOffice/products.html.twig', [
            'products' => $products
        ]);

    }

}
