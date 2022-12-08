<?php

namespace App\Controller\BackOffice\Basket;

use App\Interfaces\Basket\BasketRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin/baskets", methods={"GET"}, name="app_ecommerce_get_basket_listing_admin")
     */
    public function getBaskets(BasketRepositoryInterface $basketRepository): Response
    {

        /** If we are not ROLE_SUPER_ADMIN, we redirect to shopping products */
        try {
            $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'User tried to access admin without having ROLE_SUPER_ADMIN');
        } catch (AccessDeniedException $e) {
            return $this->redirectToRoute('app_ecommerce_get_products');
        }

        $baskets = $basketRepository->findAll();

        return $this->render('backOffice/baskets.html.twig',[
            'baskets' => $baskets
        ]);

    }

}
