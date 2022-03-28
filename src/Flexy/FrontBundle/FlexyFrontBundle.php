<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\FrontBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\FrontBundle\DependencyInjection\FlexyFrontExtension;

class FlexyFrontBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyFrontExtension([],$container);

    }
}