<?php
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $twig = $container['Twig_Environment'];

    $message = "";
    $arrayUsuario = [];

    $render = "tabela.twig";
    if (!isset($_GET['pagina']) || ((isset($_GET['pagina']) && $_GET['pagina'] == 'tabela')))
    {
        $arrayUsuario = $container['ServiceUsuario']->list();
    }
    else
    {
        if (isset($_GET['id']))
        {
            $arrayUsuario = $container['ServiceUsuario']->find($_GET['id']);
        }

        if ($_GET['pagina'] == 'form')
        {
            $render = 'form.twig';
        }
        else if ($_GET['pagina'] == 'perfil')
        {
            $render = 'perfil.twig';
        }
        else if ($_GET['pagina'] == 'delete')
        {
            if (isset($_GET['id']))
            {
                $apagou = $container['ServiceUsuario']->delete($_GET['id']);
            }
            if ($apagou)
            {
                $message = "Registro excluído com sucesso!";
            }
            $arrayUsuario = $container['ServiceUsuario']->list();
        }
    }

    $template = ['objUsuario'     => $arrayUsuario,
                 'mensagem'       => $message];

    echo $twig->render($render, compact('template'));