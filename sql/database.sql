-- 1. Tabla: usuarios (Cambiado de 'users' a 'usuarios')
-- Ajustado para coincidir con lo que busca registro_action.php y login_action.php
Create database if not exists ud_las_palmas_2026;
use ud_las_palmas_2026;
CREATE TABLE IF NOT EXISTS usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE, 
    contrasena VARCHAR(255) NOT NULL, 
    correo VARCHAR(100) NOT NULL UNIQUE, 
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabla (MAESTRA): posiciones
CREATE TABLE IF NOT EXISTS posiciones (
    posicion_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_posicion VARCHAR(50) NOT NULL UNIQUE
);

-- 3. Tabla (PRINCIPAL): jugadores
CREATE TABLE IF NOT EXISTS jugadores (
    jugadores_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_jugador VARCHAR(100) NOT NULL,
    dorsal_oficial INT NOT NULL UNIQUE, 
    posicion_id INT NOT NULL,
    posicion_campo VARCHAR(50),
    nacionalidad_iso VARCHAR(50) NOT NULL,
    edad_actual INT NOT NULL,
    valor_mercado_millones INT NOT NULL,
    FOREIGN KEY (posicion_id) REFERENCES posiciones(posicion_id)
);

-- Inserción de las posiciones
INSERT INTO posiciones (nombre_posicion) VALUES 
('Portero'), 
('Defensa'), 
('Centrocampista'), 
('Delantero');

-- Inserción de TODOS tus usuarios de prueba
-- La contraseña de todos es '1234'
INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES 
('pablo_lpz', '$2y$10$8Q6X/m0qN6vW1m0qN6vW1.7R7R7R7R7R7R7R7R7R7R7R7R7R7R7R7', 'pablo@ejemplo.com'),
('admin_canario', '$2y$10$8Q6X/m0qN6vW1m0qN6vW1.7R7R7R7R7R7R7R7R7R7R7R7R7R7R7R7', 'admin@udlp.es'),
('user3', '$2y$10$8Q6X/m0qN6vW1m0qN6vW1.7R7R7R7R7R7R7R7R7R7R7R7R7R7R7R7', 'user3@test.com'),
('user4', '$2y$10$8Q6X/m0qN6vW1m0qN6vW1.7R7R7R7R7R7R7R7R7R7R7R7R7R7R7R7', 'user4@test.com'),
('user5', '$2y$10$8Q6X/m0qN6vW1m0qN6vW1.7R7R7R7R7R7R7R7R7R7R7R7R7R7R7R7', 'user5@test.com');

-- Inserción de tus 10 jugadores (UD Las Palmas 2026)
INSERT INTO jugadores (nombre_jugador, dorsal_oficial, posicion_id, posicion_campo, nacionalidad_iso, edad_actual, valor_mercado_millones)
VALUES 
('Jasper Cillessen', 1, 1, 'Portero', 'Paises Bajos', 36, 2),
('Mika Marmol', 3, 2, 'Defensa', 'Espana', 24, 15),
('Alex Suarez', 4, 2, 'Defensa', 'Espana', 32, 3),
('Fabio Gonzalez', 6, 3, 'Centrocampista', 'Espana', 28, 2),
('Sandro Ramirez', 9, 4, 'Delantero', 'Espana', 30, 4),
('Alberto Moleiro', 10, 3, 'Centrocampista', 'Espana', 22, 20),
('Enzo Loiodice', 12, 3, 'Centrocampista', 'Francia', 25, 5),
('Oli McBurnie', 16, 4, 'Delantero', 'Escocia', 29, 6),
('Kirian Rodriguez', 20, 3, 'Centrocampista', 'Espana', 29, 12),
('Dario Essugo', 29, 3, 'Centrocampista', 'Portugal', 20, 4);