<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Entity\PubBanner;
use App\Flexy\FrontBundle\Repository\CategoryProductFrontRepository;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use App\Flexy\FrontBundle\Repository\PubBannerRepository;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\FrontBundle\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'front_home')]
    public function index(
        ProductFrontRepository $productRepository,
        MasterSliderRepository $masterSliderRepository,
        PubBannerRepository $pubBannerRepository,
        CategoryProductFrontRepository $categoryProductFrontRepository,
        TestimonialRepository $testimonialRepository
        
        ): Response
    {


        $deals = $productRepository->findDeals();


        

        

        return $this->render('@Flexy\FrontBundle/templates/home/index.html.twig', [
            'products' => $productRepository->findAll(),
            'masterSliders'=> $masterSliderRepository->findBy(["isEnabled"=>true]),
            'pubBanners'=> $pubBannerRepository->findBy(["isEnabled"=>true]),
            'deals'=>$deals,
            'categoriesProduct'=> $categoryProductFrontRepository->findBy(["parentCategory"=>null]),
            'testimonials' => $testimonialRepository->findBy(["isEnabled"=>true])
        ]);
    }



    #[Route('/contact', name: 'contact')]
    public function contact(ProductRepository $productRepository): Response
    {
        return $this->render('@Flexy\FrontBundle/templates/home/contact.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }



    #[Route('/banner-block/{id}', name: 'pubBannerBlock')]
    public function pubBannerBlock(PubBanner $pubBanner): Response
    {
        return $this->render('@Flexy\FrontBundle/templates/include-pubs/_singlePubBanner.html.twig', [
            'singleBanner' => $pubBanner,
        ]);
    }
}
