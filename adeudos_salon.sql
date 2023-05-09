-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2023 a las 14:18:17
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adeudos_salon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` bigint(20) UNSIGNED NOT NULL,
  `id_grado` bigint(20) NOT NULL,
  `id_grupo` bigint(20) NOT NULL,
  `primer_nombre` varchar(255) NOT NULL,
  `segundo_nombre` varchar(255) DEFAULT NULL,
  `apellido_paterno` varchar(255) NOT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `nombre_tutor` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado` enum('ACTIVO','BAJA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `id_grado`, `id_grupo`, `primer_nombre`, `segundo_nombre`, `apellido_paterno`, `apellido_materno`, `nombre_tutor`, `telefono`, `estado`) VALUES
(1, 1, 1, 'JOSE', 'FRANCISCO', 'PEREZ', 'RIVERA', 'MARIA ANTONIA CASTRO PEREZ', '2311459687', 'ACTIVO'),
(2, 1, 1, 'JUAN ', '', 'SANCHEZ', 'SANCHEZ', 'PEDRO SANCHEZ', '2348974561', 'ACTIVO'),
(3, 2, 1, 'EDUARDO', 'JOSE', 'RAMIRO', 'JUAREZ', 'RAMIRO RAMIREZ', '1236489751', 'BAJA'),
(4, 2, 1, 'LUCK', '', 'SKYWALKER', '', 'ANAKIN SKYWALKER', '9874562134', 'ACTIVO'),
(5, 2, 1, 'WALTER', 'JAMES', 'WHITE', '', 'HEISENBERG O COMO SE ESCRIBA', '12354512415', 'ACTIVO'),
(6, 3, 1, 'BAR', '', 'SINSO', '', 'HOMERO SINSO', '6545451234', 'ACTIVO'),
(7, 3, 1, 'JESEE', '', 'PINKMAN', '', 'YA NO ME ACUERDO', '6987453214', 'ACTIVO'),
(8, 1, 1, 'EJEMPLO', 'PARA', 'DAR', 'DE BAJA', 'EJEMPLO DE TUTOR', '23114569874', 'BAJA'),
(9, 1, 1, 'JIMMY', '', 'NEUTRON', '', 'JUDY NEUTRON', '8974563214', 'ACTIVO'),
(10, 1, 2, 'LISA', '', 'SINSO', '', 'MARCH SINSO', '9874515435', 'BAJA'),
(11, 1, 2, 'PETER', '', 'PARKER', '', 'TÍA MAY', '6542315875', 'ACTIVO'),
(12, 3, 2, 'JUAN', 'JOSE', 'SANCHEZ', '', 'PACO PEREZ', '3214569874', 'ACTIVO'),
(13, 1, 1, 'ESTEFANIA', NULL, 'MARTA', NULL, 'LAURA AGUILAR SUNYÉ', '1235698742', 'ACTIVO'),
(14, 1, 1, 'QUERALT', 'FRANCISCO', 'LAURA', '', 'JORDI BARRIGA TARDÀ', '1235698742', 'ACTIVO'),
(15, 1, 1, 'JOAN', 'SANTINO', 'JOAN', '', 'DOUNYA BARCONS LARA', '1235698742', 'ACTIVO'),
(16, 1, 1, 'JOAN', 'SEBASTIAN', 'ALEXIA', 'MARTINEZ', 'JULIO AGUILERA TATJÉ', '1235698742', 'ACTIVO'),
(17, 1, 1, 'MARC', 'ANTONIO', 'FERRAN', '', 'ANDREU ALEU PRAT', '1235698742', 'ACTIVO'),
(18, 1, 2, 'JOSEP', NULL, 'CRISTINA', NULL, 'RAMON VALLÉS GIRVENT', '1235698742', 'ACTIVO'),
(19, 1, 2, 'ESTHER', NULL, 'JOSÉ ANTONIO', NULL, 'DAVID-JESE MOLINA GARRIDO', '1235698742', 'ACTIVO'),
(20, 1, 2, 'LAURA', NULL, 'JORDI', NULL, 'ARAN ARISSA HERMOSO', '1235698742', 'ACTIVO'),
(21, 1, 2, 'RAQUEL', NULL, 'BEGONYA', NULL, 'GEMMA BARALDÉS PARDO', '1235698742', 'ACTIVO'),
(22, 1, 2, 'JOAN', NULL, 'INGRID', NULL, 'IVAN SUAREZ GARZÓN', '1235698742', 'ACTIVO'),
(23, 1, 2, 'MARIA ISABEL', NULL, 'MIQUEL', NULL, 'DAVID ARPA MORENO', '1235698742', 'ACTIVO'),
(24, 1, 2, 'ADRIÀ', NULL, 'AGUSTÍ', NULL, 'XAVIER ALOY FARRANDO', '1235698742', 'ACTIVO'),
(25, 1, 2, 'GERARD', NULL, 'ANTONI', NULL, 'MARIO LUQUE GARRIGASAIT', '1235698742', 'ACTIVO'),
(26, 1, 2, 'ELIOT', NULL, 'JOAN', NULL, 'JESUS RIDÓ GÓMEZ', '1235698742', 'ACTIVO'),
(27, 1, 2, 'JORDI', NULL, 'MÒNICA', NULL, 'GEMMA SANTAMARIA FLOTATS', '1235698742', 'ACTIVO'),
(28, 1, 2, 'LLUÍS', NULL, 'GERARD', NULL, 'SILVIA HERMS GÓMEZ', '1235698742', 'ACTIVO'),
(29, 1, 2, 'LAURA', NULL, 'GEMMA', NULL, 'ALBERT ARTIGAS MATURANO', '1235698742', 'ACTIVO'),
(30, 1, 2, 'JORDI', NULL, 'MARIA', NULL, 'MARIA AGUILAR MASANA', '1235698742', 'ACTIVO'),
(31, 1, 2, 'DOUNYA', NULL, 'ORIOL', NULL, 'BERTA ALTIMIRAS SERAROLS', '1235698742', 'ACTIVO'),
(32, 2, 1, 'JULIO', NULL, 'VIRGINIA', NULL, 'BERTA TORRESCASANA GARCIA', '1235698742', 'ACTIVO'),
(33, 2, 1, 'ANDREU', NULL, 'DAMIÀ', NULL, 'MIREIA ARIZA PUIGBÓ', '1235698742', 'ACTIVO'),
(34, 2, 1, 'RAMON', NULL, 'VALENTÍ', NULL, 'GEMMA ALVAREZ ARMENTEROS', '1235698742', 'ACTIVO'),
(35, 2, 2, 'DAVID-JESE', NULL, 'AINA', NULL, 'MARIA ISABEL BARALDÉS TARRAGÓ', '1235698742', 'BAJA'),
(36, 2, 2, 'ARAN', NULL, 'DAVID', NULL, 'TONI GARCIA GARCÍA', '1235698742', 'BAJA'),
(37, 2, 2, 'GEMMA', NULL, 'GERARD', NULL, 'ALEJANDRO AROCA GÓMEZ', '1235698742', 'ACTIVO'),
(38, 2, 2, 'IVAN', NULL, 'MARTA', NULL, 'JOAN MARTÍ ALONSO RODRIGUEZ', '1235698742', 'ACTIVO'),
(39, 2, 2, 'DAVID', NULL, 'MIREIA', NULL, 'INGRID CANO GÓMEZ', '1235698742', 'ACTIVO'),
(40, 2, 2, 'XAVIER', 'FERNANDO', 'ELOI', 'RAMIREZ', 'OLIVER ALCAIDE MOLINA', '1235698742', 'BAJA'),
(41, 2, 2, 'MARIO', NULL, 'ANNA', NULL, 'SANDRA AGUILERA PRAT', '1235698742', 'ACTIVO'),
(42, 2, 2, 'JESUS', NULL, 'ALBA', NULL, 'JORDI ALAPONT ICART', '1235698742', 'ACTIVO'),
(43, 2, 2, 'GEMMA', NULL, 'SANDRA', NULL, 'MARC RIVERO FLORIDO', '1235698742', 'ACTIVO'),
(44, 2, 2, 'SILVIA', NULL, 'ERIC', NULL, 'JORDINA AVILA MASJUAN', '1235698742', 'ACTIVO'),
(45, 3, 1, 'ALBERT', NULL, 'LLUÍS', NULL, 'MARIA JOSÉ GRANADOS ANDRÉS', '1235698742', 'ACTIVO'),
(46, 3, 1, 'MARIA', NULL, 'CRISTIAN', NULL, 'RAQUEL FERRER GASSET', '1235698742', 'ACTIVO'),
(47, 3, 1, 'BERTA', NULL, 'GUILLEM', NULL, 'ENRIC AMIGO MODREGO', '1235698742', 'ACTIVO'),
(48, 3, 1, 'BERTA', NULL, 'DIMAS', NULL, 'MARTA ABDIN TATJÈ', '1235698742', 'ACTIVO'),
(49, 3, 1, 'MIREIA', NULL, 'ANA INÉS', NULL, 'CARLA CANELLAS GOMEZ', '1235698742', 'ACTIVO'),
(50, 3, 1, 'GEMMA', NULL, 'IVET', NULL, 'MARIA NOELIA HIDALGO ALTIMIRAS', '1235698742', 'ACTIVO'),
(51, 3, 1, 'MARIA ISABEL', NULL, 'JÚLIA', NULL, 'CRISTINA BASTARDAS FRANCH', '1235698742', 'ACTIVO'),
(52, 1, 2, 'TONI', NULL, 'DANIEL', NULL, 'CARLOS ABADIAS MASANA', '1235698742', 'ACTIVO'),
(53, 3, 2, 'ALEJANDRO', NULL, 'ABEL', NULL, 'DAVID AREVALO SANCHEZ', '1235698742', 'BAJA'),
(54, 3, 2, 'JOAN MARTÍ', NULL, 'IRENE', NULL, 'CRISTIAN ALINS MULET', '1235698742', 'ACTIVO'),
(55, 3, 2, 'INGRID', NULL, 'ADRIÀ', NULL, 'JULIO ALBERTO GARCIA GONZÁLEZ', '1235698742', 'ACTIVO'),
(56, 3, 2, 'OLIVER', NULL, 'JAIRO', NULL, 'SERGI ALVAREZ PARCERISA', '1235698742', 'ACTIVO'),
(57, 3, 2, 'SANDRA', NULL, 'CRISTINA', NULL, 'ALEIX CASAS ANDRÉS', '1235698742', 'ACTIVO'),
(58, 3, 2, 'JORDI', NULL, 'DAVID', NULL, 'VERÒNICA MORALES GESE', '1235698742', 'ACTIVO'),
(59, 3, 2, 'MARC', NULL, 'ADRIÀ', NULL, 'MARIONA BARALDÉS MARTORELL', '1235698742', 'ACTIVO'),
(60, 3, 2, 'JORDINA', NULL, 'LUCIA', NULL, 'MARC AROCA GÓMEZ', '1235698742', 'ACTIVO'),
(61, 3, 2, 'MARIA JOSÉ', 'JUAREZ', 'CARLA', '', 'GEMMA RUEDA ALVAREZ', '1235698742', 'ACTIVO'),
(62, 3, 2, 'RAQUEL', NULL, 'ADRIÀ', NULL, 'RICARD ALVAREZ DOMENECH', '1235698742', 'ACTIVO'),
(63, 3, 2, 'ENRIC', NULL, 'MARTA', NULL, 'JUAN BOIX GONZÁLEZ', '1235698742', 'ACTIVO'),
(64, 3, 2, 'MARTA', NULL, 'MARC', NULL, 'MARTA BARALDÉS MONRÓS', '1235698742', 'ACTIVO'),
(65, 3, 2, 'CARLA', NULL, 'ALEX', NULL, 'NATÀLIA AGUILERA MERINO', '1235698742', 'BAJA'),
(66, 1, 3, 'MARIO', 'ARTURO', 'PEREZ', '', 'ARTURO PEREZ', '3214568745', 'ACTIVO'),
(67, 3, 3, 'EDUARDO', 'PEDRO', 'MARTINEZ', '', 'EDUARDO PEREZ', '9874563201', 'BAJA'),
(68, 2, 3, 'BENITO', 'JUANITO', 'SUAREZ', '', 'MARIA DOLORES', '9874563210', 'ACTIVO'),
(69, 1, 1, 'CRISTOFER', '', 'JUAREZ', '', 'MARIA RIVERA', '23145678', 'ACTIVO'),
(70, 1, 1, 'ALFREDO', '', 'MERCURIO', '', 'KILLER QUEEN', '2311455715', 'ACTIVO'),
(71, 1, 1, 'RIGOBERTO', '', 'MARTINEZ', '', 'RICARDO MARTINEZ', '9874562135', 'ACTIVO'),
(72, 3, 3, 'ELVIS', '', 'PRESLEY', '', 'PRESLEY', '232132545354', 'ACTIVO'),
(73, 1, 1, 'CHRISSS', '', 'CORNELLL', '', 'NOMBREEE', '784545413214', 'ACTIVO'),
(74, 2, 2, 'EJEMPLO ', 'DE', 'OTRO', 'ALUMNOOO', 'PANFILO', '5369841234', 'ACTIVO'),
(75, 1, 2, 'GUSTAVO', '', 'CERATI', '', 'SPINETTA', '32145698745', 'ACTIVO'),
(76, 3, 3, 'ROBERTO', '', 'PEREZ', 'PEREZ', 'JUAN HERNANDEZ', '1231254545', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `nombre_usuario` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`nombre_usuario`, `email`, `password`) VALUES
('paco_hunter_dev', 'paco@gmail.com', '$2y$10$SZvJP0etRNRJd5/O3Qe4Luc88Pr6wFEjhnnQmZa259P31TAr88obm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE `cuotas` (
  `id_cuota` bigint(20) UNSIGNED NOT NULL,
  `nombre_cuota` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(12,2) NOT NULL,
  `fecha_vecimiento` date DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id_cuota`, `nombre_cuota`, `descripcion`, `precio`, `fecha_vecimiento`, `fecha_registro`) VALUES
(1, 'DIA DEL NIÑO', 'COMPRA DE COSAS', '100.00', '2023-04-19', '2023-04-18'),
(2, 'DÍA DE LAS MADRES', 'COMPRA DE REGALOS', '50.00', '2023-05-09', '2023-04-18'),
(4, 'EJEMPLO', '', '30.00', '2023-05-06', '2023-04-18'),
(5, 'GRADUACION', 'PAGO PARA LA GRADUACION', '200.00', '2023-06-30', '2023-04-19'),
(6, 'PAGO', 'obligatorio', '50.00', '2023-06-25', '2023-04-20'),
(7, 'EXAMEN FINAL DE CURSO', '', '10.00', '2023-06-06', '2023-04-20'),
(8, 'EJEMPLO DE CUOTA', '', '50.00', '2023-04-23', '2023-04-21'),
(9, 'PAGO DIA DEL MAESTRO', '', '50.00', '2023-05-15', '2023-04-24'),
(11, 'PAGO PARA ALGO', '', '52.00', '2023-07-21', '2023-05-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas_grupos`
--

CREATE TABLE `cuotas_grupos` (
  `id_cg` bigint(20) UNSIGNED NOT NULL,
  `id_cuota` bigint(20) NOT NULL,
  `id_grado` bigint(20) NOT NULL,
  `id_grupo` bigint(20) NOT NULL,
  `grado_grupo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuotas_grupos`
--

INSERT INTO `cuotas_grupos` (`id_cg`, `id_cuota`, `id_grado`, `id_grupo`, `grado_grupo`) VALUES
(1, 1, 1, 1, '1° A'),
(2, 1, 2, 1, '2° A'),
(3, 1, 3, 1, '3° A'),
(5, 2, 3, 2, '3° B'),
(6, 2, 1, 1, '1° A'),
(7, 2, 2, 2, '2° B'),
(11, 1, 1, 2, '1° B'),
(12, 1, 2, 2, '2° B'),
(13, 4, 1, 1, '1° A'),
(14, 4, 2, 2, '2° B'),
(15, 5, 3, 1, '3° A'),
(16, 5, 3, 2, '3° B'),
(17, 6, 1, 1, '1° A'),
(18, 6, 2, 2, '2° B'),
(19, 6, 3, 3, '3° C'),
(20, 7, 1, 1, '1° A'),
(21, 7, 3, 1, '3° A'),
(22, 7, 2, 3, '2° C'),
(23, 8, 1, 3, '1° C'),
(24, 8, 2, 2, '2° B'),
(25, 9, 1, 2, '1° B'),
(26, 9, 2, 3, '2° C'),
(27, 11, 1, 2, '1° B'),
(28, 11, 2, 3, '2° C'),
(29, 11, 3, 3, '3° C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` bigint(20) UNSIGNED NOT NULL,
  `nombre_grado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`) VALUES
(1, '1'),
(2, '2'),
(3, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` bigint(20) UNSIGNED NOT NULL,
  `nombre_grupo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_alumnos`
--

CREATE TABLE `pagos_alumnos` (
  `id_pago` bigint(20) UNSIGNED NOT NULL,
  `id_cuota` bigint(20) NOT NULL,
  `id_alumno` bigint(20) NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `total_pago` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos_alumnos`
--

INSERT INTO `pagos_alumnos` (`id_pago`, `id_cuota`, `id_alumno`, `fecha_pago`, `total_pago`) VALUES
(1, 1, 9, '2023-04-18', '100.00'),
(2, 3, 9, '2023-04-18', '20.00'),
(3, 2, 4, '2023-04-18', '50.00'),
(4, 3, 4, '2023-04-18', '20.00'),
(5, 1, 7, '2023-04-18', '100.00'),
(6, 1, 6, '2023-04-18', '100.00'),
(7, 2, 12, '2023-04-19', '50.00'),
(8, 1, 40, '2023-04-19', '100.00'),
(9, 1, 34, '2023-04-19', '100.00'),
(10, 4, 39, '2023-04-19', '30.00'),
(11, 2, 39, '2023-04-19', '50.00'),
(12, 1, 24, '2023-04-19', '100.00'),
(13, 1, 49, '2023-04-19', '100.00'),
(14, 1, 45, '2023-04-19', '100.00'),
(15, 2, 58, '2023-04-19', '50.00'),
(16, 5, 45, '2023-04-19', '200.00'),
(17, 1, 47, '2023-04-19', '100.00'),
(18, 5, 47, '2023-04-19', '200.00'),
(19, 1, 16, '2023-04-20', '100.00'),
(20, 4, 16, '2023-04-20', '30.00'),
(21, 1, 17, '2023-04-20', '100.00'),
(22, 1, 14, '2023-04-20', '100.00'),
(23, 4, 69, '2023-04-20', '30.00'),
(24, 1, 69, '2023-04-20', '100.00'),
(25, 2, 44, '2023-04-20', '50.00'),
(26, 2, 17, '2023-04-20', '50.00'),
(27, 4, 44, '2023-04-21', '30.00'),
(28, 6, 44, '2023-04-21', '50.00'),
(29, 8, 44, '2023-04-21', '50.00'),
(30, 8, 43, '2023-04-21', '50.00'),
(31, 7, 69, '2023-04-21', '10.00'),
(32, 5, 57, '2023-04-24', '200.00'),
(33, 2, 59, '2023-04-24', '50.00'),
(34, 5, 59, '2023-04-24', '200.00'),
(35, 1, 71, '2023-04-24', '100.00'),
(36, 9, 24, '2023-04-24', '50.00'),
(37, 4, 70, '2023-05-09', '30.00'),
(38, 7, 70, '2023-05-09', '10.00'),
(39, 2, 16, '2023-05-09', '50.00'),
(40, 7, 16, '2023-05-09', '10.00'),
(41, 6, 16, '2023-05-09', '50.00'),
(42, 9, 52, '2023-05-09', '50.00'),
(43, 1, 52, '2023-05-09', '100.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id_cuota`);

--
-- Indices de la tabla `cuotas_grupos`
--
ALTER TABLE `cuotas_grupos`
  ADD PRIMARY KEY (`id_cg`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `pagos_alumnos`
--
ALTER TABLE `pagos_alumnos`
  ADD PRIMARY KEY (`id_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  MODIFY `id_cuota` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuotas_grupos`
--
ALTER TABLE `cuotas_grupos`
  MODIFY `id_cg` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagos_alumnos`
--
ALTER TABLE `pagos_alumnos`
  MODIFY `id_pago` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
