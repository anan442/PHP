-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024 年 06 月 14 日 11:18
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `final_client_data`
--

-- --------------------------------------------------------

--
-- 資料表結構 `marchart`
--

CREATE TABLE `marchart` (
  `marchartId` int(11) NOT NULL,
  `marchartName` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `businessMode` varchar(255) NOT NULL,
  `openingHours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `social_href` varchar(255) NOT NULL,
  `social_href_ig` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `marchart`
--

INSERT INTO `marchart` (`marchartId`, `marchartName`, `phone`, `address`, `businessMode`, `openingHours`, `price`, `imageName`, `imagePath`, `social_href`, `social_href_ig`) VALUES
(1, '全家', '0900-111-111', '全家路1號', '按堂收費', '0800-0000', 1000.00, 'family.jpg', 'pic/family.jpg', 'https://www.family.com.tw/Marketing/', 'https://www.instagram.com/familymart_tw/?hl=zh-tw'),
(2, '711', '0900-000-711', '小七路711號', '按月收費', '24hr', 1200.00, '711.jpg', 'pic/711.jpg', 'https://www.7-11.com.tw/', 'https://www.instagram.com/7eleventw/?hl=zh-tw'),
(3, 'OK', '0987-654-321', '可以路0號', '全額貸', '0600-2200', 500.00, 'ok.jpg', 'pic/ok.jpg', 'https://www.okmart.com.tw/', 'https://www.instagram.com/okmart_tw/'),
(4, '萊爾富', '0933-333-222', '萊爾富路7號', '僅限現金當場付款', '0800-2300', 600.00, 'hi_life.jpg', 'pic/hi_life.jpg', 'https://www.hilife.com.tw/', 'https://www.instagram.com/hilife_cvs/'),
(10, '能淬健身私教工作室', '0900-111-111', '高雄市楠梓區大學南路579號', '尚無資訊', '1000-2300', 1000.00, 'mar10.png', 'pic/mar10.png', 'https://www.facebook.com/p/%E8%83%BD%E6%B7%AC%E5%81%A5%E8%BA%AB%E7%A7%81%E6%95%99%E5%B7%A5%E4%BD%9C%E5%AE%A4-100067192513848/?locale=zh_TW', 'https://www.instagram.com/learntraining579/'),
(11, '狂享舉體訓館', '0900-000-711', '高雄市楠梓區大學西路522號', '按堂計費', '0900-2200', 1200.00, 'mar11.jpg', 'pic/mar11.jpg', 'https://www.facebook.com/crazyenjoygym/?locale=zh_TW', 'https://www.instagram.com/crazyenjoy_gym/'),
(12, 'K-FIT GYM 個人健身工作室', '0987-654-321', '高雄市楠梓區高雄大學路276~302號', '尚無資訊', '1000-2200', 500.00, 'mar12.png', 'pic/mar12.png', 'https://www.facebook.com/p/K-FIT-GYM-%E5%80%8B%E4%BA%BA%E5%81%A5%E8%BA%AB%E5%B7%A5%E4%BD%9C%E5%AE%A4-100083354431803/', 'https://www.instagram.com/kfit327/'),
(13, '艾斯靈魂私教健身房', '0933-333-222', '高雄市楠梓區大學東路202號', '按堂收費', '0900-2200', 600.00, 'mar13.png', 'pic/mar13.png', 'https://www.facebook.com/isoulfitness', 'https://www.isoul.com.tw/'),
(14, '歆自在瑜珈', '0939-553-118', '高雄市楠梓區藍昌路307號二樓', '按堂計算', '1100-2100', 1000.00, 'mar14.jpg', 'pic/mar14.jpg', 'https://www.facebook.com/p/%E6%AD%86%E8%87%AA%E5%9C%A8%E7%91%9C%E7%8F%88%E5%B7%A5%E4%BD%9C%E5%AE%A4-61551064965665/?locale=fo_FO', 'https://www.facebook.com/p/%E6%AD%86%E8%87%AA%E5%9C%A8%E7%91%9C%E7%8F%88%E5%B7%A5%E4%BD%9C%E5%AE%A4-61551064965665/?locale=fo_FO'),
(15, 'I Yoga Studio空中瑜珈工作室', '0912-345-678', '高雄市楠梓區壽豐路402號', '按堂計算', '1000-2000', 800.00, 'mar15.jpg', 'pic/mar15.jpg', 'https://www.facebook.com/p/I-Yoga-Studio%E7%A9%BA%E4%B8%AD%E7%91%9C%E7%8F%88-100067412644527/', 'https://www.instagram.com/explore/locations/612630972144883/i-yoga-studio/'),
(16, 'H健身瑜珈', '073645604', '高雄市楠梓區後昌路1110號4樓', '按堂收費', '0900-2200', 400.00, 'mar16.jpg', 'pic/mar16.jpg', 'https://www.facebook.com/Hfitnesscenter12/?locale=zh_TW', 'https://www.instagram.com/h._.fitnesscenter/'),
(17, '汶新運動工作室-楠梓店', '0909-090-909', '高雄市楠梓區秀群路499巷3號', '按次計費', '1000-2200', 1500.00, 'mar17.jpg', 'pic/mar17.jpg', 'https://www.facebook.com/WENXINFITNESS/', 'https://www.instagram.com/wx.fitness/'),
(18, 'Curves 楠梓加昌店', '073601363', '高雄市楠梓區加昌路891號2樓', '按堂計費', '1430-2030', 1500.00, 'mar18.jpg', 'pic/mar18.jpg', 'https://www.facebook.com/p/Curves-%E6%A5%A0%E6%A2%93%E5%8A%A0%E6%98%8C%E5%BA%9720-61551030694336/', 'https://www.instagram.com/explore/locations/119393597927484/curves-20/');

-- --------------------------------------------------------

--
-- 資料表結構 `suser`
--

CREATE TABLE `suser` (
  `userId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `uRole` varchar(10) NOT NULL,
  `verification_code` varchar(6) DEFAULT NULL,
  `code_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `suser`
--

INSERT INTO `suser` (`userId`, `email`, `password`, `account`, `username`, `age`, `uRole`, `verification_code`, `code_timestamp`) VALUES
(11, 'a1113362@mail.nuk.edu.tw', '$2y$10$ndlcguFGbI5vKafON51G1.OFDFeY3g8Sa8X5jPGBT25l9P8brdap6', 'qwer', 'qwer', 20, '', '448660', '2024-06-12 17:54:55'),
(14, 'yaoan.lee5@gmail.com', '$2y$10$6p6rzkvLk8zErS2u6s1rmusJvb/INeyf8gx4AfY6D4tNSyPBXLvwC', 'anan', 'lyan', 20, 'admin', '642603', '2024-06-12 17:48:30'),
(42, 'a1113363@mail.nuk.edu.tw', '$2y$10$Fy7tRog.t59mAM7NscO9AejVqaRwj3H/a2TxAi1uVYy0a8TKkYQNe', 'wan', 'wan', 25, 'user', NULL, '2024-06-12 18:19:26'),
(43, 'max20040301@gmail.com', '$2y$10$Xe5LUjtVRTq3HjNdaJdyV.zLVQfNTVyRmqwK1c7ST76/PIFzp2SEi', 'max', 'max', 30, 'user', NULL, '2024-06-12 18:19:52'),
(44, 'asdf@asdf.com', '$2y$10$mzo6ibw7t8HWmtabmmQ1IeEmxtVdtywM9dB93Nj1ftd3sSL5h80xK', 'asdf', 'zxcv', 10, 'user', NULL, '2024-06-12 18:51:35');

-- --------------------------------------------------------

--
-- 資料表結構 `user_favorites`
--

CREATE TABLE `user_favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `marchart_name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `business_mode` varchar(255) DEFAULT NULL,
  `opening_hours` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `social_href` varchar(255) DEFAULT NULL,
  `social_href_ig` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user_favorites`
--

INSERT INTO `user_favorites` (`id`, `user_id`, `marchart_name`, `phone`, `address`, `image_path`, `business_mode`, `opening_hours`, `price`, `social_href`, `social_href_ig`) VALUES
(36, 14, '全家', '0900-111-111', '全家路1號', 'pic/family.jpg', '按堂收費', '0800-0000', '1000.00', 'https://www.family.com.tw/Marketing/', 'https://www.instagram.com/familymart_tw/?hl=zh-tw');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `marchart`
--
ALTER TABLE `marchart`
  ADD PRIMARY KEY (`marchartId`);

--
-- 資料表索引 `suser`
--
ALTER TABLE `suser`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `marchart`
--
ALTER TABLE `marchart`
  MODIFY `marchartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `suser`
--
ALTER TABLE `suser`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD CONSTRAINT `user_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `suser` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
