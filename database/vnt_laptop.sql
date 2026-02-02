-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 02, 2026 lúc 10:08 AM
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
-- Cơ sở dữ liệu: `vnt_laptop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('blog','laptop') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Laptop Văn phòng', 'laptop', '2026-02-02 01:43:20', '2026-02-02 01:43:20'),
(2, 'Laptop Gaming', 'laptop', '2026-02-02 01:54:54', '2026-02-02 01:54:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptops`
--

CREATE TABLE `laptops` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `cpu` varchar(100) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `gpu` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `laptops`
--

INSERT INTO `laptops` (`id`, `name`, `price`, `cpu`, `ram`, `storage`, `gpu`, `brand`, `description`, `image`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'MacBook Air M4 2025', 39490000.00, 'CPU 10 lõi với 4 lõi hiệu năng và 6 lõi tiết kiệm điện', '24GB', '1TB', 'GPU 10 lõi Neural Engine 16 lõi Công nghệ dò tia tốc độ cao bằng phần cứng Băng thông bộ nhớ 120GB/s', 'Apple', 'Macbook Air 13 M4 10CPU 10GPU 24GB 1TB 2025 được ưu ái sở hữu chip xử lý Apple M4 với hiệu năng mạnh mẽ, cho phép người dùng xử lý nhanh mọi tác vụ. RAM 24GB giúp máy đa nhiệm hiệu quả, không lo giật lag khi làm việc liên tục. Đồng thời, sản phẩm Macbook M4 còn sở hữu màn hình Liquid Retina 13,6 inch hiển thị sắc nét, hỗ trợ 1 tỷ màu cho trải nghiệm ấn tượng.', 'laptops/0D2gxhQFNM9E4E4uJBG3mBQdqeV3ZfHIMhJoMNQ3.webp', 1, 1, '2026-02-02 01:45:37', '2026-02-02 01:45:54'),
(2, 'MacBook Pro 16 M4 Max', 98990000.00, 'Apple M4 Max 16 lõi với 12 lõi hiệu năng và 4 lõi tiết kiệm điện', '48GB', '1TB', '40 lõi Neural Engine 16 lõi', 'Apple', 'Macbook Pro 16 inch M4 Max 48GB 1TB được ưu ái trang bị CPU Apple M4 Max 16 lõi, hỗ trợ người dùng xử lý mượt mà mọi tác vụ nặng, từ đồ họa đến lập trình. Với RAM 48GB và ổ cứng SSD 1TB, thế hệ Macbook Pro M4 cao cấp này cho phép đa nhiệm nhanh chóng và lưu trữ dữ liệu thoải mái. Cùng với đó là màn hình Liquid Retina XDR 16 inch đạt độ sáng tối đa 1.600 nit, giúp hiển thị sắc nét và sống động, lý tưởng cho công việc sáng tạo chuyên nghiệp.', 'laptops/NOJo6wwZeJpaZ2XzOv4C2pgJ2rLOifDA8TeRqNOP.webp', 1, 1, '2026-02-02 01:52:05', '2026-02-02 01:52:05'),
(3, 'Laptop ASUS TUF Gaming', 44990000.00, 'AMD Ryzen AI 9 HX 370 2.0GHz', '32GB', '1TB PCIe 4.0 NVMe M.2 SSD', 'AMD Ryzen AI 9 HX 370 2.0GHz', 'ASUS', 'Asus TUF Gaming A14 sở hữu GPU NVIDIA GeForce RTX 4060 8GB GDDR6, mang đến trải nghiệm hình ảnh sắc nét và mượt mà cho người dùng. Đi kèm với thế hệ card đồ hoạ cao cấp này là bộ xử lý AMD Ryzen AI 9 HX 370 2.0GHz với 12 nhân và 24 luồng giúp thực hiện các tác vụ nặng một cách nhanh chóng và hiệu quả. Ngoài ra, máy còn được ưu ái trang bị màn hình 14 inch độ phân giải 2.5K với tần số quét 165Hz cung cấp hình ảnh chất lượng cao và giảm thiểu hiện tượng giật lag khi chơi game.', 'laptops/zXeeYxrHyHVgpNcB4vwVH4Z58i9kVrncIt8uv7mo.webp', 1, 2, '2026-02-02 01:57:05', '2026-02-02 01:57:05'),
(4, 'Laptop Lenovo ThinkPad X1 Carbon Gen 13 Aura Edition', 57990000.00, 'Intel Core Ultra 7 255H, 16 lõi (6P + 8E + 2LPE) / 16 luồng, Max Turbo up to 5.1GHz, 24MB', '32GB', '1TB SSD M.2 2280 PCIe 4.0x4 NVMe Opal 2.0', 'Intel Arc 140T GPU', 'Lenovo', 'Laptop Lenovo ThinkPad X1 Carbon Gen 13 Aura Edition 21NX003BVN được trang bị vi xử lý Intel Core Ultra 7 255H đi kèm NPU Intel AI Boost tích hợp. Máy sử dụng GPU Intel Arc 140T, kết hợp RAM 32GB và ổ cứng SSD 1TB. Màn hình OLED cảm ứng 14 inch, độ phân giải 2.8K; hỗ trợ HDR True Black 500, Dolby Vision và tần số quét 120Hz.', 'laptops/DGvIeg57qPmqXutWEHJ9U7zKL8j4EUBylFF6YKjO.webp', 1, 1, '2026-02-02 01:59:40', '2026-02-02 02:07:54'),
(5, 'Laptop Lenovo ThinkPad X9-14 Gen 1 Aura Edition', 52490000.00, 'Intel Core Ultra 7 258V, 8 lõi (4P + 4LPE) / 8 luồng, Max Turbo up to 4.8GHz, 12MB', '32GB', '1TB SSD M.2 2242 PCIe 4.0x4 NVMe Opal 2.0', 'Intel Arc Graphics 140V', 'Lenovo', NULL, 'laptops/DFCgfiKS2P8u09x9Gt5BiWJzfKB66yjq55tFb3vE.webp', 1, 2, '2026-02-02 02:01:56', '2026-02-02 02:01:56'),
(6, 'Laptop ASUS Zenbook S 14 OLED', 39490000.00, 'Intel Core Ultra 7-258V 32GB 1.8 GHz (12MB Cache, up to 4.8 GHz, 8 lõi, 8 luồng)', '32GB', '1TB M.2 NVMe PCIe 4.0 SSD', 'Intel Arc Graphics', 'ASUS', 'Laptop ASUS Zenbook S 14 OLED UX5406SA PV140WS là một chiếc laptop cao cấp nổi bật với màn hình 14 inch và bộ vi xử lý Core™ Ultra 7 ấn tượng. Zenbook S14 được thiết kế gọn gàng, dễ dàng mang theo. Màn hình 14 inch OLED có độ phân giải 3K mang đến màu sắc sống động và độ tương phản cao, lý tưởng cho việc xem phim và chỉnh sửa hình ảnh. Máy còn đi kèm với RAM 32GB LPDDR5X và bộ nhớ SSD lớn, cho khả năng lưu trữ và truy cập nhanh.', 'laptops/dzbiSJHeII7JgoSUOpxB3URimzOfLrnsLEXG99Rg.webp', 1, 1, '2026-02-02 02:04:02', '2026-02-02 02:04:02'),
(7, 'Laptop ASUS Zenbook S 16', 39990000.00, 'AMD Ryzen AI 7 350 2.0GHz (24MB Cache, up to 5.0GHz, 8 lõi, 16 luồng)', '24GB', '1TB M.2 NVMe PCIe 4.0 SSD', 'AMD Radeon Graphics', 'ASUS', 'Laptop Asus Zenbook S 16 UM5606KA-RK127WS Ryzen AI 7 trang bị bộ vi xử lý AMD Ryzen™ AI 7 350 mang lại hiệu năng vượt trội trong thời gian dài sử dụng. Laptop còn sở hữu dung lượng RAM LPDDR5X lên đến 24GB giúp tăng tốc độ truyền tải dữ liệu cho máy. Máy cũng tương đối nhẹ nhờ trọng lượng chỉ 1.50 kg nhờ đó mang đến sự linh hoạt tối ưu và dễ dàng mang theo khi di chuyển.', 'laptops/Taygvm3FKgBzHvijFpwsQ5JXhkeeMGlwRnjftJzB.webp', 1, 1, '2026-02-02 02:05:23', '2026-02-02 02:05:23'),
(8, 'Laptop ASUS Vivobook S 14 OLED', 28990000.00, 'AMD Ryzen AI 9 HX 370 2.0GHz (36MB Cache, up to 5.1GHz, 12 lõi, 24 luồng)', '32GB', '1TB M.2 NVMe PCIe 4.0 SSD', 'AMD Radeon 890M Graphics', 'ASUS', 'Laptop Asus Vivobook S 14 OLED M5406WA-PP071WS sở hữu màn hình OLED 14 inch, độ phân giải lên đến 3K (2880 x 1800), mang lại hình ảnh với độ sắc nét cao. Nhờ được tích hợp kèm với vi xử lý AMD Ryzen AI 9 HX 370 với tốc độ lên đến 5.1GHz, Asus Vivobook S 14 có thể xử lý các tác vụ nặng một cách dễ dàng, đặc biệt là trong các ứng dụng yêu cầu hiệu suất cao. Hơn nữa, máy còn sở hữu khả năng lưu trữ nhanh với SSD M.2 PCIe 4.0 1TB, giúp khởi động và truy xuất dữ liệu nhanh chóng, hỗ trợ tối ưu hóa hiệu suất làm việc.', 'laptops/Ty21EMGxzzXFQichcJpJZMaq9pncuwHVvubcq47P.webp', 1, 1, '2026-02-02 02:07:08', '2026-02-02 02:07:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_laptop`
--

CREATE TABLE `post_laptop` (
  `post_id` int(11) NOT NULL,
  `laptop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Nhật Thành', 'npnthanh.03@gmail.com', '$2y$12$kZBCh5tmW0CuZW7VNjP6E.qOZ2sZ7OAzbY8gnJa/z9/ZHRkEeVb46', 'admin', '2026-02-02 08:17:18', '2026-02-02 01:37:23');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `laptops`
--
ALTER TABLE `laptops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laptop_category` (`category_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_post_category` (`category_id`),
  ADD KEY `fk_post_user` (`user_id`);

--
-- Chỉ mục cho bảng `post_laptop`
--
ALTER TABLE `post_laptop`
  ADD PRIMARY KEY (`post_id`,`laptop_id`),
  ADD KEY `fk_pl_laptop` (`laptop_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `laptops`
--
ALTER TABLE `laptops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `laptops`
--
ALTER TABLE `laptops`
  ADD CONSTRAINT `fk_laptop_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `post_laptop`
--
ALTER TABLE `post_laptop`
  ADD CONSTRAINT `fk_pl_laptop` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pl_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
