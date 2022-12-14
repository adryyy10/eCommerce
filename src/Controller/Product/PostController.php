<?php

namespace App\Controller\Product;

use App\Entity\Product;
use App\Interfaces\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    public ProductRepositoryInterface $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/addProduct", methods={"POST"}, name="app_back_office_add_product")
     * 
     * @param Request $request
     * 
     */
    public function add(Request $request)
    {

        /** If we are not ROLE_SUPER_ADMIN, we redirect to shopping products */
        /*try {
            $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'User tried to access admin without having ROLE_SUPER_ADMIN');
        } catch (AccessDeniedException $e) {
            return $this->redirectToRoute('app_ecommerce_get_products');
        }*/

        $title          = $request->get('productTitle');
        $description    = $request->get('productDescription');
        $price          = (float)$request->get('productPrice');

        /** This method creates an instance of Product and sets all the parameters so they can be saved later */
        $product = Product::create($title, $description, $price);

        /** Persist + flush in DB */
        $this->productRepository->add($product, true);

        /** Return to admin */
        return $this->redirectToRoute("app_ecommerce_get_product_listing_admin");
    }

}
