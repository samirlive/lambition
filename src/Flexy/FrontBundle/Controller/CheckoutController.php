<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Order\OrderItem;
use App\Flexy\ShopBundle\Entity\Product\ProductShop;
use App\Flexy\ShopBundle\Entity\Shipping\City;
use App\Flexy\ShopBundle\Repository\Customer\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Flexy\ShopBundle\Repository\Payment\PaymentMethodRepository;
use App\Flexy\ShopBundle\Repository\Shipping\CityRepository;
use App\Repository\Flexy\ShopBundle\Entity\Customer\CustomerAddressRepository;
use App\Repository\Flexy\ShopBundle\Entity\Shipping\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/shop/checkout')]
class CheckoutController extends AbstractController
{
    #[Route('/', name: 'checkout')]
    public function cart(
        PaymentMethodRepository $paymentMethodRepository,
        CustomerRepository $customerRepository,
        CityRepository $cityRepository
        ): Response
    {

        $hasAccess = $this->isGranted('ROLE_CUSTOMER');

        if(!$hasAccess){
            return $this->redirectToRoute("login_register");
        }


        $currentUser = $this->getUser();

        
            $customer = $customerRepository->findOneBy(["user"=>$currentUser]);
            $cities = $cityRepository->findAll();
            
    

        $paymentMethods = $paymentMethodRepository->findBy(["isEnabled"=>true]);
        return $this->render('@Flexy\FrontBundle/templates/checkout/checkout.html.twig',[
            "paymentMethods"=>$paymentMethods,
            "customer"=>$customer,
            "cities"=> $cities
        ]);
    }

    #[Route('/confirm/ajax', name: 'confirm_checkout_ajax')]
    public function confirmChcekout(
        Request $request,
        PaymentMethodRepository $paymentMethodRepository,
        ProductFrontRepository $productFrontRepository,
        CustomerRepository $customerRepository,
        CustomerAddressRepository $customerAddressRepository,
        DepartementRepository $departementRepository
     ): Response
    {


        $currentUser = $this->getUser();

        if($currentUser){
            $customer = $customerRepository->findOneBy(["user"=>$currentUser]);
            if(!$customer){
                $customer = new Customer();
            }
        }

        
         
        
        
        $firstName = $request->query->get("firstName");
        $lastName = $request->query->get("lastName");
        $companyName = $request->query->get("companyName");
        $address = $request->query->get("address");
        $city = $request->query->get("city");
        $departement = $departementRepository->find((int)$request->query->get("department"))->getName();
        $postcode = $request->query->get("postcode");
        $email = $request->query->get("email");
        $tel = $request->query->get("tel");
        $comment = $request->query->get("comment");
        



        $order = new Order();

        

       


        if($request->query->get("customerAdresseShipping")){


            $customerAddress = $customerAddressRepository->find((int)$request->query->get("customerAdresseShipping"));

            if($customerAddress){

                

                $firstName = $customerAddress->getCustomer()->getFirstName();
                $lastName = $customerAddress->getCustomer()->getLastName();
                $companyName = $customerAddress->getCompanyName();
                $address = $customerAddress->getAddress();
                $city = $customerAddress->getCity();
                $departement = $customerAddress->getDepartement();
                $postcode = $customerAddress->getPostCode();

                if(!$email){
                    $email = $customerAddress->getCustomer()->getEmail();
                }
                if($customerAddress->getEmail()){
                    $email = $customerAddress->getEmail();
                }
                $email = $email ;
                $tel = $customerAddress->getPhone();
            }



        }


        if($request->query->get("isBilling") and $request->query->get("isBilling")=="on"){
            
       

        if($request->query->get("customerAdresseBilling")){


            $customerAddressBilling = $customerAddressRepository->find((int)$request->query->get("customerAdresseBilling"));

            if($customerAddress){

                $firstNameBilling = $customerAddressBilling->getCustomer()->getFirstName();
                $lastNameBilling = $customerAddressBilling->getCustomer()->getLastName();
                $companyNameBilling = $customerAddressBilling->getCompanyName();
                $addressBilling = $customerAddressBilling->getAddress();
                $cityBilling = $customerAddressBilling->getCity();
                $departementBilling = $customerAddressBilling->getDepartement();
                $postcodeBilling = $customerAddressBilling->getPostCode();
                if(!$email){
                    $email = $customerAddress->getCustomer()->getEmail();
                }
                if($customerAddress->getEmail()){
                    $email = $customerAddress->getEmail();
                }
                $emailBilling = $email ;
                $telBilling = $customerAddressBilling->getPhone();
            }

        //Billing : BySamir
        //Il manque la creation de facturation dans l'order

        }
    }


        $order->setFirstName($firstName);
        $order->setLastName($lastName);
        $order->setCompanyName($companyName);
        $order->setAddress($address);
        $order->setCity($city);
        $order->setCountry("Maroc");
        $order->setDepartment($departement);
        $order->setPostcode($postcode);
        $order->setEmail($email);
        $order->setTel($tel);
        $order->setComment($comment);
        foreach((array)$request->query->get("orderItems") as $singleOrderItem){
            $orderItem = new OrderItem();
            $product = $productFrontRepository->find((int)$singleOrderItem["id"]);

            // TODO BySamir : Check if product in DB
            // TODO BySamir : Check if stock existe 
            // TODO BySamir : Else redirection to message
            
            if($product){
                $orderItem->setProduct($product);
                $orderItem->setPrice($product->getPrice());
                $orderItem->setQuantity($singleOrderItem["quantity"]);
                $order->addOrderItem($orderItem);
            }

        }



        $customer->setFirstName($firstName);
        $customer->setLastName($lastName);
        $customer->setAddress($address);
        $customer->setEmail($email);
        $customer->setCompanyName($companyName);
        $customer->setPhone($tel);

        $order->setCustomer($customer);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();
        



        $paymentMethods = $paymentMethodRepository->findBy(["isEnabled"=>true]);
        return $this->render('@Flexy\FrontBundle/templates/checkout/ajax/_paymentResult.html.twig',[
            "order"=>$order
        ]);
    }

    #[Route('/departements/ajax', name: 'departements_ajax')]
    public function ajaxDeparatements(Request $request,CityRepository $cityRepository){

        //cityID

        $cityParam = $request->query->get("city");
        $city = $cityRepository->findOneBy(["name"=>$cityParam]);
        if(!$city){
            $city = $cityRepository->find((int)$cityParam);
        }

        $departemets = [];
        if($city){
            $departemets = $city->getDepartements();
        }


        return $this->render("@Flexy/FrontBundle/templates/checkout/ajax/_departementsResult.html.twig",[
            "departements"=>$departemets
        ]);
    }

}
