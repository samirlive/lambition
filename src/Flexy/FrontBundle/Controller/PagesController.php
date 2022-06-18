<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Entity\Notification;
use App\Flexy\FrontBundle\Repository\PageRepository;
use App\Flexy\SchoolBundle\Repository\EventRepository;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use App\Form\ContactNotifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pages')]
class PagesController extends AbstractController
{
    #[Route('/about-us', name: 'about_us')]
    public function about_us(ProductRepository $productRepository): Response
    {
        return $this->render('@Flexy\FrontBundle/templates/pages/about-us.html.twig');
    }



    
   


    #[Route('/contact', name: 'front_contact')]
    public function front_contact(HttpFoundationRequest $request,  EntityManagerInterface $entityManager): Response
    {

        $notifMessage = new Notification();
        $form = $this->createForm(ContactNotifType::class, $notifMessage);
        $form->handleRequest($request);

        




        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            

            $entityManager->persist($notifMessage);
            $entityManager->flush();
            $this->addFlash("success","l'inscription est effectuée avec succès");
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }

        return $this->render('@Flexy/FrontBundle/templates/home/contact.html.twig',["form"=>$form->createView()]);
    }



    #[Route('/postulez', name: 'front_hireme')]
    public function front_hireme(HttpFoundationRequest $request,  EntityManagerInterface $entityManager): Response
    {

        $notifMessage = new Notification();
        $form = $this->createForm(ContactNotifType::class, $notifMessage);
        $form->handleRequest($request);

        




        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            

            $entityManager->persist($notifMessage);
            $entityManager->flush();
            $this->addFlash("success","l'inscription est effectuée avec succès");
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }

        return $this->render('@Flexy/FrontBundle/templates/home/postulez.html.twig',["form"=>$form->createView()]);
    }


    #[Route('/{slug}', name: 'front_page')]
    public function front_page($slug,PageRepository $pageRepository): Response
    {
        $page = $pageRepository->findOneBy(['slug'=>$slug]);
        $templatePath ="pages/page.html.twig";
        if($page->getCustomTemplatePath()){
            $templatePath =$page->getCustomTemplatePath();
        }
        return $this->render('@Flexy\FrontBundle/templates/'. $templatePath, [
            'page' => $page,
        ]);
    }


    #[Route('/event/{slug}', name: 'front_event')]
    public function front_event($slug,EventRepository $eventRepository): Response
    {
        
        return $this->render('@Flexy\FrontBundle/templates/pages/event.html.twig', [
            'event' => $eventRepository->findOneBy(['slug'=>$slug]),
        ]);
    }


}
