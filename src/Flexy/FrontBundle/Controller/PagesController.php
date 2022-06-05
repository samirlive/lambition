<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\PageRepository;
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


    #[Route('/{slug}', name: 'front_page')]
    public function front_primaire($slug,PageRepository $pageRepository): Response
    {
        
        return $this->render('@Flexy\FrontBundle/templates/pages/page.html.twig', [
            'page' => $pageRepository->findOneBy(['slug'=>$slug]),
        ]);
    }


}
