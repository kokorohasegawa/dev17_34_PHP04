-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 11 月 05 日 14:49
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ec_table`
--

CREATE TABLE `ec_table` (
  `id` int(12) NOT NULL,
  `item` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL,
  `category` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `ec_table`
--

INSERT INTO `ec_table` (`id`, `item`, `value`, `description`, `fname`, `indate`, `category`) VALUES
(1, 'いいねくれ２', 1000, 'いいねくれ２', 'イイネ_くれ♡.png', '2020-11-05 23:23:25', 1),
(2, 'イイねがないと死んでしまう', 100, 'イイねがないと死んでしまう', 'イイネがないと死んでしまう.png', '2020-11-05 23:23:37', 1),
(3, 'おしゃれつくえ', 10000, 'お洒落なつくえ23', '51jvB0RlkcL._AC_SX425_.jpg', '2020-11-05 23:21:55', 2),
(4, '学校のいす', 50000, '学校のふつうのいす', 'ダウンロード.jpeg', '2020-11-05 23:13:09', 2),
(5, 'バスケットボール', 78930, 'ばすけ', 'ダウンロード (1).jpeg', '2020-11-05 23:27:30', 3),
(6, '万年筆', 22, '万年筆', '61TopLGd0+L._AC_SS350_.jpg', '2020-11-05 23:26:10', 4),
(7, 'コップ', 44, 'かわったコップ', '51NEBqLCy2L._AC_SS350_.jpg', '2020-11-05 23:26:41', 5);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `ec_table`
--
ALTER TABLE `ec_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `ec_table`
--
ALTER TABLE `ec_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;