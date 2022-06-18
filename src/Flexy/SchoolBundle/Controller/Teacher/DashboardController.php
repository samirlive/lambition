<?php

namespace App\Flexy\SchoolBundle\Controller\Teacher;

use App\Flexy\SchoolBundle\Entity\Bulletin;
use App\Flexy\SchoolBundle\Entity\Exam;
use App\Flexy\SchoolBundle\Entity\HomeWork;
use App\Flexy\SchoolBundle\Entity\SchoolClass;
use App\Flexy\SchoolBundle\Entity\Session;
use App\Flexy\SchoolBundle\Entity\Student;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
   
    #[Route('/admin/prof', name: 'app_teacher')]
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
                background: linear-gradient(150deg, #4b6cb7 0%, #182848 100%);
            }
        </style>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Student',"fas fa-edit",Student::class);
        yield MenuItem::linkToCrud('Class',"fas fa-edit",SchoolClass::class);
        yield MenuItem::linkToCrud('Session',"fas fa-edit",Session::class);
        yield MenuItem::linkToCrud('Exam',"fas fa-edit",Exam::class);
        yield MenuItem::linkToCrud('Bulletin',"fas fa-edit",Bulletin::class);
        yield MenuItem::linkToCrud('HomeWork',"fas fa-edit",HomeWork::class);
    }
}
