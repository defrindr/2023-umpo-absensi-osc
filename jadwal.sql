-- Adminer 4.8.1 MySQL 8.0.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `nomer_induk` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE `dosen`;
INSERT INTO `dosen` (`id`, `nomer_induk`, `nama`) VALUES
('DeEocWEPzYlwkaz0NGQk5xQS8AzZENt6',	'011',	'Liliana Rosa Dewi'),
('DTcqCyLy14JkOqnkJSzZ04I9tvaTaHMM',	'001',	'Subroto'),
('EjfIZtLoQlmVboqNik3fzQjYPZ7MfUJR',	'006',	'Iqbaal Wahyu Aryanata'),
('H50XkeJiOV6esKzeSMTT0gxBU564PeRf',	'005',	'Sinta Ramadani Aqilah'),
('haHhWeRnReXtFcFvh5ecjgoFXbYyo1bD',	'009',	'Silvia Putri Rengga'),
('Hl2220GvcFCLMHiqC4c8HL71xQh9yrGw',	'012',	'Wiwing Anugrah Sahaja'),
('K8vEmNhU8f5AUoRa2XjMOlpadYcm8kg9',	'008',	'Alfian Restu Nugraha'),
('ksffPNkTzyBw7hMicVhdBTCslx5fHPEw',	'002',	'M Ilham'),
('RL8jOh14s6nLb9YUKh0BydmsPjNp3EjV',	'003',	'Bambang Tri Atmojo'),
('rVJapc9HgeSAPX8wCOvMgk0aPgij7GpJ',	'010',	'Aldianata Riski Setiawan'),
('uDiyKOBJyKWxOtxuZJXCKHr7NmNZliqe',	'007',	'Satria Bian Sasongka'),
('VxPmAXZurORpUZWgAKAbr2r6HPrcDYmv',	'011',	'Cintya Sabriani Kustianingsih'),
('YVzgQCl1WP4WdADrRngf6DZlPJHaWIGZ',	'004',	'Difarina Indri');

DROP TABLE IF EXISTS `dosen_matakuliah`;
CREATE TABLE `dosen_matakuliah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `matakuliah_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matakuliah_id` (`matakuliah_id`),
  KEY `dosen_id` (`dosen_id`),
  CONSTRAINT `dosen_matakuliah_ibfk_3` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliah` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `dosen_matakuliah_ibfk_4` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `dosen_matakuliah`;
INSERT INTO `dosen_matakuliah` (`id`, `dosen_id`, `matakuliah_id`) VALUES
(12,	'DTcqCyLy14JkOqnkJSzZ04I9tvaTaHMM',	'0A5Ul61fZVDsg06eDuN63jRCpDg3mHZk'),
(24,	'ksffPNkTzyBw7hMicVhdBTCslx5fHPEw',	'5MpkrxWSZkI2smYHguCQhAyMvGUjPYWv'),
(25,	'RL8jOh14s6nLb9YUKh0BydmsPjNp3EjV',	'5pype0Mr7gvYHOroQNlWSrEjeBEQ97Q5'),
(26,	'YVzgQCl1WP4WdADrRngf6DZlPJHaWIGZ',	'8pQiD6YY2SllVtK5bmbC3HRfU29NSVl3'),
(27,	'H50XkeJiOV6esKzeSMTT0gxBU564PeRf',	'eHA8EO54NAkHdfKDwTDVzSOHs6aS1Y3N'),
(28,	'EjfIZtLoQlmVboqNik3fzQjYPZ7MfUJR',	'JuISzClSpg7IXeGw1wLoXsTy5fiRY0gF'),
(30,	'uDiyKOBJyKWxOtxuZJXCKHr7NmNZliqe',	'nDiHUavHX8fGmKmfV6bEDKwEORVCgwRX'),
(31,	'K8vEmNhU8f5AUoRa2XjMOlpadYcm8kg9',	'nUOydCn5yhl0wAwYRCGHgsyufzJleHDB'),
(32,	'haHhWeRnReXtFcFvh5ecjgoFXbYyo1bD',	'qtHM0OAf4KzlGgCCghLGfuCRi0j0Y5xz'),
(33,	'rVJapc9HgeSAPX8wCOvMgk0aPgij7GpJ',	't7oNQ6ChNYTy4XnQzjesfQAiIU9wFmFi'),
(34,	'DeEocWEPzYlwkaz0NGQk5xQS8AzZENt6',	'WM9Z9Mo9cTfGO9EEBIInl9uZGaeVVjNy'),
(35,	'VxPmAXZurORpUZWgAKAbr2r6HPrcDYmv',	'YtP6qt09vHunTe0Ka4XaKuGlHnpQiUAX'),
(36,	'Hl2220GvcFCLMHiqC4c8HL71xQh9yrGw',	'Zu38oI18kHj4vMfXGUASiGFpah5dkoQs');

DROP VIEW IF EXISTS `dosen_with_matkul`;
CREATE TABLE `dosen_with_matkul` (`nama` varchar(64), `nomer_induk` varchar(12), `id` int, `dosen_id` varchar(32), `matakuliah_id` varchar(32));


DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_angkatan` year NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE `kelas`;
INSERT INTO `kelas` (`id`, `nama`, `tahun_angkatan`, `status`) VALUES
('EOWdn9mJZumBu28NULAjuTvlqJXRQxRQ',	'D3 IT B',	'2021',	'aktif'),
('frTsFKlz70w35YtaQWFO1yxaejnA9o5u',	'D3 IT A',	'2020',	'aktif'),
('LEITBt81TntIEpwP4cTCk6ZnRnznpvEm',	'D3 IT B',	'2020',	'aktif'),
('qFhLaKz3sPjv9F8mkGppfqHzPNpemjQK',	'D3 IT A',	'2021',	'aktif');

DROP TABLE IF EXISTS `matakuliah`;
CREATE TABLE `matakuliah` (
  `id` varchar(32) NOT NULL,
  `kode_matakuliah` varchar(25) NOT NULL,
  `nama_matakuliah` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `matakuliah`;
INSERT INTO `matakuliah` (`id`, `kode_matakuliah`, `nama_matakuliah`, `created_at`) VALUES
('0A5Ul61fZVDsg06eDuN63jRCpDg3mHZk',	'MW-PPB1',	'Pemrograman Perangkat Bergerak 1',	'2023-12-30 07:22:11'),
('5MpkrxWSZkI2smYHguCQhAyMvGUjPYWv',	'MW-AJ1',	'Administrasi Jaringan 1',	'2023-12-30 07:20:54'),
('5pype0Mr7gvYHOroQNlWSrEjeBEQ97Q5',	'MW-BD1',	'Basis Data 1',	'2023-12-30 07:19:13'),
('8pQiD6YY2SllVtK5bmbC3HRfU29NSVl3',	'MW-OOP1',	'Object Oriented Programming 1',	'2023-12-30 07:21:25'),
('eHA8EO54NAkHdfKDwTDVzSOHs6aS1Y3N',	'MW-PPB2',	'Pemrograman Perangkat Bergerak 2',	'2023-12-30 07:22:22'),
('JuISzClSpg7IXeGw1wLoXsTy5fiRY0gF',	'MW-P1',	'Programming 1',	'2023-12-30 07:17:39'),
('nDiHUavHX8fGmKmfV6bEDKwEORVCgwRX',	'MW-MTK1',	'Matematika 1',	'2023-12-30 07:19:27'),
('nUOydCn5yhl0wAwYRCGHgsyufzJleHDB',	'MW-P2',	'Programming 2',	'2023-12-30 07:18:51'),
('qtHM0OAf4KzlGgCCghLGfuCRi0j0Y5xz',	'MW-AJ2',	'Administrasi Jaringan 2',	'2023-12-30 07:21:01'),
('t7oNQ6ChNYTy4XnQzjesfQAiIU9wFmFi',	'MW-JD1',	'Jaringan Dasar 1',	'2023-12-30 07:20:42'),
('WM9Z9Mo9cTfGO9EEBIInl9uZGaeVVjNy',	'MW-EP',	'Etika Profesi',	'2023-12-30 07:23:00'),
('YtP6qt09vHunTe0Ka4XaKuGlHnpQiUAX',	'MT-DS1',	'Data Science 1',	'2023-12-30 07:29:00'),
('Zu38oI18kHj4vMfXGUASiGFpah5dkoQs',	'MW-OOP2',	'Object Oriented Programming 2',	'2023-12-30 07:21:29');

DROP TABLE IF EXISTS `ruang`;
CREATE TABLE `ruang` (
  `id` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE `ruang`;
INSERT INTO `ruang` (`id`, `nama`) VALUES
('2jNTU4ip0WXMoQWBib9XAZb6kiVz8X0J',	'C02'),
('Aw9dt2DfjmxVXknNR8PlVvQuF20zb5TG',	'B04'),
('eeY3ZDXa7GD3cwgLqa9hmnPjxGWCgliw',	'A04'),
('fPHK4UAgM5moI52s3YCmV3WzsqUAFtA0',	'A01'),
('jGmW53Oed3443shOU7jWHSdKyI4PvHeM',	'B03'),
('KF4J9DKN5dlYjYx4JlvX2Ashdj4PIQvl',	'A02'),
('LRHa08cNELbldTWHuQiq8dajqe2cyYY4',	'B02'),
('lrqowzeylikfFhGM9T4Fe7OHhhQ17d0R',	'B01'),
('m3YuSAixxivukIZr8RuGcJX7iNxv6sW7',	'C04'),
('QeX738di2aW96ziIjqrXrbvLXuAh8Ftp',	'C01'),
('QYsoiqJACfWk5n52NlEsRqicZD3tOAEZ',	'A03'),
('syrx0ITX3W7DviyZ0UEGowDpi5mTr5mO',	'C03');

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `expiry` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_user` (`user_id`),
  CONSTRAINT `fk_session_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE `session`;
INSERT INTO `session` (`id`, `user_id`, `expiry`) VALUES
('Xb7CdDUgdKUAod37x7GFwh8fd7I51FyIUPqBt7SJuctV6pysqSXF8TzxmzIwP33LaVWgED9MfwCHdknGKrWxvC6DUp7hVrPyAZamU5pBuAeXQecIXsSO1O5GtzREOMKq',	'ZQq5qgbvuG14Sp63djnbO5fWykoqkzqh',	'2024-01-06');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE `user`;
INSERT INTO `user` (`id`, `username`, `password`) VALUES
('ZQq5qgbvuG14Sp63djnbO5fWykoqkzqh',	'admin',	'$2a$12$PilDADibhDPTAhGW.84jz.SYoas7NaNHpgWvgiESDduhQYvPcgR3i');

DROP TABLE IF EXISTS `dosen_with_matkul`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `dosen_with_matkul` AS select `dosen`.`nama` AS `nama`,`dosen`.`nomer_induk` AS `nomer_induk`,`dosen_matakuliah`.`id` AS `id`,`dosen_matakuliah`.`dosen_id` AS `dosen_id`,`dosen_matakuliah`.`matakuliah_id` AS `matakuliah_id` from (`dosen` join `dosen_matakuliah` on((`dosen_matakuliah`.`dosen_id` = `dosen`.`id`)));

-- 2024-01-01 11:33:24
