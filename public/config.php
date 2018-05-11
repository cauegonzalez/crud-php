<?php

use Pimple\Container;

$container = new Container();

$container['Twig_Environment'] = function(){

    $loader = new Twig_Loader_Filesystem('./templates/');
    $twig = new Twig_Environment($loader, [
        'debug' => true
    ]);
    return $twig;
};

$container['dsn'] = 'mysql:host=localhost;dbname=crud';
$container['user'] = 'root';
$container['password'] = 'caue@gonzalez5!';