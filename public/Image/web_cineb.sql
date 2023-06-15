-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 01, 2023 lúc 08:49 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_cineb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `email_admin` varchar(22) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_amdin` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `email_admin`, `password`, `level_amdin`) VALUES
(2, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_business_areas`
--

CREATE TABLE `tb_business_areas` (
  `id_areas` int(11) NOT NULL,
  `image_areas` varchar(255) DEFAULT NULL,
  `name_areas` varchar(55) NOT NULL,
  `desc_areas` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_business_areas`
--

INSERT INTO `tb_business_areas` (`id_areas`, `image_areas`, `name_areas`, `desc_areas`) VALUES
(10, 'fieldpng.png', 'asd', 'asdasd'),
(11, 'fieldpng.png', 'ád', 'ádas'),
(12, 'fieldpng.png', 'ád', 'ádasd'),
(13, 'fieldpng.png', 'ádasd', 'ád'),
(14, 'fieldpng.png', 'ád', 'ád'),
(15, 'fieldpng.png', 'ád', 'ád');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_field_project`
--

CREATE TABLE `tb_field_project` (
  `id_field` int(11) NOT NULL,
  `image_field` varchar(255) DEFAULT NULL,
  `name_field` varchar(55) NOT NULL,
  `desc_field` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_field_project`
--

INSERT INTO `tb_field_project` (`id_field`, `image_field`, `name_field`, `desc_field`) VALUES
(17, 'fieldpng.png', 'ád', 'ád'),
(18, 'fieldpng.png', 'ád', 'ádad'),
(19, 'fieldpng.png', 'asd', 'asd'),
(20, 'fieldpng.png', 'asd', 'asd'),
(21, 'fieldpng.png', 'gfdgg', 'qwe'),
(22, 'fieldpng.png', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_post`
--

CREATE TABLE `tb_post` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title_post` varchar(22) NOT NULL,
  `field_post` varchar(22) NOT NULL,
  `image_post` varchar(255) NOT NULL,
  `desc_post` varchar(255) DEFAULT NULL,
  `detail_post` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_post`
--

INSERT INTO `tb_post` (`id_post`, `id_user`, `title_post`, `field_post`, `image_post`, `desc_post`, `detail_post`) VALUES
(1, 1, 'How are you ?', '1', 'Ảnh chụp màn hình 2022-12-19 16130570.png', 'hie.....kasd !!!!', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/597c7b74-cdf0-4459-aaf7-02e6b2c9b9c9\" width=\"600\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/acc9f922-28db-4ad2-80f8-773af7a32833\" width=\"136\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/21290815-4481-489d-b9a6-62159d4fc8c9\" width=\"136\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/8a4463f2-4db1-4277-b4c1-42899a200da6\" width=\"600\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>asdadsad</p>'),
(2, 1, 'what do you mean ?', '0', 'hoc-yonna-dara-cach-duong-da-cap-nuoc-cho-co-the-de-so-huu-lan-da-min-mang-5454ea47.jpg', 'fake....,rimuru tempest ,....!!!', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/7dbf7d90-0c52-4a62-9e33-1c801c6e1891\" width=\"900\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>'),
(3, 2, 'Who is this ????', '18', '172ae5f06f87e4789434f85c5963b21396.jpg', 'beautyfull girll............. verry very', '<p>asdadads</p>'),
(4, 2, 'asd', '22', '20201023112223-38116.jpg', 'asd', '<p>asd</p>'),
(5, 2, 'asd', '17', 'aa65.png', 'asda', '<p>asdad</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_store`
--

CREATE TABLE `tb_store` (
  `id_store` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_store` varchar(55) NOT NULL,
  `address_store` varchar(100) DEFAULT NULL,
  `cmnd_user` varchar(55) NOT NULL,
  `phone_store` varchar(55) NOT NULL,
  `avt_store` varchar(255) DEFAULT NULL,
  `desc_store` varchar(255) NOT NULL,
  `Category_store` varchar(55) DEFAULT NULL,
  `type_store` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_store`
--

INSERT INTO `tb_store` (`id_store`, `id_user`, `name_store`, `address_store`, `cmnd_user`, `phone_store`, `avt_store`, `desc_store`, `Category_store`, `type_store`) VALUES
(29, 2, 'asd', 'asd', 'asd', 'asdasd', 'store.jpg', 'asda', NULL, '0'),
(30, 2, 'sdf', 'sdf', 'sdfsf', 'sfdsfsdfs', 'wdOeY_5f41.jpg', 'sdfsf', NULL, '0'),
(31, 2, 'ád', 'ád', 'ád', 'ád', 'store.jpg', 'ád', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_user` varchar(255) NOT NULL,
  `phone_user` varchar(55) NOT NULL,
  `nickname` varchar(55) NOT NULL,
  `birthday` varchar(55) NOT NULL,
  `story` varchar(55) DEFAULT NULL,
  `type_user` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `email_user`, `password`, `image_user`, `phone_user`, `nickname`, `birthday`, `story`, `type_user`) VALUES
(2, 'hien@gmail.com', '202cb962ac59075b964b07152d234b70', '30dc5ad4a8552da0172dcf5239f6ef8981.jpg', '132312313123', 'irens', '2023-03-04', '...', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tb_business_areas`
--
ALTER TABLE `tb_business_areas`
  ADD PRIMARY KEY (`id_areas`);

--
-- Chỉ mục cho bảng `tb_field_project`
--
ALTER TABLE `tb_field_project`
  ADD PRIMARY KEY (`id_field`);

--
-- Chỉ mục cho bảng `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id_post`);

--
-- Chỉ mục cho bảng `tb_store`
--
ALTER TABLE `tb_store`
  ADD PRIMARY KEY (`id_store`);

--
-- Chỉ mục cho bảng `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tb_business_areas`
--
ALTER TABLE `tb_business_areas`
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tb_field_project`
--
ALTER TABLE `tb_field_project`
  MODIFY `id_field` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tb_store`
--
ALTER TABLE `tb_store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
