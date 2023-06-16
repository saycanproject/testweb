CREATE TABLE `member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `code` char(60) DEFAULT NULL,
  `status` enum('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
  `role` set('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z') NOT NULL DEFAULT 'm',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `business` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `bizname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active', 'pending', 'rejected') NOT NULL DEFAULT 'pending',
  `extra_info` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `member_id_index` (`member_id`),
  FOREIGN KEY (`member_id`) REFERENCES `member`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `funding` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `business_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
  `extra_info` json DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_id_index` (`business_id`),
  KEY `member_id` (`member_id`),
  FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `relation` (
  `member_id` int NOT NULL,
  `business_id` int NOT NULL,
  PRIMARY KEY (`member_id`,`business_id`),
  KEY `relation_member_id_index` (`member_id`),
  KEY `relation_business_id_index` (`business_id`),
  FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `business_id` int NOT NULL,
  `category` enum('income','expense') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text,
  `extra_info` json DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_id_index` (`business_id`),
  KEY `member_id` (`member_id`),
  FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `json_options` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;