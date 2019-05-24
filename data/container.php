<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Finder\Finder;

// This should be cached.
$containerBuilder = new ContainerBuilder();
$appFolder = __DIR__.'/app';
$loader = new YamlFileLoader($containerBuilder, new FileLocator($appFolder));
$loader->load('services.yaml');
