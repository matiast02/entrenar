-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2018 a las 15:42:31
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
(1, 'Fuerza Tren Superior', NULL, '2018-01-17 14:23:53', '2018-01-17 14:23:53'),
(2, 'Fuerza Tren Inferior', NULL, '2018-01-17 14:23:58', '2018-01-17 14:23:58'),
(3, 'Velocidad', NULL, '2018-01-17 14:24:06', '2018-01-17 14:24:06'),
(4, 'Resistencia', NULL, '2018-01-17 14:24:11', '2018-01-17 14:24:11'),
(5, 'Saltos', NULL, '2018-01-17 14:24:39', '2018-01-17 14:24:39');

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
(1, 'Agilidad 5-10-5', 3, 0, NULL, '2018-01-17 14:38:16', '2018-01-17 14:38:16'),
(2, 'Peso Muerto', 2, 0, NULL, '2018-01-17 14:38:28', '2018-01-17 14:38:28'),
(3, 'Peso Muerto 1 Pierna', 2, 0, NULL, '2018-01-17 14:38:44', '2018-01-17 14:38:44'),
(4, 'Remo', 1, 0, NULL, '2018-01-17 14:38:54', '2018-01-17 14:38:54'),
(5, 'Salto Abalakov', 5, 0, NULL, '2018-01-17 14:39:09', '2018-01-17 14:39:09'),
(6, 'Salto Cmj', 5, 0, NULL, '2018-01-17 14:39:24', '2018-01-17 14:39:24'),
(7, 'Salto Continuo', 5, 0, NULL, '2018-01-17 14:39:39', '2018-01-17 14:39:39'),
(8, 'Salto Sj', 5, 0, NULL, '2018-01-17 14:40:40', '2018-01-17 14:40:40'),
(9, 'Sentadilla Bulgara', 2, 0, NULL, '2018-01-17 14:40:59', '2018-01-17 14:40:59'),
(10, 'Velocidad 10 mts', 3, 0, NULL, '2018-01-17 14:41:12', '2018-01-17 14:41:12'),
(11, 'Yoyo Test', 4, 0, NULL, '2018-01-17 14:41:23', '2018-01-17 14:41:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `maximo_peso` double DEFAULT NULL,
  `velocidad_segundos_10` double NOT NULL,
  `salto_abalakov` double DEFAULT NULL,
  `salto_cmj` double DEFAULT NULL,
  `salto_sj` double DEFAULT NULL,
  `mejor_salto_continuo` double DEFAULT NULL,
  `peor_salto_continuo` double DEFAULT NULL,
  `cantidad_salto_continuo` int(11) DEFAULT NULL,
  `resistencia_numero_fase` int(11) DEFAULT NULL,
  `cantidad_repeticiones` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `velocidad_decimas_10` double(8,2) DEFAULT NULL,
  `velocidad_centesimas_10` double(8,2) DEFAULT NULL,
  `velocidad_segundos_5` double(8,2) DEFAULT NULL,
  `velocidad_decimas_5` double(8,2) DEFAULT NULL,
  `velocidad_centesimas_5` double(8,2) DEFAULT NULL,
  `velocidad_sumatoria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('2017_08_28_021947_update_table_clientes_col_dni_unique', 1),
('2018_01_17_003816_update_table_evaluaciones_col_sumatoria', 1);

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
  `peso_corporal` double(8,2) NOT NULL,
  `peso_externo` double(8,2) NOT NULL,
  `masa` double(8,2) NOT NULL,
  `potencia_impulsiva` double(8,2) NOT NULL,
  `potencia_relativa` double(8,2) NOT NULL,
  `velocidad_impulsiva` double(8,2) NOT NULL,
  `fuerza_impulsiva` double(8,2) NOT NULL,
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
(1, 'Victor Cuellar', 'profesorvictorcuellar@hotmail.com', '$2y$10$UyQGhZYxKDZgP09Pm9y07Oaw9GC.DxV3RgRPRUanzw1pnb1Yp6L4K', NULL, '2018-01-17 14:23:30', '2018-01-17 14:23:30', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria_ejercicios`
--
ALTER TABLE `categoria_ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_ejercicios`
--
ALTER TABLE `clientes_ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_evaluaciones`
--
ALTER TABLE `clientes_evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_pagos`
--
ALTER TABLE `clientes_pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes_series`
--
ALTER TABLE `clientes_series`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
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
