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
-- Table structure for ssh_key
-- ----------------------------
DROP TABLE IF EXISTS `ssh_key`;
CREATE TABLE `ssh_key`  (
  `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `project` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '專案名稱',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '使用者',
  `ssh_key` longtext COMMENT 'SSH_KEY',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
