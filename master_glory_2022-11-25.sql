# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.21-MariaDB)
# Database: master_glory
# Generation Time: 2022-11-25 02:13:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tb_pengajuan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_pengajuan`;

CREATE TABLE `tb_pengajuan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nomor` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nik` int(11) DEFAULT NULL,
  `bagian` varchar(100) DEFAULT NULL,
  `tgl_pengajuan` varchar(100) DEFAULT NULL,
  `flag_keperluan` int(2) DEFAULT NULL COMMENT '1: sakit, 2: urusan keluarga: 9: lain-lain',
  `lain_lain` varchar(200) DEFAULT NULL,
  `flag_keterangan` int(2) DEFAULT NULL COMMENT '1: kembali, 0: tidak kembali',
  `flag_ttd` int(2) DEFAULT NULL COMMENT '1: otomatis, 0: manual',
  `ttd_ybs` longtext DEFAULT NULL,
  `ttd_manager` longtext DEFAULT NULL,
  `ttd_dept_personalia` longtext DEFAULT NULL,
  `status` int(2) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tb_pengajuan` WRITE;
/*!40000 ALTER TABLE `tb_pengajuan` DISABLE KEYS */;

INSERT INTO `tb_pengajuan` (`id`, `nomor`, `nama`, `nik`, `bagian`, `tgl_pengajuan`, `flag_keperluan`, `lain_lain`, `flag_keterangan`, `flag_ttd`, `ttd_ybs`, `ttd_manager`, `ttd_dept_personalia`, `status`)
VALUES
	(27,'162211/GLORY/11/2022','Nurul Muttaqin',2147483647,'Aplikasi','2022-11-14 16:22:18',1,'',1,0,NULL,'','',1);

/*!40000 ALTER TABLE `tb_pengajuan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tb_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;

INSERT INTO `tb_user` (`id`, `username`, `password`, `level`, `keterangan`, `status`)
VALUES
	(1,'admin','admin',1,'Administrator',1),
	(2,'user','user',2,'User Terbatas',1);

/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
