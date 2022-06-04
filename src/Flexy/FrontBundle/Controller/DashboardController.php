<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Entity\CategoryPage;
use App\Flexy\FrontBundle\Entity\MasterSlider;
use App\Flexy\FrontBundle\Entity\Page;
use App\Flexy\FrontBundle\Entity\PubBanner;
use App\Flexy\FrontBundle\Entity\Testimonial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::section('Contenu web');
        //yield MenuItem::linkToCrud('Master Slider',"fas fa-images",MasterSlider::class);
        //yield MenuItem::linkToCrud('Banniéres pubs',"fas fa-chalkboard",PubBanner::class);
        yield MenuItem::linkToCrud('Pages',"fas fa-chalkboard",Page::class);
        yield MenuItem::linkToCrud('Categories Pages',"fas fa-chalkboard",CategoryPage::class);
        yield MenuItem::linkToCrud('Témoignages',"fas fa-chalkboard",Testimonial::class);
        yield MenuItem::linkToRoute('Site web',"fas fa-eye","front_home");
        
        
        
        

        
    }
}
