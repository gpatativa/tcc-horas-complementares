-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 02:23 AM
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
-- Database: `tccdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `RA` varchar(50) NOT NULL,
  `Curso` varchar(255) NOT NULL,
  `Periodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `atividadecomplementar`
--

CREATE TABLE `atividadecomplementar` (
  `Id` int(11) NOT NULL,
  `AlunoId` int(11) NOT NULL,
  `CategoriaAtividadeId` int(11) NOT NULL,
  `Descricao` text NOT NULL,
  `Data` date NOT NULL,
  `CargaHoraria` int(11) NOT NULL,
  `ArquivoComprovante` varchar(255) NOT NULL,
  `Status` enum('Pendente','Aprovado','Rejeitado') DEFAULT 'Pendente',
  `ObservacaoCoordenador` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `avaliacaoatividade`
--

CREATE TABLE `avaliacaoatividade` (
  `Id` int(11) NOT NULL,
  `AtividadeComplementarId` int(11) NOT NULL,
  `CoordenadorId` int(11) NOT NULL,
  `DataAvaliacao` date NOT NULL,
  `Status` enum('Aprovado','Rejeitado') NOT NULL,
  `Observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoriaatividade`
--

CREATE TABLE `categoriaatividade` (
  `Id` int(11) NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `CargaHorariaMaxima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coordenador`
--

CREATE TABLE `coordenador` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `RA` varchar(50) NOT NULL,
  `Curso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- Indexes for table `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AlunoId` (`AlunoId`),
  ADD KEY `CategoriaAtividadeId` (`CategoriaAtividadeId`);

--
-- Indexes for table `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `AtividadeComplementarId` (`AtividadeComplementarId`),
  ADD KEY `CoordenadorId` (`CoordenadorId`);

--
-- Indexes for table `categoriaatividade`
--
ALTER TABLE `categoriaatividade`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoriaatividade`
--
ALTER TABLE `categoriaatividade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coordenador`
--
ALTER TABLE `coordenador`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  ADD CONSTRAINT `atividadecomplementar_ibfk_1` FOREIGN KEY (`AlunoId`) REFERENCES `aluno` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atividadecomplementar_ibfk_2` FOREIGN KEY (`CategoriaAtividadeId`) REFERENCES `categoriaatividade` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  ADD CONSTRAINT `avaliacaoatividade_ibfk_1` FOREIGN KEY (`AtividadeComplementarId`) REFERENCES `atividadecomplementar` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avaliacaoatividade_ibfk_2` FOREIGN KEY (`CoordenadorId`) REFERENCES `coordenador` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
