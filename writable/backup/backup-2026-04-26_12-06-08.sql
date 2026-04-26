-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: perpus
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `anggota_ibfk_1` (`user_id`),
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES (7,3,'A001','Bandung','0811111111','2026-04-22'),(9,5,'A003','Surabaya','0811111113','2026-04-22'),(12,8,'A006','Semarang','0811111116','2026-04-22'),(21,19,NULL,NULL,NULL,'2026-04-26');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(50) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 0,
  `tersedia` int(11) DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `buku_ibfk_1` (`id_kategori`),
  KEY `buku_ibfk_2` (`id_penulis`),
  KEY `buku_ibfk_3` (`id_penerbit`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE,
  CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE CASCADE,
  CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (24,'9786349651950','Rumah Untuk Alie',20,20,8,2026,10,0,'Alie Ishala Samantha, 16 tahun, tak pernah mengira hidupnya akan sepelik ini.\r\n\r\nSemula, dia hidup dalam keluarga yang penuh cinta, dan rumah yang selalu memeluknya. Namun, sejak dituduh menjadi penyebab meninggalnya Bunda Gianla lima tahun lalu, segalanya berubah dalam semalam. Sebutan \'pembunuh pun disematkan dalam dirinya, dan dia terus mendapatkan penolakan dan rasa sakit dari ayah dan keempat kakaknya: Sadipta, Rendra, Samuel, dan Natta.\r\n','1776841214_a7afc91f66776e4a90d9.avif',NULL),(43,'9786022207634','Malioboro at Midnight',20,21,13,2025,10,0,'Tengah malam bagi kebanyakan orang adalah waktu terbaik untuk beristirahat dan tidur lelap. Tapi untuk Serana Nighita, itu adalah waktu untuk menangisi hidup dan meratapi hubungannya dengan sang penyanyi terkenal, Jan Ichard. Popularitas membawa lelaki itu jauh darinya, Ichard di Jakarta, meninggalkan Sera di Jogja.\r\n\r\nBagi Sera, tengah malam selalu menakutkan.','1776882724_30deabe2e10991db3615.avif',NULL),(44,'9786235157351','The Art of Dark Psychology',16,26,5,2026,10,4,'The Art of Dark Psychology : Membongkar Sisi Gelap Psikologi Manusia yang Jarang Diperbincangkan\r\n\r\n· Apa Anda merasa mudah dikendalikan oleh orang lain dalam situasi tertentu?\r\n· Apa Anda belum mampu melawan manipulasi dari orang lain yang dapat merugikan diri Anda?\r\n· Apa Anda ingin memahami dark psychology secara mendalam?\r\n\r\nBuku The Art of Dark Psychology ini mengajak Anda memahami sisi gelap psikologi yang kerap hadir tanpa disadari dalam kehidupan sehari-hari. Buku ini membongkar bagaimana manipulasi bekerja secara halus, melalui gaslighting, guilt-tripping, silent treatment, hingga love bombing—yang perlahan menggerus kepercayaan diri, emosi, dan jati diri manusia. Dark psychology bukan sekadar konsep yang kompleks, melainkan praktik nyata yang sering tersembunyi di balik sikap manis dan hubungan yang tampak normal antara sesama manusia.','1776959958_ef9b042f794e1fa3fe60.avif',NULL),(45,'9786231049131','Brandal Bandung',20,23,5,2024,10,3,'Harugo Nubagja, panglima geng motor The Bandrex yang berasal dari Bandung, dia dikenal sebagai sosok tangguh dan bijaksana. Namun, di balik itu, Harugo menyimpan banyak luka juga penderitaan yang mendalam.\r\n\r\nMiseila Viona hadir menjadi obat sekaligus sumber kebahagiaannya. Sayangnya, hubungan manis mereka berakhir tragis, hancur akibat badai yang terus datang secara bertubi-tubi.','1777101313_5c2d50cbb033b0788bb0.avif',NULL),(46,'9786022204336','Azzamine',20,24,13,2022,10,4,'Sinopsis Buku\r\n“Kalau saya sudah sayang sama kamu, angka-angka yang besar nggak akan bisa menggambarkan rasa sayang saya ke kamu, Jasmine.”\r\n“Terus digambarin pake apa?”\r\n“Sepertiga.”\r\n“Cuma sepertiga?”\r\n“Iya, saya akan selalu langitkan namamu di sepertiga malam saya, Jasmine.”','1777111878_271561a4ac8d60126b6e.avif',NULL),(47,'9786239987879','Hujan',20,1,5,2022,10,8,'Novel Hujan merupakan novel yang mengisahkan kisah cinta serta perjuangan hidup Lail. Saat usianya baru menginjak 13 tahun, Lail menjadi seorang yatim piatu akibat ayah dan ibu Lail yang terkena letusan Gunung Api Purba dan gempa yang membuat kota tempat mereka tinggal hancur.\r\n\r\n','1777134733_4260a9a05cb03d1f2a05.avif',NULL),(48,'9786024818722','Laut Bercerita',20,22,5,2022,10,8,'Buku Laut Bercerita menceritakan terkait perilaku kekejaman dan kebengisan yang dirasakan oleh kelompok aktivis mahasiswa di masa Orde Baru. Tidak hanya itu, novel ini pun merenungkan kembali akan hilangnya tiga belas aktivis, bahkan sampai saat ini belum juga ada yang mendapatkan petunjuknya. Buku ini juga bertutur tentang kisah keluarga yang kehilangan, sekumpulan sahabat yang merasakan kekosongan di dada, sekelompok orang yang gemar menyiksa dan lancar berkhianat, dan sejumlah keluarga yang mencari kejelasan makam anaknya.','1777135300_bc8ec99aed1b3caedd7c.avif',NULL);
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_rak`
--

DROP TABLE IF EXISTS `buku_rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_rak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_buku_rak` (`id_buku`,`id_rak`),
  KEY `buku_rak_ibfk_1` (`id_buku`),
  KEY `buku_rak_ibfk_2` (`id_rak`),
  CONSTRAINT `buku_rak_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE,
  CONSTRAINT `buku_rak_ibfk_2` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_rak`
--

LOCK TABLES `buku_rak` WRITE;
/*!40000 ALTER TABLE `buku_rak` DISABLE KEYS */;
INSERT INTO `buku_rak` VALUES (32,24,5),(31,43,5),(28,44,15),(33,45,5),(34,46,5),(35,47,5),(36,48,5);
/*!40000 ALTER TABLE `buku_rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengembalian` int(11) DEFAULT NULL,
  `jumlah_denda` decimal(10,2) DEFAULT NULL,
  `status` enum('belum_bayar','menunggu_verifikasi','lunas') DEFAULT 'belum_bayar',
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_denda`),
  KEY `denda_ibfk_1` (`id_pengembalian`),
  KEY `fk_verified_petugas` (`verified_by`),
  CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`id_pengembalian`) REFERENCES `pengembalian` (`id_pengembalian`) ON DELETE CASCADE,
  CONSTRAINT `fk_verified_petugas` FOREIGN KEY (`verified_by`) REFERENCES `petugas` (`id_petugas`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denda`
--

LOCK TABLES `denda` WRITE;
/*!40000 ALTER TABLE `denda` DISABLE KEYS */;
INSERT INTO `denda` VALUES (13,39,2000.00,'lunas',NULL,NULL);
/*!40000 ALTER TABLE `denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_kembali` enum('belum','sudah') DEFAULT 'belum',
  PRIMARY KEY (`id_detail`),
  KEY `detail_peminjaman_ibfk_1` (`id_peminjaman`),
  KEY `detail_peminjaman_ibfk_2` (`id_buku`),
  CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE,
  CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
INSERT INTO `detail_peminjaman` VALUES (81,64,46,NULL,'belum'),(82,64,47,NULL,'belum'),(89,71,44,NULL,'belum'),(96,78,24,NULL,'belum'),(97,79,48,NULL,'belum'),(98,80,46,NULL,'belum'),(99,80,47,NULL,'belum');
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (2,'Non-Fiksi'),(3,'Teknologi'),(4,'Sejarah'),(5,'Pendidikan'),(11,'Agama'),(13,'Anak-anak'),(14,'Komik'),(16,'Psikologi'),(18,'Fiksi'),(20,'Novel');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('menunggu','dipinjam','ditolak','kembali') DEFAULT 'menunggu',
  `foto_bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `peminjaman_ibfk_1` (`id_anggota`),
  KEY `peminjaman_ibfk_2` (`id_petugas`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (64,9,3,'2026-04-24','2026-04-27','',NULL),(71,12,3,'2026-04-22','2026-04-25','kembali',NULL),(78,7,3,'2026-04-23','2026-04-26','',NULL),(79,21,3,'2026-04-23','2026-04-26','dipinjam',NULL),(80,7,3,'2026-04-26','2026-04-29','dipinjam',NULL);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penarikan`
--

DROP TABLE IF EXISTS `penarikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','diambil','selesai') DEFAULT 'menunggu',
  `tanggal_ambil` date DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penarikan`),
  KEY `penarikan_ibfk_1` (`id_peminjaman`),
  KEY `penarikan_ibfk_2` (`petugas_id`),
  CONSTRAINT `penarikan_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`),
  CONSTRAINT `penarikan_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penarikan`
--

LOCK TABLES `penarikan` WRITE;
/*!40000 ALTER TABLE `penarikan` DISABLE KEYS */;
/*!40000 ALTER TABLE `penarikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerbit`
--

DROP TABLE IF EXISTS `penerbit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerbit`
--

LOCK TABLES `penerbit` WRITE;
/*!40000 ALTER TABLE `penerbit` DISABLE KEYS */;
INSERT INTO `penerbit` VALUES (1,'Gramedia','Jakarta'),(4,'Deepublish','Yogyakarta'),(5,'Gramedia Pustaka Utama','Jakarta'),(6,'Bentang Pustaka','Yogyakarta'),(7,'Erlangga','Jakarta'),(8,'Tekad','Bandung'),(10,'Republika','Jakarta'),(13,'Kawah Media','Jakarta'),(14,'Elex Media Komputindo','Bandung'),(15,'Black Swan Books','Jakarta');
/*!40000 ALTER TABLE `penerbit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `denda_per_hari` decimal(10,2) DEFAULT NULL,
  `maksimal_pinjam` int(11) DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaturan`
--

LOCK TABLES `pengaturan` WRITE;
/*!40000 ALTER TABLE `pengaturan` DISABLE KEYS */;
INSERT INTO `pengaturan` VALUES (1,'Sistem Perpustakaan',2000.00,3,3);
/*!40000 ALTER TABLE `pengaturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id_pengembalian`),
  KEY `pengembalian_ibfk_1` (`id_peminjaman`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (39,71,'2026-04-26',0.00),(47,78,'2026-04-26',0.00),(48,64,'2026-04-26',0.00);
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengiriman`
--

DROP TABLE IF EXISTS `pengiriman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','dikirim','sampai') DEFAULT 'menunggu',
  `tanggal_kirim` date DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`),
  KEY `pengiriman_ibfk_1` (`id_peminjaman`),
  KEY `pengiriman_ibfk_2` (`petugas_id`),
  CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`),
  CONSTRAINT `pengiriman_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengiriman`
--

LOCK TABLES `pengiriman` WRITE;
/*!40000 ALTER TABLE `pengiriman` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengiriman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penulis`
--

DROP TABLE IF EXISTS `penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penulis`
--

LOCK TABLES `penulis` WRITE;
/*!40000 ALTER TABLE `penulis` DISABLE KEYS */;
INSERT INTO `penulis` VALUES (1,'Tere Liye'),(2,'Andrea Hirata'),(15,'Dee Lestari'),(20,'Lenn Liu'),(21,'Skysphire'),(22,'Leila S. Chudori'),(23,'I. A. A. Djiiwaraga'),(24,'Sophie Aulia'),(25,'Aoyama Gosho'),(26,'Asti Musman');
/*!40000 ALTER TABLE `penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `petugas_ibfk_1` (`user_id`),
  CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` VALUES (3,11,'Petugas Administrasi');
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rak`
--

DROP TABLE IF EXISTS `rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(50) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rak`
--

LOCK TABLES `rak` WRITE;
/*!40000 ALTER TABLE `rak` DISABLE KEYS */;
INSERT INTO `rak` VALUES (4,'Rak A1','Lantai 1 - Fiksi'),(5,'Rak A2','Lantai 1 - Novel'),(6,'Rak A3','Lantai 1 - Komik'),(7,'Rak B1','Lantai 2 - Teknologi'),(8,'Rak B2','Lantai 2 - Sains'),(9,'Rak B3','Lantai 2 - Pendidikan'),(10,'Rak C1','Lantai 3 - Sejarah'),(11,'Rak C2','Lantai 3 - Agama'),(12,'Rak D1','Lantai 4 - Bisnis'),(13,'Rak D2','Lantai 4 - Motivasi'),(14,'Rak C3 ','Lantai 3 - Non Fiksi'),(15,'Rak D3','Lantai 4 - Psikologi');
/*!40000 ALTER TABLE `rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `jenis` enum('denda','pengiriman','penarikan') DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `status` enum('belum_bayar','lunas','menunggu_verifikasi') DEFAULT 'belum_bayar',
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_transaksi`),
  KEY `transaksi_ibfk_1` (`id_peminjaman`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (4,71,'denda',2000.00,'lunas','2026-04-25 22:50:04');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mutiara Laila','mutiaralaila3006@gmail.com','mutiaralaila','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','admin','1777084228_3a0ef5d091cd27758234.png','aktif','2026-04-10 15:31:04'),(3,'Clara Seraphina','claraseraphina@gmail.com','clarasera','$2y$10$JrtZTY/dOWjKKRoZGL2tqu5TmvwyjlTREb2Zazw9I.Jn95tJOXPUu','anggota','1777046572_6ed63eb1197fce76819e.jpg','aktif','2026-04-10 15:35:01'),(5,'Winter Clarie','winterclarie@gmail.com','imwinter','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','anggota','1777084308_877774600cd8579bb2ed.jpg','aktif','2026-04-21 18:35:51'),(8,'Albirru Shaka ','albirrushaka@gmail.com','albirru ','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','anggota','1777084317_d0abb8ed3f8fe3e41d6b.jpg','aktif','2026-04-21 18:35:51'),(11,'Gheara Yuna Celestia','ghearayuna@gmail.com','gheara','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','petugas','1777102512_c5be9e0f64f0fa6c91f9.jpg','aktif','2026-04-21 18:36:28'),(19,'Yuvin Mahameru','yuvinmahameru@gmail.com','yuvinmeru','$2y$10$K9s2NV//jklXYg/NtWUxdO3iENhrbTbH.ERm9VXWMZPI4wUWrmYLK','anggota','1777174585_75f0d3a958a7e4048642.jpg','aktif','2026-04-26 03:36:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-26 19:06:08
