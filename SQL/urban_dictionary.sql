-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2019 at 08:55 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urban_dictionary`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `entryId` int(25) NOT NULL,
  `entryName` varchar(250) NOT NULL,
  `entryDescription` varchar(1000) NOT NULL,
  `topicId` int(25) NOT NULL,
  `userId` int(25) NOT NULL,
  `entryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topicId` int(25) NOT NULL,
  `topicName` varchar(30) NOT NULL,
  `userId` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topicId`, `topicName`, `userId`) VALUES
(40, 'When you were younger, what di', 91),
(41, 'What are one of your pet peeve', 67),
(42, 'Do you have a favorite animal,', 75),
(44, 'What is your favorite hairstyl', 51),
(45, 'Who is the hottest celebrity?', 96),
(46, 'What do you think about romanc', 41),
(47, 'What is your favorite designer', 79),
(48, 'What kind of workout routine d', 95),
(49, 'Do you have a favorite song, i', 22),
(50, 'How would you spend one millio', 77),
(51, 'Which would you choose: money,', 60),
(52, 'How do you want people to reme', 54),
(53, 'Have you done anything overly ', 36),
(54, 'What is your favorite day and ', 43),
(55, 'If you could be anyone for a d', 74),
(56, 'What is your biggest wish for ', 40),
(58, 'Do you have any regrets about ', 43),
(59, 'Do you believe in evolution or', 71),
(60, 'What is your favorite ice crea', 28),
(61, 'If you could change one facial', 94),
(62, 'What would you do in a world w', 37),
(63, 'If you could walk chose an act', 65),
(64, 'Have you ever tried dating onl', 99),
(65, 'What is your favorite childhoo', 47),
(66, 'Who are 3 of your biggest insp', 83);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(250) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `userName` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `userName`, `email`, `password`, `type`) VALUES
(21, 'Zain', 'Butt', 'zainbb', 'zain_b10@hotmail.com', '$2y$10$THl9fKBpwWNGcRNpFwz.2ul00xUNlzSqql3e9TZEMnhXwWqc7MHfW', 'author'),
(22, 'Zohaib', 'Butt', 'zohaib194', 'zohaib_b13@hotmail.com', '$2y$10$iLBimxTSyfEdOhpUSHxA3u/r.pvVcCP2qcfai/kTnox29oPxUbdKa', 'admin'),
(25, 'Lahooti', 'Castelino', 'Gigastrength', 'Lahooti97@online.com', '-rIA37mSu5', 'author'),
(26, 'Soheil', 'Takahashi', 'Deadlyinx', 'Soheil88@hotmail.com', 'WO_LN4M-EL', 'author'),
(27, 'Beinert', 'Cailloux', 'Techpill', 'Beinert56@gmail.com', 'X_ZBOWDgmh', 'author'),
(28, 'Lil', 'Maurine', 'Methshot', 'Lil65@online.com', 'PWNk9dg5vh', 'author'),
(31, 'Penas', 'Dunniway', 'PackManBrainlure', 'Penas59@online.com', 'pTiUSVub7b', 'author'),
(32, 'Debla', 'Hiram', 'Carnalpleasure', 'Debla78@hotmail.com', 'QTbwdQEq6M', 'author'),
(33, 'Feichtmeier', 'Kloester', 'Sharpcharm', 'Feichtmeier97@gmail.com', 'nR2h-pQKOW', 'author'),
(34, 'Tavares', 'Malgorzata', 'Snarelure', 'Tavares66@online.com', 't6yN7A99I0', 'author'),
(36, 'Kalona', 'Yordanka', 'Burnblaze', 'Kalona86@gmail.com', 'iFn37DMOv5', 'author'),
(37, 'Herkt', 'Pieres', 'Emberburn', 'Herkt98@online.com', 'HzopdgRg2w', 'author'),
(38, 'Crystiane', 'Ratomir', 'Emberfire', 'Crystiane95@hotmail.com', 'ORne5hCc7a', 'author'),
(39, 'Digital', 'Hugoson', 'Evilember', 'Digital89@gmail.com', 'Z3DbJtxp0m', 'author'),
(40, 'Ausseer', 'Noritake', 'Firespawn', 'Ausseer67@online.com', 'j91A6pgx5X', 'author'),
(41, 'Tica', 'FiÃºza', 'Flameblow', 'Tica95@hotmail.com', 'zQrmrKUS-x', 'author'),
(42, 'Alini', 'Dostlar', 'SniperGod', 'Alini66@gmail.com', 'Th-eouvfhN', 'author'),
(43, 'Senno', 'Whittenburg', 'TalkBomber', 'Senno78@online.com', 'yzi3pnlt6D', 'author'),
(44, 'Aaran', 'Taniel', 'SniperWish', 'Aaran59@hotmail.com', 'yOFkphL0KH', 'author'),
(45, 'Calaway', 'Olybiou', 'RavySnake', 'Calaway95@gmail.com', 'TGEbOUBF6U', 'author'),
(46, 'Dionisis', 'Yule', 'WebTool', 'Dionisis59@online.com', '8Cl2aI_uFh', 'author'),
(47, 'Lastowka', 'Aaglan', 'TurtleCat', 'Lastowka59@hotmail.com', 'CAV_qtT2cd', 'author'),
(48, 'Isinsu', 'EncarnaciÃ³n', 'BlogWobbles', 'Isinsu79@gmail.com', 'Cou4s_F0qj', 'author'),
(49, 'Garayalde', 'Rumeli', 'LuckyDusty', 'Garayalde76@online.com', '85XmKJ04FD', 'author'),
(50, 'Jaden', 'Bim', 'RumChicken', 'Jaden85@hotmail.com', '6hL0uM67Lu', 'author'),
(51, 'Lakewood', 'Azagury', 'StonedTime', 'Lakewood79@gmail.com', '4pa24WmpLo', 'author'),
(52, 'Anneline', 'Daksha', 'CouchChiller', 'Anneline96@online.com', 'tmpmu83cYb', 'author'),
(53, 'Mikalson', 'Ferdman', 'VisualMaster', 'Mikalson88@hotmail.com', 'zQ8RxPJJcF', 'author'),
(54, 'Keti', 'Kenya', 'DeathDog', 'Keti67@gmail.com', 'tB-B94CeWX', 'author'),
(55, 'Sugimoto', 'Gadhia', 'ZeroReborn', 'Sugimoto65@online.com', 'BX6-hrYK7a', 'author'),
(56, 'Magomed', 'Gerleen', 'TechHater', 'Magomed78@hotmail.com', '6-PJlFOBnF', 'author'),
(57, 'Bloxson', 'Amberger', 'eGremlin', 'Bloxson55@gmail.com', '-eD8CBUXok', 'author'),
(58, 'Evita', 'Bob', 'BinaryMan', 'Evita65@online.com', 'KZ3kRWYX4D', 'author'),
(59, 'Chorot', 'Shearmur', 'AwesomeTucker', 'Chorot77@hotmail.com', 't0tMAmw82n', 'author'),
(60, 'Elham', 'Jakey', 'FastChef', 'Elham87@gmail.com', 'E2D4TXnMjK', 'author'),
(61, 'Salomaa', 'Canayes', 'JunkTop', 'Salomaa56@online.com', 'I29hcPsJyI', 'author'),
(62, 'Yuefang', 'Akanae', 'PurpleCharger', 'Yuefang66@hotmail.com', 'n9-P_N0EXY', 'author'),
(63, 'Siepert', 'Swoboda', 'CodeBuns', 'Siepert78@gmail.com', 'xrRQHJaDCh', 'author'),
(64, 'Hasnul', 'Yoshiichi', 'BunnyJinx', 'Hasnul88@online.com', 'ndVctLm2NN', 'author'),
(65, 'Frisius', 'Grouws', 'GoogleCat', 'Frisius67@hotmail.com', 'Dc7WEVkt8I', 'author'),
(66, 'Tribhuvan', 'Fanie', 'StrangeWizard', 'Tribhuvan66@gmail.com', 'Bvm_0zdCzy', 'author'),
(67, 'Himot', 'Sunaitis', 'Fuzzy_Logic', 'Himot76@online.com', 'XjRr0Aht4y', 'author'),
(68, 'Senko', 'Silken', 'New_Cliche', 'Senko88@hotmail.com', 'K-or-1vCFh', 'author'),
(69, 'Hellard', 'Berruccini', 'Ignoramus', 'Hellard97@gmail.com', '2FAcRQoJzV', 'author'),
(70, 'Foto', 'Phile', 'Stupidasole', 'Foto68@online.com', 'W_TonYP9l5', 'author'),
(71, 'Zhiganova', 'Boother', 'whereismyname', 'Zhiganova89@hotmail.com', 'Fe-J9JvQWJ', 'author'),
(72, 'Jezset', 'Faruk', 'Nojokur', 'Jezset86@gmail.com', 'fvQiTYAGRr', 'author'),
(73, 'Labritain', 'Frege', 'Illusionz', 'Labritain69@online.com', 'IyfzAyZyrG', 'author'),
(74, 'Jubal', 'Durbin', 'Spazyfool', 'Jubal88@hotmail.com', 'uhUox_OT4-', 'author'),
(75, 'Mceveety', 'Lemkin', 'Supergrass', 'Mceveety86@gmail.com', 'uhFyIm6Uea', 'author'),
(76, 'Googy', 'Tities', 'Dreamworx', 'Googy87@online.com', 'qJypU5_yD1', 'author'),
(77, 'Anneta', 'Kishioka', 'Fried_Sushi', 'Anneta59@hotmail.com', 'SBL0SbwNFy', 'author'),
(78, 'Sharellis', 'Vivlei', 'Stark_Naked', 'Sharellis97@gmail.com', 'xgunB__IVr', 'author'),
(79, 'Bhone', 'Esquide', 'Need_TLC', 'Bhone96@online.com', 'lMfhyVIHiE', 'author'),
(80, 'Ambar', 'Maryssa', 'Raving_Cute', 'Ambar97@hotmail.com', 'eUxD5mX50d', 'author'),
(81, 'Numazawa', 'Geraki', 'Nude_Bikergirl', 'Numazawa57@gmail.com', 'FY4ano_WMK', 'author'),
(82, 'Iassen', 'Hoyland', 'Lunatick', 'Iassen76@online.com', 'gUfeL7qOKy', 'author'),
(83, 'Can', 'Lid', 'Garbage', 'Gebele', 'Cichocki	Gebele59@hotmail.com	uqzujhhWB7', 'author'),
(84, 'Edrelita', 'Malthe', 'Crazy_Nice', 'Edrelita76@gmail.com', 'ii8QZDeEUb', 'author'),
(85, 'Adamescu', 'Matalone', 'Booteefool', 'Adamescu75@online.com', 'hqGQQMmdzH', 'author'),
(86, 'Sungchol', 'Aariana', 'Harmless_Venom', 'Sungchol75@hotmail.com', 'iY8-ZZP-x2', 'author'),
(87, 'Decilian', 'Beecroft', 'Lord_Tryzalot', 'Decilian67@gmail.com', 'HYi26Rxrj2', 'author'),
(88, 'Schoeman', 'Ipek', 'Sir_Gallonhead', 'Schoeman79@online.com', '6ksP5fNdLR', 'author'),
(89, 'Sardelli', 'Rukov', 'Boy_vs_Girl', 'Sardelli66@hotmail.com', 'ZDJ-AFBzXQ', 'author'),
(90, 'Sparky', 'Akimasa', 'MPmaster', 'Sparky66@gmail.com', '5QsxhAYlu4', 'author'),
(91, 'Fenlason', 'Sarrau', 'King_Martha', 'Fenlason66@online.com', 'dBeCLyUeKV', 'author'),
(92, 'Naima', 'Breathe', 'Spamalot', 'Naima98@hotmail.com', 'mTQsLSY99f', 'author'),
(93, 'Cekic', 'Arters', 'Soft_member', 'Cekic67@gmail.com', 'RfWo3vV85R', 'author'),
(94, 'Paddi', 'Shalamar', 'girlDog', 'Paddi58@online.com', 'TojNuKK-F6', 'author'),
(95, 'Mezzena', 'Pappe', 'Evil_kitten', 'Mezzena95@hotmail.com', 'jjBCneLnx_', 'author'),
(96, 'Baishuang', 'Vimala', 'farquit', 'Baishuang96@gmail.com', 'mkC784iDmi', 'author'),
(97, 'Rembado', 'Houben', 'viagrandad', 'Rembado89@online.com', '_5v75CaCmM', 'author'),
(98, 'Alwalda', 'Immad', 'happy_sad', 'Alwalda95@hotmail.com', 'QDOXEKhUrd', 'author'),
(99, 'Sezen', 'Degrees', 'haveahappyday', 'Sezen97@gmail.com', '9kaqnI5tgI', 'author'),
(100, 'Rochy', 'AÃ¯na', 'SomethingNew', 'Rochy66@online.com', '2Ym8x7fjch', 'author'),
(101, 'Mpanza', 'Paider', '5mileys', 'Mpanza59@hotmail.com', 'm8dW2aCp9p', 'author'),
(102, 'Ilusion', 'Jaren', 'cum2soon', 'Ilusion77@gmail.com', 'Ti14z3nlQ-', 'author'),
(103, 'Shema', 'Calfee', 'takes2long', 'Shema95@online.com', 'CF3L5Zexlr', 'author'),
(104, 'Pattarasaya', 'Kalervo', 'w8t4u', 'Pattarasaya75@hotmail.com', 'a-dfz4Tjwh', 'author'),
(105, 'Eppright', 'Klidaras', 'askme', 'Eppright96@gmail.com', '895zplwF4G', 'author'),
(106, 'Kiptyn', 'Horia', 'Bidwell', 'Kiptyn68@online.com', 'joPWM_cNnV', 'author'),
(107, 'Cadillo', 'Tassin', 'massdebater', 'Cadillo59@hotmail.com', '2stBYx9Bj5', 'author'),
(108, 'Yoram', 'Sarahbel', 'iluvmen', 'Yoram75@gmail.com', '_y1oCCNPhI', 'author'),
(109, 'Kershaw', 'Ikwuegbe', 'Inmate', 'Kershaw68@online.com', '1McpPrUc22', 'author'),
(110, 'Tajsha', 'Marshanna', 'idontknow', 'Tajsha87@hotmail.com', 'tCfdirXAmu', 'author'),
(111, 'Sedoc', 'Templeton', 'lostmypassword', 'Sedoc76@gmail.com', 'TMApWeos8v', 'author'),
(112, 'Annale', 'Berna', 'kizzmybutt', 'Annale76@online.com', '_CKjeD1HOE', 'author'),
(113, 'Conesford', 'Rumsa', 'hairygrape', 'Conesford79@hotmail.com', 'GIjkbqGxaK', 'author'),
(115, 'Cokle', 'Couple', 'hatedhail', 'Cokle69@online.com', 'yt6goR90Z2', 'author'),
(116, 'Comico', 'Abenet', 'manukawebsite', 'Comico95@hotmail.com', 'rC2D0uME2R', 'author'),
(117, 'Gajdek', 'Mierzejewski', 'moldyyearling', 'Gajdek88@gmail.com', 'LJsgRjeNPS', 'author'),
(118, 'ÃÃ±igo', 'Renessta', 'lecturecastar', 'ÃÃ±igo86@online.com', 'J5VppS4znX', 'author'),
(119, 'Kereta', 'Dabija', 'cangerlambda', 'Kereta78@hotmail.com', 'HbduJwsaVP', 'author'),
(120, 'Shamil', 'GentarÃ´', 'diamondxyloid', 'Shamil97@gmail.com', 'i2-oJ18bOa', 'author'),
(121, 'Brakefield', 'Pini', 'passivekalman', 'Brakefield78@online.com', 'Mziiz49P_Z', 'author'),
(122, 'Calhecia', 'January', 'bapesbikini', 'Calhecia75@hotmail.com', 'NW_SLKQFSt', 'author'),
(123, 'Parastui123123123', 'Tostivint', 'prusikcanoe', 'Parastui98@gmail.com', 'iOigk1pJVW', 'author');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`entryId`),
  ADD KEY `topicId` (`topicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `entryId` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topicId` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`topicId`) REFERENCES `topics` (`topicId`),
  ADD CONSTRAINT `entries_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
