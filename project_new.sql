-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2025 at 05:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'sunnygkp10@gmail.com', '123456'),
(2, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('qid_68b373dcb014d7.52693907', 'opt_68b373dcb48bc3.40684319'),
('qid_68b373dcb586e1.51969371', 'opt_68b373dcb89b84.94578384'),
('qid_68b3776e4ee881.49110943', 'opt_68b3776e4fdc16.93168938'),
('qid_68b3776e584cc1.18505970', 'opt_68b3776e605a33.64023897'),
('qid_68b3790695b067.38246766', 'opt_68b379069716e4.56819482'),
('qid_68b379069dd901.45200236', 'opt_68b379069e5ad2.37525648'),
('qid_68b412cbb3a8d2.17489190', 'opt_68b412cbb52927.03828536'),
('qid_68b4170f5b69c4.99048195', 'opt_68b4170f5c62f1.71904049'),
('qid_68b4170f5facf3.44186588', 'opt_68b4170f604159.25044949'),
('qid_68b418d43ada84.22633118', 'opt_68b418d43bb2d7.45719758'),
('qid_68b41d11a31131.60950548', 'opt_68b41d11a3bb32.89642413'),
('qid_68b41d11a7f3b5.80738853', 'opt_68b41d11a86887.96029786'),
('qid_68b42ae6178b37.73782080', 'opt_68b42ae618aa04.44933782'),
('qid_68b42ae62080d2.52517616', 'opt_68b42ae6212a58.93467105'),
('qid_68b42b8891e424.52654535', 'opt_68b42b8892c3b1.91988524'),
('qid_68b42e736ba1c9.18250891', 'opt_68b42e736c9203.86141209'),
('qid_68b42e7370bba2.46789690', 'opt_68b42e73714fe5.95751305'),
('qid_68b436a0c3d006.21891567', 'opt_68b436a0c828b6.55957319'),
('qid_68b436a0cab845.40002809', 'opt_68b436a0cc5720.02198015'),
('qid_68b437ca7677f2.12675280', 'opt_68b437ca77ea94.63909556'),
('qid_68b437ca7ab586.96883916', 'opt_68b437ca7b3f00.86564288'),
('qid_68b43a801fd338.64312244', 'opt_68b43a8020e0f5.54169689'),
('qid_68b43a8028a9e8.45970983', 'opt_68b43a802d8ea0.41258924');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `feedback` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `feedback`, `date`, `time`) VALUES
('55846be776610', 'testing', 'sunnygkp10@gmail.com', 'testing', 'testing stART', '2015-06-19', '09:22:15pm'),
('5584ddd0da0ab', 'netcamp', 'sunnygkp10@gmail.com', 'feedback', ';mLBLB', '2015-06-20', '05:28:16am'),
('558510a8a1234', 'sunnygkp10', 'sunnygkp10@gmail.com', 'dl;dsnklfn', 'fmdsfld fdj', '2015-06-20', '09:05:12am'),
('5585509097ae2', 'sunny', 'sunnygkp10@gmail.com', 'kcsncsk', 'l.mdsavn', '2015-06-20', '01:37:52pm'),
('5586ee27af2c9', 'vikas', 'vikas@gmail.com', 'trial feedback', 'triaal feedbak', '2015-06-21', '07:02:31pm'),
('5589858b6c43b', 'nik', 'nik1@gmail.com', 'good', 'good site', '2015-06-23', '06:12:59pm');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`email`, `eid`, `score`, `level`, `sahi`, `wrong`, `date`, `start_time`, `end_time`, `completed`) VALUES
('eomoniyi245@gmail.com', '', 0, 0, 0, 0, '2025-08-30 00:02:42', 1756512162, 1756512162, 0),
('eomoniyi245@gmail.com', 'eid_68b34a399389a515960450', 0, 0, 0, 0, '2025-08-30 19:33:25', 1756582405, 1756582405, 0),
('', '', 0, 0, 0, 0, '2025-08-30 19:47:42', 1756583262, 1756583262, 0),
('eomoniyi245@gmail.com', 'eid_68b37315c7c06974166789', 0, 0, 0, 0, '2025-08-30 22:08:31', 1756591711, 1756592011, 0),
('eomoniyi245@gmail.com', 'eid_68b377243cfa0982276389', 0, 0, 0, 0, '2025-08-30 22:13:28', 1756592008, 1756592308, 0),
('eomoniyi245@gmail.com', 'eid_68b378850b034237252487', 0, 1, 1, 0, '2025-08-30 22:25:04', 1756592401, 1756592701, 1),
('eomoniyi245@gmail.com', 'eid_68b412bcf2bc2465956995', 0, 1, 1, 0, '2025-08-31 09:21:12', 1756631769, 1756632069, 1),
('eomoniyi245@gmail.com', 'eid_68b416efa4e0d191870238', 0, 8, 8, 0, '2025-08-31 09:34:44', 1756632857, 1756633217, 1),
('eomoniyi245@gmail.com', 'eid_68b418c436f10758142082', 0, 0, 0, 0, '2025-08-31 10:07:13', 1756633325, 1756634525, 1),
('eomoniyi245@gmail.com', 'eid_68b41cf3d87ec109597764', 2, 2, 2, 0, '2025-08-31 10:23:53', 1756635439, 1756635919, 1),
('eomoniyi245@gmail.com', 'eid_68b42ac6cdb3f645346663', 2, 2, 2, 0, '2025-08-31 10:59:27', 1756637932, 1756638232, 1),
('eomoniyi245@gmail.com', 'eid_68b42b69ead7e272949971', 0, 0, 0, 0, '2025-08-31 11:07:06', 1756638096, 1756638396, 1),
('eomoniyi245@gmail.com', 'eid_68b42e08f04c0774847085', 0, 1, 1, 0, '2025-08-31 11:21:01', 1756638966, 1756639266, 0),
('eomoniyi245@gmail.com', 'eid_68b43641a52f1910227930', 2, 2, 2, 0, '2025-08-31 11:49:56', 1756640941, 1756641241, 1),
('eomoniyi245@gmail.com', 'eid_68b437ae0d84d205520310', 0, 1, 1, 0, '2025-08-31 11:54:09', 1756641242, 1756641542, 0),
('eomoniyi245@gmail.com', 'eid_68b43a2bb2c39904941526', 1, 2, 1, 1, '2025-08-31 12:07:22', 1756641954, 1756642254, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history_answers`
--

CREATE TABLE `history_answers` (
  `email` varchar(255) NOT NULL,
  `eid` varchar(50) NOT NULL,
  `qid` varchar(50) NOT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_answers`
--

INSERT INTO `history_answers` (`email`, `eid`, `qid`, `answer`) VALUES
('eomoniyi245@gmail.com', 'eid_68b3577bf3468030949362', 'qid_68b357be04b6b9.17412620', 'opt_68b357be058c50.67012541'),
('eomoniyi245@gmail.com', 'eid_68b3577bf3468030949362', 'qid_68b357be0cb080.84538009', 'opt_68b357be0dee87.02960449'),
('eomoniyi245@gmail.com', 'eid_68b416efa4e0d191870238', 'qid_68b4170f5b69c4.99048195', 'opt_68b4170f5d7cd6.70618558'),
('eomoniyi245@gmail.com', 'eid_68b41cf3d87ec109597764', 'qid_68b41d11a31131.60950548', 'opt_68b41d11a3bb32.89642413'),
('eomoniyi245@gmail.com', 'eid_68b41cf3d87ec109597764', 'qid_68b41d11a7f3b5.80738853', 'opt_68b41d11a86887.96029786'),
('eomoniyi245@gmail.com', 'eid_68b42ac6cdb3f645346663', 'qid_68b42ae6178b37.73782080', 'opt_68b42ae618aa04.44933782'),
('eomoniyi245@gmail.com', 'eid_68b42ac6cdb3f645346663', 'qid_68b42ae62080d2.52517616', 'opt_68b42ae6212a58.93467105'),
('eomoniyi245@gmail.com', 'eid_68b42b69ead7e272949971', 'qid_68b42b8891e424.52654535', ''),
('eomoniyi245@gmail.com', 'eid_68b42e08f04c0774847085', 'qid_68b42e736ba1c9.18250891', 'opt_68b42e736c9203.86141209'),
('eomoniyi245@gmail.com', 'eid_68b43641a52f1910227930', 'qid_68b436a0c3d006.21891567', 'opt_68b436a0c828b6.55957319'),
('eomoniyi245@gmail.com', 'eid_68b43641a52f1910227930', 'qid_68b436a0cab845.40002809', 'opt_68b436a0cc5720.02198015'),
('eomoniyi245@gmail.com', 'eid_68b437ae0d84d205520310', 'qid_68b437ca7677f2.12675280', 'opt_68b437ca77ea94.63909556'),
('eomoniyi245@gmail.com', 'eid_68b43a2bb2c39904941526', 'qid_68b43a801fd338.64312244', 'opt_68b43a8020e0f5.54169689'),
('eomoniyi245@gmail.com', 'eid_68b43a2bb2c39904941526', 'qid_68b43a8028a9e8.45970983', 'opt_68b43a802c9ab4.07170297');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `option`, `optionid`) VALUES
('qid_68b373dcb014d7.52693907', 'Respiration', 'opt_68b373dcb0f861.29474218'),
('qid_68b373dcb014d7.52693907', 'Compassion', 'opt_68b373dcb17e45.78701198'),
('qid_68b373dcb014d7.52693907', 'Reproduction', 'opt_68b373dcb20136.67337718'),
('qid_68b373dcb014d7.52693907', 'Movement', 'opt_68b373dcb48bc3.40684319'),
('qid_68b373dcb586e1.51969371', 'resistor of a battery', 'opt_68b373dcb60467.23568659'),
('qid_68b373dcb586e1.51969371', 'smallest part of the human body', 'opt_68b373dcb72284.31362101'),
('qid_68b373dcb586e1.51969371', 'power of a battery', 'opt_68b373dcb81774.37348234'),
('qid_68b373dcb586e1.51969371', 'structural and functional unit of life', 'opt_68b373dcb89b84.94578384'),
('qid_68b3776e4ee881.49110943', 'Gregor Mendel', 'opt_68b3776e4fdc16.93168938'),
('qid_68b3776e4ee881.49110943', 'Isaac Newton', 'opt_68b3776e5090e8.80975866'),
('qid_68b3776e4ee881.49110943', 'Jean Lamarck', 'opt_68b3776e52fb85.61207053'),
('qid_68b3776e4ee881.49110943', 'Charles Darwin', 'opt_68b3776e53af84.10964973'),
('qid_68b3776e584cc1.18505970', 'life', 'opt_68b3776e59bdf1.35986968'),
('qid_68b3776e584cc1.18505970', 'smallest part of the human body', 'opt_68b3776e5dd186.20768966'),
('qid_68b3776e584cc1.18505970', 'power of a battery', 'opt_68b3776e5f3133.51211010'),
('qid_68b3776e584cc1.18505970', 'structural and functional unit of life', 'opt_68b3776e605a33.64023897'),
('qid_68b3790695b067.38246766', 'Jonathan', 'opt_68b379069716e4.56819482'),
('qid_68b3790695b067.38246766', 'Ella', 'opt_68b3790698e153.68042401'),
('qid_68b3790695b067.38246766', 'Bella', 'opt_68b37906996dd9.66379560'),
('qid_68b3790695b067.38246766', 'Rhoda', 'opt_68b3790699fc10.81293343'),
('qid_68b379069dd901.45200236', 'Emmanuella', 'opt_68b379069e5ad2.37525648'),
('qid_68b379069dd901.45200236', 'Benelus', 'opt_68b37906a160e8.11465474'),
('qid_68b379069dd901.45200236', 'Emmanuel', 'opt_68b37906a1e141.21453892'),
('qid_68b379069dd901.45200236', 'Efe', 'opt_68b37906a264f7.22503904'),
('qid_68b412cbb3a8d2.17489190', 'study of life', 'opt_68b412cbb52927.03828536'),
('qid_68b412cbb3a8d2.17489190', 'human anatomy', 'opt_68b412cbb6c8c3.57723935'),
('qid_68b412cbb3a8d2.17489190', 'Saviour', 'opt_68b412cbb74934.57190381'),
('qid_68b412cbb3a8d2.17489190', 'not yet tested', 'opt_68b412cbb7f5a9.76431328'),
('qid_68b4170f5b69c4.99048195', 'study of life', 'opt_68b4170f5c62f1.71904049'),
('qid_68b4170f5b69c4.99048195', 'human anatomy', 'opt_68b4170f5ceab7.45260425'),
('qid_68b4170f5b69c4.99048195', 'power of  a battery', 'opt_68b4170f5d7cd6.70618558'),
('qid_68b4170f5b69c4.99048195', 'not yet tested', 'opt_68b4170f5e8dd0.30893722'),
('qid_68b4170f5facf3.44186588', 'life', 'opt_68b4170f604159.25044949'),
('qid_68b4170f5facf3.44186588', 'gxfhgcjvkb', 'opt_68b4170f617605.62050130'),
('qid_68b4170f5facf3.44186588', 'dgfhgjh', 'opt_68b4170f6363e1.25305395'),
('qid_68b4170f5facf3.44186588', 'study of electricity', 'opt_68b4170f6416e7.42905219'),
('qid_68b418d43ada84.22633118', 'study of life', 'opt_68b418d43bb2d7.45719758'),
('qid_68b418d43ada84.22633118', 'Isaac Newton', 'opt_68b418d43c38c1.27049474'),
('qid_68b418d43ada84.22633118', '5', 'opt_68b418d43cc707.43325833'),
('qid_68b418d43ada84.22633118', 'not yet tested', 'opt_68b418d43e27b1.52707072'),
('qid_68b41d11a31131.60950548', 'structural and functional unit of life', 'opt_68b41d11a3bb32.89642413'),
('qid_68b41d11a31131.60950548', 'Isaac Newton', 'opt_68b41d11a46137.77577016'),
('qid_68b41d11a31131.60950548', 'Saviour', 'opt_68b41d11a4fbf6.05667833'),
('qid_68b41d11a31131.60950548', 'not yet tested', 'opt_68b41d11a57ef1.53323038'),
('qid_68b41d11a7f3b5.80738853', 'Duldbxk', 'opt_68b41d11a86887.96029786'),
('qid_68b41d11a7f3b5.80738853', 'sea', 'opt_68b41d11a97762.72511182'),
('qid_68b41d11a7f3b5.80738853', 'land', 'opt_68b41d11a9e9a9.05593500'),
('qid_68b41d11a7f3b5.80738853', 'Omoniyi', 'opt_68b41d11aabf14.38009729'),
('qid_68b42ae6178b37.73782080', 'study of life', 'opt_68b42ae618aa04.44933782'),
('qid_68b42ae6178b37.73782080', 'human anatomy', 'opt_68b42ae6193390.98891627'),
('qid_68b42ae6178b37.73782080', 'Saviour', 'opt_68b42ae61ab550.44816669'),
('qid_68b42ae6178b37.73782080', 'not yet tested', 'opt_68b42ae61d7b26.65543319'),
('qid_68b42ae62080d2.52517616', 'Ella', 'opt_68b42ae6212a58.93467105'),
('qid_68b42ae62080d2.52517616', 'gxfhgcjvkb', 'opt_68b42ae6226fc5.41601707'),
('qid_68b42ae62080d2.52517616', 'Emmanuel', 'opt_68b42ae622f914.15545685'),
('qid_68b42ae62080d2.52517616', 'study of electricity', 'opt_68b42ae6239751.84653774'),
('qid_68b42b8891e424.52654535', 'Gregor Mendel', 'opt_68b42b8892c3b1.91988524'),
('qid_68b42b8891e424.52654535', 'Isaac Newton', 'opt_68b42b889427a8.97298767'),
('qid_68b42b8891e424.52654535', 'Jean Lamarck', 'opt_68b42b8895d861.33299976'),
('qid_68b42b8891e424.52654535', 'Charles Darwin', 'opt_68b42b88972366.47711229'),
('qid_68b42e736ba1c9.18250891', 'yes', 'opt_68b42e736c9203.86141209'),
('qid_68b42e736ba1c9.18250891', 'not sure', 'opt_68b42e736d3272.04899572'),
('qid_68b42e736ba1c9.18250891', '5', 'opt_68b42e736e8284.70629501'),
('qid_68b42e736ba1c9.18250891', 'not yet tested', 'opt_68b42e736f5883.48901537'),
('qid_68b42e7370bba2.46789690', 'Eye', 'opt_68b42e73714fe5.95751305'),
('qid_68b42e7370bba2.46789690', 'gxfhgcjvkb', 'opt_68b42e7372cc28.75844459'),
('qid_68b42e7370bba2.46789690', '6', 'opt_68b42e73737085.82150938'),
('qid_68b42e7370bba2.46789690', 'study of electricity', 'opt_68b42e7374ac04.21105363'),
('qid_68b436a0c3d006.21891567', 'A king', 'opt_68b436a0c4d877.65286956'),
('qid_68b436a0c3d006.21891567', 'A soilder', 'opt_68b436a0c77f47.14986858'),
('qid_68b436a0c3d006.21891567', 'A prophet', 'opt_68b436a0c828b6.55957319'),
('qid_68b436a0c3d006.21891567', 'A Singer', 'opt_68b436a0c8bb92.55436177'),
('qid_68b436a0cab845.40002809', 'David', 'opt_68b436a0cc5720.02198015'),
('qid_68b436a0cab845.40002809', 'Samson', 'opt_68b436a0cd1c27.01933294'),
('qid_68b436a0cab845.40002809', 'Saul', 'opt_68b436a0cdb825.50315051'),
('qid_68b436a0cab845.40002809', 'Solomon', 'opt_68b436a0cf66d9.12912255'),
('qid_68b437ca7677f2.12675280', 'Heavenly Father', 'opt_68b437ca77ea94.63909556'),
('qid_68b437ca7677f2.12675280', 'Isaac Newton', 'opt_68b437ca789f99.45476442'),
('qid_68b437ca7677f2.12675280', 'power of  a battery', 'opt_68b437ca7908e8.10644293'),
('qid_68b437ca7677f2.12675280', 'study of man and animals', 'opt_68b437ca799f12.30312519'),
('qid_68b437ca7ab586.96883916', 'Duldbxk', 'opt_68b437ca7b3f00.86564288'),
('qid_68b437ca7ab586.96883916', 'system', 'opt_68b437ca7c0b95.09152548'),
('qid_68b437ca7ab586.96883916', 'study of animals', 'opt_68b437ca7cbd74.88043042'),
('qid_68b437ca7ab586.96883916', 'Dioxobunucleicacid', 'opt_68b437ca7d3961.76962469'),
('qid_68b43a801fd338.64312244', 'dcdgc', 'opt_68b43a8020e0f5.54169689'),
('qid_68b43a801fd338.64312244', 'tvdinvfd', 'opt_68b43a802309a1.30749396'),
('qid_68b43a801fd338.64312244', '5', 'opt_68b43a8024cad1.89716515'),
('qid_68b43a801fd338.64312244', 'study of man and animals', 'opt_68b43a80265749.50661154'),
('qid_68b43a8028a9e8.45970983', 'Eye', 'opt_68b43a802c9ab4.07170297'),
('qid_68b43a8028a9e8.45970983', 'study of life', 'opt_68b43a802d8ea0.41258924'),
('qid_68b43a8028a9e8.45970983', '6', 'opt_68b43a8030ead3.78423297'),
('qid_68b43a8028a9e8.45970983', 'study of electricity', 'opt_68b43a80337bd8.57163347');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('eid_68b37315c7c06974166789', 'qid_68b373dcb014d7.52693907', 'Which of these is not a characteristics of living things', 0, 1),
('eid_68b37315c7c06974166789', 'qid_68b373dcb586e1.51969371', 'What is a cell?', 0, 2),
('eid_68b377243cfa0982276389', 'qid_68b3776e4ee881.49110943', 'Who is referred to as the father of genetics', 0, 1),
('eid_68b377243cfa0982276389', 'qid_68b3776e584cc1.18505970', 'What is a cell?', 0, 2),
('eid_68b378850b034237252487', 'qid_68b3790695b067.38246766', 'who is a boy', 0, 1),
('eid_68b378850b034237252487', 'qid_68b379069dd901.45200236', 'Who is a girl', 0, 2),
('eid_68b412bcf2bc2465956995', 'qid_68b412cbb3a8d2.17489190', 'who is a boy', 0, 1),
('eid_68b416efa4e0d191870238', 'qid_68b4170f5b69c4.99048195', 'who is a boy', 0, 1),
('eid_68b416efa4e0d191870238', 'qid_68b4170f5facf3.44186588', 'who is a girl', 0, 2),
('eid_68b418c436f10758142082', 'qid_68b418d43ada84.22633118', 'who is a boy', 0, 1),
('eid_68b41cf3d87ec109597764', 'qid_68b41d11a31131.60950548', 'who is a boy', 0, 1),
('eid_68b41cf3d87ec109597764', 'qid_68b41d11a7f3b5.80738853', 'who is a girl', 0, 2),
('eid_68b42ac6cdb3f645346663', 'qid_68b42ae6178b37.73782080', 'who is a boy', 0, 1),
('eid_68b42ac6cdb3f645346663', 'qid_68b42ae62080d2.52517616', 'who is a girl', 0, 2),
('eid_68b42b69ead7e272949971', 'qid_68b42b8891e424.52654535', 'Who is referred to as the father of genetics', 0, 1),
('eid_68b42e08f04c0774847085', 'qid_68b42e736ba1c9.18250891', 'who is  a girl', 0, 1),
('eid_68b42e08f04c0774847085', 'qid_68b42e7370bba2.46789690', 'who is a boy', 0, 2),
('eid_68b43641a52f1910227930', 'qid_68b436a0c3d006.21891567', 'who was Samuel', 0, 1),
('eid_68b43641a52f1910227930', 'qid_68b436a0cab845.40002809', 'who killed Goliath', 0, 2),
('eid_68b437ae0d84d205520310', 'qid_68b437ca7677f2.12675280', 'who is a boy', 0, 1),
('eid_68b437ae0d84d205520310', 'qid_68b437ca7ab586.96883916', 'deefcrbv', 0, 2),
('eid_68b43a2bb2c39904941526', 'qid_68b43a801fd338.64312244', 'ycvuhlducy', 0, 1),
('eid_68b43a2bb2c39904941526', 'qid_68b43a8028a9e8.45970983', 'dvyuluf', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `intro` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `subject`, `sahi`, `wrong`, `total`, `time`, `intro`, `tag`, `date`) VALUES
('eid_68b37315c7c06974166789', 'Living Things', 'biology', 5, 5, 2, 5, '', '', '2025-08-30 21:54:29'),
('eid_68b377243cfa0982276389', 'Test01', 'Biology', 1, 1, 2, 5, '', '', '2025-08-30 22:11:48'),
('eid_68b378850b034237252487', 'Test02', 'Other', 1, 1, 2, 5, '', '', '2025-08-30 22:17:41'),
('eid_68b412bcf2bc2465956995', 'Test05', 'Other', 1, 1, 1, 5, '', '', '2025-08-31 09:15:40'),
('eid_68b416efa4e0d191870238', 'Test06', 'Physics', 1, 1, 2, 6, '', '', '2025-08-31 09:33:35'),
('eid_68b418c436f10758142082', 'Test07', 'Biology', 1, 0, 1, 20, '', '', '2025-08-31 09:41:24'),
('eid_68b41cf3d87ec109597764', 'Test07', 'Chemistry', 1, 1, 2, 8, '', '', '2025-08-31 09:59:15'),
('eid_68b42ac6cdb3f645346663', 'Test08', 'Mathematics', 1, 1, 2, 5, '', '', '2025-08-31 10:58:14'),
('eid_68b42b69ead7e272949971', 'Test09', 'Biology', 5, 5, 1, 5, '', '', '2025-08-31 11:00:57'),
('eid_68b42e08f04c0774847085', 'Test10', 'English', 1, 1, 2, 5, '', '', '2025-08-31 11:12:08'),
('eid_68b43641a52f1910227930', 'Test11', 'Mathematics', 1, 1, 2, 5, '', '', '2025-08-31 11:47:13'),
('eid_68b437ae0d84d205520310', 'Test12', 'Chemistry', 5, 5, 2, 5, '', '', '2025-08-31 11:53:18'),
('eid_68b43a2bb2c39904941526', 'Test13', 'Mathematics', 1, 0, 2, 5, '', '', '2025-08-31 12:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('sunnygkp10@gmail.com', 4, '2025-08-28 22:59:01'),
('avantika420@gmail.com', 8, '2015-06-23 14:49:39'),
('mi5@hollywood.com', 4, '2015-06-23 15:12:56'),
('nik1@gmail.com', 1, '2015-06-23 16:11:50'),
('eomoniyi245@gmail.com', 14, '2025-08-31 12:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `college` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `gender`, `college`, `email`, `mob`, `password`, `role`) VALUES
('Avantika', 'F', 'KNIT sultanpur', 'avantika420@gmail.com', 7785068889, 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('Mark Zukarburg', 'M', 'Stanford', 'ceo@facebook.com', 987654321, 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('Omoniyi Emmanuel', 'M', 'FUPRE', 'eomoniyi245@gmail.com', 8055311844, 'c9b627a6a752e5dcf992644d4ccb903f', 'user'),
('Komal', 'F', 'KNIT sultanpur', 'komalpd2011@gmail.com', 7785068889, 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('Tom Cruze', 'M', 'Hollywood', 'mi5@hollywood.com', 7785068889, 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('Netcamp', 'M', 'KNIT sultanpur', 'netcamp@gmail.com', 987654321, 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('Nikunj', 'M', 'XYZ', 'nik1@gmail.com', 987, '202cb962ac59075b964b07152d234b70', 'user'),
('Sunny', 'M', 'KNIT sultanpur', 'sunnygkp10@gmail.com', 7785068889, 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
('User', 'M', 'cimt', 'user@user.com', 11, 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('Vikash', 'M', 'KNIT sultanpur@gmail.com', 'vikash@gmail.com', 7785068889, 'e10adc3949ba59abbe56e057f20f883e', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `history_answers`
--
ALTER TABLE `history_answers`
  ADD PRIMARY KEY (`email`,`eid`,`qid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
