-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-08 04:43:44
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamwork`
--

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `projectname` varchar(128) NOT NULL,
  `intro` varchar(256) DEFAULT '',
  `private` int(10) DEFAULT '0',
  `ownerid` int(11) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `project`
--

INSERT INTO `project` (`id`, `projectname`, `intro`, `private`, `ownerid`, `createdate`) VALUES
(19, '项目1', '这里是项目说明', 0, 1, '2017-07-08 03:48:56');

-- --------------------------------------------------------

--
-- 表的结构 `project_actor`
--

CREATE TABLE `project_actor` (
  `id` int(11) NOT NULL,
  `projectid` int(11) NOT NULL,
  `actorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `project_actor`
--

INSERT INTO `project_actor` (`id`, `projectid`, `actorid`) VALUES
(22, 19, 1),
(23, 19, 2);

-- --------------------------------------------------------

--
-- 表的结构 `project_trend`
--

CREATE TABLE `project_trend` (
  `id` int(11) NOT NULL,
  `eventinfo` varchar(256) NOT NULL,
  `createdate` datetime NOT NULL,
  `projectid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `project_trend`
--

INSERT INTO `project_trend` (`id`, `eventinfo`, `createdate`, `projectid`) VALUES
(37, '用户 user1 创建项目 项目1', '2017-07-08 03:48:56', 19),
(38, '用户 user1 添加任务 任务1', '2017-07-08 03:50:01', 19),
(39, '用户 user1 添加任务 任务2', '2017-07-08 03:50:09', 19),
(40, '用户 user1 添加任务 任务3', '2017-07-08 03:50:18', 19),
(41, '用户 user1 添加任务 任务4', '2017-07-08 03:50:53', 19),
(42, '用户 user1 修改了任务 任务2', '2017-07-08 03:51:03', 19),
(43, '用户 user1 修改了任务 任务1', '2017-07-08 03:51:56', 19),
(44, '用户 user1 添加项目成员 user2', '2017-07-08 03:59:14', 19);

-- --------------------------------------------------------

--
-- 表的结构 `share`
--

CREATE TABLE `share` (
  `id` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text,
  `createdate` datetime NOT NULL,
  `projectid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `share`
--

INSERT INTO `share` (`id`, `ownerid`, `title`, `content`, `createdate`, `projectid`) VALUES
(5, 1, '"Hotpatch"潜在的安全风险', 'IOS App的开发者们经常会出现这类问题：当一个新版本上线后发现存在一个严重的bug，有可能因为一个逻辑问题导致支付接口存在被薅羊毛的风险，这个时候能做的只能是赶快修复完安全问题并提交到appstore审核，在急忙推送用户尽快更新，避免为此导致的严重安全后果买单。为了解决此类问题遍有了实现给App应用”实时打补丁”这类方案，目前大致有两种主流的“热修复”的项目。\r\n\r\n根据基本原理可以分为下面两种，\r\n\r\n原理同为构建JS脚本与Object-C语言之间转换的桥梁。\r\n\r\n    WaxPatch(Lua调用OC)\r\n\r\n    JSPatch(Javascript调用OC)\r\n\r\n”热修复” 技术虽然极大的减少了开发者更新补丁的时间与商业成本，但却将Apple努力构建的安全生态系统——Apple Store对上架App的严格审查规则置于高风险下。通过这种技术可以在上线以后直接更新App原生代码，从而从某种意义上绕过了Apple Store的审查规则。\r\n0x01 原理分析\r\n\r\n这种手段是通过IOS内置的JavaScriptCore.framework 微型框架来实现的，它是Apple官方在IOS7以后推出的主要是用来提供一个在Objective-C中执行Javascript环境的一个框架。\r\n\r\nJSPatch并没有使用JSExport协议与OC代码进行互调，而是使用了JSBinding(Javascript与OC代码交互的接口)与Objective-C中的runtime(运行时)，采用了JavaScriptCore.framework框架作为解析javascript的引擎，与客户端的代码实时交互动态修改OC方法的一种方案。\r\n\r\n对客户端整个对象的转换流程如下：\r\n\r\n    使用JavaScriptCore.framework作为Javascript引擎解析JavaScript脚本，执行JavaSript代码并与Objective-C端的代码进行桥接。另一方面则是使用Objective-C runtime中的method swizzling的方式和ForwardInvocation消息转发机制使得在JavaScript脚本中可以调用任意Objective-C方法。\r\n', '2017-07-08 03:56:07', 19),
(6, 1, '用“世界上最好的编程语言”制作的敲诈者木马揭秘', '你永远叫不醒一个装睡的人。但，快递小哥可以！\r\n\r\n虽说是一句戏言，但确实多少反映出了快递在大家心中的重要性。如果你收到一个带有快递公司发来的电子邮件通知，你会不会也希望快点打开看看是不是哪个朋友给你寄了什么东西等着你去取呢？最近我们就收到了这样的一个带有“快递单号”的电子邮件附件。唯一有些水土不服的就是——在中国用FedEx的确实并不很多……大写的PITY……', '2017-07-08 03:57:48', 19);

-- --------------------------------------------------------

--
-- 表的结构 `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `taskname` varchar(128) NOT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `isrepeat` int(10) DEFAULT '0',
  `remark` text,
  `taskstatus` int(10) DEFAULT '0',
  `stepstatus` int(10) DEFAULT '0',
  `priority` int(10) DEFAULT '0',
  `private` int(10) DEFAULT '0',
  `createdate` datetime NOT NULL,
  `projectid` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `task`
--

INSERT INTO `task` (`id`, `taskname`, `deadline`, `isrepeat`, `remark`, `taskstatus`, `stepstatus`, `priority`, `private`, `createdate`, `projectid`, `ownerid`) VALUES
(66, '任务1', '2017-07-03 05:50:00', 0, '任务说明', 0, 0, 0, 0, '2017-07-08 03:50:01', 19, 1),
(67, '任务2', NULL, 0, NULL, 1, 1, 0, 0, '2017-07-08 03:50:09', 19, 1),
(68, '任务3', NULL, 0, NULL, 0, 2, 0, 0, '2017-07-08 03:50:18', 19, 1),
(69, '任务4', NULL, 0, NULL, 0, 0, 0, 0, '2017-07-08 03:50:53', 19, 1);

-- --------------------------------------------------------

--
-- 表的结构 `task_actor`
--

CREATE TABLE `task_actor` (
  `id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `actorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `task_actor`
--

INSERT INTO `task_actor` (`id`, `taskid`, `actorid`) VALUES
(60, 69, 1);

-- --------------------------------------------------------

--
-- 表的结构 `task_trend`
--

CREATE TABLE `task_trend` (
  `id` int(11) NOT NULL,
  `eventinfo` varchar(256) NOT NULL,
  `content` text,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `avatar` varchar(256) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `avatar`) VALUES
(1, 'user1', 'passwd', 'default.jpg'),
(2, 'user2', 'passwd', 'default.jpg'),
(3, 'user3', 'passwd', 'default.jpg'),
(4, 'user4', 'passwd', 'default.jpg'),
(6, 'denglintao', '123456', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_actor`
--
ALTER TABLE `project_actor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_pa` (`projectid`,`actorid`);

--
-- Indexes for table `project_trend`
--
ALTER TABLE `project_trend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_actor`
--
ALTER TABLE `task_actor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_ta_` (`taskid`,`actorid`);

--
-- Indexes for table `task_trend`
--
ALTER TABLE `task_trend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `project_actor`
--
ALTER TABLE `project_actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `project_trend`
--
ALTER TABLE `project_trend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- 使用表AUTO_INCREMENT `share`
--
ALTER TABLE `share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- 使用表AUTO_INCREMENT `task_actor`
--
ALTER TABLE `task_actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- 使用表AUTO_INCREMENT `task_trend`
--
ALTER TABLE `task_trend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
