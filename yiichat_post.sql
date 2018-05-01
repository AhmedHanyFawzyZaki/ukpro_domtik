/*
Navicat MySQL Data Transfer

Source Server         : Egproserver
Source Server Version : 50540
Source Host           : 192.168.1.200:3306
Source Database       : ukpro_domotik

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2014-11-13 16:30:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yiichat_post`
-- ----------------------------
DROP TABLE IF EXISTS `yiichat_post`;
CREATE TABLE `yiichat_post` (
  `id` char(40) NOT NULL DEFAULT '',
  `chat_id` char(40) DEFAULT NULL COMMENT 'id  to discrimine between various chats',
  `post_identity` char(40) DEFAULT NULL COMMENT 'the ID of the person who make this post',
  `owner` char(20) DEFAULT NULL COMMENT 'the name of the person who make this post',
  `created` bigint(30) DEFAULT NULL,
  `text` blob,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `yiichat_chat_id` (`chat_id`),
  KEY `yiichat_chat_id_identity` (`chat_id`,`post_identity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yiichat_post
-- ----------------------------
