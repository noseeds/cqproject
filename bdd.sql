CREATE DATABASE petsmimos DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE petsmimos;

CREATE TABLE usuarios (
  ID_usuario int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(16) NOT NULL,
  contrasena varchar(256) NOT NULL,
  tipo varchar(16) NOT NULL,
  PRIMARY KEY (ID_usuario)   
);

CREATE TABLE imagenes (
  ID_imagen int(11) NOT NULL AUTO_INCREMENT,
  imagen longblob NOT NULL,
  PRIMARY KEY (ID_imagen)
);

CREATE TABLE productos (
  ID_producto int(16) NOT NULL AUTO_INCREMENT,
  ID_imagen int(16) NOT NULL,
  nombre varchar(32) NOT NULL,
  descripcion varchar(200) DEFAULT NULL,
  precio int(8) NOT NULL,
  stock int(8) NOT NULL,
  PRIMARY KEY (ID_producto),
  KEY ID_imagen (ID_imagen),
  CONSTRAINT productos_ibfk_1 FOREIGN KEY (ID_imagen) REFERENCES imagenes (ID_imagen)
);

CREATE TABLE gastos (
  ID_gasto int(11) NOT NULL AUTO_INCREMENT,
  ID_usuario int(11) NOT NULL,
  motivo varchar(200) NOT NULL,
  valor int(8) NOT NULL,
  fecha date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (ID_gasto),
  KEY ID_usuario (ID_usuario),
  CONSTRAINT fk_gastos_usuarios
    FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE ventas (
  ID_venta int(11) NOT NULL,
  ID_usuario int(11) NOT NULL,
  fecha date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (ID_venta),
  KEY ID_usuario (ID_usuario),
  CONSTRAINT fk_ventas_usuarios
    FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE detalles_venta (
  ID_venta int(11) NOT NULL,
  ID_producto int(11) NOT NULL,
  cantidad int(11) NOT NULL,
  KEY ID_venta (ID_venta, ID_producto),
  KEY ID_producto (ID_producto),
  CONSTRAINT detalles_venta_ibfk_1 FOREIGN KEY (ID_producto) REFERENCES productos (ID_producto),
  CONSTRAINT detalles_venta_ibfk_2 FOREIGN KEY (ID_venta) REFERENCES ventas (ID_venta)
);

CREATE TABLE codigos_acceso (
  codigo varchar(100) NOT NULL,
  ID_usuario int(11) NOT NULL,
  fecha_expiracion date NOT NULL,
  PRIMARY KEY (codigo),
  KEY ID_usuario (ID_usuario),
  CONSTRAINT fk_codigos_usuarios
    FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

/* Ingreso de registros a modo de prueba  */

INSERT INTO `usuarios` (`nombre`, `contrasena`, `tipo`) VALUES 
('asd', '12345678', 'admin'),
('user1', 'hashedpassword2', 'user'),
('user2', 'hashedpassword3', 'user');

INSERT INTO `imagenes` (`imagen`) VALUES 
(LOAD_FILE('/path/to/image1.jpg')),
(LOAD_FILE('/path/to/image2.jpg')),
(LOAD_FILE('/path/to/image3.jpg'));

INSERT INTO `productos` (`ID_imagen`, `nombre`, `descripcion`, `precio`, `stock`) VALUES 
(1, 'Dog Food', 'High-quality dog food', 50, 100),
(2, 'Cat Toy', 'Interactive cat toy', 20, 200),
(3, 'Bird Cage', 'Spacious cage for birds', 150, 50);

INSERT INTO `gastos` (`ID_usuario`, `motivo`, `valor`, `fecha`) VALUES 
(1, 'Compra de insumos', 100, '2024-09-01'),
(2, 'Mantenimiento', 200, '2024-09-02'),
(3, 'Publicidad', 300, '2024-09-03');

INSERT INTO `ventas` (`ID_venta`, `ID_usuario`, `fecha`) VALUES 
(1, 1, '2024-09-04'),
(2, 2, '2024-09-05'),
(3, 3, '2024-09-06');

INSERT INTO `detalles_venta` (`ID_venta`, `ID_producto`, `cantidad`) VALUES 
(1, 1, 2),
(2, 2, 1),
(3, 3, 3);

INSERT INTO `codigos_acceso` (`codigo`, `fecha_expiracion`) VALUES 
('ABC123', '2024-12-31'),
('XYZ789', '2025-01-15'),
('LMN456', '2024-11-30');
