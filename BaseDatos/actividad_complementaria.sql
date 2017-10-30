-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2017 a las 22:04:23
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `actividad_complementaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_comp`
--

CREATE TABLE IF NOT EXISTS `actividad_comp` (
  `clave_act` int(11) NOT NULL,
  `nombre_act` varchar(45) NOT NULL,
  PRIMARY KEY (`clave_act`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividad_comp`
--

INSERT INTO `actividad_comp` (`clave_act`, `nombre_act`) VALUES
(1, 'Tutorias'),
(2, 'Ajedrez'),
(3, 'FÃºtbol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `clave_carrera` varchar(20) NOT NULL,
  `nombre_carrera` varchar(45) NOT NULL,
  PRIMARY KEY (`clave_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`clave_carrera`, `nombre_carrera`) VALUES
('COPU-2010-205', 'Contador Público'),
('IAGR-2010-214', 'Ingeniería en Agronomía'),
('IAMD-2010-213', 'Ingeniería en Administración'),
('IINF-2010-220', 'Ingeniería en Informática'),
('LADM-2010-234', 'Licenciatura en Administración'),
('LBIO-2010-233', 'Licenciatura en Biología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `rfc_dep` varchar(13) NOT NULL,
  `nombre_dep` varchar(45) NOT NULL,
  `trabajador_rfc` varchar(20) NOT NULL,
  PRIMARY KEY (`rfc_dep`,`trabajador_rfc`),
  KEY `fk_departamento_trabajador1_idx` (`trabajador_rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`rfc_dep`, `nombre_dep`, `trabajador_rfc`) VALUES
('DAG0314HMZTR', 'Desarrollo academico', 'GOVL801204159');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE IF NOT EXISTS `estudiante` (
  `n_control` int(11) NOT NULL,
  `a_paterno_e` varchar(45) NOT NULL,
  `a_materno_e` varchar(45) NOT NULL,
  `nombre_estudiante` varchar(45) NOT NULL,
  `semestre` varchar(45) NOT NULL,
  `firma` varchar(45) NOT NULL,
  `carrera_clave` varchar(20) NOT NULL,
  PRIMARY KEY (`n_control`),
  KEY `fk_estudiante_carrera_idx` (`carrera_clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`n_control`, `a_paterno_e`, `a_materno_e`, `nombre_estudiante`, `semestre`, `firma`, `carrera_clave`) VALUES
(14930123, 'Martinez', 'Perez', 'Jesus', 'VI', '', 'IAGR-2010-214'),
(15930012, 'Antunez', 'Lopez', 'Maria', 'V', '', 'LBIO-2010-233'),
(15930163, 'Alcantar', 'Medrano', 'Alan Henry', 'V', '', 'IINF-2010-220'),
(15930164, 'Alonso', 'Cruz', 'Lucas Alberto', 'V', '', 'IINF-2010-220'),
(15930167, 'Benitez', 'Bartolo', 'Paola Rubi', 'V', '', 'IINF-2010-220'),
(15930168, 'Cabrera', 'Torres', 'Neftali', 'V', '', 'IINF-2010-220'),
(15930170, 'Carranza', 'Diaz', 'Mario de Jesus', 'V', '', 'IINF-2010-220'),
(15930178, 'Garcia', 'Pineda', 'Ernesto Quintin', 'V', '', 'IINF-2010-220'),
(15930185, 'Jaimes', 'Gutierrez', 'Alondra', 'V', '', 'IINF-2010-220'),
(15930187, 'Maldonado', 'Miranda', 'Evelia', 'V', '', 'IINF-2010-220'),
(15930194, 'Ocampo', 'Millan', 'Jorge Luis', 'V', '', 'IINF-2010-220'),
(15930200, 'Ortiz', 'Lopez', 'Jose Ramon', 'V', '', 'IINF-2010-220'),
(15930208, 'Roque', 'Pineda', 'Jorge Luis', 'V', '', 'IINF-2010-220'),
(15930210, 'Ruiz', 'Gutierrez', 'Carlos Alberto', 'V', 'car10s', 'IINF-2010-220'),
(15930216, 'Santana', 'Benitez', 'Hernan', 'V', '', 'IINF-2010-220'),
(15930218, 'Urieta', ' Albarran', 'Jonathan ', 'V', '', 'IINF-2010-220'),
(15930219, 'Valle', 'Toledo', 'Marco Antonio', 'V', '', 'IINF-2010-220'),
(15930221, 'Vivas', 'Pineda', 'Agustin', 'V', '', 'IINF-2010-220'),
(15930227, 'Alonso', 'Ignacio', 'Cristian', 'V', '', 'IINF-2010-220');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituto`
--

CREATE TABLE IF NOT EXISTS `instituto` (
  `clave` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instituto`
--

INSERT INTO `instituto` (`clave`, `nombre`) VALUES
('12DIT0005A', 'Instituto Tecnologico de Cd. Altamirano'),
('12DIT0005B', 'Tecnologico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `rfc_inst` varchar(13) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `a_paterno` varchar(45) NOT NULL,
  `a_materno` varchar(45) NOT NULL,
  `actividad_comp_clave_act` int(11) NOT NULL,
  PRIMARY KEY (`rfc_inst`,`actividad_comp_clave_act`),
  KEY `fk_instructor_actividad_comp1_idx` (`actividad_comp_clave_act`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`rfc_inst`, `nombre`, `a_paterno`, `a_materno`, `actividad_comp_clave_act`) VALUES
('ERTC', 'Erick', 'Zarate', 'Alvarez', 2),
('GDSW123456789', 'Pedro', 'Vazquez', 'Toledo', 3),
('GOVL801204159', 'Leonel', 'González', 'Vidales', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `fecha` date NOT NULL,
  `asunto` varchar(45) NOT NULL,
  `folio` int(11) NOT NULL,
  `instituto_clave` varchar(20) NOT NULL,
  `estudiante_n_control` int(11) NOT NULL,
  `actividad_comp_clave_act` int(11) NOT NULL,
  `trabajador_rfc` varchar(20) NOT NULL,
  PRIMARY KEY (`folio`,`estudiante_n_control`,`actividad_comp_clave_act`,`trabajador_rfc`),
  KEY `fk_solicitud_instituto1_idx` (`instituto_clave`),
  KEY `fk_solicitud_estudiante1_idx` (`estudiante_n_control`),
  KEY `fk_solicitud_actividad_comp1_idx` (`actividad_comp_clave_act`),
  KEY `fk_solicitud_trabajador1_idx` (`trabajador_rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`fecha`, `asunto`, `folio`, `instituto_clave`, `estudiante_n_control`, `actividad_comp_clave_act`, `trabajador_rfc`) VALUES
('2017-09-15', 'Actividad complementaria', 1, '12DIT0005B', 15930210, 2, 'GOVL801204159'),
('2015-06-11', 'Actividad de futbol', 2, '12DIT0005B', 14930123, 3, 'RUGC031490456'),
('2011-03-14', 'Actividad de ajedrez', 3, '12DIT0005B', 15930168, 2, 'GOVL801204159');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE IF NOT EXISTS `trabajador` (
  `rfc_tra` varchar(20) NOT NULL,
  `nombre_tra` varchar(45) NOT NULL,
  `a_paterno_tra` varchar(45) NOT NULL,
  `a_materno_tra` varchar(45) NOT NULL,
  `clave_presupuestal` varchar(45) NOT NULL,
  PRIMARY KEY (`rfc_tra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`rfc_tra`, `nombre_tra`, `a_paterno_tra`, `a_materno_tra`, `clave_presupuestal`) VALUES
('GOVL801204159', 'Leonel', 'Gonzalez', 'Vidales', ''),
('RUGC031490456', 'Alberto', 'Gutierrez', 'Ruiz', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_trabajador1` FOREIGN KEY (`trabajador_rfc`) REFERENCES `trabajador` (`rfc_tra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_carrera` FOREIGN KEY (`carrera_clave`) REFERENCES `carrera` (`clave_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `fk_instructor_actividad_comp1` FOREIGN KEY (`actividad_comp_clave_act`) REFERENCES `actividad_comp` (`clave_act`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_solicitud_actividad_comp1` FOREIGN KEY (`actividad_comp_clave_act`) REFERENCES `actividad_comp` (`clave_act`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_estudiante1` FOREIGN KEY (`estudiante_n_control`) REFERENCES `estudiante` (`n_control`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_instituto1` FOREIGN KEY (`instituto_clave`) REFERENCES `instituto` (`clave`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_trabajador1` FOREIGN KEY (`trabajador_rfc`) REFERENCES `trabajador` (`rfc_tra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
