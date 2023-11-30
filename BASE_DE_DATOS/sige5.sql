-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2023 a las 21:45:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sige`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nom_empresa` varchar(45) NOT NULL,
  `per_contacto` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL,
  `venta_idventa` int(11) NOT NULL,
  `precio_unidad` float NOT NULL,
  `subtotal` float NOT NULL,
  `Producto_servicio_idProducto_servicio` int(11) NOT NULL,
  `cantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `Salida` AFTER INSERT ON `detalle_venta` FOR EACH ROW INSERT INTO movimientos (Producto_servicio_idProducto_servicio, cantidad, tipo)
VALUES (NEW.Producto_servicio_idProducto_servicio, NEW.cantidad, 0)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nom_empleado` varchar(45) NOT NULL,
  `ape_empleado` varchar(45) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_has_permiso`
--

CREATE TABLE `empleado_has_permiso` (
  `Empleado_idEmpleado` int(11) NOT NULL,
  `permiso_idpermiso` int(11) NOT NULL,
  `estado_empleado` binary(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE `licencias` (
  `idLicencias` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tipo_licencia_idtipo_licencia` int(11) NOT NULL,
  `Empleado_idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `idMovimientos` int(11) NOT NULL,
  `cantidad` float DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `Producto_servicio_idProducto_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `idorden_compra` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `total_compra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedidos` int(11) NOT NULL,
  `Transportadora` varchar(45) NOT NULL,
  `venta_idventa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nom_permiso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `idProducto` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idorden_compra` int(11) NOT NULL,
  `cantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Disparadores `productos_pedidos`
--
DELIMITER $$
CREATE TRIGGER `Entradas` AFTER INSERT ON `productos_pedidos` FOR EACH ROW INSERT INTO movimientos (Producto_servicio_idProducto_servicio, cantidad, tipo)
VALUES (NEW.idProducto, NEW.cantidad, 0)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_provedoor`
--

CREATE TABLE `producto_provedoor` (
  `Producto_servicio_idProducto_servicio` int(11) NOT NULL,
  `proveedor_idproveedor` int(11) NOT NULL,
  `precio_compra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_servicio`
--

CREATE TABLE `producto_servicio` (
  `idProducto_servicio` int(11) NOT NULL,
  `nom_producto_servicio` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `precio` float NOT NULL,
  `cantidad_stock` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `nom_empresa_pro` varchar(45) NOT NULL,
  `per_conctacto_pro` varchar(45) NOT NULL,
  `direccion_pro` varchar(45) NOT NULL,
  `telefono_pro` varchar(45) NOT NULL,
  `correo_pro` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_licencia`
--

CREATE TABLE `tipo_licencia` (
  `idtipo_licencia` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nom_usuario` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `Empleado_idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_permiso`
--

CREATE TABLE `usuario_has_permiso` (
  `Usuario_idUsuario` int(11) NOT NULL,
  `permiso_idpermiso` int(11) NOT NULL,
  `estado_usuario` binary(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total_venta` float NOT NULL,
  `Empleado_idEmpleado` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_venta1_idx` (`venta_idventa`),
  ADD KEY `fk_detalle_venta_Producto_servicio1_idx` (`Producto_servicio_idProducto_servicio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `empleado_has_permiso`
--
ALTER TABLE `empleado_has_permiso`
  ADD PRIMARY KEY (`Empleado_idEmpleado`,`permiso_idpermiso`),
  ADD KEY `fk_Empleado_has_permiso_permiso1_idx` (`permiso_idpermiso`),
  ADD KEY `fk_Empleado_has_permiso_Empleado1_idx` (`Empleado_idEmpleado`);

--
-- Indices de la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD PRIMARY KEY (`idLicencias`,`tipo_licencia_idtipo_licencia`),
  ADD KEY `fk_Licencias_tipo_licencia1_idx` (`tipo_licencia_idtipo_licencia`),
  ADD KEY `fk_Licencias_Empleado1_idx` (`Empleado_idEmpleado`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`idMovimientos`),
  ADD KEY `fk_Movimientos_Producto_servicio1_idx` (`Producto_servicio_idProducto_servicio`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`idorden_compra`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedidos`),
  ADD KEY `fk_Pedidos_venta1_idx` (`venta_idventa`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD PRIMARY KEY (`idProducto`,`idproveedor`,`idorden_compra`),
  ADD KEY `fk_producto_provedoor_has_orden_compra_orden_compra1_idx` (`idorden_compra`),
  ADD KEY `fk_producto_provedoor_has_orden_compra_producto_provedoor1_idx` (`idProducto`,`idproveedor`);

--
-- Indices de la tabla `producto_provedoor`
--
ALTER TABLE `producto_provedoor`
  ADD PRIMARY KEY (`Producto_servicio_idProducto_servicio`,`proveedor_idproveedor`),
  ADD KEY `fk_Producto_servicio_has_proveedor_proveedor1_idx` (`proveedor_idproveedor`),
  ADD KEY `fk_Producto_servicio_has_proveedor_Producto_servicio1_idx` (`Producto_servicio_idProducto_servicio`);

--
-- Indices de la tabla `producto_servicio`
--
ALTER TABLE `producto_servicio`
  ADD PRIMARY KEY (`idProducto_servicio`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD PRIMARY KEY (`idtipo_licencia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuario_Empleado1_idx` (`Empleado_idEmpleado`);

--
-- Indices de la tabla `usuario_has_permiso`
--
ALTER TABLE `usuario_has_permiso`
  ADD PRIMARY KEY (`Usuario_idUsuario`,`permiso_idpermiso`),
  ADD KEY `fk_Usuario_has_permiso_permiso1_idx` (`permiso_idpermiso`),
  ADD KEY `fk_Usuario_has_permiso_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_Empleado_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_venta_Cliente1_idx` (`Cliente_idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `licencias`
--
ALTER TABLE `licencias`
  MODIFY `idLicencias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `idMovimientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `idorden_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_servicio`
--
ALTER TABLE `producto_servicio`
  MODIFY `idProducto_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  MODIFY `idtipo_licencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_Producto_servicio1` FOREIGN KEY (`Producto_servicio_idProducto_servicio`) REFERENCES `producto_servicio` (`idProducto_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado_has_permiso`
--
ALTER TABLE `empleado_has_permiso`
  ADD CONSTRAINT `fk_Empleado_has_permiso_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Empleado_has_permiso_permiso1` FOREIGN KEY (`permiso_idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD CONSTRAINT `fk_Licencias_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Licencias_tipo_licencia1` FOREIGN KEY (`tipo_licencia_idtipo_licencia`) REFERENCES `tipo_licencia` (`idtipo_licencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_Movimientos_Producto_servicio1` FOREIGN KEY (`Producto_servicio_idProducto_servicio`) REFERENCES `producto_servicio` (`idProducto_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_Pedidos_venta1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD CONSTRAINT `fk_producto_provedoor_has_orden_compra_orden_compra1` FOREIGN KEY (`idorden_compra`) REFERENCES `orden_compra` (`idorden_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_provedoor_has_orden_compra_producto_provedoor1` FOREIGN KEY (`idProducto`,`idproveedor`) REFERENCES `producto_provedoor` (`Producto_servicio_idProducto_servicio`, `proveedor_idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_provedoor`
--
ALTER TABLE `producto_provedoor`
  ADD CONSTRAINT `fk_Producto_servicio_has_proveedor_Producto_servicio1` FOREIGN KEY (`Producto_servicio_idProducto_servicio`) REFERENCES `producto_servicio` (`idProducto_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_servicio_has_proveedor_proveedor1` FOREIGN KEY (`proveedor_idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_has_permiso`
--
ALTER TABLE `usuario_has_permiso`
  ADD CONSTRAINT `fk_Usuario_has_permiso_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_permiso_permiso1` FOREIGN KEY (`permiso_idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_Empleado` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
