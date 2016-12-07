/*
Navicat MySQL Data Transfer

Source Server         : owifi
Source Server Version : 50538
Source Host           : 127.0.0.1:3306
Source Database       : wgyt

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2016-12-07 16:45:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cab
-- ----------------------------
DROP TABLE IF EXISTS `cab`;
CREATE TABLE `cab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `passby_pos` varchar(128) NOT NULL COMMENT '途径地点',
  `start_time` varchar(128) NOT NULL COMMENT '上班时间',
  `str_start_time` varchar(128) NOT NULL COMMENT '开始时间字符串',
  `companion` int(11) NOT NULL COMMENT '座位/同行',
  `start_pos` varchar(128) NOT NULL COMMENT '出发地点',
  `start_pos_img` varchar(255) NOT NULL COMMENT '上车地点图片',
  `end_pos` varchar(128) NOT NULL COMMENT '到达地点',
  `price` decimal(10,0) NOT NULL COMMENT '行程费用',
  `type` enum('1','2','0') NOT NULL DEFAULT '0' COMMENT '车主或乘客：1车主 0默认 2乘客',
  `status` varchar(32) NOT NULL DEFAULT '1' COMMENT '乘车状态：车主/乘客 1发布/取消预约 2待确认/待车主确认 3拒绝乘客/被拒绝 4等待乘客上车/预约成功 5已失约/失约 6上车 7完成 8',
  `create_time` varchar(128) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8 COMMENT='班车表';

-- ----------------------------
-- Table structure for certification
-- ----------------------------
DROP TABLE IF EXISTS `certification`;
CREATE TABLE `certification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `real_name` varchar(32) NOT NULL COMMENT '真实姓名',
  `driver_licence_num` varchar(64) NOT NULL COMMENT '驾驶证号码',
  `driver_licence_img` varchar(255) NOT NULL COMMENT '驾驶证图片',
  `car_num` varchar(64) NOT NULL COMMENT '车牌号',
  `car_owner` varchar(32) NOT NULL COMMENT '车主',
  `car_brand` varchar(32) NOT NULL COMMENT '车辆品牌',
  `car_color` varchar(32) NOT NULL COMMENT '车颜色',
  `vehicle_license_img` varchar(255) NOT NULL COMMENT '行驶证图片',
  `register_date` varchar(128) NOT NULL COMMENT '行驶证注册日期',
  `agreement` varchar(255) NOT NULL DEFAULT '' COMMENT '协议内容',
  `status` enum('2','1','0') NOT NULL DEFAULT '0' COMMENT '是否认证：0未认证 1认证中 2通过认证',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='车主认证表';

-- ----------------------------
-- Table structure for order_cab
-- ----------------------------
DROP TABLE IF EXISTS `order_cab`;
CREATE TABLE `order_cab` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单索引id',
  `cab_id` int(11) NOT NULL COMMENT 'cab表id',
  `passager_id` int(11) NOT NULL COMMENT '乘客id(也是用户id)',
  `carowner_id` int(11) NOT NULL COMMENT '车主id(也是用户id)',
  `passager_cellphone` varchar(32) NOT NULL COMMENT '乘客电话',
  `carowner_cellphone` varchar(32) NOT NULL COMMENT '车主电话',
  `start_time` varchar(64) NOT NULL COMMENT '起始时间',
  `start_pos` varchar(64) NOT NULL COMMENT '起始地点',
  `end_pos` varchar(64) NOT NULL COMMENT '到达地点',
  `companion` int(32) NOT NULL COMMENT '座位',
  `car_color` varchar(32) NOT NULL COMMENT '车颜色',
  `car_brand` varchar(32) NOT NULL COMMENT '车品牌',
  `create_time` varchar(128) NOT NULL DEFAULT '' COMMENT '订单生成时间',
  `payment_code` char(10) NOT NULL DEFAULT '' COMMENT '支付方式名称代码',
  `payment_type` enum('1','2','0') NOT NULL DEFAULT '0' COMMENT '支付(付款)方式 1微信 2支付宝',
  `finished_time` varchar(128) NOT NULL COMMENT '订单完成时间',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '乘车费用',
  `status` varchar(32) NOT NULL DEFAULT '1' COMMENT '状态',
  `order_state` enum('0','10','20') NOT NULL DEFAULT '10' COMMENT '订单状态：0(已取消)10(默认):未付款;20:已付款;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Table structure for passby
-- ----------------------------
DROP TABLE IF EXISTS `passby`;
CREATE TABLE `passby` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '途经地id',
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `passby_pos` varchar(100) NOT NULL COMMENT '途径地',
  `passby_time` varchar(128) NOT NULL COMMENT '途经时间',
  `str_passby_time` varchar(128) NOT NULL COMMENT '途径地时间字符串',
  `passby_pos_img` varchar(255) NOT NULL COMMENT '途径地照片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shuttle
-- ----------------------------
DROP TABLE IF EXISTS `shuttle`;
CREATE TABLE `shuttle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `home_addr` varchar(100) NOT NULL COMMENT '家庭地址',
  `company_addr` varchar(100) NOT NULL COMMENT '公司地址',
  `on_work_time` varchar(128) NOT NULL COMMENT '上班时间',
  `off_work_time` varchar(128) NOT NULL COMMENT '下班时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='用户设置表';

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `propertyid` varchar(50) NOT NULL COMMENT '物业小区分类id',
  `usertype` int(11) DEFAULT NULL COMMENT '用户类型 0:普通业主 3:工程师 4:保安 9:物业客服',
  `cname` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `gender` tinyint(4) DEFAULT '1' COMMENT '性别 1男 2女',
  `tel` varchar(11) DEFAULT NULL COMMENT '登陆账号（用户电话）',
  `address` varchar(100) DEFAULT NULL COMMENT '用户地址',
  `img` varchar(100) DEFAULT NULL COMMENT '用户头像',
  `password` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL COMMENT '用户电话',
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '判断是否为商家 0不是 1是',
  `authcode` varchar(6) DEFAULT NULL COMMENT '验证码',
  `info` varchar(150) NOT NULL COMMENT '介绍',
  `createtime` date DEFAULT NULL COMMENT '创建时间',
  `bind` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COMMENT='用户表';
