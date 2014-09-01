-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-06-2014 a las 21:10:56
-- Versión del servidor: 5.5.37-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `examen1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE IF NOT EXISTS `examen` (
  `id_examen` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_preguntas` smallint(6) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


INSERT INTO `examen1`.`examen` (`id_examen`, `cantidad_preguntas`, `id_grado`, `habilitado`) VALUES
('1', '10', '1', '1'),
('2', '10', '2', '1'),
('3', '10', '3', '1'),
('4', '10', '4', '1'),
('5', '10', '5', '1');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_grado`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
INSERT INTO `examen1`.`grado` (`id_grado`, `nombre`) VALUES
(1, '1º Secundaria'),
(2, '2º Secundaria'),
(3, '3º Secundaria'),
(4, '4º Secundaria'),
(5, '5º Secundaria');
--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `id_p` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `grado` smallint(6) NOT NULL,
  `interno` smallint(6) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_p`, `pregunta`, `grado`, `interno`, `id_examen`) VALUES
(1, '¿En que año nacio Juan Francisco Regis Clet?', 1, 1, 1),
(2, '¿En que fecha fue Beatificado Jaun Francisco Regis Clet?', 1, 2, 1),
(3, '¿Donde realizo su trabajo misionero Regis Clet?', 1, 3, 1),
(4, '¿En que fecha capturaron a Juan Francisco Regis?', 1, 4, 1),
(5, '¿Como murio Juan Francisco Regis Clet?', 1, 5, 1),
(6, '¿Que ocupacion realizo en el Seminario Mayor de Annecy??', 1, 6, 1),
(7, '¿Como le decian a Juan Francisco Regis Clet?', 1, 7, 1),
(8, '¿Donde descansan las reliquias de Regis Clet?', 1, 8, 1),
(9, '¿Cuando fue canonizado Juan Regis Clet?', 1, 9, 1),
(10, '¿En donde nacio Francisco Regis Clet?', 1, 10, 1);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE IF NOT EXISTS `respuestas` (
  `id_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_p` int(11) NOT NULL,
  `respuesta` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `interno` smallint(6) NOT NULL,
  `correcto` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_r`),
  UNIQUE KEY `preg_UNIQUE` (`id_p`,`respuesta`,`interno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id_r`, `id_p`, `respuesta`, `interno`, `correcto`) VALUES
(1, 1, '1756', 1, 0),
(2, 1, '1748', 1, 1),
(3, 1, '1900', 1, 0),
(4, 1, '1745', 1, 0),
(5, 2, 'Aun no fue Beatificado.', 2, 0),
(6, 2, 'El 10 de Abril de 1512.', 2, 0),
(7, 2, 'El 27 de Mayo de 1900.', 2, 1),
(8, 2, 'El 13 de Mayo de 1917.', 2, 0),
(9, 3, 'En China.', 3, 1),
(10, 3, 'En la India.', 3, 0),
(11, 3, 'En Francia.', 3, 0),
(12, 3, 'En Italia.', 3, 0),
(13, 4, 'El 14 de Mayo de 1978.', 4, 0),
(14, 4, 'El 16 de Junio de 1819.', 4, 1),
(15, 4, 'No lo capturaron.', 4, 0),
(16, 4, 'El 13 de Marzo de 1820.', 4, 0),
(17, 5, 'A pedradas.', 5, 0),
(18, 5, 'Decapitado.', 5, 0),
(19, 5, 'En una cruz y agarrotado.', 5, 1),
(20, 5, 'En la horca.', 5, 0),
(21, 6, 'Profesor de Teologia.', 6, 1),
(22, 6, 'Profesor de Sociales.', 6, 0),
(23, 6, 'Profesor de Matematicas.', 6, 0),
(24, 6, 'Director.', 6, 0),
(25, 7, 'El libro andante.', 7, 0),
(26, 7, 'El mejor profesor.', 7, 0),
(27, 7, 'La biblioteca Viviente.', 7, 1),
(28, 7, 'El mejor director.', 7, 0),
(29, 8, 'En la vertiente de la Montaña Roja.', 8, 0),
(30, 8, 'En la catedral de Paris.', 8, 0),
(31, 8, 'La casa madre de los Lazaristas de Lyon.', 8, 1),
(32, 8, 'No se sabe.', 8, 0),
(33, 9, 'El 10 de Junio de 1780.', 9, 0),
(34, 9, 'El 1 de Octubre de 2000.', 9, 1),
(35, 9, 'Aun no fue canonizado.', 9, 0),
(36, 9, 'Al año que murio.', 9, 0),
(37, 10, 'En Genova, Italia.', 10, 0),
(38, 10, 'En Grenoble, Francia.', 10, 1),
(39, 10, 'En Paris, Francia.', 10, 0),
(40, 10, 'En Turin, Italia', 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE IF NOT EXISTS `sexo` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL DEFAULT '-',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `nombre`) VALUES
(1, '-'),
(2, 'A'),
(3, 'B'),
(4, 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nombre2` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `grado` smallint(6) NOT NULL,
  `seccion` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `nota` smallint(6) NOT NULL,
  `presento` smallint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `usuarios`
--
--('93873444', 'd4e7430f1534a12df46cedd1ac369935436dbb94', 'Ricardo', 'Jesus', 'Chinchay', 'Hernandez', 'engineer_avatar', 'M', 0, '', 1, 0, 0),

INSERT INTO `usuarios` (`dni`, `password`, `nombre`, `nombre2`, `apellido1`, `apellido2`, `avatar`, `sexo`, `grado`, `seccion`, `isAdmin`, `nota`, `presento`) VALUES
('75192848', '0ecfbc3894c7b8e374232cadc0afa67162a600be', 'MELANIE', 'FIORELLA', 'ANCHIRAICO', 'ARROYO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('74285222', 'c73c8a91792173c2b72ce43b2f1374ea968e9299', 'ELEANE', 'ANTUANET', 'ARROYO', 'VICERA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('71707331', '2c9ff691cbfb62ef8748102c1102936953821b58', 'ALEJANDRA', 'DEL-PILAR', 'ASTETE', 'CUCHO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75065254', '72019bbac0b3dac88beac9ddfef0ca808919104f', 'ANA', 'VALERIA', 'AVELLANEDA', 'VALLEJOS', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('70184400', '63e19166e8db3d6c5bc9874fe0321380bc56623e', 'YOSELIN', 'DANIELA', 'BENDEZU', 'ZUÑIGA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72047156', 'dea04453c249149b5fc772d9528fe61afaf7441c', 'SARA', 'MARIAFE', 'CAMPOS', 'TOVAR', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('71777159', 'e3cd9f6469fc3e1acfb9f2bdbfc5a3d2bbb8e2ad', 'JENNIFER', 'YADHIRA', 'CAPARACHIN', 'CRUZ', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('76274889', '6975839f2171305164c2c3cc0a3c102c23e8b149', 'SHAYURY', 'GIOVANNA', 'CASIMIRO', 'ESPINOZA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('76790971', '825e064b2c85b54b1e40c143e31f24c19bbac07b', 'PAOLA', 'NICOL', 'CHAVEZ', 'LIMAYLLA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72855335', '4b70f0542b5356afcd1cc13b206292f145b46f34', 'ZARELLA', 'VERONICA', 'CONDOR', 'ROJAS', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72611926', '1db887a449145fab9facd4f6ebc90ed270bac7a3', 'ANTUANE', 'ALEXANDRA', 'CORONEL', 'MIRANDA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('71569938', '7f2276ca49a23610c4be422d412b419a7805f4bc', 'ESTEFANY', 'FRANCHESCA', 'CUADRADO', 'VICUÑA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75581890', '5ae955fb17babdbb07a3c3ff012dd7c8850af77f', 'KIARA', 'CASANDRA', 'DE-LA-CRUZ', 'SALCEDO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('71718429', '9d7ee56645944292ea086dd8828b4849a6625028', 'GRECIA', 'WENDOLY', 'GAMERO', 'ZAVALA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72076503', '8abc333f1c92b25a1f1b2102120bd195c0e34ab9', 'NOELYA', 'SALOME', 'GARCIA', 'QUISPE', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('77101138', 'cc0baf16bae62565b3d449e67b0d4f7df22cfb23', 'MASHORY', 'ZAYONHARA', 'GARCILAZO', 'TAZZA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('74826819', 'a2061bf09ff58c3ec75bbab641f840c9b2663cfe', 'YAJAYRA', 'MARIA', 'HUAMANTA', 'SAMANIEGO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72693430', '5633115bf9d0eb3800ac9911c9e11bb9b98e5d1c', 'YOMARA', 'LIZ', 'JORGE', 'RAQUI', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75348537', '903a26d824dab90f9a5cf34d6821e9dcee0c3ad8', 'NAYELI', 'JANIRA', 'LEON', 'CALLUPE', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75103737', 'e21fc56c1a272b630e0d1439079d0598cf8b8329', 'MARIA', 'DEL-CARMEN', 'MARCOS', 'ROSALES', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('74588643', '1d2f56e6e74d722ac2f6941f29db35b391c83504', 'ELIZABETH', 'ISAMAR', 'MAXIMILIANO', 'HUARCAYA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('60879119', '2386e4f3bd124b8d25c947c4109f76cce717d2b3', 'NATALY', 'NICOLLE-NINOZKA', 'MENDOZA', 'COSQUILLO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('74294579', 'fcf28d037a702f76989556eef075c801903adbd1', 'BRIGGITTE', 'YASMIN', 'MONTOYA', 'AYLAS', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75697055', 'bb4cc6ab038155f5c550175a090fbb3da5c9b762', 'SOFIA', 'MARIA', 'MUERAS', 'CONDORI', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('73670053', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'GERALDINE', 'ZULEMA', 'NAVARRO', 'COSME', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75235816', '3c5d9566525c9638fb34a90b33e0fed6f6d378af', 'MILAGROS', 'NAILY', 'NAVARRO', 'OROPEZA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72351799', '7bd1b835973cded4ac06aa71b39b1116c40065c5', 'ALISSON', 'SONYA', 'PALOMINO', 'PORRAS', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72077016', '3be9e1d910d28556002ca73ab02f251ecc5ad568', 'ISAMAR', 'JACQUELINE', 'PERALTA', 'ALVARO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('60423895', 'a971509e39df309b0ec60481b8ef316c71123cea', 'GIULIANA', 'ALEXANDRA', 'PÉREZ', 'MAYORCA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72043237', 'cfab48b7cc86efb01f2b6ff11f2306058b18c482', 'MILENA', 'MARGARITA', 'PEREZ', 'UBALDO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75245942', '9e9023d913bac7b017a1b6cc0d09288f68878053', 'DEYSI', 'KATHERINE', 'ROSALES', 'YARASCA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('74143837', '7a4a0be2eeeee98e8c29dd47316ddaed9f5f476b', 'GIANELLA', 'ALICE', 'RUFINO', 'JORGE', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('73568791', '36a62657a6da00a516349ea885cd87d323c73102', 'HEYDI', 'RAQUEL', 'TEJEDA', 'CONTRERAS', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('71078681', '7a4a0be2eeeee98e8c29dd47316ddaed9f5f476b', 'GIANELLA', 'ANGIE', 'TORRES', 'BALDEON', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('73088160', '47da192a8f8b20dd97ef2f665cc81540811c7406', 'ASTRID', 'DALILA', 'TORRES', 'DIAZ', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('60910986', 'ba278e30c5390c20ce904566076b84aaaf5e5035', 'DALMA', 'YANINA', 'VÁSQUEZ', 'BLANCO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('72089230', '7cc0d6190d4f1af3f5e919bf17bfbb0d8d066b63', 'MARIAFERNANDA', 'BEATRIZ', 'VASQUEZ', 'SIMEON', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75620303', 'ef1d3ce6df005c00e7954b3dbc2c9b8148b002a6', 'JANETH', 'ROCIO', 'VEGA', 'ANGO', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75248239', '7b32e8771748167e26dd27a3f37539d7a5b174a3', 'DANITZA', 'ROSARIO', 'YAURI', 'ZAVALA', 'gradfemale_avatar', 'F', 1, '-', 0, 0, 0),
('75660616', '4e49d854c9bffb0a64257124971234c44952926c', 'SHARON', 'OLENCKA', 'ARELLANO', 'CAMAYO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('74318478', '32b3491336522e073489725b5daf298cd749007a', 'LINDA', 'JORDANA', 'ARTEAGA', 'HUAMAN', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72890738', '8964af7e7645a7c6c1e891f5e69d22e8adaafe70', 'KARINA', 'ROCIO', 'CORONEL', 'YARASCA', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('75660617', '438d0fbcb8ceedffac573dc1eb974dd5870cd52c', 'FABIOLA', 'LIGIA', 'COSQUILLO', 'CARRASCO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('71563338', '19d7dcefe5511e40a4a73569862ef93feb9abbe0', 'ZOILA', 'MILAGROS', 'ESPINOZA', 'PEREZ', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('75103743', 'bfed8746772948e88b4a175db3f39b8ad2103ac7', 'YOJANA', 'MEDALITH', 'GUEVARA', 'REGALADO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('73273066', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'GERALDINE', 'THALIA', 'GUILLEN', 'NAVARRO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('70284359', '0a589da583cfeed1971eca6091a76bbaaf09d6f3', 'LESLIE', 'MAYLEE', 'HUACHO', 'CONDOR', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('73068761', 'e21fc56c1a272b630e0d1439079d0598cf8b8329', 'MARIA', 'FERNANDA', 'HUAMAN', 'DÍAZ', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72047098', '78faa26aa655f188cda0aaca3739d0b35018080c', 'JHOELLY', 'NICKOL', 'LAGOS', 'RAMOS', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('73196005', '0a70e77c92756ebf968c645efd2070ffd0d67eba', 'MIRNA', 'ANYLU', 'LIMAYLLA', 'CONTRERAS', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('76696755', 'dea04453c249149b5fc772d9528fe61afaf7441c', 'SARA', 'MILAGROS', 'MANSILLA', 'PINTO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('74070308', 'ec5a7c3e21436a8e76716710ce551356f9aa745e', 'SAMANTHA', '-', 'MATOS', 'BERMÚDEZ', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72047128', '7f2276ca49a23610c4be422d412b419a7805f4bc', 'ESTEFANY', 'JASMIN', 'ORDOÑEZ', 'BONILLA', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('71456082', '751a5cb5bdfaedc127f6558fed9a6b7437bb68e2', 'NAOMI', 'ALEJANDRA', 'PALOMINO', 'JORGE', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('71621527', 'fa99f711b07614bf06887dfc3b9d27cfcd6f79cd', 'JACKELINE', 'JULEYSI', 'PATILONGO', 'ZAVALA', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72107027', '6c42c39b2b3b20644b117a77b7c0523671f5150a', 'SHERLIN', 'RUTH', 'RAFAEL', 'MEDINA', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72626632', '75c7139545634555bed7dc3f49727c96686c3825', 'ANGIELA', 'MELANNY', 'RIVERA', 'PASCUAL', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72626631', '7c5868802bc0e037190f7e96f0c7fd95d83b7615', 'YESENIA', 'ANGIELA', 'RIVERA', 'PASCUAL', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('76386067', '20ddac592852daa9a1e01303617baee81fa8e1ef', 'BRIGGITE', 'ZULEIKA', 'RONCHI', 'TINAJEROS', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('74159470', '35951e2654371df7c68de546b20b3c3794b62aae', 'STEFANI', 'DEL-ROSARIO', 'SALAS', 'HURTADO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('72680757', '5476609d983928f8f0d83888b1f873f5310a58e2', 'PRYANKA', 'NAYEL', 'SOTO', 'CONDOR', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('73235853', '28b92b56ee64b92ebb72d865f172ef00c708df83', 'CAROL', 'GIANELLA', 'TEJEDA', 'SOTO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('74471772', 'ada43840f42d91586f954fffaedbb1a877ea9be7', 'CRISTEL', 'LEYDI', 'VALENTIN', 'ARELLANO', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('75176730', '2a282e8a509631bb1b26b0ecd1a7eca6d737c179', 'MARJORY', 'GREASE', 'ZAVALA', 'ARGANDOÑA', 'gradfemale_avatar', 'F', 2, 'A', 0, 0, 0),
('75855777', '6a90af129eeefc2f6e6a38746a2b33cb04c2c632', 'DIANA', 'MIRELLA', 'AGUILAR', 'MARTINEZ', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75660614', '952af361496fd47665c489615f1b9c0d564ded53', 'LEYDI', 'NAOMI', 'AGUIRRE', 'OLIVARES', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('73183259', '1833852f924c391bf756bebf0a355bc55ef9a483', 'ARIANA', 'FERNANDA', 'ATENCIO', 'LOYOLA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75209851', '5fee00239940f883d4c2854e41c7f989e75278a3', 'NICOLE', '-', 'BALVIN', 'ARGANDOÑA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('73183248', 'dca3c169ada6de4f647fa14074b83211b98cb516', 'VALERIA', 'NICOLE', 'BALVIN', 'HUANQUI', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('71083047', '3895da854ac51800a8b821b4330859705f37cfc3', 'VALERIE', 'MASSIEL', 'BULEJE', 'CAPCHA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72081313', '8ed2b9f44336a6d7c0e1c3accc183194c43bc152', 'JEANINE', 'LIZ', 'CALLUPE', 'PIZARRO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75728458', 'ac20f5c313ec7a65d13955d6f00ee65536a4bf54', 'LEIDY', 'LAURA', 'CHAVEZ', 'QUISPE', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('73310931', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'GERALDINE', 'STEPHANY', 'COSME', 'ROQUE', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('73310930', 'ff29b48f11558a757192a97611601deca77a650a', 'YAMILEN', 'YANELA', 'ESPINOZA', 'MARISCAL', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('77668596', 'e21fc56c1a272b630e0d1439079d0598cf8b8329', 'MARIA', 'FERNANDA', 'ESPINOZA', 'REYNOSO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('76132071', 'cb54a1d3d508878305afaeb2e616abc4d6f14189', 'ANAYELI', 'MARIA', 'GALINDO', 'PIZARRO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('71027021', '7b32e8771748167e26dd27a3f37539d7a5b174a3', 'DANITZA', 'ANNEL', 'GUERRERO', 'NAVARRO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72867972', '94745df4bd94de756ea5436584fec066fc7898d5', 'LAURA', 'SOFIA', 'HUAMAN', 'TORRES', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75996578', '162c97811e1d8f8610e36545d438a12abf879fd6', 'JULISSA', 'BRITZEYDA', 'LAZO', 'VENTOCILLA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72612080', '395b17eeb9f4f035b504db836f1603a7790473d8', 'DARLIN', 'MICHELLE', 'NAVARRO', 'MARINO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75006676', '3ae8e6a433d2584749a3be3b830d74ebb052856f', 'MARJHORI', 'ALEXIA', 'ORIHUELA', 'PALOMARES', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('73684681', '1a39c2ed8d2908384d8b429723f56b0196ceba03', 'ARAZELI', 'LILIANA', 'ORTEGA', 'EGOAVIL', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72855629', 'a2d5532395261c42d043fe21e938b1b1783ba816', 'HERMINIA', 'ZARAI', 'OSORIO', 'GRADOS', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75225504', '54b1cdf540b66c50db0859922765db9c5a6e5346', 'KIMBERLY', 'ADRIANA', 'PALOMINO', 'RUIZ', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('70241559', 'd0e6fcd7c8e34536de36774fbf392438cc157eec', 'DDEYANIRA', 'LUISSA', 'PANTOJA', 'CASABONA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72081277', '341b2529fa9312135f9ea8f8a397d7f7000677a2', 'YASURY', 'MARIELA', 'PEÑA', 'HILARIO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('76678630', '72019bbac0b3dac88beac9ddfef0ca808919104f', 'ANA', 'STEFHANY', 'PORRAS', 'HUANCAYA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72563287', '9bfd99f9e2f1c59a3f7aa00c256e1fbdbfd41ee3', 'ESMERALDA', 'YOMARA', 'RIOS', 'NUÑEZ', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72607822', 'ec5a7c3e21436a8e76716710ce551356f9aa745e', 'SAMANTHA', 'SORAYA', 'RODRIGUEZ', 'PADILLA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('71889662', 'ea84138b4917356fb143f9f9e48f333e844fd31a', 'ROSMERY', 'KEILY', 'ROJAS', 'VALENTIN', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('74624536', 'affd33dec31b0844c378d4ba0506c22f4c3f1ce9', 'ANGIE', 'RASHEL', 'ROSALES', 'SANCHEZ', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('70180126', 'f9bfd018601fb96c95952d697b2d8ec058468649', 'LUCIA', 'BRENDA', 'SANTOS', 'ARROYO', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('75840314', '3c5d9566525c9638fb34a90b33e0fed6f6d378af', 'MILAGROS', 'JANETH', 'SOLANO', 'RAFAEL', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72072360', 'faf8951e6662de899bdcd434c3aba74d3280e4a7', 'MIRIAM', 'RUTH', 'TACURI', 'MANRIQUE', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('72858621', '6de5fe5460193b86dc4962c6e46e46ab30701771', 'NATIHUSKA', 'YOHANNA', 'VICUÑA', 'AVELLANEDA', 'gradfemale_avatar', 'F', 2, 'B', 0, 0, 0),
('71831099', '29fca0cd05e1837c76ff37ad2efe9ad8c1592700', 'ABIGAIL', 'CRISTINA', 'BALTAZAR', 'ALANIA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('71256016', '5a26a8edac14bcf78f62448d7d836a8a36845373', 'STEFANY', 'ISABEL', 'CALDERON', 'LINO', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('71477667', '0f0fcfaa3791ecbf5c3ad2b6a9bf0b34d43dd616', 'ALEXIA', 'MARIA', 'CANCHAN', 'SIMEON', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72051738', '775bb961b81da1ca49217a48e533c832c337154a', 'PRINCESS', 'MEILYN', 'CONTRERAS', 'MONTES', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72611925', '964a37eade1ceb3d67b0dbee7a1807f8f0715197', 'CELESTE', 'PAOLA', 'CORONEL', 'MIRANDA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72036137', 'a320ba782591eb9eb67709956abc36eb6efb57e5', 'NADINE', 'MELANIE', 'GAMERO', 'VILLAJUAN', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('75838620', 'cfab48b7cc86efb01f2b6ff11f2306058b18c482', 'MILENA', 'ATENAS', 'GARCIA', 'ESPINOZA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('73273065', 'e8ff0a1bde9afaa0d0cad58dc5cb7bfa68c809a4', 'EVELIN', 'LEYDI', 'GUILLEN', 'NAVARRO', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('71975645', '6afe8826e63a6f3cf8ec50e168b0af8ba5cd9f4d', 'GIANELA', 'CRISTHINE', 'HIDALGO', 'ORTIZ', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('76167801', '868b763ace2efcf640fbcfe37761c9b905694ef3', 'GINA', 'LUZ', 'HINOSTROZA', 'QUINCHO', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('70253189', '5dbfd4e09af844a649a48e6b985a1572f24d23f8', 'NIKOLD', 'SHIRLEY', 'HURTADO', 'PAUCAR', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('75063395', '29fca0cd05e1837c76ff37ad2efe9ad8c1592700', 'ABIGAIL', 'BERENICE', 'JARA', 'CASTRO', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('75529895', 'e3cd9f6469fc3e1acfb9f2bdbfc5a3d2bbb8e2ad', 'JENNIFER', 'DAYAN', 'LEYVA', 'LUNA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('75980863', 'bd92eb3dbd236569a416120159696bef867db26e', 'JHESMIN', 'GRACIELA', 'MALPARTIDA', 'RIVERA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('70181317', 'f0c7f044c77a1f9642e835acedbaf86553bacd21', 'ROSSYNES', 'ELENA', 'MAYTA', 'LANDA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('71966563', 'e9215e0d97ff6a1e0b982d5f3f7fcef04f766735', 'JANELA', 'THALIA', 'OSORIO', 'BLANCO', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('73064683', '5fee00239940f883d4c2854e41c7f989e75278a3', 'NICOLE', 'MARCELA', 'PIZARRO', 'RIVERA', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('75176733', 'e21fc56c1a272b630e0d1439079d0598cf8b8329', 'MARIA', 'FERNANDA', 'ROJAS', 'DE-LA-CRUZ', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72096985', 'a66e4d2e817cd9b1297f05d6217b4ff2b0cfc5b1', 'ALEXANDRA', 'PAULETTE', 'SUASNABAR', 'GARRIDO', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72005255', 'af45dec30d6fe059a9f38070ebbc6a7444cf990e', 'ZOLANGHS', 'BRIGGITH', 'VELIZ', 'COCHACHI', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72811852', '7b32e8771748167e26dd27a3f37539d7a5b174a3', 'DANITZA', 'VICTORIA', 'VILLAIZAN', 'VILLAGARAY', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('72890750', 'fdb87dfd199045af7165780b11640b83768a0d57', 'ANDREA', 'XIOMARA', 'ZACARIAS', 'CHAUPIS', 'gradfemale_avatar', 'F', 3, 'A', 0, 0, 0),
('75208540', '3b501c48f26aa64bdf43e588ec98f5f2a374a581', 'ARACELLY', 'CLARISA', 'ARELLANO', 'REYES', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('71469178', '533b21734e009ccdb0a50bc556fc005a93d317a2', 'INGRID', 'MILENI', 'BALVIN', 'ALVAREZ', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('71027022', 'affd33dec31b0844c378d4ba0506c22f4c3f1ce9', 'ANGIE', 'MASSIEL', 'BRAVO', 'PARRA', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('70185663', '651aaf63fcc5b669835a21ddda868c92dbf321ab', 'KAROLAY', 'PRISCILA', 'CAPCHA', 'ZAVALA', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('71829841', '89bca6920f91f6770751482b12dca2b59ca3205e', 'CHRISTELL', 'MARJORIE', 'CHERO', 'CALCINA', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('72658568', '744ec7c13ef0fd645dcdd81dcb73210fcfee1fbb', 'MISHELY', 'STEFFANY', 'GUEVARA', 'LEON', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('74065301', '2298625f2ba17912b286ad9afd8f089e460241b9', 'NATALIA', 'ELENA', 'HINOSTROZA', 'OSORIO', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('70185673', '2669189cb93057e74d28ee21ac52581d5fb33171', 'THALIA', 'PILAR', 'NAVARRO', 'HUAMANCHOQUE', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('72100725', '5353324e8e790f56c0754f7309f714aabd9c7342', 'NELBITH', 'IBETH', 'OSORIO', 'SALDIVAR', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('76678617', '796ba8806f8ae0bfcd9c843da086c52509a7bd48', 'PATZY', 'SOLMAYRA', 'PERALTA', 'MACHUCA', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('72890749', '821e2cb2efd0be19dc96281e185324fc26fe79ba', 'FIORELLA', 'PATRICIA', 'PUCHOC', 'CANO', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('75861810', 'affd33dec31b0844c378d4ba0506c22f4c3f1ce9', 'ANGIE', 'NICOLE', 'QUINTANA', 'ROJAS', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('75993271', '85a3cd8970773b7c162a4b2de25030a4340d67b5', 'JENIFER', 'ADALIZ', 'RICALDI', 'ANGLAS', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('72047143', '7b32e8771748167e26dd27a3f37539d7a5b174a3', 'DANITZA', 'GIANELLA', 'RIVERA', 'MENDOZA', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('73037837', '952af361496fd47665c489615f1b9c0d564ded53', 'LEYDI', 'JEARETH', 'ROJAS', 'ROJAS', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('77065643', 'a60b6644e0990f8bbf51816b57456545c125ba04', 'KATHERINE', 'PAOLA', 'TACURI', 'ESTEBAN', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('71080757', '568095ee7b98b0afceb32540a1ca5540eaa72666', 'CLAUDIA', 'ELIAN', 'VILLALBA', 'AROSEMENA', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('70184411', '150859362b0a74314969ca302131fc4561205566', 'XIOMARA', 'VALERIA', 'VILLANUEVA', 'CALDERON', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('72077009', '4a4f22fbabc5d6375b354538de0249eb0a80f614', 'ALISON', 'XIOMARA', 'VILLEGAS', 'BENAVIDES', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('71223706', '40ca8c7711ecc98832f17aac687a7cbc682bd3e5', 'BELLANNELLA', 'NICKOL', 'ZAVALA', 'ROSALES', 'gradfemale_avatar', 'F', 3, 'B', 0, 0, 0),
('76852405', 'e9215e0d97ff6a1e0b982d5f3f7fcef04f766735', 'JANELA', 'LIZBETH', 'ALANIA', 'PACAHUALA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('75217932', '7c5868802bc0e037190f7e96f0c7fd95d83b7615', 'YESENIA', 'EDITH', 'AMAYA', 'MANSILLA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('74147698', 'd9a95b159985421b38eaff33e9ab4f3d534ffe9b', 'ANGHELA', 'STHEFFANY', 'ARELLANO', 'MONTES', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('70184942', 'b99054c7664cf2c61f334a893e03a67daa8f77eb', 'XIMENA', 'LUCIA', 'ARRIVASPLATA', 'GUERRERO', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('74142865', 'affd33dec31b0844c378d4ba0506c22f4c3f1ce9', 'ANGIE', 'MIRELLA', 'CAMAYO', 'ROMERO', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('72077013', 'f22f65b7648b39ed9a143ee135e879244f79cc36', 'LIZETH', 'MARISOL', 'CORONEL', 'MATURANA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('73224098', 'c2aa46b2aaadea6c0189d512a06afe7cbc6631f3', 'RUBIEL', 'MAGALY', 'ESPINOZA', 'ROSALES', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('75225564', '162c97811e1d8f8610e36545d438a12abf879fd6', 'JULISSA', 'JUDITH', 'FERNANDEZ', 'PEÑA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('75006412', '94745df4bd94de756ea5436584fec066fc7898d5', 'LAURA', 'MORELIA', 'GOMEZ', 'GALARZA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('75997157', '6469cae2f553d304b9fdfc5c08fe688f83a0ed79', 'HELEN', 'YADIRA', 'INGA', 'RICALDI', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('71322461', '6a90af129eeefc2f6e6a38746a2b33cb04c2c632', 'DIANA', 'NATALY', 'LUIS', 'CASTILLO', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('72100780', 'ae79e1c3f7f9b80dc4ef9be86ad721ba4e1db744', 'AZUCENA', 'ALEJANDRINA', 'QUISPE', 'CELESTINO', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('72460615', 'b5e1ed40f9f1e29bf5e9e09135d027830c9c7b28', 'ROSALIA', 'BELEN', 'RICAPA', 'ALCANTARA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('72051726', 'dab33377fea4a35fd404c4b6ea2a1ccc4f9365f5', 'NOELIA', 'LORENA', 'ROJAS', 'MANANI', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('74249683', '9b3cf89e04b70c0df63795bc76bee08282bc20fe', 'MIRELLA', 'VICTORIA', 'ROJAS', 'MORALES', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('73955643', '81238610e9eb45f1a37e5905f66c06d49922568a', 'BERENICE', 'JAZMIN', 'ROJAS', 'RAMOS', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('77173885', '825e064b2c85b54b1e40c143e31f24c19bbac07b', 'PAOLA', 'FIORELA', 'SANCHEZ', 'TINOCO', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('76264792', '7d2a29ae92d3d1e793bc390802b2fd326f59485b', 'TARORETH', 'JUDITH', 'TAQUIRI', 'HINOSTROZA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('70180131', '6593d1906ee3a939b98ee5be0210b60873f5df7a', 'SAYDA', 'LEONOR', 'TINTAYA', 'MANRIQUE', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('72073615', '5473f88a9985ce6824a12a6be5211f5455b484aa', 'YVONNE', 'BRENDA', 'TOLENTINO', 'BASTERES', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('74841293', '9b4015dcf2405e2306d99c990889ffddf5f46042', 'ARACELY', 'ALEXANDRA', 'TORREJON', 'TERREL', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('76039557', '3f342b0a75a2f952218b1a5db7243b60a7d4a168', 'IRMA', 'CRISTINA', 'VILLAFRANCA', 'VALENCIA', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('74951337', '25be6894160644c9ed323968bb6cc1fbd004a4c6', 'ALLISON', 'MERYANN', 'VILLAIZAN', 'ESTEBAN', 'gradfemale_avatar', 'F', 4, 'A', 0, 0, 0),
('70185735', '6c9fcec7832824a856f20e1fdb34ca854ea4359e', 'KERLY', 'WENDY', 'ARELLANO', 'PACHECO', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('75348536', 'fdb87dfd199045af7165780b11640b83768a0d57', 'ANDREA', 'DEL-JESUS', 'ARELLANO', 'VEGA', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('70403562', '162c97811e1d8f8610e36545d438a12abf879fd6', 'JULISSA', 'MAGALY', 'ASTUHUAMAN', 'TIZA', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('75824621', '9ee5a7d99b572f4a93d0bce5e0c557d657594a44', 'FIORELA', 'VALERIA', 'CAJACURI', 'MARISCAL', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('70180150', 'b99054c7664cf2c61f334a893e03a67daa8f77eb', 'XIMENA', 'IVETTE', 'CALLALLI', 'MORALES', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('72603958', '9c3708b54687e6704a3da0a00986aca0647e120e', 'JENYFER', 'PATRICIA', 'CHUCO', 'LIMAS', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('72610020', '67188ef3f7b7a9dfd2fdf247d893502abc8d70da', 'ROSAISELA', 'ANGELA', 'CORONADO', 'QUISPE', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('70184953', '6e4ca0dced8ff091780a3f13375642645960e0b6', 'CECILIA', 'OLENKA', 'HERRERA', 'LEVANO', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('75651721', '568095ee7b98b0afceb32540a1ca5540eaa72666', 'CLAUDIA', 'SUPLY', 'INOCENTE', 'DE-LA-CRUZ', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('70185706', 'dca3c169ada6de4f647fa14074b83211b98cb516', 'VALERIA', '-', 'LEONARDO', 'LEONARDO', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('73032661', '94de854417bfbc367149c9a462bc89c167afc1f2', 'ANYELA', 'YASU', 'MUÑOZ', 'VALENTIN', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('75840316', '3a03546bfcdb81113f4a3128f16c7ed688b40757', 'GABRIELA', 'DEL-ROSARIO', 'OLIVARES', 'RICALDI', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('77051406', '26fd51daf72b5a90b6f93508af228dc711b10db6', 'LUSVI', 'RIZPA', 'ORIHUELA', 'ORIHUELA', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('72047120', '625b71cd33d03995c32bd3238a0de7ea22a07548', 'ROCIO', 'LIZBETH', 'PACHECO', 'RAMIREZ', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('72388767', 'dc7636aed30693eef18a7388e3f98b24c1d2aedc', 'STEPHANY', 'MILAGROS', 'PALOMINO', 'LEIVA', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('70182310', 'affd33dec31b0844c378d4ba0506c22f4c3f1ce9', 'ANGIE', 'HILLARY', 'PASTRANA', 'RAMOS', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('72010606', 'fa99f711b07614bf06887dfc3b9d27cfcd6f79cd', 'JACKELINE', 'HILDA', 'RICALDI', 'JORGE', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('73198174', 'a66e4d2e817cd9b1297f05d6217b4ff2b0cfc5b1', 'ALEXANDRA', 'GABRIELA', 'ROMERO', 'AYALA', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('71452490', '6a90af129eeefc2f6e6a38746a2b33cb04c2c632', 'DIANA', 'PATRICIA', 'SANCHEZ', 'RAMOS', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('70185677', '4626676bd76e1e9428f31f9d2949b85e90c52c65', 'NICOL', 'VERONICA', 'SOLIS', 'TORRES', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('76167808', '55cd92128d2d99f8f263b48c20ad324b34f8e05a', 'LILIANA', 'ADA', 'SOLORZANO', 'LAVERIANO', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('72609841', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'GERALDINE', 'LEYDI', 'VALENCIA', 'MALPARTIDA', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('76340248', '981211f2e25470c484b1aeff89eaf68c51e93243', 'YADHIRA', 'LISBETH', 'YAPIAS', 'MORALES', 'gradfemale_avatar', 'F', 4, 'B', 0, 0, 0),
('76841778', '5a26a8edac14bcf78f62448d7d836a8a36845373', 'STEFANY', '-', 'ALANIA', 'GUERRERO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('72047142', '5494e0a87e8f79e83d3ba062f9f6d59672eab5fa', 'JEIDY', 'PATRICIA', 'AMARO', 'AVELLANEDA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('71718434', 'e21fc56c1a272b630e0d1439079d0598cf8b8329', 'MARIA', 'DEL-PILAR', 'BALDEON', 'BLANCO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70185718', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'GERALDINE', 'DELIA', 'BARRETO', 'YANTAS', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70178301', 'a66e4d2e817cd9b1297f05d6217b4ff2b0cfc5b1', 'ALEXANDRA', 'FABIOLA', 'BENDEZU', 'ZUÑIGA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74054510', '96d53734fc1bd54d848cd30f98069b90333b1bb3', 'MONICA', 'MARIA', 'CAJACURI', 'SOLIS', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74065299', '88db9292c772b38311e1778f6f6b18216443abf0', 'EVELYN', 'YADIRA', 'CAJACURI', 'YNCISO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74527583', '2043270082aeb8df7929c71ed6036cdfdcf7d08d', 'LIZBETH', 'KATHERINE', 'CASIMIRO', 'ESPINOZA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('72100708', '48a28d53d00edfc265bfaea6d607215b47ce4088', 'SELFA', 'PILAR', 'CONDORI', 'RAQUI', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74074815', 'e4ea294c062c525643df036a35ca579b905fa400', 'ADA', 'YEIMI', 'ECHEA', 'ULLOA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74065312', 'd676c3e7c2c7e35d69ad8d3f476a2556fcc2c422', 'JAZMIN', 'EVELYN', 'ESTRELLA', 'INGARUCA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70178971', '7cde4b5ba29ca8243c2be9b9fe138086f6f8136c', 'CARLA', 'SOFIA', 'ESTRELLA', 'ROMERO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('76050430', '5aec11673391994bee45ff5fac8ceb824a2e1bd1', 'LEONELA', 'SHEYLA', 'GALARZA', 'SAMANIEGO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('72100720', '81238610e9eb45f1a37e5905f66c06d49922568a', 'BERENICE', 'SUSSY', 'HIDALGO', 'CAPCHA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70181331', '8964af7e7645a7c6c1e891f5e69d22e8adaafe70', 'KARINA', 'DENISSE', 'HIDALGO', 'ORTIZ', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74643448', '6a90af129eeefc2f6e6a38746a2b33cb04c2c632', 'DIANA', 'CAROLINA', 'HUERTAS', 'RIOS', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70184967', '568095ee7b98b0afceb32540a1ca5540eaa72666', 'CLAUDIA', 'WENDOLY', 'JIMENEZ', 'VEGA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70470127', 'fcd1eee40b824e08506b5ff82781f775154ad51d', 'JUDITH', 'ROCIO', 'JORGE', 'MARCOS', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('71724112', '60fd7a308fbf20d935301c87eead4c1a9ffc284a', 'DANERI', 'SANDRA', 'LAVADO', 'ESPINOZA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('73568799', '64331d9d57282194df50c93024152c10e60dc374', 'ROSARIO', 'LILIANA', 'LEONARDO', 'ROMERO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('76086888', '88db9292c772b38311e1778f6f6b18216443abf0', 'EVELYN', 'DEANELLI', 'LINO', 'CASTILLO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70351344', 'cfab48b7cc86efb01f2b6ff11f2306058b18c482', 'MILENA', 'YASMIN', 'NAVARRO', 'MAYORCA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70185719', '2298625f2ba17912b286ad9afd8f089e460241b9', 'NATALIA', 'DE-JESUS', 'ORE', 'MANSILLA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('73816391', '5bf0f5391007dad6122c0f376546c36b1f8f43c9', 'KAROL', 'JOSSELINE', 'OSORIO', 'GRADOS', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74759548', '01d8a1d352c812d3869dbc52e067e0c14324114f', 'ASDRID', 'DAYANA', 'PAULINO', 'NINAHUAMAN', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('72490024', '290e2c336efa9a7a364ed29af23ebdc6dd8e0a65', 'YESSENIA', 'MIRIAM', 'PEREZ', 'MEJIA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('73183254', '6a90af129eeefc2f6e6a38746a2b33cb04c2c632', 'DIANA', 'SOFIA', 'PIZARRO', 'JORGE', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70478801', 'ffff78b9a1ad522703193c89b251f1acd2cf00a9', 'DAYANA', 'AMELIA', 'POMA', 'MEDINA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74094051', '3a03546bfcdb81113f4a3128f16c7ed688b40757', 'GABRIELA', 'ESPERANZA', 'PRINCE', 'HUAMAN', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('73266217', '821e2cb2efd0be19dc96281e185324fc26fe79ba', 'FIORELLA', 'ESTHER', 'QUISPE', 'MEZA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70184959', 'd561e68d50bf227cd2ecc41bae63c9cccb764197', 'PIERINA', 'BELEN', 'RAMOS', 'HURTADO', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70351349', 'f22f65b7648b39ed9a143ee135e879244f79cc36', 'LIZETH', 'CRISTINA', 'RODRIGUEZ', 'PAYTA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70178294', '80ae9a03f535038fa4fbe68d5fee2c1ac7e65c22', 'MARYORI', 'CLAUDIA', 'ROJAS', 'PARIAN', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('71276082', '573025376bab58005d94f7cdbc48ea4da0b3a3e8', 'SAMIRA', 'FARIDEY', 'ROSALES', 'DIAZ', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70179092', '6738b72954a4df82de1200aa6b1d4497d1a54e5a', 'ZHENIA', 'GIANELLA', 'SANCHEZ', 'NUÑEZ', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('74687245', 'ffb6327058bcce2822dc8f271882f250e05e4052', 'SARELA', 'LUISA', 'SONO', 'RODRIGUEZ', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70226490', '764be8fa8b54e1265be934eee4d8f130fe5dcd10', 'YEIMI', 'MIRELLA', 'SOTELO', 'ORTIZ', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70191219', 'fdb87dfd199045af7165780b11640b83768a0d57', 'ANDREA', '-', 'TERREL', 'SANCHEZ', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70239485', '5efc86ca883e265ab0bf38d45731d8612695cafa', 'ROSA', 'ISABEL', 'TORRES', 'HUAMAN', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('70178256', 'bb1f4af1426b82338853ddfc69f26ae11f1e7d65', 'ANTONELLA', 'DAJANA', 'ZACARIAS', 'JULCA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0),
('73436546', '2386e4f3bd124b8d25c947c4109f76cce717d2b3', 'NATALY', 'ROCIO', 'ZAPATA', 'ZAVALA', 'gradfemale_avatar', 'F', 5, '-', 0, 0, 0);



CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nombre2` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`dni`, `password`, `nombre`, `nombre2`, `apellido1`, `apellido2`, `avatar`, `sexo`, `email`, `isAdmin`) VALUES
('93873444', 'd4e7430f1534a12df46cedd1ac369935436dbb94', 'Ricardo', 'Jesus', 'Chinchay', 'Hernandez', 'engineer_avatar', 'M', 'liker251281@gmail.com', 1);







/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
