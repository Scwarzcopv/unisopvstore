CREATE DATABASE IF NOT EXISTS unisopv_store;
/*
 Navicat Premium Data Transfer

 Source Server         : MySql
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : unisopv_store

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 09/10/2024 20:56:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for akun
-- ----------------------------
DROP TABLE IF EXISTS `akun`;
CREATE TABLE `akun`  (
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of akun
-- ----------------------------
INSERT INTO `akun` VALUES ('aaaaaaaaaaaaa', 2, 'as', '1656383013.png');
INSERT INTO `akun` VALUES ('admin', 1, 'admin', '1657003255.png');
INSERT INTO `akun` VALUES ('guest', 2, 'guest', '1689560079.png');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `id_cart` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` int NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_total` int NOT NULL,
  PRIMARY KEY (`id_cart`) USING BTREE,
  INDEX `FK_Cart_1`(`username` ASC) USING BTREE,
  INDEX `FK_Cart_2`(`id_produk` ASC) USING BTREE,
  CONSTRAINT `FK_Cart_1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_Cart_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 436 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES (392, 'guest', 5, 745000, 9999, 0);
INSERT INTO `cart` VALUES (427, 'guest', 3, 250000, 1, 0);
INSERT INTO `cart` VALUES (431, 'guest', 6, 745000, 1, 0);
INSERT INTO `cart` VALUES (432, 'guest', 2, 200000, 1, 0);
INSERT INTO `cart` VALUES (435, 'admin', 7, 365000, 1, 0);

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `grade_produk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_produk` int NOT NULL,
  `img_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_produk-hover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  `ket_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_produk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1, '[HG] HIGH GRADE', '[HG] RX-78-02 Gundam - Cucuruz Doan\'s Island (PBandai)', 200000, 'HG_RX-78-02_Gundam.jpg', 'HG_RX-78-02_Gundam.jpg', 9999, '');
INSERT INTO `produk` VALUES (2, '[HG] HIGH GRADE', '[HG] IO Frame Shiden Custom - Ryuseigo (PBandai)\r\n', 200000, 'HG_IO_Frame_Shiden_Custom-Ryuseigo.jpg', 'HG_IO_Frame_Shiden_Custom-Ryuseigo.jpg', 9999, '');
INSERT INTO `produk` VALUES (3, '[HG] HIGH GRADE', '[HG] RX-78GP01Fb Gundam GP01Fb Full Burnern', 250000, 'HG_RX-78GP01Fb.jpg', 'HG_RX-78GP01Fb.jpg', 9999, '');
INSERT INTO `produk` VALUES (4, '[HG] HIGH GRADE', '[HG] MS-06F Zaku - Cucuruz Doan\'s Island (PBandai)', 200000, 'HG_MS-06F_Zaku.jpg', 'HG_MS-06F_Zaku.jpg', 9999, '');
INSERT INTO `produk` VALUES (5, '[HG] HIGH GRADE', '[HG] NZ-666 Kshatriya', 745000, '[HG] NZ-666 Kshatriya.jpg', '[HG] NZ-666 Kshatriya.jpg', 9999, '');
INSERT INTO `produk` VALUES (6, '[MG] MASTER GRADE', '[MG] Force Impulse Gundam', 745000, '[MG] Force Impulse Gundam.jpeg', '[MG] Force Impulse Gundam.jpeg', 9999, '');
INSERT INTO `produk` VALUES (7, '[HG] HIGH GRADE', '[HG] Lightning Z Gundam', 365000, '[HG] Lightning Z Gundam.jpeg', '[HG] Lightning Z Gundam.jpeg', 9999, '');
INSERT INTO `produk` VALUES (8, '[MG] MASTER GRADE', '[MG] Strike Gundam IWSP', 700000, '[MG] Strike Gundam IWSP.jpeg', '[MG] Strike Gundam IWSP.jpeg', 9999, '');
INSERT INTO `produk` VALUES (9, '[HG] HIGH GRADE', '[HG] RX-78GP01 Gundam GP01 Zephyranthes', 200000, '[HG] RX-78GP01 Gundam GP01 Zephyranthes.jpeg', '[HG] RX-78GP01 Gundam GP01 Zephyranthes.jpeg', 9999, '');

-- ----------------------------
-- Table structure for wishlist
-- ----------------------------
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist`  (
  `id_wishlist` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` int NOT NULL,
  `harga` int NOT NULL,
  PRIMARY KEY (`id_wishlist`) USING BTREE,
  INDEX `FK_Wishlist_1`(`username` ASC) USING BTREE,
  INDEX `FK_Wishlist_2`(`id_produk` ASC) USING BTREE,
  CONSTRAINT `FK_Wishlist_1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_Wishlist_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 666 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wishlist
-- ----------------------------
INSERT INTO `wishlist` VALUES (547, 'admin', 2, 0);
INSERT INTO `wishlist` VALUES (548, 'admin', 1, 0);
INSERT INTO `wishlist` VALUES (549, 'admin', 4, 0);
INSERT INTO `wishlist` VALUES (550, 'admin', 3, 0);
INSERT INTO `wishlist` VALUES (551, 'admin', 6, 0);
INSERT INTO `wishlist` VALUES (552, 'admin', 5, 0);
INSERT INTO `wishlist` VALUES (554, 'admin', 8, 0);
INSERT INTO `wishlist` VALUES (555, 'admin', 9, 0);
INSERT INTO `wishlist` VALUES (648, 'guest', 5, 745000);
INSERT INTO `wishlist` VALUES (660, 'guest', 2, 200000);
INSERT INTO `wishlist` VALUES (663, 'guest', 6, 745000);
INSERT INTO `wishlist` VALUES (664, 'guest', 3, 250000);
INSERT INTO `wishlist` VALUES (665, 'admin', 7, 365000);

SET FOREIGN_KEY_CHECKS = 1;
