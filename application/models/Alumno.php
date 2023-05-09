<?php
 class Alumno extends CI_Model {

    public function obtenerAlumnos($payload){
        $this->db->select('alumnos.primer_nombre, IFNULL(alumnos.segundo_nombre,"") as segundo_nombre,
        alumnos.apellido_paterno, IFNULL(alumnos.apellido_materno,"") as apellido_materno,
        alumnos.nombre_tutor, alumnos.telefono,alumnos.id_alumno, alumnos.estado');
        if(isset($payload->idGrado) && isset($payload->idGrupo)){
            $this->db->where('id_grado', $payload->idGrado);
            $this->db->where('id_grupo', $payload->idGrupo);
        }

        if(isset($payload->buscarPor)) {
            $this->db->like('primer_nombre', $payload->buscarPor);
            $this->db->or_like('segundo_nombre', $payload->buscarPor);
            $this->db->or_like('apellido_paterno', $payload->buscarPor);
            $this->db->or_like('apellido_materno', $payload->buscarPor);
        }

        $this->db->order_by('apellido_paterno');
        return $this->db->get('alumnos')->result();
    }

    public function dadosBaja(){
        $this->db->select('alumnos.*, CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo) AS grupo');
        $this->db->where('estado', 'BAJA');
        $this->db->join('grados', 'grados.id_grado = alumnos.id_grado');
        $this->db->join('grupos', 'grupos.id_grupo = alumnos.id_grupo');
        $this->db->order_by('alumnos.apellido_paterno');
        return $this->db->get('alumnos')->result();
    }

    public function darBaja($idAlumno) {
        $this->db->where('id_alumno', $idAlumno);
        return $this->db->update('alumnos', ['estado' => 'BAJA']);
    }

    public function editar($alumno){
        $this->db->where('id_alumno', $alumno->idAlumno);
        return $this->db->update('alumnos',
            [
                'primer_nombre' => $alumno->nombre,
                'segundo_nombre' => $alumno->segundoNombre,
                'apellido_paterno' => $alumno->apellidoPaterno,
                'apellido_materno' => $alumno->apellidoMaterno,
                'nombre_tutor' => $alumno->nombreTutor,
                'telefono' => $alumno->telefonoTutor
            ]
        );
    }

    public function registrar($alumno){
        return $this->db->insert('alumnos',
            [
                'primer_nombre' => $alumno->nombre,
                'segundo_nombre' => $alumno->segundoNombre,
                'apellido_paterno' => $alumno->apellidoPaterno,
                'apellido_materno' => $alumno->apellidoMaterno,
                'nombre_tutor' => $alumno->nombreTutor,
                'telefono' => $alumno->telefonoTutor,
                'id_grado' => $alumno->idGrado,
                'id_grupo' => $alumno->idGrupo,
                'estado' => 'ACTIVO'
            ]
        );
    }

    public function totalAlumnos(){
        $this->db->select('COUNT(*) AS total');
        $this->db->where('estado', 'ACTIVO');
        return $this->db->get('alumnos')->row();
    }
    
    public function totalBajas(){
        $this->db->select('COUNT(*) AS total');
        $this->db->where('estado', 'BAJA');
        return $this->db->get('alumnos')->row();
    }

    public function obtenerGradosYGrupos(){
        $query = $this->db->query('SELECT grados.id_grado, grupos.id_grupo, 
        CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo)AS seleccion 
        FROM grados 
        CROSS JOIN grupos');
        return $query->result();
    }
    
    public function obtenerGrados(){
        return $this->db->get('grados')->result();
    }
    
    public function obtenerGrupos(){
        return $this->db->get('grupos')->result();
    }

    public function registrarGrado($grado){
        return $this->db->insert('grados', ['nombre_grado'=>$grado]);
    }
    
    public function registrarGrupo($grupo){
        return $this->db->insert('grupos', ['nombre_grupo'=>$grupo]);
    }

    public function gradoExiste($nombre){
        $this->db->where('nombre_grado', $nombre);
        $resultado = $this->db->get('grados');
        return ($resultado->num_rows() > 0) ? true : false;
    }
   
    public function grupoExiste($nombre){
        $this->db->where('nombre_grupo', $nombre);
        $resultado = $this->db->get('grupos');
        return ($resultado->num_rows() > 0) ? true : false;
    }

    public function totalAcBajaGrupo($estado){
        $this->db->select('COUNT(*) AS totalAlumnos, CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo) AS grupo');
        $this->db->join('grados', 'grados.id_grado = alumnos.id_grado');
        $this->db->join('grupos', 'grupos.id_grupo = alumnos.id_grupo');
        $this->db->where('estado', $estado);
        $this->db->group_by('grupo');
        return $this->db->get('alumnos')->result();
    }

 }
?>