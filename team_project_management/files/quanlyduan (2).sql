-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 02, 2025 lúc 01:49 AM
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `IDCongViec` int(11) NOT NULL,
  `NoiDung` text DEFAULT NULL,
  `TepDinhKem` varchar(255) DEFAULT NULL,
  `NgayBatDau` datetime DEFAULT NULL,
  `NgayKetThuc` datetime DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT NULL,
  `IDDuAn` int(11) DEFAULT NULL,
  `IDNguoiDung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `congviec`
--

INSERT INTO `congviec` (`IDCongViec`, `NoiDung`, `TepDinhKem`, `NgayBatDau`, `NgayKetThuc`, `TrangThai`, `IDDuAn`, `IDNguoiDung`) VALUES
(1, 'Thu thập và phân tích yêu cầu từ chủ cửa hàng về quản lý bán hàng, kho, và báo cáo.', 'token.sol', '2025-12-01 01:33:00', '2025-12-19 01:33:00', b'1', 1, 2),
(4, 'Phác thảo màn hình bán hàng, quản lý sản phẩm, báo cáo doanh số.', NULL, '2025-12-02 02:39:00', '2025-12-04 02:39:00', NULL, 1, 3),
(5, 'Tạo, cập nhật, hủy đơn hàng; theo dõi trạng thái đơn.', 'new.php', '2025-11-26 02:40:00', '2025-12-01 02:40:00', b'0', 1, 3),
(6, 'Test tốc độ tải trang, tối ưu CSS/JS.', NULL, '2025-12-02 03:05:00', '2025-12-28 03:05:00', b'1', 2, 1),
(7, 'Kết nối API của đơn vị vận chuyển để tự động cập nhật phí và trạng thái đơn hàng.', 'jquery-3.7.1.min.js', '2025-11-19 03:06:00', '2025-11-30 03:07:00', b'0', 2, 1),
(8, 'Kiểm tra lỗi thanh toán khi khách hàng thanh toán qua thẻ tín dụng, fix bug và test.', '4551050144_contract.txt', '2025-11-28 03:08:00', '2025-12-28 03:08:00', NULL, 2, 1),
(9, 'Thêm các sản phẩm mới vào hệ thống, kiểm tra đầy đủ thông tin, hình ảnh, giá cả.', NULL, '2025-12-02 03:08:00', '2025-12-06 03:09:00', NULL, 2, 1),
(10, 'Cập nhật số lượng kho hàng, kiểm tra sản phẩm hết hàng, nhập dữ liệu mới vào hệ thống.', NULL, '2025-12-01 03:09:00', '2025-12-03 00:09:00', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviecdanop`
--

CREATE TABLE `congviecdanop` (
  `IDNop` int(11) NOT NULL,
  `NoiDung` text DEFAULT NULL,
  `TepDinhKem` varchar(255) DEFAULT NULL,
  `NgayNop` datetime DEFAULT NULL,
  `DanhGia` tinyint(1) DEFAULT NULL,
  `IDCongViec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `congviecdanop`
--

INSERT INTO `congviecdanop` (`IDNop`, `NoiDung`, `TepDinhKem`, `NgayNop`, `DanhGia`, `IDCongViec`) VALUES
(1, '', 'thongke (4).pdf', '2025-12-02 02:56:19', 5, 1),
(2, 'hoàn thành', NULL, '2025-12-02 03:07:34', 5, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `duan`
--

CREATE TABLE `duan` (
  `IDDuAn` int(11) NOT NULL,
  `MaDuAn` varchar(10) DEFAULT NULL,
  `TenDuAn` varchar(100) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT NULL,
  `IDLeader` int(11) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `duan`
--

INSERT INTO `duan` (`IDDuAn`, `MaDuAn`, `TenDuAn`, `MoTa`, `NgayBatDau`, `NgayKetThuc`, `TrangThai`, `IDLeader`, `NgayTao`) VALUES
(1, 'qjKfYv', 'Hệ thống quản lý bán hàng', 'Xây dựng phần mềm quản lý đơn hàng, kho hàng và báo cáo doanh số cho cửa hàng.', '2025-11-27', '2025-12-28', b'0', 1, '2025-12-02 01:19:08'),
(2, '9nyQaH', 'Website thương mại điện tử', 'Phát triển website bán hàng trực tuyến với giỏ hàng, thanh toán và quản lý sản phẩm.', NULL, NULL, b'0', 2, '2025-12-02 01:21:25'),
(3, 'cgeWlv', 'Cổng thanh toán trực tuyến', 'Tích hợp các cổng thanh toán như Visa, MasterCard, MOMO, VNPay vào website thương mại điện tử.', '2025-11-05', '2025-12-31', b'0', 3, '2025-12-02 03:23:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `duancongkhai`
--

CREATE TABLE `duancongkhai` (
  `IDDuAn` int(11) NOT NULL,
  `YeuCau` text DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `duancongkhai`
--

INSERT INTO `duancongkhai` (`IDDuAn`, `YeuCau`, `NgayTao`) VALUES
(1, 'Cần người thiết kế website', '2025-12-02 01:24:36'),
(2, 'Cần người biết biết sử dụng Nodejs', '2025-12-02 01:29:36'),
(3, 'Thành thạo HTML/CSS/JS, React/Vue, tạo giao diện thanh toán thân thiện, responsive.', '2025-12-02 03:24:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `IDNguoiDung` int(11) NOT NULL,
  `Ten` varchar(100) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(10) DEFAULT NULL,
  `MatKhau` varchar(60) DEFAULT NULL,
  `GioiTinh` bit(1) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `AnhDaiDien` longtext DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`IDNguoiDung`, `Ten`, `MoTa`, `Email`, `SoDienThoai`, `MatKhau`, `GioiTinh`, `NgaySinh`, `AnhDaiDien`, `NgayTao`) VALUES
(1, 'Nguyên', 'Developer FullStack', 'nguyennn1701@gmail.com', '', 'b0baee9d279d34fa1dfd71aadb908c3f', b'1', '2004-01-17', '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAQERUSExAWFRUWFxUVGBcYEBYXFRgXFRIWFxUWFhUYHSggGBsnGxUYITEhJikrLi4uFx8zODMsNygtLisBCgoKDg0OGhAQGy0gHyUrLSsrKy0tLS0tLSsrLSs3LS0tLS0tLS0tLS0rLi0rLS0rLS0tLS0tLS0tKy0tLSstK//AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAgIDAQAAAAAAAAAAAAAABgcDBQIECAH/xABFEAABAwIDBAcDCQYDCQAAAAABAAIDBBEFEiEGBzFBEyJRYXGBkTKhsRQjQlJicqLB0QhDU4KSshVjczM0hJOjpMLj8f/EABoBAQADAQEBAAAAAAAAAAAAAAABAgMEBQb/xAAmEQEAAgIBBAEEAwEAAAAAAAAAAQIDEQQSITFBURQiYXETMvAF/9oADAMBAAIRAxEAPwCTueBxIHn4/ofQrk03FxqO3ktdXYWJZQ8us2zQ5oGrsnSZNb6WMhPDl6d+mjEbQ0cB66kkn1JU5dxXdO8/H+9vMx1pM/dOnKyL7mXwlVpN5n7oiI/aLxSI+2Zmf0IiLRmIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiJ0IiIaEREQIiICIiAiIgIiICIiAiIgIiICIiAiIgIi4ucACSbAakoOSxzzsY0ue8NaOJc4ADzKhG0e8SOM9FStE0l7ZtcgPCwA1efBYsF3dYti7hLWymGLiA8Xdb7EI0ZpzOvio26cfHm3eezY4pvFoYbhrnTH7A6v9R09FoTvCr6kltJQl3g18p8w0ABW1gG6bCaUAmn6d4+lMc/4PZHoprBSxxtDWMaxo5NaGj0CjbprgpDz3Hhm1dTqIXxjvEUfudqsw2B2pfxnDfGqA/tC9BgL6oadFfh58O7radvCpB/4s/mFhkwTayn/dvlA7DFJ7r3XolfCE2dFfh5rftpi1L/vVAQBzdDJF+LULa4VvMpJbCVj4T2nrs/qGo9Ffr4gRYi47DqFFtod3eF1oPSUjGvP04/m3+rePmCp2ztgpPpGqGvinbnika9va1wP/AMXZUNx3c1W0ZM2HVJeR9Ano5fAOHVf4Gy1OFbe1FNJ8nxGFzHN0LsmV45XczmO8Kdue/GmO9VkIsNJVRysEkbw5rhcOBuCsylzTGhERECIiAiIgIiICIiAiIgIiIMdTOyNrnvcGtaLkk2AAVYYhitZjlR8ko2ubDzPAFt/bkPJvY1c9rMTmxSrZh9Lq3NZxHBzges532G/HyVv7JbNQ4bTiGMXPF77dZ7+bj+Q5KHbhxdMbny1+w+7ukoLENEs9tZXAaduQcGj3qxYow0WWGjgyi54ldpQ6oERFCRERAREQEREBaDazZCjxOIxzxAn6MgAEjD2td+XBb9EHmjFcLxHZuovrLSvJs7XI4dh/hya+ferAwTGIayISxOuDoRzaeYcORVlYthkNVE+GaMPjeCC0i48e496877QYRUbN1wezNJSy+yT9JvNjuQkbyPP1UxLDLhi3ePKzUXXoKtk0bZY3ZmvAIPcV2FZ58xqRERECIiAiLHUTNjY57jZrQXEnkALlCI2w4jiEVOwySyBjRzPwHae5Q2XeGZXFtHRSz252NvGzQTbxWLZ/CZMfqXVE5c2jicWsYCRmPZ+ZPfZWvFFTUcQAEcMbdBq1jR5ri5HMjHPTWNy9TBwYmu7Ktk25rYOtU4VLGzm4B4t5ubb3qS4BtJTVrbxP1HFjtHjxHZ3qQSbV4b7Lq6n7CDOz36qEbWbJQyXrsKkYJo+s5kT2lrwOOVo4O7uBUYeZNp1eul8vCprdUuUT3jY8aSmysNpJbsaeYb9N3ofeu9sftE2vhzcJG9WRvY7tHcVDquH/ABbHWU/GKJwDuzLH1pPV3VXc4MWKevU+k53QbJijpvlMjfn5wDrxbGdWt7ieJ8uxWTQxZnX5D4rrAW0HAaBbajjytHqol2x3lnC+oiquIiICIiAiIgIiICIiAtHtls5FiNJJTyD2hdjubHj2XDz9xK3i+EIPN+7qvkpKiXDajRzXOygnQPb7bR3EdYKyVD9/GDGlq4MShFsxDHkfxGasJ8Wgg/dUmwusbPDHK3g9jXeo4K0OHk01PVDtIiKXKIiICiO9CuMVA5o4yObH5cT7hZS5Q/epSGSgLgNY3sf5atP9yNMX94TzZHDG0tFBE0DSNpPe5wzOJ8SSq73pVnyuvhobnoommaax+yXHzDR+JWNsriLamjgmafajZfucBZw8iCFUVY/pKzGZjxZFIwd1yGfBq8PjVn+a1reYfQ2/rENJTQQzNzQYJNIy5AcJ5ncO9rbXWB/QwvBa2poJuRc5xZoeZs14Hqrk3Rsy4TB3mQ/9V36KS4phcFVGY5omyNPJwv5g8Qe8La/Nit5rMeFYx7jbztg2NTUFYZ5OsJA7OW2ySB3B4toetr6qdbh6EySVVY8XNxGD3uOeT/xUY3hbHOw13ULn0sh6hOpjf9Un8+Y7wpluIxiDoZaT2Zg8yjX22kAXHeLa+K9HFeL1i0OS9NTK26dmZwC3AWuw0dYnsC2SvKtRERQsLX47jUFFA6oqJAyNvE8yeQaOJJ7FsFUH7RsMpo6dzQejbMc9uAJYQwnu9oeaDPTb9KB0uR0E7I726Q5TbXiWA3A9VaVJUslY2Rjg5jgHNcDcEEXBBXiMr1TuVZKMGp+kvr0hZfj0ZkcWeVtR3EIJyiIgL442X1devY50UjWmzixwaewlpAPqgrvabfNQUczoWRyTuYbPcwtDARxAcT1iO7TvUs2N2upcVh6WnJ6tg9jgA9hIvZwB940XkOsp5I5HxyNIe1xa4HiHA2N/NXF+zfSS9NVS2PRZGRk8jJmzAd5Db/1IL6REQRHerhIqsKqWWu5rOlb96I5vgCPNVdumrjJRujP7p5A+67rD3kq+qqEPY5h4OBafAi35rzfuuvBWVdMT7Nx5xSOafipjyxzxukrNREVnmiIiAsVXTtlY6N4u17S0juIssqKRA9isZdg9U/D6l1oHuzRSHgCeGv1Tz7CO9dJ9PlxHFqfnNFI5nfcB4t2+0pntHgENdEY5BY8WvHtNNuI7u5VLiHy3DayJ813OjsGu1tJELjLm8CRY8Fy3wR1Tavt6/H5MWiInzC2tzVYJMMay+sT5GEdl3Zx7nKcqkNl9oGYVVGVt3UFXqCBfo3X4WH0m3II5iyuqkqo5WNkjeHscLtc03BHcQvH5eKa3m3qXoY5jWnS2jwhlZTSU7xo9psexw1a4d4IBXmWJ89FUZmuLJYZLXHEOaSPTQ+IK9WKlt5mw1XJXOmpoDIyexOW3Vk4G9+A0vfxW/wDz80VmazPZnnpvvC1N1+2cWJwm9mTssJY7/jaPqn3cFOl5+x/ZqqwptPidK600LGCpaPZdoA51ubTwcPAq6NlMfixCliqYuDxcjm1w0c094K9SmSt43Dlms17Nyl1q8TxZsPVAu7s7PFairxeoBF3BtxewHC/C91M3iGtMF7+ErXXr6GKeN0UrGvjeLOa4XBB7Qo27FqiMjM69xexaPyW5ocSz2a8ZXkXA7v1SLRJfBasbRSn3Q4MyTpPkzjrcMdM90f8ASTqO4qdxRhoAAsBoAOAA4ABcgvqsxEREBCiII3jmwmGVsnS1FIx7+brua424Zi0jN5rc4ZhsNLGIoY2xxt4NaLAeS7RWqr8ULS5sYu5oub++3aomdLVrNp1DaEr6Col/iNQ8OIf7OpAA4cyuVLilRYuDs2WxII5duip/JDeeLaI8wlZXm/B4xHtFWMHAvqfxPDvzXoLDMREzewjiF58wCTpdoax44B9T7pcoPuWkTtyZomtZiVlIiK7yRERAREQF0MZwiGriMUrLtPA82ntaeRXfRExMxO4UxjGFVGFOcxzRNSyHUG+R1uF/4cg5OCzbPbQTUTs9DMXxnV9LKet35freLbHtCtqtpI5mOjkaHMcLEHgqg2i2SZQTh0ge6kebB7CM8d+ANxYke/xWV8cTHd6WDkdXafK5NitsYMTY7I1zJGWzxu5X4EHmL6LubQ7UUdA0GolDSfZaOs8+DRrbvUZ2apcPwqgmraeUzgszF5cLkjRrLD2Tmda3G5Ue3bbGOx2WXEK9znR58oaCRncNS2/0Y2ggWC8unEpkyTMbisPQtlmtfy3x3r4VNeJ7ZgxwLSXRAtIIsbhrifcs/wCz1N83WxNdmiZMDGe0ODhfzDWnzUur92GDyxGP5ExmmjmXa8dhzDU+d1VODOn2YxgU73l1LOWgm1g5jjZkluTmu0PdfuXoYsFMW+lz3vNvK48Qo8s5kd7HtX8OS1zJQ+XO/hfMfAcApk5ocO0LpyYRA7jH6XHwVrUdGPkxEat8aRlswklzv4XufAcAu3h8b5p+ktYA3vysOAW7ZhMA/djzufiu6xgGgFgoik+05OTEx9setOQXSrsYpoHsjlnjjfIbMa6RrS49jQeK7yrLe9u7kxPJU07vn4mZcjnWa9ocTZp+i+5PcVq41mAr6vOeE7zcXwginrKcyBnVAmDmS2HZLweO/XxUmZv/AKe2tBJm7BMy3rb8kFzLWN2gpDUfJRUR9Pa/RZxnta/DwVGYnvbxXET0FDS9EXafNgyzanjmtZvp5qS7rt109NO2vrnnpxdzI82YhzgQXyvuczrE6d/FBcBUZxCmkhmMobmaTf14gqTriWqto20x5OiUKjnEcuZurb8O48l9p5ckvVGZpuLdoPJS11FGeMbT/KFyiga32WgeAVOiXTPKrrw01FB8mZLM82DWud4NaCblUXuoa6aoqqkj2vjI9zyPcFZO/XaQUuHmnafnKk9H3iMWMht2W6v8yjm73CPktEwOFnyfOu7swGUHystaxp5vKyTMTM+0mREV3mCIiAiIgIiICxVVMyVhje0Oa4WIIuCPBZURMTpVW2ux4ooJJoJ3iIlofCXHKbuFtQdQDbiD4q5NyoaMGpsv+YT97pX3UU22peloJ22uchcPFpDvyXf/AGesUEmHvg5wyusL/RkAePeXKsw9DBebV7rVVSftEYL0tHFVNGsEmVx+xLYf3BvqrbWvx/DGVdNLTyC7ZWOYfMaEd4Nj5KG7U7ucbFdh1PNe7ujax/8AqRjK/wB4v5qTKgt0WNSYXXT4XUGwc8ht9B0rdLi/J7bEeAV7wztdwPkgzIvi+oCIiDBVUcUrcskbXt7HNDh6FaV2w2El2Y4dTE/6DPhZSFEHWo8PhhbliiZG3sYwNHoAuyAiICIiAupimIRU0T5pXhjGNLnOPAAfmsWN4zT0ULpqiURsaOJPE8g0cSe4Lz/tXtRWbRVAp6dro6VhBsedj/tJSOfY1ETOnWdUy7Q4q6oe0injtZp4NjaTkZ95x1Pn3K0ALLXYBgsVFCIYxw1c48XOPFxWyV4edmyddvwIiIxEREBERAREQEREHF7A4EHgQQfAqu92tccKxiSkebMlPRi/bfNCfMEjzVjKA70cDc9jayIESRe0Rxyg3DtPqnVJdHHvqdT7egYZQ4XCyqvN2W2Qr6ZriR00dmSt77aPA7D+oVgRyBwuCqzDviVSb7tiXygYlTA9NDYyBvtOY03bI37Tfh4LJsFvGp6uFrKiZkVS2zSHOyiTsewnTXs5eCtlzbqkd5G518kpqMPaOubvgLg0Ak6ujJ0A7WnySJJhbdNXnn1h2gj48134pmuGhVBx7tNoaBrXUlUDoCY2TltjzGR/Ud4rido9q6S3SUb325mlz/ihKHd6DRUPHvpxOHSfDB6Sx/3ArOz9oLtw30qv/WoSvFFRrv2guzDf+7/Lo1xdv7ndozDBf/XcfcGIL0S6oV+9DaGp0p8NtfmKWZ/vOnqvjqLbKu0c58DT9uOEa/c66C6sXxylpG56ieOJva94F/AcT5Krtqt+EDLx0MJmfwEjwWx3+yz2ne5QLH91ONx3kfF8pPEuZN0jvMPs4+V11dmtoosPcI6jDsjxxflcJfNsmvoQitpmI7Rts2YHieMyievmcyPk0ixAPKOLgwd5105qwcJwqGljEcLA1o9Se0nmVhwbH6WrF4ZmuPNvB48WnVbNXiHn5clrTqewiIjEREQEREBERAREQEREBcZGBwIIuCCCDzB4hckQVXitBVYHVispdYSdRxaATrHJ9nsPJXFsTttT4hHmidZ4AzwuPXafDmO8LXTRNe0tc0OBFiCLgg8iFXeObAywyfKMPkLHNOYMzlpaf8t3Z3FQ7cWeJ7W8vRMM4cNPRZV59wPe5U0ruixCncXN0ztGSTsu5h0d4iyuLZHaiHEoelhJLblpu0tcHC1w4HnqPVRp1RKQr5lX1FCXAxg8QsRoYTxiZ/Q39F2EQdcUUX8Jn9Df0XNtMwcGNHg0LKiD5lQBCtPhW1FHVTS08M7Xywm0jRe7bGx1OhsdNOaDcELXYzgNLWM6Oop2St+025Hg7iPJbJEFJbUbkiwmbDpyxzdRFI88vqSjUfzeqjWEbZ1VFL8lxKNzS3TOW9dvYXW0e37Q969I2UW2/wBjIMUp3Mc0NlaCYpLdZruwnm08CE2rakWjUo/FIHAOaQQRcEcCDzC5KvN2GKyNdLQTXDoi4tB4jK7LIzyPxVhq7zclOi2hERGYiIgIiICIiAiIgIiICIiCA73atraaOPK0ukfcGwuGsFzY8tSFa+6zBBR4bAy1nub0j/vP6x9L28lS+2jPluMU1IBcAxNP878z/wAIXpKmYGtAHIAe5Vl6eGNUhlREUNRERAREQa7aLEBTUs85/dxPf5taSPevMOwe2U+Fzy1fybphL1XudmbYl2d1ngWBJ5HuV5b7q0xYPOAbGQxxjwdI0u/CCoRu2og3Do8zQekL3kEXBBcQLjwAUxDPJk6I2lmz2+bDKmzZS6mef4guz/mN09bKwaSrjlaHxva9p4Oa4OafAhUxi+wtDUXPRdE4/SjOX1b7J9FGG7LYthjzJQVTnDiWtOUn70brsemla56WelVxcqEpN9eJUvUrKBriNL2fC4+RBB8rJjG+6rqWGGjo+je8WD8xleL82tDQL95UNttbC5rtpqkx+znmvbho0B3D7SsdQrd3svJTB9RP/tpeRNy1pNzmP1idSpqrx4edyLRa/YRERgIiICIiAiIgIiICIiAiIgrXYo9Lj0tQ9pIidKeGoI+bZx7rlX7T49Tu+nl8QR71CWxtBJDQCeJAAJ8e1c1GnT9TMeFhRVTHey4HwIWUOVcArMyrlbwkcP5immkcr5hYN0uoKzFqgfvXedj8Vk/xyo/ifhb+ijS31VU2ul1CDjVR/EP9Lf0XB2LVB/eu9wU9J9VX4Rn9pCstSU0QPtzOee8RxkfF6z7OU3RUkEf1YmD8IXU2x2cGJmIyzvHRk2+lcOtca8OHFbuNgaABwAAHkEiGObLF4jTkiIpczi+MO0IB8RdcY4GN9ljR4NA+CyIidyIiIgREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREH//Z', '2025-12-02 01:04:04'),
(2, 'Đảm', NULL, 'dam@gmail.com', NULL, '698d51a19d8a121ce581499d7b701668', NULL, NULL, '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', '2025-12-02 01:20:46'),
(3, 'Hào', NULL, 'hao@gmail.com', NULL, '698d51a19d8a121ce581499d7b701668', NULL, NULL, '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', '2025-12-02 01:23:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom`
--

CREATE TABLE `nhom` (
  `IDNhom` int(11) NOT NULL,
  `TenNhom` varchar(100) DEFAULT NULL,
  `IDDuAn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom`
--

INSERT INTO `nhom` (`IDNhom`, `TenNhom`, `IDDuAn`) VALUES
(1, 'Hệ thống quản lý bán hàng', 1),
(2, 'Website thương mại điện tử', 2),
(3, 'Cổng thanh toán trực tuyến', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvienduan`
--

CREATE TABLE `thanhvienduan` (
  `IDDuAn` int(11) NOT NULL,
  `IDNguoiDung` int(11) NOT NULL,
  `TrangThai` varchar(20) DEFAULT NULL,
  `NgayThamGia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvienduan`
--

INSERT INTO `thanhvienduan` (`IDDuAn`, `IDNguoiDung`, `TrangThai`, `NgayThamGia`) VALUES
(1, 2, 'approved', '2025-12-02 01:31:13'),
(1, 3, 'approved', '2025-12-02 01:24:57'),
(2, 1, 'approved', '2025-12-02 01:21:46'),
(2, 3, 'approved', '2025-12-02 03:19:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhviennhom`
--

CREATE TABLE `thanhviennhom` (
  `IDNhom` int(11) NOT NULL,
  `IDNguoiDung` int(11) NOT NULL,
  `NgayThamGia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhviennhom`
--

INSERT INTO `thanhviennhom` (`IDNhom`, `IDNguoiDung`, `NgayThamGia`) VALUES
(1, 1, '2025-12-02 01:19:08'),
(1, 2, '2025-12-02 01:31:13'),
(1, 3, '2025-12-02 01:24:57'),
(2, 1, '2025-12-02 01:21:46'),
(2, 2, '2025-12-02 01:21:25'),
(2, 3, '2025-12-02 03:19:13'),
(3, 3, '2025-12-02 03:23:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `IDThongBao` int(11) NOT NULL,
  `NoiDung` text DEFAULT NULL,
  `TepDinhKem` varchar(255) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `IDDuAn` int(11) DEFAULT NULL,
  `IDNguoiDung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`IDThongBao`, `NoiDung`, `TepDinhKem`, `NgayTao`, `IDDuAn`, `IDNguoiDung`) VALUES
(1, 'Chào cả team, tuần này hãy cập nhật số liệu bán hàng trước thứ 5.', NULL, '2025-12-01 02:36:08', 1, 1),
(2, 'Đã có file mẫu báo cáo mới, xem và làm theo hướng dẫn.', 'MoviesOnStreamingPlatforms_updated.csv', '2025-12-02 02:36:41', 1, 1),
(3, 'Hệ thống quản lý đơn hàng vừa nâng cấp, vui lòng kiểm tra quyền truy cập.', NULL, '2025-12-02 02:59:44', 2, 2),
(4, 'Kiểm tra và tối ưu tốc độ trang chủ, file hướng dẫn kèm theo.', 'FullData.csv', '2025-11-27 03:01:12', 2, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinnhan`
--

CREATE TABLE `tinnhan` (
  `IDTinNhan` int(11) NOT NULL,
  `NoiDung` text DEFAULT NULL,
  `Loai` varchar(10) DEFAULT NULL,
  `IDNhom` int(11) DEFAULT NULL,
  `IDNguoiDung` int(11) DEFAULT NULL,
  `NgayGui` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tinnhan`
--

INSERT INTO `tinnhan` (`IDTinNhan`, `NoiDung`, `Loai`, `IDNhom`, `IDNguoiDung`, `NgayGui`) VALUES
(1, 'Chào cả team, hôm nay bắt đầu cập nhật danh sách sản phẩm mới', 'text', 2, 2, '2025-12-02 03:13:06'),
(2, 'Ok, tớ sẽ thêm sản phẩm mới lên hệ thống và kiểm tra hình ảnh', 'text', 2, 1, '2025-12-02 03:14:02'),
(3, '1764620152_images (2).png', 'image', 2, 1, '2025-12-02 03:15:52'),
(5, '1764620193_tải xuống (2).jpg', 'image', 2, 2, '2025-12-02 03:16:33'),
(6, 'okê', 'text', 2, 1, '2025-12-02 03:17:28'),
(7, 'ocee', 'text', 2, 3, '2025-12-02 03:19:28');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`IDCongViec`),
  ADD KEY `IDDuAn` (`IDDuAn`),
  ADD KEY `IDNguoiDung` (`IDNguoiDung`);

--
-- Chỉ mục cho bảng `congviecdanop`
--
ALTER TABLE `congviecdanop`
  ADD PRIMARY KEY (`IDNop`),
  ADD KEY `IDCongViec` (`IDCongViec`);

--
-- Chỉ mục cho bảng `duan`
--
ALTER TABLE `duan`
  ADD PRIMARY KEY (`IDDuAn`),
  ADD KEY `IDLeader` (`IDLeader`);

--
-- Chỉ mục cho bảng `duancongkhai`
--
ALTER TABLE `duancongkhai`
  ADD PRIMARY KEY (`IDDuAn`),
  ADD KEY `IDDuAn` (`IDDuAn`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`IDNguoiDung`);

--
-- Chỉ mục cho bảng `nhom`
--
ALTER TABLE `nhom`
  ADD PRIMARY KEY (`IDNhom`),
  ADD UNIQUE KEY `IDDuAn` (`IDDuAn`);

--
-- Chỉ mục cho bảng `thanhvienduan`
--
ALTER TABLE `thanhvienduan`
  ADD PRIMARY KEY (`IDDuAn`,`IDNguoiDung`),
  ADD KEY `IDNguoiDung` (`IDNguoiDung`);

--
-- Chỉ mục cho bảng `thanhviennhom`
--
ALTER TABLE `thanhviennhom`
  ADD PRIMARY KEY (`IDNhom`,`IDNguoiDung`),
  ADD KEY `IDNguoiDung` (`IDNguoiDung`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`IDThongBao`),
  ADD KEY `IDDuAn` (`IDDuAn`),
  ADD KEY `IDNguoiDung` (`IDNguoiDung`);

--
-- Chỉ mục cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD PRIMARY KEY (`IDTinNhan`),
  ADD KEY `IDNhom` (`IDNhom`),
  ADD KEY `IDNguoiDung` (`IDNguoiDung`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `congviec`
--
ALTER TABLE `congviec`
  MODIFY `IDCongViec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `congviecdanop`
--
ALTER TABLE `congviecdanop`
  MODIFY `IDNop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `duan`
--
ALTER TABLE `duan`
  MODIFY `IDDuAn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `IDNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhom`
--
ALTER TABLE `nhom`
  MODIFY `IDNhom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `IDThongBao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  MODIFY `IDTinNhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD CONSTRAINT `congviec_ibfk_1` FOREIGN KEY (`IDDuAn`) REFERENCES `duan` (`IDDuAn`),
  ADD CONSTRAINT `congviec_ibfk_2` FOREIGN KEY (`IDNguoiDung`) REFERENCES `nguoidung` (`IDNguoiDung`);

--
-- Các ràng buộc cho bảng `congviecdanop`
--
ALTER TABLE `congviecdanop`
  ADD CONSTRAINT `congviecdanop_ibfk_1` FOREIGN KEY (`IDCongViec`) REFERENCES `congviec` (`IDCongViec`),
  ADD CONSTRAINT `fk_congviec` FOREIGN KEY (`IDCongViec`) REFERENCES `congviec` (`IDCongViec`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `duan`
--
ALTER TABLE `duan`
  ADD CONSTRAINT `duan_ibfk_1` FOREIGN KEY (`IDLeader`) REFERENCES `nguoidung` (`IDNguoiDung`);

--
-- Các ràng buộc cho bảng `duancongkhai`
--
ALTER TABLE `duancongkhai`
  ADD CONSTRAINT `fk_duancongkhai_duan` FOREIGN KEY (`IDDuAn`) REFERENCES `duan` (`IDDuAn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhom`
--
ALTER TABLE `nhom`
  ADD CONSTRAINT `nhom_ibfk_1` FOREIGN KEY (`IDDuAn`) REFERENCES `duan` (`IDDuAn`);

--
-- Các ràng buộc cho bảng `thanhvienduan`
--
ALTER TABLE `thanhvienduan`
  ADD CONSTRAINT `thanhvienduan_ibfk_1` FOREIGN KEY (`IDDuAn`) REFERENCES `duan` (`IDDuAn`),
  ADD CONSTRAINT `thanhvienduan_ibfk_2` FOREIGN KEY (`IDNguoiDung`) REFERENCES `nguoidung` (`IDNguoiDung`);

--
-- Các ràng buộc cho bảng `thanhviennhom`
--
ALTER TABLE `thanhviennhom`
  ADD CONSTRAINT `thanhviennhom_ibfk_1` FOREIGN KEY (`IDNhom`) REFERENCES `nhom` (`IDNhom`),
  ADD CONSTRAINT `thanhviennhom_ibfk_2` FOREIGN KEY (`IDNguoiDung`) REFERENCES `nguoidung` (`IDNguoiDung`);

--
-- Các ràng buộc cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `thongbao_ibfk_1` FOREIGN KEY (`IDDuAn`) REFERENCES `duan` (`IDDuAn`),
  ADD CONSTRAINT `thongbao_ibfk_2` FOREIGN KEY (`IDNguoiDung`) REFERENCES `nguoidung` (`IDNguoiDung`);

--
-- Các ràng buộc cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD CONSTRAINT `tinnhan_ibfk_1` FOREIGN KEY (`IDNguoiDung`) REFERENCES `nguoidung` (`IDNguoiDung`),
  ADD CONSTRAINT `tinnhan_ibfk_2` FOREIGN KEY (`IDNhom`) REFERENCES `nhom` (`IDNhom`);

DELIMITER $$
--
-- Sự kiện
--
CREATE DEFINER=`root`@`localhost` EVENT `update_congviec_trangthai` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-11-30 23:39:46' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE congviec SET TrangThai = 0 
WHERE NgayKetThuc < NOW() AND TrangThai IS NULL$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
