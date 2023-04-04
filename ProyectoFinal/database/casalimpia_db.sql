-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2023 a las 05:36:28
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casalimpia_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_producto` int(11) NOT NULL,
  `img_url` text NOT NULL,
  `nombre_producto` varchar(40) NOT NULL,
  `tipo_producto` varchar(20) NOT NULL,
  `unidades` int(10) NOT NULL,
  `precio_producto` double(10,2) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_producto`, `img_url`, `nombre_producto`, `tipo_producto`, `unidades`, `precio_producto`, `descripcion`, `estado`, `fecha_registro`) VALUES
(12, '', 'Ace', 'Materia Prima', 150, 20.00, 'Producto Ace Buena Calidad', 'Activo', '2023-03-31 02:36:01'),
(16, '', 'Pulimento', 'Materia Prima', 200, 0.32, 'Pulimento Insumo', 'Activo', '2023-04-03 01:00:36'),
(17, '', 'Jabon Lacteo', 'Productos Terminados', 150, 0.56, 'Jabon', 'Activo', '2023-04-03 01:01:17'),
(18, '', 'Hipoclorito', 'Materia Prima', 400, 0.23, 'Hipoclorito para guardar', 'Activo', '2023-04-03 01:04:09'),
(22, '', 'Germisol', 'Materia Prima', 650, 1.20, 'Fragancia', 'Activo', '2023-04-03 01:10:03'),
(25, '', 'Champu', 'Materia Prima', 200, 0.99, 'Champu', 'Activo', '2023-04-03 01:21:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(10) NOT NULL,
  `fecha_orden` datetime NOT NULL DEFAULT current_timestamp(),
  `nombre_producto` varchar(30) NOT NULL,
  `unidades` int(10) NOT NULL,
  `precio_producto` double(10,2) NOT NULL,
  `nombre_proveedor` varchar(30) NOT NULL,
  `direccion_proveedor` varchar(200) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_orden`, `fecha_orden`, `nombre_producto`, `unidades`, `precio_producto`, `nombre_proveedor`, `direccion_proveedor`, `estado`) VALUES
(6, '2023-03-31 16:34:00', 'Jabon', 200, 0.70, 'Solquiven', 'La Limpia', 'Abierta'),
(8, '2023-03-31 16:36:52', 'Ace', 150, 1.00, 'Solquiven', 'Las Mercedes', 'Cerrada'),
(10, '2023-04-02 22:00:44', 'Lavaplatos', 500, 0.55, 'Solquiven', 'Las Mercedes', 'Abierta'),
(11, '2023-04-02 22:06:19', 'Algicida', 100, 0.80, 'All Clean', 'Miranda', 'Abierta'),
(12, '2023-04-02 22:10:36', 'Limpiador Baldosas', 50, 1.00, 'All Clean', 'Miranda', 'Abierta'),
(13, '2023-04-02 22:11:26', 'Spray', 35, 0.89, 'Solquiven', 'La Limpia', 'Abierta'),
(14, '2023-04-02 22:12:45', 'Cloro Blanqueador', 600, 0.65, 'All Clean', 'Miranda', 'Abierta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(40) NOT NULL,
  `materiales` varchar(40) NOT NULL,
  `mano_obra` double(10,2) NOT NULL,
  `unidades` int(11) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`id_producto`, `nombre_producto`, `materiales`, `mano_obra`, `unidades`, `estado`, `fecha_registro`) VALUES
(7, 'Cloro', 'Acido Sulfurico', 0.92, 500, 'En Produccion', '2023-04-02 15:37:48'),
(10, 'Desinfectante', 'Alcohol Etilico', 0.92, 400, 'En Produccion', '2023-04-03 02:49:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  `type` int(1) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `estado` text NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`, `type`, `avatar`, `estado`, `fecha_registro`) VALUES
(23, 'Carlos Ferrer', 'carlosfoberto1234@gmail.com', '$2y$10$nrbmsWp53cw0mQj6Hue8k.kIZAvOMyyRo8h3F1BHN6FTYE7HehAn6', 0, 'verified', 1, 'carlos 2.jpeg', 'Administrador', '2023-03-30 01:10:09'),
(25, 'Juan Medina', 'juan.medina@urbe.edu.ve', '$2y$10$vyBejJq3vjlpmXzFkCg9p.qRt0Ai9Pmzc1J4j.LUcHjhHkXeqrgAq', 0, 'verified', 1, 'medina.webp', 'Administrador', '2023-03-30 01:13:00'),
(27, 'Empleado', 'empleado1@casalimpia.com', '$2y$10$t7aWtPWOpUJnsiXR7k/kwOb0HNtcYWg6xsbhjB69Nvg6x45S1Z0N.', 0, 'verified', 2, 'computer-worker.png', 'Empleado', '2023-03-30 03:08:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
