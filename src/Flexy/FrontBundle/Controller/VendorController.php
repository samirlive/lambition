<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop/vendors')]
class VendorController extends AbstractController
{
    #[Route('/single-vendor/{id}', name: 'single_vendor')]
    public function single(
        Vendor $vendor,
    ProductFrontRepository $productFrontRepository,
    EntityManagerInterface $em, 
    PaginatorInterface $paginator, 
    Request $request
    ): Response
    {

        $dql   = "SELECT product FROM App\Flexy\ShopBundle\Entity\Product\Product product LEFT  JOIN product.vendor vendor WHERE vendor.id =  ".$vendor->getId()." AND  product.isPublished = TRUE";
        $query = $em->createQuery($dql);
        

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        return $this->render('@Flexy\FrontBundle/templates/vendors/singleVendor.html.twig', [
            'vendor' => $vendor,
            'products'=>$pagination

        ]);
    }
}
