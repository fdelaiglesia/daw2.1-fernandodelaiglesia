-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2020 a las 13:12:28
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--
CREATE DATABASE IF NOT EXISTS `videoclub` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `videoclub`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `genero` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero`) VALUES
(1, 'Accion'),
(2, 'Drama'),
(4, 'Gangster'),
(5, 'Terror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

DROP TABLE IF EXISTS `pelicula`;
CREATE TABLE IF NOT EXISTS `pelicula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `director` varchar(60) NOT NULL,
  `anyo` int(11) NOT NULL,
  `valoracion` double NOT NULL,
  `genero` int(11) NOT NULL,
  `portada` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `DIRECTOR` (`director`),
  KEY `genero` (`genero`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `director`, `anyo`, `valoracion`, `genero`, `portada`) VALUES
(1, 'Cadena perpetua', 'Frank Darabont', 1994, 9.3, 2, 'https://i.pinimg.com/originals/91/43/00/914300fbd44d4ba83398229981c2c803.jpg'),
(2, 'El padrino', 'Francis Ford Coppola', 1972, 9.2, 4, 'https://vignette.wikia.nocookie.net/padrinos/images/3/3e/El_Padrino_Parte_1-Caratula.jpg/revision/latest?cb=20120405120844&path-prefix=es'),
(5, 'El padrino: Parte II', 'Francis Ford Coppola', 1974, 9, 4, 'https://i.pinimg.com/originals/c2/61/b6/c261b65c5b51dbd6ab5ce4dbdb7f0408.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) NOT NULL,
  `contrasenya` varchar(25) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `contrasenya`, `email`) VALUES
(1, 'admin', 'admin', 'admin@videoclub.com'),
(2, 'prueba', 'prueba', 'prueba@prueba.com'),
(3, 'a', 'a', 'a');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_ibfk_1` FOREIGN KEY (`genero`) REFERENCES `genero` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
