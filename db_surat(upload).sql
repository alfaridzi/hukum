/*
Navicat MariaDB Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 100126
Source Host           : localhost:3306
Source Database       : db_surat

Target Server Type    : MariaDB
Target Server Version : 100126
File Encoding         : 65001

Date: 2018-03-15 15:15:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_03_02_051918_create_category_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_bahasa
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bahasa`;
CREATE TABLE `tbl_bahasa` (
  `id_bahasa` int(10) NOT NULL AUTO_INCREMENT,
  `bahasa` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bahasa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_bahasa
-- ----------------------------
INSERT INTO `tbl_bahasa` VALUES ('2', 'Indonesia', '2018-03-03 17:02:39', '2018-03-03 17:03:39');

-- ----------------------------
-- Table structure for tbl_berkas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_berkas`;
CREATE TABLE `tbl_berkas` (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `id_unitkerja` int(11) DEFAULT NULL,
  `kode_klasifikasi` varchar(11) DEFAULT NULL,
  `nomor_berkas` int(11) DEFAULT NULL,
  `judul_berkas` varchar(255) DEFAULT NULL,
  `status_retensi` int(11) DEFAULT '1',
  `retensi_dari` int(11) DEFAULT NULL,
  `r_aktif` varchar(255) DEFAULT NULL,
  `r_inaktif` varchar(255) DEFAULT NULL,
  `penyusutan_akhir` int(11) DEFAULT NULL,
  `lokasi_fisik` varchar(255) DEFAULT NULL,
  `isi_ringkas` text,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_berkas`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_berkas
-- ----------------------------
INSERT INTO `tbl_berkas` VALUES ('2', '15', 'PB.01.01', '1', 'dafa', '1', '1', '3333-03-31', '3333-03-31', '1', 'saf', 's', '2018-03-11 11:33:33', '2018-03-11 11:33:33');
INSERT INTO `tbl_berkas` VALUES ('3', '15', 'PB.01.01', '2', 'BK BK BK', '1', '0', '1999-04-03', '1999-04-03', '1', '1', 'x', '2018-03-11 12:08:19', '2018-03-11 12:08:19');
INSERT INTO `tbl_berkas` VALUES ('4', '20', 'PB.01.01', '1', 'Penolongan bencana banjir', '1', '1', '2020-04-03', '2020-03-01', '1', 'C', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-03-11 21:47:38', '2018-03-12 03:14:22');
INSERT INTO `tbl_berkas` VALUES ('5', '20', 'P.01', '2', 'Test', '2', '0', '2010-04-03', '2020-04-03', '3', null, null, '2018-03-12 01:50:07', '2018-03-12 02:36:30');
INSERT INTO `tbl_berkas` VALUES ('6', '20', 'PB.01.01', '3', 'Ini judul old', '1', '0', '1999-08-09', '1999-03-04', '2', 'E', 'bolehhh', '2018-03-12 03:16:29', '2018-03-12 03:16:29');
INSERT INTO `tbl_berkas` VALUES ('7', '19', 'PB.01.01', '1', 'PB.01 TEST', '1', '1', '2018-03-05', '2020-03-11', '1', 'Gedung Jakarta Pusat', 'TEST', '2018-03-13 20:09:13', '2018-03-13 20:09:13');
INSERT INTO `tbl_berkas` VALUES ('8', '19', 'PB.01.01', '2', 'PB.02 TEST', '1', '1', '2018-03-13', '2020-05-12', '1', 'Gedung Jakarta Pusat', 'SAFGDS', '2018-03-13 20:09:55', '2018-03-13 20:09:55');
INSERT INTO `tbl_berkas` VALUES ('9', '19', 'PB.01.01', '3', 'PB.03 TEST', '1', '1', '2018-03-13', '2020-05-18', '1', 'asdsa', 'we', '2018-03-13 20:31:24', '2018-03-13 20:31:24');

-- ----------------------------
-- Table structure for tbl_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_detail`;
CREATE TABLE `tbl_detail` (
  `id_detail` int(50) NOT NULL AUTO_INCREMENT,
  `id_naskah` int(50) DEFAULT NULL,
  `perkembangan` int(10) DEFAULT NULL,
  `sifat_naskah` int(10) DEFAULT NULL,
  `kategori_arsip` enum('1','0') DEFAULT '0' COMMENT '1=terjaga, 0=umum',
  `akses_publik` enum('1','0') DEFAULT '0' COMMENT '1=tertutup, 0=terbuka',
  `media_arsip` int(10) DEFAULT NULL,
  `bahasa` int(10) DEFAULT NULL,
  `isi_ringkas` text,
  `vital` enum('1','0') DEFAULT '0' COMMENT '1=vital, 0=tidak vital',
  `jumlah` int(30) DEFAULT '1',
  `satuan_unit` int(10) DEFAULT NULL,
  `lokasi_fisik` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_detail
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_disposisi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi`;
CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(50) NOT NULL AUTO_INCREMENT,
  `id_naskah` int(50) DEFAULT NULL,
  `id_group` int(50) DEFAULT NULL,
  `no_index` varchar(255) DEFAULT NULL,
  `sifat` int(10) DEFAULT NULL,
  `disposisi` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_ekstensi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ekstensi`;
CREATE TABLE `tbl_ekstensi` (
  `id_ekstensi` int(10) NOT NULL AUTO_INCREMENT,
  `jenis_ekstensi` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ekstensi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_ekstensi
-- ----------------------------
INSERT INTO `tbl_ekstensi` VALUES ('1', 'docx', '2018-03-03 22:33:14', '2018-03-03 22:33:14');
INSERT INTO `tbl_ekstensi` VALUES ('3', 'doc', '2018-03-03 22:33:50', '2018-03-03 22:35:48');
INSERT INTO `tbl_ekstensi` VALUES ('4', 'html', '2018-03-03 22:34:28', '2018-03-03 22:36:09');
INSERT INTO `tbl_ekstensi` VALUES ('5', 'pdf', '2018-03-07 23:00:19', '2018-03-07 23:00:24');

-- ----------------------------
-- Table structure for tbl_file
-- ----------------------------
DROP TABLE IF EXISTS `tbl_file`;
CREATE TABLE `tbl_file` (
  `id_file` int(50) NOT NULL AUTO_INCREMENT,
  `id_group` int(255) DEFAULT NULL,
  `id_naskah` int(50) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_file
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_grup_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grup_jabatan`;
CREATE TABLE `tbl_grup_jabatan` (
  `id_grup` int(10) NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_grup`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grup_jabatan
-- ----------------------------
INSERT INTO `tbl_grup_jabatan` VALUES ('2', 'Eselon I', '2018-03-01 20:26:43', '2018-03-03 23:47:01');
INSERT INTO `tbl_grup_jabatan` VALUES ('3', 'Eselon II', '2018-03-07 16:18:51', '2018-03-07 16:18:51');
INSERT INTO `tbl_grup_jabatan` VALUES ('4', 'Eselon III', '2018-03-07 16:19:02', '2018-03-07 16:19:02');
INSERT INTO `tbl_grup_jabatan` VALUES ('5', 'Eselon IV', '2018-03-07 16:19:10', '2018-03-07 16:19:10');

-- ----------------------------
-- Table structure for tbl_halaman_depan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_halaman_depan`;
CREATE TABLE `tbl_halaman_depan` (
  `id_halaman` int(10) NOT NULL,
  `header_page` varchar(150) DEFAULT NULL,
  `file_image` varchar(255) DEFAULT NULL,
  `konten` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_halaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_halaman_depan
-- ----------------------------
INSERT INTO `tbl_halaman_depan` VALUES ('1', 'Sistem Persuratan Polhukam', 'fzlOJ-pexels-photo-860379(1).jpeg', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Aplikasi Otomasi Kearsipan ditujukan untuk membantu pengguna dalam melakukan pengelolaan Persuratan yang disesuaikan dengan bisnis proses Aplikasi Persuratan standar.</p>\r\n</body>\r\n</html>', null, '2018-03-07 23:11:14');

-- ----------------------------
-- Table structure for tbl_instansi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_instansi`;
CREATE TABLE `tbl_instansi` (
  `id_instansi` int(10) NOT NULL AUTO_INCREMENT,
  `kode_instansi` varchar(255) DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `nama_lain` varchar(255) DEFAULT NULL,
  `tipe_instansi` varchar(255) DEFAULT NULL,
  `tanggal_keberadaan` date DEFAULT NULL,
  `detail` text,
  `mandat` varchar(255) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL COMMENT '1=aktif, 0=tidak aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_instansi
-- ----------------------------
INSERT INTO `tbl_instansi` VALUES ('1', 'XII/SAS/2FW', 'KEMENTERIAN SOSIAL REPUBLIK INDONESIA', 'Departemen Sosial Republik Indonesia', 'Pemerintah', '2018-03-13', 'safasufbiasobfuio', 'Entah', '0', '2018-03-03 15:08:39', '2018-03-03 23:41:12');
INSERT INTO `tbl_instansi` VALUES ('2', 'XII/SAS/2FA', 'KEMENTERIAN SOSIAL REPUBLIK INDONESIA', 'ASWZ', 'Pemerintah', '2018-03-14', 'sfasfsaf', 'asd', '1', '2018-03-03 15:33:52', '2018-03-03 23:41:03');

-- ----------------------------
-- Table structure for tbl_isi_disposisi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_isi_disposisi`;
CREATE TABLE `tbl_isi_disposisi` (
  `id_disposisi` int(10) NOT NULL AUTO_INCREMENT,
  `id_grup` int(10) DEFAULT NULL,
  `isi_disposisi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_isi_disposisi
-- ----------------------------
INSERT INTO `tbl_isi_disposisi` VALUES ('1', '2', 'Mohon Hadiri', '2018-03-03 23:51:09', '2018-03-03 23:54:39');
INSERT INTO `tbl_isi_disposisi` VALUES ('2', '3', 'Segera Tindak Lanjut', '2018-03-13 21:52:55', '2018-03-13 21:52:55');

-- ----------------------------
-- Table structure for tbl_jenis_naskah
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jenis_naskah`;
CREATE TABLE `tbl_jenis_naskah` (
  `id_jenis_naskah` int(10) NOT NULL AUTO_INCREMENT,
  `jenis_naskah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jenis_naskah`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_jenis_naskah
-- ----------------------------
INSERT INTO `tbl_jenis_naskah` VALUES ('2', 'Berita Acara', '2018-03-03 20:45:22', '2018-03-03 23:50:48');
INSERT INTO `tbl_jenis_naskah` VALUES ('4', 'Catatan File', '2018-03-03 20:46:43', '2018-03-03 23:57:34');

-- ----------------------------
-- Table structure for tbl_klasifikasi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_klasifikasi`;
CREATE TABLE `tbl_klasifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `rAktif` int(11) DEFAULT '0',
  `rInaktif` int(11) DEFAULT '0',
  `penyusutan_akhir` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `id_status` varchar(255) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_klasifikasi
-- ----------------------------
INSERT INTO `tbl_klasifikasi` VALUES ('1', 'SK', 'Semua Klasifikasi', 'Klasifikasi Induk', '1', '2', '3', '0', '0', null, '2018-03-07 16:33:27');
INSERT INTO `tbl_klasifikasi` VALUES ('2', 'PB.01.01', 'Pembinaan', 'Klasifikasi Pembinaan', '1', '1', '1', '1', '0', null, '0000-00-00 00:00:00');
INSERT INTO `tbl_klasifikasi` VALUES ('3', 'P.01', 'al', 'afsafsa', '1', '5', '4', '3', '1', '2018-03-07 14:48:35', '2018-03-07 16:07:58');

-- ----------------------------
-- Table structure for tbl_media_arsip
-- ----------------------------
DROP TABLE IF EXISTS `tbl_media_arsip`;
CREATE TABLE `tbl_media_arsip` (
  `id_media_arsip` int(10) NOT NULL AUTO_INCREMENT,
  `media_arsip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_media_arsip`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_media_arsip
-- ----------------------------
INSERT INTO `tbl_media_arsip` VALUES ('1', 'Cakram Padat (CD/DVD/BluRay)', '2018-03-03 20:59:10', '2018-03-03 20:59:20');
INSERT INTO `tbl_media_arsip` VALUES ('3', 'Harddisk', '2018-03-03 21:01:31', '2018-03-03 23:50:38');
INSERT INTO `tbl_media_arsip` VALUES ('4', 'Kertas', '2018-03-03 21:01:38', '2018-03-03 23:58:00');
INSERT INTO `tbl_media_arsip` VALUES ('5', 'Tape', '2018-03-03 21:01:47', '2018-03-03 21:02:00');

-- ----------------------------
-- Table structure for tbl_naskah
-- ----------------------------
DROP TABLE IF EXISTS `tbl_naskah`;
CREATE TABLE `tbl_naskah` (
  `id_naskah` int(50) NOT NULL AUTO_INCREMENT,
  `id_group` int(50) DEFAULT NULL,
  `id_berkas` int(11) DEFAULT NULL,
  `id_user` int(50) DEFAULT NULL,
  `jenis_naskah` int(10) DEFAULT NULL,
  `tanggal_naskah` date DEFAULT NULL,
  `tanggal_registrasi` datetime DEFAULT NULL,
  `nomor_naskah` varchar(255) DEFAULT NULL,
  `nomor_agenda` varchar(255) DEFAULT NULL,
  `hal` varchar(255) DEFAULT NULL,
  `asal_naskah` varchar(255) DEFAULT NULL,
  `tingkat_urgensi` int(10) DEFAULT NULL,
  `tingkat_perkembangan` int(10) DEFAULT NULL,
  `sifat_naskah` int(10) DEFAULT NULL,
  `kategori_arsip` enum('1','0') DEFAULT '0' COMMENT '1=terjaga, 0=umum',
  `akses_publik` enum('1','0') DEFAULT '0' COMMENT '1=tertutup, 0=terbuka',
  `media_arsip` int(10) DEFAULT NULL,
  `bahasa` int(10) DEFAULT NULL,
  `isi_ringkas` text,
  `vital` enum('1','0') DEFAULT '0' COMMENT '1=vital, 0=tidak vital',
  `jumlah` int(30) DEFAULT '1',
  `satuan_unit` int(10) DEFAULT NULL,
  `lokasi_fisik` varchar(255) DEFAULT NULL,
  `file_dir` varchar(255) DEFAULT NULL,
  `tipe_registrasi` enum('5','4','3','2','1') DEFAULT '1' COMMENT '1=naskah masuk, 2=memo, 3=nota dinas, 4=naskah keluar, 5=naskah tanpa tidak lanjut',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_naskah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_naskah
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_penerima
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penerima`;
CREATE TABLE `tbl_penerima` (
  `id_penerima` int(50) NOT NULL AUTO_INCREMENT,
  `id_group` int(255) DEFAULT NULL,
  `id_naskah` int(50) DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL,
  `sebagai` varchar(255) DEFAULT NULL,
  `pesan` text,
  `kirim_user` varchar(255) DEFAULT NULL,
  `status_naskah` enum('1','0') DEFAULT '0' COMMENT '1=sudah dibaca, 0=belum dibaca',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_penerima`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_penerima
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_perkembangan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_perkembangan`;
CREATE TABLE `tbl_perkembangan` (
  `id_perkembangan` int(10) NOT NULL AUTO_INCREMENT,
  `tingkat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_perkembangan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_perkembangan
-- ----------------------------
INSERT INTO `tbl_perkembangan` VALUES ('1', 'Asli', '2018-03-03 21:47:12', '2018-03-03 21:49:30');
INSERT INTO `tbl_perkembangan` VALUES ('3', 'Draft', '2018-03-03 21:50:56', '2018-03-04 00:00:19');

-- ----------------------------
-- Table structure for tbl_satuan_unit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_satuan_unit`;
CREATE TABLE `tbl_satuan_unit` (
  `id_satuan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_satuan_unit
-- ----------------------------
INSERT INTO `tbl_satuan_unit` VALUES ('1', 'Bab', '2018-03-01 19:12:44', '2018-03-01 19:33:17');
INSERT INTO `tbl_satuan_unit` VALUES ('2', 'Bundel', '2018-03-01 19:19:31', '2018-03-01 19:19:31');
INSERT INTO `tbl_satuan_unit` VALUES ('3', 'Cm (tebal)', '2018-03-01 19:20:21', '2018-03-04 00:00:34');
INSERT INTO `tbl_satuan_unit` VALUES ('4', 'Halaman', '2018-03-01 19:20:33', '2018-03-01 19:20:33');
INSERT INTO `tbl_satuan_unit` VALUES ('5', 'Kopi/Jilid', '2018-03-01 19:20:44', '2018-03-01 19:20:44');
INSERT INTO `tbl_satuan_unit` VALUES ('7', 'Lembar', '2018-03-01 19:53:58', '2018-03-01 19:53:58');

-- ----------------------------
-- Table structure for tbl_sifat_naskah
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sifat_naskah`;
CREATE TABLE `tbl_sifat_naskah` (
  `id_sifat_naskah` int(10) NOT NULL AUTO_INCREMENT,
  `sifat_naskah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sifat_naskah`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sifat_naskah
-- ----------------------------
INSERT INTO `tbl_sifat_naskah` VALUES ('2', 'Biasa', '2018-03-03 21:15:33', '2018-03-04 00:02:01');
INSERT INTO `tbl_sifat_naskah` VALUES ('4', 'Rahasia', '2018-03-03 21:15:52', '2018-03-04 00:01:46');
INSERT INTO `tbl_sifat_naskah` VALUES ('5', 'Sangat Rahasia', '2018-03-04 00:02:14', '2018-03-04 00:02:14');

-- ----------------------------
-- Table structure for tbl_template_dok
-- ----------------------------
DROP TABLE IF EXISTS `tbl_template_dok`;
CREATE TABLE `tbl_template_dok` (
  `id_template` int(10) NOT NULL AUTO_INCREMENT,
  `nama_template` varchar(255) DEFAULT NULL,
  `file_template` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_template`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_template_dok
-- ----------------------------
INSERT INTO `tbl_template_dok` VALUES ('1', 'Berita Acara', 'CQfRU-622-1189-1-SM.pdf', '2018-03-03 23:20:17', '2018-03-03 23:36:18');
INSERT INTO `tbl_template_dok` VALUES ('2', 'Instruksi yang ditandatangani oleh Eselon I dan Eselon II', '1BMA4-517-1886-1-PB.pdf', '2018-03-03 23:37:33', '2018-03-03 23:44:25');
INSERT INTO `tbl_template_dok` VALUES ('3', 'Instruksi yang ditandatangani oleh Menteri Sosial', 'pwBEn-622-1189-1-SM.pdf', '2018-03-03 23:38:32', '2018-03-03 23:38:32');

-- ----------------------------
-- Table structure for tbl_text_tombol
-- ----------------------------
DROP TABLE IF EXISTS `tbl_text_tombol`;
CREATE TABLE `tbl_text_tombol` (
  `id_button` int(10) NOT NULL AUTO_INCREMENT,
  `keterangan` text,
  `text` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_button`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_text_tombol
-- ----------------------------
INSERT INTO `tbl_text_tombol` VALUES ('1', 'Tombol untuk membalas Surat (Reply)', 'Balas', '2018-03-02 00:03:57', '2018-03-01 19:06:19');
INSERT INTO `tbl_text_tombol` VALUES ('2', 'Tombol untuk Meneruskan (Forward)', 'Teruskan', '2018-03-02 00:04:05', '2018-03-04 00:03:09');
INSERT INTO `tbl_text_tombol` VALUES ('3', 'Tombol untuk Disposisi', 'Disposisi', '2018-03-02 00:04:08', '2018-03-04 00:03:19');
INSERT INTO `tbl_text_tombol` VALUES ('4', 'Tombol untuk Memberi Usulan', 'Usulan', '2018-03-02 00:04:13', '2018-03-04 00:03:28');
INSERT INTO `tbl_text_tombol` VALUES ('5', 'Tombol untuk Ubah Metadata', 'Ubah Metadata', '2018-03-02 00:04:16', '2018-03-04 00:03:33');
INSERT INTO `tbl_text_tombol` VALUES ('6', 'Tombol untuk Dokumen Final', 'Upload Dokumen', '2018-03-02 00:04:21', '2018-03-04 00:03:38');
INSERT INTO `tbl_text_tombol` VALUES ('7', 'Tombol untuk Kembali', 'Kembali', '2018-03-02 00:04:25', '2018-03-04 00:03:43');
INSERT INTO `tbl_text_tombol` VALUES ('8', 'Tombol untuk Menutup Berkas', 'Tutup Berkas', '2018-03-02 00:04:28', '2018-03-04 00:03:48');

-- ----------------------------
-- Table structure for tbl_unitkerja
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unitkerja`;
CREATE TABLE `tbl_unitkerja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_status` int(11) DEFAULT '0',
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_grup` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_unitkerja
-- ----------------------------
INSERT INTO `tbl_unitkerja` VALUES ('14', '1', 'Unit Kearsipan', '4', 'Unit Kearsipan', '0', '2018-03-07 04:54:07', '2018-03-07 16:27:29');
INSERT INTO `tbl_unitkerja` VALUES ('15', '1', 'Menteri Sosial', '8', 'Kementerian Sosial', '14', '2018-03-07 04:57:02', '2018-03-07 04:57:02');
INSERT INTO `tbl_unitkerja` VALUES ('18', '1', 'Kepala Unit Kearsipan Sekretariat Jendral', '2', 'Unit Kearsipan Sekretariat Jendral', '15', '2018-03-07 05:21:31', '2018-03-07 19:43:30');
INSERT INTO `tbl_unitkerja` VALUES ('19', '0', 'Staf Ahli Menteri Bidang Dampak Sosial', '2', 'Staf Ahli Menteri Bidang Dampak Sosial', '15', '2018-03-07 05:22:11', '2018-03-07 16:17:21');
INSERT INTO `tbl_unitkerja` VALUES ('20', '1', 'Sekretariat Jendral', '1', 'Sekretariat Jendral', '18', '2018-03-07 05:22:44', '2018-03-07 05:22:44');
INSERT INTO `tbl_unitkerja` VALUES ('21', '1', 'Sekretariat Jendral II', '3', 'Sekretariat Jendral II', '18', '2018-03-13 13:23:27', '2018-03-13 13:23:27');

-- ----------------------------
-- Table structure for tbl_urgensi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_urgensi`;
CREATE TABLE `tbl_urgensi` (
  `id_urgensi` int(10) NOT NULL AUTO_INCREMENT,
  `tingkat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_urgensi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_urgensi
-- ----------------------------
INSERT INTO `tbl_urgensi` VALUES ('1', 'Amat Segera', '2018-03-03 22:11:46', '2018-03-03 22:13:40');
INSERT INTO `tbl_urgensi` VALUES ('3', 'Segera', '2018-03-03 22:13:56', '2018-03-08 01:00:34');
INSERT INTO `tbl_urgensi` VALUES ('4', 'Biasa', '2018-03-03 22:14:50', '2018-03-03 22:14:50');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` int(30) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_jabatan_atasan` int(11) DEFAULT NULL,
  `id_status` int(255) DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(15) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', '20', null, '1', 'admin', 'Administrator', '$2y$10$/qvIJz95yrpkPuAW0y0OH.bLnI9KsQV4zogJBulzqPvzJhmlvHsK6', '1', 'KwqbCAZIY72u6kMmuCW46EyJ5gbTC0uhqeYf8e0yPRSP4YKzhHaP3Z7ZQu6X', '2018-03-04 21:29:01', '2018-03-07 21:38:12');
INSERT INTO `tbl_user` VALUES ('4', '15', null, '1', 'alfaridzi', 'Rifq', '$2y$10$iPm4umAhsMz5VrjpPfvcg.zWt5uOEwwaVmGPgFngsMlhX3P7hEHeO', '2', 'wHvNXIwag7uFSlHvFz4yD1YvLbbEEjMHpaxxWsNZC9GnNUF59ZryJUVMDTZ9', '2018-03-07 20:42:32', '2018-03-15 15:08:17');
INSERT INTO `tbl_user` VALUES ('5', '19', null, '1', 'rika', 'Rika', '$2y$10$7RaM/sj2kXzbLJ7jsMCjWO12ZQvdVWyoqFjuWeOEeKnA1NtkXcbXW', '4', 'D1XKs7OlOg8RyqK2GdgKhV7xuEDk1m9o34RSq1z6AW4Q1TOjy0zYRSpGPGer', '2018-03-10 13:47:26', '2018-03-15 15:10:46');
INSERT INTO `tbl_user` VALUES ('6', '21', null, '1', 'sri.mulyati', 'Sri Mulyati', '$2y$10$4ETEwls9w7zos9A45SLGP.PeztoAPwFjK4kkLXgDYSEpI53z3m0hm', '4', 'dlQX4UxRvVhBzQdNu1A8EXhaki0Rp2AeAUskr71HeSSlBGE6SDwZbQQChPZU', '2018-03-12 00:39:19', '2018-03-15 15:08:03');
INSERT INTO `tbl_user` VALUES ('7', '19', null, '1', 'suparman', 'Suparman', '$2y$10$mWNOP1R3BruqAjkin25jPeQq4.gmBWBISJuTHEJyzqVuP94BaLDS2', '3', 'K5Sq7TqgJFFPn9PG8djn1GeSyM7c09T8HEOt8FfSivHuaRO6nC1KWsfrJGRz', '2018-03-12 00:40:27', '2018-03-15 15:08:12');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
