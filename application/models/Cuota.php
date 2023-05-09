<?php
 class Cuota extends CI_Model {

    public function registrar($cuota){
        return $this->db->insert('cuotas', [
            'nombre_cuota' =>$cuota->nombreCuota,
            'descripcion' =>$cuota->descripcionCuota,
            'precio' =>$cuota->precioCuota,
            'fecha_vecimiento' =>$cuota->fechaVencimiento,
            'fecha_registro' => date('Y-m-d H:i:s')
        ]);
    }

    public function eliminar($idCuota){
        $this->db->where('id_cuota', $idCuota);
        $cuotaEliminada =  $this->db->delete('cuotas');
        $eliminadaGrupo = $this->eliminarCuotaGrupo($idCuota);
        return $cuotaEliminada && $eliminadaGrupo;
    }

    public function editar($cuota){
        $this->db->where('id_cuota', $cuota->idCuota);
        return $this->db->update('cuotas', [
            'nombre_cuota' =>$cuota->nombreCuota,
            'descripcion' =>$cuota->descripcionCuota,
            'precio' =>$cuota->precioCuota,
            'fecha_vecimiento' =>$cuota->fechaVencimiento,
        ]);
    }

    public function eliminarCuotaGrupo($idCuota) {
        $this->db->where('id_cuota', $idCuota);
        return $this->db->delete('cuotas_grupos');
    }

    public function numeroPorGrupo(){
        $this->db->select('COUNT(*) AS total, grado_grupo');
        $this->db->group_by('grado_grupo');
        return $this->db->get('cuotas_grupos')->result();
    }

    public function obtenerPorGrupo($idGrado, $idGrupo){
        $this->db->select('cuotas.*');
		$this->db->join('cuotas_grupos', 'cuotas_grupos.id_cuota = cuotas.id_cuota');
		$this->db->where('cuotas_grupos.id_grupo', $idGrupo);
		$this->db->where('cuotas_grupos.id_grado', $idGrado);
		return $this->db->get('cuotas')->result();
    }

    public function obtenerPagadasAlumno($idAlumno, $idCuota) {
        $this->db->where('id_cuota', $idCuota);
        $this->db->where('id_alumno', $idAlumno);
        $resultado = $this->db->get('pagos_alumnos');
        return ($resultado->num_rows() > 0) ? true : false;
    }

    public function pagar($idAlumno, $idCuota, $total){
        return $this->db->insert('pagos_alumnos', [
            'id_cuota' => $idCuota,
            'id_alumno' => $idAlumno,
            'fecha_pago' => date('Y-m-d'),
            'total_pago' => $total
        ]);
    }

    public function obtener($filtros){
        $this->db->select('cuotas.*, GROUP_CONCAT(cuotas_grupos.grado_grupo SEPARATOR ", ") AS grupos');
        $this->db->join('cuotas_grupos', 'cuotas.id_cuota = cuotas_grupos.id_cuota', 'left');
        if(isset($filtros->busqueda)){
            $this->db->where('cuotas_grupos.grado_grupo', $filtros->busqueda);
        }
        $this->db->group_by('cuotas.id_cuota');
        $this->db->order_by('cuotas.id_cuota', 'desc');
        return $this->db->get('cuotas')->result();
    }

    public function obtenerGruposAsignados($idCuota){
        $this->db->where('id_cuota', $idCuota);
        return $this->db->get('cuotas_grupos')->result();
    }

    public function registraCuotaGrupo($idCuota, $idGrado, $idGrupo, $gradoGrupo){
        return $this->db->insert('cuotas_grupos', [
            'id_cuota' => $idCuota,
            'id_grado' => $idGrado,
            'id_grupo' => $idGrupo,
            'grado_grupo' => $gradoGrupo
        ]);
    }

    public function eliminaGrupoCuota($idCuota, $grupo){
        $this->db->where('id_cuota', $idCuota);
        $this->db->where('grado_grupo', $grupo);
        return $this->db->delete('cuotas_grupos');
    }
 }
?>