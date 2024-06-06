CREATE DATABASE petsmimos;
USE petsmimos;
CREATE TABLE `clientes` (
  `ID_cliente` int(11) NOT NULL,
  `Teléfono` varchar(255) DEFAULT NULL,
  `Dirección` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `detalle_ventas` (
  `ID_venta` int(11) NOT NULL,
  `ID_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `gastos` (
  `ID_gasto` int(11) NOT NULL,
  `Cedula_Usuario` varchar(255) DEFAULT NULL,
  `Valor` decimal(10,2) DEFAULT NULL,
  `Motivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `productos` (
  `ID_producto` int(11) NOT NULL,
  `ID_venta` int(11) DEFAULT NULL,
  `Nombre_Producto` varchar(255) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuarios` (
  `Cedula_usuario` varchar(255) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`Cedula_usuario`, `Contraseña`) VALUES
('1', 'a'),
('123', '123'),
('2222', 'dsad'),
('23213', '323'),
('2343', 'asdf'),
('324324', 'fdsf'),
('34', 'as'),
('43', 'as'),
('522', 'banana'),
('523', 'bas'),
('5232', '32'),
('543', 'asd'),
('54353453453451', 'abc'),
('546', 'cas'),
('777', '777'),
('juam', 'bananabanana');

CREATE TABLE `ventas` (
  `ID_venta` int(11) NOT NULL,
  `Cedula_usuario` varchar(255) DEFAULT NULL,
  `ID_cliente` int(11) DEFAULT NULL,
  `Valor` decimal(10,2) DEFAULT NULL,
  `Tipo` varchar(100) DEFAULT NULL,
  `Estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_cliente`);

ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`ID_venta`,`ID_producto`),
  ADD KEY `ID_producto` (`ID_producto`);

ALTER TABLE `gastos`
  ADD PRIMARY KEY (`ID_gasto`),
  ADD KEY `Cedula_Usuario` (`Cedula_Usuario`);

ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_producto`),
  ADD KEY `ID_venta` (`ID_venta`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Cedula_usuario`);

ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_venta`),
  ADD KEY `Cedula_usuario` (`Cedula_usuario`),
  ADD KEY `ID_cliente` (`ID_cliente`);

ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`ID_venta`) REFERENCES `ventas` (`ID_venta`),
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`ID_producto`) REFERENCES `productos` (`ID_producto`);

ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`Cedula_Usuario`) REFERENCES `usuarios` (`Cedula_usuario`);

ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_venta`) REFERENCES `ventas` (`ID_venta`);

ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`Cedula_usuario`) REFERENCES `usuarios` (`Cedula_usuario`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`ID_cliente`) REFERENCES `clientes` (`ID_cliente`);
COMMIT;