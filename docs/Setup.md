# Initial Setup

* Clone Git repo
* Composer install
* Set `storage` subdirectories to be writeable by the web server
* Copy generic configuration files

I have provided default configuration files with `.dist` appended to the file
name. Locations are all correct. Copy `phpunit.xml.dist` to `phpunit.xml` and
make desired changes for PHPUnit to run without needing to specify a config
file at run time. `app/config/config.yml` is required for Doctrine, so copy
`app/config/config.yml.dist` and update database credentials as needed.
