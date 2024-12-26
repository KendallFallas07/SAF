-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-09-2024 a las 07:37:23
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
(1, 'CAT-22082024182458', 'Verduras', 'Cebolla chile etc', '2024-08-22', '2024-08-22', 1),
(2, 'CAT-22082024182543', 'Golosinas', 'Confites chocolates', '2024-08-22', '2024-08-22', 1),
(3, 'CAT-22082024184010', 'Electrónica', 'Productos tecnológicos ', '2024-08-22', '2024-08-22', 1),
(4, 'CAT-22082024184035', 'Ropa y Moda', 'Incluye prendas de vestir calzado y accesorios', '2024-08-22', '2024-08-22', 1),
(5, 'CAT-22082024184104', 'Hogar y jardín', 'Productos para mantener el hogar', '2024-08-22', '2024-08-22', 1),
(6, 'CAT-22082024184311', 'Alimentos', ' Productos destinados al consumo humano', '2024-08-22', '2024-08-22', 1),
(7, 'CAT-22082024184324', 'Bebidas', '	Productos destinados al consumo humano', '2024-08-22', '2024-08-22', 1),
(8, 'CAT-27082024100356', 'snacks', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(9, 'CAT-27082024100525', 'Snacks', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(10, 'CAT-27082024100828', 'hola', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(11, 'CAT-27082024100930', 'calavera', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(12, 'CAT-27082024101106', 'hola', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(13, 'CAT-27082024101406', 'hol', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(14, 'CAT-27082024101720', 'hola', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(15, 'CAT-27082024101956', 'pepe', 'Sin descripcion', '2024-08-27', '2024-08-27', 1),
(16, 'CAT-27082024170320', 'prueba', 'Sin descripcion', '2024-08-27', '2024-08-27', 1);

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

--
-- Volcado de datos para la tabla `tbclientecredito`
--

INSERT INTO `tbclientecredito` (`tbclientecreditoid`, `tbclienteidentificador`, `tbclientecreditoidentificador`, `tbclientecreditocantidad`, `tbclientecreditoporcentaje`, `tbclientecreditoplazo`, `tbclientecreditofechainicio`, `tbclientecreditofechavencimiento`, `tbclientecreditocreadoen`, `tbclientecreditomodificadoen`, `tbclientecreditoestado`) VALUES
(1, 'user1012', 'CRED-2024-09-02 01:40:47', 0, 0, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(2, 'user1012', 'CRED-2024-09-02 01:41:15', 1.1, 0.9, 10, '2024-08-31', '2025-07-01', '2024-09-02', '2024-09-02', 0),
(3, 'user1012', 'CRED-2024-09-02 01:41:33', 1.5, 2, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(4, 'user1012', 'CRED-2024-09-02 02:06:19', 1, 0.8, 9, '2024-08-31', '2025-05-31', '2024-09-02', '2024-09-02', 0),
(5, 'user1012', 'CRED-2024-09-02 01:40:47', 0.8, 0.9, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(6, 'user1012', 'CRED-2024-09-02 01:40:47', 0.8, 0.9, 3, '2024-08-29', '2024-11-29', '2024-09-02', '2024-09-02', 0),
(7, 'user1012', 'CRED-2024-09-02 02:14:24', 0.6, 0.5, 9, '2024-09-01', '2025-06-01', '2024-09-02', '2024-09-02', 0),
(8, 'user1012', 'CRED-2024-09-02 02:14:44', 0.4, 0.4, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(9, 'user1012', 'CRED-2024-09-02 02:15:39', 0, 0, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(10, 'user1012', 'CRED-2024-09-02 02:15:39', 0.1, 0.1, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(11, 'user1012', 'CRED-2024-09-02 02:15:39', 0.1, 0.1, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(12, 'user1012', 'CRED-2024-09-02 02:20:17', 0, 0, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(13, 'user1012', 'CRED-2024-09-02 03:14:15', 0, 0, 0, '0000-00-00', '0000-00-00', '2024-09-02', '2024-09-02', 0),
(14, 'user1012', 'CRED-2024-09-02 03:14:15', 0.1, 0.1, 1, '2024-09-01', '2024-10-02', '2024-09-02', '2024-09-02', 0),
(15, 'USUARIO-1725340493', 'CRED-2024-09-04 08:48:59', 0.1, 0.1, 1, '2024-09-04', '2024-10-04', '2024-09-04', '2024-09-04', 1);

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

--
-- Volcado de datos para la tabla `tbcompra`
--

INSERT INTO `tbcompra` (`tbcompraid`, `tbcompraidentificador`, `tbcompraidentificadorproveedor`, `tbcompratotal`, `tbcompranotas`, `tbcomprametodopago`, `tbcomprafecha`, `tbcompracreadoen`, `tbcompramodificadoen`, `tbcompraestado`) VALUES
(1, 'BUY-2024-09-01 21:23:48', 'SUP-Suli-2024-08-2210:19:26', 0, 'Sin notas', 'Efectivo', '2024-08-28', '2024-09-01', '2024-09-01', 0),
(2, 'BUY-2024-09-01 21:23:48', 'SUP-Suli-2024-08-2210:19:26', 0, 'con notas', 'Efectivo', '2024-08-28', '2024-09-01', '2024-09-01', 0),
(3, 'BUY-2024-09-03 09:46:00', 'SUP-Suli-2024-08-2210:19:26', 0, 'prueba', 'E-wallet', '2024-09-03', '2024-09-03', '2024-09-03', 1),
(4, 'BUY-2024-09-01 21:23:48', 'SUP-Suli-2024-08-2210:19:26', 0, 'con notass', 'Efectivo', '2024-08-28', '2024-09-03', '2024-09-03', 1);

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
(1, 'EMA-SUP-suli@gmail.com-2024-08-2210:19:26', 1, 'suli@gmail.com', '2024-08-22', '2024-08-22', 1),
(2, 'EMA-SUP-sardimar@gmail.com-2024-08-2210:20:25', 2, 'sardimar@gmail.com', '2024-08-22', '2024-08-22', 1),
(3, 'EMA-SUP-cocacola@gmail.com-2024-08-2210:45:24', 3, 'cocacola@gmail.com', '2024-08-22', '2024-08-22', 1),
(4, 'EMA-SUP-t@gmail.com-2024-08-2702:25:30', 4, 't@gmail.com', '2024-08-27', '2024-08-27', 1),
(5, 'EMA-SUP-pipasa@gmail.com-2024-09-0310:06:46', 5, 'pipasa@gmail.com', '2024-09-03', '2024-09-03', 1);

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
(1, 'DIREC-SUP-30202-2024-08-2210:19:26', 1, 1, 'Del pali de Guápiles 200 mts sur', '2024-08-22', '2024-08-22', 1),
(2, 'DIREC-SUP-10304-2024-08-2210:20:25', 2, 14, 'Del super los chinitos 400mts este', '2024-08-22', '2024-08-22', 1),
(3, 'DIREC-SUP-70102-2024-08-2210:45:24', 3, 152, 'Al lado sur del pali de Cahuita', '2024-08-22', '2024-08-22', 1),
(4, 'DIREC-SUP-10301-2024-08-2702:25:30', 4, 82, 'prueba', '2024-08-27', '2024-08-27', 1),
(5, 'DIREC-SUP-10101-2024-09-0310:06:46', 5, 1, 'prueba', '2024-09-03', '2024-09-03', 1);

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
(1, 'IMPUESTO-1724722311', 'IVA', 'Impuesto de Venta Adquirido', 13.20, '2024-08-26', 1),
(1, 'IMPUESTO-1724722348', 'ISR', 'Impuesto Sobre la Renta', 20.00, '2024-08-26', 1),
(1, 'IMPUESTO-1724747054', 'prueba', 'p', 0.01, '2024-08-27', 0),
(2, 'IMPUESTO-1724747054', 'prueba', 'prueba', 0.01, '2024-08-27', 0);

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
  `tbloteporcentaje` double NOT NULL,
  `tblotefechaadquisicion` date NOT NULL,
  `tblotefechaexpiracion` date NOT NULL,
  `tblotefechacreacion` date NOT NULL,
  `tblotefechamodificacion` date NOT NULL,
  `tbloteestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblote`
--

INSERT INTO `tblote` (`tbloteid`, `tbloteidentificador`, `tbproductoidentificador`, `tblotecantidadadquirida`, `tblotecantidadactual`, `tblotepreciocompra`, `tbloteporcentaje`, `tblotefechaadquisicion`, `tblotefechaexpiracion`, `tblotefechacreacion`, `tblotefechamodificacion`, `tbloteestado`) VALUES
(1, 'LOTE-1724769984', 'PROD-prueba2024-08-2615:34:01', 1, 1, 0.01, 0.03, '2024-08-27', '2024-08-27', '2024-08-27', '2024-08-27', 0),
(2, 'LOTE-1724770043', 'PROD-prueba2024-08-2708:25:50', 5, 5, 0.01, 0.03, '2024-08-27', '2024-08-27', '2024-08-27', '2024-08-27', 0),
(3, 'LOTE-1724770355', 'PROD-prueba2024-08-2708:25:50', 5, 5, 0.01, 0.03, '2024-08-27', '2024-08-27', '2024-08-27', '2024-08-27', 0),
(4, 'LOTE-1725324427', 'PROD-prueba2024-08-2708:56:45', 1, 1, 1, 1, '2024-09-02', '2024-09-02', '2024-09-02', '2024-09-02', 1);

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
(1, '1724343686', 'Lata', 'En lata de 140G', '2024-08-22', '2024-08-22', 1),
(1, '1724343736', 'Bolsa plastica', 'Bolsa plástica que soporta 1K', '2024-08-22', '2024-08-22', 1),
(1, '1724345228', 'Botella plastica', 'Botella plástica (No retornable) ', '2024-08-22', '2024-08-22', 1),
(1, '1724747230', 'Carton', 'cajas', '2024-08-27', '2024-08-27', 0);

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
(1, 'PROD-prueba2024-08-2615:34:01', 'Masa', 'de maiz', 'CAT-22082024184311', 'Metro1724628768', '1724345228', '2024-08-26 00:00:00', '2024-08-26 00:00:00', 1),
(2, 'PROD-prueba22024-08-2615:34:20', 'Salsa', 'de tomate', 'CAT-22082024184311', 'Metro1724628768', '1724343736', '2024-08-26 00:00:00', '2024-08-26 00:00:00', 0),
(3, 'PROD-cofal2024-08-2702:29:57', 'cofal', 'pruebas', 'CAT-22082024184104', 'Metro1724628768', '1724343686', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 0),
(4, 'PROD-prueba2024-08-2708:20:13', 'prueba', 'p', 'CAT-22082024182458', 'Metro1724628768', '1724343686', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 0),
(5, 'PROD-prueba2024-08-2708:23:36', 'prueba', 'p', 'CAT-22082024182458', 'Metro1724628768', '1724343686', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 0),
(6, 'PROD-prueba2024-08-2708:25:50', 'prueba', 'p', 'CAT-22082024182458', 'Metro1724628768', '1724343686', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 0),
(7, 'PROD-prueba2024-08-2708:27:18', 'prueba', 'p', 'CAT-22082024182458', 'Metro1724628768', '1724343686', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 0),
(8, 'PROD-prueba2024-08-2708:56:45', 'prueba', 'p', 'CAT-22082024184035', 'Metro1724628768', '1724343686', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1);

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
(1, 3, 'SUP-Suli-2024-08-2210:19:26', 'Suli', '2024-08-22', '2024-09-03', 1),
(2, 2, 'SUP-Sardimar-2024-08-2210:20:25', 'Sardimar', '2024-08-22', '2024-08-22', 1),
(3, 2, 'SUP-Coca cola-2024-08-2210:45:24', 'Coca cola', '2024-08-22', '2024-08-26', 0),
(4, 3, 'SUP-CocaCola-2024-08-2702:25:30', 'CocaCola', '2024-08-27', '2024-08-27', 0),
(5, 1, 'SUP-pipasa-2024-09-0310:06:46', 'pipasa', '2024-09-03', '2024-09-03', 1);

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

--
-- Volcado de datos para la tabla `tbproveedorcredito`
--

INSERT INTO `tbproveedorcredito` (`tbproveedorcreditoid`, `tbproveedorid`, `tbproveedorcreditoidentificador`, `tbproveedorcreditocantidadcredito`, `tbproveedorcreditoporcentaje`, `tbproveedorcreditoplazo`, `tbproveedorcreditofechainicio`, `tbproveedorcreditofechavencimiento`, `tbproveedorcreditofechacreacion`, `tbproveedorcreditofechamodificacion`, `tbproveedorcreditoestado`) VALUES
(1, 'SUP-Sardimar-2024-08-2210:20:25', 'PROVEEDORCREDITO-1725326095', 0.00, 0.02, 2, '2024-09-02', '2024-09-02', '2024-09-02', '2024-09-02', 0),
(2, 'SUP-Sardimar-2024-08-2210:20:25', 'PROVEEDORCREDITO-1725326105', 0.00, 0.03, 2, '2024-09-02', '2024-09-02', '2024-09-02', '2024-09-02', 0),
(3, 'SUP-Suli-2024-08-2210:19:26', 'PROVEEDORCREDITO-1725326298', 0.05, 0.03, 2, '2024-09-02', '2024-09-02', '2024-09-02', '2024-09-02', 1),
(4, 'SUP-Sardimar-2024-08-2210:20:25', 'PROVEEDORCREDITO-1725326095', 0.01, 0.02, 2, '2024-09-02', '2024-09-02', '2024-09-03', '2024-09-03', 1),
(5, 'SUP-Sardimar-2024-08-2210:20:25', 'PROVEEDORCREDITO-1725326105', 0.37, 0.03, 2, '2024-09-02', '2024-09-02', '2024-09-03', '2024-09-03', 1),
(6, 'SUP-Suli-2024-08-2210:19:26', 'PROVEEDORCREDITO-1725326536', 0.01, 0.01, 2, '2024-09-02', '2024-09-02', '2024-09-02', '2024-09-02', 1);

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
(1, 'PROD-PROV-Coca cola-prueba2024-08-2615:34:01', 'SUP-Suli-2024-08-2210:19:26', 'PROD-prueba2024-08-2615:34:01', '2024-08-26 00:00:00', '2024-08-26 00:00:00', '2024-08-26 00:00:00', 1),
(2, 'PROD-PROV-Suli-prueba22024-08-2615:34:20', 'SUP-Sardimar-2024-08-2210:20:25', 'PROD-prueba22024-08-2615:34:20', '2024-08-26 00:00:00', '2024-08-26 00:00:00', '2024-08-26 00:00:00', 1),
(3, 'PROD-PROV-Suli-cofal2024-08-2702:29:57', 'SUP-Suli-2024-08-2210:19:26', 'PROD-cofal2024-08-2702:29:57', '2024-08-27 00:00:00', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1),
(4, 'PROD-PROV-Suli-prueba2024-08-2708:20:13', 'SUP-Suli-2024-08-2210:19:26', 'PROD-prueba2024-08-2708:20:13', '2024-08-27 00:00:00', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1),
(5, 'PROD-PROV-Suli-prueba2024-08-2708:23:36', 'SUP-Suli-2024-08-2210:19:26', 'PROD-prueba2024-08-2708:23:36', '2024-08-27 00:00:00', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1),
(6, 'PROD-PROV-Suli-prueba2024-08-2708:25:50', 'SUP-Suli-2024-08-2210:19:26', 'PROD-prueba2024-08-2708:25:50', '2024-08-27 00:00:00', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1),
(7, 'PROD-PROV-Suli-prueba2024-08-2708:27:18', 'SUP-Suli-2024-08-2210:19:26', 'PROD-prueba2024-08-2708:27:18', '2024-08-27 00:00:00', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1),
(8, 'PROD-PROV-Suli-prueba2024-08-2708:56:45', 'SUP-Suli-2024-08-2210:19:26', 'PROD-prueba2024-08-2708:56:45', '2024-08-27 00:00:00', '2024-08-27 00:00:00', '2024-08-27 00:00:00', 1);

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
(1, 'ROL-1725305888', 'hola', 'hola', '2024-09-02', '2024-09-02', 0),
(1, 'ROL-1725305971', 'Admin', 'administrador', '2024-09-02', '2024-09-02', 0),
(2, 'ROL-1725305971', 'Admin', 'hola', '2024-09-02', '2024-09-02', 0),
(1, 'ROL-1725306023', 'root', 'el estado mas alto de acceso', '2024-09-02', '2024-09-02', 0),
(3, 'ROL-1725305971', 'Admin', 'pepe', '2024-09-02', '2024-09-02', 0),
(4, 'ROL-1725305971', 'Admin', 'pepe', '2024-09-02', '2024-09-02', 0),
(5, 'ROL-1725305971', 'Admin', 'hola', '2024-09-02', '2024-09-02', 0),
(2, 'ROL-1725306023', 'root', 'acceso mas alto ', '2024-09-02', '2024-09-02', 0),
(3, 'ROL-1725306023', 'root', 'acceso mas altos ', '2024-09-02', '2024-09-02', 0),
(4, 'ROL-1725306023', 'root', 'acceso mas altos ', '2024-09-02', '2024-09-02', 0),
(6, 'ROL-1725305971', 'Admin', 'administrador', '2024-09-02', '2024-09-02', 0),
(5, 'ROL-1725306023', 'root', 'acceso mas altoss', '2024-09-02', '2024-09-02', 0),
(7, 'ROL-1725305971', 'Admin', 'administradors', '2024-09-02', '2024-09-02', 0),
(6, 'ROL-1725306023', 'root', 'acceso mas alto', '2024-09-02', '2024-09-02', 0),
(8, 'ROL-1725305971', 'Admin', 'administrador', '2024-09-02', '2024-09-02', 0),
(7, 'ROL-1725306023', 'ROOT', 'acceso mas alto', '2024-09-02', '2024-09-02', 0),
(9, 'ROL-1725305971', 'ADMIN', 'administrador', '2024-09-02', '2024-09-02', 0),
(1, 'ROL-1725346368', 'ADMIN', 'administrador', '2024-09-03', '2024-09-03', 0),
(1, 'ROL-1725346390', 'ROOT', 'ROOT de  mas alto nivel', '2024-09-03', '2024-09-03', 1),
(2, 'ROL-1725346368', 'ADMIN', 'administradors', '2024-09-03', '2024-09-03', 0),
(3, 'ROL-1725346368', 'ADMIN', 'administrador', '2024-09-03', '2024-09-03', 1);

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
(1, 'CEL-SUP-12345678-2024-08-2210:19:26', 1, '83185484', '2024-08-22', '2024-09-03', 1),
(2, 'CEL-SUP-87654321-2024-08-2210:20:25', 2, '87654321', '2024-08-22', '2024-08-22', 1),
(3, 'CEL-SUP-98981253-2024-08-2210:45:24', 3, '98981253', '2024-08-22', '2024-08-22', 1),
(4, 'CEL-SUP-11111111-2024-08-2702:25:30', 4, '11111111', '2024-08-27', '2024-08-27', 1),
(5, 'CEL-SUP-12345678-2024-09-0310:06:46', 5, '12345678', '2024-09-03', '2024-09-03', 1);

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
(1, 'TYPE-SUP-Servicio-2024-05-0823:59:00', 'Servicio', '2024-05-08', '2024-05-08', 1),
(2, 'TYPE-SUP-Fabricante-2024-08-135:59:00', 'Fabricante', '2024-08-13', '2024-08-13', 1),
(3, 'TYPE-SUP-Distribuidor-2024-08-13 16:00:00', 'Distribuidor', '2024-08-13', '2024-08-13', 1),
(4, 'TYPE-SUP-Revendedor-2024-08-13 16:01:00', 'Revendedor', '2024-08-13', '2024-08-13', 1);

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
(1, 'UNT-1724315865', 'Angulo', 'Sin descripcion', '2024-08-22', '2024-08-22', 1),
(2, 'UNT-1724315872', 'Kilometraje', 'Sin descripcion', '2024-08-22', '2024-08-22', 1),
(3, 'UNT-1724315880', 'longitud', 'Sin descripcion', '2024-08-22', '2024-08-22', 1),
(4, 'UNT-1724747513', 'pruba', 'Sin descripcion', '2024-08-27', '2024-08-27', 0),
(5, 'UNT-1724747513', 'prueba', 'Sin descripcion', '2024-08-27', '2024-08-27', 0);

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
(1, 'Metro1724628768', 'Metro', 'MTS', 'Internacional SI', 'UNT-1724315880', '2024-08-25 17:32:48', '2024-08-25 17:32:48', 0),
(2, 'Metro1724628768', 'Metros', 'MTS', 'Internacional SI', 'UNT-1724315880', '2024-08-25 17:32:48', '2024-08-25 17:37:39', 1),
(1, 'Pulgadas1724747459', 'Pulgadas', 'PGS', 'Anglosajon', 'UNT-1724315880', '2024-08-27 02:30:59', '2024-08-27 02:30:59', 0),
(2, 'Pulgadas1724747459', 'Pulgadas', 'PGS', 'Internacional SI', 'UNT-1724315865', '2024-08-27 02:30:59', '2024-08-27 02:31:16', 0);

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
(1, 'USUARIO-1725832215', 'pedro', 'pedro@gmail.com', '$2y$10$R.IXn0Bw.wcgkmStFw9rrOuaKS4ftl76rCnfxtGaLiZIkWtHedRJK', 'pedro', 'guevara', '2024-09-08', '2024-09-08 15:50:15', '2024-09-08 15:50:15', 0, 'ROL-1725731031', 'por implementar la ruta', '88888888', 'la victoria'),
(3, 'USUARIO-1725843429', 'brayan', 'brayan@una.com', '$2y$10$Z4gF.D4K.2ABLD65b/EW7.OZlXhaZX.kRUtcGQW7uSlAu3wQzNe7u', 'brayan', 'rosales', '2024-09-08', '2024-09-08 19:35:48', '2024-09-08 19:35:48', 0, 'ROL-1725731031', 'por implementar la ruta', '12345678', 'la victoria'),
(3, 'USUARIO-1725346812', 'ceasar', 'ceasar@una.com', '$2y$10$KCTHUuHmfwzr/tTQi4z61uk1lsCC/wrBYfwtjmv7dxQR3qQ8r16ru', 'ceasar', 'calvo', '2024-09-03', '2024-09-08 19:53:52', '2024-09-08 19:53:52', 0, 'ROL-1725346368', 'por implementar la ruta', '12345678', 'hola patrik'),
(4, 'USUARIO-1725340493', 'admin', 'admin@una.com', '$2y$10$Se6CWVfCf6A8O6wN4nM4W.o8EM/aUbqRlhUaXtjjyO4lFUTsDnivC', 'admin', 'admin', '2024-09-02', '2024-09-09 04:40:09', '2024-09-09 04:40:09', 0, 'ROL-1725306023', 'por implementar la ruta', '12345678', ''),
(1, 'USUARIO-1725946200', 'admin', 'admin@una.com', '$2y$10$7/CCxkEL2qEMOU7d35D4M.XB1Ziv6v8aCnLuwon6NWz1WD8fWtD2W', 'admin', 'admin', '2024-09-09', '2024-09-09 23:30:00', '2024-09-09 23:30:00', 1, 'ROL-1725346390', 'por implementar la ruta', '12345678', 'usuario admin del sistema'),
(1, 'USUARIO-1725946246', 'Kendall', 'kendall@una.com', '$2y$10$zqbXkR7Aw4l.8qJbSUMeFue0bqkpFCKQVNTlQEOvayQS9/bM9hMm2', 'kendall', 'fallas mena', '2024-09-09', '2024-09-09 23:30:46', '2024-09-09 23:30:46', 1, 'ROL-1725346368', 'por implementar la ruta', '', ''),
(1, 'USUARIO-1725946299', 'ceasar', 'ceasar@una.com', '$2y$10$UBg8gXSo8D2CJlwcjfvlmu/1OWvlI8T6bmX.bYyIkhVT4B3LrhkYG', 'ceasar', 'calvo muñoz', '2024-09-09', '2024-09-09 23:31:39', '2024-09-09 23:31:39', 1, 'ROL-1725346368', 'por implementar la ruta', '', ''),
(1, 'USUARIO-1725946365', 'brayan', 'brayan@una.com', '$2y$10$wl2ifTd9EDH.hHjvnWxLAuZwYpaw.pU9cy1.t4tXqzW8fQkRmQBFm', 'brayan', 'rosales perez', '2024-09-09', '2024-09-09 23:32:45', '2024-09-09 23:32:45', 1, 'ROL-1725346368', 'por implementar la ruta', '', '');

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

--
-- Volcado de datos para la tabla `tbventa`
--

INSERT INTO `tbventa` (`tbventaid`, `tbventaidentificador`, `tbventausuarioidentificador`, `tbventafechacreacion`, `tbventafechamodificacion`, `tbventaestado`) VALUES
(1, 'VTN-1725378088', 'USUARIO-1725340493', '2024-09-03 17:41:28', '2024-09-03 17:41:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventalote`
--

CREATE TABLE IF NOT EXISTS `tbventalote` (
  `tbventaloteid` int(11) NOT NULL,
  `tbventadentificador` mediumtext NOT NULL,
  `tbidentificadorlote` mediumtext NOT NULL,
  `tbventalotecantidadvendida` int(11) NOT NULL,
  `tbventalotefechacreacion` datetime NOT NULL,
  `tbventalotefechamodificacion` datetime NOT NULL,
  `tbventaloteestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbventalote`
--

INSERT INTO `tbventalote` (`tbventaloteid`, `tbventadentificador`, `tbidentificadorlote`, `tbventalotecantidadvendida`, `tbventalotefechacreacion`, `tbventalotefechamodificacion`, `tbventaloteestado`) VALUES
(1, 'VTN-1725378088', 'LOTE-1725324427', 1, '2024-09-03 17:41:28', '2024-09-03 17:41:28', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
