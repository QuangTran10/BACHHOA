-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 04:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bachhoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `NoiDung` text NOT NULL,
  `DanhGia` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `MSSP` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `binhluan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `ThoiGian`, `NoiDung`, `DanhGia`, `MSKH`, `MSSP`, `TrangThai`) VALUES
(1, '2022-03-01 13:06:09', 'Là một loại thực phẩm vô cùng quen thuộc, rất dễ mua và chế biến thành nhiều món ăn đa dạng khác nhau trong bữa cơm hằng ngày. Bắp cải trắng đặc biệt mang đến lợi ích trong việc hỗ trợ phòng chống ung thư, giúp cơ thể khỏe mạnh toàn diện.', 5, 1, 27, 1),
(2, '2022-03-01 22:03:33', 'Hôm qua (28/2/2022) đặt mua 2 túi cà rốt, mỗi túi 500 gram thì lúc nhận hàng thấy 1 túi cà rốt hơi mềm. Nhưng vì chiều về nấu liền nên không muốn gọi điện khiếu nại. Mong rằng lần sau BHX lựa chọn rau củ tươi hơn để giao cho khách.', 5, 1, 25, 1),
(3, '2022-03-07 18:48:02', 'Bao bì đẹp, chất lượng như mong đợi.', 3, 1, 22, 1),
(4, '2022-03-07 18:52:01', 'Bắp tím giao tươi, vỏ bên ngoài có dập 1 xíu nhưng chỉ có cái lố bên ngoài thui, bên trong okela nha', 3, 1, 27, 1),
(5, '2022-03-07 19:13:16', 'Sản phẩm rất tốt', 1, 1, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `MSDH` int(11) NOT NULL,
  `MSSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` int(11) NOT NULL,
  `GiamGia` float NOT NULL,
  `ThanhTien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`MSDH`, `MSSP`, `SoLuong`, `GiaDatHang`, `GiamGia`, `ThanhTien`) VALUES
(12, 24, 1, 17000, 0, 17000),
(12, 28, 1, 58000, 0, 58000),
(12, 29, 1, 65700, 0.2, 52560),
(13, 22, 1, 23000, 0.3, 16100),
(13, 25, 1, 12500, 0, 12500),
(14, 22, 1, 23000, 0.3, 16100),
(14, 23, 1, 16000, 0, 16000),
(14, 28, 1, 58000, 0, 58000),
(16, 29, 2, 65700, 0.2, 105120),
(17, 25, 1, 12500, 0, 12500),
(17, 30, 2, 44000, 0, 88000),
(19, 28, 1, 58000, 0, 58000),
(19, 30, 2, 44000, 0, 88000),
(20, 37, 1, 100000, 0, 100000),
(20, 38, 1, 96000, 0, 96000);

--
-- Triggers `chitietdathang`
--
DELIMITER $$
CREATE TRIGGER `sua_hang` AFTER UPDATE ON `chitietdathang` FOR EACH ROW update sanpham set SoLuong=(SoLuong-new.SoLuong+old.SoLuong) where MSSP=old.MSSP
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `them_hang` AFTER INSERT ON `chitietdathang` FOR EACH ROW UPDATE sanpham set SoLuong=SoLuong-new.SoLuong where MSSP=new.MSSP
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `xoa_hang` AFTER DELETE ON `chitietdathang` FOR EACH ROW update sanpham set SoLuong=SoLuong+old.SoLuong where MSSP=old.MSSP
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chitietphieuthu`
--

CREATE TABLE `chitietphieuthu` (
  `MaPhieu` int(11) NOT NULL,
  `MSSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` double NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietphieuthu`
--

INSERT INTO `chitietphieuthu` (`MaPhieu`, `MSSP`, `SoLuong`, `DonGia`, `TG_Tao`, `TG_CapNhat`) VALUES
(10, 6, 50, 88000, '2022-04-22 14:40:07', '2022-04-22 14:40:07'),
(10, 21, 10, 84500, '2022-04-22 14:40:07', '2022-04-22 14:40:07'),
(10, 28, 19, 58000, '2022-04-22 14:40:07', '2022-04-22 14:40:07'),
(11, 8, 20, 27500, '2022-04-22 14:47:21', '2022-04-22 14:47:21'),
(11, 9, 30, 69000, '2022-04-22 14:47:21', '2022-04-22 14:47:21'),
(11, 23, 10, 16000, '2022-04-22 14:47:21', '2022-04-22 14:47:21'),
(11, 24, 49, 17000, '2022-04-22 14:47:21', '2022-04-22 14:47:21'),
(11, 25, 9, 12500, '2022-04-22 14:47:21', '2022-04-22 14:47:21'),
(11, 26, 20, 45000, '2022-04-22 14:47:21', '2022-04-22 14:47:21'),
(11, 27, 10, 20000, '2022-04-22 14:47:21', '2022-04-22 14:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` int(11) NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `TenDanhMuc` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `MaLoai`, `TenDanhMuc`, `created_at`, `updated_at`) VALUES
(1, 1, 'Thịt heo', '2022-02-15 18:58:12', '2022-02-15 18:58:12'),
(2, 1, 'Thịt bò', '2022-02-15 18:58:34', '2022-02-15 18:58:34'),
(3, 1, 'Hải sản', '2022-02-15 18:58:50', '2022-02-15 18:58:50'),
(4, 3, 'Rau củ các loại', '2022-02-15 18:59:16', '2022-02-15 18:59:16'),
(5, 3, 'Nấm các loại', '2022-02-15 18:59:29', '2022-02-15 18:59:29'),
(6, 2, 'Nước ngọt', '2022-02-15 18:59:53', '2022-02-15 18:59:53'),
(7, 4, 'Đường, muối, gia vị', '2022-02-15 19:00:19', '2022-02-15 19:00:19'),
(8, 4, 'Dầu ăn', '2022-02-27 18:50:35', '2022-02-27 18:50:35'),
(9, 4, 'Tương ớt, tương đen', '2022-02-27 18:50:58', '2022-02-27 18:50:58'),
(10, 6, 'Sữa tươi', '2022-05-15 07:51:30', '2022-05-15 07:51:30'),
(11, 6, 'Sữa hạt, sữa đậu', '2022-05-15 08:00:26', '2022-05-15 08:00:26'),
(12, 2, 'Nước suối', '2022-05-15 08:02:58', '2022-05-15 08:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

CREATE TABLE `dathang` (
  `MSDH` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `MSNV` int(11) DEFAULT NULL,
  `HoTen` varchar(200) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `NgayDat` datetime NOT NULL,
  `NgayGiao` datetime DEFAULT NULL,
  `GhiChu` text DEFAULT NULL,
  `TrangThai` int(11) NOT NULL,
  `MaThanhToan` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`MSDH`, `MSKH`, `MSNV`, `HoTen`, `SDT`, `DiaChi`, `ThanhTien`, `NgayDat`, `NgayGiao`, `GhiChu`, `TrangThai`, `MaThanhToan`, `created_at`, `updated_at`) VALUES
(11, 1, 1, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Mỹ Xuyên, Sóc Trăng', 80000, '2022-03-15 15:10:54', NULL, NULL, 3, 4, '2022-03-15 15:10:54', '2022-03-15 15:10:54'),
(12, 1, 1, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Mỹ Xuyên, Sóc Trăng', 157560, '2022-03-15 15:42:15', NULL, NULL, 2, 5, '2022-03-15 15:42:15', '2022-03-15 15:42:15'),
(13, 1, NULL, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Mỹ Xuyên, Sóc Trăng', 58600, '2022-03-15 21:57:09', NULL, NULL, 0, 6, '2022-03-15 21:57:09', '2022-03-15 21:57:09'),
(14, 1, NULL, 'Trần Tuấn Anh', '0918151004', '185 Nguyễn Thị Minh Khai', 120100, '2022-04-22 17:44:17', NULL, NULL, 0, 7, '2022-04-22 17:44:17', '2022-04-22 17:44:17'),
(15, 1, NULL, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Mỹ Xuyên, Sóc Trăng', 135120, '2022-04-22 17:50:46', NULL, NULL, 3, 8, '2022-04-22 17:50:46', '2022-04-22 17:50:46'),
(16, 1, 1, 'Trần Tuấn Anh', '0918151004', '185 Nguyễn Thị Minh Khai', 135120, '2022-04-22 17:53:14', NULL, NULL, 1, 9, '2022-04-22 17:53:14', '2022-04-22 17:53:14'),
(17, 2, NULL, 'Trần Phú Vinh', '0918151004', '20 Đường 30/4, Thành Phố Sóc Trăng', 130500, '2022-05-13 15:19:05', NULL, NULL, 0, 10, '2022-05-13 15:19:05', '2022-05-13 15:19:05'),
(18, 2, NULL, 'Trần Phú Vinh', '0918151004', '20 Đường 30/4, Thành Phố Sóc Trăng', 176000, '2022-05-13 15:21:08', NULL, NULL, 3, 11, '2022-05-13 15:21:08', '2022-05-13 15:21:08'),
(19, 2, NULL, 'Trần Phú Vinh', '0918151004', '20 Đường 30/4, Thành Phố Sóc Trăng', 176000, '2022-05-13 15:23:04', NULL, NULL, 0, 12, '2022-05-13 15:23:04', '2022-05-13 15:23:04'),
(20, 1, 1, 'Trần Tuấn Anh', '0918151004', '185 Nguyễn Thị Minh Khai', 226000, '2022-05-15 08:08:24', NULL, NULL, 1, 13, '2022-05-15 08:08:24', '2022-05-15 08:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `HoTen` varchar(200) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `MSKH`, `HoTen`, `SDT`, `DiaChi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Mỹ Xuyên, Sóc Trăng', '2022-02-22 10:07:05', '2022-03-05 16:33:56'),
(2, 1, 'Trần Tuấn Anh', '0918151004', '185 Nguyễn Thị Minh Khai', '2022-03-04 14:47:11', '2022-03-04 14:47:11'),
(4, 2, 'Trần Phú Vinh', '0918151004', '20 Đường 30/4, Thành Phố Sóc Trăng', '2022-05-13 15:18:50', '2022-05-13 15:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `hinhanh`
--

CREATE TABLE `hinhanh` (
  `ID` int(11) NOT NULL,
  `MSSP` int(11) NOT NULL,
  `HinhAnh` varchar(300) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhanh`
--

INSERT INTO `hinhanh` (`ID`, `MSSP`, `HinhAnh`, `created_at`, `updated_at`) VALUES
(3, 6, 'ba-roi-heo-khay-500g-2021112620491023811644932886.jpg', '2022-02-15 20:48:06', '2022-02-15 20:48:06'),
(4, 6, 'ba-roi-heo-khay-500g-2021112620491061761644932886.jpg', '2022-02-15 20:48:06', '2022-02-15 20:48:06'),
(6, 7, 'thung-24-chai-tra-xanh-c2-huong-chanh-230ml-2020112808311910161645084933.jpg', '2022-02-17 15:02:13', '2022-02-17 15:02:13'),
(7, 7, 'thung-24-chai-tra-xanh-c2-huong-chanh-230ml-2020121713525886451645084933.jpg', '2022-02-17 15:02:13', '2022-02-17 15:02:13'),
(8, 8, 'nam-dui-ga-tui-200g-2-4-cai-2022021510155224101645085049.jpg', '2022-02-17 15:04:09', '2022-02-17 15:04:09'),
(9, 8, 'nam-dui-ga-vi-200g-2020110717084546431645085049.jpg', '2022-02-17 15:04:09', '2022-02-17 15:04:09'),
(10, 8, 'nam-dui-ga-vi-200g-2020110717084599661645085049.jpg', '2022-02-17 15:04:09', '2022-02-17 15:04:09'),
(11, 9, 'nam-mo-nau-hop-150g-2021012922202210561645085441.jpg', '2022-02-17 15:10:41', '2022-02-17 15:10:41'),
(12, 9, 'nam-mo-nau-hop-150g-2021012922202284401645085441.jpg', '2022-02-17 15:10:41', '2022-02-17 15:10:41'),
(13, 10, 'muoi-tom-kieu-tay-ninh-guyumi-chai-60g1645086063.jpg', '2022-02-17 15:21:03', '2022-02-17 15:21:03'),
(14, 10, 'muoi-tom-kieu-tay-ninh-guyumi-hu-60g1645086063.jpg', '2022-02-17 15:21:03', '2022-02-17 15:21:03'),
(21, 21, 'duoi-heo-meat-master-400g1645261640.jpg', '2022-02-19 16:07:20', '2022-02-19 16:07:20'),
(22, 22, 'duong-tinh-luyen-lam-son-goi-1kg-21645962597.jpg', '2022-02-27 18:49:57', '2022-02-27 18:49:57'),
(23, 23, 'nam-kim-cham-goi-150g-21645962766.jpg', '2022-02-27 18:52:46', '2022-02-27 18:52:46'),
(24, 23, 'nam-kim-cham-goi-150g-31645962766.jpg', '2022-02-27 18:52:46', '2022-02-27 18:52:46'),
(25, 24, 'bap-my-2-trai-2jpg1645962860.jpg', '2022-02-27 18:54:20', '2022-02-27 18:54:20'),
(26, 24, 'bap-my-2-trai-31645962860.jpg', '2022-02-27 18:54:20', '2022-02-27 18:54:20'),
(27, 25, 'ca-rot-da-lat-tui-500g-2-4-cu-21645962958.jpg', '2022-02-27 18:55:58', '2022-02-27 18:55:58'),
(28, 25, 'ca-rot-da-lat-tui-500g-2-4-cu-31645962958.jpg', '2022-02-27 18:55:58', '2022-02-27 18:55:58'),
(29, 26, 'khoai-mo-tui-1kg-21645963038.jpg', '2022-02-27 18:57:17', '2022-02-27 18:57:17'),
(30, 27, 'bap-cai-tim-tui-1kg-21645963117.jpg', '2022-02-27 18:58:37', '2022-02-27 18:58:37'),
(31, 28, 'tom-the-nguyen-con-khay-300g-21645964123.jpeg', '2022-02-27 19:15:23', '2022-02-27 19:15:23'),
(32, 29, 'muc-ghim-nhap-khau-dong-lanh-tui-300g-21645964230.jpg', '2022-02-27 19:17:10', '2022-02-27 19:17:10'),
(33, 29, 'muc-ghim-nhap-khau-dong-lanh-tui-300g-31645964230.jpg', '2022-02-27 19:17:10', '2022-02-27 19:17:10'),
(34, 30, '6-chai-nuoc-ngot-coca-cola-390ml-21652428332.jpg', '2022-05-13 14:52:12', '2022-05-13 14:52:12'),
(35, 30, 'hinh-nuoc-ngot-coca-cola1652428332.jpg', '2022-05-13 14:52:12', '2022-05-13 14:52:12'),
(36, 32, 'thung-36-hop-sua-dau-nanh-fami-canxi-21652576050.jpg', '2022-05-15 07:54:10', '2022-05-15 07:54:10'),
(37, 33, 'thung-48-hop-sua-tiet-trung-huong-viet-quat-nestle-11652576177.jpg', '2022-05-15 07:56:17', '2022-05-15 07:56:17'),
(38, 34, 'than-bo-uc-tuoi-hut-chan-khong-khay-250g-21652576325.jpg', '2022-05-15 07:58:45', '2022-05-15 07:58:45'),
(39, 36, 'thung-24-lon-nuoc-ngot-co-ga-mirinda-vi-soda-kem-viet-quat-lon1652576526.jpg', '2022-05-15 08:02:06', '2022-05-15 08:02:06'),
(40, 37, 'thung-24-chai-nuoc-tinh-khiet-aquafina-500ml-21652576672.jpg', '2022-05-15 08:04:32', '2022-05-15 08:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(11) NOT NULL,
  `HoTenKH` varchar(200) NOT NULL,
  `GioiTinh` tinyint(3) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `Avatar` varchar(255) NOT NULL DEFAULT 'avatar_macdinh.jpeg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `GioiTinh`, `NgaySinh`, `SDT`, `Email`, `MatKhau`, `TrangThai`, `Avatar`, `created_at`, `updated_at`) VALUES
(1, 'Trần Thanh Quang', 0, '2000-10-29', '0859083181', 'qtran8219@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Anh-vit-cute-61650460683.jpg', '2022-02-20 10:03:25', '2022-04-20 20:18:03'),
(2, 'Trần Phú Vinh', 0, '2000-10-15', '0918151004', 'vinhtran2211@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'avatar.jpeg', '2022-03-03 19:50:16', '2022-03-03 19:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `DiaChi` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `Open` time NOT NULL,
  `Close` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`DiaChi`, `Email`, `SoDienThoai`, `Open`, `Close`) VALUES
('27 Hai Bà Trưng, Phường 3, Thành phố Sóc Trăng', 'qtran8219@gmail.com', '0859083181', '08:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `loaihang`
--

CREATE TABLE `loaihang` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(255) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihang`
--

INSERT INTO `loaihang` (`MaLoai`, `TenLoai`, `TrangThai`, `created_at`, `updated_at`) VALUES
(1, 'Thịt, cá, hải sản', 1, '2022-02-15 07:06:14', '2022-02-15 07:11:30'),
(2, 'Đồ uống', 1, '2022-02-15 07:08:35', '2022-02-15 07:11:16'),
(3, 'Rau, củ, trái cây', 1, '2022-02-15 07:09:14', '2022-02-15 07:09:14'),
(4, 'Dầu ăn, Gia vị', 1, '2022-02-15 11:09:59', '2022-02-15 11:09:59'),
(5, 'Mì, cháo, phở, bún', 1, '2022-02-27 11:47:56', '2022-02-27 11:47:56'),
(6, 'Sữa các loại', 1, '2022-05-15 00:51:16', '2022-05-15 00:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` int(11) NOT NULL,
  `HoTenNV` varchar(255) NOT NULL,
  `GioiTinh` tinyint(4) NOT NULL,
  `Ngay` int(11) NOT NULL,
  `Thang` int(11) NOT NULL,
  `Nam` int(11) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `ChucVu` varchar(100) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `GioiTinh`, `Ngay`, `Thang`, `Nam`, `SDT`, `DiaChi`, `ChucVu`, `Email`, `MatKhau`, `Avatar`, `TrangThai`, `created_at`, `updated_at`) VALUES
(1, 'Trần Thanh Quang', 1, 29, 10, 2000, '0859083181', '180 Triệu Nương, thị trấn Mỹ Xuyên, Sóc Trăng', 'Admin', 'qtran8219@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'avatar_macdinh1645085633.jpeg', 1, '2022-02-14 13:00:22', '2022-02-14 13:00:22'),
(2, 'Trần Tuấn Anh', 1, 1, 1, 2000, '0918151004', '185 Nguyễn Thị Minh Khai', 'Nhân Viên', 'anh1234@gmail.com', '07c4eab44493e1258128f06bfeec79e6', 'avatar_macdinh.jpeg', 1, '2022-02-15 14:16:37', '2022-02-15 14:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `phieuthu`
--

CREATE TABLE `phieuthu` (
  `MaPhieu` int(11) NOT NULL,
  `NguoiNP` varchar(60) NOT NULL,
  `ThanhTien` double DEFAULT NULL,
  `NgayLap` datetime NOT NULL,
  `NCC` text NOT NULL,
  `GhiChu` text DEFAULT NULL,
  `TinhTrang` int(11) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieuthu`
--

INSERT INTO `phieuthu` (`MaPhieu`, `NguoiNP`, `ThanhTien`, `NgayLap`, `NCC`, `GhiChu`, `TinhTrang`, `TG_Tao`, `TG_CapNhat`) VALUES
(10, 'Trần Thanh Quang', 6347000, '2022-04-22 14:40:07', 'Công ty Meet Master', NULL, 1, '2022-04-22 14:40:07', '2022-04-22 14:40:07'),
(11, 'Trần Thanh Quang', 4825500, '2022-04-22 14:47:21', 'Công ty Dalat Farm', NULL, 1, '2022-04-22 14:47:21', '2022-04-22 14:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MSSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Gia` int(11) NOT NULL,
  `GiamGia` double NOT NULL,
  `MaDM` int(11) NOT NULL,
  `ThongTin` text DEFAULT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MSSP`, `TenSP`, `SoLuong`, `Gia`, `GiamGia`, `MaDM`, `ThongTin`, `TrangThai`, `Image`, `created_at`, `updated_at`) VALUES
(6, 'Ba rọi heo C.P khay 500g', 50, 88000, 0, 1, NULL, 1, 'ba-roi-heo-khay-500g-2021112620491023811644932886.jpg', '2022-02-15 20:48:06', '2022-02-15 21:26:47'),
(7, 'Thùng 24 chai trà xanh C2 hương chanh 230ml', 20, 69000, 0, 6, '<p>Được sản xuất từ những l&aacute; tr&agrave; xanh tự nhi&ecirc;n h&ograve;a quyện c&ugrave;ng hương chanh tươi m&aacute;t cho bạn một thức uống giải kh&aacute;t tuyệt vời. Tr&agrave; xanh chứa h&agrave;m lượng chất chống oxy h&oacute;a cao c&ugrave;ng vitamin C dồi d&agrave;o từ chanh gi&uacute;p bạn lu&ocirc;n giữ trạng th&aacute;i năng động v&agrave; hứng khởi.</p>', 1, 'thung-24-chai-tra-xanh-c2-huong-chanh-230ml-2020121713525886451645084933.jpg', '2022-02-17 15:02:13', '2022-02-17 15:02:13'),
(8, '3/7 Nấm đùi gà túi 200g (2-4 cái)', 20, 27500, 0, 5, '<p>Nấm đ&ugrave;i g&agrave; được nu&ocirc;i trồng v&agrave; đ&oacute;ng g&oacute;i theo những ti&ecirc;u chuẩn nghi&ecirc;m ngặt, bảo đảm c&aacute;c ti&ecirc;u chuẩn xanh - sach, chất lượng v&agrave; an to&agrave;n với người d&ugrave;ng. Nấm gi&ograve;n dai, ngọt thịt, nhiều dinh dưỡng thường được d&ugrave;ng cho c&aacute;c m&oacute;n x&agrave;o, chi&ecirc;n gi&ograve;n hoặc nướng ăn k&egrave;m với c&aacute;c loại xốt chấm.</p>', 1, 'nam-dui-ga-vi-200g-2020110717084546431645085049.jpg', '2022-02-17 15:04:09', '2022-02-17 15:04:09'),
(9, 'Nấm mỡ nâu hộp 150g (6-8 cái)', 30, 69000, 0.1, 5, '<p>Nấm mỡ trắng&nbsp;của B&aacute;ch H&oacute;a Xanh được nu&ocirc;i trồng v&agrave; đ&oacute;ng g&oacute;i theo những ti&ecirc;u chuẩn nghi&ecirc;m ngặt, bảo đảm c&aacute;c ti&ecirc;u chuẩn xanh - sach, chất lượng v&agrave; an to&agrave;n với người d&ugrave;ng. Nấm mỡ chứa h&agrave;m lượng chất dinh dưỡng cao, nhiều vitamin v&agrave; protein quan trọng n&ecirc;n thường được chế biến bằng c&aacute;ch x&agrave;o hoặc nướng.</p>', 1, 'nam-mo-nau-hop-150g-2021012922202210561645085441.jpg', '2022-02-17 15:10:41', '2022-02-27 18:46:47'),
(10, 'Muối tôm kiểu Tây Ninh Guyumi hũ 60g', 20, 7400, 0, 7, '<p><a href=\"https://www.bachhoaxanh.com/muoi-an-guyumi\" target=\"_blank\">Muối Guyumi</a>&nbsp;với nguồn nguy&ecirc;n liệu sạch, tạo n&ecirc;n một loại muối t&ocirc;m thơm ngon đ&uacute;ng kiểu T&acirc;y Ninh.&nbsp;<a href=\"https://www.bachhoaxanh.com/muoi-an/muoi-tom-kieu-tay-ninh-guyumi-chai-60g\" target=\"_blank\">Muối t&ocirc;m kiểu T&acirc;y Ninh Guyumi chai 60g</a>&nbsp;l&agrave; loại&nbsp;<a href=\"https://www.bachhoaxanh.com/muoi-an\" target=\"_blank\">muối</a>&nbsp;chấm được tạo n&ecirc;n bởi hương vị ngọt của t&ocirc;m, kết hợp với vị cay của ớt v&agrave; gia vị, c&oacute; độ mặn vừa phải</p>', 1, 'muoi-tom-kieu-tay-ninh-guyumi-chai-60g1645086063.jpg', '2022-02-17 15:21:03', '2022-02-17 15:21:03'),
(21, 'Đuôi heo Meat Master khay 400g (6-8 miếng)', 10, 84500, 0.2, 1, NULL, 1, 'duoi-heo-meat-master-khay-400g1645261640.jpg', '2022-02-19 16:07:20', '2022-02-19 16:07:20'),
(22, 'Đường tinh luyện Lam Sơn gói 1kg', 48, 23000, 0.3, 7, '<p><a href=\"https://www.bachhoaxanh.com/duong\" target=\"_blank\">Đường</a>&nbsp;được ứng dụng c&ocirc;ng nghệ ti&ecirc;n tiến, chiết &eacute;p từ những c&acirc;y m&iacute;a tốt nhất,&nbsp;kh&ocirc;ng sử dụng h&oacute;a chất tẩy trắng đến từ thương hiệu&nbsp;<a href=\"https://www.bachhoaxanh.com/duong-lam-son\" target=\"_blank\">đường Lam Sơn</a>.&nbsp;<a href=\"https://www.bachhoaxanh.com/duong/duong-tinh-luyen-lam-son-goi-1kg\" target=\"_blank\">Đường tinh luyện Lam Sơn g&oacute;i 1kg</a>&nbsp;c&oacute;&nbsp;vị ngọt dịu, thơm ngon, hấp dẫn, c&oacute; m&agrave;u trắng tự nhi&ecirc;n, dễ h&ograve;a tan.</p>', 1, 'duong-tinh-luyen-lam-son-goi-1kg1645962577.jpg', '2022-02-27 18:49:37', '2022-03-01 11:19:09'),
(23, 'Nấm kim châm Hàn Quốc túi 150g', 9, 16000, 0, 5, '<p>Nấm kim ch&acirc;m H&agrave;n Quốc của B&aacute;ch h&oacute;a Xanh được nu&ocirc;i trồng v&agrave; đ&oacute;ng g&oacute;i theo những ti&ecirc;u chuẩn nghi&ecirc;m ngặt, bảo đảm c&aacute;c ti&ecirc;u chuẩn xanh - sach, chất lượng v&agrave; an to&agrave;n với người d&ugrave;ng. Sợi nấm dai, gi&ograve;n v&agrave; ngọt, khi nấu ch&iacute;n rất thơm n&ecirc;n thường được lăn bột chi&ecirc;n gi&ograve;n, nấu s&uacute;p hoặc để nướng ăn k&egrave;m.</p>', 1, 'nam-kim-cham-goi-150g-11645962766.jpg', '2022-02-27 18:52:46', '2022-02-27 18:52:46'),
(24, 'Bắp mỹ gói 2 trái', 49, 17000, 0, 4, '<p>Bắp Mỹ l&agrave; một loại thực phẩm được trồng rất nhiều ở khắp nơi tr&ecirc;n thế giới. Đ&acirc;y l&agrave; một loại quả vừa ngon, lại c&oacute; rất nhiều chất kho&aacute;ng chất v&agrave; vitamin. Bắp c&oacute; thể chế biến th&agrave;nh nhiều m&oacute;n ăn ngon như: cơm bắp, ch&egrave; bắp, sữa bắp,... bất kỳ m&oacute;n g&igrave; cũng tạo n&ecirc;n hương vị tuyệt hảo.</p>', 1, 'bap-my-2-trai-11645962860.jpg', '2022-02-27 18:54:20', '2022-02-27 18:54:20'),
(25, 'Cà rốt Đà Lạt túi 500g', 8, 12500, 0, 4, '<p>C&agrave; rốt Đ&agrave; Lạt l&agrave; một loại củ rất quen thuộc trong c&aacute;c m&oacute;n ăn của người Việt.&nbsp;Loại củ n&agrave;y c&oacute; h&agrave;m lượng chất dinh dưỡng v&agrave; vitamin A cao, được xem l&agrave; nguy&ecirc;n liệu cần thiết cho c&aacute;c m&oacute;n ăn dặm của trẻ nhỏ, gi&uacute;p trẻ s&aacute;ng mắt v&agrave; cung cấp nguồn chất xơ dồi d&agrave;o.</p>', 1, 'ca-rot-da-lat-tui-500g-2-4-cu-11645962958.jpg', '2022-02-27 18:55:58', '2022-02-27 18:55:58'),
(26, 'Khoai mỡ túi 1kg', 20, 45000, 0, 4, '<p>L&agrave; nguy&ecirc;n liệu kh&aacute; quen thuộc của c&aacute;c chị em khi nấu ăn cho cả gia đ&igrave;nh. Với h&agrave;m lượng kho&aacute;ng chất v&agrave; vitamin c&oacute; trong khoai mỡ sẽ gi&uacute;p cải thiện hệ ti&ecirc;u ho&aacute;, gi&uacute;p nhuận tr&agrave;ng, chữa t&aacute;o b&oacute;n rất tốt. Khoai mỡ c&oacute; thể sử dụng để chế biến th&agrave;nh c&aacute;c m&oacute;n như: canh, b&aacute;nh khoai mỡ, khoai mỡ chi&ecirc;n gi&ograve;n,...</p>', 1, 'khoai-mo-tui-1kg-11645963037.jpg', '2022-02-27 18:57:17', '2022-02-27 18:57:17'),
(27, 'Bắp cải tím gói 500g', 10, 20000, 0.1, 4, '<p>L&agrave; một loại thực phẩm v&ocirc; c&ugrave;ng quen thuộc, c&oacute; m&agrave;u sắc v&ocirc; c&ugrave;ng bắt mắt, rất dễ mua v&agrave; chế biến th&agrave;nh nhiều m&oacute;n ăn đa dạng kh&aacute;c nhau trong bữa cơm hằng ng&agrave;y.&nbsp; Bắp cải t&iacute;m đặc biệt mang đến lợi &iacute;ch trong việc hỗ trợ ph&ograve;ng chống ung thư, gi&uacute;p cơ thể khỏe mạnh to&agrave;n diện.</p>', 1, 'bap-cai-tim-tui-1kg-11645963117.jpg', '2022-02-27 18:58:37', '2022-02-27 19:04:26'),
(28, 'Tôm thẻ khay 300g (7-9 con)', 17, 58000, 0, 3, NULL, 1, 'tom-the-nguyen-con-khay-300g-11645964123.jpeg', '2022-02-27 19:15:23', '2022-02-27 19:15:23'),
(29, 'Mực ghim nhập khẩu đông lạnh túi 300g', 17, 65700, 0.2, 3, '<p>Mực ghim l&agrave; loại mực th&acirc;n d&agrave;i, cuộn tr&ograve;n như c&acirc;y ghim, vừa gi&agrave;u chất dinh dưỡng v&agrave; thơm ngon đậm vị. Mực ghim nhập khẩu đ&ocirc;ng lạnh vẫn giữ được độ săn chắc, gi&uacute;p bảo quản l&acirc;u hơn, mang đến vị đậm đ&agrave; cho m&oacute;n ăn</p>', 1, 'muc-ghim-nhap-khau-dong-lanh-tui-300g-11645964230.jpg', '2022-02-27 19:17:10', '2022-02-27 19:20:17'),
(30, '6 nước ngọt Coca Cola 390ml', 0, 44000, 0, 6, '<p>Từ thương hiệu nước giải kh&aacute;t h&agrave;ng đầu thế giới, nước ngọt Coca Cola chai 390ml xua tan nhanh mọi cảm gi&aacute;c mệt mỏi, căng thẳng, đặc biệt th&iacute;ch hợp sử dụng với c&aacute;c hoạt động ngo&agrave;i trời. B&ecirc;n cạnh đ&oacute; thiết kế dạng chai nhỏ gọn, tiện lợi dễ d&agrave;ng bảo quản khi kh&ocirc;ng sử dụng hết</p>', 0, '6-chai-nuoc-ngot-coca-cola-390ml1652428332.jpg', '2022-05-13 14:52:12', '2022-05-13 15:20:14'),
(31, 'Thùng 48 hộp sữa tươi có đường Vinamilk 180ml', 4, 330000, 0, 10, '<p>Được chế biến từ nguồn&nbsp;sữa tươi&nbsp;100% chứa nhiều dưỡng chất như vitamin A, D3, canxi,... tốt cho xương v&agrave; hệ miễn dịch.&nbsp;Sữa tươi Vinamilk&nbsp;l&agrave; thương hiệu được tin d&ugrave;ng h&agrave;ng đầu với chất lượng tuyệt vời.&nbsp;Th&ugrave;ng 48 hộp sữa tươi c&oacute; đường Vinamilk 100% Sữa Tươi 180ml&nbsp;thơm ngon&nbsp;dễ uống.</p>', 1, 'thung-48-hop-sua-tuoi-co-duong-vinamilk1652575812.jpg', '2022-05-15 07:50:12', '2022-05-15 07:50:12'),
(32, 'Thùng 36 hộp sữa đậu nành Fami Canxi 200ml', 5, 147000, 0, 11, '<p style=\"text-align:justify\">Được bổ sung th&ecirc;m canxi, vitamin D3 v&agrave; vitamin B12 gi&uacute;p xương chắc khoẻ hơn mỗi ng&agrave;y.&nbsp;Sữa đậu&nbsp;n&agrave;nh&nbsp;Fami&nbsp;thơm ngon, dễ uống, kh&ocirc;ng d&ugrave;ng chất bảo quản. Sản phẩm&nbsp;th&ugrave;ng 36 hộp sữa Fami Canxi 200ml&nbsp;được đ&oacute;ng th&ugrave;ng 36 hộp tiết kiệm, tiện d&ugrave;ng l&acirc;u d&agrave;i.</p>', 1, 'thung-36-hop-sua-dau-nanh-fami-canxi1652576050.jpg', '2022-05-15 07:54:10', '2022-05-15 07:54:10'),
(33, 'Thùng 48 hộp sữa tiệt trùng hương việt quất Nestlé NutriStrong 180ml', 5, 320000, 0, 10, '<p>Được bổ sung th&ecirc;m 25% canxi, vitamin A &amp; D,&nbsp;sữa tươi Nestle gi&uacute;p xương bạn khoẻ hơn mỗi ng&agrave;y. Sữa tươi Nestle được nhiều người ưa chuộng bởi nguồn dinh dưỡng dồi d&agrave;o m&agrave; n&oacute; lu&ocirc;n cung cấp cho cơ thể. Th&ugrave;ng 48 hộp sữa tiệt tr&ugrave;ng hương việt quất Nestl&eacute; NutriStrong 180ml đ&oacute;ng th&ugrave;ng tiết kiệm, hương việt ...</p>', 1, 'thung-48-hop-sua-tiet-trung-huong-viet-quat-nestle1652576177.jpg', '2022-05-15 07:56:17', '2022-05-15 07:56:17'),
(34, 'Thăn bò Úc tươi Trung Đồng hút chân không khay 250g', 10, 130000, 0, 2, '<p>Thăn b&ograve; &Uacute;c tươi h&uacute;t ch&acirc;n kh&ocirc;ng khay 250g c&oacute; một lớp mỡ mỏng bao phủ b&ecirc;n ngo&agrave;i phần nạc gi&uacute;p cho phần thịt khi chế biến kh&ocirc;ng bị kh&ocirc;. Bạn c&oacute; thể mua thịt thăn b&ograve; &uacute;c về &aacute;p chảo với bơ, đảm bảo m&oacute;n ăn mềm mọng nước, cả nh&agrave; ai cũng th&iacute;ch.</p>', 1, 'than-bo-uc-tuoi-hut-chan-khong-khay-250g1652576325.jpg', '2022-05-15 07:58:45', '2022-05-15 07:58:45'),
(35, 'Bít tết đùi bò Úc Pacow vỉ 250g', 10, 118000, 0, 2, '<p style=\"text-align:justify\">Phần thịt nạc nguy&ecirc;n quả nằm ngay ph&iacute;a tr&ecirc;n bắp ch&acirc;n sau của con b&ograve;. Miếng thịt rất nạc v&agrave; hơi kh&ocirc; ph&ugrave; hợp với chi&ecirc;n hoặc nướng theo tảng. Đặc biệt với m&oacute;n beefsteak,một m&oacute;n ăn ưa th&iacute;ch.&nbsp;B&iacute;t tết đ&ugrave;i b&ograve; &Uacute;c Pacow khay 250g được sản xuất ở &Uacute;c bởi Pacow, đ&atilde; được kiểm duyệt chặc chẽ n&ecirc;n đảm bảo an to&agrave;n.</p>', 1, 'bit-tet-dui-bo-uc-pascow-khay-250g1652576390.jpg', '2022-05-15 07:59:50', '2022-05-15 07:59:50'),
(36, 'Thùng 24 lon nước ngọt có ga Mirinda vị soda kem việt quất 320ml', 20, 235000, 0, 6, '<p style=\"text-align:justify\">Nước ngọt Mirinda&nbsp;soda kem vị việt quất ngọt ng&agrave;o tươi mới, vị soda kem b&ugrave;ng nổ c&ugrave;ng hương việt quất thơm ngon. H&atilde;y mua&nbsp;th&ugrave;ng 24 lon nước ngọt c&oacute; ga Mirinda vị soda kem việt quất 320ml&nbsp;để cảm nhận vị ngon kh&oacute; cưỡng v&agrave; c&ugrave;ng thưởng thức&nbsp;nước ngọt&nbsp;n&agrave;y với bạn b&egrave;, người th&acirc;n nh&eacute;!</p>', 1, 'thung-24-lon-nuoc-ngot-co-ga-mirinda-vi-soda-kem-viet-quat1652576526.jpg', '2022-05-15 08:02:06', '2022-05-15 08:02:06'),
(37, 'Thùng 24 chai nước tinh khiết Aquafina 500ml', 9, 100000, 0, 12, '<p>Được lấy từ nguồn nước ngầm đảm bảo&nbsp; trải qua quy tr&igrave;nh khử tr&ugrave;ng, lọc sạch c&aacute;c tạp chất. Nước tinh khiết Aquafina 500ml đ&atilde; đạt tới tr&igrave;nh độ nước tinh khiết&nbsp;c&oacute; t&aacute;c dụng dịu cơn kh&aacute;t, khi uống sẽ c&oacute; cảm gi&aacute;c hơi ngọt ở miệng, rất dễ uống. Nhỏ gọn tiện lợi dễ mang b&ecirc;n m&igrave;nh</p>', 1, 'thung-24-chai-nuoc-tinh-khiet-aquafina-500ml1652576672.jpg', '2022-05-15 08:04:32', '2022-05-15 08:04:32'),
(38, 'Thùng 24 chai nước khoáng Vivant 500ml', 9, 96000, 0, 12, '<p>Sản phẩm&nbsp;nước uống đ&oacute;ng chai&nbsp;từ thương hiệu&nbsp;Vivant.&nbsp;24 chai nước kho&aacute;ng Vivant 500ml&nbsp;từ nguồn kho&aacute;ng nổi tiếng từ Vĩnh Hảo v&agrave; Quang Hanh, dễ uống, chứa nhiều kho&aacute;ng chất h&ograve;a tan tự nhi&ecirc;n trong nước c&oacute; t&aacute;c dụng tốt cho sức khỏe con người. Cam kết ch&iacute;nh h&atilde;ng v&agrave; an to&agrave;n.</p>', 1, 'thung-24-chai-nuoc-khoang-vivant-500ml1652576769.jpg', '2022-05-15 08:06:09', '2022-05-15 08:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `MaThanhToan` int(11) NOT NULL,
  `TT_Ten` varchar(200) NOT NULL,
  `TT_DienGiai` text DEFAULT NULL,
  `TT_TrangThai` int(11) NOT NULL,
  `TT_BankCode` varchar(255) DEFAULT NULL,
  `TT_CodeVnpay` varchar(255) DEFAULT NULL,
  `TT_ResponseCode` varchar(255) DEFAULT NULL,
  `TT_TaoMoi` datetime NOT NULL,
  `TT_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thanhtoan`
--

INSERT INTO `thanhtoan` (`MaThanhToan`, `TT_Ten`, `TT_DienGiai`, `TT_TrangThai`, `TT_BankCode`, `TT_CodeVnpay`, `TT_ResponseCode`, `TT_TaoMoi`, `TT_CapNhat`) VALUES
(4, 'Thanh Toán Khi Nhận Hàng', NULL, 0, NULL, NULL, NULL, '2022-03-15 15:10:54', '2022-03-15 15:10:54'),
(5, 'Thanh Toán Khi Nhận Hàng', NULL, 1, NULL, NULL, NULL, '2022-03-15 15:42:15', '2022-03-15 15:42:15'),
(6, 'Thanh Toán Bằng VnPay', 'Thanh toan don hang', 2, 'NCB', '20220315215345', '00', '2022-03-15 21:57:09', '2022-03-15 21:57:09'),
(7, 'Thanh Toán Bằng Ví MOMO', 'Thanh toán qua MoMo', 1, 'MOMO', '1650624253132', '1005', '2022-04-22 17:44:17', '2022-04-22 17:44:17'),
(8, 'Thanh Toán Khi Nhận Hàng', 'Thanh toan don hang', 0, NULL, NULL, NULL, '2022-04-22 17:50:46', '2022-04-22 17:50:46'),
(9, 'Thanh Toán Bằng Ví MOMO', 'Thanh toán qua MoMo', 1, 'MOMO', '1650624791281', '1005', '2022-04-22 17:53:14', '2022-04-22 17:53:14'),
(10, 'Thanh Toán Khi Nhận Hàng', 'Thanh toan don hang', 0, NULL, NULL, NULL, '2022-05-13 15:19:05', '2022-05-13 15:19:05'),
(11, 'Thanh Toán Khi Nhận Hàng', 'Thanh toan don hang', 0, NULL, NULL, NULL, '2022-05-13 15:21:08', '2022-05-13 15:21:08'),
(12, 'Thanh Toán Khi Nhận Hàng', 'Thanh toan don hang', 0, NULL, NULL, NULL, '2022-05-13 15:23:04', '2022-05-13 15:23:04'),
(13, 'Thanh Toán Bằng VnPay', 'Thanh toan don hang', 1, 'NCB', 'VNP13746639', '00', '2022-05-15 08:08:24', '2022-05-15 08:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `yeuthich`
--

CREATE TABLE `yeuthich` (
  `Ma` int(11) NOT NULL,
  `MSSP` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yeuthich`
--

INSERT INTO `yeuthich` (`Ma`, `MSSP`, `MSKH`, `created_at`, `updated_at`) VALUES
(6, 22, 1, '2022-03-07 19:20:29', '2022-03-07 19:20:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSSP` (`MSSP`);

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`MSDH`,`MSSP`),
  ADD KEY `MSSP` (`MSSP`);

--
-- Indexes for table `chitietphieuthu`
--
ALTER TABLE `chitietphieuthu`
  ADD PRIMARY KEY (`MaPhieu`,`MSSP`),
  ADD KEY `MSHH` (`MSSP`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`MSDH`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `MaThanhToan` (`MaThanhToan`);

--
-- Indexes for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Indexes for table `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MSSP` (`MSSP`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Indexes for table `loaihang`
--
ALTER TABLE `loaihang`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- Indexes for table `phieuthu`
--
ALTER TABLE `phieuthu`
  ADD PRIMARY KEY (`MaPhieu`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MSSP`),
  ADD KEY `MaDM` (`MaDM`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`MaThanhToan`);

--
-- Indexes for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD PRIMARY KEY (`Ma`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSSP` (`MSSP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dathang`
--
ALTER TABLE `dathang`
  MODIFY `MSDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaihang`
--
ALTER TABLE `loaihang`
  MODIFY `MaLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phieuthu`
--
ALTER TABLE `phieuthu`
  MODIFY `MaPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MSSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `MaThanhToan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `yeuthich`
--
ALTER TABLE `yeuthich`
  MODIFY `Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`MSSP`) REFERENCES `sanpham` (`MSSP`);

--
-- Constraints for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`MSSP`) REFERENCES `sanpham` (`MSSP`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`MSDH`) REFERENCES `dathang` (`MSDH`);

--
-- Constraints for table `chitietphieuthu`
--
ALTER TABLE `chitietphieuthu`
  ADD CONSTRAINT `chitietphieuthu_ibfk_1` FOREIGN KEY (`MSSP`) REFERENCES `sanpham` (`MSSP`),
  ADD CONSTRAINT `chitietphieuthu_ibfk_2` FOREIGN KEY (`MaPhieu`) REFERENCES `phieuthu` (`MaPhieu`);

--
-- Constraints for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD CONSTRAINT `danhmuc_ibfk_1` FOREIGN KEY (`MaLoai`) REFERENCES `loaihang` (`MaLoai`);

--
-- Constraints for table `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  ADD CONSTRAINT `dathang_ibfk_3` FOREIGN KEY (`MaThanhToan`) REFERENCES `thanhtoan` (`MaThanhToan`);

--
-- Constraints for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Constraints for table `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `hinhanh_ibfk_1` FOREIGN KEY (`MSSP`) REFERENCES `sanpham` (`MSSP`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`);

--
-- Constraints for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD CONSTRAINT `yeuthich_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `yeuthich_ibfk_2` FOREIGN KEY (`MSSP`) REFERENCES `sanpham` (`MSSP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
