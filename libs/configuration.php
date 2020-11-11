<?php
// configuration
    require 'libs/Config.php';
    //se llama a la funcion y se les hace un set
    $config=Config::singleton();
    $config->set('controllerFolder', 'controller/');
    $config->set('modelFolder', 'model/');
    $config->set('viewFolder', 'view/');
    
    $config->set('dbhost', 'localhost');
    $config->set('dbname', 'boyscouts');
    $config->set('dbuser', 'root');
    $config->set('dbpass', '');
    
    
?>
