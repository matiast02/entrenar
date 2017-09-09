-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2017 a las 02:39:51
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
(1, 1, '2017-08-09', 80.50, 73.30, 78.00, 85.00, 45.00, 12.00, 45.00, '10 Puntos', 12.50, NULL, '2017-08-03 01:18:02', '2017-08-03 01:18:02'),
(2, 1, '2017-08-10', 80.00, 75.50, 48.00, 45.00, 87.00, 45.00, 54.00, 'Bien', 10.00, NULL, '2017-08-04 02:01:07', '2017-08-04 02:01:07'),
(3, 1, '2017-08-17', 80.00, 80.00, 80.00, 80.00, 80.00, 80.00, 80.00, '80', 80.00, NULL, '2017-08-05 03:21:02', '2017-08-05 03:22:41');

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
(1, 'sobrepeso', NULL, NULL, NULL);

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
(1, 'Fuerza Tren Superior', NULL, '2017-08-03 01:30:24', '2017-08-03 01:30:24'),
(2, 'Fuerza Tren Inferior', NULL, '2017-08-04 02:31:13', '2017-08-04 02:31:13'),
(3, 'Semi Fuerza', NULL, '2017-08-05 02:26:20', '2017-08-05 02:26:20');

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
(1, 'Pablo', 'Rivera', '1989-01-21', '33753907', 'Urquiza', '155124345', 'pablo@hotmail.com', 1, 1, 'Vicky', 'Vicky', '2017-01-01', NULL, 0, 1, NULL, NULL, NULL),
(2, 'juan', 'perez', '1989-01-01', '34569784', 'su casa', '154236597', 'jperez@gmail.com', 1, 1, 'Vicky', 'Vicky', '2017-08-01', 'images/perfiles/2.jpg', 0, 1, NULL, '2017-08-05 06:41:35', '2017-08-05 06:41:35'),
(3, 'Mateo', 'Rivera', '2016-11-25', '55467894', 'Urquiza', '154678945', 'mateo@hotmail.com', 1, 1, 'Vicky', 'Vickyyyy', '2017-01-01', 'images/perfiles/3.jpg', 0, 1, NULL, '2017-08-05 06:47:17', '2017-08-05 06:47:48');

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
(1, 1, 1, 2, NULL, '2017-08-25 01:18:28', '2017-08-25 01:18:28'),
(2, 1, 2, 4, NULL, '2017-08-24 07:14:26', '2017-08-24 07:14:26'),
(3, 1, 3, 9, NULL, '2017-08-25 08:04:40', '2017-08-25 08:04:40'),
(4, 1, 4, 10, NULL, '2017-08-25 08:24:50', '2017-08-25 08:24:50'),
(5, 1, 5, 13, NULL, '2017-08-28 03:29:05', '2017-08-28 03:29:05'),
(6, 1, 6, 13, NULL, '2017-08-29 02:47:54', '2017-08-29 02:47:54'),
(7, 1, 7, 13, NULL, '2017-08-31 03:21:51', '2017-08-31 03:21:51'),
(8, 1, 8, 14, NULL, '2017-08-31 03:23:41', '2017-08-31 03:23:41'),
(9, 1, 9, 2, NULL, '2017-08-31 03:24:30', '2017-08-31 03:24:30'),
(10, 1, 10, 9, NULL, '2017-08-31 03:24:48', '2017-08-31 03:24:48'),
(11, 1, 11, 10, NULL, '2017-08-31 03:25:10', '2017-08-31 03:25:10'),
(12, 1, 12, 11, NULL, '2017-08-31 03:25:28', '2017-08-31 03:25:28'),
(13, 1, 13, 13, NULL, '2017-08-31 03:25:48', '2017-08-31 03:25:48'),
(14, 1, 14, 11, NULL, '2017-08-31 03:26:05', '2017-08-31 03:26:05'),
(15, 1, 15, 12, NULL, '2017-08-31 03:27:59', '2017-08-31 03:27:59'),
(16, 1, 16, 4, NULL, '2017-08-31 03:28:19', '2017-08-31 03:28:19');

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
(1, 1, 1, 1, NULL, '2017-08-03 01:38:13', '2017-08-03 01:38:13'),
(2, 1, 2, 1, NULL, '2017-08-03 01:38:14', '2017-08-03 01:38:14'),
(3, 1, 3, 13, NULL, '2017-08-25 22:32:26', '2017-08-25 22:32:26'),
(4, 1, 4, 13, NULL, '2017-08-25 22:32:26', '2017-08-25 22:32:26'),
(5, 1, 5, 13, NULL, '2017-08-25 22:41:43', '2017-08-25 22:41:43'),
(6, 1, 6, 13, NULL, '2017-08-25 22:41:43', '2017-08-25 22:41:43'),
(7, 1, 7, 13, NULL, '2017-08-25 22:43:27', '2017-08-25 22:43:27'),
(8, 1, 8, 1, NULL, '2017-08-26 23:06:00', '2017-08-26 23:06:00'),
(9, 1, 9, 1, NULL, '2017-08-26 23:06:00', '2017-08-26 23:06:00'),
(10, 1, 10, 1, NULL, '2017-08-26 23:21:54', '2017-08-26 23:21:54'),
(11, 1, 11, 1, NULL, '2017-08-26 23:21:54', '2017-08-26 23:21:54'),
(12, 1, 12, 1, NULL, '2017-08-26 23:32:27', '2017-08-26 23:32:27'),
(13, 1, 13, 1, NULL, '2017-08-26 23:32:27', '2017-08-26 23:32:27'),
(14, 1, 14, 1, NULL, '2017-08-26 23:36:55', '2017-08-26 23:36:55'),
(15, 1, 15, 1, NULL, '2017-08-26 23:36:55', '2017-08-26 23:36:55'),
(16, 1, 16, 1, NULL, '2017-08-26 23:39:19', '2017-08-26 23:39:19'),
(17, 1, 17, 1, NULL, '2017-08-26 23:39:19', '2017-08-26 23:39:19'),
(18, 1, 18, 1, NULL, '2017-08-27 00:06:51', '2017-08-27 00:06:51'),
(19, 1, 19, 1, NULL, '2017-08-27 00:06:51', '2017-08-27 00:06:51'),
(20, 1, 20, 1, NULL, '2017-08-28 03:17:20', '2017-08-28 03:17:20'),
(21, 1, 21, 1, NULL, '2017-08-28 03:17:20', '2017-08-28 03:17:20'),
(22, 1, 22, 1, NULL, '2017-08-28 03:17:35', '2017-08-28 03:17:35'),
(23, 1, 23, 1, NULL, '2017-08-28 03:17:35', '2017-08-28 03:17:35'),
(24, 1, 24, 1, NULL, '2017-08-28 03:22:21', '2017-08-28 03:22:21'),
(25, 1, 25, 1, NULL, '2017-08-28 03:23:31', '2017-08-28 03:23:31'),
(26, 1, 27, 1, NULL, '2017-08-30 04:56:46', '2017-08-30 04:56:46'),
(27, 1, 28, 1, NULL, '2017-08-30 04:56:46', '2017-08-30 04:56:46'),
(28, 1, 29, 1, NULL, '2017-08-30 04:58:17', '2017-08-30 04:58:17'),
(29, 1, 30, 1, NULL, '2017-08-30 04:58:18', '2017-08-30 04:58:18'),
(30, 1, 32, 1, NULL, '2017-08-31 02:32:57', '2017-08-31 02:32:57'),
(31, 1, 33, 1, NULL, '2017-08-31 02:32:57', '2017-08-31 02:32:57'),
(32, 1, 34, 1, NULL, '2017-08-31 02:36:35', '2017-08-31 02:36:35'),
(33, 1, 35, 1, NULL, '2017-08-31 02:36:35', '2017-08-31 02:36:35');

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
(1, 'Futbol', NULL, NULL, NULL);

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
(1, 'Pecho', 1, 1, NULL, '2017-08-03 01:30:34', '2017-08-03 01:30:34'),
(2, 'Salto abalacob', 2, 0, NULL, '2017-08-04 02:31:56', '2017-08-24 03:45:02'),
(3, 'Remo', 1, 1, '2017-08-24 05:44:41', '2017-08-05 02:09:33', '2017-08-24 05:44:41'),
(4, 'Salto cm', 3, 0, NULL, '2017-08-05 02:26:31', '2017-08-24 03:45:19'),
(9, 'Salto sj', 2, 0, NULL, '2017-08-24 05:39:21', '2017-08-24 05:39:21'),
(10, 'Salto continuo', 2, 0, NULL, '2017-08-24 05:40:43', '2017-08-24 05:40:43'),
(11, 'Peso muerto', 2, 0, NULL, '2017-08-24 05:41:25', '2017-08-24 05:41:25'),
(12, 'velocidad 10 mts', 2, 0, NULL, '2017-08-24 05:42:44', '2017-08-24 05:42:44'),
(13, 'Remo', 1, 0, NULL, '2017-08-24 05:43:10', '2017-08-24 05:43:10'),
(14, 'Yoyo test', 1, 0, NULL, '2017-08-24 05:43:33', '2017-08-24 05:43:33'),
(15, 'popo', 2, 0, NULL, '2017-08-29 02:48:45', '2017-08-29 02:48:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `maximo_peso` int(11) DEFAULT NULL,
  `velocidad_segundos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salto_abalacob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salto_cmj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salto_sj` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mejor_salto_continuo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peor_salto_continuo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_salto_continuo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resistencia_numero_fase` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `velocidad_decimas` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `velocidad_centesimas` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `maximo_peso`, `velocidad_segundos`, `salto_abalacob`, `salto_cmj`, `salto_sj`, `mejor_salto_continuo`, `peor_salto_continuo`, `cantidad_salto_continuo`, `resistencia_numero_fase`, `deleted_at`, `created_at`, `updated_at`, `velocidad_decimas`, `velocidad_centesimas`) VALUES
(1, NULL, NULL, '35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-25 01:18:28', '2017-08-25 01:18:28', NULL, NULL),
(2, NULL, NULL, NULL, '22', NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-25 07:14:26', '2017-08-25 07:14:26', NULL, NULL),
(3, NULL, NULL, NULL, NULL, '15', NULL, NULL, NULL, NULL, NULL, '2017-08-25 08:04:40', '2017-08-25 08:04:40', NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, '2', '1', '4', NULL, NULL, '2017-08-25 08:24:50', '2017-08-25 08:24:50', NULL, NULL),
(5, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-28 03:29:05', '2017-08-28 03:29:05', NULL, NULL),
(6, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-29 02:47:54', '2017-08-29 02:47:54', NULL, NULL),
(7, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:21:51', '2017-08-31 03:21:51', NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, NULL, '2017-08-31 03:23:41', '2017-08-31 03:23:41', NULL, NULL),
(9, NULL, NULL, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:24:30', '2017-08-31 03:24:30', NULL, NULL),
(10, NULL, NULL, NULL, NULL, '20', NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:24:48', '2017-08-31 03:24:48', NULL, NULL),
(11, NULL, NULL, NULL, NULL, NULL, '10', '10', '10', NULL, NULL, '2017-08-31 03:25:10', '2017-08-31 03:25:10', NULL, NULL),
(12, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:25:28', '2017-08-31 03:25:28', NULL, NULL),
(13, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:25:47', '2017-08-31 03:25:47', NULL, NULL),
(14, 300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:26:05', '2017-08-31 03:26:05', NULL, NULL),
(15, NULL, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:27:59', '2017-08-31 03:27:59', '5', '3'),
(16, NULL, NULL, NULL, '65', NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31 03:28:19', '2017-08-31 03:28:19', NULL, NULL);

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
(1, 1, '2017-08-02', 31, '2017-08-02', 80.50, 78.00, 3.11, '10:30:00', '11:30:00', 8, 8, 8, 8, 8, 40, 8, 60.00, 480, NULL, '2017-08-03 01:03:12', '2017-08-29 23:56:36'),
(2, 1, '2017-08-16', 33, '2017-08-16', 90.00, 85.00, 5.56, '10:30:00', '11:50:00', 9, 8, 7, 6, 5, 35, 4, 80.00, 320, NULL, '2017-08-03 01:04:19', '2017-08-03 01:04:19'),
(3, 1, '2017-08-03', 31, '2017-08-03', 80.50, 78.00, 3.11, '10:30:00', '11:30:00', 9, 9, 9, 9, 9, 45, 9, 60.00, 540, NULL, '2017-08-03 01:03:12', '2017-08-30 04:53:15'),
(4, 1, '2017-08-02', 31, '2017-08-02', 80.50, 78.00, 3.11, '10:30:00', '11:30:00', 8, 7, 9, 5, 1, 30, 8, 60.00, 180, '2017-08-28 05:16:26', '2017-08-03 01:03:12', '2017-08-28 05:16:26');

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
('2017_08_24_210125_update_evaluaciones_table_add_nullable_All_col', 2),
('2017_08_26_205619_update_table_series_add_col_mejor_serie_bool', 3),
('2017_08_28_021947_update_table_clientes_col_dni_unique', 4);

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
  `peso_corporal` int(11) NOT NULL,
  `peso_externo` int(11) NOT NULL,
  `masa` int(11) NOT NULL,
  `potencia_impulsiva` int(11) NOT NULL,
  `potencia_relativa` double(8,2) NOT NULL,
  `velocidad_impulsiva` int(11) NOT NULL,
  `fuerza_impulsiva` int(11) NOT NULL,
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
(1, 4, 80, 60, 140, 78, 0.98, 45, 45, 45, 4, 90.10, NULL, '2017-08-03 01:38:13', '2017-08-03 01:38:13', 0, 87, 477.223, 66.592674805771, NULL),
(2, 4, 80, 60, 140, 78, 0.98, 45, 45, 45, 4, 90.10, NULL, '2017-08-03 01:38:14', '2017-08-03 01:38:14', 1, 87, 477.223, 66.592674805771, NULL),
(3, 3, 80, 50, 130, 2, 0.02, 2, 2, 5, 1, 9.25, NULL, '2017-08-25 22:32:26', '2017-08-25 22:32:26', 0, 2, 53.073, 540.54054054054, NULL),
(4, 3, 80, 50, 130, 1, 0.01, 1, 1, 2, 1, 4.30, NULL, '2017-08-25 22:32:26', '2017-08-25 22:32:26', 1, 1, 48.083, 1162.7906976744, NULL),
(5, 2, 80, 80, 160, 4, 0.05, 4, 4, 5, 1, 14.20, NULL, '2017-08-25 22:41:43', '2017-08-25 22:41:43', 0, 4, 63.053, 563.38028169014, NULL),
(6, 2, 80, 80, 160, 3, 0.04, 3, 3, 3, 1, 8.92, NULL, '2017-08-25 22:41:43', '2017-08-25 22:41:43', 1, 3, 58.063, 896.86098654709, NULL),
(7, 1, 80, 80, 160, 5, 0.06, 4, 4, 5, 1, 5.00, NULL, '2017-08-25 22:43:27', '2017-08-25 22:43:27', 0, 4, 63.053, 1600, NULL),
(8, 2, 80, 55, 135, 1, 0.01, 1, 1, 3, 2, 6.45, NULL, '2017-08-26 23:06:00', '2017-08-26 23:06:00', 0, 1, 48.083, 853.3747090768, NULL),
(9, 2, 80, 55, 135, 1, 0.01, 1, 1, 3, 2, 6.45, NULL, '2017-08-26 23:06:00', '2017-08-26 23:06:00', 1, 1, 48.083, 853.3747090768, NULL),
(10, 2, 80, 100, 180, 2, 0.02, 2, 2, 5, 1, 17.50, NULL, '2017-08-26 23:21:54', '2017-08-26 23:21:54', 0, 2, 53.073, 571.42857142857, 1),
(11, 2, 80, 100, 180, 1, 0.01, 1, 1, 5, 1, 17.50, NULL, '2017-08-26 23:21:54', '2017-08-26 23:21:54', 1, 1, 48.083, 571.42857142857, NULL),
(12, 2, 80, 100, 180, 2, 0.02, 2, 2, 5, 1, 17.50, NULL, '2017-08-26 23:32:27', '2017-08-26 23:32:27', 0, 2, 53.073, 571.42857142857, NULL),
(13, 2, 80, 100, 180, 1, 0.01, 1, 1, 5, 1, 17.50, NULL, '2017-08-26 23:32:27', '2017-08-26 23:32:27', 1, 1, 48.083, 571.42857142857, NULL),
(14, 2, 80, 120, 200, 1, 0.01, 1, 1, 5, 2, 20.80, NULL, '2017-08-26 23:36:55', '2017-08-26 23:36:55', 0, 1, 48.083, 576.92307692308, 2),
(15, 2, 80, 120, 200, 1, 0.01, 1, 1, 5, 2, 20.80, NULL, '2017-08-26 23:36:55', '2017-08-26 23:36:55', 1, 1, 48.083, 576.92307692308, NULL),
(16, 2, 80, 120, 200, 2, 0.02, 2, 2, 5, 1, 20.80, NULL, '2017-08-26 23:39:19', '2017-08-26 23:39:19', 0, 2, 53.073, 576.92307692308, NULL),
(17, 2, 80, 100, 180, 1, 0.01, 1, 1, 5, 1, 17.50, NULL, '2017-08-26 23:39:19', '2017-08-26 23:39:19', 1, 1, 48.083, 685.71428571429, NULL),
(18, 2, 80, 120, 200, 2, 0.02, 2, 2, 5, 1, 20.80, NULL, '2017-08-27 00:06:51', '2017-08-27 00:06:51', 0, 2, 53.073, 576.92307692308, 1),
(19, 2, 80, 100, 180, 1, 0.01, 1, 1, 5, 1, 17.50, NULL, '2017-08-27 00:06:51', '2017-08-27 00:06:51', 1, 1, 48.083, 685.71428571429, NULL),
(20, 2, 80, 100, 180, 2, 0.02, 2, 2, 2, 1, 7.60, NULL, '2017-08-28 03:17:20', '2017-08-28 03:17:20', 0, 2, 53.073, 1315.7894736842, 1),
(21, 2, 80, 110, 190, 1, 0.01, 1, 1, 1, 1, 4.63, NULL, '2017-08-28 03:17:20', '2017-08-28 03:17:20', 1, 1, 48.083, 2159.8272138229, NULL),
(22, 2, 80, 100, 180, 2, 0.02, 2, 2, 2, 1, 7.60, NULL, '2017-08-28 03:17:35', '2017-08-28 03:17:35', 0, 2, 53.073, 1315.7894736842, 1),
(23, 2, 80, 110, 190, 1, 0.01, 1, 1, 1, 1, 4.63, NULL, '2017-08-28 03:17:35', '2017-08-28 03:17:35', 1, 1, 48.083, 2159.8272138229, NULL),
(24, 1, 80, 100, 180, 2, 0.02, 2, 2, 2, 1, 2.00, NULL, '2017-08-28 03:22:21', '2017-08-28 03:22:21', 0, 2, 53.073, 5000, 1),
(25, 1, 80, 70, 150, 2, 0.02, 2, 2, 2, 1, 2.00, NULL, '2017-08-28 03:23:31', '2017-08-28 03:23:31', 0, 2, 53.073, 3500, 1),
(26, 1, 80, 100, 180, 100, 1.25, 100, 100, 3, 1, 100.00, NULL, '2017-08-30 04:55:29', '2017-08-30 04:55:29', 0, 10, 92.993, 100, 1),
(27, 2, 80, 100, 180, 100, 1.25, 100, 100, 3, 0, 10.90, NULL, '2017-08-30 04:56:46', '2017-08-30 04:56:46', 0, 10, 92.993, 917.43119266055, 1),
(28, 2, 80, 80, 160, 80, 1.00, 80, 80, 3, 0, 8.92, NULL, '2017-08-30 04:56:46', '2017-08-30 04:56:46', 1, 8, 83.013, 1121.0762331839, NULL),
(29, 3, 80, 300, 380, 300, 3.75, 300, 300, 30, 1, 298.00, NULL, '2017-08-30 04:58:17', '2017-08-30 04:58:17', 0, 30, 192.793, 100.6711409396, 1),
(30, 3, 80, 100, 180, 100, 1.25, 100, 100, 10, 1, 34.00, NULL, '2017-08-30 04:58:17', '2017-08-30 04:58:17', 1, 10, 92.993, 882.35294117647, NULL),
(31, 1, 80, 101, 181, 101, 1.26, 101, 101, 3, 1, 100.50, NULL, '2017-08-31 02:28:21', '2017-08-31 02:28:21', 0, 8, 83.013, 100, 1),
(32, 2, 80, 100, 180, 100, 1.25, 100, 100, 3, 0, 10.90, NULL, '2017-08-31 02:32:56', '2017-08-31 02:32:56', 0, 10, 92.993, 917.43119266055, 1),
(33, 2, 80, 80, 160, 80, 1.00, 80, 80, 0, 0, 1.00, NULL, '2017-08-31 02:32:57', '2017-08-31 02:32:57', 1, 8, 83.013, 10000, NULL),
(34, 4, 100, 200, 300, 200, 2.00, 200, 200, 3, 0, 20.80, NULL, '2017-08-31 02:36:35', '2017-08-31 02:36:35', 0, 20, 142.893, 961.53846153846, 1),
(35, 4, 100, 50, 150, 50, 0.50, 50, 50, 3, 0, 5.95, NULL, '2017-08-31 02:36:35', '2017-08-31 02:36:35', 1, 5, 68.043, 3361.3445378151, NULL);

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
(1, 'Matias', 'matix_tkd@hotmail.com', '$2y$10$LFuxJ3cyhpJgjAWNI5iHkOEr1I8/vYudNxurcJMQm/Z41JJYdxoNi', '5yj5QxDlIgBapIQj7jZHG6XIPf0ItsSY50QCQrkS4I320HgNAfxZoJjb6n0K', '2017-08-03 01:02:37', '2017-08-05 06:15:14', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categoria_ejercicios`
--
ALTER TABLE `categoria_ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `clientes_ejercicios`
--
ALTER TABLE `clientes_ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_evaluaciones`
--
ALTER TABLE `clientes_evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `clientes_pagos`
--
ALTER TABLE `clientes_pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_series`
--
ALTER TABLE `clientes_series`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `indicadores_semanales`
--
ALTER TABLE `indicadores_semanales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
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
