<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('alumno');
		$this->load->library('session');
    }

	public function index()
	{
		if(!$this->session->userdata('usuario'))  redirect($base."index.php/usuario/login");
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('alumnos/index');
		$this->load->view('footer');
	}

	public function obtener(){
		$payload = json_decode(file_get_contents('php://input'));
		echo json_encode($this->alumno->obtenerAlumnos($payload));
	}

	public function registrar(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->alumno->registrar($payload));
	}
	
	public function editar(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->alumno->editar($payload));
	}

	public function darBaja(){
		$payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->alumno->darBaja($payload->idAlumno));
	}

	public function dadosBaja(){
		echo json_encode($this->alumno->dadosBaja());
	}

	public function gradosYGrupos(){
		$resultados = $this->alumno->obtenerGradosYGrupos();
		$respuesta = [];
		$opciones = [];
		foreach($resultados as $resultado) {
			$clave = $resultado->seleccion;
			$data  = ["id_grado" => $resultado->id_grado,
			"id_grupo" => $resultado->id_grupo];
			$add  = [$clave => null];
			$add2  = [$clave => $data];
			array_push($opciones, $add);
			array_push($respuesta, $add2);
		}

		echo json_encode(["opciones" => $opciones, "respuesta" => $respuesta]);
	}

	public function obtenerGrados(){
		echo json_encode($this->alumno->obtenerGrados());
	}
	
	public function obtenerGrupos(){
		echo json_encode($this->alumno->obtenerGrupos());
	}

	public function registrarGrado(){
		$payload =  json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
		if($this->alumno->gradoExiste($payload->nombreGrado)) {
			echo json_encode('EXISTE');
			return;
		}
		echo json_encode($this->alumno->registrarGrado($payload->nombreGrado));
	}

	public function registrarGrupo(){
		$payload =  json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
		if($this->alumno->grupoExiste($payload->nombreGrupo)) {
			echo json_encode('EXISTE');
			return;
		}
		echo json_encode($this->alumno->registrarGrupo($payload->nombreGrupo));
	}
}
