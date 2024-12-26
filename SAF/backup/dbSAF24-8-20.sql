-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2024 a las 06:23:07
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdfacturacion`
--
CREATE DATABASE IF NOT EXISTS `bdfacturacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bdfacturacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcanton`
--

DROP TABLE IF EXISTS `tbcanton`;
CREATE TABLE `tbcanton` (
  `tbcantonid` int(11) NOT NULL,
  `tbprovinciaid` int(11) NOT NULL,
  `tbcantonidentificador` mediumtext NOT NULL,
  `tbcantonnombre` mediumtext NOT NULL,
  `tbcantonfechacreacion` date NOT NULL,
  `tbcantonfechamodificacion` date NOT NULL,
  `tbcantonestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `tbcorreoproveedor`
--

DROP TABLE IF EXISTS `tbcorreoproveedor`;
CREATE TABLE `tbcorreoproveedor` (
  `tbcorreoproveedorid` int(11) NOT NULL,
  `tbcorreoproveedoridentifier` mediumtext NOT NULL,
  `tbcorreoproveedoridSupplier` int(11) NOT NULL,
  `tbcorreoproveedoremail` mediumtext NOT NULL,
  `tbcorreoproveedorcreatedAt` date NOT NULL,
  `tbcorreoproveedormodifiedAt` date NOT NULL,
  `tbcorreoproveedorstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbcorreoproveedor`
--

INSERT INTO `tbcorreoproveedor` (`tbcorreoproveedorid`, `tbcorreoproveedoridentifier`, `tbcorreoproveedoridSupplier`, `tbcorreoproveedoremail`, `tbcorreoproveedorcreatedAt`, `tbcorreoproveedormodifiedAt`, `tbcorreoproveedorstatus`) VALUES
(1, 'EMA-SUP-suli@gmail.com-2024-08-1302:09:34', 1, 'suli@gmail.com', '2024-08-13', '2024-08-13', 1),
(2, 'EMA-SUP-sardimar@gmail.com-2024-08-1302:10:18', 2, 'sardimar@gmail.com', '2024-08-13', '2024-08-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdetallesdecompra`
--

DROP TABLE IF EXISTS `tbdetallesdecompra`;
CREATE TABLE `tbdetallesdecompra` (
  `tbdetallesdecompraid` int(11) DEFAULT NULL,
  `tbdetallesdecompraidentificador` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tbdetallesdecompracompra_id` int(11) DEFAULT NULL,
  `tbdetallesdecompraproducto_id` int(11) DEFAULT NULL,
  `tbdetallesdecompralote_id` int(11) DEFAULT NULL,
  `tbdetallesdecompracantidadUnidades` int(11) DEFAULT NULL,
  `tbdetallesdecomprafecha_creacion` datetime DEFAULT NULL,
  `tbdetallesdecomprafecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdireccionproveedor`
--

DROP TABLE IF EXISTS `tbdireccionproveedor`;
CREATE TABLE `tbdireccionproveedor` (
  `tbdireccionproveedorid` int(11) NOT NULL,
  `tbdireccionproveedoridentificador` mediumtext NOT NULL,
  `tbproveedorid` int(11) NOT NULL,
  `tbdistritoid` int(11) NOT NULL,
  `tbdireccionporsenha` mediumtext NOT NULL,
  `tbdireccionproveedorfechacreacion` date NOT NULL,
  `tbdireccionproveedorfechamodificacion` date NOT NULL,
  `tbdireccionproveedorestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbdireccionproveedor`
--

INSERT INTO `tbdireccionproveedor` (`tbdireccionproveedorid`, `tbdireccionproveedoridentificador`, `tbproveedorid`, `tbdistritoid`, `tbdireccionporsenha`, `tbdireccionproveedorfechacreacion`, `tbdireccionproveedorfechamodificacion`, `tbdireccionproveedorestado`) VALUES
(1, 'DIREC-SUP-20302-2024-08-1302:09:34', 1, 26, 'Del palo de mango 300mts', '2024-08-13', '2024-08-13', 1),
(2, 'DIREC-SUP-20505-2024-08-1302:10:18', 2, 12, '25mts sur de pali', '2024-08-13', '2024-08-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdistrito`
--

DROP TABLE IF EXISTS `tbdistrito`;
CREATE TABLE `tbdistrito` (
  `tbdistritoid` int(11) NOT NULL,
  `tbcantonid` int(11) NOT NULL,
  `tbdistritoidentificador` mediumtext NOT NULL,
  `tbdistritonombre` mediumtext NOT NULL,
  `tbdistritofechacreacion` date NOT NULL,
  `tbdistritofechamodificacion` date NOT NULL,
  `tbdistritoestado` tinyint(1) NOT NULL,
  `tbdistritodetalle` mediumtext NOT NULL,
  `tbcodigopostal` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `tbimpuesto`;
CREATE TABLE `tbimpuesto` (
  `tbimpuestoid` int(11) NOT NULL,
  `tbimpuestonombre` varchar(535) NOT NULL,
  `tbimpuestodescripcion` varchar(535) DEFAULT NULL,
  `tbimpuestovalor` decimal(10,2) NOT NULL,
  `tbimpuestovigencia` date NOT NULL,
  `tbimpuestoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbimpuesto`
--

INSERT INTO `tbimpuesto` (`tbimpuestoid`, `tbimpuestonombre`, `tbimpuestodescripcion`, `tbimpuestovalor`, `tbimpuestovigencia`, `tbimpuestoestado`) VALUES
(1, 'IVA', 'Primer impuesto', 16.00, '2024-08-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpais`
--

DROP TABLE IF EXISTS `tbpais`;
CREATE TABLE `tbpais` (
  `tbpaisid` int(11) NOT NULL,
  `tbpaisidentificador` mediumtext NOT NULL,
  `tbpaisnombre` mediumtext NOT NULL,
  `tbpaisfechacreacion` date NOT NULL,
  `tbpaisfechamodificacion` date NOT NULL,
  `tbpaisestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbpais`
--

INSERT INTO `tbpais` (`tbpaisid`, `tbpaisidentificador`, `tbpaisnombre`, `tbpaisfechacreacion`, `tbpaisfechamodificacion`, `tbpaisestado`) VALUES
(1, 'CRC-019', 'Costa Rica', '2024-08-02', '2024-08-02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpresentacion`
--

DROP TABLE IF EXISTS `tbpresentacion`;
CREATE TABLE `tbpresentacion` (
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
(1, '1723528386', 'Bolsa', 'Una bolsa plástica pequeña', '2024-08-13', '2024-08-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductos`
--

DROP TABLE IF EXISTS `tbproductos`;
CREATE TABLE `tbproductos` (
  `tbproductosid` int(11) DEFAULT NULL,
  `tbproductosidentificador` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tbproductosnombreproducto` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tbproductosdescripcionproducto` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tbproductoscategoria_id` int(11) DEFAULT NULL,
  `tbproductosunidadmedida_id` int(11) DEFAULT NULL,
  `tbproductospresentacion_id` int(11) DEFAULT NULL,
  `tbproductosfecha_creacion` datetime DEFAULT NULL,
  `tbproductosfecha_modificacion` datetime DEFAULT NULL,
  `tbproductosestado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedor`
--

DROP TABLE IF EXISTS `tbproveedor`;
CREATE TABLE `tbproveedor` (
  `tbsupplierid` int(11) NOT NULL,
  `tbsupplieridtipoproveedor` int(11) NOT NULL,
  `tbsupplieridentifier` mediumtext NOT NULL,
  `tbsuppliername` mediumtext NOT NULL,
  `tbsuppliercreatedat` date NOT NULL,
  `tbsuppliermodifiedat` date NOT NULL,
  `tbsupplierstatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbproveedor`
--

INSERT INTO `tbproveedor` (`tbsupplierid`, `tbsupplieridtipoproveedor`, `tbsupplieridentifier`, `tbsuppliername`, `tbsuppliercreatedat`, `tbsuppliermodifiedat`, `tbsupplierstatus`) VALUES
(1, 4, 'SUP-Suli-2024-08-1302:09:34', 'Suli', '2024-08-13', '2024-08-15', 1),
(2, 2, 'SUP-Sardimar-2024-08-1302:10:18', 'Sardimar', '2024-08-13', '2024-08-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprovincia`
--

DROP TABLE IF EXISTS `tbprovincia`;
CREATE TABLE `tbprovincia` (
  `tbprovinciaid` int(11) NOT NULL,
  `tbidpais` int(11) NOT NULL,
  `tbprovinciaidentificador` mediumtext NOT NULL,
  `tbprovincianombre` mediumtext NOT NULL,
  `tbprovinciafechacreacion` date NOT NULL,
  `tbprovinciafechamodificacion` date NOT NULL,
  `tbprovinciaestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `tbtelefono`
--

DROP TABLE IF EXISTS `tbtelefono`;
CREATE TABLE `tbtelefono` (
  `tbtelefonoid` int(11) DEFAULT NULL,
  `tbtelefonoidentificador` mediumtext DEFAULT NULL,
  `tbtelefonoidproveedor` int(11) DEFAULT NULL,
  `tbtelefonotelefono` mediumtext DEFAULT NULL,
  `tbtelefonocreadoen` date DEFAULT NULL,
  `tbtelefonomodificadoen` date DEFAULT NULL,
  `tbtelefonoestado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbtelefono`
--

INSERT INTO `tbtelefono` (`tbtelefonoid`, `tbtelefonoidentificador`, `tbtelefonoidproveedor`, `tbtelefonotelefono`, `tbtelefonocreadoen`, `tbtelefonomodificadoen`, `tbtelefonoestado`) VALUES
(1, 'CEL-SUP-99999912-2024-08-1302:09:34', 1, '99999912', '2024-08-13', '2024-08-15', 1),
(2, 'CEL-SUP-84842562-2024-08-1302:10:18', 2, '84842563', '2024-08-13', '2024-08-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoproveedor`
--

DROP TABLE IF EXISTS `tbtipoproveedor`;
CREATE TABLE `tbtipoproveedor` (
  `tbtipoproveedorid` int(11) NOT NULL,
  `tbtipoproveedoridentificador` varchar(255) NOT NULL,
  `tbtipoproveedornombre` varchar(255) NOT NULL,
  `tbtipoproveedorcreadoen` date NOT NULL,
  `tbtipoproveedormodificadoen` date NOT NULL,
  `tbtipoproveedorestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbtipoproveedor`
--

INSERT INTO `tbtipoproveedor` (`tbtipoproveedorid`, `tbtipoproveedoridentificador`, `tbtipoproveedornombre`, `tbtipoproveedorcreadoen`, `tbtipoproveedormodificadoen`, `tbtipoproveedorestado`) VALUES
(1, 'TYPE-SUP-Servicio-2024-05-0823:59:00', 'Servicio', '2024-05-08', '2024-05-08', 1),
(2, 'TYPE-SUP-Fabricante-2024-08-135:59:00', 'Fabricante', '2024-08-13', '2024-08-13', 1),
(3, 'TYPE-SUP-Distribuidor-2024-08-13 16:00:00', 'Distribuidor', '2024-08-13', '2024-08-13', 1),
(4, 'TYPE-SUP-Revendedor-2024-08-13 16:01:00', 'Revendedor', '2024-08-13', '2024-08-13', 1);
COMMIT;

DROP TABLE IF EXISTS `tbcategoria`;
CREATE TABLE `tbcategoria` (
  `tbcategoriaid` int(11) NOT NULL,
  `tbcategoriaidentificador` mediumtext NOT NULL,
  `tbcategorianombre` mediumtext NOT NULL,
  `tbcategoriadescripcion` mediumtext NOT NULL,
  `tbcategoriafechacreacion` date NOT NULL,
  `tbcategoriafechamodificacion` date NOT NULL,
  `tbcategoriaestado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbcategoria`
--

INSERT INTO `tbcategoria` (`tbcategoriaid`, `tbcategoriaidentificador`, `tbcategorianombre`, `tbcategoriadescripcion`, `tbcategoriafechacreacion`, `tbcategoriafechamodificacion`, `tbcategoriaestado`) VALUES
(1, 'CAT001', 'Frutas y Verduras', 'Productos frescos de frutas y verduras', '2024-08-18', '2024-08-18', 1),
(2, 'CAT002', 'Carnes', 'Cortes de carne, pollo, y pescado', '2024-08-18', '2024-08-18', 0),
(3, 'CAT003', 'Lácteos', 'Leche yogures y más', '2024-08-18', '2024-08-19', 1),
(4, 'CAT004', 'Panadería', 'Pan fresco, pasteles y productos horneados', '2024-08-18', '2024-08-18', 1),
(5, 'CAT005', 'Bebidas', 'Bebidas no alcohólicas y jugos', '2024-08-18', '2024-08-18', 1),
(6, 'CAT006', 'Congelados', 'Productos congelados y comidas preparadas', '2024-08-18', '2024-08-18', 1),
(7, 'CAT007', 'Cereales', 'Cereales, avena y productos integrales', '2024-08-18', '2024-08-18', 1),
(8, 'CAT008', 'Aseo y Limpieza', 'Productos de aseo personal y limpieza del hogar', '2024-08-18', '2024-08-18', 1),
(9, 'CAT009', 'Snacks', 'Botanas, dulces y galletas', '2024-08-18', '2024-08-18', 1),
(10, 'CAT010', 'Vinos y Licores', 'Bebidas alcohólicas, vinos y cervezas', '2024-08-18', '2024-08-18', 1);

DROP TABLE IF EXISTS `tbprovedorproducto`;
CREATE TABLE `tbprovedorproducto` (
  `tbprvedorproductoid` int(11) NOT NULL,
  `tbprvedorproductoidentificador` varchar(255) NOT NULL,
  `tbprvedorproductoidentificadorprovedor` varchar(255) NOT NULL,
  `tbprvedorproductoidentificadorproducto` varchar(255) NOT NULL,
  `tbprvedorproductofechamodificacion` datetime NOT NULL,
  `tbprvedorproductoultimacompra` datetime NOT NULL,
  `tbprvedorproductofechacreacion` datetime NOT NULL,
  `tbprvedorproductoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tbunidadmedida`;
CREATE TABLE `tbunidadmedida` (
  `id` int(11) NOT NULL,
  `identificador` varchar(255) NOT NULL,
  `nombreunidad` varchar(255) NOT NULL,
  `abreviatura` varchar(255) NOT NULL,
  `sistemamedida` varchar(255) DEFAULT NULL,
  `tipounidad` varchar(255) DEFAULT NULL,
  `fechacreacion` datetime NOT NULL,
  `fechamodificacion` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbunidadmedida`
--

INSERT INTO `tbunidadmedida` (`id`, `identificador`, `nombreunidad`, `abreviatura`, `sistemamedida`, `tipounidad`, `fechacreacion`, `fechamodificacion`, `estado`) VALUES
(2, 'metros1724124479', 'metros', 'MTS', 'kendall', '', '2024-08-19 21:27:59', '2024-08-19 21:33:48', 1),
(1, 'litros1724124837', 'litros', 'L', '', '', '2024-08-19 21:33:57', '2024-08-19 21:33:57', 1);

DROP TABLE IF EXISTS `tblote`;
CREATE TABLE `tblote` (
  `tbloteid` int(11) NOT NULL,
  `tbloteidentificador` varchar(255) NOT NULL,
  `tbproductoid` int(11) NOT NULL,
  `tblotecantidadadquirida` int(11) NOT NULL,
  `tblotecantidadactual` int(11) NOT NULL,
  `tblotepreciocompra` double NOT NULL,
  `tbloteprecioventa` double NOT NULL,
  `tblotefechaadquisicion` date NOT NULL,
  `tblotefechaexpiracion` date NOT NULL,
  `tblotefechacreacion` date NOT NULL,
  `tblotefechamodificacion` date NOT NULL,
  `tbloteestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblote`
--

INSERT INTO `tblote` (`tbloteid`, `tbloteidentificador`, `tbproductoid`, `tblotecantidadadquirida`, `tblotecantidadactual`, `tblotepreciocompra`, `tbloteprecioventa`, `tblotefechaadquisicion`, `tblotefechaexpiracion`, `tblotefechacreacion`, `tblotefechamodificacion`, `tbloteestado`) VALUES
(1, 'LOTE1', 1, 21, 21, 10000, 12000, '2024-08-18', '2024-08-27', '2024-08-19', '2024-08-19', 1),
(2, 'LOTE2', 1, 1, 1, 1, 1, '2024-08-19', '2024-08-15', '2024-08-19', '2024-08-15', 1);

DROP TABLE IF EXISTS `tbcompra`;
CREATE TABLE tbcompra (
  tbcompraid int(11) NOT NULL,
  tbcompraidentificador varchar(255) NOT NULL,
  tbcompraidproveedor int(11) NOT NULL,
  tbcompratotal double NOT NULL,
  tbcompranotas varchar(255) NOT NULL,
  tbcomprametodopago varchar(255) NOT NULL,
  tbcomprafecha date NOT NULL,
  tbcompracreadoen date NOT NULL,
  tbcompramodificadoen date NOT NULL,
  tbcompraestado tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbcompra (
  tbcompraid, 
  tbcompraidentificador,
  tbcompraidproveedor, 
  tbcompratotal, 
  tbcompranotas, 
  tbcomprametodopago, 
  tbcomprafecha, 
  tbcompracreadoen, 
  tbcompramodificadoen, 
  tbcompraestado
) VALUES
(1, 'BUY-2024-08-18 00:31:20', 1, 0, 'hola', 'Tarjeta', '2024-08-04', '2024-08-18', '2024-08-04', 1),
(2, 'BUY-2024-08-18 00:33:41', 1, 0, 'Patrick', 'E-wallet', '2024-08-05', '2024-08-18', '2024-08-05', 1),
(3, 'BUY-2024-08-18 02:00:16', 1, 0, 'Sequeira', 'Tarjeta', '2024-08-13', '2024-08-18', '2024-08-13', 1);



COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
