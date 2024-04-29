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
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `admin_permissions_slug_unique`(`slug`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (6, '公告', '公告', 'GET,POST', '/', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (7, '常用連結', '常用連結', 'GET,POST', '/link*', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (8, '查詢機器', '查詢機器', 'GET,POST', '/gcp*', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (9, 'GCP-LB', 'GCP-LB', 'GET,POST', '/gcp_lb*', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (10, '專案版號', '專案版號', 'GET,POST', '/version*', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (11, 'SSH-KEY', 'SSH-KEY', 'GET,POST', '/sshkey*', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (12, '帳戶設定', '帳戶設定', 'GET,POST', '/setting*', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_permissions` VALUES (13, '權限管控', '權限管控', 'GET,POST', '/adminList*', '2024-01-01 00:00:00', NULL);

SET FOREIGN_KEY_CHECKS = 1;
