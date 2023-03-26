-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 19, 2023 lúc 07:37 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `multichoice`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT 'tài khoản',
  `password` varchar(150) NOT NULL COMMENT 'mật khẩu',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'là admin',
  `fullname` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `is_admin`, `fullname`, `phone`, `email`, `address`) VALUES
(3, 'admin', '$2y$10$LMb3/XoNU8Q/kwWxQpkDMOODEIBC/w4rsz3RgQcXPPu/5UZrqrRK.', 1, 'Truong', '0911397764', 'redoprogrammer@gmail.com', 'Dak Doa - Gia Lai'),
(5, 'quynhgiao', '$2y$10$2umJ8LYJk5rn6MlPhPw7q./gAtjRGG9o/hygF6XVUYlJr9.cgrSQm', 0, 'Quỳnh Giao', '1234432142', 'quynhgiao@gmail.com', 'Gia Lai'),
(6, 'minhkhang', '$2y$10$mGkajHsaN81Rk8EZLDBJs.hdqz.KrKsLZ03YsslM12Nh08xFpAUdy', 0, 'Minh Khang', '2134214124', 'minhkhang@gmail.com', 'Gia Lai'),
(7, 'minhvy', '$2y$10$j5wHL9gZt6ahyM2cX3p66.1x27eChQ5G0TbILXdAPu99sI1jd4npS', 0, 'Minh Vy', '3211234124', 'minhvy@gmail.com', 'Gia Lai'),
(8, 'nhidoan', '$2y$10$mybRtK1dUl39GJpHCwct4.DUabUnKz6t./800PEbggwQ83wkRiyQq', 0, 'Nhi Đo&agrave;n', '4321443124', 'nhidoan@gmail.com', 'Gia Lai'),
(9, 'doancongty', '$2y$10$dfbFLp1BF9DkfeI7y9SE5O6AKkY0ukwdy5uQZGHc4linlKYIeIybe', 0, 'Đo&agrave;n Dự', '1234214', 'doancongtu@gmail.com', 'Đại L&yacute; Đo&agrave;n Thị'),
(10, 'duongqua', '$2y$10$EKfeDiKhTxadZHlg0fmvvu2Yxce4ePb9iI0Ue5LkucaDiyKyBXGJi', 0, 'Dương Qu&aacute;', '43214214', 'duongqua@gmail.com', 'Cổ Mộ'),
(11, 'tieulongnu', '$2y$10$fjEfZESO5Y.4trKJyidZa.lczPKNJslHktVlhudt9I0VwhW5NNTra', 0, 'Thần tiên tỉ tỉ', '0098841111', 'thantientiti@gmail.com', 'Cổ Mộ - Chung Nam sơn'),
(12, 'doanchibinh', '$2y$10$aHRJSfG17BeRFIFFxuZe4.wdn4Sg2e22UknnV3UfkLuL46HgjpoQG', 0, 'Do&atilde;n Ch&iacute; B&igrav', '4545253', 'binhcongtu@gmail.com', 'To&agrave;n Ch&acirc;n'),
(14, 'test', '$2y$10$6QciGG43mNCcb7PZ4ZKzW.cIqqw9efm5JFoEQbLGjd3.6fu60ZBQm', 0, 'Test', '0431341341', 'test@gmail.com', 'Test address');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `answer` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `title`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(1, 'đây phải là câu hỏi không?', 'aaa', 'b', 'c', 'd', 'D'),
(2, 'Chương trình liveshow truyền hình?', 'Ai là triệu phú', 'Hãy chọn giá đúng', 'Vietnam got Talents', 'All', 'D'),
(3, 'Luật Tổ chức chính quyền địa phương được Quốc Hội thông qua ngày tháng năm nào?', 'Ngày 19/06/2016', 'Ngày 19/06/2015', 'Ngày 21/12/2015', 'Ngày 01/07/2016', 'B'),
(4, 'Luật Tổ chức chính quyền địa phương 2015 có hiệu lực từ ngày tháng năm nào?', '01/01/2016', '20/10/2015', '31/12/2015', '01/07/2016', 'A'),
(5, 'Chương I của Luật tổ chức chính quyền địa phương có nội dung gì?', 'Những quy định chung', 'Phạm vi điều chỉnh và đối tượng áp dụng.', 'Đơn vị hành chính.', 'Đơn vị hành chính và phân loại đơn vị hành chính.', 'A'),
(6, 'Chương I Luật tổ chức chính quyền địa phương có mấy điều?', '15', '20', '25', '30', 'A'),
(7, 'Phạm vi điều chỉnh của Luật Tổ chức chính quyền địa phương có nội dung gì?', 'Quy định về đơn vị hành chính và tổ chức, hoạt động cũng như nguyên tắc vận hành của các đơn vị hành chính.', 'Quy định về đơn vị hành chính và tổ chức, hoạt động của chính quyền địa phương ở các đơn vị hành chính.', 'Quy định về chính quyền địa phương các cấp tại các đơn vị hành chính.', 'Đơn vị hành chính và việc áp dụng đơn vị hành chính ở chính quyền địa phương các cấp.', 'B'),
(8, 'Thành phố Hà Nội và thành phố Hồ Chí Minh là loại đơn vị hành chính nào?', 'Cấp tỉnh loại I.', 'Cấp tỉnh.', 'Cấp thành phố trực thuộc trung ương.', 'Cấp tỉnh loại đặc biệt.', 'D'),
(9, 'Mục đích của việc phân loại đơn vị hành chính là?', 'Cơ sở để hoạch định chính sách phát triển kinh tế - xã hội; xây dựng tổ chức bộ máy, chế độ, chính sách đối với cán bộ, công chức của chính quyền địa phương phù hợp với từng loại đơn vị hành chính.', 'Cơ sở để hoạch định chính sách phát triển kinh tế - xã hội phù hợp với từng địa phương, ngành, lĩnh vực.', 'Cơ sở để quyết định chính sách phát triển cơ sở hạ tầng, ngân sách cho từng địa phương phù hợp với từng loại đơn vị hành chính.', 'Bảo đảm chính sách an sinh xã hội, phát triển các ngành, lĩnh vực trên từng địa bàn.', 'A'),
(10, 'Đơn vị hành chính cấp tỉnh được chia thành mấy loại?', '04 loại.', '03 loại.', '05 loại.', '02 loại.', 'A'),
(11, 'Đâu không phải là tiêu chí để phân loại đơn vị hành chính?', 'Trình độ dân trí, mức độ phát triển các ngành, lĩnh vực.', 'Quy mô dân số.', 'Diện tích tự nhiên.', 'Số đơn vị hành chính trực thuộc.', 'A'),
(15, 'Câu hỏi này dùng để test chức năng update question qua api?', 'Có vẻ như mọi thứ đang nằm trong tầm kiểm soát', 'Bạn đã nắm khá rõ về API trong PHP rồi đó!', 'Ráng lên! Ba mẹ bạn tin bạn!', 'Cùi mía. Có vậy mà làm mãi không xong à?', 'B'),
(16, 'Câu hỏi này dùng để test chức năng update question qua api?', 'Có vẻ như mọi thứ đang nằm trong tầm kiểm soát', 'Bạn đã nắm khá rõ về API trong PHP rồi đó!', 'Ráng lên! Ba mẹ bạn tin bạn!', 'Cùi mía. Có vậy mà làm mãi không xong à?', 'B'),
(17, 'Câu hỏi này dùng để test chức năng update question qua api?', 'Có vẻ như mọi thứ đang nằm trong tầm kiểm soát', 'Bạn đã nắm khá rõ về API trong PHP rồi đó!', 'Ráng lên! Ba mẹ bạn tin bạn!', 'Cùi mía. Có vậy mà làm mãi không xong à?', 'B'),
(18, 'Câu hỏi này dùng để test chức năng update question qua api?', 'Có vẻ như mọi thứ đang nằm trong tầm kiểm soát', 'Bạn đã nắm khá rõ về API trong PHP rồi đó!', 'Ráng lên! Ba mẹ bạn tin bạn!', 'Cùi mía. Có vậy mà làm mãi không xong à?', 'B'),
(22, 'test 3', '1', '2', '3', '4', 'A');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL,
  `exam_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `results`
--

INSERT INTO `results` (`id`, `user_id`, `exam_date`, `result`, `mark`) VALUES
(21, 3, '2023-03-19 17:14:56', '[{\"id\":\"2\",\"choice\":\"A\",\"answer\":\"D\"},{\"id\":\"11\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"6\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"7\",\"choice\":\"A\",\"answer\":\"B\"},{\"id\":\"10\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"4\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"22\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"16\",\"choice\":\"A\",\"answer\":\"B\"},{\"id\":\"17\",\"choice\":\"A\",\"answer\":\"B\"},{\"id\":\"9\",\"choice\":\"A\",\"answer\":\"A\"}]', 0),
(22, 3, '2023-03-19 17:21:56', '[{\"id\":\"22\",\"choice\":\"C\",\"answer\":\"A\"},{\"id\":\"8\",\"choice\":\"A\",\"answer\":\"D\"},{\"id\":\"17\",\"choice\":\"A\",\"answer\":\"B\"},{\"id\":\"5\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"7\",\"choice\":\"B\",\"answer\":\"B\"},{\"id\":\"9\",\"choice\":\"C\",\"answer\":\"A\"},{\"id\":\"2\",\"choice\":\"A\",\"answer\":\"D\"},{\"id\":\"6\",\"choice\":\"A\",\"answer\":\"A\"},{\"id\":\"16\",\"choice\":\"B\",\"answer\":\"B\"},{\"id\":\"15\",\"choice\":\"B\",\"answer\":\"B\"}]', 5);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
