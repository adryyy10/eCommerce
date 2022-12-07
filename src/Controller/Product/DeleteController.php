<?php

namespace App\Controller\Product;

use App\Interfaces\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{

    /**
     * @Route("/removeProduct/{id}", name="app_back_office_remove_product")
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

        /** Throw exception in case we don't find the product */
        if (empty($product)) {
            throw new EntityNotFoundException('No product found');
        }
        
        /** Remove + flush */
        $productRepository->remove($product, true);

        /** Return to admin */
        return $this->redirectToRoute("app_ecommerce_get_listing_admin");
    }
}
