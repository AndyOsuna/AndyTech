-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2019 a las 14:46:35
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `osuna`
--
CREATE DATABASE IF NOT EXISTS `osuna` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `osuna`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cat`
--

INSERT INTO `cat` (`id`, `name`) VALUES
(3, 'Laptop'),
(4, 'CÃ¡mara'),
(5, 'Celular'),
(6, 'TV'),
(7, 'Monitor'),
(8, 'Placa de video'),
(9, 'Placa madre'),
(10, 'Disco duro'),
(11, 'SSD'),
(12, 'Mouse'),
(13, 'Teclado'),
(14, 'Auriculares'),
(15, 'Parlantes'),
(16, 'Gabinete'),
(17, 'CPU'),
(18, 'RAM'),
(19, 'Placa de audio'),
(21, 'Consola de juegos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(8,2) NOT NULL,
  `descr` text COLLATE utf8_unicode_ci NOT NULL,
  `cat` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `urlImg` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `descr`, `cat`, `urlImg`) VALUES
(11, 'Samsung Galaxy S10', 899.00, 'Pantalla 6.1\" SuperAMOLED 1440p\r\n6gb RAM\r\n128gb Storage', 'Celular', 's10'),
(12, 'Apple iPhone XS', 999.00, '4gb RAM\r\nDoble camara', 'Celular', 'iphone-xs'),
(14, 'MSI GS-65 i7 16gb 512gb', 1899.00, 'i7 9750h\r\n16gb RAM \r\n512gb SSD nvme\r\nRTX 2060', 'Laptop', 'msi-gs65'),
(15, 'Play Station 4 Slim', 499.00, 'xd', 'Consola de juegos', 'ps4'),
(16, 'LG 38UC99-W', 1149.00, 'Ultra-Wide 38\"\r\nUV4K, IPS, LED, 3840 x 1600, 5ms', 'Monitor', 'lg-38uc99-w'),
(17, 'Nvidia RTX 2070', 799.00, '8gb GDDR6', 'Placa de video', 'rtx-2070'),
(18, 'Nintendo Switch', 350.00, 'asd', 'Consola de juegos', 'nintendo-switch'),
(19, 'Huawei Mate 30 Pro', 1249.00, 'Pantalla grande', 'Celular', 'mate-30-pro'),
(22, 'Samsung Galaxy S8+', 399.00, 'Pantalla 6.2\"\r\nRam: 4gb\r\nStorage: 64gb', 'Celular', 's8'),
(23, 'Sony Alpha a5100', 549.00, 'Sensor: 24.3MP', 'CÃ¡mara', 'sony-a5100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `isAdmin`, `username`, `email`, `pass`) VALUES
(1, 1, 'andyosuna', 'osuna010@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(2, 0, 'Nachito', 'nachi@to.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(3, 0, 'Mikencio', 'mike@sergio.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
