-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2019 a las 14:32:12
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apatxee_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2016_12_04_162332_create_tbl_publicaciones_table', 1),
(6, '2016_12_04_162427_create_tbl_publicacion_imagenes_table', 1),
(7, '2016_12_04_162530_create_tbl_categoria_table', 1),
(8, '2016_12_04_162619_create_tbl_publicacion_categoria_table', 1),
(9, '2016_12_04_162719_create_tbl_atributos_globales_table', 1),
(10, '2016_12_04_162816_create_tbl_atributos_globales_valores_table', 1),
(11, '2016_12_04_162915_create_tbl_categoria_atributos_table', 1),
(12, '2016_12_04_163017_create_tbl_publicacion_atributos_globales_table', 1),
(13, '2016_12_04_163116_create_tbl_contacto_publicacion_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newsleter`
--

CREATE TABLE `newsleter` (
  `id` int(9) NOT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `newsleter`
--

INSERT INTO `newsleter` (`id`, `mail`) VALUES
(1, 'ccarch81@gmail.com'),
(2, 'mail@meia.com'),
(3, 'grgrg'),
(4, 'login@mail.com'),
(5, 'leifer33@gmail.com'),
(6, 'micorreo@boletin.com'),
(7, 'eeeeeeee'),
(8, 'mfefe@fefe.com'),
(9, 'sds'),
(10, 'HOLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ventas`
--

CREATE TABLE `producto_ventas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pedin','cancel','complete') NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `qr` varchar(20) NOT NULL,
  `fecha_entrega` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_ventas`
--

INSERT INTO `producto_ventas` (`id`, `id_cliente`, `id_producto`, `fecha`, `status`, `id_vendedor`, `qr`, `fecha_entrega`) VALUES
(1, 13, 2, '2018-07-07 18:40:12', 'pedin', 2, '', NULL),
(2, 13, 166, '2018-07-07 18:52:36', 'pedin', 2, '', NULL),
(3, 2, 165, '2018-07-08 09:54:20', 'pedin', 2, 'FMZFg8BtWgyN', NULL),
(4, 13, 174, '2018-07-25 08:47:21', 'pedin', 2, 'DoR5aD5kKk6', NULL),
(5, 2, 181, '2018-07-25 15:34:23', 'pedin', 2, '53n2MW0MCfr', NULL),
(6, 2, 171, '2018-07-25 15:35:43', 'pedin', 13, 'K8aCEvNRryi', NULL),
(7, 2, 176, '2018-07-25 15:36:21', 'pedin', 2, 'qT85CjQZYjQ', NULL),
(8, 2, 177, '2018-07-25 15:49:29', 'pedin', 2, 'vu5XQBeaeoj', NULL),
(9, 2, 180, '2018-07-25 16:12:59', 'pedin', 13, 'mwVDvIDZVsH', NULL),
(10, 2, 178, '2018-07-25 17:48:50', 'pedin', 2, 'ejbqDdfxWEC', NULL),
(11, 2, 184, '2018-07-25 17:58:47', 'pedin', 2, 'Rxj5FMmUZa3', NULL),
(12, 2, 179, '2018-07-25 18:02:39', 'pedin', 2, 'dNOWGHasCRv', NULL),
(13, 37, 189, '2018-07-28 16:05:58', 'pedin', 36, 'XQDOfpwgrYJ', NULL),
(14, 37, 185, '2018-07-28 16:07:04', 'pedin', 29, 'zgNLdYOmwsb', NULL),
(15, 37, 192, '2018-07-28 16:07:27', 'pedin', 37, 'bh0PKX2NRVr', NULL),
(16, 13, 206, '2018-08-03 08:25:37', 'pedin', 13, '4KnItD6WNPS', NULL),
(17, 13, 207, '2018-08-03 08:30:39', 'pedin', 13, 'VozYBIQEhWQ', NULL),
(18, 42, 208, '2018-08-03 09:02:46', 'pedin', 13, 'uDMLpzkTk9o', NULL),
(19, 37, 205, '2018-08-05 16:02:42', 'pedin', 29, 'lfqqiBTo6Bv', NULL),
(20, 13, 214, '2019-05-12 11:36:06', 'pedin', 13, 'UsaSbjz9YJR', NULL),
(21, 13, 200, '2019-05-12 11:42:35', 'pedin', 61, 'r8SXS5jKJoB', NULL),
(22, 13, 213, '2019-05-12 11:45:49', 'pedin', 78, 'gyH5VelIuXB', NULL),
(23, 13, 209, '2019-05-12 12:37:06', 'pedin', 68, 'O8p2tQGYYQC', NULL),
(24, 13, 210, '2019-05-12 14:30:08', 'pedin', 70, 'ZIcoKyf8QTm', NULL),
(25, 82, 204, '2019-05-12 15:28:24', 'pedin', 82, '93wmxKaFlSe', NULL),
(26, 82, 204, '2019-05-12 15:33:55', 'pedin', 82, 'ODdKYfvEYls', NULL),
(27, 82, 204, '2019-05-12 15:42:19', 'pedin', 82, 'BJe0nOb71l7', NULL),
(28, 82, 204, '2019-05-12 15:46:55', 'pedin', 82, 'pydzJKV3RNF', NULL),
(29, 13, 204, '2019-05-12 20:44:35', 'complete', 13, 'dYrtpfZLXxo', NULL),
(30, 13, 204, '2019-05-12 20:43:23', 'complete', 13, 'dYrtpfZLXxo', NULL),
(31, 13, 204, '2019-05-12 20:42:42', 'complete', 13, 'dYrtpfZLXxo', NULL),
(32, 13, 204, '2019-05-12 19:02:37', 'pedin', 60, 'RCcfilZ2HWf', NULL),
(33, 13, 199, '2019-05-12 19:04:09', 'pedin', 29, 'qu9cxoWJQ5s', NULL),
(34, 13, 199, '2019-05-12 19:30:02', 'pedin', 29, 'aYOoRGdvwwz', NULL),
(35, 13, 215, '2019-05-12 20:16:27', 'pedin', 2, '54mgJCNTqMm', NULL),
(36, 13, 216, '2019-05-19 12:08:11', 'pedin', 2, 'PmmapkggcMm', NULL),
(37, 13, 217, '2019-05-19 12:11:26', 'pedin', 13, 'FCRvNyBvcv8', NULL),
(38, 13, 217, '2019-05-19 12:14:50', 'pedin', 13, 'APm7wQrW8e4', NULL),
(39, 13, 217, '2019-10-06 18:14:33', 'complete', 13, '4B9xOcakx6U', NULL),
(40, 85, 218, '2019-10-06 16:17:17', 'pedin', 85, 'WYiwmvYcE01', NULL),
(41, 85, 216, '2019-10-06 16:19:16', 'pedin', 2, 'Zgyxz34ksg1', NULL),
(42, 13, 216, '2019-10-06 18:28:15', 'pedin', 2, 'nTbbd1EEBUM', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_atributos_globales`
--

CREATE TABLE `tbl_atributos_globales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elemento` enum('input','textarea','selectbox','multiselectbox','radio','checkbox','checkboxgroup','file','hidden') COLLATE utf8_unicode_ci NOT NULL,
  `requerido` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_atributos_globales`
--

INSERT INTO `tbl_atributos_globales` (`id`, `nombre`, `elemento`, `requerido`, `orden`, `created_at`, `updated_at`) VALUES
(122, 'Garantia', 'input', '1', 1, '2018-06-09 01:19:24', '2018-06-09 01:19:24'),
(123, 'peso', 'input', '1', 1, '2019-05-16 19:15:53', '2019-05-16 19:15:53'),
(124, 'Gramos', 'radio', '2', 1, '2019-05-16 19:18:16', '2019-05-16 19:18:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_atributos_globales_valores`
--

CREATE TABLE `tbl_atributos_globales_valores` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_atributos_globales` int(10) UNSIGNED NOT NULL,
  `value_vista` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_atributos_globales_valores`
--

INSERT INTO `tbl_atributos_globales_valores` (`id`, `id_atributos_globales`, `value_vista`, `estado`, `created_at`, `updated_at`) VALUES
(241, 122, '', 'activo', '2018-06-09 01:19:24', '2018-06-09 01:19:24'),
(242, 123, '', 'activo', '2019-05-16 19:15:53', '2019-05-16 19:15:53'),
(243, 124, 'sad', 'activo', '2019-05-16 19:18:16', '2019-05-16 19:18:16'),
(244, 124, 'asdas', 'activo', '2019-05-16 19:18:16', '2019-05-16 19:18:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_padre` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` enum('activa','inactiva') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id`, `nombre`, `id_padre`, `orden`, `estado`, `created_at`, `updated_at`) VALUES
(108, 'Electronica', 0, 1, 'activa', '2018-06-09 01:18:02', '2018-06-09 01:18:12'),
(109, 'Móviles y Telefonia', 108, 2, 'activa', '2018-06-09 01:18:57', '2018-07-31 14:32:59'),
(110, 'Informática y Tablets', 108, 1, 'activa', '2018-06-09 01:33:52', '2018-07-31 14:33:08'),
(111, 'Cámaras y Fotografía', 108, 3, 'activa', '2018-07-31 14:33:25', '2018-07-31 14:33:25'),
(112, 'Otros', 108, 3, 'activa', '2018-07-31 14:33:34', '2018-07-31 14:33:34'),
(113, 'Deportes', 0, 3, 'activa', '2018-07-31 14:33:45', '2018-07-31 14:33:45'),
(114, 'Ciclismo', 113, 3, 'activa', '2018-07-31 14:33:55', '2018-07-31 14:33:55'),
(115, 'Fitness, Running y Yoga', 113, 3, 'activa', '2018-07-31 14:34:06', '2018-07-31 14:34:06'),
(116, 'Pádel y Tenis', 113, 3, 'activa', '2018-07-31 14:34:16', '2018-07-31 14:34:16'),
(117, 'Pesca', 113, 3, 'activa', '2018-07-31 14:34:29', '2018-07-31 14:34:29'),
(118, 'Otros', 113, 4, 'activa', '2018-07-31 14:34:37', '2018-07-31 14:34:37'),
(119, 'Joyería y Belleza', 0, 4, 'activa', '2018-07-31 14:34:53', '2018-07-31 14:34:53'),
(120, 'Relojes y Joyas', 119, 4, 'activa', '2018-07-31 14:35:26', '2018-07-31 14:35:26'),
(121, 'Belleza y Salud', 119, 4, 'activa', '2018-07-31 14:35:39', '2018-07-31 14:35:39'),
(122, 'Manicura y Pedicura', 119, 4, 'activa', '2018-07-31 14:35:54', '2018-07-31 14:35:54'),
(123, 'Maquillaje', 119, 4, 'activa', '2018-07-31 14:36:27', '2018-07-31 14:36:27'),
(124, 'Casa y Jardín', 0, 3, 'activa', '2018-07-31 14:36:45', '2018-07-31 14:36:45'),
(125, 'Hogar y Decoración', 124, 4, 'activa', '2018-07-31 14:36:57', '2018-07-31 14:36:57'),
(126, 'Electrodomésticos', 124, 4, 'activa', '2018-07-31 14:37:11', '2018-07-31 14:37:11'),
(127, 'Bricolaje', 124, 4, 'activa', '2018-07-31 14:37:22', '2018-07-31 14:37:22'),
(128, 'Terraza y Jardín', 124, 4, 'activa', '2018-07-31 14:37:30', '2018-07-31 14:37:30'),
(129, 'Motor', 0, 4, 'activa', '2018-07-31 14:37:41', '2018-07-31 14:37:41'),
(130, 'Recambios para coches', 129, 4, 'activa', '2018-07-31 14:37:54', '2018-07-31 14:37:54'),
(131, 'Audio, tecnología y navegación', 129, 4, 'activa', '2018-07-31 14:38:08', '2018-07-31 14:38:08'),
(132, 'Tuning para coches', 129, 4, 'activa', '2018-07-31 14:38:20', '2018-07-31 14:38:20'),
(133, 'Accesorios para coches', 129, 4, 'activa', '2018-07-31 14:38:29', '2018-07-31 14:38:29'),
(134, 'Otros', 129, 4, 'activa', '2018-07-31 14:38:36', '2018-07-31 14:38:36'),
(135, 'Ocio', 0, 4, 'activa', '2018-07-31 14:38:45', '2018-07-31 14:38:45'),
(136, 'Juguetes', 135, 4, 'activa', '2018-07-31 14:38:54', '2018-07-31 14:38:54'),
(137, 'Instrumentos musicales', 135, 4, 'activa', '2018-07-31 14:39:10', '2018-07-31 14:39:10'),
(138, 'Libros y Musica', 135, 4, 'activa', '2018-07-31 14:39:22', '2018-07-31 14:39:22'),
(139, 'Viajes', 135, 4, 'activa', '2018-07-31 14:39:33', '2018-07-31 14:39:33'),
(140, 'Otros', 135, 4, 'activa', '2018-07-31 14:39:41', '2018-07-31 14:39:41'),
(141, 'Moda', 0, 4, 'activa', '2018-07-31 14:39:48', '2018-07-31 14:39:48'),
(142, 'Ropa de hombre', 141, 4, 'activa', '2018-07-31 14:39:59', '2018-07-31 14:39:59'),
(143, 'Ropa de mujer', 141, 4, 'activa', '2018-07-31 14:40:11', '2018-07-31 14:40:11'),
(144, 'Ropa y Calzado de niños', 141, 4, 'activa', '2018-07-31 14:43:40', '2018-07-31 14:43:40'),
(145, 'Calzado', 141, 4, 'activa', '2018-07-31 14:43:48', '2018-07-31 14:43:48'),
(146, 'Otros', 141, 4, 'activa', '2018-07-31 14:43:55', '2018-07-31 14:43:55'),
(147, 'Coleccionismo', 0, 4, 'activa', '2018-07-31 14:44:06', '2018-07-31 14:44:06'),
(148, 'Arte y Antigüedades', 147, 4, 'activa', '2018-07-31 14:44:17', '2018-07-31 14:44:17'),
(149, 'Artículos militares', 147, 4, 'activa', '2018-07-31 14:44:26', '2018-07-31 14:44:26'),
(150, 'Artículos de Escritorio', 147, 4, 'activa', '2018-07-31 14:44:36', '2018-07-31 14:44:36'),
(151, 'Cromos', 147, 4, 'activa', '2018-07-31 14:44:47', '2018-07-31 14:44:47'),
(152, 'Bebés', 0, 4, 'activa', '2018-07-31 14:44:53', '2018-07-31 14:44:53'),
(153, 'Equipamiento y Maquinaria', 0, 4, 'activa', '2018-07-31 14:45:03', '2018-07-31 14:45:03'),
(154, 'Artículos para animales', 0, 4, 'activa', '2018-07-31 14:45:09', '2018-07-31 14:45:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_atributos`
--

CREATE TABLE `tbl_categoria_atributos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_atributo` int(10) UNSIGNED NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_categoria_atributos`
--

INSERT INTO `tbl_categoria_atributos` (`id`, `id_categoria`, `id_atributo`, `estado`, `created_at`, `updated_at`) VALUES
(198, 110, 122, 'activo', '2018-06-09 01:34:05', '2018-06-09 01:34:05'),
(199, 123, 122, 'activo', '2019-05-16 19:19:25', '2019-05-16 19:19:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_contacto_publicacion`
--

CREATE TABLE `tbl_contacto_publicacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_publicacion` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('leer','inactivo','leido','respondido') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_publicaciones`
--

CREATE TABLE `tbl_publicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `tipo_moneda` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('activo','pausa','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `destacado` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '1 destacado , 0 no',
  `id_user` int(11) DEFAULT '2',
  `date_init` timestamp NULL DEFAULT '2019-05-12 11:00:00',
  `date_finish` timestamp NULL DEFAULT '2020-05-12 11:00:00',
  `hour_init` varchar(300) COLLATE utf8_unicode_ci DEFAULT '8:00:00',
  `hour_finish` varchar(300) COLLATE utf8_unicode_ci DEFAULT '11:59:00',
  `dais` varchar(1000) COLLATE utf8_unicode_ci DEFAULT '[{"day":"Monday","status":"true"},{"day":"Tuesday","status":"true"},{"day":"Wednesday","status":"true"},{"day":"Thursday","status":"true"},{"day":"Friday","status":"true"},{"day":"Saturday","status":"true"},{"day":"Sunday","status":"true"}]	',
  `vendido` enum('no','yes','vencido','process') COLLATE utf8_unicode_ci DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_publicaciones`
--

INSERT INTO `tbl_publicaciones` (`id`, `titulo`, `precio`, `tipo_moneda`, `descripcion`, `estado`, `created_at`, `updated_at`, `destacado`, `id_user`, `date_init`, `date_finish`, `hour_init`, `hour_finish`, `dais`, `vendido`) VALUES
(200, 'Telefono satelital', 1000, '2', 'Samsung galaxy note 8 totalmente nuevo en envoltorio original con total garantia y entrega en mano color midnight black, dimensiones: 6,3 \", doble camara trasera con sensores de estabilizacion optica y doble camara frontal, resistente al agua y al polvo, escaner de retina, lector de huella y reconocimiento facial; 6GB de RAM y 64 de memoria ampliable, se puede cargar sin cables, auriculares nuevos del movil, bateria 3300Ah doble procesador y un sin fin de cosas que no se ni para que sirven ', 'activo', NULL, '2019-10-07 19:28:23', '0', 61, '2018-08-01 00:00:00', '2018-12-22 00:00:00', '05:00', '12:00', '[{\"day\":\"Monday\",\"status\":true},{\"day\":\"Tuesday\",\"status\":true},{\"day\":\"Wednesday\",\"status\":true},{\"day\":\"Thursday\",\"status\":true},{\"day\":\"Friday\",\"status\":true},{\"day\":\"Saturday\",\"status\":true},{\"day\":\"Sunday\",\"status\":true}]', 'process'),
(204, 'adaptadores de coche', 30, '2', 'comida para comer', 'activo', NULL, '2019-10-07 19:29:34', '0', 60, '2018-08-06 00:00:00', '2018-08-12 00:00:00', '21:00', '12:00', '[{\"day\":\"Monday\",\"status\":true},{\"day\":\"Tuesday\",\"status\":true},{\"day\":\"Wednesday\",\"status\":true},{\"day\":\"Thursday\",\"status\":true},{\"day\":\"Friday\",\"status\":true},{\"day\":\"Saturday\",\"status\":true},{\"day\":\"Sunday\",\"status\":true}]', 'process'),
(214, 'producto heavy', 300, '1', 'esta es la descripciuon', 'activo', NULL, '2019-10-07 19:30:12', '0', 13, '2019-05-12 20:00:00', '2019-05-13 20:00:00', '0:1:00', '3:3:00', '[{\"day\":\"Monday\",\"status\":\"true\"},{\"day\":\"Tuesday\",\"status\":\"true\"},{\"day\":\"Wednesday\",\"status\":\"true\"},{\"day\":\"Thursday\",\"status\":\"true\"},{\"day\":\"Friday\",\"status\":\"true\"},{\"day\":\"Saturday\",\"status\":\"true\"},{\"day\":\"Sunday\",\"status\":\"true\"}]', 'process'),
(215, 'Enchufe', 200, '2', 'descripcion', 'activo', '2019-05-12 20:06:46', '2019-10-07 19:27:47', '0', 2, '2019-05-12 11:00:00', '2020-05-12 11:00:00', '8:00:00', '11:59:00', '[{\"day\":\"Monday\",\"status\":\"true\"},{\"day\":\"Tuesday\",\"status\":\"true\"},{\"day\":\"Wednesday\",\"status\":\"true\"},{\"day\":\"Thursday\",\"status\":\"true\"},{\"day\":\"Friday\",\"status\":\"true\"},{\"day\":\"Saturday\",\"status\":\"true\"},{\"day\":\"Sunday\",\"status\":\"true\"}]	', 'no'),
(216, 'Router satelital', 300, '1', 'hola', 'activo', '2019-05-16 19:16:53', '2019-10-07 19:28:55', '1', 2, '2019-05-12 11:00:00', '2020-05-12 11:00:00', '8:00:00', '11:59:00', '[{\"day\":\"Monday\",\"status\":\"true\"},{\"day\":\"Tuesday\",\"status\":\"true\"},{\"day\":\"Wednesday\",\"status\":\"true\"},{\"day\":\"Thursday\",\"status\":\"true\"},{\"day\":\"Friday\",\"status\":\"true\"},{\"day\":\"Saturday\",\"status\":\"true\"},{\"day\":\"Sunday\",\"status\":\"true\"}]	', 'no'),
(217, 'Cargador', 33223, '2', 'edsdsds', 'activo', NULL, '2019-10-07 19:31:10', '0', 13, '2019-05-26 20:00:00', '2019-05-30 20:00:00', '1:8:00', '21:2:00', '[{\"day\":\"Monday\",\"status\":\"true\"},{\"day\":\"Tuesday\",\"status\":\"true\"},{\"day\":\"Wednesday\",\"status\":\"true\"},{\"day\":\"Thursday\",\"status\":\"true\"},{\"day\":\"Friday\",\"status\":\"true\"},{\"day\":\"Saturday\",\"status\":\"true\"},{\"day\":\"Sunday\",\"status\":\"true\"}]', 'no'),
(218, 'Bateria de telefono', 3223, '1', 'dadasdsasd', 'activo', NULL, '2019-10-07 19:31:57', '0', 13, '2019-05-17 20:00:00', '2019-05-30 20:00:00', '0:1:00', '0:1:00', '[{\"day\":\"Monday\",\"status\":\"true\"},{\"day\":\"Tuesday\",\"status\":\"true\"},{\"day\":\"Wednesday\",\"status\":\"true\"},{\"day\":\"Thursday\",\"status\":\"true\"},{\"day\":\"Friday\",\"status\":\"true\"},{\"day\":\"Saturday\",\"status\":\"true\"},{\"day\":\"Sunday\",\"status\":\"true\"}]', 'no'),
(219, 'Baterias', 300, '1', 'esta es la descripcion', 'activo', NULL, '2019-10-07 19:30:44', '0', 85, '2019-10-14 20:00:00', '2019-10-13 20:00:00', '9:0:00', '12:0:00', '[{\"day\":\"Monday\",\"status\":\"true\"},{\"day\":\"Tuesday\",\"status\":\"true\"},{\"day\":\"Wednesday\",\"status\":\"true\"},{\"day\":\"Thursday\",\"status\":\"true\"},{\"day\":\"Friday\",\"status\":\"true\"},{\"day\":\"Saturday\",\"status\":\"true\"},{\"day\":\"Sunday\",\"status\":\"true\"}]', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_publicacion_atributos_globales`
--

CREATE TABLE `tbl_publicacion_atributos_globales` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_publicacion` int(10) UNSIGNED NOT NULL,
  `id_atributo` int(10) UNSIGNED NOT NULL,
  `valor_atributo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_publicacion_atributos_globales`
--

INSERT INTO `tbl_publicacion_atributos_globales` (`id`, `id_publicacion`, `id_atributo`, `valor_atributo`, `created_at`, `updated_at`) VALUES
(1, 214, 122, '3 dias', NULL, NULL),
(2, 217, 122, '18', NULL, NULL),
(3, 218, 122, '10', NULL, NULL),
(4, 219, 122, '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_publicacion_categoria`
--

CREATE TABLE `tbl_publicacion_categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `estado` enum('activa','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_publicacion_categoria`
--

INSERT INTO `tbl_publicacion_categoria` (`id`, `id_categoria`, `id_producto`, `estado`, `created_at`, `updated_at`) VALUES
(579, 111, 215, 'activa', '2019-10-07 19:27:47', '2019-10-07 19:27:47'),
(580, 113, 215, 'activa', '2019-10-07 19:27:47', '2019-10-07 19:27:47'),
(581, 108, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(582, 109, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(583, 110, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(584, 111, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(585, 112, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(586, 118, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(587, 134, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(588, 140, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(589, 146, 200, 'activa', '2019-10-07 19:28:23', '2019-10-07 19:28:23'),
(590, 123, 216, 'activa', '2019-10-07 19:28:55', '2019-10-07 19:28:55'),
(591, 109, 204, 'activa', '2019-10-07 19:29:34', '2019-10-07 19:29:34'),
(592, 136, 204, 'activa', '2019-10-07 19:29:34', '2019-10-07 19:29:34'),
(593, 109, 214, 'activa', '2019-10-07 19:30:12', '2019-10-07 19:30:12'),
(594, 110, 214, 'activa', '2019-10-07 19:30:12', '2019-10-07 19:30:12'),
(595, 109, 219, 'activa', '2019-10-07 19:30:44', '2019-10-07 19:30:44'),
(596, 110, 219, 'activa', '2019-10-07 19:30:44', '2019-10-07 19:30:44'),
(597, 108, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(598, 110, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(599, 112, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(600, 118, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(601, 134, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(602, 140, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(603, 146, 217, 'activa', '2019-10-07 19:31:10', '2019-10-07 19:31:10'),
(604, 108, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(605, 109, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(606, 110, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(607, 111, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(608, 112, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(609, 113, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(610, 114, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(611, 115, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(612, 116, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(613, 117, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(614, 118, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(615, 119, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(616, 120, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(617, 121, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(618, 122, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(619, 123, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(620, 124, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(621, 125, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(622, 126, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(623, 127, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(624, 134, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(625, 140, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57'),
(626, 146, 218, 'activa', '2019-10-07 19:31:57', '2019-10-07 19:31:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_publicacion_imagenes`
--

CREATE TABLE `tbl_publicacion_imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_publicacion` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('activo','pausa','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_publicacion_imagenes`
--

INSERT INTO `tbl_publicacion_imagenes` (`id`, `id_publicacion`, `ruta`, `estado`, `created_at`, `updated_at`) VALUES
(311, 215, 'uploads/215/cargador_de_pared_thuraya _4_.jpg', 'activo', '2019-10-07 19:27:38', '2019-10-07 19:27:38'),
(312, 200, 'uploads/200/thuraya_xt_pro _1_.jpg', 'activo', '2019-10-07 19:28:09', '2019-10-07 19:28:09'),
(313, 216, 'uploads/216/redport_optimizer _1_.jpg', 'activo', '2019-10-07 19:28:42', '2019-10-07 19:28:42'),
(314, 204, 'uploads/204/cargador_de_coche_para_isatphone_pro_e_isatphone_2 _1_.jpg', 'activo', '2019-10-07 19:29:17', '2019-10-07 19:29:17'),
(315, 204, 'uploads/204/cargador_de_coche_thuraya _1_.jpg', 'activo', '2019-10-07 19:29:18', '2019-10-07 19:29:18'),
(316, 204, 'uploads/204/cargador_de_coche_para_isatphone_pro_e_isatphone_2.jpg', 'activo', '2019-10-07 19:29:18', '2019-10-07 19:29:18'),
(317, 214, 'uploads/214/cobham_explorer_510_bgan.jpg', 'activo', '2019-10-07 19:29:59', '2019-10-07 19:29:59'),
(318, 214, 'uploads/214/cobham_explorer_710_bgan _1_.jpg', 'activo', '2019-10-07 19:29:59', '2019-10-07 19:29:59'),
(319, 214, 'uploads/214/cobham_explorer_710_bgan _2_.jpg', 'activo', '2019-10-07 19:29:59', '2019-10-07 19:29:59'),
(320, 214, 'uploads/214/cobham_explorer_710_bgan _3_.jpg', 'activo', '2019-10-07 19:29:59', '2019-10-07 19:29:59'),
(321, 219, 'uploads/219/pilas_energizer_aaa_ultimate_lithium _1_.jpg', 'activo', '2019-10-07 19:30:35', '2019-10-07 19:30:35'),
(322, 219, 'uploads/219/pilas_energizer_aaa_ultimate_lithium.jpg', 'activo', '2019-10-07 19:30:35', '2019-10-07 19:30:35'),
(323, 217, 'uploads/217/cargador_de_pared_thuraya.jpg', 'activo', '2019-10-07 19:31:00', '2019-10-07 19:31:00'),
(324, 217, 'uploads/217/cargador_pared_inmarsat_isatphone_pro_isatphone_2.jpg', 'activo', '2019-10-07 19:31:00', '2019-10-07 19:31:00'),
(325, 218, 'uploads/218/bateria_inmarsat_isatphone_2 _1_.jpg', 'activo', '2019-10-07 19:31:45', '2019-10-07 19:31:45'),
(326, 218, 'uploads/218/bateria_inmarsat_isatphone_2.jpg', 'activo', '2019-10-07 19:31:45', '2019-10-07 19:31:45'),
(327, 218, 'uploads/218/bateria_iridium_go.jpg', 'activo', '2019-10-07 19:31:45', '2019-10-07 19:31:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL,
  `direccion2` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipe` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT 'admin :2 user:1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellido`, `email`, `password`, `estado`, `remember_token`, `created_at`, `updated_at`, `telefono`, `direccion`, `latitude`, `longitude`, `avatar`, `direccion2`, `tipe`) VALUES
(1, 'carlos', 'chacon', 'ccarch81@gmail.com', '$2y$10$y8KDNW3hMTSzEaz4PEFtKeZPQRGf8R6xlGJFnyvVEKyoHWOjojr3O', 'activo', 'z5F6BJxWIffYjJqmhiynjlZF6rjRzDs7ICM64shv3K3UBW4BxX3PixprL7HA', '2016-12-05 23:59:52', '2018-10-16 19:13:30', '', '', '40.463374', '-3.699329', 0, NULL, '1'),
(2, 'admin', 'rapipana', 'admin@rapipana.com', '$2y$10$uZvFdxvrQFizKjUVPrJAa..K9PNzVqmiBlTdorSCxdJu6GCECjqpy', 'activo', 'KYujgFItmyUaYXv9C0a7e5Xpai6V39Nbp1vxvnMfDEtmgvQiOVIXEbBOPuul', '2016-12-07 03:29:31', '2018-09-28 15:45:41', '12312321312', '', '40.4616721', '-3.7011249999999998', 0, NULL, '1'),
(5, 'ariel', 'bion', 'ariel@grupobion.com', '$2y$10$WNe6I27ZBKHkAK.99LgO2u6SVguN8.u8H2JD9wkV7L/lJ4zAfgWre', 'activo', 'eXkQYdkYQCenTboROWYoo2gjJiVB25ldsiyeoL7XDJH7oHMMhKOrz00JnE4G', '2016-12-15 04:53:02', '2017-01-10 13:41:43', '', '', NULL, NULL, 0, NULL, '1'),
(7, 'demo1', 'demo1', 'demo@demo.com', '$2y$10$Ei2bcavcdXPpnoqoDFpRVOaYe1D3r7YO3Lwlpts50lLkLEFvY18qW', 'activo', NULL, '2017-01-05 02:33:15', '2017-01-05 02:33:15', '', '', NULL, NULL, 0, NULL, '1'),
(8, 'test', 'test', 'test@test.com', '$2y$10$M81KoCjqARex8CMIlbcDl.nZt2IKM//G94vcn4HL4tZ0rH2f7mZ86', 'activo', 'rdHFrXIjWlBro71y3I0jB0NbcQr2aBne9H5TqcTpV6JiUWwNXQzsgiwW9m2f', '2017-01-06 23:01:12', '2017-01-07 01:25:44', '', '', NULL, NULL, 0, NULL, '1'),
(9, 'santiago', 'aguirre', 'santiago@publicenter.com.ar', '$2y$10$eHungyJXl5pDmdS6/GPQoebRmAaEX48ETmjZVmA13ltogN5mnAqAi', 'activo', 'MVv8n4Lg7LsOxmiTFU8tGtYyQobPKTQyyuDSCx4QuN0zPlYJ8GhYeCyhTeIU', '2017-01-09 23:30:54', '2017-01-15 05:10:51', '', '', NULL, NULL, 0, NULL, '1'),
(13, 'yonathan', 'suarezzz', 'yond1994@gmail.com', '$2y$10$tyy7XX7Qv7ZXqg51XyeieeCU57AtWf18qy0eG5Tozbn/VIRX5OM.2', 'activo', 'tE0KgBqDVkydaoJfBSuhDbMlGe3c2aXTvsvMd94JhFAHuydnS075NgYv6yAM', NULL, '2019-10-06 18:23:01', '04268734726', 'calle 12 carrera 9-10', '40.4295019', '-3.7157158000000003', 0, 'Segunda direcc', '2'),
(19, 'yonathan', 'suarez', 'yondansu@gmail.com', '$2y$10$CNYMNkOPYl2m/SIT297F.e7a.IDGW/6zo8MeyX.9XttSc9P0Gyk3u', 'activo', NULL, NULL, NULL, '4212312', 'calle 12 carrera 9-10', 'null', 'null', NULL, NULL, '1'),
(20, 'yona', 'sua', 'yond@gmail.com', '$2y$10$38LXNiHVfOm9I1QHmMiL3u168w0IcKomTqVYMlA5OMajw1u1tMEv6', 'activo', NULL, NULL, NULL, '4231231', 'calle 13 asdasd', '40.4616015', '-3.7011865', NULL, NULL, '1'),
(21, 'asdasd', 'qwewqe', 'yond1994@asdsad.com', '$2y$10$Pr/IrIuIKGwl2q1fm4ZFlOceTfwYTiq4b3y4hEIUXwMYRnxeCe3lO', 'activo', NULL, NULL, NULL, '(34) 12121-2121', 'cascada asdasd', '40.4640717', '-3.692763', NULL, NULL, '1'),
(22, 'Will', 'Wiill', 'wil@gmail.com', '$2y$10$dQCCfSqizXRfMgS7jH6eZeX6.ky30SFPdZvi0IK7i0DJEF00gHV36', 'activo', NULL, NULL, NULL, '(34) 34727-2849', 'Esta es la respuesta ', 'null', 'null', NULL, NULL, '1'),
(23, 'Caca', 'Caca', 'caca@caca', '$2y$10$1QI60asdAzJ/P9e7Yz/pvuoyNNfZpko3QawA4z4QpPZBk1NoeVC0O', 'activo', NULL, NULL, '2018-07-24 15:49:51', '(34) 38382-7289', 'Calle 12 ', '40.4592142', '-3.6888446', NULL, NULL, '1'),
(24, 'Leifer', 'Demo', 'demo@demo.net', '$2y$10$nxLUuJVb7.aPjuZZp2yx/./9Ag7h98Q/GeyPRKONnJu9XChwG0Z4K', 'activo', NULL, NULL, NULL, '(34) 69101-5468', 'Madrid', 'null', 'null', NULL, NULL, '1'),
(25, 'Test', 'Demo', 'test@test.net', '$2y$10$eW/3ABIRe96bBZueamX9aue.IO/FYhExaz4os.x9eHRGk6YYRclDe', 'activo', NULL, NULL, NULL, '(34) 69145-8476', 'Madrid', '40.4621411', '-3.6911586', NULL, NULL, '1'),
(26, 'francisco', 'bautista serrano', 'kiko.000@live.com', '$2y$10$AKad86xeoD/vRuPgvi8zmu31PmYiULtm9B5qX/dHixNZ7LzLFD1gK', 'activo', NULL, NULL, NULL, '(34) 63322-4266', 'errotazar 23', 'null', 'null', NULL, NULL, '1'),
(27, 'Elena', 'Lorente', 'marijelen11@hotmail.com', '$2y$10$//UIam9eTy1D3vv0PLWeZez2CMbqRBr/EPRjQvMd57Gl3BMNJz5um', 'activo', NULL, NULL, NULL, '(34) 66136-5561', 'Xxxxxxx', 'null', 'null', NULL, NULL, '1'),
(28, 'Javier', 'Aranda', 'jaranda84@hotmail.com', '$2y$10$UVNgxuGAfbnwLk.msl47/OsCVtqYgzCzRXKk16cubaKzgnTLLr6Va', 'activo', NULL, NULL, '2018-07-31 16:36:30', '(34) 62847-0923', 'Calle rio arga 26 2 d Pamplona', '42.8240155', '-1.6549022', NULL, NULL, '1'),
(29, 'Elena', 'Lorente', 'elenalorente1@gmail.com', '$2y$10$vb7ZT6f2Pf9zGhkU6BrsXu26PWya/mBQV50FVX/h6H9e2/NLNUZbq', 'activo', NULL, NULL, '2018-09-08 16:41:47', '(34) 66136-5561', 'Lesaka', '42.8294992', '-1.632209', NULL, NULL, '1'),
(30, 'Oihana ', 'Mendieta ', 'oihanaetamendia@hotmail.com', '$2y$10$H0UqEKbEaA95Jy0JhKy/oOGTOe/xbxa5wGkhICTj/yeaD4Avkqqpq', 'activo', NULL, NULL, NULL, '(34) 65779-3687', 'Zigordia 8 2ª', 'null', 'null', NULL, NULL, '1'),
(31, 'web', 'websappe', 'web@web.com', '$2y$10$Jqtw4qGXw1QiX8RGY5Z/fec3uAO8nJ2NMyuqtycZ6zgcVG5gDxYq6', 'activo', NULL, NULL, NULL, '(34) 54545-4121', 'castellana 23 ', '40.4640717', '-3.692763', NULL, 'casa 35', '1'),
(32, 'casca', 'descanso', 'yon94@gmail.com', '$2y$10$sBsDwuejwKJPOoqbXG497On4BF8rfcOXTu3AZuwJyphjTMPewgeXW', 'activo', NULL, NULL, NULL, '(34) 54545-4121', 'calle 12 ', '40.4640717', '-3.692763', NULL, 'carrera 28', '1'),
(33, 'casca', 'sua', '123@123.com', '$2y$10$CT2xrZR9NVv45i8MXNTAouh.3PFr.bpHQtjDhnTHJPZtWmnpTGLny', 'activo', NULL, NULL, NULL, '(34) 24545-4512', 'calle 5', '40.4640717', '-3.692763', NULL, 'casd asd', '1'),
(34, 'Demo', 'Demo', 'dem@dem.com', '$2y$10$jBiuEukzpSr7bJsr4.RhY.U0WfCtFrqWrDJOUusT/Exvy8QcMZdmS', 'activo', NULL, NULL, NULL, '(34) 6939-393', 'Eukee', 'null', 'null', NULL, 'Eie', '1'),
(35, 'pppp', 'iiii', 'y@q.com', '$2y$10$9m9OHc2jRsMDJHjwMrufZ.YwW7sY7AP0ZFZqO7/l6VpLkZSVbPiAe', 'activo', NULL, NULL, NULL, '(34) 45451-2154', 'calle 12 ', '40.4640717', '-3.692763', NULL, 'casa 9-10', '1'),
(36, 'Wilber', 'Mujica', 'wilber@gmail.com', '$2y$10$ohn8zW1ShZHb8XTqzxIKnONKw1I7LAoDSfOHLMzS83n58.303wtOu', 'activo', NULL, NULL, NULL, '(34) 23372-8183', 'Calle 12 ', '40.459203', '-3.6888498', NULL, 'Carrera 9-10', '1'),
(37, 'Patxi', 'Ibañez', 'patxikutx@hotmail.com', '$2y$10$rZWA68oK0gy9m8sRDGGhwOb.7ti57QKShtmcp9TE5B87a0tqiH2Ey', 'activo', NULL, NULL, '2018-08-02 16:37:07', '(34) 63333-0223', 'Calle Lesaka 1primero c', '42.825263', '-1.629489', NULL, NULL, '1'),
(38, 'Trst', 'Etwte', 'hola@hola.com', '$2y$10$wyifmtk26Sx7aJQetvOu/Om1av1ySa8I1CtQcEa/l0lysufzGf8Pm', 'activo', NULL, NULL, NULL, '(34) 37474-7474', 'Cdmx', '40.4591733', '-3.6889672', NULL, '34', '1'),
(40, 'Javier', 'Sesma', 'barjavier@hotmail.com', '$2y$10$7qSFedj82faBD0gIpPDyZO99Wj4vbkCUUVp12kxR8VoLbkJcKXpb2', 'activo', NULL, NULL, '2018-07-30 13:44:54', '(34) 62680-0218', 'Cildoz 3', '42.8301557', '-1.624361', NULL, '1', '1'),
(42, 'Albert', 'Mujica', 'marianarolfo29@gmail.com', '$2y$10$fRClFMVBiNR8VHSEIVVLdOfYo8d07OupQSUsQRB1C3RQol8IZpUvm', 'activo', NULL, NULL, '2018-07-30 14:08:37', '(34) 3838-3383', 'Cemx', '42.3441207', '-3.7297124', NULL, '48', '1'),
(43, 'Txinaurri', 'Soft soft', 'txinaurri@hotmail.com', '$2y$10$Unj8kc.ZkiBhO.srRjpQE.qofWOF4yUy0/2kYJ4ERKvrBa4/Dq3x6', 'activo', NULL, NULL, '2018-07-30 14:44:20', '(34) 66666-6666', 'Rue del percebe', 'null', 'null', NULL, '1', '1'),
(44, 'Naiara', 'Ibanez Lorente', 'naiara_ibanez@hotmail.com', '$2y$10$OPyamUIEWwRuFTFoYM4du.gdcrl/KsXovZXK46kj1LU9znTRm6.uu', 'activo', NULL, NULL, '2018-07-30 16:13:40', '(34) 66697-2595', 'Calle Cildoz ', '-0.2047276', '-78.4869486', NULL, '1 1A', '1'),
(45, 'Vanessa', 'Echavarri erdozain', 'vanessaechavarries@gmail.com', '$2y$10$te80JRJj0R5Z7WedoU80quZ7UDcg3xh6rqcvyqu/b8PBqRSzfUxwK', 'activo', NULL, NULL, '2018-07-30 19:28:35', '(34) 64900-5213', 'Calle estafeta 4', 'null', 'null', NULL, '4', '1'),
(46, 'Kepa ', 'Keton ', 'kepaketon@hotmail.com', '$2y$10$eF9mhAGWAW0vyPmz08a9DOHvOOKAKrd0oH22XaFw81yAE0QTyaAzG', 'inactivo', NULL, NULL, NULL, '(34) 6669-96', 'Gyuijgggh hilos ', '42.8101935', '-1.5972293', NULL, '69', '1'),
(47, 'Fernando', 'Torres', 'fertoriko@gmail.com', '$2y$10$8bFb9aaolu.SADtNxujH0.dXwVwzUCuh9VjQD5J25Pf/GcNHkGti6', 'activo', NULL, NULL, '2018-12-02 11:13:07', '(34) 63626-1898', 'Calle caseda', '43.3854395', '-4.1048512', NULL, '21 bajo', '1'),
(48, 'Eneko', 'Oses', 'okene00@hotmail.com', '$2y$10$5OpnQ2IP5s1j3vRSBrtT6OjlaIkNETPb44T6zy4diygGF4RwSLO8q', 'inactivo', NULL, NULL, NULL, '34 ', 'Av/villava n° 84-1°D', '42.8314303', '-1.6256487', NULL, '84', '1'),
(49, 'Piluka', 'Jajaja', 'pilukajajaja@hotmail.com', '$2y$10$3hQY/Jj7t8dxSvAXIL/pRuPsi4P5sZ918kRPDmKN6n5JQREzmVkMG', 'inactivo', NULL, NULL, NULL, '34 ', 'Sierra de Andia ', '42.8126441', '-1.5955161', NULL, '10, 2 A', '1'),
(50, 'Susana', 'Mendo', 'susisugandila@yahoo.es', '$2y$10$j9Ch1JXZ0DLIFPo57z4NQuAB7QzDeY1MraMRdQ5lsAWplU0fsJZIe', 'inactivo', NULL, NULL, NULL, '(34) 60948-2303', 'Besaire', '41.7802221', '3.0396171', NULL, '80,2b', '1'),
(51, 'David', 'Extremera', 'pelukapura@gmail.com', '$2y$10$AMAWZ3elDtqzzLJfYYeLkO6inbxWQraMATqUceNgm2uJr04XKtnt2', 'inactivo', NULL, NULL, NULL, '(34) 60703-0534', 'Madroño', '40.3062211', '-3.9313966', NULL, '28', '1'),
(52, 'Carlos ', 'Valencia ', 'saotxo.cv@gmail.com', '$2y$10$kJil6WfCSbN2LxuzAOiUOO9Ubm.eG4WUn./qv/aMXXn.ZwtUqbbCC', 'inactivo', NULL, NULL, NULL, '34 ', 'Plaza mayor', 'null', 'null', NULL, '331b', '1'),
(53, 'Gorka', 'Osta Garate', 'gorkasound@yahoo.es', '$2y$10$zxbE/EeY04AAU.yv91QD/OK5NoCiY2v3CVigIxDXEYybsNyMSLk2e', 'inactivo', NULL, NULL, NULL, '(34) 69929-9741', 'C/alamos de lodosa', '42.9365156', '-1.6849053', NULL, '15 5b', '1'),
(54, 'Jon', 'Goñi', 'juantxokolste@gmsil.com', '$2y$10$4RM3xfoZbVYtFHlgRdzrPuLNiFV/zZJcHJ14C3FAeGwUQcV5TXiqa', 'inactivo', NULL, NULL, NULL, '(34) 65982-5271', 'Curia karrika 27', 'null', 'null', NULL, '1.', '1'),
(55, 'Jon ', 'Goñi', 'juantxokolate@gmail.com', '$2y$10$e3S4vFoMBOnFgRe/BIu3uOtN08spSIXSKnqv3qXwCWHxW3i/H0Fbe', 'activo', NULL, NULL, '2018-07-31 20:31:43', '(34) 65982-5271', 'Curia karrika 27', 'null', 'null', NULL, '1.', '1'),
(56, 'David', 'Resano', 'ratatouil84@gmail.com', '$2y$10$aWAZfT3c77CdqTvzUk.QJ.MxcDGdYxkWcV6L721MPgVsKfRWczx9a', 'activo', NULL, NULL, '2018-08-01 10:51:26', '(34) 64611-9589', 'Ezkaba 21 alto pamplona', 'null', 'null', NULL, '21 alto', '1'),
(57, 'mikel', 'alfaro tio', 'mikeldrif123@gmail.com', '$2y$10$z9wofzM/O6TgboT3G59j3.2nU0H/dhPPsfV4YrLaJQrDtSAj1NXwG', 'inactivo', NULL, NULL, '2018-08-01 13:31:42', '(34) 68917-3905', 'avenida pamplona portal 20', '42.802284', '-1.6840258', NULL, '4 d', '1'),
(58, 'vali', 'm', 'nicecoolfine@gmail.com', '$2y$10$B.R5.7fXsKt1viwaoKZX/ebk8ls3oGKcZD5Vf3SGAg7A.uQZ5XaKe', 'activo', NULL, NULL, '2018-08-01 13:38:03', '(34', 'santa vicenta maria', '42.8198572', '-1.6645153', NULL, '16', '1'),
(59, 'Ana', 'Diaz', 'Ana.diaz@adginvestigacion.com', '$2y$10$wuccG30nMzO2qLozWMnbuOYmB7pAbDIVAN5AWutcrqCjDNJfiSpjC', 'activo', NULL, NULL, '2018-08-01 15:24:34', '(34) 60031-0730', 'Pamplona', 'null', 'null', NULL, '3', '1'),
(60, 'Jorge', 'R', 'sobreruedaspc@gmail.com', '$2y$10$C9hoEu6nyKYANw7Oc0e1g.JHyN124OOO6mPAF3Fl/wjcDdSy5wBjG', 'activo', NULL, NULL, '2018-08-02 14:49:50', '699322475', 'Avenida san jorge', '40.388081', '-3.6690128', NULL, '81', '1'),
(61, 'Angel', 'Minda', 'angel_minda@hotmail.es', '$2y$10$AczzajviwRrSVgbpmsUWhud2oUPLbejFOWGVH0zJaZOoGEByE9cqG', 'activo', NULL, NULL, '2018-08-01 17:14:30', '(34) 64844-8691', 'C/lizarra', '42.6739086', '-2.0308835', NULL, '49', '1'),
(62, 'Jesus', 'Rodriguez vaquero', 'infoebayrepuestoinformatico@gmail.com', '$2y$10$xjKoBXSjrggNZWLA.xh6QOgtX8hSDl9/TbqX9kK7FOWgmw4klWddi', 'activo', NULL, NULL, '2018-08-02 10:28:29', '', 'Calle puerto linera 10 nave 16', '40.3374699', '-3.8634623', NULL, 'Nave 16', '1'),
(63, 'Raul ', 'Yuste ', 'raulhoyo666@gmail.com', '$2y$10$RHUfGv3NdLtiHZZ/EWZ/J.q.VTu6Teu.ekco31OMqXgvKrbLwNvgy', 'activo', NULL, NULL, '2018-08-08 21:43:25', '(67) 9280-596', 'Madrid ', '39.98153220090862', '-4.7352195364048715', NULL, 'Casa', '1'),
(64, 'Raul ', 'Yuste ', 'avalanchraul@hotmail.es', '$2y$10$hPn0N8zMwV3Qq5nfYbQkxOZ.1cEeiKKIm5Q6YSKkW6gNOT/xc14He', 'inactivo', NULL, NULL, NULL, '(67) 9280-596', 'Madrid ', '39.98153220090862', '-4.7352195364048715', NULL, 'Casa', '1'),
(65, 'Mayka', 'Iglesias', 'maykaiglesiasgarcia@hotmail.es', '$2y$10$PG7/.d2vzyldpImT.hrSi.9vuTVYP31Lf.pueEvrrFf0D0SG3eHuK', 'activo', NULL, NULL, '2018-08-05 09:30:50', '(34) 62249-4247', '3 de Abril', 'null', 'null', NULL, '2-2G', '1'),
(66, 'Oscar', 'Galindez', 'galindez78@hotmail.com', '$2y$10$r.PHr6RnHoRdGAtYENKSHO/NTZnLrrUEMu0BEGlvsfHr1DiGLpMJ2', 'activo', NULL, NULL, '2018-08-05 14:28:31', '34 ', 'Avenida de la bandera', '42.0240434', '-1.4859237', NULL, '35', '1'),
(67, 'Jose', 'Moreno', 'platinu64@gmail.com', '$2y$10$kAlVEybByHMn4eBskUCcgO2G.RRit39Lu4d45OvNs15jlJgmAHhG2', 'activo', NULL, NULL, '2018-08-05 17:42:02', '34 ', 'Cuba', '40.1875194', '-3.691835', NULL, '53', '1'),
(68, 'Diego', 'Leon', 'netohg_one@hotmail.es', '$2y$10$1g1SMcjUCbf5yYH/KeqSpeCYsmx8dxFDkBjPm7eOp1yOb17WFhK..', 'activo', NULL, NULL, '2018-08-06 01:11:46', '(69) 8528-520', 'Calle', '40.388081', '-3.6690128', NULL, '10', '1'),
(69, 'Javier Iván', 'Montezuma Pantoja', 'jmontezuma23@gmail.com', '$2y$10$R0C5wnRRa/30k7.PUzqLhedpuH35c8knpeihutb9szqQohfThOSwi', 'activo', NULL, NULL, '2018-08-06 13:59:02', '(34) 65454-3704', 'Calle Elfo ', '40.4357916', '-3.645626', NULL, '106', '1'),
(70, 'repuesto', 'informatico', 'ebayrepuestoinformatico@gmail.com', '$2y$10$X2Dy1ChQYtYc.h4gtZrIiuUBxpydEx6ZH/RJ5MJv62hqZRT3RvHHa', 'activo', NULL, NULL, '2018-08-09 14:16:31', '(34) 68235-9839', 'avenida america 32', '40.3477127', '-3.8691787', NULL, '32', '1'),
(71, 'Adolfo', 'Marcos vicente', 'adolfo.marcos.vicente@gmail.com', '$2y$10$Z/mOIiwOQLcNd9ntFFAfgO.Vgr1OqyCGcpL384nOOm9ATE/AyPrNi', 'activo', NULL, NULL, '2018-08-10 14:41:37', '(34) 69360-8250', 'Pamplona c/cintruenigo ', 'null', 'null', NULL, 'N5 bajo', '1'),
(72, 'Alicia', 'Balmaseda', 'riojamaq@gmail.com', '$2y$10$kRQSNzg5LxPNuQeUny5yQ.zTazyRrYvP0oskGnCaECdVkalihEBRO', 'activo', NULL, NULL, '2018-08-17 21:14:01', '(34) 66677-0413', 'Logroño', 'null', 'null', NULL, '31', '1'),
(73, 'Carlos', 'Goñi Santesteban', 'txarlytxan@hotmail.com', '$2y$10$VAW2tyNUl/lp6GW3qST6Gub2xy5DucrxZpddBgv8bZNKCeGmr4wnS', 'activo', NULL, NULL, '2018-08-18 19:25:12', '(34) 63372-0326', 'Plaza Sancho VI El Sabio', '42.8292798', '-1.6282155', NULL, 'N°1 - 3°D', '1'),
(74, 'Jaio', 'Martinez', 'Jaio771@gmail.com', '$2y$10$MLj0rgZljpy9KYmo4AkMFebWC./EoImBQ/3S1CM4dATxX7m.GsCHS', 'activo', NULL, NULL, '2018-08-27 19:28:18', '(34) 60688-9420', 'Gipuzkoa kalea 28', '43.2863428', '-2.1763426', NULL, '1esk', '1'),
(75, 'Íñigo', 'Rodríguez', 'Morenoeugenio73@yahoo.es', '$2y$10$dn/8M2LgaVy9pNOUT8EHHuKdMetqFsKafT3TZVKW2x9.WXPqpHoou', 'activo', NULL, NULL, '2018-10-02 17:25:47', '66666696', 'Desengaño 21', 'null', 'null', NULL, '3°A', '1'),
(76, 'Javier', 'Mata', 'javimata80@gmail.com', '$2y$10$h4OlSlZpyGFTNCSxEHN5DeCDsMIffRLPqZc5n9Q2WbA0ga23dLbtq', 'activo', NULL, NULL, '2018-10-06 00:58:40', '(34) 61668-3919', 'Ppdkfkdkd', '42.8183668', '-1.6422055', NULL, 'Fdff', '1'),
(77, 'Rodrigo', 'Vargas', 'franksniper@gmail.com', '$2y$10$D/nTiTFpoALq9v3ZTWNJwOPkTQwHQV53tWp/erxS2J6YwLodacLEq', 'activo', NULL, NULL, '2018-10-09 01:06:16', '(55) 1150-1922', 'Domingo Rios', '19.3880849', '-99.1355939', NULL, '42', '1'),
(78, 'Ricardo Isaias', 'Mendoza', 'izaiazm9@gmail.com', '$2y$10$y3TzF4HNp6GarUwcTRrRaOINJgnO72wFHh.vsqmOM77.N87kS6QSW', 'activo', NULL, NULL, '2018-10-09 14:48:56', '(44) 9102-9698', 'Tapias Viejas Chicahuales II', 'null', 'null', NULL, '305', '1'),
(79, 'Josa', 'Barcenas', 'josamartinez900@gmail.com', '$2y$10$itGdCCJ73TBMma5TnuyCTuGc3MBTl4KmtNuDIFhaP/F4bZ345eZya', 'activo', NULL, NULL, '2018-12-21 17:32:53', '34 ', 'Americo villa real', 'null', 'null', NULL, '', '1'),
(80, 'Javier', 'Ramírez', 'javier@ramirezasesores.net', '$2y$10$8PM2xWG/xz9fSMGi1q1iLu6SEAFWoBprZLJ2WVdcK1drlRMfpTe4C', 'inactivo', NULL, NULL, NULL, '34 ', 'Plaza constitución', 'null', 'null', NULL, '9', '1'),
(81, 'Alvaro', 'fuentes-guerra', 'alfugue@gmail.com', '$2y$10$13AExh79d2EjpX6clyYPhe7mJ0wtxcBtvQJtwBf8dR16wn2aZm4bG', 'inactivo', NULL, NULL, NULL, '(67) 0384-332', 'José Sánchez Guerra 7,1,2', '37.901112', '-4.7771819', NULL, 'Piso', '1'),
(82, 'yonathan2', 'suarez', 'jond2894@gmail.com', '$2y$10$Pb.KiCLznkVO9vdarGqfjeRU2cTxiQ09EBqFnnDvkpVIbIAqqOFCO', 'activo', NULL, NULL, NULL, '426', 'calle 12', NULL, NULL, NULL, NULL, '1'),
(83, 'yonathan', 'suarez2', 'yondann@ggmmail.com', '$2y$10$MEIhjll/Y8ZiGKO5OooTp.Zm4/cv5UFNIFwJ/IxAGH1Oi48kt6Q3G', 'activo', NULL, '2019-05-12 17:34:13', '2019-05-12 17:34:13', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(84, 'admin', 'admin rapipana', 'admin@admin.com', '$2y$10$uZvFdxvrQFizKjUVPrJAa..K9PNzVqmiBlTdorSCxdJu6GCECjqpy', 'activo', NULL, '2019-05-12 20:10:19', '2019-05-12 20:10:19', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(85, 'yon', 'suarez', 'yondansu23@gmail.com', '$2y$10$mhRmZ6zajEjSu4dSEoVsdOmQg8szc7cni/Law.Ar51IxSu5eHcN9W', 'activo', NULL, NULL, NULL, '651965515', 'call 12', NULL, NULL, NULL, NULL, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `newsleter`
--
ALTER TABLE `newsleter`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `producto_ventas`
--
ALTER TABLE `producto_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_atributos_globales`
--
ALTER TABLE `tbl_atributos_globales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_atributos_globales_valores`
--
ALTER TABLE `tbl_atributos_globales_valores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_atributos_globales_valores_id_atributos_globales_foreign` (`id_atributos_globales`);

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_categoria_atributos`
--
ALTER TABLE `tbl_categoria_atributos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_categoria_atributos_id_categoria_foreign` (`id_categoria`),
  ADD KEY `tbl_categoria_atributos_id_atributo_foreign` (`id_atributo`);

--
-- Indices de la tabla `tbl_contacto_publicacion`
--
ALTER TABLE `tbl_contacto_publicacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_contacto_publicacion_id_publicacion_foreign` (`id_publicacion`);

--
-- Indices de la tabla `tbl_publicaciones`
--
ALTER TABLE `tbl_publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_publicacion_atributos_globales`
--
ALTER TABLE `tbl_publicacion_atributos_globales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_publicacion_atributos_globales_id_publicacion_foreign` (`id_publicacion`),
  ADD KEY `tbl_publicacion_atributos_globales_id_atributo_foreign` (`id_atributo`);

--
-- Indices de la tabla `tbl_publicacion_categoria`
--
ALTER TABLE `tbl_publicacion_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_publicacion_categoria_id_categoria_foreign` (`id_categoria`),
  ADD KEY `tbl_publicacion_categoria_id_producto_foreign` (`id_producto`);

--
-- Indices de la tabla `tbl_publicacion_imagenes`
--
ALTER TABLE `tbl_publicacion_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_publicacion_imagenes_id_publicacion_foreign` (`id_publicacion`);

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
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `newsleter`
--
ALTER TABLE `newsleter`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto_ventas`
--
ALTER TABLE `producto_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `tbl_atributos_globales`
--
ALTER TABLE `tbl_atributos_globales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT de la tabla `tbl_atributos_globales_valores`
--
ALTER TABLE `tbl_atributos_globales_valores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria_atributos`
--
ALTER TABLE `tbl_categoria_atributos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT de la tabla `tbl_contacto_publicacion`
--
ALTER TABLE `tbl_contacto_publicacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_publicaciones`
--
ALTER TABLE `tbl_publicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT de la tabla `tbl_publicacion_atributos_globales`
--
ALTER TABLE `tbl_publicacion_atributos_globales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_publicacion_categoria`
--
ALTER TABLE `tbl_publicacion_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=627;

--
-- AUTO_INCREMENT de la tabla `tbl_publicacion_imagenes`
--
ALTER TABLE `tbl_publicacion_imagenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_atributos_globales_valores`
--
ALTER TABLE `tbl_atributos_globales_valores`
  ADD CONSTRAINT `tbl_atributos_globales_valores_id_atributos_globales_foreign` FOREIGN KEY (`id_atributos_globales`) REFERENCES `tbl_atributos_globales` (`id`);

--
-- Filtros para la tabla `tbl_categoria_atributos`
--
ALTER TABLE `tbl_categoria_atributos`
  ADD CONSTRAINT `tbl_categoria_atributos_id_atributo_foreign` FOREIGN KEY (`id_atributo`) REFERENCES `tbl_atributos_globales` (`id`),
  ADD CONSTRAINT `tbl_categoria_atributos_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id`);

--
-- Filtros para la tabla `tbl_contacto_publicacion`
--
ALTER TABLE `tbl_contacto_publicacion`
  ADD CONSTRAINT `tbl_contacto_publicacion_id_publicacion_foreign` FOREIGN KEY (`id_publicacion`) REFERENCES `tbl_publicaciones` (`id`);

--
-- Filtros para la tabla `tbl_publicacion_atributos_globales`
--
ALTER TABLE `tbl_publicacion_atributos_globales`
  ADD CONSTRAINT `tbl_publicacion_atributos_globales_id_atributo_foreign` FOREIGN KEY (`id_atributo`) REFERENCES `tbl_atributos_globales` (`id`),
  ADD CONSTRAINT `tbl_publicacion_atributos_globales_id_publicacion_foreign` FOREIGN KEY (`id_publicacion`) REFERENCES `tbl_publicaciones` (`id`);

--
-- Filtros para la tabla `tbl_publicacion_categoria`
--
ALTER TABLE `tbl_publicacion_categoria`
  ADD CONSTRAINT `tbl_publicacion_categoria_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id`),
  ADD CONSTRAINT `tbl_publicacion_categoria_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `tbl_publicaciones` (`id`);

--
-- Filtros para la tabla `tbl_publicacion_imagenes`
--
ALTER TABLE `tbl_publicacion_imagenes`
  ADD CONSTRAINT `tbl_publicacion_imagenes_id_publicacion_foreign` FOREIGN KEY (`id_publicacion`) REFERENCES `tbl_publicaciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
