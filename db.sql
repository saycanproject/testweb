CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `investment` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `funding` (
  `member_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`, `business_id`),
  FOREIGN KEY (`member_id`) REFERENCES `member`(`id`),
  FOREIGN KEY (`business_id`) REFERENCES `business`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `category` enum('income','expense') NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`business_id`) REFERENCES `business`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
