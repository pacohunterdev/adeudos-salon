<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

    }

	public function index()
	{
		if(!$this->session->userdata('usuario'))  redirect($base."index.php/usuario/login");
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('configuracion');
		$this->load->view('footer');
	}	
}
