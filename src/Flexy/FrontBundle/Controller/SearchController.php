<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\FrontBundle\Repository\ProductFrontRepository;
use App\Flexy\ProductBundle\Repository\ProductRepository;
use App\Flexy\ShopBundle\Entity\Product\Attribut;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Repository\Product\AttributRepository;
use App\Repository\Flexy\ShopBundle\Entity\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop/search')]
class SearchController extends AbstractController
{

    #[Route('/', name: "front_search")]
    public function search(Request $request,ProductFrontRepository $productFrontRepository): Response
    {

        $keyword = $request->query->get("keyword");


        $products = $productFrontRepository->findAll();

        if(count($productFrontRepository->findByKeyWord($keyword)) > 0){
            $products = $productFrontRepository->findByKeyWord($keyword);
        }

        return $this->render('@Flexy\FrontBundle/templates/search/search.html.twig',[
            "products"=>$products
        ]);
    }




    #[Route('/sideBarFilter', name: "front_sideBarFilter")]
    public function sideBarFilter(
        Request $request,
        AttributRepository $attributRepository,
        BrandRepository $brandRepository,
    ): Response
    
        {

            

            return $this->render('@Flexy\FrontBundle/templates/search/_sideBarFilter.html.twig',[
                "Attributes"=>$attributRepository->findAll(),
                "brands"=>$brandRepository->findAll(),

            ]);
        }
        
    

    #[Route('/filter', name: "front_filter")]
    public function filter(
        Request $request,
        EntityManagerInterface $em,
        PaginatorInterface $paginator
    ): Response
    {

        $filterValues=[];
        $filters=$request->query->get("filter");
        foreach ( (array)$filters as $key => $value) {
            $filterValues[]=$key;
        }

        




        $dql   = "SELECT product FROM App\Flexy\ShopBundle\Entity\Product\Product product";

        foreach ( (array)$filters as $key => $value) {
            if($key == "price"){

                
                continue;
            }
            $dql.= ' LEFT JOIN product.'.$key.' '.$key.' ';
        }

        $counter = 0;
        $startAdditionalFilters = false;
        foreach ((array)$filters as $key => $value) {

            $filterValues = [];
            foreach((array)$value as  $filterKey=>$filterValue){
               $filterValues[]=  $filterKey;
            }
            
            $sqlfilterValues = '(' . join(',', $filterValues) . ')';
            if($counter == 0){
                $dql.= ' WHERE 1 = 1';// Condition principale
            }
            if($key == "price"){
                $dql.= ' AND ';
                $dql.= ' (product.price >=  '.($filters["price"]["min"] * 100 ).' AND  product.price <= '.($filters["price"]["max"] * 100 ).')';
                if(count((array)$filters) > 1){

                    $dql.= ' AND (';// Fin de condition principale, et comencant les autres filtres avec 'OR' ***Ouvrir la parentaise***
                    
                    $counter = $counter + 1;
                    
                }
                
                
                continue;
            }

            
            
            if($startAdditionalFilters){
                $dql.= ' OR ';
            }
            
            $dql.= '  '.$key.'.id IN  '.$sqlfilterValues;
            $startAdditionalFilters = true;

            $counter = $counter + 1;
        }
        if(count((array)$filters) > 1){
        $dql.= ' ) ';//***fermer la parentaise***
        }


        // Add filter price
        

        //dd($dql);

       
        $query = $em->createQuery($dql);

        
        

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('@Flexy\FrontBundle/templates/search/search.html.twig',[
     
            "products"=>$pagination

        ]);
    }
}
