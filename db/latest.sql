-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2024 a las 22:28:05
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
-- Base de datos: `tfg_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuario_1`
--

CREATE TABLE `archivos_usuario_1` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_usuario_1`
--

INSERT INTO `archivos_usuario_1` (`id`, `nombre_archivo`, `usuario_id`) VALUES
(9, 'index.html', NULL),
(10, 'login.html', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuario_2`
--

CREATE TABLE `archivos_usuario_2` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_usuario_2`
--

INSERT INTO `archivos_usuario_2` (`id`, `nombre_archivo`, `usuario_id`) VALUES
(3, 'alumno_registrado.html', NULL),
(4, 'alumno_registrado.html', NULL),
(5, 'circulo.js', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuario_3`
--

CREATE TABLE `archivos_usuario_3` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuario_4`
--

CREATE TABLE `archivos_usuario_4` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuario_8`
--

CREATE TABLE `archivos_usuario_8` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuario_10`
--

CREATE TABLE `archivos_usuario_10` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `almacenamiento` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `contrasena`, `telefono`, `almacenamiento`) VALUES
(1, 'Edwin', 'Bravo', 'eb@gmail.com', 'admin', '456', 472),
(2, 'lu', 'lu', 'lu@gmail.com', 'admin', '44', 271),
(3, 'Mario', 'Osuna Martínez', 'marioosunamartinez11@gmail.com', 'campusfp', '15656516', 502),
(4, '', '', '', '$2y$10$DlBk2vSAZGIXYaeQlaPwT.QGd1Cu8rq/c4sD/LikPFvERxB38T/Bq', '', 0),
(8, 'root', 'root', 'root@root.com', '$2y$10$1D.2xvxr3HGapR6Diqcemu3c53tCtrDRttqS1wkVoLvOLu6CFXS.m', 'root', 1),
(10, 'root', 'root', 'root@rot.com', '$2y$10$SAS.1VubV0ukpXj4dwSenOhpxjtfi5mdHpZv4gwVYDiJiGveA2hXK', 'root', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_usuario_1`
--
ALTER TABLE `archivos_usuario_1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `archivos_usuario_2`
--
ALTER TABLE `archivos_usuario_2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `archivos_usuario_3`
--
ALTER TABLE `archivos_usuario_3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `archivos_usuario_4`
--
ALTER TABLE `archivos_usuario_4`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `archivos_usuario_8`
--
ALTER TABLE `archivos_usuario_8`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `archivos_usuario_10`
--
ALTER TABLE `archivos_usuario_10`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_usuario_1`
--
ALTER TABLE `archivos_usuario_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `archivos_usuario_2`
--
ALTER TABLE `archivos_usuario_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `archivos_usuario_3`
--
ALTER TABLE `archivos_usuario_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_usuario_4`
--
ALTER TABLE `archivos_usuario_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_usuario_8`
--
ALTER TABLE `archivos_usuario_8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_usuario_10`
--
ALTER TABLE `archivos_usuario_10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_usuario_1`
--
ALTER TABLE `archivos_usuario_1`
  ADD CONSTRAINT `archivos_usuario_1_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `archivos_usuario_2`
--
ALTER TABLE `archivos_usuario_2`
  ADD CONSTRAINT `archivos_usuario_2_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `archivos_usuario_3`
--
ALTER TABLE `archivos_usuario_3`
  ADD CONSTRAINT `archivos_usuario_3_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `archivos_usuario_4`
--
ALTER TABLE `archivos_usuario_4`
  ADD CONSTRAINT `archivos_usuario_4_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `archivos_usuario_8`
--
ALTER TABLE `archivos_usuario_8`
  ADD CONSTRAINT `archivos_usuario_8_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `archivos_usuario_10`
--
ALTER TABLE `archivos_usuario_10`
  ADD CONSTRAINT `archivos_usuario_10_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
