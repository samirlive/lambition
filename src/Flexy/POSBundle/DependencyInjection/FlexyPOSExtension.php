<?php
namespace App\Flexy\POSBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class FlexyPOSExtension extends Extension implements PrependExtensionInterface
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $this->addAnnotatedClassesToCompile([
            
            // ... but glob patterns are also supported:
            'FlexyPOSBundle\\Controller\\',
            'FlexyPOSBundle\\Entity\\',
        ]);
    }

    public function prepend(ContainerBuilder $container)
    {
        // TODO: Implement prepend() method.
    }
    
    public function getAlias()
    {
        return parent::getAlias();
    }
}