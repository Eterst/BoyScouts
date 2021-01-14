<?php

require_once 'model/Miembro.php';

class Grupo
{
	private $nombre;

	private $tipo;

	private $monitores;

	private $jefes;

	private $miembros;

	private $grupos;

	function __construct($nombre,$tipo,$parent,$miembro_fundador){
		$this->nombre = $nombre;
		$this->tipo = $tipo;
		$this->grupos = array();
		$this->miembros = array();
		$this->jefes = array();
		$this->monitores = array();
		array_push($this->miembros, $miembro_fundador);
		array_push($parent, $this);
	}

	function __construct($nombre,$miembro_fundador){
		$this->nombre = $nombre;
		$this->tipo = 'grupo';
		array_push($this->miembros, $miembro_fundador);
	}

	public funtion getNombre(){
		return $nombre;
	}

	public funtion getTipo(){
		return $tipo;
	}

	public funtion getMonitores(){
		return $monitores;
	}

	public funtion getJefes(){
		return $jefes;
	}

	public funtion getMiembros(){
		return $miembros;
	}

	public funtion getGrupos(){
		return $grupos;
	}

	public function getMiembro($cedula){
		if(isset($miembros[$cedula])){
			return $miembros[$cedula];
		}
		return NULL;
	}

	public function getJefe($cedula){
		if(isset($jefes[$cedula])){
			return $jefes[$cedula];
		}
		return NULL;
	}

	public function getMonitor($cedula){
		if(isset($monitores[$cedula])){
			return $monitores[$cedula];
		}
		return NULL;
	}

	public function getGrupo($nombre){
		if(isset($grupos[$nombre])){
			return $grupos[$nombre];
		}
		return NULL;
	}

	public function insertMiembro($miembro){
		$miembros[$miembro->getCedula()] = $miembro;
	}

	public function insertJefe($jefe){
		$jefes[$jefe->getCedula()] = $jefe;
	}

	public function insertMonitor($monitor){
		$monitores[$monitor->getCedula()] = $monitor;
	}

	public function insertGrupo($grupo){
		$grupos[$grupo->getNombre()] = $grupo;
	}

	######################################################
	### Estas funciones si vamos por el segundo camino ###
	######################################################

	public function loadMiembros($row_miembros){
		# TODO: Falta implementar
		# Argumentos: "row" del resultado de la consulta de sql a la base de datos
		# donde contendra los miembros
		# Funcionalidad: Dado la row crear los miembros con los datos y añadirlos con insertMiembro()
	}

	public function loadJefes($row_jefes){
		# TODO: Falta implementar
		# Lo mismo que loadMiembros() pero con Jefes
	}

	public function loadJefes($row_monitores){
		# TODO: Falta implementar
		# Lo mismo que loadMiembros() pero con Monitores
	}
	######################################################
}
?>