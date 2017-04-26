-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2017 a las 21:52:54
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rppc`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `workdaydiff` (`b` DATE, `a` DATE) RETURNS INT(11) BEGIN
 
DECLARE freedays int;
 
SET freedays = 0;
SET @x = DATEDIFF(b, a);
IF @x<0 THEN
SET @m = a;
SET a = b;
SET b = @m;
SET @m = -1;
ELSE
SET @m = 1;
END IF;
SET @x = abs(@x) + 1;
 
SET @w1 = WEEKDAY(a)+1;
SET @wx1 = 8-@w1;
IF @w1>5 THEN
SET @w1 = 0;
ELSE
SET @w1 = 6-@w1;
END IF;
 
SET @wx2 = WEEKDAY(b)+1;
SET @w2 = @wx2;
IF @w2>5 THEN
SET @w2 = 5;
END IF;
 
SET @weeks = (@x-@wx1-@wx2)/7;
SET @noweekends = (@weeks*5)+@w1+@w2;
 
SET @result = @noweekends-freedays;
RETURN @result*@m;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `idAcciones` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Hallazgo` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Sistema` int(11) NOT NULL,
  `RS` int(11) NOT NULL,
  `RA` int(11) NOT NULL,
  `Causas` text NOT NULL,
  `Objetivo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `FEC` date NOT NULL,
  `Rechazo` int(11) DEFAULT NULL,
  `Cerro` int(11) DEFAULT NULL,
  `FRC` date DEFAULT NULL,
  `Tiempo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`idAcciones`, `Tipo`, `Hallazgo`, `Fecha`, `Sistema`, `RS`, `RA`, `Causas`, `Objetivo`, `Descripcion`, `FEC`, `Rechazo`, `Cerro`, `FRC`, `Tiempo`) VALUES
(1, 1, 1, '2017-04-04', 1, 1, 2, 'ASDASD', 'ASDASDASD', 'ASDASDASD', '2017-04-04', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `idArea` int(11) NOT NULL,
  `Area` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`idArea`, `Area`) VALUES
(2, 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `Categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `Categoria`) VALUES
(1, 'Categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `idDocumentos` int(11) NOT NULL,
  `p_p` varchar(4) NOT NULL,
  `num` varchar(45) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `p_resp` varchar(45) NOT NULL,
  `area_api` varchar(400) NOT NULL,
  `rev_a` varchar(4) NOT NULL,
  `rev_v` varchar(4) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `estado` varchar(10) NOT NULL,
  `observacion` varchar(500) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `formato_idFormato` varchar(400) NOT NULL,
  `tipodoc_idtTipodoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`idDocumentos`, `p_p`, `num`, `nombre`, `p_resp`, `area_api`, `rev_a`, `rev_v`, `fecha_reg`, `estado`, `observacion`, `codigo`, `formato_idFormato`, `tipodoc_idtTipodoc`) VALUES
(1, 'E122', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 1),
(2, 'E122', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 2),
(3, 'E122', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 3),
(4, 'E120', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 4),
(5, 'E120', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 5),
(6, 'E120', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 6),
(7, 'E120', '00', 'PRUEBA', 'PRUEBA', 'PRUEBA', '00', '00', '2017-04-01 00:00:00', 'PRUEBA', 'PRUEBA', '', 'PRUEBA', 7),
(8, 'E120', '01', 'UNO dos', 'AGN', 'Compras', '00', '00', '2017-04-13 17:55:00', 'LIBRE', 'uno dos', 'E120PM01', 'E120PM01.txt', 7),
(10, 'E120', '01', 'Miguel1111', 'INSCRIPCIÓN', 'Todo el RPPC', '11', '11', '2017-04-12 11:11:00', 'ACTIVO', '11111111111111', 'E120P01', 'E120P01.txt', 6),
(11, 'E120', '01', 'DOS', 'ATENCIÓN Y SERVICIO A USUARIOS', 'Dentina', '00', '000', '2017-04-11 11:11:00', 'ACTIVO', 'LLLLL', 'E120N01', 'E120N01.txt', 5),
(13, 'E122', '02', 'CUATRO CUATRO', 'REGISTRAL FORÁNEO', '', '666', '666', '2017-04-13 15:00:00', 'ACTIVO', 'XXX6X66', 'E122A02', 'E122A02.txt', 1),
(14, 'E120', '03', 'SIETE', 'ATENCIÓN Y SERVICIO A USUARIOS', 'Unidad de Apoyo Administrativo - Dentina', '11', '11', '2017-04-12 11:11:00', 'ACTIVO', 'SSS', 'E120PM03', 'E120PM03.txt', 7),
(16, 'E120', '04', 'Biblia 5', 'AGN', 'Jurídico', '66', '66', '0000-00-00 00:00:00', 'LIBRE', '11111', 'E120PM04', 'E120PM04.txt', 7),
(18, 'E122', '01', 'IMAGEN', 'REGISTRAL FORÁNEO', 'AGN', '11', '111', '2017-04-12 11:11:00', 'ACTIVO', 'IMAGEN', 'E122I01', 'E122I01.jpg', 3),
(19, 'E120', '05', 'MAX FORANEO', 'REGISTRAL FORÁNEO', 'Subdirecciones Foráneas', '666', '666', '1111-11-11 23:01:00', 'ACTIVO', 'MAX FORENA', 'E120PM05', '1', 7),
(20, 'E120', '06', 'FORANEO', 'REGISTRAL FORÁNEO', 'Registral Foráneo', '111', '111', '0000-00-00 00:00:00', 'ACTIVO', '11111', 'E120PM06', 'E120PM06.pdf', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `NoEncuesta` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`NoEncuesta`, `nombre`) VALUES
(2, 'Ambiente 2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestapreguntas`
--

CREATE TABLE `encuestapreguntas` (
  `NoEncuesta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `idPonderacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encuestapreguntas`
--

INSERT INTO `encuestapreguntas` (`NoEncuesta`, `idPregunta`, `idPonderacion`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hallazgos`
--

CREATE TABLE `hallazgos` (
  `idHallazgo` int(11) NOT NULL,
  `NombreHallazgo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hallazgos`
--

INSERT INTO `hallazgos` (`idHallazgo`, `NombreHallazgo`) VALUES
(1, 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrantes`
--

CREATE TABLE `integrantes` (
  `Accion` int(11) NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasos`
--

CREATE TABLE `pasos` (
  `idPaso` int(11) NOT NULL,
  `Tarea` text NOT NULL,
  `Responsable` varchar(100) NOT NULL,
  `FI` date NOT NULL,
  `FF` date NOT NULL,
  `FR` date DEFAULT NULL,
  `Accion` int(11) NOT NULL,
  `Evidencia` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasos`
--

INSERT INTO `pasos` (`idPaso`, `Tarea`, `Responsable`, `FI`, `FF`, `FR`, `Accion`, `Evidencia`) VALUES
(1, 'ASDAS', '1', '2017-04-04', '2017-04-04', '2017-04-04', 1, 'Evidencia-1.docx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponderaciones`
--

CREATE TABLE `ponderaciones` (
  `idPonderacion` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ponderaciones`
--

INSERT INTO `ponderaciones` (`idPonderacion`, `Nombre`) VALUES
(1, 'ponderacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `Pregunt` varchar(200) NOT NULL,
  `idPonderacion` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `Pregunt`, `idPonderacion`, `idCategoria`) VALUES
(1, 'pregunta', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `idProceso` int(11) NOT NULL,
  `Proceso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`idProceso`, `Proceso`) VALUES
(2, 'AGN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `idPuesto` int(11) NOT NULL,
  `Puesto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`idPuesto`, `Puesto`) VALUES
(2, 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasultados`
--

CREATE TABLE `reasultados` (
  `NoEmpleado` int(11) NOT NULL,
  `NoEncuesta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reasultados`
--

INSERT INTO `reasultados` (`NoEmpleado`, `NoEncuesta`, `idPregunta`, `idRespuesta`, `Status`) VALUES
(1, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rechazobloqueo`
--

CREATE TABLE `rechazobloqueo` (
  `idRechazo` int(11) NOT NULL,
  `Estatus` varchar(20) NOT NULL,
  `Responsable` int(11) NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Razon` text NOT NULL,
  `Bloqueo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL,
  `Respuesta` varchar(100) NOT NULL,
  `idValor` int(11) NOT NULL,
  `idPonderacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `Respuesta`, `idValor`, `idPonderacion`) VALUES
(1, 'Respuesta 1', 1, 1),
(2, 'Respuesta 2', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas`
--

CREATE TABLE `sistemas` (
  `idSistema` int(11) NOT NULL,
  `NombreSistema` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sistemas`
--

INSERT INTO `sistemas` (`idSistema`, `NombreSistema`) VALUES
(1, 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subir`
--

CREATE TABLE `subir` (
  `idSubir` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodoc`
--

CREATE TABLE `tipodoc` (
  `idtTipodoc` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipodoc`
--

INSERT INTO `tipodoc` (`idtTipodoc`, `tipo`, `descripcion`) VALUES
(1, 'A', '(A) ANEXOS AL MANUAL DE CALIDAD'),
(2, 'F', '(F) FORMATO'),
(3, 'I', '(I) INSTRUCTIVOS Y/O GUIAS'),
(4, 'M', '(M) MANUAL'),
(5, 'N', '(N) PROCEDIMIENTO NORMATIVOS'),
(6, 'P', '(P) PROCEDIMIENTO'),
(7, 'PM', '(PM) PROCEDIMIENTO MAESTRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `idTipo` int(11) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  `Limite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipo`, `Tipo`, `Limite`) VALUES
(1, 'PRUEBA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `NoEmpleado` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Proceso` int(11) NOT NULL,
  `Area` int(11) NOT NULL,
  `Puesto` int(11) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1',
  `Privilegio` int(11) NOT NULL DEFAULT '0',
  `FR` date NOT NULL,
  `FC` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Tel` int(10) DEFAULT NULL,
  `Ext` int(5) DEFAULT NULL,
  `Marcacion` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`NoEmpleado`, `Nombre`, `Proceso`, `Area`, `Puesto`, `Clave`, `Status`, `Privilegio`, `FR`, `FC`, `Email`, `Tel`, `Ext`, `Marcacion`) VALUES
(1, 'Aldo Omar Guajardo Chavez', 2, 2, 2, '123456', 1, 1, '2017-04-01', '2017-04-01', 'aldoogc@gmail.com', 171023281, 44, 123),
(2, 'PRUEBA', 2, 2, 2, '123456', 1, 0, '2017-04-01', '2017-04-09', 'PRUEBA@GMAIL.COM', 1234567891, 444, 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_has_documentos`
--

CREATE TABLE `usuarios_has_documentos` (
  `Usuarios_NoEmpleado` int(11) NOT NULL,
  `Documentos_idDocumentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `idValor` int(11) NOT NULL,
  `Valor` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`idValor`, `Valor`) VALUES
(1, 100),
(2, 90);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`idAcciones`,`Tipo`,`Hallazgo`,`Sistema`,`RS`,`RA`),
  ADD KEY `fk_Acciones_Tipo_idx` (`Tipo`),
  ADD KEY `fk_Acciones_Hallazgo1_idx` (`Hallazgo`),
  ADD KEY `fk_Acciones_Sistemas1_idx` (`Sistema`),
  ADD KEY `fk_Acciones_Usuarios1_idx` (`RS`),
  ADD KEY `fk_Acciones_Usuarios2_idx` (`RA`),
  ADD KEY `fk_Acciones_Rechazos1_idx` (`Rechazo`),
  ADD KEY `fk_Acciones_Usuarios3_idx` (`Cerro`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`idDocumentos`,`tipodoc_idtTipodoc`),
  ADD KEY `fk_Documentos_tipodoc1_idx` (`tipodoc_idtTipodoc`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`NoEncuesta`);

--
-- Indices de la tabla `encuestapreguntas`
--
ALTER TABLE `encuestapreguntas`
  ADD PRIMARY KEY (`NoEncuesta`,`idPregunta`,`idPonderacion`),
  ADD KEY `fk_Encuesta_has_Preguntas_Preguntas1_idx` (`idPregunta`,`idPonderacion`),
  ADD KEY `fk_Encuesta_has_Preguntas_Encuesta1_idx` (`NoEncuesta`),
  ADD KEY `ponderacionm` (`idPonderacion`);

--
-- Indices de la tabla `hallazgos`
--
ALTER TABLE `hallazgos`
  ADD PRIMARY KEY (`idHallazgo`);

--
-- Indices de la tabla `integrantes`
--
ALTER TABLE `integrantes`
  ADD PRIMARY KEY (`Accion`,`Usuario`),
  ADD KEY `fk_Acciones_has_Usuarios_Usuarios1_idx` (`Usuario`),
  ADD KEY `fk_Acciones_has_Usuarios_Acciones1_idx` (`Accion`);

--
-- Indices de la tabla `pasos`
--
ALTER TABLE `pasos`
  ADD PRIMARY KEY (`idPaso`,`Accion`),
  ADD KEY `fk_Pasos_Acciones1_idx` (`Accion`);

--
-- Indices de la tabla `ponderaciones`
--
ALTER TABLE `ponderaciones`
  ADD PRIMARY KEY (`idPonderacion`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`,`idPonderacion`,`idCategoria`),
  ADD KEY `fk_Preguntas_Ponderaciones1_idx` (`idPonderacion`),
  ADD KEY `fk_preguntas_categorias1_idx` (`idCategoria`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`idProceso`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`idPuesto`);

--
-- Indices de la tabla `reasultados`
--
ALTER TABLE `reasultados`
  ADD PRIMARY KEY (`NoEmpleado`,`NoEncuesta`,`idPregunta`,`idRespuesta`),
  ADD KEY `fk_Usuarios_has_Encuesta_Encuesta1_idx` (`NoEncuesta`),
  ADD KEY `fk_Usuarios_has_Encuesta_Usuarios1_idx` (`NoEmpleado`),
  ADD KEY `fk_Reasultados_Preguntas1_idx` (`idPregunta`),
  ADD KEY `fk_Reasultados_Respuestas1_idx` (`idRespuesta`);

--
-- Indices de la tabla `rechazobloqueo`
--
ALTER TABLE `rechazobloqueo`
  ADD PRIMARY KEY (`idRechazo`,`Responsable`,`Bloqueo`),
  ADD KEY `fk_Rechazos_Usuarios1_idx` (`Responsable`),
  ADD KEY `fk_Rechazos_Usuarios2_idx` (`Bloqueo`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuesta`,`idValor`,`idPonderacion`),
  ADD KEY `fk_Respuestas_Valor1_idx` (`idValor`),
  ADD KEY `fk_Respuestas_Ponderaciones1_idx` (`idPonderacion`);

--
-- Indices de la tabla `sistemas`
--
ALTER TABLE `sistemas`
  ADD PRIMARY KEY (`idSistema`);

--
-- Indices de la tabla `subir`
--
ALTER TABLE `subir`
  ADD PRIMARY KEY (`idSubir`);

--
-- Indices de la tabla `tipodoc`
--
ALTER TABLE `tipodoc`
  ADD PRIMARY KEY (`idtTipodoc`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`NoEmpleado`,`Proceso`,`Area`,`Puesto`),
  ADD UNIQUE KEY `idIntegrante_UNIQUE` (`NoEmpleado`),
  ADD KEY `fk_Usuarios_Procesos1_idx` (`Proceso`),
  ADD KEY `fk_Usuarios_Areas1_idx` (`Area`),
  ADD KEY `fk_Usuarios_Puestos1_idx` (`Puesto`);

--
-- Indices de la tabla `usuarios_has_documentos`
--
ALTER TABLE `usuarios_has_documentos`
  ADD PRIMARY KEY (`Usuarios_NoEmpleado`,`Documentos_idDocumentos`),
  ADD KEY `fk_Usuarios_has_Documentos_Documentos1_idx` (`Documentos_idDocumentos`),
  ADD KEY `fk_Usuarios_has_Documentos_Usuarios1_idx` (`Usuarios_NoEmpleado`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`idValor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `idAcciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `idDocumentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `NoEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `hallazgos`
--
ALTER TABLE `hallazgos`
  MODIFY `idHallazgo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pasos`
--
ALTER TABLE `pasos`
  MODIFY `idPaso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ponderaciones`
--
ALTER TABLE `ponderaciones`
  MODIFY `idPonderacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `idProceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rechazobloqueo`
--
ALTER TABLE `rechazobloqueo`
  MODIFY `idRechazo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sistemas`
--
ALTER TABLE `sistemas`
  MODIFY `idSistema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `subir`
--
ALTER TABLE `subir`
  MODIFY `idSubir` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipodoc`
--
ALTER TABLE `tipodoc`
  MODIFY `idtTipodoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `valores`
--
ALTER TABLE `valores`
  MODIFY `idValor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD CONSTRAINT `fk_Acciones_Hallazgo1` FOREIGN KEY (`Hallazgo`) REFERENCES `hallazgos` (`idHallazgo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_Rechazos1` FOREIGN KEY (`Rechazo`) REFERENCES `rechazobloqueo` (`idRechazo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_Sistemas1` FOREIGN KEY (`Sistema`) REFERENCES `sistemas` (`idSistema`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_Tipo` FOREIGN KEY (`Tipo`) REFERENCES `tipos` (`idTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_Usuarios1` FOREIGN KEY (`RS`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_Usuarios2` FOREIGN KEY (`RA`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_Usuarios3` FOREIGN KEY (`Cerro`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_Documentos_tipodoc1` FOREIGN KEY (`tipodoc_idtTipodoc`) REFERENCES `tipodoc` (`idtTipodoc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `encuestapreguntas`
--
ALTER TABLE `encuestapreguntas`
  ADD CONSTRAINT `fk_Encuesta_has_Preguntas_Encuesta1` FOREIGN KEY (`NoEncuesta`) REFERENCES `encuesta` (`NoEncuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encuesta_has_Preguntas_Preguntas1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ponderacionm` FOREIGN KEY (`idPonderacion`) REFERENCES `ponderaciones` (`idPonderacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `integrantes`
--
ALTER TABLE `integrantes`
  ADD CONSTRAINT `fk_Acciones_has_Usuarios_Acciones1` FOREIGN KEY (`Accion`) REFERENCES `acciones` (`idAcciones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Acciones_has_Usuarios_Usuarios1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pasos`
--
ALTER TABLE `pasos`
  ADD CONSTRAINT `fk_Pasos_Acciones1` FOREIGN KEY (`Accion`) REFERENCES `acciones` (`idAcciones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_Preguntas_Ponderaciones1` FOREIGN KEY (`idPonderacion`) REFERENCES `ponderaciones` (`idPonderacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_preguntas_categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reasultados`
--
ALTER TABLE `reasultados`
  ADD CONSTRAINT `fk_Reasultados_Preguntas1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reasultados_Respuestas1` FOREIGN KEY (`idRespuesta`) REFERENCES `respuestas` (`idRespuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_has_Encuesta_Encuesta1` FOREIGN KEY (`NoEncuesta`) REFERENCES `encuesta` (`NoEncuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_has_Encuesta_Usuarios1` FOREIGN KEY (`NoEmpleado`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rechazobloqueo`
--
ALTER TABLE `rechazobloqueo`
  ADD CONSTRAINT `fk_Rechazos_Usuarios1` FOREIGN KEY (`Responsable`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rechazos_Usuarios2` FOREIGN KEY (`Bloqueo`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_Respuestas_Ponderaciones1` FOREIGN KEY (`idPonderacion`) REFERENCES `ponderaciones` (`idPonderacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Respuestas_Valor1` FOREIGN KEY (`idValor`) REFERENCES `valores` (`idValor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_Areas1` FOREIGN KEY (`Area`) REFERENCES `areas` (`idArea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_Procesos1` FOREIGN KEY (`Proceso`) REFERENCES `procesos` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_Puestos1` FOREIGN KEY (`Puesto`) REFERENCES `puestos` (`idPuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_has_documentos`
--
ALTER TABLE `usuarios_has_documentos`
  ADD CONSTRAINT `fk_Usuarios_has_Documentos_Documentos1` FOREIGN KEY (`Documentos_idDocumentos`) REFERENCES `documentos` (`idDocumentos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_has_Documentos_Usuarios1` FOREIGN KEY (`Usuarios_NoEmpleado`) REFERENCES `usuarios` (`NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
