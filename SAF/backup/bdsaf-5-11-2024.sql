-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2024 a las 18:47:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsaf`
--
CREATE DATABASE IF NOT EXISTS `bdsaf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bdsaf`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcanton`
--

CREATE TABLE IF NOT EXISTS `tbcanton` (
  `tbcantonid` int(11) NOT NULL,
  `tbprovinciaid` int(11) NOT NULL,
  `tbcantonidentificador` mediumtext NOT NULL,
  `tbcantonnombre` mediumtext NOT NULL,
  `tbcantonfechacreacion` date NOT NULL,
  `tbcantonfechamodificacion` date NOT NULL,
  `tbcantonestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbcanton`
--

INSERT INTO `tbcanton` (`tbcantonid`, `tbprovinciaid`, `tbcantonidentificador`, `tbcantonnombre`, `tbcantonfechacreacion`, `tbcantonfechamodificacion`, `tbcantonestado`) VALUES
(1, 1, 'SJ1', 'San José', '2024-08-02', '2024-08-02', 0),
(2, 1, 'SJ2', 'Escazú', '2024-08-02', '2024-08-02', 0),
(3, 1, 'SJ3', 'Desamparados', '2024-08-02', '2024-08-02', 0),
(4, 1, 'SJ4', 'Santa Ana', '2024-08-02', '2024-08-02', 0),
(5, 1, 'SJ5', 'Alajuelita', '2024-08-02', '2024-08-02', 0),
(6, 2, 'AL1', 'Alajuela', '2024-08-02', '2024-08-02', 0),
(7, 2, 'AL2', 'San Carlos', '2024-08-02', '2024-08-02', 0),
(8, 2, 'AL3', 'Grecia', '2024-08-02', '2024-08-02', 0),
(9, 2, 'AL4', 'Naranjo', '2024-08-02', '2024-08-02', 0),
(10, 2, 'AL5', 'Atenas', '2024-08-02', '2024-08-02', 0),
(11, 4, 'HE1', 'Heredia', '2024-08-02', '2024-08-02', 0),
(12, 4, 'HE2', 'San Pablo', '2024-08-02', '2024-08-02', 0),
(13, 4, 'HE3', 'San Rafael', '2024-08-02', '2024-08-02', 0),
(14, 4, 'HE4', 'Barva', '2024-08-02', '2024-08-02', 0),
(15, 4, 'HE5', 'Santo Domingo', '2024-08-02', '2024-08-02', 0),
(16, 3, 'CA1', 'Cartago', '2024-08-02', '2024-08-02', 0),
(17, 3, 'CA2', 'Paraíso', '2024-08-02', '2024-08-02', 0),
(18, 3, 'CA3', 'La Unión', '2024-08-02', '2024-08-02', 0),
(19, 3, 'CA4', 'Oreamuno', '2024-08-02', '2024-08-02', 0),
(20, 3, 'CA5', 'Jiménez', '2024-08-02', '2024-08-02', 0),
(21, 5, 'GU1', 'Liberia', '2024-08-02', '2024-08-02', 0),
(22, 5, 'GU2', 'Nicoya', '2024-08-02', '2024-08-02', 0),
(23, 5, 'GU3', 'Santa Cruz', '2024-08-02', '2024-08-02', 0),
(24, 5, 'GU4', 'Carrillo', '2024-08-02', '2024-08-02', 0),
(25, 5, 'GU5', 'Hojancha', '2024-08-02', '2024-08-02', 0),
(26, 6, 'PU1', 'Puntarenas', '2024-08-02', '2024-08-02', 0),
(27, 6, 'PU2', 'Esparza', '2024-08-02', '2024-08-02', 0),
(28, 6, 'PU3', 'Quepos', '2024-08-02', '2024-08-02', 0),
(29, 6, 'PU4', 'Golfito', '2024-08-02', '2024-08-02', 0),
(30, 6, 'PU5', 'Coto Brus', '2024-08-02', '2024-08-02', 0),
(31, 7, 'LI1', 'Limón', '2024-08-02', '2024-08-02', 0),
(32, 7, 'LI2', 'Guácimo', '2024-08-02', '2024-08-02', 0),
(33, 7, 'LI3', 'Pococí', '2024-08-02', '2024-08-02', 0),
(34, 7, 'LI4', 'Siquirres', '2024-08-02', '2024-08-02', 0),
(35, 7, 'LI5', 'Matina', '2024-08-02', '2024-08-02', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcategoria`
--

CREATE TABLE IF NOT EXISTS `tbcategoria` (
  `tbcategoriaid` int(11) NOT NULL,
  `tbcategoriaidentificador` mediumtext NOT NULL,
  `tbcategorianombre` mediumtext NOT NULL,
  `tbcategoriadescripcion` mediumtext NOT NULL,
  `tbcategoriafechacreacion` date NOT NULL,
  `tbcategoriafechamodificacion` date NOT NULL,
  `tbcategoriaestado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbcategoria`
--

INSERT INTO `tbcategoria` (`tbcategoriaid`, `tbcategoriaidentificador`, `tbcategorianombre`, `tbcategoriadescripcion`, `tbcategoriafechacreacion`, `tbcategoriafechamodificacion`, `tbcategoriaestado`) VALUES
(1, 'CAT-21102024235354', 'ANIMALES VIVOS Y PRODUCTOS DEL REINO ANIMAL', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(2, 'CAT-21102024235401', 'PRODUCTOS DEL REINO VEGETAL', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(3, 'CAT-21102024235420', 'GRASAS Y ACEITES ANIMALES O VEGETALES', 'PRODUCTOS DE SU   DESDOBLAMIENTO', '2024-10-21', '2024-10-21', 1),
(4, 'CAT-21102024235452', 'PRODUCTOS DE LAS INDUSTRIAS ALIMENTARIAS', 'BEBIDAS LIQUIDOS ALCOHOLICOS Y VINAGRE', '2024-10-21', '2024-10-21', 1),
(5, 'CAT-21102024235503', 'PRODUCTOS MINERALES', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(6, 'CAT-21102024235512', 'PRODUCTOS DE LAS INDUSTRIAS QUIMICAS  O DE LAS INDUSTRIAS CONEXAS', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(7, 'CAT-21102024235522', 'PLASTICO Y SUS MANUFACTURAS', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(8, 'CAT-21102024235543', 'PIELES CUEROS PELETERIA Y MANUFACTURAS DE ESTAS MATERIAS', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(9, 'CAT-21102024235555', 'MADERA CARBON VEGETAL Y MANUFACTURAS DE MADERA', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(10, 'CAT-21102024235608', 'PASTA DE MADERA O DE LAS DEMAS MATERIAS FIBROSAS CELULOSICAS', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(11, 'CAT-21102024235615', 'MATERIAS TEXTILES Y SUS MANUFACTURAS', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(12, 'CAT-21102024235740', 'CALZADO SOMBREROS Y DEMAS', 'PARAGUAS  QUITASOLES BASTONES LATIGOS FUSTAS Y SUS PARTES  PLUMAS PREPARADAS Y ARTICULOS DE PLUMAS  FLORES ARTIFICIALES MANUFACTURAS DE CABELLO', '2024-10-21', '2024-10-21', 1),
(13, 'CAT-21102024235906', 'MANUFACTURAS DE PIEDRA YESO FRAGUABLE CEMENTO', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(14, 'CAT-21102024235939', 'PIEDRAS PRECIOSAS O SEMIPRECIOSAS', 'METALES PRECIOSOS CHAPADOS DE METAL PRECIOSO', '2024-10-21', '2024-10-21', 1),
(15, 'CAT-21102024235946', 'METALES COMUNES Y MANUFACTURAS DE ESTOS METALES', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(16, 'CAT-22102024000031', 'MAQUINAS Y APARATOS MATERIAL ELECTRICO Y SUS PARTES', 'APARATOS DE GRABACION O REPRODUCCION DE SONIDO  APARATOS DE GRABACION O REPRODUCCION  DE IMAGEN Y SONIDO EN TELEVISION  Y LAS PARTES Y ACCESORIOS DE ESTOS APARATOS ', '2024-10-22', '2024-10-22', 1),
(17, 'CAT-22102024000040', 'MATERIAL DE TRANSPORTE', 'Sin descripcion', '2024-10-22', '2024-10-22', 1),
(18, 'CAT-22102024000102', 'INSTRUMENTOS Y APARATOS DE OPTICA FOTOGRAFIA O CINEMATOGRAFIA', 'Sin descripcion', '2024-10-22', '2024-10-22', 1),
(19, 'CAT-22102024000124', 'ARMAS MUNICIONES Y SUS PARTES Y ACCESORIOS', 'Sin descripcion', '2024-10-22', '2024-10-22', 1),
(20, 'CAT-22102024000131', 'MERCANCIAS Y PRODUCTOS DIVERSOS', 'Sin descripcion', '2024-10-22', '2024-10-22', 1),
(21, 'CAT-22102024000202', 'OBJETOS DE ARTE O COLECCION Y ANTIGUEDADES', 'Sin descripcion', '2024-10-22', '2024-10-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientecredito`
--

CREATE TABLE IF NOT EXISTS `tbclientecredito` (
  `tbclientecreditoid` int(11) NOT NULL,
  `tbclienteidentificador` tinytext NOT NULL,
  `tbclientecreditoidentificador` varchar(255) NOT NULL,
  `tbclientecreditocantidad` float NOT NULL,
  `tbclientecreditoporcentaje` float NOT NULL,
  `tbclientecreditoplazo` int(11) NOT NULL,
  `tbclientecreditofechainicio` date NOT NULL,
  `tbclientecreditofechavencimiento` date NOT NULL,
  `tbclientecreditocreadoen` date NOT NULL,
  `tbclientecreditomodificadoen` date NOT NULL,
  `tbclientecreditoestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcompra`
--

CREATE TABLE IF NOT EXISTS `tbcompra` (
  `tbcompraid` int(11) NOT NULL,
  `tbcompraidentificador` varchar(255) NOT NULL,
  `tbcompraidentificadorproveedor` varchar(255) NOT NULL,
  `tbcompratotal` double NOT NULL,
  `tbcompranotas` varchar(255) NOT NULL,
  `tbcomprametodopago` varchar(255) NOT NULL,
  `tbcomprafecha` date NOT NULL,
  `tbcompracreadoen` date NOT NULL,
  `tbcompramodificadoen` date NOT NULL,
  `tbcompraestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcorreoproveedor`
--

CREATE TABLE IF NOT EXISTS `tbcorreoproveedor` (
  `tbcorreoproveedorid` int(11) NOT NULL,
  `tbcorreoproveedoridentificador` mediumtext NOT NULL,
  `tbcorreoproveedoridproveedor` int(11) NOT NULL,
  `tbcorreoproveedorcorreo` mediumtext NOT NULL,
  `tbcorreoproveedorcreadoen` date NOT NULL,
  `tbcorreoproveedormodificadoen` date NOT NULL,
  `tbcorreoproveedorestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbcorreoproveedor`
--

INSERT INTO `tbcorreoproveedor` (`tbcorreoproveedorid`, `tbcorreoproveedoridentificador`, `tbcorreoproveedoridproveedor`, `tbcorreoproveedorcorreo`, `tbcorreoproveedorcreadoen`, `tbcorreoproveedormodificadoen`, `tbcorreoproveedorestado`) VALUES
(1, 'CORREO-001', 1, 'contacto@abc.com', '2023-01-01', '2023-10-21', 1),
(2, 'CORREO-002', 2, 'info@xyz.com', '2023-02-15', '2023-10-21', 1),
(3, 'CORREO-003', 3, 'servicios@suministros.com', '2023-03-10', '2023-10-21', 1),
(4, 'CORREO-004', 4, 'soporte@techsolutions.com', '2023-04-05', '2023-10-21', 1),
(5, 'CORREO-005', 5, 'ventas@comercializadora.com', '2023-05-20', '2023-10-21', 1),
(6, 'CORREO-006', 6, 'contacto@deliciosos.com', '2023-06-15', '2023-10-21', 1),
(7, 'CORREO-007', 7, 'info@electrodomesticos.com', '2023-07-10', '2023-10-21', 1),
(8, 'CORREO-008', 8, 'ventas@muebles.com', '2023-08-01', '2023-10-21', 1),
(9, 'CORREO-009', 9, 'info@construccion.com', '2023-09-12', '2023-10-21', 1),
(10, 'CORREO-010', 10, 'servicio@electricos.com', '2023-10-05', '2023-10-21', 1),
(11, 'CORREO-011', 11, 'contacto@moda.com', '2023-01-20', '2023-10-21', 1),
(12, 'CORREO-012', 12, 'info@juguetes.com', '2023-02-25', '2023-10-21', 1),
(13, 'CORREO-013', 13, 'contacto@oficina.com', '2023-03-30', '2023-10-21', 1),
(14, 'CORREO-014', 14, 'info@limpieza.com', '2023-04-18', '2023-10-21', 1),
(15, 'CORREO-015', 15, 'contacto@saludable.com', '2023-05-22', '2023-10-21', 1),
(16, 'CORREO-016', 16, 'info@belleza.com', '2023-06-11', '2023-10-21', 1),
(17, 'CORREO-017', 17, 'contacto@accesorios.com', '2023-07-19', '2023-10-21', 1),
(18, 'CORREO-018', 18, 'info@deportes.com', '2023-08-27', '2023-10-21', 1),
(19, 'CORREO-019', 19, 'contacto@medicos.com', '2023-09-09', '2023-10-21', 1),
(20, 'CORREO-020', 20, 'info@tecnologia.com', '2023-10-15', '2023-10-21', 1),
(21, 'EMA-SUP-cocacola@gmail.com-2024-10-2118:00:19', 21, 'cocacola@gmail.com', '2024-10-21', '2024-10-21', 1),
(22, 'EMA-SUP-sardimar@gmail.com-2024-10-2118:04:16', 22, 'sardimar@gmail.com', '2024-10-21', '2024-10-21', 1),
(23, 'EMA-SUP-demasa@gmail.com-2024-10-2118:07:21', 23, 'demasa@gmail.com', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdetallecompra`
--

CREATE TABLE IF NOT EXISTS `tbdetallecompra` (
  `tbdetallecompraid` int(11) DEFAULT NULL,
  `tbdetallecompraidentificador` mediumtext NOT NULL,
  `tbdetallecompracompraid` int(11) NOT NULL,
  `tbdetallecompraproductoid` int(11) NOT NULL,
  `tbdetallecompraloteid` int(11) NOT NULL,
  `tbdetallecompracantidadunidades` int(11) NOT NULL,
  `tbdetallecomprafechacreacion` datetime NOT NULL,
  `tbdetallecomprafechamodificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdireccionproveedor`
--

CREATE TABLE IF NOT EXISTS `tbdireccionproveedor` (
  `tbdireccionproveedorid` int(11) NOT NULL,
  `tbdireccionproveedoridentificador` mediumtext NOT NULL,
  `tbproveedorid` int(11) NOT NULL,
  `tbdistritoid` int(11) NOT NULL,
  `tbdireccionporsenha` mediumtext NOT NULL,
  `tbdireccionproveedorfechacreacion` date NOT NULL,
  `tbdireccionproveedorfechamodificacion` date NOT NULL,
  `tbdireccionproveedorestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbdireccionproveedor`
--

INSERT INTO `tbdireccionproveedor` (`tbdireccionproveedorid`, `tbdireccionproveedoridentificador`, `tbproveedorid`, `tbdistritoid`, `tbdireccionporsenha`, `tbdireccionproveedorfechacreacion`, `tbdireccionproveedorfechamodificacion`, `tbdireccionproveedorestado`) VALUES
(1, 'DIR-001', 1, 1, 'Av. Principal 123', '2023-01-01', '2023-10-21', 1),
(2, 'DIR-002', 2, 1, 'Calle Secundaria 456', '2023-02-15', '2023-10-21', 1),
(3, 'DIR-003', 3, 1, 'Boulevard 789', '2023-03-10', '2023-10-21', 1),
(4, 'DIR-004', 4, 1, 'Paseo del Comercio 101', '2023-04-05', '2023-10-21', 1),
(5, 'DIR-005', 5, 1, 'Calle de la Industria 202', '2023-05-20', '2023-10-21', 1),
(6, 'DIR-006', 6, 1, 'Av. de los Suministros 303', '2023-06-15', '2023-10-21', 1),
(7, 'DIR-007', 7, 1, 'Calle de los Electrodomésticos 404', '2023-07-10', '2023-10-21', 1),
(8, 'DIR-008', 8, 1, 'Calle de los Muebles 505', '2023-08-01', '2023-10-21', 1),
(9, 'DIR-009', 9, 1, 'Av. de la Construcción 606', '2023-09-12', '2023-10-21', 1),
(10, 'DIR-010', 10, 1, 'Calle de los Servicios 707', '2023-10-05', '2023-10-21', 1),
(11, 'DIR-011', 11, 1, 'Av. de la Moda 808', '2023-01-20', '2023-10-21', 1),
(12, 'DIR-012', 12, 1, 'Calle de los Juguetes 909', '2023-02-25', '2023-10-21', 1),
(13, 'DIR-013', 13, 1, 'Av. de la Oficina 111', '2023-03-30', '2023-10-21', 1),
(14, 'DIR-014', 14, 1, 'Calle de la Limpieza 222', '2023-04-18', '2023-10-21', 1),
(15, 'DIR-015', 15, 1, 'Av. de la Salud 333', '2023-05-22', '2023-10-21', 1),
(16, 'DIR-016', 16, 1, 'Calle de la Belleza 444', '2023-06-11', '2023-10-21', 1),
(17, 'DIR-017', 17, 1, 'Av. de los Accesorios 555', '2023-07-19', '2023-10-21', 1),
(18, 'DIR-018', 18, 1, 'Calle de los Deportes 666', '2023-08-27', '2023-10-21', 1),
(19, 'DIR-019', 19, 1, 'Av. de los Médicos 777', '2023-09-09', '2023-10-21', 1),
(20, 'DIR-020', 20, 1, 'Calle de la Tecnología 888', '2023-10-15', '2023-10-21', 1),
(21, 'DIREC-SUP-70201-2024-10-2118:00:19', 21, 156, 'Guapiles', '2024-10-21', '2024-10-21', 1),
(22, 'DIREC-SUP-60101-2024-10-2118:04:16', 22, 126, 'En el roble de puntarenas', '2024-10-21', '2024-10-21', 1),
(23, 'DIREC-SUP-10404-2024-10-2118:07:21', 23, 19, 'San José, Zona Industrial Oeste', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdistrito`
--

CREATE TABLE IF NOT EXISTS `tbdistrito` (
  `tbdistritoid` int(11) NOT NULL,
  `tbcantonid` int(11) NOT NULL,
  `tbdistritoidentificador` mediumtext NOT NULL,
  `tbdistritonombre` mediumtext NOT NULL,
  `tbdistritofechacreacion` date NOT NULL,
  `tbdistritofechamodificacion` date NOT NULL,
  `tbdistritoestado` tinyint(1) NOT NULL,
  `tbdistritodetalle` mediumtext NOT NULL,
  `tbcodigopostal` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbdistrito`
--

INSERT INTO `tbdistrito` (`tbdistritoid`, `tbcantonid`, `tbdistritoidentificador`, `tbdistritonombre`, `tbdistritofechacreacion`, `tbdistritofechamodificacion`, `tbdistritoestado`, `tbdistritodetalle`, `tbcodigopostal`) VALUES
(1, 1, 'SJ1-1', 'Carmen', '2024-08-02', '2024-08-02', 0, 'Centro de San José', '10101'),
(2, 1, 'SJ1-2', 'Merced', '2024-08-02', '2024-08-02', 0, 'Parte central de San José', '10102'),
(3, 1, 'SJ1-3', 'Hospital', '2024-08-02', '2024-08-02', 0, 'Sector oeste del centro de San José', '10103'),
(4, 1, 'SJ1-4', 'Catedral', '2024-08-02', '2024-08-02', 0, 'Sector este del centro de San José', '10104'),
(5, 1, 'SJ1-5', 'Zapote', '2024-08-02', '2024-08-02', 0, 'Distrito residencial al sureste de San José', '10105'),
(6, 2, 'SJ2-1', 'San Miguel', '2024-08-02', '2024-08-02', 0, 'Centro de Escazú', '10201'),
(7, 2, 'SJ2-2', 'San Rafael', '2024-08-02', '2024-08-02', 0, 'Parte oeste de Escazú', '10202'),
(8, 2, 'SJ2-3', 'San Antonio', '2024-08-02', '2024-08-02', 0, 'Distrito sureste de Escazú', '10203'),
(9, 2, 'SJ2-4', 'Bello Horizonte', '2024-08-02', '2024-08-02', 0, 'Área residencial en el norte de Escazú', '10204'),
(10, 2, 'SJ2-5', 'Guachipelín', '2024-08-02', '2024-08-02', 0, 'Distrito comercial y residencial al norte de Escazú', '10205'),
(11, 3, 'SJ3-1', 'Desamparados', '2024-08-02', '2024-08-02', 0, 'Centro de Desamparados', '10301'),
(12, 3, 'SJ3-2', 'San Miguel', '2024-08-02', '2024-08-02', 0, 'Distrito noreste de Desamparados', '10302'),
(13, 3, 'SJ3-3', 'San Juan de Dios', '2024-08-02', '2024-08-02', 0, 'Distrito sur de Desamparados', '10303'),
(14, 3, 'SJ3-4', 'San Rafael Arriba', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Desamparados', '10304'),
(15, 3, 'SJ3-5', 'San Rafael Abajo', '2024-08-02', '2024-08-02', 0, 'Distrito al suroeste de Desamparados', '10305'),
(16, 4, 'SJ4-1', 'Santa Ana', '2024-08-02', '2024-08-02', 0, 'Centro de Santa Ana', '10401'),
(17, 4, 'SJ4-2', 'Salitral', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Santa Ana', '10402'),
(18, 4, 'SJ4-3', 'Pozos', '2024-08-02', '2024-08-02', 0, 'Distrito norte de Santa Ana', '10403'),
(19, 4, 'SJ4-4', 'Uruca', '2024-08-02', '2024-08-02', 0, 'Distrito al noreste de Santa Ana', '10404'),
(20, 4, 'SJ4-5', 'Piedades', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Santa Ana', '10405'),
(21, 5, 'SJ5-1', 'Alajuelita', '2024-08-02', '2024-08-02', 0, 'Centro de Alajuelita', '10501'),
(22, 5, 'SJ5-2', 'San Josecito', '2024-08-02', '2024-08-02', 0, 'Distrito al noreste de Alajuelita', '10502'),
(23, 5, 'SJ5-3', 'San Antonio', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Alajuelita', '10503'),
(24, 5, 'SJ5-4', 'Concepción', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Alajuelita', '10504'),
(25, 5, 'SJ5-5', 'San Felipe', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Alajuelita', '10505'),
(26, 6, 'AL1-1', 'Alajuela', '2024-08-02', '2024-08-02', 0, 'Centro de Alajuela', '20101'),
(27, 6, 'AL1-2', 'San José', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Alajuela', '20102'),
(28, 6, 'AL1-3', 'Carrizal', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Alajuela', '20103'),
(29, 6, 'AL1-4', 'San Antonio', '2024-08-02', '2024-08-02', 0, 'Distrito al noreste de Alajuela', '20104'),
(30, 6, 'AL1-5', 'Guácima', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Alajuela', '20105'),
(31, 7, 'AL2-1', 'Quesada', '2024-08-02', '2024-08-02', 0, 'Centro de San Carlos', '20201'),
(32, 7, 'AL2-2', 'Florencia', '2024-08-02', '2024-08-02', 0, 'Distrito al este de San Carlos', '20202'),
(33, 7, 'AL2-3', 'Buenavista', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de San Carlos', '20203'),
(34, 7, 'AL2-4', 'Aguas Zarcas', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de San Carlos', '20204'),
(35, 7, 'AL2-5', 'Venecia', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de San Carlos', '20205'),
(36, 8, 'AL3-1', 'Grecia', '2024-08-02', '2024-08-02', 0, 'Centro de Grecia', '20301'),
(37, 8, 'AL3-2', 'San Isidro', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Grecia', '20302'),
(38, 8, 'AL3-3', 'San José', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Grecia', '20303'),
(39, 8, 'AL3-4', 'San Roque', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Grecia', '20304'),
(40, 8, 'AL3-5', 'Tacares', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Grecia', '20305'),
(41, 9, 'AL4-1', 'Naranjo', '2024-08-02', '2024-08-02', 0, 'Centro de Naranjo', '20401'),
(42, 9, 'AL4-2', 'San Miguel', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Naranjo', '20402'),
(43, 9, 'AL4-3', 'San José', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Naranjo', '20403'),
(44, 9, 'AL4-4', 'Cirrí Sur', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Naranjo', '20404'),
(45, 9, 'AL4-5', 'San Jerónimo', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Naranjo', '20405'),
(46, 10, 'AL5-1', 'Atenas', '2024-08-02', '2024-08-02', 0, 'Centro de Atenas', '20501'),
(47, 10, 'AL5-2', 'Jesús', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Atenas', '20502'),
(48, 10, 'AL5-3', 'Mercedes', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Atenas', '20503'),
(49, 10, 'AL5-4', 'San Isidro', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Atenas', '20504'),
(50, 10, 'AL5-5', 'Concepción', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Atenas', '20505'),
(51, 11, 'HE1-1', 'Heredia', '2024-08-02', '2024-08-02', 0, 'Centro de Heredia', '40101'),
(52, 11, 'HE1-2', 'Mercedes', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Heredia', '40102'),
(53, 11, 'HE1-3', 'San Francisco', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Heredia', '40103'),
(54, 11, 'HE1-4', 'Ulloa', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Heredia', '40104'),
(55, 11, 'HE1-5', 'Varablanca', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Heredia', '40105'),
(56, 12, 'HE2-1', 'San Pablo', '2024-08-02', '2024-08-02', 0, 'Centro de San Pablo', '40201'),
(57, 12, 'HE2-2', 'Rincón de Sabanilla', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de San Pablo', '40202'),
(58, 12, 'HE2-3', 'Calle Blancos', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de San Pablo', '40203'),
(59, 12, 'HE2-4', 'San Josecito', '2024-08-02', '2024-08-02', 0, 'Distrito al este de San Pablo', '40204'),
(60, 12, 'HE2-5', 'La Amistad', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de San Pablo', '40205'),
(61, 13, 'HE3-1', 'San Rafael', '2024-08-02', '2024-08-02', 0, 'Centro de San Rafael', '40301'),
(62, 13, 'HE3-2', 'Concepción', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de San Rafael', '40302'),
(63, 13, 'HE3-3', 'San Josecito', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de San Rafael', '40303'),
(64, 13, 'HE3-4', 'Santiago', '2024-08-02', '2024-08-02', 0, 'Distrito al este de San Rafael', '40304'),
(65, 13, 'HE3-5', 'Ángeles', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de San Rafael', '40305'),
(66, 14, 'HE4-1', 'Barva', '2024-08-02', '2024-08-02', 0, 'Centro de Barva', '40401'),
(67, 14, 'HE4-2', 'San Pedro', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Barva', '40402'),
(68, 14, 'HE4-3', 'San Roque', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Barva', '40403'),
(69, 14, 'HE4-4', 'Santa Lucía', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Barva', '40404'),
(70, 14, 'HE4-5', 'San Pablo', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Barva', '40405'),
(71, 15, 'HE5-1', 'Santo Domingo', '2024-08-02', '2024-08-02', 0, 'Centro de Santo Domingo', '40501'),
(72, 15, 'HE5-2', 'San Vicente', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Santo Domingo', '40502'),
(73, 15, 'HE5-3', 'San Miguel', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Santo Domingo', '40503'),
(74, 15, 'HE5-4', 'Paracito', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Santo Domingo', '40504'),
(75, 15, 'HE5-5', 'Santa Rosa', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Santo Domingo', '40505'),
(76, 16, 'CA1-1', 'Oriental', '2024-08-02', '2024-08-02', 0, 'Centro de Cartago', '30101'),
(77, 16, 'CA1-2', 'Occidental', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Cartago', '30102'),
(78, 16, 'CA1-3', 'Carmen', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Cartago', '30103'),
(79, 16, 'CA1-4', 'San Nicolás', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Cartago', '30104'),
(80, 16, 'CA1-5', 'Agua Caliente', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Cartago', '30105'),
(81, 17, 'CA2-1', 'Paraíso', '2024-08-02', '2024-08-02', 0, 'Centro de Paraíso', '30201'),
(82, 17, 'CA2-2', 'Santiago', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Paraíso', '30202'),
(83, 17, 'CA2-3', 'Orosi', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Paraíso', '30203'),
(84, 17, 'CA2-4', 'Cachí', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Paraíso', '30204'),
(85, 17, 'CA2-5', 'Llanos de Santa Lucía', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Paraíso', '30205'),
(86, 18, 'CA3-1', 'Tres Ríos', '2024-08-02', '2024-08-02', 0, 'Centro de La Unión', '30301'),
(87, 18, 'CA3-2', 'San Ramón', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de La Unión', '30302'),
(88, 18, 'CA3-3', 'San Juan', '2024-08-02', '2024-08-02', 0, 'Distrito al este de La Unión', '30303'),
(89, 18, 'CA3-4', 'San Rafael', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de La Unión', '30304'),
(90, 18, 'CA3-5', 'Concepción', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de La Unión', '30305'),
(91, 19, 'CA4-1', 'San Rafael', '2024-08-02', '2024-08-02', 0, 'Centro de Oreamuno', '30401'),
(92, 19, 'CA4-2', 'Cot', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Oreamuno', '30402'),
(93, 19, 'CA4-3', 'Potrero Cerrado', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Oreamuno', '30403'),
(94, 19, 'CA4-4', 'Cipreses', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Oreamuno', '30404'),
(95, 19, 'CA4-5', 'Santa Rosa', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Oreamuno', '30405'),
(96, 20, 'CA5-1', 'Juan Viñas', '2024-08-02', '2024-08-02', 0, 'Centro de Jiménez', '30501'),
(97, 20, 'CA5-2', 'Tucurrique', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Jiménez', '30502'),
(98, 20, 'CA5-3', 'Pejibaye', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Jiménez', '30503'),
(99, 20, 'CA5-4', 'Purisil', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Jiménez', '30504'),
(100, 20, 'CA5-5', 'San Jerónimo', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Jiménez', '30505'),
(101, 21, 'GU1-1', 'Liberia', '2024-08-02', '2024-08-02', 0, 'Centro de Liberia', '50101'),
(102, 21, 'GU1-2', 'Cañas Dulces', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Liberia', '50102'),
(103, 21, 'GU1-3', 'Mayorga', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Liberia', '50103'),
(104, 21, 'GU1-4', 'Nacascolo', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Liberia', '50104'),
(105, 21, 'GU1-5', 'Curubandé', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Liberia', '50105'),
(106, 22, 'GU2-1', 'Nicoya', '2024-08-02', '2024-08-02', 0, 'Centro de Nicoya', '50201'),
(107, 22, 'GU2-2', 'Mansión', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Nicoya', '50202'),
(108, 22, 'GU2-3', 'San Antonio', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Nicoya', '50203'),
(109, 22, 'GU2-4', 'Quebrada Honda', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Nicoya', '50204'),
(110, 22, 'GU2-5', 'Sámara', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Nicoya', '50205'),
(111, 23, 'GU3-1', 'Santa Cruz', '2024-08-02', '2024-08-02', 0, 'Centro de Santa Cruz', '50301'),
(112, 23, 'GU3-2', 'Bolsón', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Santa Cruz', '50302'),
(113, 23, 'GU3-3', 'Veintisiete de Abril', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Santa Cruz', '50303'),
(114, 23, 'GU3-4', 'Tempate', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Santa Cruz', '50304'),
(115, 23, 'GU3-5', 'Cartagena', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Santa Cruz', '50305'),
(116, 24, 'GU4-1', 'Filadelfia', '2024-08-02', '2024-08-02', 0, 'Centro de Carrillo', '50401'),
(117, 24, 'GU4-2', 'Palmira', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Carrillo', '50402'),
(118, 24, 'GU4-3', 'Sardinal', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Carrillo', '50403'),
(119, 24, 'GU4-4', 'Belén', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Carrillo', '50404'),
(120, 24, 'GU4-5', 'Bosques de Doña Rosa', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Carrillo', '50405'),
(121, 25, 'GU5-1', 'Hojancha', '2024-08-02', '2024-08-02', 0, 'Centro de Hojancha', '50501'),
(122, 25, 'GU5-2', 'Monte Romo', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Hojancha', '50502'),
(123, 25, 'GU5-3', 'Puerto Carrillo', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Hojancha', '50503'),
(124, 25, 'GU5-4', 'Huacas', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Hojancha', '50504'),
(125, 25, 'GU5-5', 'Matapalo', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Hojancha', '50505'),
(126, 26, 'PU1-1', 'Puntarenas', '2024-08-02', '2024-08-02', 0, 'Centro de Puntarenas', '60101'),
(127, 26, 'PU1-2', 'Pitahaya', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Puntarenas', '60102'),
(128, 26, 'PU1-3', 'Chomes', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Puntarenas', '60103'),
(129, 26, 'PU1-4', 'Lepanto', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Puntarenas', '60104'),
(130, 26, 'PU1-5', 'Isla del Coco', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Puntarenas', '60105'),
(131, 27, 'PU2-1', 'Esparza', '2024-08-02', '2024-08-02', 0, 'Centro de Esparza', '60201'),
(132, 27, 'PU2-2', 'San Rafael', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Esparza', '60202'),
(133, 27, 'PU2-3', 'San Jerónimo', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Esparza', '60203'),
(134, 27, 'PU2-4', 'Caldera', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Esparza', '60204'),
(135, 27, 'PU2-5', 'El Roble', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Esparza', '60205'),
(136, 28, 'PU3-1', 'Buenos Aires', '2024-08-02', '2024-08-02', 0, 'Centro de Buenos Aires', '60301'),
(137, 28, 'PU3-2', 'Volcán', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Buenos Aires', '60302'),
(138, 28, 'PU3-3', 'Potrero Grande', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Buenos Aires', '60303'),
(139, 28, 'PU3-4', 'Pilón', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Buenos Aires', '60304'),
(140, 28, 'PU3-5', 'Colinas', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Buenos Aires', '60305'),
(141, 29, 'PU4-1', 'Osa', '2024-08-02', '2024-08-02', 0, 'Centro de Osa', '60401'),
(142, 29, 'PU4-2', 'Palmar', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Osa', '60402'),
(143, 29, 'PU4-3', 'Piedras Blancas', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Osa', '60403'),
(144, 29, 'PU4-4', 'Bahía Ballena', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Osa', '60404'),
(145, 29, 'PU4-5', 'Cortés', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Osa', '60405'),
(146, 30, 'PU5-1', 'Quepos', '2024-08-02', '2024-08-02', 0, 'Centro de Quepos', '60501'),
(147, 30, 'PU5-2', 'Savegre', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Quepos', '60502'),
(148, 30, 'PU5-3', 'Naranjito', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Quepos', '60503'),
(149, 30, 'PU5-4', 'Villa Nueva', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Quepos', '60504'),
(150, 30, 'PU5-5', 'Cerros', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Quepos', '60505'),
(151, 31, 'LI1-1', 'Limón', '2024-08-02', '2024-08-02', 0, 'Centro de Limón', '70101'),
(152, 31, 'LI1-2', 'Valle La Estrella', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Limón', '70102'),
(153, 31, 'LI1-3', 'Río Blanco', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Limón', '70103'),
(154, 31, 'LI1-4', 'Matama', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Limón', '70104'),
(155, 31, 'LI1-5', 'Bataán', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Limón', '70105'),
(156, 32, 'LI2-1', 'Guácimo', '2024-08-02', '2024-08-02', 0, 'Centro de Guácimo', '70201'),
(157, 32, 'LI2-2', 'Río Jiménez', '2024-08-02', '2024-08-02', 0, 'Distrito al norte de Guácimo', '70202'),
(158, 32, 'LI2-3', 'Santa Clara', '2024-08-02', '2024-08-02', 0, 'Distrito al este de Guácimo', '70203'),
(159, 32, 'LI2-4', 'Pocora', '2024-08-02', '2024-08-02', 0, 'Distrito al sur de Guácimo', '70204'),
(160, 32, 'LI2-5', 'La Isabel', '2024-08-02', '2024-08-02', 0, 'Distrito al oeste de Guácimo', '70205');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimpuesto`
--

CREATE TABLE IF NOT EXISTS `tbimpuesto` (
  `tbimpuestoid` int(11) NOT NULL,
  `tbimpuestoidentificador` tinytext NOT NULL,
  `tbimpuestonombre` varchar(535) NOT NULL,
  `tbimpuestodescripcion` varchar(535) DEFAULT NULL,
  `tbimpuestovalor` decimal(10,2) NOT NULL,
  `tbimpuestovigencia` date NOT NULL,
  `tbimpuestoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbimpuesto`
--

INSERT INTO `tbimpuesto` (`tbimpuestoid`, `tbimpuestoidentificador`, `tbimpuestonombre`, `tbimpuestodescripcion`, `tbimpuestovalor`, `tbimpuestovigencia`, `tbimpuestoestado`) VALUES
(1, 'IMPUESTO-1729540715', 'Impuesto al Valor Agregado', 'Grava el consumo de bienes y servicios.', 13.00, '2024-01-01', 1),
(2, 'IMPUESTO-1729540804', 'Impuesto de Rentas', 'Impuesto sobre las rentas obtenidas.', 30.00, '2024-01-01', 1),
(3, 'IMPUESTO-1729540844', 'Impuesto de Timbres y Sellos', 'Grava el uso de documentos legales.', 0.25, '2024-01-01', 1),
(4, 'IMPUESTO-1729540879', 'Impuesto Municipal', 'Impuesto para servicios municipales.', 1.50, '2024-01-01', 1),
(5, 'IMPUESTO-1729540908', 'Impuesto a los Combustibles', 'Grava la compra de combustibles.', 30.00, '2024-01-01', 1),
(6, 'IMPUESTO-1729540933', 'Impuesto a la Riqueza', 'Impuesto a personas con altos patrimonios.', 2.50, '2024-01-01', 1),
(7, 'IMPUESTO-1729540965', 'Impuesto de Transferencia', 'Grava las transacciones de bienes.', 1.00, '2024-01-01', 1),
(8, 'IMPUESTO-1729541000', 'Impuesto a las Sociedades Mercantiles', 'Grava la inscripción de empresas.', 10.00, '2024-01-01', 1),
(9, 'IMPUESTO-1729541023', 'Impuesto sobre la Propiedad Inmueble', 'Grava la posesión de propiedades.', 0.25, '2024-01-01', 1),
(10, 'IMPUESTO-1729541057', 'Impuesto a las Exportaciones', 'Grava las exportaciones de bienes.', 5.00, '2024-01-01', 1),
(11, 'IMPUESTO-1729541152', 'Impuesto a Vehiculos', 'Grava la posesión de vehículos.', 3.00, '2024-01-01', 1),
(12, 'IMPUESTO-1729541181', 'Impuesto de Seguridad', 'Impuesto destinado a seguridad pública.', 1.00, '2024-01-01', 1),
(13, 'IMPUESTO-1729541205', 'Impuesto de Educacion', 'Fondo para el desarrollo educativo.', 2.00, '2024-01-01', 1),
(14, 'IMPUESTO-1729541318', 'Impuesto de Migracion', 'Grava trámites migratorios.', 0.50, '2024-01-01', 1),
(15, 'IMPUESTO-1729541335', 'Impuesto a la Ganancia de Capital', 'Grava las ganancias de capital.', 15.00, '2024-01-01', 1),
(16, 'IMPUESTO-1729541352', 'Impuesto Ambiental', 'Grava actividades contaminantes.', 0.75, '2024-01-01', 1),
(17, 'IMPUESTO-1729541379', 'Impuesto de Prestamos', 'Grava los intereses de préstamos.', 1.50, '2024-01-01', 1),
(18, 'IMPUESTO-1729541404', 'Impuesto Turistico', 'Grava las actividades turísticas.', 7.00, '2024-01-01', 1),
(19, 'IMPUESTO-1729541433', 'Impuesto a la Tecnologia', 'Grava importaciones tecnológicas.', 8.00, '2024-01-01', 1),
(20, 'IMPUESTO-1729541449', 'Impuesto de Telecomunicaciones', 'Grava los servicios de telecomunicaciones.', 2.00, '2024-01-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblote`
--

CREATE TABLE IF NOT EXISTS `tblote` (
  `tbloteid` int(11) NOT NULL,
  `tbloteidentificador` varchar(255) NOT NULL,
  `tbproductoidentificador` mediumtext NOT NULL,
  `tblotecantidadadquirida` int(11) NOT NULL,
  `tblotecantidadactual` int(11) NOT NULL,
  `tblotepreciocompra` double NOT NULL,
  `tblotefechaadquisicion` date NOT NULL,
  `tblotefechaexpiracion` date NOT NULL,
  `tblotefechacreacion` date NOT NULL,
  `tblotefechamodificacion` date NOT NULL,
  `tbloteestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblote`
--

INSERT INTO `tblote` (`tbloteid`, `tbloteidentificador`, `tbproductoidentificador`, `tblotecantidadadquirida`, `tblotecantidadactual`, `tblotepreciocompra`, `tblotefechaadquisicion`, `tblotefechaexpiracion`, `tblotefechacreacion`, `tblotefechamodificacion`, `tbloteestado`) VALUES
(1, 'LOTE-1729609727', 'PROD-22102024084516', 500, 500, 1200, '2024-10-22', '2025-10-01', '2024-10-22', '2024-10-22', 1),
(2, 'LOTE-1729609765', 'PROD-22102024084409', 650, 650, 865, '2024-10-22', '2025-12-30', '2024-10-22', '2024-10-22', 1),
(3, 'LOTE-1729609822', 'PROD-22102024084651', 340, 340, 1000, '2024-10-22', '2025-12-28', '2024-10-22', '2024-10-22', 1),
(4, 'LOTE-1729609862', 'PROD-22102024084900', 50, 50, 250, '2024-10-22', '2024-12-12', '2024-10-22', '2024-10-22', 1),
(5, 'LOTE-1729609895', 'PROD-22102024084944', 50, 50, 325, '2024-10-22', '2024-12-30', '2024-10-22', '2024-10-22', 1),
(6, 'LOTE-1729609932', 'PROD-22102024085042', 120, 120, 1400, '2024-10-22', '2025-06-19', '2024-10-22', '2024-10-22', 1),
(7, 'LOTE-1729609982', 'PROD-22102024085210', 40, 40, 200, '2024-10-22', '2024-12-16', '2024-10-22', '2024-10-22', 1),
(8, 'LOTE-1729610024', 'PROD-22102024085258', 630, 630, 2100, '2024-10-22', '2025-06-19', '2024-10-22', '2024-10-22', 1),
(9, 'LOTE-1729610058', 'PROD-22102024085429', 46, 46, 1300, '2024-10-22', '2025-02-22', '2024-10-22', '2024-10-22', 1),
(10, 'LOTE-1729610094', 'PROD-22102024085526', 45, 45, 1390, '2024-10-22', '2025-05-01', '2024-10-22', '2024-10-22', 1),
(11, 'LOTE-1729610134', 'PROD-22102024085644', 65, 65, 900, '2024-10-22', '2024-12-11', '2024-10-22', '2024-10-22', 1),
(12, 'LOTE-1729610168', 'PROD-22102024085753', 100, 100, 2050, '2024-10-22', '2025-01-29', '2024-10-22', '2024-10-22', 1),
(13, 'LOTE-1729610201', 'PROD-22102024090006', 90, 90, 2500, '2024-10-22', '2025-01-29', '2024-10-22', '2024-10-22', 1),
(14, 'LOTE-1729610224', 'PROD-22102024090036', 80, 80, 2100, '2024-10-22', '2025-02-26', '2024-10-22', '2024-10-22', 1),
(15, 'LOTE-1729610244', 'PROD-22102024090221', 60, 60, 1200, '2024-10-22', '2024-12-31', '2024-10-22', '2024-10-22', 1),
(16, 'LOTE-1729610273', 'PROD-22102024090301', 100, 100, 600, '2024-10-22', '2025-01-15', '2024-10-22', '2024-10-22', 1),
(17, 'LOTE-1729610295', 'PROD-22102024090356', 200, 200, 1500, '2024-10-22', '2025-02-26', '2024-10-22', '2024-10-22', 1),
(18, 'LOTE-1729610321', 'PROD-22102024090456', 95, 95, 1400, '2024-10-22', '2025-02-27', '2024-10-22', '2024-10-22', 1),
(19, 'LOTE-1729610346', 'PROD-22102024090520', 130, 130, 900, '2024-10-22', '2025-02-27', '2024-10-22', '2024-10-22', 1),
(20, 'LOTE-1729610366', 'PROD-22102024090652', 60, 60, 1300, '2024-10-22', '2025-07-24', '2024-10-22', '2024-10-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmargenganancia`
--

CREATE TABLE IF NOT EXISTS `tbmargenganancia` (
  `tbmargengananciaid` int(11) NOT NULL,
  `tbloteidentificador` varchar(255) NOT NULL,
  `tbmargengananciaidentificador` varchar(255) NOT NULL,
  `tbmargengananciaporcentaje` double NOT NULL,
  `tbmargengananciafechacreacion` date NOT NULL,
  `tbmargengananciafechamodificacion` date NOT NULL,
  `tbmargengananciaestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbmargenganancia`
--

INSERT INTO `tbmargenganancia` (`tbmargengananciaid`, `tbloteidentificador`, `tbmargengananciaidentificador`, `tbmargengananciaporcentaje`, `tbmargengananciafechacreacion`, `tbmargengananciafechamodificacion`, `tbmargengananciaestado`) VALUES
(1, 'LOTE01', 'MG01', 15, '2024-01-01', '2024-01-01', 1),
(2, 'LOTE02', 'MG02', 10.5, '2024-01-02', '2024-01-02', 1),
(3, 'LOTE03', 'MG03', 20, '2024-01-03', '2024-01-03', 1),
(4, 'LOTE04', 'MG04', 5.75, '2024-01-04', '2024-01-04', 1),
(5, 'LOTE05', 'MG05', 12.25, '2024-01-05', '2024-01-05', 1),
(6, 'LOTE06', 'MG06', 18, '2024-01-06', '2024-01-06', 1),
(7, 'LOTE07', 'MG07', 8.5, '2024-01-07', '2024-01-07', 1),
(8, 'LOTE08', 'MG08', 25, '2024-01-08', '2024-01-08', 1),
(9, 'LOTE09', 'MG09', 3.5, '2024-01-09', '2024-01-09', 1),
(10, 'LOTE10', 'MG10', 16.75, '2024-01-10', '2024-01-10', 1),
(11, 'LOTE11', 'MG11', 9, '2024-01-11', '2024-01-11', 1),
(12, 'LOTE12', 'MG12', 14, '2024-01-12', '2024-01-12', 1),
(13, 'LOTE13', 'MG13', 7.5, '2024-01-13', '2024-01-13', 1),
(14, 'LOTE14', 'MG14', 11, '2024-01-14', '2024-01-14', 1),
(15, 'LOTE15', 'MG15', 22.5, '2024-01-15', '2024-01-15', 1),
(16, 'LOTE16', 'MG16', 4, '2024-01-16', '2024-01-16', 1),
(17, 'LOTE17', 'MG17', 19, '2024-01-17', '2024-01-17', 1),
(18, 'LOTE18', 'MG18', 13.25, '2024-01-18', '2024-01-18', 1),
(19, 'LOTE19', 'MG19', 2.75, '2024-01-19', '2024-01-19', 1),
(20, 'LOTE20', 'MG20', 17.5, '2024-01-20', '2024-01-20', 1),
(21, 'LOTE-1729609727', 'MAG-1729610555', 10, '2024-10-22', '2024-10-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpais`
--

CREATE TABLE IF NOT EXISTS `tbpais` (
  `tbpaisid` int(11) NOT NULL,
  `tbpaisidentificador` mediumtext NOT NULL,
  `tbpaisnombre` mediumtext NOT NULL,
  `tbpaisfechacreacion` date NOT NULL,
  `tbpaisfechamodificacion` date NOT NULL,
  `tbpaisestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbpais`
--

INSERT INTO `tbpais` (`tbpaisid`, `tbpaisidentificador`, `tbpaisnombre`, `tbpaisfechacreacion`, `tbpaisfechamodificacion`, `tbpaisestado`) VALUES
(1, 'CRC-019', 'Costa Rica', '2024-08-02', '2024-08-02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpresentacion`
--

CREATE TABLE IF NOT EXISTS `tbpresentacion` (
  `tbpresentacionid` int(11) NOT NULL,
  `tbpresentacionidentificador` varchar(255) DEFAULT NULL,
  `tbpresentacionombre` varchar(255) NOT NULL,
  `tbpresentaciondescripcion` varchar(255) NOT NULL,
  `tbpresentacioncreadoen` date NOT NULL,
  `tbpresentacionmodificadoen` date NOT NULL,
  `tbpresentacionestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbpresentacion`
--

INSERT INTO `tbpresentacion` (`tbpresentacionid`, `tbpresentacionidentificador`, `tbpresentacionombre`, `tbpresentaciondescripcion`, `tbpresentacioncreadoen`, `tbpresentacionmodificadoen`, `tbpresentacionestado`) VALUES
(1, 'PRESENTACION-1729542178', 'Botella', 'Producto en presentación de botella de 500 ml.', '2024-10-21', '2024-10-21', 1),
(2, 'PRESENTACION-1729542196', 'Paquete', 'Producto empacado en paquete de 1 kg.', '2024-10-21', '2024-10-21', 1),
(3, 'PRESENTACION-1729542217', 'Caja', 'Producto presentado en caja de 12 unidades.', '2024-10-21', '2024-10-21', 1),
(4, 'PRESENTACION-1729542231', 'Sobre', 'Producto en sobre de 50 g.', '2024-10-21', '2024-10-21', 1),
(5, 'PRESENTACION-1729542241', 'Lata', 'Producto en lata de 350 ml.', '2024-10-21', '2024-10-21', 1),
(6, 'PRESENTACION-1729542250', 'Bolsa', 'Producto en bolsa de 250 g.', '2024-10-21', '2024-10-21', 1),
(7, 'PRESENTACION-1729542261', 'Tubo', 'Producto en tubo de 200 ml.', '2024-10-21', '2024-10-21', 1),
(8, 'PRESENTACION-1729542272', 'Tarro', 'Producto en tarro de 1 litro.', '2024-10-21', '2024-10-21', 1),
(9, 'PRESENTACION-1729542285', 'Frasco', 'Producto en frasco de 250 ml.', '2024-10-21', '2024-10-21', 1),
(10, 'PRESENTACION-1729542293', 'Sachet', 'Producto en sachet de 10 g.', '2024-10-21', '2024-10-21', 1),
(11, 'PRESENTACION-1729542303', 'Pack', 'Producto en pack de 6 unidades.', '2024-10-21', '2024-10-21', 1),
(12, 'PRESENTACION-1729542324', 'Carton', 'Producto en presentación de cartón de 12 unidades.', '2024-10-21', '2024-10-21', 1),
(13, 'PRESENTACION-1729542351', 'Tetra Pak', 'Producto en Tetra Pak de 1 litro.', '2024-10-21', '2024-10-21', 1),
(14, 'PRESENTACION-1729542365', 'Blister', 'Producto en blíster de 10 unidades.', '2024-10-21', '2024-10-21', 1),
(15, 'PRESENTACION-1729542389', 'Bidon', 'Producto en bidón de 5 litros.', '2024-10-21', '2024-10-21', 1),
(16, 'PRESENTACION-1729542401', 'Ampolla', 'Producto en ampolla de 5 ml.', '2024-10-21', '2024-10-21', 1),
(17, 'PRESENTACION-1729542413', 'Galon', 'Producto en galón de 4 litros.', '2024-10-21', '2024-10-21', 1),
(18, 'PRESENTACION-1729542424', 'Doypack', 'Producto en doypack de 250 g.', '2024-10-21', '2024-10-21', 1),
(19, 'PRESENTACION-1729542435', 'Cubeta', 'Producto en cubeta de 10 kg.', '2024-10-21', '2024-10-21', 1),
(20, 'PRESENTACION-1729542463', 'Cubo', 'Producto en presentación de cubo de 500 g.', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproducto`
--

CREATE TABLE IF NOT EXISTS `tbproducto` (
  `tbproductoid` int(11) NOT NULL,
  `tbproductoidentificador` mediumtext NOT NULL,
  `tbproductonombreproducto` mediumtext NOT NULL,
  `tbproductodescripcionproducto` mediumtext NOT NULL,
  `tbproductocategoriaidentificador` varchar(255) NOT NULL,
  `tbproductounidadmedidaidentificador` varchar(255) NOT NULL,
  `tbproductopresentacionidentificador` varchar(255) NOT NULL,
  `tbproductofechacreacion` datetime NOT NULL,
  `tbproductofechamodificacion` datetime NOT NULL,
  `tbproductoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbproducto`
--

INSERT INTO `tbproducto` (`tbproductoid`, `tbproductoidentificador`, `tbproductonombreproducto`, `tbproductodescripcionproducto`, `tbproductocategoriaidentificador`, `tbproductounidadmedidaidentificador`, `tbproductopresentacionidentificador`, `tbproductofechacreacion`, `tbproductofechamodificacion`, `tbproductoestado`) VALUES
(1, 'PROD-22102024084409', 'Atún', 'Atún', 'CAT-21102024235354', 'Kilogramo1724628769', 'PRESENTACION-1729542241', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(2, 'PROD-22102024084516', 'Coca cola', 'Nuevo embace ', 'CAT-21102024235452', 'Litro1724628770', 'PRESENTACION-1729542178', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(3, 'PROD-22102024084651', 'Coca cola light', 'Sin azucar', 'CAT-21102024235452', 'Litro1724628770', 'PRESENTACION-1729542178', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(4, 'PROD-22102024084900', 'Achiote en polvo', 'Achiote en polvo', 'CAT-21102024235401', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(5, 'PROD-22102024084944', 'Achiote en pasta', 'Achiote en pasta', 'CAT-21102024235401', 'Kilogramo1724628769', 'PRESENTACION-1729542217', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(6, 'PROD-22102024085042', 'Ablandador de carne', 'Ablandador de carne', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(7, 'PROD-22102024085210', 'Apio en semilla', 'Apio en semilla', 'CAT-21102024235401', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(8, 'PROD-22102024085258', 'Arroz', 'Arroz 99%', 'CAT-21102024235401', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(9, 'PROD-22102024085429', 'Canela granulada', 'Canela granulada', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(10, 'PROD-22102024085526', 'Canela en polvo', 'Canela en polvo', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(11, 'PROD-22102024085644', 'Apio en polvo', 'Apio en polvo', 'CAT-21102024235420', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(12, 'PROD-22102024085753', 'Cebolla en polvo', 'Cebolla en polvo estandar', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542217', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(13, 'PROD-22102024090006', 'Cebolla en escamas', 'Cebolla en escamas', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542217', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(14, 'PROD-22102024090036', 'Cebolla granulada', 'Cebolla granulada', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542217', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(15, 'PROD-22102024090221', 'Chile cayenne', 'Chile cayenne', 'CAT-21102024235401', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(16, 'PROD-22102024090301', 'Chile dulce ', 'Chile dulce', 'CAT-21102024235401', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(17, 'PROD-22102024090356', 'Café', 'Café', 'CAT-21102024235420', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(18, 'PROD-22102024090456', 'AZÚCAR ESTANDAR', 'AZÚCAR ESTANDAR', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542250', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(19, 'PROD-22102024090520', 'SARDINA', 'SARDINA', 'CAT-21102024235354', 'Kilogramo1724628769', 'PRESENTACION-1729542241', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(20, 'PROD-22102024090652', 'Salsa de tomate', 'Salsa de tomate', 'CAT-21102024235452', 'Kilogramo1724628769', 'PRESENTACION-1729542178', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductoimagen`
--


DROP TABLE IF EXISTS `tbproductoimagen`;
CREATE TABLE `tbproductoimagen` (
  `tbproductoimagenidentificador` varchar(255) NOT NULL,
  `tbproductoimagenproductoIdentificador` varchar(255) NOT NULL,
  `tbproductoimagenruta` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedor`
--

CREATE TABLE IF NOT EXISTS `tbproveedor` (
  `tbproveedorid` int(11) NOT NULL,
  `tbproveedoridtipoproveedor` int(11) NOT NULL,
  `tbproveedoridentificador` mediumtext NOT NULL,
  `tbproveedornombre` mediumtext NOT NULL,
  `tbproveedorcreadoen` date NOT NULL,
  `tbproveedormodificadoen` date NOT NULL,
  `tbproveedorestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbproveedor`
--

INSERT INTO `tbproveedor` (`tbproveedorid`, `tbproveedoridtipoproveedor`, `tbproveedoridentificador`, `tbproveedornombre`, `tbproveedorcreadoen`, `tbproveedormodificadoen`, `tbproveedorestado`) VALUES
(1, 1, 'PROV-001', 'Proveedores ABC S.A.', '2023-01-01', '2023-10-21', 1),
(2, 1, 'PROV-002', 'Distribuidora XYZ', '2023-02-15', '2023-10-21', 1),
(3, 2, 'PROV-003', 'Servicios y Suministros SRL', '2023-03-10', '2023-10-21', 1),
(4, 2, 'PROV-004', 'Tech Solutions', '2023-04-05', '2023-10-21', 1),
(5, 3, 'PROV-005', 'Comercializadora 123', '2023-05-20', '2023-10-21', 1),
(6, 3, 'PROV-006', 'Alimentos Deliciosos', '2023-06-15', '2023-10-21', 1),
(7, 1, 'PROV-007', 'Electrodomésticos SA', '2023-07-10', '2023-10-21', 1),
(8, 1, 'PROV-008', 'Muebles y Más', '2023-08-01', '2023-10-21', 1),
(9, 2, 'PROV-009', 'Construcción ABC', '2023-09-12', '2023-10-21', 1),
(10, 2, 'PROV-010', 'Servicios Eléctricos XYZ', '2023-10-05', '2023-10-21', 1),
(11, 3, 'PROV-011', 'Ropa de Moda', '2023-01-20', '2023-10-21', 1),
(12, 3, 'PROV-012', 'Juguetes y Diversiones', '2023-02-25', '2023-10-21', 1),
(13, 1, 'PROV-013', 'Materiales de Oficina', '2023-03-30', '2023-10-21', 1),
(14, 1, 'PROV-014', 'Productos de Limpieza', '2023-04-18', '2023-10-21', 1),
(15, 2, 'PROV-015', 'Farmacia Saludable', '2023-05-22', '2023-10-21', 1),
(16, 2, 'PROV-016', 'Belleza y Cosméticos', '2023-06-11', '2023-10-21', 1),
(17, 3, 'PROV-017', 'Accesorios para el Hogar', '2023-07-19', '2023-10-21', 1),
(18, 3, 'PROV-018', 'Artículos Deportivos', '2023-08-27', '2023-10-21', 1),
(19, 1, 'PROV-019', 'Suministros Médicos', '2023-09-09', '2023-10-21', 1),
(20, 1, 'PROV-020', 'Tecnología Avanzada', '2023-10-15', '2023-10-21', 1),
(21, 2, 'SUP-CocaCola-2024-10-2118:00:19', 'CocaCola', '2024-10-21', '2024-10-21', 1),
(22, 2, 'SUP-Sardimar-2024-10-2118:04:16', 'Sardimar', '2024-10-21', '2024-10-21', 1),
(23, 2, 'SUP-Demasa-2024-10-2118:07:21', 'Demasa', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedorcredito`
--

CREATE TABLE IF NOT EXISTS `tbproveedorcredito` (
  `tbproveedorcreditoid` int(11) NOT NULL,
  `tbproveedorid` varchar(255) NOT NULL,
  `tbproveedorcreditoidentificador` varchar(255) NOT NULL,
  `tbproveedorcreditocantidadcredito` decimal(10,2) NOT NULL,
  `tbproveedorcreditoporcentaje` double NOT NULL,
  `tbproveedorcreditoplazo` int(11) NOT NULL,
  `tbproveedorcreditofechainicio` date NOT NULL,
  `tbproveedorcreditofechavencimiento` date NOT NULL,
  `tbproveedorcreditofechacreacion` date NOT NULL,
  `tbproveedorcreditofechamodificacion` date NOT NULL,
  `tbproveedorcreditoestado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedorproducto`
--

CREATE TABLE IF NOT EXISTS `tbproveedorproducto` (
  `tbproveedorproductoid` int(11) NOT NULL,
  `tbproveedorproductoidentificador` varchar(255) NOT NULL,
  `tbproveedorproductoidentificadorproveedor` varchar(255) NOT NULL,
  `tbproveedorproductoidentificadorproducto` varchar(255) NOT NULL,
  `tbproveedorproductofechamodificacion` datetime NOT NULL,
  `tbproveedorproductoultimacompra` datetime NOT NULL,
  `tbproveedorproductofechacreacion` datetime NOT NULL,
  `tbproveedorproductoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbproveedorproducto`
--

INSERT INTO `tbproveedorproducto` (`tbproveedorproductoid`, `tbproveedorproductoidentificador`, `tbproveedorproductoidentificadorproveedor`, `tbproveedorproductoidentificadorproducto`, `tbproveedorproductofechamodificacion`, `tbproveedorproductoultimacompra`, `tbproveedorproductofechacreacion`, `tbproveedorproductoestado`) VALUES
(1, 'PROD-PROV-Sardimar-Atún2024-10-2208:44:09', 'SUP-Sardimar-2024-10-2118:04:16', 'PROD-22102024084409', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(2, 'PROD-PROV-CocaCola-Coca cola2024-10-2208:45:16', 'SUP-CocaCola-2024-10-2118:00:19', 'PROD-22102024084516', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(3, 'PROD-PROV-CocaCola-Coca cola light2024-10-2208:46:51', 'SUP-CocaCola-2024-10-2118:00:19', 'PROD-22102024084651', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(4, 'PROD-PROV-Proveedores ABC S.A.-Achiote en polvo2024-10-2208:49:00', 'PROV-001', 'PROD-22102024084900', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(5, 'PROD-PROV-Proveedores ABC S.A.-Achiote en pasta2024-10-2208:49:44', 'PROV-001', 'PROD-22102024084944', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(6, 'PROD-PROV-Alimentos Deliciosos-Ablandador de carne2024-10-2208:50:42', 'PROV-006', 'PROD-22102024085042', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(7, 'PROD-PROV-Alimentos Deliciosos-Apio en semilla2024-10-2208:52:10', 'PROV-006', 'PROD-22102024085210', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(8, 'PROD-PROV-Alimentos Deliciosos-Arroz2024-10-2208:52:58', 'PROV-006', 'PROD-22102024085258', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(9, 'PROD-PROV-Distribuidora XYZ-Canela granulada2024-10-2208:54:29', 'PROV-002', 'PROD-22102024085429', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(10, 'PROD-PROV-Distribuidora XYZ-Canela en polvo2024-10-2208:55:26', 'PROV-002', 'PROD-22102024085526', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(11, 'PROD-PROV-Alimentos Deliciosos-Apio en polvo2024-10-2208:56:44', 'PROV-006', 'PROD-22102024085644', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(12, 'PROD-PROV-Alimentos Deliciosos-Cebolla en polvo2024-10-2208:57:53', 'PROV-006', 'PROD-22102024085753', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(13, 'PROD-PROV-Distribuidora XYZ-Cebolla en escamas2024-10-2209:00:06', 'PROV-002', 'PROD-22102024090006', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(14, 'PROD-PROV-Distribuidora XYZ-Cebolla granulada2024-10-2209:00:36', 'PROV-002', 'PROD-22102024090036', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(15, 'PROD-PROV-Alimentos Deliciosos-Chile cayenne2024-10-2209:02:22', 'PROV-006', 'PROD-22102024090221', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(16, 'PROD-PROV-Distribuidora XYZ-Chile dulce 2024-10-2209:03:01', 'PROV-002', 'PROD-22102024090301', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(17, 'PROD-PROV-Alimentos Deliciosos-Café2024-10-2209:03:57', 'PROV-006', 'PROD-22102024090356', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(18, 'PROD-PROV-Alimentos Deliciosos-AZÚCAR ESTANDAR2024-10-2209:04:56', 'PROV-006', 'PROD-22102024090456', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(19, 'PROD-PROV-Sardimar-SARDINA2024-10-2209:05:20', 'SUP-Sardimar-2024-10-2118:04:16', 'PROD-22102024090520', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1),
(20, 'PROD-PROV-Distribuidora XYZ-Salsa de tomate2024-10-2209:06:52', 'PROV-002', 'PROD-22102024090652', '2024-10-22 00:00:00', '2024-10-22 00:00:00', '2024-10-22 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprovincia`
--

CREATE TABLE IF NOT EXISTS `tbprovincia` (
  `tbprovinciaid` int(11) NOT NULL,
  `tbidpais` int(11) NOT NULL,
  `tbprovinciaidentificador` mediumtext NOT NULL,
  `tbprovincianombre` mediumtext NOT NULL,
  `tbprovinciafechacreacion` date NOT NULL,
  `tbprovinciafechamodificacion` date NOT NULL,
  `tbprovinciaestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbprovincia`
--

INSERT INTO `tbprovincia` (`tbprovinciaid`, `tbidpais`, `tbprovinciaidentificador`, `tbprovincianombre`, `tbprovinciafechacreacion`, `tbprovinciafechamodificacion`, `tbprovinciaestado`) VALUES
(1, 1, 'SJ-000', 'San José', '2024-08-02', '2024-08-02', 1),
(2, 1, 'AJ-000', 'Alajuela', '2024-08-02', '2024-08-02', 1),
(3, 1, 'CA-000', 'Cartago', '2024-08-02', '2024-08-02', 1),
(4, 1, 'HE', 'Heredia', '2024-08-02', '2024-08-02', 1),
(5, 1, 'GU-000', 'Guanacaste', '2024-08-02', '2024-08-02', 1),
(6, 1, 'PU-000', 'Puntarenas', '2024-08-02', '2024-08-02', 1),
(7, 1, 'LI-000', 'Limón', '2024-08-02', '2024-08-02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbrol`
--

CREATE TABLE IF NOT EXISTS `tbrol` (
  `tbrolid` int(11) NOT NULL,
  `tbrolidentificador` tinytext NOT NULL,
  `tbrolnombre` varchar(100) NOT NULL,
  `tbroldescripcion` tinytext NOT NULL,
  `tbrolfechacreacion` date NOT NULL,
  `tbrolfechamodificacion` date NOT NULL,
  `tbrolestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbrol`
--

INSERT INTO `tbrol` (`tbrolid`, `tbrolidentificador`, `tbrolnombre`, `tbroldescripcion`, `tbrolfechacreacion`, `tbrolfechamodificacion`, `tbrolestado`) VALUES
(1, 'ROL-1729543567', 'Administrador', 'Rol con acceso completo a todas las funciones del sistema', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543588', 'Gerente', 'Rol con permisos para gestionar operaciones y recursos', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543612', 'Empleado', 'Rol básico para realizar tareas diarias', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543620', 'Contador', 'Rol especializado para gestión contable y financiera', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543628', 'Vendedor', 'Rol enfocado en la venta y atención al cliente', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543636', 'Almacenero', 'Rol encargado de la gestión de inventarios', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543644', 'Soporte Técnico', 'Rol para brindar asistencia técnica y soporte', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543652', 'Desarrollador', 'Rol para desarrollo y mantenimiento de software', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543660', 'Analista', 'Rol para análisis de datos y reportes', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543668', 'Recursos Humanos', 'Rol para gestión del personal y relaciones laborales', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543675', 'Marketing', 'Rol enfocado en estrategias de marketing y publicidad', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543683', 'Proyectos', 'Rol encargado de la gestión de proyectos', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543690', 'Interno', 'Rol para pasantes y estudiantes en prácticas', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543698', 'Consultor', 'Rol especializado para brindar asesoría externa', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543705', 'Director', 'Rol para la toma de decisiones estratégicas', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543712', 'Auditor', 'Rol para revisión y auditoría de procesos', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543723', 'Diseñador', 'Rol para creación y diseño de contenido visual', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543731', 'Investigador', 'Rol para realizar investigaciones y estudios', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543738', 'Planificador', 'Rol para planificación y programación de actividades', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1729543747', 'Cliente', 'Rol para usuarios que realizan compras y transacciones', '2024-10-21', '2024-10-21', 1),
(1, 'ROL-1725952935', 'Root', 'Acceso más altos', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbsubcategoria`
--

CREATE TABLE IF NOT EXISTS `tbsubcategoria` (
  `tbsubcategoriaid` int(11) NOT NULL,
  `tbsubcategoriaidentificador` mediumtext NOT NULL,
  `tbcategoriaidentificador` mediumtext NOT NULL,
  `tbsubcategorianombre` mediumtext NOT NULL,
  `tbsubcategoriadescripcion` mediumtext NOT NULL,
  `tbsubcategoriafechacreacion` date NOT NULL,
  `tbsubcategoriafechamodificacion` date NOT NULL,
  `tbsubcategoriaestado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbsubcategoria`
--

INSERT INTO `tbsubcategoria` (`tbsubcategoriaid`, `tbsubcategoriaidentificador`, `tbcategoriaidentificador`, `tbsubcategorianombre`, `tbsubcategoriadescripcion`, `tbsubcategoriafechacreacion`, `tbsubcategoriafechamodificacion`, `tbsubcategoriaestado`) VALUES
(1, 'SCT-1729548248', 'CAT-21102024235354', 'Animales vivos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(2, 'SCT-1729548261', 'CAT-21102024235354', 'Carne y despojos comestibles', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(3, 'SCT-1729548321', 'CAT-21102024235354', 'Pescados y crustáceos, moluscos y demás invertebrados acuáticos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(4, 'SCT-1729548339', 'CAT-21102024235354', 'Leche y productos lácteos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(5, 'SCT-1729548348', 'CAT-21102024235354', 'huevos de ave', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(6, 'SCT-1729548357', 'CAT-21102024235354', ' miel natural', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(7, 'SCT-1729548368', 'CAT-21102024235354', 'productos comestibles de  origen animal', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(8, 'SCT-1729548384', 'CAT-21102024235354', 'Los demás productos de origen animal no expresados ni comprendidos en otra parte ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(9, 'SCT-1729548402', 'CAT-21102024235401', 'Plantas vivas y productos de la floricultura', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(10, 'SCT-1729548411', 'CAT-21102024235401', 'Hortalizas, plantas, raíces y tubérculos alimenticios', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(11, 'SCT-1729548423', 'CAT-21102024235401', 'Frutas y frutos comestibles; cortezas de agrios (cítricos), melones o sandías', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(12, 'SCT-1729548434', 'CAT-21102024235401', 'Café, té, yerba mate y especias', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(13, 'SCT-1729548445', 'CAT-21102024235401', 'Cereales', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(14, 'SCT-1729548455', 'CAT-21102024235401', 'Productos de la molinería; malta; almidón y fécula; inulina; gluten de trigo', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(15, 'SCT-1729548468', 'CAT-21102024235401', 'Semillas y frutos oleaginosos; semillas y frutos diversos; plantas industriales o  medicinales; paja y forraje', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(16, 'SCT-1729548479', 'CAT-21102024235401', 'Gomas, resinas y demás jugos y extractos vegetales', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(17, 'SCT-1729548747', 'CAT-21102024235401', 'Materias trenzables y demás productos de origen vegetal, no expresados ni  comprendidos en otra parte', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(18, 'SCT-1729548764', 'CAT-21102024235420', 'Grasas y aceites animales o vegetales; productos de su desdoblamiento; grasas  alimenticias elaboradas; ceras de origen animal o vegetal', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(19, 'SCT-1729548777', 'CAT-21102024235452', 'Preparaciones de carne, pescado o de crustáceos, moluscos o demás invertebrados  acuáticos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(20, 'SCT-1729548790', 'CAT-21102024235452', 'Azúcares y artículos de confitería', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(21, 'SCT-1729548800', 'CAT-21102024235452', 'Cacao y sus preparaciones', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(22, 'SCT-1729548813', 'CAT-21102024235452', 'Preparaciones a base de cereales, harina, almidón, fécula o leche; productos de  pastelería', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(23, 'SCT-1729548822', 'CAT-21102024235452', 'Preparaciones de hortalizas, frutas u otros frutos o demás partes de plantas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(24, 'SCT-1729548831', 'CAT-21102024235452', 'Preparaciones alimenticias diversas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(25, 'SCT-1729548841', 'CAT-21102024235452', 'Bebidas, líquidos alcohólicos y vinagre ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(26, 'SCT-1729548848', 'CAT-21102024235452', 'Residuos y desperdicios de las industrias alimentarias; alimentos preparados para  animales ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(27, 'SCT-1729548861', 'CAT-21102024235452', 'Tabaco y sucedáneos del tabaco elaborados', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(28, 'SCT-1729548876', 'CAT-21102024235503', 'Sal; azufre; tierras y piedras; yesos, cales y cementos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(29, 'SCT-1729548888', 'CAT-21102024235503', 'Minerales metalíferos, escorias y cenizas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(30, 'SCT-1729548896', 'CAT-21102024235503', 'Combustibles minerales, aceites minerales y productos de su destilación; materias  bituminosas; ceras minerales ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(31, 'SCT-1729548906', 'CAT-21102024235512', 'Productos químicos inorgánicos; compuestos inorgánicos u orgánicos de metal  precioso, de elementos radiactivos, de metales de las tierras raras o de isótopos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(32, 'SCT-1729548915', 'CAT-21102024235512', 'Productos químicos orgánicos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(33, 'SCT-1729548925', 'CAT-21102024235512', 'Productos farmacéuticos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(34, 'SCT-1729548932', 'CAT-21102024235512', 'Abonos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(35, 'SCT-1729548941', 'CAT-21102024235512', 'Extractos curtientes o tintóreos; taninos y sus derivados; pigmentos y demás materias  colorantes; pinturas y barnices; mástiques; tintas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(36, 'SCT-1729548948', 'CAT-21102024235512', 'Aceites esenciales y resinoides; preparaciones de perfumería, de tocador o de  cosmética', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(37, 'SCT-1729548967', 'CAT-21102024235512', 'Jabón, agentes de superficie orgánicos, preparaciones para lavar, preparaciones  lubricantes, ceras artificiales, ceras preparadas, productos de limpieza, velas y  artículos similares, pastas para modelar, «ceras para odontología» y preparaciones  V para odontología a base de yeso fraguable', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(38, 'SCT-1729548995', 'CAT-21102024235512', 'Materias albuminoideas; productos a base de almidón o de fécula modificados; colas;  enzimas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(39, 'SCT-1729549015', 'CAT-21102024235512', 'Pólvora y explosivos; artículos de pirotecnia; fósforos (cerillas); aleaciones pirofóricas;  materias inflamables', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(40, 'SCT-1729549023', 'CAT-21102024235512', 'Productos fotográficos o cinematográficos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(41, 'SCT-1729549031', 'CAT-21102024235512', 'Productos diversos de las industrias químicas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(42, 'SCT-1729549040', 'CAT-21102024235522', 'Plástico y sus manufacturas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(43, 'SCT-1729549049', 'CAT-21102024235522', 'Caucho y sus manufacturas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(44, 'SCT-1729549059', 'CAT-21102024235543', 'Pieles (excepto la peletería) y cueros', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(45, 'SCT-1729549078', 'CAT-21102024235543', 'Manufacturas de cuero', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(46, 'SCT-1729549092', 'CAT-21102024235543', 'artículos de talabartería o guarnicionería', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(47, 'SCT-1729549105', 'CAT-21102024235543', ' artículos de viaje', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(48, 'SCT-1729549119', 'CAT-21102024235543', 'bolsos de mano (carteras) y continentes similares', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(49, 'SCT-1729549132', 'CAT-21102024235543', 'Peletería y confecciones de peletería; peletería facticia o artificial ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(50, 'SCT-1729549146', 'CAT-21102024235555', 'Madera, carbón vegetal y manufacturas de madera', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(51, 'SCT-1729549163', 'CAT-21102024235555', 'Corcho y sus manufacturas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(52, 'SCT-1729549174', 'CAT-21102024235555', 'Manufacturas de espartería o cestería', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(53, 'SCT-1729549195', 'CAT-21102024235608', 'Pasta de madera o de las demás materias fibrosas celulósicas; papel o cartón para  reciclar (desperdicios y desechos)', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(54, 'SCT-1729549207', 'CAT-21102024235608', 'Papel y cartón; manufacturas de pasta de celulosa, de papel o cartón', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(55, 'SCT-1729549218', 'CAT-21102024235608', 'Productos editoriales, de la prensa y de las demás industrias gráficas; textos  manuscritos o mecanografiados y planos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(56, 'SCT-1729549229', 'CAT-21102024235615', 'Seda', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(57, 'SCT-1729549237', 'CAT-21102024235615', 'Lana y pelo fino u ordinario; hilados y tejidos de crin', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(58, 'SCT-1729549254', 'CAT-21102024235615', 'Algodón ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(59, 'SCT-1729549264', 'CAT-21102024235615', 'Las demás fibras textiles vegetales; hilados de papel y tejidos de hilados de papel ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(60, 'SCT-1729549276', 'CAT-21102024235615', 'Filamentos sintéticos o artificiales; tiras y formas similares de materia textil sintética o artificial. ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(61, 'SCT-1729549288', 'CAT-21102024235615', 'Fibras sintéticas o artificiales discontinuas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(62, 'SCT-1729549317', 'CAT-21102024235615', 'Guata, fieltro y tela sin tejer; hilados especiales; cordeles, cuerdas y cordajes;  artículos de cordelería', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(63, 'SCT-1729549326', 'CAT-21102024235615', 'Alfombras y demás revestimientos para el suelo, de materia textil ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(64, 'SCT-1729549339', 'CAT-21102024235615', 'Tejidos especiales; superficies textiles con mechón insertado; encajes; tapicería;  pasamanería; bordados', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(65, 'SCT-1729549349', 'CAT-21102024235615', 'Telas impregnadas, recubiertas, revestidas o estratificadas; artículos técnicos de  materia textil ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(66, 'SCT-1729549362', 'CAT-21102024235615', 'Tejidos de punto', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(67, 'SCT-1729549372', 'CAT-21102024235615', 'Prendas y complementos (accesorios), de vestir, de punto ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(68, 'SCT-1729549381', 'CAT-21102024235615', 'Prendas y complementos (accesorios), de vestir, excepto los de punto', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(69, 'SCT-1729549390', 'CAT-21102024235615', 'Los demás artículos textiles confeccionados; juegos; prendería y trapos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(70, 'SCT-1729549411', 'CAT-21102024235740', 'Calzado, polainas y artículos análogos; partes de estos artículos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(71, 'SCT-1729549420', 'CAT-21102024235740', 'Sombreros, demás tocados y sus partes ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(72, 'SCT-1729549428', 'CAT-21102024235740', 'Paraguas, sombrillas, quitasoles, bastones, bastones asiento, látigos, fustas, y sus  partes ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(73, 'SCT-1729549438', 'CAT-21102024235740', 'Plumas y plumón preparados y artículos de plumas o plumón; flores artificiales;  VII manufacturas de cabello', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(74, 'SCT-1729549450', 'CAT-21102024235906', 'Manufacturas de piedra, yeso fraguable, cemento, amianto (asbesto), mica o materias  análogas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(75, 'SCT-1729549459', 'CAT-21102024235906', 'Productos cerámicos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(76, 'SCT-1729549467', 'CAT-21102024235906', 'Vidrio y sus manufacturas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(77, 'SCT-1729549478', 'CAT-21102024235939', 'Perlas finas (naturales) o cultivadas, piedras preciosas o semipreciosas, metales  preciosos, chapados de metal precioso (plaqué) y manufacturas de estas materias;  bisutería; monedas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(78, 'SCT-1729549491', 'CAT-21102024235946', 'Fundición, hierro y acero', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(79, 'SCT-1729549500', 'CAT-21102024235946', 'Manufacturas de fundición, hierro o acero ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(80, 'SCT-1729549512', 'CAT-21102024235946', 'Cobre y sus manufacturas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(81, 'SCT-1729549522', 'CAT-21102024235946', 'Níquel y sus manufacturas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(82, 'SCT-1729549529', 'CAT-21102024235946', 'Aluminio y sus manufacturas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(83, 'SCT-1729549548', 'CAT-21102024235946', 'Plomo y sus manufacturas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(84, 'SCT-1729549560', 'CAT-21102024235946', 'Cinc y sus manufacturas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(85, 'SCT-1729549568', 'CAT-21102024235946', 'Estaño y sus manufacturas ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(86, 'SCT-1729549577', 'CAT-21102024235946', 'Los demás metales comunes; cermets; manufacturas de estas materias ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(87, 'SCT-1729549586', 'CAT-21102024235946', 'Herramientas y útiles, artículos de cuchillería y cubiertos de mesa, de metal común;  partes de estos artículos, de metal común', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(88, 'SCT-1729549596', 'CAT-21102024235946', 'Manufacturas diversas de metal común', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(89, 'SCT-1729549610', 'CAT-22102024000031', 'Reactores nucleares, calderas, máquinas, aparatos y artefactos mecánicos; partes de  estas máquinas o aparatos ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(90, 'SCT-1729549639', 'CAT-22102024000031', 'Máquinas, aparatos y material eléctrico, y sus partes; aparatos de grabación o  reproducción de sonido, aparatos de grabación o reproducción de imagen y sonido en  televisión, y las partes y accesorios de estos aparatos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(91, 'SCT-1729549651', 'CAT-22102024000040', 'Vehículos y material para vías férreas o similares, y sus partes; aparatos mecánicos  (incluso electromecánicos) de señalización para vías de comunicación ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(92, 'SCT-1729549659', 'CAT-22102024000040', 'Vehículos automóviles, tractores, velocípedos y demás vehículos terrestres; sus  partes y accesorios', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(93, 'SCT-1729549668', 'CAT-22102024000040', 'Aeronaves, vehículos espaciales, y sus partes', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(94, 'SCT-1729549676', 'CAT-22102024000040', 'Barcos y demás artefactos flotantes ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(95, 'SCT-1729549688', 'CAT-22102024000102', 'Instrumentos y aparatos de óptica, fotografía o cinematografía, de medida, control o  precisión; instrumentos y aparatos medicoquirúrgicos; partes y accesorios de estos  instrumentos o aparatos', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(96, 'SCT-1729549713', 'CAT-22102024000102', 'Aparatos de relojería y sus partes', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(97, 'SCT-1729549725', 'CAT-22102024000102', 'Instrumentos musicales; sus partes y accesorios ', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(98, 'SCT-1729549741', 'CAT-22102024000124', 'Armas, municiones, y sus partes y accesorios', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(99, 'SCT-1729549752', 'CAT-22102024000131', 'Muebles; mobiliario medicoquirúrgico; artículos de cama y similares; aparatos de  alumbrado no expresados ni comprendidos en otra parte; anuncios, letreros y placas  indicadoras luminosos y artículos similares; construcciones prefabricadas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(100, 'SCT-1729549763', 'CAT-22102024000131', 'Juguetes, juegos y artículos para recreo o deporte; sus partes y accesorios', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(101, 'SCT-1729549772', 'CAT-22102024000131', 'Manufacturas diversas', 'Sin descripcion', '2024-10-21', '2024-10-21', 1),
(102, 'SCT-1729549784', 'CAT-22102024000202', 'Objetos de arte o colección y antigüedades', 'Sin descripcion', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtelefono`
--

CREATE TABLE IF NOT EXISTS `tbtelefono` (
  `tbtelefonoid` int(11) NOT NULL,
  `tbtelefonoidentificador` mediumtext NOT NULL,
  `tbtelefonoidproveedor` int(11) NOT NULL,
  `tbtelefonotelefono` mediumtext DEFAULT NULL,
  `tbtelefonocreadoen` date NOT NULL,
  `tbtelefonomodificadoen` date NOT NULL,
  `tbtelefonoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbtelefono`
--

INSERT INTO `tbtelefono` (`tbtelefonoid`, `tbtelefonoidentificador`, `tbtelefonoidproveedor`, `tbtelefonotelefono`, `tbtelefonocreadoen`, `tbtelefonomodificadoen`, `tbtelefonoestado`) VALUES
(1, 'TEL-001', 1, '555-0101', '2023-01-01', '2023-10-21', 1),
(2, 'TEL-002', 2, '555-0102', '2023-02-15', '2023-10-21', 1),
(3, 'TEL-003', 3, '555-0103', '2023-03-10', '2023-10-21', 1),
(4, 'TEL-004', 4, '555-0104', '2023-04-05', '2023-10-21', 1),
(5, 'TEL-005', 5, '555-0105', '2023-05-20', '2023-10-21', 1),
(6, 'TEL-006', 6, '555-0106', '2023-06-15', '2023-10-21', 1),
(7, 'TEL-007', 7, '555-0107', '2023-07-10', '2023-10-21', 1),
(8, 'TEL-008', 8, '555-0108', '2023-08-01', '2023-10-21', 1),
(9, 'TEL-009', 9, '555-0109', '2023-09-12', '2023-10-21', 1),
(10, 'TEL-010', 10, '555-0110', '2023-10-05', '2023-10-21', 1),
(11, 'TEL-011', 11, '555-0111', '2023-01-20', '2023-10-21', 1),
(12, 'TEL-012', 12, '555-0112', '2023-02-25', '2023-10-21', 1),
(13, 'TEL-013', 13, '555-0113', '2023-03-30', '2023-10-21', 1),
(14, 'TEL-014', 14, '555-0114', '2023-04-18', '2023-10-21', 1),
(15, 'TEL-015', 15, '555-0115', '2023-05-22', '2023-10-21', 1),
(16, 'TEL-016', 16, '555-0116', '2023-06-11', '2023-10-21', 1),
(17, 'TEL-017', 17, '555-0117', '2023-07-19', '2023-10-21', 1),
(18, 'TEL-018', 18, '555-0118', '2023-08-27', '2023-10-21', 1),
(19, 'TEL-019', 19, '555-0119', '2023-09-09', '2023-10-21', 1),
(20, 'TEL-020', 20, '555-0120', '2023-10-15', '2023-10-21', 1),
(21, 'CEL-SUP-72996665-2024-10-2118:00:19', 21, '72996665', '2024-10-21', '2024-10-21', 1),
(22, 'CEL-SUP-25047676-2024-10-2118:04:16', 22, '25047676', '2024-10-21', '2024-10-21', 1),
(23, 'CEL-SUP-25431300-2024-10-2118:07:21', 23, '25431300', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoproveedor`
--

CREATE TABLE IF NOT EXISTS `tbtipoproveedor` (
  `tbtipoproveedorid` int(11) NOT NULL,
  `tbtipoproveedoridentificador` varchar(255) NOT NULL,
  `tbtipoproveedornombre` varchar(255) NOT NULL,
  `tbtipoproveedorcreadoen` date NOT NULL,
  `tbtipoproveedormodificadoen` date NOT NULL,
  `tbtipoproveedorestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbtipoproveedor`
--

INSERT INTO `tbtipoproveedor` (`tbtipoproveedorid`, `tbtipoproveedoridentificador`, `tbtipoproveedornombre`, `tbtipoproveedorcreadoen`, `tbtipoproveedormodificadoen`, `tbtipoproveedorestado`) VALUES
(1, 'CONSTRU', 'Materiales de construcción', '2023-01-10', '2024-01-10', 1),
(2, 'ALIM', 'Productos alimenticios', '2023-02-15', '2024-02-15', 1),
(3, 'FERRET', 'Ferretería y herramientas', '2023-03-05', '2024-03-05', 1),
(4, 'MEDIC', 'Equipos médicos', '2023-04-12', '2024-04-12', 1),
(5, 'TEXTIL', 'Textiles y ropa', '2023-05-18', '2024-05-18', 1),
(6, 'FARMA', 'Medicamentos', '2023-06-25', '2024-06-25', 1),
(7, 'ELECTR', 'Electrodomésticos', '2023-07-03', '2024-07-03', 1),
(8, 'MADERA', 'Madera y derivados', '2023-08-07', '2024-08-07', 1),
(9, 'AUTO', 'Repuestos automotrices', '2023-09-14', '2024-09-14', 1),
(10, 'AGRO', 'Insumos agrícolas', '2023-10-21', '2024-10-21', 1),
(11, 'GRAF', 'Servicios gráficos', '2023-11-09', '2024-11-09', 1),
(12, 'LIMPIEZA', 'Productos de limpieza', '2023-12-01', '2024-12-01', 1),
(13, 'PAPEL', 'Papelería y útiles', '2023-02-08', '2024-02-08', 1),
(14, 'ELECTRIC', 'Materiales eléctricos', '2023-03-22', '2024-03-22', 1),
(15, 'PESCADO', 'Productos del mar', '2023-04-30', '2024-04-30', 1),
(16, 'TECNO', 'Software y tecnología', '2023-05-15', '2024-05-15', 1),
(17, 'AGROPEC', 'Productos agropecuarios', '2023-06-10', '2024-06-10', 1),
(18, 'METAL', 'Estructuras metálicas', '2023-07-25', '2024-07-25', 1),
(19, 'SERVLIMP', 'Servicios de limpieza', '2023-08-16', '2024-08-16', 1),
(20, 'TELECOM', 'Telecomunicaciones', '2023-09-28', '2024-09-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipounidad`
--

CREATE TABLE IF NOT EXISTS `tbtipounidad` (
  `tbtipounidadid` int(11) NOT NULL,
  `tbtipounidadidentificador` varchar(255) NOT NULL,
  `tbtipounidadnombre` mediumtext NOT NULL,
  `tbtipounidaddescripcion` mediumtext NOT NULL,
  `tbtipounidadfechacreacion` date NOT NULL,
  `tbtipounidadfechamodificacion` date NOT NULL,
  `tbtipounidadestado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbtipounidad`
--

INSERT INTO `tbtipounidad` (`tbtipounidadid`, `tbtipounidadidentificador`, `tbtipounidadnombre`, `tbtipounidaddescripcion`, `tbtipounidadfechacreacion`, `tbtipounidadfechamodificacion`, `tbtipounidadestado`) VALUES
(1, 'UNT-1729544975', 'Masa', 'Unidad utilizada para medir la cantidad de materia', '2024-10-21', '2024-10-21', 1),
(2, 'UNT-1729544991', 'Longitud', 'Unidad utilizada para medir distancia o tamaño', '2024-10-21', '2024-10-21', 1),
(3, 'UNT-1729545013', 'Volumen', 'Unidad utilizada para medir la cantidad de espacio que ocupa una sustancia ', '2024-10-21', '2024-10-21', 1),
(4, 'UNT-1729545029', 'Densidad', 'Unidad utilizada para medir la masa por unidad de volumen', '2024-10-21', '2024-10-21', 1),
(5, 'UNT-1729545048', 'Superficie', 'Unidad utilizada para medir el área de una superficie', '2024-10-21', '2024-10-21', 1),
(6, 'UNT-1729545066', 'Tiempo', 'Unidad utilizada para medir la duración de eventos', '2024-10-21', '2024-10-21', 1),
(7, 'UNT-1729545091', 'Temperatura', 'Unidad utilizada para medir el calor o frío', '2024-10-21', '2024-10-21', 1),
(8, 'UNT-1729545101', 'Cantidad', 'Unidad genérica para contar elementos o productos', '2024-10-21', '2024-10-21', 1),
(9, 'UNT-1729545115', 'Velocidad', 'Unidad utilizada para medir la rapidez de un objeto', '2024-10-21', '2024-10-21', 1),
(10, 'UNT-1729545131', 'Aceleración', 'Unidad utilizada para medir el cambio en la velocidad de un objeto', '2024-10-21', '2024-10-21', 1),
(11, 'UNT-1729545142', 'Fuerza', 'Unidad utilizada para medir la interacción que cambia el movimiento de un objeto', '2024-10-21', '2024-10-21', 1),
(12, 'UNT-1729545153', 'Presión', 'Unidad utilizada para medir la fuerza ejercida por unidad de área', '2024-10-21', '2024-10-21', 1),
(13, 'UNT-1729545163', 'Energía', 'Unidad utilizada para medir la capacidad de realizar trabajo', '2024-10-21', '2024-10-21', 1),
(14, 'UNT-1729545175', 'Potencia', 'Unidad utilizada para medir la tasa de transferencia de energía', '2024-10-21', '2024-10-21', 1),
(15, 'UNT-1729545185', 'Carga eléctrica', 'Unidad utilizada para medir la cantidad de electricidad', '2024-10-21', '2024-10-21', 1),
(16, 'UNT-1729545197', 'Corriente eléctrica', 'Unidad utilizada para medir el flujo de carga eléctrica', '2024-10-21', '2024-10-21', 1),
(17, 'UNT-1729545209', 'Resistencia eléctrica', 'Unidad utilizada para medir la resistencia al flujo de electricidad', '2024-10-21', '2024-10-21', 1),
(18, 'UNT-1729545221', 'Frecuencia', 'Unidad utilizada para medir la repetición de un evento por unidad de tiempo', '2024-10-21', '2024-10-21', 1),
(19, 'UNT-1729545262', 'Capacidad eléctrica', 'Unidad utilizada para medir la cantidad de carga eléctrica almacenada', '2024-10-21', '2024-10-21', 1),
(20, 'UNT-1729545273', 'Inductancia', 'Unidad utilizada para medir la capacidad de un circuito para inducir voltaje', '2024-10-21', '2024-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbunidadmedida`
--

CREATE TABLE IF NOT EXISTS `tbunidadmedida` (
  `tbunidadmedidaid` int(11) NOT NULL,
  `tbunidadmedidaidentificador` varchar(255) NOT NULL,
  `tbunidadmedidanombreunidad` varchar(255) NOT NULL,
  `tbunidadmedidaabreviatura` varchar(255) NOT NULL,
  `tbunidadmedidasistemamedida` varchar(255) DEFAULT NULL,
  `tbunidadmedidatipounidad` varchar(255) DEFAULT NULL,
  `tbunidadmedidafechacreacion` datetime NOT NULL,
  `tbunidadmedidafechamodificacion` datetime NOT NULL,
  `tbunidadmedidaestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbunidadmedida`
--

INSERT INTO `tbunidadmedida` (`tbunidadmedidaid`, `tbunidadmedidaidentificador`, `tbunidadmedidanombreunidad`, `tbunidadmedidaabreviatura`, `tbunidadmedidasistemamedida`, `tbunidadmedidatipounidad`, `tbunidadmedidafechacreacion`, `tbunidadmedidafechamodificacion`, `tbunidadmedidaestado`) VALUES
(1, 'Metro1724628768', 'Metro', 'MTS', 'Internacional SI', 'UNT-1729544991', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(2, 'Kilogramo1724628769', 'Kilogramo', 'KG', 'Internacional SI', 'UNT-1729544975', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(3, 'Litro1724628770', 'Litro', 'L', 'Internacional SI', 'UNT-1729545013', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(4, 'Newton1724628771', 'Newton', 'N', 'Internacional SI', 'UNT-1729545142', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(5, 'Metro cuadrado1724628772', 'Metro cuadrado', 'M2', 'Internacional SI', 'UNT-1729545048', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(6, 'Segundo1724628773', 'Segundo', 'S', 'Internacional SI', 'UNT-1729545066', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(7, 'Grado Celsius1724628774', 'Grado Celsius', '°C', 'Internacional SI', 'UNT-1729545091', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(8, 'Mole1724628775', 'Mole', 'mol', 'Internacional SI', 'UNT-1729545101', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(9, 'Metro por segundo1724628776', 'Metro por segundo', 'MPS', 'Internacional SI', 'UNT-1729545115', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(10, 'Metro por segundo cuadrado1724628777', 'Metro por segundo cuadrado', 'MPS2', 'Internacional SI', 'UNT-1729545131', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(11, 'Pascal1724628778', 'Pascal', 'Pa', 'Internacional SI', 'UNT-1729545153', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(12, 'Joule1724628779', 'Joule', 'J', 'Internacional SI', 'UNT-1729545163', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(13, 'Watt1724628780', 'Watt', 'W', 'Internacional SI', 'UNT-1729545175', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(14, 'Coulomb1724628781', 'Coulomb', 'C', 'Internacional SI', 'UNT-1729545185', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(15, 'Amperio1724628782', 'Amperio', 'A', 'Internacional SI', 'UNT-1729545197', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(16, 'Ohm1724628783', 'Ohm', 'Ω', 'Internacional SI', 'UNT-1729545209', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(17, 'Hertz1724628784', 'Hertz', 'Hz', 'Internacional SI', 'UNT-1729545221', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(18, 'Faradio1724628785', 'Faradio', 'F', 'Internacional SI', 'UNT-1729545262', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(19, 'Henry1724628786', 'Henry', 'H', 'Internacional SI', 'UNT-1729545273', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1),
(20, 'Mililitro1724628787', 'Mililitro', 'mL', 'Internacional SI', 'UNT-1729545013', '2024-10-21 12:00:00', '2024-10-21 12:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbusuario`
--

CREATE TABLE IF NOT EXISTS `tbusuario` (
  `tbusuarioid` int(11) NOT NULL,
  `tbusuarioidentificador` mediumtext NOT NULL,
  `tbusuarionombreusuario` varchar(50) NOT NULL,
  `tbusuarioemail` tinytext NOT NULL,
  `tbusuariocontrasena` tinytext NOT NULL,
  `tbusuarionombre` varchar(50) NOT NULL,
  `tbusuarioapellidos` varchar(100) NOT NULL,
  `tbusuariofechacreacion` date NOT NULL,
  `tbusuariofechamodificacion` datetime NOT NULL,
  `tbusuarioultimoingreso` datetime NOT NULL,
  `tbusuarioestado` int(11) NOT NULL,
  `tbusuariorol` tinytext NOT NULL,
  `tbusuariofotoperfil` tinytext NOT NULL,
  `tbusuarioidentificadortelefono` tinytext NOT NULL,
  `tbusuariodireccion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbusuario`
--

INSERT INTO `tbusuario` (`tbusuarioid`, `tbusuarioidentificador`, `tbusuarionombreusuario`, `tbusuarioemail`, `tbusuariocontrasena`, `tbusuarionombre`, `tbusuarioapellidos`, `tbusuariofechacreacion`, `tbusuariofechamodificacion`, `tbusuarioultimoingreso`, `tbusuarioestado`, `tbusuariorol`, `tbusuariofotoperfil`, `tbusuarioidentificadortelefono`, `tbusuariodireccion`) VALUES
(4, 'USUARIO-1725987630', 'admin', 'admin@una.com', '$2y$10$9dGFNTUbmAPw0IPodAZbwu3UJi.xYQV0tpdbuRXvrkMQJMmyrBkw2', 'admin', 'admin', '2024-09-10', '2024-09-19 13:47:48', '2024-09-19 13:47:48', 1, 'ROL-1729543567', '../images/user/USUARIO-1725987630.png', '', ''),
(1, 'USUARIO-1728169584', 'cliente', 'cliente@gmail.com', '$2y$10$okRJP8y9cvKO/ZS9HpMjrOm3qyEMygkN7QANt6C/tf27acVCymem6', 'cliente', 'cliente', '2024-10-05', '2024-10-05 17:06:24', '2024-10-05 17:06:24', 1, 'ROL-1729543747', '../images/user/USUARIO-1728169584.png', '1245678', 'cuenta cliente de pruebas');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfactura`
--

CREATE TABLE `tbfactura` (
  `tbfacturaid` int(11) NOT NULL,
  `tbfacturaidentificador` varchar(255) NOT NULL,
  `tbfacturaidventa` int(11) NOT NULL,
  `tbfacturacreadoen` date NOT NULL,
  `tbfacturamodificadoen` date NOT NULL,
  `tbfacturaurlqr` varchar(255) NOT NULL,
  `tbfacturaestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventa`
--

CREATE TABLE IF NOT EXISTS `tbventa` (
  `tbventaid` int(11) NOT NULL,
  `tbventaidentificador` mediumtext NOT NULL,
  `tbventausuarioidentificador` mediumtext NOT NULL,
  `tbventafechacreacion` datetime NOT NULL,
  `tbventafechamodificacion` datetime NOT NULL,
  `tbventaestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventaproducto`
--

CREATE TABLE IF NOT EXISTS `tbventaproducto` (
  `tbventaproductoid` int(11) NOT NULL,
  `tbventaidentificador` mediumtext NOT NULL,
  `tbventaproductoidentificador` mediumtext NOT NULL,
  `tbventacantidadproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;


CREATE TABLE IF NOT EXISTS `tbtrasaccionventa` (
  `tbidentificadorventa` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
