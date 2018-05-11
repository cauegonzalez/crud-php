<?php
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $twig = $container['Twig_Environment'];

    $template = [];

    $render = 'about.twig';

    echo $twig->render($render, compact('template'));