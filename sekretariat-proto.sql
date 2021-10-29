-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Lis 2016, 12:10
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sekretariat`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employee`
--

CREATE TABLE `employee` (
  `idemployee` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pesel` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `salary` double NOT NULL,
  `info` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `employee`
--

INSERT INTO `employee` (`idemployee`, `name`, `surname`, `title`, `role`, `street`, `address`, `postalcode`, `city`, `pesel`, `isActive`, `salary`, `info`) VALUES
(1, 'Anna', 'Przykładowska', 'mgr', '2', 'Zwykła', 'Zwykła 8/5', '00-000', 'Wałbrzych', '01234567891', '1', 2000, 'Nauczyciel matematyki'),
(2, 'Test', 'Test', 'test', 'test', 'test', 'test', 'test', 'test', '11111111111', '0', 1000, 'test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fee`
--

CREATE TABLE `fee` (
  `idfee` int(11) NOT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `feename` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `feevalue` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expire_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expire_at`) VALUES
(1, 'admin', 'admin', 'admin@example.org', 'admin@example.org', 1, '7uzvkwyfnzwgsgcs8kg0c4wsow4ow44', '$2y$13$yguHuZV.nXTHjP5aSs8M4OPuz3nFBAD7xLQJhYyyURzgSQGCoK99e', '2016-11-24 20:03:18', 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grade`
--

CREATE TABLE `grade` (
  `idgrade` int(11) NOT NULL,
  `idsubject` int(11) DEFAULT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `grade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `school`
--

CREATE TABLE `school` (
  `idschool` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `street` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `schoolclass`
--

CREATE TABLE `schoolclass` (
  `idschoolclass` int(11) NOT NULL,
  `idschool` int(11) DEFAULT NULL,
  `startYear` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `letter` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `student`
--

CREATE TABLE `student` (
  `idstudent` int(11) NOT NULL,
  `idschoolclass` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pesel` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `beginDate` date NOT NULL,
  `endDate` date NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `studentparent`
--

CREATE TABLE `studentparent` (
  `idstudentparent` int(11) NOT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `parentName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `parentSurname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `parentAddress` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `parentPhone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `parentEmail` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subject`
--

CREATE TABLE `subject` (
  `idsubject` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `obligatory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teacher`
--

CREATE TABLE `teacher` (
  `idteacher` int(11) NOT NULL,
  `idschoolclass` int(11) DEFAULT NULL,
  `idemployee` int(11) DEFAULT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`idemployee`);

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`idfee`),
  ADD KEY `fk_fee_idstudent_idx` (`idstudent`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`idgrade`),
  ADD KEY `fk_grade_student1_idx` (`idstudent`),
  ADD KEY `fk_grade_subject1_idx` (`idsubject`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`idschool`);

--
-- Indexes for table `schoolclass`
--
ALTER TABLE `schoolclass`
  ADD PRIMARY KEY (`idschoolclass`),
  ADD KEY `fk_schoolclass_school1_idx` (`idschool`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`),
  ADD KEY `fk_student_schoolclass1_idx` (`idschoolclass`);

--
-- Indexes for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD PRIMARY KEY (`idstudentparent`),
  ADD KEY `fk_studentparent_student1_idx` (`idstudent`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`idsubject`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`idteacher`),
  ADD KEY `fk_teacher_employee1_idx` (`idemployee`),
  ADD KEY `fk_teacher_schoolclass1_idx` (`idschoolclass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `employee`
--
ALTER TABLE `employee`
  MODIFY `idemployee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `fee`
--
ALTER TABLE `fee`
  MODIFY `idfee` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `grade`
--
ALTER TABLE `grade`
  MODIFY `idgrade` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `school`
--
ALTER TABLE `school`
  MODIFY `idschool` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `schoolclass`
--
ALTER TABLE `schoolclass`
  MODIFY `idschoolclass` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `student`
--
ALTER TABLE `student`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `studentparent`
--
ALTER TABLE `studentparent`
  MODIFY `idstudentparent` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `subject`
--
ALTER TABLE `subject`
  MODIFY `idsubject` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teacher`
--
ALTER TABLE `teacher`
  MODIFY `idteacher` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `fee`
--
ALTER TABLE `fee`
  ADD CONSTRAINT `FK_964964B56827FD5D` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`);

--
-- Ograniczenia dla tabeli `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `FK_595AAE3424CA6C14` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`),
  ADD CONSTRAINT `FK_595AAE346827FD5D` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`);

--
-- Ograniczenia dla tabeli `schoolclass`
--
ALTER TABLE `schoolclass`
  ADD CONSTRAINT `FK_F146B6699D237717` FOREIGN KEY (`idschool`) REFERENCES `school` (`idschool`);

--
-- Ograniczenia dla tabeli `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_B723AF333787C6C6` FOREIGN KEY (`idschoolclass`) REFERENCES `schoolclass` (`idschoolclass`);

--
-- Ograniczenia dla tabeli `studentparent`
--
ALTER TABLE `studentparent`
  ADD CONSTRAINT `FK_3F81F54E6827FD5D` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`);

--
-- Ograniczenia dla tabeli `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `FK_B0F6A6D53787C6C6` FOREIGN KEY (`idschoolclass`) REFERENCES `schoolclass` (`idschoolclass`),
  ADD CONSTRAINT `FK_B0F6A6D5F74A3DAC` FOREIGN KEY (`idemployee`) REFERENCES `employee` (`idemployee`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
