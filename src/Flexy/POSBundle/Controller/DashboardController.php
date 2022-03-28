<?php

namespace App\Flexy\POSBundle\Controller;

use App\Controller\Admin\DashboardController as AdminDashboardController;
use App\Entity\Product;
use App\Flexy\POSBundle\Entity\Table;
use App\Flexy\POSBundle\Entity\Caisse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Flexy\BillardsBundle\Controller\BillardsDashboardController as BillardsDashboardController;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        

        return [];

        yield MenuItem::section('POS Caisse');
        yield MenuItem::linkToCrud('Caisse', 'fa fa-tags', Caisse::class);
        yield MenuItem::linkToRoute('Panier', 'fas fa-shopping-cart', "pos_cart");
        yield MenuItem::subMenu('Tables', 'fas fa-swatchbook')->setSubItems([
            MenuItem::linkToCrud('Gestion des tables', 'fas fa-users', Table::class),
            MenuItem::linkToRoute('Réservation', 'fas fa-shopping-cart', "tables"),
        ]);
        
        
        
        

        
    }
}
