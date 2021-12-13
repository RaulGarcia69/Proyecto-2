-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2021 a las 20:10:21
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_restaurante_PR2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesa`
--

CREATE TABLE `tbl_mesa` (
  `id_mes` int(11) NOT NULL,
  `status_mes` enum('Libre','Mantenimiento','Ocupado/Reservado') NOT NULL,
  `capacidad_mes` int(3) NOT NULL,
  `id_sal_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_mesa`
--

INSERT INTO `tbl_mesa` (`id_mes`, `status_mes`, `capacidad_mes`, `id_sal_fk`) VALUES
(1, 'Libre', 2, 1),
(2, 'Libre', 2, 1),
(3, 'Libre', 2, 1),
(4, 'Libre', 2, 1),
(5, 'Libre', 2, 1),
(6, 'Libre', 2, 1),
(7, 'Libre', 2, 1),
(8, 'Libre', 2, 1),
(9, 'Libre', 2, 1),
(10, 'Libre', 2, 1),
(11, 'Libre', 2, 1),
(12, 'Libre', 2, 1),
(13, 'Libre', 4, 1),
(14, 'Libre', 4, 1),
(15, 'Libre', 2, 2),
(16, 'Libre', 2, 2),
(17, 'Libre', 2, 2),
(18, 'Libre', 2, 2),
(19, 'Libre', 4, 2),
(20, 'Libre', 4, 2),
(21, 'Libre', 4, 2),
(22, 'Libre', 4, 2),
(23, 'Libre', 6, 2),
(24, 'Libre', 6, 2),
(25, 'Libre', 6, 2),
(26, 'Libre', 10, 2),
(27, 'Libre', 2, 3),
(28, 'Libre', 2, 3),
(29, 'Libre', 4, 3),
(30, 'Libre', 4, 3),
(31, 'Libre', 4, 3),
(32, 'Libre', 4, 3),
(33, 'Libre', 4, 3),
(34, 'Libre', 4, 3),
(35, 'Libre', 2, 4),
(36, 'Libre', 2, 4),
(37, 'Libre', 4, 4),
(38, 'Libre', 4, 4),
(39, 'Libre', 4, 4),
(40, 'Libre', 6, 4),
(41, 'Libre', 6, 4),
(42, 'Libre', 2, 5),
(43, 'Libre', 2, 5),
(44, 'Ocupado/Reservado', 4, 5),
(45, 'Libre', 4, 5),
(46, 'Libre', 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `id_res` int(11) NOT NULL,
  `horaIni_res` datetime NOT NULL,
  `horaFin_res` datetime DEFAULT NULL,
  `datos_res` varchar(30) NOT NULL,
  `id_use_fk` int(11) NOT NULL,
  `id_mes_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`id_res`, `horaIni_res`, `horaFin_res`, `datos_res`, `id_use_fk`, `id_mes_fk`) VALUES
(1, '2021-11-05 19:10:41', '2021-11-05 17:37:26', 'Loko', 2, 2),
(3, '2021-11-05 17:04:34', '2021-11-05 17:30:02', 'Starkiller', 2, 8),
(17, '2021-11-09 17:12:52', '2021-11-09 21:49:21', 'Halfonso', 1, 7),
(18, '2021-11-09 17:13:40', '2021-12-09 18:33:57', 'QWERTY', 1, 43),
(19, '2021-11-09 17:20:45', '2021-11-09 21:49:04', 'Raul69', 1, 16),
(20, '2021-11-09 21:47:48', '2021-11-09 21:48:30', 'Su madre', 1, 37),
(21, '2021-11-10 10:28:51', '2021-11-10 10:29:05', 'Vegetta', 1, 3),
(22, '2021-11-10 10:29:57', NULL, 'Alberto el del', 1, 20),
(23, '2021-11-10 15:57:25', NULL, 'Raul69420', 1, 14),
(24, '2021-12-09 18:35:30', NULL, 'Solana', 1, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sala`
--

CREATE TABLE `tbl_sala` (
  `id_sal` int(11) NOT NULL,
  `nombre_sal` varchar(50) DEFAULT NULL,
  `capacidad_sal` int(3) DEFAULT NULL,
  `imagen_sal` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_sala`
--

INSERT INTO `tbl_sala` (`id_sal`, `nombre_sal`, `capacidad_sal`, `imagen_sal`) VALUES
(1, 'Sala romance', 32, 'heart-dynamic-color.png'),
(2, 'Salón Sol', 52, 'sun-dynamic-color.png'),
(3, 'Sala gourmet', 28, 'glass-dynamic-color.png'),
(4, 'Terraza Luna', 28, 'moon-dynamic-clay.png'),
(5, 'Terraza estrellas', 16, 'star-dynamic-color.png'),
(6, 'Sala Teatral', 32, 'theatre.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_use` int(11) NOT NULL,
  `nombre_use` varchar(45) DEFAULT NULL,
  `email_use` varchar(50) NOT NULL,
  `pwd_use` varchar(50) NOT NULL,
  `tipo_use` enum('Camarero','Admin','Mantenimiento') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_use`, `nombre_use`, `email_use`, `pwd_use`, `tipo_use`) VALUES
(1, 'Alfredo', 'blumal@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero'),
(2, 'Isaac', 'isaac@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero'),
(3, 'Raul', 'raulseleccion@fje.edu', '1fa3356b1eb65f144a367ff8560cb406', 'Camarero'),
(4, 'vegetta69', 'vegetta69@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Mantenimiento'),
(5, 'Camarero1', 'camarero1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero'),
(6, 'Camarero2', 'camarero2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero'),
(7, 'Camarero3', 'camarero3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero'),
(8, 'Admin1', 'admin1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(9, 'Admin2', 'admin2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(10, 'Admin3', 'admin3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(11, 'Admin4', 'admin4@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(12, 'Admin5', 'admin5@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(13, 'admin6', 'admin6@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(14, 'Alex', 'alexadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(15, 'alan', 'alan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD PRIMARY KEY (`id_mes`),
  ADD KEY `fk_sala_mesa_idx` (`id_sal_fk`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`id_res`),
  ADD KEY `fk_mesa_reserva_idx` (`id_mes_fk`),
  ADD KEY `fk_usuario_reserva_idx` (`id_use_fk`);

--
-- Indices de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD PRIMARY KEY (`id_sal`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_use`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `id_res` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  MODIFY `id_sal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_use` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD CONSTRAINT `fk_sala_mesa` FOREIGN KEY (`id_sal_fk`) REFERENCES `tbl_sala` (`id_sal`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
