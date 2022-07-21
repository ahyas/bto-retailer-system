-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2022 at 02:54 PM
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
-- Database: `db_backtooffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(5) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `code`, `name`) VALUES
(1, '115111', 'Computer Accessories & Peripherals'),
(2, '115113', 'Laptop Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id` int(5) NOT NULL,
  `code_category` varchar(15) NOT NULL,
  `code_sub_category` varchar(15) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stock` int(10) NOT NULL,
  `code_unit` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id`, `code_category`, `code_sub_category`, `code`, `name`, `stock`, `code_unit`, `created_at`, `updated_at`) VALUES
(1, '115111', '1010301012', '1010301001000001', 'SmartQ C307 USB 3.0 Portable Card Reader for SD, SDHC, SDXC, MicroSD, MicroSDHC, MicroSDXC, with Adv', 3, 3, '2022-07-11 02:51:09', '2022-07-16 15:34:27'),
(5, '115113', '1010305999', '1010301001000002', 'Docking Station USB C to Dual HDMI Adapter, USB C Hub Dual HDMI Monitors for Windows,USB C Adapter w', 15, 3, '2022-07-11 02:51:24', '2022-07-16 15:29:44'),
(6, '115113', '1010305008', '1010301001000003', 'New Genuine Lenovo ThinkPad 65 Watt 20V 3.25A Type-C USB AC Adapter ADLX65YDC2A', 12, 3, '2022-07-11 02:48:28', '2022-07-16 13:55:07'),
(7, '115113', '1010305008', '1010301001000004', 'Dell 45W Replacement AC Adapter for Dell', 10, 3, '2022-07-11 02:51:28', '2022-07-19 07:13:28'),
(8, '115113', '1010305008', '1010301001000005', 'New Dell Original Inspiron Laptop Charger 65W watt 4.5mm tip AC Power Adapter', 0, 3, '2022-07-11 02:48:29', '2022-07-16 13:55:07'),
(9, '115113', '1010305012', '1010301001000006', 'LIENS Laptop Cooling Pad with Adjustable Height Two 5.1 Inches Fan 2 USB Ports Suitable for 12\"-15.6', 0, 1, '2022-07-11 02:48:30', '2022-07-16 13:55:07'),
(10, '115113', '1010305999', '1010301001000007', 'USB C Docking Station Dual Monitor for Dell/HP/Lenovo/Surface Laptop, 14 in 1 Triple Display USB C H', 8, 3, '2022-07-11 02:48:31', '2022-07-16 13:55:07'),
(11, '115113', '1010305999', '1010301002000001', 'NEW Microsoft Surface Dock 2', 3, 4, '2022-07-11 02:51:16', '2022-07-16 15:29:44'),
(12, '115111', '1010301006', '1010301002000002', 'Apple Lightning to Digital AV Adapter', 10, 3, '2022-07-11 02:48:32', '2022-07-16 13:55:23'),
(13, '115111', '1010301003', '1010301003000001', 'SanDisk 128GB Extreme microSDXC UHS-I Memory Card with Adapter - Up to 160MB/s, C10, U3, V30, 4K, A2', 5, 5, '2022-07-11 02:48:33', '2022-07-16 13:55:07'),
(14, '115113', '1010305001', '1010301003000002', 'HQRP 2-Pack Gumstick Battery Compatible with Sony NC-5WM, NC-6WM, WM-701C, 1-528-231-11, WM-RX707, W', 2, 5, '2022-07-11 02:48:34', '2022-07-16 13:55:07'),
(15, '115113', '1010305002', '1010301003000003', 'HOMEYUER External Battery Pack with 2.5mm Jack for Some Safe Box with External Battery Supply Like B', 4, 5, '2022-07-11 02:48:35', '2022-07-16 13:55:07'),
(16, '115113', '1010305002', '1010301003000004', 'Bfenown Replacement CAZ10 Battery Cable Connector Wire Cord for Dell Latitude', 1, 5, '2022-07-11 02:48:36', '2022-07-16 13:55:07'),
(17, '115111', '1010306011', '1010301004000001', 'Amazon Basics External Hard Drive Portable Carrying Case', 5, 4, '2022-07-11 02:48:27', '2022-07-16 13:55:07'),
(18, '115111', '1010301012', '1010301005000001', 'SD Card Reader for iPhone iPad,Oyuiasle Trail Game Camera Micro SD Card Reader Viewer,SLR Cameras', 3, 3, '2022-07-11 02:48:26', '2022-07-16 13:55:07'),
(19, '115113', '1010305999', '1010301005000002', 'Dell Thunderbolt Dock- WD19TBS 130w Power Delivery', 5, 3, '2022-07-11 02:51:17', '2022-07-16 15:29:44'),
(20, '115111', '1010301007', '1010301006000001', 'Razer Kraken Ultimate RGB USB Gaming Headset: THX 7.1 Spatial Surround Sound - Chroma RGB Lighting -', 0, 1, '2022-07-11 02:48:23', '2022-07-16 13:55:07'),
(21, '115111', '1010301007', '1010301006000002', 'BENGOO G9000 Stereo Gaming Headset for PS4 PC Xbox One PS5 Controller, Noise Cancelling Over Ear Hea', 0, 1, '2022-07-11 02:48:17', '2022-07-16 13:52:54'),
(22, '115111', '1010301007', '1010301006000003', 'Logitech G305 LIGHTSPEED Wireless Gaming Mouse, Hero 12K Sensor, 12,000 DPI, Lightweight, 6 Programm', 5, 1, '2022-07-11 02:48:18', '2022-07-16 13:52:54'),
(23, '115111', '1010301007', '1010301006000004', 'Newseego PUBG Game Controller Trigger, Mobile Game Accessories 6 Finger Trigger Sensitive Shoot and ', 2, 1, '2022-07-11 02:48:19', '2022-07-16 13:52:54'),
(24, '115111', '1010301004', '1010301006000005', 'USB C Cable AINOPE [2-Pack, 6.6ft] 3.1A Type C Charger Fast Charging Cable Right Angle, Durable Nylo', 0, 1, '2022-07-11 02:48:20', '2022-07-16 13:52:54'),
(25, '115111', '1010301005', '1010301007000001', 'REESIBI Cordless Electric Air Duster, 3-Gear to 90000 RPM Strongest Powerful Dust Blower, Replaces C', 5, 3, '2022-07-11 02:48:21', '2022-07-16 13:52:54'),
(26, '115113', '1010305002', '1010301008000001', 'GinTai Power Cord Battery Connector Cable for Dell Latitude 7480 7490 E7480 E7490 Series Laptop F3YG', 3, 3, '2022-07-11 02:48:22', '2022-07-16 13:53:04'),
(27, '115111', '1010301005', '1010301008000002', 'STREBITO Screwdriver Sets 142-Piece Electronics Precision Screwdriver', 0, 5, '2022-07-11 02:48:24', '2022-07-16 13:55:07'),
(28, '115111', '1010301007', '1010301010000001', 'Razer Naga Pro Wireless Gaming Mouse: Interchangeable Side Plate w/ 2, 6, 12 Button Configurations -', 4, 3, '2022-07-11 02:48:25', '2022-07-16 13:55:07'),
(29, '115111', '1010301004', '1010301010000002', 'Amazon Basics iPhone Charger Cable, Nylon USB-A to Lightning, MFi Certified, for Apple iPhone, iPad,', 3, 3, '2022-07-11 02:50:14', '2022-07-16 14:27:15'),
(30, '115111', '1010301010', '1010301010000003', 'USB Hub, 5 in 1 USB Port Expander, USB 3.0 Hub Multiport , USB Splitter with SD/', 0, 3, '2022-07-11 02:48:51', '2022-07-16 14:01:12'),
(31, '115111', '1010301004', '1010301010000004', 'iPhone Charger 3Pack Apple MFi Certified Apple Charger 6FT, Lightning Cable 6FT Compatible with iPho', 3, 3, '2022-07-11 02:48:52', '2022-07-16 14:01:27'),
(32, '115113', '1010305001', '1010301010000005', 'Lenovo Laptop Shoulder Bag T210, 15.6-Inch Laptop or Tablet, Sleek, Durable and Water-Repellent Fabr', 1, 3, '2022-07-11 02:48:53', '2022-07-16 14:01:12'),
(33, '115111', '1010301001', '1010301010000006', 'Logitech S120 2.0 Stereo Speakers, Black', 5, 3, '2022-07-11 02:48:54', '2022-07-16 14:28:43'),
(34, '115111', '1010301001', '1010301010000007', 'Redragon GS520 RGB Desktop Speakers, 2.0 Channel PC Computer Stereo Speaker with 6 Colorful LED Mode', 11, 3, '2022-07-11 02:48:55', '2022-07-16 14:01:12'),
(35, '115111', '1010301004', '1010301010000008', 'Syntech USB C to USB Adapter Pack of 2 USB C Male to USB3 Female Adapter Compatible with MacBook Pro', 0, 3, '2022-07-11 02:48:56', '2022-07-16 14:01:12'),
(36, '115111', '1010301003', '1010301010000009', '[Apple MFi Certified] 6Pack 3/3/6/6/6/10 FT iPhone Charger Nylon Braided Fast Charging Lightning Cab', 2, 4, '2022-07-11 02:48:57', '2022-07-16 14:01:12'),
(37, '115111', '1010301007', '1010301012000001', 'Logitech G604 LIGHTSPEED Wireless Gaming Mouse with 15 programmable controls, up to 240 hour battery', 5, 3, '2022-07-11 02:48:58', '2022-07-16 14:01:12'),
(38, '115111', '1010301003', '1010301013000001', 'Kensington Combination Ultra Cable Lock for Laptops and Other Devices (K64675US),Silver', 9, 5, '2022-07-11 02:50:31', '2022-07-16 15:14:15'),
(39, '115111', '1010301001', '1010301999000001', 'Amazon Basics Computer Speakers for Desktop or Laptop PC | USB-Powered, Black', 4, 1, '2022-07-11 02:50:12', '2022-07-16 14:28:28'),
(40, '115111', '1010301007', '1010301999000002', 'Logitech G502 HERO High Performance Wired Gaming Mouse, HERO 25K Sensor, 25,600 DPI, RGB, Adjustable', 6, 1, '2022-07-11 02:50:13', '2022-07-16 14:27:15'),
(41, '115111', '1010301001', '1010301999000003', 'Creative Pebble 2.0 USB-Powered Desktop Speakers with Far-Field Drivers and Passive Radiators for Pc', 7, 1, '2022-07-11 02:48:50', '2022-07-16 14:01:12'),
(42, '115111', '1010301006', '1010301999000004', 'BENFEI USB 3.0 to VGA Adapter, USB 3.0 to VGA Male to Female Adapter', 4, 3, '2022-07-11 02:48:49', '2022-07-16 14:01:12'),
(43, '115113', '1010305001', '1010301999000005', 'Laptop Backpack,Business Travel Anti Theft Slim Durable Laptops Backpack with USB Charging Port,Wate', 1, 3, '2022-07-11 02:48:37', '2022-07-16 13:56:33'),
(44, '115111', '1010301001', '1010301999000006', 'Bose Companion 2 Series III Multimedia Speakers - for PC (with 3.5mm AUX & PC Input) Black', 0, 3, '2022-07-11 02:48:38', '2022-07-16 13:57:04'),
(45, '115111', '1010301001', '1010301999000007', 'Computer Speakers for Desktop, PC Powered Speaker, USB Powered Monitor Speakers for Computer/TV/Lapt', 0, 3, '2022-07-11 02:48:39', '2022-07-16 14:01:11'),
(46, '115111', '1010301007', '1010301999000008', 'Logitech G920 Driving Force Racing Wheel and Floor Pedals, Real Force Feedback, Stainless Steel Padd', 0, 3, '2022-07-11 02:48:40', '2022-07-16 14:01:12'),
(47, '115111', '1010301006', '1010301999000009', 'DVI to HDMI, Benfei Bidirectional DVI (DVI-D) to HDMI Male to Female Adapter with Gold-Plated Cord', 7, 3, '2022-07-11 02:48:41', '2022-07-16 14:01:12'),
(48, '115111', '1010302001', '1010302001000001', 'Syntech USB C Female to USB Male Adapter Pack of 3[Aluminum Shell, High Stability] Type C to USB A C', 15, 1, '2022-07-11 02:48:42', '2022-07-16 14:01:12'),
(49, '115113', '1010305008', '1010302001000002', 'PowerSource 19.5V 65W 45W UL Listed 14Ft Long HP Smart Blue Tip AC Adapter for Many Models', 4, 3, '2022-07-11 02:48:43', '2022-07-16 14:01:12'),
(50, '115113', '1010305001', '1010302001000003', 'Matein Travel Laptop Backpack, Business Anti Theft Slim Durable Laptops Backpack with USB Charging P', 1, 1, '2022-07-11 02:48:44', '2022-07-16 14:01:12'),
(51, '115113', '1010305001', '1010302003000001', 'Travel Backpack, Extra Large 50L Laptop Backpacks for Men Women, Water Resistant College School Book', 3, 1, '2022-07-11 02:48:45', '2022-07-16 14:01:12'),
(52, '115111', '1010302004', '1010302004000001', 'Logitech G PRO X SUPERLIGHT Wireless Gaming Mouse, Ultra-Lightweight, HERO 25K Sensor, 25,600 DPI, 5', 2, 2, '2022-07-11 02:48:46', '2022-07-16 14:01:43'),
(53, '115111', '1010301007', '1010302004000002', 'Razer DeathAdder V2 Gaming Mouse: 20K DPI Optical Sensor - Fastest Gaming Mouse Switch - Chroma RGB ', 2, 1, '2022-07-11 02:48:47', '2022-07-16 14:01:12'),
(54, '115111', '1010302004', '1010302004000003', '[Apple MFi Certified] 6Pack 3/3/6/6/6/10 FT iPhone Charger Nylon Braided Fast Charging Lightning Cab', 5, 1, '2022-07-11 02:48:48', '2022-07-16 14:01:12'),
(55, '115111', '1010301005', '1010302999000001', 'KOONIE Cordless Air Duster, Battery Operated Computer Cleaning Duster, Portable Replaces Compressed ', 0, 1, '2022-07-11 02:50:15', '2022-07-16 14:27:15'),
(56, '115111', '1010301003', '1010302999000002', 'Kensington N17 Dell Laptop Lock - Keyed (K64440WW)', 5, 1, '2022-07-11 02:50:16', '2022-07-16 14:27:15'),
(57, '115111', '1010304004', '1010304004000001', 'Logitech H390 Wired Headset, Stereo Headphones with Noise-Cancelling Microphone, USB, In-Line Contro', 4, 4, '2022-07-11 02:50:17', '2022-07-16 14:27:15'),
(58, '115111', '1010301001', '1010304004000002', 'Klipsch ProMedia 2.1 THX Certified Computer Speaker System (Black)', 10, 4, '2022-07-11 02:50:18', '2022-07-16 14:27:15'),
(59, '115111', '1010301001', '1010304004000003', 'Computer Speakers, Dynamic RGB Computer Sound Bar, HiFi Stereo Bluetooth 5.0 & 3.5mm Aux-in Connecti', 6, 3, '2022-07-11 02:50:36', '2022-07-16 15:15:33'),
(60, '115111', '1010301005', '1010304004000004', 'Compressed Air Duster, Keyboard Cleaner, 3-in-1 Mini Vacuum, 35000 RPM Electric Canned Air Kit, Cord', 0, 4, '2022-07-11 02:50:35', '2022-07-16 15:14:15'),
(61, '115111', '1010301004', '1010304004000005', '[2-Pack, 3ft] USB C Cable 3A Fast Charge, etguuds USB A to Type C Charger Cord Braided Compatible wi', 0, 4, '2022-07-11 02:50:34', '2022-07-16 15:14:15'),
(62, '115111', '1010304006', '1010304006000001', 'Logitech G502 Lightspeed Wireless Gaming Mouse with Hero 25K Sensor, PowerPlay Compatible, Tunable W', 0, 3, '2022-07-11 02:50:33', '2022-07-16 15:14:15'),
(63, '115113', '1010305012', '1010306002000001', 'AICHESON Laptop Cooling Pad 5 Fans Up to 17.3 Inch Heavy Notebook Cooler, Blue LED Lights', 0, 3, '2022-07-11 02:50:32', '2022-07-16 15:14:15'),
(64, '115113', '1010305999', '1010306002000002', 'USB C Docking Station, ORICO Thunderbolt 3 Dock, 15 in 1 Docking Station for USB-C Laptop, Dual 4K@6', 0, 3, '2022-07-11 02:50:11', '2022-07-16 14:27:15'),
(65, '115113', '1010305002', '1010306010000001', 'Xantrex 84-2030-00 LinkLite Battery Monitor', 23, 3, '2022-07-11 02:50:10', '2022-07-16 14:27:15'),
(66, '115111', '1010306011', '1010305001000001', 'FYY Electronic Organizer, Travel Cable Organizer Bag Pouch Electronic Accessories Carry Case Portabl', 0, 3, '2022-07-11 02:50:09', '2022-07-16 14:27:15'),
(67, '115111', '1010306011', '1010305001000002', 'Nanit Monitor Travel Case - Protective Hard Shell Carrying Case', 0, 3, '2022-07-11 02:50:30', '2022-07-16 15:14:15'),
(68, '115113', '1010305001', '1010305001000003', 'Logitech for Creators Blue Yeti USB Microphone for PC, Podcast, Gaming, Streaming, Studio, Computer ', 5, 3, '2022-07-11 02:50:29', '2022-07-16 15:14:15'),
(69, '115111', '1010301006', '1010305001000004', 'QGeeM USB C to HDMI Adapter 4K, USB Type-C to HDMI Adapter [Thunderbolt 3 Compatible]', 0, 3, '2022-07-11 02:50:57', '2022-07-16 15:20:26'),
(70, '115111', '1010301006', '1010305001000005', 'Amazon Basics HDMI to DVI Adapter Cable, Black, 6 Feet, 1-Pack', 8, 3, '2022-07-11 02:48:59', '2022-07-16 14:27:15'),
(71, '115111', '1010301006', '1010305001000006', 'Apple Thunderbolt 3 (USB-C) to Thunderbolt 2 Adapter', 0, 3, '2022-07-11 02:50:00', '2022-07-16 14:27:15'),
(72, '115111', '1010301012', '1010305001000007', 'USB C SD Card Reader Adapter, iHoryson Type C Micro SD TF Card Reader Adapter, 3 in 1 USB C to USB C', 4, 3, '2022-07-11 02:50:01', '2022-07-16 15:36:13'),
(73, '115111', '1010301006', '1010305001000008', 'Syntech USB C to USB Adapter Pack of 2 USB C Male to USB3 Female Adapter Compatible with MacBook Pro', 5, 3, '2022-07-11 02:50:02', '2022-07-16 14:27:15'),
(75, '115113', '1010305999', '1010305002000002', 'Lenovo USA ThinkPad Thunderbolt 3 Dock Gen 2 135W (40AN0135US) Dual UHD 4K Display Capability', 0, 3, '2022-07-11 02:50:03', '2022-07-16 14:27:15'),
(76, '115113', '1010305999', '1010305002000003', 'Plugable USB 3.0 Universal Laptop Docking Station Dual Monitor for Windows and Mac, USB 3.0 or USB-C', 0, 3, '2022-07-11 02:50:04', '2022-07-16 14:27:15'),
(77, '115113', '1010305012', '1010305002000004', 'Targus 17 inch Dual Fan Lap Chill Mat - Soft Neoprene Laptop Cooling Pad, Heat Protection Laptop Coo', 0, 3, '2022-07-11 02:50:08', '2022-07-16 14:27:15'),
(78, '115113', '1010305008', '1010305004000001', 'Mac Book Pro Charger - 100W USB C Charger Power Adapter Compatible with MacBook Pro', 4, 3, '2022-07-11 02:50:07', '2022-07-16 14:27:15'),
(79, '115111', '1010301006', '1010305004000002', 'USB C Female to USB A Male Adapter,Compatible with Apple MagSafe Watch to USB Wall Plug,Type-C to A ', 3, 3, '2022-07-11 02:50:06', '2022-07-16 14:27:15'),
(80, '115111', '1010301007', '1010305004000003', 'SteelSeries Apex 3 RGB Gaming Keyboard – 10-Zone RGB Illumination – IP32 Water Resistant – Premium M', 2, 3, '2022-07-11 02:50:05', '2022-07-16 14:27:15'),
(82, '115111', '1010301012', '1010305008000002', 'Vanja Micro USB OTG Adapter and USB 2.0 Portable Memory Card Reader for SD-3C SDXC SDHC MMC RS-MMC M', 3, 4, '2022-07-11 02:50:37', '2022-07-16 15:14:15'),
(83, '115111', '1010301005', '1010305008000003', 'Compressed Air Duster & Mini Vacuum Keyboard Cleaner 3-in-1, New Generation Canned Air Spray, Portab', 12, 4, '2022-07-11 02:50:38', '2022-07-16 15:14:15'),
(84, '115111', '1010301005', '1010305008000004', 'Compressed Air Duster, 41000 RPM Electric Air Duster, Handheld Cordless Air Duster, Stepless Speed M', 0, 4, '2022-07-11 02:51:08', '2022-07-16 15:26:20'),
(85, '115113', '1010305008', '1010305008000005', 'SAMSUNG EVO Select Micro SD-Memory-Card + Adapter, 256GB microSDXC 130MB/s Full HD & 4K UHD, UHS-I, ', 2, 3, '2022-07-11 02:50:47', '2022-07-16 15:20:26'),
(86, '115111', '1010301002', '1010305008000006', 'SanDisk 128GB Extreme PRO SDXC UHS-I Card - C10, U3, V30, 4K UHD, SD Card - SDSDXXY-128G-GN4IN', 4, 3, '2022-07-11 02:50:48', '2022-07-16 15:20:26'),
(87, '115111', '1010301010', '1010305008000007', 'Logitech MK235 Wireless Keyboard and Mouse Combo for Windows, 2.4 GHz Wireless Unifying USB Receiver', 5, 4, '2022-07-11 02:50:49', '2022-07-16 15:20:26'),
(88, '115111', '1010301003', '1010305008000008', 'Upgraded Funny Dog Humping Phone Charger Cable for iPhone 13/12/11 and More, 3HQ Fast Charger Touch ', 0, 4, '2022-07-11 02:50:50', '2022-07-16 15:20:26'),
(89, '115111', '1010301001', '1010305008000009', 'LENRUE Computer Speakers,Wired USB-Powered PC Speakers with 10W Stereo Sound,Gaming Sound-bar Speake', 0, 4, '2022-07-11 02:50:28', '2022-07-16 15:14:15'),
(90, '115111', '1010306011', '1010305008000010', 'SABRENT USB 3.0 to SATA External Hard Drive Lay-Flat Docking Station for 2.5 or 3.5in HDD, SSD [Supp', 3, 4, '2022-07-11 02:50:27', '2022-07-16 15:14:15'),
(91, '115111', '1010306011', '1010305008000011', 'SABRENT 2.5-Inch SATA to USB 3.0 Tool-Free External Hard Drive Enclosure [Optimized for SSD, Support', 3, 3, '2022-07-11 02:50:51', '2022-07-16 15:31:25'),
(92, '115111', '1010306011', '1010305008000012', 'SSK Aluminum M.2 NVME SSD Enclosure Adapter, USB 3.1/3.2 Gen 2 (10 Gbps) to NVME PCI-E M-Key Solid S', 0, 4, '2022-07-11 02:50:52', '2022-07-16 15:20:26'),
(93, '115111', '1010301010', '1010305012000001', 'Logitech MX Keys Advanced Wireless Illuminated Keyboard, Tactile Responsive Typing, Backlighting, Bl', 0, 3, '2022-07-11 02:50:53', '2022-07-16 15:20:26'),
(96, '115111', '1010301012', '1010305999000003', 'Identiv SCR3310v2.0 USB Smart Card Reader', 0, 3, '2022-07-11 02:50:54', '2022-07-16 15:20:26'),
(97, '115111', '1010306011', '1010305999000004', 'iMangoo Shockproof Carrying Case Hard Protective EVA Case Impact Resistant Travel 12000mAh Bank Pouc', 3, 3, '2022-07-11 02:50:55', '2022-07-16 15:20:26'),
(98, '115111', '1010301006', '1010305999000005', 'HDMI to VGA, Benfei Gold-Plated HDMI to VGA 6 Feet Cable (Male to Male) Compatible for Computer, Des', 0, 1, '2022-07-11 02:50:58', '2022-07-16 15:20:26'),
(99, '115111', '1010306011', '1010305999000006', 'Flash Drive Case USB Storage Case JBOS USB Holder Storage Bag for USB Flash Drive Electronic Accesso', 3, 3, '2022-07-11 02:50:56', '2022-07-16 15:20:26'),
(100, '115111', '1010306011', '1010305999000007', 'Corsair Dual SSD Mounting Bracket 3.5\" CSSD-BRKT2, Black (packaging may vary)', 1, 3, '2022-07-11 02:50:19', '2022-07-18 08:11:39'),
(101, '115111', '1010306011', '1010305999000008', 'M.2 NVMe SSD Enclosure Adapter Tool-Free, USB 3.2 Gen 2 10Gbps HDD Adapter MKey(B+M Key) SSD Reader,', 0, 3, '2022-07-11 02:50:20', '2022-07-16 15:14:15'),
(102, '115111', '1010306011', '1010305999000009', 'GiGimundo 2.5\" Hard Drive Enclosure,SATA to USB 3.0(5Gbps) External Hard Drive Case with UASP', 0, 3, '2022-07-11 02:50:21', '2022-07-16 15:14:15'),
(103, '115111', '1010306011', '1010305999000010', 'SSK Aluminum USB C to M.2 NVMe SSD Tool-Free Enclosure Reader, USB 3.1/3.2 Gen 2(10Gbps) to NVMe PCI', 0, 3, '2022-07-11 02:50:22', '2022-07-16 15:14:15'),
(104, '115111', '1010306011', '1010305999000011', 'UGREEN 2.5\" Hard Drive Enclosure USB 3.0 to SATA III for 2.5 Inch SSD & HDD 9.5mm 7mm External Hard ', 0, 3, '2022-07-11 02:50:23', '2022-07-16 15:14:15'),
(105, '115111', '1010306011', '1010305999000012', 'sisma Travel Cords Organizer Universal Small Electronic Accessories Carrying Bag for Cables Adapter ', 2, 3, '2022-07-11 02:50:24', '2022-07-16 15:14:15'),
(106, '115111', '1010306011', '1010305999000013', 'SABRENT USB 3.0 to SATA I/II/III Dual Bay External Hard Drive Docking Station for 2.5 or 3.5in HDD, ', 0, 3, '2022-07-11 02:50:25', '2022-07-16 15:14:15'),
(119, '115113', '1010305999', '1010305999000001', 'Made for Amazon SanDisk 128GB microSD Memory Card for Fire Tablets and Fire -TV', 5, 1, '2022-07-11 02:50:26', '2022-07-16 15:14:15'),
(122, '115111', '1010301001', '1010301013000003', 'Amazon Basics USB Plug-n-Play Computer Speakers for PC or Laptop, Black - Set of 2', 4, 5, '2022-07-11 02:51:07', '2022-07-16 15:26:20'),
(123, '115111', '1010301006', '1010301013000002', 'DisplayPort to HDMI Adapter, CableCreation 1080P Gold Plated DP to HDMI Adapter (Male to Female) 1.3', 2, 5, '2022-07-11 02:51:06', '2022-07-16 15:26:20'),
(124, '115111', '1010302999', '1010302999000005', '[Apple MFi Certified] 5pack[6/6/6/10/10FT] iPhone Charger Long Lightning Cable Fast Charging High Sp', 5, 1, '2022-07-11 02:51:26', '2022-07-20 13:19:44'),
(125, '115111', '1010301006', '1010301006000006', 'iPhone Charger, 3 Packs 10FT 90 Degree Charging Cable MFi Certified USB Lightning Cable Nylon Braide', 4, 1, '2022-07-11 02:51:11', '2022-07-16 15:26:20'),
(126, '115111', '1010301012', '1010305002000005', 'Multifunctional 9 in 1 Data Cable with USB Type-C Card Reader Micro SD Memory Card high-Speed Card', 5, 2, '2022-07-11 02:51:27', '2022-07-21 06:21:04'),
(127, '115111', '1010301007', '1010305004000004', 'Razer Viper Ultimate Hyperspeed Lightweight Wireless Gaming Mouse & RGB Charging Dock: Fastest Gamin', 8, 3, '2022-07-11 02:50:46', '2022-07-16 15:20:26'),
(128, '115113', '1010305001', '1010301999000013', 'Monsdle Travel Laptop Backpack Anti Theft Water Resistant Backpacks School Computer Bookbag with USB', 0, 3, '2022-07-11 02:50:45', '2022-07-16 15:20:26'),
(129, '115111', '1010301004', '1010302999000004', 'SYBECHATF Nucleus M P TAP to 7 Pin Motor Power Cable for Tilta', 0, 1, '2022-07-11 02:50:44', '2022-07-16 15:20:26'),
(130, '115111', '1010301006', '1010301999000012', 'HDMI to VGA, Moread Gold-Plated HDMI to VGA Adapter (Male to Female) for Computer, Desktop, Laptop,', 6, 3, '2022-07-11 02:50:59', '2022-07-21 06:29:28'),
(132, '115111', '1010301010', '1010301005000003', 'Rose Gold Glitter Black Desk Mat Extended Mouse Pad XXL Office Desk 31.5x15.7 in Accessories for Wom', 2, 3, '2022-07-11 02:51:00', '2022-07-21 05:48:03'),
(133, '115111', '1010301012', '1010301012000002', 'HUANUO Dual Monitor Stand, Adjustable Spring Monitor Desk Mount Swivel Vesa Bracket with C Clamp/Gro', 4, 3, '2022-07-11 02:51:01', '2022-07-21 05:47:52'),
(134, '115111', '1010301012', '1010301001000008', 'Deftun Bluetooth MSR-X6(BT) MSRX6BT Magnetic Stripe Card Reader Writer Encoder Mini Portable', 1, 5, '2022-07-11 02:51:02', '2022-07-16 15:35:09'),
(135, '115111', '1010301003', '1010301010000011', 'RUBAN Notebook Lock and Security Cable (PC/Laptop) Two Keys 6.2 foot (Black)', 3, 3, '2022-07-11 02:51:03', '2022-07-21 06:29:43'),
(136, '115111', '1010301006', '1010301999000010', 'Apple USB-C to USB Adapter', 5, 3, '2022-07-11 02:51:04', '2022-07-20 11:27:36'),
(137, '115111', '1010301005', '1010305001000009', '4 Pack Keyboard Cleaner, Dust Cleaning Gel with 5 Keyboard Cleaning Kit, Universal Car Cleaning Gel', 2, 3, '2022-07-11 02:51:05', '2022-07-20 03:51:15'),
(138, '115111', '1010301010', '1010301010000010', 'Original HP 63XL Black High-yield Ink Cartridge | Works with HP DeskJet 1112, 2130, 3630 Series; HP ', 3, 3, '2022-07-11 02:50:43', '2022-07-16 15:20:26'),
(139, '115113', '1010305999', '1010301003000005', 'Plugable 4K USB C Docking Station Triple Monitor with 100W Charging, USB C Dock for Thunderbolt', 2, 5, '2022-07-11 02:50:42', '2022-07-16 15:20:26'),
(140, '115111', '1010301010', '1010305012000002', 'Logitech M510 Wireless Computer Mouse for PC with USB Unifying Receiver - Graphite', 2, 4, '2022-07-11 02:50:41', '2022-07-16 15:20:26'),
(141, '115111', '1010301005', '1010301007000002', 'iFixit Pro Tech Toolkit - Electronics, Smartphone, Computer & Tablet', 1, 3, '2022-07-11 02:50:40', '2022-07-16 15:20:26'),
(142, '115111', '1010301006', '1010301001000010', 'Anker USB C to HDMI Adapter (4K@60Hz), 310 USB-C Adapter (4K HDMI), Aluminum Portable USB C Adapter,', 2, 3, '2022-07-11 02:50:39', '2022-07-16 15:20:26'),
(143, '115111', '1010301012', '1010301004000003', 'SmartQ C368 USB 3.0 SD Card Reader, Plug N Play, Apple and Windows Compatible, Powered by USB', 2, 3, '2022-07-11 02:51:10', '2022-07-21 06:30:47'),
(144, '115111', '1010301004', '1010305012000003', 'Anker 6 ft Premium Double-Braided Nylon Lightning Cable, Apple MFi Certified for iPhone Chargers, iP', 4, 3, '2022-07-11 02:51:18', '2022-07-18 12:13:27'),
(145, '115111', '1010301003', '1010305012000004', 'Amazon Basics T-Bar Combination Laptop Lock, 6-Foot Carbon Steel Lock for PC, Monitors, Projectors, ', 0, 3, '2022-07-11 02:51:19', '2022-07-16 15:29:44'),
(146, '115111', '1010301001', '1010301001000009', 'Logitech C920x HD Pro Webcam, Full HD 1080p/30fps Video Calling, Clear Stereo Audio, HD Light Correc', 8, 3, '2022-07-11 02:51:20', '2022-07-20 02:08:11'),
(147, '115113', '1010305001', '1010301999000015', 'Tzowla Travel Laptop Backpack Water Resistant Anti-Theft Bag with USB Charging Port and Lock 15.6 In', 4, 3, '2022-07-11 02:51:21', '2022-07-16 15:29:44'),
(148, '115111', '1010301012', '1010301002000003', 'Anker SD Card Reader, 2-in-1 USB C Memory Card Reader for SDXC, SDHC, SD, MMC, RS-MMC, Micro SDXC, M', 8, 3, '2022-07-11 02:51:22', '2022-07-18 13:53:20'),
(149, '115111', '1010301005', '1010301003000008', 'KOONIE 15000mAh Cordless Air Duster & Vacuum 2 in 1, Powerful 77000RPM/11000PA, 2 Speeds, Electric C', 23, 5, '2022-07-11 02:51:23', '2022-07-16 15:29:44'),
(150, '115111', '1010306011', '1010301003000006', 'MOKiN M.2 NVME SATA SSD Enclosure Adapter Tool-Free, RTL9210B Chips, USB C 3.1 Gen 2 10Gbps NVME, 6G', 15, 5, '2022-07-11 02:51:15', '2022-07-16 15:29:44'),
(151, '115111', '1010306011', '1010301004000002', 'SABRENT USB 3.2 Type-C Tool-Free Enclosure for M.2 PCIe NVMe and SATA SSDs (EC-SNVE)', 2, 3, '2022-07-11 02:51:14', '2022-07-16 15:29:44'),
(152, '115113', '1010305999', '1010302999000003', 'Dell WD19 130W Docking Station (with 90W Power Delivery) USB-C, HDMI, Dual DisplayPort', 2, 3, '2022-07-11 02:51:13', '2022-07-16 15:29:44'),
(153, '115111', '1010306011', '1010306010000003', 'ASUS ROG STRIX Arion Aluminum Alloy M.2 NVMe SSD External Portable Enclosure Case Adapter', 0, 3, '2022-07-11 02:51:12', '2022-07-16 15:29:44'),
(154, '115113', '1010305999', '1010306010000002', 'Dell USB 3.0 Ultra HD/4K Triple Display Docking Station (D3100), Black', 22, 3, '2022-07-11 02:51:25', '2022-07-16 15:31:02'),
(155, '115111', '1010301010', '10100800004', 'Logitech K350 Wireless Wave Ergonomic Keyboard with Unifying Wireless Technology - Black', 11, 1, '2022-07-11 02:51:29', '2022-07-21 06:19:25'),
(184, '115113', '1010305002', '54312322223335', 'SanDisk 128GB Ultra microSDXC UHS-I Memory Card with Adapter - 120MB/s, C10, U1, Full HD, A1, Micro', 10, 5, '2022-07-13 23:45:05', '2022-07-21 06:37:19'),
(187, '115111', '1010301004', '123356445333', 'Logitech G920 Driving Force Racing Wheel and Floor Pedals, Real Force Feedback, Stainless Steel Padd', 13, 2, '2022-07-15 22:56:23', '2022-07-21 06:18:16'),
(188, '115111', '1010301003', '1233321233321', 'Logitech C922x Pro Stream Webcam – Full 1080p HD Camera', 12, 2, '2022-07-16 00:30:15', '2022-07-18 13:42:39'),
(199, '115111', '1010301002', '22212311155', 'Wireless Vertical Mouse,2.4GHz Wireless Ergonomic Vertical Mouse High Precision Optical Cordless Gam', 10, 2, '2022-07-16 11:36:07', '2022-07-20 10:32:45'),
(200, '115111', '1010301002', '232123222235', 'Roku Streaming Stick 4K 2021 | Streaming Device 4K/HDR/Dolby Vision with Roku Voice Remote and TV Co', 11, 2, '2022-07-16 11:51:38', '2022-07-21 06:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_unit`
--

CREATE TABLE `tb_ref_unit` (
  `id` int(5) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ref_unit`
--

INSERT INTO `tb_ref_unit` (`id`, `name`) VALUES
(1, 'BAG'),
(2, 'CARTON'),
(3, 'PCS'),
(4, 'UNIT'),
(5, 'BOX');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_category`
--

CREATE TABLE `tb_sub_category` (
  `id` int(5) NOT NULL,
  `code_category` varchar(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sub_category`
--

INSERT INTO `tb_sub_category` (`id`, `code_category`, `code`, `name`) VALUES
(1, '115111', '1010301001', 'Audio & Video Accessories'),
(2, '115111', '1010301002', 'Blank Media'),
(3, '115111', '1010301003', 'Cable Security Devices'),
(4, '115111', '1010301004', 'Cables & Accessories'),
(5, '115111', '1010301005', 'Cleaning & Repair'),
(6, '115111', '1010301006', 'Computer Cable Adapters'),
(7, '115111', '1010301007', 'Game Hardware'),
(8, '115111', '1010301008', 'Input Devices'),
(9, '115111', '1010301010', 'Keyboards, Mice & Accessories'),
(10, '115111', '1010301012', 'Memory Card Accessories'),
(11, '115111', '1010301013', 'Memory Cards'),
(12, '115111', '1010301999', 'Monitor Accessories'),
(13, '115111', '1010302001', 'Printer Accessories'),
(14, '115111', '1010302003', 'Printer Ink & Toner'),
(15, '115111', '1010302004', 'Racks & Cabinets'),
(16, '115111', '1010302999', 'Scanner Accessories'),
(17, '115111', '1010304004', 'Uninterruptible Power Supply (UPS)'),
(18, '115111', '1010304006', 'USB Gadgets'),
(19, '115111', '1010306002', 'USB Hubs'),
(20, '115111', '1010306010', 'Video Projector Accessories'),
(21, '115113', '1010305001', 'Bags, Cases & Sleeves'),
(22, '115113', '1010305002', 'Batteries'),
(23, '115113', '1010305004', 'Camera Privacy Covers'),
(24, '115113', '1010305008', 'Chargers & Adapters'),
(25, '115113', '1010305012', 'Cooling Pads & External Fans'),
(37, '115113', '1010305999', 'Docking Stations'),
(41, '115111', '1010306011', 'Hard Drive Accessories');

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
(18, 'Admin', 'admin', '$2y$10$2yTvjcAsG5MdQiSTLnDlh.ZHDYqgKqCCtJKtpGZPPJSk2mh.4AtmC', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ref_unit`
--
ALTER TABLE `tb_ref_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_category`
--
ALTER TABLE `tb_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `tb_ref_unit`
--
ALTER TABLE `tb_ref_unit`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sub_category`
--
ALTER TABLE `tb_sub_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
