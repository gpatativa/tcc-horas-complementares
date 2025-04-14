
-- Banco de dados: `tccdb`
-- Dump Unificado com conflitos resolvidos
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

-- Estrutura da tabela `aluno`
CREATE TABLE `aluno` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `RA` varchar(50) NOT NULL UNIQUE,
  `Curso` varchar(255) NOT NULL,
  `Periodo` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `coordenador`
CREATE TABLE `coordenador` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `RA` varchar(50) NOT NULL UNIQUE,
  `Curso` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `categoria`
CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `categoriaatividade`
CREATE TABLE `categoriaatividade` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` text NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `CargaHorariaMaxima` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `atividade_categoria`
CREATE TABLE `atividade_categoria` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoriaId` int(11) NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `CargaHorariaMaxima` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `CategoriaId` (`CategoriaId`),
  CONSTRAINT `atividade_categoria_ibfk_1` FOREIGN KEY (`CategoriaId`) REFERENCES `categoria` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `atividadecomplementar`
CREATE TABLE `atividadecomplementar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `AlunoId` int(11) NOT NULL,
  `CategoriaAtividadeId` int(11) NOT NULL,
  `Descricao` text NOT NULL,
  `Resumo` text NOT NULL,
  `Data` date NOT NULL,
  `CargaHoraria` int(11) NOT NULL,
  `ArquivoComprovante` varchar(255) NOT NULL,
  `Status` enum('Pendente','Aprovado','Rejeitado') DEFAULT 'Pendente',
  `ObservacaoCoordenador` text DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `AlunoId` (`AlunoId`),
  KEY `CategoriaAtividadeId` (`CategoriaAtividadeId`),
  CONSTRAINT `atividadecomplementar_ibfk_1` FOREIGN KEY (`AlunoId`) REFERENCES `aluno` (`Id`) ON DELETE CASCADE,
  CONSTRAINT `atividadecomplementar_ibfk_2` FOREIGN KEY (`CategoriaAtividadeId`) REFERENCES `categoriaatividade` (`Id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `avaliacaoatividade`
CREATE TABLE `avaliacaoatividade` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `AtividadeComplementarId` int(11) NOT NULL UNIQUE,
  `CoordenadorId` int(11) NOT NULL,
  `DataAvaliacao` date NOT NULL,
  `Status` enum('Aprovado','Rejeitado') NOT NULL,
  `Observacao` text DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `CoordenadorId` (`CoordenadorId`),
  CONSTRAINT `avaliacaoatividade_ibfk_1` FOREIGN KEY (`AtividadeComplementarId`) REFERENCES `atividadecomplementar` (`Id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacaoatividade_ibfk_2` FOREIGN KEY (`CoordenadorId`) REFERENCES `coordenador` (`Id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `cursos`
CREATE TABLE `cursos` (
  `Id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_curso` text NOT NULL,
  `Ano_inicio` int(11) NOT NULL,
  `Coordenador` text NOT NULL,
  `Data_cadastro` date NOT NULL,
  PRIMARY KEY (`Id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura da tabela `recuperacao_senha`
CREATE TABLE `recuperacao_senha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expira_em` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
