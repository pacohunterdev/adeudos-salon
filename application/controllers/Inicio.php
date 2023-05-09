<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('pago');
		$this->load->model('alumno');
		$this->load->library('session');

    }

	public function index()
	{
		if(!$this->session->userdata('usuario'))  redirect($base."index.php/usuario/login");
		$data['totalesGenerales'] = $this->totales();
		$data['totalesGrupos'] = $this->totalesGrupo();
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('inicio/index', $data);
		$this->load->view('footer');
	}

	public function pagosAlumnos(){
		echo json_encode ($this->pago->pagosAlumnos());
	}
	
	public function pagosCuotas(){
		echo json_encode ($this->pago->pagosCuotas());
	}
	
	public function pagosPorGrupo(){
		echo json_encode ($this->pago->pagosPorGrupo());
	}

	public function totales() {
		return [
			[
				'titulo' => 'Alumnos', 
				'total' => $this->alumno->totalAlumnos()->total,
				'color' => 'deep-purple darken-2',
				'imagen' => 'https://cdn-icons-png.flaticon.com/512/1046/1046270.png'
			],
			[
				'titulo' => 'Bajas', 
				'total' => $this->alumno->totalBajas()->total,
				'color' => ' deep-purple darken-3',
				'imagen' => 'https://cdn-icons-png.flaticon.com/512/2444/2444466.png'
			],
			[
				'titulo' => 'Pagos', 
				'total' => $this->pago->obtenerTotal()->total,
				'color' => ' deep-purple darken-4',
				'imagen' => 'https://cdn-icons-png.flaticon.com/512/2489/2489650.png'
			],
			[
				'titulo' => '$Hoy', 
				'total' => $this->pago->totalHoy()->total,
				'color' => ' purple darken-2',
				'imagen' => 'https://creazilla-store.fra1.digitaloceanspaces.com/cliparts/70458/calendar-clipart-xl.png'
			],
			[
				'titulo' => '$Semana', 
				'total' => $this->pago->totalSemana()->total,
				'color' => ' purple darken-3',
				'imagen' => 'https://img.icons8.com/doodle/512/calendar-week.png'
			],
			[
				'titulo' => '$Mes', 
				'total' => $this->pago->totalMes()->total,
				'color' => ' purple darken-4',
				'imagen' => 'https://www.freeiconspng.com/thumbs/calendar-image-png/calendar-image-png-3.png'
			],
		];

	}

	public function totalesGrupo(){
		$grupos = $this->alumno->obtenerGradosYGrupos();
		$activosGrupo = $this->alumno->totalAcBajaGrupo('ACTIVO');
		$bajasGrupo = $this->alumno->totalAcBajaGrupo('BAJA');
		$pagosGrupo = $this->pago->pagosPorGrupo();

		foreach($grupos as $grupo) {
			foreach($activosGrupo as $activo) {
				if($grupo->seleccion === $activo->grupo) {
					$grupo->activos = $activo->totalAlumnos;
				} 
			}
		}
		
		foreach($grupos as $grupo) {
			foreach($bajasGrupo as $baja) {
				if($grupo->seleccion === $baja->grupo) $grupo->bajas = $baja->totalAlumnos;
			}
		}
		
		foreach($grupos as $grupo) {
			foreach($pagosGrupo as $pago) {
				if($grupo->seleccion === $pago->grupo) $grupo->pagos = $pago->total;
			}
		}
		return $grupos;
	}
}