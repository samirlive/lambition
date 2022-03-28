<?php

namespace App\Flexy\BookingBundle\Controller;

use App\Flexy\BookingBundle\Entity\CategoryOffer;
use App\Flexy\BookingBundle\Entity\Offer;
use App\Flexy\BookingBundle\Entity\Reservation;
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
        yield MenuItem::section('Services');
        yield MenuItem::linkToCrud("Offers","fas fa-edit",Offer::class);
        yield MenuItem::linkToCrud("Reservations","fas fa-edit",Reservation::class);
        yield MenuItem::linkToCrud("Categories Offers","fas fa-edit",CategoryOffer::class);
        
        
        
        

        
    }
}
