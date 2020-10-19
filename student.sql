-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-10-2020 a las 22:04:38
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `student`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_info`
--

CREATE TABLE IF NOT EXISTS `student_info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `roll` int(6) NOT NULL,
  `class` varchar(7) NOT NULL,
  `city` varchar(15) NOT NULL,
  `pcontact` varchar(11) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roll` (`roll`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `student_info`
--

INSERT INTO `student_info` (`id`, `name`, `roll`, `class`, `city`, `pcontact`, `photo`, `datetime`) VALUES
(49, 'Rafael Castro', 234110, 'Segundo', 'Calle 78 N 19 1', '3145648712', '2341102020-08-14-08-13.png', '2020-08-14 20:38:13'),
(50, 'Julia Barón', 234111, 'Tercero', 'Calle 20 N 17 8', '3215468719', '2341112020-08-14-08-27.jpg', '2020-08-14 22:19:16'),
(51, 'Natalia Cardona', 234112, 'Cuarto', 'Carrera 54 N 12', '3015824671', '2341122020-08-14-08-22.png', '2020-08-15 00:54:22'),
(52, 'Sofia Tamayo', 234113, 'Quinto', 'Carrera 55 N 97', '3147894512', '2341132020-08-14-08-22.png', '2020-08-15 02:51:22'),
(53, 'Pepito', 123456, 'Primero', 'BogotÃ¡', '3157185146', '1234562020-10-19-10-02.jpeg', '2020-10-19 20:36:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `photo`, `status`, `datetime`) VALUES
(21, 'Miguelosorionaranjo', 'miguelosorionaranjo@gmail.com', 'configuroweb', 'c42a54b24089898a208cd520efa47bf79141330d', 'configuroweb23-08-20-08-2020avatar1.png', 'activo', '2020-08-14 20:00:09'),
(22, 'usuario', 'usuario@cweb.com', 'usuario1', 'c42a54b24089898a208cd520efa47bf79141330d', 'usuario1.jpg', 'inactivo', '2020-08-14 21:32:36'),
(23, 'Miguel', 'miguelosorionaranjo@gmail.com', 'miguelosorio', 'bdc3c9de6ebd26a84506979469bd15f119c994c4', 'miguelosorio.jpeg', 'activo', '2020-10-19 20:27:10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
