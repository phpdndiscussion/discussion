# What?

Rather than bundle everything under app/ you can create distinct "modules" under
modules/. They are their own distinct Silex applications. Besides the segregation,
the idea is to create an initial version of an extension system.

The phpinfo module is a quick example.

Directory structure for modules:

* /modules/$name - $name is an arbitrary label for the directory
	* /bootstrap.php - bootstrap file to define the module (required)
	* /config/config.yml - basic configuration and will be loaded automatically (required)
	* /src - source files

todo: How would a module's public/ work?

# config.yml

	# official name of the module (required)
	module: phpinfo
	# description (optional)
	description: Calls phpinfo()

	# a prefix to apply to all routes defined in this module (optional)
	# applied when routed from the main application - not applied internally
	# intended to be editable by an end user
	uriprefix: /status

# bootstrap.php

	<?php

	// create a module
	$module = new Discussion\Module(__DIR__);

	// create routes like normal
	$module->get('/demo', function() {
		return "Hello, World!";
	});

	// return module to application
	return $module;

# Notes

* As said earlier, modules are their own distinct Silex applications. They'll work
much the same way that the main Application does, including loading `/config/config.yml`,
database schemas, and whatever, with the difference that everything is relative
to the module directory.

* The main Application (technically, whatever loaded the module) is accessible in
the module with `$app['parent']`.

* Routing works like regular Silex routing. The module's routes exist in its own
application, and the routes are added to the main Application's via a mount() with
an optional URI path prefix. Theoretically, the module can execute internal routes -
those would not include the path prefix.
