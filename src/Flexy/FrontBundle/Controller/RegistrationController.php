<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Entity\User;
use App\Flexy\FrontBundle\Form\Student\RegisterStudentType;
use App\Flexy\SchoolBundle\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $student = new Student();
        $form = $this->createForm(RegisterStudentType::class, $student);
        $form->handleRequest($request);

        




        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            

            $entityManager->persist($student);
            $entityManager->flush();
            $this->addFlash("success","l'inscription est effectuée avec succès");
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }

        return $this->render('@Flexy/FrontBundle/templates/myaccount/login-register.html.twig');
    }
}
