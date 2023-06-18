-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 01:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `CreatedAt` date DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ID`, `Title`, `CreatedAt`, `CreatedBy`) VALUES
(1, 'Informatică Avansată', '2023-06-01', 21),
(2, 'Programare Web', '2023-06-02', 23),
(3, 'Algoritmi și Structuri de Date', '2023-06-03', 22),
(4, 'Baze de Date', '2023-06-04', 24),
(5, 'Inteligenta Artificiala', '2023-06-05', 24),
(6, 'Securitate Cibernetică', '2023-06-06', 25),
(7, 'Clasa de info jocuri', '2023-06-17', 28),
(8, 'Clasa invatare 3', '2023-06-17', 28),
(9, 'Clasa invatare 1', '2023-06-17', 28),
(10, 'Clasa invatare 2', '2023-06-18', 28),
(11, 'Clasa Random', '2023-06-18', 28),
(20, 'Sane Classroom', '2023-06-18', 28),
(21, 'Finally', '2023-06-18', 28),
(22, 'clasa numarul 3', '2023-06-19', 28),
(23, 'Clasa 99', '2023-06-19', 31),
(24, 'Clasa Noua', '2023-06-19', 31);

-- --------------------------------------------------------

--
-- Table structure for table `classmembers`
--

CREATE TABLE `classmembers` (
  `ID` int(11) NOT NULL,
  `ClassID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classmembers`
--

INSERT INTO `classmembers` (`ID`, `ClassID`, `StudentID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(21, 1, 11),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(22, 2, 12),
(31, 3, 1),
(23, 3, 3),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(24, 4, 4),
(16, 4, 16),
(17, 4, 17),
(18, 4, 18),
(19, 4, 19),
(20, 4, 20),
(26, 5, 1),
(29, 5, 8),
(27, 5, 12),
(28, 5, 13),
(25, 5, 15),
(30, 5, 19),
(32, 7, 26),
(39, 8, 4),
(40, 8, 7),
(34, 9, 1),
(33, 9, 24),
(36, 10, 1),
(37, 10, 2),
(38, 10, 3),
(35, 10, 23),
(42, 11, 1),
(41, 11, 26),
(50, 20, 23),
(52, 21, 1),
(51, 21, 6),
(56, 22, 7),
(55, 22, 8),
(54, 22, 13),
(53, 22, 25),
(57, 22, 26),
(61, 23, 13),
(59, 23, 21),
(58, 23, 25),
(60, 23, 26),
(62, 24, 30);

-- --------------------------------------------------------

--
-- Table structure for table `classproblems`
--

CREATE TABLE `classproblems` (
  `ID` int(11) NOT NULL,
  `ClassID` int(11) DEFAULT NULL,
  `ProblemID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classproblems`
--

INSERT INTO `classproblems` (`ID`, `ClassID`, `ProblemID`) VALUES
(11, 1, 11),
(9, 1, 19),
(12, 2, 12),
(10, 2, 20),
(13, 3, 13),
(8, 3, 18),
(14, 4, 14),
(7, 4, 17),
(15, 5, 15),
(6, 5, 16),
(5, 6, 15),
(16, 6, 16),
(4, 7, 14),
(17, 7, 17),
(21, 7, 20),
(3, 8, 13),
(18, 8, 18),
(2, 9, 12),
(19, 9, 19),
(1, 10, 11),
(20, 10, 20),
(22, 20, 24),
(23, 22, 18),
(24, 23, 16),
(25, 24, 16);

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Rating` decimal(3,2) DEFAULT 0.00,
  `Difficulty` enum('Easy','Medium','Hard') DEFAULT NULL,
  `CreatedAt` date DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`ID`, `Title`, `Description`, `Rating`, `Difficulty`, `CreatedAt`, `CreatedBy`) VALUES
(11, 'Permutari1 ', 'Se citeşte un număr natural nenul n. Să se afişeze, în ordine invers lexicografică, permutările mulţimii {1,2,..,n}.', 0.00, 'Easy', '2023-06-01', 21),
(12, 'PermPF', 'Fie mulţimea M={1,2,..,n} şi P(1),P(2),...,P(n) o permutare a ei. Elementul x din M se numeşte punct fix dacă P(x)=x.\r\nSe citeşte un număr natural nenul n. Să se afişeze, în ordine lexicografică, permutările fără puncte fixe ale mulţimii {1,2,..,n}.', 0.00, 'Medium', '2023-06-02', 22),
(13, 'SumCifF', 'Să se scrie o funcție C++ care să returneze suma cifrelor unui număr natural transmis ca parametru.', 0.00, 'Medium', '2023-06-03', 23),
(14, 'ZeroFact', 'Scrieți definiția completă a unui subprogram C++, nz, cu un parametru întreg n, care returnează numărul zerourilor de la sfârşitul numărului n!', 0.00, 'Hard', '2023-06-04', 24),
(15, 'Interval4', 'Subprogramul interval are un singur parametru, n, prin care primește un număr natural (n∈ [3,106]). Subprogramul returnează cel mai mic număr natural x (n<x) care NU este prim, cu proprietatea că în intervalul [n,x] există un singur număr prim.\r\n\r\nScrieţi definiţia completă a subprogramului. Dacă n=8, subprogramul returnează numărul 12.', 0.00, 'Medium', '2023-06-05', 25),
(16, 'bitcmp', 'Să se scrie o funcție C++ care primește ca parametri două numere naturale, a și b care returnează 1, dacă a > b, 0, dacă a = b și -1 dacă a < b.', 0.00, 'Hard', '2023-06-06', 21),
(17, 'puteri3', 'Se citeşte un număr natural n. Să se scrie n ca sumă de puteri crescătoare ale lui 2.', 0.00, 'Easy', '2023-06-07', 22),
(18, 'pattern', 'Se dă un număr natural n. Să se genereze o matrice pătratică de dimensiune 2n, după un pattern dat.', 0.00, 'Medium', '2023-06-08', 23),
(19, 'fill_1221', 'Se dă o matrice cu n linii și m coloane, formată din 2 tipuri de caractere: \'$\' și \'.\'. Trebuie acoperite toate caracterele \'.\' cu piese 1x2 sau 2x1. Dacă se poate realiza acoperirea într-un mod unic, se va afișa matricea completată, altfel se va afișa mesajul \"altadata\".', 0.00, 'Hard', '2023-06-09', 24),
(20, 'echi_interv', 'Se dau două numere naturale a și b. Calculați suma numerelor echilibrate din intervalul [a,b]. Un număr este echilibrat dacă are număr par de cifre si are numărul de cifre pare egal cu numărul de cifre impare.', 0.00, 'Easy', '2023-06-10', 25),
(21, 'Operatie', '2+2=?', 0.00, 'Easy', '2023-06-01', 28),
(22, 'Inmultire', '2*2=?', 0.00, 'Easy', '2023-06-18', 28),
(24, 'Opp', '10+10=?', 0.00, 'Easy', '2023-06-18', 28),
(25, '#751. ', 'O rama se misca in spirala in sens invers trigonometric intr-o zona dreptunghiulara, intrand si iesind din pamant. Deplasarea ramei se face alternativ in pamant si la suprafata. La intalnirea unei gropi rama intra in pamant daca era la suprafata si iese la suprafata daca era in pamant. Din fisierul rama.in se citeste configuratia zonei dreptunghiulare in care rama porneste din coordonatele (1,1). Gropile sunt repezentate prin valoarea 0, iar restul fiind valoarea 1. Afisati numarul de gropi prin care rama va iesi la suprafata si coordonatele acestora.', 0.00, 'Hard', '2023-06-18', 28),
(26, 'PerechiPuncte', 'Se dau n puncte în plan, nu neapărat distincte, fiecare punct fiind dat prin coordonatele sale (x, y), unde x și y sunt numere naturale. Spunem că două puncte (x, y) și (i, j) sunt simetrice dacă x = j și y = i. Să se determine numărul perechilor de puncte simetrice.', 0.00, 'Medium', '2023-06-19', 28),
(27, 'Problema Noua', 'Se dă n și un sir cu n elemente, numere naturale. Folosind metoda HeapSort, să se sorteze crescător șirul și să se afișeze elementele sale, separate prin câte un spațiu.', 0.00, 'Easy', '2023-06-19', 31),
(28, 'Problema Noua Test', 'Test Test', 0.00, 'Easy', '2023-06-19', 28);

-- --------------------------------------------------------

--
-- Table structure for table `problemtags`
--

CREATE TABLE `problemtags` (
  `ID` int(11) NOT NULL,
  `ProblemID` int(11) DEFAULT NULL,
  `TagID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problemtags`
--

INSERT INTO `problemtags` (`ID`, `ProblemID`, `TagID`) VALUES
(1, 11, 1),
(2, 11, 3),
(3, 12, 2),
(4, 12, 4),
(6, 13, 1),
(5, 13, 5),
(7, 14, 3),
(8, 14, 4),
(9, 15, 2),
(10, 15, 5),
(11, 16, 1),
(12, 16, 3),
(13, 17, 2),
(14, 17, 4),
(16, 18, 1),
(15, 18, 5),
(17, 19, 3),
(18, 19, 4),
(19, 20, 2),
(20, 20, 5),
(21, 21, 53),
(22, 22, 54),
(25, 24, 53),
(23, 24, 54),
(24, 24, 56),
(26, 24, 57),
(30, 25, 56),
(27, 25, 58),
(28, 25, 59),
(29, 25, 60),
(33, 26, 3),
(31, 26, 54),
(32, 26, 56),
(34, 26, 61),
(36, 27, 56),
(37, 27, 61),
(35, 27, 62),
(39, 28, 54),
(38, 28, 56),
(40, 28, 61);

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE `solutions` (
  `ID` int(11) NOT NULL,
  `ProblemID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SolutionText` text DEFAULT NULL,
  `SubmittedAt` datetime DEFAULT NULL,
  `IsCorrect` enum('corect','incorect') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`ID`, `ProblemID`, `UserID`, `SolutionText`, `SubmittedAt`, `IsCorrect`) VALUES
(1, 11, 1, 'Unlucky', '2023-06-17 15:12:30', 'incorect'),
(2, 13, 4, 'Unlucky123', '2023-06-17 15:12:53', 'incorect'),
(3, 13, 1, 'Unlucky11', '2023-06-17 15:12:53', 'incorect'),
(4, 12, 1, 'Unlucky John Doe', '2023-06-17 17:50:31', NULL),
(5, 17, 1, 'Unlucky Jhonn Doe', '2023-06-17 17:50:53', NULL),
(6, 19, 1, 'Unlucky Unlucky John Doe', '2023-06-17 17:51:08', NULL),
(7, 20, 1, 'Unlucky John Doe', '2023-06-17 17:52:30', NULL),
(8, 12, 2, 'Unlucky Jane Doe', '2023-06-17 17:55:12', NULL),
(15, 24, 28, '20', '2023-06-18 19:24:24', NULL),
(16, 24, 28, '20', '2023-06-18 19:39:01', NULL),
(17, 25, 1, 'NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU NU STIU ', '2023-06-18 20:22:13', NULL),
(18, 20, 28, 'dsadadadasda', '2023-06-18 21:13:43', NULL),
(19, 16, 28, 'dsadasdada', '2023-06-18 21:14:03', NULL),
(20, 24, 28, '21', '2023-06-18 21:37:10', NULL),
(21, 24, 28, '21', '2023-06-18 21:40:48', NULL),
(22, 24, 28, '20', '2023-06-18 21:45:39', NULL),
(23, 22, 28, '5', '2023-06-18 21:46:07', NULL),
(24, 22, 28, '4', '2023-06-18 21:46:16', NULL),
(25, 14, 26, '...dsadad...', '2023-06-19 01:11:39', NULL),
(26, 14, 26, 'alt raspuns', '2023-06-19 01:11:53', NULL),
(27, 22, 30, '5', '2023-06-19 01:28:06', NULL),
(28, 22, 30, '4 (corect)', '2023-06-19 01:28:24', NULL),
(29, 16, 30, '???', '2023-06-19 01:32:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE `stars` (
  `ID` int(11) NOT NULL,
  `ProblemID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Stars` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`ID`, `Name`) VALUES
(57, 'adunare'),
(22, 'algebra booleana'),
(1, 'algoritmi'),
(45, 'algoritmi genetici'),
(32, 'analiza algoritmilor'),
(61, 'arbori'),
(20, 'arhitectura calculatoarelor'),
(5, 'baze de date'),
(44, 'baze de date distribuite'),
(48, 'bioinformatica'),
(17, 'cloud computing'),
(14, 'compilatoare'),
(46, 'computatie in ceata'),
(13, 'criptografie'),
(19, 'data science'),
(9, 'dezvoltare software'),
(53, 'faai'),
(18, 'grafica computerizata'),
(56, 'info'),
(34, 'inginerie software'),
(4, 'inteligenta artificiala'),
(25, 'interactiune om-calculator'),
(38, 'interfete om-calculator'),
(16, 'internet of things'),
(28, 'introducere in informatica'),
(41, 'limbaje de programare'),
(29, 'lingvistica computationala'),
(30, 'logica matematica'),
(11, 'machine learning'),
(54, 'mate'),
(60, 'matrice'),
(47, 'minerit de date'),
(26, 'modelare si simulare'),
(62, 'nou'),
(23, 'optimizare'),
(43, 'prelucrarea limbajului natural'),
(31, 'probabilitati si statistica'),
(2, 'programare'),
(39, 'programare orientata pe obiecte'),
(24, 'programare paralela'),
(12, 'realitate virtuala'),
(51, 'recunoastere de pattern-uri'),
(6, 'retele'),
(35, 'retele de calculatoare'),
(40, 'retele neurale'),
(15, 'robotica'),
(50, 'robotica mobila'),
(7, 'securitate'),
(33, 'securitate informatica'),
(10, 'sisteme de operare'),
(21, 'sisteme distribuite'),
(36, 'sisteme embedded'),
(42, 'sisteme expert'),
(27, 'sisteme inteligente'),
(3, 'structuri de date'),
(58, 'tablouri'),
(49, 'tehnologii web'),
(37, 'teoria informatiei'),
(52, 'teoria limbajelor formale'),
(59, 'vectori'),
(8, 'web');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Role` enum('teacher','student') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Role`) VALUES
(1, 'Adelin', 'Avream', 'adelinavram@gmail.com', '$2y$10$tUZmcmJH.l3hATQoYfzpL.LhyLBijKVPxZsDxujtmbiqpAlzCJzUy', 'student'),
(2, 'Jane', 'Lorena', 'janelore@yahoo.com', '$2y$10$tQNqWqBlJgJBrQXWWQP79OXmLMhoVVS9i13vgz.K//.tCaHlojiDy', 'student'),
(3, 'David', 'Johnson', 'david.johnson@example.com', '$2y$10$duh4o0dZR9nhGaPX/GmMMu0kkz6TbSxeq6/5HCrfsbebPxylZSh/2', 'student'),
(4, 'Emanuel', 'Florentin', 'emanuelFlorentin123@gmail.com', '$2y$10$4tGSdcJcTYHMSRAYK14wQu5Ogg.w43utz2.WdNzx3I5LFWR9NNysm', 'student'),
(5, 'Travis', 'Brown', 'TravisBrowny@yahoo.co.uk', '$2y$10$elEgr.X5Dfd1SEv8mRjWUO28xPclVvJyQNkC7j3oX5V9mo4jsNmby', 'student'),
(6, 'Random', 'Jones', 'RanyJJ@gmail.com', '$2y$10$xRuL/q5Ezjtwd3Ssvsqv.eMyWqbGY.d0WU.XMCvs0rwcv7/fmiD4.', 'student'),
(7, 'Anthony', 'Davis', 'LakersLost@gmail.com', '$2y$10$CimniuFDdPMRnEaix/Y0Q.7TjORapR/SNsiJyYCAz/af9mewBYGh.', 'student'),
(8, 'Jessica', 'Wood', 'jessiWhoE4@gmail.com', '$2y$10$dm/SEmRxWBypTser0T2S8eVCJkfVt6FPyN8TO3h5ic5tUUyTgQxri', 'student'),
(9, 'Christopher', 'Wilson', 'Christopher_Wil_Com_Bac@yahoo.com', '$2y$10$kqMZVK1qCWl/wLOlcwkHrOLPWxTjWlxlEOgaqKtjClf.OUHVnop8i', 'student'),
(10, 'Amanda', 'Adnam', 'palindromama@yahoo.com', '$2y$10$sINPj26BAXvQCz8FOQILMOPrbpmHKzwp9RxDAOYrxjnuLnFZ2sZzO', 'student'),
(11, 'Matei', 'Anderson', 'matthewanabeanderson@gmail.com', '$2y$10$c8txUJeLJOBAoxGTDRNidO9kuEcux4.Vm8tCXBGgqfcNUmhhqXXx6', 'student'),
(12, 'Elizabeth', 'Thomas', 'kiNgElizabeth6@gmail.com', '$2y$10$8ceTvR1S1B0gJvvfMn7jxeAEtUQqP2HYIZYx/IZH07ySirP2HS6hy', 'student'),
(13, 'Dan', 'Marius', 'danut13@yahoo.ro', '$2y$10$2H9uYhP.Q3LSLYmfxNr9vuz.4IDb14g4DATf1wO8SOnNY0P2UEMwe', 'student'),
(14, 'Emily', 'Levis', 'levi.sEmily@gmail.com', '$2y$10$YvJoGYdwBT29otolKBMroOkiPgEyTSGMD2fDSMZqrj93ODa4H2Chq', 'student'),
(15, 'Andrew', 'Clark', 'NotSuPpermAn@gmail.com', '$2y$10$lW.Mx0/gBiqHixKXClGHOuOd4feq1v5PhVXBCWWDa/Hc.HscKgmNa', 'student'),
(16, 'Olivia', 'Lee', 'olivia3Brucelee@example.com', '$2y$10$4.mC6fsKiMmqw9NscUB.yOylp.6pax1D747jaUPaK8YuYGc/OPgQG', 'student'),
(17, 'James-Jack', 'Martin', 'james.martinJack@gmail.com', '$2y$10$KRIfG1g59.I.eNK21h7gb.8kzE9tWK/A1.CiS/k/hCwG44iRU62re', 'student'),
(18, 'Sophia', 'Walker', 'sophia.walker@example.com', '$2y$10$15n5UFNWO.yyHaUo/FWL9OBOCqNqsV3GQzMnJyMmvhD1zrWjoCNGG', 'student'),
(19, 'Benjamin', 'Halldoor', 'benjamin.Doorhall@yahoo.com', '$2y$10$dbFz2LPAJN87xyPGyhS8a.6GMLBrUlwHQZK0HXRrULx98miLIdk4C', 'student'),
(20, 'Mia', 'Young', 'miaTrae.young@yahoo.com', '$2y$10$Llz1KrJZn/6Aw/aG.AoHBu8BXaeoy/pd1QvkshU95xW24dTmt7nBy', 'student'),
(21, 'Sarah', 'Wilson', 'saharah-wilson@yahoo.com', '$2y$10$PpC8ZTsZfOiUmatkSpkaMeKsInjwGwXtHKxl7ZMtzZQK64OcEEuda', 'teacher'),
(22, 'Mark', 'Thompson', 'markenen.thompy@gmail.com', '$2y$10$fFUdLRBTgZy2bKMGF57Ir.HhlZ3Q0cf8KZCCQFVVrdf/hOdkI.F1m', 'teacher'),
(23, 'Laura', 'Anderson', 'lmadethisat10n@gmail.com', '$2y$10$BFdezk/WdSjlzNdfqjisZ.xzZJ3W9o9ig9unryskOPdexwurMs/By', 'teacher'),
(24, 'Daniel', 'Robinson', 'danielrobinson@gmail.com', '$2y$10$pu9g/RZ.dC4yJJw64DHFve165Wp85UHQcQp8hnBtiO2uBLheJjfTG', 'teacher'),
(25, 'Jennifer', 'Mitchell', 'jennifermitchell@yahoo.com', '$2y$10$WXeM5yPdYcAvpN3zuzxESuQ4aouofEtw/i2SMeS9RAmIujYvuO7Li', 'teacher'),
(26, 'Andrei', 'Stefan', 'andreistefanalex@gmail.com', '$2y$10$2IqaaZl6aIWBgp6HF5UseOYZ/JCEbYI11x2y5BrpRPC.zL8bOhy9O', 'student'),
(27, 'Rosu', 'Negru', 'rosunegru@hotmail.com', '$2y$10$U1aV3Yg0OJ6.tIxdNLzQhus14dojnQz8g7xVQ86ir9CP6X0L.uIXq', 'student'),
(28, 'Cosmin', 'Glodeanu', 'cosminglodeanu105@gmail.com', '$2y$10$tdFwJ0C/tgDtGYR6hjENlOR2RzNa/7TYh5wgn75mbvl.9cGU9jBEy', 'teacher'),
(29, 'dasdada', 'dasda', '12345@gmail.com', '$2y$10$ZJb4Qw.oZR40ZyAKREFtsuxoNHDaIc0NBGRb.0fkeRMOdU95VNazy', 'student'),
(30, 'test1', 'test2', 'teststudent@gmail.com', '$2y$10$Uzg50qQpXMW4eAa/5XcU7.8GHIUgovNoMKjKiLTlA1MnNjAWitKg2', 'student'),
(31, 'test3', 'test4', 'testprofesor@gmail.com', '$2y$10$Brbbat7Rvo5V4XN.H8eObeJ/sG.KQHHlMxxle.cyqREDCLrSxI7hC', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_class_title` (`Title`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `classmembers`
--
ALTER TABLE `classmembers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `uc_classmembers` (`ClassID`,`StudentID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `classproblems`
--
ALTER TABLE `classproblems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_class_problem` (`ClassID`,`ProblemID`),
  ADD KEY `ProblemID` (`ProblemID`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_title` (`Title`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `problemtags`
--
ALTER TABLE `problemtags`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_problem_tag` (`ProblemID`,`TagID`),
  ADD KEY `TagID` (`TagID`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProblemID` (`ProblemID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProblemID` (`ProblemID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_tag_name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `uc_email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `classmembers`
--
ALTER TABLE `classmembers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `classproblems`
--
ALTER TABLE `classproblems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `problemtags`
--
ALTER TABLE `problemtags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `stars`
--
ALTER TABLE `stars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `classmembers`
--
ALTER TABLE `classmembers`
  ADD CONSTRAINT `classmembers_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `classes` (`ID`),
  ADD CONSTRAINT `classmembers_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `classproblems`
--
ALTER TABLE `classproblems`
  ADD CONSTRAINT `classproblems_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `classes` (`ID`),
  ADD CONSTRAINT `classproblems_ibfk_2` FOREIGN KEY (`ProblemID`) REFERENCES `problems` (`ID`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `problemtags`
--
ALTER TABLE `problemtags`
  ADD CONSTRAINT `problemtags_ibfk_1` FOREIGN KEY (`ProblemID`) REFERENCES `problems` (`ID`),
  ADD CONSTRAINT `problemtags_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tags` (`ID`);

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `solutions_ibfk_1` FOREIGN KEY (`ProblemID`) REFERENCES `problems` (`ID`),
  ADD CONSTRAINT `solutions_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `stars`
--
ALTER TABLE `stars`
  ADD CONSTRAINT `stars_ibfk_1` FOREIGN KEY (`ProblemID`) REFERENCES `problems` (`ID`),
  ADD CONSTRAINT `stars_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
