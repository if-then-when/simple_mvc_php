CREATE DATABASE IF NOT EXISTS `mvc` ;

CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB;


INSERT INTO `users` (`id`, `login`, `password`) VALUES (0, 'user', '5f4dcc3b5aa765d61d8327deb882cf99');


CREATE TABLE `balance` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp(),
  `value` decimal(10,2) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  FOREIGN KEY fk_users(user_id)
  REFERENCES users(id)
  ON UPDATE CASCADE
 ON DELETE RESTRICT
) ENGINE=InnoDB;


INSERT INTO `balance` (`id`, `user_id`, `datetime`, `value`, `password`) VALUES (2, 0, '2020-08-06 12:45:57', '500.00', '5f4dcc3b5aa765d61d8327deb882cf99');
