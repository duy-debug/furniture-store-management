-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql:3306
-- Thời gian đã tạo: Th6 02, 2026 lúc 08:12 AM
-- Phiên bản máy phục vụ: 8.0.45
-- Phiên bản PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@admin.com|127.0.0.1', 'i:1;', 1779189605),
('laravel-cache-admin@admin.com|127.0.0.1:timer', 'i:1779189605;', 1779189605);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('active','converted','abandoned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `item_count` int UNSIGNED NOT NULL DEFAULT '0',
  `subtotal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `checked_out_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `status`, `item_count`, `subtotal`, `checked_out_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'active', 0, 0.00, NULL, '2026-05-19 10:21:41', '2026-05-19 10:21:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name_snapshot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image_path_snapshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `line_total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','hidden') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `image_path`, `status`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Phòng khách', 'phong-khach', 'Nội thất phòng khách', 'categories/1/3AuSfVCQa1kTDRJWpLyumFGmrDIcqDKJ6LiXWU5F.jpg', 'active', 1, '2026-05-18 09:31:47', '2026-05-31 08:59:31', NULL),
(2, NULL, 'Phòng ngủ', 'phong-ngu', 'Nội thất phòng ngủ', 'categories/2/oZBtBPntt2jVmp4UPDHoS5iFiUQamRqDBXLc0xY8.jpg', 'active', 2, '2026-05-18 09:31:47', '2026-05-31 08:53:54', NULL),
(3, NULL, 'Phòng bếp', 'phong-bep', 'Nội thất nhà bếp', 'categories/3/ZA6MHYsOK6uAv24X4uTIEQjc7DkhKuB9f8cMVNv2.jpg', 'active', 3, '2026-05-18 09:31:47', '2026-05-31 09:07:50', NULL),
(4, NULL, 'Văn phòng', 'van-phong', 'Nội thất văn phòng', 'categories/4/T1EEYTNSRij6YStCnTCSb0GP9Gs8DGUbuKevTp4U.jpg', 'active', 4, '2026-05-18 09:31:47', '2026-05-31 09:07:04', NULL),
(5, NULL, 'Sofa vải', 'sofa-vai', 'Các mẫu sofa vải thoáng mát, dễ phối màu cho phòng khách hiện đại.', 'categories/5/uiQOs8M4asNnPFM4z83pSTMccjtV3zrl64L8R2rL.jpg', 'active', 1, '2026-05-31 08:26:04', '2026-05-31 08:54:19', NULL),
(6, NULL, 'Sofa da', 'sofa-da', 'Sofa da thật và da công nghiệp sang trọng cho không gian tiếp khách.', 'categories/6/GR19ZZKzeuX3oQDVYYz8oZMN0Yba5S1ItpZ6jrJ0.jpg', 'active', 2, '2026-05-31 08:26:04', '2026-05-31 08:52:55', NULL),
(7, NULL, 'Bàn trà', 'ban-tra', 'Bàn trà phòng khách với nhiều lựa chọn mặt đá, gỗ và kính cường lực.', 'categories/7/hwNkTv2QDyNYhaea58aIzqJASxtzxaQA7GCdxCv8.webp', 'active', 3, '2026-05-31 08:26:04', '2026-05-31 09:07:25', NULL),
(8, NULL, 'Kệ tivi', 'ke-tivi', 'Kệ tivi tối ưu lưu trữ, phù hợp không gian phòng khách căn hộ và nhà phố.', 'categories/8/8d9XvMsrHtiqtll0xS5EvRIRctzahoDdzDqNzsPK.jpg', 'active', 4, '2026-05-31 08:26:04', '2026-05-31 09:06:34', NULL),
(9, NULL, 'Tủ giày', 'tu-giay', 'Tủ giày gọn gàng, hỗ trợ lưu trữ và giữ cho lối vào luôn ngăn nắp.', 'categories/9/cFgzMWW4Kppw2KWjtgrMoEEusBAsyasSrAKOFGGh.webp', 'active', 5, '2026-05-31 08:26:04', '2026-05-31 09:06:01', NULL),
(10, NULL, 'Ghế thư giãn', 'ghe-thu-gian', 'Ghế thư giãn cho góc đọc sách, lounge tiếp khách hoặc phòng ngủ.', 'categories/10/GNYO7tuIyUIgWUXKALyNF1jN0gt6fxFVDLsWbjjt.jpg', 'active', 6, '2026-05-31 08:26:04', '2026-05-31 09:05:32', NULL),
(11, NULL, 'Giường gỗ', 'giuong-go', 'Giường gỗ tự nhiên và công nghiệp, ưu tiên độ bền và tính thẩm mỹ.', 'categories/11/BaQ43gdxRvxMKdgpIwuVPCdHWcu4yjS3lJy3WT3S.jpg', 'active', 7, '2026-05-31 08:26:04', '2026-05-31 09:05:11', NULL),
(12, NULL, 'Giường bọc nệm', 'giuong-boc-nem', 'Giường bọc nệm êm ái, phù hợp phòng ngủ phong cách khách sạn.', 'categories/12/GYpENjWTLf85UMEZwwEdxSTjiOm1b6ujJAoiU20h.webp', 'active', 8, '2026-05-31 08:26:04', '2026-05-31 09:04:43', NULL),
(13, NULL, 'Tủ quần áo', 'tu-quan-ao', 'Tủ quần áo nhiều kích thước, tối ưu lưu trữ cho phòng ngủ gia đình.', 'categories/13/Y5GwJ5nqBtJONIkQObGi6Ywms68rNt2oUPznjU1e.jpg', 'active', 9, '2026-05-31 08:26:04', '2026-05-31 09:04:07', NULL),
(14, NULL, 'Bàn trang điểm', 'ban-trang-diem', 'Bàn trang điểm có gương, ngăn kéo và thiết kế tinh gọn cho phòng ngủ.', 'categories/14/GRQNWgCYtDk2LSrnzRklVdXWomF7022Lh4KOGXRj.jpg', 'active', 10, '2026-05-31 08:26:04', '2026-05-31 09:03:30', NULL),
(15, NULL, 'Tab đầu giường', 'tab-dau-giuong', 'Tab đầu giường nhỏ gọn, tăng khả năng lưu trữ bên cạnh giường ngủ.', 'categories/15/pituM9QDcLGEKdSA4PxcEitkVQgk7hKAkKnvNSJN.webp', 'active', 11, '2026-05-31 08:26:04', '2026-05-31 09:03:00', NULL),
(16, NULL, 'Bàn ăn', 'ban-an', 'Bàn ăn cho gia đình nhỏ đến đông người, đa dạng chất liệu và kiểu dáng.', 'categories/16/xq2W5dg7p9VYB0MgirEXljeN69RyTJLJwGBnUbbG.jpg', 'active', 12, '2026-05-31 08:26:04', '2026-05-31 09:02:34', NULL),
(17, NULL, 'Ghế ăn', 'ghe-an', 'Ghế ăn đồng bộ bàn ăn, chú trọng độ bền, độ thoải mái và tính thẩm mỹ.', 'categories/17/1dPYKfxQ66nf0BSpPBQKdMRdLTe8ykOhJPTNimet.jpg', 'active', 13, '2026-05-31 08:26:04', '2026-05-31 09:01:25', NULL),
(18, NULL, 'Tủ bếp', 'tu-bep', 'Tủ bếp module cho căn hộ và nhà phố, tối ưu công năng và độ bền.', 'categories/18/lpiAkVO7KSyEWIJ7DzlrXdv8UWAqZsPcDR9rSXC5.webp', 'active', 14, '2026-05-31 08:26:04', '2026-05-31 09:00:56', NULL),
(19, NULL, 'Phụ kiện bếp', 'phu-kien-bep', 'Phụ kiện bếp hỗ trợ sắp xếp và tối ưu không gian lưu trữ trong khu bếp.', 'categories/19/6kmIGrHjpRXZUg9u6v1AQBfQ7VfJ7fSitzrLpOHf.jpg', 'active', 15, '2026-05-31 08:26:04', '2026-05-31 09:00:11', NULL),
(20, NULL, 'Bàn làm việc', 'ban-lam-viec', 'Bàn làm việc cho học tập và văn phòng tại nhà, nhiều kích thước tiện dụng.', 'categories/20/LRON8gEF8xrY9Kh1hyGbDU0GscojTbYDiutxccS4.webp', 'active', 16, '2026-05-31 08:26:04', '2026-05-31 09:09:23', NULL),
(21, NULL, 'Ghế văn phòng', 'ghe-van-phong', 'Ghế văn phòng và ghế công thái học cho làm việc lâu dài, giảm mỏi lưng cổ.', 'categories/21/jo0GHno688n4aQajuq22aMdQv0hYDulEVK8z48fz.jpg', 'active', 17, '2026-05-31 08:26:04', '2026-05-31 09:09:51', NULL),
(22, NULL, 'Tủ hồ sơ', 'tu-ho-so', 'Tủ hồ sơ văn phòng với khóa an toàn và khả năng lưu trữ tài liệu tốt.', 'categories/22/rmOfCUOVS4feDZEx27hKi42agVlJqCRAyDiJInUx.jpg', 'active', 18, '2026-05-31 08:26:04', '2026-05-31 09:10:17', NULL),
(23, NULL, 'Kệ sách', 'ke-sach', 'Kệ sách cho phòng khách, phòng làm việc và không gian học tập.', 'categories/23/6seWJEjVJRQ0E6B8kO7uyREMrpe26fHJm7DTP6aJ.webp', 'active', 19, '2026-05-31 08:26:04', '2026-05-31 09:10:40', NULL),
(24, NULL, 'Bàn học', 'ban-hoc', 'Bàn học cho trẻ em và người lớn với kích thước gọn và tiện dụng.', 'categories/24/ET6qdEVXg5HTSY862RwJVScI8rzGKGsyHaf9u9On.jpg', 'active', 20, '2026-05-31 08:26:04', '2026-05-31 09:11:24', NULL),
(25, NULL, 'Giường tầng', 'giuong-tang', 'Giường tầng tối ưu diện tích cho phòng trẻ em và căn hộ nhỏ.', 'categories/25/02Bl0lRh6ZhFqkrJYeFPJncSaOTezPrW2Aj9V6HZ.jpg', 'active', 21, '2026-05-31 08:26:04', '2026-05-31 09:12:05', NULL),
(26, NULL, 'Nội thất trẻ em', 'noi-that-tre-em', 'Nội thất an toàn cho phòng trẻ em, chú trọng màu sắc nhẹ nhàng và bền chắc.', 'categories/26/O8hXbvrkY2fbFRzGQtCQCSYR3BHKyIJANXyHJoEZ.jpg', 'active', 22, '2026-05-31 08:26:04', '2026-05-31 09:13:31', NULL),
(27, NULL, 'Tủ trưng bày', 'tu-trung-bay', 'Tủ trưng bày cho decor, rượu vang, sách hoặc bộ sưu tập cá nhân.', 'categories/27/wcoQyiuaEe1I7gd2xjIJ36ewctZey98fa0LwCEDi.png', 'active', 23, '2026-05-31 08:26:04', '2026-05-31 09:13:57', NULL),
(28, NULL, 'Bàn console', 'ban-console', 'Bàn console trang trí lối vào, hành lang hoặc sau sofa.', 'categories/28/kZbO3go0Ek3bMuuEvU4aec9bTIzlDqJwaqssJwdq.webp', 'active', 24, '2026-05-31 08:26:04', '2026-05-31 09:14:30', NULL),
(29, NULL, 'Tủ ngăn kéo', 'tu-ngan-keo', 'Tủ ngăn kéo hỗ trợ lưu trữ đồ dùng cá nhân và tài liệu nhỏ gọn.', 'categories/29/z9QZxkYwNil5vK4GZivceBnS6z4IE739SirMwxb1.jpg', 'active', 25, '2026-05-31 08:26:04', '2026-05-31 09:15:04', NULL),
(30, NULL, 'Kệ treo tường', 'ke-treo-tuong', 'Kệ treo tường trang trí và lưu trữ nhẹ nhàng cho nhiều không gian.', 'categories/30/NiimnKXgJMUUUNvM5G9BBDkxJN9xFB0JhZRYfniy.jpg', 'active', 26, '2026-05-31 08:26:05', '2026-05-31 09:16:00', NULL),
(31, NULL, 'Đồ decor', 'do-decor', 'Đồ decor hoàn thiện không gian sống, tạo điểm nhấn cho nhà ở và văn phòng.', 'categories/31/ihW2KUDaWfhqdMQJjUTlhneLhS8x7bPOd33yRY1y.jpg', 'active', 27, '2026-05-31 08:26:05', '2026-05-31 09:16:22', NULL),
(32, NULL, 'Đèn trang trí', 'den-trang-tri', 'Đèn trang trí tạo ánh sáng ấm và tăng điểm nhấn cho nội thất.', 'categories/32/YK2x7yOVzyalackPuDmCxVlhMOFiE6zK3Q5rhJOV.jpg', 'active', 28, '2026-05-31 08:26:05', '2026-05-31 09:16:43', NULL),
(33, NULL, 'Bàn ban công', 'ban-ban-cong', 'Bàn nhỏ cho ban công, sân vườn và góc cà phê ngoài trời.', 'categories/33/sbKojzoOMlKdUKr1GWT9x9GwiEuxjI3m8qCOVk6t.jpg', 'active', 29, '2026-05-31 08:26:05', '2026-05-31 09:17:13', NULL),
(34, NULL, 'Thảm trang trí', 'tham-trang-tri', 'Thảm trang trí giúp hoàn thiện bố cục không gian và tăng cảm giác ấm cúng.', 'categories/34/lIdHVzpnjcF8OrWPMVSq0zET0syVVsajpOlQM6yI.jpg', 'active', 30, '2026-05-31 08:26:05', '2026-05-31 09:08:38', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `design_requests`
--

CREATE TABLE `design_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_staff_id` bigint UNSIGNED DEFAULT NULL,
  `request_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `space_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `space_type` enum('living_room','bedroom','kitchen','whole_house','office','cafe','apartment','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `space_area` decimal(10,2) DEFAULT NULL,
  `ceiling_height` decimal(10,2) DEFAULT NULL,
  `room_count` smallint UNSIGNED DEFAULT NULL,
  `style_preference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget_amount` decimal(15,2) DEFAULT NULL,
  `desired_completion_date` date DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `status` enum('new','contacting','surveyed','designing','sent_design','approved','constructing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `contacted_at` timestamp NULL DEFAULT NULL,
  `surveyed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `design_requests`
--

INSERT INTO `design_requests` (`id`, `user_id`, `assigned_staff_id`, `request_code`, `customer_name`, `customer_phone`, `customer_email`, `space_address`, `space_type`, `space_area`, `ceiling_height`, `room_count`, `style_preference`, `main_color`, `budget_amount`, `desired_completion_date`, `requirements`, `status`, `cancel_reason`, `contacted_at`, `surveyed_at`, `completed_at`, `cancelled_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 2, 'YC202605310001', 'Nguyen Minh Anh', '0901000001', 'minh.anh@thongmai.local', 'Can ho 1208, 12 Nguyen Hue, Quan 1, Ho Chi Minh City', 'living_room', 28.50, 2.80, 1, 'Modern Japandi', 'Be - xam - go sang', 85000000.00, '2026-07-05', 'Can toi uu sofa, ban tra, ke tivi va anh sang am. Uu tien vat lieu de ve sinh.', 'new', NULL, NULL, NULL, NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 12:52:45', NULL),
(2, 7, 2, 'YC202605310002', 'Tran Hoang Nam', '0901000002', 'hoang.nam@thongmai.local', 'Nha pho 45 Hoang Quoc Viet, Bac Tu Liem, Ha Noi', 'whole_house', 128.00, 3.20, 4, 'Contemporary luxury', 'Nau dam - trang - den', 320000000.00, '2026-07-30', 'Can bao gom phong khach, phong ngu master va phong lam viec tai nha.', 'completed', NULL, '2026-05-30 08:43:33', '2026-05-31 12:53:20', '2026-05-31 12:53:43', NULL, '2026-05-31 08:43:33', '2026-05-31 12:53:43', NULL),
(3, 8, 2, 'YC202605310003', 'Le Thuy Linh', '0901000003', 'thuy.linh@thongmai.local', '78 Le Loi, Hai Chau 1, Da Nang', 'bedroom', 18.20, 2.75, 1, 'Soft minimal', 'Trang - kem - xanh olive', 45000000.00, '2026-06-28', 'Can giuong boc nem, tab dau giuong va tu quan ao am tuong.', 'surveyed', NULL, '2026-05-28 08:43:33', '2026-05-30 08:43:33', NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(4, 9, 2, 'YC202605310004', 'Pham Quang Huy', '0901000004', 'quang.huy@thongmai.local', 'Can ho 1501, 103 Tran Phu, Nha Trang, Khanh Hoa', 'apartment', 72.00, 2.70, 2, 'Warm modern', 'Go sang - xam am', 98000000.00, '2026-07-10', 'Can thiet ke tron goi phong khach va bep, co them khu lam viec nho.', 'designing', NULL, '2026-05-26 08:43:33', '2026-05-27 08:43:33', NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(5, 10, 2, 'YC202605310005', 'Do Mai Phuong', '0901000005', 'mai.phuong@thongmai.local', '220 Nguyen Trai, Ninh Kieu, Can Tho', 'office', 46.00, 3.00, 2, 'Professional minimalist', 'Trang - xam - xanh navy', 72000000.00, '2026-06-25', 'Van phong 6-8 cho ngoi, co ban lam viec, tu ho so va khu tiep khach nho.', 'sent_design', NULL, '2026-05-25 08:43:33', '2026-05-26 08:43:33', NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(6, 11, 2, 'YC202605310006', 'Vo Tuan Kiet', '0901000006', 'tuan.kiet@thongmai.local', '9 Phan Dang Luu, Phu Nhuan, Ho Chi Minh City', 'cafe', 62.00, 3.10, 1, 'Industrial cozy', 'Nau go - den - cam dat', 145000000.00, '2026-07-20', 'Can lam ben trong cafe 40 cho, co khu bar va goc check-in dep.', 'completed', NULL, '2026-05-23 08:43:33', '2026-05-24 08:43:33', '2026-05-31 12:54:11', NULL, '2026-05-31 08:43:33', '2026-05-31 12:54:11', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_06_000001_create_roles_table', 1),
(5, '2026_05_06_000002_create_permissions_table', 1),
(6, '2026_05_06_000003_create_role_user_table', 1),
(7, '2026_05_06_000004_create_permission_role_table', 1),
(8, '2026_05_06_000005_create_categories_table', 1),
(9, '2026_05_06_000008_create_products_table', 1),
(10, '2026_05_06_000009_create_product_images_table', 1),
(11, '2026_05_06_000010_create_carts_table', 1),
(12, '2026_05_06_000011_create_cart_items_table', 1),
(13, '2026_05_06_000012_create_orders_table', 1),
(14, '2026_05_06_000013_create_order_items_table', 1),
(15, '2026_05_06_000014_create_order_status_logs_table', 1),
(16, '2026_05_06_000016_create_design_requests_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_note` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('unpaid','partial','paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `status` enum('pending','processing','preparing','shipping','completed','cancelled','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `subtotal` decimal(15,2) NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `shipping_fee` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `placed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `processed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `customer_name`, `customer_phone`, `customer_email`, `shipping_address`, `shipping_note`, `payment_method`, `payment_status`, `status`, `subtotal`, `tax_amount`, `shipping_fee`, `discount_amount`, `total_amount`, `cancel_reason`, `placed_at`, `processed_at`, `completed_at`, `cancelled_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'DH202605310001', 'Nguyen Minh Anh', '0901000001', 'minh.anh@thongmai.local', '12 Nguyen Hue, Ben Nghe, Quan 1, Ho Chi Minh City', 'Giao sau 14h, goi truoc 30 phut.', 'cod', 'unpaid', 'pending', 19100000.00, 1528000.00, 0.00, 500000.00, 20128000.00, NULL, '2026-05-27 08:43:33', NULL, NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(2, 7, 'DH202605310002', 'Tran Hoang Nam', '0901000002', 'hoang.nam@thongmai.local', '45 Hoang Quoc Viet, Co Nhue 1, Bac Tu Liem, Ha Noi', 'Can lap truoc do day 4 tang.', 'bank_transfer', 'partial', 'processing', 36500000.00, 2920000.00, 0.00, 1200000.00, 38220000.00, NULL, '2026-05-25 08:43:33', '2026-05-26 08:43:33', NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(3, 8, 'DH202605310003', 'Le Thuy Linh', '0901000003', 'thuy.linh@thongmai.local', '78 Le Loi, Hai Chau 1, Hai Chau, Da Nang', 'Can sua truoc 1 ngay de doi khung gio giao.', 'cod', 'unpaid', 'shipping', 42600000.00, 3408000.00, 0.00, 1200000.00, 44808000.00, NULL, '2026-05-28 08:43:33', '2026-05-29 08:43:33', NULL, NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(4, 9, 'DH202605310004', 'Pham Quang Huy', '0901000004', 'quang.huy@thongmai.local', '103 Tran Phu, Loc Tho, Nha Trang, Khanh Hoa', 'Da thanh toan toan bo qua chuyen khoan.', 'bank_transfer', 'paid', 'completed', 19100000.00, 1528000.00, 0.00, 500000.00, 20128000.00, NULL, '2026-05-21 08:43:33', '2026-05-22 08:43:33', '2026-05-24 08:43:33', NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(5, 10, 'DH202605310005', 'Do Mai Phuong', '0901000005', 'mai.phuong@thongmai.local', '220 Nguyen Trai, Phong 3, Ninh Kieu, Can Tho', 'Khach doi xem mau hoan thien truoc khi dat lai.', 'cod', 'unpaid', 'cancelled', 12740000.00, 1019200.00, 250000.00, 0.00, 14009200.00, 'Khach doi chuyen sang mau noi that khac phu hop hon.', '2026-05-23 08:43:33', NULL, NULL, '2026-05-24 08:43:33', '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL),
(6, 11, 'DH202605310006', 'Vo Tuan Kiet', '0901000006', 'tuan.kiet@thongmai.local', '9 Phan Dang Luu, Phu Nhuan, Ho Chi Minh City', 'Hang duoc dong goi cao cap de van chuyen xe tai nho.', 'bank_transfer', 'refunded', 'returned', 18300000.00, 1464000.00, 0.00, 500000.00, 19264000.00, NULL, '2026-05-15 08:43:33', '2026-05-16 08:43:33', '2026-05-19 08:43:33', NULL, '2026-05-31 08:43:33', '2026-05-31 08:43:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_code_snapshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name_snapshot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image_path_snapshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `line_total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_code_snapshot`, `product_name_snapshot`, `product_image_path_snapshot`, `quantity`, `unit_price`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'SP0001', 'Sofa vải 3 chỗ Milan', NULL, 1, 12900000.00, 12900000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(2, 1, 12, 'SP0012', 'Bàn trà đôi tổ ong', NULL, 1, 6200000.00, 6200000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(3, 2, 6, 'SP0006', 'Sofa da 3 chỗ Verona', NULL, 1, 21900000.00, 21900000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(4, 2, 25, 'SP0025', 'Tủ giày đa năng kèm móc treo', NULL, 2, 7300000.00, 14600000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(5, 3, 17, 'SP0017', 'Kệ tivi treo tường hiện đại', NULL, 1, 5400000.00, 5400000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(6, 3, 34, 'SP0034', 'Giường gỗ công nghiệp hiện đại', NULL, 4, 9300000.00, 37200000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(7, 4, 41, 'SP0041', 'Tủ quần áo 4 cánh', NULL, 1, 9700000.00, 9700000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(8, 4, 48, 'SP0048', 'Bàn phấn ngăn kéo đôi', NULL, 2, 4700000.00, 9400000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(9, 5, 57, 'SP0057', 'Bàn ăn mặt đá 4 ghế', NULL, 1, 9800000.00, 9800000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(10, 5, 63, 'SP0063', 'Ghế ăn Nordic lưng cong', NULL, 3, 980000.00, 2940000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(11, 6, 1, 'SP0001', 'Sofa vải 3 chỗ Milan', NULL, 1, 12900000.00, 12900000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33'),
(12, 6, 17, 'SP0017', 'Kệ tivi treo tường hiện đại', NULL, 1, 5400000.00, 5400000.00, '2026-05-31 08:43:33', '2026-05-31 08:43:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status_logs`
--

CREATE TABLE `order_status_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `changed_by` bigint UNSIGNED DEFAULT NULL,
  `from_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('customer@thongmai.local', '$2y$12$hAj1bBQ4smxvQTUrKVw0KOg14yoO6DUHzmWDh6TMjlUzdmkR2Meem', '2026-05-31 08:37:41'),
('hunghuy0925@gmail.com', '$2y$12$ocemOziLZ.Y3yxIjQYydNeYAzRc3vVRj8QlPRoQC1G5/Vxt7ZnFqG', '2026-05-31 08:40:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `code`, `module`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'View products', 'product.view', 'product', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(2, 'Create products', 'product.create', 'product', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(3, 'Update products', 'product.update', 'product', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(4, 'Delete products', 'product.delete', 'product', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(5, 'Manage product images', 'product.manage_image', 'product', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(6, 'Update product stock', 'product.update_stock', 'product', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(7, 'View categories', 'category.view', 'category', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(8, 'Create categories', 'category.create', 'category', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(9, 'Update categories', 'category.update', 'category', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(10, 'Delete categories', 'category.delete', 'category', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(11, 'View carts', 'cart.view', 'cart', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(12, 'Add items to cart', 'cart.add', 'cart', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(13, 'Update cart items', 'cart.update', 'cart', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(14, 'Clear cart', 'cart.clear', 'cart', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(15, 'View orders', 'order.view', 'order', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(16, 'View order detail', 'order.detail', 'order', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(17, 'View own orders', 'order.own_view', 'order', NULL, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(18, 'View own order detail', 'order.own_detail', 'order', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(19, 'Create orders', 'order.create', 'order', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(20, 'Update order status', 'order.update_status', 'order', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(21, 'Cancel orders', 'order.cancel', 'order', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(22, 'View customers', 'customer.view', 'customer', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(23, 'View customer detail', 'customer.detail', 'customer', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(24, 'Lock customer accounts', 'customer.lock', 'customer', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(25, 'Update profile', 'profile.update', 'profile', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(26, 'View users', 'user.view', 'user', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(27, 'Create users', 'user.create', 'user', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(28, 'Update users', 'user.update', 'user', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(29, 'Lock users', 'user.lock', 'user', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(30, 'View roles', 'role.view', 'role', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(31, 'Create roles', 'role.create', 'role', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(32, 'Update roles', 'role.update', 'role', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(33, 'Delete roles', 'role.delete', 'role', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(34, 'View permissions', 'permission.view', 'permission', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(35, 'Assign permissions', 'permission.assign', 'permission', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(36, 'Create design requests', 'design_request.create', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(37, 'View design requests', 'design_request.view', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(38, 'View design request detail', 'design_request.detail', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(39, 'View own design requests', 'design_request.own_view', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(40, 'View own design request detail', 'design_request.own_detail', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(41, 'Update design request status', 'design_request.update_status', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(42, 'Export design reports', 'design_request.export', 'design_request', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(43, 'View reports', 'report.view', 'report', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(44, 'Export reports', 'report.export', 'report', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL),
(45, 'View activity logs', 'activity_log.view', 'activity_log', NULL, '2026-05-18 07:50:47', '2026-05-18 07:50:47', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(2, 2, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(3, 3, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(4, 4, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(5, 5, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(6, 6, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(7, 7, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(8, 8, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(9, 9, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(10, 10, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(11, 11, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(12, 12, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(13, 13, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(14, 14, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(15, 15, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(16, 16, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(17, 17, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(18, 18, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(19, 19, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(20, 20, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(21, 21, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(22, 22, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(23, 23, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(24, 24, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(25, 25, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(26, 26, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(27, 27, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(28, 28, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(29, 29, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(30, 30, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(31, 31, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(32, 32, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(33, 33, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(34, 34, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(35, 35, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(36, 36, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(37, 37, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(38, 38, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(39, 39, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(40, 40, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(41, 41, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(42, 42, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(43, 43, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(44, 44, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(45, 45, 4, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(46, 11, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(47, 12, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(48, 13, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(49, 14, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(50, 19, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(51, 17, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(52, 18, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(53, 21, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(54, 36, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(55, 39, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(56, 40, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(57, 25, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(58, 21, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(59, 16, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(60, 17, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(61, 2, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(62, 4, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(63, 5, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(64, 6, 3, '2026-05-30 10:33:35', '2026-05-30 10:33:35'),
(65, 3, 3, '2026-05-30 10:33:36', '2026-05-30 10:33:36'),
(66, 1, 3, '2026-05-30 10:33:36', '2026-05-30 10:33:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,2) NOT NULL,
  `cost_price` decimal(15,2) DEFAULT NULL,
  `size` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_quantity` int UNSIGNED NOT NULL DEFAULT '0',
  `low_stock_threshold` int UNSIGNED NOT NULL DEFAULT '5',
  `status` enum('active','hidden') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_code`, `slug`, `name`, `description`, `price`, `cost_price`, `size`, `material`, `color`, `stock_quantity`, `low_stock_threshold`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'SP0001', 'sofa-vai-3-cho-milan', 'Sofa vải 3 chỗ Milan', 'Mẫu Sofa vải 3 chỗ Milan phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 12900000.00, 8385000.00, '220x90x85 cm', 'Khung gỗ thông, vải bố cao cấp', 'Xám ghi', 6, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(2, 5, 'SP0002', 'sofa-goc-l-nordic', 'Sofa góc L Nordic', 'Mẫu Sofa góc L Nordic phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 16800000.00, 10920000.00, '280x180x88 cm', 'Khung gỗ sồi, vải nhung', 'Be nhạt', 4, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(3, 5, 'SP0003', 'sofa-bang-2-cho-compact', 'Sofa băng 2 chỗ Compact', 'Mẫu Sofa băng 2 chỗ Compact phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 8900000.00, 5785000.00, '180x85x82 cm', 'Gỗ thông, mút D40', 'Xanh olive', 8, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(4, 5, 'SP0004', 'sofa-giuong-da-nang-urban', 'Sofa giường đa năng Urban', 'Mẫu Sofa giường đa năng Urban phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 14900000.00, 9685000.00, '200x100x90 cm', 'Khung thép sơn tĩnh điện, vải polyester', 'Xanh than', 5, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(5, 5, 'SP0005', 'ghe-don-sofa-dong-bo', 'Ghế đôn sofa đồng bộ', 'Mẫu Ghế đôn sofa đồng bộ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2200000.00, 1430000.00, '70x55x42 cm', 'Vải nỉ, chân gỗ tự nhiên', 'Kem', 12, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(6, 6, 'SP0006', 'sofa-da-3-cho-verona', 'Sofa da 3 chỗ Verona', 'Mẫu Sofa da 3 chỗ Verona phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 21900000.00, 14235000.00, '230x95x88 cm', 'Da bò Ý, khung gỗ sồi', 'Nâu cognac', 3, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(7, 6, 'SP0007', 'sofa-goc-l-da-cong-nghiep', 'Sofa góc L da công nghiệp', 'Mẫu Sofa góc L da công nghiệp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 17900000.00, 11635000.00, '275x175x86 cm', 'Da PU, khung gỗ dầu', 'Đen', 4, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(8, 6, 'SP0008', 'sofa-bang-da-2-cho', 'Sofa băng da 2 chỗ', 'Mẫu Sofa băng da 2 chỗ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 13200000.00, 8580000.00, '190x92x84 cm', 'Da microfiber, mút đàn hồi', 'Nâu đậm', 5, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(9, 6, 'SP0009', 'ghe-don-da-thu-gian', 'Ghế đơn da thư giãn', 'Mẫu Ghế đơn da thư giãn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 7600000.00, 4940000.00, '92x86x98 cm', 'Da thật, chân thép sơn', 'Nâu caramel', 7, 5, 'active', '2026-05-18 09:31:47', '2026-05-31 08:26:04', NULL),
(10, 6, 'SP0010', 'don-da-phong-khach', 'Đôn da phòng khách', 'Mẫu Đôn da phòng khách phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1950000.00, 1267500.00, '60x45x40 cm', 'Da PU, khung gỗ MDF', 'Đen', 15, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(11, 7, 'SP0011', 'ban-tra-mat-da-marble', 'Bàn trà mặt đá marble', 'Mẫu Bàn trà mặt đá marble phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5400000.00, 3510000.00, '120x60x45 cm', 'Đá marble, chân inox', 'Trắng vân xám', 10, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(12, 7, 'SP0012', 'ban-tra-doi-to-ong', 'Bàn trà đôi tổ ong', 'Mẫu Bàn trà đôi tổ ong phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6200000.00, 4030000.00, '80x80x42 cm', 'MDF phủ melamine, chân sắt', 'Nâu óc chó', 7, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(13, 7, 'SP0013', 'ban-tra-tron-kinh-cuong-luc', 'Bàn trà tròn kính cường lực', 'Mẫu Bàn trà tròn kính cường lực phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3900000.00, 2535000.00, '90x90x40 cm', 'Kính cường lực, thép sơn', 'Đen', 12, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(14, 7, 'SP0014', 'ban-tra-ngan-keo-go-soi', 'Bàn trà ngăn kéo gỗ sồi', 'Mẫu Bàn trà ngăn kéo gỗ sồi phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 7100000.00, 4615000.00, '130x70x45 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 6, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(15, 7, 'SP0015', 'ban-tra-nang-mat-da-nang', 'Bàn trà nâng mặt đa năng', 'Mẫu Bàn trà nâng mặt đa năng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5800000.00, 3770000.00, '110x55x48 cm', 'MDF chống ẩm, piston thép', 'Kem', 8, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(16, 8, 'SP0016', 'ke-tivi-go-soi-2m', 'Kệ tivi gỗ sồi 2m', 'Mẫu Kệ tivi gỗ sồi 2m phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6900000.00, 4485000.00, '200x40x50 cm', 'Gỗ sồi', 'Nâu tự nhiên', 8, 5, 'active', '2026-05-18 09:31:48', '2026-05-31 08:26:04', NULL),
(17, 8, 'SP0017', 'ke-tivi-treo-tuong-hien-dai', 'Kệ tivi treo tường hiện đại', 'Mẫu Kệ tivi treo tường hiện đại phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5400000.00, 3510000.00, '180x35x30 cm', 'MDF phủ veneer', 'Trắng kem', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(18, 8, 'SP0018', 'ke-tivi-thap-phong-cach-nhat', 'Kệ tivi thấp phong cách Nhật', 'Mẫu Kệ tivi thấp phong cách Nhật phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4800000.00, 3120000.00, '160x38x42 cm', 'Gỗ ash', 'Sồi sáng', 11, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(19, 8, 'SP0019', 'ke-tivi-tich-hop-ngan-keo', 'Kệ tivi tích hợp ngăn kéo', 'Mẫu Kệ tivi tích hợp ngăn kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 8200000.00, 5330000.00, '220x45x55 cm', 'MDF lõi xanh, phụ kiện giảm chấn', 'Xám khói', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(20, 8, 'SP0020', 'ke-tivi-mat-da-sang-trong', 'Kệ tivi mặt đá sang trọng', 'Mẫu Kệ tivi mặt đá sang trọng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 11800000.00, 7670000.00, '210x42x48 cm', 'Đá nhân tạo, khung gỗ', 'Đen vân trắng', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(21, 9, 'SP0021', 'tu-giay-3-canh-canh-lat', 'Tủ giày 3 cánh cánh lật', 'Mẫu Tủ giày 3 cánh cánh lật phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3900000.00, 2535000.00, '120x35x100 cm', 'MDF chống ẩm', 'Trắng', 14, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(22, 9, 'SP0022', 'tu-giay-go-soi-co-ghe-ngoi', 'Tủ giày gỗ sồi có ghế ngồi', 'Mẫu Tủ giày gỗ sồi có ghế ngồi phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6200000.00, 4030000.00, '140x40x110 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 7, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(23, 9, 'SP0023', 'tu-giay-thong-thoang-5-tang', 'Tủ giày thông thoáng 5 tầng', 'Mẫu Tủ giày thông thoáng 5 tầng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2800000.00, 1820000.00, '100x30x120 cm', 'Gỗ thông', 'Tự nhiên', 18, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(24, 9, 'SP0024', 'tu-giay-cua-lua-hien-dai', 'Tủ giày cửa lùa hiện đại', 'Mẫu Tủ giày cửa lùa hiện đại phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5100000.00, 3315000.00, '150x35x105 cm', 'MDF phủ melamine', 'Xám nhạt', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(25, 9, 'SP0025', 'tu-giay-da-nang-kem-moc-treo', 'Tủ giày đa năng kèm móc treo', 'Mẫu Tủ giày đa năng kèm móc treo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 7300000.00, 4745000.00, '160x40x180 cm', 'MDF, thép sơn tĩnh điện', 'Nâu óc chó', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(26, 10, 'SP0026', 'ghe-thu-gian-boc-vai-boucle', 'Ghế thư giãn bọc vải bouclé', 'Mẫu Ghế thư giãn bọc vải bouclé phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5600000.00, 3640000.00, '88x82x92 cm', 'Vải bouclé, chân gỗ sồi', 'Kem sữa', 10, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(27, 10, 'SP0027', 'ghe-bap-benh-thu-gian', 'Ghế bập bênh thư giãn', 'Mẫu Ghế bập bênh thư giãn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4100000.00, 2665000.00, '84x78x94 cm', 'Vải nỉ, khung gỗ uốn cong', 'Xám tro', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(28, 10, 'SP0028', 'ghe-don-lounge-boc-da', 'Ghế đơn lounge bọc da', 'Mẫu Ghế đơn lounge bọc da phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 8100000.00, 5265000.00, '90x86x100 cm', 'Da microfiber, chân thép', 'Nâu caramel', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(29, 10, 'SP0029', 'ghe-papasan-kem-dem', 'Ghế papasan kèm đệm', 'Mẫu Ghế papasan kèm đệm phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3650000.00, 2372500.00, '95x90x95 cm', 'Mây tre, đệm cotton', 'Tự nhiên', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(30, 10, 'SP0030', 'ghe-nam-doc-sach-co-gac-chan', 'Ghế nằm đọc sách có gác chân', 'Mẫu Ghế nằm đọc sách có gác chân phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 9200000.00, 5980000.00, '150x82x95 cm', 'Vải polyester, khung gỗ', 'Xanh rêu', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(31, 11, 'SP0031', 'giuong-go-oc-cho-1m8', 'Giường gỗ óc chó 1m8', 'Mẫu Giường gỗ óc chó 1m8 phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 16200000.00, 10530000.00, '200x180x35 cm', 'Gỗ óc chó', 'Nâu óc chó', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(32, 11, 'SP0032', 'giuong-go-soi-co-hoc-keo', 'Giường gỗ sồi có hộc kéo', 'Mẫu Giường gỗ sồi có hộc kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 14800000.00, 9620000.00, '210x160x38 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(33, 11, 'SP0033', 'giuong-go-ash-kieu-nhat', 'Giường gỗ ash kiểu Nhật', 'Mẫu Giường gỗ ash kiểu Nhật phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 11900000.00, 7735000.00, '205x160x32 cm', 'Gỗ ash', 'Vàng sồi', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(34, 11, 'SP0034', 'giuong-go-cong-nghiep-hien-dai', 'Giường gỗ công nghiệp hiện đại', 'Mẫu Giường gỗ công nghiệp hiện đại phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 9300000.00, 6045000.00, '200x160x34 cm', 'MDF chống ẩm', 'Trắng kem', 8, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(35, 11, 'SP0035', 'giuong-platform-toi-gian', 'Giường platform tối giản', 'Mẫu Giường platform tối giản phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 10700000.00, 6955000.00, '200x180x28 cm', 'Gỗ thông', 'Tự nhiên', 7, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(36, 12, 'SP0036', 'giuong-boc-nem-dau-cong', 'Giường bọc nệm đầu cong', 'Mẫu Giường bọc nệm đầu cong phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 13900000.00, 9035000.00, '210x180x100 cm', 'Khung gỗ, nỉ cao cấp', 'Xám ghi', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(37, 12, 'SP0037', 'giuong-boc-nem-nhung-mem', 'Giường bọc nệm nhung mềm', 'Mẫu Giường bọc nệm nhung mềm phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 15700000.00, 10205000.00, '220x180x105 cm', 'Vải nhung, khung gỗ thông', 'Xanh navy', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(38, 12, 'SP0038', 'giuong-boc-nem-co-ngan-keo', 'Giường bọc nệm có ngăn kéo', 'Mẫu Giường bọc nệm có ngăn kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 16800000.00, 10920000.00, '210x160x102 cm', 'Vải polyester, ván plywood', 'Be', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(39, 12, 'SP0039', 'giuong-boc-nem-chan-thap', 'Giường bọc nệm chân thấp', 'Mẫu Giường bọc nệm chân thấp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 12400000.00, 8060000.00, '200x160x96 cm', 'Nỉ, gỗ công nghiệp', 'Xám đậm', 8, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(40, 12, 'SP0040', 'giuong-boc-nem-luxury-king-size', 'Giường bọc nệm luxury king size', 'Mẫu Giường bọc nệm luxury king size phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 22900000.00, 14885000.00, '220x200x110 cm', 'Da microfiber, khung gỗ sồi', 'Nâu champagne', 2, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(41, 13, 'SP0041', 'tu-quan-ao-4-canh', 'Tủ quần áo 4 cánh', 'Mẫu Tủ quần áo 4 cánh phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 9700000.00, 6305000.00, '200x60x220 cm', 'MDF phủ melamine', 'Trắng kem', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(42, 13, 'SP0042', 'tu-quan-ao-cua-lua-3-canh', 'Tủ quần áo cửa lùa 3 cánh', 'Mẫu Tủ quần áo cửa lùa 3 cánh phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 11500000.00, 7475000.00, '180x60x220 cm', 'MDF lõi xanh', 'Xám khói', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(43, 13, 'SP0043', 'tu-quan-ao-kem-ngan-keo', 'Tủ quần áo kèm ngăn kéo', 'Mẫu Tủ quần áo kèm ngăn kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 12800000.00, 8320000.00, '220x60x220 cm', 'Gỗ công nghiệp chống ẩm', 'Nâu óc chó', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(44, 13, 'SP0044', 'tu-quan-ao-canh-kinh-mo', 'Tủ quần áo cánh kính mờ', 'Mẫu Tủ quần áo cánh kính mờ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 14900000.00, 9685000.00, '200x65x230 cm', 'MDF, kính mờ, nhôm', 'Đen + khói', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(45, 13, 'SP0045', 'tu-quan-ao-mini-2-canh', 'Tủ quần áo mini 2 cánh', 'Mẫu Tủ quần áo mini 2 cánh phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6200000.00, 4030000.00, '120x55x190 cm', 'Gỗ thông', 'Tự nhiên', 10, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(46, 14, 'SP0046', 'ban-trang-diem-co-guong-led', 'Bàn trang điểm có gương LED', 'Mẫu Bàn trang điểm có gương LED phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5200000.00, 3380000.00, '100x45x75 cm', 'MDF chống ẩm', 'Trắng', 8, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(47, 14, 'SP0047', 'ban-trang-diem-go-soi-mini', 'Bàn trang điểm gỗ sồi mini', 'Mẫu Bàn trang điểm gỗ sồi mini phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6100000.00, 3965000.00, '110x50x78 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(48, 14, 'SP0048', 'ban-phan-ngan-keo-doi', 'Bàn phấn ngăn kéo đôi', 'Mẫu Bàn phấn ngăn kéo đôi phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4700000.00, 3055000.00, '95x45x72 cm', 'MDF phủ veneer', 'Kem', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(49, 14, 'SP0049', 'ban-trang-diem-phong-cach-han', 'Bàn trang điểm phong cách Hàn', 'Mẫu Bàn trang điểm phong cách Hàn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6800000.00, 4420000.00, '105x48x76 cm', 'Gỗ công nghiệp', 'Be sáng', 7, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(50, 14, 'SP0050', 'ban-trang-diem-kem-ghe-don', 'Bàn trang điểm kèm ghế đôn', 'Mẫu Bàn trang điểm kèm ghế đôn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 7900000.00, 5135000.00, '120x50x78 cm', 'MDF, chân thép sơn', 'Trắng mờ', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(51, 15, 'SP0051', 'tab-dau-giuong-2-ngan-keo', 'Tab đầu giường 2 ngăn kéo', 'Mẫu Tab đầu giường 2 ngăn kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1800000.00, 1170000.00, '50x40x55 cm', 'Gỗ MDF', 'Xám', 15, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(52, 15, 'SP0052', 'tab-dau-giuong-go-soi', 'Tab đầu giường gỗ sồi', 'Mẫu Tab đầu giường gỗ sồi phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2600000.00, 1690000.00, '48x38x52 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 11, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(53, 15, 'SP0053', 'tab-dau-giuong-treo-tuong', 'Tab đầu giường treo tường', 'Mẫu Tab đầu giường treo tường phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1450000.00, 942500.00, '45x30x25 cm', 'MDF chống ẩm', 'Trắng', 20, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(54, 15, 'SP0054', 'tab-dau-giuong-mat-da', 'Tab đầu giường mặt đá', 'Mẫu Tab đầu giường mặt đá phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3100000.00, 2015000.00, '50x40x50 cm', 'Đá nhân tạo, khung thép', 'Đen', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(55, 15, 'SP0055', 'tab-dau-giuong-toi-gian', 'Tab đầu giường tối giản', 'Mẫu Tab đầu giường tối giản phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2100000.00, 1365000.00, '42x35x48 cm', 'Gỗ thông', 'Tự nhiên', 14, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(56, 16, 'SP0056', 'ban-an-go-tu-nhien-6-ghe', 'Bàn ăn gỗ tự nhiên 6 ghế', 'Mẫu Bàn ăn gỗ tự nhiên 6 ghế phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 11900000.00, 7735000.00, '160x80x75 cm', 'Gỗ ash', 'Nâu sáng', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(57, 16, 'SP0057', 'ban-an-mat-da-4-ghe', 'Bàn ăn mặt đá 4 ghế', 'Mẫu Bàn ăn mặt đá 4 ghế phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 9800000.00, 6370000.00, '140x80x75 cm', 'Đá ceramic, chân thép', 'Trắng vân xám', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(58, 16, 'SP0058', 'ban-an-tron-mo-rong', 'Bàn ăn tròn mở rộng', 'Mẫu Bàn ăn tròn mở rộng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 13600000.00, 8840000.00, '120-160x120x75 cm', 'Gỗ sồi, cơ cấu mở rộng', 'Nâu mật ong', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(59, 16, 'SP0059', 'ban-an-8-ghe-phong-cach-bac-au', 'Bàn ăn 8 ghế phong cách Bắc Âu', 'Mẫu Bàn ăn 8 ghế phong cách Bắc Âu phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 18500000.00, 12025000.00, '180x90x75 cm', 'Gỗ tần bì, vải nệm', 'Kem + gỗ tự nhiên', 2, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(60, 16, 'SP0060', 'ban-an-gap-gon-can-ho', 'Bàn ăn gấp gọn căn hộ', 'Mẫu Bàn ăn gấp gọn căn hộ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6900000.00, 4485000.00, '120x75x75 cm', 'MDF chống ẩm', 'Trắng', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(61, 17, 'SP0061', 'ghe-an-go-boc-nem', 'Ghế ăn gỗ bọc nệm', 'Mẫu Ghế ăn gỗ bọc nệm phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1250000.00, 812500.00, '45x52x82 cm', 'Gỗ sồi, nệm vải', 'Nâu sáng', 20, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(62, 17, 'SP0062', 'ghe-an-boc-da-cong-nghiep', 'Ghế ăn bọc da công nghiệp', 'Mẫu Ghế ăn bọc da công nghiệp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1450000.00, 942500.00, '46x54x84 cm', 'Da PU, chân thép', 'Đen', 18, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(63, 17, 'SP0063', 'ghe-an-nordic-lung-cong', 'Ghế ăn Nordic lưng cong', 'Mẫu Ghế ăn Nordic lưng cong phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 980000.00, 637000.00, '44x50x80 cm', 'Gỗ ash', 'Tự nhiên', 24, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(64, 17, 'SP0064', 'ghe-an-dem-nhung', 'Ghế ăn đệm nhung', 'Mẫu Ghế ăn đệm nhung phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1690000.00, 1098500.00, '46x53x83 cm', 'Vải nhung, chân gỗ', 'Xanh rêu', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(65, 17, 'SP0065', 'ghe-an-quay-bar-cao', 'Ghế ăn quầy bar cao', 'Mẫu Ghế ăn quầy bar cao phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1790000.00, 1163500.00, '48x50x105 cm', 'Sắt sơn tĩnh điện, gỗ', 'Đen + nâu', 10, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(66, 18, 'SP0066', 'tu-bep-chu-l-acrylic', 'Tủ bếp chữ L Acrylic', 'Mẫu Tủ bếp chữ L Acrylic phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 28500000.00, 18525000.00, '300x60x220 cm', 'MDF lõi xanh phủ Acrylic', 'Trắng bóng', 2, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(67, 18, 'SP0067', 'tu-bep-tren-duoi-laminate', 'Tủ bếp trên dưới laminate', 'Mẫu Tủ bếp trên dưới laminate phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 23900000.00, 15535000.00, '280x60x220 cm', 'MDF chống ẩm phủ Laminate', 'Xám khói', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(68, 18, 'SP0068', 'tu-bep-chu-i-can-ho', 'Tủ bếp chữ I căn hộ', 'Mẫu Tủ bếp chữ I căn hộ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 19800000.00, 12870000.00, '240x60x220 cm', 'MDF chống ẩm', 'Kem', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(69, 18, 'SP0069', 'tu-bep-go-soi-tu-nhien', 'Tủ bếp gỗ sồi tự nhiên', 'Mẫu Tủ bếp gỗ sồi tự nhiên phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 36900000.00, 23985000.00, '320x65x220 cm', 'Gỗ sồi', 'Nâu sáng', 1, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(70, 18, 'SP0070', 'tu-bep-module-treo-tuong', 'Tủ bếp module treo tường', 'Mẫu Tủ bếp module treo tường phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 14900000.00, 9685000.00, '200x35x80 cm', 'MDF chống ẩm', 'Trắng kem', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(71, 19, 'SP0071', 'ke-gia-vi-treo-tuong', 'Kệ gia vị treo tường', 'Mẫu Kệ gia vị treo tường phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 850000.00, 552500.00, '60x15x40 cm', 'Inox 304', 'Bạc', 20, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(72, 19, 'SP0072', 'gia-bat-nang-ha', 'Giá bát nâng hạ', 'Mẫu Giá bát nâng hạ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2900000.00, 1885000.00, '80x30x70 cm', 'Inox sơn tĩnh điện', 'Bạc', 8, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(73, 19, 'SP0073', 'khay-chia-ngan-keo-bep', 'Khay chia ngăn kéo bếp', 'Mẫu Khay chia ngăn kéo bếp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 620000.00, 403000.00, '50x40x5 cm', 'Nhựa ABS', 'Xám', 25, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(74, 19, 'SP0074', 'ke-up-chen-2-tang', 'Kệ úp chén 2 tầng', 'Mẫu Kệ úp chén 2 tầng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1100000.00, 715000.00, '60x25x45 cm', 'Inox 304', 'Bạc', 18, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(75, 19, 'SP0075', 'mam-xoay-goc-tu-bep', 'Mâm xoay góc tủ bếp', 'Mẫu Mâm xoay góc tủ bếp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1750000.00, 1137500.00, '80x80x20 cm', 'Thép mạ crom', 'Bạc', 10, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(76, 20, 'SP0076', 'ban-lam-viec-chu-l', 'Bàn làm việc chữ L', 'Mẫu Bàn làm việc chữ L phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4500000.00, 2925000.00, '140x120x75 cm', 'Gỗ MDF, sắt sơn tĩnh điện', 'Nâu + đen', 7, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(77, 20, 'SP0077', 'ban-lam-viec-toi-gian-120cm', 'Bàn làm việc tối giản 120cm', 'Mẫu Bàn làm việc tối giản 120cm phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2900000.00, 1885000.00, '120x60x75 cm', 'MDF phủ melamine', 'Trắng', 15, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(78, 20, 'SP0078', 'ban-lam-viec-co-hoc-tu', 'Bàn làm việc có hộc tủ', 'Mẫu Bàn làm việc có hộc tủ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4100000.00, 2665000.00, '140x70x75 cm', 'Gỗ công nghiệp', 'Nâu sồi', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(79, 20, 'SP0079', 'ban-standing-desk-dien', 'Bàn standing desk điện', 'Mẫu Bàn standing desk điện phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 12500000.00, 8125000.00, '160x80x72-118 cm', 'Khung thép, mặt gỗ MDF', 'Đen', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(80, 20, 'SP0080', 'ban-lam-viec-kem-ke-sach', 'Bàn làm việc kèm kệ sách', 'Mẫu Bàn làm việc kèm kệ sách phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5600000.00, 3640000.00, '150x60x150 cm', 'MDF, thép', 'Xám gỗ', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(81, 21, 'SP0081', 'ghe-cong-thai-hoc-ergonomic', 'Ghế công thái học Ergonomic', 'Mẫu Ghế công thái học Ergonomic phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6200000.00, 4030000.00, '65x65x120 cm', 'Lưới mesh, nhôm', 'Đen', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(82, 21, 'SP0082', 'ghe-xoay-lung-cao', 'Ghế xoay lưng cao', 'Mẫu Ghế xoay lưng cao phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3200000.00, 2080000.00, '68x68x118 cm', 'Da PU, chân thép', 'Nâu đậm', 11, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(83, 21, 'SP0083', 'ghe-luoi-van-phong', 'Ghế lưới văn phòng', 'Mẫu Ghế lưới văn phòng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2100000.00, 1365000.00, '60x60x112 cm', 'Lưới mesh, khung nhựa', 'Đen', 20, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(84, 21, 'SP0084', 'ghe-gaming-lam-viec', 'Ghế gaming làm việc', 'Mẫu Ghế gaming làm việc phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5400000.00, 3510000.00, '70x70x125 cm', 'Da PU, đệm mút lạnh', 'Đen đỏ', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(85, 21, 'SP0085', 'ghe-quy-van-phong', 'Ghế quỳ văn phòng', 'Mẫu Ghế quỳ văn phòng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1800000.00, 1170000.00, '55x55x95 cm', 'Vải lưới, chân thép', 'Xám', 14, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(86, 22, 'SP0086', 'tu-ho-so-3-ngan-co-khoa', 'Tủ hồ sơ 3 ngăn có khóa', 'Mẫu Tủ hồ sơ 3 ngăn có khóa phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2800000.00, 1820000.00, '45x62x100 cm', 'Thép sơn tĩnh điện', 'Xám', 14, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(87, 22, 'SP0087', 'tu-ho-so-canh-kinh', 'Tủ hồ sơ cánh kính', 'Mẫu Tủ hồ sơ cánh kính phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4900000.00, 3185000.00, '90x40x185 cm', 'Thép, kính cường lực', 'Trắng', 8, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(88, 22, 'SP0088', 'tu-tai-lieu-thap-2-canh', 'Tủ tài liệu thấp 2 cánh', 'Mẫu Tủ tài liệu thấp 2 cánh phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2300000.00, 1495000.00, '80x40x90 cm', 'MDF phủ melamine', 'Nâu gỗ', 16, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(89, 22, 'SP0089', 'tu-locker-van-phong-6-ngan', 'Tủ locker văn phòng 6 ngăn', 'Mẫu Tủ locker văn phòng 6 ngăn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5800000.00, 3770000.00, '90x45x180 cm', 'Thép sơn tĩnh điện', 'Xanh nhạt', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(90, 22, 'SP0090', 'tu-ho-so-di-dong', 'Tủ hồ sơ di động', 'Mẫu Tủ hồ sơ di động phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1950000.00, 1267500.00, '40x45x65 cm', 'MDF chống ẩm', 'Trắng kem', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(91, 23, 'SP0091', 'ke-sach-5-tang', 'Kệ sách 5 tầng', 'Mẫu Kệ sách 5 tầng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2100000.00, 1365000.00, '80x30x180 cm', 'Gỗ thông', 'Tự nhiên', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(92, 23, 'SP0092', 'ke-sach-chu-a', 'Kệ sách chữ A', 'Mẫu Kệ sách chữ A phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2600000.00, 1690000.00, '85x35x175 cm', 'MDF, chân sắt', 'Trắng + đen', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(93, 23, 'SP0093', 'ke-sach-treo-tuong', 'Kệ sách treo tường', 'Mẫu Kệ sách treo tường phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1450000.00, 942500.00, '100x20x60 cm', 'MDF chống ẩm', 'Nâu sáng', 20, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(94, 23, 'SP0094', 'ke-sach-module-6-o', 'Kệ sách module 6 ô', 'Mẫu Kệ sách module 6 ô phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3400000.00, 2210000.00, '120x30x120 cm', 'Gỗ công nghiệp', 'Xám gỗ', 10, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(95, 23, 'SP0095', 'ke-sach-co-cua-kinh', 'Kệ sách có cửa kính', 'Mẫu Kệ sách có cửa kính phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5200000.00, 3380000.00, '90x35x190 cm', 'MDF, kính mờ', 'Nâu óc chó', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(96, 24, 'SP0096', 'ban-hoc-sinh-co-ke-sach', 'Bàn học sinh có kệ sách', 'Mẫu Bàn học sinh có kệ sách phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2900000.00, 1885000.00, '120x60x120 cm', 'MDF chống ẩm', 'Trắng', 15, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(97, 24, 'SP0097', 'ban-hoc-doi-cho-be', 'Bàn học đôi cho bé', 'Mẫu Bàn học đôi cho bé phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4100000.00, 2665000.00, '140x60x125 cm', 'Gỗ công nghiệp', 'Xanh pastel', 7, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(98, 24, 'SP0098', 'ban-hoc-thong-minh-nang-ha', 'Bàn học thông minh nâng hạ', 'Mẫu Bàn học thông minh nâng hạ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6800000.00, 4420000.00, '110x60x75-105 cm', 'Khung thép, mặt MDF', 'Trắng xám', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(99, 24, 'SP0099', 'ban-hoc-goc-nho', 'Bàn học góc nhỏ', 'Mẫu Bàn học góc nhỏ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2400000.00, 1560000.00, '100x50x75 cm', 'MDF phủ melamine', 'Nâu sồi', 18, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(100, 24, 'SP0100', 'ban-hoc-co-hoc-keo', 'Bàn học có hộc kéo', 'Mẫu Bàn học có hộc kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3600000.00, 2340000.00, '120x55x76 cm', 'Gỗ thông', 'Tự nhiên', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(101, 25, 'SP0101', 'giuong-tang-tre-em-co-cau-truot', 'Giường tầng trẻ em có cầu trượt', 'Mẫu Giường tầng trẻ em có cầu trượt phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 17900000.00, 11635000.00, '250x120x180 cm', 'Gỗ thông', 'Trắng + hồng', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(102, 25, 'SP0102', 'giuong-tang-go-tu-nhien', 'Giường tầng gỗ tự nhiên', 'Mẫu Giường tầng gỗ tự nhiên phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 16500000.00, 10725000.00, '240x110x175 cm', 'Gỗ sồi', 'Nâu sáng', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(103, 25, 'SP0103', 'giuong-tang-co-ban-hoc', 'Giường tầng có bàn học', 'Mẫu Giường tầng có bàn học phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 19800000.00, 12870000.00, '260x125x190 cm', 'MDF chống ẩm, khung thép', 'Trắng xám', 2, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(104, 25, 'SP0104', 'giuong-tang-toi-gian-cho-be', 'Giường tầng tối giản cho bé', 'Mẫu Giường tầng tối giản cho bé phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 13900000.00, 9035000.00, '230x105x170 cm', 'Gỗ thông', 'Tự nhiên', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(105, 25, 'SP0105', 'giuong-tang-3-ngan-keo', 'Giường tầng 3 ngăn kéo', 'Mẫu Giường tầng 3 ngăn kéo phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 21400000.00, 13910000.00, '250x120x185 cm', 'MDF lõi xanh', 'Xanh navy', 2, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(106, 26, 'SP0106', 'tu-quan-ao-tre-em-2-canh', 'Tủ quần áo trẻ em 2 cánh', 'Mẫu Tủ quần áo trẻ em 2 cánh phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5700000.00, 3705000.00, '100x50x180 cm', 'MDF chống ẩm', 'Trắng hồng', 10, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(107, 26, 'SP0107', 'ban-hoc-tre-em-kem-ghe', 'Bàn học trẻ em kèm ghế', 'Mẫu Bàn học trẻ em kèm ghế phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3300000.00, 2145000.00, '100x55x75 cm', 'Gỗ công nghiệp', 'Xanh pastel', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(108, 26, 'SP0108', 'ke-do-choi-6-o', 'Kệ đồ chơi 6 ô', 'Mẫu Kệ đồ chơi 6 ô phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2500000.00, 1625000.00, '120x30x90 cm', 'MDF bo cạnh', 'Trắng + vàng', 16, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(109, 26, 'SP0109', 'giuong-don-tre-em', 'Giường đơn trẻ em', 'Mẫu Giường đơn trẻ em phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6900000.00, 4485000.00, '190x90x35 cm', 'Gỗ thông', 'Kem', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(110, 26, 'SP0110', 'ghe-ngoi-doc-sach-tre-em', 'Ghế ngồi đọc sách trẻ em', 'Mẫu Ghế ngồi đọc sách trẻ em phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1650000.00, 1072500.00, '55x55x60 cm', 'Vải nỉ, mút mềm', 'Đỏ cam', 14, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(111, 27, 'SP0111', 'tu-trung-bay-canh-kinh', 'Tủ trưng bày cánh kính', 'Mẫu Tủ trưng bày cánh kính phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 8400000.00, 5460000.00, '90x40x190 cm', 'MDF, kính cường lực', 'Nâu óc chó', 5, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(112, 27, 'SP0112', 'tu-ruou-trung-bay-co-den', 'Tủ rượu trưng bày có đèn', 'Mẫu Tủ rượu trưng bày có đèn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 11300000.00, 7345000.00, '100x45x200 cm', 'Gỗ công nghiệp, kính', 'Đen', 3, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(113, 27, 'SP0113', 'tu-showcase-4-tang', 'Tủ showcase 4 tầng', 'Mẫu Tủ showcase 4 tầng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6900000.00, 4485000.00, '80x35x180 cm', 'MDF phủ veneer', 'Trắng kem', 7, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(114, 27, 'SP0114', 'tu-trung-bay-goc-phong', 'Tủ trưng bày góc phòng', 'Mẫu Tủ trưng bày góc phòng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5200000.00, 3380000.00, '70x70x175 cm', 'Gỗ thông, kính mờ', 'Tự nhiên', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(115, 27, 'SP0115', 'tu-trung-bay-mini', 'Tủ trưng bày mini', 'Mẫu Tủ trưng bày mini phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2900000.00, 1885000.00, '60x30x120 cm', 'MDF chống ẩm', 'Xám nhạt', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(116, 28, 'SP0116', 'ban-console-chan-sat', 'Bàn console chân sắt', 'Mẫu Bàn console chân sắt phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3200000.00, 2080000.00, '120x35x80 cm', 'MDF, sắt sơn tĩnh điện', 'Đen + nâu', 14, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(117, 28, 'SP0117', 'ban-console-mat-da', 'Bàn console mặt đá', 'Mẫu Bàn console mặt đá phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 5900000.00, 3835000.00, '130x40x82 cm', 'Đá nhân tạo, chân thép', 'Trắng vân mây', 6, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(118, 28, 'SP0118', 'ban-console-go-soi', 'Bàn console gỗ sồi', 'Mẫu Bàn console gỗ sồi phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4300000.00, 2795000.00, '110x30x78 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 9, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(119, 28, 'SP0119', 'ban-console-guong-decor', 'Bàn console gương decor', 'Mẫu Bàn console gương decor phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 7600000.00, 4940000.00, '100x35x85 cm', 'Kính, thép không gỉ', 'Bạc', 4, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(120, 28, 'SP0120', 'ban-console-toi-gian', 'Bàn console tối giản', 'Mẫu Bàn console tối giản phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2600000.00, 1690000.00, '100x30x75 cm', 'Gỗ thông', 'Tự nhiên', 18, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(121, 29, 'SP0121', 'tu-ngan-keo-3-hoc', 'Tủ ngăn kéo 3 hộc', 'Mẫu Tủ ngăn kéo 3 hộc phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2500000.00, 1625000.00, '80x45x90 cm', 'MDF phủ melamine', 'Trắng', 12, 5, 'active', '2026-05-31 08:26:04', '2026-05-31 08:26:04', NULL),
(122, 29, 'SP0122', 'tu-ngan-keo-go-soi', 'Tủ ngăn kéo gỗ sồi', 'Mẫu Tủ ngăn kéo gỗ sồi phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4500000.00, 2925000.00, '90x50x100 cm', 'Gỗ sồi tự nhiên', 'Nâu sáng', 8, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(123, 29, 'SP0123', 'tu-ngan-keo-phong-ngu', 'Tủ ngăn kéo phòng ngủ', 'Mẫu Tủ ngăn kéo phòng ngủ phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3600000.00, 2340000.00, '85x45x95 cm', 'Gỗ công nghiệp', 'Xám nhạt', 10, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(124, 29, 'SP0124', 'tu-ngan-keo-co-banh-xe', 'Tủ ngăn kéo có bánh xe', 'Mẫu Tủ ngăn kéo có bánh xe phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1900000.00, 1235000.00, '50x45x65 cm', 'MDF chống ẩm', 'Kem', 20, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(125, 29, 'SP0125', 'tu-ngan-keo-mat-da', 'Tủ ngăn kéo mặt đá', 'Mẫu Tủ ngăn kéo mặt đá phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 6200000.00, 4030000.00, '100x45x92 cm', 'Đá nhân tạo, khung thép', 'Đen', 4, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(126, 30, 'SP0126', 'ke-treo-tuong-3-tang', 'Kệ treo tường 3 tầng', 'Mẫu Kệ treo tường 3 tầng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 950000.00, 617500.00, '60x15x60 cm', 'Gỗ thông', 'Tự nhiên', 30, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(127, 30, 'SP0127', 'ke-treo-tuong-hinh-hop', 'Kệ treo tường hình hộp', 'Mẫu Kệ treo tường hình hộp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1250000.00, 812500.00, '80x20x40 cm', 'MDF phủ melamine', 'Trắng', 22, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(128, 30, 'SP0128', 'ke-treo-tuong-decor-phong-khach', 'Kệ treo tường decor phòng khách', 'Mẫu Kệ treo tường decor phòng khách phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1800000.00, 1170000.00, '100x20x45 cm', 'Gỗ sồi', 'Nâu sáng', 14, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(129, 30, 'SP0129', 'ke-treo-tuong-am-tuong', 'Kệ treo tường âm tường', 'Mẫu Kệ treo tường âm tường phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2400000.00, 1560000.00, '90x25x50 cm', 'MDF chống ẩm', 'Xám', 10, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(130, 30, 'SP0130', 'ke-treo-tuong-zigzag', 'Kệ treo tường zigzag', 'Mẫu Kệ treo tường zigzag phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1600000.00, 1040000.00, '75x18x55 cm', 'MDF, thép sơn', 'Đen + gỗ', 18, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(131, 31, 'SP0131', 'bo-binh-gom-decor', 'Bộ bình gốm decor', 'Mẫu Bộ bình gốm decor phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1100000.00, 715000.00, '30x12x25 cm', 'Gốm sứ', 'Trắng ngà', 25, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(132, 31, 'SP0132', 'tuong-decor-truu-tuong', 'Tượng decor trừu tượng', 'Mẫu Tượng decor trừu tượng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1800000.00, 1170000.00, '20x15x40 cm', 'Composite', 'Đen mờ', 16, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(133, 31, 'SP0133', 'khung-tranh-canvas-set-3', 'Khung tranh canvas set 3', 'Mẫu Khung tranh canvas set 3 phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1450000.00, 942500.00, '40x60 cm', 'Canvas, gỗ thông', 'Đa sắc', 20, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(134, 31, 'SP0134', 'dong-ho-treo-tuong-decor', 'Đồng hồ treo tường decor', 'Mẫu Đồng hồ treo tường decor phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2350000.00, 1527500.00, '60x60x5 cm', 'Kim loại, kính', 'Vàng champagne', 11, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(135, 31, 'SP0135', 'bo-nen-thom-trang-tri', 'Bộ nến thơm trang trí', 'Mẫu Bộ nến thơm trang trí phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 790000.00, 513500.00, '12x12x15 cm', 'Sáp thực vật, thủy tinh', 'Kem', 35, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(136, 32, 'SP0136', 'den-san-doc-sach', 'Đèn sàn đọc sách', 'Mẫu Đèn sàn đọc sách phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2200000.00, 1430000.00, '35x35x160 cm', 'Kim loại sơn, chụp vải', 'Đen', 12, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(137, 32, 'SP0137', 'den-ban-decor-anh-vang', 'Đèn bàn decor ánh vàng', 'Mẫu Đèn bàn decor ánh vàng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1300000.00, 845000.00, '25x25x45 cm', 'Gốm, vải', 'Kem', 18, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(138, 32, 'SP0138', 'den-tha-tran-3-chao', 'Đèn thả trần 3 chao', 'Mẫu Đèn thả trần 3 chao phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3600000.00, 2340000.00, '90x20x120 cm', 'Thép sơn tĩnh điện', 'Đen mờ', 7, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(139, 32, 'SP0139', 'den-ngu-cam-ung', 'Đèn ngủ cảm ứng', 'Mẫu Đèn ngủ cảm ứng phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 890000.00, 578500.00, '18x18x28 cm', 'Nhựa ABS', 'Trắng', 30, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(140, 32, 'SP0140', 'den-tuong-trang-tri', 'Đèn tường trang trí', 'Mẫu Đèn tường trang trí phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1650000.00, 1072500.00, '20x15x35 cm', 'Kim loại, kính mờ', 'Vàng đồng', 14, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(141, 33, 'SP0141', 'ban-ban-cong-gap-gon', 'Bàn ban công gấp gọn', 'Mẫu Bàn ban công gấp gọn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2400000.00, 1560000.00, '70x70x75 cm', 'Gỗ acacia, khung thép', 'Nâu + đen', 14, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(142, 33, 'SP0142', 'ban-ca-phe-ngoai-troi-tron', 'Bàn cà phê ngoài trời tròn', 'Mẫu Bàn cà phê ngoài trời tròn phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1900000.00, 1235000.00, '60x60x70 cm', 'Nhôm đúc', 'Xám đá', 16, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(143, 33, 'SP0143', 'ban-ban-cong-mat-kinh', 'Bàn ban công mặt kính', 'Mẫu Bàn ban công mặt kính phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3100000.00, 2015000.00, '80x80x74 cm', 'Kính cường lực, thép', 'Đen', 9, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(144, 33, 'SP0144', 'ban-san-vuon-go-tu-nhien', 'Bàn sân vườn gỗ tự nhiên', 'Mẫu Bàn sân vườn gỗ tự nhiên phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 4200000.00, 2730000.00, '90x90x75 cm', 'Gỗ teak', 'Nâu teak', 5, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(145, 33, 'SP0145', 'ban-ban-cong-mini-2-ghe', 'Bàn ban công mini 2 ghế', 'Mẫu Bàn ban công mini 2 ghế phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 3600000.00, 2340000.00, '65x65x72 cm', 'Mây nhựa, khung thép', 'Màu mây', 8, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(146, 34, 'SP0146', 'tham-long-ngan-phong-khach', 'Thảm lông ngắn phòng khách', 'Mẫu Thảm lông ngắn phòng khách phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1350000.00, 877500.00, '160x230 cm', 'Polyester', 'Xám nhạt', 20, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(147, 34, 'SP0147', 'tham-det-tay-bac-au', 'Thảm dệt tay Bắc Âu', 'Mẫu Thảm dệt tay Bắc Âu phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 2400000.00, 1560000.00, '200x290 cm', 'Cotton, sợi tổng hợp', 'Be + nâu', 10, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(148, 34, 'SP0148', 'tham-tron-decor', 'Thảm tròn decor', 'Mẫu Thảm tròn decor phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 980000.00, 637000.00, '120 cm', 'Len nhân tạo', 'Kem', 18, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(149, 34, 'SP0149', 'tham-phong-ngu-chong-truot', 'Thảm phòng ngủ chống trượt', 'Mẫu Thảm phòng ngủ chống trượt phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1100000.00, 715000.00, '140x200 cm', 'Microfiber', 'Xanh xám', 16, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL),
(150, 34, 'SP0150', 'tham-hanh-lang-cao-cap', 'Thảm hành lang cao cấp', 'Mẫu Thảm hành lang cao cấp phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.', 1650000.00, 1072500.00, '80x300 cm', 'Polypropylene', 'Nâu đất', 12, 5, 'active', '2026-05-31 08:26:05', '2026-05-31 08:26:05', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `uploaded_by`, `image_path`, `alt_text`, `is_primary`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 1, 'products/10/HU6HtaIvDsGQSRXdv4HLCynZE9H1Bx02WRhYiFpv.jpg', 'Tủ bếp trên dưới chữ L', 0, 0, '2026-05-19 10:14:03', '2026-05-31 09:33:08', '2026-05-31 09:33:08'),
(2, 11, 1, 'products/11/S0tU1iHcNj4v1XLbZpgSvmLyTQXmVZUIk52hOWaB.jpg', 'Ghế bar chân sắt mặt gỗ', 1, 0, '2026-05-19 10:16:37', '2026-05-31 09:35:26', '2026-05-31 09:35:26'),
(3, 12, 1, 'products/12/qw7MPFBYtQZky1lbcgWAeCB78somA64H8tDzgWBa.jpg', 'Kệ gia vị treo tường', 1, 0, '2026-05-19 10:16:51', '2026-05-31 09:36:09', '2026-05-31 09:36:09'),
(4, 13, 1, 'products/13/3FKOhjzvZemKQ0LGEwiEzdXMEBB5y7bA2qGTG15Y.jpg', 'Bàn làm việc chữ L', 1, 0, '2026-05-19 10:17:07', '2026-05-31 09:36:36', '2026-05-31 09:36:36'),
(5, 13, 1, 'products/13/ScSfZn5W792J36l4VgEqhAnpghAjwtUkwj5tDF2X.jpg', 'Bàn làm việc chữ L', 1, 1, '2026-05-19 10:19:57', '2026-05-31 09:36:39', '2026-05-31 09:36:39'),
(6, 13, 1, 'products/13/B9moRJ822lARM0vCo8ypFWQKO7OyHcRDBzTwRfCJ.jpg', 'Bàn làm việc chữ L', 1, 2, '2026-05-19 10:19:57', '2026-05-31 09:36:42', '2026-05-31 09:36:42'),
(7, 13, 1, 'products/13/pUJnPaPitwvlrqzrDXDWD9WzwNJPCKSINwBhwhm3.jpg', 'Bàn làm việc chữ L', 0, 3, '2026-05-19 10:19:57', '2026-05-31 09:36:33', '2026-05-31 09:36:33'),
(8, 128, 1, 'products/128/Vbjct0JKCns3gDGDWkhHLMf8VcTSwqfgsS1eAJ7p.jpg', 'Kệ treo tường decor phòng khách', 1, 0, '2026-05-31 09:21:37', '2026-05-31 09:21:37', NULL),
(9, 135, 1, 'products/135/UfWKYpFfOF96C8cWLWrlzoGeiFdOn5YyEblIJujX.jpg', 'Bộ nến thơm trang trí', 1, 0, '2026-05-31 09:22:14', '2026-05-31 09:22:14', NULL),
(10, 134, 1, 'products/134/ni5ngeWGCoBgfFQotALIgB1pAS0EtcaH0NgEjQGT.jpg', 'Đồng hồ treo tường decor', 1, 0, '2026-05-31 09:22:48', '2026-05-31 09:22:48', NULL),
(11, 133, 1, 'products/133/I0x1Ku3QNUNLQxedWNHu80f5RHnbWoyRBO2G6U96.jpg', 'Khung tranh canvas set 3', 1, 0, '2026-05-31 09:23:08', '2026-05-31 09:23:08', NULL),
(12, 132, 1, 'products/132/cROxQ1Eyl3IONBUakebqMgYHnW3xyTC842bAlcLN.jpg', 'Tượng decor trừu tượng', 1, 0, '2026-05-31 09:23:33', '2026-05-31 09:23:33', NULL),
(13, 131, 1, 'products/131/R9lts4wr5Wj06ugab126AkxgLgAurWYazQqBh9Tl.jpg', 'Bộ bình gốm decor', 1, 0, '2026-05-31 09:23:54', '2026-05-31 09:23:54', NULL),
(14, 130, 1, 'products/130/OrBScY9M4Ru6xjHCbUNf4FsgaWRxkop9WcqYWRr7.jpg', 'Kệ treo tường zigzag', 1, 0, '2026-05-31 09:24:14', '2026-05-31 09:24:14', NULL),
(15, 129, 1, 'products/129/BrraE6XBXZViVMXFxgq4ttnPblD7LyGviJhMK1Us.jpg', 'Kệ treo tường âm tường', 1, 0, '2026-05-31 09:24:48', '2026-05-31 09:24:48', NULL),
(16, 125, 1, 'products/125/e2ncTRaUKQeg6RfXpMVbsdenjSDQNXQC6hr10mNl.jpg', 'Tủ ngăn kéo mặt đá', 1, 0, '2026-05-31 09:25:27', '2026-05-31 09:25:27', NULL),
(17, 122, 1, 'products/122/szhicnmFyzG61Ptsg0qSYzhfiQMmag4vNC72iKUY.jpg', 'Tủ ngăn kéo gỗ sồi', 1, 0, '2026-05-31 09:25:56', '2026-05-31 09:25:56', NULL),
(18, 123, 1, 'products/123/gjIXSxD5pDgTqe8R1McW5UFa1RqI2e0lX5avYG1t.jpg', 'Tủ ngăn kéo phòng ngủ', 1, 0, '2026-05-31 09:26:29', '2026-05-31 09:26:29', NULL),
(19, 124, 1, 'products/124/yiMnC8ik4DoSXzy6EhCDdGojkpMlwyBpWx6D0QWx.jpg', 'Tủ ngăn kéo có bánh xe', 1, 0, '2026-05-31 09:26:59', '2026-05-31 09:26:59', NULL),
(20, 150, 1, 'products/150/u9S0Xe6IfYgSIo7EDHSVcP5fVjAyv3NzYdD8XvvE.jpg', 'Thảm hành lang cao cấp', 1, 0, '2026-05-31 09:27:38', '2026-05-31 09:27:38', NULL),
(21, 126, 1, 'products/126/iISbXjtx7GRVUtX8o33Bhe7YhKb2BNMGLvaNtwQZ.jpg', 'Kệ treo tường 3 tầng', 1, 0, '2026-05-31 09:27:58', '2026-05-31 09:27:58', NULL),
(22, 127, 1, 'products/127/fL0J3pHV4TkOORLSsccXztGgR4KXxDYhAL1O0THq.jpg', 'Kệ treo tường hình hộp', 1, 0, '2026-05-31 09:28:19', '2026-05-31 09:28:19', NULL),
(23, 1, 1, 'products/1/vZAGnldnzaiQygxODZSPTp0vOczpxLMWnncF9eJm.jpg', 'Sofa vải 3 chỗ Milan', 1, 0, '2026-05-31 09:30:40', '2026-05-31 09:30:40', NULL),
(24, 2, 1, 'products/2/wTFd10oBlXvFYLsZIoDrRIbt5SKZp1kXDvgvu27E.jpg', 'Sofa góc L Nordic', 1, 0, '2026-05-31 09:31:01', '2026-05-31 09:31:01', NULL),
(25, 3, 1, 'products/3/hi52dDLLelCoKN5o59F1P2vu6Jcw3YYuVjKd84gU.jpg', 'Sofa băng 2 chỗ Compact', 1, 0, '2026-05-31 09:31:25', '2026-05-31 09:31:25', NULL),
(26, 4, 1, 'products/4/6Gi96tWgpYXViJ8qGKsLLqqTibPZECRrwdwLM1D4.webp', 'Sofa giường đa năng Urban', 1, 0, '2026-05-31 09:31:54', '2026-05-31 09:31:54', NULL),
(27, 5, 1, 'products/5/jFotDTJjw0Ma30l1QLb2EYD6guwmFywkp3v2Bj2L.jpg', 'Ghế đôn sofa đồng bộ', 1, 0, '2026-05-31 09:32:14', '2026-05-31 09:32:14', NULL),
(28, 10, 1, 'products/10/kn55ia0xN5TU4KRYYHqjh7m9MBkhUpChoDM3q8sx.webp', 'Đôn da phòng khách', 1, 1, '2026-05-31 09:33:03', '2026-05-31 09:33:03', NULL),
(29, 6, 1, 'products/6/Qj2YeKtejD5Jq87D4eKZgk9ytrLqq9Z7rKYcC8CE.webp', 'Sofa da 3 chỗ Verona', 1, 0, '2026-05-31 09:33:36', '2026-05-31 09:33:36', NULL),
(30, 7, 1, 'products/7/8w444B8OmBTpkZfZQ2ed5wQSjl0e6FlzwBPWw3SX.jpg', 'Sofa góc L da công nghiệp', 1, 0, '2026-05-31 09:33:56', '2026-05-31 09:33:56', NULL),
(31, 8, 1, 'products/8/UzEMeCoht32DCjFgSIr0NhdnkWfBwJZobEiKbHUy.jpg', 'Sofa băng da 2 chỗ', 1, 0, '2026-05-31 09:34:19', '2026-05-31 09:34:19', NULL),
(32, 9, 1, 'products/9/20cguRhe5e9bJDJqGheho2mrkx1zZ4aQnWfgZe4Z.jpg', 'Ghế đơn da thư giãn', 1, 0, '2026-05-31 09:35:02', '2026-05-31 09:35:02', NULL),
(33, 11, 1, 'products/11/MaleOHGUkvaAozbHDJ1ZJH9fpu6XudU9ZmUZBXJy.jpg', 'Bàn trà mặt đá marble', 1, 0, '2026-05-31 09:35:31', '2026-05-31 09:35:31', NULL),
(34, 12, 1, 'products/12/GSgkup8F1XsYzQTOkdvN9KctSCLVVp9wAzpMp52X.webp', 'Bàn trà đôi tổ ong', 1, 0, '2026-05-31 09:36:12', '2026-05-31 09:36:12', NULL),
(35, 13, 1, 'products/13/Objwke1mGUfuCvShMQX5ExRn6pTelUv3QhR2VsqJ.webp', 'Bàn trà tròn kính cường lực', 1, 0, '2026-05-31 09:36:46', '2026-05-31 09:36:46', NULL),
(36, 14, 1, 'products/14/Tl1yzHPtI4YcxiyehaX85BhOu8KzYE9IrpAahSNb.jpg', 'Bàn trà ngăn kéo gỗ sồi', 1, 0, '2026-05-31 09:37:17', '2026-05-31 09:37:17', NULL),
(37, 15, 1, 'products/15/CFqcLXbCPXat0kkn4LNlTmrBhyW4ca0V1IDWnBzf.jpg', 'Bàn trà nâng mặt đa năng', 1, 0, '2026-05-31 09:37:45', '2026-05-31 09:37:45', NULL),
(38, 17, 1, 'products/17/p9L3wQfuMS22W6ekz4OiCV1bI8L0MEN1ajCT1YfA.webp', 'Kệ tivi treo tường hiện đại', 1, 0, '2026-05-31 09:38:39', '2026-05-31 09:38:39', NULL),
(39, 18, 1, 'products/18/UW9BM1k6kYriRe99Y181g6QRsoLzGAjxYSjpHUm0.jpg', 'Kệ tivi thấp phong cách Nhật', 1, 0, '2026-05-31 09:39:12', '2026-05-31 09:39:12', NULL),
(40, 19, 1, 'products/19/eU1mm5jRSCO3kI8s0SAeXVltsjOoiV7f8KOeYst5.jpg', 'Kệ tivi tích hợp ngăn kéo', 1, 0, '2026-05-31 09:39:55', '2026-05-31 09:39:55', NULL),
(41, 20, 1, 'products/20/eXqCFjY15x6N4LbIhRjGbDtVIvttsONnMVMrObr5.webp', 'Kệ tivi mặt đá sang trọng', 1, 0, '2026-05-31 09:40:29', '2026-05-31 09:40:29', NULL),
(42, 16, 1, 'products/16/2yt46WRg67VZbvgu4j5MyTFQZS3V2fSO85X5M4c8.jpg', 'Kệ tivi gỗ sồi 2m', 1, 0, '2026-05-31 09:41:08', '2026-05-31 09:41:08', NULL),
(43, 21, 1, 'products/21/y2GEzzgiTKaNOIEulTBvvtDymKjcO1sNaZIaQdxB.jpg', 'Tủ giày 3 cánh cánh lật', 1, 0, '2026-05-31 09:41:51', '2026-05-31 09:41:51', NULL),
(44, 22, 1, 'products/22/YfCAEFIOoB2bJzLI9s5KemyBK9TispHCzSqcZevD.jpg', 'Tủ giày gỗ sồi có ghế ngồi', 1, 0, '2026-05-31 09:42:30', '2026-05-31 09:42:30', NULL),
(45, 23, 1, 'products/23/yJJdHExF8M5Yz6EPDCRqSJ2CJTWqfsXfkrUSkSvi.jpg', 'Tủ giày thông thoáng 5 tầng', 1, 0, '2026-05-31 09:43:18', '2026-05-31 09:43:18', NULL),
(46, 24, 1, 'products/24/PutKIEdmb41pr7hJfCkil3yGx1mDkP7CE9K2orB5.jpg', 'Tủ giày cửa lùa hiện đại', 1, 0, '2026-05-31 09:43:50', '2026-05-31 09:43:50', NULL),
(47, 25, 1, 'products/25/L0o6k6SdrpKYHoPbhoQnmRcacX8rR1NvKv82YNZI.jpg', 'Tủ giày đa năng kèm móc treo', 1, 0, '2026-05-31 09:44:18', '2026-05-31 09:44:18', NULL),
(48, 26, 1, 'products/26/GevwBo5zNWKsUobudC8nvQv4BnoVZevYOwrGBYgg.jpg', 'Ghế thư giãn bọc vải bouclé', 1, 0, '2026-05-31 09:44:51', '2026-05-31 09:44:51', NULL),
(49, 27, 1, 'products/27/9rOciVVCmG9Io7SP9aRipdVMY9aTeIsARVwdy7LT.webp', 'Ghế bập bênh thư giãn', 1, 0, '2026-05-31 09:45:09', '2026-05-31 09:45:09', NULL),
(50, 28, 1, 'products/28/UZkg4uEphnAKaY3pJeNDVC0ETDh44W4mZidPBkN1.jpg', 'Ghế đơn lounge bọc da', 1, 0, '2026-05-31 09:45:45', '2026-05-31 09:45:45', NULL),
(51, 29, 1, 'products/29/gUXzPAsAby6AtfNpAxC7Fdm82G3yu2vFyI8Duroi.jpg', 'Ghế papasan kèm đệm', 1, 0, '2026-05-31 09:46:07', '2026-05-31 09:46:07', NULL),
(52, 30, 1, 'products/30/fQaRbh8uCU1t0Iqq0hAY1vCNLQEo1UD9gGdm7TdD.webp', 'Ghế nằm đọc sách có gác chân', 1, 0, '2026-05-31 09:46:36', '2026-05-31 09:46:36', NULL),
(53, 31, 1, 'products/31/HrQq0fjOmGbv80euraaKYM86EB30SgONJT7WIRFK.jpg', 'Giường gỗ óc chó 1m8', 1, 0, '2026-05-31 09:47:15', '2026-05-31 09:47:15', NULL),
(54, 32, 1, 'products/32/1FlAtzUTjmD7cE4vTUDyto7nbUQEmxKhTw5aHG7h.jpg', 'Giường gỗ sồi có hộc kéo', 1, 0, '2026-05-31 09:47:35', '2026-05-31 09:47:35', NULL),
(55, 33, 1, 'products/33/DdxnaKdKNoUuf9ncrLRAaoDRX05TPmz7ysJ1mcMw.jpg', 'Giường gỗ ash kiểu Nhật', 1, 0, '2026-05-31 09:48:00', '2026-05-31 09:48:00', NULL),
(56, 34, 1, 'products/34/QTnuLN2r1v9XTLOhel16T1pWadpYaILdqEkYz1aH.webp', 'Giường gỗ công nghiệp hiện đại', 1, 0, '2026-05-31 09:48:19', '2026-05-31 09:48:19', NULL),
(57, 35, 1, 'products/35/FUxeZbXmrjuYWzmJzASjTylOvPealoZWJLgQJFDS.webp', 'Giường platform tối giản', 0, 0, '2026-05-31 09:48:44', '2026-05-31 09:48:50', '2026-05-31 09:48:50'),
(58, 35, 1, 'products/35/LylKLRdF6yi0XlMPh351yJMVgqeuUaodrAwcs4Sc.webp', 'Giường platform tối giản', 1, 1, '2026-05-31 09:48:47', '2026-05-31 09:48:47', NULL),
(59, 36, 1, 'products/36/plhmaVYXcVJyNRvHEbKcOz8ALJeA3oKLJNieo5cR.jpg', 'Giường bọc nệm đầu cong', 1, 0, '2026-05-31 09:50:46', '2026-05-31 09:50:46', NULL),
(60, 37, 1, 'products/37/UUcDnqu3TLgPpQuJ8NKIiGCx2zsqjHPPt7Y8cbQr.jpg', 'Giường bọc nệm nhung mềm', 1, 0, '2026-05-31 09:51:06', '2026-05-31 09:51:06', NULL),
(61, 38, 1, 'products/38/vJi61K3LAJJXxIT3zoRiAJG61Hgy7A3jQNtUFLiC.jpg', 'Giường bọc nệm có ngăn kéo', 1, 0, '2026-05-31 09:51:27', '2026-05-31 09:51:27', NULL),
(62, 39, 1, 'products/39/J4szi9DGT9KZCTpVLikKNqbq3URt5P8rJoYbz6ue.webp', 'Giường bọc nệm chân thấp', 1, 0, '2026-05-31 09:51:54', '2026-05-31 09:51:54', NULL),
(63, 40, 1, 'products/40/vCRdPe2rlb2oPWRBxDVvubdCfAMx6vwp6WNwAU20.jpg', 'Giường bọc nệm luxury king size', 1, 0, '2026-05-31 09:52:26', '2026-05-31 09:52:26', NULL),
(64, 41, 1, 'products/41/KeolPlg3OrLARZgyp0qwYK0geC14jf7mdPCRDUCn.jpg', 'Tủ quần áo 4 cánh', 1, 0, '2026-05-31 09:53:12', '2026-05-31 09:53:12', NULL),
(65, 42, 1, 'products/42/g1wXK8nksETthM5HnkwBcshdgZ8RY1ATzlAIGcLh.webp', 'Tủ quần áo cửa lùa 3 cánh', 1, 0, '2026-05-31 09:53:43', '2026-05-31 09:53:43', NULL),
(66, 43, 1, 'products/43/hTJhpy7VjOaTSRIKEjL25NlliH0z7LEwNPHTWmZG.jpg', 'Tủ quần áo kèm ngăn kéo', 1, 0, '2026-05-31 09:54:08', '2026-05-31 09:54:08', NULL),
(67, 44, 1, 'products/44/yFtfxS4A4tlCVZ6EJc1zhP24mJSMWpxV9978nAiF.jpg', 'Tủ quần áo cánh kính mờ', 1, 0, '2026-05-31 09:54:31', '2026-05-31 09:54:31', NULL),
(68, 45, 1, 'products/45/37BQEV8WZirTGlRh68GqHeYR86KgKDDsOGlXoFCe.jpg', 'Tủ quần áo mini 2 cánh', 0, 0, '2026-05-31 09:54:57', '2026-05-31 09:55:01', '2026-05-31 09:55:01'),
(69, 45, 1, 'products/45/ywdO7FXW2RdHJ8HKDtOOtZ5E6RbsG5eI4AFnjsKf.jpg', 'Tủ quần áo mini 2 cánh', 1, 1, '2026-05-31 09:54:57', '2026-05-31 09:55:12', '2026-05-31 09:55:12'),
(70, 45, 1, 'products/45/MmwtAbGISX1XWMEbqOfJOumnegt6Tz1aLr6O0q1m.jpg', 'Tủ quần áo mini 2 cánh', 1, 0, '2026-05-31 09:55:20', '2026-05-31 09:55:20', NULL),
(71, 46, 1, 'products/46/QFWBURiCVYmP68HlCroiBFA1HUU4cILNhZETG3Fr.jpg', 'Bàn trang điểm có gương LED', 1, 0, '2026-05-31 09:56:14', '2026-05-31 09:56:14', NULL),
(72, 47, 1, 'products/47/PHtf48AkvZ08iuwWGNzaL8yNCqw3TcWGj0fTCxkU.jpg', 'Bàn trang điểm gỗ sồi mini', 1, 0, '2026-05-31 09:56:36', '2026-05-31 09:56:36', NULL),
(73, 48, 1, 'products/48/Mo3zA72BfFOTdpjawSpqCTx6nf589B7jj3gag3P3.jpg', 'Bàn phấn ngăn kéo đôi', 1, 0, '2026-05-31 09:56:57', '2026-05-31 09:56:57', NULL),
(74, 49, 1, 'products/49/Oy4uvFgVfDoX5km7yVukKgHNh6X69PjGomeqIr42.webp', 'Bàn trang điểm phong cách Hàn', 1, 0, '2026-05-31 09:57:30', '2026-05-31 09:57:30', NULL),
(75, 50, 1, 'products/50/Kyme3zShqQvZAcy4rBiIirT4e2IU1VzwFZQ9SVnn.jpg', 'Bàn trang điểm kèm ghế đôn', 1, 0, '2026-05-31 09:58:01', '2026-05-31 09:58:01', NULL),
(76, 51, 1, 'products/51/Ficm64KpyFSgfXklrRzEC0q4hmphigmmaq1RlBVE.jpg', 'Tab đầu giường 2 ngăn kéo', 1, 0, '2026-05-31 09:58:33', '2026-05-31 09:58:33', NULL),
(77, 52, 1, 'products/52/xijyVrObKnGlvxyz9atQHFzpn2ZH8wwuROMJRjG0.jpg', 'Tab đầu giường gỗ sồi', 1, 0, '2026-05-31 09:58:57', '2026-05-31 09:58:57', NULL),
(78, 55, 1, 'products/55/8jwlAf8RJOJwKj5QekwRpWOqUcOXjPVlaNCd9wWR.jpg', 'Tab đầu giường tối giản', 1, 0, '2026-05-31 09:59:55', '2026-05-31 09:59:55', NULL),
(79, 53, 1, 'products/53/Dvp71XH89ZDysto8nLSj9cnc518C8npllAWzVJnt.png', 'Tab đầu giường treo tường', 1, 0, '2026-05-31 10:00:02', '2026-05-31 10:00:02', NULL),
(80, 54, 1, 'products/54/Vr0gC1Aurd7jlEKf6aZFI6T2Hi8gTylWhbTGi48F.webp', 'Tab đầu giường mặt đá', 1, 0, '2026-05-31 10:00:32', '2026-05-31 10:00:32', NULL),
(81, 60, 1, 'products/60/IHxFwoO7YWIQsm6BISZ0dNgvbf05EOKj9TJ6ldqK.jpg', 'Bàn ăn gấp gọn căn hộ', 1, 0, '2026-05-31 10:02:31', '2026-05-31 10:02:31', NULL),
(82, 59, 1, 'products/59/Iq3QHgW8kNBuojoiS2lNfIBYvVGLAxSryOkMpKmx.jpg', 'Bàn ăn 8 ghế phong cách Bắc Âu', 1, 0, '2026-05-31 10:02:45', '2026-05-31 10:02:45', NULL),
(83, 58, 1, 'products/58/pAi0M0CDxtJQsUs6CvGFWzeoWS7GwstOmiW57d0b.jpg', 'Bàn ăn tròn mở rộng', 1, 0, '2026-05-31 10:02:57', '2026-05-31 10:02:57', NULL),
(84, 57, 1, 'products/57/B10ynjbGiWT7uZSaAdb4QO2ddN2HMkNDLSSE0GlA.webp', 'Bàn ăn mặt đá 4 ghế', 1, 0, '2026-05-31 10:03:06', '2026-05-31 10:03:06', NULL),
(85, 56, 1, 'products/56/Bve4gjoxHvKSHRN09QVqAQ6hFCwFPuIlsx6ek4dl.jpg', 'Bàn ăn gỗ tự nhiên 6 ghế', 1, 0, '2026-05-31 10:03:15', '2026-05-31 10:03:15', NULL),
(86, 65, 1, 'products/65/mSCO5VfBwBHMUAHEbsxfZXg8VEWWfp9rgXcPzbsV.jpg', 'Ghế ăn quầy bar cao', 1, 0, '2026-05-31 10:04:52', '2026-05-31 10:04:52', NULL),
(87, 64, 1, 'products/64/QQQHfkvKfqsYzM0v0MQabdO3b4hfcYcckNFCMUWF.jpg', 'Ghế ăn đệm nhung', 1, 0, '2026-05-31 10:04:59', '2026-05-31 10:04:59', NULL),
(88, 63, 1, 'products/63/5bIcLLSfaM9FJmBwKIEs4lj3YCyjp9ZqSlDlXwZy.jpg', 'Ghế ăn Nordic lưng cong', 1, 0, '2026-05-31 10:05:06', '2026-05-31 10:05:06', NULL),
(89, 62, 1, 'products/62/1E0sIy4mSlqRAzVKvBhecbHhmtygeUkKwDmcEvIk.jpg', 'Ghế ăn bọc da công nghiệp', 1, 0, '2026-05-31 10:05:17', '2026-05-31 10:05:17', NULL),
(90, 61, 1, 'products/61/6GW8YrN2wad3EA56eDGFX01k0A6tlrTeM1d5TVnw.jpg', 'Ghế ăn gỗ bọc nệm', 1, 0, '2026-05-31 10:05:24', '2026-05-31 10:05:24', NULL),
(91, 70, 1, 'products/70/9ZO4pEAwOuycO4K5L8IYAynVPRowpqNZXCmsjrzy.jpg', 'Tủ bếp module treo tường', 1, 0, '2026-05-31 10:06:44', '2026-05-31 10:07:55', '2026-05-31 10:07:55'),
(92, 69, 1, 'products/69/Fj5JvS8ul4XcrYbFnQ4QwyifJrtBSxoPN6RESrt6.jpg', 'Tủ bếp gỗ sồi tự nhiên', 1, 0, '2026-05-31 10:06:52', '2026-05-31 10:06:52', NULL),
(93, 68, 1, 'products/68/WxZci6enb8im0BbXctsnrnzZOGlzWaJejnuxZwDJ.jpg', 'Tủ bếp chữ I căn hộ', 1, 0, '2026-05-31 10:06:58', '2026-05-31 10:06:58', NULL),
(94, 67, 1, 'products/67/IRQwFgopsotwvVoF0j2tDPyEOhB2AsBgrwsSU2uf.jpg', 'Tủ bếp trên dưới laminate', 1, 0, '2026-05-31 10:07:08', '2026-05-31 10:07:08', NULL),
(95, 66, 1, 'products/66/jDc82teF25SQjmgxm1wKRGd7PLcanCkjOZJK6LMP.png', 'Tủ bếp chữ L Acrylic', 1, 0, '2026-05-31 10:07:14', '2026-05-31 10:07:14', NULL),
(96, 70, 1, 'products/70/8Z0GHMep9uqbQA0h3T5ibfxMlKwWqJtWCcSied32.jpg', 'Tủ bếp module treo tường', 1, 0, '2026-05-31 10:08:01', '2026-05-31 10:08:01', NULL),
(97, 108, 1, 'products/108/9o4mOIlWNhN2StR4g1qz3HQNSYMAUKLBCcTwlANk.jpg', 'Kệ đồ chơi 6 ô', 1, 0, '2026-05-31 10:09:10', '2026-05-31 10:09:11', NULL),
(98, 109, 1, 'products/109/ZJrirVirSTEauNLMW6ojtZS1qMCfrY7Po0syS6lU.jpg', 'Giường đơn trẻ em', 1, 0, '2026-05-31 10:09:32', '2026-05-31 10:09:32', NULL),
(99, 110, 1, 'products/110/mZEY76qMTyliG8wuqPgnEcP2Uh8XRw6XPppW62Kj.jpg', 'Ghế ngồi đọc sách trẻ em', 1, 0, '2026-05-31 10:09:53', '2026-05-31 10:09:53', NULL),
(100, 111, 1, 'products/111/x0VMuHASFv1UZO1cijmlUeJUrxKpq3WIifA9axPh.jpg', 'Tủ trưng bày cánh kính', 1, 0, '2026-05-31 10:10:11', '2026-05-31 10:10:11', NULL),
(101, 112, 1, 'products/112/bHsbPYZ6JYkRAps6oaMYvitvIpLp9HaRlENpxzDw.jpg', 'Tủ rượu trưng bày có đèn', 1, 0, '2026-05-31 10:10:34', '2026-05-31 10:10:34', NULL),
(102, 113, 1, 'products/113/X4zRUlfYHNIaT4wLNVRUE8SrGViZiHhuw5hVD1A4.webp', 'Tủ showcase 4 tầng', 1, 0, '2026-05-31 10:11:04', '2026-05-31 10:11:04', NULL),
(103, 114, 1, 'products/114/nXno4Dv3rxcD8wr1Th3RGdoAmTF7HP0uZkzCCljf.jpg', 'Tủ trưng bày góc phòng', 1, 0, '2026-05-31 10:11:24', '2026-05-31 10:11:24', NULL),
(104, 115, 1, 'products/115/OpumI2VB9REDpmAz3ruTLDxaXwItIpRoeEMrYLFH.jpg', 'Tủ trưng bày mini', 1, 0, '2026-05-31 10:12:03', '2026-05-31 10:12:03', NULL),
(105, 116, 1, 'products/116/7WACWq8ev8XIWlucuIKCDZiR2BuHgGDs61It7as6.jpg', 'Bàn console chân sắt', 1, 0, '2026-05-31 10:12:20', '2026-05-31 10:12:20', NULL),
(106, 117, 1, 'products/117/oGmDSpMw7SK0593VwMnihBDPkgho9t31z0kHixzT.jpg', 'Bàn console mặt đá', 1, 0, '2026-05-31 10:12:39', '2026-05-31 10:12:39', NULL),
(107, 118, 1, 'products/118/ijnkCQCo1b6ZENqzM6ZwZ1IeQCDaTMgTidda2Q1k.jpg', 'Bàn console gỗ sồi', 1, 0, '2026-05-31 10:12:56', '2026-05-31 10:12:56', NULL),
(108, 119, 1, 'products/119/7jLiJgTwOFYU95g1fyCaltlz1lldzvPLMVAZfFNn.jpg', 'Bàn console gương decor', 1, 0, '2026-05-31 10:13:13', '2026-05-31 10:13:13', NULL),
(109, 120, 1, 'products/120/Z6vOFJyS36GPDSHzjN9IvnalnFLKENTAhlFWy05C.jpg', 'Bàn console tối giản', 1, 0, '2026-05-31 10:13:35', '2026-05-31 10:13:35', NULL),
(110, 121, 1, 'products/121/ii3V2nd38HXg39qPBw9JLsU9sWNUoqoz025bCvur.jpg', 'Tủ ngăn kéo 3 hộc', 1, 0, '2026-05-31 10:13:54', '2026-05-31 10:13:54', NULL),
(111, 137, 1, 'products/137/hvlpkuPtblGzqdc8OHROxzVFqkctJ2eqbtqBY4an.jpg', 'Đèn bàn decor ánh vàng', 1, 0, '2026-05-31 10:14:45', '2026-05-31 10:14:45', NULL),
(112, 136, 1, 'products/136/PTLIyW24KjOzir7keFPpzRZxdxwSliVbaUkO4BPc.webp', 'Đèn sàn đọc sách', 1, 0, '2026-05-31 10:15:08', '2026-05-31 10:15:08', NULL),
(113, 149, 1, 'products/149/ZGTCWMEZM9VyKb9hC5SaonGs1iBCKlq1eQAOOdrP.jpg', 'Thảm phòng ngủ chống trượt', 1, 0, '2026-05-31 10:15:31', '2026-05-31 10:15:31', NULL),
(114, 148, 1, 'products/148/RvQzZSjLeykjyErfOU19LOfVtIxzMlqThCAK2e3h.webp', 'Thảm tròn decor', 1, 0, '2026-05-31 10:15:46', '2026-05-31 10:15:46', NULL),
(115, 147, 1, 'products/147/ZCx8QypofRAleGRdLjlfAuTxloVJF59ljZckDyyV.jpg', 'Thảm dệt tay Bắc Âu', 1, 0, '2026-05-31 10:16:14', '2026-05-31 10:16:14', NULL),
(116, 146, 1, 'products/146/H7D3ql92AHXnF91M4VsMmXaxLBghbA5xAhWunGwG.jpg', 'Thảm lông ngắn phòng khách', 1, 0, '2026-05-31 10:16:32', '2026-05-31 10:16:32', NULL),
(117, 145, 1, 'products/145/o8C7CpsGEPGJ2FxQn2uBuKOz8Bo50rAqwWfXzC2H.jpg', 'Bàn ban công mini 2 ghế', 1, 0, '2026-05-31 10:16:55', '2026-05-31 10:16:55', NULL),
(118, 144, 1, 'products/144/ggZHK3om9L28d0KujjOa5DrIVrK8ENW02C0Lul3e.jpg', 'Bàn sân vườn gỗ tự nhiên', 1, 0, '2026-05-31 10:17:12', '2026-05-31 10:17:12', NULL),
(119, 142, 1, 'products/142/J8Uv1FYnBeD65yMEph7iDysxalJwJW18HIaGuHn8.jpg', 'Bàn cà phê ngoài trời tròn', 1, 0, '2026-05-31 10:17:43', '2026-05-31 10:17:43', NULL),
(120, 143, 1, 'products/143/LpzDugcJhJ9BJSrE4j8Q5xcBefo4MwBG4kms6dLp.jpg', 'Bàn ban công mặt kính', 1, 0, '2026-05-31 10:18:03', '2026-05-31 10:18:03', NULL),
(121, 138, 1, 'products/138/6HJRajEaFfLH7Jq51fu9kJqQLjpukCqvTgpMFypF.jpg', 'Đèn thả trần 3 chao', 1, 0, '2026-05-31 10:18:20', '2026-05-31 10:18:20', NULL),
(122, 139, 1, 'products/139/brpw9zQbeeY78PDuPz7oHChJzmqhndB3BhVckwTT.jpg', 'Đèn ngủ cảm ứng', 1, 0, '2026-05-31 10:18:39', '2026-05-31 10:18:39', NULL),
(123, 141, 1, 'products/141/gILSDjYuh6Mil6bz8iqQG9J75JQGVQLgUb2gKMzF.jpg', 'Bàn ban công gấp gọn', 1, 0, '2026-05-31 10:18:58', '2026-05-31 10:18:58', NULL),
(124, 140, 1, 'products/140/FD71nIxPWPxlR3FBR3Z8TyRSBZkMa9s9ipkk4b2B.jpg', 'Đèn tường trang trí', 1, 0, '2026-05-31 10:19:15', '2026-05-31 10:19:15', NULL),
(125, 92, 1, 'products/92/lIs911wiFM679bTHge6RlmFFnzM73lbA8orNsP0Z.jpg', 'Kệ sách chữ A', 1, 0, '2026-05-31 10:19:34', '2026-05-31 10:19:34', NULL),
(126, 97, 1, 'products/97/qPlHp8OYucv11dO6DOflX9REKvaw4yuByITg4cuV.jpg', 'Bàn học đôi cho bé', 1, 0, '2026-05-31 10:20:36', '2026-05-31 10:20:36', NULL),
(127, 96, 1, 'products/96/uy164uEeDSy0fGeguRJgrCQHar7IOk3dFHJQ9qSH.jpg', 'Bàn học sinh có kệ sách', 1, 0, '2026-05-31 10:20:59', '2026-05-31 10:20:59', NULL),
(128, 95, 1, 'products/95/5AJ4XBDgsM54nAOhPJMfWJNEsXSbtoNNYTID74kr.jpg', 'Kệ sách có cửa kính', 1, 0, '2026-05-31 12:38:30', '2026-05-31 12:38:30', NULL),
(129, 94, 1, 'products/94/WkoYxmuc2bXrKCFEHSZiWP4mVklP2hrQhZkLZyh6.jpg', 'Kệ sách module 6 ô', 1, 0, '2026-05-31 12:38:51', '2026-05-31 12:38:51', NULL),
(130, 93, 1, 'products/93/rYiNU5eFnJb4CoWJLYWkB2LFN9DSdDb5Ady2MoTK.jpg', 'Kệ sách treo tường', 1, 0, '2026-05-31 12:39:14', '2026-05-31 12:39:14', NULL),
(131, 91, 1, 'products/91/8VcWu4p9PlqhzyP8ZS46fJOwT0Bczhg0mycSYVFi.jpg', 'Kệ sách 5 tầng', 1, 0, '2026-05-31 12:39:41', '2026-05-31 12:39:41', NULL),
(132, 90, 1, 'products/90/4QbSvtlRfWT5D9xP3YxU8Pajr5cFiKb7CGBVbcP2.jpg', 'Tủ hồ sơ di động', 1, 0, '2026-05-31 12:40:04', '2026-05-31 12:40:04', NULL),
(133, 89, 1, 'products/89/juPNkm8rO7da8xg2yZETbzkryCQM8kYzmZegVqcH.jpg', 'Tủ locker văn phòng 6 ngăn', 1, 0, '2026-05-31 12:40:22', '2026-05-31 12:40:22', NULL),
(134, 88, 1, 'products/88/9lDA0ZU9eOpcCzUuN6AAPHKa9QHJigIZOmdDljGz.jpg', 'Tủ tài liệu thấp 2 cánh', 1, 0, '2026-05-31 12:40:40', '2026-05-31 12:40:40', NULL),
(135, 78, 1, 'products/78/5qvx7caPrOts2hSZ0EO9HeeS5r9TRlYzE7j6Csct.png', 'Bàn làm việc có hộc tủ', 1, 0, '2026-05-31 12:41:10', '2026-05-31 12:41:10', NULL),
(136, 80, 1, 'products/80/sl7NkJuPFRVc4zALjAHmxXbppLPWmy89selUm74g.webp', 'Bàn làm việc kèm kệ sách', 1, 0, '2026-05-31 12:41:42', '2026-05-31 12:41:42', NULL),
(137, 76, 1, 'products/76/qxn0zKCEAQL67wtTJu7CajWl4OoNKawySGpHINkm.jpg', 'Bàn làm việc chữ L', 1, 0, '2026-05-31 12:42:04', '2026-05-31 12:42:04', NULL),
(138, 81, 1, 'products/81/jgwf9nPS2ZgSb6rfpnYk5JadUXrTZgDtPIMhoOah.jpg', 'Ghế công thái học Ergonomic', 1, 0, '2026-05-31 12:42:24', '2026-05-31 12:42:24', NULL),
(139, 79, 1, 'products/79/3mgihVqGZNrMXZpLl1icHsWevYMDFznrTM79OkNC.webp', 'Bàn standing desk điện', 1, 0, '2026-05-31 12:42:46', '2026-05-31 12:42:46', NULL),
(140, 98, 1, 'products/98/H5FsHmn0n2ZUmmGnBzXE6J7bracVnrZ0A2qUOZka.webp', 'Bàn học thông minh nâng hạ', 1, 0, '2026-05-31 12:43:06', '2026-05-31 12:43:06', NULL),
(141, 71, 1, 'products/71/9NSJ9I4o44V3a9WzIWxYIFU1nbcAETCGWefzCL1Y.jpg', 'Kệ gia vị treo tường', 1, 0, '2026-05-31 12:43:43', '2026-05-31 12:43:44', NULL),
(142, 77, 1, 'products/77/pVopv32c6jxEgArl83BSkPiMXDOcYIsiq8CYqmlM.jpg', 'Bàn làm việc tối giản 120cm', 1, 0, '2026-05-31 12:44:18', '2026-05-31 12:44:18', NULL),
(143, 75, 1, 'products/75/inIzF6lqIcws3NPpvx3BnRZPTn9qRUoozrvUFQDz.jpg', 'Mâm xoay góc tủ bếp', 1, 0, '2026-05-31 12:44:36', '2026-05-31 12:44:36', NULL),
(144, 74, 1, 'products/74/p77HgTpRNBm1EWtcSVg6pzQJRn3keffHP8DpEc2J.jpg', 'Kệ úp chén 2 tầng', 1, 0, '2026-05-31 12:44:54', '2026-05-31 12:44:54', NULL),
(145, 72, 1, 'products/72/P5dn52o7ad3rQY4ErjpwLoAcpqTEw6GRVxCZItmL.png', 'Giá bát nâng hạ', 1, 0, '2026-05-31 12:45:58', '2026-05-31 12:45:58', NULL),
(146, 73, 1, 'products/73/yp3LVlbeyW97s2lN6kRGi5SGMQmMY2KqLA7ZdIlg.jpg', 'Khay chia ngăn kéo bếp', 1, 0, '2026-05-31 12:46:15', '2026-05-31 12:46:15', NULL),
(147, 84, 1, 'products/84/crz1yp1HI2bnLBgnPm8HOWYboKrMYh9rMihW8VJU.jpg', 'Ghế gaming làm việc', 1, 0, '2026-05-31 12:46:35', '2026-05-31 12:46:35', NULL),
(148, 86, 1, 'products/86/YqfavX0DjAwmQ4ryKsZUFwQ9riTGpkCMOwf9NYh2.jpg', 'Tủ hồ sơ 3 ngăn có khóa', 1, 0, '2026-05-31 12:47:04', '2026-05-31 12:47:04', NULL),
(149, 87, 1, 'products/87/ZV0aAcTcyigBqxZrlsU25464L38AhJANtflWwm4c.jpg', 'Tủ hồ sơ cánh kính', 1, 0, '2026-05-31 12:47:28', '2026-05-31 12:47:28', NULL),
(150, 85, 1, 'products/85/wIWw15OIr66FyLflXyM6JWB1YBoi4csbdkbkLfCH.jpg', 'Ghế quỳ văn phòng', 1, 0, '2026-05-31 12:47:48', '2026-05-31 12:47:48', NULL),
(151, 83, 1, 'products/83/Raxyf06GslT5BFHWl1CvZjbkSXg5gRPVyOlw60Ph.jpg', 'Ghế lưới văn phòng', 1, 0, '2026-05-31 12:47:58', '2026-05-31 12:47:58', NULL),
(152, 82, 1, 'products/82/NvoZpfxtArUpwvKWxQDYB1aXSNIexWvf6esc3vBX.jpg', 'Ghế xoay lưng cao', 1, 0, '2026-05-31 12:48:07', '2026-05-31 12:48:07', NULL),
(153, 100, 1, 'products/100/4qiD9JxyhwCHcLCpeEjaORhluxtn5DgsUQYDgZGQ.png', 'Bàn học có hộc kéo', 1, 0, '2026-05-31 12:48:30', '2026-05-31 12:48:30', NULL),
(154, 99, 1, 'products/99/qbkaV5l1ArCY7qRRhULsuksyM7CdeaZWFthP6Hfi.jpg', 'Bàn học góc nhỏ', 1, 0, '2026-05-31 12:48:42', '2026-05-31 12:48:42', NULL),
(155, 101, 1, 'products/101/rXiNgEUUigp2yHH7Da2NT5Z4JsMQ8vZTiFArUQsv.webp', 'Giường tầng trẻ em có cầu trượt', 1, 0, '2026-05-31 12:49:02', '2026-05-31 12:49:02', NULL),
(156, 102, 1, 'products/102/ulNteyc4SJdbjIZomGCNNs9nfMl45VhRTwnEKgPr.jpg', 'Giường tầng gỗ tự nhiên', 1, 0, '2026-05-31 12:49:24', '2026-05-31 12:49:24', NULL),
(157, 107, 1, 'products/107/D1kod6Q4s0t3EIfOBSZvkduW7LHy195jOgDJ9Phw.jpg', 'Bàn học trẻ em kèm ghế', 1, 0, '2026-05-31 12:50:01', '2026-05-31 12:50:01', NULL),
(158, 106, 1, 'products/106/iFflUTRsrJDbY4jOrkwj0Vb4RgDQwiGkf7HwiV6x.jpg', 'Tủ quần áo trẻ em 2 cánh', 1, 0, '2026-05-31 12:50:18', '2026-05-31 12:50:18', NULL),
(159, 105, 1, 'products/105/6QgdPzM8PB6ptK1bWHrVMPFRdbDNhfPRSsev2JMI.jpg', 'Giường tầng 3 ngăn kéo', 1, 0, '2026-05-31 12:50:40', '2026-05-31 12:50:40', NULL),
(160, 104, 1, 'products/104/wP1u6dacX22CNU6oudlEoYKEHtXvwXFAQsevbz6y.jpg', 'Giường tầng tối giản cho bé', 1, 0, '2026-05-31 12:51:21', '2026-05-31 12:51:21', NULL),
(161, 103, 1, 'products/103/htIDD4EQnOW6jn4SMoa75oH5gnYtZ8L5X6rab219.jpg', 'Giường tầng có bàn học', 1, 0, '2026-05-31 12:51:41', '2026-05-31 12:51:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `description`, `is_system`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Guest', 'guest', 'Default public visitor role.', 1, 0, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(2, 'Customer', 'customer', 'Registered customer role.', 1, 10, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(3, 'Staff', 'staff', 'Internal staff role with dynamic permissions.', 1, 20, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(4, 'Admin', 'admin', 'System administrator role.', 1, 30, '2026-05-18 07:50:46', '2026-05-18 07:50:46', NULL),
(5, 'nv', 'nv', 'sfjak', 0, 0, '2026-05-30 10:34:50', '2026-05-30 10:35:26', '2026-05-30 10:35:26'),
(6, 'nv', 'nv000', 'sfjak', 0, 0, '2026-05-30 10:34:56', '2026-05-30 10:35:33', '2026-05-30 10:35:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(2, 3, 2, '2026-05-18 07:50:47', '2026-05-18 07:50:47'),
(3, 2, 3, '2026-05-18 07:50:48', '2026-05-18 07:50:48'),
(4, 2, 4, '2026-05-18 08:47:34', '2026-05-18 08:47:34'),
(5, 2, 5, '2026-05-18 08:49:57', '2026-05-18 08:49:57'),
(6, 2, 6, '2026-05-31 08:26:02', '2026-05-31 08:26:02'),
(7, 2, 7, '2026-05-31 08:26:02', '2026-05-31 08:26:02'),
(8, 2, 8, '2026-05-31 08:26:02', '2026-05-31 08:26:02'),
(9, 2, 9, '2026-05-31 08:26:02', '2026-05-31 08:26:02'),
(10, 2, 10, '2026-05-31 08:26:03', '2026-05-31 08:26:03'),
(11, 2, 11, '2026-05-31 08:26:03', '2026-05-31 08:26:03'),
(12, 2, 12, '2026-05-31 08:26:03', '2026-05-31 08:26:03'),
(13, 2, 13, '2026-05-31 08:26:03', '2026-05-31 08:26:03'),
(14, 2, 14, '2026-05-31 08:26:04', '2026-05-31 08:26:04'),
(15, 2, 15, '2026-05-31 08:26:04', '2026-05-31 08:26:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oB3z7kMPyMsOZSXFLApVroKGIY2SuaceBbNyRPvc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTZiODFpajJVZlEzMXZMdkZQU01IZFhiRGx5QURUQW1JM2FIRHV0YyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1780236131),
('WNb8s8t1XnKqbaUTyRcsvPEa2WBLkGcsUBnynUzj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.122.1 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnVGMDlBQWhxeXVMa2UxeFFtWHRWNjY5ODk3aGhOYjlpQ1ZUdnNCdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780231025);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred_contact_method` enum('email','phone','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','locked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `lock_reason` text COLLATE utf8mb4_unicode_ci,
  `locked_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `birthday`, `gender`, `address_line_1`, `address_line_2`, `ward`, `district`, `province`, `postal_code`, `preferred_contact_method`, `notes`, `email_verified_at`, `password`, `status`, `lock_reason`, `locked_at`, `last_login_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'System Admin', 'admin@thongmai.local', '0900000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'both', NULL, '2026-05-31 08:43:30', '$2y$12$/ql.l.zTOx0eK.0zABbG4uQFFWsCY6oVRXZmPNyoFHdLeZC0nGfY.', 'active', NULL, NULL, '2026-05-31 12:37:18', NULL, '2026-05-18 07:50:47', '2026-05-31 12:37:18', NULL),
(2, 'System Staff', 'staff@thongmai.local', '0900000002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'both', NULL, '2026-05-31 08:43:30', '$2y$12$ODTbwICq.JNtI.aRCYpImetLIwBWtznv5Y1QbO74SGadw40jTO.52', 'active', NULL, NULL, NULL, NULL, '2026-05-18 07:50:47', '2026-05-31 08:43:30', NULL),
(3, 'Demo Customer', 'customer@thongmai.local', '0900000003', '1995-01-01', 'other', '115 Nguyen Xien', NULL, 'Bac Nha Trang', 'Nha Trang', 'Khanh Hoa', NULL, 'both', 'Seeded customer account.', '2026-05-31 08:43:30', '$2y$12$wbnLnAR9uThA14CyEjMpP.Q70thOQATJYP7EPZo1kan0uToAPrJCS', 'active', NULL, NULL, '2026-05-19 14:10:06', NULL, '2026-05-18 07:50:48', '2026-05-31 08:43:30', NULL),
(4, 'Test fun register', 'register@register.cloud', '0301548852', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'both', NULL, NULL, '$2y$12$I/HzcU7n4p8CG0xG7A40sOEHRsDQyTzkgssovfQhM3.CexotlCwqq', 'active', NULL, NULL, NULL, NULL, '2026-05-18 08:47:34', '2026-05-18 08:47:34', NULL),
(5, 'hunghuy0925@gmail.com', 'hunghuy0925@gmail.com', '0000111100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'both', NULL, NULL, '$2y$12$3wbZYTrQMS1WsHBmDTvxJ.luH7LF4Bk7xWAaFBSkHc5U4uvtXzOj2', 'active', NULL, NULL, '2026-05-25 09:52:23', 'vkOWnMZ8zko9YGC4GnWcdKh9YiOfRsoYh3fLTr5kdMxx2iAfeDiIW0QkmBBE', '2026-05-18 08:49:57', '2026-05-25 09:52:23', NULL),
(6, 'Nguyen Minh Anh', 'minh.anh@thongmai.local', '0901000001', '1992-04-12', 'female', '12 Nguyen Hue', 'Can ho 1208', 'Ben Nghe', 'Quan 1', 'Ho Chi Minh City', '700000', 'both', 'Uu tien giao hang buoi chieu.', '2026-05-31 08:43:31', '$2y$12$aR18HKbZZxOzTIcqRaGAhOmOkj7OLGPxEMjKfVhlBMol67dhxkTiy', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:02', '2026-05-31 08:43:31', NULL),
(7, 'Tran Hoang Nam', 'hoang.nam@thongmai.local', '0901000002', '1988-09-23', 'male', '45 Hoang Quoc Viet', NULL, 'Co Nhue 1', 'Bac Tu Liem', 'Ha Noi', '100000', 'phone', 'Thuong dat noi that cho can ho cho thuê.', '2026-05-31 08:43:31', '$2y$12$SGRtvmbqzggUbnhLTbJmjeX9zcnGg5ByPJ/oCu9pXDuFvsxu2fmVq', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:02', '2026-05-31 08:43:31', NULL),
(8, 'Le Thuy Linh', 'thuy.linh@thongmai.local', '0901000003', '1996-06-08', 'female', '78 Le Loi', NULL, 'Hai Chau 1', 'Hai Chau', 'Da Nang', '550000', 'email', 'Thich mau trung tinh, de phoi voi phong ngu nho.', '2026-05-31 08:43:31', '$2y$12$zzN8weo1O2NCzvklSAylLO2CFcu7arjh5yYL7ADNVHFyOHNAA846u', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:02', '2026-05-31 08:43:31', NULL),
(9, 'Pham Quang Huy', 'quang.huy@thongmai.local', '0901000004', '1990-11-17', 'male', '103 Tran Phu', 'Tang 5', 'Loc Tho', 'Nha Trang', 'Khanh Hoa', '650000', 'both', 'Can tu van sofa va ban tra cho can ho bien.', '2026-05-31 08:43:31', '$2y$12$4vl1MSYcFMQVQOvk9R0jiO6j3QQ7.RhvzYXQzsp5tGPflXyszY8Ju', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:02', '2026-05-31 08:43:31', NULL),
(10, 'Do Mai Phuong', 'mai.phuong@thongmai.local', '0901000005', '1993-02-27', 'female', '220 Nguyen Trai', 'Phong 3', 'An Phu', 'Ninh Kieu', 'Can Tho', '900000', 'phone', 'Mua sam cho nha pho moi hoan thien.', '2026-05-31 08:43:31', '$2y$12$wsYyBbBoyEGMdkuAbLgNNeGSSfFwDeg1.Y18zGf.Dp50MX5kb7.qy', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:03', '2026-05-31 08:43:31', NULL),
(11, 'Vo Tuan Kiet', 'tuan.kiet@thongmai.local', '0901000006', '1987-08-03', 'male', '9 Phan Dang Luu', NULL, 'Phu Nhuan', 'Phu Nhuan', 'Ho Chi Minh City', '700000', 'both', 'Quan tam den san pham cho van phong tai nha.', '2026-05-31 08:43:32', '$2y$12$dnCtriikSjwxLX0eCgQx9e0xuDv2UFM2DY2IGRQ7Yfp1/Dt/5i.N2', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:03', '2026-05-31 08:43:32', NULL),
(12, 'Bui Ngoc Han', 'ngoc.han@thongmai.local', '0901000007', '1998-12-14', 'female', '56 Nguyen Van Cu', NULL, 'An Hoa', 'Ninh Kieu', 'Can Tho', '900000', 'email', 'Thich noi that tre trung, sang mau.', '2026-05-31 08:43:32', '$2y$12$/Zx68yra0o5g1qogMAiMuuEzRW9qvo2pdpSbrxsPaGJ.obt4bEzLK', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:03', '2026-05-31 08:43:32', NULL),
(13, 'Nguyen Duc Minh', 'duc.minh@thongmai.local', '0901000008', '1985-05-19', 'male', '31 Le Thanh Ton', 'Can ho 1501', 'Ben Thanh', 'Quan 1', 'Ho Chi Minh City', '700000', 'both', 'Can bo tri noi that phong khach va phong lam viec.', '2026-05-31 08:43:32', '$2y$12$jxceUTEBlQLDJH5OQQzVOuJndXTkY5vgoykXp7CbwibQ3O04bdQAO', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:03', '2026-05-31 08:43:32', NULL),
(14, 'Tran Khanh Van', 'khanh.van@thongmai.local', '0901000009', '1994-07-21', 'female', '84 Nguyen Chi Thanh', NULL, 'Lang Thuong', 'Dong Da', 'Ha Noi', '100000', 'phone', 'Co nhu cau mua giuong va tu quan ao cho gia dinh tre.', '2026-05-31 08:43:32', '$2y$12$cXaQIL7hMxF9CKnZEYkhOO1VSGNIXOwa338GPjkzlmTUuLp924GBm', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:04', '2026-05-31 08:43:32', NULL),
(15, 'Le Anh Khoa', 'anh.khoa@thongmai.local', '0901000010', '1991-03-30', 'male', '19 Vo Van Tan', NULL, 'Vo Thi Sau', 'Quan 3', 'Ho Chi Minh City', '700000', 'both', 'Thuong xem mau thuc te truoc khi dat hang.', '2026-05-31 08:43:33', '$2y$12$3.4nButwjWfe0rplexBL/OCVkxa/X43MbX2sSDgC86G3sEJw2m/mu', 'active', NULL, NULL, NULL, NULL, '2026-05-31 08:26:04', '2026-05-31 08:43:33', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_unique` (`user_id`),
  ADD KEY `carts_user_id_status_index` (`user_id`,`status`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_cart_id_product_id_index` (`cart_id`,`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_status_index` (`parent_id`,`status`);

--
-- Chỉ mục cho bảng `design_requests`
--
ALTER TABLE `design_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `design_requests_request_code_unique` (`request_code`),
  ADD KEY `design_requests_assigned_staff_id_foreign` (`assigned_staff_id`),
  ADD KEY `design_requests_user_id_status_space_type_index` (`user_id`,`status`,`space_type`),
  ADD KEY `design_requests_customer_phone_customer_name_index` (`customer_phone`,`customer_name`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_status_placed_at_index` (`user_id`,`status`,`placed_at`),
  ADD KEY `orders_customer_phone_customer_name_index` (`customer_phone`,`customer_name`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_product_id_index` (`order_id`,`product_id`);

--
-- Chỉ mục cho bảng `order_status_logs`
--
ALTER TABLE `order_status_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_logs_changed_by_foreign` (`changed_by`),
  ADD KEY `order_status_logs_order_id_to_status_index` (`order_id`,`to_status`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_code_unique` (`code`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_role_permission_id_role_id_unique` (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_status_index` (`category_id`,`status`),
  ADD KEY `products_price_stock_quantity_index` (`price`,`stock_quantity`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `product_images_product_id_is_primary_sort_order_index` (`product_id`,`is_primary`,`sort_order`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_code_unique` (`code`);

--
-- Chỉ mục cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_role_id_user_id_unique` (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_role_id_index` (`user_id`,`role_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `design_requests`
--
ALTER TABLE `design_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order_status_logs`
--
ALTER TABLE `order_status_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `design_requests`
--
ALTER TABLE `design_requests`
  ADD CONSTRAINT `design_requests_assigned_staff_id_foreign` FOREIGN KEY (`assigned_staff_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `design_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ràng buộc cho bảng `order_status_logs`
--
ALTER TABLE `order_status_logs`
  ADD CONSTRAINT `order_status_logs_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `order_status_logs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_images_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
