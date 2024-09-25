CREATE DATABASE IF NOT EXISTS `petsmimos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `petsmimos`;

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(16) NOT NULL,
  `contrasena` varchar(256) NOT NULL,
  `tipo` varchar(16) NOT NULL,
  PRIMARY KEY (`ID_usuario`)
);

CREATE TABLE `imagenes` (
  `ID_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` longblob NOT NULL,
  PRIMARY KEY (`ID_imagen`)
);

CREATE TABLE `productos` (
  `ID_producto` int(16) NOT NULL AUTO_INCREMENT,
  `ID_imagen` int(16) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` int(8) NOT NULL,
  `stock` int(8) NOT NULL,
  PRIMARY KEY (`ID_producto`),
  KEY `ID_imagen` (`ID_imagen`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_imagen`) REFERENCES `imagenes` (`ID_imagen`)
);

CREATE TABLE `gastos` (
  `ID_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `valor` int(8) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_gasto`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `fk_gastos_usuarios`
    FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios`(`ID_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE `ventas` (
  `ID_venta` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_venta`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `fk_ventas_usuarios`
    FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios`(`ID_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE `detalles_venta` (
  `ID_venta` int(11) NOT NULL,
  `ID_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  KEY `ID_venta` (`ID_venta`, `ID_producto`),
  KEY `ID_producto` (`ID_producto`),
  CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`ID_producto`) REFERENCES `productos` (`ID_producto`),
  CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`ID_venta`) REFERENCES `ventas` (`ID_venta`)
);

CREATE TABLE `codigos_acceso` (
  `codigo` varchar(100) NOT NULL,
  `fecha_expiracion` date NOT NULL,
  PRIMARY KEY (`codigo`)
);
