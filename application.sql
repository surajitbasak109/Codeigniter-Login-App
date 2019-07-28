/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : application

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-07-29 00:43:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(50) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `recaptcha` varchar(5) NOT NULL,
  `theme` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'Admin System Login', 'Asia/Kolkata', 'no', 'public/dist/css/skins/skin-blue.min.css');

-- ----------------------------
-- Table structure for tokens
-- ----------------------------
DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tokens
-- ----------------------------
INSERT INTO `tokens` VALUES ('1', '98a882bc51abb2909c236d56ffcfff', '3', '2019-07-21');
INSERT INTO `tokens` VALUES ('2', '4f37c13d2314fa30b8a6ebc1bf5b58', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('3', '94958b3645eaecc66fc5c0eeda5c66', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('4', 'd1e0c4408ce8b18570ad14f974c995', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('5', '95d407a0b6904ac753d4103ba869f0', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('6', '19c7b361a6998ce1b4000d7c071b1b', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('7', 'fbc0bef0fff15aa2d8c5b72af4867a', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('8', '383526dfc5456c7f021d95b67bf121', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('9', '226d7e728c3b5c36003b58d8872884', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('10', 'e1c336aca90abd7dd6798288010ad3', '3', '2019-07-27');
INSERT INTO `tokens` VALUES ('11', 'f72ac93f0c6f195e562253a89385ce', '4', '2019-07-27');
INSERT INTO `tokens` VALUES ('12', '38e36d5570b261fd9f97d75cc27d6b', '6', '2019-07-28');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `last_login` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `banned_users` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin@gmail.com', 'Surajit', 'Basak', '1', 'sha256:1000:JDJ5JDEwJGQubEZZSkpLNmFjR2luZFFlbi53L09wUTJqdEdsT3Nob0tPc2lNYXUvTEZIZ3A4L0RRbXZ1:XaJIX418UeIzPfPM4ipjlXOP1RCmuYcD', '2019-07-29 00:25:05 AM', 'approved', 'unban');
INSERT INTO `users` VALUES ('6', 'surajitbasak109@gmail.com', 'Surajit', 'Basak', '1', 'sha256:1000:JDJ5JDEwJGhsS0huLnR1VDhHWEVkR2tNbTZpcmVLSzBIUlpRdjMuMERYTE84cm1FWjlZZXI0blNtQzR1:TMZleV1PSAsKUNHCtkGyHQb/nBrx87I3', '2019-07-28 01:28:30 AM', 'approved', 'unban');
