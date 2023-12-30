-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 05:32 AM
-- Server version: 10.11.5-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` varchar(32) NOT NULL,
  `nomer_induk` varchar(12) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nomer_induk`, `nama`) VALUES
('5BTogDVTGMLJKiRlKvz0FHJcrZVAtyeV', '123', 'WEI'),
('bta6bkUAQVrEoGJv0CVjzbcaWRytGnP0', '394', 'WU');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` varchar(32) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `ruang` varchar(32) NOT NULL,
  `jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `ruang`, `jam`) VALUES
('123123123', 'CLASS ONE', 'fIIHYV5cuVMB7qgMwnBJ5OlH3vtDHnS1', 2),
('b1YDXMO0NUX2zEf9uEJ1wj4yHFg44xkJ', 'CLASS THREE', 'SjZgCxYMLNCphj3JkaCWrA79rUt33RcK', 3),
('FYbP0Joz8Co5VlTgeWz6aoqdRS1vfzEZ', 'CLASS TWO', 'SjZgCxYMLNCphj3JkaCWrA79rUt33RcK', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` varchar(32) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`) VALUES
('AoBRtmc8SQR8PKAH8XAwzLJavphWEuvr', '4444', 'FOUR'),
('imeMSqYexPjBl5hABW1HSFmOHcTUSMAO', '22222', 'TWO'),
('li78IcrPmM00A5zbRNqZ4mxlNP06gYox', '77777', 'SEVEN'),
('RbilMKIxqVst5D1t2l1wcrmUOzAlnNJx', '66666', 'SIX'),
('RykYmyHAygqgTLN0aNJcIQUVzrSRbNG6', '55555', 'FIVE'),
('zCPBOQ0nQVTcbw8rzG0HNNzvqY69SCF0', '11111', 'ONE'),
('ZqMd0uW5XC2AN9SS6cgy7hTxLMPuwQWY', '33333', 'THREE');

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE `relasi` (
  `id` varchar(64) NOT NULL,
  `id_dosen` varchar(32) NOT NULL,
  `id_kelas` varchar(32) NOT NULL,
  `list_mahasiswa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relasi`
--

INSERT INTO `relasi` (`id`, `id_dosen`, `id_kelas`, `list_mahasiswa`) VALUES
('123123123', '5BTogDVTGMLJKiRlKvz0FHJcrZVAtyeV', '123123123', 'imeMSqYexPjBl5hABW1HSFmOHcTUSMAO zCPBOQ0nQVTcbw8rzG0HNNzvqY69SCF0 ZqMd0uW5XC2AN9SS6cgy7hTxLMPuwQWY'),
('2pvrC4Hi1oSpgkGTp7Ey9q7qbepJP8125cizjHGMXssi8hA5uTpUIvGw6yrd9Hwy', 'bta6bkUAQVrEoGJv0CVjzbcaWRytGnP0', 'FYbP0Joz8Co5VlTgeWz6aoqdRS1vfzEZ', ' zCPBOQ0nQVTcbw8rzG0HNNzvqY69SCF0 imeMSqYexPjBl5hABW1HSFmOHcTUSMAO ZqMd0uW5XC2AN9SS6cgy7hTxLMPuwQWY AoBRtmc8SQR8PKAH8XAwzLJavphWEuvr'),
('cpWd9a2GCoU0BE0kNxeuCnIJwZHFPrUc84UGeSnLOhc0WrYdyhEZjUayS2w9qZy8', '5BTogDVTGMLJKiRlKvz0FHJcrZVAtyeV', 'b1YDXMO0NUX2zEf9uEJ1wj4yHFg44xkJ', ' RbilMKIxqVst5D1t2l1wcrmUOzAlnNJx li78IcrPmM00A5zbRNqZ4mxlNP06gYox RykYmyHAygqgTLN0aNJcIQUVzrSRbNG6');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` varchar(32) NOT NULL,
  `nama` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `nama`) VALUES
('fIIHYV5cuVMB7qgMwnBJ5OlH3vtDHnS1', 'FK 302'),
('jhsR7S5PNDppuDs2fmDkBchvlDryq56d', 'FK 301'),
('SjZgCxYMLNCphj3JkaCWrA79rUt33RcK', 'FK 304');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` varchar(128) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `expiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `user_id`, `expiry`) VALUES
('1n5w3JDoC7AJFA44VKxLXck2Ofu4bHh9C5kdhmMFjhP4JK8isTJUNQCgY5tTUzjNxnsdEKp6PBnjzrkO7wb3pn2p9vJZMrCR1uiXgWBtkZKh9rr3nyPdczk5gXlMjNsv', 'ZQq5qgbvuG14Sp63djnbO5fWykoqkzqh', '2023-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(32) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
('ZQq5qgbvuG14Sp63djnbO5fWykoqkzqh', 'admin', '$2y$10$FSmx1eJyNtNltfK5KozVN.0T3WcNuy2F4fcF17zywcUVRqEF07gAu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_relasi_dosen` (`id_dosen`),
  ADD KEY `fk_relasi_kelas` (`id_kelas`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_session_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relasi`
--
ALTER TABLE `relasi`
  ADD CONSTRAINT `fk_relasi_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `fk_relasi_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_session_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
