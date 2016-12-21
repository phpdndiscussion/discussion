<?php

namespace Discussion\Tests;

use Silex\WebTestCase as Base;

abstract class WebTestCase extends Base
{
    public function createApplication()
    {
        $app = require dirname(__DIR__) . '/app/bootstrap.php';

        $app['debug'] = true;
        unset($app['exception_handler']);

        return $app;
    }
}
