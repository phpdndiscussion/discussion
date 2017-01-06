<?php

$module = new Discussion\Module(__DIR__);

$module->get('/phpinfo', function() {
    phpinfo();
    return new Symfony\Component\HttpFoundation\Response();
});

return $module;
