<?php

namespace App\Controller\BackOffice\Product;

use App\Interfaces\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{

    /**
     * @Route("/productForm/{id}", name="app_back_office_new_product_form")
     * 
     */
    public function newProductForm(int $id = null, ProductRepositoryInterface $productRepository): Response
    {

        if (!empty($id)) {
            $product = $productRepository->find($id);
        }

        return $this->render("backOffice/new--product.html.twig", [
            'product' => (!empty($product)) ? $product : null
        ]);
    }

}
