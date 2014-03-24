#microphork-application

[![Latest Stable Version](https://poser.pugx.org/microphork/application/v/stable.png)](https://packagist.org/packages/microphork/application) 
[![Latest Unstable Version](https://poser.pugx.org/microphork/application/v/unstable.png)](https://packagist.org/packages/microphork/application) 
[![Total Downloads](https://poser.pugx.org/microphork/application/downloads.png)](https://packagist.org/packages/microphork/application)


##Introduction

This is a [Composer](http://getcomposer.org/)-based installer for creating a microphork application. If you prefer not to use Composer you can clone the [microphork framework](https://github.com/phork/microphork) repository directly.


##Usage

First make sure that Composer is [installed](https://getcomposer.org/doc/00-intro.md). Then use the [`composer create-project`](http://getcomposer.org/doc/03-cli.md#create-project) command in the terminal:

```
composer create-project microphork/application -s dev my-microphork-app
```

This will download the microphork framework and its dependencies to a folder called `my-microphork-app` and it will create a fresh copy of the `app` directory which should be used for your application files. Make sure that the `logs` directory has write permissions.

Next point your browser to the `htdocs/index.php` file. It's recommended that your set your server's document root to the htdocs directory and set up URLs to rewrite to index.php.

If any of the path constants require overriding you can create an `htdocs/env.php` file. This will be included automatically before the rest of the application runs.
An example env.php file has been provided below showing some of the overrides that can be used.


##Example env.php
```
<?php
    //turn on the setting to display all errors
    ini_set('display_errors', 1);
    
    //define the environment (eg. dev, stage, prod)
    define('PHK_ENV', 'dev');
    
    //define the paths to the test files
    define('TEST_PATH', realpath(dirname(__DIR__)).DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR);
    define('LOG_PATH', realpath(dirname(__DIR__)).DIRECTORY_SEPARATOR.'logs/tests'.DIRECTORY_SEPARATOR);
    
    //define a custom function to load and use the testing bootstrap
    function phork_initialize() {
        require_once TEST_PATH.'classes'.DIRECTORY_SEPARATOR.'Bootstrap.php';
        class_alias('Phork\\Test\\Bootstrap', 'Phork');
    }
    
    //register a shutdown function to print all remaining errors
    register_shutdown_function(function() {
        if (class_exists('Phork') && !empty(Phork::instance()->error)) {
             if ($errors = Phork::error()->getErrors()->items()) {
                 print '<pre>'.print_r($errors, true).'</pre>';
             }
        } else {
             print 'Unable to get shutdown errors';
        }
    });
    
    //register a shutdown function to print the total execution time
    register_shutdown_function(function() {
        if (\Phork::instance()->verbose()) {
             printf('%f seconds ellapsed', (microtime(true) - PHORK_START));
        }
    });
    
    //define the start time
    define('PHORK_START', microtime(true));
```

##Credits

Built by [Elenor](http://elenor.net) at [Phork Labs](http://phorklabs.com).


##License

Licensed under The MIT License
<http://www.opensource.org/licenses/mit-license.php>