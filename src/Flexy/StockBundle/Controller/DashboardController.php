<?php

namespace App\Flexy\StockBundle\Controller;

use App\Flexy\StockBundle\Entity\Article;
use App\Flexy\StockBundle\Entity\Document;
use App\Flexy\StockBundle\Entity\Stock;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        

        return [];
        yield MenuItem::section('Stock');
        yield MenuItem::linkToCrud("Articles","fas fa-list",Article::class);
        yield MenuItem::linkToCrud("Documents","fas fa-list",Document::class);
        yield MenuItem::linkToCrud("Inventaire","fas fa-list",Stock::class);

        
    }
}
