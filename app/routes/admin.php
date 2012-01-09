<?php

    /**
     *
     * Routing for Admin Module
     * 
     * General Autenticate Functions
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

    $authentica_app_page_for_role = function ( $app, $page, $role = 'member' )
    {
        return (function () use ( $app, $page, $role )
        {
            if (!isset($_SESSION['login']))
            {
                $app->redirect('/login/' . $page, 301);
            }
            else
            {
                if($_SESSION['role'] != $role)
                {
                    unset ($_SESSION['login']);
                    unset ($_SESSION['username']);
                    unset ($_SESSION['role']);
                    $app->flash('login_error', 'Unauthorized access.<br/>You do not have the necessary privileges.<br/>You have been disconnected from the server.');
                    $app->redirect('/login/' . $page, 301);
                }
                else
                {
                    return true;
                }
            }
        });
    };
    $app->map('/login/:page', function ($page) use ($app)
    {
        if ( $app->request()->isPost() )
        {
            $user = $app->request()->post('user');
            $pass = md5($app->request()->post('password'));
            ORM_EXT::configure($app->config('connection.string'));
            $one_user = ORM_EXT::for_table('users')->where('user', $user)->find_one();
            $db_pass = ($one_user) ? $one_user->password : null;
            $db_role = ($one_user) ? $one_user->role : null;
            if($pass == $db_pass)
            {
                $_SESSION['login'] = 'ok';
                $_SESSION['username'] = $user;
                $_SESSION['role'] = $db_role;
                $app->redirect('/' . $page . '/', 301);
            }
            else
            {
                $app->flash('login_error', 'invalid username or password');
            }
        }
        $app->render('view_login.php', array('service' => $app->config('service.name'), 'url' => $page));
    })->via('GET', 'POST');

    $app->get('/logout/', function () use ($app)
    {
        unset ($_SESSION['login']);
        unset ($_SESSION['username']);
        unset ($_SESSION['role']);
        $app->redirect('/', 301);
    });

    $app->get('/admin/', $authentica_app_page_for_role($app, 'admin', 'admin'), function ()
    {
        echo "loggggin!";
    });

    $app->get('/test_page/', $authentica_app_page_for_role($app, 'test', 'rulez'), function ()
    {
        echo "nevere here!";
    });

?>