<?php

namespace App\Controller\Basket;

use App\Interfaces\Basket\BasketRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetController extends AbstractController
{

    /**
     * @Route("/basket", methods={"GET"}, name="app_shop_get_basket")
     * 
     */
    public function getBasket(int $userId, BasketRepositoryInterface $basketRepository): Response
    {

        $basket = $basketRepository->findOneBy(["userId" => $userId]);

        return $this->render('shop/basket.html.twig', [
            "basket" => $basket
        ]);
    }

}
