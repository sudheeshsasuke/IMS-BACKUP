<?php

spl_autoload_register(function ($class_name) {
    
    $file_name = './libs/controllers/' . strtolower($class_name) . '.class.php';
    if(file_exists($file_name)) {
        require_once $file_name;
    }
    
    $file_name = './libs/models/' . strtolower($class_name) . '.class.php';
    if(file_exists($file_name)) {
        require_once $file_name;
    }

});

?>