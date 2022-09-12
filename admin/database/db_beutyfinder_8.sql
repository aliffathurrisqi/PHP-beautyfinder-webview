/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - db_beautyfinder
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
  `img` text DEFAULT NULL,
  `alamat` text NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `verifikasi` enum('Ya','Tidak') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `toko` */

insert  into `toko`(`id`,`nama_toko`,`id_kategori`,`img`,`alamat`,`latitude`,`longitude`,`username`,`verifikasi`) values 
(1,'Fashion Story',1,'fashionstory.jpg','Jl. Kaliurang No.10, Kocoran, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.763437825331106','110.37942409515381','admin','Ya'),
(2,'Sakola Jogja',1,'sakolajogja.jpg','Jl. Kapten Piere Tendean No.47, Wirobrajan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55252','-7.8059031871684486','110.35099536180496','admin','Ya'),
(3,'CF Beauty',2,'default.png','Jl. Selokan Mataram, Dabag, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.770557541143634','110.404132604599','admin','Ya'),
(4,'Mutiara Pusat Kosmetik',3,'default.png','Jl. Doktor Sutomo No.64 A, Baciro, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55211','-7.791987714781772','110.3781259059906','admin','Ya'),
(5,'Monokrom Store Jogja',1,'default.png','Jl. Wates No.3 RW.32, Sonosewu, Ngestiharjo Kec. Kasihan Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184','-7.800537952448851','110.34163981676102','admin','Ya'),
(6,'Al Munawaroh Collection',4,'default.png','Jalan Pandega Marta Raya No.46 46, Caturtunggal Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.755569630058111','110.37736747405083','admin','Ya'),
(7,'Jolie Jogja Wirobrajan',1,'jolie.jpg','Jl. Kapten Piere Tendean No.29 Wirobrajan Kota Yogyakarta, Daerah Istimewa Yogyakarta 55252','-7.804610381830076','110.3513091802597','admin','Ya'),
(8,'Elsbeauty',2,'default.png','Jl. Kaliurang No.11 Manggung, Caturtunggal Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.758862699789552','110.38132444024086','admin','Ya'),
(9,'Mutiara Kosmetik Jakal Bawah',3,'default.png','Jl. Kaliurang Jl. Turonggosari Blk. III No.km RW.5, Manggung, Condongcatur Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.758098623725079','110.3816556930542','admin','Ya'),
(10,'Mels Jogja Beauty',3,'default.png','785X+VXC Kranggahan I, Trihanggo Kec. Gamping Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291','-7.740315191992772','110.34987688064575','admin','Ya'),
(11,'Nadiraa Hijab',4,'default.png','Jl. Selokan Mataram No.451 Pringwulung, Condongcatur Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.768038148224359','110.3984785079956','admin','Ya'),
(12,'Sabrina Softlens',4,'default.png','Jl. Wahid Hasyim No.106 Dabag, Condongcatur Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283','-7.769919721580338','110.4018634557724','admin','Ya'),
(13,'Jogja Softlens',4,'default.png','Jl. Babarsari No.111 Kledokan, Caturtunggal Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.773746624425123','110.40951311588287','admin','Ya'),
(14,'Jelita Cosmetic Jakal',3,'default.png','Jalan Kaliurang KM.5 CT III No. 6 Kocoran, Caturtunggal Kec. Depok Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.76212229912559','110.38026094436646','admin','Ya'),
(15,'Fashion Santri \"Inayah Store\"',1,'default.png','PP Inayatullah, Jl. Monjali No.20 RT 1/38, Nandan, Sariharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581','-7.752921501330173','110.36991512255231','admin','Ya'),
(17,'D-Fashion Boutique',1,'default.png','Jl. Monumen Jogja Kembali No.71B, Gemangan, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55284','-7.757168188545748','110.3698879980173','admin','Ya'),
(18,'MSGLOW Jogja 20',1,'default.png','Jl. Tegal Melati No.13Jombor Lor, Sinduadi, Mlati, Sleman Regency, Special Region of Yogyakarta 55284','-7.745548974135803','110.36398127675056','admin','Ya'),
(21,'Jogja Art Fashion',1,'default.png','Jl. Suryatmajan No.36, Ngupasan, Kec. Gondomanan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55122','-7.796704672989614','110.3680418854315','admin','Ya'),
(22,'Kebul Pusat Grosir Clothing Jogja',1,'default.png','Prenggan, Kec. Kotagede, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55161','-7.822889985276855','110.3948038816452','admin','Ya'),
(23,'Dynasty Fashion',1,'default.png','Jl. A.M. Sangaji No.35, Cokrodiningratan, Kec. Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55233','-7.78040641519143','110.36719858646393','admin','Ya'),
(24,'Cotton On Jogja',1,'default.png','Plaza Ambarrukmo, Jl. Laksda Adisucipto No.13, Ambarukmo, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281','-7.781990232343787','110.40112373708361','admin','Ya'),
(25,'Karita',1,'default.png','Jl. C. Simanjuntak No.73, Terban, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55223','-7.778891627698488','110.37311553955078','khnisa30','Ya'),
(26,'Ruby Clothes',1,'default.png','Jl. Wates No.80 Sonosewu, Ngestiharjo,Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55182','-7.800491893304881','110.34353842970887','admin','Ya'),
(27,'GAIA FASHION',1,'default.png','Jl. Doktor Sutomo No.57 Bausasran, Kec. Danurejan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55211','-7.793401472426067','110.37802934646606','admin','Ya'),
(28,'Fashion Story Taman Siswa',1,'default.png','Jl. Taman Siswa No.48A Wirogunan, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55151','-7.806794728910724','110.37748217582703','admin','Ya'),
(29,'Toko Baju Bangkok Miss Classy',1,'default.png','Jl. Taman Siswa No.59-61, Wirogunan, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55151','-7.808132218629474','110.37752719216284','admin','Ya'),
(30,'CRSL Store',1,'default.png','Jl. Flamboyan No.37, Karang Gayam, Caturtunggal, Depok, Sleman Regency, Special Region of Yogyakarta 55283','-7.766096105867837','110.3899846225977','tiaraanisa','Ya'),
(31,'Jogokaryan',4,'default.png','Jl. Jogokaryan No.36, Mantrijeron, Kec. Mantrijeron , Kota Yogyakarta, Daerah Istimewa Yogyakarta 55143','-7.823928967618225','110.36418914794922','tiaraanisa','Tidak');

/*Table structure for table `ulasan` */

DROP TABLE IF EXISTS `ulasan`;

CREATE TABLE `ulasan` (
  `id` varchar(100) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ulasan` text DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `ulasan` */

insert  into `ulasan`(`id`,`id_toko`,`rating`,`username`,`ulasan`,`waktu`) values 
('11khnisa30',11,4,'khnisa30','Tempatnya kecil, desak-desakan antar pembeli','2022-04-12 15:27:22'),
('1imroatus',1,4,'imroatus','Tempatnya bagus tapi sayang ada beberapa pakaian yang tidak lengkap','2022-04-09 23:05:20'),
('1khnisa30',1,5,'khnisa30','Langganan beli baju disini kadang banyak diskon','2022-04-09 23:00:30'),
('1tiaraanisa',1,4,'tiaraanisa',NULL,'2022-04-09 23:00:34'),
('24khnisa30',24,2,'khnisa30','','2022-04-12 16:36:34'),
('2khnisa30',2,5,'khnisa30','','2022-04-09 23:37:50'),
('3khnisa30',3,2,'khnisa30','Produknya gk lengkap tidak sesuai ekspetasi','2022-04-12 15:28:30'),
('3tiaraanisa',3,3,'tiaraanisa','Tokonya kecil, produk lumayan lengkap','2022-04-12 15:29:51'),
('4khnisa30',4,5,'khnisa30','Produk lengkap dari berbagai merek','2022-04-12 15:24:59'),
('5khnisa30',5,4,'khnisa30','Harga produk terjangkau, tapi tempatnya agak kecil jadi sering desak-desakan','2022-04-12 15:26:37'),
('6tiaraanisa',6,5,'tiaraanisa','Menjual berbagai pernak pernik, mulai dari kalung, pita, jepitan rambut bahkan ad hijab juga','2022-04-12 15:30:54'),
('9khnisa30',9,3,'khnisa30','Produk nya gak selengkap yang ada di lempuyangan','2022-04-09 23:32:49'),
('9tiaraanisa',9,5,'tiaraanisa','Aneka produk ada disini...','2022-04-12 15:33:27');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `img` text DEFAULT NULL,
  `akses` enum('Admin','User') DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`username`,`password`,`nama_lengkap`,`img`,`akses`) values 
('admin','nisanisa30','Khoirun Nisa',NULL,'Admin'),
('imroatus','123','imroatus',NULL,'User'),
('khnisa30','123','Khoirun Nisa','khnisa3020220420030605.jpg','User'),
('tiaraanisa','123','Tiara Anisa Putri','tiaraanisa20220420031219.jpg','User');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
