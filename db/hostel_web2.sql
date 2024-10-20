-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2024 a las 21:38:01
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
(1, 'Habitación Individual - Vista al Mar', 'Individual', 1, 500, 'public/img/FotoHabitaciones/6715577d87c7b0.14620296.jpg'),
(2, 'Habitación Doble - Cama King', 'Doble', 2, 750, 'public/img/FotoHabitaciones/671557988fecc3.17522671.jpg'),
(3, 'Habitación Doble - Cama Queen', 'Doble', 2, 600, 'public/img/FotoHabitaciones/671557a04cebe8.88236537.jpg'),
(4, 'Suite - Lujo en París', 'Suite', 4, 1500, 'public/img/FotoHabitaciones/671557b408b611.73779563.jpg'),
(5, 'Habitación Compartida - Backpackers', 'Compartida', 8, 2000, 'public/img/FotoHabitaciones/67155b75b082c2.24469727.jpg'),
(6, 'Habitación Individual - Relax en Buenos Aires', 'Individual', 1, 600, 'public/img/FotoHabitaciones/6715581a157d90.52665819.jpg'),
(7, 'Habitación Doble - Romántica en Mendoza', 'Doble', 2, 800, 'public/img/FotoHabitaciones/671558701e7a10.55558760.jpg'),
(8, 'Suite - Paraíso en Cancún', 'Suite', 4, 1800, 'public/img/FotoHabitaciones/671558821ad833.19020992.jpg'),
(9, 'Habitación Compartida - Aventura en Bariloche', 'Compartida', 6, 1500, 'public/img/FotoHabitaciones/671558b06b0175.47992937.jpg'),
(10, 'Habitación Familiar - Escape a la Costa', 'Familiar', 5, 2500, 'public/img/FotoHabitaciones/671558bfa3ee81.64071381.jpg'),
(11, 'Habitación Individual - Refugio en Rosario', 'Individual', 1, 700, 'public/img/FotoHabitaciones/671558db707300.49851529.jpg'),
(12, 'Habitación Doble - Oasis en Dubai', 'Doble', 2, 850, 'public/img/FotoHabitaciones/67155916e66168.27036484.jpg'),
(13, 'Suite - Experiencia en Bora Bora', 'Suite', 4, 2000, 'public/img/FotoHabitaciones/6715592f2d5953.33458325.jpg'),
(14, 'Habitación Compartida - Comunidad en Córdoba', 'Compartida', 6, 1700, 'public/img/FotoHabitaciones/67155945df88a5.65631325.jpg'),
(15, 'Habitación Familiar - Recuerdos en Tandil', 'Familiar', 5, 3000, 'public/img/FotoHabitaciones/6715596354bca0.92991470.jpg'),
(16, 'Habitación Deluxe - Estilo en Ibiza', 'Deluxe', 3, 2200, 'public/img/FotoHabitaciones/671559730521d8.66828121.jpg'),
(17, 'Habitación Económica - Ahorro en La Plata', 'Economica', 2, 500, 'public/img/FotoHabitaciones/67155988eaa6b1.01686013.jpg'),
(18, 'Habitación Premium - Lujo en Las Vegas', 'Premium', 4, 2500, 'public/img/FotoHabitaciones/67155994eb2650.80407998.jpg'),
(19, 'Habitación Deluxe - Vista a la Ciudad de Nueva Yor', 'Deluxe', 3, 2400, 'public/img/FotoHabitaciones/671559b01c1af1.01655639.jpg'),
(20, 'Habitación Económica - Confort en Tandil', 'Económica', 2, 450, 'public/img/FotoHabitaciones/671559bc9ada63.23188104.jpg');

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
(23, 4, '2024-10-19', '2024-10-22', 'Padding Margin', 10),
(24, 2, '2024-11-01', '2024-11-06', 'hola mundo', 11),
(25, 7, '2024-11-07', '2024-11-14', 'hola mundo', 11),
(26, 13, '2024-11-15', '2024-11-17', 'hola mundo', 11),
(27, 20, '2024-11-28', '2030-10-28', 'Error Warning ', 12),
(28, 15, '2024-10-26', '2024-10-26', 'Juan', 13),
(29, 12, '2024-10-19', '2042-10-19', 'Iago Mati', 14),
(30, 1, '2024-10-20', '2024-10-26', 'Web Admin', 6);

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
(4, 'barrionuevonoa@gmail.com', '$2y$10$VaTFknJTpxezH.PwM2PwgOT23dvWODo33vqE/nJ1e8BJpN3.trBW2'),
(5, 'test@tudai.com', '$2y$10$WW281rLvOyiCcW8Gt1rBzuoFFhTEfZ62PaI5hZtQyPJILkVxF9nFO'),
(6, 'webadmin@unicen.tudai', '$2y$10$ddC8sbbnG.zZItIPp01h6edkKGAjmy5LcgFt7unbxr6.SDGILOALW'),
(10, 'padding@gmail.com', '$2y$10$Ni.ATvWeSGTjFlkQVar2E.GyQr5wUWYoGjO3eyA/WBXfIYk00yD8.'),
(11, 'helloworld@python.com', '$2y$10$aI5Qz07YMYY7sX.9SL9IGOU3kjs7JHqxADegHQpa4cXe14aVaU5dq'),
(12, 'warningError@gmail.com', '$2y$10$ZIJCPdPZgZRhnJGcjdTZD.C1TOZHipl2a041yWbVCFGG./h2hnY6a'),
(13, 'juan@hotmail.com', '$2y$10$99zVemEnmDy/eKSq0X42Le./deaCnrATjvF1N1NXVtJPbh6MWpx5O'),
(14, 'iagomati@gmail.com', '$2y$10$.VEnx4gyXKxkvQsMy/4F6edaCaForfs7J8xpV1Ni5GZf8S/6PhJS2');

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
  ADD KEY `id_habitacion` (`id_habitacion`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

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
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
