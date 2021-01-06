<?php 

require_once 'model/Direccion.php';

class Miembro
{
	private $cedula;

	private $nombre;

	private $apellidos;

	private $correo;

	private $telefono;

	private $direccion;

	function __construct($cedula,$nombre,$apellidos,$correo,$telefono,$pais,$provincia,$canton,$distrito,$detalle){
		$this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->correo = $correo;
		$this->telefono = $telefono;

		$this->direccion = new Direccion($pais,$provincia,$canton,$distrito,$detalle);
	}

	public function getCedula(){
		return $cedula;
	}

	public function getNombre(){
		return $nombre;
	}

	public function getApellidos(){
		return $apellidos;
	}

	public function getCorreo(){
		return $correo;
	}

	public function getTelefono(){
		return $telefono;
	}

	public function getDireccion(){
		return $direccion;
	}
}

?>