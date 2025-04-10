-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/04/2025 às 16:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tccdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `RA` varchar(50) NOT NULL,
  `Curso` varchar(255) NOT NULL,
  `Periodo` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`Id`, `Nome`, `RA`, `Curso`, `Periodo`, `Senha`) VALUES
(1, 'Gustavo', '0766231', 'Tads', '4° Semestre', '$2y$10$Xju1jLhWCAVc/s3xqT5uRO0DXpgpCN2vX9mjlkOQ8cooGUstkCLNW'),
(2, 'Teste Aluno', '123456789', 'Teste', '5° Semestre', '$2y$10$xThXS6srB89ZLi/5XnOAO.pDlAlwicBphi6zfUSJ8vWYtcmylC2Fu');

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividadecomplementar`
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
-- Estrutura para tabela `avaliacaoatividade`
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
-- Estrutura para tabela `categoriaatividade`
--

CREATE TABLE `categoriaatividade` (
  `Id` int(11) NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `CargaHorariaMaxima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `coordenador`
--

CREATE TABLE `coordenador` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `RA` varchar(50) NOT NULL,
  `Curso` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `coordenador`
--

INSERT INTO `coordenador` (`Id`, `Nome`, `RA`, `Curso`, `Senha`) VALUES
(1, 'Gustavo', '0766231', 'Tads', ''),
(2, 'Pedro IVO', '099987', 'teste', ''),
(4, 'teste', '2323', 'teste', '$2y$10$QxyuaYZNQA093sI1LFPDbOpqR9NBMhjAaO0yhvb3MUiPbpUD0IgDy'),
(5, 'Teste ', '9514960', 'Tads', '$2y$10$uTibiPwfm3W.N/S9pxvX/.tQA/OzGN9xISl7hxphMP89XD5ROD3cG'),
(6, 'Teste ', '9514961', 'Tads', '$2y$10$yB/OZer7.7nxOZV3NiqxZORF4Bkh3dsFGUwqsa6wyzc9WpNvC4cOm'),
(7, 'Teste', '123123', 'Teste', '$2y$10$9Tl7aGQDQ0UMxwI6zHIt9OtX9Ctlls./tHdZ7x8KLngIB7vQQ4rjS');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `Id_curso` int(11) NOT NULL,
  `Nome_curso` text NOT NULL,
  `Quant_periodos` int(11) NOT NULL,
  `Coordenador` text NOT NULL,
  `Data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`Id_curso`, `Nome_curso`, `Quant_periodos`, `Coordenador`, `Data_cadastro`) VALUES
(2, 'TADS', 6, 'Pedro', '2025-04-06'),
(3, 'Pedagogia', 8, 'Taciane', '2025-04-06');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- Índices de tabela `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AlunoId` (`AlunoId`),
  ADD KEY `CategoriaAtividadeId` (`CategoriaAtividadeId`);

--
-- Índices de tabela `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `AtividadeComplementarId` (`AtividadeComplementarId`),
  ADD KEY `CoordenadorId` (`CoordenadorId`);

--
-- Índices de tabela `categoriaatividade`
--
ALTER TABLE `categoriaatividade`
  ADD PRIMARY KEY (`Id`);

--
-- Índices de tabela `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Id_curso`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoriaatividade`
--
ALTER TABLE `categoriaatividade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `coordenador`
--
ALTER TABLE `coordenador`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividadecomplementar`
--
ALTER TABLE `atividadecomplementar`
  ADD CONSTRAINT `atividadecomplementar_ibfk_1` FOREIGN KEY (`AlunoId`) REFERENCES `aluno` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atividadecomplementar_ibfk_2` FOREIGN KEY (`CategoriaAtividadeId`) REFERENCES `categoriaatividade` (`Id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `avaliacaoatividade`
--
ALTER TABLE `avaliacaoatividade`
  ADD CONSTRAINT `avaliacaoatividade_ibfk_1` FOREIGN KEY (`AtividadeComplementarId`) REFERENCES `atividadecomplementar` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avaliacaoatividade_ibfk_2` FOREIGN KEY (`CoordenadorId`) REFERENCES `coordenador` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
