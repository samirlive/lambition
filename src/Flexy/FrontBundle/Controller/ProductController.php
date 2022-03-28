<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Repository\Shipping\CityRepository;
use App\Repository\Flexy\ShopBundle\Entity\Shipping\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop')]
class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'single_product')]
    public function singleProduct(Product $product,ProductFrontRepository $productFrontRepository,CityRepository $cityRepository,DepartementRepository $departementRepository): Response
    {
        return $this->render('@Flexy\FrontBundle/templates/products/singleProduct.html.twig', [
            'singleProduct' => $product,
            'associatedProducts'=>$productFrontRepository->findAll(),
            'cities'=>$cityRepository->findAll(),
            'departements'=>$departementRepository->findAll()
        ]);
    }
}
