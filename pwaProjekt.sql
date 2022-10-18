-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2022 at 10:44 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u751154697_pwaProjekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(80) COLLATE utf8_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(16, 'pec', 'pec', 'pec', '$2y$10$V1QoAQp6bzY118GaC0lOZObdGs6P17XPK6xwvNCic8C8Kz7Bm0DPe', 0),
(17, 'admin', 'admin', 'admin', '$2y$10$JUZGwo0G9mbK5mB.Y9YdnO3aHmIG/IwhIoTFMW.Dvj4bMdNC/yI8q', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `naslov` varchar(80) COLLATE utf8_croatian_ci NOT NULL,
  `opis` text COLLATE utf8_croatian_ci NOT NULL,
  `vijest` text COLLATE utf8_croatian_ci NOT NULL,
  `slika` varchar(64) COLLATE utf8_croatian_ci NOT NULL,
  `kategorija` varchar(80) COLLATE utf8_croatian_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `opis`, `vijest`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '07.06.2020.', 'Macron', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fringilla lobortis nisl sed tristique. Nunc in risus sit amet nulla commodo pulvinar. Quisque sapien nunc, convallis quis lorem ac, rutrum vestibulum mauris. Curabitur mi quam, pharetra ut consectetur vel, sollicitudin sit amet justo. In ultrices facilisis nunc, ut maximus mi lobortis id. Etiam porta porttitor neque sed pulvinar. Sed at augue sed ipsum viverra consequat. Fusce consectetur vehicula justo, euismod consequat mauris imperdiet eget. Mauris a hendrerit quam, quis porttitor erat. Aenean ac enim eu tortor tincidunt aliquet sed ac felis. Duis egestas dui in metus pharetra, sed dictum quam pulvinar. Phasellus ornare fringilla justo, id placerat purus bibendum vitae. Vestibulum accumsan nisi eros, quis egestas ligula pulvinar et. Quisque ut ante libero. Nulla consequat gravida leo sit amet mattis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ', 'macron2.jpg', 'Politik', 0),
(2, '07.06.2020.', 'Angela Merkel', 'Suspendisse malesuada risus lectus', 'Suspendisse malesuada risus lectus. Nullam sit amet nulla eget orci faucibus porta at eget nisi. Vivamus fermentum tortor sem, nec scelerisque felis bibendum at. Nunc sed malesuada tellus. Morbi semper pretium ipsum, in elementum dolor molestie eu. In bibendum ex sit amet erat eleifend condimentum. Nullam ultricies purus et turpis aliquam fermentum. Phasellus mollis tempus tortor. Aliquam volutpat nunc ut egestas ullamcorper. Sed vitae diam vitae sem finibus viverra. Sed accumsan odio sit amet lorem tempus varius.', 'merkel.jpg', 'Politik', 0),
(3, '07.06.2020.', 'Trump', 'Donec vel sem metus', 'Donec vel sem metus. Mauris lacinia, arcu sed facilisis semper, augue justo feugiat nunc, pharetra auctor ex ante fringilla magna. Nulla pharetra nisl nisi, quis sagittis nibh lobortis nec. Donec viverra feugiat orci id cursus. Aenean eu tortor nec lacus bibendum molestie a et sapien. Nam quis laoreet nibh. Etiam sed malesuada est. Curabitur imperdiet turpis enim, vel cursus libero fringilla ac. Fusce mollis mollis nulla, eget imperdiet neque condimentum sed. Aliquam erat volutpat. Maecenas vel nunc consequat, ultrices odio vel, dictum massa. Sed vel est nisl. Nulla lobortis dui sed tincidunt finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 'trump.jpg', 'Politik', 0),
(4, '07.06.2020.', 'Obst', 'Donec pharetra, magna vitae gravida euismod, est nisl consequat ligula, et venenatis tellus augue in velit', 'Donec pharetra, magna vitae gravida euismod, est nisl consequat ligula, et venenatis tellus augue in velit. Nam et bibendum eros, a placerat mi. Aliquam lobortis sodales urna, non malesuada ipsum blandit non. Nulla varius pulvinar dictum. Aliquam erat volutpat. Duis lobortis, sem sed euismod condimentum, urna tortor auctor urna, eget lobortis nibh nunc sed lacus. Fusce congue tortor enim, vitae egestas nibh suscipit vitae. Etiam lacinia rhoncus nulla, in volutpat sapien convallis sed. Praesent auctor dolor non velit pretium, nec dignissim metus sagittis. Aenean non nunc quis felis suscipit sollicitudin et ut sapien. Nulla ut facilisis quam. Vestibulum a enim justo. Quisque mollis scelerisque urna, id condimentum risus dictum sit amet. ', 'voce.jpg', 'Gesundheit', 0),
(11, '25.02.2022.', 'Joga za sve', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'joga.jpg', 'Gesundheit', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
