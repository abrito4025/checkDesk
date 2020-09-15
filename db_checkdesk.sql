
-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2020 a las 06:09:11
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_checkdesk`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAcceso` (IN `_correoUsuario` VARCHAR(100), IN `_Clave` VARCHAR(32))  BEGIN
   SELECT u.idUsuario, u.email, ru.idRol,u.estado FROM usuario u
    INNER JOIN usuariorol ru ON ru.idUsuario = u.idUsuario
   WHERE u.email = _correoUsuario AND u.clave = _Clave;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idCargo`, `nombre`, `descripcion`, `idDepartamento`) VALUES
(1, 'Encargado de Banca Electrónica', 'Encargado de los procesos de Banca electrónica, prevención de fraudes y calidad de datos', 1),
(2, 'Gerente de Tecnologia', 'Gerente de tecnología, gestión de proyectos', 3),
(3, 'Encargado de contabilidad', 'Encargado del personal de contable.', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Operaciones', 'Operaciones de procesos', 'activo'),
(2, 'Contabilidad y Finanzas', 'Contabilidad y compras', 'activo'),
(3, 'Tecnología TI', 'Departamento de TI', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idEquipo` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `direccionMac` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idEquipo`, `alias`, `marca`, `modelo`, `direccionMac`, `tipo`, `fechaIngreso`, `estado`, `idProveedor`, `idDepartamento`) VALUES
(1, 'WORKSTATION01', 'DELL', 'INSPIRON', '48-A4-72-B3-DA-43', 'LAPTOP', '2020-09-01', 'activo', 1, 3),
(2, 'WORKSTATION02', 'LENOVO', 'LEGION', '33-B4-55-A3-CA-22', 'PC', '2020-09-02', 'activo', 2, 1),
(3, 'WORKSTATION03', 'HP', 'PAVILION', '21-C5-12-A3-BA-44', 'LAPTOP', '2020-09-02', 'activo', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `dias` varchar(30) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `horaInicio`, `horaFin`, `dias`, `estado`) VALUES
(1, '08:30:00', '17:00:00', 'Lunes-Viernes', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `idMantenimiento` int(11) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEquipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`idMantenimiento`, `asunto`, `fecha`, `estado`, `idUsuario`, `idEquipo`) VALUES
(1, 'Reparación disco duro', '2020-09-01', 'Pendiente', 3, 1),
(2, 'Actualización de software', '2020-09-03', 'Completado', 3, 2),
(3, 'Instalación de programas', '2020-09-11', 'Proceso', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `email`, `direccion`, `telefono`) VALUES
(1, 'Labcode SRL.', 'labcode@gmail.com', 'LA SALVIA C/. MAYOBANEX VARGAS, BONAO D.M.', '8492127645'),
(2, 'PHD TECHNOLOGY', 'phdtechnology@gmail.com', 'C/. CAPOTILLO, ESQUINA VICTOR MANUEL ABREU, DAJABÓN.', '8297534965'),
(3, 'C Y L SYSTEM', 'cylsystem@gmail.com', 'LA SALVIA C/. MAYOBANEX VARGAS, BONAO D.M.', '8492127645');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportemantenimiento`
--

CREATE TABLE `reportemantenimiento` (
  `idReporte` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMantenimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reportemantenimiento`
--

INSERT INTO `reportemantenimiento` (`idReporte`, `fecha`, `detalle`, `estado`, `idUsuario`, `idMantenimiento`) VALUES
(1, '2020-09-02', 'reportes mensuales.', 'Completado', 3, 2),
(2, '2020-09-04', 'reportes semanales', 'Completado', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Administrador del sistema', 'activo'),
(2, 'Tecnico', 'Revisiones operativas', 'activo'),
(3, 'Empleado', 'Emisor de solicitudes', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idSolicitud` int(11) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `tipoProblema` varchar(50) NOT NULL,
  `detalleProblema` varchar(255) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEquipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idSolicitud`, `asunto`, `tipoProblema`, `detalleProblema`, `estado`, `fecha`, `idUsuario`, `idEquipo`) VALUES
(1, 'Reparación', 'Aplicación', 'Problema al iniciar bloqueado.', 'Pendiente', '2020-09-03 00:28:55', 4, 1),
(2, 'Instalación', 'Programas', 'Instalación de Excel, Email', 'Pendiente', '2020-09-03 00:28:55', 4, 2),
(3, 'Actualización', 'Software', 'Actualizar los servicios de licencia.', 'Pendiente', '2020-09-09 00:49:31', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `idRol` int(11) NOT NULL,
  `idCargo` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `fechaIngreso`, `email`, `clave`, `idRol`, `idCargo`, `idDepartamento`, `idHorario`, `estado`) VALUES
(2, 'Danny', 'Sosa', '2020-09-01 23:02:09', 'dsosa@gmail.com', '12345678', 1, 1, 1, 1, 'activo'),
(3, 'Eddy', 'Diaz', '2020-09-01 23:27:16', 'ediaz@gmail.com', '12345678', 2, 2, 3, 1, 'activo'),
(4, 'Isaac', 'Polanco', '2020-09-02 23:29:42', 'ipolanco@gmail.com', '12345678', 3, 3, 2, 1, 'activo'),
(5, 'carlos', 'moran', '2020-09-03 23:31:06', 'cmoran@gmail.com', '12345678', 2, 2, 3, 1, 'activo'),
(6, 'Leidy', 'perez', '2020-09-04 23:33:31', 'lperez@gmail.com', '12345678', 2, 1, 2, 1, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idUsuario`, `idRol`) VALUES
(2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`),
  ADD KEY `cargo_ibfk_1` (`idDepartamento`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipo`),
  ADD KEY `equipo_ibfk_1` (`idProveedor`),
  ADD KEY `equipo_ibfk_2` (`idDepartamento`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`idMantenimiento`),
  ADD KEY `idEquipo` (`idEquipo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `reportemantenimiento`
--
ALTER TABLE `reportemantenimiento`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idMantenimiento` (`idMantenimiento`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `idEquipo` (`idEquipo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `usuario_ibfk_1` (`idRol`),
  ADD KEY `usuario_ibfk_2` (`idDepartamento`),
  ADD KEY `usuario_ibfk_3` (`idHorario`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `idMantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reportemantenimiento`
--
ALTER TABLE `reportemantenimiento`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_2` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mantenimiento_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportemantenimiento`
--
ALTER TABLE `reportemantenimiento`
  ADD CONSTRAINT `reportemantenimiento_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportemantenimiento_ibfk_2` FOREIGN KEY (`idMantenimiento`) REFERENCES `mantenimiento` (`idMantenimiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
