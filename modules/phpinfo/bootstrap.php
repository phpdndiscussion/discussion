<?php

$module = new Discussion\Module(__DIR__);

$module->get('/phpinfo', function() use ($module) {
    return new Discussion\Http\Response\ScriptResponse('phpinfo.php', $module['src.file.locator']);
});

return $module;
