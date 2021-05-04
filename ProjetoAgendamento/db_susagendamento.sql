-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Nov-2020 às 19:37
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_susagendamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE `consultas` (
  `cod_consulta` int(11) NOT NULL,
  `dia` date NOT NULL,
  `horario` time NOT NULL,
  `especialidade` int(11) NOT NULL,
  `cpf_paciente` varchar(11) NOT NULL,
  `crm_medico` varchar(30) NOT NULL,
  `id_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `cod_especialidade` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `especialidades`
--

INSERT INTO `especialidades` (`cod_especialidade`, `nome`) VALUES
(1, 'Alergia e Imunologia'),
(2, 'Anestesiologia'),
(3, 'Cardiologia'),
(4, 'Cirurgia Cardiovascular'),
(5, 'Cirurgia Geral'),
(6, 'Dermatologia'),
(7, 'Geriatria'),
(8, 'Ginecologia'),
(10, 'Infectologia'),
(11, 'Neurologia'),
(9, 'ObstetrÃ­cia'),
(12, 'Oftalmologia'),
(13, 'Pediatria'),
(15, 'PsicÃ³logo'),
(14, 'Psiquiatria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `cod_medico` int(11) NOT NULL,
  `crm_medico` varchar(30) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cod_especialidade` int(11) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`cod_medico`, `crm_medico`, `nome`, `cod_especialidade`, `senha`) VALUES
(4, '2222', 'Antonio', 0, '4a181673429f0b6abbfd452f0f3b5950');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `cod_paciente` int(11) NOT NULL,
  `cpf_paciente` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` varchar(22) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`cod_paciente`, `cpf_paciente`, `nome`, `data_nascimento`, `endereco`, `telefone`, `senha`) VALUES
(6, '12423999925', 'Camila Fernandes', '1998-06-04', 'Rua', '42984427618', '064b3974fc5686fd02bed27bf390fd29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `statusagenda`
--

CREATE TABLE `statusagenda` (
  `cod_status` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`cod_consulta`);

--
-- Índices para tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`cod_especialidade`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`cod_medico`),
  ADD UNIQUE KEY `crm_medico` (`crm_medico`),
  ADD KEY `cod_especialidade` (`cod_especialidade`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`cod_paciente`),
  ADD UNIQUE KEY `cpf_paciente` (`cpf_paciente`);

--
-- Índices para tabela `statusagenda`
--
ALTER TABLE `statusagenda`
  ADD PRIMARY KEY (`cod_status`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consultas`
--
ALTER TABLE `consultas`
  MODIFY `cod_consulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `cod_especialidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `cod_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `cod_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `statusagenda`
--
ALTER TABLE `statusagenda`
  MODIFY `cod_status` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
