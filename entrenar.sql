-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2017 a las 18:54:40
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Estructura de tabla para la tabla `antropometrias`
--

CREATE TABLE `antropometrias` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `fecha_antropometria` date NOT NULL,
  `peso_corporal` double(8,2) NOT NULL,
  `talla` double(8,2) NOT NULL,
  `porcentaje_adiposo` double(8,2) NOT NULL,
  `porcentaje_muscular` double(8,2) NOT NULL,
  `indice_endo` double(8,2) NOT NULL,
  `indice_meso` double(8,2) NOT NULL,
  `indice_hecto` double(8,2) NOT NULL,
  `clasificacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ideal` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `antropometrias`
--

INSERT INTO `antropometrias` (`id`, `cliente_id`, `fecha_antropometria`, `peso_corporal`, `talla`, `porcentaje_adiposo`, `porcentaje_muscular`, `indice_endo`, `indice_meso`, `indice_hecto`, `clasificacion`, `ideal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-09-09', 80.50, 73.30, 10.00, 10.60, 23.50, 25.60, 36.00, '10', 15.00, NULL, '2017-09-09 07:11:03', '2017-09-09 07:11:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sobrepeso', '2017-09-09 06:34:42', '2017-09-09 06:34:42', NULL),
(2, 'Vida Comun', '2017-09-09 06:34:45', '2017-09-09 06:34:45', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_ejercicios`
--

CREATE TABLE `categoria_ejercicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_ejercicios`
--

INSERT INTO `categoria_ejercicios` (`id`, `nombre`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Fuerza Tren Superior', NULL, '2017-09-09 06:36:12', '2017-09-09 06:36:12'),
(2, 'Fuerza Tren Inferior', NULL, '2017-09-09 06:36:15', '2017-09-09 06:36:15'),
(3, 'Velocidad', NULL, '2017-09-09 06:36:22', '2017-09-09 06:36:22'),
(4, 'Resistencia', NULL, '2017-09-09 06:36:27', '2017-09-09 06:36:27'),
(5, 'Saltos', NULL, '2017-09-09 06:36:33', '2017-09-09 06:36:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deporte_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `institucion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gym` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio_entrenamiento` date NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_control_id` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `dni`, `direccion`, `celular`, `email`, `deporte_id`, `categoria_id`, `institucion`, `gym`, `fecha_inicio_entrenamiento`, `foto`, `test_control_id`, `estado`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pablo', 'Rivera', '1989-01-21', '33753907', 'Urquiza', '3875124345', 'pablo@hotmail.com', 1, 2, 'Vicky', 'Vicky', '2017-01-01', 'images/perfiles/1.jpg', 0, 1, NULL, '2017-09-09 06:35:20', '2017-09-09 06:35:20'),
(2, 'Daniel', 'Vale', '1989-01-01', '35467894', 'Catamarca', '124567899', 'daniel@gmail.com', 1, 1, 'Vicky', 'Vickyyyy', '2017-01-01', 'images/perfiles/2.jpg', 0, 1, NULL, '2017-09-13 19:39:10', '2017-09-13 19:39:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_ejercicios`
--

CREATE TABLE `clientes_ejercicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `ejercicio_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_evaluaciones`
--

CREATE TABLE `clientes_evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `evaluaciones_id` int(10) UNSIGNED NOT NULL,
  `ejercicio_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_evaluaciones`
--

INSERT INTO `clientes_evaluaciones` (`id`, `cliente_id`, `evaluaciones_id`, `ejercicio_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 9, NULL, '2017-09-09 06:44:28', '2017-09-09 06:44:28'),
(2, 1, 2, 9, NULL, '2017-09-09 06:54:18', '2017-09-09 06:54:18'),
(3, 1, 3, 11, NULL, '2017-09-09 06:54:35', '2017-09-09 06:54:35'),
(4, 1, 4, 12, NULL, '2017-09-09 06:54:46', '2017-09-09 06:54:46'),
(5, 1, 5, 10, NULL, '2017-09-09 06:55:03', '2017-09-09 06:55:03'),
(6, 1, 6, 3, NULL, '2017-09-09 06:55:17', '2017-09-09 06:55:17'),
(7, 1, 7, 6, NULL, '2017-09-09 06:55:37', '2017-09-09 06:55:37'),
(8, 1, 8, 7, NULL, '2017-09-09 06:55:58', '2017-09-09 06:55:58'),
(9, 1, 9, 8, NULL, '2017-09-09 06:56:17', '2017-09-09 06:56:17'),
(10, 1, 10, 4, NULL, '2017-09-09 06:58:21', '2017-09-09 06:58:21'),
(11, 1, 11, 9, NULL, '2017-09-12 05:04:28', '2017-09-12 05:04:28'),
(12, 1, 12, 9, NULL, '2017-09-12 05:09:56', '2017-09-12 05:09:56'),
(13, 1, 13, 9, NULL, '2017-09-13 19:30:24', '2017-09-13 19:30:24'),
(14, 1, 14, 11, NULL, '2017-09-13 19:31:29', '2017-09-13 19:31:29'),
(15, 1, 15, 11, NULL, '2017-09-13 19:31:43', '2017-09-13 19:31:43'),
(16, 1, 16, 9, NULL, '2017-09-13 19:32:05', '2017-09-13 19:32:05'),
(17, 1, 17, 12, NULL, '2017-09-13 19:32:23', '2017-09-13 19:32:23'),
(18, 1, 18, 10, NULL, '2017-09-13 19:32:47', '2017-09-13 19:32:47'),
(19, 1, 19, 3, NULL, '2017-09-13 19:33:04', '2017-09-13 19:33:04'),
(20, 1, 20, 4, NULL, '2017-09-13 19:33:22', '2017-09-13 19:33:22'),
(21, 1, 21, 6, NULL, '2017-09-13 19:34:43', '2017-09-13 19:34:43'),
(22, 1, 22, 7, NULL, '2017-09-13 19:34:57', '2017-09-13 19:34:57'),
(23, 1, 23, 8, NULL, '2017-09-13 19:35:15', '2017-09-13 19:35:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_pagos`
--

CREATE TABLE `clientes_pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `pago_id` int(10) UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `mes_pago` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_pagos`
--

INSERT INTO `clientes_pagos` (`id`, `cliente_id`, `pago_id`, `fecha_pago`, `mes_pago`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10, 1, 1, '2017-09-12', '2017-09-01', NULL, '2017-09-12 06:25:25', '2017-09-12 06:25:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_series`
--

CREATE TABLE `clientes_series` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `serie_id` int(10) UNSIGNED NOT NULL,
  `ejercicio_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_series`
--

INSERT INTO `clientes_series` (`id`, `cliente_id`, `serie_id`, `ejercicio_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, NULL, '2017-09-09 07:12:40', '2017-09-09 07:12:40'),
(2, 1, 2, 5, NULL, '2017-09-09 07:12:40', '2017-09-09 07:12:40'),
(3, 1, 3, 2, NULL, '2017-09-09 07:24:08', '2017-09-09 07:24:08'),
(4, 1, 4, 2, NULL, '2017-09-09 07:24:08', '2017-09-09 07:24:08'),
(5, 1, 5, 5, NULL, '2017-09-11 04:47:04', '2017-09-11 04:47:04'),
(6, 1, 6, 5, NULL, '2017-09-11 04:47:04', '2017-09-11 04:47:04'),
(7, 1, 8, 5, NULL, '2017-09-11 05:11:38', '2017-09-11 05:11:38'),
(8, 1, 9, 2, NULL, '2017-09-11 05:47:03', '2017-09-11 05:47:03'),
(9, 1, 10, 2, NULL, '2017-09-11 05:47:04', '2017-09-11 05:47:04'),
(10, 1, 11, 2, NULL, '2017-09-11 05:56:19', '2017-09-11 05:56:19'),
(11, 1, 12, 2, NULL, '2017-09-11 05:56:19', '2017-09-11 05:56:19'),
(12, 1, 13, 5, NULL, '2017-09-11 06:15:45', '2017-09-11 06:15:45'),
(13, 1, 14, 5, NULL, '2017-09-11 06:15:45', '2017-09-11 06:15:45'),
(14, 1, 15, 5, NULL, '2017-09-12 05:23:51', '2017-09-12 05:23:51'),
(15, 1, 16, 5, NULL, '2017-09-12 05:23:51', '2017-09-12 05:23:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id`, `nombre`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Futbol', NULL, '2017-09-09 06:34:03', '2017-09-09 06:34:03'),
(2, 'Tenis', NULL, '2017-09-09 06:34:07', '2017-09-09 06:34:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categoria_ejercicios_id` int(10) UNSIGNED NOT NULL,
  `fuerza` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id`, `nombre`, `categoria_ejercicios_id`, `fuerza`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pechp', 1, 1, '2017-09-09 06:38:21', '2017-09-09 06:36:58', '2017-09-09 06:38:21'),
(2, 'Sentadilla', 2, 1, NULL, '2017-09-09 06:37:05', '2017-09-09 06:37:05'),
(3, 'Yoyo Test', 4, 0, NULL, '2017-09-09 06:37:27', '2017-09-09 06:37:27'),
(4, 'Salto Abalacob', 5, 0, NULL, '2017-09-09 06:37:59', '2017-09-09 06:37:59'),
(5, 'Pecho', 1, 1, NULL, '2017-09-09 06:38:31', '2017-09-09 06:38:31'),
(6, 'Salto cmj', 5, 0, NULL, '2017-09-09 06:38:58', '2017-09-09 06:38:58'),
(7, 'Salto sj', 5, 0, NULL, '2017-09-09 06:39:09', '2017-09-09 06:39:09'),
(8, 'Salto Continuo', 5, 0, NULL, '2017-09-09 06:39:22', '2017-09-09 06:39:22'),
(9, 'Peso Muerto', 1, 0, NULL, '2017-09-09 06:39:33', '2017-09-09 06:39:33'),
(10, 'Velocidad 10 mts', 3, 0, NULL, '2017-09-09 06:39:45', '2017-09-09 06:39:45'),
(11, 'Remo', 1, 0, NULL, '2017-09-09 06:39:54', '2017-09-09 06:39:54'),
(12, 'Sentadilla Bulgara ', 2, 0, NULL, '2017-09-09 06:40:04', '2017-09-09 06:40:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `maximo_peso` float DEFAULT NULL,
  `velocidad_segundos` float DEFAULT NULL,
  `salto_abalacob` float DEFAULT NULL,
  `salto_cmj` float DEFAULT NULL,
  `salto_sj` float DEFAULT NULL,
  `mejor_salto_continuo` float DEFAULT NULL,
  `peor_salto_continuo` float DEFAULT NULL,
  `cantidad_salto_continuo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resistencia_numero_fase` float DEFAULT NULL,
  `cantidad_repeticiones` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `velocidad_decimas` float DEFAULT NULL,
  `velocidad_centesimas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `maximo_peso`, `velocidad_segundos`, `salto_abalacob`, `salto_cmj`, `salto_sj`, `mejor_salto_continuo`, `peor_salto_continuo`, `cantidad_salto_continuo`, `resistencia_numero_fase`, `cantidad_repeticiones`, `deleted_at`, `created_at`, `updated_at`, `velocidad_decimas`, `velocidad_centesimas`) VALUES
(1, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:44:28', '2017-09-09 06:44:28', NULL, NULL),
(2, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:54:18', '2017-09-09 06:54:18', NULL, NULL),
(3, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:54:35', '2017-09-09 06:54:35', NULL, NULL),
(4, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2017-09-09 06:54:46', '2017-09-09 06:54:46', NULL, NULL),
(5, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:55:03', '2017-09-09 06:55:03', 3, 5),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, '2017-09-09 06:55:17', '2017-09-09 06:55:17', NULL, NULL),
(7, NULL, NULL, NULL, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:55:37', '2017-09-09 06:55:37', NULL, NULL),
(8, NULL, NULL, NULL, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:55:58', '2017-09-09 06:55:58', NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, 50, 30, '6', NULL, NULL, NULL, '2017-09-09 06:56:17', '2017-09-09 06:56:17', NULL, NULL),
(10, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-09 06:58:21', '2017-09-09 06:58:21', NULL, NULL),
(11, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-12 05:04:28', '2017-09-12 05:04:28', NULL, NULL),
(12, 33.4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-12 05:09:56', '2017-09-12 05:09:56', NULL, NULL),
(13, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:30:24', '2017-09-13 19:30:24', NULL, NULL),
(14, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:31:29', '2017-09-13 19:31:29', NULL, NULL),
(15, 90.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:31:43', '2017-09-13 19:31:43', NULL, NULL),
(16, 80.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:32:05', '2017-09-13 19:32:05', NULL, NULL),
(17, 50.6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2017-09-13 19:32:23', '2017-09-13 19:32:23', NULL, NULL),
(18, NULL, 10.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:32:47', '2017-09-13 19:32:47', 10.3, 10),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.6, NULL, NULL, '2017-09-13 19:33:04', '2017-09-13 19:33:04', NULL, NULL),
(20, NULL, NULL, 15.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:33:22', '2017-09-13 19:33:22', NULL, NULL),
(21, NULL, NULL, NULL, 12.3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:34:43', '2017-09-13 19:34:43', NULL, NULL),
(22, NULL, NULL, NULL, NULL, 30.6, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-13 19:34:57', '2017-09-13 19:34:57', NULL, NULL),
(23, NULL, NULL, NULL, NULL, NULL, 20.6, 15.6, '10.6', NULL, NULL, NULL, '2017-09-13 19:35:15', '2017-09-13 19:35:15', NULL, NULL);

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
(5, 1, '2017-10-12', 37, '2017-10-01', 81.00, 81.00, 0.00, '21:49:00', '22:49:00', 8, 7, 6, 5, 4, 30, 4, 60.00, 240, NULL, '2017-09-11 03:49:51', '2017-09-11 03:49:51'),
(6, 2, '2017-09-13', 37, '2017-09-01', 80.00, 78.00, 2.50, '13:39:00', '13:59:00', 8, 7, 9, 4, 5, 33, 6, 20.00, 120, NULL, '2017-09-13 19:39:35', '2017-09-13 19:39:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores_semanales`
--

CREATE TABLE `indicadores_semanales` (
  `id` int(10) UNSIGNED NOT NULL,
  `indicador_id` int(10) UNSIGNED NOT NULL,
  `carga_semanal` double(8,2) NOT NULL,
  `ds` double(8,2) NOT NULL,
  `indice_monotonia` double(8,2) NOT NULL,
  `impacto` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_04_28_231055_create_clientes_table', 1),
('2017_04_28_231548_create_deportes_table', 1),
('2017_04_28_231621_create_ejercicios_table', 1),
('2017_04_28_231653_create_series_table', 1),
('2017_04_28_232349_create_pagos_table', 1),
('2017_04_28_232618_create_indicadores_table', 1),
('2017_04_28_234941_create_indicadores_semanales_table', 1),
('2017_04_28_235357_create_clientes_pagos_table', 1),
('2017_04_28_235635_create_clientes_ejercicios_table', 1),
('2017_04_28_235942_create_clientes_series_table', 1),
('2017_04_29_001938_update_cliente_table_add_fk', 1),
('2017_04_29_045140_update_softdeletes_users_table', 1),
('2017_05_04_223809_update_indicadores_table_add_fk', 1),
('2017_06_25_004044_create_categorias_table', 1),
('2017_06_25_005219_update_clientes_table_categorias_add_fk', 1),
('2017_07_28_010715_add_cols_mejor_serie_ultima_serie_series_table', 1),
('2017_07_29_223732_create_categoria_ejercicios_table', 1),
('2017_07_29_224019_update_ejercicios_add_fk', 1),
('2017_07_31_141522_create_evaluaciones_table', 1),
('2017_07_31_153145_create_clientes_evaluaciones_table', 1),
('2017_07_31_153658_create_antropometrias_table', 1),
('2017_08_24_210125_update_evaluaciones_table_add_nullable_All_col', 1),
('2017_08_26_205619_update_table_series_add_col_mejor_serie_bool', 1),
('2017_08_28_021947_update_table_clientes_col_dni_unique', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `dias_semana` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `costo_mensual` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `dias_semana`, `grupo`, `costo_mensual`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 700, NULL, '2017-09-09 07:09:32', '2017-09-09 07:09:32'),
(2, 3, 1, 800, NULL, '2017-09-09 07:09:40', '2017-09-09 07:09:40'),
(3, 4, 1, 900, NULL, '2017-09-09 07:09:49', '2017-09-09 07:09:49'),
(4, 5, 1, 1000, NULL, '2017-09-09 07:09:57', '2017-09-09 07:09:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad_series` int(11) NOT NULL,
  `peso_corporal` float NOT NULL,
  `peso_externo` float NOT NULL,
  `masa` float NOT NULL,
  `potencia_impulsiva` float NOT NULL,
  `potencia_relativa` double(8,2) NOT NULL,
  `velocidad_impulsiva` float NOT NULL,
  `fuerza_impulsiva` float NOT NULL,
  `cantidad_repeticiones` int(11) NOT NULL,
  `mejor_serie` int(11) NOT NULL,
  `rm` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ultima_serie` tinyint(1) NOT NULL,
  `pse` int(11) NOT NULL,
  `rm_pse_porcentual` double NOT NULL,
  `rm_porcentual` double NOT NULL,
  `mejor_serie_boolean` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `cantidad_series`, `peso_corporal`, `peso_externo`, `masa`, `potencia_impulsiva`, `potencia_relativa`, `velocidad_impulsiva`, `fuerza_impulsiva`, `cantidad_repeticiones`, `mejor_serie`, `rm`, `deleted_at`, `created_at`, `updated_at`, `ultima_serie`, `pse`, `rm_pse_porcentual`, `rm_porcentual`, `mejor_serie_boolean`) VALUES
(1, 3, 81, 100, 181, 100, 1.24, 100, 100, 3, 0, 10.90, NULL, '2017-09-09 07:12:40', '2017-09-09 07:12:40', 0, 10, 92.993, 917.43119266055, 1),
(2, 3, 81, 60, 141, 60, 0.75, 60, 60, 1, 0, 2.98, NULL, '2017-09-09 07:12:40', '2017-09-09 07:12:40', 1, 6, 73.033, 3355.7046979866, NULL),
(3, 3, 80, 100, 180, 100, 1.25, 100, 100, 3, 1, 10.90, NULL, '2017-09-09 07:24:08', '2017-09-09 07:24:08', 0, 10, 92.993, 917.43119266055, 1),
(4, 3, 80, 80, 160, 80, 1.00, 80, 80, 2, 1, 6.28, NULL, '2017-09-09 07:24:08', '2017-09-09 07:24:08', 1, 9, 88.003, 1592.3566878981, NULL),
(5, 2, 82.5, 92.5, 175, 2, 0.02, 2, 2, 3, 1, 10.11, NULL, '2017-09-11 04:47:04', '2017-09-11 04:47:04', 0, 2, 53.073, 915.11673921646, 1),
(6, 2, 82.5, 92.5, 175, 2, 0.02, 2, 2, 3, 1, 10.11, NULL, '2017-09-11 04:47:04', '2017-09-11 04:47:04', 1, 2, 53.073, 915.11673921646, NULL),
(7, 1, 80, 80, 160, 105.3, 1.32, 106.3, 100, 3, 1, 105.30, NULL, '2017-09-11 04:51:35', '2017-09-11 04:51:35', 0, 3, 58.063, 75.973409306743, 1),
(8, 3, 80, 200, 280, 2, 0.02, 2, 2, 2, 1, 14.20, NULL, '2017-09-11 05:11:38', '2017-09-11 05:11:38', 0, 2, 53.073, 1408.4507042254, 1),
(9, 3, 80, 100, 180, 100, 1.25, 100, 100, 3, 0, 12.09, NULL, '2017-09-11 05:47:03', '2017-09-11 05:47:03', 0, 5, 68.043, 827.26671078756, 1),
(10, 3, 80, 112, 192, 105, 1.31, 100, 100, 3, 0, 12.09, NULL, '2017-09-11 05:47:04', '2017-09-11 05:47:04', 1, 5, 68.043, 827.26671078756, NULL),
(11, 3, 80, 100, 180, 100, 1.25, 100, 100, 2, 0, 10.90, NULL, '2017-09-11 05:56:19', '2017-09-11 05:56:19', 0, 3, 58.063, 917.43119266055, 1),
(12, 3, 80, 100, 180, 100, 1.25, 100, 100, 3, 0, 10.90, NULL, '2017-09-11 05:56:19', '2017-09-11 05:56:19', 1, 3, 58.063, 917.43119266055, NULL),
(13, 2, 80, 110, 190, 110, 1.38, 100, 100, 3, 1, 11.89, NULL, '2017-09-11 06:15:45', '2017-09-11 06:15:45', 0, 4, 63.053, 925.14718250631, 1),
(14, 2, 80, 110, 190, 110, 1.38, 100, 100, 3, 1, 11.89, NULL, '2017-09-11 06:15:45', '2017-09-11 06:15:45', 1, 4, 63.053, 925.14718250631, NULL),
(15, 4, 80, 100, 180, 10, 0.12, 10, 10.5, 3, 0, 10.90, NULL, '2017-09-12 05:23:51', '2017-09-12 05:23:51', 0, 1, 48.083, 917.43119266055, 1),
(16, 4, 80, 100, 180, 8, 0.10, 8, 8.3, 3, 0, 10.90, NULL, '2017-09-12 05:23:51', '2017-09-12 05:23:51', 1, 8, 83.013, 917.43119266055, NULL),
(17, 1, 80, 100, 180, 10, 0.12, 10, 10, 3, 1, 10.00, NULL, '2017-09-12 06:02:04', '2017-09-12 06:02:04', 0, 1, 48.083, 1000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Matias', 'matix_tkd@hotmail.com', '$2y$10$Q.TLMQ4YKjbGqeTkKL606e4hRUSPBfPreckRqlq7VvlJeS.CFTSn2', NULL, '2017-09-09 06:18:51', '2017-09-09 06:18:51', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antropometrias`
--
ALTER TABLE `antropometrias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antropometrias_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_ejercicios`
--
ALTER TABLE `categoria_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_dni_unique` (`dni`),
  ADD KEY `clientes_deporte_id_foreign` (`deporte_id`),
  ADD KEY `clientes_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `clientes_ejercicios`
--
ALTER TABLE `clientes_ejercicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_ejercicios_cliente_id_foreign` (`cliente_id`),
  ADD KEY `clientes_ejercicios_ejercicio_id_foreign` (`ejercicio_id`);

--
-- Indices de la tabla `clientes_evaluaciones`
--
ALTER TABLE `clientes_evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_evaluaciones_cliente_id_foreign` (`cliente_id`),
  ADD KEY `clientes_evaluaciones_evaluaciones_id_foreign` (`evaluaciones_id`),
  ADD KEY `clientes_evaluaciones_ejercicio_id_foreign` (`ejercicio_id`);

--
-- Indices de la tabla `clientes_pagos`
--
ALTER TABLE `clientes_pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_pagos_cliente_id_foreign` (`cliente_id`),
  ADD KEY `clientes_pagos_pago_id_foreign` (`pago_id`);

--
-- Indices de la tabla `clientes_series`
--
ALTER TABLE `clientes_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_series_cliente_id_foreign` (`cliente_id`),
  ADD KEY `clientes_series_serie_id_foreign` (`serie_id`),
  ADD KEY `clientes_series_ejercicio_id_foreign` (`ejercicio_id`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ejercicios_categoria_ejercicios_id_foreign` (`categoria_ejercicios_id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicadores_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `indicadores_semanales`
--
ALTER TABLE `indicadores_semanales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicadores_semanales_indicador_id_foreign` (`indicador_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antropometrias`
--
ALTER TABLE `antropometrias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categoria_ejercicios`
--
ALTER TABLE `categoria_ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `clientes_ejercicios`
--
ALTER TABLE `clientes_ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_evaluaciones`
--
ALTER TABLE `clientes_evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `clientes_pagos`
--
ALTER TABLE `clientes_pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `clientes_series`
--
ALTER TABLE `clientes_series`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `indicadores_semanales`
--
ALTER TABLE `indicadores_semanales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antropometrias`
--
ALTER TABLE `antropometrias`
  ADD CONSTRAINT `antropometrias_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `clientes_deporte_id_foreign` FOREIGN KEY (`deporte_id`) REFERENCES `deportes` (`id`);

--
-- Filtros para la tabla `clientes_ejercicios`
--
ALTER TABLE `clientes_ejercicios`
  ADD CONSTRAINT `clientes_ejercicios_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `clientes_ejercicios_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicios` (`id`);

--
-- Filtros para la tabla `clientes_evaluaciones`
--
ALTER TABLE `clientes_evaluaciones`
  ADD CONSTRAINT `clientes_evaluaciones_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `clientes_evaluaciones_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicios` (`id`),
  ADD CONSTRAINT `clientes_evaluaciones_evaluaciones_id_foreign` FOREIGN KEY (`evaluaciones_id`) REFERENCES `evaluaciones` (`id`);

--
-- Filtros para la tabla `clientes_pagos`
--
ALTER TABLE `clientes_pagos`
  ADD CONSTRAINT `clientes_pagos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `clientes_pagos_pago_id_foreign` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`id`);

--
-- Filtros para la tabla `clientes_series`
--
ALTER TABLE `clientes_series`
  ADD CONSTRAINT `clientes_series_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `clientes_series_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicios` (`id`),
  ADD CONSTRAINT `clientes_series_serie_id_foreign` FOREIGN KEY (`serie_id`) REFERENCES `series` (`id`);

--
-- Filtros para la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD CONSTRAINT `ejercicios_categoria_ejercicios_id_foreign` FOREIGN KEY (`categoria_ejercicios_id`) REFERENCES `categoria_ejercicios` (`id`);

--
-- Filtros para la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `indicadores_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `indicadores_semanales`
--
ALTER TABLE `indicadores_semanales`
  ADD CONSTRAINT `indicadores_semanales_indicador_id_foreign` FOREIGN KEY (`indicador_id`) REFERENCES `indicadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
