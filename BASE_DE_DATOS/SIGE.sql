-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema SIGE
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SIGE
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SIGE` DEFAULT CHARACTER SET utf8 ;
USE `SIGE` ;

-- -----------------------------------------------------
-- Table `SIGE`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Empleado` (
  `idEmpleado` INT NOT NULL AUTO_INCREMENT,
  `nom_empleado` VARCHAR(45) NOT NULL,
  `ape_empleado` VARCHAR(45) NOT NULL,
  `cargo` VARCHAR(45) NOT NULL,
  `departamento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEmpleado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nom_usuario` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `rol` VARCHAR(45) NOT NULL,
  `Empleado_idEmpleado` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_Usuario_Empleado1_idx` (`Empleado_idEmpleado` ASC),
  CONSTRAINT `fk_Usuario_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `SIGE`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nom_empresa` VARCHAR(45) NOT NULL,
  `per_contacto` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Producto_servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Producto_servicio` (
  `idProducto_servicio` INT NOT NULL,
  `nom_producto_servicio` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `precio` FLOAT NOT NULL,
  `cantidad_stock` FLOAT NOT NULL,
  PRIMARY KEY (`idProducto_servicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`venta` (
  `idventa` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `total_venta` FLOAT NOT NULL,
  `Empleado_idEmpleado` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idventa`),
  INDEX `fk_venta_Empleado_idx` (`Empleado_idEmpleado` ASC),
  INDEX `fk_venta_Cliente1_idx` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_venta_Empleado`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `SIGE`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `SIGE`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`proveedor` (
  `idproveedor` INT NOT NULL,
  `nom_empresa_pro` VARCHAR(45) NOT NULL,
  `per_conctacto_pro` VARCHAR(45) NOT NULL,
  `direccion_pro` VARCHAR(45) NOT NULL,
  `telefono_pro` VARCHAR(45) NOT NULL,
  `correo_pro` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idproveedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`detalle_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`detalle_venta` (
  `iddetalle_venta` INT NOT NULL,
  `venta_idventa` INT NOT NULL,
  `precio_unidad` FLOAT NOT NULL,
  `subtotal` FLOAT NOT NULL,
  `Producto_servicio_idProducto_servicio` INT NOT NULL,
  PRIMARY KEY (`iddetalle_venta`),
  INDEX `fk_detalle_venta_venta1_idx` (`venta_idventa` ASC),
  INDEX `fk_detalle_venta_Producto_servicio1_idx` (`Producto_servicio_idProducto_servicio` ASC),
  CONSTRAINT `fk_detalle_venta_venta1`
    FOREIGN KEY (`venta_idventa`)
    REFERENCES `SIGE`.`venta` (`idventa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_venta_Producto_servicio1`
    FOREIGN KEY (`Producto_servicio_idProducto_servicio`)
    REFERENCES `SIGE`.`Producto_servicio` (`idProducto_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`orden_compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`orden_compra` (
  `idorden_compra` INT NOT NULL,
  `fecha_creacion` DATE NOT NULL,
  `total_compra` FLOAT NOT NULL,
  PRIMARY KEY (`idorden_compra`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`producto_provedoor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`producto_provedoor` (
  `Producto_servicio_idProducto_servicio` INT NOT NULL,
  `proveedor_idproveedor` INT NOT NULL,
  `precio_compra` FLOAT NOT NULL,
  PRIMARY KEY (`Producto_servicio_idProducto_servicio`, `proveedor_idproveedor`),
  INDEX `fk_Producto_servicio_has_proveedor_proveedor1_idx` (`proveedor_idproveedor` ASC),
  INDEX `fk_Producto_servicio_has_proveedor_Producto_servicio1_idx` (`Producto_servicio_idProducto_servicio` ASC),
  CONSTRAINT `fk_Producto_servicio_has_proveedor_Producto_servicio1`
    FOREIGN KEY (`Producto_servicio_idProducto_servicio`)
    REFERENCES `SIGE`.`Producto_servicio` (`idProducto_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producto_servicio_has_proveedor_proveedor1`
    FOREIGN KEY (`proveedor_idproveedor`)
    REFERENCES `SIGE`.`proveedor` (`idproveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Movimientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Movimientos` (
  `idMovimientos` INT NOT NULL AUTO_INCREMENT,
  `cantidad` FLOAT NULL,
  `tipo` INT NULL,
  `Producto_servicio_idProducto_servicio` INT NOT NULL,
  PRIMARY KEY (`idMovimientos`),
  INDEX `fk_Movimientos_Producto_servicio1_idx` (`Producto_servicio_idProducto_servicio` ASC),
  CONSTRAINT `fk_Movimientos_Producto_servicio1`
    FOREIGN KEY (`Producto_servicio_idProducto_servicio`)
    REFERENCES `SIGE`.`Producto_servicio` (`idProducto_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`tipo_licencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`tipo_licencia` (
  `idtipo_licencia` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipo_licencia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Licencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Licencias` (
  `idLicencias` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL,
  `fecha_ini` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `tipo_licencia_idtipo_licencia` INT NOT NULL,
  `Empleado_idEmpleado` INT NOT NULL,
  PRIMARY KEY (`idLicencias`, `tipo_licencia_idtipo_licencia`),
  INDEX `fk_Licencias_tipo_licencia1_idx` (`tipo_licencia_idtipo_licencia` ASC),
  INDEX `fk_Licencias_Empleado1_idx` (`Empleado_idEmpleado` ASC),
  CONSTRAINT `fk_Licencias_tipo_licencia1`
    FOREIGN KEY (`tipo_licencia_idtipo_licencia`)
    REFERENCES `SIGE`.`tipo_licencia` (`idtipo_licencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Licencias_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `SIGE`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Pedidos` (
  `idPedidos` INT NOT NULL AUTO_INCREMENT,
  `Transportadora` VARCHAR(45) NOT NULL,
  `venta_idventa` INT NOT NULL,
  PRIMARY KEY (`idPedidos`),
  INDEX `fk_Pedidos_venta1_idx` (`venta_idventa` ASC),
  CONSTRAINT `fk_Pedidos_venta1`
    FOREIGN KEY (`venta_idventa`)
    REFERENCES `SIGE`.`venta` (`idventa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`permiso` (
  `idpermiso` INT NOT NULL AUTO_INCREMENT,
  `nom_permiso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpermiso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Usuario_has_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Usuario_has_permiso` (
  `Usuario_idUsuario` INT NOT NULL,
  `permiso_idpermiso` INT NOT NULL,
  `estado_usuario` BINARY NOT NULL,
  PRIMARY KEY (`Usuario_idUsuario`, `permiso_idpermiso`),
  INDEX `fk_Usuario_has_permiso_permiso1_idx` (`permiso_idpermiso` ASC),
  INDEX `fk_Usuario_has_permiso_Usuario1_idx` (`Usuario_idUsuario` ASC),
  CONSTRAINT `fk_Usuario_has_permiso_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `SIGE`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_permiso_permiso1`
    FOREIGN KEY (`permiso_idpermiso`)
    REFERENCES `SIGE`.`permiso` (`idpermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`Empleado_has_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`Empleado_has_permiso` (
  `Empleado_idEmpleado` INT NOT NULL,
  `permiso_idpermiso` INT NOT NULL,
  `estado_empreado` BINARY NOT NULL,
  PRIMARY KEY (`Empleado_idEmpleado`, `permiso_idpermiso`),
  INDEX `fk_Empleado_has_permiso_permiso1_idx` (`permiso_idpermiso` ASC),
  INDEX `fk_Empleado_has_permiso_Empleado1_idx` (`Empleado_idEmpleado` ASC),
  CONSTRAINT `fk_Empleado_has_permiso_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `SIGE`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empleado_has_permiso_permiso1`
    FOREIGN KEY (`permiso_idpermiso`)
    REFERENCES `SIGE`.`permiso` (`idpermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SIGE`.`productos_pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SIGE`.`productos_pedidos` (
  `idProducto` INT NOT NULL,
  `idproveedor` INT NOT NULL,
  `idorden_compra` INT NOT NULL,
  PRIMARY KEY (`idProducto`, `idproveedor`, `idorden_compra`),
  INDEX `fk_producto_provedoor_has_orden_compra_orden_compra1_idx` (`idorden_compra` ASC),
  INDEX `fk_producto_provedoor_has_orden_compra_producto_provedoor1_idx` (`idProducto` ASC, `idproveedor` ASC),
  CONSTRAINT `fk_producto_provedoor_has_orden_compra_producto_provedoor1`
    FOREIGN KEY (`idProducto` , `idproveedor`)
    REFERENCES `SIGE`.`producto_provedoor` (`Producto_servicio_idProducto_servicio` , `proveedor_idproveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_provedoor_has_orden_compra_orden_compra1`
    FOREIGN KEY (`idorden_compra`)
    REFERENCES `SIGE`.`orden_compra` (`idorden_compra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
