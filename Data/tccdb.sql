-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 09:52 PM
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
  `Ano_inicio` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `TotalHorasAprovadas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`Id`, `Nome`, `RA`, `Curso`, `Ano_inicio`, `Senha`, `email`, `TotalHorasAprovadas`) VALUES
(1, 'Gustavo Oliveira Patativa', '0766231', 'Tads', '2023', '$2y$10$Xju1jLhWCAVc/s3xqT5uRO0DXpgpCN2vX9mjlkOQ8cooGUstkCLNW', 'Gustavo@gmail.com', 0),
(4, 'Mariana Pedroso', '741852963', 'tads', '2023', '$2y$10$htD4kU0eG/BM5dPgcwJVCuiW7.7rmIiNE8ICM/VwEsmL6hffZi8ve', 'teste@teste.com', 25),
(5, 'testando novamente', '987654321', 'TADS', '2025', '$2y$10$/QUS80iEpuWw3SieoDhXTuX2.4J3ZCwz8.fUwqDA/14CpKXcQwxHq', 'teste@teste.com', 0),
(6, 'Gustavo', '07662312', 'Tads', '2034', '$2y$10$CQyk/dst7AVnAj/uWzPHjueOQnECpwYFx1P9t9i0NQ6evcWgvIl2a', 'patativa1301@gmail.com', 103);

-- --------------------------------------------------------

--
-- Table structure for table `atividadecomplementar`
--

CREATE TABLE `atividadecomplementar` (
  `Id` int(11) NOT NULL,
  `AlunoId` int(11) NOT NULL,
  `CategoriaAtividadeId` int(11) NOT NULL,
  `Descricao` text NOT NULL,
  `Resumo` text NOT NULL,
  `Data` date NOT NULL,
  `CargaHoraria` int(11) NOT NULL,
  `HorasAprovadas` int(11) DEFAULT 0,
  `ArquivoComprovante` varchar(255) NOT NULL,
  `Status` enum('Pendente','Aprovado','Rejeitado') DEFAULT 'Pendente',
  `ObservacaoCoordenador` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atividadecomplementar`
--

INSERT INTO `atividadecomplementar` (`Id`, `AlunoId`, `CategoriaAtividadeId`, `Descricao`, `Resumo`, `Data`, `CargaHoraria`, `HorasAprovadas`, `ArquivoComprovante`, `Status`, `ObservacaoCoordenador`) VALUES
(5, 1, 8, 'Extensão - Organização e ministrante de cursos', 'Testando', '2025-04-22', 20, 2, 'comprovante_6806ef28a02713.13387314.pdf', 'Aprovado', 'tes'),
(12, 4, 7, 'Execução de trabalho de projeto docente', 'uysgdkcbfs', '2025-05-09', 27, 0, 'Curriculo - Mariana Leonardo de Souza Pedroso_3.pdf', 'Rejeitado', 'teste'),
(13, 4, 5, 'Ministrante de cursos organizados por docentes', 'kajhbfkwjce', '2025-05-09', 200, 22, 'Curriculum Vitae - Mariana Leonardo de Souza Pedroso_1.pdf', 'Aprovado', 'teste'),
(14, 4, 3, 'Execução de trabalho de projeto docente', 'uioadumc', '2025-05-09', 600, 22, 'Curriculo - Mariana Leonardo de Souza Pedroso_4.pdf', 'Aprovado', 'teste'),
(15, 5, 5, 'Ministrante de cursos organizados por docentes', 'Resumoooo testando o cadastro', '2025-05-09', 20, 0, 'ComprovanteEscolaridade_Mariana_4.pdf', 'Rejeitado', 'teste 0'),
(16, 4, 7, 'Execução de trabalho de projeto docente', 'Testando com a mãe', '2025-05-09', 8000, 3, 'ComprovanteEscolaridade_Mariana_5.pdf', 'Aprovado', 'test'),
(17, 6, 7, 'Execução de trabalho de projeto docente', 'Teste', '2025-05-14', 24, 20, 'Currículo - Gabriel Oliveira Gomes.pdf', 'Aprovado', 'teste'),
(18, 6, 3, 'Execução de trabalho de projeto docente', 'teste', '2025-05-14', 22, 13, 'Currículo - Gabriel Oliveira Gomes_1.pdf', 'Rejeitado', 'burro pra caramba'),
(19, 6, 1, 'Autoria e execução de projetos', 'teste', '2025-05-14', 13, 0, 'Currículo - Gabriel Oliveira Gomes_2.pdf', 'Pendente', NULL),
(20, 6, 3, 'Execução de trabalho de projeto docente', 'teste', '2025-05-14', 23, 0, 'Currículo - Gabriel Oliveira Gomes_3.pdf', 'Pendente', NULL),
(21, 6, 1, 'Autoria e execução de projetos', 'ATIVIDADE TESTE1', '2025-05-14', 50, 20, 'Sala23-28-04-19-30-Qualidade_1.pdf', 'Aprovado', '50 pode não'),
(22, 6, 1, 'Autoria e execução de projetos', 'teste', '2025-05-28', 30, 23, 'Compartilhar Projeto no Tinkercad.pdf', 'Aprovado', 'Correção das horas\r\n'),
(23, 6, 3, 'Execução de trabalho de projeto docente', 'teste', '2025-06-01', 1233, 40, 'Currículo - Gabriel Oliveira Gomes_4.pdf', 'Aprovado', 'Para de ser burro moleque');

-- --------------------------------------------------------

--
-- Table structure for table `atividade_categoria`
--

CREATE TABLE `atividade_categoria` (
  `Id` int(11) NOT NULL,
  `CategoriaId` int(11) NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `CargaHorariaMaxima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atividade_categoria`
--

INSERT INTO `atividade_categoria` (`Id`, `CategoriaId`, `Descricao`, `CargaHorariaMaxima`) VALUES
(1, 1, 'Autoria e execução de projetos', 25),
(3, 1, 'Execução de trabalho de projeto docente', 15),
(4, 1, 'Organização e ministrante de cursos', 15),
(5, 1, 'Ministrante de cursos organizados por docentes', 10),
(6, 2, 'Autoria e execução de projetos', 25),
(7, 2, 'Execução de trabalho de projeto docente', 15),
(8, 2, 'Trabalho acadêmico (1 por disciplina)', 5);

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
  `Observacao` text DEFAULT NULL,
  `HorasAprovadas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avaliacaoatividade`
--

INSERT INTO `avaliacaoatividade` (`Id`, `AtividadeComplementarId`, `CoordenadorId`, `DataAvaliacao`, `Status`, `Observacao`, `HorasAprovadas`) VALUES
(1, 5, 9, '2025-05-13', 'Aprovado', 'teste', 0),
(2, 12, 9, '2025-05-13', 'Rejeitado', 'teste', 0),
(3, 13, 9, '2025-05-13', 'Aprovado', 'teste', 0),
(6, 14, 9, '2025-05-13', 'Aprovado', 'teste', 22),
(7, 16, 9, '2025-05-13', 'Aprovado', 'test', 3),
(8, 15, 9, '2025-05-13', 'Rejeitado', 'teste 0', 0),
(9, 17, 9, '2025-05-14', 'Aprovado', 'teste', 20),
(10, 18, 9, '2025-05-14', 'Rejeitado', 'burro pra caramba', 13),
(11, 21, 9, '2025-05-14', 'Aprovado', '50 pode não', 20),
(12, 22, 8, '2025-05-28', 'Aprovado', 'Correção das horas\r\n', 23),
(13, 23, 8, '2025-06-01', 'Aprovado', 'Para de ser burro moleque', 40);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL,
  `Categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`Id`, `Categoria`) VALUES
(1, 'Extensão'),
(2, 'Pesquisa');

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
(8, 'Gustavo Cod', '076623122', 'TADS', '$2y$10$48mRxHCnbSz82t.sOk2k3.iL.NDr4IZ4tdkhh4oR.pilssgHCvTZe', 'patativa1301@gmail.com'),
(9, 'Gustavo2', '076623122222', 'TADS', '$2y$10$.jsb60V8uCouJxhU26wa3.YOdO5LG9Pq2qg1kNrOvL7XX1AAqK8pm', 'patativa1301@gmail.com'),
(10, 'Gustavo', '076623133333', 'TADS', '$2y$10$1chfJcRaTkX3J/sNu0jwEe2fak0SQ9SCVd0a5T4tRAdFS0dTKXTX2', 'patativa1301@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `Id_curso` int(11) NOT NULL,
  `Nome_curso` text NOT NULL,
  `Ano_inicio` int(11) NOT NULL,
  `Coordenador` text NOT NULL,
  `Data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`Id_curso`, `Nome_curso`, `Ano_inicio`, `Coordenador`, `Data_cadastro`) VALUES
(2, 'TADS', 6, 'Pedro', '2025-04-06'),
(3, 'Pedagogia', 8, 'Taciane', '2025-04-06');

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
-- Indexes for table `atividade_categoria`
--
ALTER TABLE `atividade_categoria`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoriaId` (`CategoriaId`);

--
-- Indexes for table `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `AtividadeComplementarId` (`AtividadeComplementarId`),
  ADD KEY `CoordenadorId` (`CoordenadorId`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Id_curso`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `atividade_categoria`
--
ALTER TABLE `atividade_categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coordenador`
--
ALTER TABLE `coordenador`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  ADD CONSTRAINT `atividadecomplementar_ibfk_1` FOREIGN KEY (`AlunoId`) REFERENCES `aluno` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_nova_categoria` FOREIGN KEY (`CategoriaAtividadeId`) REFERENCES `atividade_categoria` (`Id`);

--
-- Constraints for table `atividade_categoria`
--
ALTER TABLE `atividade_categoria`
  ADD CONSTRAINT `atividade_categoria_ibfk_1` FOREIGN KEY (`CategoriaId`) REFERENCES `categoria` (`Id`);

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
