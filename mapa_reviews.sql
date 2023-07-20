/*
SQLyog Trial v13.1.9 (64 bit)
MySQL - 5.7.40-log : Database - mapa_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mapa_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mapa_db`;

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review` text,
  `ratings` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `isposted` tinyint(1) DEFAULT '0',
  `dtposted` datetime DEFAULT NULL,
  `isreviewed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `reviews` */

insert  into `reviews`(`id`,`review`,`ratings`,`tenant_id`,`list_id`,`uid`,`isposted`,`dtposted`,`isreviewed`) values 
(2,'dfsdfsd',5,3,38,2,1,'2022-12-11 20:06:07',0),
(3,'sample 101',4,3,38,2,1,'2022-12-11 20:28:29',0),
(4,'hello world',5,3,38,2,1,'2022-12-11 23:50:50',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
