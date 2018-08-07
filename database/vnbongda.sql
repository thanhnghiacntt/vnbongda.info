/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : vnbongda

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-07-30 17:21:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tên danh mục',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Mô tả danh mục',
  `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug',
  `parent_id` int(11) DEFAULT NULL COMMENT 'Id cha',
  `order_by` int(11) DEFAULT 0 COMMENT 'Thứ tự',
  `deleted_at` date DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------
INSERT INTO `tbl_category` VALUES ('1', 'Tin tức', 'Tin tức chung', 'tin-tuc', null, null, '4', '4', '2018-07-30', '2018-07-30');

-- ----------------------------
-- Table structure for tbl_category_post
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category_post`;
CREATE TABLE `tbl_category_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `id_category` int(11) NOT NULL COMMENT 'Id của danh  mục',
  `id_post` int(11) NOT NULL COMMENT 'Id của bài post',
  `deleted_at` date DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category_post
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_gallery
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Url image tương đối: VD /image/test.png',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Title của image',
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Description của image',
  `deleted_at` date DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_post
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post`;
CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tiêu đề bài viết',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Nội dung bài viết',
  `id_image` int(11) DEFAULT NULL COMMENT 'Id của hình ảnh đại điện',
  `deleted_at` date DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_image` (`id_image`) USING BTREE,
  CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `tbl_gallery` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_post
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Họ',
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tên',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Số điện thoại',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Avatar',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu đăng nhập',
  `last_visited` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'Nguyễn Thành', 'Nghĩa', 'thanhnghiacntt@gmail.com', '0975335587', 'image/adfsadfsdf.jpg', 'thanhnghiacntt', '$2y$10$MV5/S/1KgHUcVrYpr9CAAeJFWashqElEn5pxA9vLcUN9N.ft3coGa', '2018-07-28', null, '1', '1', '2018-07-26', '2018-07-28');
INSERT INTO `tbl_user` VALUES ('4', 'Nguyễn Thành', 'Nghĩa', 'thanhnghiacntt@yahoo.com.vn', '0975335587', 'http://google.com.vn/abcd.png', 'tieutanduong', '$2y$10$ONBSiC6aZlF0ZmxaMUl67OsooHlDOwydZ6uGPmwpNwsvgomjB45Zm', null, null, null, null, '2018-07-27', '2018-07-27');
