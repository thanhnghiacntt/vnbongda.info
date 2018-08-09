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

 Date: 09/08/2018 21:38:25
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------
INSERT INTO `tbl_category` VALUES (1, 'Tin tức', 'Tin tức chung', 'tin-tuc', NULL, NULL, 4, 4, '2018-07-30', '2018-07-30');
INSERT INTO `tbl_category` VALUES (2, 'Thế Giới', 'Thế giới chung', 'the-gioi', NULL, NULL, 4, 4, '2018-08-04', '2018-08-04');
INSERT INTO `tbl_category` VALUES (3, 'Thời Sự', 'Thời sự chung', 'thoi-su', NULL, NULL, 4, 4, '2018-08-04', '2018-08-04');
INSERT INTO `tbl_category` VALUES (4, 'Tâm Sự', 'Tâm sự chung', 'tam-su', NULL, NULL, 4, 4, '2018-08-04', '2018-08-04');

-- ----------------------------
-- Table structure for tbl_category_post
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category_post`;
CREATE TABLE `tbl_category_post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `id_category` int(11) NOT NULL COMMENT 'Id của danh  mục',
  `id_post` int(11) NOT NULL COMMENT 'Id của bài post',
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_category_post
-- ----------------------------
INSERT INTO `tbl_category_post` VALUES (1, 1, 2, '2018-08-05', NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (2, 2, 2, '2018-08-05', NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (3, 1, 3, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (4, 2, 3, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (5, 1, 4, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (6, 2, 4, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (7, 1, 5, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (8, 2, 5, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (9, 1, 6, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (10, 2, 6, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (11, 1, 7, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (12, 2, 7, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (13, 1, 8, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (14, 2, 8, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (15, 1, 9, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (16, 2, 9, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (17, 1, 10, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (18, 2, 10, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (19, 1, 11, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (20, 2, 11, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (21, 1, 12, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (22, 2, 12, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (23, 1, 13, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (24, 2, 13, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (25, 1, 14, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (26, 2, 14, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (27, 1, 15, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (28, 2, 15, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (29, 1, 16, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (30, 2, 16, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (31, 1, 17, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (32, 2, 17, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (33, 1, 18, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (34, 2, 18, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (35, 1, 19, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (36, 2, 19, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (37, 1, 20, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (38, 2, 20, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (39, 1, 21, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (40, 2, 21, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (41, 1, 22, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (42, 2, 22, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (43, 1, 2, NULL, NULL, NULL, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_category_post` VALUES (44, 2, 2, NULL, NULL, NULL, '2018-08-05', '2018-08-05');

-- ----------------------------
-- Table structure for tbl_gallery
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Url image tương đối: VD /image/test.png',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Title của image',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Mô tả về hình ảnh',
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_gallery
-- ----------------------------
INSERT INTO `tbl_gallery` VALUES (1, '1533468117.JPG', 'Hình ảnh', 'Mô tả sơ sơ', NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_gallery` VALUES (2, '1533468117.JPG', 'Hình ảnh', 'Mô tả sơ sơ', NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_gallery` VALUES (3, 'http://vnbongda.info/public/uploads/1533468117.JPG', 'Hình chụp cũ', 'Cũ rồi sơ sơ', NULL, 4, 4, '2018-08-05', '2018-08-05');

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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_post
-- ----------------------------
INSERT INTO `tbl_post` VALUES (1, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', NULL, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (2, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (3, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (4, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (5, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (6, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (7, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (8, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (9, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (10, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (11, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (12, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (13, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (14, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (15, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (16, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (17, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (18, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (19, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (20, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (21, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');
INSERT INTO `tbl_post` VALUES (22, 'Nguyễn Thành Nghĩa đạt thủ khoa', '<div>Hello</div>', 1, NULL, 4, 4, '2018-08-05', '2018-08-05');

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
  `role` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'user' COMMENT 'Vai trò của user',
  `last_visited` date NULL DEFAULT NULL COMMENT 'Viến thăm lần cuối',
  `deleted_at` date NULL DEFAULT NULL COMMENT 'Đã xóa hay chưa',
  `created_by` int(11) NULL DEFAULT NULL COMMENT 'Tạo bởi user id nào',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT 'Cập nhật bởi user id nào',
  `created_at` date NULL DEFAULT NULL COMMENT 'Tạo vào ngày nào',
  `updated_at` date NULL DEFAULT NULL COMMENT 'Cập nhật vào ngày nào',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Nguyễn Thành', 'Nghĩa', 'thanhnghiacntt@gmail.com', '0975335587', 'image/adfsadfsdf.jpg', 'thanhnghiacntt', '$2y$10$MV5/S/1KgHUcVrYpr9CAAeJFWashqElEn5pxA9vLcUN9N.ft3coGa', NULL, '2018-07-28', NULL, 1, 1, '2018-07-26', '2018-07-28');
INSERT INTO `tbl_user` VALUES (4, 'Nguyễn Thành', 'Nghĩa', 'thanhnghiacntt@yahoo.com.vn', '0975335587', 'http://google.com.vn/abcd.png', 'tieutanduong', '$2y$10$ONBSiC6aZlF0ZmxaMUl67OsooHlDOwydZ6uGPmwpNwsvgomjB45Zm', NULL, '2018-08-05', NULL, NULL, NULL, '2018-07-27', '2018-08-05');

SET FOREIGN_KEY_CHECKS = 1;
