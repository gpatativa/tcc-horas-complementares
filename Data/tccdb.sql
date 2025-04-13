-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 01:04 AM
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
  `Periodo` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`Id`, `Nome`, `RA`, `Curso`, `Periodo`, `Senha`, `email`) VALUES
(1, 'Gustavo', '0766231', 'Tads', '4° Semestre', '123123123', ''),
(2, 'Teste Aluno', '123456789', 'Teste', '5° Semestre', '$2y$10$xThXS6srB89ZLi/5XnOAO.pDlAlwicBphi6zfUSJ8vWYtcmylC2Fu', '');

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
  `Curso` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordenador`
--

INSERT INTO `coordenador` (`Id`, `Nome`, `RA`, `Curso`, `Senha`, `email`) VALUES
(1, 'Gustavo', '0766231', 'Tads', '', ''),
(2, 'Pedro IVO', '099987', 'teste', '', ''),
(4, 'teste', '2323', 'teste', '$2y$10$QxyuaYZNQA093sI1LFPDbOpqR9NBMhjAaO0yhvb3MUiPbpUD0IgDy', ''),
(5, 'Teste ', '9514960', 'Tads', '$2y$10$uTibiPwfm3W.N/S9pxvX/.tQA/OzGN9xISl7hxphMP89XD5ROD3cG', ''),
(6, 'Teste ', '9514961', 'Tads', '$2y$10$yB/OZer7.7nxOZV3NiqxZORF4Bkh3dsFGUwqsa6wyzc9WpNvC4cOm', ''),
(7, 'Teste', '123123', 'Teste', '$2y$10$9Tl7aGQDQ0UMxwI6zHIt9OtX9Ctlls./tHdZ7x8KLngIB7vQQ4rjS', ''),
(8, 'Teste', '123123123', 'Teste', '$2y$10$GiwTbvvg.CF.ro4MDKEEv.R5LK9ZmEfMG6zkdxBt7pU7.cYViNBca', ''),
(9, 'Gustavo Cod', '40028922', 'TADS', '$2y$10$SEd7/.q5q.Agb6FR1zas3OGm4qbghn/Y/a2lpY5Hf0U2INT2d6eyC', '');

-- --------------------------------------------------------

--
-- Table structure for table `recuperacao_senha`
--

CREATE TABLE `recuperacao_senha` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expira_em` datetime NOT NULL
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
-- Indexes for table `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
