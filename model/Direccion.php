<?php 

class Direccion
{
	private $pais;

	private $provincia;

	private $canton;

	private $distrito;

	private $detalle;


	function __construct($pais,$provincia,$canton,$distrito,$detalle){
		$this->pais = $pais;
		$this->provincia = $provincia;
		$this->canton = $canton;
		$this->distrito = $distrito;
		$this->detalle = $detalle;
	}

	public function getPais(){
		return $pais;
	}

	public function getProvincia(){
		return $provincia;
	}

	public function getCanton(){
		return $canton;
	}

	public function getDistrito(){
		return $distrito;
	}

	public function getDetalle(){
		return $detalle;
	}
}

 ?>