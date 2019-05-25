<?php

namespace AppContainer;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContainerFactory
{
    public static function getContainer()
    {
        $containerBuilder = new ContainerBuilder();
        $appFolder = __DIR__.'/../app';
        $loader = new YamlFileLoader($containerBuilder, new FileLocator($appFolder));
        $loader->load('services.yaml');

        return $containerBuilder;
    }

}
