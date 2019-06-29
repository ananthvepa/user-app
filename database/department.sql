-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2019 at 02:39 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `department`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(10) NOT NULL,
  `department_name` varchar(20) NOT NULL,
  `commission_percentage` int(10) NOT NULL,
  `allowance_payable` float NOT NULL,
  `last_month_deduction` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `commission_percentage`, `allowance_payable`, `last_month_deduction`) VALUES
(1, ' Department 1', 1, 1212.33, 1002),
(2, ' Department 2', 2, 3131.44, 333),
(3, 'Department 3', 12, 23334.9, 22),
(4, 'Department 4', 20, 6733.9, 213123),
(5, 'Department 5', 15, 331321, 123123),
(6, 'Department 6', 18, 21312300, 2122),
(7, 'Department 7', 12, 789992, 67732),
(8, 'Department 8', 25, 33222, 222),
(9, 'Department 9', 10, 213123, 589),
(10, 'Department 10', 30, 213123, 300);

-- --------------------------------------------------------

--
-- Table structure for table `payable_salary_tax_charge`
--

CREATE TABLE `payable_salary_tax_charge` (
  `payable_tax_charge_id` int(11) NOT NULL,
  `payable_salary_upto` float NOT NULL,
  `tax_pecentage_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payable_salary_tax_charge`
--

INSERT INTO `payable_salary_tax_charge` (`payable_tax_charge_id`, `payable_salary_upto`, `tax_pecentage_value`) VALUES
(1, 100, 1.5),
(2, 500, 2.5),
(3, 1000, 3.6),
(4, 1500, 3.9),
(5, 2000, 4),
(6, 8000, 8.3),
(7, 20000, 9.1),
(8, 50000, 11.9),
(9, 100000, 13.9),
(10, 1000000, 30.9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type_id` int(10) NOT NULL,
  `department_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `user_type_id`, `department_id`) VALUES
(1101, 'Ananth', 'Vepa', 'ananthvepa@gmail.com', 'ananth@123', 2, 3),
(1102, 'Ravi', 'Vepa', 'ravi@gmail.com', 'ravi123', 2, 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `users_view`
-- (See below for the actual view)
--
CREATE TABLE `users_view` (
`first_name` varchar(20)
,`last_name` varchar(20)
,`payable_salary` float
,`basic_salary` float
,`tax_value` float
,`last_month_deduction` float
,`user_type_name` varchar(20)
,`department_name` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(10) NOT NULL,
  `payable_salary` float NOT NULL,
  `basic_salary` float NOT NULL,
  `tax_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `payable_salary`, `basic_salary`, `tax_value`) VALUES
(1101, 28912.9, 5000, 3440.64),
(1102, 28912.9, 5000, 3440.64);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(20) NOT NULL,
  `basic_salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `basic_salary`) VALUES
(1, 'Worker 1', 2000),
(2, 'Worker 2', 5000),
(3, 'Worker 3', 10000),
(4, 'Worker 4', 13000),
(5, 'Worker 5', 15000);

-- --------------------------------------------------------

--
-- Structure for view `users_view`
--
DROP TABLE IF EXISTS `users_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_view`  AS  select `user`.`first_name` AS `first_name`,`user`.`last_name` AS `last_name`,`ua`.`payable_salary` AS `payable_salary`,`ua`.`basic_salary` AS `basic_salary`,`ua`.`tax_value` AS `tax_value`,`dep`.`last_month_deduction` AS `last_month_deduction`,`ut`.`user_type_name` AS `user_type_name`,`dep`.`department_name` AS `department_name` from (((`user` join `user_accounts` `ua`) join `department` `dep`) join `user_type` `ut`) where ((`user`.`user_id` = `ua`.`user_id`) and (`dep`.`department_id` = `user`.`department_id`) and (`ut`.`user_type_id` = `user`.`user_type_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `payable_salary_tax_charge`
--
ALTER TABLE `payable_salary_tax_charge`
  ADD PRIMARY KEY (`payable_tax_charge_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD CONSTRAINT `user_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
