<?php
// src/Menu/Builder.php
namespace App\Flexy\ShopBundle\Menu;

use App\Entity\Blog;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

final class MenuShopBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;


    public function mainMenu(FactoryInterface $factory, array $options): ItemInterface
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Accueil', ['route' => 'front_home'])->setAttribute('class', 'menu-item');
        $menu->addChild('Á propos', ['route' => 'about_us'])->setAttribute('class', 'menu-item');
        $menu->addChild('Contact', ['route' => 'contact'])->setAttribute('class', 'menu-item');
        $menu->addChild('Mon compte', ['route' => 'login_register'])->setAttribute('class', 'menu-item');
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