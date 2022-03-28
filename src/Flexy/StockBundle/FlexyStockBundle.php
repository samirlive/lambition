<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\StockBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\StockBundle\DependencyInjection\FlexyStockExtension;

class FlexyStockBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyStockExtension([],$container);

    }
}