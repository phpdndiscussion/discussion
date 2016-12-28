<?php

namespace Discussion\Config;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlLoader extends FileLoader
{
    public function load($file, $type = null)
    {
        $path = $this->locator->locate($file);

        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf("File '%s' cannot be found", $path));
        }

        try {
            $parsed = Yaml::parse(file_get_contents($path));
            return $parsed;
        } catch (ParseException $e) {
            throw new \InvalidArgumentException(sprintf("File '%s' does not contain valid YAML", $path), 0, $e);
        }
    }

    public function supports($file, $type = null)
    {
        return is_string($file) && in_array(pathinfo($file, PATHINFO_EXTENSION), ['yml', 'yaml'], true) && (!$type || $type === 'yaml');
    }
}

