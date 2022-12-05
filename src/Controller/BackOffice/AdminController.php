<?php

namespace App\Controller\BackOffice;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @route("/admin", methods={"GET"}, name="app_ecommerce_get_listing_admin")
     * 
     * @return Response
     */
    public function listing(ManagerRegistry $doctrine): Response
    {
        /** If we are not ROLE_SUPER_ADMIN, we redirect to shopping products */
        try {
            $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'User tried to access admin without having ROLE_SUPER_ADMIN');
        } catch (AccessDeniedException $e) {
            return $this->redirectToRoute('app_ecommerce_get_products');
        }

        $products = $doctrine->getRepository(Product::class)->findAll();

        return $this->render('backOffice/products.html.twig', [
            'products' => $products
        ]);

    }

}
