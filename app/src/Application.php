<?php

namespace Discussion;

use Composer\Autoload\ClassLoader;
use Discussion\Providers\ServiceProvider;
use Silex\Application as SilexApplication;

class Application extends SilexApplication
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $root = dirname(__DIR__);
        $this->register(new ServiceProvider($root));
    }

    public function loadModules($path, ClassLoader $autoloader)
    {
        $require = function() { return require func_get_arg(0); };

        foreach (glob($path . '/*/bootstrap.php') as $bootstrap) {
            $module = $require($bootstrap);
            $autoloader->add($module['config']['namespace'], dirname($bootstrap) . '/src');
            $module->init($this);
        }
    }
}
