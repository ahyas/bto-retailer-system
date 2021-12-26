-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 07:26 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbscm`
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
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_daftar_barang`
--

INSERT INTO `tb_daftar_barang` (`id`, `kode_jenis`, `kode_kategori`, `kode_barang`, `nama_barang`, `stock`) VALUES
(1, '115111', '1010301001', '1010301001000001', 'STABILLO', 0),
(5, '115111', '1010301001', '1010301001000002', 'BALLPOINT BIASA', 0),
(6, '115111', '1010301001', '1010301001000003', 'BALLPOINT TANDA TANGAN', 0),
(7, '115111', '1010301001', '1010301001000004', 'SPIDOL BOARDMARKER SEDANG', 0),
(8, '115111', '1010301001', '1010301001000005', 'SPIDOL KECIL', 0),
(9, '115111', '1010301001', '1010301001000006', 'MAP PLASTIK KANCING', 0),
(10, '115111', '1010301001', '1010301001000007', 'PENSIL', 0),
(11, '115111', '1010301002', '1010301002000001', 'TINTA STEMPEL', 0),
(12, '115111', '1010301002', '1010301002000002', 'REFILL BOARDMARKER', 0),
(13, '115111', '1010301003', '1010301003000001', 'BINDER CLIP NO. 105', 0),
(14, '115111', '1010301003', '1010301003000002', 'BINDER CLIP NO. 155', 0),
(15, '115111', '1010301003', '1010301003000003', 'TRIGONAL CLIPS', 0),
(16, '115111', '1010301003', '1010301003000004', 'BINDER CLIP NO. 200', 0),
(17, '115111', '1010301004', '1010301004000001', 'PENGHAPUS PEN', 0),
(18, '115111', '1010301005', '1010301005000001', 'BUKU FOLIO', 0),
(19, '115111', '1010301005', '1010301005000002', 'BUKU EKSPEDISI', 0),
(20, '115111', '1010301006', '1010301006000001', 'MAP PLASTIK JEPIT', 0),
(21, '115111', '1010301006', '1010301006000002', 'MAP PLASTIK SNELHECTER', 0),
(22, '115111', '1010301006', '1010301006000003', 'MAP PLASTIK SPRING', 0),
(23, '115111', '1010301006', '1010301006000004', 'ORDNER BESAR', 0),
(24, '115111', '1010301006', '1010301006000005', 'MAP KERTAS', 0),
(25, '115111', '1010301007', '1010301007000001', 'MISTAR BESI 30 CM', 0),
(26, '115111', '1010301008', '1010301008000001', 'CUTTER L-500', 0),
(27, '115111', '1010301008', '1010301008000002', 'ISI CUTTER L-150', 0),
(28, '115111', '1010301010', '1010301010000001', 'LEM STICK 40 GRAM', 0),
(29, '115111', '1010301010', '1010301010000002', 'LAKBAN BENING BESAR', 0),
(30, '115111', '1010301010', '1010301010000003', 'LAKBAN BENING SEDANG', 0),
(31, '115111', '1010301010', '1010301010000004', 'LAKBAN BENING KECIL', 0),
(32, '115111', '1010301010', '1010301010000005', 'LAKBAN HITAM BESAR', 0),
(33, '115111', '1010301010', '1010301010000006', 'DOUBLE TAPE BESAR', 0),
(34, '115111', '1010301010', '1010301010000007', 'DOUBLE TAPE KECIL', 0),
(35, '115111', '1010301010', '1010301010000008', 'LAKBAN HITAM SEDANG', 0),
(36, '115111', '1010301010', '1010301010000009', 'LEM FOX 800 GRAM', 0),
(37, '115111', '1010301012', '1010301012000001', 'STAPLES HD-10', 0),
(38, '115111', '1010301013', '1010301013000001', 'ISI STAPLES NO. 10', 0),
(39, '115111', '1010301999', '1010301999000001', 'STICKY NOTE 3M', 0),
(40, '115111', '1010301999', '1010301999000002', 'STICKY NOTE TTD', 0),
(41, '115111', '1010301999', '1010301999000003', 'STICKY NOTE MEMO PAPER', 0),
(42, '115111', '1010301999', '1010301999000004', 'GUNTING KECIL', 0),
(43, '115111', '1010301999', '1010301999000005', 'STAPLES JILID', 0),
(44, '115111', '1010301999', '1010301999000006', 'ISI LEM TEMBAK BESAR', 0),
(45, '115111', '1010301999', '1010301999000007', 'RAUTAN PENSIL MEJA', 0),
(46, '115111', '1010301999', '1010301999000008', 'BUKU KUITANSI', 0),
(47, '115111', '1010301999', '1010301999000009', 'TEMPAT PENA', 0),
(48, '115111', '1010302001', '1010302001000001', 'KERTAS A4', 0),
(49, '115111', '1010302001', '1010302001000002', 'KERTAS F4', 0),
(50, '115111', '1010302001', '1010302001000003', 'KERTAS A3', 0),
(51, '115111', '1010302003', '1010302003000001', 'KERTAS COVER F4', 0),
(52, '115111', '1010302004', '1010302004000001', 'AMPLOP COKELAT KECIL', 0),
(53, '115111', '1010302004', '1010302004000002', 'AMPLOP COKELAT BESAR', 0),
(54, '115111', '1010302004', '1010302004000003', 'AMPLOP PUTIH', 0),
(55, '115111', '1010302999', '1010302999000001', 'PLASTIK JILID MIKA', 0),
(56, '115111', '1010302999', '1010302999000002', 'KERTAS FOTO A4', 0),
(57, '115111', '1010304004', '1010304004000001', 'TINTA BOTOL EPSON HITAM', 0),
(58, '115111', '1010304004', '1010304004000002', 'TINTA BOTOL EPSON WARNA', 0),
(59, '115111', '1010304004', '1010304004000003', 'CARTRIDGE', 0),
(60, '115111', '1010304004', '1010304004000004', 'TINTA PRINTER A3 HITAM', 0),
(61, '115111', '1010304004', '1010304004000005', 'TINTA PRINTER A3 WARNA', 0),
(62, '115111', '1010304006', '1010304006000001', 'FLASHDISK 16 GB', 0),
(63, '115111', '1010306002', '1010306002000001', 'LAMPU 10 WATT', 0),
(64, '115111', '1010306002', '1010306002000002', 'LAMPU 12 WATT', 0),
(65, '115111', '1010306010', '1010306010000001', 'BATERAI A3', 11),
(66, '115113', '1010305001', '1010305001000001', 'SAPU TAMAN PLASTIK', 0),
(67, '115113', '1010305001', '1010305001000002', 'SAPU LIDI', 0),
(68, '115113', '1010305001', '1010305001000003', 'SAPU AIR', 0),
(69, '115113', '1010305001', '1010305001000004', 'SIKAT LANTAI PANJANG', 0),
(70, '115113', '1010305001', '1010305001000005', 'SAPU IJUK', 0),
(71, '115113', '1010305001', '1010305001000006', 'SAPU NILON', 0),
(72, '115113', '1010305001', '1010305001000007', 'SIKAT WC PENDEK', 0),
(73, '115113', '1010305001', '1010305001000008', 'SEROK', 0),
(74, '115113', '1010305002', '1010305002000001', 'ALAT PEL LOBI 60CM', 0),
(75, '115113', '1010305002', '1010305002000002', 'ALAT PEL LOBI 40CM', 0),
(76, '115113', '1010305002', '1010305002000003', 'KANEBO SEDANG', 0),
(77, '115113', '1010305002', '1010305002000004', 'LAP TANGAN', 0),
(78, '115113', '1010305004', '1010305004000001', 'KESET KARET 40X65', 0),
(79, '115113', '1010305004', '1010305004000002', 'KERANJANG SAMPAH KECIL', 0),
(80, '115113', '1010305004', '1010305004000003', 'KERANJANG SAMPAH SEDANG', 0),
(81, '115113', '1010305008', '1010305008000001', 'WIPOL 800 ML', 0),
(82, '115113', '1010305008', '1010305008000002', 'PROSTEX 500 ML', 0),
(83, '115113', '1010305008', '1010305008000003', 'PEMBERSIH SERANGGA ONE PUSH', 0),
(84, '115113', '1010305008', '1010305008000004', 'PEMBERSIH SERANGGA BOTOL', 0),
(85, '115113', '1010305008', '1010305008000005', 'PENCUCI PIRING', 15),
(86, '115113', '1010305008', '1010305008000006', 'PEMBERSIH KACA', 0),
(87, '115113', '1010305008', '1010305008000007', 'PEMBERSIH LANTAI KECIL', 0),
(88, '115113', '1010305008', '1010305008000008', 'PEMBERSIH LANTAI SEDANG', 0),
(89, '115113', '1010305008', '1010305008000009', 'SABUN CUCI TANGAN', 0),
(90, '115113', '1010305008', '1010305008000010', 'PEMUTIH', 1),
(91, '115113', '1010305008', '1010305008000011', 'ANTI KUMAN TANGAN 5 LITER', 0),
(92, '115113', '1010305008', '1010305008000012', 'SABUN MOBIL', 0),
(93, '115113', '1010305012', '1010305012000001', 'STELLA ALL IN ONE', 5),
(94, '115113', '1010305999', '1010305999000001', 'TISSU MULTI MP-03', 8),
(95, '115113', '1010305999', '1010305999000002', 'PIGURA A4', 0),
(96, '115113', '1010305999', '1010305999000003', 'PIGURA A3', 0),
(97, '115113', '1010305999', '1010305999000004', 'CALL BELL', 0),
(98, '115113', '1010305999', '1010305999000005', 'TISSU BASAH BOTOL', 0),
(99, '115113', '1010305999', '1010305999000006', 'SPANDUK 1 (1X1)', 0),
(100, '115113', '1010305999', '1010305999000007', 'SPANDUK 2 (2X1)', 0),
(101, '115113', '1010305999', '1010305999000008', 'SPANDUK 3 (3X1)', 0),
(102, '115113', '1010305999', '1010305999000009', 'SPANDUK 4 (4X1)', 0),
(103, '115113', '1010305999', '1010305999000010', 'SPANDEK 5 (3X3)', 0),
(104, '115113', '1010305999', '1010305999000011', 'SPANDUK 6 (5X3)', 0),
(105, '115113', '1010305999', '1010305999000012', 'KEMOCENG', 0),
(106, '115113', '1010305999', '1010305999000013', 'GANTUNGAN DINDING', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_inventory`
--

CREATE TABLE `tb_inventory` (
  `id` int(5) NOT NULL,
  `barcode` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `stock` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_inventory`
--

INSERT INTO `tb_inventory` (`id`, `barcode`, `nama_barang`, `id_kategori`, `stock`) VALUES
(5, NULL, 'BALLPOINT STANDARD E-7', 1, '1'),
(6, NULL, 'BALLPOINT STANDARD PRO BOLDLINER', 1, '1'),
(7, NULL, 'BALLPOINT FASTER C-600', 1, '1'),
(8, NULL, 'BALLPOINT PILOT BALLLINER', 0, '1'),
(9, NULL, 'BALLPOINT GEL PEN JOYKO', 0, '1'),
(10, NULL, 'BALLPOINT JOYKO BETA 0,7', 0, '0'),
(11, NULL, 'BALLPOINT ESCO WIN 0,7', 0, '0'),
(12, NULL, 'BALLPOINT JOYKO 1OOO', 0, '0'),
(13, NULL, 'BALLPOINT BOXY', 0, '0'),
(14, NULL, 'SPIDOL SNOWMAN WHITE BOARD MARKER', 0, '0'),
(15, NULL, 'SPIDOL SNOWMAN MARKER BESAR', 0, '0'),
(16, NULL, 'SPIDOL SNOWMAN MARKER KECIL', 1, '0'),
(17, NULL, 'PENSIL 2B JOYKO R-88', 1, '0'),
(18, NULL, 'PENSIL 2B JOYKO R-93', 1, '0'),
(19, NULL, 'PENSIL FABER CASTELL SET STANDAR', 1, '0'),
(20, NULL, 'PENSIL FABER CASTELL PAKET UJIAN MANTAP', 1, '0'),
(21, NULL, 'PENSIL MEKANIK JOYKO 2B 0,5', 1, '0'),
(22, NULL, 'PENSIL MEKANIK JOYKO 2B 0,7', 1, '0'),
(23, NULL, 'PENSIL MEKANIK JOYKO 2B 1,0', 1, '0'),
(24, NULL, 'ISI PENSIL MEKANIK JOYKO PL-05 2B 0,5', 1, '0'),
(25, NULL, 'ISI PENSIL MEKANIK JOYKO PL-07 2B 0,7', 1, '0'),
(26, NULL, 'ISI PENSIL MEKANIK JOYKO PL-10 2B 2,0 X 90 MM', 1, '0'),
(27, NULL, 'ISI PENSIL MEKANIK JOYKO PL-16 2B 2,0 X 120 MM', 1, '0'),
(28, NULL, 'PENSIL MEKANIK JOYKO MP-39', 1, '0'),
(29, NULL, 'PENSIL MEKANIK JOYKO MP-29', 1, '0'),
(30, NULL, 'GUNTING JOYKO SC-838JA', 1, '0'),
(31, NULL, 'GUNTING JOYKO SC-838', 1, '0'),
(32, NULL, 'GUNTING GUNINDO OMM', 1, '0'),
(33, NULL, 'BISNIS FILE MICRO SNEL', 1, '0'),
(34, NULL, 'MAP PLASTIK KANCING', 1, '0'),
(35, NULL, 'MAP BIOLA 5001', 1, '0'),
(36, NULL, 'MAP BIOLA 5002', 1, '0'),
(37, NULL, 'MAP KABITA', 1, '0'),
(38, NULL, 'PENGGARIS BESI 30 CM', 1, '0'),
(39, NULL, 'PENGGARIS BESI 50 CM', 1, '0'),
(40, NULL, 'PENGGARIS BETERFLY 30 CM', 1, '0'),
(41, NULL, 'PENGGARIS BETERFLY 20 CM', 1, '0'),
(42, NULL, 'PENGGARIS BETERFLY SEGITIGA NO.8', 1, '0'),
(43, NULL, 'CLEAR HOLDER ISI 20 MIKRO', 1, '0'),
(44, NULL, 'CLEAR HOLDER ISI 40 MIKRO', 1, '0'),
(45, NULL, 'CALCULATOR SAKU KAWACHI', 1, '0');

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
  `kode` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `kode`, `keterangan`) VALUES
(1, '1010301001', 'Alat Tulis'),
(2, '1010301002', 'Tinta Tulis, Tinta Stempel'),
(3, '1010301003', 'Penjepit Kertas'),
(4, '1010301004', 'Penghapus/Korektor'),
(5, '1010301005', 'Buku Tulis'),
(6, '1010301006', 'Ordner Dan Map'),
(7, '1010301007', 'Penggaris'),
(8, '1010301008', 'Cutter (Alat Tulis Kantor)'),
(9, '1010301010', 'Alat Perekat'),
(10, '1010301012', 'Staples'),
(11, '1010301013', 'Isi Staples'),
(12, '1010301999', 'Alat Tulis Kantor Lainnya'),
(13, '1010302001', 'Kertas HVS'),
(14, '1010302003', 'Kertas Cover'),
(15, '1010302004', 'Amplop'),
(16, '1010302999', 'Kertas Dan Cover Lainnya'),
(17, '1010304004', 'Tinta/Toner Printer'),
(18, '1010304006', 'USB/Flash Disk'),
(19, '1010306002', 'Lampu Listrik'),
(20, '1010306010', 'Batu Baterai'),
(21, '1010305001', 'Sapu Dan Sikat'),
(22, '1010305002', 'Alat-Alat Pel Dan Lap'),
(23, '1010305004', 'Keset Dan Tempat Sampah'),
(24, '1010305008', 'Bahan Kimia Untuk Pembersih'),
(25, '1010305012', 'Pengharum Ruangan'),
(26, '1010305999', 'Perabot Kantor Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemakaian`
--

CREATE TABLE `tb_pemakaian` (
  `tanggal_keluar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ref_pemakaian` varchar(10) NOT NULL,
  `id_penerima` int(5) NOT NULL,
  `total_qty` int(5) NOT NULL,
  `harga_pokok` bigint(10) NOT NULL,
  `total_nilai` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pemakaian`
--

INSERT INTO `tb_pemakaian` (`tanggal_keluar`, `ref_pemakaian`, `id_penerima`, `total_qty`, `harga_pokok`, `total_nilai`) VALUES
('2021-06-08 16:56:38', '1', 1, 2, 0, 0),
('2021-06-08 20:28:30', '2', 5, 1, 0, 0),
('2021-06-08 21:02:26', '3', 4, 2, 0, 0),
('2021-06-08 22:15:32', '4', 4, 2, 0, 0),
('2021-06-09 15:53:34', '5', 6, 2, 0, 0),
('2021-06-09 15:58:04', '6', 1, 1, 0, 0),
('2021-06-09 16:09:58', '7', 1, 4, 0, 0),
('2021-06-09 16:50:25', '8', 5, 1, 0, 0),
('2021-06-09 17:14:08', '9', 4, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `ref_pembelian` varchar(10) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `total_qty` int(5) NOT NULL,
  `harga_pokok` bigint(10) NOT NULL,
  `total_nilai` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`ref_pembelian`, `tanggal_masuk`, `total_qty`, `harga_pokok`, `total_nilai`) VALUES
('1', '2021-06-09 01:55:17', 10, 0, 0),
('2', '2021-06-09 06:01:45', 6, 0, 0),
('3', '2021-06-09 07:14:17', 15, 0, 0),
('4', '2021-06-10 02:31:43', 25, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(5) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_pemakai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `nip`, `nama_pemakai`) VALUES
(1, '199105172020121006', 'AHYAS WIDYATMAKA, A.Md'),
(3, '199109022020121004', 'ZAINAL PRATAMA SAPTA YANANDA, S.Kom                                                                 '),
(4, '199606092020121004', 'YASER ARAFAT, S.H'),
(5, '199106102017121001', 'MUFTY HASAN, S.Sy.                                                                                  '),
(6, '199407022017121001', 'JUMARDIN, S.H.'),
(7, '199510022017121004', 'Muhammad Ibadurrohman Al Hasyimi, S.H.'),
(8, '199511292017121002', 'Lauhin Mahfudz Kamil, S.H.'),
(9, '198005222006041024', 'MUHAMMAD YAMIN RABO'),
(10, '198809062014031005', 'SALAMUN MUSTOFA,S.HI'),
(11, '198007272012122004', 'NOVIA DWI KUSUMAWATI, SH'),
(12, '198212312005021001', 'EDDY WALUYO'),
(13, '197809112007041001', 'MUHAMMAD NASIR, S.H.I.,M.H'),
(14, '196802151992021001', 'JUMAT PATIPI, S.Ag.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(5) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `nama_satuan`, `keterangan`) VALUES
(1, 'Unit', ''),
(2, 'Pak', ''),
(3, 'Roll', ''),
(4, 'Set', ''),
(5, 'Buah', ''),
(6, 'None', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(5) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_pemakaian`
--

CREATE TABLE `tb_transaksi_pemakaian` (
  `kode_barang` varchar(20) NOT NULL,
  `ref_pemakaian` varchar(10) NOT NULL,
  `qty` int(5) NOT NULL,
  `subtotal` bigint(10) NOT NULL,
  `harga_satuan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_pemakaian`
--

INSERT INTO `tb_transaksi_pemakaian` (`kode_barang`, `ref_pemakaian`, `qty`, `subtotal`, `harga_satuan`) VALUES
('1010305999000001', '4', 2, 0, 0),
('1010306002000001', '3', 2, 0, 0),
('1010306002000001', '6', 1, 0, 0),
('1010306002000001', '7', 1, 0, 0),
('1010306002000001', '8', 1, 0, 0),
('1010306002000002', '1', 1, 0, 0),
('1010306002000002', '2', 1, 0, 0),
('1010306002000002', '5', 1, 0, 0),
('1010306002000002', '7', 2, 0, 0),
('1010306010000001', '1', 1, 0, 0),
('1010306010000001', '5', 1, 0, 0),
('1010306010000001', '7', 1, 0, 0),
('1010306010000001', '9', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_pembelian`
--

CREATE TABLE `tb_transaksi_pembelian` (
  `kode_barang` varchar(20) NOT NULL,
  `ref_pembelian` varchar(10) NOT NULL,
  `harga_satuan` float NOT NULL,
  `qty` int(5) NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_pembelian`
--

INSERT INTO `tb_transaksi_pembelian` (`kode_barang`, `ref_pembelian`, `harga_satuan`, `qty`, `subtotal`) VALUES
('1010305008000005', '4', 0, 15, 0),
('1010305008000010', '2', 0, 1, 0),
('1010305012000001', '3', 0, 5, 0),
('1010305999000001', '3', 0, 10, 0),
('1010306002000001', '2', 0, 5, 0),
('1010306002000002', '1', 0, 5, 0),
('1010306010000001', '1', 0, 10, 0),
('1010306010000001', '4', 0, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahyas Widyatmaka', 'ahyasw@gmail.com', '2021-05-06 17:04:51', '$2y$10$hNN8KQ4sXGu89HNi.0izxuudCptO4MNBKRxvPNrpcuV/1RDVjSfzu', NULL, NULL, NULL),
(2, 'Admin', 'admin@myproject.dev', '2021-05-06 17:13:26', '$2y$10$9Nds41OjGv14Hqn2GkgpGOft/VwLwrC8HDFWfSAKd92JgTtuJiFDm', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_daftar_barang`
--
ALTER TABLE `tb_daftar_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
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
-- Indexes for table `tb_pemakaian`
--
ALTER TABLE `tb_pemakaian`
  ADD PRIMARY KEY (`ref_pemakaian`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`ref_pembelian`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi_pemakaian`
--
ALTER TABLE `tb_transaksi_pemakaian`
  ADD UNIQUE KEY `kode_barang` (`kode_barang`,`ref_pemakaian`);

--
-- Indexes for table `tb_transaksi_pembelian`
--
ALTER TABLE `tb_transaksi_pembelian`
  ADD UNIQUE KEY `kode_barang` (`kode_barang`,`ref_pembelian`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
