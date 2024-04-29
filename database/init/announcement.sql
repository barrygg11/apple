/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : 

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 01/01/2024 00:00:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for announcement
-- ----------------------------
DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '站點訊息列表',
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '類型  1公告',
  `unit` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '單位',
  `personnel` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '人員',
  `content` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '內文',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '創建時間',
  `delete_time` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '刪除時間',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
