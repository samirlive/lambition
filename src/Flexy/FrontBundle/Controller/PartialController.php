<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\CategoryProductFrontRepository;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use App\Flexy\FrontBundle\Repository\PubBannerRepository;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PartialController extends AbstractController
{
    #[Route('/header', name: 'front_header')]
    public function header(
        CategoryProductFrontRepository $categoryProductFrontRepository
        
        ): Response
    {


        return $this->render('@Flexy\FrontBundle/templates/_header.html.twig', [
            
            'categoriesProduct'=> $categoryProductFrontRepository->findBy(["parentCategory"=>null])
        ]);
    }


}
