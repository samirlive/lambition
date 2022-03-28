<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Entity\User;
use App\Flexy\FrontBundle\Form\RegistrationCustomerFormType;
use App\Flexy\FrontBundle\Form\RegistrationVendorFormType;
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

        $user = new User();
        $formVendor = $this->createForm(RegistrationVendorFormType::class, $user);
        $formVendor->handleRequest($request);

        $formCustomer = $this->createForm(RegistrationCustomerFormType::class, $user);
        $formCustomer->handleRequest($request);

        if ($formVendor->isSubmitted() && $formVendor->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $formVendor->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }


        if ($formCustomer->isSubmitted() && $formCustomer->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $formCustomer->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }

        return $this->render('@Flexy/FrontBundle/templates/myaccount/login-register.html.twig', [
            'registrationVendorForm' => $formVendor->createView(),
            'registrationCustomerForm' => $formCustomer->createView(),
        ]);
    }
}
