<?php

namespace App\Controller\Basket;

use App\Interfaces\Basket\BasketRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetController extends AbstractController
{

    /**
     * @Route("/basket/{id}", methods={"GET"}, name="app_shop_get_basket")
     * 
     * @param int $id
     * @param BasketRepositoryInterface $basketRepository
     * 
     * @return Response
     */
    public function getBasket(int $id, BasketRepositoryInterface $basketRepository): Response
    {
        $basket = $basketRepository->find($id);

        return $this->render('shop/basket-profile.html.twig', [
            "basket" => $basket
        ]);
    }

}
