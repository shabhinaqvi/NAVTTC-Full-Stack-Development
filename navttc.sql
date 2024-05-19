-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 01:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `navttc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Description` varchar(500) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Name`, `Description`, `image`) VALUES
(1, 'Bags', 'Lugage Bag', 'OIP.jfif'),
(2, 'Computer', 'DELL', 'OIP (1).jfif'),
(3, 'Laptop', 'HP', 'maxresdefault.jpg'),
(5, 'Purse', 'Carry', 'OIP.jfif'),
(8, 'Volit', 'Pocket bag', 'OIP.jfif'),
(12, 'Bag', 'abc', 'maxresdefault.jpg'),
(13, 'asd', 'er', 'testimonial-1.jpg'),
(14, 'Mobile', 'Techno', 'Mob.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `p_price` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `u_email` varchar(200) NOT NULL,
  `status` varchar(200) DEFAULT 'pending',
  `dateTime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `p_id`, `p_name`, `p_qty`, `p_price`, `u_id`, `u_name`, `u_email`, `status`, `dateTime`) VALUES
(1, 2, 'Gaon', 2, 5000, 12, 'kashif', 'kashi@gmail.com', NULL, NULL),
(2, 6, 'Hand Carry', 3, 12345, 12, 'kashif', 'kashi@gmail.com', NULL, NULL),
(3, 3, 'Techno', 4, 45000, 12, 'kashif', 'kashi@gmail.com', NULL, NULL),
(4, 6, 'Hand Carry', 3, 12345, 12, 'kashif', 'kashi@gmail.com', 'pending', '2024-05-13 11:59:47'),
(5, 5, 'Hand Bag', 2, 5000, 12, 'kashif', 'kashi@gmail.com', 'pending', '2024-05-13 12:00:57'),
(6, 3, 'Techno', 3, 45000, 12, 'kashif', 'kashi@gmail.com', 'pending', '2024-05-13 12:00:57'),
(7, 7, 'Hand Bag', 2, 45678, 12, 'kashif', 'kashi@gmail.com', 'pending', '2024-05-14 08:09:24'),
(8, 2, 'Gaon', 23, 5000, 12, 'kashif', 'kashi@gmail.com', 'pending', '2024-05-14 08:09:24'),
(9, 3, 'Techno', 1, 45000, 12, 'kashif', 'kashi@gmail.com', 'pending', '2024-05-14 08:09:24'),
(10, 7, 'Hand Bag', 4, 45678, 15, 'Admin', 'admin', 'pending', '2024-05-15 10:14:31'),
(11, 3, 'Techno', 30, 45000, 15, 'Admin', 'admin', 'pending', '2024-05-15 10:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `catid` int(11) NOT NULL,
  `procid` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `image`, `catid`, `procid`) VALUES
(2, 'Gaon', 'ASD', 5000, 2, 'Screenshot 2024-02-29 174953.png', 13, NULL),
(3, 'Techno', 'Mob', 45000, 5, 'Mob.jpg', 14, NULL),
(5, 'Hand Bag', 'asd', 5000, 1, 'images.jfif', 1, NULL),
(6, 'Hand Carry', 'bag', 12345, 42, 'cb7a4018b4ead03b272c9d5d9449af63.jpg', 1, NULL),
(7, 'abc', 'asdf', 45678, 4, 'cb7a4018b4ead03b272c9d5d9449af63.jpg', 1, NULL),
(8, 'Phone', 'dhkj', 50000, 2, '', 14, 'PR-94fd5f49-136f-11ef-9c61-90b11c60f675'),
(9, 'Mouse', 'Input device', 500, 1, '123', 2, 'PR-b2524e23-1371-11ef-9c61-90b11c60f675'),
(10, 'Keyboard', 'Input Device', 1000, 1, 'download (1).jfif', 2, 'PR-259641ce-1372-11ef-9c61-90b11c60f675');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `ProductID` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    IF NEW.procid IS NULL THEN
        SET NEW.procid = CONCAT('PR-', UUID());
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `test` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    IF NEW.procid IS NULL THEN
        SET NEW.procid = CONCAT('PR-', UUID());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `age`, `city`, `gender`, `salary`, `department`, `address`) VALUES
(1, 'Shabhi', 'Shabhi@gma', 27, 'karachi', 'male', '42500', 'management', 'malir'),
(2, 'nimra', 'nimra@gmai', 21, 'karachi', 'female', '49178', 'technical', 'gulshan e Iqbal'),
(3, 'asad', 'asad@gmail', 27, 'karachi', 'male', '37390', 'management', 'malir'),
(4, 'muneeb', 'muneeb@gma', 32, 'lahore', 'female', '103500', 'technical', 'gulshan e Iqbal'),
(5, 'mubeen', 'mubeen@gma', 30, 'lahore', 'male', '22500', 'management', 'gulshan e hadeed'),
(6, 'rafy', 'rafy@gmail', 28, 'lahore', 'female', '53500', 'technical', 'North'),
(7, 'yaqoob', 'yaqoob@gma', 27, 'Islamabad', 'male', '42500', 'management', 'gulshan e hadeed'),
(8, 'iqra', 'iqra@gmail', 21, 'Islamabad', 'female', '53500', 'technical', 'North');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `roleid` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `roleid`) VALUES
(6, 'Shabhi', 'Shabiii', '10fff7184284f1cab3c739cd5130de6f1c5e831b', 2),
(8, 'Hamza', 'hamza@gmail.com', 'd798d4338adeb553a1089a58e61e18c2fcdf77bb', 2),
(10, 'Ali', 'ali@gmail.com', '749bc367fd90880f2d6dbe578e98e14645b0b26d', 2),
(11, 'Ahsan', 'ahsan@gmail.com', '056eafe7cf52220de2df36845b8ed170c67e23e3', 2),
(12, 'kashif', 'kashi@gmail.com', '95938f7d0a9581a694282ebac1c4c49e0e19c1cd', 2),
(13, 'ahmad', 'ahamd@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2),
(14, 'asad', 'asad@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(15, 'Admin', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2),
(16, 'hasan', 'hasan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `UNION_email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
