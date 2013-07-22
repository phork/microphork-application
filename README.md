#microphork-application

* [By Phork Labs](http://phorklabs.com/)
* Version: 0.1


##Introduction

This is an installer used to start a new microphork application. It will check out the microphork framework and create a fresh copy of the `app` directory which should be used to build the application.


##Usage

This requires [composer](http://getcomposer.org/) in order to run. If you don't have composer you can checkout the [microphork](https://github.com/phork/microphork) repository directly. To begin the installation use the [`composer install`](http://getcomposer.org/doc/00-intro.md#using-composer) command. 
If any of the settings require overriding you can create an `htdocs/env.php` file. This will be included automatically before the rest of the application runs.


##Example env.php
```
<?php
    //define the environment (eg. dev, stage, prod)
    define('PHK_ENV', 'dev');
    
    //define the paths to the test files
    define('TEST_PATH', realpath(dirname(__DIR__)).DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR);
    define('LOG_PATH', realpath(dirname(__DIR__)).DIRECTORY_SEPARATOR.'logs/tests'.DIRECTORY_SEPARATOR);
    
    //define a custom function to load and use the testing bootstrap
    function phork_initialize() {
        require_once TEST_PATH.'classes'.DIRECTORY_SEPARATOR.'bootstrap.php';
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


##License

Licensed under The MIT License
<http://www.opensource.org/licenses/mit-license.php>