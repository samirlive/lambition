<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\MyNewBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\MyNewBundle\DependencyInjection\FlexyMyNewExtension;

class FlexyMyNewBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyMyNewExtension([],$container);

    }
}