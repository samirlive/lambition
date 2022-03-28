<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Entity\User;
use App\Flexy\FrontBundle\Form\Customer\CustomerAddressType;
use App\Flexy\FrontBundle\Form\RegistrationCustomerPasswordFormType;
use App\Flexy\FrontBundle\Form\RegistrationCustomerFormType;
use App\Flexy\FrontBundle\Form\RegistrationCustomerProfilFormType;
use App\Flexy\FrontBundle\Form\RegistrationVendorFormType;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Customer\CustomerAddress;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Product\Comment;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use App\Flexy\ShopBundle\Repository\Customer\CustomerRepository;
use App\Flexy\ShopBundle\Repository\Order\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


#[Route('/account')]
class MyAccountController extends AbstractController
{
    #[Route('/login-register', name: 'login_register')]
    public function register(
        Request $request,
         UserPasswordHasherInterface $userPasswordHasher,
          EntityManagerInterface $entityManager,
          AuthenticationUtils $authenticationUtils
          ): Response
    {


        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if($hasAccess){
            return $this->redirectToRoute("myaccount");
        }


        

        // Auth

        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        

        // Register
        $user = new User();
        $vendor = new Vendor();
        $formVendor = $this->createForm(RegistrationVendorFormType::class, $vendor);
        $formVendor->handleRequest($request);

        $customer = new Customer();
        $formCustomer = $this->createForm(RegistrationCustomerFormType::class, $customer);
        $formCustomer->handleRequest($request);

        if ($formVendor->isSubmitted() && $formVendor->isValid()) {
            // encode the plain password

            //dd($vendor);
            $user->setUsername($formVendor->get('simulateUsername')->getData());
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $formVendor->get('simulatePassword')->getData()
                )
            );
            $user->setRoles(["ROLE_VENDOR"]);
            $vendor->setUser($user);
            $entityManager->persist($vendor);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }


        if ($formCustomer->isSubmitted() && $formCustomer->isValid()) {
            // encode the plain password

            $user->setIsValid(true);
            $user->setUsername($formCustomer->get('simulateUsername')->getData());
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $formCustomer->get('simulatePassword')->getData()
                )
            );
            $user->setRoles(["ROLE_CUSTOMER"]);
            $customer->setUser($user);
            $entityManager->persist($customer);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }

        return $this->render('@Flexy/FrontBundle/templates/myaccount/login-register.html.twig', [
            'registrationVendorForm' => $formVendor->createView(),
            'registrationCustomerForm' => $formCustomer->createView(),
            'last_username' => $lastUsername,
             'error' => $error
        ]);
    }


    #[Route('/editMyPassword', name: 'editpassword')]
    public function editpassword( 
        Request $request,
          UserPasswordHasherInterface $userPasswordHasher,
          EntityManagerInterface $entityManager,
          AuthenticationUtils $authenticationUtils,
          CustomerRepository $customerRepository,

          ): Response
    {
        $customer = $customerRepository->findOneBy(["user"=>$this->getUser()]);

        $formCustomer = $this->createForm(RegistrationCustomerPasswordFormType::class, $customer);
     
        return $this->render('@Flexy/FrontBundle/templates/myaccount/editMyPassword.html.twig', [
             
            'registrationCustomerForm' => $formCustomer->createView(),
            "customer"=>$customer,
            
             
        ]);

    }
  

    #[Route('/myaccount', name: 'myaccount')]
    public function myaccount(
        CustomerRepository $customerRepository,
        OrderRepository $orderRepository,
         Request $request,
         
         ): Response
    {
        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if(!$hasAccess){
            return $this->redirectToRoute("login_register");
        }

        $customer = $customerRepository->findOneBy(["user"=>$this->getUser()]);
        $orders = $orderRepository->findBy(["customer"=>$customer]);



        return $this->render('@Flexy/FrontBundle/templates/myaccount/myaccount.html.twig',[
            "customer"=>$customer,
            "orders"=>$orders
        ]);
    }

    

    #[Route('/edit-myaccount', name: 'edit_myaccount')]
    public function edit_myaccount(
        CustomerRepository $customerRepository,
        OrderRepository $orderRepository,
        Request $request,         
         ): Response
    {
        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if(!$hasAccess){
            return $this->redirectToRoute("login_register");
        }

        $customer = $customerRepository->findOneBy(["user"=>$this->getUser()]);
       

        $formCustomer = $this->createForm(RegistrationCustomerProfilFormType::class, $customer);
        $formCustomer->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($formCustomer->isSubmitted()) {
               // dd($formCustomer->get('firstName')->getData());

                $customer->setFirstName($formCustomer->get('firstName')->getData());
                $customer->setLastName($formCustomer->get('lastName')->getData());
                $customer->setEmail($formCustomer->get('email')->getData());
                $customer->setGender($formCustomer->get('gender')->getData());
                $customer->setPhone($formCustomer->get('phone')->getData());
                $em = $this->getDoctrine()->getManager();
                $em->persist($customer);
                $em->flush();
                $this->addFlash("success","Vos informations personnelles ont été enregistrées"); 
                
                return $this->redirectToRoute('edit_myaccount');  
        
             
        }


        }

         
  

        $customer = $customerRepository->findOneBy(["user"=>$this->getUser()]);
        $orders = $orderRepository->findBy(["customer"=>$customer]);


        return $this->render('@Flexy/FrontBundle/templates/myaccount/editMyAccount.html.twig',[
            "customer"=>$customer,
            "orders"=>$orders,
            "registrationCustomerForm"=>$formCustomer->createView()
            
        ]);
    }

  
    #[Route('/my-address-delete/{id}',name: 'delete_address') ]
    
    public function delete(Request $request,CustomerAddress $customerAddress): Response
    {

       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customerAddress);
            $entityManager->flush();
       
        $this->addFlash("success","Votre adresse a été Supprimer"); 
        return $this->redirectToRoute('my_customer_address');
    }



    #[Route('/my-customer-address', name: 'my_customer_address', defaults:  ['id' => null]) ]
    #[Route('/my-customer-address/{id}') ]
    public function add_customer_address(
        CustomerAddress $customerAddress = null,
        CustomerRepository $customerRepository,
        Request $request,         
         ): Response
    {
        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if(!$hasAccess){
            return $this->redirectToRoute("login_register");
        }

        if(!$customerAddress){
            $customerAddress = new CustomerAddress();
        }
        

        $customer = $customerRepository->findOneBy(["user"=>$this->getUser()]);
       

        $formCustomerAddress = $this->createForm(CustomerAddressType::class, $customerAddress);
        $formCustomerAddress->handleRequest($request);

        
                if ($formCustomerAddress->isSubmitted() && $formCustomerAddress->isValid()) {
                
                    //dd($customerAddress);
                    $customerAddress->setCustomer($customer);
                    $customerAddress->setCountry("Maroc");
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($customerAddress);
                    $em->flush();
                    $this->addFlash("success","Vos informations personnelles adresse ont été enregistrées"); 
                    return $this->redirectToRoute('my_customer_address');  
                  
            }

        return $this->render('@Flexy/FrontBundle/templates/myaccount/myAddresses.html.twig',[
            "customer"=>$customer,
            "customAddress"=>$customerAddress,
            "formCustomerAddress"=>$formCustomerAddress->createView()
            
        ]);
    }


    #[Route('/order-details/{id}', name: 'customer_order_detail')]
    public function customer_order_detail(
        Order $order,
       
         ): Response
    {
        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if(!$hasAccess){
            return $this->redirectToRoute("login_register");
        }


        return $this->render('@Flexy/FrontBundle/templates/myaccount/orderDetail.html.twig',[
            "order"=>$order
        ]);
    }

    #[Route('/comment-product/{id}', name: 'comment_product')]
    public function comment_product(
        CustomerRepository $customerRepository,
        Product $product,
       Request $request
         ): Response
    {
        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if(!$hasAccess){
            return $this->redirectToRoute("login_register");
        }
        $em = $this->getDoctrine()->getManager();



        $customer = $customerRepository->findOneBy(["user"=>$this->getUser()]);
        $comment = new Comment();
        $comment->setRating((int)$request->request->get("rating"));
        $comment->setComment($request->request->get("comment"));
        $comment->setProduct($product);
        $comment->setCustomer($customer);

        $em->persist($comment);
        $em->flush();
        

       return $this->redirectToRoute("single_product",["id"=>$product->getId()]);
    }


}

