-- phpMyAdmin SQL Dump
-- version 4.2.0-beta1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-17 05:29:24
-- 服务器版本： 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `next_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `b_book`
--

CREATE TABLE IF NOT EXISTS `b_book` (
`book_id` int(11) NOT NULL COMMENT '书id',
  `b_isbn` char(13) NOT NULL COMMENT '书isbn',
  `b_title` varchar(40) NOT NULL COMMENT '书名',
  `b_publisher` varchar(50) DEFAULT NULL COMMENT '出版社',
  `b_author` varchar(50) DEFAULT NULL COMMENT '作者',
  `b_translator` varchar(50) DEFAULT NULL COMMENT '译者',
  `b_img` varchar(200) DEFAULT NULL COMMENT '图片',
  `b_summary` varchar(500) DEFAULT NULL COMMENT '摘要',
  `category_id` int(11) NOT NULL COMMENT '分类id'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='书籍表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `b_book`
--

INSERT INTO `b_book` (`book_id`, `b_isbn`, `b_title`, `b_publisher`, `b_author`, `b_translator`, `b_img`, `b_summary`, `category_id`) VALUES
(14, '9787533887674', '考研英语词汇词根+联想记忆法', '浙江教育', '俞敏洪', '', '/uploads/2015/06/oZ28x55xzlMnr69m.jpg', '《新东方·考研英语词汇词根+联想记忆法(便携版)》科学统计，词频排序，助你走出记忆怪圈，全面瘦身，小巧轻便，随时随地背诵单词，标记重点，直击考点，复习记忆有的放矢，新鲜元素，记忆加速，优化升级助记方法。', 1),
(15, '9787515013107', '考研数学复习全书（数学一）', '国家行政学院出版社', '李永乐 王式安 季文铎', '', '/uploads/2015/06/k4vqMSlXqkC5iKns.jpg', '', 2),
(16, '9787115293800', '算法（第4版）', '人民邮电出版社', '塞奇威克 (Robert Sedgewick) 韦恩 (Kevin Wayne)', '', '/uploads/2015/06/uqybTYCBvS3ymuFV.jpg', '本书全面讲述算法和数据结构的必备知识，具有以下几大特色。\n     算法领域的经典参考书\nSedgewick畅销著作的最新版，反映了经过几十年演化而成的算法核心知识体系\n 内容全面\n全面论述排序、搜索、图处理和字符串处理的算法和数据结构，涵盖每位程序员应知应会的50种算法\n 全新修订的代码\n全新的Java实现代码，采用模块化的编程风格，所有代码均可供读者使用\n 与实际应用相结合\n在重要的科学、工程和商业应用环境下探讨算法，给出了算法的实际代码，而非同类著作常用的伪代码\n 富于智力趣味性\n简明扼要的内容，用丰富的视觉元素展示的示例，精心设计的代码，详尽的历史和科学背景知识，各种难度的练习，这一切都将使读者手不释卷\n       科学的方法\n用合适的数学模型精确地讨论算法性能，这些模型是在真实环境中得到验证的\n 与网络相结合\n配套网站algs4.cs.princeton.edu提供了本书内容的摘要及相关的代码、测试数据、编程练习、教学课件等资源', 3),
(17, '9787111338291', 'Linux内核设计与实现', '机械工业出版社华章公司', 'Robert Love', '', '/uploads/2015/07/BktTICfSXpcLuXcM.jpg', '《Linux内核设计与实现(原书第3版)》详细描述了Linux内核的设计与实现。内核代码的编写者、开发者以及程序开发人员都可以通过阅读本书受益，他们可以更好理解操作系统原理，并将其应用在自己的编码中以提高效率和生产率。\n《Linux内核设计与实现(原书第3版)》详细描述了Linux内核的主要子系统和特点，包括Linux内核的设计、实现和接口。从理论到实践涵盖了Linux内核的方方面面，可以满足读者的各种兴趣和需求。\n作者Robert Love是一位Linux内核核心开发人员，他分享了在开发Linux 2.6内核过程中颇具价值的知识和经验。本书的主题包括进程管理、进程调度、时间管理和定时器、系统调用接口、内存寻址、内存管理和页缓存、VFS、内核同步、移植性相关的问题以及调试技术。同时本书也涵盖了Linux 2.6内核中颇具特色的内容，包括CFS调度程序、抢占式内核、块I/O层以及I/O调度程序。\n《Linux内核设计与实现(原书第3版)》新增内容包括：\n增加一章专门描述内核数据结构\n详细描述中断处理程序和下半部机制\n扩充虚拟内存和内存分配的内容\n调试Linux内核的技巧\n内核同步和锁机制', 1),
(18, '123456', 'ceshishu', 'mc', 'wu', 'wo', '\\/uploads\\/2015\\/05\\/2b19b06578f3363aedc8684c2e30873c.jpg', 'meiyou', 1);

-- --------------------------------------------------------

--
-- 表的结构 `b_category`
--

CREATE TABLE IF NOT EXISTS `b_category` (
`category_id` int(11) NOT NULL COMMENT '类别id',
  `c_name` varchar(20) NOT NULL COMMENT '类别名'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='书籍类别表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `b_category`
--

INSERT INTO `b_category` (`category_id`, `c_name`) VALUES
(1, '文学'),
(2, '传记'),
(3, '历史'),
(4, '计算机'),
(5, '外语');

-- --------------------------------------------------------

--
-- 表的结构 `r_deal_record`
--

CREATE TABLE IF NOT EXISTS `r_deal_record` (
`record_id` int(11) NOT NULL COMMENT '记录id',
  `sender_uid` int(11) NOT NULL COMMENT '送出者id',
  `book_id` int(11) NOT NULL COMMENT '送出书id',
  `dr_explain` varchar(200) DEFAULT NULL COMMENT '送出说明',
  `dr_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `dr_bid_uid` varchar(50) DEFAULT NULL COMMENT '想要的人id',
  `recipient_uid` int(11) NOT NULL DEFAULT '0' COMMENT '选定的人id',
  `dr_status` int(2) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='交易记录' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `r_deal_record`
--

INSERT INTO `r_deal_record` (`record_id`, `sender_uid`, `book_id`, `dr_explain`, `dr_time`, `dr_bid_uid`, `recipient_uid`, `dr_status`) VALUES
(10, 1, 14, '用着还行，经常看看', '2015-06-05 12:53:55', '5', 5, 0),
(11, 2, 15, '新版考研数学全集，讲解挺到位的', '2015-06-05 12:59:46', '7,8,1', 0, 0),
(12, 5, 16, '简明易懂的算法书籍', '2015-06-05 13:00:51', '1', 0, 0),
(13, 1, 17, '哈哈哈', '2015-07-18 18:51:53', NULL, 0, 0),
(14, 2, 18, 'meiyoushuoming', '2015-08-06 22:33:15', NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `r_experience_record`
--

CREATE TABLE IF NOT EXISTS `r_experience_record` (
`record_id` int(11) NOT NULL COMMENT '记录id',
  `sender_uid` int(11) NOT NULL COMMENT '送出者id',
  `er_explain` varchar(200) NOT NULL DEFAULT '' COMMENT '送出说明',
  `er_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `er_status` int(1) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `r_experience_record`
--

INSERT INTO `r_experience_record` (`record_id`, `sender_uid`, `er_explain`, `er_time`, `er_status`) VALUES
(5, 6, '保研中山大学', '2015-06-05 13:05:15', 0),
(6, 1, '拿到华为、美团等offer', '2015-06-05 13:06:07', 0);

-- --------------------------------------------------------

--
-- 表的结构 `r_experience_reply`
--

CREATE TABLE IF NOT EXISTS `r_experience_reply` (
`reply_id` int(11) NOT NULL COMMENT '回复记录id',
  `record_id` int(11) NOT NULL COMMENT '所属交易id',
  `sender_id` int(11) NOT NULL COMMENT '发布者id',
  `replied_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复的评论的id',
  `rp_content` varchar(200) DEFAULT NULL COMMENT '内容',
  `rp_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '回复时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `r_reply`
--

CREATE TABLE IF NOT EXISTS `r_reply` (
`reply_id` int(11) NOT NULL COMMENT '回复记录id',
  `record_id` int(11) NOT NULL COMMENT '所属交易id',
  `sender_id` int(11) NOT NULL COMMENT '发布者id',
  `replied_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复的评论的id',
  `rp_content` varchar(200) DEFAULT NULL COMMENT '内容',
  `rp_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '回复时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `u_college`
--

CREATE TABLE IF NOT EXISTS `u_college` (
`college_id` int(11) NOT NULL COMMENT '院系id',
  `cl_name` varchar(100) NOT NULL COMMENT '院系名称'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `u_college`
--

INSERT INTO `u_college` (`college_id`, `cl_name`) VALUES
(1, '湘雅医学院'),
(2, '地球科学与信息物理学院'),
(3, '信息科学与工程学院'),
(4, '交通运输工程学院'),
(5, '土木工程学院'),
(6, '化学化工学院'),
(7, '资源与安全工程学院'),
(8, '外国语学院'),
(9, '建筑与艺术学院'),
(10, '商学院'),
(11, '能源科学与工程学院'),
(12, '法学院'),
(13, '机电工程学院'),
(14, '数学与统计学院'),
(15, '资源加工与生物工程学院'),
(16, '文学院'),
(17, '冶金与环境学院'),
(18, '软件学院'),
(19, '信息物理工程学院'),
(20, '口腔医学院'),
(21, '体育教研部'),
(22, '航空航天学院'),
(23, '材料科学与工程学院'),
(24, '粉末冶金研究院'),
(25, '马克思主义学院'),
(26, '公共管理学院'),
(27, '药学院'),
(28, '物理与电子学院'),
(29, '护理学院'),
(30, '生命科学学院'),
(31, '公共卫生学院'),
(32, '医学检验系'),
(33, '基础医学院'),
(34, '医药信息系');

-- --------------------------------------------------------

--
-- 表的结构 `u_major`
--

CREATE TABLE IF NOT EXISTS `u_major` (
`major_id` int(11) NOT NULL COMMENT '专业id',
  `mj_name` varchar(100) NOT NULL COMMENT '专业名',
  `college_id` int(11) NOT NULL COMMENT '院系id'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=229 ;

--
-- 转存表中的数据 `u_major`
--

INSERT INTO `u_major` (`major_id`, `mj_name`, `college_id`) VALUES
(1, '电气信息类', 3),
(2, '交通运输类', 4),
(3, '土建类（2010本科）', 5),
(4, '采矿工程', 7),
(5, '安全工程', 7),
(6, '无机非金属材料工程', 15),
(7, '冶金工程', 17),
(8, '机械设计制造及其自动化', 13),
(9, '通信工程', 3),
(10, '信息安全', 3),
(12, '化学工程与工艺', 6),
(13, '应用化学', 6),
(14, '工商管理', 10),
(15, '思想政治教育', 25),
(16, '精神医学', 1),
(17, '口腔医学(五年制)', 20),
(18, '社会学', 26),
(19, '新能源科学与工程', 11),
(20, '矿物与材料类', 15),
(21, '材料科学与工程', 23),
(22, '预防医学', 31),
(23, '劳动与社会保障', 26),
(24, '新能源材料与器件', 17),
(25, '软件工程', 18),
(26, '化工与制药类', 6),
(27, '城市地下空间工程', 7),
(28, '材料中澳', 23),
(29, '自动化', 3),
(30, '计算机科学与技术', 3),
(31, '电子信息工程', 3),
(32, '工程管理（本科）', 5),
(33, '工程力学（本科）', 5),
(34, '消防工程（本科）', 5),
(35, '数学与应用数学', 14),
(36, '信息与计算科学', 14),
(37, '制药工程', 6),
(38, '会计学', 10),
(39, '国际经济与贸易', 10),
(40, '英语', 8),
(41, '法学', 12),
(42, '临床医学(五年制)', 1),
(43, '管理学类', 10),
(44, '机械类', 13),
(45, '地质工程(T)', 2),
(46, '矿物加工工程(T)', 15),
(47, '视觉传达设计', 9),
(48, '护理学', 29),
(49, '智能科学与技术', 3),
(50, '环境设计', 9),
(51, '经济与管理类', 10),
(52, '生物医学工程', 2),
(53, '地球信息科学与技术', 2),
(54, '粉体材料科学与工程', 24),
(55, '电气工程及其自动化', 3),
(56, '信息管理与信息系统', 10),
(57, '汉语言文学', 16),
(58, '音乐表演', 9),
(59, '临床医学(八年)', 1),
(60, '热能与动力工程', 11),
(61, '测控技术与仪器', 3),
(62, '医学检验技术', 32),
(63, '行政管理', 26),
(64, '车辆工程', 13),
(65, '广播电视学', 16),
(66, '光电信息科学与工程', 28),
(67, '产品设计', 9),
(68, '生物技术', 15),
(69, '材料化学', 24),
(70, '药学', 27),
(71, '法学类', 12),
(72, '中国语言文学类', 16),
(73, '电子信息科学与技术', 28),
(74, '采矿工程(T)', 7),
(75, '高分子材料与工程', 24),
(76, '城乡规划', 9),
(77, '建筑环境与能源应用工程', 11),
(78, '建筑学', 9),
(79, '微电子科学与工程', 13),
(80, '麻醉学', 1),
(81, '统计学', 14),
(82, '地质工程', 2),
(83, '法语', 8),
(84, '测绘地理信息类', 2),
(85, '冶金与新能源类', 17),
(86, '能源与动力工程', 11),
(87, '地球科学类', 2),
(88, '物理与电子科学类', 28),
(89, '生物工程', 15),
(90, '环境工程', 17),
(91, '应用物理学', 28),
(92, '财务管理', 10),
(93, '金融学', 10),
(94, '日语', 8),
(95, '生物科学', 30),
(96, '航空航天工程', 22),
(97, '市场营销', 10),
(98, '物联网工程', 3),
(99, '矿物加工工程', 15),
(100, '电子商务', 10),
(101, '工商管理（高水平运动）', 10),
(102, '生物信息学', 34),
(103, '运动训练', 21),
(104, '数学科学班', 14),
(105, '探测制导与控制技术', 22),
(106, '西班牙语', 8),
(107, '医学检验', 1),
(108, '医学类(五年制)', 1),
(109, '化学工程与工艺(T)', 6),
(110, '交通运输(T)', 4),
(111, '口腔医学(七年)', 20),
(112, '经济学类', 10),
(113, '复合材料', 22),
(114, '艺术类', 9),
(201, '工程力学（博士080104）', 5),
(116, '机械设计制造及其自动化(T)', 13),
(117, '材料科学与工程(T)', 23),
(118, '电气工程及其自动化(T)', 3),
(119, '测绘工程(T)', 2),
(120, '软件工程(T)', 18),
(121, '护理学类', 27),
(122, '冶金工程(T)', 17),
(123, '粉体材料科学与工程(T)', 24),
(124, '公共管理类', 26),
(125, '建筑学类', 9),
(126, '环境与安全类', 17),
(127, '热能与动力工程(T)', 11),
(128, '药学类', 27),
(129, '生物科学类', 30),
(130, '预防医学类', 31),
(131, '医学信息学', 1),
(132, '生物工程类', 15),
(133, '临床医学与医学技术类（五年制）', 1),
(134, '工业设计', 9),
(135, '音乐表演类', 9),
(136, '口腔医学类（七年制）', 20),
(137, '口腔医学类（五年制）', 20),
(138, '政治学类', 25),
(139, '信息物理工程类', 19),
(140, '冶金与环境类', 17),
(141, '软件工程类', 18),
(142, '口腔医学类', 20),
(143, '新能源科学与工程', 11),
(145, '环艺设计', 9),
(146, '视觉传达', 9),
(147, '数字媒体', 9),
(149, '医学类(八年制)', 1),
(150, '交通运输', 4),
(154, '土木工程（本科）', 5),
(152, '交通设备信息工程', 4),
(153, '物流工程', 4),
(204, '防灾减灾工程与防护工程（博士081405）', 5),
(202, '岩土工程（博士081401）', 5),
(228, '交通中澳', 4),
(203, '结构工程（博士081402）', 5),
(162, '数学类', 14),
(163, '美术类', 9),
(164, '能源动力类', 11),
(165, '临床八年', 3),
(166, '通信工程', 3),
(167, '电子信息', 3),
(168, '数字出版', 16),
(169, '测绘工程', 2),
(170, '交通设备与控制工程', 4),
(171, '地理信息科学', 2),
(172, '遥感科学与技术', 2),
(173, '法医学', 33),
(174, '材料国际', 23),
(176, '材料类', 23),
(177, '微电子制造工程', 13),
(178, '建筑环境与设备工程', 11),
(205, '市政工程（博士081403）', 5),
(180, '地理信息系统', 2),
(181, '艺术设计', 9),
(200, '建筑类（2010本科）', 5),
(183, '计算机类', 3),
(184, '传播学', 1),
(185, '材料科学类', 23),
(186, '物理升华', 28),
(187, '化学升华', 6),
(188, '材料工程试验班', 23),
(189, '机电工程试验班', 13),
(191, '冶金工程试验班', 17),
(198, '精神卫生', 1);

-- --------------------------------------------------------

--
-- 表的结构 `u_user`
--

CREATE TABLE IF NOT EXISTS `u_user` (
`user_id` int(11) NOT NULL COMMENT '用户id',
  `u_phone` char(11) NOT NULL COMMENT '用户手机',
  `u_name` varchar(30) DEFAULT NULL COMMENT '昵称',
  `u_password` char(32) NOT NULL COMMENT '用户密码',
  `u_sex` int(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `college_id` int(11) NOT NULL DEFAULT '0' COMMENT '学院id',
  `major_id` int(11) NOT NULL DEFAULT '0' COMMENT '专业id',
  `u_specialty` varchar(60) DEFAULT NULL COMMENT '擅长',
  `u_logo` varchar(100) DEFAULT NULL COMMENT '用户头像'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `u_user`
--

INSERT INTO `u_user` (`user_id`, `u_phone`, `u_name`, `u_password`, `u_sex`, `college_id`, `major_id`, `u_specialty`, `u_logo`) VALUES
(1, '15522223333', '李依', 'c4ca4238a0b923820dcc509a6f75849b', 2, 7, 4, '', '/uploads/2015/05/111111.png'),
(2, '13566668888', '姚飞', 'c4ca4238a0b923820dcc509a6f75849b', 1, 7, 4, '睡觉', '/uploads/2015/05/KU201108170745250.jpg'),
(5, '15226262626', '任强正', 'c4ca4238a0b923820dcc509a6f75849b', 2, 8, 40, '我是美女', '/uploads/2015/05/logo.png'),
(6, '15288889999', '周之明', 'c4ca4238a0b923820dcc509a6f75849b', 1, 10, 56, '我是大神', '/uploads/2015/05/69bcb3bfjw1dyx81uhlelg.gif'),
(7, '15288887777', '侯晓元', 'c4ca4238a0b923820dcc509a6f75849b', 1, 11, 60, '我是大神', '/uploads/2015/05/1dqfn9j.jpg'),
(8, '18326262626', 'lc', 'c4ca4238a0b923820dcc509a6f75849b', 1, 8, 8, '士大夫1', '\\/uploads\\/2015\\/05\\/2b19b06578f3363aedc8684c2e30873c.jpg');

--
-- 触发器 `u_user`
--
DELIMITER //
CREATE TRIGGER `autoadd_college` BEFORE INSERT ON `u_user`
 FOR EACH ROW begin
select college_id into @collegeid from u_major where u_major.major_id=NEW.major_id;
set NEW.college_id = @collegeid;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 替换视图以便查看 `v_exp_record`
--
CREATE TABLE IF NOT EXISTS `v_exp_record` (
`record_id` int(11)
,`er_explain` varchar(200)
,`er_time` datetime
,`er_status` int(1)
,`sender_uid` int(11)
,`u_phone` char(11)
,`u_name` varchar(30)
,`u_sex` int(1)
,`college_id` int(11)
,`major_id` int(11)
,`u_specialty` varchar(60)
,`u_logo` varchar(100)
);
-- --------------------------------------------------------

--
-- 替换视图以便查看 `v_record`
--
CREATE TABLE IF NOT EXISTS `v_record` (
`record_id` int(11)
,`sender_uid` int(11)
,`dr_explain` varchar(200)
,`dr_time` datetime
,`dr_bid_uid` varchar(50)
,`recipient_uid` int(11)
,`dr_status` int(2)
,`book_id` int(11)
,`b_isbn` char(13)
,`b_title` varchar(40)
,`b_publisher` varchar(50)
,`b_author` varchar(50)
,`b_translator` varchar(50)
,`b_img` varchar(200)
,`b_summary` varchar(500)
,`category_id` int(11)
);
-- --------------------------------------------------------

--
-- 视图结构 `v_exp_record`
--
DROP TABLE IF EXISTS `v_exp_record`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exp_record` AS select `r_experience_record`.`record_id` AS `record_id`,`r_experience_record`.`er_explain` AS `er_explain`,`r_experience_record`.`er_time` AS `er_time`,`r_experience_record`.`er_status` AS `er_status`,`r_experience_record`.`sender_uid` AS `sender_uid`,`u_user`.`u_phone` AS `u_phone`,`u_user`.`u_name` AS `u_name`,`u_user`.`u_sex` AS `u_sex`,`u_user`.`college_id` AS `college_id`,`u_user`.`major_id` AS `major_id`,`u_user`.`u_specialty` AS `u_specialty`,`u_user`.`u_logo` AS `u_logo` from (`r_experience_record` join `u_user` on((`r_experience_record`.`sender_uid` = `u_user`.`user_id`)));

-- --------------------------------------------------------

--
-- 视图结构 `v_record`
--
DROP TABLE IF EXISTS `v_record`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_record` AS select `r_deal_record`.`record_id` AS `record_id`,`r_deal_record`.`sender_uid` AS `sender_uid`,`r_deal_record`.`dr_explain` AS `dr_explain`,`r_deal_record`.`dr_time` AS `dr_time`,`r_deal_record`.`dr_bid_uid` AS `dr_bid_uid`,`r_deal_record`.`recipient_uid` AS `recipient_uid`,`r_deal_record`.`dr_status` AS `dr_status`,`b_book`.`book_id` AS `book_id`,`b_book`.`b_isbn` AS `b_isbn`,`b_book`.`b_title` AS `b_title`,`b_book`.`b_publisher` AS `b_publisher`,`b_book`.`b_author` AS `b_author`,`b_book`.`b_translator` AS `b_translator`,`b_book`.`b_img` AS `b_img`,`b_book`.`b_summary` AS `b_summary`,`b_book`.`category_id` AS `category_id` from (`r_deal_record` join `b_book` on((`b_book`.`book_id` = `r_deal_record`.`book_id`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_book`
--
ALTER TABLE `b_book`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `b_category`
--
ALTER TABLE `b_category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `r_deal_record`
--
ALTER TABLE `r_deal_record`
 ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `r_experience_record`
--
ALTER TABLE `r_experience_record`
 ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `r_experience_reply`
--
ALTER TABLE `r_experience_reply`
 ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `r_reply`
--
ALTER TABLE `r_reply`
 ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `u_college`
--
ALTER TABLE `u_college`
 ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `u_major`
--
ALTER TABLE `u_major`
 ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `u_user`
--
ALTER TABLE `u_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_book`
--
ALTER TABLE `b_book`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '书id',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `b_category`
--
ALTER TABLE `b_category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类别id',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `r_deal_record`
--
ALTER TABLE `r_deal_record`
MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录id',AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `r_experience_record`
--
ALTER TABLE `r_experience_record`
MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录id',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `r_experience_reply`
--
ALTER TABLE `r_experience_reply`
MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复记录id';
--
-- AUTO_INCREMENT for table `r_reply`
--
ALTER TABLE `r_reply`
MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复记录id';
--
-- AUTO_INCREMENT for table `u_college`
--
ALTER TABLE `u_college`
MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '院系id',AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `u_major`
--
ALTER TABLE `u_major`
MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专业id',AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT for table `u_user`
--
ALTER TABLE `u_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
