CREATE TABLE `star_rating` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `star_rating`
  ADD PRIMARY KEY (`product_id`,`user_id`);
