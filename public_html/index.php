<?php

    /**
     *
     * Piqo Entry Point
     *
     * http://github.com/micheg/piqo
     *
     * Setting Slim and application
     *
     * Copyright (c) 2012, Michelangelo Giacomelli
     * All rights reserved.
     * 
     * BSD Licensed.
     *
     */

    // Microframeworks: slim & underscore
    // note this is my generic app template
    // not sure using underscore in this project
    require_once '../vendor/Slim/Slim.php';
    require_once '../vendor/underscore.php';
    require_once '../vendor/idiorm.php';
    require_once '../vendor/my.php';

    // custom setting
    $app = new Slim(array(
        'log.enable' => true,
        'log.path' => './log',
        'log.level' => 4,
        'templates.path' => './app/views',
        'connection.string' => 'sqlite:./data/url.sqlite',
        'service.name' => $_SERVER['SERVER_NAME'] . '/',
    ));

    // application routes
    require_once '../app/routes/urls.php';

    // run app!
    $app->run();
?>