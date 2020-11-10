<?php


class SPDO extends PDO{
   private static $instance=null;
   
   public function __construct() {
       //Se llama a la funcion como decir la instancia
       $config= Config::singleton();
       //se usa el metodo get para acceder a las variables de conexion
       parent::__construct('mysql:host='.$config->get('dbhost').';dbname='.$config->get('dbname'),
               $config->get('dbuser'), $config->get('dbpass'));               
   } // constructor
   
   public static function singleton(){
       if(self::$instance==null){
           self::$instance=new self();
       }
       return self::$instance;
   } // singleton   
} // SPDO 

