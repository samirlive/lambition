<?php
// src/Menu/Builder.php
namespace App\Flexy\ShopBundle\Menu;

use App\Entity\Blog;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\ORM\EntityManagerInterface;

final class CategoryMenuShopBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    


    

    public function mainMenu(FactoryInterface $factory, array $options): ItemInterface
    {
        $menu = $factory->createItem('root');

        $em = $this->container->get('doctrine')->getManager();
        $categories = $em->getRepository(CategoryProduct::class)->findBy(["parentCategory"=>null,"forProductType"=>null]);

        //dd($categories);

        foreach($categories as $singleCategorie){
            
            if(count($singleCategorie->getSubCategories()) > 0 ){

                $menuLevel1 = $menu->addChild($singleCategorie->getName(), [
                    'route' => 'single_category_product',
                     'routeParameters' =>[
                         'id'=>$singleCategorie->getId()
                     ]])->setAttribute('class', 'menu-item right-menu ');

                foreach($singleCategorie->getSubCategories() as $subCategory){

                    
                   
                    $menuLevel2 = $menuLevel1->addChild($subCategory->getName(), [
                        'route' => 'single_category_product',
                     'routeParameters' =>[
                         'id'=>$subCategory->getId()
                     ]])->setAttribute('class', 'menu-item  title_level  ');
                    
                     if(count($subCategory->getSubCategories()) > 0 ){
                        

                       

                        
                     foreach($subCategory->getSubCategories() as $subCategory2){
                        $menuLevel2->addChild($subCategory2->getName(), [
                            'route' => 'single_category_product',
                         'routeParameters' =>[
                             'id'=>$subCategory2->getId()
                         ]]);
    
                                
                         }
                    }else{
                        $menuLevel2->addChild($subCategory->getName(), [
                            'route' => 'single_category_product',
                             'routeParameters' =>[
                                 'id'=>$subCategory->getId()
                             ]])->setAttribute('class', 'menu-item right-menu cat-mega-title ');
                    }

                }
              
            }else{
                $menuLevel1 = $menu->addChild($singleCategorie->getName(), [
                    'route' => 'single_category_product',
                     'routeParameters' =>[
                         'id'=>$singleCategorie->getId()
                     ]])->setAttribute('class', 'menu-item');
            }

            
        }

        
        // access services from the container!
        //$em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        //$blog = $em->getRepository(Blog::class)->findMostRecent();

        /*$menu->addChild('Latest Blog Post', [
            'route' => 'blog_show',
            'routeParameters' => ['id' => $blog->getId()]
        ]);*/

        // create another menu item
        // you can also add sub levels to your menus as follows
       // $menu['About Me']->addChild('Edit profile', ['route' => 'edit_profile']);

        // ... add more children

        return $menu;
    }
}