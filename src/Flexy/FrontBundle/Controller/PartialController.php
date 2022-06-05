<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Form\Student\RegisterStudentType;
use App\Flexy\FrontBundle\Repository\CategoryProductFrontRepository;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use App\Flexy\FrontBundle\Repository\PageRepository;
use App\Flexy\FrontBundle\Repository\PubBannerRepository;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\SchoolBundle\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class PartialController extends AbstractController
{
    #[Route('/header', name: 'front_header')]
    public function header(
        PageRepository $pageRepository
        
        ): Response
    {


        return $this->render('@Flexy\FrontBundle/templates/_header.html.twig', [
            
            'pages'=> $pageRepository->findBy(["type"=>"page"],["position"=>"ASC"]),
            'pagesNiveau'=> $pageRepository->findBy(["type"=>"pageniveau"],["position"=>"ASC"]),
            'pagesVie'=> $pageRepository->findBy(["type"=>"pagevie"],["position"=>"ASC"])
        ]);
    }



    #[Route('/footer', name: 'front_footer')]
    public function footer(
        PageRepository $pageRepository
        
        ): Response
    {


        return $this->render('@Flexy\FrontBundle/templates/_footer.html.twig', [
            
            'pages'=> $pageRepository->findBy(["type"=>"page"],["position"=>"ASC"]),
            'pagesNiveau'=> $pageRepository->findBy(["type"=>"pageniveau"],["position"=>"ASC"]),
            'pagesVie'=> $pageRepository->findBy(["type"=>"pagevie"],["position"=>"ASC"])
        ]);
    }



    #[Route('/register-form', name: 'app_register_form')]
    public function app_register_form(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $student = new Student();
        $form = $this->createForm(RegisterStudentType::class, $student);
        $form->handleRequest($request);

        




        return $this->render('@Flexy/FrontBundle/templates/myaccount/_formInscription.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


}
