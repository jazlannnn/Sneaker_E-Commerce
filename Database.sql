-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2022 at 08:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whitecanvas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(10) NOT NULL,
  `Admin_Username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Username`, `password`, `email`) VALUES
(1, 'Azlie', '12345', 'johariazlie@gmail.com'),
(3, 'Zeke', '12345', 'Zeke.99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(10) NOT NULL,
  `Customer_Username` varchar(50) NOT NULL,
  `Customer_Password` varchar(50) NOT NULL,
  `Customer_Email` varchar(50) NOT NULL,
  `Customer_PhoneNumber` varchar(50) NOT NULL,
  `Customer_Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_Username`, `Customer_Password`, `Customer_Email`, `Customer_PhoneNumber`, `Customer_Address`) VALUES
(1, 'Lee', '12345', 'johariazlie@gmail.com', '0194479368', '1X Jalan keramat, Keramat, 54000, KL, WIlayah Persekutuan, Malaysia'),
(4, 'Fitri Rafie', '123456', 'BeronDowski69@gmail.com', '0116689364', '1 x jalan keramat, 54000 KL'),
(16, 'Elon Musk ', '12345', 'ElonMusk@protonMail.com', '0196948749', 'No 23 Jalan Tun Razak, 50400, Kuala Lumpur, WP'),
(17, 'Alex', '12345', 'Alex.Brown@gmail.com', '0196689368', '23 X Jalan Pasir Gudang, KL,WP');

-- --------------------------------------------------------

--
-- Table structure for table `manageinventory`
--

CREATE TABLE `manageinventory` (
  `ManageInventory_ProductFK` int(10) NOT NULL,
  `ManageInventory_AdminFK` int(10) NOT NULL,
  `ManageInventory_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manageinventory`
--

INSERT INTO `manageinventory` (`ManageInventory_ProductFK`, `ManageInventory_AdminFK`, `ManageInventory_Date`) VALUES
(25, 1, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(20, 3, '2022-02-16'),
(18, 3, '2022-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `managepayment`
--

CREATE TABLE `managepayment` (
  `ManagePayment_PaymentFK` int(10) NOT NULL,
  `ManagePayment_AdminFK` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Orders_ID` int(10) NOT NULL,
  `Orders_Date` date NOT NULL,
  `Orders_TotalPrice` double NOT NULL,
  `Orders_CustomerFK` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Orders_ID`, `Orders_Date`, `Orders_TotalPrice`, `Orders_CustomerFK`) VALUES
(135, '2022-02-03', 589.97, 1),
(136, '2022-02-03', 560.49, 4),
(137, '2022-02-16', 359.97, 17);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `OrderDetails_ID` int(10) NOT NULL,
  `OrderDetails_Size` double NOT NULL,
  `OrderDetails_Quantity` int(11) NOT NULL,
  `OrderDetails_SubTotal` double NOT NULL,
  `OrderDetails_OrderFK` int(10) NOT NULL,
  `OrderDetails_ProductFK` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`OrderDetails_ID`, `OrderDetails_Size`, `OrderDetails_Quantity`, `OrderDetails_SubTotal`, `OrderDetails_OrderFK`, `OrderDetails_ProductFK`) VALUES
(270, 7.5, 1, 199.99, 135, 22),
(271, 7.5, 1, 129.99, 135, 21),
(272, 7.5, 1, 249.99, 135, 23),
(273, 7.5, 1, 299.99, 136, 15),
(274, 7.5, 1, 250.5, 136, 17),
(275, 7.5, 1, 119.99, 137, 8),
(276, 7.5, 1, 129.99, 137, 19),
(277, 7.5, 1, 99.99, 137, 20);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(10) NOT NULL,
  `Payment_Proof` varchar(255) NOT NULL,
  `Payment_OrderFK` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Payment_Proof`, `Payment_OrderFK`) VALUES
(83, 'Uploads/61fbb14d35b490.59076803.png', 135),
(84, 'Uploads/61fbb1cfdd7a63.08509181.png', 136),
(85, 'Uploads/620d4960d48082.81436924.png', 137);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(10) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Product_Price` double NOT NULL,
  `Product_Desc` varchar(255) NOT NULL,
  `Product_Quantity` int(11) NOT NULL,
  `Product_Gender` varchar(50) NOT NULL,
  `Product_Category` varchar(50) NOT NULL,
  `Product_Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Price`, `Product_Desc`, `Product_Quantity`, `Product_Gender`, `Product_Category`, `Product_Image`) VALUES
(7, 'Nike Air Force 1', 99.99, 'Top-selling lifestyle shoe by Nike', 60, 'Men', 'Lifestyle', 'Images/Image for catalog/Men/NikeAirForce1_Lifestyle_Men.jpg'),
(8, 'Air hurricane', 119.99, 'Stylish new black & white look with good comfort', 45, 'Men', 'Lifestyle', 'Images/Image for catalog/Men/Huarache_Lifestyle_Men.jpg'),
(10, 'Jordan Point', 199.99, 'Comfortable texture with detail design ', 50, 'Men', 'Lifestyle', 'Images/Image for catalog/Men/JordanPoint_Lifestyle_Men.jpg'),
(12, 'Nike Pegasus', 199.99, 'Top Nike shoes for running ', 60, 'Men', 'Running', 'Images/Image for catalog/Men/Nike_Pegasus_Running_Men.jpg'),
(13, 'Nike Zoom Fly', 399.99, 'Newly Nike released shoe for running ', 50, 'Men', 'Running', 'Images/Image for catalog/Men/Nike_Zoom_Fly_Running_Men.jpg'),
(14, 'Nike ZoomX', 120.5, 'Better fabric for quality run ', 65, 'Men', 'Running', 'Images/Image for catalog/Men/Nike_ZoomX_Running_Men.jpg'),
(15, 'Jordan Delta', 299.99, 'Top selling brand by Jordan ', 55, 'Men', 'Jordan', 'Images/Image for catalog/Men/JordanDelta_Jordan_Men.jpg'),
(16, 'Jordan Point ', 99.99, 'Classic look and well designed ', 20, 'Men', 'Jordan', 'Images/Image for catalog/Men/JordanPoint_Lifestyle_Men.jpg'),
(17, 'Jordan Gold', 250.5, 'Limited designer Collab with Nike  ', 20, 'Men', 'Jordan', 'Images/Image for catalog/Men/Nike_JorganGold_Jordan_Men.jpg'),
(18, 'Air Force 1 ', 99.99, 'Top Selling Nike shoe ', 62, 'Women', 'Lifestyle', 'Images/Image for catalog/Women/AirForce1_Lifestyle_Women.jpg'),
(19, 'Vintage X', 129.99, 'Top vintage Nike brand', 20, 'Women', 'Lifestyle', 'Images/Image for catalog/Women/VintageX_Lifestyle_Women.jpg'),
(20, 'Nike RYZ', 99.99, 'Great texture and comfy ', 146, 'Women', 'Lifestyle', 'Images/Image for catalog/Women/NikeRYZ_Lifestyle_Women.jpg'),
(21, 'Nike Air Zoom', 129.99, 'Top Female running shoes', 75, 'Women', 'Running', 'Images/Image for catalog/Women/NikeAirZoom_Running_Women.jpg'),
(22, 'Nike Revolution ', 199.99, 'Newly Running shoes by Nike ', 45, 'Women', 'Running', 'Images/Image for catalog/Women/NikeRevolution_Running-Women.jpg'),
(23, 'Nike Air Tempo', 249.99, 'Top trending women\'s running shoe', 70, 'Women', 'Running', 'Images/Image for catalog/Women/NikeAirTempo_Running_Women.jpg'),
(24, 'Air Jordan 11', 159.99, 'Top Trending women\'s Jordan ', 55, 'Women', 'Jordan', 'Images/Image for catalog/Women/AirJordan11_Jordan_Women.jpg'),
(25, 'Jordan Delta', 299.99, 'Well designed and comfy texture', 55, 'Women', 'Jordan', 'Images/Image for catalog/Women/JordanDeltaX_Jordan_Women.jpg'),
(26, 'Jordan M.A', 149.99, 'Popular vintage designed with comfy texture', 35, 'Women', 'Jordan', 'Images/Image for catalog/Women/JordanMA2_Jordan_Women.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sales_ID` int(11) NOT NULL,
  `Sales_Sales` double NOT NULL,
  `Sales_Date` date NOT NULL,
  `Sales_AdminFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `manageinventory`
--
ALTER TABLE `manageinventory`
  ADD KEY `ManageInventory_ProductFK` (`ManageInventory_ProductFK`),
  ADD KEY `ManageInventory_AdminFK` (`ManageInventory_AdminFK`);

--
-- Indexes for table `managepayment`
--
ALTER TABLE `managepayment`
  ADD KEY `ManagePayment_PaymentFK` (`ManagePayment_PaymentFK`),
  ADD KEY `ManagePayment_AdminFK` (`ManagePayment_AdminFK`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Orders_ID`),
  ADD KEY `Orders_CustomerFK` (`Orders_CustomerFK`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`OrderDetails_ID`),
  ADD KEY `OrderDetails_OrderFK` (`OrderDetails_OrderFK`),
  ADD KEY `OrderDetails_ProductFK` (`OrderDetails_ProductFK`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Payment_OrderFK` (`Payment_OrderFK`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sales_ID`),
  ADD KEY `Sales_AdminFK` (`Sales_AdminFK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Orders_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `OrderDetails_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sales_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manageinventory`
--
ALTER TABLE `manageinventory`
  ADD CONSTRAINT `manageinventory_ibfk_1` FOREIGN KEY (`ManageInventory_AdminFK`) REFERENCES `admin` (`Admin_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manageinventory_ibfk_2` FOREIGN KEY (`ManageInventory_ProductFK`) REFERENCES `product` (`Product_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `managepayment`
--
ALTER TABLE `managepayment`
  ADD CONSTRAINT `managepayment_ibfk_1` FOREIGN KEY (`ManagePayment_AdminFK`) REFERENCES `admin` (`Admin_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `managepayment_ibfk_2` FOREIGN KEY (`ManagePayment_PaymentFK`) REFERENCES `payment` (`Payment_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Orders_CustomerFK`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`OrderDetails_OrderFK`) REFERENCES `orders` (`Orders_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`OrderDetails_ProductFK`) REFERENCES `product` (`Product_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Payment_OrderFK`) REFERENCES `orders` (`Orders_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`Sales_AdminFK`) REFERENCES `admin` (`Admin_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
