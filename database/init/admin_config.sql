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
-- Table structure for admin_config
-- ----------------------------
DROP TABLE IF EXISTS `admin_config`;
CREATE TABLE `admin_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理員關聯資訊表',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '啟用狀態  1啟用 0停用',
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '類型  1超級管理員 2管理員 3一般人員',
  `admin_id` int(11) UNSIGNED NOT NULL COMMENT '管理員列表對應ID',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '備註',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '創建時間',
  `update_time` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '更新時間',
  `delete_time` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '刪除時間',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_config
-- ----------------------------
INSERT INTO `admin_config` VALUES (1, 1, 1, 1, NULL, 1704038400, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
