SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DELIMITER $$
DROP PROCEDURE IF EXISTS `actualizarMiembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarMiembro` (`monitor1` INT, `jefe1` INT, `id_grupo1` INT, `id_miembro1` INT)  BEGIN
	DECLARE id_padre INT;
	UPDATE grupoxmiembro SET monitor = monitor1, jefe = jefe1 WHERE id_miembro = id_miembro1 AND id_grupo = id_grupo1;
    SELECT id_parent INTO id_padre FROM jerarquia WHERE jerarquia.id_grupo = id_grupo1; 
    IF monitor1 = 1 THEN
    	INSERT INTO grupoxmiembro(id_grupo,id_miembro,monitor,jefe) VALUES(id_padre,id_miembro1,1,0);
    ELSEIF jefe1 = 1 THEN
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
    IF jefe1 = 1 THEN
        INSERT INTO grupoxmiembro(id_miembro,id_grupo,monitor,jefe) VALUES(cedula1,idpadre,0,0);
    ELSEIF monitor1 = 1 THEN 
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarMiembros` ()  NO SQL
SELECT m.cedula,m.nombre,m.apellidos,m.correo,m.telefono,pais,provincia,canton,distrito,detalle,gm.monitor,gm.jefe FROM ((GrupoXMiembro gm JOIN Miembro m) JOIN direccion d) where m.cedula = gm.id_miembro AND d.id_miembro = gm.id_miembro$$

DROP PROCEDURE IF EXISTS `mostrarMiembrosGrupo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarMiembrosGrupo` (IN `ident` INT)  SELECT m.cedula,m.nombre,m.apellidos,m.correo,m.telefono,pais,provincia,canton,distrito,detalle,gm.monitor,gm.jefe FROM ((GrupoXMiembro gm JOIN Miembro m) JOIN direccion d) where m.cedula = gm.id_miembro AND d.id_miembro = gm.id_miembro AND gm.id_grupo = ident$$

DROP PROCEDURE IF EXISTS `mostrarRamas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarRamas` ()  SELECT id_grupo,id_parent,nombre FROM grupo JOIN jerarquia WHERE grupo.tipo = "rama" and jerarquia.id_grupo = grupo.id$$

DROP PROCEDURE IF EXISTS `mostrarZonas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarZonas` ()  SELECT id_grupo,id_parent,nombre FROM grupo JOIN jerarquia WHERE grupo.tipo = "zona" and jerarquia.id_grupo = grupo.id$$

DROP PROCEDURE IF EXISTS `selectMiembro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectMiembro` (`id_miembro1` INT)  SELECT * FROM grupoxmiembro WHERE id_miembro = id_miembro1$$

DELIMITER ;

DROP TABLE IF EXISTS direccion;
CREATE TABLE direccion (
  id int(11) NOT NULL,
  pais varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  provincia varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  canton varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  distrito varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  detalle varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  id_miembro int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO direccion (id, pais, provincia, canton, distrito, detalle, id_miembro) VALUES(16, 'Costa Rica', 'Alajuela', 'Naranjo', 'CirrÃ­', 'jaja pa k kieres saber eso jaja salu2', 208090132);
INSERT INTO direccion (id, pais, provincia, canton, distrito, detalle, id_miembro) VALUES(17, 'Taiwan', 'Africa xd', 'Ponte', 'Berga', 'despuÃ©s del perro echado', 123);
INSERT INTO direccion (id, pais, provincia, canton, distrito, detalle, id_miembro) VALUES(18, 'c', 'd', 'e', 'f', 'g', 789);

DROP TABLE IF EXISTS grupo;
CREATE TABLE grupo (
  id int(11) NOT NULL,
  nombre varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  tipo varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO grupo (id, nombre, tipo) VALUES(24, 'Coordinacion mamalona', 'coordinacion');
INSERT INTO grupo (id, nombre, tipo) VALUES(25, 'Zona mamalona', 'zona');
INSERT INTO grupo (id, nombre, tipo) VALUES(26, 'Rama mamada', 'rama');
INSERT INTO grupo (id, nombre, tipo) VALUES(27, 'Grupo mamalon', 'grupo');
INSERT INTO grupo (id, nombre, tipo) VALUES(28, 'Grupo F', 'grupo');

DROP TABLE IF EXISTS grupoxmiembro;
CREATE TABLE grupoxmiembro (
  id_grupo int(11) NOT NULL,
  id_miembro int(11) NOT NULL,
  monitor tinyint(1) NOT NULL DEFAULT '0',
  jefe tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(24, 208090132, 0, 1);
INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(25, 208090132, 0, 1);
INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(26, 208090132, 0, 1);
INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(27, 208090132, 1, 0);
INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(28, 208090132, 1, 0);
INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(27, 789, 1, 0);
INSERT INTO grupoxmiembro (id_grupo, id_miembro, monitor, jefe) VALUES(26, 789, 1, 0);

DROP TABLE IF EXISTS jerarquia;
CREATE TABLE jerarquia (
  id_grupo int(11) NOT NULL,
  id_parent int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO jerarquia (id_grupo, id_parent) VALUES(25, 24);
INSERT INTO jerarquia (id_grupo, id_parent) VALUES(26, 25);
INSERT INTO jerarquia (id_grupo, id_parent) VALUES(27, 26);
INSERT INTO jerarquia (id_grupo, id_parent) VALUES(28, 26);

DROP TABLE IF EXISTS miembro;
CREATE TABLE miembro (
  cedula int(11) NOT NULL,
  nombre varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  apellidos varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  correo varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  telefono int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO miembro (cedula, nombre, apellidos, correo, telefono) VALUES(208090132, 'Jonder', 'Hernandez Gutierrez', 'mjonder09@gmail.com', 85397030);
INSERT INTO miembro (cedula, nombre, apellidos, correo, telefono) VALUES(123, 'Keylor', 'Cruz Alfaro', 'keylorcruz99@gmail.com', 808080);
INSERT INTO miembro (cedula, nombre, apellidos, correo, telefono) VALUES(789, 'Juan xd', 'a', 'b@e.com', 9090);


ALTER TABLE direccion
  ADD PRIMARY KEY (id),
  ADD KEY id_miembro (id_miembro);

ALTER TABLE grupo
  ADD PRIMARY KEY (id);

ALTER TABLE grupoxmiembro
  ADD KEY id_grupo (id_grupo),
  ADD KEY id_miembro (id_miembro);

ALTER TABLE jerarquia
  ADD KEY id_grupo (id_grupo),
  ADD KEY id_parent (id_parent);

ALTER TABLE miembro
  ADD PRIMARY KEY (cedula);


ALTER TABLE direccion
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE grupo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
