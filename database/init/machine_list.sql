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
-- Table structure for machine_list
-- ----------------------------
DROP TABLE IF EXISTS `machine_list`;
CREATE TABLE `machine_list`  (
  `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'GCP機器列表',
  `project` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '專案名稱',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '機器名稱',
  `zone` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地區',
  `network_ip` varchar(39) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '內部IP/內網IP',
  `nat_ip` varchar(39) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '外部IP/外網IP',
  `machine_type` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '機器規格',
  `status` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '狀態',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
