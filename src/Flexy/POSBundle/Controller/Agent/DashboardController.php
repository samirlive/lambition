<?php

namespace App\Flexy\POSBundle\Controller\Agent;



use App\Flexy\POSBundle\Entity\Caisse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



    /**
     * @Route("/agentpos")
     * @Security("is_granted('ROLE_USER')")
     */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="agent")
     */
    public function index(): Response
    {
        
        return parent::index();
    }

   

    public function configureMenuItems(): iterable
    {
        

        

        yield MenuItem::section('POS Caisse Compte Agent');
        yield MenuItem::linkToCrud('Caisse', 'fa fa-tags', Caisse::class);
        
        
        
        

        
    }
}
