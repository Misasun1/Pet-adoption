-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 05:43 PM
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
-- Database: `be23_exam5_animal_adoption_mariamisaowusu`
--
CREATE DATABASE IF NOT EXISTS `be23_exam5_animal_adoption_mariamisaowusu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be23_exam5_animal_adoption_mariamisaowusu`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animalId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address_anim` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `age` decimal(2,1) DEFAULT NULL,
  `vaccinated` varchar(10) NOT NULL,
  `status_anim` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalId`, `name`, `breed`, `image`, `address_anim`, `description`, `size`, `age`, `vaccinated`, `status_anim`) VALUES
(1, 'Luna', 'British Shorthair', 'british_shorthair.jpg', '  Thayagasse 1/16, Wien', 'gentle and affectionate,she adapts quickly to the enviroment and very independent', 'small', 0.5, 'Yes', 'available'),
(2, 'Ricky and Tom', 'Lovebird', 'lovebird.jpg', 'Dr. Renner-Straße 51, Gäserndorf', 'This two little inseparable brothers are lively, and brings good humor to anyone around them', 'very small', 3.5, 'No', 'available'),
(3, 'Chase', 'German Sheppard', 'german_sheppard.jpg', 'Obere Wasserstubenalpe 17, Bludenz', ' A lovely senior dog, he adores a lot walking and entreating, really friendly', 'large', 8.0, 'Yes', 'adopted'),
(4, 'Izzy', 'Iguana', 'iguana.jpg', 'Stammersdorfer Straße 251B, Wien', 'She creates a strong bond with people who gives constant love,really affectionate and she enjoys a lot eating', 'large', 9.0, 'No', 'available'),
(5, 'Gustav', 'Siamese', 'siamese.jpg', 'Feldgasse 16, Tulln', 'His beautiful eyes will capture your heart,very smart and playful', 'small', 2.0, 'Yes', 'available'),
(6, 'Nacho', 'Chameleon', 'chameleon.jpg', 'Alexander-Daum-Straße 15, Mödling', 'Certainly he will keep you entratain by is magic powers. Really calm and indipendent', 'very small', 1.0, 'No', 'available'),
(7, 'Chopper', 'Pug', 'pug.jpg', 'Pürzlbach 1, Zell am See', 'An iconic star needs a bright stage. He is loyal and energetic', 'small', 3.0, 'Yes', 'available'),
(8, 'Bea', 'Cockatoo', 'cockatoo.jpg', 'Dornachweg 8, Innsbruk', 'A big bird with a big heart, she loves a lot to be in company,talkative and friendly', 'large', 6.0, 'no', 'available'),
(9, 'Nala', 'Golden Retriever', 'golden.jpg', 'Wexstraße 16/70, Linz', 'a really affectionate and loving dog, well-manered, she enjoys a lot intensive walking and activities', 'large', 1.5, 'Yes', 'available'),
(10, 'Milly', 'Bengal', 'bengal.jpg', 'Nivenburggasse 5/11, Korneuburg', 'relaxed and chill cat,friendly and loves cuddles ', 'small', 5.0, 'Yes', 'available'),
(11, 'Blaze', 'Leopard Gecko', 'gecko.jpg', 'Oberlaaer Straße 39/9, Wien', 'A mesmerizing lizard with a mesmerizing charachter. He is really active and clever.', 'very small', 5.0, 'No', 'available'),
(12, 'Cosmo', 'Alaskan', 'rabbit.jpg', 'Hans-Buchmüller-Gasse 45/4, St. Pölten', 'It loves interraction, and has a soft and affectionate heart', 'small', 8.0, 'Yes', 'available'),
(13, 'Wisky (test)', 'Border Collie', '6742313b9f764.jpg', 'Gasometer Straße 234,Wien', 'a wonderful test', 'medium', 3.0, 'Yes', 'available'),
(14, 'test', 'test', 'defeault_animal.jpg', 'Gasometer Straße 234,Wien', 'another test', 'medium', 9.9, 'Yes', 'available'),
(15, 'Oreo', 'Chihuahua', 'chihuahua.jpg', 'Etschbachstraße 63, Graz', 'He is introvert, he love snuggling beetween soft blankets.He enjoys good company and a lot of love and support', 'small', 9.9, 'Yes', 'available'),
(16, 'Olaf', 'Great Dane', 'great_dane.jpg', 'Reichergasse 140, Klosterneuburg ', 'Meet a real gentledog. He loves mostly spending good quality time walking in nature as well as staying indoors', 'large', 9.0, 'Yes', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `user_Id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `adoption_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`user_Id`, `pet_id`, `adoption_date`) VALUES
(1, 3, '2024-11-24'),
(1, 3, '2024-11-24'),
(1, 13, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24'),
(1, 7, '2024-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `profile_img`, `password`, `status`) VALUES
(1, 'John', 'Doe', 'johnDoe@gmail.com', '068845125464', 'Rennweg 10/5, Vienna, Austria', 'user.jpg', '90d5d73253fc60103cd89775f31e24dd9a054873577b618e9b', 'user'),
(7, 'Serena', 'Fernandez', 'serena@mail.com', '064834354868', 'WallensteinStraße 132, Wien', '67422be816829.png', '90d5d73253fc60103cd89775f31e24dd9a054873577b618e9b', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animalId`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD KEY `user_Id` (`user_Id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `users` (`userId`) ON DELETE SET NULL,
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animals` (`animalId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
