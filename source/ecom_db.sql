-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 05:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db_tuitt`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `image_path`, `category_id`) VALUES
(1, 'Egg', '15.00', 'Everyones favorite breakfast companion', '../assets/images/1548171741-egg.jpg', 1),
(2, 'Tapsilog', '49.00', 'Marinated beef with poached egg on garlic rice', '../assets/images/item_tapsilog.jpg', 1),
(3, 'Pares', '59.00', 'Beef broth with bone marrow and intestines', '../assets/images/item_pares.jpg', 2),
(4, 'Tuyo', '120.00', 'Dried Mackerel', '../assets/images/item_tuyo.jpg', 2),
(5, 'Adobo', '49.00', 'Chicken marinated in soy sauce and vinegar with black pepper and bayleaf\r\n', '../assets/images/item_adobong_manok.jpg', 3),
(15, 'Tinola', '59.00', 'Chicken with wedges of green papaya, and leaves of the siling labuyo chili pepper in broth flavored with ginger, onions and fish sauce', '../assets/images/item_tinola.jpg', 3),
(24, 'Kare Kare', '129.00', 'Meat and vegetables with thick savory peanut sauce', '../assets/images/1548172462-kare-kare.jpg', 2),
(25, 'Sinigang', '99.00', 'Sour and savoury soup with meat and vegetables', '../assets/images/1548172584-sinigang.jpg', 3),
(26, 'Fried Chicken', '69.00', 'Everyones favorite childhood food', '../assets/images/1548172676-chicken.jpg', 2),
(27, 'Nilaga', '119.00', 'Beef in clear broth with potato, saba banana, and pechay', '../assets/images/1548172857-nilaga.jpg', 3),
(28, 'Tocilog', '49.00', 'Marinated pork with poached egg on garlic rice', '../assets/images/1548173028-tocilog.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int(11) NOT NULL,
  `payment_mode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `transaction_code`, `purchase_date`, `status_id`, `payment_mode_id`) VALUES
(47, 5, '64C8385C1F117FB1-1547700885', '2019-01-16 21:54:45', 3, 1),
(48, 9, 'D09DED44DB194946-1548053824', '2019-01-20 23:57:04', 2, 1),
(49, 5, '0AAC752EE4A7232B-1548120321', '2019-01-21 18:25:21', 1, 1),
(50, 5, 'F18BBE10B2D98AEB-1548120348', '2019-01-21 18:25:48', 3, 1),
(51, 5, 'EABE4ACA4D529BCA-1548120375', '2019-01-21 18:26:15', 1, 1),
(52, 5, '09E6179F099F73AD-1548120389', '2019-01-21 18:26:29', 1, 1),
(53, 5, '1F948ABB1AA3EA03-1548120412', '2019-01-21 18:26:52', 3, 1),
(54, 9, '00419B4EAF6C0444-1548127207', '2019-01-21 20:20:07', 1, 1),
(55, 9, '034E6417C1AFC44E-1548127233', '2019-01-21 20:20:33', 1, 1),
(56, 9, '5E4A04E198DBB454-1548127247', '2019-01-21 20:20:47', 2, 1),
(57, 9, '636A4C7BBED4F2A7-1548127262', '2019-01-21 20:21:02', 1, 1),
(58, 9, '771654209A73603F-1548127276', '2019-01-21 20:21:16', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `quantity`) VALUES
(86, 47, 1, '10.00', 2),
(87, 48, 15, '69.00', 2),
(88, 48, 5, '45.00', 2),
(89, 48, 1, '10.00', 2),
(90, 49, 5, '45.00', 1),
(91, 49, 15, '69.00', 1),
(92, 49, 1, '10.00', 1),
(93, 49, 3, '45.00', 1),
(94, 49, 2, '69.00', 1),
(95, 49, 4, '120.00', 1),
(96, 50, 2, '69.00', 10),
(97, 51, 5, '45.00', 3),
(98, 51, 15, '69.00', 3),
(99, 51, 1, '10.00', 3),
(100, 52, 3, '45.00', 2),
(101, 52, 2, '69.00', 2),
(102, 52, 4, '120.00', 2),
(103, 53, 5, '45.00', 1),
(104, 53, 15, '69.00', 1),
(105, 53, 1, '10.00', 1),
(106, 53, 3, '45.00', 1),
(107, 53, 2, '69.00', 1),
(108, 53, 4, '120.00', 1),
(109, 54, 5, '45.00', 3),
(110, 54, 15, '69.00', 3),
(111, 55, 2, '69.00', 20),
(112, 56, 4, '120.00', 5),
(113, 57, 1, '10.00', 10),
(114, 58, 2, '69.00', 3),
(115, 58, 3, '45.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE `payment_modes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `name`) VALUES
(1, 'COD'),
(2, 'Paypal');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'completed'),
(3, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `address`, `role_id`) VALUES
(1, 'Admin', 'Admin', 'admin', '$2y$10$OxrZy.RLcojM5yvBTqQioOyS3nvcQF.yw8l/ONbPQL.l6fltSsbdG', 'wheresthefoodphilippines@gmail.com', '2437 Taal St. Malate Manila', 1),
(5, 'Alyssa', 'Cape', 'alyssacape', '$2y$10$htk8/vWaymkeZ9bQYZYU6OMdTd9B93hWF4nuw6lzc9QnGRRJqJSLW', 'alyssacape@gmail.com', '2437 Taal St. Malate Manila', 2),
(9, 'Axis', 'Arreola', 'axisarreola', '$2y$10$hNNH7aIIAKy5wDpXIEQBEOxMt6yEnOObNkgU7WYv2Y6PLU5D4tnUy', 'benedictmartinii.arreola@gmail.com', '2437 Taal St. Malate Manila', 2),
(11, '1234567890', '1234567890', '1234567890', '$2y$10$qyPnnauF4zhlaJzUpW5omu111VeiH.2xJ9..7b68M4JuMobXJGiIi', '1234567890@gmail.com', '1234567890', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_modes` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
