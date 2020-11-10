<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ItemModel {

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }// constructor
    
    public function login($nombre, $contra) {
        $consulta = $this->db->prepare("call login('$nombre','$contra')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }
    
    public function insertar($ced,$nombre,$ape,$email,$tel,$pais,$prov,$cant,$dist,$deta,$idgrupo,$moni,$jefe) {
        $consulta = $this->db->prepare("call insertar_miembro('$ced','$nombre','$ape','$email','$tel','$pais','$prov','$cant','$dist','$deta','$idgrupo','$moni','$jefe')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin registrar

    public function insertarMiembroSinGrupo($ced,$nombre,$ape,$email,$tel,$pais,$prov,$cant,$dist,$deta) {
        $consulta = $this->db->prepare("call insertar_miembroSG('$ced','$nombre','$ape','$email','$tel','$pais','$prov','$cant','$dist','$deta')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin registrar
    

    public function insertarGrupo($nombre,$tipo,$idrama,$cedulamonitor) {
        $consulta = $this->db->prepare("call insertar_grupo('$nombre','$tipo','$idrama','$cedulamonitor')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin registrar
    

    public function listar() {
        $consulta = $this->db->prepare('call getPersonas()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

    public function listarGrupo() {
        $consulta = $this->db->prepare('call mostrarGrupos()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

    public function listarRama() {
        $consulta = $this->db->prepare('call mostrarRamas()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

    public function listarZona() {
        $consulta = $this->db->prepare('call mostrarZonas()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

    public function listarCoordinacion() {
        $consulta = $this->db->prepare('call mostrarCoordinaciones()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

    public function listarMiembros($id) {
        $consulta = $this->db->prepare("call mostrarMiembros('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

      public function eliminarRegistro($id) {
        $consulta = $this->db->prepare("call eliminarRegistro('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar
   public function listarPorID($id) {
        $consulta = $this->db->prepare("call sp_listar('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar
    public function modificarDatos($id,$nombre,$apellido,$email) {
        $consulta = $this->db->prepare("call sp_modificarDatos('$nombre','$apellido','$email','$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar
    public function modificarDatosMiembro($monitor,$jefe,$id_grupo,$id_miembro) {
        $consulta = $this->db->prepare("call actualizarMiembro('$monitor', '$jefe','$id_grupo','$id_miembro')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar
    public function selectMiembro($id_miembro) {
        $consulta = $this->db->prepare("call selectMiembro('$id_miembro')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar
    public function eliminarMiembro($id) {
        $consulta = $this->db->prepare("call eliminarMiembro('$id')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar

    public function eliminarMiembroGrupo($id,$idgrupo) {
        $consulta = $this->db->prepare("call eliminarMiembroGrupo('$id', '$idgrupo')");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }// fin listar
}
// fin clase