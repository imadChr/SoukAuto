SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `soukauto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soukauto`;

CREATE TABLE `brand` (
  `brand_id` int(5) NOT NULL,
  `brand` varchar(15) DEFAULT NULL,
  `FullName` varchar(25) DEFAULT NULL,
  `Country` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `brand` (`brand_id`, `brand`, `FullName`, `Country`) VALUES
(1, 'Ford', 'Ford Motor Company', 1),
(2, 'Toyota', 'Toyota Motor Corporation', 2),
(3, 'BMW', 'Bayerische Motoren Werke ', 3),
(4, 'Hyundai', 'Hyundai Motor Company', 4),
(5, 'Chevrolet', 'General Motors Company', 1),
(6, 'Honda', 'Honda Motor Company, Ltd.', 2),
(7, 'Mercedes-Benz', 'Mercedes-Benz AG', 3),
(8, 'Kia', 'Kia Corporation', 4),
(9, 'Nissan', 'Nissan Motor Co., Ltd.', 2),
(10, 'Audi', 'Audi AG', 3),
(11, 'Mazda', 'Mazda Motor Corporation', 2),
(12, 'Volvo', 'Volvo Car Corporation', 7),
(13, 'Subaru', 'Subaru Corporation', 2),
(14, 'Jeep', 'Stellantis N.V.', 1),
(15, 'Porsche', 'Porsche AG', 3),
(16, 'Ferrari', 'Ferrari N.V.', 5),
(17, 'Renault', 'Renault Group', 6),
(18, 'Jaguar', 'Jaguar Land Rover Limited', 8),
(19, 'Lamborghini', 'Automobili Lamborghini S.', 5),
(20, 'Tesla', 'Tesla, Inc.', 1),
(21, 'McLaren', 'McLaren Group Limited', 8),
(22, 'Bugatti', 'Bugatti Automobiles S.A.S', 6),
(23, 'Bentley', 'Bentley Motors Limited', 8),
(24, 'Genesis', 'Genesis Motor, LLC', 4),
(25, 'Maserati', 'Maserati S.p.A.', 5),
(26, 'Peugeot', 'Peugeot', 6),
(27, 'Citroen', 'Citroen', 6),
(28, 'Renault', 'Renault', 6);

CREATE TABLE `car` (
  `car_id` int(5) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) DEFAULT NULL,
  `fuel` varchar(10) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `mileage` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `car` (`car_id`, `brand_id`, `model_id`, `fuel`, `year`, `mileage`) VALUES
(11, 3, 5, 'Essen', 1988, 120000),
(12, 4, 7, 'Essen', 2015, 60000),
(13, 11, 22, 'Diese', 1992, 120000),
(14, 6, 12, 'Essen', 1992, 150000),
(15, 6, 103, 'Essen', 1999, 60000),
(16, 15, 29, '', 2015, 30000),
(17, 26, 51, 'Diese', 2018, 20000),
(18, 3, 86, 'GPL', 2023, 5),
(19, 12, 23, 'Essen', 2007, 150000),
(20, 3, 5, 'Essence', 1993, 122000),
(21, 3, 5, 'Essence', 1993, 122000),
(22, 3, 81, 'Diesel', 1950, 1),
(23, 5, 10, 'Diesel', 1950, 1),
(24, 5, 10, 'Diesel', 1950, 1),
(25, 2, 3, 'Essence', 1954, 3),
(26, 2, 3, 'Essence', 1954, 3),
(27, 5, 10, 'Essence', 1952, 4),
(28, 5, 10, 'Essence', 1952, 4);

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `post_id` int(11) NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `comments` (`comment_id`, `user_id`, `message`, `post_id`, `date_posted`) VALUES
(92, 1, 'khghj', 20, '2023-05-28');

CREATE TABLE `countries` (
  `CountryID` int(5) NOT NULL,
  `CountryName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `countries` (`CountryID`, `CountryName`) VALUES
(1, 'usa'),
(2, 'japan'),
(3, 'germany'),
(4, 'south korea'),
(5, 'italy'),
(6, 'france'),
(7, 'sweden'),
(8, 'United Kingdom'),
(11, 'australia');

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `favorites` (`id`, `post_id`, `user_id`) VALUES
(13, 11, 15),
(17, 11, 19),
(43, 25, 1),
(44, 18, 1),
(47, 19, 1),
(48, 17, 1);

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `images` (`image_id`, `post_id`, `url`, `image_order`) VALUES
(1, 11, 'images/uploads/Background.png', 1),
(2, 11, 'images/uploads/IMG_20220901_194451.jpg', 2),
(3, 11, 'images/uploads/IMG_20220901_200955.jpg', 3),
(4, 11, 'images/uploads/IMG_20220901_201100.jpg', 4),
(5, 12, 'images/uploads/1.PNG', 1),
(6, 12, 'images/uploads/캡처.PNG', 2),
(7, 17, 'images/uploads/engels-flaz-0lh_fY6NEBM-unsplash.jpg', 1),
(8, 18, 'images/uploads/civic EK9.jpeg', 1),
(9, 19, 'images/uploads/eloy-carrasco-fmF95zYq_CY-unsplash.jpg', 1),
(10, 20, 'images/uploads/eloy-carrasco-fmF95zYq_CY-unsplash.jpg', 1),
(11, 20, 'images/uploads/aachal-WwRkM7CduQA-unsplash.jpg', 2),
(12, 20, 'images/uploads/engels-flaz-0lh_fY6NEBM-unsplash.jpg', 3),
(13, 20, 'images/uploads/anthony-bautista-ngsvXuGixaM-unsplash.jpg', 4),
(14, 21, 'images/uploads/aachal-WwRkM7CduQA-unsplash.jpg', 1),
(15, 22, 'images/uploads/civic EK9.jpeg', 1),
(16, 23, 'images/uploads/Volvo_S60_002.jpg', 1),
(17, 25, 'images/uploads/E30-transformed.jpeg', 1),
(18, 30, 'images/uploads/Volvo_S60_002.jpg', 1);

CREATE TABLE `model` (
  `model_id` int(5) NOT NULL,
  `brand_id` int(5) DEFAULT NULL,
  `model_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `model` (`model_id`, `brand_id`, `model_name`) VALUES
(1, 1, 'Mustang'),
(2, 1, 'F-150'),
(3, 2, 'Corolla'),
(4, 2, 'Camry'),
(5, 3, '3 Series'),
(6, 3, '5 Series'),
(7, 4, 'Sonata'),
(8, 4, 'Elantra'),
(9, 5, 'Silverado'),
(10, 5, 'Camaro'),
(11, 6, 'Accord'),
(12, 6, 'Civic'),
(13, 7, 'C-Class'),
(14, 7, 'E-Class'),
(15, 8, 'Sportage'),
(16, 8, 'Sorento'),
(17, 9, 'Altima'),
(18, 9, 'Maxima'),
(19, 10, 'A4'),
(20, 10, 'A6'),
(21, 11, 'CX-5'),
(22, 11, 'MX-5'),
(23, 12, 'S60'),
(24, 12, 'XC90'),
(25, 13, 'Impreza'),
(26, 13, 'WRX'),
(27, 14, 'Wrangler'),
(28, 14, 'Grand Cherokee'),
(29, 15, '911'),
(30, 15, 'Cayenne'),
(31, 16, '488 GTB'),
(32, 16, '812 Superfast'),
(33, 17, 'Captur'),
(34, 17, 'Clio'),
(35, 18, 'F-PACE'),
(36, 18, 'XE'),
(37, 19, 'Huracan'),
(38, 19, 'Aventador'),
(39, 20, 'Model S'),
(40, 20, 'Model X'),
(41, 21, '570S'),
(42, 21, '720S'),
(43, 22, 'Chiron'),
(44, 22, 'Divo'),
(45, 23, 'Continental GT'),
(46, 23, 'Flying Spur'),
(47, 24, 'G70'),
(48, 24, 'G90'),
(49, 25, 'GLC'),
(50, 25, 'GLE'),
(51, 26, '208'),
(52, 26, '308'),
(53, 26, '508'),
(54, 26, '2008'),
(55, 26, '3008'),
(56, 27, 'C3'),
(57, 27, 'C4'),
(58, 27, 'C5'),
(59, 27, 'Cactus'),
(60, 27, 'Berlingo'),
(61, 17, 'Clio'),
(62, 17, 'Captur'),
(66, 26, '5008'),
(67, 26, '508 SW'),
(68, 26, 'Partner'),
(69, 26, 'Rifter'),
(70, 26, 'Traveller'),
(71, 27, 'C-Elysee'),
(72, 27, 'C1'),
(73, 27, 'C2'),
(74, 27, 'C3 Aircross'),
(75, 27, 'C4 Cactus'),
(76, 17, 'Zoe'),
(77, 17, 'Twingo'),
(78, 17, 'Captur'),
(79, 17, 'Koleos'),
(80, 17, 'Scenic'),
(81, 3, '1 Series'),
(82, 3, '2 Series'),
(83, 3, '3 Series'),
(84, 3, '4 Series'),
(85, 3, '5 Series'),
(86, 3, '6 Series'),
(87, 3, '7 Series'),
(88, 3, '8 Series'),
(89, 3, 'X1'),
(90, 3, 'X2'),
(91, 3, 'X3'),
(92, 3, 'X4'),
(93, 3, 'X5'),
(94, 3, 'X6'),
(95, 3, 'X7'),
(96, 3, 'Z4'),
(97, 3, 'M2'),
(98, 3, 'M3'),
(99, 3, 'M4'),
(100, 3, 'M5'),
(101, 17, 'Symbol'),
(102, 17, 'Megane'),
(103, 6, 'S2000');

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `wilaya` varchar(10) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `type` enum('sell','rent') NOT NULL DEFAULT 'sell'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `post` (`post_id`, `user_id`, `car_id`, `title`, `description`, `price`, `date`, `wilaya`, `approved`, `type`) VALUES
(11, 1, 11, 'BMW E30 325I WAGON', 'swap moteur 325i ', 220000, '2023-05-06', 'Oran', 1, 'sell'),
(12, 1, 12, 'Hyundai', 'GOOD car ', 300000, '2023-05-06', 'Adrar', 1, 'sell'),
(17, 1, 13, 'Integra Type-R', '8250Rpm ', 160000, '2023-05-09', 'Oran', 1, 'sell'),
(18, 1, 14, 'Civic Type-R EK9 K20', 'imported from japan', 250000, '2023-05-10', 'Béjaïa', 1, 'sell'),
(19, 1, 15, 'Honda S2000 AP1', 'imported from japan and tastefully modified', 300000, '2023-05-10', 'Tizi Ouzou', 1, 'sell'),
(20, 15, 16, '911', 'lol', 5000000, '2023-05-10', '', 1, 'sell'),
(21, 1, 17, '208 tb9a 208', 'Freelancin', -2147483648, '2023-05-14', 'Biskra', 1, 'sell'),
(22, 19, 18, 'aezazr', 'zheuize kjazeh', 765432, '2023-05-17', 'Biskra', 1, 'sell'),
(23, 1, 19, 'VOLVO S60 from canada', 'it has no rust dont worry', 500000, '2023-05-18', 'El Tarf', 1, 'sell'),
(25, 1, 21, 'Wagon E30 325i', 'great for hooning with the whole family', 2200000, '2023-05-27', 'Oran', 1, 'sell'),
(26, 1, 22, 'hbh', 'hhuhu', 6, '2023-05-27', 'Oum El Bou', 1, 'sell'),
(27, 1, 23, 'hbh', 'hhuhu', 6, '2023-05-27', 'Oum El Bou', 1, 'sell'),
(28, 1, 24, 'hbh', 'hhuhu', 6, '2023-05-27', 'Oum El Bou', 1, 'sell'),
(29, 30, 27, 'efdsf', 'great for hooning with the whole family', 3, '2023-05-28', 'Oum El Bou', 0, 'sell'),
(30, 30, 28, 'efdsf', 'great for hooning with the whole family', 3, '2023-05-28', 'Oum El Bou', 0, 'sell');

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `wilaya` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `phonenumber`, `wilaya`) VALUES
(1, 'Mohammed Mouncef', 'Kadri', 'mohammed.kadri@ensia.edu.dz', '$2y$10$2NW.CbkCQ4LElYbJ.VbctePZYz7wTbzdxa/33FDyr4LG4i2lhsfJO', '0561636981', 'Oran'),
(15, 'nihel ', 'hocine', 'NIHEL@GMAIL.COM', '$2y$10$5Nn2aDE9Zgf4vYJJlYw/Tuz5TVAx5yyXrpsUbsrAUDP6Ts8ov/yOC', '0557543645', ''),
(28, 'Mohammed Mouncef', 'Kadri', 'mohammed.kadri@ensia.edu.dz.L', '$2y$10$p19VwbHunQYDpiq4ZP3by.fLTTzYd9XlJ3EwRRRcBiwxyxcYSnBJa', '0561636981', 'Tébessa'),
(29, 'Mohammed Mouncef', 'Kadri', 'mohammed.kadri@ensia.edu', '$2y$10$JjVFk7dbenIkhxB5WETz2OdMTfHAfPFhuq6l/dE7c.7wQnARIKbMe', '0561636981', 'Tizi Ouzou'),
(30, 'Mohamed Nadjib', 'Bentayeb', 'najibbentayeb@gmail.com', '$2y$10$OWZn3R.Bqis3rcPpxpTrXO6Spys8EZnpQ8tL0HfH5.UFc/E60ozBe', '0562198660', 'Batna');


ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `brand_country_id_fk` (`Country`);

ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_brand_id_car` (`brand_id`),
  ADD KEY `fk_model_id_car` (`model_id`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_post_id_comments` (`post_id`),
  ADD KEY `fk_user_id_comments` (`user_id`);

ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_post_id_image` (`post_id`);

ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `model_brand_fk` (`brand_id`);

ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_car_id` (`car_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`);


ALTER TABLE `car`
  MODIFY `car_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `model`
  MODIFY `model_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;


ALTER TABLE `brand`
  ADD CONSTRAINT `brand_country_id_fk` FOREIGN KEY (`Country`) REFERENCES `countries` (`CountryID`);

ALTER TABLE `car`
  ADD CONSTRAINT `fk_brand_id_car` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_model_id_car` FOREIGN KEY (`model_id`) REFERENCES `model` (`model_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `comments`
  ADD CONSTRAINT `fk_post_id_comments` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `countries`
  ADD CONSTRAINT `country_continent_id_fk` FOREIGN KEY (`Continent`) REFERENCES `continents` (`ContID`);

ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `images`
  ADD CONSTRAINT `fk_post_id_image` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

ALTER TABLE `model`
  ADD CONSTRAINT `model_brand_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`);

ALTER TABLE `post`
  ADD CONSTRAINT `fk_car_id` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
