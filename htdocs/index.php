<?php
	//everything below can be overridden by an environmental file (this can also be auto-prepended by the server)
    (file_exists('env.php') && include_once 'env.php');
	
	//define the path to the application files if they haven't been defined already
	(!defined('VENDOR_PATH')) && define('VENDOR_PATH', realpath('../vendor/microphork').DIRECTORY_SEPARATOR);
	(!defined('APP_PATH')) && define('APP_PATH', realpath('../app').DIRECTORY_SEPARATOR);
	(!defined('VIEW_PATH')) && define('VIEW_PATH', realpath('../app/views').DIRECTORY_SEPARATOR);
	(!defined('PKG_PATH')) && define('PKG_PATH', realpath(VENDOR_PATH.'packages').DIRECTORY_SEPARATOR);
	(!defined('LOG_PATH')) && define('LOG_PATH', realpath('../logs').DIRECTORY_SEPARATOR);
	
	//require the files to run the application from the vendor package
	require VENDOR_PATH.'framework/htdocs/env.php';
	require VENDOR_PATH.'framework/htdocs/index.php';
