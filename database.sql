-- CREAR BASE DE DATOS
CREATE DATABASE IF NOT EXISTS OmonteJeremiasFinal;

-- Usar BD
USE OmonteJeremiasFinal;

-- Status Tables

CREATE TABLE IF NOT EXISTS costumeStatus(
    id TINYINT(4),
    description VARCHAR(23),
    PRIMARY KEY(id)
); 

CREATE TABLE IF NOT EXISTS roles(
    id TINYINT(4),
    description VARCHAR(30),
    PRIMARY KEY(rol)
);

CREATE TABLE IF NOT EXISTS rentalStatus(
    id TINYINT(4),
    description VARCHAR(30),
    PRIMARY KEY(id)
);

-- Main Tables

CREATE TABLE IF NOT EXISTS costume (
    id INT(11) AUTO_INCREMENT NOT NULl,
    description VARCHAR(30),
    size TINYINT(4),
    status_id TINYINT(4),
    PRIMARY KEY(nroDisfraz),
    FOREIGN KEY (estado_id) REFERENCES costumeStatus(id)
);

CREATE TABLE IF NOT EXISTS user(
    id INT(11) AUTO_INCREMENT NOT NULL,
    name VARCHAR(30),
    lastname VARCHAR(30),
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255),
    address VARCHAR(40),
    phone BIGINT(20),
    role_id TINYINT(4),
    PRIMARY KEY(id),
    FOREIGN KEY (role_id) REFERENCES roles(id) 
);

-- Alquileres
CREATE TABLE IF NOT EXISTS rental(
    id INT(11) AUTO_INCREMENT NOT NULL,
    user_id INT(11),
    costume_id INT(11),
    rent_date DATE DEFAULT (CURRENT_DATE),
    status_id TINYINT(4),
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (costume_id) REFERENCES costume(id),
    FOREIGN KEY (status_id) REFERENCES rentalStatus(id)
);