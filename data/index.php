<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/container.php';

$authorService = $containerBuilder->get('author_service');

//print($authorService->getAuthorById(1)->getName());
