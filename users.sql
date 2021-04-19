SET NAMES utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(19) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `view_date` datetime NOT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `views_count` tinyint NOT NULL,
  PRIMARY KEY (`id`)
);

