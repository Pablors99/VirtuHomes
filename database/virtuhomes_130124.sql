-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2024 a las 22:20:01
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
-- Base de datos: `virtuhomes`
--
CREATE DATABASE IF NOT EXISTS `virtuhomes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `virtuhomes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `telefono_contacto` varchar(15) NOT NULL,
  `email_contacto` varchar(100) NOT NULL,
  `email_administrador` varchar(100) NOT NULL,
  `password_administrador` varchar(100) NOT NULL,
  `direccion_oficina` varchar(255) DEFAULT NULL,
  `mapa_embedded` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `telefono_contacto`, `email_contacto`, `email_administrador`, `password_administrador`, `direccion_oficina`, `mapa_embedded`) VALUES
(1, '123456789', 'contacto@virtuhomes.com', 'admin@virtuhomes.com', '', '456 Main St', 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3476.9558109071627!2d-66.34241857118006!3d-33.28432508428671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1645188876080!5m2!1ses-419!2sar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre_municipio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `nombre_municipio`) VALUES
(1, 'La Acebeda'),
(2, 'Ajalvir'),
(3, 'Alameda del Valle'),
(4, 'El Álamo'),
(5, 'Alcalá de Henares'),
(6, 'Alcobendas'),
(7, 'Alcorcón'),
(8, 'Aldea del Fresno'),
(9, 'Algete'),
(10, 'Alpedrete'),
(11, 'Ambite'),
(12, 'Anchuelo'),
(13, 'Aranjuez'),
(14, 'Arganda del Rey'),
(15, 'Arroyomolinos'),
(16, 'El Atazar'),
(17, 'Batres'),
(18, 'Becerril de la Sierra'),
(19, 'Belmonte de Tajo'),
(20, 'El Berrueco'),
(21, 'Berzosa del Lozoya'),
(22, 'Boadilla del Monte'),
(23, 'El Boalo'),
(24, 'Braojos'),
(25, 'Brea de Tajo'),
(26, 'Brunete'),
(27, 'Buitrago del Lozoya'),
(28, 'Bustarviejo'),
(29, 'Cabanillas de la Sierra'),
(30, 'La Cabrera'),
(31, 'Cadalso de los Vidrios'),
(32, 'Camarma de Esteruelas'),
(33, 'Campo Real'),
(34, 'Canencia'),
(35, 'Carabaña'),
(36, 'Casarrubuelos'),
(37, 'Cenicientos'),
(38, 'Cercedilla'),
(39, 'Cervera de Buitrago'),
(40, 'Chapinería'),
(41, 'Chinchón'),
(42, 'Ciempozuelos'),
(43, 'Cobeña'),
(44, 'Collado Mediano'),
(45, 'Collado Villalba'),
(46, 'Colmenar de Oreja'),
(47, 'Colmenar del Arroyo'),
(48, 'Colmenar Viejo'),
(49, 'Colmenarejo'),
(50, 'Corpa'),
(51, 'Coslada'),
(52, 'Cubas de la Sagra'),
(53, 'Daganzo de Arriba'),
(54, 'El Escorial'),
(55, 'Estremera'),
(56, 'Fresnedillas de la Oliva'),
(57, 'Fresno de Torote'),
(58, 'Fuenlabrada'),
(59, 'Fuente el Saz de Jarama'),
(60, 'Fuentidueña de Tajo'),
(61, 'Galapagar'),
(62, 'Garganta de los Montes'),
(63, 'Gargantilla del Lozoya y Pinilla de Buitrago'),
(64, 'Gascones'),
(65, 'Getafe'),
(66, 'Griñón'),
(67, 'Guadalix de la Sierra'),
(68, 'Guadarrama'),
(69, 'La Hiruela'),
(70, 'Horcajo de la Sierra-Aoslos'),
(71, 'Horcajuelo de la Sierra'),
(72, 'Hoyo de Manzanares'),
(73, 'Humanes de Madrid'),
(74, 'Leganés'),
(75, 'Loeches'),
(76, 'Lozoya'),
(77, 'Lozoyuela-Navas-Sieteiglesias'),
(78, 'Madarcos'),
(79, 'Madrid'),
(80, 'Majadahonda'),
(81, 'Manzanares el Real'),
(82, 'Meco'),
(83, 'Mejorada del Campo'),
(84, 'Miraflores de la Sierra'),
(85, 'El Molar'),
(86, 'Los Molinos'),
(87, 'Montejo de la Sierra'),
(88, 'Moraleja de Enmedio'),
(89, 'Moralzarzal'),
(90, 'Morata de Tajuña'),
(91, 'Móstoles'),
(92, 'Navacerrada'),
(93, 'Navalafuente'),
(94, 'Navalagamella'),
(95, 'Navalcarnero'),
(96, 'Navarredonda y San Mamés'),
(97, 'Navas del Rey'),
(98, 'Nuevo Baztán'),
(99, 'Olmeda de las Fuentes'),
(100, 'Orusco de Tajuña'),
(101, 'Paracuellos de Jarama'),
(102, 'Parla'),
(103, 'Patones'),
(104, 'Pedrezuela'),
(105, 'Pelayos de la Presa'),
(106, 'Perales de Tajuña'),
(107, 'Pezuela de las Torres'),
(108, 'Pinilla del Valle'),
(109, 'Pinto'),
(110, 'Piñuécar-Gandullas'),
(111, 'Pozuelo de Alarcón'),
(112, 'Pozuelo del Rey'),
(113, 'Prádena del Rincón'),
(114, 'Puebla de la Sierra'),
(115, 'Puentes Viejas'),
(116, 'Quijorna'),
(117, 'Rascafría'),
(118, 'Redueña'),
(119, 'Ribatejada'),
(120, 'Rivas-Vaciamadrid'),
(121, 'Robledillo de la Jara'),
(122, 'Robledo de Chavela'),
(123, 'Robregordo'),
(124, 'Las Rozas de Madrid'),
(125, 'Rozas de Puerto Real'),
(126, 'San Agustín del Guadalix'),
(127, 'San Fernando de Henares'),
(128, 'San Lorenzo de El Escorial'),
(129, 'San Martín de la Vega'),
(130, 'San Martín de Valdeiglesias'),
(131, 'San Sebastián de los Reyes'),
(132, 'Santa María de la Alameda'),
(133, 'Santorcaz'),
(134, 'Los Santos de la Humosa'),
(135, 'La Serna del Monte'),
(136, 'Serranillos del Valle'),
(137, 'Sevilla la Nueva'),
(138, 'Somosierra'),
(139, 'Soto del Real'),
(140, 'Talamanca de Jarama'),
(141, 'Tielmes'),
(142, 'Titulcia'),
(143, 'Torrejón de Ardoz'),
(144, 'Torrejón de la Calzada'),
(145, 'Torrejón de Velasco'),
(146, 'Torrelaguna'),
(147, 'Torrelodones'),
(148, 'Torremocha de Jarama'),
(149, 'Torres de la Alameda'),
(150, 'Tres Cantos'),
(151, 'Valdaracete'),
(152, 'Valdeavero'),
(153, 'Valdelaguna'),
(154, 'Valdemanco'),
(155, 'Valdemaqueda'),
(156, 'Valdemorillo'),
(157, 'Valdemoro'),
(158, 'Valdeolmos-Alalpardo'),
(159, 'Valdepiélagos'),
(160, 'Valdetorres de Jarama'),
(161, 'Valdilecha'),
(162, 'Valverde de Alcalá'),
(163, 'Velilla de San Antonio'),
(164, 'El Vellón'),
(165, 'Venturada'),
(166, 'Villa del Prado'),
(167, 'Villaconejos'),
(168, 'Villalbilla'),
(169, 'Villamanrique de Tajo'),
(170, 'Villamanta'),
(171, 'Villamantilla'),
(172, 'Villanueva de la Cañada'),
(173, 'Villanueva de Perales'),
(174, 'Villanueva del Pardillo'),
(175, 'Villar del Olmo'),
(176, 'Villarejo de Salvanés'),
(177, 'Villaviciosa de Odón'),
(178, 'Villavieja del Lozoya'),
(179, 'Zarzalejo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

DROP TABLE IF EXISTS `pisos`;
CREATE TABLE `pisos` (
  `id_piso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `aseos` int(11) NOT NULL,
  `metros` int(11) NOT NULL,
  `planta` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(160) NOT NULL,
  `municipio` int(11) NOT NULL,
  `calle` varchar(10) NOT NULL,
  `numero_calle` varchar(10) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `estado` enum('EN VENTA','VENDIDO','RETIRADO') NOT NULL DEFAULT 'EN VENTA',
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pisos`
--

INSERT INTO `pisos` (`id_piso`, `id_usuario`, `habitaciones`, `aseos`, `metros`, `planta`, `precio`, `descripcion`, `municipio`, `calle`, `numero_calle`, `codigo_postal`, `estado`, `imagen`) VALUES
(1, 4, 2, 1, 85, 6, 175200, 'Este piso contemporáneo ofrece un diseño elegante y minimalista. Con amplios ventanales que permiten la entrada de luz natural, su cocina abierta y electrodomés', 106, 'C/del Agil', '67', '28176', 'EN VENTA', './assets/img/img1.png'),
(2, 7, 4, 3, 210, 0, 386000, 'Disfruta de la vida al aire libre en este ático con una terraza panorámica. Vistas impresionantes de la ciudad, un espacio para barbacoas, y zonas de descanso h', 38, 'C/Pico del', '8', '28423', 'EN VENTA', './assets/img/img2.png'),
(3, 2, 3, 2, 110, 2, 245000, 'Este encantador piso rústico cuenta con suelos de madera, vigas a la vista y una acogedora chimenea. La decoración refleja la calidez del estilo rural, creando ', 72, 'C/del Peca', '140', '28040', 'EN VENTA', './assets/img/img3.png'),
(4, 6, 1, 1, 90, 10, 310972, 'Este loft renovado fusiona la esencia industrial con el lujo moderno. Techos altos, tuberías a la vista y suelos de hormigón crean un ambiente urbano, mientras ', 49, 'C/Consuegr', '19', '28019', 'EN VENTA', './assets/img/img4.png'),
(5, 7, 2, 2, 110, 4, 286064, 'Ubicado en un animado barrio bohemio, este piso refleja la diversidad y la creatividad del entorno. Colores vibrantes, muebles eclécticos y obras de arte origin', 17, 'C/del Noga', '28', '28712', 'EN VENTA', './assets/img/img5.png'),
(6, 2, 3, 1, 164, 1, 257000, 'Con paredes de ladrillo visto, suelos de cemento pulido y mobiliario moderno, este piso adopta un estilo industrial y minimalista. Grandes espacios abiertos cre', 31, 'C/Jara', '43', '28421', 'EN VENTA', './assets/img/img6.png'),
(7, 2, 4, 2, 205, 3, 329742, 'Este piso está diseñado con un enfoque eco-sostenible, utilizando materiales reciclados y sistemas de energía renovable. Con paneles solares, jardines verticale', 57, 'C/Gallegos', '72', '28540', 'EN VENTA', './assets/img/img7.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

DROP TABLE IF EXISTS `transacciones`;
CREATE TABLE `transacciones` (
  `id_transaccion` int(11) NOT NULL,
  `id_usuario_comprador` int(11) DEFAULT NULL,
  `id_piso` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `transacciones`
--
DROP TRIGGER IF EXISTS `mark_sold`;
DELIMITER $$
CREATE TRIGGER `mark_sold` AFTER INSERT ON `transacciones` FOR EACH ROW BEGIN
    UPDATE pisos
    SET estado = 'VENDIDO'
    WHERE id_piso = NEW.id_piso;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `dni`, `nombre`, `apellidos`, `correo`, `telefono`, `contrasenia`) VALUES
(1, '25975296Q', 'Pablo', 'Alonso', 'pablo@gmail.com', '611223344', '$2y$10$MVwVdzLlodZ89L.z.8ztDevRImLuLl8O5ji5NzSw4n8isNKPxTB72'),
(2, '50613576Y', 'Alex', 'Carrascal', 'alex@gmail.com', '622334455', '$2y$10$OeHXHeLv.E3uEAdrHNMt7OetR6sHiBLyYB/KWpCOP2S.oMTMcx6mS'),
(3, '79376518E', 'Lucia', 'Soto', 'luci.soto@gmail.com', '633445566', '$2y$10$TN6CZ0cIW7vA3QPk.QEL6O/oC4x.Cuju5a4K1jWIZgXItzMgQhHHq'),
(4, '15038034J', 'Lucia', 'Garcia', 'lucia99@gmail.com', '644556677', '$2y$10$TN6CZ0cIW7vA3QPk.QEL6O/oC4x.Cuju5a4K1jWIZgXItzMgQhHHq'),
(5, '30018456Y', 'Ivan', 'Perez', 'ivan.p@gmail.com', '655667788', '$2y$10$5SU6yPQ26de8LUV8GcFRNuy5V3p/qWXO.lTWtpDvM2te14RITu99i'),
(6, '94731855F', 'Diana', 'Ramirez', 'diana@gmail.com', '666778899', '$2y$10$RQGlE.ZmjF/T/DF9nifkOejwvoTqkLwAD9cqP6v/D6F5I6txUSEny'),
(7, '01735923K', 'Pablo', 'San Miguel', 'pablo.s@gmail.com', '677889900', '$2y$10$MVwVdzLlodZ89L.z.8ztDevRImLuLl8O5ji5NzSw4n8isNKPxTB72'),
(8, '63974296A', 'Jose Manuel', 'Garcia', 'jose_g@gmail.com', '688990011', '$2y$10$U6hhJ43JCMkvW3hTguigU.JB6/MG2y.ZMKGLLxbzhIjgYjUg0QTzC'),
(9, '18357428R', 'Angel', 'Mojica', 'angel@gmail.com', '699001122', '$2y$10$yJTcY8koqzau7ZgcPtipPeZKp07cXZDNUaZNGkSTMKeY4Xxfp6u5C'),
(10, '38317853Z', 'Maria', 'Perez', 'maria@gmail.com', '600112233', '$2y$10$Keu1BzmN1zMEABID.mm6q.HDC4mtyZyxaMbesjH1WWDHbeLpAjkf.'),
(12, '79376518A', 'Pablo', 'Ramirez', 'pablor@gmail.com', '654654654', '$2y$10$NdQ4PXI6cCXvAacYACo4zOOsDHkaK5lJESA3FDjH3gLQU6uwGz8V.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`),
  ADD UNIQUE KEY `id_configuracion` (`id_configuracion`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`id_piso`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `municipio` (`municipio`) USING BTREE;

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_usuario_comprador` (`id_usuario_comprador`),
  ADD KEY `id_piso` (`id_piso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `id_piso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `municipio_ibfk_!` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipio`),
  ADD CONSTRAINT `pisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`id_usuario_comprador`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `transacciones_ibfk_2` FOREIGN KEY (`id_piso`) REFERENCES `pisos` (`id_piso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
