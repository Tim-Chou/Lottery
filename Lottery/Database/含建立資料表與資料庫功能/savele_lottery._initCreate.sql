-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-11-13 01:41:44
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `savele_lottery`
--
CREATE DATABASE IF NOT EXISTS `savele_lottery` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `savele_lottery`;

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `aID` int(11) NOT NULL,
  `aName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理者帳號',
  `aPassword` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理者密碼'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='後臺管理者登入時的帳號與密碼';

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`aID`, `aName`, `aPassword`) VALUES
(1, 'admin', 'P@ssW0rd');

-- --------------------------------------------------------

--
-- 資料表結構 `active_date`
--

CREATE TABLE `active_date` (
  `tID` int(11) NOT NULL,
  `tStart` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '活動開始時間',
  `tEnd` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '活動結束時間',
  `add_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '資料更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='活動時間限制控制';

--
-- 傾印資料表的資料 `active_date`
--

INSERT INTO `active_date` (`tID`, `tStart`, `tEnd`, `add_time`) VALUES
(1, '2021-08-01T17:02:00', '2021-12-16T17:02:00', '2021-10-24T00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `bulletin`
--

CREATE TABLE `bulletin` (
  `bID` int(100) NOT NULL COMMENT '布告欄ID',
  `bTitle` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公佈欄的公告名稱(公告標題Title)',
  `bContext` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告文章內容',
  `bAddFileDir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告的附件檔案之路徑與系統檔名',
  `bAddFileName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告的附件檔案的檔名',
  `bAddURL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告欄之附上的URL超連結網址',
  `bAddURLName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告欄之附上的超連結之網站名稱',
  `bStartDate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告開始時間(只有日期:ex:  2021-11-02)',
  `bEndDate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公告的結束時間(只有日期:ex:  2021-11-15)',
  `bOnTop` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '置頂功能：「Y」為置頂，「N」為「非」置頂；預設是「N」。',
  `bAddDate` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '布告欄公告創建時間。'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='bulletin公佈欄';

-- --------------------------------------------------------

--
-- 資料表結構 `lottery`
--

CREATE TABLE `lottery` (
  `LID` int(11) NOT NULL,
  `LName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '參賽者/得獎者姓名',
  `LEleNum` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電表號碼',
  `LAddress` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '參賽者電表地址',
  `LBeforeFee` int(50) DEFAULT NULL COMMENT '區年同期總用電量',
  `LLastFee` int(50) DEFAULT NULL COMMENT '本期總用電量',
  `LBeforeDays` int(11) DEFAULT NULL COMMENT '去年同期用電日',
  `LLastDays` int(11) DEFAULT NULL COMMENT '本期總用電日',
  `LBeforeAvgFee` float DEFAULT NULL COMMENT '去年同期平均用電量',
  `LLastAvgFee` float DEFAULT NULL COMMENT '本期總平均用電量',
  `LSaveFee` int(100) DEFAULT NULL COMMENT '節電率',
  `LImage_file` varchar(515) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電表帳單上傳圖檔的位置(包含系統檔名)',
  `LRealImgFileName` varchar(515) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電表帳單上傳圖檔的真實名字(原始檔名)',
  `LAward` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '是否有得獎：Y(得獎)，無符號者為未得獎；都沒有Y時則尚未開獎。',
  `LAdd_time` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='抽獎者與得獎者名單';

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `notop_bulletin`
-- (請參考以下實際畫面)
--
CREATE TABLE `notop_bulletin` (
`bID` int(100)
,`bTitle` varchar(45)
,`bContext` text
,`bAddFileDir` varchar(255)
,`bAddFileName` varchar(100)
,`bAddURL` varchar(255)
,`bAddURLName` varchar(100)
,`bStartDate` varchar(45)
,`bEndDate` varchar(45)
,`bOnTop` char(1)
,`bAddDate` varchar(45)
);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `top_bulletin`
-- (請參考以下實際畫面)
--
CREATE TABLE `top_bulletin` (
`bID` int(100)
,`bTitle` varchar(45)
,`bContext` text
,`bAddFileDir` varchar(255)
,`bAddFileName` varchar(100)
,`bAddURL` varchar(255)
,`bAddURLName` varchar(100)
,`bStartDate` varchar(45)
,`bEndDate` varchar(45)
,`bOnTop` char(1)
,`bAddDate` varchar(45)
);

-- --------------------------------------------------------

--
-- 檢視表結構 `notop_bulletin`
--
DROP TABLE IF EXISTS `notop_bulletin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `notop_bulletin`  AS  select `bulletin`.`bID` AS `bID`,`bulletin`.`bTitle` AS `bTitle`,`bulletin`.`bContext` AS `bContext`,`bulletin`.`bAddFileDir` AS `bAddFileDir`,`bulletin`.`bAddFileName` AS `bAddFileName`,`bulletin`.`bAddURL` AS `bAddURL`,`bulletin`.`bAddURLName` AS `bAddURLName`,`bulletin`.`bStartDate` AS `bStartDate`,`bulletin`.`bEndDate` AS `bEndDate`,`bulletin`.`bOnTop` AS `bOnTop`,`bulletin`.`bAddDate` AS `bAddDate` from `bulletin` where `bulletin`.`bOnTop` = 'N' order by `bulletin`.`bStartDate` ;

-- --------------------------------------------------------

--
-- 檢視表結構 `top_bulletin`
--
DROP TABLE IF EXISTS `top_bulletin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `top_bulletin`  AS  select `bulletin`.`bID` AS `bID`,`bulletin`.`bTitle` AS `bTitle`,`bulletin`.`bContext` AS `bContext`,`bulletin`.`bAddFileDir` AS `bAddFileDir`,`bulletin`.`bAddFileName` AS `bAddFileName`,`bulletin`.`bAddURL` AS `bAddURL`,`bulletin`.`bAddURLName` AS `bAddURLName`,`bulletin`.`bStartDate` AS `bStartDate`,`bulletin`.`bEndDate` AS `bEndDate`,`bulletin`.`bOnTop` AS `bOnTop`,`bulletin`.`bAddDate` AS `bAddDate` from `bulletin` where `bulletin`.`bOnTop` = 'Y' order by `bulletin`.`bStartDate` ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`aID`);

--
-- 資料表索引 `active_date`
--
ALTER TABLE `active_date`
  ADD PRIMARY KEY (`tID`);

--
-- 資料表索引 `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`bID`);

--
-- 資料表索引 `lottery`
--
ALTER TABLE `lottery`
  ADD PRIMARY KEY (`LID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `aID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `active_date`
--
ALTER TABLE `active_date`
  MODIFY `tID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `bID` int(100) NOT NULL AUTO_INCREMENT COMMENT '布告欄ID', AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lottery`
--
ALTER TABLE `lottery`
  MODIFY `LID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
