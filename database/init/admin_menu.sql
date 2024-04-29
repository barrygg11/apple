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
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (2, 0, 1002, 'Admin', 'fa-tasks', '', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (3, 2, 1003, 'Users', 'fa-users', 'auth/users', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (4, 2, 1004, 'Roles', 'fa-user', 'auth/roles', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (5, 2, 1005, 'Permission', 'fa-ban', 'auth/permissions', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (6, 2, 1006, 'Menu', 'fa-bars', 'auth/menu', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (7, 2, 1007, 'Operation log', 'fa-history', 'auth/logs', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (8, 0, 1, '公告', 'fa-bullhorn', '/', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (9, 0, 2, '常用連結', 'fa-link', '', '常用連結', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (10, 9, 3, 'DEV', 'fa-link', '/link/dev', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (11, 9, 4, 'STG', 'fa-link', '/link/stg', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (12, 9, 5, 'UAT', 'fa-link', '/link/uat', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (13, 9, 6, 'PRD', 'fa-link', '/link/prd', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (14, 9, 7, 'DEVOPS', 'fa-link', '/link/devops', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (15, 0, 8, '查詢機器', 'fa-search', '', '查詢機器', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (16, 15, 9, 'DEV', 'fa-search', '/gcp/dev', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (17, 15, 10, 'STG', 'fa-search', '/gcp/stg', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (18, 15, 11, 'UAT', 'fa-search', '/gcp/uat', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (19, 15, 12, 'PRD', 'fa-search', '/gcp/prd', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (20, 15, 13, 'DEVOPS', 'fa-search', '/gcp/devops', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (21, 0, 14, 'GCP-LB', 'fa-bar-chart', '', 'GCP-LB', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (22, 21, 15, 'DEV', 'fa-bar-chart', '/gcp_lb/dev', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (23, 21, 16, 'STG', 'fa-bar-chart', '/gcp_lb/stg', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (24, 21, 17, 'UAT', 'fa-bar-chart', '/gcp_lb/uat', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (25, 21, 18, 'PRD', 'fa-bar-chart', '/gcp_lb/prd', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (26, 21, 19, 'DEVOPS', 'fa-bar-chart', '/gcp_lb/devops', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (27, 0, 20, '專案版號', 'fa-file-text', '', '專案版號', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (28, 27, 21, 'DEV', 'fa-file-text', '/version/dev', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (29, 27, 22, 'STG', 'fa-file-text', '/version/stg', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (30, 27, 23, 'UAT', 'fa-file-text', '/version/uat', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (31, 27, 24, 'PRD', 'fa-file-text', '/version/prd', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (32, 0, 25, 'SSH-KEY', 'fa-key', '', 'SSH-KEY', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (33, 32, 26, 'DEV', 'fa-key', '/sshkey/dev', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (34, 32, 27, 'STG', 'fa-key', '/sshkey/stg', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (35, 32, 28, 'UAT', 'fa-key', '/sshkey/uat', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (36, 32, 29, 'PRD', 'fa-key', '/sshkey/prd', NULL, '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (37, 0, 30, '帳戶設定', 'fa-cog', '/setting', '帳戶設定', '2024-01-01 00:00:00', NULL);
INSERT INTO `admin_menu` VALUES (38, 0, 31, '權限管控', 'fa-user-plus', '/adminList', '權限管控', '2024-01-01 00:00:00', NULL);

SET FOREIGN_KEY_CHECKS = 1;
