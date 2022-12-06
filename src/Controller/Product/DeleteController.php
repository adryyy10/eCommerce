<?php

namespace App\Controller\Product;

use App\Interfaces\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{

    /**
     * @Route("/removeProduct", methods={"DELETE"}, name="app_back_office_remove_product")
     */
    public function delete(int $id, ProductRepositoryInterface $productRepository)
    {
        /** If we are not ROLE_SUPER_ADMIN, we redirect to shopping products */
        try {
            $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'User tried to access admin without having ROLE_SUPER_ADMIN');
        } catch (AccessDeniedException $e) {
            return $this->redirectToRoute('app_ecommerce_get_products');
        }

        /** Find product */
        $product = $productRepository->find($id);
        
        /** Remove + flush */
        $productRepository->remove($product, true);
    }
}
