# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.19)
# Base de Dados: artigos
# Tempo de Geração: 2017-11-04 18:54:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela article_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_categories`;

CREATE TABLE `article_categories` (
  `article_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  KEY `article_categories_category` (`category_id`),
  CONSTRAINT `article_categories_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `article_categories` WRITE;
/*!40000 ALTER TABLE `article_categories` DISABLE KEYS */;

INSERT INTO `article_categories` (`article_id`, `category_id`)
VALUES
	(10,1),
	(10,3),
	(11,2),
	(12,1),
	(12,2),
	(12,3),
	(13,1),
	(13,3);

/*!40000 ALTER TABLE `article_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela article_key_words
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_key_words`;

CREATE TABLE `article_key_words` (
  `article_id` int(11) unsigned NOT NULL,
  `key_word_id` int(11) unsigned NOT NULL,
  KEY `article_key_word_key_word` (`key_word_id`),
  CONSTRAINT `article_key_word_key_word` FOREIGN KEY (`key_word_id`) REFERENCES `key_words` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `article_key_words` WRITE;
/*!40000 ALTER TABLE `article_key_words` DISABLE KEYS */;

INSERT INTO `article_key_words` (`article_id`, `key_word_id`)
VALUES
	(10,1),
	(11,1),
	(11,2),
	(11,3),
	(12,1),
	(12,2),
	(12,3),
	(13,2);

/*!40000 ALTER TABLE `article_key_words` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `summary` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_user` (`user_id`),
  CONSTRAINT `article_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;

INSERT INTO `articles` (`id`, `title`, `slug`, `summary`, `content`, `active`, `created`, `modified`, `user_id`)
VALUES
	(3,'teste','',NULL,'asdfasdfasdf',0,'2017-10-26 23:35:59','2017-10-26 23:35:59',1),
	(4,'Teste 1','','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet purus nisi. Etiam eros nisl, eleifend vel dignissim fermentum, eleifend non lacus. Aliquam eget neque enim. Nullam mollis augue sit amet nisi imperdiet laoreet. Cras mollis posuere te','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet purus nisi. Etiam eros nisl, eleifend vel dignissim fermentum, eleifend non lacus. Aliquam eget neque enim. Nullam mollis augue sit amet nisi imperdiet laoreet. Cras mollis posuere tempus. Etiam eleifend turpis elit, sed dictum nulla facilisis ac. Ut convallis dictum elementum. Morbi sed elit id orci rutrum aliquet eget vitae mi. Aliquam interdum ac libero nec feugiat.\r\n\r\nQuisque placerat, neque eu sagittis vestibulum, nunc odio congue dui, in rhoncus ex lacus quis est. Curabitur dictum auctor convallis. Mauris elit turpis, rhoncus nec porta quis, feugiat at nulla. Sed eu feugiat lacus. Nunc ornare odio et feugiat vestibulum. Suspendisse sapien ligula, ultricies sed vestibulum eu, pretium interdum libero. Duis vehicula metus at augue ultrices facilisis. Duis sagittis neque quis erat placerat, in fermentum elit iaculis. In rutrum auctor ex, ac porta velit blandit iaculis. Nulla id congue lorem, ut imperdiet quam. Nullam eu ipsum auctor, feugiat nulla at, vehicula neque. Vestibulum ullamcorper, libero sed tempor accumsan, augue erat condimentum mauris, id sodales tellus lectus eget lorem. Aliquam et dui est. Integer dignissim mauris consectetur orci vestibulum, finibus sollicitudin sapien placerat. Nam ut ligula ex.\r\n\r\nSed mollis nibh erat, et facilisis neque viverra vitae. Curabitur facilisis arcu vitae dolor luctus facilisis. Vestibulum vitae neque quis lorem consequat auctor. Aenean sed bibendum ante, in sagittis risus. Vivamus sit amet lacinia sapien. Mauris euismod ex in elit mattis vulputate. Proin posuere varius rutrum.\r\n\r\nPraesent velit quam, viverra nec tempor a, ultrices eget arcu. Nunc venenatis gravida est a efficitur. Nam vulputate felis in volutpat rutrum. Donec nec leo vitae sem iaculis posuere ac condimentum dui. Nam faucibus semper lobortis. Ut vel sapien sodales tellus porttitor venenatis. Pellentesque eu diam pellentesque, auctor justo sed, tincidunt lacus. Nunc sodales diam vel ligula consequat finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer non mi ut augue finibus laoreet.\r\n\r\nPhasellus sodales non felis eget congue. Morbi semper pulvinar dignissim. Pellentesque arcu nisl, ultrices vel finibus at, hendrerit vel ipsum. Etiam at dolor at elit rutrum bibendum eget non risus. Nulla in tortor lacus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam volutpat libero ex, vel fringilla augue vestibulum vitae. Phasellus euismod ultrices nisl eget eleifend. Phasellus elementum, nibh sit amet finibus volutpat, sem elit vulputate libero, vel mollis mauris purus quis ante.',0,'2017-10-26 23:42:41','2017-10-26 23:42:41',1),
	(5,'teste123','','teste','teste12312312',0,'2017-10-29 20:39:50','2017-10-29 20:39:50',3),
	(7,'Teste 1','','teste','teste',0,'2017-10-29 23:52:11','2017-10-29 23:52:11',3),
	(10,'Artigo 2','','Artigo 2','asdasd',0,'2017-10-29 23:56:21','2017-10-29 23:56:21',3),
	(11,'teres','','teste','teste',0,'2017-10-30 21:06:00','2017-10-30 21:13:47',3),
	(12,'editor','','editor','<p>safasdfasdf</p>\r\n<p>asdfasdfsad</p>\r\n<p>asdfasdfasdfasdfasdfasdfasdf</p>\r\n<p>zxcvzxcvzxcvzxv</p>\r\n<p>asdfasdfasfasdfasdfasdfasdfasdfsdf asdfa sdf asdf</p>\r\n<p style=\"padding-left: 60px;\">asdfasdfasdfasdfasdf</p>\r\n<p style=\"padding-left: 60px;\">asdfasdfasdf</p>\r\n<p><strong>asdfasfasf</strong></p>\r\n<blockquote>\r\n<p><em><strong>asdfasdfasdfasdf</strong></em></p>\r\n</blockquote>',0,'2017-10-30 21:23:20','2017-10-30 21:23:20',3),
	(13,'teste1312','','tesafasfasdf','<p>asdfasdfa sds fas f</p>\r\n<p>a sdfsd fggsd</p>\r\n<p>sd fgsdfg</p>',0,'2017-10-31 23:50:45','2017-10-31 23:50:45',3);

/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `created`, `modified`)
VALUES
	(1,'cate1',NULL,NULL),
	(2,'cate2',NULL,NULL),
	(3,'cate3',NULL,NULL);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `article_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_user` (`user_id`),
  KEY `comment_article` (`article_id`),
  CONSTRAINT `comment_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `comment`, `created`, `modified`, `user_id`, `article_id`)
VALUES
	(1,'teste','2017-10-29 21:24:38','2017-10-29 21:24:38',3,3),
	(2,'hahahahah','2017-10-29 23:58:51','2017-10-29 23:58:51',3,5),
	(3,'asfdsfsadf','2017-10-29 23:59:00','2017-10-29 23:59:00',3,3),
	(4,'hsgadhagsd\r\n','2017-10-31 23:58:13','2017-10-31 23:58:13',3,13);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela key_words
# ------------------------------------------------------------

DROP TABLE IF EXISTS `key_words`;

CREATE TABLE `key_words` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `key_words` WRITE;
/*!40000 ALTER TABLE `key_words` DISABLE KEYS */;

INSERT INTO `key_words` (`id`, `name`, `created`, `modified`)
VALUES
	(1,'keywor1',NULL,NULL),
	(2,'keywor2',NULL,NULL),
	(3,'keywor3',NULL,NULL);

/*!40000 ALTER TABLE `key_words` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela user_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_categories`;

CREATE TABLE `user_categories` (
  `user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  KEY `user_categories_category` (`category_id`),
  CONSTRAINT `user_categories_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_categories` WRITE;
/*!40000 ALTER TABLE `user_categories` DISABLE KEYS */;

INSERT INTO `user_categories` (`user_id`, `category_id`)
VALUES
	(5,1),
	(5,3),
	(3,2),
	(3,3),
	(3,1);

/*!40000 ALTER TABLE `user_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela user_key_words
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_key_words`;

CREATE TABLE `user_key_words` (
  `user_id` int(11) unsigned NOT NULL,
  `key_word_id` int(11) unsigned NOT NULL,
  KEY `user_key_words_key_word` (`key_word_id`),
  CONSTRAINT `user_key_words_key_word` FOREIGN KEY (`key_word_id`) REFERENCES `key_words` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_key_words` WRITE;
/*!40000 ALTER TABLE `user_key_words` DISABLE KEYS */;

INSERT INTO `user_key_words` (`user_id`, `key_word_id`)
VALUES
	(5,1),
	(3,2),
	(3,1),
	(3,3);

/*!40000 ALTER TABLE `user_key_words` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `description`, `facebook`, `instagram`, `linkedin`, `twitter`, `created`, `modified`)
VALUES
	(1,'teste','teste@teste.com','teste','teste',NULL,NULL,NULL,NULL,NULL,NULL),
	(2,'henrique','henrique@hentique.com','henrique',NULL,NULL,NULL,NULL,NULL,'2017-10-29 15:32:26','2017-10-29 15:32:26'),
	(3,'teste123','teste123@teste.com','7562d9637353175ccfca21ff651adc4cdc768c59','<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed tincidunt nisl. Integer at velit laoreet, tincidunt lacus nec, rutrum ex. Ut efficitur risus vitae fermentum euismod. Vestibulum sagittis, nibh non tincidunt accumsan, nibh ipsum placerat neque, sit amet commodo eros magna quis lectus. Cras consectetur eros vitae est convallis, at rutrum diam blandit. Donec facilisis varius libero eu lobortis. Nullam sed ultrices metus. Praesent tristique augue at massa condimentum tempus. Quisque convallis imperdiet lobortis. Etiam egestas malesuada tempor. Sed at ipsum rutrum lacus condimentum finibus eget cursus metus. Nullam iaculis lacinia ex eget euismod. Morbi ut auctor sapien. Morbi aliquet vulputate neque id interdum.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">In tincidunt vestibulum est, et varius nunc lobortis et. Sed ut justo libero. Vivamus quis lorem interdum, volutpat diam in, tempus eros. Proin sit amet neque efficitur, consectetur velit fringilla, ultrices urna. Vestibulum commodo semper velit at consequat. Ut vehicula accumsan dolor eu maximus. Fusce feugiat magna id turpis faucibus, at iaculis dui euismod. Sed sed eros vestibulum, laoreet ligula non, venenatis sapien. Nullam sed ante dolor. Donec lacinia tellus turpis, sit amet tincidunt nunc suscipit vitae.</p>','','','','','2017-10-29 15:46:46','2017-10-31 23:39:04'),
	(5,'teste123','teste123@teste.com','','','','','','','2017-10-30 00:01:28','2017-10-30 00:01:28');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela vieweds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vieweds`;

CREATE TABLE `vieweds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `article_id` int(11) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `views_user` (`user_id`),
  KEY `views_article` (`article_id`),
  CONSTRAINT `views_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `views_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `vieweds` WRITE;
/*!40000 ALTER TABLE `vieweds` DISABLE KEYS */;

INSERT INTO `vieweds` (`id`, `user_id`, `article_id`, `created`, `modified`)
VALUES
	(1,3,11,'2017-10-31 22:18:45','2017-10-31 22:32:07'),
	(2,3,12,'2017-10-31 22:32:29','2017-10-31 22:32:29'),
	(3,3,3,'2017-10-31 22:35:00','2017-10-31 22:35:00'),
	(4,3,5,'2017-10-31 23:45:04','2017-10-31 23:45:04'),
	(5,3,10,'2017-10-31 23:45:18','2017-10-31 23:45:18'),
	(6,3,4,'2017-10-31 23:45:23','2017-10-31 23:45:23'),
	(7,3,13,'2017-10-31 23:58:02','2017-10-31 23:58:02');

/*!40000 ALTER TABLE `vieweds` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
