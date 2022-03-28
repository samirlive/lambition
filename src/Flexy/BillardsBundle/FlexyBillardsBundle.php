<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\BillardsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\BillardsBundle\DependencyInjection\FlexyBillardsExtension;

class FlexyBillardsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyBillardsExtension([],$container);

    }
}