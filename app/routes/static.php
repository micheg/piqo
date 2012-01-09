<?php

    $app->get('/:static_page/', function ($static_page) use ($app)
    {
        $long_name = realpath($app->config('static_page.path') . '/' . $static_page . '.md');
        if($long_name)
        {
            $app->render('view_generic_markdown.php', array(
                'service' => $app->config('service.name'),
                'file_name' => $long_name));
        }
        else
        {
            $app->render('view_error.php',array(
                'service' => $app->config('service.name'),
                'url' => $app->config('service.name') . $static_page . '/'));
          }
     });
?>