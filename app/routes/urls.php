<?php

function have_http($url)
{
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

$app->get('/:hash', function ($hash) use ($app)
{
    try
    {
        $hash = strtolower($hash);
        ORM_EXT::configure($app->config('connection.string'));
        $one_url = ORM_EXT::for_table('urls')->where('hash', $hash)->find_one();
        $url = ($one_url) ? $one_url->url : null;
        if($url)
        {
            $app->redirect($url, 301);
        }
        else
        {
            $app->render('view_error.php',array('service' => $app->config('service.name'), 'url' => $app->config('service.name') . $hash));
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
});

$app->post('/short/', function() use ($app)
{
    $url = $app->request()->post('url');
    $url = rawurldecode($url);
    $tiny = '';
    if(!have_http($url))
    {
        $url = 'http://' . $url;
    }
    try
    {
        ORM_EXT::configure($app->config('connection.string'));
        $one_hash = ORM_EXT::for_table('urls')->where('url', $url)->find_one();
        $hash = ($one_hash) ? $one_hash->hash : null;
        if($hash)
        {
            $tiny = $hash;
        }
        else
        {
            $next = (int) ORM_EXT::for_table('urls')->max('id') + 36;
            $next = base_convert((string) $next, 10, 36); // at least 2 char!
            // -- insert new record
            $record = ORM_EXT::for_table('urls')->create();
            $record->hash = strval($next);
            $record->url = $url;
            $record->save();
            $tiny = $next;
        }
    }    
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $res = array('tiny' => rawurlencode($app->config('service.name') . $tiny), 'url'=>rawurlencode($url));
    $app->response()->header('Content-Type: application/json');
    echo json_encode($res);
});

$app->get('/', function () use ($app)
{
    $app->render('view_index.php',array('service' => $app->config('service.name')));
});

?>