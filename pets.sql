SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS venta_metodos_pago, detalles_venta, descuento_productos, gastos, codigos_acceso,
                    imagenes, ventas, metodos_pago, categoria_productos, productos, usuarios, 
                    categorias, descuentos;

CREATE TABLE codigos_acceso (
  codigo varchar(100) NOT NULL PRIMARY KEY,
  ID_usuario int(11) NOT NULL,
  fecha_expiracion datetime NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE detalles_venta (
  ID_venta int(11) NOT NULL,
  ID_producto int(11) NOT NULL,
  cantidad int(11) NOT NULL,
  PRIMARY KEY (ID_venta, ID_producto),
  KEY ID_producto (ID_producto)
);

CREATE TABLE gastos (
  ID_gasto int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_usuario int(11) NOT NULL,
  motivo varchar(200) DEFAULT NULL,
  valor int(11) NOT NULL,
  fecha datetime NOT NULL DEFAULT current_timestamp(),
  KEY ID_usuario (ID_usuario)
);

CREATE TABLE productos (
  ID_producto int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(32) NOT NULL,
  descripcion varchar(200) DEFAULT NULL,
  precio int(11) NOT NULL,
  stock int(11) NOT NULL DEFAULT 0,
  stock_minimo int(11) DEFAULT NULL,
  activo boolean NOT NULL DEFAULT 1
);

CREATE TABLE imagenes (
  ID_imagen int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_producto int(11) NOT NULL,
  imagen longblob NOT NULL,
  KEY ID_producto (ID_producto)
);

CREATE TABLE usuarios (
  ID_usuario int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(16) NOT NULL,
  contrasena varchar(256) NOT NULL,
  tipo ENUM('común', 'administrador') NOT NULL,
  activo boolean NOT NULL DEFAULT 1
);

CREATE TABLE metodos_pago (
  ID_metodo_pago int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(50) NOT NULL
);

CREATE TABLE ventas (
  ID_venta int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_usuario int(11) NOT NULL,
  fecha datetime NOT NULL DEFAULT current_timestamp(),
  activo boolean NOT NULL DEFAULT 1,
  KEY ID_usuario (ID_usuario)
);

CREATE TABLE venta_metodos_pago (
  ID_venta int(11) NOT NULL,
  ID_metodo_pago int(11) NOT NULL,
  cantidad_paga int(11) NOT NULL,
  PRIMARY KEY (ID_venta, ID_metodo_pago)
);

CREATE TABLE categorias (
  ID_categoria int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(100) NOT NULL
);

CREATE TABLE categoria_productos (
  ID_producto int(11) NOT NULL,
  ID_categoria int(11) NOT NULL,
  PRIMARY KEY (ID_producto, ID_categoria),
  KEY ID_categoria (ID_categoria)
);

CREATE TABLE descuentos (
  ID_descuento int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  porcentaje int(3) NOT NULL,
  fecha datetime NOT NULL DEFAULT current_timestamp(),
  fecha_expiracion datetime NOT NULL DEFAULT (current_timestamp() + INTERVAL 7 DAY),
  activo boolean NOT NULL DEFAULT 1
);

CREATE TABLE descuento_productos (
  ID_producto int(11) NOT NULL,
  ID_descuento int(11) NOT NULL,
  PRIMARY KEY (ID_producto, ID_descuento),
  KEY ID_descuento (ID_descuento)
);

ALTER TABLE detalles_venta 
  ADD CONSTRAINT detalles_venta_ibfk_1 FOREIGN KEY (ID_producto) REFERENCES productos (ID_producto),
  ADD CONSTRAINT detalles_venta_ibfk_2 FOREIGN KEY (ID_venta) REFERENCES ventas (ID_venta);

ALTER TABLE gastos 
  ADD CONSTRAINT fk_gastos_usuarios FOREIGN KEY (ID_usuario) REFERENCES usuarios (ID_usuario) 
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE imagenes 
  ADD CONSTRAINT fk_imagenes_productos FOREIGN KEY (ID_producto) REFERENCES productos (ID_producto) 
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ventas 
  ADD CONSTRAINT fk_ventas_usuario FOREIGN KEY (ID_usuario) REFERENCES usuarios (ID_usuario);

ALTER TABLE venta_metodos_pago 
  ADD CONSTRAINT fk_venta_metodos_pago_venta FOREIGN KEY (ID_venta) REFERENCES ventas (ID_venta) ON DELETE CASCADE,
  ADD CONSTRAINT fk_venta_metodos_pago_metodo_pago FOREIGN KEY (ID_metodo_pago) REFERENCES metodos_pago (ID_metodo_pago) ON DELETE CASCADE;

ALTER TABLE descuento_productos 
  ADD CONSTRAINT fk_descuento_productos_productos FOREIGN KEY (ID_producto) REFERENCES productos (ID_producto) 
  ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fk_descuento_productos_descuento FOREIGN KEY (ID_descuento) REFERENCES descuentos (ID_descuento) 
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE categoria_productos 
  ADD CONSTRAINT fk_categoria_productos_productos FOREIGN KEY (ID_producto) REFERENCES productos (ID_producto) 
  ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fk_categoria_productos_categoria FOREIGN KEY (ID_categoria) REFERENCES categorias (ID_categoria) 
  ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

INSERT INTO `usuarios` (`ID_usuario`, `nombre`, `contrasena`, `tipo`) VALUES
(1337, 'admin', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'administrador'),
(101, 'usuario', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'común');

INSERT INTO `categorias` (nombre) VALUES ('Alimentos'), ('Juguetes'), ('Accesorios'), ('Camas y Mantas'), ('Higiene'), ('Collares y Correas'), ('Transportadoras'), ('Areneros'), ('Ropa para Mascotas'), ('Comederos y Bebederos'), ('Rascadores'), ('Casetas');

INSERT INTO `metodos_pago` (`nombre`) VALUES ('Efectivo'), ('Tarjeta');
