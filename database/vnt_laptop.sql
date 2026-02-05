-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 05, 2026 lúc 01:25 PM
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
(2, 'Laptop Gaming', 'laptop', '2026-02-02 01:54:54', '2026-02-02 01:54:58'),
(3, 'Review', 'blog', '2026-02-05 05:04:30', '2026-02-05 05:04:30');

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

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `thumbnail`, `views`, `status`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Đánh giá Apple MacBook Pro 16 inch 2024: Có đáng đầu tư với mức giá gần 90 triệu đồng?', 'danh-gia-apple-macbook-pro-16-inch-2024-co-dang-dau-tu-voi-muc-gia-gan-90-trieu-dong', 'Apple lại một lần nữa dẫn đầu trong phân khúc máy tính xách tay cao cấp với chiếc MacBook Pro 16 inch M4 Pro với hàng loạt các công nghệ đi kèm.\r\n\r\nPhiên bản trang bị chip M4 Pro này chứng minh khả năng cạnh tranh mạnh mẽ với các dòng vi xử lý hàng đầu từ AMD, Intel và NVIDIA, đặc biệt trong các tác vụ sáng tạo nội dung. Bên cạnh tốc độ vượt trội, Apple còn mang đến tùy chọn màn hình kết cấu nano giúp giảm độ chói và phản chiếu, dù đây là một tính năng có phí.\r\nNgoài ra, công nghệ webcam Center Stage cũng được tích hợp, mang lại trải nghiệm tiện lợi dù không nổi bật bằng màn hình nano. Với thời lượng pin ấn tượng kéo dài cả ngày, MacBook Pro 16 inch trang bị M4 Pro tiếp tục xứng đáng với danh hiệu \"Lựa chọn của biên tập viên\" trong phân khúc máy trạm di động cao cấp.\r\nApple đã tiếp tục giữ nguyên thiết kế quen thuộc cho dòng MacBook Pro, với chỉ một vài thay đổi nhỏ như bổ sung tùy chọn màn hình kết cấu nano và nâng cấp kết nối lên Thunderbolt 5.\r\nMacBook Pro 2024 16 inch vẫn duy trì kích thước và trọng lượng giống với phiên bản năm trước. Các cổng kết nối không có thay đổi về số lượng, bao gồm ba cổng Thunderbolt 5, một cổng HDMI, khe cắm thẻ SD và giắc cắm âm thanh 3.5mm. Một lần nữa, bàn phím và trackpad của Apple tiếp tục gây ấn tượng, từ cảm giác sử dụng mượt mà của trackpad đến hệ thống đèn nền phím sáng và đồng đều – một trong những thiết kế tốt nhất trên thị trường laptop hiện nay.\r\nMàn hình laptop Macbook vẫn sử dụng công nghệ mini LED Liquid Retina XDR với độ phân giải 3,456 x 2,234 pixel, hỗ trợ tần số làm mới biến thiên ProMotion lên tới 120Hz. Tùy chọn màn hình kết cấu nano giúp giảm thiểu độ chói và phản chiếu, đặc biệt hiệu quả dưới ánh sáng mạnh. Đây là một cải tiến đáng giá, khiến trải nghiệm thị giác trở nên dễ chịu hơn, ngay cả khi nhìn màn hình từ các góc rộng.\r\n\r\nTuy nhiên, chi phí bổ sung 3.6 triệu đồng cho tùy chọn màn hình này có thể khiến nhiều người dùng phải cân nhắc. Mặc dù Apple đã giảm giá tùy chọn này so với khi nó ra mắt lần đầu trên iMac vào năm 2020, nhưng mức giá hiện tại vẫn tương đối cao, đặc biệt khi so sánh với các nâng cấp miễn phí như webcam Center Stage.\r\nVề tính năng Center Stage, webcam này tự động căn chỉnh để giữ bạn luôn trong khung hình, tuy nhiên, phạm vi theo dõi còn hạn chế. Ngoài ra, tính năng Desk View, vốn hiệu quả hơn trên iMac, không thật sự tối ưu khi sử dụng trên MacBook, đặc biệt trên các bàn nhỏ, khiến nó trở nên ít hữu ích trong nhiều tình huống.\r\n\r\nApple đã chọn cách tinh chỉnh và cải thiện thiết kế MacBook Pro thay vì thay đổi hoàn toàn. Với những ai yêu thích thiết kế hiện tại, đây vẫn là một sản phẩm đáng giá. Tuy nhiên, nếu bạn không phải là fan của phong cách MacBook Pro hiện tại, thì phiên bản 2024 cũng khó có thể thuyết phục bạn.\r\n\r\nTrải nghiệm MacBook Pro 16 inch 2024\r\nMacBook Pro 16 inch 2024 là một chiếc máy tính xách tay mạnh mẽ, được thiết kế để thay thế máy tính để bàn hoặc trở thành một trạm làm việc di động. Tuy nhiên, nếu bạn đã quen với sự mỏng nhẹ của MacBook Air, chiếc máy Macbook M4 này có thể khiến bạn ngạc nhiên vì cảm giác khá nặng và chắc tay. Apple không đặt mục tiêu làm cho dòng MacBook Pro lớn này trở nên siêu di động mà tập trung vào việc tích hợp hiệu năng cao trong một thiết bị gọn gàng nhất có thể.\r\n\r\nKhi sử dụng máy trên đùi, như khi ngồi ghế sofa, bạn sẽ cảm thấy rõ trọng lượng và đôi khi hơi nóng ở phần máy tiếp xúc gần bản lề. Ngoài ra, khi chip M4 Pro hoạt động tối đa, quạt tản nhiệt có thể phát ra tiếng ồn đáng chú ý nhưng vẫn không quá phiền so với các dòng máy trạm khác. Dù vậy, máy nhanh chóng giảm nhiệt và tiếng ồn sau khi xử lý xong các tác vụ nặng. Với những công việc đòi hỏi hiệu năng cao, bạn nên sử dụng máy khi đặt trên bàn và cắm sạc để tận dụng chế độ hiệu suất, giúp rút ngắn thời gian hoàn thành công việc.\r\nMột điểm nhấn khác là bản cập nhật macOS Sequoia năm nay đã cải thiện đáng kể khả năng quản lý cửa sổ, mang lại trải nghiệm làm việc trực quan hơn. Nếu bạn quan tâm, hãy tham khảo thêm đánh giá chi tiết về Sequoia để hiểu rõ các tính năng mới. Công nghệ Apple Intelligence cũng là một bổ sung thú vị, mặc dù vẫn còn trong giai đoạn thử nghiệm. Tính năng này cho thấy Apple đang nỗ lực bắt kịp xu hướng công nghệ mới, nhưng hiện tại vẫn chưa thực sự tạo ra sự khác biệt đáng kể.\r\nNhìn chung, MacBook Pro 16 inch là một lựa chọn tuyệt vời cho những người làm việc trong các lĩnh vực chuyên biệt, chẳng hạn như sản xuất nội dung hoặc thiết kế đồ họa, nơi cần sự di động nhưng không muốn hy sinh sức mạnh. Tuy nhiên, nếu bạn chỉ cần hiệu năng cao để làm việc tại nhà hoặc văn phòng, một chiếc Mac mini với cấu hình tương tự sẽ là lựa chọn thoải mái và tiết kiệm hơn. Với mức giá khởi điểm khá cao, chiếc laptop này thực sự phù hợp với những người dùng có nhu cầu đặc thù và sẵn sàng đầu tư.\r\n\r\nSo sánh hiệu năng MacBook Pro 16 inch 2024 với Mac mini\r\nDựa trên kết quả benchmark, chip M4 Pro cho thấy hiệu năng gần như tương đồng giữa Mac mini và MacBook Pro 16 inch. Điều này không quá ngạc nhiên vì cả hai đều sử dụng cùng một con chip. Tuy nhiên, theo logic thông thường, phiên bản desktop như Mac mini thường sẽ tận dụng được hiệu năng tốt hơn nhờ hệ thống tản nhiệt lớn hơn và không gian rộng rãi hơn cho phần cứng làm mát.\r\n\r\nTrong một số bài kiểm tra, MacBook Pro 16 inch có hiệu năng nhỉnh hơn một chút so với Mac mini 2024 trang bị M4 Pro, nhưng mức chênh lệch thường nằm trong sai số cho phép. Đây là một phát hiện thú vị, và có thể phiên bản M4 Pro trên Mac mini sẽ nhanh hơn một chút so với trên MacBook Pro 14 inch. Tuy nhiên, đừng mong đợi hiệu năng vượt trội chỉ vì Mac mini được đặt trong một khối nhôm nhỏ gọn với quạt tản nhiệt lớn, so với thiết kế nhôm rộng rãi đi kèm bàn phím và màn hình của MacBook Pro.\r\n\r\nChúng tôi cũng so sánh MacBook Pro 16 inch với các dòng máy khác như MacBook Pro 14 inch 2023 trang bị M3 Pro, MacBook Pro 16 inch 2023 trang bị M3 Max và MacBook Pro 14 inch 2024 với chip M4 10 lõi. Để mở rộng phạm vi so sánh, chúng tôi thêm vào một số mẫu máy tính xách tay trạm làm việc hàng đầu như Asus ProArt P16 và HP ZBook Fury 16 G11.\r\n\r\nChip M4 Pro của Apple phải cạnh tranh với các sản phẩm mạnh mẽ nhất hiện nay của AMD và Intel dành cho các laptop trạm làm việc và máy tính xách tay dành cho nhà sáng tạo nội dung. Đây là một trận chiến công nghệ thực sự, với những con chip đỉnh cao được đưa vào các thiết bị di động hiệu năng cao.\r\n\r\nHiệu năng với các phần mềm chuyên dụng\r\nHệ điều hành macOS có phần hạn chế trong việc hỗ trợ một số bài kiểm tra benchmark phổ biến. (Chẳng hạn, bài kiểm tra PCMark 10 – tiêu chuẩn trong ngành – không được hỗ trợ trên Mac.) Tuy nhiên, hầu hết các bài kiểm tra khác đều có thể so sánh giữa các nền tảng, mang lại cái nhìn cạnh tranh hơn bao giờ hết cho MacBook Pro.\r\n\r\nCác bài kiểm tra chính của chúng tôi tập trung vào hiệu suất CPU:\r\n\r\nCinebench 2024 của Maxon sử dụng công cụ Cinema 4D để dựng cảnh phức tạp.\r\nGeekbench 6.3 Pro của Primate Labs mô phỏng các ứng dụng phổ biến như xử lý PDF, nhận dạng giọng nói, và học máy.\r\nHandBrake 1.8 đo thời gian chuyển đổi đoạn video 12 phút từ độ phân giải 4K xuống 1080p.\r\nPugetBench for Creators từ Puget Systems đánh giá khả năng chỉnh sửa hình ảnh thông qua các thao tác tự động trong Adobe Photoshop 25 một trong những ứng dụng phổ biến nhất trên Mac.\r\nTrong cả bốn bài kiểm tra, M4 Pro đều vượt qua các tùy chọn chip x86 của AMD và Intel về tốc độ hoàn thành công việc. Điều đáng chú ý là M4 Pro thậm chí nhỉnh hơn cả dòng M3 Max mạnh mẽ. Tuy nhiên, sự khác biệt nhỏ này khó có thể nhận ra trong quá trình sử dụng thông thường và không đủ để thuyết phục người dùng nâng cấp từ dòng M3.\r\n\r\nSau chiến thắng trong bài kiểm tra Cinebench, M4 Pro tiếp tục thể hiện ưu thế so với các chip di động mạnh nhất từ đối thủ. Trong bài kiểm tra HandBrake, nó hoàn thành nhanh hơn đối thủ x86 đến một phút, và trong Geekbench đa nhân, M4 Pro bỏ xa các đối thủ hàng ngàn điểm. Bài kiểm tra Photoshop cũng ghi nhận chiến thắng cách biệt tương tự cho MacBook Pro 16 inch.\r\n\r\nĐiều này là một tín hiệu đáng lo ngại cho các nhà sản xuất chip x86, bởi giá của các hệ thống này không chênh lệch nhiều so với MacBook Pro đặc biệt là các dòng máy trạm như HP Z Book. MacBook Pro tiếp tục giữ vững vị thế là một trạm làm việc tối ưu dành cho các nhà sáng tạo nội dung với mức giá tương đương các đối thủ. Tuy nhiên, hãy nhớ rằng sản phẩm này chủ yếu phục vụ nhu cầu \"trạm làm việc tập trung vào sáng tạo nội dung.\r\n\r\nKhả năng đồ họa và chơi game trên M4 Pro\r\nDo hạn chế của macOS, chúng tôi chưa thể thực hiện các bài kiểm tra đồ họa tiêu chuẩn, nhưng đã thử nghiệm Total War: Warhammer 3 (2022) ở độ phân giải 1080p với thiết lập Ultra và Low. Kết quả cho thấy MacBook Pro M4 Pro có thể chạy game ở chế độ Ultra trên 30fps, và khi sử dụng cài đặt “Recommended,” máy duy trì ổn định ở mức 60fps. Đây là hiệu suất gaming tốt nhất trên MacBook, chỉ xếp sau các dòng desktop như Mac Studio. Apple đang tiến gần hơn đến việc biến Mac thành nền tảng chơi game phổ thông, mang lại trải nghiệm đáng kể cho cả công việc lẫn giải trí.\r\n\r\nThời lượng pin\r\nKiểm tra thời lượng pin bằng cách phát một video 720p (Tears of Steel) được lưu trữ cục bộ, với độ sáng màn hình 50%, âm lượng 100%, và tắt Wi-Fi cùng đèn nền bàn phím. Pin được sạc đầy trước khi bắt đầu thử nghiệm. Apple công bố MacBook Pro 16 inch có thể đạt 24 giờ khi duyệt web hoặc phát video 1080p. Trong thử nghiệm, máy đạt thời gian 25 giờ 52 phút với video 720p, vượt mức Apple công bố. Tuy nhiên, đây vẫn là thời lượng thấp nhất trong hai thế hệ MacBook Pro gần đây.\r\n\r\nDù vậy, MacBook Pro 16 inch vẫn đảm bảo thời lượng pin sử dụng cả ngày nhờ chip M4 Pro. Mặc dù không đạt kỷ lục 30 giờ như một số mẫu trước, con số 26 giờ vẫn rất ấn tượng, đặc biệt khi so sánh với laptop Windows, vốn chỉ hoạt động được nửa thời gian này.\r\n\r\nKết luận\r\nMacBook Pro 16 inch mới nhất tiếp tục khẳng định vị thế hàng đầu của mình, ngay cả khi chưa sử dụng chip M4 Max mạnh nhất. Điều này giúp nó trở thành một trong những lựa chọn đáng giá nhất trong phân khúc máy trạm di động cao cấp.\r\n\r\nMàn hình kết cấu nano là một điểm cộng lớn, nhưng thật tiếc khi Apple vẫn tính phí thêm 3,600,000 VND cho tùy chọn này, thay vì tích hợp sẵn. Một điểm khác cần cân nhắc là cấu hình M4 Pro được đánh giá có giá 87,576,000 VND, cao hơn 3,600,000 VND so với phiên bản cơ bản M4 Max (83,976,000 VND). Với mức giá tương đương, lựa chọn chip mạnh hơn rõ ràng là hợp lý hơn so với việc ưu tiên dung lượng lưu trữ lớn.\r\n\r\nDù vậy, MacBook Pro 16 inch vẫn là một lựa chọn xuất sắc. Với hiệu năng mạnh mẽ và những tính năng nổi bật, đây là chiếc laptop lý tưởng cho những ai cần một công cụ sáng tạo nội dung đáng tin cậy và cao cấp.', 'posts/rZncMNqCsjyloKGXqRzDYFE6gLD6r5AsFgOeywbf.jpg', 2, 1, 3, 1, '2026-02-05 05:07:21', '2026-02-05 05:09:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_laptop`
--

CREATE TABLE `post_laptop` (
  `post_id` int(11) NOT NULL,
  `laptop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_laptop`
--

INSERT INTO `post_laptop` (`post_id`, `laptop_id`) VALUES
(1, 2);

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
(1, 'Nhật Thành', 'npnthanh.03@gmail.com', '$2y$12$kZBCh5tmW0CuZW7VNjP6E.qOZ2sZ7OAzbY8gnJa/z9/ZHRkEeVb46', 'admin', '2026-02-02 08:17:18', '2026-02-02 01:37:23'),
(2, 'Đức Hùng', 'dhung.1@gmail.com', '$2y$12$SfWf2z/fRCUYuGu1SWOGtOF2O1VFHAvGuqDk13T1q7dQ868FeQp.y', 'user', '2026-02-05 04:10:18', '2026-02-05 04:10:18');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
