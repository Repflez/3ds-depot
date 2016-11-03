SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE `3ds_depot` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `3ds_depot`;

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `titleid` varchar(16) NOT NULL DEFAULT '0000000000000000',
  `name` varchar(200) NOT NULL DEFAULT 'No Game Name',
  `region` varchar(3) NOT NULL DEFAULT 'ALL',
  `serial` varchar(20) NOT NULL DEFAULT 'CTR-P-CTAP'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titleid` (`titleid`);

ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;