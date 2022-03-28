<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Entity\PubBanner;
use App\Flexy\FrontBundle\Repository\CategoryProductFrontRepository;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use App\Flexy\FrontBundle\Repository\OfferRepository;
use App\Flexy\FrontBundle\Repository\PubBannerRepository;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ShopBundle\Entity\Product\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking')]
class BookingController extends AbstractController
{
    #[Route('/', name: 'index_booking')]
    public function index(
        OfferRepository $offerRepository,
        
        ): Response
    {
        $offers = $offerRepository->findByValid();
        return $this->render('@Flexy\FrontBundle/templates/booking/index.html.twig', [
            'offers' => $offers,
            
        ]);
    }


    #[Route('/single-offer/{id}', name: 'single_offer')]
    public function singleOffer(
        Product $offer,
        
        ): Response
    {
        
        return $this->render('@Flexy\FrontBundle/templates/booking/singleOffer/singleOffer.html.twig', [
            'singleOffer' => $offer,
            
        ]);
    }


}
