<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\ShopBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\ShopBundle\DependencyInjection\FlexyShopExtension;

class FlexyShopBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyShopExtension([],$container);

    }
}