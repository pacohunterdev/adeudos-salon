<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('pago');
        $this->load->library('session');
    }

	public function index()
	{
        if(!$this->session->userdata('usuario'))  redirect($base."index.php/usuario/login");
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('pagos/index');
		$this->load->view('footer');
	}	

    public function obtener(){
        $payload = json_decode(file_get_contents('php://input'));
        echo json_encode($this->pago->obtener($payload->filtros));
    }

    public function porGrupos(){
        $payload = json_decode(file_get_contents('php://input'));
        echo json_encode($this->pago->obtenerPorGrupos($payload->filtros));
    }
    
    public function porCuotas(){
        $payload = json_decode(file_get_contents('php://input'));
        echo json_encode($this->pago->obtenerPorCuota($payload->filtros));
    }
    
    public function porAlumno(){
        $payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
        echo json_encode($this->pago->obtenerPorAlumno($payload->idAlumno));
    }
}
