<?php

namespace Discussion\Providers;

use Discussion\Config\YamlLoader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Config\FileLocator;

class ServiceProvider implements ServiceProviderInterface
{
    private $root = '';

    public function __construct($root)
    {
        $this->root = $root;
    }

    public function register(Container $app)
    {
        $app['config.dir'] = $this->root . '/config';
        $app['schema.dir'] = $this->root . '/database/schema';

        $app['config.file.locator'] = function($app) {
            $locator = new FileLocator($app['config.dir']);
            return $locator;
        };

        $app['config.yaml.loader'] = function($app) {
            $loader = new YamlLoader($app['config.file.locator']);
            return $loader;
        };

        $app['config'] = $app['config.yaml.loader']->load('config.yml');

        $app['entity.manager'] = function($app) {
            $config = Setup::createYAMLMetadataConfiguration([$app['schema.dir']]);
            $manager = EntityManager::create($app['config']['database'], $config);

            return $manager;
        };
    }
}
