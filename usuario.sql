-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql203.epizy.com
-- Tempo de geração: 13/07/2022 às 16:08
-- Versão do servidor: 10.3.27-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `epiz_32124319_usuario`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `cnpj` varchar(220) NOT NULL,
  `evento` varchar(220) NOT NULL,
  `descricao` varchar(2000) NOT NULL,
  `end` varchar(220) NOT NULL,
  `data` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `cnpj`, `evento`, `descricao`, `end`, `data`) VALUES
(1, 'Ahka', 'Ahajka', 'Ahja', 'Agkaka', 'Agajka', 'Ahakkaka'),
(2, 'Ahajoao', 'Gakakal', 'Agjaja', 'Ahakka', 'Hajaha', 'Gajaj'),
(3, 'Ahajo', 'Gakakal', 'Agjaffhja', 'Ahakka', 'Hajaha', 'Gajaj'),
(4, '11', '22', '33', '44', '55', '66');

-- --------------------------------------------------------

--
-- Estrutura para tabela `locais`
--

CREATE TABLE `locais` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `cnpj` varchar(220) NOT NULL,
  `bairro` varchar(220) NOT NULL,
  `rua` varchar(220) NOT NULL,
  `cep` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `locais`
--

INSERT INTO `locais` (`id`, `nome`, `cnpj`, `bairro`, `rua`, `cep`) VALUES
(1, 'Ecoponto', '1252681919', 'Crateus', 'Rua 2 N 56', '60181270'),
(2, 'Mahh', '156182991', 'Babms', 'Hajaoal', 'Aghakal'),
(3, '11', '22', '33', '44', '55'),
(4, 'Ecopo', '1234567890', 'CrateÃºs ', 'Rua Teste, N 56', '60180180');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rotas`
--

CREATE TABLE `rotas` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `cnpj` varchar(220) NOT NULL,
  `ponto1` varchar(220) NOT NULL,
  `ponto2` varchar(220) NOT NULL,
  `ponto3` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `rotas`
--

INSERT INTO `rotas` (`id`, `nome`, `cnpj`, `ponto1`, `ponto2`, `ponto3`) VALUES
(1, 'Ban', 'Vajak', 'Agjak', 'Ahaj', 'Ahja'),
(2, 'Ahbzbb', 'Vaja', 'Agjak', 'Ahaj', 'Ahja'),
(3, 'oi', '123', '11', '22', '33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_usuario` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_conta` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha_usuario`, `tipo_conta`, `cidade`) VALUES
(37, 'Daniel', 'daniel@gmail.com', '123456', 'fisica', 'crateus'),
(38, 'Carlos', 'carlos@gmail.com', '123456', 'juridica', 'crateus'),
(39, 'Daniel', 'Gajakal@gmail.com', '123457', 'juridica', 'fortaleza'),
(40, 'RICARDO', 'rmaiatsouza@gmail.com', 'aaaaaaaaaaaa', 'fisica', 'fortaleza'),
(41, 'pedro', 'pbarretogoncalves@gmail.com', '123456', 'fisica', 'crateus'),
(42, 'pedrooo', 'pbarretogs@gmail.com', '123456', 'juridica', 'crateus'),
(43, 'Jair', 'jair@gmail.com', '123456', 'juridica', 'fortaleza');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `rotas`
--
ALTER TABLE `rotas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `locais`
--
ALTER TABLE `locais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `rotas`
--
ALTER TABLE `rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
