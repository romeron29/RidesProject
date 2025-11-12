create database rides_project;
use rides_project;

-- Tabla usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    cedula VARCHAR(20) NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(25),
    fotografia VARCHAR(255),
    contrasenna VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('administrador','chofer','pasajero') NOT NULL DEFAULT 'pasajero',
    estado ENUM('pendiente','activo','inactivo') NOT NULL DEFAULT 'pendiente',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);
select * from usuarios;
delete from usuarios where id_usuario = 6;
insert into usuarios (nombre, apellido, cedula, fecha_nacimiento, correo, telefono, fotografia, 
contrasenna, tipo_usuario) values ();
-- Tabla vehiculos
CREATE TABLE vehiculos (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    id_chofer INT NOT NULL,
    placa VARCHAR(15) NOT NULL UNIQUE,
    marca VARCHAR(25) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    anno INT NOT NULL,
    color VARCHAR(30),
    capacidad_asientos INT NOT NULL,
    fotografia VARCHAR(255),
    estado ENUM('activo','inactivo') DEFAULT 'activo',
    FOREIGN KEY (id_chofer) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

UPDATE vehiculos 
SET marca = :marca, modelo = :modelo, anno = :anno, color = :color, capacidad_asientos = :capacidad_asientos, estado = :estado 
WHERE id_vehiculo = :id_vehiculo;
INSERT INTO vehiculos (id_chofer, placa, marca, modelo, anno, color, capacidad_asientos, fotografia) values 
(:id_chofer, :placa, :marca, :modelo, :anno, :color, :capacidad_asientos, :fotografia);                                            
                                            
SELECT id_vehiculo, id_chofer, placa, marca, modelo, anno, color, capacidad_asientos, estado from vehiculos;
-- Tabla rides
CREATE TABLE rides (
    id_ride INT AUTO_INCREMENT PRIMARY KEY,
    id_chofer INT NOT NULL,
    id_vehiculo INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    lugar_salida VARCHAR(100) NOT NULL,
    lugar_llegada VARCHAR(100) NOT NULL,
    dia_semana ENUM('lunes','martes','miércoles','jueves','viernes','sábado','domingo') NOT NULL,
    hora TIME NOT NULL,
    costo_espacio DECIMAL(10,2) NOT NULL,
    espacios INT NOT NULL,
    estado ENUM('activo','cancelado') DEFAULT 'activo',
    FOREIGN KEY (id_chofer) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculos(id_vehiculo)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_ride_busqueda (lugar_salida, lugar_llegada, dia_semana, hora)
);
insert into rides(id_chofer, id_vehiculo, nombre, lugar_salida, lugar_llegada, dia_semana, hora, 
costo_espacio, espacios, estado) values();


-- Tabla reservas
CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_ride INT NOT NULL,
    id_pasajero INT NOT NULL,
    fecha_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente','aceptada','rechazada','cancelada') DEFAULT 'pendiente',
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ride) REFERENCES rides(id_ride)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_pasajero) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
insert into reservas(id_ride, id_pasajero, fecha_reserva, estado, fecha_actualizacion) values ();
-- Tabla tokens_activacion

CREATE TABLE tokens_activacion (
    id_token INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_expiracion DATETIME,
    usado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
select * from tokens_activacion;
insert into tokens_activacion(id_usuario, token) values ();

CREATE TABLE logs_notificaciones (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo ENUM('activacion','recordatorio_reserva') NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    exito BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- usuario administrador para pruebas

INSERT INTO usuarios (
    nombre, apellido, cedula, fecha_nacimiento, correo, telefono, contraseña, tipo_usuario, estado
) VALUES (
    'Admin', 'Principal', '000000000', '1990-01-01', 'admin@sistema.com', '0000-0000', 
    '$2y$10$7ExAmpleHashDeContraseñaSeguro',  -- Cambia este valor por un hash real de bcrypt
    'administrador', 'activo'
);

-- ====================================================
-- EJEMPLO DE CONSULTA PARA EL SCRIPT AUTOMÁTICO
-- (Reservas pendientes con más de X minutos)
-- ====================================================
/*
SELECT r.id_reserva, r.id_ride, u.correo AS chofer_correo
FROM reservas r
JOIN rides ri ON r.id_ride = ri.id_ride
JOIN usuarios u ON ri.id_chofer = u.id_usuario
WHERE r.estado = 'pendiente'
AND TIMESTAMPDIFF(MINUTE, r.fecha_reserva, NOW()) > 30;
*/

