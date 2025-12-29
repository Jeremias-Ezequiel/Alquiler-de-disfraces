-- CREAR BASE DE DATOS
CREATE DATABASE IF NOT EXISTS OmonteJeremiasFinal;

-- Usar BD
USE OmonteJeremiasFinal;

-- Estado Disfraz
CREATE TABLE IF NOT EXISTS estadodisfraz(
    id TINYINT(4),
    descripcion VARCHAR(23),
    PRIMARY KEY(id)
); 

-- Roles
CREATE TABLE IF NOT EXISTS roles(
    rol TINYINT(4),
    descripcion VARCHAR(30),
    PRIMARY KEY(rol)
);

-- Estado Alquiler
CREATE TABLE IF NOT EXISTS estadoalquiler(
    id TINYINT(4),
    descripcion VARCHAR(30),
    PRIMARY KEY(id)
);

-- Disfraz
CREATE TABLE IF NOT EXISTS disfraz (
    nroDisfraz INT(11) AUTO_INCREMENT NOT NULl,
    descripcion VARCHAR(30),
    talle TINYINT(4),
    estado TINYINT(4),
    PRIMARY KEY(nroDisfraz),
    FOREIGN KEY (estado) REFERENCES estadodisfraz(id)
);

-- Usuario
CREATE TABLE IF NOT EXISTS usuario(
    idUsuario INT(11) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(30),
    apellido VARCHAR(30),
    nombreUsuario VARCHAR(30) NOT NULL,
    contra VARCHAR(20),
    direccion VARCHAR(40),
    tel BIGINT(20),
    rol TINYINT(4),
    PRIMARY KEY(idUsuario),
    FOREIGN KEY (rol) REFERENCES roles(rol) 
);

-- Alquileres
CREATE TABLE IF NOT EXISTS alquileres(
    nro INT(11) AUTO_INCREMENT NOT NULL,
    usuario INT(11),
    disfraz INT(11),
    fecha DATE DEFAULT (CURRENT_DATE),
    estado TINYINT(4),
    PRIMARY KEY(nro),
    FOREIGN KEY (usuario) REFERENCES usuario(idUsuario),
    FOREIGN KEY (disfraz) REFERENCES disfraz(nroDisfraz),
    FOREIGN KEY (estado) REFERENCES estadoalquiler(id)
);