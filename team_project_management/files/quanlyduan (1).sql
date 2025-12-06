-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2025 lúc 12:44 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyduan`
--

--
-- Đang đổ dữ liệu cho bảng `duan`
--

INSERT INTO `duan` (`IDDuAn`, `TenDuAn`, `MoTa`, `NgayBatDau`, `NgayKetThuc`, `TrangThai`, `IDLeader`, `NgayTao`) VALUES
(1, 'Quản lý Sinh Viên', 'Quản lý Sinh Viên Quản lý Sinh ViênQuản lý Sinh ViênQuản lý Sinh Viên', NULL, NULL, NULL, 10, NULL),
(2, 'Quản lý khách sạn', 'Quản lý khách sạnQuản lý khách sạnQuản lý khách sạn', NULL, NULL, NULL, 11, NULL);

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`IDNguoiDung`, `Ten`, `MoTa`, `Email`, `SoDienThoai`, `MatKhau`, `GioiTinh`, `NgaySinh`, `NgayTao`) VALUES
(10, 'Nguyen', NULL, 'nguyennn1701@gmail.com', NULL, 'b0baee9d279d34fa1dfd71aadb908c3f', NULL, NULL, '2025-11-13 16:02:25'),
(11, 'Nguyen Phan', NULL, 'nguyennn1711@gmail.com', NULL, 'b0baee9d279d34fa1dfd71aadb908c3f', NULL, NULL, '2025-11-13 18:33:23');

--
-- Đang đổ dữ liệu cho bảng `thanhvienduan`
--

INSERT INTO `thanhvienduan` (`IDDuAn`, `IDNguoiDung`, `VaiTro`, `NgayThamGia`) VALUES
(1, 10, 'leader', NULL),
(2, 10, 'member', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
