-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2014 at 11:18 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `corsarios`
--

-- --------------------------------------------------------

--
-- Table structure for table `ataques`
--

CREATE TABLE IF NOT EXISTS `ataques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `enemig` int(11) NOT NULL,
  `origenX` int(11) NOT NULL,
  `origenY` int(11) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `direccion` double NOT NULL,
  `danio` int(11) NOT NULL,
  `arma` text NOT NULL,
  `atack` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cofres`
--

CREATE TABLE IF NOT EXISTS `cofres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oro` int(11) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cofres`
--

INSERT INTO `cofres` (`id`, `oro`, `posX`, `posY`) VALUES
(1, 28, -4679, -3168);

-- --------------------------------------------------------

--
-- Table structure for table `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` int(11) NOT NULL,
  `leido` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `mensajes`
--

INSERT INTO `mensajes` (`id`, `player`, `titulo`, `mensaje`, `fecha`, `leido`) VALUES
(24, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 7 y 6. Suma: 13<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389707974, 0),
(26, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 1 y 3. Suma: 4<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708008, 0),
(28, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 6 y 7. Suma: 13<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708015, 0),
(30, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 5 y 7. Suma: 12<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708021, 0),
(32, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 6 y 1. Suma: 7<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708042, 0),
(34, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 7 y 6. Suma: 13<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708048, 0),
(36, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 7 y 1. Suma: 8<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708057, 0),
(38, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 7 y 1. Suma: 8<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708079, 0),
(40, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 4 y 3. Suma: 7<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708087, 0),
(42, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 1 y 3. Suma: 4<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708093, 0),
(44, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 5 y 1. Suma: 6<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708116, 0),
(46, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 4 y 5. Suma: 9<br>El retador Pablo aposto 9 y gano 20% del oro enemigo<br>El defensor Maxi perdio 0 de Oro<br>', 1389708125, 0),
(48, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 1 y 1. Suma: 2<br>El retador Pablo aposto 9 y perdio<br>El defensor Maxi gano<br>', 1389708132, 0),
(50, 4, 'Informe de Duelo', 'Informe del duelo Cara o Cruz<br>El retador Pablo aposto cara y gano 1% del oro enemigo<br>El defensor Maxi perdio 0 de Oro<br>', 1389712775, 0),
(52, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 6 y 1. Suma: 7<br>El retador Pablo aposto 10 y perdio<br>El defensor Maxi gano<br>', 1390094605, 0),
(54, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 5 y 7. Suma: 12<br>El retador Pablo aposto 10 y perdio<br>El defensor Maxi gano<br>', 1390094606, 0),
(56, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 1 y 2. Suma: 3<br>El retador Pablo aposto 10 y perdio<br>El defensor Maxi gano<br>', 1390094606, 0),
(58, 4, 'Informe de Duelo', 'Informe del duelo Dados<br>Salieron los dados: 5 y 7. Suma: 12<br>El retador Pablo aposto 5 y perdio<br>El defensor Maxi gano<br>', 1390094706, 0),
(60, 4, 'Informe de Duelo', 'Informe del duelo Cara o Cruz<br>El retador Pablo aposto cara y perdio<br>El defensor Maxi gano<br>', 1390094902, 0),
(66, 4, 'Pesca robada', 'Te robaron la red 7127:5422', 0, 1),
(75, 3, 'Cofre capturado', 'Oro del cofre: -400<br>Ahora tenes: 795096', 1395860541, 0),
(76, 3, 'Pesca capturada', 'Oro segun la venta de la pesca: 62218<br>Ahora tenes: 846364', 1401212481, 0),
(77, 3, 'Cofre capturado', 'Oro del cofre: -5879<br>Ahora tenes: 840485', 1401239080, 1),
(78, 3, 'Cofre capturado', 'Oro del cofre: 47<br>Ahora tenes: 840532', 1401239403, 1),
(79, 3, 'Pesca capturada', 'Oro segun la venta de la pesca: 0<br>Ahora tenes: 0', 1401300877, 1),
(80, 11, 'Pesca capturada', 'Oro segun la venta de la pesca: 0<br>Ahora tenes: 0', 1401838143, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobs`
--

CREATE TABLE IF NOT EXISTS `mobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vida` int(11) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  `model` text NOT NULL,
  `direction` int(11) NOT NULL,
  `oro` int(11) NOT NULL,
  `vidaTotal` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Dumping data for table `mobs`
--

INSERT INTO `mobs` (`id`, `vida`, `posX`, `posY`, `model`, `direction`, `oro`, `vidaTotal`) VALUES
(47, 436, -6769, 3423, 'Tortuga', 0, 45, 436),
(49, 373, -7129, 3420, 'Tortuga', 0, 39, 373),
(50, 66, -7416, 4637, 'Canoa', 0, 42, 402),
(52, 457, -6001, 4483, 'Tortuga', 0, 47, 457),
(53, 294, -6535, 3823, 'Tortuga', 0, 31, 294),
(54, 318, -6045, 5595, 'Tortuga', 0, 33, 318),
(55, 297, -6556, 4755, 'Tortuga', 0, 31, 297),
(56, 158, -6535, 5069, 'Tortuga', 0, 17, 158),
(57, 179, -7188, 4934, 'Tortuga', 0, 19, 179),
(58, 311, -7326, 4712, 'Tortuga', 0, 33, 311),
(59, 268, -5601, 5383, 'Tortuga', 0, 28, 268),
(60, 294, -5637, 5833, 'Tortuga', 0, 31, 294),
(61, 175, -7392, 3912, 'Tortuga', 0, 19, 175),
(62, 270, -6203, 4429, 'Tortuga', 0, 28, 270),
(63, 135, -7559, 4107, 'Tortuga', 0, 15, 135),
(64, 231, -7183, 4386, 'Tortuga', 0, 25, 231),
(65, 145, -7554, 4162, 'Tortuga', 0, 16, 145),
(66, 254, -6550, 4691, 'Tortuga', 0, 27, 254),
(67, 165, -5680, 5861, 'Tortuga', 0, 18, 165),
(68, 206, -5229, 4249, 'Tortuga', 0, 22, 206),
(69, 250, -5407, 5777, 'Tortuga', 0, 26, 250),
(70, 201, -5656, 6072, 'Tortuga', 0, 22, 201),
(71, 0, -5063, 5710, 'Tortuga', 0, 1, 0),
(72, 0, -5078, 5257, 'Tortuga', 0, 1, 0),
(74, 407, -5412, -3259, 'Tortuga', 0, 42, 407),
(75, 491, -4892, -4399, 'Tortuga', 0, 51, 491),
(76, 192, -4400, -3793, 'Tortuga', 0, 21, 192),
(77, 287, -4147, -3528, 'Tortuga', 0, 30, 287),
(78, 234, -4657, -3486, 'Tortuga', 0, 25, 234),
(79, 400, -4809, -2352, 'Tortuga', 0, 41, 400),
(80, 340, -5156, -4082, 'Tortuga', 0, 35, 340),
(81, 394, -5323, -2567, 'Tortuga', 0, 41, 394),
(82, 429, -4257, -3288, 'Tortuga', 0, 44, 429),
(83, 442, -4162, -3110, 'Tortuga', 0, 46, 442),
(84, 420, -5188, -2514, 'Tortuga', 0, 43, 420),
(85, 236, -4412, -2682, 'Tortuga', 0, 25, 236),
(86, 230, -4121, -4184, 'Tortuga', 0, 24, 230),
(87, 453, -4557, -4056, 'Tortuga', 0, 47, 453),
(88, 265, -4692, -2407, 'Tortuga', 0, 28, 265),
(89, 403, -4306, -4148, 'Tortuga', 0, 42, 403),
(90, 155, -4757, -2723, 'Tortuga', 0, 25, 239),
(91, 409, -4746, -3342, 'Tortuga', 0, 42, 409),
(92, 200, -5260, -4178, 'Tortuga', 0, 21, 200),
(93, 394, -4658, -2905, 'Tortuga', 0, 41, 394),
(94, 420, -4974, -3872, 'Tortuga', 0, 43, 420),
(95, 206, -6191, -3944, 'Tortuga', 0, 22, 206),
(96, 281, -4957, -3553, 'Tortuga', 0, 30, 281),
(97, 311, -4841, -2595, 'Tortuga', 0, 33, 311),
(98, 410, -5394, -3061, 'Tortuga', 0, 42, 410),
(99, 351, -6517, -3644, 'Tortuga', 0, 37, 351),
(100, 314, -5624, -4021, 'Tortuga', 0, 33, 314),
(101, 332, -5329, -3352, 'Tortuga', 0, 35, 332),
(102, 184, -5047, -2120, 'Tortuga', 0, 20, 184),
(103, 243, -5698, -2437, 'Tortuga', 0, 26, 243),
(104, 268, -5334, -2127, 'Tortuga', 0, 28, 268),
(105, 183, -5385, -3814, 'Tortuga', 0, 20, 183),
(106, 190, -4822, -2207, 'Tortuga', 0, 20, 190),
(107, 174, -6603, -2409, 'Tortuga', 0, 19, 174),
(108, 310, -6613, -3265, 'Tortuga', 0, 32, 310),
(109, 370, -5467, -2334, 'Tortuga', 0, 38, 370),
(110, 362, -5855, -2205, 'Tortuga', 0, 38, 362),
(111, 257, -5049, -2897, 'Tortuga', 0, 27, 257),
(112, 301, -5916, -2856, 'Tortuga', 0, 32, 301),
(113, 218, -4796, -3313, 'Tortuga', 0, 23, 218),
(114, 295, -5908, -3635, 'Tortuga', 0, 31, 295),
(115, 428, -6326, -2348, 'Tortuga', 0, 44, 428),
(116, 346, -5393, -3112, 'Tortuga', 0, 36, 346),
(117, 368, -6546, -4002, 'Tortuga', 0, 38, 368),
(118, 193, -6224, -3615, 'Tortuga', 0, 21, 193),
(119, 420, -4901, -3417, 'Tortuga', 0, 43, 420),
(120, 247, -5543, -2909, 'Tortuga', 0, 26, 247),
(121, 237, -5009, -2932, 'Tortuga', 0, 25, 237),
(122, 425, -5408, -2161, 'Tortuga', 0, 44, 425),
(123, 214, -4964, -2269, 'Tortuga', 0, 23, 214),
(124, 337, -6047, -2970, 'Tortuga', 0, 35, 337),
(125, 180, -6192, -2745, 'Tortuga', 0, 19, 180),
(126, 251, -5251, -3134, 'Tortuga', 0, 27, 251),
(127, 300, -5114, -2120, 'Tortuga', 0, 31, 300),
(128, 263, -5354, -3347, 'Tortuga', 0, 28, 263),
(129, 383, -5197, -3163, 'Tortuga', 0, 40, 383),
(130, 240, -6285, -3257, 'Tortuga', 0, 25, 240),
(131, 396, -5160, -3595, 'Tortuga', 0, 41, 396),
(132, 200, -4695, -3544, 'Tortuga', 0, 21, 200),
(133, 400, -5488, -2424, 'Tortuga', 0, 41, 400),
(134, 203, -6210, -3916, 'Tortuga', 0, 22, 203),
(135, 376, -6304, -3498, 'Tortuga', 0, 39, 376),
(136, 361, -5863, -3286, 'Tortuga', 0, 38, 361),
(137, 203, -5280, -2493, 'Tortuga', 0, 22, 203),
(138, 346, -6203, -2669, 'Tortuga', 0, 36, 346),
(139, 257, -6233, -2377, 'Tortuga', 0, 31, 299),
(140, 434, -5861, -3362, 'Tortuga', 0, 45, 434),
(141, 260, -5139, -3114, 'Tortuga', 0, 27, 260),
(142, 203, -4895, -3248, 'Tortuga', 0, 22, 203),
(143, 327, -5886, -3128, 'Tortuga', 0, 34, 327),
(144, 359, -5144, -2819, 'Tortuga', 0, 42, 401),
(145, 378, -5506, -2922, 'Tortuga', 0, 39, 378),
(146, 176, -6086, -2940, 'Tortuga', 0, 19, 176),
(147, 290, -4868, -3320, 'Tortuga', 0, 30, 290),
(148, 292, -6670, -2209, 'Tortuga', 0, 31, 292),
(149, 8, -359, 6457, 'Tortuga', 0, 2, 9),
(150, 8, -223, 5655, 'Tortuga', 0, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pesca`
--

CREATE TABLE IF NOT EXISTS `pesca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` text NOT NULL,
  `nick` text NOT NULL,
  `pass` text NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  `undir` int(11) NOT NULL,
  `vida` int(11) NOT NULL,
  `oro` int(11) NOT NULL,
  `direction` double NOT NULL,
  `fog` int(11) NOT NULL,
  `uclick` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `autentificado` int(11) NOT NULL,
  `ataque` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `mail`, `nick`, `pass`, `posX`, `posY`, `undir`, `vida`, `oro`, `direction`, `fog`, `uclick`, `ban`, `autentificado`, `ataque`, `nivel`) VALUES
(3, 'costanzo_pablo@hotmail.com', 'Pablo', 'cae656821714ec23efd5eb520a8456f6', -5869, -2545, 0, 332, 0, 5.6162605953466, 0, 1402160120, 0, 0, 1402160106, 42),
(5, 'costanzo_maxi@hotmail.com', 'Sehkmet', 'c610759a421cd8ef10f3e01719924c0f', 9865, 6729, 0, 110, 0, 2.32416401882, 0, 1391382325, 0, 0, 0, 11),
(6, 'gerlpino@hotmail.com', 'tuka', 'd016b80d074a0b179ab4797ada5deaf1', 7450, 9558, 0, 210, 0, 6.29173587146, 0, 1391134764, 0, 0, 0, 21),
(7, 'gastonmsistemas@gmail.com', 'gatowan', '734bdef4389c8ae98340fd79570db136', 8697, 397, 0, 268, 0, 4.725, 0, 1391217755, 0, 0, 0, 31),
(10, 'fff@fff.com', 'Test', 'cae656821714ec23efd5eb520a8456f6', -1984, 116, 0, 10, 0, 6, 0, 1391430651, 0, 0, 0, 1),
(11, 'waly71@gmail.com', 'waly', '6bb6b25a965f49e7d8f0f67d2562ac41', -860, 5750, 0, 10, 0, 4.725, 0, 1401838475, 0, 0, 1401838204, 1);

-- --------------------------------------------------------

--
-- Table structure for table `viajes`
--

CREATE TABLE IF NOT EXISTS `viajes` (
  `player` int(11) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  `ucheck` int(11) NOT NULL,
  UNIQUE KEY `player` (`player`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `viajes`
--

INSERT INTO `viajes` (`player`, `posX`, `posY`, `ucheck`) VALUES
(3, -6201, -2136, 1402160119);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
