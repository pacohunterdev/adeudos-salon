<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuotas extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('cuota');
		$this->load->library('session');
    }

	public function index()
	{
		if(!$this->session->userdata('usuario'))  redirect($base."index.php/usuario/login");
		$data['totalesGrupo'] = $this->cuota->numeroPorGrupo();
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('cuotas/index', $data);
		$this->load->view('footer');
	}

	public function obtener(){
		$payload = json_decode(file_get_contents('php://input'));

		echo json_encode($this->cuota->obtener($payload->filtros));
	}

	public function eliminar(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->cuota->eliminar($payload->idCuota));
	}

	public function eliminaGrupoCuota(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->cuota->eliminaGrupoCuota($payload->idCuota, $payload->grupo));
	}

	public function obtenerPorGrupo(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		$cuotas = $this->cuota->obtenerPorGrupo($payload->idGrado, $payload->idGrupo);

		foreach($cuotas as $cuota){
			$cuota->vencida = (strtotime($cuota->fecha_vecimiento) < time()) ? true: false;
			$cuota->pagada = $this->cuota->obtenerPagadasAlumno($payload->idAlumno, $cuota->id_cuota);
		}
		echo json_encode($cuotas);
	}

	public function pagar(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->cuota->pagar($payload->idAlumno, $payload->idCuota, $payload->total));
	}

	public function gruposAsignados(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
		$resultados = $this->cuota->obtenerGruposAsignados($payload->idCuota);
		$chips = [];
		foreach($resultados as $resultado){
			array_push($chips, ["tag" => $resultado->grado_grupo]);
			//$chips[$resultado->grado_grupo] = null;
		}
		echo json_encode($chips); 
	}

	public function registrar(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
		$respuestaGrupos = false; 
		$grupos = $payload->grupos;
		$registro = $this->cuota->registrar($payload);
		$idCuota = $this->db->insert_id();

		foreach($grupos as $grupo){
			$insertado = $this->cuota->registraCuotaGrupo($idCuota, $grupo->id_grado, $grupo->id_grupo, $grupo->texto);
			$respuestaGrupos = ($this->db->affected_rows() != 1) ? false : true;
		}

		echo json_encode($respuestaGrupos && $registro);
	}
	
	public function editar(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
		$respuestaGrupos = true; 
		$grupos = $payload->grupos;
		$registro = $this->cuota->editar($payload);
		if(count($grupos)>0){
			foreach($grupos as $grupo){
				$insertado = $this->cuota->registraCuotaGrupo($payload->idCuota, $grupo->id_grado, $grupo->id_grupo, $grupo->texto);
				$respuestaGrupos = ($this->db->affected_rows() != 1) ? false : true;
			}
		}

		echo json_encode($respuestaGrupos && $registro);
	}
}
