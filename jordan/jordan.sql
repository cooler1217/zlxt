/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : jordan

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-09-25 17:59:26
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `ad_config`
-- ----------------------------
DROP TABLE IF EXISTS `ad_config`;
CREATE TABLE `ad_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `position` varchar(10) DEFAULT NULL,
  `isfixed` varchar(10) DEFAULT NULL,
  `left` int(3) DEFAULT NULL,
  `top` int(3) DEFAULT NULL,
  `width` int(4) DEFAULT NULL,
  `height` int(4) DEFAULT NULL,
  `content` text,
  `config_datetime` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad_config
-- ----------------------------
INSERT INTO `ad_config` VALUES ('32', '127.0.0.1', 'l', 'left', 'false', '6', '80', '100', '233', '<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"97\" height=\"233\"><param name=\"movie\" value=\"http://127.0.0.1/jordan/uploads/source/1380102810_l.swf\"><param name=\"quality\" value=\"high\"><embed src=\"http://127.0.0.1/jordan/uploads/source/1380102810_l.swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"97\" height=\"233\"></embed></object><img align=\"right\" src=\"http://49.4.129.122/jordan/static/images/close.gif\" class=\"close_ad_cooler\">', '2013-09-25 09:53:30', '1');
INSERT INTO `ad_config` VALUES ('33', '127.0.0.1', 'r', 'right', 'false', '106', '80', '100', '233', '<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"97\" height=\"233\"><param name=\"movie\" value=\"http://127.0.0.1/jordan/uploads/source/1380102831_r.swf\"><param name=\"quality\" value=\"high\"><embed src=\"http://127.0.0.1/jordan/uploads/source/1380102831_r.swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"97\" height=\"233\"></embed></object><img align=\"right\" src=\"http://49.4.129.122/jordan/static/images/close.gif\" class=\"close_ad_cooler\">', '2013-09-25 09:53:51', '1');
INSERT INTO `ad_config` VALUES ('34', '127.0.0.1', '底层', 'bottom', 'false', '10', '220', '100', '233', '<object type=\"application/x-shockwave-flash\" data=\"http://127.0.0.1/jordan/uploads/source/1380102857_dibianhengfu.swf\" width=\"100%\" height=\"120\"><param name=\"movie\" value=\"http://127.0.0.1/jordan/uploads/source/1380102857_dibianhengfu.swf\"><param name=\"quality\" value=\"high\"><param name=\"bgcolor\" value=\"#666666\"><param name=\"play\" value=\"true\"><param name=\"loop\" value=\"true\"><param name=\"wmode\" value=\"transparent\"><param name=\"scale\" value=\"showall\"><param name=\"menu\" value=\"true\"><param name=\"devicefont\" value=\"false\"><param name=\"salign\" value=\"\"><param name=\"allowScriptAccess\" value=\"sameDomain\"></object> ', '2013-09-25 09:54:17', '1');
INSERT INTO `ad_config` VALUES ('35', '127.0.0.1', 'll-r', 'right', 'true', '106', '80', '100', '233', '<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"97\" height=\"233\"><param name=\"movie\" value=\"http://127.0.0.1/jordan/uploads/source/1380102913_ll-r.swf\"><param name=\"quality\" value=\"high\"><embed src=\"http://127.0.0.1/jordan/uploads/source/1380102913_ll-r.swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"97\" height=\"233\"></embed></object><img align=\"right\" src=\"http://49.4.129.122/jordan/static/images/close.gif\" class=\"close_ad_cooler\">', '2013-09-25 09:55:13', '1');

-- ----------------------------
-- Table structure for `authority`
-- ----------------------------
DROP TABLE IF EXISTS `authority`;
CREATE TABLE `authority` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `right` varchar(14) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authority
-- ----------------------------
INSERT INTO `authority` VALUES ('1', 'admin', 'Gp2nn9hnsPAxJiVxTAn08zQj2eXA/ojDBNG+CC8/aE2O4C3RDOdYuq2ojwt0CK6MNE944pPj5kRnfXO6IgML3Q==', '0', 'all');

-- ----------------------------
-- Table structure for `request`
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `request_datetime` datetime DEFAULT NULL,
  `jordanGUID` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request
-- ----------------------------
INSERT INTO `request` VALUES ('1', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-18 12:52:39', '613852b2-9cd0-2bc8-cac5-4adf5090e3db');
INSERT INTO `request` VALUES ('2', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-18 12:53:01', '613852b2-9cd0-2bc8-cac5-4adf5090e3db');
INSERT INTO `request` VALUES ('3', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-18 12:52:39', '613852b2-9cd0-2bc8-cac5-4adf5090e3db');
INSERT INTO `request` VALUES ('4', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-18 12:53:00', '613852b2-9cd0-2bc8-cac5-4adf5090e3db');
INSERT INTO `request` VALUES ('5', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 14:41:04', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('6', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 14:52:33', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('7', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 14:54:09', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('8', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 14:54:14', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('9', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 14:58:14', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('10', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:00:05', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('11', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:00:17', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('12', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:04:20', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('13', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:10:22', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('14', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:10:48', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('15', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:10:54', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('16', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:10:58', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('17', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:11:03', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('18', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:13:03', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('19', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:13:36', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('20', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:13:59', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('21', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:21:47', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('22', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:21:55', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('23', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:22:32', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('24', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:22:47', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('25', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:23:42', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('26', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:25:20', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('27', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:26:29', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('28', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:26:55', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('29', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:27:08', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('30', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:27:41', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('31', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-22 15:30:03', '82044f1e-28e1-1923-2756-68f91252bad6');
INSERT INTO `request` VALUES ('32', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 15:34:36', 'efeb9390-4040-68f1-f967-498955b128b5');
INSERT INTO `request` VALUES ('33', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 15:35:14', 'efeb9390-4040-68f1-f967-498955b128b5');
INSERT INTO `request` VALUES ('34', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 15:39:41', 'efeb9390-4040-68f1-f967-498955b128b5');
INSERT INTO `request` VALUES ('35', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 15:40:03', 'efeb9390-4040-68f1-f967-498955b128b5');
INSERT INTO `request` VALUES ('36', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 15:40:37', 'efeb9390-4040-68f1-f967-498955b128b5');
INSERT INTO `request` VALUES ('37', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 15:42:29', 'efeb9390-4040-68f1-f967-498955b128b5');
INSERT INTO `request` VALUES ('38', '127.0.0.1', 'http://127.0.0.1/jordan/blog/test_browser', '2013-09-25 17:55:42', '88d45c01-783a-e69a-5280-70e4f16d4bf8');

-- ----------------------------
-- Table structure for `source`
-- ----------------------------
DROP TABLE IF EXISTS `source`;
CREATE TABLE `source` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `adconfigid` int(10) DEFAULT NULL,
  `sourcetype` varchar(100) DEFAULT NULL,
  `domain` varchar(30) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `filename` varchar(40) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of source
-- ----------------------------
INSERT INTO `source` VALUES ('32', '32', 'swf', '127.0.0.1', 'http://127.0.0.1/jordan/uploads/source/1380102810_l.swf', '1380102810_l.swf', 'l', '2013-09-25 09:53:30');
INSERT INTO `source` VALUES ('33', '33', 'swf', '127.0.0.1', 'http://127.0.0.1/jordan/uploads/source/1380102831_r.swf', '1380102831_r.swf', 'r', '2013-09-25 09:53:51');
INSERT INTO `source` VALUES ('34', '34', 'swf', '127.0.0.1', 'http://127.0.0.1/jordan/uploads/source/1380102857_dibianhengfu.swf', '1380102857_dibianhengfu.swf', '底层', '2013-09-25 09:54:17');
INSERT INTO `source` VALUES ('35', '35', 'swf', '127.0.0.1', 'http://127.0.0.1/jordan/uploads/source/1380102913_ll-r.swf', '1380102913_ll-r.swf', 'll-r', '2013-09-25 09:55:13');
