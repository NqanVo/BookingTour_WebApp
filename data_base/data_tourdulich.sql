-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 25, 2022 lúc 03:24 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `data_tourdulich`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_dangkytour`
--

CREATE TABLE `tbl_dangkytour` (
  `id_dangkytour` int(200) NOT NULL,
  `id_donvi` int(200) NOT NULL,
  `id_nhanvien` int(200) NOT NULL,
  `id_tourdulich` int(200) NOT NULL,
  `tentour_dangkytour` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ngaydi_dangkytour` date NOT NULL,
  `ngayve_dangkytour` date NOT NULL,
  `ngaydangky_dangkytour` date NOT NULL,
  `soluong_dangkytour` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_dangkytour`
--

INSERT INTO `tbl_dangkytour` (`id_dangkytour`, `id_donvi`, `id_nhanvien`, `id_tourdulich`, `tentour_dangkytour`, `ngaydi_dangkytour`, `ngayve_dangkytour`, `ngaydangky_dangkytour`, `soluong_dangkytour`) VALUES
(34, 1, 1, 20, 'Tp.HCM - Hội An - La Vang - Động Phong Nha - Huế 4 ngày 3 đêm Có Vé Máy Bay', '2022-07-23', '2022-07-26', '2022-07-06', '2'),
(35, 1, 2, 20, 'Tp.HCM - Hội An - La Vang - Động Phong Nha - Huế 4 ngày 3 đêm Có Vé Máy Bay', '2022-07-23', '2022-07-26', '2022-07-06', '1'),
(36, 1, 6, 13, 'Du Lịch Miền Tây: Đà Nẵng - Sóc Trăng - Bạc Liêu - Cà Mau - Đất Mũi - Cần Thơ 4 Ngày, Bay Vietjet Air + KS 3*', '2022-07-26', '2022-07-29', '2022-07-06', '1'),
(37, 1, 2, 13, 'Du Lịch Miền Tây: Đà Nẵng - Sóc Trăng - Bạc Liêu - Cà Mau - Đất Mũi - Cần Thơ 4 Ngày, Bay Vietjet Air + KS 3*', '2022-07-26', '2022-07-29', '2022-07-08', '1'),
(38, 1, 2, 10, 'Du Lịch Hạ Long Cao Cấp: Hà Nội - Hạ Long 3N2Đ - Du thuyền 5 sao & Khách sạn Hạ Long 5 sao', '2022-07-23', '2022-07-27', '2022-07-08', '2'),
(39, 1, 1, 22, 'Test', '2022-07-22', '2022-07-25', '2022-07-18', '3'),
(40, 2, 19, 22, 'Test', '2022-07-22', '2022-07-25', '2022-07-19', '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_dangkytour_chitiet`
--

CREATE TABLE `tbl_dangkytour_chitiet` (
  `id_dangkytour_chitiet` int(200) NOT NULL,
  `ten_dangkytour_chitiet` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `sdt_dangkytour_chitiet` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `cccd_dangkytour_chitiet` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `gioitinh_dangkytour_chitiet` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `quanhe_dangkytour_chitiet` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `thanhtien_dangkytour_chitiet` int(200) NOT NULL,
  `status_dangkytour_chitiet` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `id_dangkytour` int(200) NOT NULL,
  `id_tourdulich` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_dangkytour_chitiet`
--

INSERT INTO `tbl_dangkytour_chitiet` (`id_dangkytour_chitiet`, `ten_dangkytour_chitiet`, `sdt_dangkytour_chitiet`, `cccd_dangkytour_chitiet`, `gioitinh_dangkytour_chitiet`, `quanhe_dangkytour_chitiet`, `thanhtien_dangkytour_chitiet`, `status_dangkytour_chitiet`, `id_dangkytour`, `id_tourdulich`) VALUES
(53, 'Võ Nguyễn Phúc Ngân', '0911222333', '0123456789', 'nam', 'daidien', 5500000, '1', 34, 20),
(54, 'Võ Nguyễn Phúc Ngân 2', '123456', '68766575675', 'nam', 'nguoithan', 6100000, '1', 34, 20),
(55, 'Trần Thiên Vạn', '0999994566', '0123448588', 'nam', 'daidien', 6100000, '0', 35, 20),
(56, 'Trần Văn B', '091111911', '012345678', 'nam', 'daidien', 5849000, '1', 36, 13),
(57, 'Trần Thiên Vạn', '0999994566', '0123448588', 'nam', 'daidien', 5999000, '0', 37, 13),
(58, 'Trần Thiên Vạn', '0999994566', '0123448588', 'nam', 'daidien', 2849000, '1', 38, 10),
(59, 'Võ Nguyễn Phúc Ngân 2', '3423432', '432432432', 'nam', 'nguoithan', 2999000, '1', 38, 10),
(60, 'Võ Nguyễn Phúc Ngân', '0911222333', '0123456789', 'nam', 'daidien', 2000000, '1', 39, 22),
(61, 'Võ Nguyễn Phúc Ngân 2', '222222222222', '333333333', 'nam', 'nguoithan', 2000000, '1', 39, 22),
(62, 'Võ Nguyễn Phúc Ngân 3', '543543', '3333', 'nam', 'nguoithan', 2000000, '1', 39, 22),
(63, '3RacObaMa', '0834022222', '012343333333', 'nam', 'daidien', 1850000, '1', 40, 22),
(64, '5RacObaMa', '1234566666', '222222233333', 'nu', 'nguoithan', 2000000, '1', 40, 22);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_diadiem`
--

CREATE TABLE `tbl_diadiem` (
  `id_diadiem` int(100) NOT NULL,
  `ten_diadiem` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_diadiem`
--

INSERT INTO `tbl_diadiem` (`id_diadiem`, `ten_diadiem`) VALUES
(1, 'An Giang'),
(2, 'Bà Rịa – Vũng Tàu'),
(3, 'Bạc Liêu'),
(4, 'Bắc Giang'),
(5, 'Bắc Kạn'),
(6, 'Bắc Ninh'),
(7, 'Bến Tre'),
(8, 'Bình Dương'),
(9, 'Bình Định'),
(10, 'Bình Phước'),
(11, 'Bình Thuận'),
(12, 'Cà Mau'),
(13, 'Cao Bằng'),
(14, 'Cần Thơ'),
(15, 'Đà Nẵng'),
(16, 'Đắk Lắk'),
(17, 'Đắk Nông'),
(18, 'Điện Biên'),
(19, 'Đồng Nai'),
(20, 'Đồng Tháp'),
(21, 'Gia Lai'),
(22, 'Hà Giang'),
(23, 'Hà Nam'),
(24, 'Hà Nội'),
(25, 'Hà Tĩnh'),
(26, 'Hải Dương'),
(27, 'Hải Phòng'),
(28, 'Hậu Giang'),
(29, 'Hòa Bình'),
(30, 'Thành phố Hồ Chí Minh'),
(31, 'Hưng Yên'),
(32, 'Khánh Hòa'),
(33, 'Kiên Giang'),
(34, 'Kon Tum'),
(35, 'Lai Châu'),
(36, 'Lạng Sơn'),
(37, 'Lào Cai'),
(38, 'Lâm Đồng'),
(39, 'Long An'),
(40, 'Nam Định'),
(41, 'Nghệ An'),
(42, 'Ninh Bình'),
(43, 'Ninh Thuận'),
(44, 'Phú Thọ'),
(45, 'Phú Yên'),
(46, 'Quảng Bình'),
(47, 'Quảng Nam'),
(48, 'Quảng Ngãi'),
(49, 'Quảng Ninh'),
(50, 'Quảng Trị'),
(51, 'Sóc Trăng'),
(52, 'Sơn La'),
(53, 'Tây Ninh'),
(54, 'Thái Bình'),
(55, 'Thái Nguyên'),
(56, 'Thanh Hóa'),
(57, 'Thừa Thiên Huế'),
(58, 'Tiền Giang'),
(59, 'Trà Vinh'),
(60, 'Tuyên Quang'),
(61, 'Vĩnh Long'),
(62, 'Vĩnh Phúc'),
(63, 'Yên Bái');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_donvi`
--

CREATE TABLE `tbl_donvi` (
  `id_donvi` int(200) NOT NULL,
  `ten_donvi` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_donvi`
--

INSERT INTO `tbl_donvi` (`id_donvi`, `ten_donvi`) VALUES
(1, 'Trung Tâm Công Nghệ Thông Tin'),
(2, 'Trung Tâm Hệ Thống Thông Tin'),
(10, 'a'),
(11, 'b'),
(12, 'c'),
(13, 'd'),
(14, 'e'),
(15, 'f'),
(16, 'g'),
(17, 'h'),
(18, '32432'),
(19, 'ereter');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hotro_kinhphi`
--

CREATE TABLE `tbl_hotro_kinhphi` (
  `id_hotro_kinhphi` int(200) NOT NULL,
  `tunam_hotro_kinhphi` year(4) NOT NULL,
  `dennam_hotro_kinhphi` year(4) NOT NULL,
  `tongtien_hotro_kinhphi` int(200) NOT NULL,
  `status_hotro_kinhphi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_hotro_kinhphi`
--

INSERT INTO `tbl_hotro_kinhphi` (`id_hotro_kinhphi`, `tunam_hotro_kinhphi`, `dennam_hotro_kinhphi`, `tongtien_hotro_kinhphi`, `status_hotro_kinhphi`) VALUES
(2, 2018, 2021, 200000000, '0'),
(3, 2021, 2022, 200000000, '0'),
(6, 2022, 2023, 2147483647, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hotro_kinhphi_chitiet2`
--

CREATE TABLE `tbl_hotro_kinhphi_chitiet2` (
  `id_hotro_kinhphi_chitiet` int(200) NOT NULL,
  `thamnien_hotro_kinhphi_chitiet` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tien_hotro_kinhphi_chitiet` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_hotro_kinhphi` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_hotro_kinhphi_chitiet2`
--

INSERT INTO `tbl_hotro_kinhphi_chitiet2` (`id_hotro_kinhphi_chitiet`, `thamnien_hotro_kinhphi_chitiet`, `tien_hotro_kinhphi_chitiet`, `id_hotro_kinhphi`) VALUES
(1, '0', '100000', 3),
(2, '3', '1000000', 3),
(3, '5', '1500000', 3),
(4, '6', '1222222', 3),
(9, '0', '6', 2),
(10, '0', '150000', 6),
(11, '3', '600000', 6),
(12, '5', '800000', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhanvien`
--

CREATE TABLE `tbl_nhanvien` (
  `id_nhanvien` int(200) NOT NULL,
  `id_phongban` int(200) NOT NULL,
  `ten_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `sdt_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `diachi_nhanvien` varchar(400) COLLATE utf8_unicode_520_ci NOT NULL,
  `email_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `cccd_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `gioitinh_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `ngayvaolam_nhanvien` date NOT NULL,
  `chucvu_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `taikhoan_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL,
  `matkhau_nhanvien` varchar(400) COLLATE utf8_unicode_520_ci NOT NULL,
  `status_nhanvien` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`id_nhanvien`, `id_phongban`, `ten_nhanvien`, `sdt_nhanvien`, `diachi_nhanvien`, `email_nhanvien`, `cccd_nhanvien`, `gioitinh_nhanvien`, `ngayvaolam_nhanvien`, `chucvu_nhanvien`, `taikhoan_nhanvien`, `matkhau_nhanvien`, `status_nhanvien`) VALUES
(1, 3, 'Võ Nguyễn Phúc Ngân', '0911222333', 'Bến Tre, Việt Nam, Trái Đất', 'ngan@gmail.com', '0123456789', 'nam', '2018-06-01', '0', 'ngan123', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(2, 4, 'Trần Thiên Vạn', '0999994566', 'Bến Tre, Việt Nam, Trái Đất, Vũ Trụ 6', 'van@gmail.com', '0123448588', 'nam', '2022-06-16', '1', 'van123', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(6, 3, 'Trần Văn B', '091111911', 'Tiền Giang', 'vanb@gmail.com', '012345678', 'nam', '2022-06-17', '2', 'user0', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(9, 3, 'Trần Văn CC', '098694378', 'Tiền Giang', 'vanc@gmail.com', '0123456789', 'nam', '2022-06-18', '2', 'user1', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(11, 3, 'Trần Văn D', '0834011111', 'Tiền Giang', 'vanb@gmail.com', '01234567892', 'nam', '2022-07-19', '2', 'user2', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(12, 3, 'Nguyễn Thị Á', '0111111111', 'Bến Tre', 'thia@gmail.com', '01112222222', 'nu', '2022-07-19', '2', 'user3', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(13, 3, 'Nguyễn Thị À', '0111111122', 'Bến Tre', 'thiaa@gmail.com', '01112222223', 'nu', '2022-07-19', '2', 'user4', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(14, 3, 'Nguyễn Thị Ả', '0111144122', 'Bến Tre', 'thiaaa@gmail.com', '01112422223', 'nu', '2022-07-19', '2', 'user5', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(15, 3, 'Trần Văn O', '0111164125', 'Tiền Giang', 'trano@gmail.com', '01112322225', 'nam', '2022-07-19', '2', 'user7', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(16, 3, 'Trần Văn Ó', '0111164127', 'Tiền Giang', 'tranoo@gmail.com', '01112322227', 'nam', '2022-07-19', '2', 'user8', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(17, 3, 'Trần Văn Ỏ', '0111129127', 'Tiền Giang', 'tranooo@gmail.com', '01112333327', 'nam', '2022-07-19', '2', 'user9', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(18, 3, 'Trần Văn Ò', '0111129199', 'Tiền Giang', 'tranoooo@gmail.com', '01112333399', 'nam', '2022-07-19', '2', 'user10', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(19, 22, '3RacObaMa', '0834022222', 'LA', 'obama@gmail.com', '012343333333', 'nam', '2022-07-19', '2', 'obama123', 'e10adc3949ba59abbe56e057f20f883e', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhan_hotro`
--

CREATE TABLE `tbl_nhan_hotro` (
  `id_nhan_hotro` int(200) NOT NULL,
  `id_hotro_kinhphi` int(200) NOT NULL,
  `id_nhanvien` int(200) NOT NULL,
  `id_tourdulich` int(200) NOT NULL,
  `sotien_nhan_hotro` int(200) NOT NULL,
  `status_nhan_hotro` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nhan_hotro`
--

INSERT INTO `tbl_nhan_hotro` (`id_nhan_hotro`, `id_hotro_kinhphi`, `id_nhanvien`, `id_tourdulich`, `sotien_nhan_hotro`, `status_nhan_hotro`) VALUES
(47, 6, 1, 20, 600000, '0'),
(49, 6, 6, 13, 150000, '0'),
(55, 6, 2, 10, 150000, '0'),
(56, 6, 19, 22, 150000, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_phongban`
--

CREATE TABLE `tbl_phongban` (
  `id_phongban` int(200) NOT NULL,
  `id_donvi` int(200) NOT NULL,
  `ten_phongban` varchar(200) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_phongban`
--

INSERT INTO `tbl_phongban` (`id_phongban`, `id_donvi`, `ten_phongban`) VALUES
(3, 1, 'Phòng Nghiên Cứu Và Phát Triển'),
(4, 1, 'Phòng Phát Triển Và Nghiên Cứu'),
(15, 1, 'v'),
(16, 1, '4'),
(17, 1, 'f'),
(18, 1, 's'),
(19, 1, 'u'),
(20, 1, '5'),
(21, 1, 'tr'),
(22, 2, 'Phòng HAHAHAHHA');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thongke_donvi_dangky`
--

CREATE TABLE `tbl_thongke_donvi_dangky` (
  `id_thongke` int(200) NOT NULL,
  `id_donvi` int(200) NOT NULL,
  `sotour_thongke` int(200) NOT NULL,
  `ngay_thongke` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_thongke_donvi_dangky`
--

INSERT INTO `tbl_thongke_donvi_dangky` (`id_thongke`, `id_donvi`, `sotour_thongke`, `ngay_thongke`) VALUES
(24, 1, 4, '2022-07-20'),
(25, 2, 1, '2022-07-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_tourdulich`
--

CREATE TABLE `tbl_tourdulich` (
  `id_tourdulich` int(200) NOT NULL,
  `donvi_tourdulich` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_tourdulich` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gia_tourdulich` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `img_tourdulich` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `dangkytruoc_tourdulich` date NOT NULL,
  `ngaydi_tourdulich` date NOT NULL,
  `ngayve_tourdulich` date NOT NULL,
  `diadiem_tourdulich` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mota_tourdulich` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `noidung_tourdulich` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chitiet_tourdulich` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `soluongdadangky_tourdulich` int(200) NOT NULL,
  `soluongtoida_tourdulich` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_tourdulich`
--

INSERT INTO `tbl_tourdulich` (`id_tourdulich`, `donvi_tourdulich`, `ten_tourdulich`, `gia_tourdulich`, `img_tourdulich`, `dangkytruoc_tourdulich`, `ngaydi_tourdulich`, `ngayve_tourdulich`, `diadiem_tourdulich`, `mota_tourdulich`, `noidung_tourdulich`, `chitiet_tourdulich`, `soluongdadangky_tourdulich`, `soluongtoida_tourdulich`) VALUES
(10, '1', 'Du Lịch Hạ Long Cao Cấp: Hà Nội - Hạ Long 3N2Đ - Du thuyền 5 sao & Khách sạn Hạ Long 5 sao', '2999000', '1655694963_ha-long.jpg', '2022-07-15', '2022-07-23', '2022-07-27', 'Quảng Ninh', ' KHÁM PHÁ VẺ ĐẸP THIÊN NHIÊN CỦA TUẦN CHÂU - HẠ LONG', '<p>Vịnh Hạ Long&nbsp;ở về ph&iacute;a Đ&ocirc;ng Bắc Việt Nam, c&aacute;ch Thủ đ&ocirc; H&agrave; Nội 165 km. Vịnh Hạ Long l&agrave; một phần s&aacute;t bờ ph&iacute;a T&acirc;y của Vịnh Bắc Bộ, l&agrave; biển của th&agrave;nh phố Hạ Long v&agrave; thị x&atilde; Cẩm Phả thuộc tỉnh Quảng Ninh.</p>\r\n', '1655694623_de tai.pdf', 2, 40),
(11, '0', 'Du Lịch Phú Quốc: Hà Nội - Phú Quốc 4 Ngày Siêu Kích Cầu + Vé Máy Bay', '4890000', '1655568499_phu-quoc.jpg', '2022-07-15', '2022-07-23', '2022-07-27', 'Kiên Giang', 'Phú Quốc là một huyện đảo thuộc tỉnh Kiên Giang, bạn có thể đến Phú Quốc bằng 2 phương tiện chính, đó là: đi máy bay từ Hà Nội vào Phú Quốc hoặc đi tàu cao tốc từ Rạch Giá - Hà Tiên.', '<p>Ph&uacute; Quốc&nbsp;được&nbsp;mọi người mệnh danh l&agrave; Đảo Ngọc của Việt Nam. Sở dĩ Ph&uacute; Quốc c&oacute; c&aacute;i t&ecirc;n như vậy l&agrave; bởi nơi đ&acirc;y c&oacute; bờ c&aacute;t trắng, nước biển trong xanh, c&ugrave;ng với rất nhiều c&aacute;c loại sinh vật biển đa dang v&agrave; phong ph&uacute; đ&atilde; khiến cho Ph&uacute; Quốc trở th&agrave;nh &quot;thi&ecirc;n đường Đảo</p>\r\n', '1655568499_S1-E-Book-How-To-Make-Hits.pdf', 0, 50),
(12, '0', 'Du Lịch Nha Trang: Hà Nội - Nha Trang Thành Phố Biển 4 Ngày + Vé Máy Bay', '7090000', '1655568716_nha-trang.jpg', '2022-07-15', '2022-07-29', '2022-07-31', 'Khánh Hòa', 'Tour du lịch Nha Trang 4 ngày từ Hà Nội luôn chào đón tất cả du khách khám phá những bãi biển trong xanh, cùng những thắng cảnh nổi tiếng đã làm say đắm tất cả du khách khi đến với vùng biển tuyệt đẹp này.', '<p><strong>Vinpearl Land</strong>&nbsp;l&agrave; khu vui chơi giải tr&iacute; nổi tiếng, tại đ&acirc;y bạn c&oacute; thể thỏa sức đu quay cảm gi&aacute;c mạnh, đu quay d&acirc;y văng, đu quay th&uacute; nh&uacute;n, đu quay con voi, t&agrave;u lượn si&ecirc;u tốc, đu quay v&ograve;ng xoay, xe đạp bay, t&agrave;u hải tặc, xiếc th&uacute;&hellip;</p>\r\n', '1655568716_S1-E-Book-How-To-Make-Hits.pdf', 0, 50),
(13, '1', 'Du Lịch Miền Tây: Đà Nẵng - Sóc Trăng - Bạc Liêu - Cà Mau - Đất Mũi - Cần Thơ 4 Ngày, Bay Vietjet Air + KS 3*', '5999000', '1655568891_mien-tay.jpg', '2022-07-15', '2022-07-26', '2022-07-29', 'Sóc Trăng', 'Miền Tây được thiên nhiên ưu ái với khí hậu ôn hòa, dễ chịu quanh năm.', '<p>Miền T&acirc;y được thi&ecirc;n nhi&ecirc;n ưu &aacute;i với kh&iacute; hậu &ocirc;n h&ograve;a, dễ chịu quanh năm. Do đ&oacute;, bạn c&oacute; thể đến đ&acirc;y v&agrave;o bất cứ thời điểm n&agrave;o. Mỗi m&ugrave;a, c&aacute;c địa điểm du lịch ở miền T&acirc;y đều c&oacute; những hoạt động ri&ecirc;ng biệt, độc đ&aacute;o v&agrave; hứa hẹn sẽ đem đến cho bạn nhiều trải nghiệm th&uacute; vị nh</p>\r\n', '1655568891_S1-E-Book-How-To-Make-Hits.pdf', 1, 100),
(14, '0', 'Du Lịch Quy Nhơn & Tuy Hoà : Hà Nội - Quy Nhơn - Tuy Hòa 4N3Đ (Đi Quy Nhơn - Về Tuy Hoà)', '5600000', '1655569153_quy-nhon.jpg', '2022-07-15', '2022-07-30', '2022-07-31', 'Bình Định', 'Đến với Quy Nhơn, bạn có thể tắm biển ngay ở những bãi gần trung tâm mà không phải đi xa. ', '<p>Ghềnh R&aacute;ng&nbsp;trải d&agrave;i dọc bờ biển trong xanh, v&agrave; từ đ&acirc;y c&oacute; thể nh&igrave;n thấy th&agrave;nh phố Quy Nhơn. Nơi đ&acirc;y c&oacute; b&atilde;i Đ&aacute; Trứng với v&ocirc; số h&ograve;n đ&aacute; tr&ograve;n nhẵn như trứng chim khổng lồ, b&atilde;i tắm Ho&agrave;ng Hậu. &nbsp;Mộ nh&agrave; thơ H&agrave;n Mặc Tử nằm tr&ecirc;n đồi Thi Nh&acirc;n v&agrave; Lầu</p>\r\n', '1655569153_S1-E-Book-How-To-Make-Hits.pdf', 0, 60),
(15, '2', 'Du Lịch Đà Lạt: Hà Nội - Đà Lạt Thành Phố Ngàn Hoa 3 Ngày + Bay Vietnam Airlines', '5390000', '1655569290_da-lat.jpg', '2022-07-15', '2022-07-23', '2022-07-30', 'Lâm Đồng', 'Đà Lạt là một thành phố cao nguyên được ví như một ốc đảo trên núi.', '<p>Đ&agrave; Lạt l&agrave; một th&agrave;nh phố cao nguy&ecirc;n được v&iacute; như một ốc đảo tr&ecirc;n n&uacute;i. L&agrave; một th&agrave;nh phố Việt Nam nhưng Đ&agrave; Lạt mang hơi thở của Ph&aacute;p, kh&iacute; hậu của Ph&aacute;p v&agrave; ảnh hưởng nhiều theo kiến tr&uacute;c Ph&aacute;p. Ti&ecirc;u biểu cho kiến tr&uacute;c cổ điển Ph&aacute;p th&igrave; kh&ocirc;ng thể kh&ocirc;ng nhắc</p>\r\n', '1655569290_S1-E-Book-How-To-Make-Hits.pdf', 0, 60),
(19, '2', 'Tp.HCM-Đà Nẵng - Bà Nà - Hội An - La Vang - Động Phong Nha - Huế 4 ngày 3 đêm Có Vé Máy Bay', '5390000', '1656643661_da-nang.jpg', '2022-07-15', '2022-07-23', '2022-07-27', 'Đà Nẵng', 'Đà Nẵng nằm giữa ba di sản thế giới: cố đô Huế, phố cổ Hội An và thánh địa Mỹ Sơn. Đà Nẵng còn có nhiều danh thắng tuyệt đẹp say lòng du khách như Ngũ Hành Sơn, Bà Nà, bán đảo Sơn Trà, đèo Hải Vân, sông Hàn thơ mộng và cầu quay Sông Hàn – niềm tự hào của thành phố, và biển Mỹ Khê đẹp nhất hành tinh.', '<p>Đ&agrave; Nẵng nằm giữa ba di sản thế giới: cố đ&ocirc; Huế, phố cổ Hội An v&agrave; th&aacute;nh địa Mỹ Sơn. Đ&agrave; Nẵng c&ograve;n c&oacute; nhiều danh thắng tuyệt đẹp say l&ograve;ng du kh&aacute;ch như Ngũ H&agrave;nh Sơn, B&agrave; N&agrave;, b&aacute;n đảo Sơn Tr&agrave;, đ&egrave;o Hải V&acirc;n, s&ocirc;ng H&agrave;n thơ mộng v&agrave; cầu quay S&ocirc;ng H&agrave;n &ndash; niềm tự h&agrave;o của th&agrave;nh phố, v&agrave; biển Mỹ Kh&ecirc; đẹp nhất h&agrave;nh tinh.&nbsp;Đ&agrave; Nẵng nằm giữa ba di sản thế giới: cố đ&ocirc; Huế, phố cổ Hội An v&agrave; th&aacute;nh địa Mỹ Sơn. Đ&agrave; Nẵng c&ograve;n c&oacute; nhiều danh thắng tuyệt đẹp say l&ograve;ng du kh&aacute;ch như Ngũ H&agrave;nh Sơn, B&agrave; N&agrave;, b&aacute;n đảo Sơn Tr&agrave;, đ&egrave;o Hải V&acirc;n, s&ocirc;ng H&agrave;n thơ mộng v&agrave; cầu quay S&ocirc;ng H&agrave;n &ndash; niềm tự h&agrave;o của th&agrave;nh phố, v&agrave; biển Mỹ Kh&ecirc; đẹp nhất h&agrave;nh tinh.</p>\r\n\r\n<p>Đ&agrave; Nẵng nằm giữa ba di sản thế giới: cố đ&ocirc; Huế, phố cổ Hội An v&agrave; th&aacute;nh địa Mỹ Sơn. Đ&agrave; Nẵng c&ograve;n c&oacute; nhiều danh thắng tuyệt đẹp say l&ograve;ng du kh&aacute;ch như Ngũ H&agrave;nh Sơn, B&agrave; N&agrave;, b&aacute;n đảo Sơn Tr&agrave;, đ&egrave;o Hải V&acirc;n, s&ocirc;ng H&agrave;n thơ mộng v&agrave; cầu quay S&ocirc;ng H&agrave;n &ndash; niềm tự h&agrave;o của th&agrave;nh phố, v&agrave; biển Mỹ Kh&ecirc; đẹp nhất h&agrave;nh tinh.&nbsp;Đ&agrave; Nẵng nằm giữa ba di sản thế giới: cố đ&ocirc; Huế, phố cổ Hội An v&agrave; th&aacute;nh địa Mỹ Sơn. Đ&agrave; Nẵng c&ograve;n c&oacute; nhiều danh thắng tuyệt đẹp say l&ograve;ng du kh&aacute;ch như Ngũ H&agrave;nh Sơn, B&agrave; N&agrave;, b&aacute;n đảo Sơn Tr&agrave;, đ&egrave;o Hải V&acirc;n, s&ocirc;ng H&agrave;n thơ mộng v&agrave; cầu quay S&ocirc;ng H&agrave;n &ndash; niềm tự h&agrave;o của th&agrave;nh phố, v&agrave; biển Mỹ Kh&ecirc; đẹp nhất h&agrave;nh tinh.</p>\r\n', '1656643661_de tai.pdf', 0, 100),
(20, '1', 'Tp.HCM - Hội An - La Vang - Động Phong Nha - Huế 4 ngày 3 đêm Có Vé Máy Bay', '6100000', '1656644032_hoi-an.jpg', '2022-07-15', '2022-07-23', '2022-07-26', 'Quảng Nam', 'Tour Mỹ Sơn Hội An khám phá di sản văn hoá thế giới Thánh địa Mỹ Sơn kết hợp tham quan phố cổ Hội An, ăn trưa đặc sản Hội An hoặc bê thui cầu mống, ghép đoàn hàng ngày khởi hành từ Đà Nẵng và Hội An.', '<p>Tour Mỹ Sơn Hội An kh&aacute;m ph&aacute; di sản văn ho&aacute; thế giới Th&aacute;nh địa Mỹ Sơn kết hợp tham quan phố cổ Hội An, ăn trưa đặc sản Hội An hoặc b&ecirc; thui cầu mống, gh&eacute;p đo&agrave;n h&agrave;ng ng&agrave;y khởi h&agrave;nh từ Đ&agrave; Nẵng v&agrave; Hội An.Tour Mỹ Sơn Hội An kh&aacute;m ph&aacute; di sản văn ho&aacute; thế giới Th&aacute;nh địa Mỹ Sơn kết hợp tham quan phố cổ Hội An, ăn trưa đặc sản Hội An hoặc b&ecirc; thui cầu mống, gh&eacute;p đo&agrave;n h&agrave;ng ng&agrave;y khởi h&agrave;nh từ Đ&agrave; Nẵng v&agrave; Hội An.</p>\r\n\r\n<p>Tour Mỹ Sơn Hội An kh&aacute;m ph&aacute; di sản văn ho&aacute; thế giới Th&aacute;nh địa Mỹ Sơn kết hợp tham quan phố cổ Hội An, ăn trưa đặc sản Hội An hoặc b&ecirc; thui cầu mống, gh&eacute;p đo&agrave;n h&agrave;ng ng&agrave;y khởi h&agrave;nh từ Đ&agrave; Nẵng v&agrave; Hội An.Tour Mỹ Sơn Hội An kh&aacute;m ph&aacute; di sản văn ho&aacute; thế giới Th&aacute;nh địa Mỹ Sơn kết hợp tham quan phố cổ Hội An, ăn trưa đặc sản Hội An hoặc b&ecirc; thui cầu mống, gh&eacute;p đo&agrave;n h&agrave;ng ng&agrave;y khởi h&agrave;nh từ Đ&agrave; Nẵng v&agrave; Hội An.</p>\r\n', '1656644032_de tai.pdf', 2, 110),
(22, '0', 'Test', '2000000', '1658112051_Ảnh chụp màn hình (1).png', '2022-07-21', '2022-07-22', '2022-07-25', 'An Giang', '123', '<p>12</p>\r\n', '1658112051_de tai.pdf', 5, 2147483647);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_tourdulich_liked`
--

CREATE TABLE `tbl_tourdulich_liked` (
  `id_tourdulich_liked` int(11) NOT NULL,
  `id_tourdulich` int(11) NOT NULL,
  `id_nhanvien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_tourdulich_liked`
--

INSERT INTO `tbl_tourdulich_liked` (`id_tourdulich_liked`, `id_tourdulich`, `id_nhanvien`) VALUES
(11, 15, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_dangkytour`
--
ALTER TABLE `tbl_dangkytour`
  ADD PRIMARY KEY (`id_dangkytour`),
  ADD KEY `id_nhanvien` (`id_nhanvien`),
  ADD KEY `id_tourdulich` (`id_tourdulich`),
  ADD KEY `id_donvi` (`id_donvi`);

--
-- Chỉ mục cho bảng `tbl_dangkytour_chitiet`
--
ALTER TABLE `tbl_dangkytour_chitiet`
  ADD PRIMARY KEY (`id_dangkytour_chitiet`),
  ADD KEY `id_dangkytour` (`id_dangkytour`),
  ADD KEY `id_tourdulich` (`id_tourdulich`);

--
-- Chỉ mục cho bảng `tbl_diadiem`
--
ALTER TABLE `tbl_diadiem`
  ADD PRIMARY KEY (`id_diadiem`);

--
-- Chỉ mục cho bảng `tbl_donvi`
--
ALTER TABLE `tbl_donvi`
  ADD PRIMARY KEY (`id_donvi`);

--
-- Chỉ mục cho bảng `tbl_hotro_kinhphi`
--
ALTER TABLE `tbl_hotro_kinhphi`
  ADD PRIMARY KEY (`id_hotro_kinhphi`);

--
-- Chỉ mục cho bảng `tbl_hotro_kinhphi_chitiet2`
--
ALTER TABLE `tbl_hotro_kinhphi_chitiet2`
  ADD PRIMARY KEY (`id_hotro_kinhphi_chitiet`),
  ADD KEY `id_hotro_kinhphi` (`id_hotro_kinhphi`);

--
-- Chỉ mục cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD PRIMARY KEY (`id_nhanvien`),
  ADD KEY `id_phongban` (`id_phongban`);

--
-- Chỉ mục cho bảng `tbl_nhan_hotro`
--
ALTER TABLE `tbl_nhan_hotro`
  ADD PRIMARY KEY (`id_nhan_hotro`),
  ADD KEY `id_hotro_kinhphi` (`id_hotro_kinhphi`),
  ADD KEY `id_tourdulich` (`id_tourdulich`),
  ADD KEY `tbl_nhan_hotro_ibfk_2` (`id_nhanvien`);

--
-- Chỉ mục cho bảng `tbl_phongban`
--
ALTER TABLE `tbl_phongban`
  ADD PRIMARY KEY (`id_phongban`),
  ADD KEY `id_donvi` (`id_donvi`);

--
-- Chỉ mục cho bảng `tbl_thongke_donvi_dangky`
--
ALTER TABLE `tbl_thongke_donvi_dangky`
  ADD PRIMARY KEY (`id_thongke`),
  ADD KEY `id_donvi` (`id_donvi`);

--
-- Chỉ mục cho bảng `tbl_tourdulich`
--
ALTER TABLE `tbl_tourdulich`
  ADD PRIMARY KEY (`id_tourdulich`),
  ADD KEY `id_donvi` (`donvi_tourdulich`);

--
-- Chỉ mục cho bảng `tbl_tourdulich_liked`
--
ALTER TABLE `tbl_tourdulich_liked`
  ADD PRIMARY KEY (`id_tourdulich_liked`),
  ADD KEY `id_tourdulich` (`id_tourdulich`),
  ADD KEY `id_nhanvien` (`id_nhanvien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_dangkytour`
--
ALTER TABLE `tbl_dangkytour`
  MODIFY `id_dangkytour` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `tbl_dangkytour_chitiet`
--
ALTER TABLE `tbl_dangkytour_chitiet`
  MODIFY `id_dangkytour_chitiet` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `tbl_diadiem`
--
ALTER TABLE `tbl_diadiem`
  MODIFY `id_diadiem` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `tbl_donvi`
--
ALTER TABLE `tbl_donvi`
  MODIFY `id_donvi` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_hotro_kinhphi`
--
ALTER TABLE `tbl_hotro_kinhphi`
  MODIFY `id_hotro_kinhphi` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_hotro_kinhphi_chitiet2`
--
ALTER TABLE `tbl_hotro_kinhphi_chitiet2`
  MODIFY `id_hotro_kinhphi_chitiet` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  MODIFY `id_nhanvien` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_nhan_hotro`
--
ALTER TABLE `tbl_nhan_hotro`
  MODIFY `id_nhan_hotro` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `tbl_phongban`
--
ALTER TABLE `tbl_phongban`
  MODIFY `id_phongban` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_thongke_donvi_dangky`
--
ALTER TABLE `tbl_thongke_donvi_dangky`
  MODIFY `id_thongke` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tbl_tourdulich`
--
ALTER TABLE `tbl_tourdulich`
  MODIFY `id_tourdulich` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_tourdulich_liked`
--
ALTER TABLE `tbl_tourdulich_liked`
  MODIFY `id_tourdulich_liked` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_dangkytour`
--
ALTER TABLE `tbl_dangkytour`
  ADD CONSTRAINT `tbl_dangkytour_ibfk_1` FOREIGN KEY (`id_nhanvien`) REFERENCES `tbl_nhanvien` (`id_nhanvien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_dangkytour_ibfk_2` FOREIGN KEY (`id_tourdulich`) REFERENCES `tbl_tourdulich` (`id_tourdulich`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_dangkytour_ibfk_3` FOREIGN KEY (`id_donvi`) REFERENCES `tbl_donvi` (`id_donvi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_dangkytour_chitiet`
--
ALTER TABLE `tbl_dangkytour_chitiet`
  ADD CONSTRAINT `tbl_dangkytour_chitiet_ibfk_1` FOREIGN KEY (`id_dangkytour`) REFERENCES `tbl_dangkytour` (`id_dangkytour`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_dangkytour_chitiet_ibfk_2` FOREIGN KEY (`id_tourdulich`) REFERENCES `tbl_tourdulich` (`id_tourdulich`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_hotro_kinhphi_chitiet2`
--
ALTER TABLE `tbl_hotro_kinhphi_chitiet2`
  ADD CONSTRAINT `tbl_hotro_kinhphi_chitiet2_ibfk_1` FOREIGN KEY (`id_hotro_kinhphi`) REFERENCES `tbl_hotro_kinhphi` (`id_hotro_kinhphi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD CONSTRAINT `tbl_nhanvien_ibfk_1` FOREIGN KEY (`id_phongban`) REFERENCES `tbl_phongban` (`id_phongban`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_nhan_hotro`
--
ALTER TABLE `tbl_nhan_hotro`
  ADD CONSTRAINT `tbl_nhan_hotro_ibfk_1` FOREIGN KEY (`id_hotro_kinhphi`) REFERENCES `tbl_hotro_kinhphi` (`id_hotro_kinhphi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_nhan_hotro_ibfk_2` FOREIGN KEY (`id_nhanvien`) REFERENCES `tbl_nhanvien` (`id_nhanvien`),
  ADD CONSTRAINT `tbl_nhan_hotro_ibfk_3` FOREIGN KEY (`id_tourdulich`) REFERENCES `tbl_tourdulich` (`id_tourdulich`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_phongban`
--
ALTER TABLE `tbl_phongban`
  ADD CONSTRAINT `tbl_phongban_ibfk_1` FOREIGN KEY (`id_donvi`) REFERENCES `tbl_donvi` (`id_donvi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_thongke_donvi_dangky`
--
ALTER TABLE `tbl_thongke_donvi_dangky`
  ADD CONSTRAINT `tbl_thongke_donvi_dangky_ibfk_1` FOREIGN KEY (`id_donvi`) REFERENCES `tbl_donvi` (`id_donvi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_tourdulich_liked`
--
ALTER TABLE `tbl_tourdulich_liked`
  ADD CONSTRAINT `tbl_tourdulich_liked_ibfk_1` FOREIGN KEY (`id_tourdulich`) REFERENCES `tbl_tourdulich` (`id_tourdulich`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_tourdulich_liked_ibfk_2` FOREIGN KEY (`id_nhanvien`) REFERENCES `tbl_nhanvien` (`id_nhanvien`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
