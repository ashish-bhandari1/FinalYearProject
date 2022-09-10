-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 06:43 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `theatre_id`, `username`, `password`) VALUES
(1, 1, 'qfx', '21232f297a57a5a743894a0e4a801fc3'),
(2, 2, 'fcube', '21232f297a57a5a743894a0e4a801fc3'),
(3, 3, 'barahi', '21232f297a57a5a743894a0e4a801fc3'),
(4, 4, 'cineplex', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `screening_id` int(11) NOT NULL,
  `boking_date` text NOT NULL,
  `booking_seat_count` int(11) NOT NULL,
  `booking_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `movie_id`, `screening_id`, `boking_date`, `booking_seat_count`, `booking_type`) VALUES
(1, 1, 1, 1, 'April 2, 2020, 8:58 am', 1, 'Paid'),
(2, 1, 1, 1, 'April 7, 2020, 4:38 pm', 1, 'Paid'),
(3, 1, 1, 1, 'April 7, 2020, 4:56 pm', 1, 'Paid'),
(4, 1, 1, 1, 'April 7, 2020, 5:03 pm', 1, 'Paid'),
(5, 1, 1, 1, 'April 7, 2020, 5:04 pm', 1, 'Paid'),
(6, 1, 1, 1, 'April 7, 2020, 8:58 pm', 1, 'Paid'),
(7, 1, 7, 4, 'April 11, 2020, 9:34 pm', 4, 'Paid'),
(8, 1, 6, 6, 'April 11, 2020, 9:35 pm', 5, 'Paid'),
(9, 1, 8, 1, 'April 12, 2020, 7:57 pm', 5, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` int(11) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `complain` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `phone`, `email`, `complain`) VALUES
(1, '9869213908', 'ashish.bhandariy67@gmail.com', 'Where is barahi ka hall located?? \r\n                ');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `provenience` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `passportNumber` int(11) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `phone`, `email`, `country`, `provenience`, `city`, `zipcode`, `passportNumber`, `gender`, `password`) VALUES
(1, 'Ashish ', 'Bhandari', 2147483647, 'ashish.bhandariy67@gmail.com', 'Australia', 'Gandaki', 'Pokhara', 37007, 0, 'male', '7b69ad8a8999d4ca7c42b8a729fb0ffd'),
(2, 'Sagun', 'Sahi', 2147483647, 'sangam@gmail.com', 'Argentina', '', 'Waxin', 9022, 2147483647, 'female', 'ff9099c569a2ab76a0a7c9ae70512a8b'),
(9, 'Sangam', 'Bhandari', 2147483647, 'aaaa@gmail', 'Bahamas', 'Gandaki', 'Pokhara', 0, 0, 'male', '21ad0bd836b90d08f4cf640b4c298e7c'),
(10, 'Aliz sen', 'Tiwari', 2147483647, 'aliz@hotmail.com', 'Nepal', 'Gandaki', 'Pokhara', 37007, 0, 'male', '6504ad22127554be865407c4330d566e');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `screening_id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `director` varchar(20) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `movie_hour` varchar(50) DEFAULT NULL,
  `show_time` varchar(200) DEFAULT NULL,
  `casts` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `screening_id`, `theatre_id`, `name`, `link`, `director`, `language`, `genre`, `movie_hour`, `show_time`, `casts`, `image`, `description`, `status`) VALUES
(1, 1, 1, '    Deerskin    ', '  https://www.youtube.com/embed/vVT4jlEJYQA', '    Quentin Dupieux ', '    English US    ', '    Horror/ Comedy  ', '    2:30 min    ', '    9:00AM, 1:00PM, 8:00PM    ', '    Jean Dujardin, Albert Delpy, Adele Haenel    ', 'Deerskin-Poster-600x800.jpg', ' It features Daniel Craig in his fifth and final outing as the fictional                 ', 1),
(2, 1, 1, '     Kedarnath     ', 'https://www.youtube.com/embed/mhqTO5mWKEI', '     Susant Sing Raj', '     Hindi     ', '     Drama, Romantic', '     2:54:00     ', '     9:00 AM, 2:00 PM, 8:00 PM     ', '     Abhisek Kapoor  , sara ali khan', 'kedarnath.jpg', '                     ', 1),
(3, 3, 2, 'Aama', 'https://www.youtube.com/embed/RRv_IJSQweM', 'Dipendra K. Khanal', 'Nepali', 'Drama', '2:03:00', '3:00 pm, 9:00 PM ', 'Mithila Sharma, Surakshya Panta, Manish Niraula', 'Aama-l_AZNNBhG.jpg', 'after the huge blockbuster success of ‘Pashupati and Prasad’. Movie claims to give meaningful lessons and every character will justify the name.                    ', 1),
(4, 8, 4, 'Sex Education', 'https://www.youtube.com/embed/apt8-uTd2ZQ', 'Laurie Numm', 'UK English', 'Drama, Comedy', '2:03:00', '9:00 AM', 'laegecy jr, Solomon sj', 'sex education.jpg', ' Inexperienced Otis channels his sex therapist mom when he teams up with rebellious Maeve to set up an underground sex therapy clinic at school.                    ', 1),
(5, 7, 3, 'Red', 'https://www.youtube.com/embed/mhqTO5mWKEI', 'Mani Sharma', 'Telegu', 'Action, Drama', '2:30:00', '4:00 PM, 8:00 PM', 'Ram Photeni, Tamannah', 'red.jpg', 'Red is an upcoming Indian Telugu-language action thriller film directed by Kishore Tirumala and co-produced by Krishna Chaitanya and Sravanthi Ravi Kishore under Sri Sravanthi Movies.                     ', 1),
(6, 2, 1, 'No Time To DIe', 'https://www.youtube.com/embed/mhqTO5mWKEI', 'Robert Wade', 'US English', 'Action, Drama', '03:00  ', '3:00 pm, 9:00 PM ', 'Jems Bond, Solomon sj', 'no time to die.jpeg', 'No Time to Die is a forthcoming spy film and the twenty-fifth instalment in the James Bond film series produced by Eon Productions. It features Daniel Craig in his fifth and final outing as the fictional                 ', 1),
(7, 4, 2, 'Bad Boys For Life', 'https://www.youtube.com/embed/mhqTO5mWKEI', 'Laurie Numm', 'US English', 'Action, Drama', '2:54:00', '9:00 AM, 1:00 PM, 8:00 PM', 'Jems Bond, Solomon sj', 'bad boys for life.jpg', ' The film was directed by James Wan, from a screenplay by David Leslie Johnson-McGoldrick and Will Beall and stars Jason Momoa                    ', 1),
(8, 1, 1, 'On Ward', 'https://www.youtube.com/embed/gn5QmllRCn4', ' Dan Scanlon', 'US English', ' Computer-animated, ', '2:03:00', '9:00 AM, 1:00 PM, 8:00 PM', 'voice of Tom Holland, Chris Pratt, Julia Louis-Dre', 'b_onward_header_ondigitalnow_mobile_19024_385445a2.jpeg', 'Onward is a 2020 American computer-animated urban fantasy film produced by Pixar Animation Studios for Walt Disney Pictures. The film is directed by Dan Scanlon', 1),
(9, 1, 1, ' Aqua men-2 ', 'https://www.youtube.com/embed/mhqTO5mWKEI', ' Luis Fonsi ', ' US English ', ' Action, Drama ', ' 2:54:00 ', ' 3:00 pm, 9:00 PM  ', '  Will Beall, Jason Momoa ', 'Aquaman 2_poster.jpg', '                     ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `movie_rating` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `mid`, `movie_rating`, `description`) VALUES
(1, 1, 5, 'I Love the Movie                     '),
(2, 1, 4, 'i wish i could give 5 stars        '),
(3, 2, 3, ':(                     '),
(4, 1, 2, '  :(                   '),
(5, 3, 5, '  Pradip Khadka is always best\r\n             '),
(6, 4, 5, '  All adult should watch it                   '),
(7, 4, 3, 'why the actress is so vulger                   '),
(8, 6, 4, '   Fire           '),
(9, 7, 4, 'noting to say                     '),
(10, 8, 5, 'amezing anim                     '),
(11, 9, 2, 'not realiastic               '),
(13, 6, 1, '   Money Wasted                  '),
(14, 6, 5, ' Sweet !!                    '),
(15, 7, 4, 'I suggest you to watch it                   '),
(16, 8, 5, 'I love this animation... lit :)                     ');

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `id` int(5) NOT NULL,
  `theatre_id` int(5) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `seat_number` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `screening`
--

INSERT INTO `screening` (`id`, `theatre_id`, `name`, `type`, `seat_number`) VALUES
(1, 1, 'Q-F2', 'AC', 250),
(2, 1, 'Q-F1', 'AC', 100),
(3, 2, 'Ground F1', 'AC', 200),
(4, 2, 'Roof-F1', 'Non-AC', 100),
(5, 2, 'Ground F2', 'AC', 200),
(6, 3, ' Barahi-ka ', 'Non-AC', 250),
(7, 3, 'Barahi-kha', 'Non-AC', 250),
(8, 4, 'Tread-Mall-1', 'AC', 500),
(10, 1, ' Test Hall ', 'AC', 500);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `screening_id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `seat_row` int(3) DEFAULT NULL,
  `seat_column` int(3) DEFAULT NULL,
  `seat_availability` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `screening_id`, `theatre_id`, `seat_row`, `seat_column`, `seat_availability`) VALUES
(1, 1, 1, 10, 15, 'yes'),
(2, 2, 1, 8, 10, 'yes'),
(3, 3, 2, 8, 10, 'yes'),
(4, 4, 2, 9, 12, 'yes'),
(5, 5, 2, 5, 12, 'yes'),
(6, 6, 3, 7, 11, 'yes'),
(7, 7, 3, 10, 10, 'yes'),
(8, 8, 4, 7, 15, 'yes'),
(10, 10, 1, 5, 11, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `seat_booking`
--

CREATE TABLE `seat_booking` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `show_time` varchar(100) DEFAULT NULL,
  `seat_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat_booking`
--

INSERT INTO `seat_booking` (`id`, `c_id`, `m_id`, `show_time`, `seat_id`) VALUES
(7, 1, 7, '9:00AM', '125'),
(8, 1, 7, '9:00AM', '114'),
(9, 1, 7, '9:00AM', '159'),
(10, 1, 7, '9:00AM', '109'),
(16, 1, 8, '9:00AM', '101'),
(17, 1, 8, '9:00AM', '102'),
(18, 1, 8, '9:00AM', '104'),
(19, 1, 8, '9:00AM', '111'),
(20, 1, 8, '9:00AM', '103');

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE `theatre` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `postal_code` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theatre`
--

INSERT INTO `theatre` (`id`, `name`, `image`, `email`, `phone`, `country`, `city`, `postal_code`) VALUES
(1, 'QFX Cinema', 'qfx hall.PNG', 'Qfx@contact.com', 61129823, 'Nepal', 'Pokhara', 37007),
(2, 'Fcube Cinema', 'fcube-cinema-internal.jpg', 'fcube@contact.com', 61726725, 'Nepal', 'Kathmandu', 577),
(3, 'Barahi Cinema Hall', 'barahi.jpg', 'barahi.net@support.c', 62452425, 'Nepal', 'Pokhara', 577),
(4, 'Cineplex', 'brand-region-3.png', 'cineplex@info.com', 612372673, 'Nepal', 'Butwal', 224);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show_id` (`screening_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show_id` (`screening_id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screening_id` (`screening_id`);

--
-- Indexes for table `seat_booking`
--
ALTER TABLE `seat_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `theatre`
--
ALTER TABLE `theatre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seat_booking`
--
ALTER TABLE `seat_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `theatre`
--
ALTER TABLE `theatre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`theatre_id`) REFERENCES `theatre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`screening_id`) REFERENCES `screening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_3` FOREIGN KEY (`screening_id`) REFERENCES `screening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_ibfk_4` FOREIGN KEY (`theatre_id`) REFERENCES `theatre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `movie` (`id`);

--
-- Constraints for table `screening`
--
ALTER TABLE `screening`
  ADD CONSTRAINT `screening_ibfk_1` FOREIGN KEY (`theatre_id`) REFERENCES `theatre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_2` FOREIGN KEY (`screening_id`) REFERENCES `screening` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `seat_booking`
--
ALTER TABLE `seat_booking`
  ADD CONSTRAINT `seat_booking_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
