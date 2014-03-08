<?php
    //the path to the microphork framework directory in the vendor package
    $root = dirname(__DIR__).DIRECTORY_SEPARATOR;
    $source = $root.'vendor'.DIRECTORY_SEPARATOR.'microphork'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR;
    
    //recursively copies the entire $source directory to the $target
    function copyall($source, $target) {
        if (file_exists($source)) {
            if (!is_dir($source)) {
                if (!copy($source, $target)) {
                    throw new Exception(sprintf('Unable to copy %s to %s', $source, $target));
                }
            } else {
                if (is_dir($target) || mkdir($target)) {
                    foreach (scandir($source) as $item) {
                        if ($item != '.' && $item != '..') {
                            copyall($source.DIRECTORY_SEPARATOR.$item, $target.DIRECTORY_SEPARATOR.$item);
                        }
                    }
                } else {
                    throw new Exception(sprintf('Unable to create target: %s', $target));
                }
            }
        } else {
            throw new Exception(sprintf('Invalid source dir: %s', $source));
        }
    }
    
    //copy the vendor app directory to the top level
    copyall(
        $source.'php'.DIRECTORY_SEPARATOR.'app', 
        $root.'app'
    );
    
    //copy the vendor env file to the top level htdocs directory
    copyall(
        $source.'htdocs'.DIRECTORY_SEPARATOR.'env.php',
        $root.'htdocs'.DIRECTORY_SEPARATOR.'env.php'
    );
    
    //copy the vendor fatal file to the top level htdocs directory
    copyall(
        $source.'htdocs'.DIRECTORY_SEPARATOR.'fatal.php',
        $root.'htdocs'.DIRECTORY_SEPARATOR.'fatal.php'
    );
