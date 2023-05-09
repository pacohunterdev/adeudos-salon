<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('usuarios');
    }

	public function login()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

    public function salir(){
        $this->session->unset_userdata('usuario');
        $this->session->unset_userdata('email');
        $this->session->sess_destroy();
        redirect(base_url()."index.php/usuario/login");
    }

    public function obtener(){
        echo json_encode($this->usuarios->obtener());
    }

    public function editar(){
        $payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

		echo json_encode($this->usuarios->editar($payload));
    }

    public function cambiarPassword(){
        $payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');
        
        if(!$this->usuarios->verificar($payload->actual)){
            echo json_encode('INCORRECTO');
            return;
        }

        echo json_encode($this->usuarios->cambiar(password_hash($payload->nueva, PASSWORD_DEFAULT)));
    }

    public function inciarSesion(){
        $base =  base_url();
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
        $resultado = $this->usuarios->iniciar($usuario, $password);
        if(!$resultado){
            $this->session->set_flashdata('mensaje', 'Datos incorrectos, revisa la información');
            redirect($base."index.php/usuario/login");
        }
        $this->session->set_userdata('usuario', $resultado->nombre_usuario); 
        $this->session->set_userdata('email', $resultado->email); 
        $this->session->set_flashdata('mensaje', 'Datos correcto, bienvenido');
        
        redirect($base."index.php/inicio/index");
    }

    public function recuperar(){
        $payload = json_decode(file_get_contents('php://input'));
		if(!$payload) exit('No se estableció información :(');

        $datos = $this->usuarios->obtener();
        if($datos->nombre_usuario !== $payload->usuario
        || $datos->email !== $payload->email){
            echo json_encode(false);
            return;
        }

        echo json_encode($this->usuarios->cambiar(password_hash($payload->nueva, PASSWORD_DEFAULT)));
    }

}
