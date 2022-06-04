<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\CategoryProductFrontRepository;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use App\Flexy\FrontBundle\Repository\PageRepository;
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
        PageRepository $pageRepository
        
        ): Response
    {


        return $this->render('@Flexy\FrontBundle/templates/_header.html.twig', [
            
            'pages'=> $pageRepository->findBy(["type"=>"page"],["position"=>"ASC"]),
            'pagesNiveau'=> $pageRepository->findBy(["type"=>"pageniveau"],["position"=>"ASC"]),
            'pagesVie'=> $pageRepository->findBy(["type"=>"pagevie"],["position"=>"ASC"])
        ]);
    }


}
