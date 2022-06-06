<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\Bulletin;
use App\Flexy\SchoolBundle\Entity\Event;
use App\Flexy\SchoolBundle\Entity\Exam;
use App\Flexy\SchoolBundle\Entity\HomeWork;
use App\Flexy\SchoolBundle\Entity\Payment;
use App\Flexy\SchoolBundle\Entity\SchoolClass;
use App\Flexy\SchoolBundle\Entity\SchoolSubject;
use App\Flexy\SchoolBundle\Entity\SchoolYear;
use App\Flexy\SchoolBundle\Entity\Session;
use App\Flexy\SchoolBundle\Entity\Student;
use App\Flexy\SchoolBundle\Entity\StudentParent;
use App\Flexy\SchoolBundle\Entity\Teacher;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        //return [];
        yield MenuItem::section('School');
        yield MenuItem::linkToCrud('Student',"fas fa-edit",Student::class);
        yield MenuItem::linkToCrud('Teacher',"fas fa-edit",Teacher::class);
        yield MenuItem::linkToCrud('StudentParent',"fas fa-edit",StudentParent::class);
        yield MenuItem::linkToCrud('Class',"fas fa-edit",SchoolClass::class);
        yield MenuItem::linkToCrud('SchoolSubject',"fas fa-edit",SchoolSubject::class);
        yield MenuItem::linkToCrud('SchoolYear',"fas fa-edit",SchoolYear::class);
        yield MenuItem::linkToCrud('Session',"fas fa-edit",Session::class);
        yield MenuItem::linkToCrud('Exam',"fas fa-edit",Exam::class);
        yield MenuItem::linkToCrud('Bulletin',"fas fa-edit",Bulletin::class);
        yield MenuItem::linkToCrud('HomeWork',"fas fa-edit",HomeWork::class);
        yield MenuItem::linkToCrud('Events',"fas fa-edit",Event::class);
        
        
        
        

        
    }
}
