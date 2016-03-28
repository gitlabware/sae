-- phpMyAdmin SQL Dump
-- version 4.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2015 at 04:06 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sae`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambienteconceptos`
--

CREATE TABLE IF NOT EXISTS `ambienteconceptos` (
  `id` int(11) NOT NULL,
  `ambiente_id` int(11) NOT NULL,
  `concepto_id` int(11) NOT NULL,
  `monto` decimal(12,5) NOT NULL DEFAULT '0.00000',
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ambienteconceptos`
--

INSERT INTO `ambienteconceptos` (`id`, `ambiente_id`, `concepto_id`, `monto`, `created`, `modified`) VALUES
(1, 39, 3, 56.39000, '2014-12-16', '2014-12-16'),
(2, 39, 4, 20.45000, '2014-12-16', '2014-12-16'),
(3, 40, 3, 56.39000, '2014-12-16', '2014-12-16'),
(4, 40, 4, 20.45000, '2014-12-16', '2014-12-16'),
(5, 41, 3, 56.39000, '2014-12-16', '2014-12-16'),
(7, 42, 3, 56.39000, '2014-12-16', '2014-12-16'),
(8, 42, 4, 20.45000, '2014-12-16', '2014-12-16'),
(9, 43, 3, 56.39000, '2014-12-16', '2014-12-16'),
(10, 43, 4, 20.45000, '2014-12-16', '2014-12-16'),
(11, 44, 3, 56.39000, '2014-12-16', '2014-12-16'),
(12, 44, 4, 20.45000, '2014-12-16', '2014-12-16'),
(13, 45, 3, 56.39000, '2014-12-16', '2014-12-16'),
(14, 45, 4, 20.45000, '2014-12-16', '2014-12-16'),
(15, 46, 3, 56.39000, '2014-12-16', '2014-12-16'),
(16, 46, 4, 20.45000, '2014-12-16', '2014-12-16'),
(17, 47, 3, 56.39000, '2014-12-16', '2014-12-16'),
(18, 47, 4, 20.45000, '2014-12-16', '2014-12-16'),
(19, 48, 3, 56.39000, '2014-12-16', '2014-12-16'),
(20, 48, 4, 20.45000, '2014-12-16', '2014-12-16'),
(21, 49, 3, 56.39000, '2014-12-16', '2014-12-16'),
(22, 49, 4, 20.45000, '2014-12-16', '2014-12-16'),
(23, 50, 3, 56.39000, '2014-12-16', '2014-12-16'),
(24, 50, 4, 20.45000, '2014-12-16', '2014-12-16'),
(25, 51, 3, 56.39000, '2014-12-16', '2014-12-16'),
(26, 51, 4, 20.45000, '2014-12-16', '2014-12-16'),
(27, 52, 3, 56.39000, '2014-12-16', '2014-12-16'),
(28, 52, 4, 20.45000, '2014-12-16', '2014-12-16'),
(29, 53, 3, 56.39000, '2014-12-16', '2014-12-16'),
(30, 53, 4, 20.45000, '2014-12-16', '2014-12-16'),
(31, 39, 5, 100.00000, '2014-12-16', '2014-12-16'),
(32, 41, 5, 80.00000, '2014-12-16', '2014-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `ambientes`
--

CREATE TABLE IF NOT EXISTS `ambientes` (
  `id` int(11) NOT NULL,
  `categoriasambiente_id` int(11) NOT NULL,
  `categoriaspago_id` int(11) DEFAULT NULL,
  `edificio_id` int(11) NOT NULL,
  `piso_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `area_util` decimal(15,2) NOT NULL DEFAULT '0.00',
  `area_comun` decimal(15,2) NOT NULL DEFAULT '0.00',
  `mantenimiento` decimal(15,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ambientes`
--

INSERT INTO `ambientes` (`id`, `categoriasambiente_id`, `categoriaspago_id`, `edificio_id`, `piso_id`, `nombre`, `area_util`, `area_comun`, `mantenimiento`, `user_id`, `descripcion`, `created`, `modified`) VALUES
(1, 1, 1, 1, 1, 'A1', 12.45, 15.00, 143.49, 12, '', '2014-12-13', '2014-12-13'),
(2, 2, 1, 2, 5, 'ee', 41.00, 20.36, 700.00, 16, '', '2014-12-13', '2014-12-14'),
(3, 1, NULL, 1, 1, 'A3', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(4, 1, NULL, 1, 1, 'A4', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(5, 1, NULL, 1, 1, 'A5', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(6, 1, NULL, 1, 1, 'A6', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(7, 1, NULL, 1, 2, 'A1', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(8, 1, NULL, 1, 2, 'A2', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(9, 1, NULL, 1, 2, 'A3', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(10, 1, NULL, 1, 2, 'A4', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(11, 1, NULL, 1, 2, 'A5', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(12, 1, NULL, 1, 2, 'A6', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(13, 1, NULL, 1, 3, 'A1', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(14, 1, NULL, 1, 3, 'A2', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(15, 1, NULL, 1, 3, 'A3', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(16, 1, NULL, 1, 3, 'A4', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(17, 1, NULL, 1, 3, 'A5', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(18, 1, NULL, 1, 3, 'A6', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(19, 1, NULL, 1, 4, 'A1', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(20, 1, NULL, 1, 4, 'A2', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(21, 1, NULL, 1, 4, 'A3', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(22, 1, NULL, 1, 4, 'A4', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(23, 1, NULL, 1, 4, 'A5', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(24, 1, NULL, 1, 4, 'A6', 12.45, 50.30, 258.57, NULL, '', '2014-12-13', '2014-12-13'),
(25, 2, 1, 2, 5, 'A1', 41.00, 20.36, 517.88, NULL, '', '2014-12-13', '2014-12-13'),
(26, 2, 1, 2, 5, 'A2', 41.00, 20.36, 517.88, NULL, '', '2014-12-13', '2014-12-13'),
(27, 2, 1, 2, 6, 'A1', 41.00, 20.36, 517.88, NULL, '', '2014-12-13', '2014-12-13'),
(28, 2, 1, 2, 6, 'A2', 41.00, 20.36, 517.88, 15, '', '2014-12-13', '2014-12-13'),
(29, 2, 1, 2, 7, 'A1', 41.00, 20.36, 517.88, NULL, '', '2014-12-13', '2014-12-13'),
(30, 2, 1, 2, 7, 'A2', 41.00, 20.36, 517.88, NULL, '', '2014-12-13', '2014-12-13'),
(31, 2, 1, 4, 12, 'A1', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(32, 2, 1, 4, 12, 'A2', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(33, 2, 1, 4, 13, 'A1', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(34, 2, 1, 4, 13, 'A2', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(35, 2, 1, 4, 14, 'A1', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(36, 2, 1, 4, 14, 'A2', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(37, 2, 1, 4, 15, 'A1', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(38, 2, 1, 4, 15, 'A2', 34.00, 23.36, 487.64, NULL, '', '2014-12-15', '2014-12-15'),
(39, 1, 1, 5, 16, 'A1', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(40, 1, 1, 5, 16, 'A2', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(41, 1, 1, 5, 16, 'A3', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(42, 1, 1, 5, 17, 'A1', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(43, 1, 1, 5, 17, 'A2', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(44, 1, 1, 5, 17, 'A3', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(45, 1, 1, 5, 18, 'A1', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(46, 1, 1, 5, 18, 'A2', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(47, 1, 1, 5, 18, 'A3', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(48, 1, 1, 5, 19, 'A1', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(49, 1, 1, 5, 19, 'A2', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(50, 1, 1, 5, 19, 'A3', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(51, 1, 1, 5, 20, 'A1', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(52, 1, 1, 5, 20, 'A2', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16'),
(53, 1, 1, 5, 20, 'A3', 34.00, 65.00, 376.74, NULL, '', '2014-12-16', '2014-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `categoriasambientes`
--

CREATE TABLE IF NOT EXISTS `categoriasambientes` (
  `id` int(11) NOT NULL,
  `edificio_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `constante` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoriasambientes`
--

INSERT INTO `categoriasambientes` (`id`, `edificio_id`, `nombre`, `descripcion`, `constante`, `created`, `modified`) VALUES
(1, NULL, 'Oficina', '', 3.26, '0000-00-00', '2014-12-12'),
(2, NULL, 'Almacen', 'adlm', 7.56, '2014-12-12', '2014-12-12'),
(4, 5, 'Oficina', 'Ambiente oficina', 12.36, '2014-12-17', '2014-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `categoriaspagos`
--

CREATE TABLE IF NOT EXISTS `categoriaspagos` (
  `id` int(11) NOT NULL,
  `edificio_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `constante` decimal(15,2) NOT NULL DEFAULT '0.00',
  `descripcion` varchar(500) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoriaspagos`
--

INSERT INTO `categoriaspagos` (`id`, `edificio_id`, `nombre`, `constante`, `descripcion`, `created`, `modified`) VALUES
(1, NULL, 'Propietario', 54.00, 'ninguno', '2014-12-12', '2014-12-12'),
(2, 5, 'Propietario', 8.00, '', '2014-12-17', '2014-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `conceptos`
--

CREATE TABLE IF NOT EXISTS `conceptos` (
  `id` int(11) NOT NULL,
  `edificio_id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conceptos`
--

INSERT INTO `conceptos` (`id`, `edificio_id`, `nombre`, `descripcion`, `created`, `modified`) VALUES
(1, 4, 'Agua', 'Servicio de agua', '2014-12-16', '2014-12-16'),
(2, 4, 'Agua', 'Servicio de agua', '2014-12-16', '2014-12-16'),
(3, 5, 'Luz', 'Servicio de luz', '2014-12-16', '2014-12-16'),
(4, 5, 'Agua', 'Servcicio de agua', '2014-12-16', '2014-12-16'),
(5, 5, 'Internet', 'servicio de internet', '2014-12-16', '2014-12-16'),
(6, 5, 'fsdtgds', 'gsdgdf', '2014-12-17', '2014-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `edificioconceptos`
--

CREATE TABLE IF NOT EXISTS `edificioconceptos` (
  `id` int(11) NOT NULL,
  `edificio_id` int(11) NOT NULL,
  `concepto_id` int(11) NOT NULL,
  `monto` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edificioconceptos`
--

INSERT INTO `edificioconceptos` (`id`, `edificio_id`, `concepto_id`, `monto`, `created`, `modified`) VALUES
(1, 4, 1, 25.69, '2014-12-16', '2014-12-16'),
(3, 4, 2, 45.36, '2014-12-16', '2014-12-16'),
(4, 5, 3, 56.39, '2014-12-16', '2014-12-16'),
(5, 5, 4, 20.45, '2014-12-16', '2014-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `edificios`
--

CREATE TABLE IF NOT EXISTS `edificios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefonos` varchar(30) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `ambientes` int(10) DEFAULT '0',
  `area_util` decimal(15,2) DEFAULT '0.00',
  `area_comun` decimal(15,2) DEFAULT '0.00',
  `categoriasambiente_id` int(11) DEFAULT NULL,
  `categoriaspago_id` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edificios`
--

INSERT INTO `edificios` (`id`, `nombre`, `direccion`, `telefonos`, `observaciones`, `ambientes`, `area_util`, `area_comun`, `categoriasambiente_id`, `categoriaspago_id`, `created`, `modified`) VALUES
(1, 'San Juan', 'CALLE QUE TE IMPORTA', '236558 - 415652', NULL, 6, 12.45, 50.30, 1, 1, '2014-12-13', '2014-12-13'),
(2, 'VICENTENARIO', 'calle 123', '236558 - 415652', NULL, 2, 41.00, 20.36, 2, 1, '2014-12-13', '2014-12-13'),
(3, 'Egipto', 'avenida siempre viva', '2586398', NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-15', '2014-12-15'),
(4, 'Nuevo Edificio', 'dnsakldnsa', '4365465363', NULL, 2, 34.00, 23.36, 2, 1, '2014-12-15', '2014-12-15'),
(5, 'GEOGEA', 'CALLE NO MEACRUEDO', '84546524', NULL, 3, 34.00, 65.00, 1, 1, '2014-12-16', '2014-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `inquilinos`
--

CREATE TABLE IF NOT EXISTS `inquilinos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ambiente_id` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquilinos`
--

INSERT INTO `inquilinos` (`id`, `user_id`, `ambiente_id`, `estado`, `created`, `modified`) VALUES
(1, 20, 2, 1, '2014-12-15', '2014-12-15'),
(2, 20, 2, 1, '2014-12-15', '2014-12-15'),
(4, 20, 2, 0, '2014-12-15', '2014-12-15'),
(5, 20, 2, 1, '2014-12-15', '2014-12-15'),
(6, 20, 2, 0, '2014-12-15', '2014-12-15'),
(7, 20, 2, 1, '2014-12-15', '2014-12-15'),
(8, 21, 2, 1, '2014-12-15', '2014-12-15'),
(9, 20, 2, 1, '2014-12-15', '2014-12-15'),
(10, 22, 2, 1, '2014-12-15', '2014-12-15'),
(11, 22, 2, 0, '2014-12-15', '2014-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `pisos`
--

CREATE TABLE IF NOT EXISTS `pisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `edificio_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pisos`
--

INSERT INTO `pisos` (`id`, `nombre`, `edificio_id`, `created`, `modified`) VALUES
(1, 'P1', 1, '2014-12-13', '2014-12-13'),
(2, 'P2', 1, '2014-12-13', '2014-12-13'),
(3, 'P3', 1, '2014-12-13', '2014-12-13'),
(4, 'P4', 1, '2014-12-13', '2014-12-13'),
(5, 'P1', 2, '2014-12-13', '2014-12-13'),
(6, 'P2', 2, '2014-12-13', '2014-12-13'),
(7, 'P3', 2, '2014-12-13', '2014-12-13'),
(8, 'P1', 3, '2014-12-15', '2014-12-15'),
(9, 'P2', 3, '2014-12-15', '2014-12-15'),
(10, 'P3', 3, '2014-12-15', '2014-12-15'),
(11, 'P4', 3, '2014-12-15', '2014-12-15'),
(12, 'P1', 4, '2014-12-15', '2014-12-15'),
(13, 'P2', 4, '2014-12-15', '2014-12-15'),
(14, 'P3', 4, '2014-12-15', '2014-12-15'),
(15, 'P4', 4, '2014-12-15', '2014-12-15'),
(16, 'P1', 5, '2014-12-16', '2014-12-16'),
(17, 'P2', 5, '2014-12-16', '2014-12-16'),
(18, 'P3', 5, '2014-12-16', '2014-12-16'),
(19, 'P4', 5, '2014-12-16', '2014-12-16'),
(20, 'P5', 5, '2014-12-16', '2014-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `telefonos` varchar(35) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `role` varchar(25) NOT NULL,
  `edificio_id` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `telefonos`, `direccion`, `email`, `username`, `password`, `role`, `edificio_id`, `created`, `modified`) VALUES
(1, 'Eynar David Torrez Torrez', NULL, NULL, NULL, 'david', '75243a8479c48805b079c6d16b1e301de17c4dfc', 'Super Administrador', NULL, '2014-12-08', '2014-12-17'),
(3, 'Administrador', NULL, NULL, NULL, 'admin', 'dd18e28f27bc943617ef9366036a0d', 'Super Administrador', 4, '2014-12-08', '2014-12-16'),
(9, 'Handel', '556', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(8, 'Pablo Marmol', '555555', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(10, 'Osmar', '222222', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(11, 'dddd', '431212', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(12, 'Pedro', '5222525', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(13, 'Miguwss', '11551', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(14, 'David Fernandez', '255565 -555555', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(15, 'Angelo', '55556324', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-13', '2014-12-13'),
(16, 'Alberto rios', '22222222', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-14', '2014-12-14'),
(17, 'Juansito Pinolis', '22222663', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-15', '2014-12-15'),
(18, 'sssss', '432423432', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-15', '2014-12-15'),
(19, 'NJKDASNDJKJ', '584656', '', '', NULL, NULL, 'Propietario', NULL, '2014-12-15', '2014-12-15'),
(20, 'Jose Lopez', '6632554', '52', '', NULL, NULL, 'Inquilino', NULL, '2014-12-15', '2014-12-15'),
(21, 'Ernesto Cabrera', '704562145', 'xxxxx', 'ssss@nose.com', NULL, NULL, 'Inquilino', NULL, '2014-12-15', '2014-12-15'),
(22, 'hrgf', '543643', '', '', NULL, NULL, 'Inquilino', NULL, '2014-12-15', '2014-12-15'),
(23, 'hernan', '21654165', 'dsadsa', 'fazdsdsa', 'herly', '75243a8479c48805b079c6d16b1e301de17c4dfc', 'Administrador', 4, '2014-12-16', '2014-12-16'),
(24, 'csdsad', 'dsadsad', 'dasdasd', 'dasdasd', 'root', '99949034e9d64e82bf4c2e24a49f693c500879ff', 'Administrador', NULL, '2014-12-16', '2014-12-16'),
(25, 'ddasdsa', 'trdg', 'fgrdfht', 'ffdsfds', NULL, NULL, 'Propietario', NULL, '2014-12-16', '2014-12-16'),
(26, 'Alan', '85654452', 'xxxxxxxxx', 'asnhdjasnj', 'alan', '75243a8479c48805b079c6d16b1e301de17c4dfc', 'Administrador', 5, '2014-12-17', '2014-12-17'),
(27, 'cristiamherrera', NULL, NULL, NULL, 'cristiamherrera', '75243a8479c48805b079c6d16b1e301de17c4dfc', 'Super Administrador', NULL, '2015-01-02', '2015-01-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambienteconceptos`
--
ALTER TABLE `ambienteconceptos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ambientes`
--
ALTER TABLE `ambientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoriasambientes`
--
ALTER TABLE `categoriasambientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoriaspagos`
--
ALTER TABLE `categoriaspagos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edificioconceptos`
--
ALTER TABLE `edificioconceptos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edificios`
--
ALTER TABLE `edificios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquilinos`
--
ALTER TABLE `inquilinos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambienteconceptos`
--
ALTER TABLE `ambienteconceptos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `ambientes`
--
ALTER TABLE `ambientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `categoriasambientes`
--
ALTER TABLE `categoriasambientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categoriaspagos`
--
ALTER TABLE `categoriaspagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `edificioconceptos`
--
ALTER TABLE `edificioconceptos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `edificios`
--
ALTER TABLE `edificios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `inquilinos`
--
ALTER TABLE `inquilinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pisos`
--
ALTER TABLE `pisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
