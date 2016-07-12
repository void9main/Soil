# Host: localhost  (Version: 5.5.40)
# Date: 2016-07-09 15:41:46
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "sj_company"
#

DROP TABLE IF EXISTS `sj_company`;
CREATE TABLE `sj_company` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `type` varchar(10) DEFAULT NULL COMMENT 'common',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='公司内部表';

#
# Data for table "sj_company"
#

/*!40000 ALTER TABLE `sj_company` DISABLE KEYS */;
INSERT INTO `sj_company` VALUES (1,'','Soil系统上线运行，测试版本号vson1.0','common');
/*!40000 ALTER TABLE `sj_company` ENABLE KEYS */;

#
# Structure for table "sj_datalist"
#

DROP TABLE IF EXISTS `sj_datalist`;
CREATE TABLE `sj_datalist` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text COMMENT '表集合',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='表集合';

#
# Data for table "sj_datalist"
#

/*!40000 ALTER TABLE `sj_datalist` DISABLE KEYS */;
/*!40000 ALTER TABLE `sj_datalist` ENABLE KEYS */;

#
# Structure for table "sj_left"
#

DROP TABLE IF EXISTS `sj_left`;
CREATE TABLE `sj_left` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `list` varchar(255) DEFAULT NULL COMMENT '链接名称',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `type` varchar(255) DEFAULT NULL COMMENT '链接发起者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='侧边栏';

#
# Data for table "sj_left"
#

/*!40000 ALTER TABLE `sj_left` DISABLE KEYS */;
INSERT INTO `sj_left` VALUES (1,'数据表单','Data/index.html','data'),(2,'数据管理','','data'),(3,'用户列表','Type/index.html','type'),(4,'权限管理','Type/typelist.html','type'),(5,'数据导入','','data'),(6,'公共平台','Common/index.html','common'),(7,'内部邮件','','common'),(8,'常用工具',NULL,'common'),(9,'语句查询',NULL,'data'),(10,'勾架平台','Shelf/index.html','shelf'),(11,'用户组',NULL,'type'),(12,'行为管理',NULL,'type'),(15,'部门数据',NULL,'data');
/*!40000 ALTER TABLE `sj_left` ENABLE KEYS */;

#
# Structure for table "sj_log"
#

DROP TABLE IF EXISTS `sj_log`;
CREATE TABLE `sj_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) DEFAULT NULL COMMENT '日志发起者',
  `log` text COMMENT '日志内容',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日志添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='日志信息';

#
# Data for table "sj_log"
#

/*!40000 ALTER TABLE `sj_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sj_log` ENABLE KEYS */;

#
# Structure for table "sj_type"
#

DROP TABLE IF EXISTS `sj_type`;
CREATE TABLE `sj_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `typename` varchar(50) DEFAULT NULL COMMENT '权限名称',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '权限增加时间',
  `state` varchar(50) DEFAULT NULL COMMENT '权限状态1（启用）0（停用）',
  `dis` varchar(255) DEFAULT NULL COMMENT '权限描述',
  `uid` varchar(255) DEFAULT NULL COMMENT '授权id（|分割）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限表格';

#
# Data for table "sj_type"
#

/*!40000 ALTER TABLE `sj_type` DISABLE KEYS */;
INSERT INTO `sj_type` VALUES (1,'S','2016-07-02 14:43:16','1','超级管理员组','demo|'),(2,'A','2016-07-02 14:43:43','1','管理员组',NULL),(3,'V','2016-07-02 14:43:50','1','访问者组',NULL),(4,'K','2016-07-07 00:00:00','1','临时会员组',NULL);
/*!40000 ALTER TABLE `sj_type` ENABLE KEYS */;

#
# Structure for table "sj_typerule"
#

DROP TABLE IF EXISTS `sj_typerule`;
CREATE TABLE `sj_typerule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '规则所属的用户组',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '规则地址',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则表示',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限行为集合';

#
# Data for table "sj_typerule"
#

/*!40000 ALTER TABLE `sj_typerule` DISABLE KEYS */;
/*!40000 ALTER TABLE `sj_typerule` ENABLE KEYS */;

#
# Structure for table "sj_user"
#

DROP TABLE IF EXISTS `sj_user`;
CREATE TABLE `sj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '用户名称',
  `password` varchar(100) DEFAULT NULL COMMENT '密码',
  `sex` varchar(5) DEFAULT NULL COMMENT '性别',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `typeid` varchar(50) DEFAULT 'V' COMMENT '用户权限S(超级管理员)A（普通管理员）V（访问者）',
  `logid` varchar(50) DEFAULT NULL COMMENT '日志id',
  `uid` varchar(50) DEFAULT NULL COMMENT '引用id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "sj_user"
#

/*!40000 ALTER TABLE `sj_user` DISABLE KEYS */;
INSERT INTO `sj_user` VALUES (1,'demo','fe01ce2a7fbac8fafaed7c982a04e229',NULL,'2016-07-05 17:04:45','S,V,,,,','demo记录',NULL);
/*!40000 ALTER TABLE `sj_user` ENABLE KEYS */;

#
# Structure for table "sj_usergroup"
#

DROP TABLE IF EXISTS `sj_usergroup`;
CREATE TABLE `sj_usergroup` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '组名',
  `uid` text COMMENT '用户组id',
  `state` varchar(50) DEFAULT '1' COMMENT '状态（1可用0不可用）',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '用户组成立时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户组';

#
# Data for table "sj_usergroup"
#

/*!40000 ALTER TABLE `sj_usergroup` DISABLE KEYS */;
INSERT INTO `sj_usergroup` VALUES (1,'技术部',NULL,'1','2016-07-09 15:09:28'),(2,'测试部',NULL,'1','2016-07-09 15:09:37');
/*!40000 ALTER TABLE `sj_usergroup` ENABLE KEYS */;
