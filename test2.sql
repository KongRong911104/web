-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2023 年 08 月 12 日 16:12
-- 伺服器版本： 10.3.38-MariaDB-0ubuntu0.20.04.1
-- PHP 版本： 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test2`
--

-- --------------------------------------------------------

--
-- 資料表結構 `exdata`
--

CREATE TABLE `exdata` (
  `sn` bigint(20) UNSIGNED NOT NULL,
  `classname` text NOT NULL,
  `hour` int(2) NOT NULL,
  `math` float DEFAULT NULL,
  `base` float NOT NULL,
  `li` float NOT NULL,
  `shi` float NOT NULL,
  `value1` text NOT NULL,
  `value2` text NOT NULL,
  `value3` text NOT NULL,
  `value4` text NOT NULL,
  `value5` text NOT NULL,
  `value6` text NOT NULL,
  `value7` text NOT NULL,
  `value8` text NOT NULL,
  `del_flag` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `exdata`
--

INSERT INTO `exdata` (`sn`, `classname`, `hour`, `math`, `base`, `li`, `shi`, `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `value8`, `del_flag`) VALUES
(28, 'Python程式設計', 4, 0, 1, 2, 0, '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(29, '計算機組織', 1, 0, 0, 3, 0, '■', '■', '■', '■', 'NULL', 'NULL', '■', 'NULL', 0),
(30, '計算機概論', 3, 0, 3, 0, 0, '■', '■', '■', '■', 'NULL', 'NULL', '■', 'NULL', 0),
(31, '專題實作', 2, 0, 0, 0, 2, '■', '■', '■', '■', '■', '■', '■', '■', 0),
(32, '統計學', 3, 3, 0, 0, 0, '■', '■', 'NULL', '■', 'NULL', 'NULL', 'NULL', '■', 0),
(33, '軟體工程（二）', 3, 0, 0, 3, 0, '■', '■', 'NULL', 'NULL', '■', '■', 'NULL', 'NULL', 0),
(34, '微算機系統', 1, 0, 0, 3, 0, '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(35, '微算機系統實驗', 1, 0, 0, 0, 1, '■', 'NULL', '■', '■', 'NULL', '■', 'NULL', 'NULL', 0),
(36, '微積分甲〈一〉', 4, 3, 0, 0, 0, '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '■', 0),
(37, '資料庫', 3, 0, 0, 3, 0, '■', '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 0),
(38, '資料結構', 3, 0, 3, 0, 0, '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(39, '電子電路學', 3, 0, 3, 0, 0, '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(40, '電子電路學實驗', 3, 0, 1, 0, 0, '■', '■', '■', '■', 'NULL', '■', 'NULL', 'NULL', 0),
(41, '演算法', 3, 0, 3, 0, 0, '■', '■', '■', 'NULL', 'NULL', 'NULL', '', 'NULL', 0),
(42, '線性代數', 3, 3, 0, 0, 0, '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(43, '機率學', 3, 3, 0, 0, 0, '■', '■', 'NULL', '■', 'NULL', 'NULL', 'NULL', '■', 0),
(44, '機器學習導論', 3, 0, 0, 1, 2, '■', '■', '■', '■', 'NULL', 'NULL', '■', '■', 0),
(45, '離散數學', 3, 3, 0, 0, 0, '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(46, 'AI實作（二）', 3, 0, 0, 0, 3, '■', '■', '■', '■', 'NULL', '■', 'NULL', 'NULL', 0),
(47, 'JAVA程式設計', 3, 0, 1, 2, 0, '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(48, '自然語言處理', 3, 0, 0, 0, 3, '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(49, '物件導向程式設計', 3, 0, 0, 1, 2, 'NULL', 'NULL', '■', '■', '■', 'NULL', '■', 'NULL', 0),
(50, '深度學習進階', 3, 0, 0, 1, 2, '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(51, '組合語言', 3, 0, 0, 2, 1, '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(52, '硬體描述語言', 3, 0, 0, 1, 2, '■', '■', '■', '■', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(53, '專題討論（一）', 1, 0.1, 0.1, 0.8, 0, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '■', '■', 'NULL', 0),
(54, '專題討論（三）', 1, 0.1, 0.1, 0.8, 0, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '■', '■', 'NULL', 0),
(68, 'javascript:alert(1)', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1),
(69, 'j', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', 'NULL', 1),
(70, 'h', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', 'NULL', 1),
(71, '\"><script>alert(1)</script>', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1),
(72, '&quot;&lt;script&gt;alert(0)&lt;/scrpit&gt;', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1),
(73, '0 0 ', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1),
(74, '12', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1),
(75, '13', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1),
(76, '&quot;&lt;script&gt;alert(1)&lt;/script&gt;', 0, 0, 0, 0, 0, '■', '■', '■', '■', '■', '■', '■', '■', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `GR`
--

CREATE TABLE `GR` (
  `sn` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `GR`
--

INSERT INTO `GR` (`sn`, `groupID`, `roleID`) VALUES
(1, 1, 1),
(6, 1, 2),
(5, 3, 1),
(7, 3, 2),
(8, 3, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `groups`
--

CREATE TABLE `groups` (
  `sn` int(11) NOT NULL,
  `groupName` text NOT NULL,
  `groupColor` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `groups`
--

INSERT INTO `groups` (`sn`, `groupName`, `groupColor`) VALUES
(1, '管理員群組', '#ffdfa8'),
(3, '測試2', '#a7aafb'),
(9, 'qwe', '#FAADA2');

-- --------------------------------------------------------

--
-- 資料表結構 `GRP`
--

CREATE TABLE `GRP` (
  `sn` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `GRP`
--

INSERT INTO `GRP` (`sn`, `groupID`, `roleID`, `permissionID`) VALUES
(8, 1, 1, 1),
(9, 1, 1, 2),
(10, 1, 1, 3),
(20, 3, 1, 1),
(21, 3, 1, 2),
(22, 3, 1, 3),
(23, 1, 2, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `GRU`
--

CREATE TABLE `GRU` (
  `sn` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `GRU`
--

INSERT INTO `GRU` (`sn`, `groupID`, `roleID`, `userID`) VALUES
(2, 1, 1, 1),
(9, 3, 1, 1),
(10, 3, 1, 2),
(11, 1, 2, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `permission`
--

CREATE TABLE `permission` (
  `sn` int(11) NOT NULL,
  `permissionName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `permission`
--

INSERT INTO `permission` (`sn`, `permissionName`) VALUES
(1, '管理員'),
(2, '可以用教學成效表'),
(3, '可以用教學反思表');

-- --------------------------------------------------------

--
-- 資料表結構 `roles`
--

CREATE TABLE `roles` (
  `sn` int(11) NOT NULL,
  `roleName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `roles`
--

INSERT INTO `roles` (`sn`, `roleName`) VALUES
(1, '管理員'),
(2, '助教'),
(3, '測試');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `sn` int(11) NOT NULL,
  `account` text NOT NULL,
  `password` text NOT NULL DEFAULT '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
  `userName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`sn`, `account`, `password`, `userName`) VALUES
(1, 'admin', 'dfa3476846ce31adf8b1496b34595fb3f5ca2adf22b6df8ca2264c718b985cd9', '最高管理員'),
(2, 'member', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user#2');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `exdata`
--
ALTER TABLE `exdata`
  ADD UNIQUE KEY `sn` (`sn`);

--
-- 資料表索引 `GR`
--
ALTER TABLE `GR`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `GR` (`groupID`,`roleID`) USING BTREE;

--
-- 資料表索引 `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `GRP`
--
ALTER TABLE `GRP`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `permissionID` (`permissionID`),
  ADD KEY `GR` (`groupID`,`roleID`) USING BTREE;

--
-- 資料表索引 `GRU`
--
ALTER TABLE `GRU`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `userID` (`userID`),
  ADD KEY `GR` (`groupID`,`roleID`) USING BTREE;

--
-- 資料表索引 `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sn`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `exdata`
--
ALTER TABLE `exdata`
  MODIFY `sn` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `GR`
--
ALTER TABLE `GR`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `groups`
--
ALTER TABLE `groups`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `GRP`
--
ALTER TABLE `GRP`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `GRU`
--
ALTER TABLE `GRU`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `permission`
--
ALTER TABLE `permission`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `roles`
--
ALTER TABLE `roles`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `GR`
--
ALTER TABLE `GR`
  ADD CONSTRAINT `GR_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`sn`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `GR_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`sn`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的限制式 `GRP`
--
ALTER TABLE `GRP`
  ADD CONSTRAINT `GRP_ibfk_3` FOREIGN KEY (`permissionID`) REFERENCES `permission` (`sn`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `GR_2` FOREIGN KEY (`groupID`,`roleID`) REFERENCES `GR` (`groupID`, `roleID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的限制式 `GRU`
--
ALTER TABLE `GRU`
  ADD CONSTRAINT `GRU_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`sn`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `GR_1` FOREIGN KEY (`groupID`,`roleID`) REFERENCES `GR` (`groupID`, `roleID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
