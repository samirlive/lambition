<?php

namespace App\Flexy\BillardsBundle\Controller;

use App\Controller\Admin\DashboardController as AdminDashboardController;
use App\Entity\Product;
use App\Entity\Table;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        return [];
        yield MenuItem::section('BillardsClub');
        yield MenuItem::linkToUrl('Test', 'fas fa-tachometer-alt',"#");
        
        
        
        

        
    }
}
