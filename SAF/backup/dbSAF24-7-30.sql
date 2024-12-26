-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2024 a las 06:04:50
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
-- Base de datos: `bdfacturacion`
--
CREATE DATABASE IF NOT EXISTS `bdfacturacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bdfacturacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimpuesto`
--

CREATE TABLE `tbimpuesto` (
  `tbimpuestoid` int(11) NOT NULL,
  `tbimpuestonombre` varchar(100) NOT NULL,
  `tbimpuestovalor` decimal(10,2) NOT NULL,
  `tbimpuestovigencia` date NOT NULL,
  `tbimpuestoestado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbimpuesto`
--

INSERT INTO `tbimpuesto` (`tbimpuestoid`, `tbimpuestonombre`, `tbimpuestovalor`, `tbimpuestovigencia`, `tbimpuestoestado`) VALUES
(1, 'kendall', 1.00, '2024-07-30', 0),
(2, 'laravel', 3.00, '2024-07-03', 0),
(3, 'test', 33.00, '2024-07-30', 1),
(4, 'Prueba5', 12.00, '2024-07-31', 1),
(5, 'Prueba9', 70.00, '2024-08-03', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
