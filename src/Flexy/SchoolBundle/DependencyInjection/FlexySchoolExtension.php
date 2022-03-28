<?php
namespace App\Flexy\SchoolBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class FlexySchoolExtension extends Extension implements PrependExtensionInterface
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $this->addAnnotatedClassesToCompile([
            
            // ... but glob patterns are also supported:
            'FlexySchoolBundle\\Controller\\',
            'FlexySchoolBundle\\Entity\\',
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