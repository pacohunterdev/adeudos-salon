<?php
 class Pago extends CI_Model {

    public function obtenerPorAlumno($idAlumno){
        $this->db->select('CONCAT(cuotas.nombre_cuota, ": ",
        cuotas.descripcion) AS cuota, pagos_alumnos.total_pago AS precio, cuotas.fecha_vecimiento,
        pagos_alumnos.fecha_pago');
        $this->db->where('pagos_alumnos.id_alumno', $idAlumno);
        $this->db->join('cuotas', 'pagos_alumnos.id_cuota = cuotas.id_cuota', 'left');
        return $this->db->get('pagos_alumnos')->result();
    }

    public function obtenerPorCuota($filtros){
        $this->db->select('SUM(pagos_alumnos.total_pago) AS total, cuotas.nombre_cuota');
        $this->db->join('cuotas', 'cuotas.id_cuota =  pagos_alumnos.id_cuota', 'left');

        if(isset($filtros->fecha)) {
            $this->db->where('DATE(pagos_alumnos.fecha_pago) >=', $filtros->fecha->inicio);
            $this->db->where('DATE(pagos_alumnos.fecha_pago) <=', $filtros->fecha->fin);
        } 

        if(isset($filtros->grupo)) {
            $this->db->join('alumnos', 'alumnos.id_alumno=  pagos_alumnos.id_alumno');
            //$this->db->join('cuotas_grupos', 'cuotas.id_cuota =  cuotas_grupos.id_cuota');
            $this->db->where('alumnos.id_grado', $filtros->grupo->grado);
            $this->db->where('alumnos.id_grupo', $filtros->grupo->grupo);
        }
        
        
        if(!isset($filtros->fecha)  && !isset($filtros->grupo)) 
            $this->db->where('DATE(pagos_alumnos.fecha_pago)', 'CURDATE()', FALSE);
        
            $this->db->group_by('pagos_alumnos.id_cuota');
        return $this->db->get('pagos_alumnos')->result();
    }

    public function obtenerPorGrupos($filtros){
        $this->db->select('CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo) AS grupo,
        SUM(pagos_alumnos.total_pago) AS total');
        $this->db->join('alumnos', 'alumnos.id_alumno = pagos_alumnos.id_alumno', 'left');
        $this->db->join('grupos', 'grupos.id_grupo =  alumnos.id_grupo', 'left');
        $this->db->join('grados', 'grados.id_grado =  alumnos.id_grado', 'left');
        $this->db->join('cuotas', 'cuotas.id_cuota =  pagos_alumnos.id_cuota', 'left');
        if(isset($filtros->fecha)) {
            $this->db->where('DATE(pagos_alumnos.fecha_pago) >=', $filtros->fecha->inicio);
            $this->db->where('DATE(pagos_alumnos.fecha_pago) <=', $filtros->fecha->fin);
        }

        if(isset($filtros->grupo)) {
            $this->db->where('grados.id_grado', $filtros->grupo->grado);
            $this->db->where('grupos.id_grupo', $filtros->grupo->grupo);
        }

        if(!isset($filtros->fecha) && !isset($filtros->grupo)) 
            $this->db->where('DATE(pagos_alumnos.fecha_pago)', 'CURDATE()', FALSE);
        $this->db->group_by('grupo');
        return $this->db->get('pagos_alumnos')->result();
    }

    public function obtener($filtros){
        $this->db->select('CONCAT(alumnos.primer_nombre, " ", 
        IFNULL(alumnos.segundo_nombre, ""), " ", alumnos.apellido_paterno, " ",
        IFNULL(alumnos.apellido_materno, "")) AS alumno, alumnos.id_alumno, CONCAT(cuotas.nombre_cuota, ": ",
        cuotas.descripcion) AS cuota, pagos_alumnos.total_pago AS precio, pagos_alumnos.fecha_pago,
        CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo) AS grupo');
        $this->db->join('alumnos', 'alumnos.id_alumno = pagos_alumnos.id_alumno', 'left');
        $this->db->join('cuotas', 'cuotas.id_cuota = pagos_alumnos.id_cuota', 'left');
        $this->db->join('grados', 'grados.id_grado = alumnos.id_grado', 'left');
        $this->db->join('grupos', 'grupos.id_grupo = alumnos.id_grupo', 'left');

        if(isset($filtros->grupo)) {
            $this->db->where('alumnos.id_grado', $filtros->grupo->grado);
            $this->db->where('alumnos.id_grupo', $filtros->grupo->grupo);
        }
        
        if(isset($filtros->fecha)) {
            $this->db->where('DATE(pagos_alumnos.fecha_pago) >=', $filtros->fecha->inicio);
            $this->db->where('DATE(pagos_alumnos.fecha_pago) <=', $filtros->fecha->fin);
        } 
        if(!isset($filtros->fecha) && !isset($filtros->grupo)) 
            $this->db->where('DATE(pagos_alumnos.fecha_pago)', 'CURDATE()', FALSE);
        
        
        return $this->db->get('pagos_alumnos')->result();
    }

    public function obtenerTotal(){
        $this->db->select('SUM(total_pago) AS total');
        return $this->db->get('pagos_alumnos')->row();
    }

    public function pagosPorGrupo(){
        $this->db->select('CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo) AS grupo,
        SUM(pagos_alumnos.total_pago) AS total');
        $this->db->join('alumnos', 'alumnos.id_alumno = pagos_alumnos.id_alumno', 'left');
        $this->db->join('grupos', 'grupos.id_grupo =  alumnos.id_grupo', 'left');
        $this->db->join('grados', 'grados.id_grado =  alumnos.id_grado', 'left');
        $this->db->join('cuotas', 'cuotas.id_cuota =  pagos_alumnos.id_cuota', 'left');
        $this->db->group_by('grupo');
        return $this->db->get('pagos_alumnos')->result();

    }
    
    public function totalHoy(){
        $this->db->select('IFNULL(SUM(total_pago),0) AS total');
        $this->db->where('DATE(fecha_pago)', 'CURDATE()', FALSE);
        return $this->db->get('pagos_alumnos')->row();
    }

    public function totalSemana(){
        $this->db->select('IFNULL(SUM(total_pago), 0) AS total');
        $this->db->where('WEEK(fecha_pago)', 'WEEK(NOW())', FALSE);
        return $this->db->get('pagos_alumnos')->row();
    }

    public function totalMes(){
        $this->db->select('IFNULL(SUM(total_pago), 0) AS total');
        $this->db->where('MONTH(fecha_pago)', 'MONTH(CURRENT_DATE())', FALSE);
        $this->db->where('YEAR(fecha_pago)', 'YEAR(CURRENT_DATE())', FALSE);
        return $this->db->get('pagos_alumnos')->row();
    }

    public function pagosAlumnos(){
        $this->db->select('CONCAT(alumnos.primer_nombre, " ", IFNULL(alumnos.segundo_nombre,""), " ", alumnos.apellido_paterno,
        " ", IFNULL(alumnos.apellido_materno,""), " ", grados.nombre_grado, "° ", grupos.nombre_grupo) AS alumno,
        SUM(pagos_alumnos.total_pago) AS total ');
        $this->db->join('pagos_alumnos', 'pagos_alumnos.id_alumno = alumnos.id_alumno');
        $this->db->join('grados', 'grados.id_grado = alumnos.id_grado');
        $this->db->join('grupos', 'grupos.id_grupo = alumnos.id_grupo');
        $this->db->group_by('alumnos.id_alumno');
        return $this->db->get('alumnos')->result();
    }

    public function pagosCuotas(){
        $this->db->select('cuotas.nombre_cuota, SUM(pagos_alumnos.total_pago) AS total');
        $this->db->join('cuotas', 'cuotas.id_cuota = pagos_alumnos.id_cuota');
        $this->db->group_by('cuotas.id_cuota');
        return $this->db->get('pagos_alumnos')->result();
    }
}
?>
