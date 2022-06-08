-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2022 a las 10:24:50
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_restaurant`
--
CREATE DATABASE IF NOT EXISTS `db_restaurant` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_restaurant`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `Categoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `Categoria`) VALUES
(1, 'Ensaladas'),
(2, 'Bebidas'),
(3, 'Combos Express'),
(5, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ticket`
--

CREATE TABLE `detalle_ticket` (
  `id_detalle_ticket` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_ticket`
--

INSERT INTO `detalle_ticket` (`id_detalle_ticket`, `id_producto`, `folio`, `cantidad`, `precio`) VALUES
(7, 3, 48, 2, 46),
(9, 3, 48, 2, 46),
(10, 3, 48, 2, 46),
(11, 3, 48, 2, 46),
(12, 3, 48, 2, 46),
(13, 3, 48, 2, 46),
(14, 3, 48, 2, 46),
(15, 3, 48, 2, 46),
(16, 1, 48, 1, 23),
(20, 3, 54, 1, 23),
(21, 2, 54, 2, 20),
(23, 1, 48, 2, 46),
(25, 3, 55, 1, 23),
(26, 1, 56, 2, 46),
(27, 3, 56, 2, 46),
(28, 1, 56, 1, 23),
(29, 7, 57, 4, 176),
(30, 6, 57, 1, 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `ticket_folio` int(11) NOT NULL,
  `Cliente_id_cliente` int(11) NOT NULL,
  `razon_social` varchar(30) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `cfdi` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `categoria_id_categoria` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `Precio_de_Venta` float DEFAULT NULL,
  `Descripcion` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `categoria_id_categoria`, `nombre`, `Precio_de_Venta`, `Descripcion`) VALUES
(1, 2, 'Refresco 355 ml', 23, 'Refresco de cola'),
(2, 2, 'Aguas de Sabor', 11, 'Agua fresca de diferente tipo de sabores'),
(3, 1, 'Ensalada Cesar', 23, 'Ensalada tipo Cesar'),
(4, 2, 'Jarrito 500ml', 18, 'Jarritos de Varios Sabores'),
(5, 1, 'Pescado al mojo de Ajo', 23, 'Pescado al mojo de ajo'),
(6, 1, 'Pescado asado', 99, 'Pescado asado'),
(7, 2, 'Naranjada', 44, 'Naranjada'),
(8, 5, 'Carlota de Limon', 25, 'Delicioso postre casero\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `folio` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `mesa` varchar(12) DEFAULT NULL,
  `impuesto` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` varchar(10) NOT NULL,
  `fecha_salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`folio`, `usuario`, `fecha`, `mesa`, `impuesto`, `total`, `estado`, `fecha_salida`) VALUES
(48, 2, '2022-06-07 14:12:41', '3', 0, 437, 'pendiente', NULL),
(54, 2, '2022-06-07 23:19:03', '1', 0, 43, 'cobrado', '2022-06-08 01:38:45'),
(55, 2, '2022-06-08 01:36:00', '3', 0, 23, 'cobrado', '2022-06-15 01:37:27'),
(56, 3, '2022-06-08 01:59:22', '1', 0, 115, 'pendiente', NULL),
(57, 2, '2022-06-08 05:42:44', '2', 0, 275, 'cobrado', '2022-06-08 08:19:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `contrasena` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nickname`, `rol`, `nombre`, `contrasena`) VALUES
(1, 'ADMIN', 'Administrador', 'Christian', 'password'),
(2, 'MESE01', 'Mesero', 'Juan', 'password'),
(3, 'MESE02', 'Mesero', 'Alfredo', 'password');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalle_ticket`
--
ALTER TABLE `detalle_ticket`
  ADD PRIMARY KEY (`id_detalle_ticket`,`id_producto`,`folio`),
  ADD KEY `fk_Producto_has_ticket_ticket1_idx` (`folio`),
  ADD KEY `fk_Producto_has_ticket_Producto_idx` (`id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`,`ticket_folio`,`Cliente_id_cliente`),
  ADD KEY `fk_factura_ticket1_idx` (`ticket_folio`),
  ADD KEY `fk_factura_Cliente1_idx` (`Cliente_id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`,`categoria_id_categoria`),
  ADD KEY `fk_Producto_categoria1_idx` (`categoria_id_categoria`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`folio`,`usuario`),
  ADD KEY `fk_ticket_Usuario1_idx` (`usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ticket`
--
ALTER TABLE `detalle_ticket`
  MODIFY `id_detalle_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `folio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ticket`
--
ALTER TABLE `detalle_ticket`
  ADD CONSTRAINT `fk_Producto_has_ticket_Producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_ticket_ticket1` FOREIGN KEY (`folio`) REFERENCES `ticket` (`folio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_Cliente1` FOREIGN KEY (`Cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factura_ticket1` FOREIGN KEY (`ticket_folio`) REFERENCES `ticket` (`folio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_categoria1` FOREIGN KEY (`categoria_id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_ticket_Usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
