-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 01:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingtable`
--

CREATE TABLE `bookingtable` (
  `bookingID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `bookingTheatre` varchar(50) NOT NULL,
  `bookingType` varchar(50) NOT NULL,
  `bookingDate` date NOT NULL,
  `bookingTime` time NOT NULL,
  `bookingFName` varchar(50) NOT NULL,
  `bookingLName` varchar(50) NOT NULL,
  `bookingPNumber` varchar(15) NOT NULL,
  `bookingEmail` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `ORDERID` varchar(100) NOT NULL,
  `member_type` varchar(20) NOT NULL,
  `discounts` decimal(4,2) NOT NULL,
  `ticketPrice` decimal(10,2) DEFAULT NULL,
  `ticketQuantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingtable`
--

INSERT INTO `bookingtable` (`bookingID`, `movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`, `amount`, `ORDERID`, `member_type`, `discounts`, `ticketPrice`, `ticketQuantity`) VALUES
(66, 75, 'main-hall', 'imax', '2023-05-24', '16:49:35', 'Nihar', 'Priyadarshi', '+447495197064', 'nihar.darshi@gmail.com', 8.24, 'CINE31842283', 'child', 0.25, 10.99, 1),
(67, 75, 'main-hall', 'imax', '2023-05-24', '16:50:59', 'Nihar', 'Priyadarshi', '+447495197064', 'nihar.darshi@gmail.com', 8.24, 'CINE5337568', 'child', 0.25, 10.99, 1),
(68, 69, 'main-hall', 'imax', '2023-05-24', '19:31:53', 'Abdul', 'Muthi', '+4433197864523', 'abdul.muthi@outlook.com', 32.97, 'CINE92870293', 'guest', 0.00, 10.99, 3),
(69, 76, 'main-hall', 'imax', '2023-05-24', '20:45:49', 'Calama', 'Reynard', '+443121576428', 'ming.reynard@aston.ac.uk', 29.67, 'CINE34021494', 'regular', 0.10, 10.99, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cine_customers`
--

CREATE TABLE `cine_customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `is_member` tinyint(1) NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cine_customers`
--

INSERT INTO `cine_customers` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `member_type`, `is_member`, `discount`) VALUES
(3, 'David', 'Afolabi', 'afolabitoni@gmail.com', '$2y$10$NmkRIyzvnOMnHqx5dmmBiO.2U5Ue2SNKEXRd2kzMgEVLsts3Mrm1y', '', 'child', 1, 0.25),
(4, 'Salar', 'Butt', 'salar.butt@gmail.com', '$2y$10$C2hLugEV8BwnqX8AZvJdSOzApwpM1AfdmBcJldP0yGNHOCI3G3bDW', '', 'regular', 1, 0.1),
(5, 'Mujeeb', 'Sambo', 'mujeeb.sambo@oncampus.global', '$2y$10$QSAC7hN5bKLg/F8o.shYiOGQnOWiei9n8VMj6.KEVcO3QvjjIDIIi', '', 'senior', 1, 0.3),
(6, 'Matthew Brian', 'Tahir', 'briantahirmatthew@gmail.com', '$2y$10$hFEgXxj1bT98auDHzY2VLOOeWUfo.6QAIW85Jxd3qsrQ1TARf523i', '+447493012182', 'regular', 1, 0.1),
(7, 'Mary', 'Chew', 'mary.chew@gmail.com', '$2y$10$jQSre.vdoPmXcK9vHT5KfOLV7maXtJNTVMWILJL3yUYTnCMTDBl0O', '', 'senior', 1, 0.3),
(8, 'Callum', 'Chambers', 'cchambers.04@gmail.com', '$2y$10$.wSFSvdyaW1D9EgzeKERQuJQaHyWkF/ABQZ42EXWVITgvT1pTy6FK', '', 'regular', 1, 0.1),
(9, 'John', 'Smith', 'john.smith@example.com', '$2y$10$2Sbs6g8ZxzfeUtRO0YSj9.KJSAcqiUwgkAutSLaw40j7briCu9P/i', '+447480532101', 'senior', 1, 0.3),
(10, 'Nihar', 'Priyadarshi', 'nihar.darshi@gmail.com', '$2y$10$q.dcIliu8Hu3x1HhJaXd4uRTQ.bHgeI7.fj6LI2W2FU09L97AWX1S', '+445576120891', 'child', 1, 0.25),
(11, 'John', 'Smith', 'john.smith@example.com', '$2y$10$q53zf2ALzNuN6G5LwIHw3urwhKnmX3vLhAMd3fL7bg.yRQWODp2fq', '+447480532101', 'senior', 1, 0.3),
(12, 'Kyle', 'Walker', 'kyle.walker@gmail.com', '$2y$10$yojlz4XlH0e/CAupCTbDfetBJiBs9s3kWvKRTX/PpBNXrrLHkmMlC', '', 'regular', 1, 0.1),
(13, 'Ruben', 'Wills', 'rub.wills@gmail.com', '$2y$10$TIROQKbeQq5LQxENPmrxxedFu/0noQZ5vDO5tVwI//.ZH00dIZlWK', '+445321978065', 'regular', 1, 0.1),
(14, 'Calama', 'Reynard', 'ming.reynard@aston.ac.uk', '$2y$10$2T.2XlZekTW97y6eI.b1b.dq0dppJKrbAddjzTX3Qt025z/MZN/VG', '+443121576428', 'regular', 1, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `movietable`
--

CREATE TABLE `movietable` (
  `movieID` int(11) NOT NULL,
  `movieImg` varchar(150) NOT NULL,
  `movieTitle` varchar(100) NOT NULL,
  `movieDuration` varchar(255) NOT NULL,
  `movieGenre` varchar(50) NOT NULL,
  `movieRelDate` date NOT NULL,
  `movieDirector` varchar(50) NOT NULL,
  `movieActors` varchar(150) NOT NULL,
  `trailerURL` varchar(255) DEFAULT NULL,
  `DESCRIPTION` text NOT NULL,
  `ticket_availability` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `movietable`
--

INSERT INTO `movietable` (`movieID`, `movieImg`, `movieTitle`, `movieDuration`, `movieGenre`, `movieRelDate`, `movieDirector`, `movieActors`, `trailerURL`, `DESCRIPTION`, `ticket_availability`) VALUES
(69, 'img/Guardians.jpg', 'Guardians of the Galaxy Vol.3', '120 minutes', 'Action, Adventure, Comedy', '2023-05-05', 'James Gunn', 'Chris Pratt, Zoe Saldana, Dave Bautista, Bradley Cooper, Vin Diesel', 'https://www.youtube.com/watch?v=JqcncLPi9zw', 'Guardians of the Galaxy Vol. 3 is a 2023 American superhero film based on the Marvel Comics superhero team Guardians of the Galaxy, produced by Marvel Studios, and distributed by Walt Disney Studios Motion Pictures. It is the sequel to Guardians of the Galaxy and Guardians of the Galaxy Vol. 2, and the 32nd film in the Marvel Cinematic Universe. ', 28),
(70, 'img/Super Mario.jpg', 'Super Mario Bros Movie', '92 minutes', 'Action, Adventure, Comedy', '2023-06-02', 'Aaron Horvath', 'Chris Pratt, Anya Taylor-Joy, Charlie Day, Jack Black, Keegan-Michael Key', 'https://www.youtube.com/watch?v=TnGl01FkMMo', 'An adventure comedy film based on the Super Mario video game franchise. It is directed by Aaron Horvath and Michael Jelenic and stars Chris Pratt, Anya Taylor-Joy, Charlie Day, and Jack Black. The film follows Mario and Luigi as they embark on a quest to save the Mushroom Kingdom.', 19),
(71, 'img/JW4.jpg', 'John Wick 4', '122 minutes', 'Action, Crime, Thriller', '2023-04-06', 'Chad Stahelski', 'Keanu Reeves, Laurence Fishburne, Ian McShane, Lance Reddick, Donnie Yen', 'https://www.youtube.com/watch?v=qEVUtrk8_B4', 'An action thriller film directed by Chad Stahelski. It is the fourth installment in the John Wick franchise and stars Keanu Reeves, Laurence Fishburne, Ian McShane, and Lance Reddick. The movie follows legendary hitman John Wick as he navigates a world of assassins and fights to survive.', 34),
(72, 'img/Evildead.jpg', 'Evil Dead Rise', '96 minutes', 'Horror', '2023-08-04', 'Lee Cronin', 'Alyssa Sutherland, Lily Sullivan, Morgan Davies, Nell Fisher, Gabriella Munro-Douglas', 'https://www.youtube.com/watch?v=smTK_AeAPHs', 'An upcoming horror film directed by Lee Cronin. It is the fifth installment in the Evil Dead franchise and stars Alyssa Sutherland, Lily Sullivan, Morgan Davies, and Nell Fisher. The plot follows a group of friends who unwittingly summon demonic forces while staying at a remote cabin.', 14),
(73, 'img/DandD.jpg', 'Dungeons & Dragons: Honor Among Thieves', '134 minutes', 'Action, Adventure, Fantasy', '2023-05-09', 'Jonathan Goldstein', 'Hugh Grant, Sophia Lillis, Regé-Jean Page, Michelle Rodriguez, Justice Smith', 'https://www.youtube.com/watch?v=IiMinixSXII', 'An upcoming fantasy adventure film directed by Jonathan Goldstein and John Francis Daley. The film is based on the Dungeons & Dragons role-playing game and stars Hugh Grant, Sophia Lillis, Regé-Jean Page, and Michelle Rodriguez. The plot follows a group of adventurers who must work together to retrieve a powerful artifact.', 26),
(74, 'img/Creed III.jpg', 'Creed III', '116 minutes', 'Action, Drama, Sport', '2023-04-17', 'Michael B. Jordan', 'Michael B. Jordan, Tessa Thompson, Phylicia Rashad...', 'https://www.youtube.com/watch?v=AHmCH7iB_IM', 'An upcoming sports drama film directed by Michael B. Jordan. It is the third installment in the Creed franchise and stars Jordan, Tessa Thompson, and Phylicia Rashad. The plot follows boxer Adonis Creed as he prepares for a big fight while balancing his personal life and family obligations.', 32),
(75, 'img/avatar2.jpg', 'Avatar: The Way of Water', '192 minutes', 'Action, Adventure, Fantasy', '2022-12-16', 'James Cameron', 'Sam Worthington, Zoe Saldana, Sigourney Weaver', 'https://www.youtube.com/watch?v=d9MyW72ELq0', 'An upcoming science fiction adventure film directed by James Cameron. It is the second installment in the Avatar franchise and stars Sam Worthington, Zoe Saldana, Kate Winslet, and Cliff Curtis. The plot follows the Na’vi people as they explore the oceans of Pandora and encounter new threats.', 18),
(76, 'img/AIR.jpg', 'Air', '111 minutes', 'Drama, Sport', '2023-04-05', 'Ben Affleck', 'Matt Damon, Ben Affleck, Chris Messina, Jason Bateman', 'https://www.youtube.com/watch?v=Euy4Yu6B3nU', 'An upcoming comedy-drama film directed by David O. Russell. The movie follows a group of employees at an airport who must deal with a variety of problems and conflicts while trying to keep the airport running smoothly. It stars Jared Leto, Anne Hathaway, Melissa McCarthy, and Willem Dafoe.', 25),
(77, 'img/fast x.jpeg', 'Fast X', '141 minutes', 'Action', '2023-05-19', 'Louis Leterrier', 'Vin Diesel', 'https://www.youtube.com/watch?v=32RAq6JzY-w', 'Fast X is a 2023 American action film directed by Louis Leterrier from a screenplay written by Dan Mazeau and Justin Lin, who also co-wrote the story with Zach Dean. It is the sequel to F9, the tenth main installment, and the eleventh installment overall in the Fast & Furious franchise. ', 49);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
(1, 'briant', 'brian', 'cinefun');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookingtable`
--
ALTER TABLE `bookingtable`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `movieID` (`movieID`);

--
-- Indexes for table `cine_customers`
--
ALTER TABLE `cine_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movietable`
--
ALTER TABLE `movietable`
  ADD UNIQUE KEY `movieID` (`movieID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingtable`
--
ALTER TABLE `bookingtable`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `cine_customers`
--
ALTER TABLE `cine_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `movietable`
--
ALTER TABLE `movietable`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookingtable`
--
ALTER TABLE `bookingtable`
  ADD CONSTRAINT `bookingtable_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movietable` (`movieID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
