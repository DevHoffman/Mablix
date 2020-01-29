-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2020 at 01:51 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mablix`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_animes`
--

DROP TABLE IF EXISTS `tbl_animes`;
CREATE TABLE IF NOT EXISTS `tbl_animes` (
  `CodiAnime` int(11) NOT NULL AUTO_INCREMENT,
  `Anime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Texto` longtext COLLATE utf8_unicode_ci,
  `Descricao` text COLLATE utf8_unicode_ci,
  `CodiCategoria` int(10) NOT NULL,
  `Imagem_Destacada` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Trailer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataLancamento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CodiAnime`),
  KEY `CodiCategoria_fk` (`CodiCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_animes`
--

INSERT INTO `tbl_animes` (`CodiAnime`, `Anime`, `Texto`, `Descricao`, `CodiCategoria`, `Imagem_Destacada`, `Trailer`, `DataLancamento`) VALUES
(81, 'Anime 06', NULL, 'Descrição 06', 1, 'grow-green.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 19:16:28'),
(82, 'Teste', NULL, 'Teste 1234567890', 2, 'guitarist.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 21:46:24'),
(80, 'Anime 05', NULL, 'Descrição 05', 5, 'the-beetle.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 19:16:10'),
(76, 'Anime 01', NULL, 'Descrição 01', 1, 'lady-shutterbug.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 19:05:31'),
(77, 'Anime 02', NULL, 'Descrição 02', 2, 'woodcraft.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 19:14:03'),
(78, 'Anime 03', NULL, 'Descrição 03', 3, 'guitarist@2x.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 19:14:21'),
(79, 'Anime 04', NULL, 'Descrição 04', 4, 'palmeira.jpg', 'Glint - Google Chrome 2019-12-31 02-11-40.mp4', '2020-01-28 19:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorias`
--

DROP TABLE IF EXISTS `tbl_categorias`;
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `CodiCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`CodiCategoria`, `Categoria`) VALUES
(1, 'Categoria 01'),
(2, 'Categoria 02'),
(3, 'Categoria 03'),
(4, 'Categoria 04'),
(5, 'Categoria 05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_episodios`
--

DROP TABLE IF EXISTS `tbl_episodios`;
CREATE TABLE IF NOT EXISTS `tbl_episodios` (
  `CodiEpisodio` int(11) NOT NULL AUTO_INCREMENT,
  `CodiAnime` int(10) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataPublicacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Imagem_Destacada` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiEpisodio`),
  KEY `CodiAnime_fk` (`CodiAnime`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_episodios`
--

INSERT INTO `tbl_episodios` (`CodiEpisodio`, `CodiAnime`, `Titulo`, `DataPublicacao`, `Video`, `Imagem_Destacada`) VALUES
(53, 82, 'Teste', '2020-01-28 22:13:46', 'https://vjs.zencdn.net/v/oceans.mp4', 'guitarist.jpg'),
(48, 76, 'Episodio 01', '2020-01-28 19:31:13', 'https://vjs.zencdn.net/v/oceans.mp4', 'guitarist.jpg'),
(49, 76, 'Episodio 02', '2020-01-28 19:31:28', 'https://vjs.zencdn.net/v/oceans.mp4', 'palmeira.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `CodiLog` int(11) NOT NULL AUTO_INCREMENT,
  `Log` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataLog` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CodiUsuario` int(10) NOT NULL,
  `Ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiLog`),
  KEY `CodiUsuario_fk` (`CodiUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`CodiLog`, `Log`, `DataLog`, `CodiUsuario`, `Ip`) VALUES
(1, 'Usuário Autenticado', '2020-01-14 21:47:10', 50, '127.0.0.1'),
(2, 'Usuário Autenticado', '2020-01-14 22:11:09', 50, '127.0.0.1'),
(3, 'Usuário Autenticado', '2020-01-14 22:50:14', 50, '127.0.0.1'),
(4, 'Usuário Autenticado', '2020-01-15 09:23:48', 50, '127.0.0.1'),
(5, 'Usuário Autenticado', '2020-01-15 09:33:12', 50, '127.0.0.1'),
(6, 'Usuário Autenticado', '2020-01-15 12:12:43', 50, '127.0.0.1'),
(7, 'Usuário Autenticado', '2020-01-15 12:14:52', 50, '127.0.0.1'),
(8, 'Usuário Autenticado', '2020-01-15 12:23:04', 50, '127.0.0.1'),
(9, 'Usuário Autenticado', '2020-01-15 12:29:21', 50, '127.0.0.1'),
(10, 'Usuário Autenticado', '2020-01-15 12:32:39', 50, '127.0.0.1'),
(11, 'Usuário Autenticado', '2020-01-15 12:52:50', 50, '127.0.0.1'),
(12, 'Usuário Autenticado', '2020-01-15 18:14:47', 50, '127.0.0.1'),
(13, 'Usuário Autenticado', '2020-01-15 22:41:29', 50, '127.0.0.1'),
(14, 'Usuário Autenticado', '2020-01-16 08:58:05', 50, '127.0.0.1'),
(15, 'Usuário Autenticado', '2020-01-16 21:35:50', 50, '127.0.0.1'),
(16, 'Usuário Autenticado', '2020-01-16 21:52:20', 50, '127.0.0.1'),
(17, 'Usuário Autenticado', '2020-01-16 22:50:45', 50, '127.0.0.1'),
(18, 'Usuário Autenticado', '2020-01-17 08:38:43', 50, '127.0.0.1'),
(19, 'Usuário Autenticado', '2020-01-17 08:39:33', 50, '127.0.0.1'),
(20, 'Usuário Autenticado', '2020-01-17 08:39:57', 50, '127.0.0.1'),
(21, 'Usuário Autenticado', '2020-01-17 08:44:42', 50, '127.0.0.1'),
(22, 'Usuário Autenticado', '2020-01-17 09:17:26', 50, '127.0.0.1'),
(23, 'Usuário Autenticado', '2020-01-19 22:20:44', 68, '127.0.0.1'),
(24, 'Usuário Autenticado', '2020-01-20 15:50:29', 50, '127.0.0.1'),
(25, 'Usuário Autenticado', '2020-01-21 06:46:06', 50, '127.0.0.1'),
(26, 'Usuário Autenticado', '2020-01-21 11:31:47', 50, '127.0.0.1'),
(27, 'Usuário Autenticado', '2020-01-22 11:24:37', 50, '127.0.0.1'),
(28, 'Usuário Autenticado', '2020-01-22 12:18:15', 69, '127.0.0.1'),
(29, 'Usuário Autenticado', '2020-01-22 12:35:18', 70, '127.0.0.1'),
(30, 'Usuário Autenticado', '2020-01-22 13:54:00', 69, '127.0.0.1'),
(31, 'Usuário Autenticado', '2020-01-22 23:54:27', 69, '127.0.0.1'),
(32, 'Usuário Autenticado', '2020-01-23 09:06:43', 69, '127.0.0.1'),
(33, 'Usuário Autenticado', '2020-01-23 11:51:46', 83, '127.0.0.1'),
(34, 'Usuário Autenticado', '2020-01-23 11:52:28', 83, '127.0.0.1'),
(35, 'Usuário Autenticado', '2020-01-23 13:40:20', 69, '127.0.0.1'),
(36, 'Usuário Autenticado', '2020-01-23 15:44:26', 69, '::1'),
(37, 'Usuário Autenticado', '2020-01-23 15:45:07', 69, '::1'),
(38, 'Usuário Autenticado', '2020-01-23 15:45:55', 69, '::1'),
(39, 'Usuário Autenticado', '2020-01-23 23:51:28', 69, '::1'),
(40, 'Usuário Autenticado', '2020-01-24 11:20:26', 69, '::1'),
(41, 'Usuário Autenticado', '2020-01-24 16:04:52', 69, '::1'),
(42, 'Usuário Autenticado', '2020-01-25 12:56:39', 69, '::1'),
(43, 'Usuário Autenticado', '2020-01-25 15:22:53', 69, '::1'),
(44, 'Usuário Autenticado', '2020-01-26 14:52:48', 69, '::1'),
(45, 'Usuário Autenticado', '2020-01-26 18:02:58', 69, '::1'),
(46, 'Usuário Autenticado', '2020-01-26 19:28:10', 69, '::1'),
(47, 'Usuário Autenticado', '2020-01-27 00:10:50', 69, '::1'),
(48, 'Usuário Autenticado', '2020-01-27 12:57:25', 69, '::1'),
(49, 'Usuário Autenticado', '2020-01-27 21:56:15', 69, '::1'),
(50, 'Usuário Autenticado', '2020-01-28 12:38:11', 69, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

DROP TABLE IF EXISTS `tbl_newsletter`;
CREATE TABLE IF NOT EXISTS `tbl_newsletter` (
  `CodiEmail` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiEmail`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`CodiEmail`, `Email`) VALUES
(14, 'teste@teste.com'),
(15, 'teste1@teste.com'),
(16, 'teste2@teste.com'),
(19, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nivelacesso`
--

DROP TABLE IF EXISTS `tbl_nivelacesso`;
CREATE TABLE IF NOT EXISTS `tbl_nivelacesso` (
  `CodiNivelAcesso` int(11) NOT NULL AUTO_INCREMENT,
  `NivelAcesso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiNivelAcesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_nivelacesso`
--

INSERT INTO `tbl_nivelacesso` (`CodiNivelAcesso`, `NivelAcesso`) VALUES
(1, 'Administrador'),
(2, 'Usuário');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `CodiUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodiNivelAcesso` int(10) NOT NULL DEFAULT '2',
  `Foto` varchar(155) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  PRIMARY KEY (`CodiUsuario`),
  KEY `CodiNivelAcesso_fk` (`CodiNivelAcesso`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`CodiUsuario`, `Usuario`, `Login`, `Senha`, `Email`, `CodiNivelAcesso`, `Foto`) VALUES
(69, 'Thyago Hoffman', 'hoffman', '$2y$10$4l0SJCP4b5AvD2XkDuv/deb5mQ3H7ibQAugYX2U6BBiUmX/Ozr/iK', 'thoffman1698@gmail.com', 1, 'user-04.jpg'),
(88, 'Teste', 'Teste', '$2y$10$4t/eEJGN/IZe3lJoGhtIbuKTGmXYw85ZH2s0DQ4RkO9OxRAG47mY2', 'teste@teste.com', 2, 'user.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
