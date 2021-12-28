-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2021 at 03:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar_barang`
--

CREATE TABLE `tb_daftar_barang` (
  `id` int(5) NOT NULL,
  `kode_jenis` varchar(15) NOT NULL,
  `kode_kategori` varchar(15) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stock` int(10) NOT NULL,
  `id_satuan` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_daftar_barang`
--

INSERT INTO `tb_daftar_barang` (`id`, `kode_jenis`, `kode_kategori`, `kode_barang`, `nama_barang`, `stock`, `id_satuan`) VALUES
(1, '115111', '1010301001', '1010301001000001', 'STABILLO MERAH', 3, 3),
(5, '115111', '1010301001', '1010301001000002', 'BALLPOINT BIASA', 13, 3),
(6, '115111', '1010301001', '1010301001000003', 'BALLPOINT TANDA TANGAN', 12, 3),
(7, '115111', '1010301001', '1010301001000004', 'SPIDOL BOARDMARKER HITAM', 1, 3),
(8, '115111', '1010301001', '1010301001000005', 'SPIDOL KECIL', 0, 3),
(9, '115111', '1010301001', '1010301001000006', 'MAP PLASTIK KANCING', 0, 1),
(10, '115111', '1010301001', '1010301001000007', 'PENSIL', 8, 3),
(11, '115111', '1010301002', '1010301002000001', 'TINTA STEMPEL', 3, 4),
(12, '115111', '1010301002', '1010301002000002', 'REFILL BOARDMARKER HITAM', 3, 4),
(13, '115111', '1010301003', '1010301003000001', 'BINDER CLIP NO. 105', 0, 5),
(14, '115111', '1010301003', '1010301003000002', 'BINDER CLIP NO. 155', 2, 5),
(15, '115111', '1010301003', '1010301003000003', 'TRIGONAL CLIPS', 4, 5),
(16, '115111', '1010301003', '1010301003000004', 'BINDER CLIP NO. 200', 1, 5),
(17, '115111', '1010301004', '1010301004000001', 'PENGHAPUS PEN/TIPE X', 5, 4),
(18, '115111', '1010301005', '1010301005000001', 'BUKU FOLIO', 3, 3),
(19, '115111', '1010301005', '1010301005000002', 'BUKU EKSPEDISI', 5, 3),
(20, '115111', '1010301006', '1010301006000001', 'MAP PLASTIK JEPIT', 0, 1),
(21, '115111', '1010301006', '1010301006000002', 'MAP PLASTIK SNELHECTER', 0, 1),
(22, '115111', '1010301006', '1010301006000003', 'MAP PLASTIK SPRING', 0, 1),
(23, '115111', '1010301006', '1010301006000004', 'ORDNER BESAR', 2, 1),
(24, '115111', '1010301006', '1010301006000005', 'MAP KERTAS', 0, 1),
(25, '115111', '1010301007', '1010301007000001', 'MISTAR BESI 30 CM', 5, 3),
(26, '115111', '1010301008', '1010301008000001', 'CUTTER L-500', 0, 3),
(27, '115111', '1010301008', '1010301008000002', 'ISI CUTTER L-150', 0, 5),
(28, '115111', '1010301010', '1010301010000001', 'LEM STICK 40 GRAM', 0, 3),
(29, '115111', '1010301010', '1010301010000002', 'LAKBAN BENING BESAR', 3, 3),
(30, '115111', '1010301010', '1010301010000003', 'LAKBAN BENING SEDANG', 0, 3),
(31, '115111', '1010301010', '1010301010000004', 'LAKBAN BENING KECIL', 0, 3),
(32, '115111', '1010301010', '1010301010000005', 'LAKBAN HITAM BESAR', 1, 3),
(33, '115111', '1010301010', '1010301010000006', 'DOUBLE TAPE BESAR', 0, 3),
(34, '115111', '1010301010', '1010301010000007', 'DOUBLE TAPE KECIL', 11, 3),
(35, '115111', '1010301010', '1010301010000008', 'LAKBAN HITAM SEDANG', 0, 3),
(36, '115111', '1010301010', '1010301010000009', 'LEM FOX 800 GRAM', 0, 4),
(37, '115111', '1010301012', '1010301012000001', 'STAPLES HD-10', 5, 3),
(38, '115111', '1010301013', '1010301013000001', 'ISI STAPLES NO. 10', 6, 5),
(39, '115111', '1010301999', '1010301999000001', 'STICKY NOTE 3M', 0, 1),
(40, '115111', '1010301999', '1010301999000002', 'STICKY NOTE TTD', 0, 1),
(41, '115111', '1010301999', '1010301999000003', 'STICKY NOTE MEMO PAPER', 7, 1),
(42, '115111', '1010301999', '1010301999000004', 'GUNTING KECIL', 4, 3),
(43, '115111', '1010301999', '1010301999000005', 'STAPLES JILID', 1, 3),
(44, '115111', '1010301999', '1010301999000006', 'ISI LEM TEMBAK BESAR', 0, 3),
(45, '115111', '1010301999', '1010301999000007', 'RAUTAN PENSIL MEJA', 0, 3),
(46, '115111', '1010301999', '1010301999000008', 'BUKU KUITANSI', 0, 3),
(47, '115111', '1010301999', '1010301999000009', 'TEMPAT PENA', 6, 3),
(48, '115111', '1010302001', '1010302001000001', 'KERTAS A4', 15, 1),
(49, '115111', '1010302001', '1010302001000002', 'KERTAS F4', 4, 3),
(50, '115111', '1010302001', '1010302001000003', 'KERTAS A3', 1, 1),
(51, '115111', '1010302003', '1010302003000001', 'KERTAS COVER F4', 3, 1),
(52, '115111', '1010302004', '1010302004000001', 'AMPLOP COKELAT KECIL', 0, 1),
(53, '115111', '1010302004', '1010302004000002', 'AMPLOP COKELAT BESAR', 2, 1),
(54, '115111', '1010302004', '1010302004000003', 'AMPLOP PUTIH', 1, 1),
(55, '115111', '1010302999', '1010302999000001', 'PLASTIK JILID MIKA', 0, 1),
(56, '115111', '1010302999', '1010302999000002', 'KERTAS FOTO A4', 2, 1),
(57, '115111', '1010304004', '1010304004000001', 'TINTA BOTOL EPSON HITAM', 4, 4),
(58, '115111', '1010304004', '1010304004000002', 'TINTA BOTOL EPSON WARNA', 10, 4),
(59, '115111', '1010304004', '1010304004000003', 'CARTRIDGE', 0, 3),
(60, '115111', '1010304004', '1010304004000004', 'TINTA PRINTER A3 HITAM', 0, 4),
(61, '115111', '1010304004', '1010304004000005', 'TINTA PRINTER A3 WARNA', 0, 4),
(62, '115111', '1010304006', '1010304006000001', 'FLASHDISK 16 GB', 0, 3),
(63, '115111', '1010306002', '1010306002000001', 'LAMPU 10 WATT', 0, 3),
(64, '115111', '1010306002', '1010306002000002', 'LAMPU 12 WATT', 0, 3),
(65, '115111', '1010306010', '1010306010000001', 'BATERAI AAA', 23, 3),
(66, '115113', '1010305001', '1010305001000001', 'SAPU TAMAN PLASTIK', 0, 3),
(67, '115113', '1010305001', '1010305001000002', 'SAPU LIDI', 0, 3),
(68, '115113', '1010305001', '1010305001000003', 'SAPU AIR', 0, 3),
(69, '115113', '1010305001', '1010305001000004', 'SIKAT LANTAI PANJANG', 0, 3),
(70, '115113', '1010305001', '1010305001000005', 'SAPU IJUK', 0, 3),
(71, '115113', '1010305001', '1010305001000006', 'SAPU NILON', 0, 3),
(72, '115113', '1010305001', '1010305001000007', 'SIKAT WC PENDEK', 4, 3),
(73, '115113', '1010305001', '1010305001000008', 'SEROK', 0, 3),
(74, '115113', '1010305002', '1010305002000001', 'ALAT PEL LOBI 60CM', 0, 3),
(75, '115113', '1010305002', '1010305002000002', 'ALAT PEL LOBI 40CM', 0, 3),
(76, '115113', '1010305002', '1010305002000003', 'KANEBO SEDANG', 0, 3),
(77, '115113', '1010305002', '1010305002000004', 'LAP TANGAN', 0, 3),
(78, '115113', '1010305004', '1010305004000001', 'KESET KARET 40X65', 0, 3),
(79, '115113', '1010305004', '1010305004000002', 'KERANJANG SAMPAH KECIL', 0, 3),
(80, '115113', '1010305004', '1010305004000003', 'KERANJANG SAMPAH SEDANG', 0, 3),
(81, '115113', '1010305008', '1010305008000001', 'WIPOL 800 ML', 0, 4),
(82, '115113', '1010305008', '1010305008000002', 'KARBOL PEMBERSIH TOILET', 1, 4),
(83, '115113', '1010305008', '1010305008000003', 'PEMBERSIH SERANGGA ONE PUSH', 12, 4),
(84, '115113', '1010305008', '1010305008000004', 'PEMBERSIH SERANGGA BOTOL', 0, 4),
(85, '115113', '1010305008', '1010305008000005', 'PENCUCI PIRING', 2, 3),
(86, '115113', '1010305008', '1010305008000006', 'PEMBERSIH KACA', 2, 3),
(87, '115113', '1010305008', '1010305008000007', 'PEMBERSIH LANTAI KECIL', 0, 4),
(88, '115113', '1010305008', '1010305008000008', 'PEMBERSIH LANTAI SEDANG', 0, 4),
(89, '115113', '1010305008', '1010305008000009', 'SABUN CUCI TANGAN', 0, 4),
(90, '115113', '1010305008', '1010305008000010', 'PEMUTIH', 0, 4),
(91, '115113', '1010305008', '1010305008000011', 'ANTI KUMAN TANGAN 5 LITER', 0, 4),
(92, '115113', '1010305008', '1010305008000012', 'SABUN MOBIL', 0, 4),
(93, '115113', '1010305012', '1010305012000001', 'STELLA ALL IN ONE', 0, 3),
(95, '115113', '1010305999', '1010305999000002', 'PIGURA A4', 0, 3),
(96, '115113', '1010305999', '1010305999000003', 'PIGURA A3', 0, 3),
(97, '115113', '1010305999', '1010305999000004', 'CALL BELL', 0, 3),
(98, '115113', '1010305999', '1010305999000005', 'TISSU BASAH BOTOL', 0, 1),
(99, '115113', '1010305999', '1010305999000006', 'SPANDUK 1 (1X1)', 0, 3),
(100, '115113', '1010305999', '1010305999000007', 'SPANDUK 2 (2X1)', 0, 3),
(101, '115113', '1010305999', '1010305999000008', 'SPANDUK 3 (3X1)', 0, 3),
(102, '115113', '1010305999', '1010305999000009', 'SPANDUK 4 (4X1)', 0, 3),
(103, '115113', '1010305999', '1010305999000010', 'SPANDEK 5 (3X3)', 0, 3),
(104, '115113', '1010305999', '1010305999000011', 'SPANDUK 6 (5X3)', 0, 3),
(105, '115113', '1010305999', '1010305999000012', 'KEMOCENG', 2, 3),
(106, '115113', '1010305999', '1010305999000013', 'GANTUNGAN DINDING', 0, 3),
(119, '115113', '1010305999', '1010305999000001', 'TISSU NICE 900gr', 3, 1),
(121, '115111', '1010301999', '1010301999000014', 'GANTUNGAN KUNCI', 29, 3),
(122, '115111', '1010301013', '1010301013000003', 'ISI STAPLES NO. 24/6', 4, 5),
(123, '115111', '1010301013', '1010301013000002', 'ISI STAPLES NO. 23/17', 2, 5),
(124, '115111', '1010302999', '1010302999000005', 'PLASTIK WRAP', 0, 1),
(125, '115111', '1010301006', '1010301006000006', 'MAP BATIK', 0, 1),
(126, '115113', '1010305002', '1010305002000005', 'BUSA CUCI PIRING', 0, 3),
(127, '115113', '1010305004', '1010305004000004', 'TEMPAT TISSU', 0, 3),
(128, '115111', '1010301999', '1010301999000013', 'GLUE GUN', 0, 3),
(129, '115111', '1010302999', '1010302999000004', 'PLASTIK LAMINATING F4', 0, 1),
(130, '115111', '1010301999', '1010301999000012', 'ID CARD HOLDER', 5, 3),
(132, '115111', '1010301005', '1010301005000003', 'BUKU KUARTO', 0, 3),
(133, '115111', '1010301012', '1010301012000002', 'STAPLE REMOVER', 2, 3),
(134, '115111', '1010301001', '1010301001000008', 'ISI ULANG ERASABLE BALLPOINT', 1, 5),
(135, '115111', '1010301010', '1010301010000011', 'LEM LIQUID SUNWELL 50 ML', 1, 3),
(136, '115111', '1010301999', '1010301999000010', 'MINI CONTAINER', 0, 3),
(137, '115113', '1010305001', '1010305001000009', 'SIKAT BAJU', 0, 3),
(138, '115111', '1010301010', '1010301010000010', 'LEM STICK SEDANG 21 GRAM', 0, 3),
(139, '115111', '1010301003', '1010301003000005', 'BINDER CLIP NO. 260', 2, 5),
(140, '115113', '1010305012', '1010305012000002', 'PENGHARUM RUANGAN SEMPROT', 2, 4),
(141, '115111', '1010301007', '1010301007000002', 'MISTAR MIKA', 1, 3),
(142, '115111', '1010301001', '1010301001000010', 'STABILLO HIJAU', 2, 3),
(143, '115111', '1010301004', '1010301004000003', 'PENGHAPUS PENSIL', 0, 3),
(144, '115113', '1010305012', '1010305012000003', 'KAMPER TOILET BIASA', 0, 3),
(145, '115113', '1010305012', '1010305012000004', 'PENGHARUM KAMAR MANDI', 0, 3),
(146, '115111', '1010301001', '1010301001000009', 'SPIDOL BOARDMARKER WARNA', 6, 3),
(147, '115111', '1010301999', '1010301999000015', 'GUNTING BESAR', 4, 3),
(148, '115111', '1010301002', '1010301002000003', 'REFILL BOARDMARKER MERAH', 0, 4),
(149, '115111', '1010301003', '1010301003000007', 'BINDER CLIP NO. 107', 23, 5),
(150, '115111', '1010301003', '1010301003000006', 'BINDER CLIP NO. 111', 15, 5),
(151, '115111', '1010301004', '1010301004000002', 'PENGHAPUS WHITEBOARD', 2, 3),
(152, '115111', '1010302999', '1010302999000003', 'PLASTIK PEMBATAS (SHEET PROTECTOR)', 0, 3),
(153, '115111', '1010306010', '1010306010000003', 'BATERAI KOTAK', 0, 3),
(154, '115111', '1010306010', '1010306010000002', 'BATERAI A2', 22, 3),
(155, '115113', '1010305008', '10100800004', 'Pengusir serangga spray', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id` int(5) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id`, `kode`, `keterangan`) VALUES
(1, '115111', 'Barang Habis Pakai'),
(2, '115113', 'Barang Untuk Pemeliharaan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(5) NOT NULL,
  `kode_jenis` varchar(10) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `kode_jenis`, `kode`, `keterangan`) VALUES
(1, '115111', '1010301001', 'Alat Tulis'),
(2, '115111', '1010301002', 'Tinta Tulis, Tinta Stempel'),
(3, '115111', '1010301003', 'Penjepit Kertas'),
(4, '115111', '1010301004', 'Penghapus/Korektor'),
(5, '115111', '1010301005', 'Buku Tulis'),
(6, '115111', '1010301006', 'Ordner Dan Map'),
(7, '115111', '1010301007', 'Penggaris'),
(8, '115111', '1010301008', 'Cutter (Alat Tulis Kantor)'),
(9, '115111', '1010301010', 'Alat Perekat'),
(10, '115111', '1010301012', 'Staples'),
(11, '115111', '1010301013', 'Isi Staples'),
(12, '115111', '1010301999', 'Alat Tulis Kantor Lainnya'),
(13, '115111', '1010302001', 'Kertas HVS'),
(14, '115111', '1010302003', 'Kertas Cover'),
(15, '115111', '1010302004', 'Amplop'),
(16, '115111', '1010302999', 'Kertas Dan Cover Lainnya'),
(17, '115111', '1010304004', 'Tinta/Toner Printer'),
(18, '115111', '1010304006', 'USB/Flash Disk'),
(19, '115111', '1010306002', 'Lampu Listrik'),
(20, '115111', '1010306010', 'Batu Baterai'),
(21, '115113', '1010305001', 'Sapu Dan Sikat'),
(22, '115113', '1010305002', 'Alat-Alat Pel Dan Lap'),
(23, '115113', '1010305004', 'Keset Dan Tempat Sampah'),
(24, '115113', '1010305008', 'Bahan Kimia Untuk Pembersih'),
(25, '115113', '1010305012', 'Pengharum Ruangan'),
(37, '115113', '1010305999', 'Perabot Kantor lainya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `ref_pemesanan` varchar(100) NOT NULL,
  `no_bukti` varchar(30) DEFAULT NULL,
  `tgl_pemesanan` varchar(20) NOT NULL,
  `tgl_diterima` varchar(20) DEFAULT NULL,
  `id_status` int(5) NOT NULL DEFAULT 6,
  `total_qty_dipesan` int(5) NOT NULL DEFAULT 0,
  `total_qty_diterima` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`ref_pemesanan`, `no_bukti`, `tgl_pemesanan`, `tgl_diterima`, `id_status`, `total_qty_dipesan`, `total_qty_diterima`) VALUES
('O-20211214.1-18', '-', '2021-12-14', '2021-12-14', 8, 2, 2),
('O-20211214.2-18', '-', '2021-12-15', '2021-12-15', 8, 48, 48),
('O-20211220.3-18', '-', '2021-12-20', '2021-12-20', 8, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(5) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama_pemakai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `nip`, `nama_pemakai`) VALUES
(4, '199105172020121006', 'Ahyas Widyatmaka'),
(5, '197809112007041001', 'Muhammad Nasir'),
(6, '196802151992021001', 'Jumat Patipi'),
(7, '198007272012122004', 'Novia Dwi Kusumawati'),
(8, '198212312005021001', 'Eddy Waluyo'),
(9, '198809062014031005', 'Salamun Mustofa'),
(10, '198005222006041024', 'Muhammad Yamin Rabo'),
(11, '199407022017121001', 'Jumardin'),
(12, '198211032009041006', 'Muhammad Sopalatu'),
(13, '199511292017121002', 'Lauhin Mahfudz Kamil'),
(14, '199106102017121001', 'Mufty Hasan'),
(15, '199109022020121004', 'Zainal Pratama Sapta Yananda'),
(16, '199606092020121004', 'Yaser Arafat'),
(17, '198902212019031004', 'Abu Haider Tamima');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `no_referensi` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `result` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`no_referensi`, `id_user`, `result`) VALUES
('P-20211026.5-8', '8', 1),
('P-20211027.2-7', '7', 1),
('P-20211103.1-16', '16', 4),
('P-20211103.2-16', '16', 4),
('P-20211103.1-15', '15', 3),
('P-20211103.3-16', '16', 4),
('P-20211103.1-4', '4', 3),
('P-20211104.2-4', '4', 3),
('P-20211110.1-8', '8', 4),
('P-20211111.2-8', '8', 4),
('P-20211115.3-4', '4', 3),
('P-20211117.4-4', '4', 3),
('P-20211118.5-4', '4', 3),
('P-20211119.3-8', '8', 4),
('P-20211129.4-8', '8', 4),
('P-20211129.5-8', '8', 4),
('P-20211202.6-8', '8', 3),
('P-20211210.7-8', '8', 3),
('P-20211213.8-8', '8', 3),
('P-20211214.9-8', '8', 3),
('P-20211214.10-8', '8', 3),
('P-20211220.1-14', '14', 4),
('P-20211221.11-8', '8', 3),
('P-20211222.12-8', '8', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan`
--

CREATE TABLE `tb_permintaan` (
  `id_user` int(5) NOT NULL,
  `ref_permintaan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_diterima` varchar(20) DEFAULT NULL,
  `id_status` int(5) NOT NULL DEFAULT 1,
  `total_qty_diminta` int(5) NOT NULL,
  `total_qty_dikeluarkan` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_permintaan`
--

INSERT INTO `tb_permintaan` (`id_user`, `ref_permintaan`, `tanggal`, `tgl_diterima`, `id_status`, `total_qty_diminta`, `total_qty_dikeluarkan`) VALUES
(15, 'P-20211103.1-15', '2021-11-03', '2021-11-03', 8, 1, 1),
(16, 'P-20211103.1-16', '2021-11-03', '2021-11-03', 8, 1, 1),
(4, 'P-20211103.1-4', '2021-11-04', '2021-11-03', 8, 1, 1),
(16, 'P-20211103.2-16', '2021-11-03', '2021-11-03', 8, 4, 4),
(16, 'P-20211103.3-16', '2021-11-03', '2021-11-03', 8, 1, 1),
(4, 'P-20211104.2-4', '2021-11-04', '2021-11-04', 8, 1, 1),
(8, 'P-20211110.1-8', '2021-11-10', '2021-11-10', 8, 1, 1),
(8, 'P-20211111.2-8', '2021-11-11', '2021-11-11', 8, 1, 1),
(4, 'P-20211115.3-4', '2021-11-15', '2021-11-15', 8, 1, 1),
(4, 'P-20211117.4-4', '2021-11-18', '2021-11-17', 8, 2, 2),
(4, 'P-20211118.5-4', '2021-11-18', '2021-11-17', 8, 2, 2),
(8, 'P-20211119.3-8', '2021-11-19', '2021-11-19', 8, 2, 2),
(8, 'P-20211129.4-8', '2021-11-29', '2021-11-29', 8, 1, 1),
(8, 'P-20211129.5-8', '2021-11-29', '2021-11-29', 8, 1, 1),
(8, 'P-20211202.6-8', '2021-12-03', '2021-12-02', 8, 1, 1),
(8, 'P-20211210.7-8', '2021-12-10', '2021-12-10', 8, 1, 1),
(16, 'P-20211212.4-16', '2021-12-13', NULL, 2, 1, 1),
(8, 'P-20211213.8-8', '2021-12-13', '2021-12-13', 8, 1, 1),
(8, 'P-20211214.10-8', '2021-12-15', '2021-12-14', 8, 2, 2),
(8, 'P-20211214.9-8', '2021-12-14', '2021-12-14', 8, 1, 1),
(14, 'P-20211220.1-14', '2021-12-20', '2021-12-20', 8, 1, 1),
(8, 'P-20211221.11-8', '2021-12-21', '2021-12-21', 8, 1, 1),
(8, 'P-20211222.12-8', '2021-12-22', '2021-12-22', 8, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_penilaian`
--

CREATE TABLE `tb_ref_penilaian` (
  `id` int(5) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ref_penilaian`
--

INSERT INTO `tb_ref_penilaian` (`id`, `keterangan`) VALUES
(1, 'Tidak puas'),
(2, 'Kurang puas'),
(3, 'Puas'),
(4, 'Sangat puas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_satuan`
--

CREATE TABLE `tb_ref_satuan` (
  `id` int(5) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ref_satuan`
--

INSERT INTO `tb_ref_satuan` (`id`, `nama`, `keterangan`) VALUES
(1, 'PAK', ''),
(2, 'KARTON', ''),
(3, 'PCS', ''),
(4, 'BOTOL', ''),
(5, 'BOX', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_status`
--

CREATE TABLE `tb_ref_status` (
  `id` int(5) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ref_status`
--

INSERT INTO `tb_ref_status` (`id`, `keterangan`) VALUES
(1, 'Menunggu konfirmasi'),
(2, 'Diproses'),
(3, 'Diterima'),
(4, 'Ditolak'),
(5, 'Dibatalkan'),
(6, 'Verified'),
(7, 'Not verified'),
(8, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `nama`, `keterangan`) VALUES
(1, 'admin', 'Admin gudang'),
(2, 'user', 'User'),
(3, 'kasubag kepegawaian', 'Kasubag kepegawaian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stock_opname`
--

CREATE TABLE `tb_stock_opname` (
  `no_ref` varchar(20) NOT NULL,
  `tanggal` varchar(15) NOT NULL,
  `tot_qty_sistem` int(10) NOT NULL,
  `tot_qty_gudang` int(10) NOT NULL,
  `tot_selisih` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_stock_opname`
--

INSERT INTO `tb_stock_opname` (`no_ref`, `tanggal`, `tot_qty_sistem`, `tot_qty_gudang`, `tot_selisih`) VALUES
('S-20211110.1', '10/11/2021', 35, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(5) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `nama_supplier`, `alamat`) VALUES
(1, 'Mega media', 'Kaimana');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_pemesanan`
--

CREATE TABLE `tb_transaksi_pemesanan` (
  `id` int(5) NOT NULL,
  `ref_pemesanan` varchar(100) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `id_status` int(5) NOT NULL,
  `qty_dipesan` int(5) NOT NULL,
  `qty_diterima` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_pemesanan`
--

INSERT INTO `tb_transaksi_pemesanan` (`id`, `ref_pemesanan`, `kode_barang`, `id_status`, `qty_dipesan`, `qty_diterima`) VALUES
(3, 'O-20211214.1-18', '10100800004', 6, 2, 2),
(6, 'O-20211220.3-18', '1010301006000004', 6, 2, 2),
(1, 'O-20211120.1-18', '1010301999000007', 6, 2, 2),
(2, 'O-20211120.1-18', '1010305002000004', 6, 5, 5),
(5, 'O-20211214.2-18', '1010306010000001', 6, 24, 24),
(4, 'O-20211214.2-18', '1010306010000002', 6, 24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_permintaan`
--

CREATE TABLE `tb_transaksi_permintaan` (
  `id` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `ref_permintaan` varchar(100) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `id_status` int(5) NOT NULL,
  `qty_diminta` int(5) NOT NULL,
  `qty_dikeluarkan` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_permintaan`
--

INSERT INTO `tb_transaksi_permintaan` (`id`, `id_user`, `ref_permintaan`, `kode_barang`, `id_status`, `qty_diminta`, `qty_dikeluarkan`) VALUES
(22, 8, 'P-20211214.9-8', '10100800004', 6, 1, 1),
(14, 8, 'P-20211119.3-8', '1010301001000002', 6, 1, 1),
(15, 8, 'P-20211119.3-8', '1010301001000003', 6, 1, 1),
(27, 8, 'P-20211222.12-8', '1010301003000003', 6, 1, 1),
(1, 16, 'P-20211103.1-16', '1010301010000001', 6, 1, 1),
(5, 16, 'P-20211103.2-16', '1010301010000005', 7, 2, 0),
(6, 16, 'P-20211103.3-16', '1010301010000005', 6, 1, 1),
(20, 16, 'P-20211212.4-16', '1010301010000011', 6, 1, 1),
(4, 15, 'P-20211103.1-15', '1010301999000005', 6, 1, 1),
(8, 4, 'P-20211104.2-4', '1010302001000001', 6, 1, 1),
(9, 8, 'P-20211110.1-8', '1010302001000001', 6, 1, 1),
(10, 8, 'P-20211111.2-8', '1010302001000001', 6, 1, 1),
(11, 4, 'P-20211115.3-4', '1010302001000001', 6, 1, 1),
(25, 8, 'P-20211221.11-8', '1010302001000001', 6, 1, 1),
(26, 8, 'P-20211222.12-8', '1010302001000001', 6, 1, 1),
(3, 16, 'P-20211103.2-16', '1010304004000001', 6, 1, 1),
(19, 8, 'P-20211210.7-8', '1010304004000001', 6, 1, 1),
(2, 16, 'P-20211103.2-16', '1010304004000002', 6, 3, 3),
(21, 8, 'P-20211213.8-8', '1010305008000002', 6, 1, 1),
(7, 4, 'P-20211103.1-4', '1010305999000001', 6, 1, 1),
(18, 8, 'P-20211202.6-8', '1010305999000001', 6, 1, 1),
(24, 14, 'P-20211220.1-14', '1010306010000001', 6, 1, 1),
(12, 4, 'P-20211117.4-4', '1010306010000002', 6, 2, 2),
(13, 4, 'P-20211118.5-4', '1010306010000002', 6, 2, 2),
(16, 8, 'P-20211129.4-8', '1010306010000002', 6, 1, 1),
(17, 8, 'P-20211129.5-8', '1010306010000002', 6, 1, 1),
(23, 8, 'P-20211214.10-8', '1010306010000002', 6, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_stock_opname`
--

CREATE TABLE `tb_transaksi_stock_opname` (
  `no_ref` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty_sistem` int(5) NOT NULL,
  `qty_gudang` int(5) NOT NULL,
  `selisih` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_stock_opname`
--

INSERT INTO `tb_transaksi_stock_opname` (`no_ref`, `kode_barang`, `qty_sistem`, `qty_gudang`, `selisih`) VALUES
('S-20211110.1', '1010305008000003', 12, 12, 0),
('S-20211110.1', '1010301001000003', 13, 13, 0),
('S-20211110.1', '1010301010000007', 11, 11, 0),
('S-20211110.1', '1010301001000002', 14, 14, 0),
('S-20211110.1', '1010302001000001', 19, 19, 0),
('S-20211110.1', '1010301001000007', 8, 8, 0),
('S-20211110.1', '1010301003000007', 23, 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(5) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Ahyas Widyatmaka', '199105172020121006', '$2y$10$0OKfLN.8iW9GwftP03xpPOEW7reg8bqHw.u00N/76YFl.NfciyPCm', 2, NULL, NULL, NULL),
(5, 'Muhammad Nasir', '197809112007041001', '$2y$10$.hkVLj.U16R/pPpmygkzWepuE4SgoLTB6vZE3q5n5M3A6HIvcTKpC', 2, NULL, NULL, NULL),
(6, 'Jumat Patipi', '196802151992021001', '$2y$10$bao.rAsnatqUyRmjGyLKvOk0ry6l.Hp3Fd1ASH7HKacQZDH0H8Clq', 2, NULL, NULL, NULL),
(7, 'Novia Dwi Kusumawati', '198007272012122004', '$2y$10$eXnWePJMCE6LuLXLcF.NsuesYIOIixzFyuDoykDmda6971hxYVuZq', 2, NULL, NULL, NULL),
(8, 'Eddy Waluyo', '198212312005021001', '$2y$10$HFQCeyhcBpJyPaklW2annOSARHgZyYvuW73r9CS51Eo0kWjfJTi4q', 2, NULL, NULL, NULL),
(9, 'Salamun Mustofa', '198809062014031005', '$2y$10$ZVHyicevhwWaAxcsBCI9u.8GvlsXjPFOPFz./QqPrrnj0zYI7Cu5C', 2, NULL, NULL, NULL),
(10, 'Muhammad Yamin Rabo', '198005222006041024', '$2y$10$cPAvpMcHEDiwz5hpMIC5/.EQ1USnVcgXEk6fc65U3oGDMyNYIzH76', 2, NULL, NULL, NULL),
(11, 'Jumardin', '199407022017121001', '$2y$10$.iCgRQiXyh0GKUZUmYfvBOtEDOh8oF8yBA.TP9pUZddT0M4TA2pWa', 2, NULL, NULL, NULL),
(13, 'Lauhin Mahfudz Kamil', '199511292017121002', '$2y$10$RgE.uTXLlrqlJEE/eq0gxu9BG.0TjQIa/MrzFu/Smd27q3gH04Gw.', 2, NULL, NULL, NULL),
(14, 'Muhammad Sopalatu', '198211032009041006', '$2y$10$FDVLhucNwQRXJLneb2uIzOFZxtfahR1I6AeKCCbpBSvplRZQuLO9u', 2, NULL, NULL, NULL),
(15, 'Zainal Pratama Sapta Yananda', '199109022020121004', '$2y$10$UnLQ6vd7tKTcxcPCut9A2uj87a1PgTsS46BKRvolVk1uZHSYxrCL2', 2, NULL, NULL, NULL),
(16, 'Yaser Arafat', '199606092020121004', '$2y$10$z8EjSIMxk4zNdm//E5xpIekaCm4xLPp/Cj/OOXGVTgQCroYOVqSmu', 2, NULL, NULL, NULL),
(17, 'Abu Haider Tamima', '198902212019031004', '$2y$10$cPlQV7P65vDZSEoQRdMJrO6PfsXGV4PykwzE/sl3zylgcVrYWT27W', 2, NULL, NULL, NULL),
(18, 'Admin', 'admin', '$2y$10$04f3Ye0.NglKHqTInAv32eTRmqP7hn8et1vTBmhNjJgKRY18.7oTC', 1, NULL, NULL, NULL),
(22, 'Paijo', 'paijo@gmail.com', '$2y$10$3mAyg3isGcuxFX.qBBZZiuoWLKc6Rc0fBPdLffp5R73TLGbv1mdxO', 2, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_daftar_barang`
--
ALTER TABLE `tb_daftar_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`ref_pemesanan`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`no_referensi`);

--
-- Indexes for table `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  ADD PRIMARY KEY (`ref_permintaan`);

--
-- Indexes for table `tb_ref_penilaian`
--
ALTER TABLE `tb_ref_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ref_satuan`
--
ALTER TABLE `tb_ref_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ref_status`
--
ALTER TABLE `tb_ref_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_stock_opname`
--
ALTER TABLE `tb_stock_opname`
  ADD PRIMARY KEY (`no_ref`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi_pemesanan`
--
ALTER TABLE `tb_transaksi_pemesanan`
  ADD UNIQUE KEY `kode_barang` (`kode_barang`,`ref_pemesanan`);

--
-- Indexes for table `tb_transaksi_permintaan`
--
ALTER TABLE `tb_transaksi_permintaan`
  ADD UNIQUE KEY `kode_barang` (`kode_barang`,`ref_permintaan`);

--
-- Indexes for table `tb_transaksi_stock_opname`
--
ALTER TABLE `tb_transaksi_stock_opname`
  ADD UNIQUE KEY `no_ref` (`no_ref`,`kode_barang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_daftar_barang`
--
ALTER TABLE `tb_daftar_barang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_ref_penilaian`
--
ALTER TABLE `tb_ref_penilaian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_ref_satuan`
--
ALTER TABLE `tb_ref_satuan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_ref_status`
--
ALTER TABLE `tb_ref_status`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
