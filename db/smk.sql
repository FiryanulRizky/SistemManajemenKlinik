-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2019 at 01:31 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smk`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `umur_pasien` ()  BEGIN
SELECT YEAR(CURDATE())-YEAR(tgl_lahir) AS age FROM tb_pasien;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adminis_detail`
--

CREATE TABLE `adminis_detail` (
  `no_administrasi` varchar(8) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminis_detail`
--

INSERT INTO `adminis_detail` (`no_administrasi`, `jumlah`) VALUES
('ADM00001', 1),
('ADM00002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_detail`
--

CREATE TABLE `bahan_detail` (
  `no_bahan` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_detail`
--

INSERT INTO `bahan_detail` (`no_bahan`, `jumlah`) VALUES
('BHN0000001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_adminis`
--

CREATE TABLE `log_adminis` (
  `no_log` varchar(10) NOT NULL,
  `tgl_log` date DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `id_pegawai` varchar(8) NOT NULL,
  `no_resep` varchar(10) NOT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obat_detail`
--

CREATE TABLE `obat_detail` (
  `no_obat` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat_detail`
--

INSERT INTO `obat_detail` (`no_obat`, `jumlah`) VALUES
('OBT0000001', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orderbahan_detail`
--

CREATE TABLE `orderbahan_detail` (
  `no_order` varchar(10) NOT NULL,
  `no_bahan` varchar(10) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderobat_detail`
--

CREATE TABLE `orderobat_detail` (
  `no_order` varchar(10) NOT NULL,
  `no_obat` varchar(10) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderobat_detail`
--

INSERT INTO `orderobat_detail` (`no_order`, `no_obat`, `harga`, `jumlah`) VALUES
('ORD0000001', 'OBT0000001', 5000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_administrasi`
--

CREATE TABLE `tb_administrasi` (
  `no_administrasi` varchar(8) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_administrasi`
--

INSERT INTO `tb_administrasi` (`no_administrasi`, `nama`, `biaya`) VALUES
('ADM00001', 'Biaya Parkir', 2000),
('ADM00002', 'Biaya Check-Up', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_apoteker`
--

CREATE TABLE `tb_apoteker` (
  `id_apoteker` varchar(8) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_apoteker`
--

INSERT INTO `tb_apoteker` (`id_apoteker`, `nama`, `jenis_kelamin`, `telp`, `email`, `alamat`) VALUES
('AP000001', 'Benedict Emanuel Sutrisna', 'Laki-Laki', '082340111783', 'nutman452@gmail.com', 'Jl. Gedong Sari no 1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan`
--

CREATE TABLE `tb_bahan` (
  `no_bahan` varchar(10) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bahan`
--

INSERT INTO `tb_bahan` (`no_bahan`, `nama`, `stok`, `harga`, `deskripsi`) VALUES
('BHN0000001', 'Jarum Suntik', 1, 5000, 'Jarum untuk suntikan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(8) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `id_spesialis` varchar(4) DEFAULT NULL,
  `no_praktek` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama`, `jenis_kelamin`, `telp`, `email`, `alamat`, `id_spesialis`, `no_praktek`) VALUES
('DK000001', 'Prasetyo Adi Utomo', 'Laki-Laki', '085858737659', 'rashito7659@gmail.com', 'Jl. Tuan Lange A4 Kuta', 'SP01', 'PR01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `no_obat` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`no_obat`, `nama`, `stok`, `harga`, `deskripsi`) VALUES
('OBT0000001', 'Amoxicillin', 5, 5000, 'Antibiotik'),
('OBT0000002', 'Amoxan', 2, 4000, 'Antibiotik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `no_order` varchar(10) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `id_supplier` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`no_order`, `tgl_order`, `id_supplier`) VALUES
('ORD0000001', '2019-05-20', 'SP000001'),
('ORD0000002', '2019-05-26', 'SP000001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`nik`, `nama`, `tgl_lahir`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('3510071806990001', 'Prasetyo Adi Utomo', '1999-06-18', 'Laki-Laki', '085858737659', 'Jl. Tuan Lange no A4 Kuta'),
('3510072006000002', 'Oohasi Rei', '2000-06-20', 'Perempuan', 'Â Â 08155860066', 'Â Â Jl. Kendedes no 15 Kuta');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` varchar(8) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `user_pegawai` varchar(16) DEFAULT NULL,
  `pass_pegawai` varchar(8) DEFAULT NULL,
  `level_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama`, `jenis_kelamin`, `email`, `alamat`, `user_pegawai`, `pass_pegawai`, `level_pegawai`) VALUES
('PGW00001', 'Prasetyo Adi Utomo', 'Laki-Laki', 'rashito7659@gmail.com', 'Jl. Tuan Lange no A4', 'rieru18', 'rimuru18', 1),
('PW000002', 'Gede Putra Aditya Brahmantha', 'Perempuan', 'adithermawan33@gmail.com', 'Jl. Gua Gong', 'natsume123', 'natsume', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktek`
--

CREATE TABLE `tb_praktek` (
  `no_praktek` varchar(4) NOT NULL,
  `hari` varchar(6) DEFAULT NULL,
  `jam` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_praktek`
--

INSERT INTO `tb_praktek` (`no_praktek`, `hari`, `jam`) VALUES
('PR01', 'Senin', '09.00-12.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep`
--

CREATE TABLE `tb_resep` (
  `no_resep` varchar(10) NOT NULL,
  `tgl_resep` date DEFAULT NULL,
  `deskripsi` varchar(30) DEFAULT NULL,
  `id_dokter` varchar(8) DEFAULT NULL,
  `id_apoteker` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rm`
--

CREATE TABLE `tb_rm` (
  `no_rm` varchar(6) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `keluhan` varchar(50) DEFAULT NULL,
  `diagnosa` varchar(50) DEFAULT NULL,
  `alergi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rm`
--

INSERT INTO `tb_rm` (`no_rm`, `nik`, `keluhan`, `diagnosa`, `alergi`) VALUES
('RM0001', '3510071806990001', 'Sakit Tenggorokan', 'Radang Tenggorokan', 'Pennicillin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spesialis`
--

CREATE TABLE `tb_spesialis` (
  `id_spesialis` varchar(4) NOT NULL,
  `nama_spesial` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_spesialis`
--

INSERT INTO `tb_spesialis` (`id_spesialis`, `nama_spesial`) VALUES
('SP01', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` varchar(8) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `deskripsi` varchar(30) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama`, `deskripsi`, `telp`, `alamat`, `kota`) VALUES
('SP000001', 'Anugrah Agency', 'Supplier Amoxicilin', '085858676454', 'Jl. Tuan Raya Bandung', 'Bandung'),
('SP000002', 'Salty Agency', 'Supplier Amonia', '082456789321', 'Jl. Raya Kuta', 'Badung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminis_detail`
--
ALTER TABLE `adminis_detail`
  ADD KEY `no_administrasi` (`no_administrasi`);

--
-- Indexes for table `bahan_detail`
--
ALTER TABLE `bahan_detail`
  ADD KEY `no_bahan` (`no_bahan`);

--
-- Indexes for table `log_adminis`
--
ALTER TABLE `log_adminis`
  ADD PRIMARY KEY (`no_log`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `no_resep` (`no_resep`);

--
-- Indexes for table `obat_detail`
--
ALTER TABLE `obat_detail`
  ADD KEY `no_obat` (`no_obat`);

--
-- Indexes for table `orderbahan_detail`
--
ALTER TABLE `orderbahan_detail`
  ADD KEY `no_order` (`no_order`),
  ADD KEY `no_bahan` (`no_bahan`);

--
-- Indexes for table `orderobat_detail`
--
ALTER TABLE `orderobat_detail`
  ADD KEY `no_order` (`no_order`),
  ADD KEY `no_obat` (`no_obat`);

--
-- Indexes for table `tb_administrasi`
--
ALTER TABLE `tb_administrasi`
  ADD PRIMARY KEY (`no_administrasi`);

--
-- Indexes for table `tb_apoteker`
--
ALTER TABLE `tb_apoteker`
  ADD PRIMARY KEY (`id_apoteker`);

--
-- Indexes for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  ADD PRIMARY KEY (`no_bahan`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_spesialis` (`id_spesialis`),
  ADD KEY `tb_dokter_ibfk_2` (`no_praktek`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`no_obat`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`no_order`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tb_praktek`
--
ALTER TABLE `tb_praktek`
  ADD PRIMARY KEY (`no_praktek`);

--
-- Indexes for table `tb_resep`
--
ALTER TABLE `tb_resep`
  ADD PRIMARY KEY (`no_resep`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_apoteker` (`id_apoteker`);

--
-- Indexes for table `tb_rm`
--
ALTER TABLE `tb_rm`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `tb_spesialis`
--
ALTER TABLE `tb_spesialis`
  ADD PRIMARY KEY (`id_spesialis`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminis_detail`
--
ALTER TABLE `adminis_detail`
  ADD CONSTRAINT `adminis_detail_ibfk_2` FOREIGN KEY (`no_administrasi`) REFERENCES `tb_administrasi` (`no_administrasi`);

--
-- Constraints for table `bahan_detail`
--
ALTER TABLE `bahan_detail`
  ADD CONSTRAINT `bahan_detail_ibfk_2` FOREIGN KEY (`no_bahan`) REFERENCES `tb_bahan` (`no_bahan`);

--
-- Constraints for table `log_adminis`
--
ALTER TABLE `log_adminis`
  ADD CONSTRAINT `log_adminis_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_pasien` (`nik`),
  ADD CONSTRAINT `log_adminis_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`),
  ADD CONSTRAINT `log_adminis_ibfk_3` FOREIGN KEY (`no_resep`) REFERENCES `tb_resep` (`no_resep`);

--
-- Constraints for table `obat_detail`
--
ALTER TABLE `obat_detail`
  ADD CONSTRAINT `obat_detail_ibfk_2` FOREIGN KEY (`no_obat`) REFERENCES `tb_obat` (`no_obat`);

--
-- Constraints for table `orderbahan_detail`
--
ALTER TABLE `orderbahan_detail`
  ADD CONSTRAINT `orderbahan_detail_ibfk_1` FOREIGN KEY (`no_order`) REFERENCES `tb_order` (`no_order`),
  ADD CONSTRAINT `orderbahan_detail_ibfk_2` FOREIGN KEY (`no_bahan`) REFERENCES `tb_bahan` (`no_bahan`);

--
-- Constraints for table `orderobat_detail`
--
ALTER TABLE `orderobat_detail`
  ADD CONSTRAINT `orderobat_detail_ibfk_1` FOREIGN KEY (`no_order`) REFERENCES `tb_order` (`no_order`),
  ADD CONSTRAINT `orderobat_detail_ibfk_2` FOREIGN KEY (`no_obat`) REFERENCES `tb_obat` (`no_obat`);

--
-- Constraints for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD CONSTRAINT `tb_dokter_ibfk_1` FOREIGN KEY (`id_spesialis`) REFERENCES `tb_spesialis` (`id_spesialis`),
  ADD CONSTRAINT `tb_dokter_ibfk_2` FOREIGN KEY (`no_praktek`) REFERENCES `tb_praktek` (`no_praktek`);

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`);

--
-- Constraints for table `tb_resep`
--
ALTER TABLE `tb_resep`
  ADD CONSTRAINT `tb_resep_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `tb_dokter` (`id_dokter`),
  ADD CONSTRAINT `tb_resep_ibfk_2` FOREIGN KEY (`id_apoteker`) REFERENCES `tb_apoteker` (`id_apoteker`);

--
-- Constraints for table `tb_rm`
--
ALTER TABLE `tb_rm`
  ADD CONSTRAINT `tb_rm_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_pasien` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
