<?php

namespace AppContainer;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ContainerFactory
{
    /**
     * Get DI container.
     *
     * @return ContainerBuilder
     *
     * @throws \Exception
     */
    public static function getContainer()
    {
        $containerBuilder = new ContainerBuilder();
        $appFolder = __DIR__.'/../app';
        $loader = new YamlFileLoader($containerBuilder, new FileLocator($appFolder));
        $loader->load('services.yaml');

        $containerBuilder->register('event_dispatcher', EventDispatcher::class);

        return $containerBuilder;
    }

}
