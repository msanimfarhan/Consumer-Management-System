-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 07:13 AM
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
-- Database: `whats_happening`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventTypeID` int(11) UNSIGNED NOT NULL,
  `GroupID` int(11) UNSIGNED NOT NULL,
  `EventDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `SubmitDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `EventTitle` varchar(100) NOT NULL,
  `EventImage` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EventDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventTypeID`, `GroupID`, `EventDate`, `SubmitDate`, `EventTitle`, `EventImage`, `EventDesc`) VALUES
(1, 5, 1, '2024-02-25 22:00:00', '2024-01-04 01:11:38', 'Support Spay and Neuter Day\r\n', 'files/images/events/animal1.jpg\r\n', 'Nullam id pellentesque ante. Vestibulum in convallis mauris. Duis dolor augue, varius eget gravida eu, ullamcorper vitae sem. Curabitur eleifend maximus finibus. Phasellus sagittis porttitor augue ut commodo. Duis dolor augue, varius eget gravida eu, ullmcorper vitae sem\r\n'),
(2, 3, 6, '2024-02-26 15:00:00', '2024-01-16 01:11:38', 'Come Skate on the Oval\r\n', 'files/images/events/skate3.jpg\r\n', 'Nunc vel commodo sapien, Phasellus ac enim sit amet ligula congue scelerisque sit amet ligula congue scelerisque sit amet quis tellus. Ut tincidunt nibh sapien, nec interdum eros fringilla in.\r\n'),
(3, 3, 8, '2024-02-28 00:00:00', '2024-01-16 09:07:28', 'Learn to Ski\r\n', 'files/images/events/ski6.jpg', 'Aliquam consequat, est et posuere maximus, magna arcu dapibus justo. Nulla euismod elit in mauris dignissim auctor\r\n'),
(4, 4, 2, '2024-02-28 21:00:00', '2024-02-01 18:08:44', 'Food/Wine Pairing\r\n', 'files/images/events/food1.jpg', 'Aenean odio ante, efficitur vel porttitor id, imperdiet ut urna. Ut tincidunt nibh sapien, nec interdum eros fringilla in. Cras accumsan rutrum arcu ac congue. Integer finibus velit eu elementum rutrum.\r\n'),
(5, 2, 3, '2024-03-01 22:00:00', '2024-02-18 13:18:10', 'Exhibition of Local Dance\r\n', 'files/images/events/dance1.jpg', 'sed sit amet urna sed nisl lobortis pharetra sit amet at nulla. Nulla euismod elit in mauris dignissim auctor. Aenean a diam non turpis mollis auctor ac quis est.\r\n'),
(6, 5, 4, '2024-03-08 20:00:00', '2024-02-21 01:27:33', 'Local Bands compete to raise funds for national competition\r\n', 'files/images/events/music1.jpg', 'Ut ligula metus, pretium non dapibus dictum, rutrum et magna. Pellentsque et lorem in diam pharetra curus eget et ex. Integer finibus velit eu elementum rutrum.\r\n'),
(7, 5, 1, '2024-06-02 16:00:00', '2024-02-18 10:16:11', 'Meet Greet AND Adapt Day\r\n', 'files/images/events/animal3.jpg', 'Ut ligula metus, pretium non dapibus dictum, rutrum et magna. Pellentsque et lorem in diam pharetra curus eget et ex. Integer finibus velit eu elementum rutrum.\r\n'),
(8, 5, 5, '2024-06-25 20:00:00', '2024-02-14 13:08:11', 'Auction of local art to support local artist', 'files/images/events/art1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare nulla ac aliquet ultricies. Donec egestas nunc massa, faucibus vestibulum lorem eleifend ut.'),
(9, 1, 4, '2024-07-29 21:00:00', '2024-02-18 01:31:27', 'Spring concert', 'files/images/events/music2.jpg', 'Vestibulum venenatis nunc mi, convallis faucibus sem fringilla pellentesque. Curabitur eu ipsum pretium, faucibus ante sed, rhoncus justo'),
(10, 4, 2, '2024-06-30 04:00:00', '2024-02-20 01:31:26', 'Spring Hamper - Get Yours', 'files/images/events/food7.jpg', 'Fusce aliquet gravida mauris, cursus dictum augue blandit ac. ');

-- --------------------------------------------------------

--
-- Table structure for table `eventtypes`
--

CREATE TABLE `eventtypes` (
  `EventTypeID` int(11) NOT NULL,
  `EventType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventtypes`
--

INSERT INTO `eventtypes` (`EventTypeID`, `EventType`) VALUES
(1, 'Music'),
(2, 'Art+Culture'),
(3, 'Sports'),
(4, 'Food'),
(5, 'Fund Raiser');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` int(11) UNSIGNED NOT NULL,
  `GroupName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `GroupImage` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `GroupType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `GroupDesc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ContactName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ContactEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`, `GroupImage`, `GroupType`, `GroupDesc`, `ContactName`, `ContactEmail`) VALUES
(1, 'Human Society\r\n', 'files/images/Groups/HumanSociety.jpg', 'Animal Shelter\r\n', 'Nullam id pellentesque ante. Vestibulum in convallis mauris.Duis dolor augue, varius eget gravida eu, ullamcorper vitae sem. Curabitur eleifend maximus finibus. Phasellus sagittis porttitor augue ut commodo.Duis dolor augue, varius eget gravida eu, ullamcorper vitae sem. \r\n', 'Petra Barn', 'pb@hs.com'),
(2, 'Eat Local\r\n', 'files/images/Groups/EatLocal.jpg', 'Promotes Local Farms\r\n', 'Aenean odio ante, efficitur vel porttitor id, imperdiet ut urna. Ut tincidunt nibh sapien, nec interdum eros fringilla in. Cras accumsan rutrum arcu ac congue. Integer finibus velit eu elementum rutrum.\r\n', 'Joe Farm', 'joe@farms.com'),
(3, 'Dance NS\r\n', 'files/images/Groups/DanceNS.jpg', 'Dance for Youth\r\n', 'Sed sit amet urna sed nisl lobortis pharetra sit amet at nulla. Nulla euismod elit in mauris dignissim auctor. Aenean a diam non turpis mollis auctor ac quis est.\"\r\n', 'Ami Glen', 'ami@NSD.com'),
(4, 'Youth Band\r\n', 'files/images/Groups/YouthBand.jpg', 'Promotes Local School Bands\r\n', 'Ut ligula metus, pretium non dapibus dictum, rutrum at magna. Pellentesque et lorem in diam pharetra cursus eget et ex. Integer finibus velit eu elementum rutrum.\r\n', 'Drum Trumpet', 'DT@band.com'),
(5, 'Nocturne Association\r\n', 'files/images/Groups/Nocturne.jpg', 'Showcasing and supporting local art\r\n', 'Quisque vel rutrum est. Donec in turpis nec enim tincidunt eleifend vel eu nunc.Varius eget gravida eu, ullamcorper vitae sem.\r\n', 'P Blue', 'pb@nocturne.com'),
(6, 'Outdoor Skating Group\r\n', 'files/images/Groups/Outdoor_Skate.jpg', 'Organizes outdoor skating\r\n', 'Nunc vel commodo sapien. Phasellus ac enim sit amet ligula congue scelerisque sit amet quis tellus.Ut tincidunt nibh sapien, nec interdum eros fringilla in. \r\n', 'Blade Fast', 'bf@rink.com'),
(7, 'NS Soccer Association\r\n', 'files/images/Groups/NS_Soccer.jpg', 'Organzies youth soccer\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consequat, est et posuere maximus, magna arcu dapibus justo, ac congue dui dui sed tellus. Aliquam bibendum efficitur lacinia. Quisque ac pellentesque turpis\r\n', 'Soca Foot', 'soca@soccer.com'),
(8, 'NS Ski School\r\n', 'files/images/Groups/NS_Ski.jpg', 'Downhill skiing\r\n', 'Aliquam consequat, est et posuere maximus, magna arcu dapibus justo.\r\n', 'SK Downing', 'sk@hill.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);
  
  

--
-- Indexes for table `eventtypes`
--
ALTER TABLE `eventtypes`
  ADD PRIMARY KEY (`EventTypeID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
  

--
-- AUTO_INCREMENT for table `eventtypes`
--
ALTER TABLE `eventtypes`
  MODIFY `EventTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
  
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`EventTypeID`) REFERENCES `eventtypes` (`EventTypeID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);
 
  
  
  

  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
