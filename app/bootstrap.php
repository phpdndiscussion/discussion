<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Discussion\Application;

$app->get('/', function() {
    $html = "<h1>Hello!</h1>";
    $response = new \Symfony\Component\HttpFoundation\Response($html);

    return $response;
});

return $app;
