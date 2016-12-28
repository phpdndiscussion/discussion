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
    public function register(Container $app)
    {
        $app['config.dir'] = dirname(dirname(__DIR__)) . '/config';
        $app['schema.dir'] = dirname(dirname(__DIR__)) . '/database/schema';

        $app['file.locator'] = function($app) {
            $locator = new FileLocator($app['config.dir']);
            return $locator;
        };

        $app['yaml.loader'] = function($app) {
            $loader = new YamlLoader($app['file.locator']);
            return $loader;
        };

        $app['config'] = $app['yaml.loader']->load('config.yml');

        $app['entity.manager'] = function($app) {
            $config = Setup::createYAMLMetadataConfiguration([$app['schema.dir']]);
            $manager = EntityManager::create($app['config']['database'], $config);

            return $manager;
        };
    }
}
