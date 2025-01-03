-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-01-2025 a las 20:08:29
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
-- Base de datos: `idahue`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fam_prod`
--

CREATE TABLE `fam_prod` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Medida` varchar(255) DEFAULT NULL,
  `Formato` varchar(255) DEFAULT NULL,
  `Funcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fam_prod`
--

INSERT INTO `fam_prod` (`id`, `Nombre`, `Medida`, `Formato`, `Funcion`) VALUES
(1, 'Familia 1', 'Medida 1', 'Formato 1', 'Función 1'),
(2, 'Familia 2', 'Medida 2', 'Formato 2', 'Función 2'),
(3, 'Familia 3', 'Medida 3', 'Formato 3', 'Función 3'),
(4, 'Familia 4', 'Medida 4', 'Formato 4', 'Función 4'),
(5, 'Familia 5', 'Medida 5', 'Formato 5', 'Función 5'),
(6, 'Familia 6', 'Medida 6', 'Formato 6', 'Función 6'),
(7, 'Familia 7', 'Medida 7', 'Formato 7', 'Función 7'),
(8, 'Familia 8', 'Medida 8', 'Formato 8', 'Función 8'),
(9, 'Familia 9', 'Medida 9', 'Formato 9', 'Función 9'),
(10, 'Familia 10', 'Medida 10', 'Formato 10', 'Función 10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fertilizacion`
--

CREATE TABLE `fertilizacion` (
  `id` int(11) NOT NULL,
  `ID_pers` varchar(255) DEFAULT NULL,
  `ID_prod` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_i` time DEFAULT NULL,
  `hora_f` time DEFAULT NULL,
  `conc_prod` varchar(255) DEFAULT NULL,
  `dosis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fertilizacion`
--

INSERT INTO `fertilizacion` (`id`, `ID_pers`, `ID_prod`, `fecha`, `hora_i`, `hora_f`, `conc_prod`, `dosis`) VALUES
(2, '22222222-2', 2, '2025-02-01', '09:00:00', '11:00:00', 'Producto B', '20ml'),
(3, '33333333-3', 3, '2025-03-01', '10:00:00', '12:00:00', 'Producto C', '30ml'),
(4, '44444444-4', 4, '2025-04-01', '11:00:00', '13:00:00', 'Producto D', '40ml'),
(5, '55555555-5', 5, '2025-05-01', '12:00:00', '14:00:00', 'Producto E', '50ml'),
(6, '66666666-6', 6, '2025-06-01', '13:00:00', '15:00:00', 'Producto F', '60ml'),
(8, '88888888-8', 8, '2025-08-01', '15:00:00', '17:00:00', 'Producto H', '80ml'),
(9, '99999999-9', 9, '2025-09-01', '16:00:00', '18:00:00', 'Producto I', '90ml'),
(11, '44444444-4', 4, '2024-12-11', '12:27:00', '17:27:00', 'asdad', 'asdasd'),
(12, '44444444-4', 5, '2024-12-26', '13:32:00', '16:32:00', '123123', '232323');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ing_act`
--

CREATE TABLE `ing_act` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ing_act`
--

INSERT INTO `ing_act` (`id`, `nombre`) VALUES
(1, 'Actividad 1'),
(2, 'Actividad 2'),
(3, 'Actividad 3'),
(4, 'Actividad 4'),
(5, 'Actividad 5'),
(6, 'Actividad 6'),
(7, 'Actividad 7'),
(8, 'Actividad 8'),
(9, 'Actividad 9'),
(10, 'Actividad 10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `rut` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `fono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`rut`, `nombre`, `fono`) VALUES
('12223335', 'Bella Armina', '232333'),
('14.686.379-5', 'El Topito Moroco', '34444222'),
('15.196.068-5', 'WEQ', 'ASDAD'),
('22222222-2', 'Persona 2', '234567890'),
('33333333-3', 'Persona 3', '345678901'),
('44444444-4', 'Persona 4', '456789012'),
('55555555-5', 'Persona 5', '567890123'),
('66666666-6', 'Persona 6', '678901234'),
('88888888-8', 'Persona 8', '890123456'),
('99999999-9', 'Persona 9', '901234567'),
('asasdasd', 'asdasda', 'asdasdd'),
('asdasdads', 'asdasd', 'asdasd'),
('sadad', 'asdasd', 'asdasd'),
('tretertetet', 'ertretet', 'ertertert');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `ID_Fam` int(11) DEFAULT NULL,
  `ID_PROV` varchar(255) DEFAULT NULL,
  `ID_INGACT` int(11) DEFAULT NULL,
  `Nombre` varchar(1000) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Fecha_venc` date DEFAULT NULL,
  `especie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `ID_Fam`, `ID_PROV`, `ID_INGACT`, `Nombre`, `cantidad`, `Fecha_venc`, `especie`) VALUES
(1, 1, '12345678-9', 1, '', 100, '2025-01-01', 'Especie 1'),
(2, 2, '23456789-0', 2, '', 200, '2025-02-01', 'Especie 2'),
(3, 3, '34567890-1', 3, '', 300, '2025-03-01', 'Especie 3'),
(4, 4, '45678901-2', 4, '', 400, '2025-04-01', 'Especie 4'),
(5, 5, '56789012-3', 5, '', 500, '2025-05-01', 'Especie 5'),
(6, 6, '67890123-4', 6, '', 600, '2025-06-01', 'Especie 6'),
(7, 7, '78901234-5', 7, '', 700, '2025-07-01', 'Especie 7'),
(8, 8, '89012345-6', 8, '', 800, '2025-08-01', 'Especie 8'),
(9, 9, '90123456-7', 9, '', 900, '2025-09-01', 'Especie 9'),
(10, 10, '01234567-8', 10, '', 1000, '2025-10-01', 'Especie 10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ing_act`
--

CREATE TABLE `producto_ing_act` (
  `PRODUCTO_ID_INGACT` int(11) NOT NULL,
  `ING_ACT_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_ing_act`
--

INSERT INTO `producto_ing_act` (`PRODUCTO_ID_INGACT`, `ING_ACT_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedor`
--

CREATE TABLE `producto_proveedor` (
  `PRODUCTO_ID_PROV` int(11) NOT NULL,
  `PROVEEDOR_rut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_proveedor`
--

INSERT INTO `producto_proveedor` (`PRODUCTO_ID_PROV`, `PROVEEDOR_rut`) VALUES
(1, '12345678-9'),
(2, '23456789-0'),
(3, '34567890-1'),
(4, '45678901-2'),
(5, '56789012-3'),
(6, '67890123-4'),
(7, '78901234-5'),
(8, '89012345-6'),
(9, '90123456-7'),
(10, '01234567-8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `rut` varchar(255) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fono` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`rut`, `Nombre`, `direccion`, `fono`, `contacto`) VALUES
('01234567-8', 'Proveedor 10asdasdasdasdasd', 'Dirección 10', '012345678', 'Contacto 10'),
('12345678-9', 'Proveedor 1', 'Dirección 1', '123456789', 'Contacto 1'),
('14.686.379-5', 'El Proveedor ', 'la direccion', '55566777778', 'el contacto '),
('23456789-0', 'Proveedor 2', 'Dirección 2', '234567890', 'Contacto 2'),
('34567890-1', 'Proveedor 3', 'Dirección 3', '345678901', 'Contacto 3'),
('45678901-2', 'Proveedor 4', 'Dirección 4', '456789012', 'Contacto 4'),
('56789012-3', 'Proveedor 5', 'Dirección 5', '567890123', 'Contacto 5'),
('67890123-4', 'Proveedor 6', 'Dirección 6', '678901234', 'Contacto 6'),
('78901234-5', 'Proveedor 7', 'Dirección 7', '789012345', 'Contacto 7'),
('89012345-6', 'Proveedor 8', 'Dirección 8', '890123456', 'Contacto 8'),
('90123456-7', 'Proveedor 9', 'Dirección 9', '901234567', 'Contacto 9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `Descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `Descripcion`) VALUES
(1, 'Rol 1', ''),
(2, 'Rol 2', ''),
(3, 'Rol 3', ''),
(4, 'Rol 4', ''),
(5, 'Rol 5', ''),
(6, 'Rol 6', ''),
(7, 'Rol 7', ''),
(8, 'Rol 8', ''),
(9, 'Rol 9', ''),
(10, 'Rol 10', ''),
(11, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_persona`
--

CREATE TABLE `rol_persona` (
  `ROL_id` int(11) NOT NULL,
  `PERSONA_rut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_persona`
--

INSERT INTO `rol_persona` (`ROL_id`, `PERSONA_rut`) VALUES
(1, '12223335'),
(1, '14.686.379-5'),
(1, '15.196.068-5'),
(1, '44444444-4'),
(2, '12223335'),
(2, '14.686.379-5'),
(2, '15.196.068-5'),
(2, '22222222-2'),
(2, '44444444-4'),
(3, '12223335'),
(3, '14.686.379-5'),
(3, '15.196.068-5'),
(3, '33333333-3'),
(3, '44444444-4'),
(3, 'asasdasd'),
(3, 'sadad'),
(3, 'tretertetet'),
(4, '12223335'),
(4, '14.686.379-5'),
(4, '44444444-4'),
(4, 'asasdasd'),
(4, 'asdasdads'),
(4, 'sadad'),
(4, 'tretertetet'),
(5, '12223335'),
(5, '14.686.379-5'),
(5, '55555555-5'),
(6, '12223335'),
(6, '14.686.379-5'),
(6, '66666666-6'),
(7, '12223335'),
(7, '14.686.379-5'),
(7, '44444444-4'),
(8, '12223335'),
(8, '14.686.379-5'),
(8, '88888888-8'),
(9, '12223335'),
(9, '14.686.379-5'),
(9, '99999999-9'),
(10, '14.686.379-5'),
(10, '44444444-4'),
(11, '14.686.379-5');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fam_prod`
--
ALTER TABLE `fam_prod`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fertilizacion`
--
ALTER TABLE `fertilizacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_pers` (`ID_pers`),
  ADD KEY `ID_prod` (`ID_prod`);

--
-- Indices de la tabla `ing_act`
--
ALTER TABLE `ing_act`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Fam` (`ID_Fam`),
  ADD KEY `ID_PROV` (`ID_PROV`),
  ADD KEY `ID_INGACT` (`ID_INGACT`);

--
-- Indices de la tabla `producto_ing_act`
--
ALTER TABLE `producto_ing_act`
  ADD PRIMARY KEY (`PRODUCTO_ID_INGACT`,`ING_ACT_id`),
  ADD KEY `ING_ACT_id` (`ING_ACT_id`);

--
-- Indices de la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD PRIMARY KEY (`PRODUCTO_ID_PROV`,`PROVEEDOR_rut`),
  ADD KEY `PROVEEDOR_rut` (`PROVEEDOR_rut`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_persona`
--
ALTER TABLE `rol_persona`
  ADD PRIMARY KEY (`ROL_id`,`PERSONA_rut`),
  ADD KEY `PERSONA_rut` (`PERSONA_rut`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fam_prod`
--
ALTER TABLE `fam_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `fertilizacion`
--
ALTER TABLE `fertilizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ing_act`
--
ALTER TABLE `ing_act`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fertilizacion`
--
ALTER TABLE `fertilizacion`
  ADD CONSTRAINT `fertilizacion_ibfk_1` FOREIGN KEY (`ID_pers`) REFERENCES `persona` (`rut`),
  ADD CONSTRAINT `fertilizacion_ibfk_2` FOREIGN KEY (`ID_prod`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`ID_Fam`) REFERENCES `fam_prod` (`id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`ID_PROV`) REFERENCES `proveedor` (`rut`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`ID_INGACT`) REFERENCES `ing_act` (`id`);

--
-- Filtros para la tabla `producto_ing_act`
--
ALTER TABLE `producto_ing_act`
  ADD CONSTRAINT `producto_ing_act_ibfk_1` FOREIGN KEY (`PRODUCTO_ID_INGACT`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `producto_ing_act_ibfk_2` FOREIGN KEY (`ING_ACT_id`) REFERENCES `ing_act` (`id`);

--
-- Filtros para la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD CONSTRAINT `producto_proveedor_ibfk_1` FOREIGN KEY (`PRODUCTO_ID_PROV`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `producto_proveedor_ibfk_2` FOREIGN KEY (`PROVEEDOR_rut`) REFERENCES `proveedor` (`rut`);

--
-- Filtros para la tabla `rol_persona`
--
ALTER TABLE `rol_persona`
  ADD CONSTRAINT `rol_persona_ibfk_1` FOREIGN KEY (`ROL_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `rol_persona_ibfk_2` FOREIGN KEY (`PERSONA_rut`) REFERENCES `persona` (`rut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
