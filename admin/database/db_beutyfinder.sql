/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - db_beautyfinder
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `simbol` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`nama_kategori`,`simbol`) values 
(1,'Busana','marker_busana.png'),
(2,'Skincare','marker_skincare.png'),
(3,'Kosmetik','marker_kosmetik.png'),
(4,'Aksesoris','marker_aksesoris.png');

/*Table structure for table `toko` */

DROP TABLE IF EXISTS `toko`;

CREATE TABLE `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `toko` */

insert  into `toko`(`id`,`nama_toko`,`id_kategori`,`alamat`,`latitude`,`longitude`) values 
(1,'Fashion Story',1,'Jl. Kaliurang No.10, Kocoran, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.763437825331106','110.37942409515381'),
(2,'Sakola Jogja',1,'Jl. Kapten Piere Tendean No.47, Wirobrajan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55252','-7.8059031871684486','110.35099536180496'),
(3,'CF Beauty',2,'Jl. Selokan Mataram, Dabag, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.770557541143634','110.404132604599'),
(4,'Mutiara Pusat Kosmetik',3,'Jl. Doktor Sutomo No.64 A, Baciro, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55211','-7.791987714781772','110.3781259059906'),
(5,'Monokrom Store Jogja',1,'Jl. Wates No.3 RW.32, Sonosewu, Ngestiharjo Kec. Kasihan Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184','-7.800537952448851','110.34163981676102'),
(6,' Al Munawaroh Collection',4,'Jalan Pandega Marta Raya No.46 46, Caturtunggal Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.755569630058111','110.37736747405083'),
(7,'Jolie Jogja Wirobrajan',1,'Jl. Kapten Piere Tendean No.29 Wirobrajan Kota Yogyakarta, Daerah Istimewa Yogyakarta 55252','-7.804610381830076','110.3513091802597'),
(8,'Elsbeauty',2,'Jl. Kaliurang No.11 Manggung, Caturtunggal Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.758862699789552','110.38132444024086'),
(9,'Mutiara Kosmetik Jakal Bawah',3,'Jl. Kaliurang Jl. Turonggosari Blk. III No.km RW.5, Manggung, Condongcatur Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.758098623725079','110.3816556930542');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
