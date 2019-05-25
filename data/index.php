<?php

require __DIR__.'/vendor/autoload.php';

use \AppContainer\ContainerFactory;

$myContainer = ContainerFactory::getContainer();
$authorService = $myContainer->get('author_service');
