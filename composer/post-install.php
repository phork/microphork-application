<?php
    //the path to the microphork application directory in the vendor package
    $root = dirname(__DIR__).DIRECTORY_SEPARATOR;
    $source = $root.'vendor/microphork/framework/php/app';
    $target = $root.'app';
    
    //recursively copies the entire $source directory to the $target
    function copydir($source, $target) {
        if (file_exists($source)) {
            if (!is_dir($source)) {
                if (!copy($source, $target)) {
                    throw new Exception(sprintf('Unable to copy %s to %s', $source, $target));
                }
            } else {
                if (mkdir($target)) {
                    foreach (scandir($source) as $item) {
                        if ($item != '.' && $item != '..') {
                            copydir($source.DIRECTORY_SEPARATOR.$item, $target.DIRECTORY_SEPARATOR.$item);
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
    copydir($source, $target);