-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2022 at 02:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_crud_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isbn_code` varchar(15) DEFAULT NULL,
  `short_description` tinytext NOT NULL,
  `type` enum('Book','CD','DVD') DEFAULT NULL,
  `author_first_name` varchar(50) NOT NULL,
  `author_last_name` varchar(70) NOT NULL,
  `publisher_name` varchar(100) DEFAULT NULL,
  `publisher_adress` varchar(255) DEFAULT NULL,
  `publish_date` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `title`, `image`, `isbn_code`, `short_description`, `type`, `author_first_name`, `author_last_name`, `publisher_name`, `publisher_adress`, `publish_date`) VALUES
(1, 'La casa de los espiritus', '1-book.jpg', '9781234567897', 'The House of the Spirits is the debut novel of Isabel Allende. The novel was rejected by several Spanish-language publishers before being published in Buenos Aires in 1982.', 'Book', 'Isabel', 'Allende', 'Plaza&Janés, S.A', 'Spain', 1982),
(2, 'The House of the Spirits', '2-dvd.jpg', '9781234567898', 'Based on the 1982 novel La Casa de los Espíritus by Isabel Allende, the film follows three generations of women from a Chilean family during the country’s military dictatorship. ', 'DVD', 'Billie', 'August', 'Neue Constantin Film', 'Germany', 1993),
(3, 'The forty rules of love', '3-book.jpeg', '9781234567899', 'The novel is about Maulana Jalal-Ud-Din, known as Rumi and his companion Shams Tabrizi. This book explains how Shams transformed a scholar into a Sufi through love.', 'Book', 'Elif', 'Shafak', 'Penguin Books', 'United Kingdom', 2009),
(4, 'The Kite Runner', '4-book.jpeg', '9781234567891', 'The novel tells the story of Amir, a young boy from Kabul in tumultuous events, from the fall of Afghanistan\'s monarchy through the Soviet invasion, the exodus of refugees to Pakistan and the United States, and the rise of the Taliban regime.', 'Book', 'Khaled', 'Hosseini', 'Riverhead Books', 'United States', 2003),
(5, 'Call me by your name', '5-dvd.jpg', '9781234567892', 'Set in 1983 in northern Italy, movie chronicles the romantic relationship between  Elio Perlman (Timothée Chalamet), and Oliver (Armie Hammer), a graduate-student assistant to Elio\'s father Samuel (Michael Stuhlbarg), an archaeology professor.', 'DVD', 'Luca', 'Guadagnino', 'Sayombhu Mukdeeprom', 'United States', 2017),
(6, 'The Age of Adelaine', '6-dvd.png', '9781234567893', 'A romantic fantasy film follows the story of Adaline Bowman, a young woman who stops aging after being brought back to life from death following an accident at the age of 29. ', 'DVD', 'Lee Toland', 'Krieger', 'Lakeshore Entertainment Sidney Kimmel Entertainment', 'United States', 2015),
(7, 'Knives Out', '7-dvd.jpg', '9781234567894', 'Mystery film  follows a master detective, Benoit Blanc, investigating the death of the patriarch of a wealthy, dysfunctional family. ', 'DVD', 'Rian', 'Johnson', 'T-Street', 'United States', 2019),
(8, 'Flowers for Algernon', '8-book.jpeg', '9781234567895', 'A short story about Algernon, a laboratory mouse who has undergone surgery to increase his intelligence, touches on ethical and moral themes such as the treatment of the mentally disabled.', 'Book', 'Daniel', 'Keyes', 'Harcourt, Brace & World', 'United States', 1959),
(9, 'The great Gatsby', '9-cd.jpeg', '9781234567896', 'The novel is told from the perspective of a young man named Nick Carraway who has recently moved to New York City and is befriended by his eccentric nouveau riche neighbor with mysterious origins, Jay Gatsby.', 'CD', 'F.', 'Scott-Fitzgerald', 'audible', 'United States', 1925),
(10, 'One hundred years of Solitute (soledad)', '10-cd.jpg', '9781234567879', 'The novel tells the story of seven generations of the Buendía family and follows the establishment of their town Macondo until its destruction along with the last of the family’s descendents.  ', 'Book', 'Gabriel', 'García Márquez', 'Editorial Sudamericana, \r\nHarper & Row, Jonathan Cape \r\n\r\n', 'United Kingdom, United States', 1967),
(23, 'Practical Magic movie', '6371148f5cc68.jpg', NULL, 'Practical Magic is a 1998 American fantasy romantic drama film based on the 1995 novel of the same name by Alice Hoffman.', 'Book', 'Griffin', 'Dunne', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'Vickyvicky', 'Lee', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-11-16', 'vicky@gmail.com', 'avatar.png', 'user'),
(2, 'administrator', 'adm', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-11-14', 'adm@gmail.com', 'avatar.png', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
