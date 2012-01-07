<?php
// Microframeworks: slim & underscore
// note this is my generic app template
// not sure using underscore in this project
require '../vendor/Slim/Slim.php';

// custom setting
$app = new Slim(array(
    'log.enable' => true,
    'log.path' => '../log',
    'log.level' => 4,
    'templates.path' => '../app/views',
    'connection.string' => 'sqlite:../data/url.sqlite',
    'service.name' => $_SERVER['SERVER_NAME'] . '/',
));

// application routes
require '../app/routes/urls.php';

// run app!
$app->run();
