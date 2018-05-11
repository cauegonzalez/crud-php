<?php

use CFG\Database\Connection;
use CFG\Usuario\ServiceUsuario;
use CFG\Usuario\Usuario;

$container['connection'] = function ($c) {
    return new Connection($c['dsn'], $c['user'], $c['password']);
};

$container['usuario'] = function () {
    return new Usuario;
};

$container['ServiceUsuario'] = function ($c) {
    return new ServiceUsuario($c['connection'], $c['usuario']);
};