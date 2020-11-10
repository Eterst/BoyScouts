-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-11-2020 a las 02:59:23
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boyscouts`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `actualizarMiembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarMiembro` (IN `monitor1` INT, IN `jefe1` INT, IN `id_grupo1` INT, IN `id_miembro1` INT)  BEGIN
	DECLARE id_padre INT;
	UPDATE grupoxmiembro SET monitor = monitor1, jefe = jefe1 WHERE id_miembro = id_miembro1 AND id_grupo = id_grupo1;
    SELECT id_parent INTO id_padre FROM jerarquia WHERE jerarquia.id_grupo = id_grupo1; 
    IF monitor1 = 1 AND id_padre != id_grupo1 THEN 
    	INSERT INTO grupoxmiembro(id_grupo,id_miembro,monitor,jefe) VALUES(id_padre,id_miembro1,1,0);
    ELSEIF jefe1 = 1 AND id_padre != id_grupo1 THEN
    	INSERT INTO grupoxmiembro(id_grupo,id_miembro,monitor,jefe) VALUES(id_padre,id_miembro1,0,0);
   	END IF;
END$$

DROP PROCEDURE IF EXISTS `ascenderMiembroJefe`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ascenderMiembroJefe` (`id_miembro1` INT, `id_grupo1` INT)  UPDATE grupoxmiembro SET jefe = TRUE WHERE id_miembro = id_miembro1 and id_grupo = id_grupo1$$

DROP PROCEDURE IF EXISTS `eliminarMiembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarMiembro` (`id_miembro1` INT)  BEGIN
	DELETE FROM grupoxmiembro WHERE id_miembro = id_miembro1;
    DELETE FROM direccion WHERE id_miembro = id_miembro1;
    DELETE FROM miembro WHERE cedula = id_miembro1;
END$$

DROP PROCEDURE IF EXISTS `eliminarMiembroGrupo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarMiembroGrupo` (`id_miembro1` INT, `id_grupo1` INT)  BEGIN
    DELETE FROM grupoxmiembro WHERE id_miembro = id_miembro1 AND id_grupo = id_grupo1;
    
END$$

DROP PROCEDURE IF EXISTS `getAscenderMiembroJefe`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAscenderMiembroJefe` (IN `id_miembro1` INT)  SELECT * FROM grupoxmiembro WHERE id_miembro = id_miembro1$$

DROP PROCEDURE IF EXISTS `insertarmiembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarmiembro` ()  SELECT * FROM grupo$$

DROP PROCEDURE IF EXISTS `insertar_grupo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_grupo` (`nombregrupo` VARCHAR(40), `tipogrupo` VARCHAR(40), `id_parent` VARCHAR(40), `cedulamonitor` INT)  BEGIN
    IF tipogrupo = "coordinacion" THEN
        INSERT INTO grupo(nombre,tipo) VALUES(nombregrupo,tipogrupo);
        INSERT INTO grupoxmiembro(id_grupo,id_miembro,monitor,jefe) VALUES(LAST_INSERT_ID(),cedulamonitor,0,1);
    ELSEIF EXISTS(SELECT * FROM grupo WHERE grupo.id = id_parent) THEN
        INSERT INTO grupo(nombre,tipo) VALUES(nombregrupo,tipogrupo);
        IF tipogrupo = "grupo" THEN
            INSERT INTO grupoxmiembro(id_grupo,id_miembro,monitor,jefe) VALUES(LAST_INSERT_ID(),cedulamonitor,1,0);
            INSERT INTO jerarquia(id_grupo,id_parent) VALUES(LAST_INSERT_ID(),id_parent);  
        ELSE
            INSERT INTO grupoxmiembro(id_grupo,id_miembro,monitor,jefe) VALUES(LAST_INSERT_ID(),cedulamonitor,0,1);
            INSERT INTO jerarquia(id_grupo,id_parent) VALUES(LAST_INSERT_ID(),id_parent);
        END IF;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `insertar_miembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_miembro` (IN `cedula1` INT, IN `nombre1` VARCHAR(40), IN `apellidos1` VARCHAR(40), IN `correo1` VARCHAR(40), IN `telefono1` INT, IN `pais1` VARCHAR(40), IN `provincia1` VARCHAR(40), IN `canton1` VARCHAR(40), IN `distrito1` VARCHAR(40), IN `detalle1` VARCHAR(40), IN `id_grupo1` INT, IN `monitor1` INT, IN `jefe1` INT)  BEGIN
	DECLARE idpadre INT;
    INSERT INTO miembro(cedula, nombre, apellidos, correo, telefono) VALUES(cedula1, nombre1, apellidos1, correo1, telefono1);
	INSERT INTO direccion(id_miembro,pais, provincia, canton, distrito, detalle) VALUES(cedula1,pais1, provincia1, canton1, distrito1, detalle1);
    INSERT INTO grupoxmiembro(id_miembro,id_grupo,monitor,jefe) VALUES(cedula1,id_grupo1,monitor1,jefe1);
	SELECT id_parent INTO idpadre FROM jerarquia WHERE jerarquia.id_grupo = id_grupo1; 
    IF jefe1 = 1 AND idpadre != id_grupo1 THEN
        INSERT INTO grupoxmiembro(id_miembro,id_grupo,monitor,jefe) VALUES(cedula1,idpadre,0,0);
    ELSEIF monitor1 = 1 AND idpadre != id_grupo1 THEN 
        INSERT INTO grupoxmiembro(id_miembro,id_grupo,monitor,jefe) VALUES(cedula1,idpadre,1,0);
    END IF;
END$$

DROP PROCEDURE IF EXISTS `insertar_miembroSG`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_miembroSG` (`cedula1` INT, `nombre1` VARCHAR(40), `apellidos1` VARCHAR(40), `correo1` VARCHAR(40), `telefono1` INT, `pais1` VARCHAR(40), `provincia1` VARCHAR(40), `canton1` VARCHAR(40), `distrito1` VARCHAR(40), `detalle1` VARCHAR(40))  BEGIN
    INSERT INTO miembro(cedula, nombre, apellidos, correo, telefono) VALUES(cedula1, nombre1, apellidos1, correo1, telefono1);
    INSERT INTO direccion(id_miembro,pais, provincia, canton, distrito, detalle) VALUES(cedula1,pais1, provincia1, canton1, distrito1, detalle1);
END$$

DROP PROCEDURE IF EXISTS `mostrarCoordinaciones`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarCoordinaciones` ()  SELECT id,nombre FROM grupo WHERE grupo.tipo = "coordinacion"$$

DROP PROCEDURE IF EXISTS `mostrarGrupos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarGrupos` ()  SELECT id_grupo,id_parent,nombre FROM grupo JOIN jerarquia WHERE grupo.tipo = "grupo" and jerarquia.id_grupo = grupo.id$$

DROP PROCEDURE IF EXISTS `mostrarMiembros`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarMiembros` (IN `ident` INT)  SELECT m.cedula,m.nombre,m.apellidos,m.correo,m.telefono,pais,provincia,canton,distrito,detalle,gm.monitor,gm.jefe FROM ((GrupoXMiembro gm JOIN Miembro m) JOIN direccion d) where m.cedula = gm.id_miembro AND d.id_miembro = gm.id_miembro AND gm.id_grupo = ident$$

DROP PROCEDURE IF EXISTS `mostrarRamas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarRamas` ()  SELECT id_grupo,id_parent,nombre FROM grupo JOIN jerarquia WHERE grupo.tipo = "rama" and jerarquia.id_grupo = grupo.id$$

DROP PROCEDURE IF EXISTS `mostrarZonas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarZonas` ()  SELECT id_grupo,id_parent,nombre FROM grupo JOIN jerarquia WHERE grupo.tipo = "zona" and jerarquia.id_grupo = grupo.id$$

DROP PROCEDURE IF EXISTS `selectMiembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectMiembro` (`id_miembro1` INT)  SELECT * FROM grupoxmiembro WHERE id_miembro = id_miembro1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `canton` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `distrito` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `detalle` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `id_miembro` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_miembro` (`id_miembro`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id`, `pais`, `provincia`, `canton`, `distrito`, `detalle`, `id_miembro`) VALUES
(16, 'Costa Rica', 'Alajuela', 'Alajuela', 'San Antonio', 'El Roble', 207990940),
(17, 'Costa Rica', 'Alajuela', 'Naranjo', 'Cirri', 'Cirri sur', 12345),
(18, 'Costa Rica', 'Alajuela', 'Atenas', 'Nosexd', 'En una casa con puertas y ventanas', 54321),
(19, 'Costa Rica', 'San Jose', 'EscazÃº', 'Stawea', 'Al lado del taller', 111111),
(21, 'Costa Rica', 'Alajuela', 'Alajuela', 'San Antonio', 'Al que le funaron el dogo', 222222);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`, `tipo`) VALUES
(23, 'Juvenil', 'rama'),
(22, 'Norte', 'zona'),
(21, 'Costa Rica', 'coordinacion'),
(24, 'Grupo1', 'grupo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoxmiembro`
--

DROP TABLE IF EXISTS `grupoxmiembro`;
CREATE TABLE IF NOT EXISTS `grupoxmiembro` (
  `id_grupo` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL,
  `monitor` tinyint(1) NOT NULL DEFAULT '0',
  `jefe` tinyint(1) NOT NULL DEFAULT '0',
  KEY `id_grupo` (`id_grupo`),
  KEY `id_miembro` (`id_miembro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupoxmiembro`
--

INSERT INTO `grupoxmiembro` (`id_grupo`, `id_miembro`, `monitor`, `jefe`) VALUES
(21, 207990940, 0, 1),
(22, 12345, 0, 1),
(23, 54321, 0, 1),
(24, 111111, 1, 0),
(23, 222222, 1, 0),
(22, 111111, 1, 0),
(23, 111111, 1, 0),
(22, 54321, 0, 1),
(21, 54321, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jerarquia`
--

DROP TABLE IF EXISTS `jerarquia`;
CREATE TABLE IF NOT EXISTS `jerarquia` (
  `id_grupo` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  KEY `id_grupo` (`id_grupo`),
  KEY `id_parent` (`id_parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jerarquia`
--

INSERT INTO `jerarquia` (`id_grupo`, `id_parent`) VALUES
(22, 21),
(23, 22),
(24, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

DROP TABLE IF EXISTS `miembro`;
CREATE TABLE IF NOT EXISTS `miembro` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `miembro`
--

INSERT INTO `miembro` (`cedula`, `nombre`, `apellidos`, `correo`, `telefono`) VALUES
(207990940, 'Keylor', 'Cruz', 'keylorcruz99@gmail.com', 63361700),
(12345, 'Jonder', 'Hernandez', 'jonder09@gmail.com', 88888888),
(54321, 'Roy', 'Chavarria', 'roychg@gmail.com', 12345678),
(111111, 'Chuta', 'Rivera', 'ChutaR@gmail.com', 33333333),
(222222, 'Jhon', 'Wick', 'elmatador@gmail.com', 66666666);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
