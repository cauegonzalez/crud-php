<?php
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $twig = $container['Twig_Environment'];

    $usuario = $container['usuario'];


    $usuario->setNome($_POST['nome'])
            ->setCep(str_replace('-', '', $_POST['cep']))
            ->setRua($_POST['rua'])
            ->setNumero($_POST['numero'])
            ->setComplemento($_POST['complemento'])
            ->setBairro($_POST['bairro'])
            ->setCidade($_POST['cidade'])
            ->setUf($_POST['uf']);

    if (isset($_POST['id']) && $_POST['id'] != '')
    {
        $usuario->setId($_POST['id']);
        $container['ServiceUsuario']->update();
        $insertedId = $_POST['id'];
    }
    else
    {
        $insertedId = $container['ServiceUsuario']->save();
    }
    $objUsuario = $container['ServiceUsuario']->find($insertedId);

    $template = ['objUsuario'     => $objUsuario,
                 'ordem'            => 'asc'];

    $render = 'perfil.twig';

    echo $twig->render($render, compact('template'));