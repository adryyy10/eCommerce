<?php

namespace App\Controller\Product;

use App\Entity\Product;
use App\Interfaces\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UpdateController extends AbstractController
{

    /**
     * 
     * @Route("/updateProduct", name="app_back_office_update_product")
     * 
     */
    public function updatePRoduct(
        ProductRepositoryInterface $productRepository,
        Request $request
    ) {
            /** If we are not ROLE_SUPER_ADMIN, we redirect to shopping products */
            try {
                $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'User tried to access admin without having ROLE_SUPER_ADMIN');
            } catch (AccessDeniedException $e) {
                return $this->redirectToRoute('app_ecommerce_get_products');
            }
    
            $id             = (int)$request->get('productId');
            $title          = $request->get('productTitle');
            $description    = $request->get('productDescription');
            $price          = (float)$request->get('productPrice');

            $product = $productRepository->find($id);

            if (empty($product)) {
                throw new EntityNotFoundException("Product doesn't exist");
            }

            /** Update product */
            $product = Product::update($product, $title, $description, $price);
            $productRepository->flush();

            /** Return to admin */
            return $this->redirectToRoute("app_ecommerce_get_listing_admin");
    }

}
