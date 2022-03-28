<?php
// src/Menu/Builder.php
namespace App\Flexy\ShopBundle\Menu;

use App\Entity\Blog;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\ORM\EntityManagerInterface;

final class VendorMenuShopBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    


    

    public function mainMenu(FactoryInterface $factory, array $options): ItemInterface
    {
        $menu = $factory->createItem('root');

        $em = $this->container->get('doctrine')->getManager();
        $vendors = $em->getRepository(Vendor::class)->findAll();

        $menuLevel1 = $menu->addChild("Vendeurs", [
            'uri' => '#'
            ])->setAttribute('class', 'menu-item right-menu');

        foreach($vendors as $vendor){
            $menuLevel1->addChild($vendor->getName(), [
                'route' => 'single_vendor',
                 'routeParameters' =>[
                     'id'=>$vendor->getId()
                 ]])->setAttribute('class', 'menu-item');
        }
        
        //dd($vendors);

       
        
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