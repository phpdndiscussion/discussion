<?php

namespace Discussion\Http\Response;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Response;

class ScriptResponse extends Response
{

    protected $file;

    /** @throws \Symfony\Component\Config\Exception\FileLocatorFileNotFoundException */
    public function __construct($file, FileLocator $locator, $status = 200, $headers = array())
    {
        parent::__construct(null, $status, $headers);

        $this->file = $locator->locate($file);
    }

    public function send()
    {
        ob_start();
        $return = include $this->file;
        $this->setContent(ob_get_clean());

        if ($return && $return instanceof Response) {
            $return->send();
        } else {
            parent::send();
        }

        return $this;
    }

}
