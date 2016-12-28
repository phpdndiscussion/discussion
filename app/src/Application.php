<?php

namespace Discussion;

use Discussion\Providers\ServiceProvider;
use Silex\Application as SilexApplication;

class Application extends SilexApplication
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $this->register(new ServiceProvider());
    }
}
