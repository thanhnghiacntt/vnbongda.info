/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : vnbongda

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 28/07/2018 22:54:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Tên danh mục',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Mô tả danh mục',
  `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT 'Id cha',
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_gallery
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Url image tương đối: VD /image/test.png',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Title của image',
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_post
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post`;
CREATE TABLE `tbl_post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Tiêu đề bài viết',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT 'Nội dung bài viết',
  `id_image` int(11) NULL DEFAULT NULL COMMENT 'Id của hình ảnh đại điện',
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_image`(`id_image`) USING BTREE,
  CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `tbl_gallery` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Họ',
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Tên',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Số điện thoại',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Avatar',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu đăng nhập',
  `last_visited` date NULL DEFAULT NULL,
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Nguyễn Thành', 'Nghĩa', 'thanhnghiacntt@gmail.com', '0975335587', 'image/adfsadfsdf.jpg', 'thanhnghiacntt', '$2y$10$MV5/S/1KgHUcVrYpr9CAAeJFWashqElEn5pxA9vLcUN9N.ft3coGa', '2018-07-28', NULL, 1, 1, '2018-07-26', '2018-07-28');
INSERT INTO `tbl_user` VALUES (4, 'Nguyễn Thành', 'Nghĩa', 'thanhnghiacntt@yahoo.com.vn', '0975335587', 'http://google.com.vn/abcd.png', 'tieutanduong', '$2y$10$ONBSiC6aZlF0ZmxaMUl67OsooHlDOwydZ6uGPmwpNwsvgomjB45Zm', NULL, NULL, NULL, NULL, '2018-07-27', '2018-07-27');

SET FOREIGN_KEY_CHECKS = 1;
