<?php

namespace Discussion;

use Discussion\Application;
use Discussion\Providers\ServiceProvider;
use Silex\Application as SilexApplication;

class Module extends SilexApplication
{
    public function __construct($root, array $values = [])
    {
        parent::__construct($values);

        $this->register(new ServiceProvider($root));
    }

    public function init(Application $app)
    {
        $this['parent'] = $app;
        $app['controllers']->mount($this['config']['uriprefix'] ?? '', $this['controllers']);
    }
}
