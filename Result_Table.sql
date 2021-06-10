/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.19-MariaDB : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test`;

/*Table structure for table `results` */

DROP TABLE IF EXISTS `results`;

CREATE TABLE `results` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rollno` int(10) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `total_mark` int(10) DEFAULT NULL,
  `mark_obtain` int(10) DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `results` */

insert  into `results`(`id`,`rollno`,`subject`,`total_mark`,`mark_obtain`,`result`,`grade`) values 
(1,1200,'maths',100,63,'Pass','B'),
(2,1200,'tamil',100,69,'Pass','B'),
(3,1200,'computer',100,72,'Pass','A'),
(4,1201,'maths',100,65,'Pass','B'),
(5,1201,'tamil',100,78,'Pass','A'),
(6,1201,'computer',100,69,'Pass','B'),
(7,1202,'maths',100,61,'Pass','B');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
