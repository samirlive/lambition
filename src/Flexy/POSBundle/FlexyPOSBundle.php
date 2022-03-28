<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\POSBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\POSBundle\DependencyInjection\FlexyPOSExtension;

class FlexyPOSBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyPOSExtension([],$container);

    }
}