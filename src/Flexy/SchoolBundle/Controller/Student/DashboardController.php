<?php

namespace App\Flexy\SchoolBundle\Controller\Student;

use App\Flexy\SchoolBundle\Entity\Bulletin;
use App\Flexy\SchoolBundle\Entity\Event;
use App\Flexy\SchoolBundle\Entity\Exam;
use App\Flexy\SchoolBundle\Entity\HomeWork;
use App\Flexy\SchoolBundle\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
   
    #[Route('/admin/etudiant', name: 'app_student')]
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
                background: linear-gradient(150deg, #0491af 0%, #3a47d5 100%);
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
