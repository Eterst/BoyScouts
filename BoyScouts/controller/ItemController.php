<?php

class ItemController {

    public function __construct() {
        $this->view = new View();
    }

    public function home() {
        require 'model/ItemModel.php';
        $this->view->show("indexView.php");
    }

    public function insertar() {
        require 'model/ItemModel.php';
        $this->view->show("insertar.php");
    }

    public function insertarMiembroGrupo() {
        require 'model/ItemModel.php';
        $this->view->show("insertarMiembroGrupo.php");
    }

    public function insertarMiembroRama() {
        require 'model/ItemModel.php';
        $this->view->show("insertarMiembroRama.php");
    }

    public function insertarMiembroZona() {
        require 'model/ItemModel.php';
        $this->view->show("insertarMiembroZona.php");
    }

    public function insertarCoordinacion() {
        require 'model/ItemModel.php';
        $this->view->show("insertarCoordinacion.php");
    }

    public function insertarMSG() {
        require 'model/ItemModel.php';
        $this->view->show("insertarMiembro.php");
    }

    public function ver() {
        require 'model/ItemModel.php';
   
    }

    public function bactualizar() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listar();

        $this->view->show("actualizar.php", $data);
    }

    public function actualizar() {
        require 'model/ItemModel.php';

        $this->view->show("actualizar.php");
    }

    public function eliminar() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listar();
        $this->view->show("eliminar.php", $data);
        
    }

    public function metodoEliminarPersona() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $codigo = filter_input(INPUT_GET, 'id');

        $items->eliminarRegistro($codigo);
        $data['listado'] = $items->listar();
        $this->view->show("ver.php", $data);
               $message = 'Persona Eliminada';
       echo "<script type='text/javascript'>alert('$message');</script>";
    }

    public function insertarMiembroSinGrupo() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
         $data['listado'] = $items->listarGrupo();   
          $this->view->show("mostrargrupos.php",$data);
        $cedula = filter_input(INPUT_POST, 'cedula');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $apellido = filter_input(INPUT_POST, 'apellidos');
        $correo = filter_input(INPUT_POST, 'correo');
        $telefono = filter_input(INPUT_POST, 'telefono');
        $pais = filter_input(INPUT_POST, 'pais');
        $provincia = filter_input(INPUT_POST, 'provincia');
        $canton = filter_input(INPUT_POST, 'canton');
        $distrito = filter_input(INPUT_POST, 'distrito');
        $detalle = filter_input(INPUT_POST, 'detalle');
      
      $resultado=  $items->insertarMiembroSinGrupo($cedula, $nombre, $apellido, $correo, $telefono, $pais, $provincia,$canton,$distrito,$detalle);
      if($resultado!= null){
        $message = 'Miembro Registrada';
       echo "<script type='text/javascript'>alert('$message');</script>";  
      }else{
          $message = $nombre.', registrado (a)';
       echo "<script type='text/javascript'>alert('$message');</script>";
          
      }
          
    }

    public function insertarMiembro() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
         $data['listado'] = $items->listarGrupo();   
          $this->view->show("mostrargrupos.php",$data);
        $cedula = filter_input(INPUT_POST, 'cedula');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $apellido = filter_input(INPUT_POST, 'apellidos');
        $correo = filter_input(INPUT_POST, 'correo');
        $telefono = filter_input(INPUT_POST, 'telefono');
        $pais = filter_input(INPUT_POST, 'pais');
        $provincia = filter_input(INPUT_POST, 'provincia');
        $canton = filter_input(INPUT_POST, 'canton');
        $distrito = filter_input(INPUT_POST, 'distrito');
        $detalle = filter_input(INPUT_POST, 'detalle');
        $idgrupo = filter_input(INPUT_POST, 'idgrupo');
        $monitor = filter_input(INPUT_POST, 'monitor');
        $jefe = filter_input(INPUT_POST, 'jefe');
      
      $resultado=  $items->insertar($cedula, $nombre, $apellido, $correo, $telefono, $pais, $provincia,$canton,$distrito,$detalle,$idgrupo,$monitor,$jefe);
      if($resultado!= null){
        $message = 'Miembro Registrada';
       echo "<script type='text/javascript'>alert('$message');</script>";  
      }else{
          $message = $nombre.', registrado (a)';
       echo "<script type='text/javascript'>alert('$message');</script>";
          
      }
          
    }

    public function insertarGrupo() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
         $data['listado'] = $items->listarGrupo();   
          $this->view->show("mostrargrupos.php",$data);
        $nombre = filter_input(INPUT_POST, 'nombre');
        $idrama = filter_input(INPUT_POST, 'idrama');
        $tipo = filter_input(INPUT_POST, 'tipo');
        $cedulamonitor = filter_input(INPUT_POST, 'cedulamonitor');
      
      $resultado=  $items->insertarGrupo($nombre,$tipo,$idrama,$cedulamonitor);
      if($resultado!= null){
        $message = 'Grupo Registrada';
       echo "<script type='text/javascript'>alert('$message');</script>";  
      }else{
          $message = $nombre.', registrado (a)';
       echo "<script type='text/javascript'>alert('$message');</script>";
          
      }
          
    }

    public function listar() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listar();
        $this->view->show("ver.php", $data);
    }

    public function listarGrupo() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listarGrupo();
        $this->view->show("mostrargrupos.php", $data);
    }

    public function listarRama() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listarRama();
        $this->view->show("mostrarramas.php", $data);
    }

    public function listarZona() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listarZona();
        $this->view->show("mostrarzonas.php", $data);
    }

    public function listarCoordinacion() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $data['listado'] = $items->listarCoordinacion();
        $this->view->show("mostrarcoordinacion.php", $data);
    }

    public function listarMiembros() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $codigo = filter_input(INPUT_GET, 'id');
        $data['listado'] = $items->listarMiembros($codigo);
        $data['idgrupo'] = $codigo;
        $this->view->show("verMiembros.php", $data);
    }

    public function modificarVistaMiembro() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $id = filter_input(INPUT_GET, 'id');
        $data['listado'] = $items->selectMiembro($id);
        $this->view->show("modificarVista.php", $data);
    }

    public function metodoActualizarMiembro() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $id_miembro = filter_input(INPUT_POST, 'idmiembro');
        $monitor = filter_input(INPUT_POST, 'monitor');
        $jefe = filter_input(INPUT_POST, 'jefe');
        $idgrupo = filter_input(INPUT_POST, 'idgrupo');
        $items->modificarDatosMiembro($monitor, $jefe, $idgrupo, $id_miembro);
        $data['listado'] = $items->listarGrupo();
        $this->view->show("mostrargrupos.php", $data);
        $message = 'Miembro Modificado';
       echo "<script type='text/javascript'>alert('$message');</script>";
    }

    public function metodoEliminarMiembro() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $codigo = filter_input(INPUT_GET, 'id');

        $items->eliminarMiembro($codigo);
        $data['listado'] = $items->listarGrupo();
        $this->view->show("mostrargrupos.php", $data);
               $message = 'Miembro Eliminada';
       echo "<script type='text/javascript'>alert('$message');</script>";
    }

    public function metodoEliminarMiembroGrupo() {
        require 'model/ItemModel.php';
        $items = new ItemModel();
        $codigo = filter_input(INPUT_GET, 'id');
        $idgrupo = filter_input(INPUT_GET, 'idgrupo');

        $items->eliminarMiembroGrupo($codigo,$idgrupo);
        $data['listado'] = $items->listarGrupo();
        $this->view->show("mostrargrupos.php", $data);
               $message = 'Miembro Eliminada';
       echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
