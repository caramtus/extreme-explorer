-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 03:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `extreme_explorer`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catID` int(11) NOT NULL,
  `catName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `catName`) VALUES
(1, 'Red Wine'),
(2, 'White Wine'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(50) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `suburb` varchar(50) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `street`, `suburb`, `state`, `zip`, `mobile`, `tel`, `email`, `username`, `password`) VALUES
(1, 'jsmith Smith', '12 asdafdf', 'asfdasfd', 'nsw', 2211, '1234567891', '1234554321', 'asdfdasd@sgsg.jk', 'jsmith', '12345'),
(11, ' ', '', '', '', 0, '', '', '', '', ''),
(12, ' ', '', '', '', 0, '', '', '', '', ''),
(13, ' ', '', '', '', 0, '', '', '', '', ''),
(14, ' ', '', '', '', 0, '', '', '', '', ''),
(17, 'Adrian Paras ', '47 Samantha Crescent', 'Glendenning', 'NSW', 2761, '0414023023', '0414023023', 'yanyan03@gmail.com', 'adrian', 'adrian123456');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `colour` varchar(50) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `description`, `size`, `colour`, `price`, `type`, `catID`) VALUES
(1, 'Fat Cat Shiraz 2021 - 1 Case', 'The Fat Cat Shiraz from Cat Amongst the Pigeons from the Barossa is made from carefully selected grapes, chosen for their superior quality. The result? The ultimate Borossa Shiraz full of intense, rich flavours of plum, blackberry and a hint of spice.', '', 'gray', 136.00, '', 1),
(2, 'Barossa Shiraz - 1 Case', 'Little Giant produces regionally focussed distinctive wines that consistently deliver the taste of South Australia in every glass proving great things come in small packages! A proud Platinum supporter of WIRES animal rescue, we ensure the continued welfare of wombats and their rehabilitation.', '', 'green', 113.26, '', 1),
(3, 'Over The Shoulder Pinot Noir', 'The team at Oakridge are going from strength to strength these days and they are taking the Over The Shoulder range with them. Dry maraschino cherry and gently gamey yet clean mouthful of delicious Pinot! Really great finishing length for this sort of price!', '', '', 131.93, '', 1),
(4, 'Vasse Felix', 'Bright pale straw, with a green tinge. Delicate lifted perfume of lemon blossom, orange pith, bright Kaffir lime, jasmine, and Lily flowers. A soft, clean, and bright, fresh palate. Comfortable body and acidity with orange zest and sweet straw flavours ending with a squeaky bright, dry finish.', '', '', 35.00, '', 2),
(5, 'Petaluma', 'Petaluma use their impressive vineyard holding in the Adelaide Hills to produce a Chardonnay that shows poise and precision. Sourced from vineyards in Lenswood and Balhannah and then fermented in a combination of one and two year old French oak as well as stainless steel. Lees stirring helps add complexity and texture while the cool-climate fruit adds minerality and freshness.', '', '', 78.82, '', 2),
(6, 'South Island', 'Lovers of Marlborough Sauvignon Blanc who are keeping an eye on their waistbands will fall in love with the latest addition to the South Island range. The South Island White Mist Sauvignon Blanc is sourced from the world\'s most famous region for Sauvignon Blanc and contains all the typical flavours of gooseberry and citrus we\'ve all come to love. The bonus here is the 25% less calories than the standard South Island meaning you can enjoy that glass of Savvie guilt free.', '', '', 77.29, '', 2),
(7, 'Wine Gift Box', 'Multipurpose wine box Our wine storage box can hold up to one bottle of wine, craft beer or champagne. Suitable for wedding, anniversary, birthday party, housewarming and other occasions. It also can be used for Home decor, bar decor, and your personal wine collection. And a perfect wine storage for travel carrying.', NULL, 'Black and green', 75.00, NULL, 3),
(8, 'LEIAOLY Wine Cooler', 'LEIAOLY Wine Chiller Stick, a combination of wine bottle chiller, filter and pourer, allow you enjoy a glass of perfect chilled wine at optimal temperature. Its elegant design will add a level of refinement to your wine drinking experience, is the perfect gift for wine lovers.', NULL, 'Black and gray', 19.99, NULL, 3),
(9, 'TANGCLIZI Wine Opener', 'Sturdy Metal - Made of solid zinc alloy with high quality construction. You will truly feel this weighted wine opener is heavy in your hand.\r\n\r\nNo Cork Tear - Sharp pointed spiral goes into the cork quickly and efficiently. No need to worry about the cork remnants in the wine. Just enjoy the sip without hassle.\r\n\r\nEasy To Screw - Featured with a big sleek turn handle for easy to screw. For people with arthritic hands and the elderly, IPOW wine opener will be a great choice.', '7ft', 'Black and white', 20.00, NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `catID` (`catID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `category` (`catID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
