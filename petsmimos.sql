SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `codigos_acceso` (
  `codigo` varchar(100) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `fecha_expiracion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalles_venta` (
  `ID_venta` int(11) NOT NULL,
  `ID_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `gastos` (
  `ID_gasto` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `motivo` varchar(200) DEFAULT NULL,
  `valor` int(8) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `imagenes` (
  `ID_imagen` int(11) NOT NULL,
  `imagen` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `productos` (
  `ID_producto` int(16) NOT NULL,
  `ID_imagen` int(16) NOT NULL,
  `nombre` varchar(32) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` int(8) DEFAULT NULL,
  `stock` int(8) DEFAULT NULL,
  `activo` boolean NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL,
  `nombre` varchar(16) NOT NULL,
  `contrasena` varchar(256) NOT NULL,
  `tipo` varchar(16) NOT NULL,
  `activo` boolean NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

-- --------------------------------------------------------

CREATE TABLE `ventas` (
  `ID_venta` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear tabla 'categorias'
CREATE TABLE `categorias` (
  `ID_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
);

-- Crear tabla 'categoria_productos' para la relación N-N entre productos y categorias
CREATE TABLE `categoria_productos` (
  `ID_producto` int(16) NOT NULL,
  `ID_categoria` int(11) NOT NULL
);

-- Crear tabla 'Descuento'
CREATE TABLE `Descuento` (
  `ID_descuento` int(11) NOT NULL,
  `porcentaje` int(3) NOT NULL,
  `fecha_expiracion` datetime NOT NULL DEFAULT current_timestamp()
);

-- Crear tabla 'Descuento_productos' para la relación N-N entre productos y descuentos
CREATE TABLE `Descuento_productos` (
  `ID_producto` int(16) NOT NULL,
  `ID_descuento` int(11) NOT NULL
);
--
-- Indexes for table `codigos_acceso`
--
ALTER TABLE `codigos_acceso`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD KEY `ID_venta` (`ID_venta`,`ID_producto`),
  ADD KEY `ID_producto` (`ID_producto`);

--
-- Indexes for table `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`ID_gasto`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indexes for table `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`ID_imagen`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_producto`),
  ADD KEY `ID_imagen` (`ID_imagen`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_usuario`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_venta`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gastos`
--
ALTER TABLE `gastos`
  MODIFY `ID_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `ID_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_producto` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`ID_producto`) REFERENCES `productos` (`ID_producto`),
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`ID_venta`) REFERENCES `ventas` (`ID_venta`);

--
-- Constraints for table `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fk_gastos_usuarios` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_imagen`) REFERENCES `imagenes` (`ID_imagen`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`);
COMMIT;

-- Alterar las tablas para añadir índices y llaves primarias
ALTER TABLE `Descuento`
  ADD PRIMARY KEY (`ID_descuento`);

ALTER TABLE `Descuento_productos`
  ADD PRIMARY KEY (`ID_producto`, `ID_descuento`),
  ADD KEY `ID_descuento` (`ID_descuento`);

-- Alterar tabla 'productos' para crear la relación con 'Descuento_productos'
ALTER TABLE `Descuento_productos`
  ADD CONSTRAINT `fk_descuento_productos_productos` FOREIGN KEY (`ID_producto`) REFERENCES `productos` (`ID_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_descuento_productos_descuento` FOREIGN KEY (`ID_descuento`) REFERENCES `Descuento` (`ID_descuento`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Auto increment para 'Descuento'
ALTER TABLE `Descuento`
  MODIFY `ID_descuento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Alterar las tablas para añadir índices y llaves primarias
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_categoria`);

ALTER TABLE `categoria_productos`
  ADD PRIMARY KEY (`ID_producto`, `ID_categoria`),
  ADD KEY `ID_categoria` (`ID_categoria`);

-- Alterar tabla 'productos' para crear la relación con 'categoria_productos'
ALTER TABLE `categoria_productos`
  ADD CONSTRAINT `fk_categoria_productos_productos` FOREIGN KEY (`ID_producto`) REFERENCES `productos` (`ID_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_categoria_productos_categoria` FOREIGN KEY (`ID_categoria`) REFERENCES `categorias` (`ID_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Auto increment para 'categoria'
ALTER TABLE `categorias`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `usuarios` (`ID_usuario`, `nombre`, `contrasena`, `tipo`) VALUES
(10, 'banananana', '17007d055e4149923bf0a9b8beec5dd3eeeebadbbe993b09bcdb9c2b86f0126c', ''),
(11, 'asd', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'propietario');

INSERT INTO categorias (nombre) VALUES ('Alimentos');
INSERT INTO categorias (nombre) VALUES ('Juguetes');
INSERT INTO categorias (nombre) VALUES ('Accesorios');
INSERT INTO categorias (nombre) VALUES ('Camas y Mantas');
INSERT INTO categorias (nombre) VALUES ('Higiene');
INSERT INTO categorias (nombre) VALUES ('Collares y Correas');
INSERT INTO categorias (nombre) VALUES ('Transportadoras');
INSERT INTO categorias (nombre) VALUES ('Areneros');
INSERT INTO categorias (nombre) VALUES ('Ropa para Mascotas');
INSERT INTO categorias (nombre) VALUES ('Comederos y Bebederos');
INSERT INTO categorias (nombre) VALUES ('Rascadores');
INSERT INTO categorias (nombre) VALUES ('Casetas');
INSERT INTO categorias (nombre) VALUES ('Sustratos');
INSERT INTO categorias (nombre) VALUES ('Adiestramiento');