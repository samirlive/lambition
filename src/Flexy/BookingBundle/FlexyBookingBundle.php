<?php 
// src/Acme/TestBundle/AcmeTestBundle.php
namespace App\Flexy\BookingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Flexy\BookingBundle\DependencyInjection\FlexyBookingExtension;

class FlexyBookingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ext = new FlexyBookingExtension([],$container);

    }
}