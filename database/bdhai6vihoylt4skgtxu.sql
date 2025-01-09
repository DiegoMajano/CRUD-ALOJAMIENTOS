-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: bdhai6vihoylt4skgtxu-mysql.services.clever-cloud.com:3306
-- Tiempo de generación: 09-01-2025 a las 02:56:41
-- Versión del servidor: 8.0.15-5
-- Versión de PHP: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdhai6vihoylt4skgtxu`
--
CREATE DATABASE IF NOT EXISTS `bdhai6vihoylt4skgtxu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdhai6vihoylt4skgtxu`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accommodations`
--

CREATE TABLE `accommodations` (
  `id_accommodation` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accommodations`
--

INSERT INTO `accommodations` (`id_accommodation`, `name`, `description`, `price`, `image_url`) VALUES
(1, 'Hotel Paraíso', 'Un hotel lujoso con vistas al mar, perfecto para unas vacaciones inolvidables.', 150.00, 'https://i.ibb.co/gZftpgx/vancouver-hotels.jpg'),
(2, 'Cabaña Rústica', 'Una cabaña acogedora en el bosque, ideal para desconectarse y relajarse.', 75.00, 'https://i.ibb.co/2PnmpqP/caba-a.webp'),
(3, 'Villa Sol', 'Una villa espaciosa con piscina privada, perfecta para familias y grupos grandes.', 250.00, 'https://i.ibb.co/Rg9pBGC/07d768ba8cb7.jpg'),
(4, 'Apartamento Urbano', 'Un moderno apartamento en el centro de la ciudad, cerca de todos los servicios.', 120.00, 'https://i.ibb.co/k2dq6Hg/61c78cc796bf.jpg'),
(5, 'Hostal El Refugio', 'Un hostal económico con ambiente amigable, ideal para mochileros.', 30.00, 'https://i.ibb.co/JBD4xdq/962e5fe4469c.png'),
(6, 'Casa de Campo', 'Una casa de campo tranquila con vistas a las montañas.', 110.00, 'https://i.ibb.co/vDQbyjP/e1c57cfdc431.jpg'),
(7, 'Bungalow Tropical', 'Un bungalow privado rodeado de naturaleza tropical.', 80.00, 'https://i.ibb.co/dr2FNDn/21abb6119b23.webp'),
(8, 'Suite Presidencial', 'Una suite de lujo con todas las comodidades modernas.', 350.00, 'https://i.ibb.co/KzqdNNK/571006932c10.jpg'),
(9, 'Habitación Económica', 'Una opción sencilla y económica para viajes cortos.', 25.00, 'https://i.ibb.co/YBPfL0y/1b813f64c7e8.jpg'),
(10, 'Hotel paraiso escondido', 'Un hotel lujoso con vistas a las montañas.', 90.00, 'https://i.ibb.co/JBHbbC9/11edc70abf5c.jpg'),
(11, 'Casa Rural', 'Casa acogedora en el campo, perfecta para familias.', 175.00, 'https://i.ibb.co/mzw0BC1/fc011384cd96.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(11) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `route_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_menu`, `option_name`, `route_url`) VALUES
(1, 'Administrar', 'http://localhost/CRUD-ALOJAMIENTOS/index_admin.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privileges`
--

CREATE TABLE `privileges` (
  `id_privilege` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privileges`
--

INSERT INTO `privileges` (`id_privilege`, `id_role`, `id_menu`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `id_role`) VALUES
(1, 'Alison Batres', 'alison@prueba.com', '$2y$12$wTtbgxbRsEyQsCxy4cB4nu0JBzocb7B.P2chhOS/TnLGM.hqW1.GS', 1),
(2, 'Marcela Menjívar', 'marcela@prueba.com', '$2y$12$wTtbgxbRsEyQsCxy4cB4nu0JBzocb7B.P2chhOS/TnLGM.hqW1.GS', 2),
(3, 'Lenny Servino', 'lenny@prueba.com', '$2y$12$wTtbgxbRsEyQsCxy4cB4nu0JBzocb7B.P2chhOS/TnLGM.hqW1.GS', 1),
(4, 'Diego Rodríguez', 'diego@prueba.com', '$2y$12$wTtbgxbRsEyQsCxy4cB4nu0JBzocb7B.P2chhOS/TnLGM.hqW1.GS', 1),
(5, 'Juan Melara', 'juanme@prueba.com', '$2y$12$YAKl1xHoz7oz30cgnqJ58eA7qABmypKob93ZCCxKbMT5vc25wQDGu', 2),
(6, 'diegom', 'diegom@prueba.com', '$2y$12$nJ1uDFYPxYFbKl78G6/n/eT44kZeKftneoFJbZJ3yJmJe9IG6COhO', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_accommodation`
--

CREATE TABLE `user_accommodation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_accommodation` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_accommodation`
--

INSERT INTO `user_accommodation` (`id`, `id_user`, `id_accommodation`, `created_at`) VALUES
(1, 2, 1, '2024-12-15'),
(2, 3, 2, '2024-12-16'),
(3, 1, 3, '2024-12-20'),
(4, 4, 4, '2024-12-31'),
(5, 2, 5, '2024-12-31'),
(6, 2, 6, '2025-01-01'),
(7, 4, 7, '2025-01-02'),
(8, 2, 8, '2025-01-05'),
(9, 4, 9, '2025-01-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id_accommodation`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id_privilege`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- Indices de la tabla `user_accommodation`
--
ALTER TABLE `user_accommodation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_accommodation` (`id_accommodation`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id_accommodation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id_privilege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user_accommodation`
--
ALTER TABLE `user_accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `privileges`
--
ALTER TABLE `privileges`
  ADD CONSTRAINT `privileges_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`),
  ADD CONSTRAINT `privileges_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

--
-- Filtros para la tabla `user_accommodation`
--
ALTER TABLE `user_accommodation`
  ADD CONSTRAINT `user_accommodation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_accommodation_ibfk_2` FOREIGN KEY (`id_accommodation`) REFERENCES `accommodations` (`id_accommodation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
