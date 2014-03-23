#microphork-application

[![Latest Stable Version](https://poser.pugx.org/microphork/application/v/stable.png)](https://packagist.org/packages/microphork/application) [![Latest Unstable Version](https://poser.pugx.org/microphork/application/v/unstable.png)](https://packagist.org/packages/microphork/application) [![Total Downloads](https://poser.pugx.org/microphork/application/downloads.png)](https://packagist.org/packages/microphork/application)


##Introduction

This is an installer used to start a new microphork application. It will check out the [microphork framework](https://github.com/phork/microphork) and create a fresh copy of the `app` directory which should be used to build the application.


##Usage

This requires [Composer](http://getcomposer.org/) in order to run. If you prefer not to use Composer you can checkout the [microphork](https://github.com/phork/microphork) repository directly. 
The simplest way to install microphork using composer is via the [`composer create-project`](http://getcomposer.org/doc/03-cli.md#create-project) command:
`composer create-project microphork/application -s dev myapp` where myapp is the name of the folder everything will be installed in.

Next point your browser to the `htdocs/index.php` file. It's recommended that your set your server's document root to the htdocs directory. 

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