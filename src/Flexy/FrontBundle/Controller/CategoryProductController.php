<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ProductBundle\Repository\CategoryProductRepository;
use App\Flexy\ShopBundle\Entity\Product\ProductShop;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop')]
class CategoryProductController extends AbstractController
{
    #[Route('/category-product/{id}', name: 'single_category_product')]
    public function singleProduct(
        CategoryProduct $categoryProduct,
        EntityManagerInterface $em, 
        PaginatorInterface $paginator, 
        Request $request
        ): Response
    {

        $dql   = "SELECT product FROM App\Flexy\ShopBundle\Entity\Product\Product product LEFT OUTER JOIN product.categoriesProduct categorie WhERE categorie.id =  ".$categoryProduct->getId()." AND  product.isPublished = TRUE";
        $query = $em->createQuery($dql);
        

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('@Flexy\FrontBundle/templates/categories/singleCategoryProduct.html.twig', [
            'categoryProduct' => $categoryProduct,
            "products"=>$pagination

        ]);
    }
}
