-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 23, 2025 lúc 02:33 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website_ban_quan_ao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `title`, `desc`, `img`, `thumb_img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tiêu đề banner 1', 'Mô tả banner 1', '9YJjlsHcwlyfkK0B907SYikK8IDQfO5UP0Q6PxP3.jpg', 'az3p04akOccRw037qgIpisCQxM7E6piTwPYpbQoI.jpg', 0, '2025-02-22 14:12:08', '2025-02-22 14:12:08'),
(2, 'Tiêu đề banner 2', 'Mô tả banner 2', 'xiA9Jpk5SGUz18JDHaJyF4fKJBW7nHsdhavR5hLn.jpg', 'Y2kU3TGITWm2PMHdr4FtbpU7upUFmekZW1Z6zZnu.jpg', 0, '2025-02-22 14:12:08', '2025-02-22 14:12:08'),
(3, 'Tiêu đề banner 3', 'Mô tả banner 3', 'eDXZ2WjDeTKF4pemMUR150gzbpwKVHB3ygMnt1Vh.jpg', 'vncGnMCsB40BzycuHFznfCL2XhLhOIWqYUpeIGgQ.jpg', 0, '2025-02-22 14:12:08', '2025-02-22 14:12:08'),
(10, 'Tiêu đề banner 10', 'Mô tả banner 10', 'h5SNJcR6F4arfhXvigRcD7pyLIufJsdmvbnZSGuL.jpg', 'JOvMM2afHRhSoky2RcvNjDSugYIeuHozJodW18Ot.jpg', 0, '2025-02-22 14:12:09', '2025-02-22 14:12:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `img`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Limit', 'X44JImakLdJR2ECG4mVeeISZJdQM3xxPTcJrNcdv.jpg', 0, '2025-02-22 14:12:09', '2025-02-22 14:12:09'),
(8, 'Sản phẩm mới', 'ibLw25h08ANdKsqesmbO0Fkh39zqaXgYXtxV1vhK.jpg', 0, '2025-02-22 14:12:09', '2025-02-22 14:12:09'),
(9, 'Giày & phụ kiện', 'JxvdIXhWLuSxrZuobqnFi7De3UATkPm3S0pyp7bk.jpg', 0, '2025-02-22 14:12:09', '2025-02-22 14:12:09'),
(10, 'Nữ', 'PlJf6UGCZY1OYUXLDlZ3QMxGiiv3UC1FhEKkg093.webp', 0, '2025-02-22 14:12:09', '2025-02-22 14:12:09'),
(11, 'Nam', 'LFyGLFOVFUYvjnkbkFMpNhSMEleTpsyZ4z12hYSS.jpg', 0, '2025-02-23 00:23:45', '2025-02-23 00:23:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_07_15_073213_create_banners_table', 1),
(3, '2022_07_15_073457_create_users_table', 1),
(4, '2022_07_15_073727_create_vouchers_table', 1),
(5, '2022_07_15_074108_create_categories_table', 1),
(6, '2022_07_15_074415_create_products_table', 1),
(7, '2022_07_15_074924_create_orders_table', 1),
(8, '2022_07_15_075202_create_product_order_detail_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `email`, `customer_name`, `phone_number`, `address`, `voucher_id`, `status`, `created_at`, `updated_at`, `total`) VALUES
(12, '#1740272890', 'phongngo03255@gmail.com', 'phongngo', '0325500080', 'Hà Nội', 11, 1, '2025-02-23 01:08:10', '2025-02-23 01:08:10', 311000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SKU` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(9,2) NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materials` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_gallery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_stock` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `SKU`, `product_name`, `price`, `short_desc`, `img`, `sizes`, `colors`, `desc`, `weight`, `dimensions`, `materials`, `tag`, `photo_gallery`, `in_stock`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(10, 'JK-10', 'Áo Không Logo Elando Màu Đen', 159000.00, 'Mô tả ngắn 10', '/UJrOYc8CW1oM3h7oPXRf8pTDzFLNIrtCE2x7oYoZ.jpg', '[\"X\",\"L\",\"XL\"]', '[\"Xanh\",\"Đỏ\",\"Tím\",\"Vàng\"]', '<p>Th&ocirc;ng tin về sản phẩm:<br>&bull; Full size từ 10kg &ndash; 120kg</p>\r\n<p>&bull; Full 6 chất liệu tương ứng 6 mức gi&aacute;</p>\r\n<p>&bull; Thoải m&aacute;i thay đổi logo, nh&agrave; t&agrave;i trợ</p>\r\n<p>&bull; Miễn ph&iacute; in ấn 100%</p>\r\n<p>&bull; Miễn ph&iacute; ship to&agrave;n quốc 100%</p>\r\n<p>&bull; Nhiều ưu đ&atilde;i về gi&aacute; v&agrave; qu&agrave; tặng đi k&egrave;m.</p>', '0,6 kg', '110 x 33 x 100 cm', '60% cotton', '[\"Fashion\",\"Lifestyle\",\"Denim\"]', '[\"\\/EEOOuYaYcnOfElWRmjyTISvYmx2pl8z5m2nrQ8cU.jpg\"]', 100, 1, 1, '2025-02-22 14:12:09', '2025-02-22 14:12:09'),
(11, 'PRO00001', 'Áo Bra thể thao Recycle phối viền khác màu BR073W1', 216000.00, 'Áo bra cổ tròn, dáng ôm khít, vai khoét sâu, chi tiết cắt rã trên thân áo', '/Fm9uMhpdWJbZLVuaDORbbIH0k7mbXOXjx7LpfWP4.png', '[\"S\",\"X\",\"L\"]', '[\"Tím\",\"Đỏ\",\"Vàng\"]', '<ul>\r\n<li>&Aacute;o bra cổ tr&ograve;n, d&aacute;ng &ocirc;m kh&iacute;t, vai kho&eacute;t s&acirc;u, chi tiết cắt r&atilde; tr&ecirc;n th&acirc;n &aacute;o</li>\r\n<li>Chất liệu vải 89% Recycled Polyester 11% Spandex, mềm mại, co gi&atilde;n v&agrave; thấm h&uacute;t tốt</li>\r\n<li>Chất vải từ sợi t&aacute;i chế, th&acirc;n thiện với m&ocirc;i trường</li>\r\n</ul>', '0.6', '1000x2000x3000 cm', 'cotton', '[\"Áo\"]', '[\"\\/FRBPAHEnRvgppdznd8NMKM4oIAcNUHNv0CabqjsI.png\"]', 10000, 0, 10, '2025-02-23 00:46:19', '2025-02-23 00:46:19'),
(12, 'PRO00002', 'Áo thun dài tay Nữ dáng crop top SS062W1', 149000.00, 'Áo thun tay dài, cổ tròn, dáng ôm vừa vặn, tôn dáng, thân trước in hình logo phối họa tiết Bộ sưu tập', '/jpd4EAmB0MH4KNIuVzkVUQNE5sq3Srzl2hS8XL84.jpg', '[\"S\"]', '[\"Đỏ\"]', '<ul>\r\n<li>&Aacute;o thun tay d&agrave;i, cổ tr&ograve;n, d&aacute;ng &ocirc;m vừa vặn, t&ocirc;n d&aacute;ng, th&acirc;n trước in h&igrave;nh logo phối họa tiết Bộ sưu tập</li>\r\n<li>Chất liệu 83% polyester, 17% spandex</li>\r\n<li>Chất vải c&oacute; t&iacute;nh năng DRI-AIR, thấm h&uacute;t mồ h&ocirc;i v&agrave; l&agrave;m kh&ocirc; nhanh</li>\r\n<li>Model cao 1m65, nặng 46kg, mặc size M</li>\r\n</ul>', '0.6', '1x2x3 cm', 'cotton', '[\"Áo\"]', '[\"\\/Hox6VTDaWro457vO2H4JiKcGBLiZqpCoudKwmcXi.jpg\"]', 24998, 0, 11, '2025-02-23 00:48:11', '2025-02-23 01:08:10'),
(13, 'PRO00005', 'Áo dài tay Nữ DRI-AIR khóa kéo SS051W1', 287000.00, 'Dáng áo ôm khít, vừa vặn,', '/N7BH0o5sR1puG6tvhW3OLYZIDgqmflu7PzoDer3P.jpg', '[\"Vàng\"]', '[\"Đỏ\"]', '<ul>\r\n<li>D&aacute;ng &aacute;o &ocirc;m kh&iacute;t, vừa vặn,</li>\r\n<li>Chất liệu vải 91% nylon, 9% spandex, mềm, mịn, rất m&aacute;t v&agrave; co gi&atilde;n tốt</li>\r\n<li>T&iacute;ch hợp t&iacute;nh năng DRI-AIR, thấm h&uacute;t mồ h&ocirc;i v&agrave; l&agrave;m kh&ocirc; nhanh.</li>\r\n</ul>', '0.6', '1x2x3 cm', 'Cotton', '[\"Áo\"]', '[\"\\/OP2YY70efuHvgRvm64VbwQ09dGJ6syDUBM0rAedi.jpg\"]', 20000, 0, 7, '2025-02-23 00:51:33', '2025-02-23 00:51:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_order_detail`
--

CREATE TABLE `product_order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_order_detail`
--

INSERT INTO `product_order_detail` (`id`, `order_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`, `color`) VALUES
(11, 12, 12, 'size s', 2, '2025-02-23 01:08:10', '2025-02-23 01:08:10', 'Đỏ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `address`, `avatar`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin1@gmail.com', '$2y$10$FKn.phILNq69ULw7E/BIFO5KaohtVUpaoIkUXRESUgfG4s/fWgyxq', 'họ và tên 1', 'Địa chỉ 1', '1.jpg', 1, 0, '2025-02-22 14:12:08', '2025-02-22 14:12:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id`, `title`, `discount`, `code`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Giảm giá ngày mưa', 10.00, 'NGAYMUA', '2025-02-23 08:02:00', '2025-02-24 08:05:00', 0, '2025-02-23 01:05:22', '2025-02-23 01:05:22');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_order_detail`
--
ALTER TABLE `product_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `product_order_detail`
--
ALTER TABLE `product_order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
