<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pages')]
class PagesController extends AbstractController
{
    #[Route('/about-us', name: 'about_us')]
    public function about_us(ProductRepository $productRepository): Response
    {
        return $this->render('@Flexy\FrontBundle/templates/pages/about-us.html.twig');
    }



    #[Route('/contact', name: 'front_contact')]
    public function contact(ProductRepository $productRepository): Response
    {
        return $this->render('@Flexy\FrontBundle/templates/home/contact.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
}
