-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 14, 2024 lúc 05:15 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `baimau`
--
CREATE DATABASE IF NOT EXISTS `baimau` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `baimau`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `email`, `name`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'tkhacdi26@gmail.com', 'Trương Khắc DĨ', '$2y$12$OEZmBWCeHpcqYwtBK4pdcuR/D2PCrQ4FcMGuIrzRZCQVLwRrQ3fpK', 'admin', '2024-04-14 05:52:12', '2024-04-14 05:53:31'),
(2, 'user1@gmail.com', 'user1', '$2y$12$zAduyHyIl/M42z5SlVgimu4RbU3X1.1TSuV3jpzX6G9OGlwXYpg62', 'user', '2024-04-14 08:41:19', '2024-04-14 08:41:19'),
(3, 'admin@gmail.com', 'admin', '$2y$12$Qi9V9GbbiXS390yOi8A2ceDRzukuGi.xUlZB4xCcsg.79/HH5NLpW', 'admin', '2024-04-14 09:23:59', '2024-04-14 09:24:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `note` text DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `fullname`, `phone`, `email`, `address`, `note`, `payment_method`, `created_at`) VALUES
(1, 'Trương Khắc DĨ', '0352457359', 'tkhacdi.26@gmail.com', '47/24/38 Bùi Đình Túy', 'ssss', 'bank_transfer', '2024-04-14 12:59:57'),
(2, 'Trương Khắc DĨ', '0352457359', 'tkhacdi.26@gmail.com', '47/24/38 Bùi Đình Túy', 'ss', 'bank_transfer', '2024-04-14 13:02:20'),
(3, 'Trương Khắc DĨ', '0352457359', 'tkhacdi.26@gmail.com', '47/24/38 Bùi Đình Túy', 'ssss', 'bank_transfer', '2024-04-14 13:02:44'),
(4, 'Trương Khắc DĨ', '0352457359', 'tkhacdi.26@gmail.com', '47/24/38 Bùi Đình Túy', 'ddd', 'bank_transfer', '2024-04-14 13:05:03'),
(6, 'Trương Khắc DĨ', '0352457359', 'tkhacdi.26@gmail.com', '47/24/38 Bùi Đình Túy', 'ghehehe', 'bank_transfer', '2024-04-14 15:12:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_name`, `product_id`, `quantity`, `price`, `total_price`, `created_at`) VALUES
(1, 1, 'Bàn làm việc 160x60cm gỗ cao su chân sắt Aconcept HBAC026', 7, 1, 2255000.00, 2255000.00, '2024-04-14 12:59:57'),
(2, 2, 'Ghế lưới văn phòng chân xoay nệm bọc da M1102D-1', 8, 1, 1250000.00, 1250000.00, '2024-04-14 13:02:20'),
(3, 3, 'Ghế lưới văn phòng chân xoay nệm bọc da M1102D-1', 8, 1, 1250000.00, 1250000.00, '2024-04-14 13:02:44'),
(4, 3, 'Kệ trang trí khung sắt 54x28x160cm gỗ cao su KTB68181', 9, 1, 2450000.00, 2450000.00, '2024-04-14 13:02:44'),
(5, 4, 'Bàn làm việc 160x60cm gỗ cao su chân sắt Aconcept HBAC026', 7, 1, 2255000.00, 2255000.00, '2024-04-14 13:05:03'),
(8, 6, 'Ghế lưới văn phòng chân xoay nệm bọc da M1102D-1', 8, 2, 1250000.00, 2500000.00, '2024-04-14 15:12:31'),
(9, 6, 'Kệ trang trí khung sắt 54x28x160cm gỗ cao su KTB68181', 9, 1, 2450000.00, 2450000.00, '2024-04-14 15:12:31'),
(10, 6, 'Bàn làm việc 160x60cm gỗ cao su chân sắt Aconcept HBAC026', 7, 7, 2255000.00, 15785000.00, '2024-04-14 15:12:31'),
(11, 6, 'Ghế Gaming chân xoay bọc nệm GC68033', 10, 1, 2380000.00, 2380000.00, '2024-04-14 15:12:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(7, 'Bàn làm việc 160x60cm gỗ cao su chân sắt Aconcept HBAC026', 'Bàn làm việc hệ Aconcept HBAC026 với kích thước mặt bàn 160x60cm rất lớn dành cho các bạn có nhu cầu diện tích sử dụng bề mặt bàn dài cần không gian làm việc rộng rãi, bàn với chất liệu gỗ cao su tiêu chuẩn AA dày 17m sơn PU hoàn thiện tiêu chuẩn của HomeOfice với 5 màu mặt bàn lựa chọn, chiều cao 75cm tiêu chuẩn cho bàn văn phòng tại Việt Nam. Khung chân sắt kệ Aconcept lắp ráp ngàm rất khoa học và chắc chắn của HomeOffice tiện lợi, đễ dàng lắp đặt và di chuyển, nên các bạn ở phòng trọ cũng an ', 345678, 'uploads/ban-lam-viec-160x60cm-he-aconcept-03_6vu3-89.jpg'),
(8, 'Ghế lưới văn phòng chân xoay nệm bọc da M1102D-1', 'Ghế lưới văn phòng M1102D-1 sở hữu thiết kế hiện đại, trẻ trung với gam màu cam nổi bật, tạo điểm nhấn cho không gian làm việc. Lưng ghế được làm từ lưới cao cấp, thoáng mát, giúp người sử dụng cảm thấy thoải mái, dễ chịu trong suốt thời gian dài làm việc. Ghế lưới văn phòng M1102D-1 có mức giá vô cùng hợp lý, phù hợp với mọi ngân sách của đa số các doanh nghiệp. Đây là lựa chọn lý tưởng giúp bạn tối ưu chi phí, tiết kiệm hiệu quả.  Với thiết kế đẹp mắt, hiện đại, chất lượng đảm bảo, tính năng v', 1250000, 'uploads/ghe-xoay-van-phong-boc-nem-da-lung-luoi.jpg'),
(9, 'Kệ trang trí khung sắt 54x28x160cm gỗ cao su KTB68181', 'Với thiết kế thanh lịch và tinh tế, kệ trang trí KTB68181 là một lựa chọn tuyệt vời để tô điểm thêm cho không gian sống hiện đại. Kệ trang trí được làm bằng chất liệu khung sắt hộp 20x20mm, đảm bảo độ bền bỉ và chắc chắn theo thời gian. Bề mặt khung sắt được phủ sơn tĩnh điện giúp chống gỉ sét, đồng thời mang lại vẻ ngoài sang trọng và hiện đại. Bên cạnh đó, chất liệu gỗ cao su AA, tiêu chuẩn xuất khẩu, đã được xử lý chống thấm giúp tăng thêm vẻ đẹp cho ngôi nhà  Kệ trang trí KTB68181 có kết cấu', 2450000, 'uploads/ke-trang-tri-khung-sat-co-ngan-tu-go-cao-su-1.jpg'),
(10, 'Ghế Gaming chân xoay bọc nệm GC68033', 'Với thiết kế thanh lịch và tinh tế, kệ trang trí KTB68181 là một lựa chọn tuyệt vời để tô điểm thêm cho không gian sống hiện đại. Kệ trang trí được làm bằng chất liệu khung sắt hộp 20x20mm, đảm bảo độ bền bỉ và chắc chắn theo thời gian. Bề mặt khung sắt được phủ sơn tĩnh điện giúp chống gỉ sét, đồng thời mang lại vẻ ngoài sang trọng và hiện đại. Bên cạnh đó, chất liệu gỗ cao su AA, tiêu chuẩn xuất khẩu, đã được xử lý chống thấm giúp tăng thêm vẻ đẹp cho ngôi nhà  Kệ trang trí KTB68181 có kết cấu', 2380000, 'uploads/ghe-gaming-1.jpg'),
(11, 'Bàn làm việc 160x80 AConcept chân sắt lắp ráp HBAC008', 'Bàn làm việc HBAC008 AConcept chân sắt chữ nhật 25x50. Bàn văn phòng gỗ cao su ghép tiêu chuẩn AA dày 17mm PU màu gỗ tự nhiên luôn có một vẻ đẹp riêng, thân thiện với môi trường, đối với các văn phòng mở, văn phòng kết hợp với cây xanh thì việc sử dụng bàn gỗ cao su chân sắt kết hợp trở nên hoàn hảo. Chất liệu gỗ cao su tại HomeOffice là gỗ ghép dày 17mm tiêu chuẩn AA ( 2 mặt đẹp) được xử lý qua 4 công đoạn trước khi PU hoàn thiện cho bề mặt sản phẩm rất đẹp mắt, chống nước tuyệt đối. Khung chân', 2750000, 'uploads/ban-giam-doc-80x160cm-aconcept.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
