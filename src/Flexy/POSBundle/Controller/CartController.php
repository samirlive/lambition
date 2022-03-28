<?php

namespace App\Flexy\POSBundle\Controller;

use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Flexy\POSBundle\Repository\TableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CartController extends AbstractController
{
    #[Route('/cart', name: 'pos_cart')]
    public function index(ProductRepository $productRepository): Response
    {



        $products = $productRepository->findAll();
        return $this->render('@Flexy/POSBundle/templates/cart/index.html.twig', [
            'products' => $products,
        ]);
    }


    #[Route('/tables', name: 'tables')]
    public function tables(TableRepository $tableRepository): Response
    {

        $tables = $tableRepository->findAll();
        return $this->render('@Flexy/POSBundle/templates/cart/tables.html.twig', [
            'tables' => $tables,
        ]);
    }

    
}
