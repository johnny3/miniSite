-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: sitejohn
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subCategory_id` int(11) DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `chapo` longtext COLLATE utf8_unicode_ci,
  `is_picture` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CD8737FA989D9B62` (`slug`),
  KEY `IDX_CD8737FA12469DE2` (`category_id`),
  KEY `IDX_CD8737FADB5A7180` (`subCategory_id`),
  CONSTRAINT `FK_CD8737FA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_CD8737FADB5A7180` FOREIGN KEY (`subCategory_id`) REFERENCES `subcategory` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,2,'2013-03-10 22:16:04','2014-07-25 23:51:35','article-1','article 1','<p>corps article 1</p>\r\n<p>suite corps article 1</p>','Animals-Eagle-icon-2.png',NULL,1,'',1),(2,1,'2013-03-10 22:16:04','2014-07-26 14:50:14','article-2','article 2','<p>corps article 2</p>\r\n<p>suite corps article 2</p>','Animals-Fishes-icon-2.png',NULL,1,'',1),(4,8,'2013-03-10 22:16:04','2013-03-10 22:16:04','article-4','article 4','<p>corps article 4</p><p>suite corps article 4</p>','Fruits-Persimmon-icon.png',NULL,1,'',NULL),(5,NULL,'2013-03-10 22:16:04','2013-03-10 22:16:04','article-5','article 5','<p>corps article 5</p><p>suite corps article 5</p>','Animals-Eagle-icon-2.png',1,1,'',NULL),(6,NULL,'2013-03-10 22:16:04','2013-03-10 22:16:04','article-6','article 6','<p>corps article 6</p><p>suite corps article 6</p>','Animals-Fishes-icon-2.png',1,1,'',NULL),(7,NULL,'2013-03-18 22:53:38','2013-03-18 22:53:38','article-7','article 7','<p>corps article 7</p><p>suite corps article 7</p>',NULL,2,1,'',NULL),(8,NULL,'2013-03-18 22:53:38','2013-03-18 22:53:38','article-8','article 8','<p>corps article 8</p><p>suite corps article 8</p>',NULL,2,1,'',NULL),(9,NULL,'2013-03-18 22:53:38','2013-03-18 22:53:38','article-9','article 9','<p>corps article 9</p><p>suite corps article 9</p>',NULL,1,1,'',NULL),(10,NULL,'2013-03-18 22:53:38','2013-03-18 22:53:38','article-10','article 10','<p>corps article 10</p><p>suite corps article 10</p>',NULL,1,1,'',NULL),(11,NULL,'2013-03-18 22:53:38','2013-03-18 22:53:38','article-11','article 11','<p>corps article 11</p><p>suite corps article 11</p>',NULL,1,1,'',NULL),(12,NULL,'2013-03-18 22:53:38','2013-03-18 22:53:38','article-12','article 12','<p>corps article 12</p><p>suite corps article 12</p>',NULL,1,1,'',NULL),(13,NULL,'2014-07-26 02:28:53','2014-07-26 02:28:53','article-test-films','article test films','<p>Corps du texte</p>',NULL,1,1,'<p>chap&ocirc;</p>',0),(15,2,'2013-03-10 22:16:04','2014-07-25 23:51:35','article-20','article 20','<p>corps article 2</p>\r\n<p>suite corps article 2</p>','Animals-Eagle-icon-2.png',NULL,1,'',1),(16,NULL,'2014-07-26 18:40:34','2014-07-26 18:40:34','vivre-chaque-jour-comme-s-il-etait-le-dernier','Vivre chaque jour comme s\'il était le dernier','<p>Ce concept revient r&eacute;guli&egrave;rement et je dois avouer qu\'il m\'inspire ces derniers temps.</p>\r\n<p>Vivre chaque jour comme s\'il &eacute;tait le dernier... Est-ce vraiment possible? En fait, je crois que j\'aimerais vivre chaque ann&eacute;e comme si elle &eacute;tait la derni&egrave;re de ma vie physique. Car si j\'applique le principe de vivre chaque journ&eacute;e comme si elle &eacute;tait la derni&egrave;re, alors, au final, je ferai des choses tr&egrave;s humaines mais pratiquement rien de mat&eacute;riel. Et le mat&eacute;riel fait partie de notre vie.</p>\r\n<p>J\'&eacute;crirais &agrave; mes enfants et je tournerais une vid&eacute;o pour eux. Je pense que je tournerais des vid&eacute;os pour de nombreuses personnes, car je n\'aurais pas le temps de toutes les voir. Et je leur enverrais. J\'appellerais certaines personnes pour leur dire ce que j\'ai sur le coeur.</p>\r\n<p>J\'irais me promener dans certains endroits qui ont marqu&eacute; ma vie. Un retour sur ma vie. Je relirais certains &eacute;crits que j\'ai produits.</p>\r\n<p>Je pense que je demanderais pardon aussi &agrave; de nombreuses personnes pour les avoir bless&eacute;es.</p>\r\n<p>Il serait aussi possible que je fasse une pri&egrave;re consciente (je reviendrai plus tard sur ce concept)</p>\r\n<p>Mais au final, une journ&eacute;e, ce serait si court &agrave; vivre, si je savais que c\'&eacute;tait la derni&egrave;re de mon existence sur Terre.</p>\r\n<p>Et en m&ecirc;me temps... si, demain, je me faisais renverser alors que je fais attention? Si je recevais une &eacute;chelle sur la t&ecirc;te. La mort physique peut survenir &agrave; tout moment. Ce qui m\'am&egrave;ne &agrave; approfondir le concept de \"la derni&egrave;re journ&eacute;e\".</p>\r\n<p>Et si, au final, nous vivions la derni&egrave;re heure de notre vie? La derni&egrave;re minute?</p>\r\n<p>Le temps est pr&eacute;cieux, et il nous file entre les doigts, comme s\'il s\'&eacute;coulait dans un sablier. A peine je viens d\'avoir une pens&eacute;e qu\'elle appartient au pass&eacute;.</p>\r\n<p>C\'est pourquoi il m\'apparait si important d\'employer mon temps intelligemment, &agrave; pr&eacute;sent. A faire ce que j\'aime. Mais aussi &agrave; faire ce que je n\'aime pas si cela est n&eacute;cessaire. A ne plus \"perdre mon temps\" &agrave; juger, que ce soit une situation, des gens, ou moi-m&ecirc;me. La tranquilit&eacute; d\'esprit se manisfeste dans notre existence lorsque nous cessons de r&eacute;sister, lorsque nous acceptons les situations de notre vie sans les juger. Il devient alors possible de les faire &eacute;voluer vers quelque chose qui nous correspond davantage.</p>\r\n<p>Je finirai ce post par la r&eacute;ponse que Bruce Lee a donn&eacute;e &agrave; un journaliste qui lui demandait quelles &eacute;taient ses limites: \"les limites du ciel ouvert\".</p>\r\n<p>Pour r&eacute;aliser vos r&ecirc;ves, regardez souvent en l\'air.</p>',NULL,3,1,NULL,0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_text` longtext COLLATE utf8_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `chapo` longtext COLLATE utf8_unicode_ci,
  `is_picture` tinyint(1) DEFAULT NULL,
  `contact_cat` tinyint(1) DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  `is_visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FF3A7B97989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'2013-03-10 22:13:47','2014-07-21 20:17:34','conversations-avec-dieu','Conversations Avec Dieu','neale.jpg','<p>Neale Donald Walsch, auteur de \"Conversations avec Dieu\", nous a permis de nous ouvrir &agrave; une nouvelle r&eacute;alit&eacute;. Aujourd\'hui, il publie quotidiennement des lettres que je vous livre en fran&ccedil;ais.</p>',NULL,NULL,NULL,1,NULL,1,0,NULL,1),(2,'2013-03-10 22:13:47','2013-03-10 22:13:47','bodhiyuga','Bodhiyuga','bodhiyuga.jpg','<p>Bodhiyuga, un être en quête perpétuelle d\'éveil, et a énormément apporté avant de fermer son site. Je vous livre aujourd\'hui une partie de ses lettres.</p>',NULL,NULL,NULL,3,NULL,1,0,NULL,1),(3,'2013-03-10 22:13:47','2013-03-10 22:13:47','musiques-films','Musiques & Films','Musique-Film.jpg','<p>Depuis des années, les films et la musique m\'aident à m\'ouvrir sur le monde, alors voici une sélection de ceux qui m\'ont grandement inspirés.</p>',NULL,NULL,NULL,2,NULL,1,0,NULL,1),(4,'2013-03-10 22:13:47','2014-07-26 15:24:04','spiritualite','Spiritualité','spiritualite.jpg','<p>Ma r&eacute;flexion personnelle sur la spiritualit&eacute; en r&egrave;gle g&eacute;n&eacute;rale.</p>',NULL,NULL,NULL,4,NULL,1,0,NULL,0),(5,'2013-03-10 22:13:47','2013-03-10 22:13:47','la-vie','La vie','difficultes-bonmoments.jpg','<p>Diverses réflexions sur la vie, ses obstacles comme ses joies.</p>',NULL,NULL,NULL,5,NULL,1,0,NULL,1),(6,'2013-03-10 22:13:47','2014-07-26 15:24:07','citations','Citations','citations-reflexions.jpg','<p>Citations et r&eacute;flexions de grands hommes qui ont influenc&eacute; leurs proches... et leurs moins proches...</p>',NULL,NULL,NULL,8,NULL,1,0,NULL,0),(7,'2013-03-10 22:13:47','2014-07-26 15:24:13','histoires','Histoires','histoires.jpg','<p>Histoires spirituelles, lues sur internet, que je trouve inspirantes.</p>',NULL,NULL,NULL,6,NULL,1,0,NULL,0),(8,'2013-03-10 22:13:47','2014-07-26 15:26:42','lectures','Lectures','lectures.jpg','<p>Les livres que j\'ai lus ces derni&egrave;res ann&eacute;es, ces derniers mois ou ces derni&egrave;res semaines, qui ont influenc&eacute; ma vie.</p>',NULL,NULL,NULL,7,NULL,1,0,NULL,1),(9,'2013-03-10 22:13:47','2014-07-26 15:24:26','ma-vie','Ma vie','ma-vie.gif','<p>Divers &eacute;v&eacute;nements de ma vie, la plupart spirituels.</p>',NULL,NULL,NULL,9,NULL,1,0,NULL,0),(10,'2014-07-26 14:59:05','2014-07-26 15:44:48','contact','Contact',NULL,NULL,NULL,NULL,NULL,10,NULL,0,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra, tellus sit amet congue vulputate, nisi erat iaculis nibh, vitae feugiat sapien ante eget mauris.</p>\r\n<p>Cras elit nisl, rhoncus nec iaculis ultricies, feugiat eget sapien. Pellentesque ac felis tellus. Aenean sollicitudin imperdiet arcu, vitae dignissim est posuere id. Duis placerat justo eu nunc interdum ultrices.</p>\r\n<p>Our Address</p>\r\n<p>586 Main Ave, Building 42<br />Main City, Country 12345-6789</p>\r\n<p>T: (555) 123 - 4567<br />F: (555) 523 - 4567</p>\r\n<p>W:<a href=\"file://sauvegarde2/Public/PROJETS%20INFORMATIQUES/SiteJohnRefonte/contacts.html#\">http://www.domain.com<br /></a>E:&nbsp;<a href=\"file://sauvegarde2/Public/PROJETS%20INFORMATIQUES/SiteJohnRefonte/contacts.html#\">email@domain.com</a></p>',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'admin','admin','positive.energie.bouddha@gmail.com','positive.energie.bouddha@gmail.com',1,'job6nbwepjc4scgk8go4oo8o8444o0k','IwlYIAHu5wophOGyGobgflynqwWV15oFFJ/75Ty9wruhRAyo7i0+TlSolN+g2GHhZ+Nzgunnu7ja9sbBvi5GJQ==','2014-07-26 14:46:26',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `center_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sentence_footer1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sentence_footer2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info`
--

LOCK TABLES `info` WRITE;
/*!40000 ALTER TABLE `info` DISABLE KEYS */;
INSERT INTO `info` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_email`
--

DROP TABLE IF EXISTS `lexik_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spool` tinyint(1) NOT NULL,
  `headers` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D781892EAEA34913` (`reference`),
  KEY `IDX_D781892E8C22AA1A` (`layout_id`),
  CONSTRAINT `FK_D781892E8C22AA1A` FOREIGN KEY (`layout_id`) REFERENCES `lexik_layout` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_email`
--

LOCK TABLES `lexik_email` WRITE;
/*!40000 ALTER TABLE `lexik_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `lexik_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_email_translation`
--

DROP TABLE IF EXISTS `lexik_email_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_email_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) DEFAULT NULL,
  `lang` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `body_text` longtext COLLATE utf8_unicode_ci,
  `from_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6ED9BAA2A832C1C9` (`email_id`),
  CONSTRAINT `FK_6ED9BAA2A832C1C9` FOREIGN KEY (`email_id`) REFERENCES `lexik_email` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_email_translation`
--

LOCK TABLES `lexik_email_translation` WRITE;
/*!40000 ALTER TABLE `lexik_email_translation` DISABLE KEYS */;
/*!40000 ALTER TABLE `lexik_email_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_layout`
--

DROP TABLE IF EXISTS `lexik_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B1B4C0FDAEA34913` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_layout`
--

LOCK TABLES `lexik_layout` WRITE;
/*!40000 ALTER TABLE `lexik_layout` DISABLE KEYS */;
INSERT INTO `lexik_layout` VALUES (1,'template-reference','Template de base des mails');
/*!40000 ALTER TABLE `lexik_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_layout_translation`
--

DROP TABLE IF EXISTS `lexik_layout_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_layout_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) DEFAULT NULL,
  `lang` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_495DCB868C22AA1A` (`layout_id`),
  CONSTRAINT `FK_495DCB868C22AA1A` FOREIGN KEY (`layout_id`) REFERENCES `lexik_layout` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_layout_translation`
--

LOCK TABLES `lexik_layout_translation` WRITE;
/*!40000 ALTER TABLE `lexik_layout_translation` DISABLE KEYS */;
INSERT INTO `lexik_layout_translation` VALUES (1,1,'fr','{% block content %}{% endblock %}','2014-07-26 01:15:30','2014-07-26 01:15:30');
/*!40000 ALTER TABLE `lexik_layout_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscriber`
--

DROP TABLE IF EXISTS `newsletter_subscriber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscriber`
--

LOCK TABLES `newsletter_subscriber` WRITE;
/*!40000 ALTER TABLE `newsletter_subscriber` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_subscriber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscriber_test`
--

DROP TABLE IF EXISTS `newsletter_subscriber_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscriber_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscriber_test`
--

LOCK TABLES `newsletter_subscriber_test` WRITE;
/*!40000 ALTER TABLE `newsletter_subscriber_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_subscriber_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_text` longtext COLLATE utf8_unicode_ci,
  `metaTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metaDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `is_picture` tinyint(1) DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_723649C9989D9B62` (`slug`),
  KEY `IDX_723649C912469DE2` (`category_id`),
  CONSTRAINT `FK_723649C912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,3,'2013-03-10 22:13:47','2014-07-21 21:57:37','films','Films','films.jpg',NULL,NULL,NULL,2,1,1,NULL),(2,3,'2013-03-10 22:13:47','2014-07-21 21:41:34','musiques','Musiques','musique.jpg',NULL,NULL,NULL,1,1,1,NULL),(3,5,'2014-07-26 18:06:03','2014-07-26 18:42:11','apprecier-chaque-moment','Apprécier chaque moment','675332292_a06a028032_m.jpg',NULL,NULL,NULL,1,1,1,NULL),(4,5,'2014-07-26 18:06:36','2014-07-26 19:55:53','les-difficultes-rencontrees','Les difficultés rencontrées','8353af577813382a1a325822224e82a8.jpg',NULL,NULL,NULL,2,0,1,NULL);
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-26 20:32:21
