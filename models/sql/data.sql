# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Base de datos: rdy4racing
# Tiempo de Generación: 2013-09-15 10:16:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla driver
# ------------------------------------------------------------



# Volcado de tabla game
# ------------------------------------------------------------



# Volcado de tabla gamemod
# ------------------------------------------------------------



# Volcado de tabla session
# ------------------------------------------------------------



# Volcado de tabla session_state
# ------------------------------------------------------------

LOCK TABLES `session_state` WRITE;
/*!40000 ALTER TABLE `session_state` DISABLE KEYS */;

INSERT INTO `session_state` (`sstate_id`, `sstate_constant`, `sstate_name`, `sstate_description`)
VALUES
	(1,'SCHEDULED','Scheduled','Session is scheduled'),
	(2,'CLOSED','Closed','Session closed, no more drivers may join'),
	(3,'OPEN','Open','Session is open, drivers may join at any time'),
	(4,'RACING','Racing','Session is closed, drivers have started the race'),
	(5,'FINISHED','Finished','Session has ended, results pending'),
	(6,'COMPLETED','Completed','Session has ended, results done');

/*!40000 ALTER TABLE `session_state` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla session_type
# ------------------------------------------------------------

LOCK TABLES `session_type` WRITE;
/*!40000 ALTER TABLE `session_type` DISABLE KEYS */;

INSERT INTO `session_type` (`stype_id`, `stype_constant`, `stype_name`, `stype_description`)
VALUES
	(1,'PRACTICE','Practice','Practice session'),
	(2,'RACE','Race','Race session');

/*!40000 ALTER TABLE `session_type` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla user
# ------------------------------------------------------------



# Volcado de tabla user_game
# ------------------------------------------------------------




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
