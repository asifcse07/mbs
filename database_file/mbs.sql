-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 04:43 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_no` varchar(20) DEFAULT NULL,
  `idntity_file` varchar(200) DEFAULT NULL,
  `opening_amount` decimal(30,6) DEFAULT 0.000000,
  `amount` decimal(30,6) DEFAULT 0.000000,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_transactions`
--

CREATE TABLE `accounts_transactions` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `transaction_type` int(4) DEFAULT NULL,
  `amount` decimal(30,6) DEFAULT 0.000000,
  `transfer_to` int(11) DEFAULT NULL,
  `invoice_no` varchar(16) DEFAULT NULL,
  `remakrs` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `father_name` varchar(250) DEFAULT NULL,
  `mother_name` varchar(250) DEFAULT NULL,
  `gender` int(2) DEFAULT 0,
  `mobile_no` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `passcode` varchar(8) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_transactions`
--
ALTER TABLE `accounts_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts_transactions`
--
ALTER TABLE `accounts_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
