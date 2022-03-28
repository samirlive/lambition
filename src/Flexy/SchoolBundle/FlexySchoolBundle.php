<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\SchoolBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\SchoolBundle\DependencyInjection\FlexySchoolExtension;

class FlexySchoolBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexySchoolExtension([],$container);

    }
}