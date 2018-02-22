/*
Navicat MySQL Data Transfer

Source Server         : seuhistory
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : seuhistory

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-08-24 08:10:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `ID` varchar(2) NOT NULL,
  `password` varchar(16) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `college` varchar(255) CHARACTER SET utf8 NOT NULL,
  `num` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for choose
-- ----------------------------
DROP TABLE IF EXISTS `choose`;
CREATE TABLE `choose` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `optionA` varchar(255) CHARACTER SET utf8 NOT NULL,
  `optionB` varchar(255) CHARACTER SET utf8 NOT NULL,
  `optionC` varchar(255) CHARACTER SET utf8 NOT NULL,
  `optionD` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=ascii;

-- ----------------------------
-- Table structure for judge
-- ----------------------------
DROP TABLE IF EXISTS `judge`;
CREATE TABLE `judge` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=ascii;

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 NOT NULL,
  `answer` char(61) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=ascii;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `stuNum` varchar(8) CHARACTER SET utf8 NOT NULL,
  `ID` varchar(9) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`stuNum`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii ROW_FORMAT=COMPACT;
