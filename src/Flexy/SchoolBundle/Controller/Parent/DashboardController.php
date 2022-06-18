<?php

namespace App\Flexy\SchoolBundle\Controller\Parent;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
   
    #[Route('/admin/parent', name: 'app_parent')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<img  style="margin:16px 0 20px 14px" src="../lambition/admin/logo.png" width="150px" />')
        // ->setFaviconPath('flexy/img/favicon-flexy-white.png')
         ->setTranslationDomain('admin');
         
    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addHtmlContentToHead('<style>
            .sidebar{
                background: linear-gradient(-150deg, #9ebd13 0%, #008552 100%);
            }
        </style>');
    }

    public function configureMenuItems(): iterable
    {
       
        
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Mes sessions',"fas fa-edit",Session::class);
        yield MenuItem::linkToCrud('Mes Examens',"fas fa-edit",Exam::class);
        yield MenuItem::linkToCrud('Mes Bulletins',"fas fa-edit",Bulletin::class);
        yield MenuItem::linkToCrud('Mes devoirs',"fas fa-edit",HomeWork::class);
        
    }
}
