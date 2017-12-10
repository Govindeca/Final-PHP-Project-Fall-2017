/*
 Navicat MySQL Data Transfer

 Source Server         : MyLocalDB
 Source Server Type    : MySQL
 Source Server Version : 50622
 Source Host           : localhost
 Source Database       : UserManager

 Target Server Type    : MySQL
 Target Server Version : 50622
 File Encoding         : utf-8

 Date: 11/03/2017 10:42:58 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `UserDetails`
-- ----------------------------
DROP TABLE IF EXISTS `UserDetails`;
CREATE TABLE `UserDetails` (
  `UserID` varchar(120) NOT NULL,
  `UserName` varchar(150) NOT NULL,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(1000) DEFAULT NULL,
  `MemberSince` varchar(255) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserName`,`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `UserDetails`
-- ----------------------------
BEGIN;
INSERT INTO `UserDetails` VALUES ('pzujj5', 'admin', 'Paula', 'p', 'cursus.non.egestas@sempercursus.co.uk', 'bea881cc49fcc7fa395647799a59f61fe5e0bd231732c711aba8dd6e445248980', '1491236221', '1'), ('tjewkm', 'admin2', 'Pr', 'M', 'p@g.co', '3f9da0c63313c28939b5f850b784914fcd8b6f3ae018b9d7da5bd677599719c18', '1491237181', '1'), ('cyftrb', 'FrodoBaggins', 'Frodo', 'Baggins', 'frodo@localhost.com', 'ce1615712e24b7c7ebf23feab855a75b4a8a852bbcfae9a99911246256a0fe497', '1447091580', '1'), ('kgo8as', 'Gandalf', 'Gandalf', 'The White', 'gandalf@lotr.com', '544e4add46abcd2d71719d88b7ba3ffd79305e76f8f5646fd565d7e938696644a', '1478648340', '1'), ('e3njt7', 'JSmith', 'J', 'Smith', 'r@g.com', 'fefda3cb1dc072fa024e24e24f21e5d7b82e421f1ea2259a6f573b3e339e117cc', '1491520600', '1'), ('w05c3h', 'NedStark', 'Ned', 'Stark', 'ned@stark.com', 'e8af7aba9dc4fd9a69170487dcdb42adc47d9625875e5e43cec45e213b9a8e59a', '1478735594', '1'), ('nuptj3', 'PraviinM', 'Praviin', 'Mandhare', 'pravsm@gmail.com', '8d66f8f3836b4346e4ec9f766190e7539fa6b4fa0c728a9ee13cdd372552bc3d3', '1477402585', '1'), ('8rtq1t', 'PraviinM2', 'p', 'p', '1@gmai.com', '5378cff9f6baeae832a293dea1815bbfad6a4a6e623eb00216040966114f30b5c', '1509578963', '1'), ('3nv7pq', 'PraviinM2', 'Praviin', 'M', '21@gmail.com', '2d51006cb43de35454c91350b375490ba65109108519cb8864306ca6edb369047', '1509490531', '1'), ('w3vk4e', 'PraviinM3', 'p', 'm', '1@gmai.com', '5ddbbbdc7811e6b50f8e1f46015cfb01c2f35b28f7eadc19f6fb2953abc7f2449', '1509491714', '0'), ('nwkcgz', 'Tommy', 'Tommy', 'Tommy', 'tommy@tommy.com', 'b99323d7cfce96fd4da498c1112fe2f343804274fb78252f1a7b02830136c613c', '1477436541', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
