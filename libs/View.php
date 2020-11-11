<?php

class View {
    public function __construct() {
        ;
    } // constructor
    
    public function show($nombreVista, $vars=array()){
       $config= Config::singleton();
       $path=$config->get('viewFolder').$nombreVista;
       
       
       if(is_array($vars)){
           foreach($vars as $key=>$value){
               $key=$value;
           } // for
       } // if(is_array($vars))
       
       include $path;
    } // show
} // fin clase

?>
