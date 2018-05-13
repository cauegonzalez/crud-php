<?php

use CFG\Database\Connection;
use CFG\Usuario\ServiceUsuario;
use CFG\Usuario\Usuario;
use CFG\Telefone\ServiceTelefone;
use CFG\Telefone\Telefone;

$container['connection'] = function ($c) {
    return new Connection($c['dsn'], $c['user'], $c['password']);
};

$container['usuario'] = function () {
    return new Usuario;
};

$container['telefone'] = function () {
    return new Telefone;
};

$container['ServiceUsuario'] = function ($c) {
    return new ServiceUsuario($c['connection'], $c['usuario']);
};

$container['ServiceTelefone'] = function ($c) {
    return new ServiceTelefone($c['connection'], $c['telefone']);
};

$container['Twig_Environment'] = function(){
    $loader = new Twig_Loader_Filesystem('./templates/');
    $twig = new Twig_Environment($loader, [
        'debug' => true
    ]);
    return $twig;
};