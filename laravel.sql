/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : laravel

 Target Server Type    : MariaDB
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 28/05/2020 01:15:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for apartments
-- ----------------------------
DROP TABLE IF EXISTS `apartments`;
CREATE TABLE `apartments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of apartments
-- ----------------------------
INSERT INTO `apartments` VALUES (1, 'Chung Cư Ba Hàng A', 'Lĩnh Nam, Hoàng Mai, Hà Nội, Việt Nam', 1, '2020-05-12 22:08:38', '2020-05-12 22:08:40');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Dịch Vụ Vệ Sinh', 'dich-vu-ve-sinh1590424869', 0, 1, '2020-05-16 17:28:07', '2020-05-25 16:41:09');
INSERT INTO `categories` VALUES (2, 'Dịch Vụ Hỗ Trợ Nấu Ăn', 'dich-vu-ho-tro-nau-an1590424896', 4, 1, '2020-05-25 16:41:36', '2020-05-25 16:42:52');
INSERT INTO `categories` VALUES (3, 'Dịch Vụ Phục Vụ Tiệc Gia Đình', 'dich-vu-phuc-vu-tiec-gia-dinh1590424920', 4, 1, '2020-05-25 16:42:00', '2020-05-25 16:42:53');
INSERT INTO `categories` VALUES (4, 'Dịch Vụ Chuyển Nhà', 'dich-vu-chuyen-nha1590424985', 2, 1, '2020-05-25 16:43:05', '2020-05-25 16:45:12');
INSERT INTO `categories` VALUES (5, 'Dịch Vụ Lắp Đặt Trang Thiết Bị', 'dich-vu-lap-dat-trang-thiet-bi1590425002', 2, 1, '2020-05-25 16:43:22', '2020-05-25 16:45:08');
INSERT INTO `categories` VALUES (6, 'Dịch Vụ Thu Dọn và Phân Loại Phê Liệu', 'dich-vu-thu-don-va-phan-loai-phe-lieu1590425028', 5, 1, '2020-05-25 16:43:48', '2020-05-25 16:45:06');
INSERT INTO `categories` VALUES (7, 'Dịch Vụ Chăm Sanh', 'dich-vu-cham-sanh1590425043', 3, 1, '2020-05-25 16:44:03', '2020-05-25 16:45:13');
INSERT INTO `categories` VALUES (8, 'Dịch Vụ Chăm Sóc Người Già', 'dich-vu-cham-soc-nguoi-gia1590425056', 3, 1, '2020-05-25 16:44:16', '2020-05-25 16:45:05');
INSERT INTO `categories` VALUES (9, 'Dịch Vụ Chăm Sóc Người Bệnh', 'dich-vu-cham-soc-nguoi-benh1590425064', 3, 1, '2020-05-25 16:44:24', '2020-05-25 16:45:04');
INSERT INTO `categories` VALUES (10, 'Dịch Vụ Sửa Điện Lạnh', 'dich-vu-sua-dien-lanh1590425083', 1, 1, '2020-05-25 16:44:43', '2020-05-25 16:45:01');
INSERT INTO `categories` VALUES (11, 'Dịch Vụ Sửa Hệ Thống Ống Nước', 'dich-vu-sua-he-thong-ong-nuoc1590425099', 1, 0, '2020-05-25 16:44:59', '2020-05-25 16:44:59');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for consts
-- ----------------------------
DROP TABLE IF EXISTS `consts`;
CREATE TABLE `consts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `demeanor` int(11) NOT NULL DEFAULT 100,
  `responsiveness` int(11) NOT NULL DEFAULT 100,
  `competence` int(11) NOT NULL DEFAULT 100,
  `tangible` int(11) NOT NULL DEFAULT 100,
  `completeness` int(11) NOT NULL DEFAULT 100,
  `relevancy` int(11) NOT NULL DEFAULT 100,
  `accuracy` int(11) NOT NULL DEFAULT 100,
  `currency` int(11) NOT NULL DEFAULT 100,
  `training_provider` int(11) NOT NULL DEFAULT 100,
  `user_understanding` int(11) NOT NULL DEFAULT 100,
  `participation` int(11) NOT NULL DEFAULT 100,
  `easier_to_the_job` int(11) NOT NULL DEFAULT 100,
  `increase_productivity` int(11) NOT NULL DEFAULT 100,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of consts
-- ----------------------------
INSERT INTO `consts` VALUES (1, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (47, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (48, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (49, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (50, '2020_05_12_143039_create_products_table', 1);
INSERT INTO `migrations` VALUES (51, '2020_05_12_143113_create_orders_table', 1);
INSERT INTO `migrations` VALUES (52, '2020_05_12_143148_create_categories_table', 1);
INSERT INTO `migrations` VALUES (53, '2020_05_12_144353_create_comments_table', 1);
INSERT INTO `migrations` VALUES (54, '2020_05_12_163627_create_apartments_table', 1);
INSERT INTO `migrations` VALUES (55, '2020_05_14_151016_create_rate_table', 1);
INSERT INTO `migrations` VALUES (56, '2020_05_14_151427_create_consts_table', 1);
INSERT INTO `migrations` VALUES (57, '2020_05_27_092220_create_staffs_table', 2);
INSERT INTO `migrations` VALUES (58, '2020_05_27_163630_create_staff_product_table', 3);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 'no', 1, 1, 0, '2020-05-23 05:53:56', '2020-05-23 05:53:58');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` double NOT NULL DEFAULT 0,
  `rate_number` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Lau Dọn Vệ Sinh Nhà Cửa', '/images/1590425373.jpeg', 'lau-don-ve-sinh-nha-cua1590508055', '<p>Nh&acirc;n vi&ecirc;n Tận tụy</p>\n\n<p>Đội Ngũ Nhiều Năm Kinh Nghiệm</p>\n\n<p>Lu&ocirc;n Hướng Tới L&agrave;m Thỏa M&atilde;n Nhu Cầu Kh&aacute;ch H&agrave;ng</p>', '1', 1, 5, 1, 1, '2020-05-16 17:41:44', '2020-05-26 15:47:35');
INSERT INTO `products` VALUES (2, 'Dịch Vụ Trợ Giúp Nấu Ăn', '/images/1590508347.jpeg', 'dich-vu-tro-giup-nau-an1590508347', '<p>Gi&uacute;p Bạn C&oacute; C&aacute;c M&oacute;n Ăn Ngon.</p>\n\n<p>Trao Đổi Tận Tụy Về C&aacute;ch Nấu Ăn.</p>\n\n<p>Sẵn S&agrave;ng L&agrave;m Bếp Phụ Để Gi&uacute;p Bạn L&agrave;m M&oacute;n Ăn Cho Gia Đ&igrave;nh</p>', '2', 1, 4, 2, 1, '2020-05-16 17:58:04', '2020-05-26 15:52:27');
INSERT INTO `products` VALUES (3, 'Dịch Vụ Chăm Sóc Trẻ Nhỏ', '/images/1590508585.jpeg', 'dich-vu-cham-soc-tre-nho1590508585', '<p>Nếu Bạn Qu&aacute; Bận Rộn Với C&ocirc;ng Việc Th&igrave; Sao Kh&ocirc;ng Li&ecirc;n Hệ Ngay Với Ch&uacute;ng T&ocirc;i.</p>\n\n<p>Ch&uacute;ng T&ocirc;i Sẽ Gi&uacute;p Baby của bạn được trở th&agrave;nh qu&yacute; &ocirc;ng được chăm s&oacute;c chu đ&aacute;o Nhất</p>', '7', 1, 5, 3, 1, '2020-05-16 18:29:38', '2020-05-26 15:56:25');
INSERT INTO `products` VALUES (4, 'Dịch Vụ Sửa Chữa Hệ Thống Điện', '/images/1590508713.jpeg', 'dich-vu-sua-chua-he-thong-dien1590508713', '<p>C&oacute; vẻ như bạn đang bị hỏng h&oacute;c g&igrave; đ&oacute; về điện nh&agrave; m&igrave;nh.</p>\n\n<p>H&atilde;y để ch&uacute;ng t&ocirc;i gi&uacute;p bạn.</p>\n\n<p>Ch&uacute;ng t&ocirc;i l&agrave; sẽ mang những chuy&ecirc;n gia đ&aacute;ng tin cậy về điện tới tận gia đ&igrave;nh bạn</p>', '10', 1, 3, 10, 1, '2020-05-16 19:09:03', '2020-05-26 15:58:33');
INSERT INTO `products` VALUES (5, 'Dịch Vụ Sửa Chữa Hệ Thống Nước', '/images/1590508859.jpeg', 'dich-vu-sua-chua-he-thong-nuoc1590508859', '<p>Ồ h&igrave;nh như đường nước nh&agrave; bạn đang c&oacute; vấn đề.</p>\n\n<p>Với đội ngũ anh em nhiều năm kinh nghiệm.</p>\n\n<p>T&ocirc;i tin chắc chắn rằng ch&uacute;ng t&ocirc;i sẽ gi&uacute;p được bạn đấy.</p>\n\n<p>Vậy sao bạn kh&ocirc;ng cho ch&uacute;ng t&ocirc;i cơ hội để gi&uacute;p đỡ bạn.</p>', '10', 1, 0, 0, 1, '2020-05-26 16:00:59', '2020-05-26 16:11:09');
INSERT INTO `products` VALUES (6, 'Dịch Vụ Chăm Sóc Người Già', '/images/1590509079.jpeg', 'dich-vu-cham-soc-nguoi-gia1590509079', '<p>H&atilde;y để ch&uacute;ng t&ocirc;i gi&uacute;p bạn trở th&agrave;nh một người con hiếu thảo.</p>\n\n<p>Với phương ch&acirc;m &quot;sống v&agrave; mang lại niềm hạnh ph&uacute;c cho mọi người&quot;.</p>\n\n<p>Ch&uacute;ng t&ocirc;i kh&ocirc;ng chỉ gi&uacute;p bạn chăm s&oacute;c cho cha mẹ bạn như một người l&agrave;m thu&ecirc;.&nbsp;</p>\n\n<p>M&agrave; ch&uacute;ng t&ocirc;i c&ograve;n săn s&agrave;ng trở th&agrave;nh người bạn vong ni&ecirc;m với người gi&agrave;.</p>\n\n<p>V&agrave; c&oacute; thể bạn đ&atilde; biết người gi&agrave; lu&ocirc;n cần một người bầu bạn đ&oacute;.</p>', '8', 1, 0, 0, 1, '2020-05-26 16:04:39', '2020-05-26 16:11:08');
INSERT INTO `products` VALUES (7, 'Dịch Vụ Hỗ Trợ Lắp Đặt', '/images/1590509243.jpeg', 'dich-vu-ho-tro-lap-dat1590509243', '<p>Mọi thứ đang qu&aacute; cồng kềnh trong khi bạn vẫn loay hoay chưa biết lắp đặt thiết bị trong nh&agrave; th&acirc;n y&ecirc;u của m&igrave;nh.</p>\n\n<p>N&agrave;o nhấc m&aacute;y l&ecirc;n v&agrave; gọi cho ch&uacute;ng t&ocirc;i ngay th&ocirc;i.</p>\n\n<p>Mọi việc sẽ trở n&ecirc;n dễ d&agrave;ng khi c&oacute; người gi&uacute;p đỡ bạn phải kh&ocirc;ng n&agrave;o.</p>', '5', 1, 0, 0, 1, '2020-05-26 16:07:23', '2020-05-26 16:11:07');
INSERT INTO `products` VALUES (8, 'Dịch Vụ Sửa Chữa Đồ Điện Công Nghệ Cao', '/images/1590509427.png', 'dich-vu-sua-chua-do-dien-cong-nghe-cao1590509427', '<p>Với đội ngũ nhiều năm kinh nghiệm v&agrave; năng động.</p>\n\n<p>Ch&uacute;ng t&ocirc;i c&oacute; thể gi&uacute;p bạn sửa:</p>\n\n<p>- Điều H&ograve;a.</p>\n\n<p>- M&aacute;y Giặt.</p>\n\n<p>- Tivi.</p>\n\n<p>- Tủ Lạnh.</p>\n\n<p>....</p>', '10', 1, 0, 0, 1, '2020-05-26 16:10:27', '2020-05-26 16:11:06');

-- ----------------------------
-- Table structure for rate
-- ----------------------------
DROP TABLE IF EXISTS `rate`;
CREATE TABLE `rate`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `demeanor` int(11) NOT NULL DEFAULT 5,
  `responsiveness` int(11) NOT NULL DEFAULT 5,
  `competence` int(11) NOT NULL DEFAULT 5,
  `tangible` int(11) NOT NULL DEFAULT 5,
  `completeness` int(11) NOT NULL DEFAULT 5,
  `relevancy` int(11) NOT NULL DEFAULT 5,
  `accuracy` int(11) NOT NULL DEFAULT 5,
  `currency` int(11) NOT NULL DEFAULT 5,
  `training_provider` int(11) NOT NULL DEFAULT 5,
  `user_understanding` int(11) NOT NULL DEFAULT 5,
  `participation` int(11) NOT NULL DEFAULT 5,
  `easier_to_the_job` int(11) NOT NULL DEFAULT 5,
  `increase_productivity` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rate
-- ----------------------------
INSERT INTO `rate` VALUES (1, 5, 4, 5, 5, 5, 5, 5, 4, 4, 3, 5, 3, 5, NULL, NULL);

-- ----------------------------
-- Table structure for staff_product
-- ----------------------------
DROP TABLE IF EXISTS `staff_product`;
CREATE TABLE `staff_product`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staffs
-- ----------------------------
DROP TABLE IF EXISTS `staffs`;
CREATE TABLE `staffs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of staffs
-- ----------------------------
INSERT INTO `staffs` VALUES (3, 'Vũ Minh Thắng', '0909090908', '/staffs/1590594475.png', 'vuthang.hustit@gmail.com', NULL, '1', '2020-05-27 15:47:55', '2020-05-27 15:48:44', 1);
INSERT INTO `staffs` VALUES (4, 'Trương Tí Tộ', '0908090809', '/staffs/1590597179.png', 'dienluc@gmail.com', NULL, '1', '2020-05-27 16:33:00', '2020-05-27 16:33:00', 0);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blocker',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Thang', '099999999', '101', '123@gmail.com', NULL, '$2y$12$cYBsTEONuXYS6AuTCGPKTeWKlrR.GfQyjbmS8wETB.1jhIJr1f./i', 1, 'admin', NULL, '2020-05-12 22:09:10', '2020-05-12 22:09:13');
INSERT INTO `users` VALUES (2, 'thang vu', '0909090909', '12', '1234@gmail.com', NULL, '$2y$12$cYBsTEONuXYS6AuTCGPKTeWKlrR.GfQyjbmS8wETB.1jhIJr1f./i', 1, 'manage', NULL, '2020-05-16 19:52:50', '2020-05-20 17:12:56');
INSERT INTO `users` VALUES (5, 'thang vu', '0909090909', '12', '12345@gmail.com', NULL, '$2y$12$cYBsTEONuXYS6AuTCGPKTeWKlrR.GfQyjbmS8wETB.1jhIJr1f./i', 1, 'providor', NULL, '2020-05-16 19:53:40', '2020-05-20 17:13:04');
INSERT INTO `users` VALUES (6, 'thang', '0909090909', '1', '123456@gmail.com', NULL, '$2y$12$cYBsTEONuXYS6AuTCGPKTeWKlrR.GfQyjbmS8wETB.1jhIJr1f./i', 1, 'user', NULL, '2020-05-22 16:18:06', '2020-05-22 16:18:06');
INSERT INTO `users` VALUES (7, 'thang', '0909090909', '1', '1234567@gmail.com', NULL, '$2y$12$cYBsTEONuXYS6AuTCGPKTeWKlrR.GfQyjbmS8wETB.1jhIJr1f./i', 1, 'blocker', NULL, '2020-05-22 16:18:06', '2020-05-22 16:18:06');

SET FOREIGN_KEY_CHECKS = 1;
