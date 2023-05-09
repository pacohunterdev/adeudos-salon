<?php
 class Usuarios extends CI_Model {
    public function iniciar($usuario, $password){
        $this->db->where('nombre_usuario', $usuario);
        $datos = $this->db->get('configuracion')->row();
        if (password_verify($password, $datos->password)) {
            return $datos;
        }
        return false;
    }

    public function obtener(){
        return $this->db->get('configuracion')->row();
    }

    public function editar($usuario){
        return $this->db->update('configuracion',[
            'nombre_usuario' => $usuario->nombre,
            'email' => $usuario->email
        ]);
    }

    public function verificar($password){
        $this->db->select('password');
        $pass = $this->db->get('configuracion')->row()->password;
        return password_verify($password, $pass);
    }

    public function cambiar($nuevaPassword){
        return $this->db->update('configuracion', ['password' => $nuevaPassword]);
    }


}
?>
