-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2017 a las 06:28:39
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `entrenar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores`
--

CREATE TABLE `indicadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `fecha_indicador` date NOT NULL,
  `semana` int(11) NOT NULL,
  `mes` date NOT NULL,
  `peso_inicial` double(8,2) NOT NULL,
  `peso_final` double(8,2) NOT NULL,
  `diferencia_peso_porcentual` double(8,2) NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `pse` int(11) NOT NULL,
  `sueno` int(11) NOT NULL,
  `dolor` int(11) NOT NULL,
  `deseo_entrenar` int(11) NOT NULL,
  `desayuno` int(11) NOT NULL,
  `sumatoria` int(11) NOT NULL,
  `pse_global_sesion` int(11) NOT NULL,
  `tiempo_entrenamiento` double(8,2) NOT NULL,
  `carga_entrenamiento` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `indicadores`
--

INSERT INTO `indicadores` (`id`, `cliente_id`, `fecha_indicador`, `semana`, `mes`, `peso_inicial`, `peso_final`, `diferencia_peso_porcentual`, `hora_entrada`, `hora_salida`, `pse`, `sueno`, `dolor`, `deseo_entrenar`, `desayuno`, `sumatoria`, `pse_global_sesion`, `tiempo_entrenamiento`, `carga_entrenamiento`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-09-09', 36, '2017-09-09', 80.00, 78.00, 2.50, '10:30:00', '12:00:00', 8, 7, 9, 4, 6, 34, 9, 90.00, 810, NULL, '2017-09-09 06:41:33', '2017-09-09 06:41:33'),
(2, 1, '2017-09-06', 36, '2017-09-06', 85.50, 79.00, 7.60, '11:30:00', '13:30:00', 8, 5, 4, 2, 3, 22, 7, 120.00, 840, NULL, '2017-09-09 06:42:08', '2017-09-09 06:42:08'),
(3, 1, '2017-10-01', 39, '2017-10-01', 78.00, 75.00, 3.85, '09:00:00', '10:25:00', 8, 9, 7, 5, 6, 35, 2, 85.00, 170, NULL, '2017-09-09 06:42:47', '2017-09-09 06:42:47'),
(4, 1, '2017-09-10', 36, '2017-09-01', 80.00, 80.00, 0.00, '21:43:00', '22:43:00', 3, 4, 5, 4, 3, 19, 2, 60.00, 120, NULL, '2017-09-11 02:46:15', '2017-09-11 02:46:15'),
(5, 1, '2017-09-12', 37, '2017-09-01', 81.00, 81.00, 0.00, '21:49:00', '22:49:00', 8, 7, 6, 5, 4, 30, 4, 60.00, 240, NULL, '2017-09-11 03:49:51', '2017-09-11 03:49:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicadores_cliente_id_foreign` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `indicadores_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
