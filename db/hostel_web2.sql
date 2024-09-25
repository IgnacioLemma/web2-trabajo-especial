-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2024 a las 20:31:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hostel_web2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `Nombre`, `Tipo`, `Capacidad`, `Precio`) VALUES
(1, 'Habitación Individual - Vista al Mar', 'Individual', 1, 500),
(2, 'Habitación Doble - Cama King', 'Doble', 2, 750),
(3, 'Habitación Doble - Cama Queen', 'Doble', 2, 600),
(4, 'Suite - Lujo en París', 'Suite', 4, 1500),
(5, 'Habitación Compartida - Backpackers', 'Compartida', 8, 2000),
(6, 'Habitación Individual - Relax en Buenos Aires', 'Individual', 1, 600),
(7, 'Habitación Doble - Romántica en Mendoza', 'Doble', 2, 800),
(8, 'Suite - Paraíso en Cancún', 'Suite', 4, 1800),
(9, 'Habitación Compartida - Aventura en Bariloche', 'Compartida', 6, 1500),
(10, 'Habitación Familiar - Escape a la Costa', 'Familiar', 5, 2500),
(11, 'Habitación Individual - Refugio en Rosario', 'Individual', 1, 700),
(12, 'Habitación Doble - Oasis en Dubai', 'Doble', 2, 850),
(13, 'Suite - Experiencia en Bora Bora', 'Suite', 4, 2000),
(14, 'Habitación Compartida - Comunidad en Córdoba', 'Compartida', 6, 1700),
(15, 'Habitación Familiar - Recuerdos en Tandil', 'Familiar', 5, 3000),
(16, 'Habitación Deluxe - Estilo en Ibiza', 'Deluxe', 3, 2200),
(17, 'Habitación Económica - Ahorro en La Plata', 'Economica', 2, 500),
(18, 'Habitación Premium - Lujo en Las Vegas', 'Premium', 4, 2500),
(19, 'Habitación Deluxe - Vista a la Ciudad de Nueva Yor', 'Deluxe', 3, 2400),
(20, 'Habitación Económica - Confort en Tandil', 'Económica', 2, 450);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `Check_in` date NOT NULL,
  `Check_out` date NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_habitacion`, `Check_in`, `Check_out`, `nombre_cliente`) VALUES
(4, 1, '2024-10-01', '2024-10-05', 'Juan'),
(7, 1, '2024-10-03', '2024-10-07', 'Marisa'),
(8, 4, '2024-10-03', '2024-10-20', 'Edena'),
(11, 3, '2024-10-02', '2024-10-18', 'Noa'),
(16, 5, '2024-10-01', '2024-10-25', 'Jorge'),
(19, 4, '2024-09-20', '2024-09-25', 'hola mundo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
