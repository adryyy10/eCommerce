<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{

    /**
     * @Route("/productForm", name="app_back_office_new_product_form")
     */
    public function newProductForm(): Response
    {
        return $this->render("backOffice/new--product.html.twig", []);
    }

}
