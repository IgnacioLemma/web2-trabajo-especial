-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 02:20:37
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
  `Precio` int(11) NOT NULL,
  `foto_habitacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `Nombre`, `Tipo`, `Capacidad`, `Precio`, `foto_habitacion`) VALUES
(1, 'Habitación Individual - Vista al Mar', 'Individual', 1, 500, 'imagen_habitacion_101.jpg'),
(2, 'Habitación Doble - Cama King', 'Doble', 2, 750, 'imagen_habitacion_102.jpg'),
(3, 'Habitación Doble - Cama Queen', 'Doble', 2, 600, 'imagen_habitacion_103.jpg'),
(4, 'Suite - Lujo en París', 'Suite', 4, 1500, 'imagen_habitacion_104.jpg'),
(5, 'Habitación Compartida - Backpackers', 'Compartida', 8, 2000, 'imagen_habitacion_105.jpg'),
(6, 'Habitación Individual - Relax en Buenos Aires', 'Individual', 1, 600, 'imagen_habitacion_106.jpg'),
(7, 'Habitación Doble - Romántica en Mendoza', 'Doble', 2, 800, 'imagen_habitacion_107.jpg'),
(8, 'Suite - Paraíso en Cancún', 'Suite', 4, 1800, 'imagen_habitacion_108.jpg'),
(9, 'Habitación Compartida - Aventura en Bariloche', 'Compartida', 6, 1500, 'imagen_habitacion_109.jpg'),
(10, 'Habitación Familiar - Escape a la Costa', 'Familiar', 5, 2500, 'imagen_habitacion_110.jpg'),
(11, 'Habitación Individual - Refugio en Rosario', 'Individual', 1, 700, 'imagen_habitacion_111.jpg'),
(12, 'Habitación Doble - Oasis en Dubai', 'Doble', 2, 850, 'imagen_habitacion_112.jpg'),
(13, 'Suite - Experiencia en Bora Bora', 'Suite', 4, 2000, 'imagen_habitacion_113.jpg'),
(14, 'Habitación Compartida - Comunidad en Córdoba', 'Compartida', 6, 1700, 'imagen_habitacion_114.jpg'),
(15, 'Habitación Familiar - Recuerdos en Tandil', 'Familiar', 5, 3000, 'imagen_habitacion_115.jpg'),
(16, 'Habitación Deluxe - Estilo en Ibiza', 'Deluxe', 3, 2200, 'imagen_habitacion_116.jpg'),
(17, 'Habitación Económica - Ahorro en La Plata', 'Economica', 2, 500, 'imagen_habitacion_117.jpg'),
(18, 'Habitación Premium - Lujo en Las Vegas', 'Premium', 4, 2500, 'imagen_habitacion_118.jpg'),
(19, 'Habitación Deluxe - Vista a la Ciudad de Nueva Yor', 'Deluxe', 3, 2400, 'imagen_habitacion_119.jpg'),
(20, 'Habitación Económica - Confort en Tandil', 'Económica', 2, 450, 'imagen_habitacion_120.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `Check_in` date NOT NULL,
  `Check_out` date NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_habitacion`, `Check_in`, `Check_out`, `nombre_cliente`, `id_usuario`) VALUES
(4, 1, '2024-10-01', '2024-10-05', 'Juan', 1),
(7, 1, '2024-10-03', '2024-10-07', 'Marisa', 1),
(8, 4, '2024-10-03', '2024-10-20', 'Edena', 1),
(11, 3, '2024-10-02', '2024-10-18', 'Noa', 2),
(16, 5, '2024-10-01', '2024-10-25', 'Jorge', 1),
(19, 4, '2024-09-20', '2024-09-25', 'hola mundo', 3),
(22, 5, '2025-02-03', '2025-03-06', 'test 2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`) VALUES
(1, 'webadmin@tudai.ar', 'admin'),
(2, 'noa@tudai.es', 'holamundo'),
(3, 'hellotudai@web2.phtml', ' basededatos'),
(4, 'barrionuevonoa@gmail.com', '$2y$10$VaTFknJTpxezH.PwM2PwgOT23dvWODo33vqE/nJ1e8BJpN3.trBW2'),
(5, 'test@tudai.com', '$2y$10$WW281rLvOyiCcW8Gt1rBzuoFFhTEfZ62PaI5hZtQyPJILkVxF9nFO'),
(6, 'webadmin@unicen.tudai', '$2y$10$ddC8sbbnG.zZItIPp01h6edkKGAjmy5LcgFt7unbxr6.SDGILOALW');

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
