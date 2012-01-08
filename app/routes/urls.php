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
        $dbh = new PDO($app->config('connection.string'));
        $qry = $dbh->prepare('SELECT URL FROM URLS WHERE hash = :hash');
        $qry->bindParam(':hash',$hash,PDO::PARAM_STR);
        $qry->execute();
        $first_res = $qry->fetch(PDO::FETCH_ASSOC);
        if($first_res)
        {
            $app->redirect($first_res['url'], 301);
        }
        else
        {
            $app->render('view_error.php',array('service' => $app->config('service.name'), 'url' => $app->config('service.name') . $hash));
        }
        $dbh = null;    
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
        $dbh = new PDO($app->config('connection.string'));
        $have_hash = $dbh->prepare('SELECT hash FROM urls WHERE url = :url');
        $have_hash->bindParam(':url',$url,PDO::PARAM_STR);
        $have_hash->execute();
        $hash = $have_hash->fetch(PDO::FETCH_ASSOC);
        if($hash)
        {
            $tiny = $hash['hash'];
        }
        else
        {
            $uniq_result = $dbh->query('SELECT MAX(ID)  as num FROM urls')->fetch(PDO::FETCH_ASSOC);
            //$uniq_result = $dbh->query('select count(id) as max from urls')->fetch(PDO::FETCH_ASSOC);
            $next = intval($uniq_result['num']) + 36; // at least 2 char
            $next = base_convert((string) $next, 10, 36);
            $qry = $dbh->prepare('INSERT INTO urls(hash, url) VALUES(:hash, :url)');
            $qry->bindParam(':hash',$next,PDO::PARAM_STR);
            $qry->bindParam(':url',$url,PDO::PARAM_STR);
            $qry->execute();
            $tiny = $next;
        }
        $dbh = null;
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