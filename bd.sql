create database adeudos_salon;
use adeudos_salon;
create table grados(
    id_grado BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grado varchar(100) not null
);


create table grupos(
    id_grupo BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_grupo varchar(100) not null
);

create table alumnos(
    id_alumno BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_grado BIGINT not null,
    id_grupo BIGINT not null,
    primer_nombre varchar(255) not null,
    segundo_nombre varchar(255),
    apellido_paterno varchar(255) not null,
    apellido_materno varchar(255),
    nombre_tutor varchar(255) not null,
    telefono varchar(20)
);

alter table alumnos add column estado enum('ACTIVO', 'BAJA');


create table cuotas(
    id_cuota BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_cuota varchar(255) not null,
    descripcion varchar(255),
    precio decimal(12,2) not null,
    fecha_vecimiento date,
    fecha_registro date
);

create table cuotas_grupos(
    id_cg BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cuota BIGINT not null,
    id_grado BIGINT not null,
    id_grupo BIGINT not null, 
    grado_grupo varchar(255) not null
);

create table pagos_alumnos(
    id_pago BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cuota BIGINT not null,
    id_alumno BIGINT not null,
    fecha_pago date
);

alter table pagos_alumnos add column total_pago decimal(12,2);

create table configuracion(
    nombre_usuario varchar(255),
    email varchar(255),
    password varchar(255)
);

#CONSULTAS DE AYUDA
select count(*) as totalAlumnos,
CONCAT(grados.nombre_grado, "° ", grupos.nombre_grupo) as grupo 
from alumnos 
inner join grados on grados.id_grado = alumnos.id_grado
inner join grupos on grupos.id_grupo = alumnos.id_grupo
where estado = 'ACTIVO' 
group by grupo;

select concat(grados.nombre_grado, "° ", grupos.nombre_grupo) as grupo,
SUM(cuotas.precio) AS total
from pagos_alumnos
inner join alumnos on alumnos.id_alumno = pagos_alumnos.id_alumno
inner join grupos on grupos.id_grupo =  alumnos.id_grupo
inner join grados on grados.id_grado =  alumnos.id_grado
inner join cuotas on cuotas.id_cuota =  pagos_alumnos.id_cuota 
where date(pagos_alumnos.fecha_pago) = curdate()
group by grupo;

select concat(grados.nombre_grado, "° ", grupos.nombre_grupo) as grupo,
SUM(pagos_alumnos.total_pago) AS total
from pagos_alumnos
left join alumnos on alumnos.id_alumno = pagos_alumnos.id_alumno
left join grupos on grupos.id_grupo =  alumnos.id_grupo
left join grados on grados.id_grado =  alumnos.id_grado
left join cuotas on cuotas.id_cuota =  pagos_alumnos.id_cuota 
group by grupo;


select SUM(cuotas.precio) as total, cuotas.nombre_cuota
from pagos_alumnos
inner join cuotas on cuotas.id_cuota =  pagos_alumnos.id_cuota
where date(pagos_alumnos.fecha_pago)  = curdate()
group by pagos_alumnos.id_cuota;

select 
alumnos.id_alumno, 
concat( 
    alumnos.primer_nombre, " ", 
    IFNULL(alumnos.segundo_nombre, ''), " ", 
    alumnos.apellido_paterno, " ", 
    IFNULL(alumnos.apellido_materno, ''), " ", 
    grados.nombre_grado, "° ", grupos.nombre_grupo) AS 
alumno,
SUM(pagos_alumnos.total_pago) as total 
from pagos_alumnos
join alumnos on pagos_alumnos.id_alumno = alumnos.id_alumno
join grados on grados.id_grado = alumnos.id_grado
join grupos on grupos.id_grupo = alumnos.id_grupo
group by alumnos.id_alumno;