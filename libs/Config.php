<?php


class Config {
    
    //Variables.
    private $vars;
    private static $instance;  
    
    
    //  El patrón Singleton se implementa mediante una clase con un constructor privado.
    private function __construct(){
        $this->vars=array();
    }  // constructor
    
  
    public function set($nombreAtributo, $valor){
        if(!isset($this->vars[$nombreAtributo])){
            $this->vars[$nombreAtributo]=$valor;
        } // if        
    } // set
    
     public function get($nombreAtributo){
         if(isset($this->vars[$nombreAtributo])){
             return $this->vars[$nombreAtributo];
         } // if         
     } // get
     
     
     //instancia unica
     //creando (en la propia clase) un método que crea una instancia del objeto si este no existe y lo retorna.
     //entonces cada vez que una clase quiera usar singelton llama esta funcion para no tener que ahcer la instancia
     public static function singleton(){
         if(!isset(self::$instance)){
             $tempClass=__CLASS__;
             self::$instance=new $tempClass;
         } // if
         return self::$instance;
     } // singleton
} // fin clase

?>
