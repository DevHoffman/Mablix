DROP TABLE IF EXISTS tbl_animes;

CREATE TABLE `tbl_animes` (
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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_animes WRITE;
INSERT INTO tbl_animes (CodiAnime, Anime, Texto, Descricao, CodiCategoria, Imagem_Destacada, Trailer, DataLancamento) VALUES ('1', 'Anime 01', 'Texto 01', 'Descricao 01', '1', 'assets/images/portfolio/guitarist.jpg', NULL, '2020-01-09T20:29:30'), ('2', 'Anime 02', 'Texto 02', 'Descricao 02', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2020-01-08T10:53:10'), ('3', 'Anime 03', 'Texto 03', 'Descricao 03', '3', 'assets/images/portfolio/guitarist.jpg', NULL, '2020-01-07T10:53:10'), ('4', 'Anime 04', 'Texto 04', 'Descricao 04', '4', 'assets/images/portfolio/gallery/g-shutterbug.jpg', NULL, '2020-01-06T10:53:10'), ('5', 'Anime 05', 'Texto 05', 'Descricao 05', '1', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('6', 'Anime 06', 'Texto 06', 'Descricao 06', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('7', 'Anime 07', 'Texto 07', 'Descricao 07', '3', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('8', 'Anime 08', 'Texto 08', 'Descricao 08', '4', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-30T20:29:30'), ('9', 'Anime 09', 'Texto 09', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('10', 'Anime 10', 'Texto 10', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('11', 'Anime 11', 'Texto 11', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('12', 'Anime 12', 'Texto 12', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('13', 'Anime 13', 'Texto 13', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('14', 'Anime 14', 'Texto 14', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('15', 'Anime 15', 'Texto 15', 'Descricao 09', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('26', 'Anime 16', 'Texto 16', 'Descricao 16', '2', 'assets/images/portfolio/guitarist.jpg', NULL, '2019-12-29T20:29:30'), ('25', 'Teste', 'Teste', 'Teste', '1', 'assets/images/portfolio/guitarist.jpg', NULL, '2020-01-10T11:09:52');
UNLOCK TABLES;

DROP TABLE IF EXISTS tbl_categorias;

CREATE TABLE `tbl_categorias` (
  `CodiCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_categorias WRITE;
INSERT INTO tbl_categorias (CodiCategoria, Categoria) VALUES ('1', 'Categoria 01'), ('2', 'Categoria 02'), ('3', 'Categoria 03'), ('4', 'Categoria 04');
UNLOCK TABLES;

DROP TABLE IF EXISTS tbl_episodios;

CREATE TABLE `tbl_episodios` (
  `CodiEpisodio` int(11) NOT NULL AUTO_INCREMENT,
  `CodiAnime` int(10) NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataPublicacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Imagem_Destacada` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Temporada` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodiEpisodio`),
  KEY `CodiAnime_fk` (`CodiAnime`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_episodios WRITE;
INSERT INTO tbl_episodios (CodiEpisodio, CodiAnime, Titulo, Descricao, DataPublicacao, Video, Imagem_Destacada, Temporada) VALUES ('1', '1', 'Tituloteste', 'Descricao 01', '2020-01-07T23:20:00', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('2', '2', 'Titulo 02', 'Descricao 02', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('3', '3', 'Titulo 03', 'Descricao 03', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('4', '4', 'Titulo 04', 'Descricao 04', '2020-01-07T23:21:49', 'https://vjs.zencdn.net/v/oceans.mp4', 'assets/images/portfolio/guitarist.jpg', NULL), ('5', '1', 'Titulo 05', 'Descricao 05', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('6', '2', 'Titulo 06', 'Descricao 06', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('7', '2', 'Titulo 06', 'Descricao 07', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('8', '2', 'Titulo 06', 'Descricao 08', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('9', '2', 'Titulo 06', 'Descricao 09', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('10', '2', 'Titulo 06', 'Descricao 01', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('11', '2', 'Titulo 06', 'Descricao 02', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('12', '6', 'Titulo 06', 'Descricao 03', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('13', '2', 'Titulo 06', 'Descricao 04', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('14', '2', 'Titulo 06', 'Descricao 05', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('15', '2', 'Titulo 06', 'Descricao 06', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('16', '2', 'Titulo 06', 'Descricao 07', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('17', '2', 'Titulo 06', 'Descricao 08', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('18', '2', 'Titulo 06', 'Descricao 09', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('19', '2', 'Titulo 06', 'Descricao 01', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('20', '2', 'Titulo 06', 'Descricao 02', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('21', '2', 'Titulo 06', 'Descricao 03', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('22', '2', 'Titulo 06', 'Descricao 04', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('23', '2', 'Titulo 06', 'Descricao 05', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('24', '2', 'Titulo 06', 'Descricao 06', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('25', '2', 'Titulo 06', 'Descricao 07', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('26', '2', 'Titulo 06', 'Descricao 08', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('27', '2', 'Titulo 06', 'Descricao 09', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('28', '2', 'Titulo 06', 'Descricao 01', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('29', '2', 'Titulo 06', 'Descricao 02', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('30', '2', 'Titulo 06', 'Descricao 03', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('31', '2', 'Titulo 06', 'Descricao 04', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('32', '2', 'Titulo 06', 'Descricao 05', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('33', '2', 'Titulo 06', 'Descricao 06', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('34', '2', 'Titulo 06', 'Descricao 07', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('35', '2', 'Titulo 06', 'Descricao 08', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('36', '2', 'Titulo 06', 'Descricao 09', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('37', '2', 'Titulo 06', 'Descricao 01', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('38', '2', 'Titulo 06', 'Descricao 02', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('39', '2', 'Titulo 06', 'Descricao 03', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('40', '2', 'Titulo 06', 'Descricao 04', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL), ('41', '2', 'Titulo 06', 'Descricao 05', '2020-01-07T23:21:49', 'assets/images/portfolio/guitarist.jpg', 'assets/images/portfolio/guitarist.jpg', NULL);
UNLOCK TABLES;

DROP TABLE IF EXISTS tbl_logs;

CREATE TABLE `tbl_logs` (
  `CodiLog` int(11) NOT NULL AUTO_INCREMENT,
  `Log` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataLog` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CodiUsuario` int(10) NOT NULL,
  `Ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiLog`),
  KEY `CodiUsuario_fk` (`CodiUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_logs WRITE;
INSERT INTO tbl_logs (CodiLog, Log, DataLog, CodiUsuario, Ip) VALUES ('1', 'Usuário Autenticado', '2020-01-14T21:47:10', '50', '127.0.0.1'), ('2', 'Usuário Autenticado', '2020-01-14T22:11:09', '50', '127.0.0.1'), ('3', 'Usuário Autenticado', '2020-01-14T22:50:14', '50', '127.0.0.1'), ('4', 'Usuário Autenticado', '2020-01-15T09:23:48', '50', '127.0.0.1'), ('5', 'Usuário Autenticado', '2020-01-15T09:33:12', '50', '127.0.0.1'), ('6', 'Usuário Autenticado', '2020-01-15T12:12:43', '50', '127.0.0.1'), ('7', 'Usuário Autenticado', '2020-01-15T12:14:52', '50', '127.0.0.1'), ('8', 'Usuário Autenticado', '2020-01-15T12:23:04', '50', '127.0.0.1'), ('9', 'Usuário Autenticado', '2020-01-15T12:29:21', '50', '127.0.0.1'), ('10', 'Usuário Autenticado', '2020-01-15T12:32:39', '50', '127.0.0.1'), ('11', 'Usuário Autenticado', '2020-01-15T12:52:50', '50', '127.0.0.1'), ('12', 'Usuário Autenticado', '2020-01-15T18:14:47', '50', '127.0.0.1'), ('13', 'Usuário Autenticado', '2020-01-15T22:41:29', '50', '127.0.0.1'), ('14', 'Usuário Autenticado', '2020-01-16T08:58:05', '50', '127.0.0.1'), ('15', 'Usuário Autenticado', '2020-01-16T21:35:50', '50', '127.0.0.1'), ('16', 'Usuário Autenticado', '2020-01-16T21:52:20', '50', '127.0.0.1'), ('17', 'Usuário Autenticado', '2020-01-16T22:50:45', '50', '127.0.0.1'), ('18', 'Usuário Autenticado', '2020-01-17T08:38:43', '50', '127.0.0.1'), ('19', 'Usuário Autenticado', '2020-01-17T08:39:33', '50', '127.0.0.1'), ('20', 'Usuário Autenticado', '2020-01-17T08:39:57', '50', '127.0.0.1'), ('21', 'Usuário Autenticado', '2020-01-17T08:44:42', '50', '127.0.0.1'), ('22', 'Usuário Autenticado', '2020-01-17T09:17:26', '50', '127.0.0.1'), ('23', 'Usuário Autenticado', '2020-01-19T22:20:44', '68', '127.0.0.1'), ('24', 'Usuário Autenticado', '2020-01-20T15:50:29', '50', '127.0.0.1'), ('25', 'Usuário Autenticado', '2020-01-21T06:46:06', '50', '127.0.0.1'), ('26', 'Usuário Autenticado', '2020-01-21T11:31:47', '50', '127.0.0.1'), ('27', 'Usuário Autenticado', '2020-01-22T11:24:37', '50', '127.0.0.1'), ('28', 'Usuário Autenticado', '2020-01-22T12:18:15', '69', '127.0.0.1'), ('29', 'Usuário Autenticado', '2020-01-22T12:35:18', '70', '127.0.0.1'), ('30', 'Usuário Autenticado', '2020-01-22T13:54:00', '69', '127.0.0.1'), ('31', 'Usuário Autenticado', '2020-01-22T23:54:27', '69', '127.0.0.1'), ('32', 'Usuário Autenticado', '2020-01-23T09:06:43', '69', '127.0.0.1'), ('33', 'Usuário Autenticado', '2020-01-23T11:51:46', '83', '127.0.0.1'), ('34', 'Usuário Autenticado', '2020-01-23T11:52:28', '83', '127.0.0.1');
UNLOCK TABLES;

DROP TABLE IF EXISTS tbl_newsletter;

CREATE TABLE `tbl_newsletter` (
  `CodiEmail` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiEmail`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_newsletter WRITE;
INSERT INTO tbl_newsletter (CodiEmail, Email) VALUES ('14', 'teste@teste.com'), ('15', 'teste1@teste.com'), ('16', 'teste2@teste.com'), ('19', '');
UNLOCK TABLES;

DROP TABLE IF EXISTS tbl_nivelacesso;

CREATE TABLE `tbl_nivelacesso` (
  `CodiNivelAcesso` int(11) NOT NULL AUTO_INCREMENT,
  `NivelAcesso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CodiNivelAcesso`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_nivelacesso WRITE;
INSERT INTO tbl_nivelacesso (CodiNivelAcesso, NivelAcesso) VALUES ('1', 'Administrador'), ('2', 'Usuário');
UNLOCK TABLES;

DROP TABLE IF EXISTS tbl_usuarios;

CREATE TABLE `tbl_usuarios` (
  `CodiUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodiNivelAcesso` int(10) NOT NULL DEFAULT '2',
  `Foto` varchar(155) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  PRIMARY KEY (`CodiUsuario`),
  KEY `CodiNivelAcesso_fk` (`CodiNivelAcesso`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES tbl_usuarios WRITE;
INSERT INTO tbl_usuarios (CodiUsuario, Usuario, Login, Senha, Email, CodiNivelAcesso, Foto) VALUES ('69', 'Thyago Hoffman', 'hoffman', '$2y$10$4l0SJCP4b5AvD2XkDuv/deb5mQ3H7ibQAugYX2U6BBiUmX/Ozr/iK', 'thoffman1698@gmail.com', '2', 'user-04.jpg'), ('83', 'Teste', 'Teste', '$2y$10$5TglAe3QG3rllOAllBAjxOpOZB/NlfLWpfahd7VwIvS52Ftl8X8zG', 'teste@teste.com', '2', 'user.png');
UNLOCK TABLES;

