-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Jul-2021 às 02:25
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_montenegro2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nivel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nivel`) VALUES
(1, 'admin'),
(2, 'Assitente'),
(3, 'Coordenador'),
(4, 'Auxiliar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `descricao`) VALUES
(1, 'Asssistente de Logística'),
(2, 'Coordenadora de Logística'),
(3, 'Asssistente de Logística'),
(4, 'Supervisor de Operações Logísticas Interior'),
(5, 'Encarregada de Expedição'),
(6, 'Assistente da qualidade'),
(7, 'Auxiliar de Logística'),
(8, 'Diretora'),
(9, 'Assistente Financeiro'),
(10, 'Coordenadora de RH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carteira`
--

CREATE TABLE `carteira` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `qtd` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `cod_id` int(11) DEFAULT NULL,
  `entregadores_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carteira`
--

INSERT INTO `carteira` (`id`, `data`, `qtd`, `valor`, `cod_id`, `entregadores_id`) VALUES
(26, '2021-07-04 22:57:47', 5, '10.00', 87070519, 4),
(27, '2021-07-04 22:58:00', 5, '10.00', 87070519, 4),
(28, '2021-07-04 23:04:23', 14, '28.00', 17733085, 11),
(29, '2021-07-04 23:04:39', 6, '12.00', 17733085, 11),
(30, '2021-07-05 15:16:21', 15, '30.00', 85709858, 4),
(31, '2021-07-05 19:03:33', 5, '10.00', 15928274, 14),
(32, '2021-07-05 19:28:19', 4, '8.00', 14964784, 15),
(33, '2021-07-05 19:37:43', 5, '10.00', 31555839, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `servicos_id` int(11) NOT NULL,
  `setores_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `data`, `telefone`, `email`, `cnpj`, `foto`, `usuarios_id`, `servicos_id`, `setores_id`) VALUES
(7, 'HAPIVIDA', '2021-07-03 00:04:14', NULL, NULL, NULL, NULL, 7, 3, 3),
(8, 'Gfl', '2021-07-05 19:01:25', NULL, NULL, NULL, NULL, 7, 1, 1),
(9, 'dba', '2021-07-05 19:25:30', NULL, NULL, NULL, NULL, 7, 1, 1),
(10, 'nt log', '2021-07-05 19:35:18', NULL, NULL, NULL, NULL, 7, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `devolucao`
--

CREATE TABLE `devolucao` (
  `id` int(11) NOT NULL,
  `cod_id` int(11) DEFAULT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `qtd` int(11) DEFAULT NULL,
  `ocorrencias_id` int(11) NOT NULL,
  `logisticas_id` int(11) NOT NULL,
  `entregadores_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `devolucao`
--

INSERT INTO `devolucao` (`id`, `cod_id`, `data`, `qtd`, `ocorrencias_id`, `logisticas_id`, `entregadores_id`) VALUES
(46, 87070519, '2021-07-04 22:58:13', 5, 2, 29, 4),
(47, 87070519, '2021-07-04 22:58:25', 5, 6, 29, 4),
(48, 17733085, '2021-07-04 23:04:58', 5, 1, 30, 11),
(49, 17733085, '2021-07-04 23:05:11', 5, 6, 30, 11),
(50, 85709858, '2021-07-05 15:16:38', 5, 1, 31, 4),
(51, 15928274, '2021-07-05 19:03:58', 5, 6, 33, 14),
(52, 14964784, '2021-07-05 19:28:56', 5, 6, 34, 15),
(53, 31555839, '2021-07-05 19:38:14', 5, 2, 35, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

CREATE TABLE `entrega` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `cod_id` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `logisticas_id` int(11) NOT NULL,
  `entregadores_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`id`, `data`, `cod_id`, `qtd`, `logisticas_id`, `entregadores_id`) VALUES
(74, '2021-07-04 22:57:47', 87070519, 5, 29, 4),
(75, '2021-07-04 22:58:00', 87070519, 5, 29, 4),
(76, '2021-07-04 23:04:23', 17733085, 14, 30, 11),
(77, '2021-07-04 23:04:39', 17733085, 6, 30, 11),
(78, '2021-07-05 15:16:21', 85709858, 15, 31, 4),
(79, '2021-07-05 19:03:33', 15928274, 5, 33, 14),
(80, '2021-07-05 19:28:19', 14964784, 4, 34, 15),
(81, '2021-07-05 19:37:43', 31555839, 5, 35, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(225) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `banco` varchar(45) DEFAULT NULL,
  `agencia` varchar(45) DEFAULT NULL,
  `conta` varchar(45) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `rotas_id` int(11) NOT NULL,
  `regioes_id` int(11) NOT NULL,
  `veiculos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `telefone`, `email`, `banco`, `agencia`, `conta`, `usuarios_id`, `rotas_id`, `regioes_id`, `veiculos_id`) VALUES
(3, 'Eneylton Barros', '(98) 9915-8196', 'eneylton@hotmail.com', 'Caixa economica', '778854-96', '887555-98', 7, 3, 21, 1),
(4, 'Elias barros', '989915819629', 'eneylton@hotmail.com', 'ITAU', '778854-96', '887555-98', 7, 7, 41, 1),
(5, 'Talis MEsias', '(98) 8887-4444', 'eneylton@hotmail.com', 'Caixa economica', '887555-98', '8795541', 7, 5, 16, 1),
(6, 'Camilla Souza', '(98) 9915-8196', 'jamillla@gmail.com', 'ITAU', '778854-96', '887555-98', 7, 5, 5, 3),
(7, 'Revan Barros', '(98) 52147-850', 'VIVANE@GMAIL.COM', 'NUBANK', '887555-98', '887555-98', 7, 1, 1, 1),
(8, 'Jessica Arruda', '(98) 99158-1962', 'eneylton@hotmail.com', 'ITAU', '887555-98', '887555-98', 7, 7, 41, 1),
(9, 'Luis Garcia', '(98) 99158-1962', 'eneylton@hotmail.com', 'NUBANK', '887555-98', '887555-98', 7, 1, 14, 2),
(10, 'Marinna Silva ', '(98) 55214-7855', 'marinna@gmail.com', 'BRADESCO', '888855-965', '555511-78', 7, 4, 4, 1),
(11, 'Carla rodriguez', '(98) 99158-1962', 'eneylton@hotmail.com', 'ITAU', '887555-98', '887555-98', 7, 7, 41, 1),
(12, 'Susy Santos', '(98) 99158-1962', 'eneylton@hotmail.com', 'NUBANK', '778854-96', '8795541', 7, 7, 41, 2),
(13, 'Rafaelly souza', '(98) 99158-1962', 'rafaelly202@gmail.com', 'Caixa economica', '887555-98', '887555-98', 7, 4, 6, 1),
(14, 'roberto ', '(98) 99158-1962', 'eneylton@hotmail.com', 'ITAU', '887555-98', '8795541', 7, 4, 4, 1),
(15, 'Ademir neres ', '(98) 99158-1962', 'eneylton@hotmail.com', 'ITAU', '887555-98', '887555-98', 7, 7, 24, 1),
(16, 'chico', '(98) 99158-1962', 'eneylton@hotmail.com', 'Caixa economica', '887555-98', '887555-98', 7, 7, 29, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logisticas`
--

CREATE TABLE `logisticas` (
  `id` int(11) NOT NULL,
  `cod_id` int(11) DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `entregadores_id` int(11) NOT NULL,
  `servicos_id` int(11) NOT NULL,
  `regioes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logisticas`
--

INSERT INTO `logisticas` (`id`, `cod_id`, `data`, `data_inicio`, `data_fim`, `qtd`, `clientes_id`, `entregadores_id`, `servicos_id`, `regioes_id`) VALUES
(29, 87070519, '2021-07-04 22:57:00', '2021-07-04', '2021-07-04', 0, 7, 4, 3, 41),
(30, 17733085, '2021-07-04 23:03:00', '2021-07-04', '2021-07-04', 0, 7, 11, 3, 41),
(31, 85709858, '2021-07-05 15:15:00', '2021-07-05', '2021-07-05', 0, 7, 4, 3, 41),
(32, 14827978, '2021-07-05 15:25:00', '2021-07-05', '2021-07-08', 90, 7, 13, 1, 6),
(33, 15928274, '2021-07-05 19:01:00', '2021-07-05', '2021-07-05', 0, 8, 14, 1, 4),
(34, 14964784, '2021-07-05 19:26:00', '2021-07-05', '2021-07-06', 0, 9, 15, 1, 24),
(35, 31555839, '2021-07-05 19:36:00', '2021-07-05', '2021-07-06', 0, 10, 16, 1, 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id`, `nome`, `usuarios_id`) VALUES
(1, 'Endereço não encotrado', 4),
(2, 'Dificil acesso', 4),
(3, 'Moto apreendida', 7),
(6, 'Ausente', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `regioes`
--

CREATE TABLE `regioes` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `rotas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `regioes`
--

INSERT INTO `regioes` (`id`, `nome`, `rotas_id`) VALUES
(1, 'ARARI', 1),
(2, 'BACABAL', 2),
(3, 'BARRA DO CORDA', 3),
(4, 'BARRERINHAS', 4),
(5, 'CHAPADINHA', 5),
(6, 'COLINAS', 4),
(7, 'COROATA', 4),
(8, 'CURURUPU', 1),
(9, 'DOM PEDRO', 4),
(10, 'ITAPECURU', 3),
(11, 'LAGO DA PEDRA', 2),
(12, 'PEDREIRAS', 4),
(13, 'PINDARÉ MIRIM', 2),
(14, 'PINHEIRO', 1),
(15, 'PRESIDENTE DUTRAA', 4),
(16, 'ROSÁRIO', 5),
(17, 'SANTA INÊS', 2),
(18, 'SANTA LUZIA', 2),
(19, 'SÃO MATEUS', 3),
(20, 'TUNTUN', 4),
(21, 'TUTOIA', 3),
(22, 'VIANA', 1),
(23, 'ZE DOCA', 2),
(24, 'ELDORADO', 7),
(25, 'RIBAMAR', 7),
(26, 'COHAFUMA', 7),
(27, 'CIDADE OLIMPICA', 7),
(28, 'SÃO JOSE DE RIBAMAR', 7),
(29, 'ARAÇAGY', 7),
(30, 'JOÃO PAULO', 7),
(31, 'PAÇO LUMIAR', 7),
(32, 'BR', 7),
(33, 'SÃO CRISTÓVÃO', 7),
(34, 'AREA NOBRE', 7),
(35, 'COHAJAP', 7),
(36, 'COHAMA', 7),
(37, 'PARQUE VITÓRIA/VILA LUIZÃO', 7),
(38, 'VILA LUIÃO', 7),
(39, 'CENTRO / ANJO DA GUARDA', 7),
(40, 'SÃO CRISTOVAO/COHAB/COHATRAC/ANIL', 7),
(41, 'COHATRAC', 7),
(42, 'RENASCENÇA', 7),
(43, 'TURU', 7),
(44, 'COHAB', 7),
(45, 'CENTRO', 7),
(46, 'ITAQUI / BACANGA', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rotas`
--

CREATE TABLE `rotas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rotas`
--

INSERT INTO `rotas` (`id`, `descricao`) VALUES
(1, 'BAIXADA '),
(2, 'CENTRAL'),
(3, 'COCAIS'),
(4, 'LENÇOIS'),
(5, 'PARNAIBA'),
(7, 'SÃO LUÍS'),
(8, 'RIBAMAR'),
(9, 'RAPOSA'),
(10, 'PAÇO LUMIAR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `nome`) VALUES
(1, 'Pequenos volumes'),
(3, 'boletos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

CREATE TABLE `setores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `setores`
--

INSERT INTO `setores` (`id`, `nome`) VALUES
(1, 'E- commerce'),
(3, 'Editorial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargos_id` int(11) NOT NULL,
  `acessos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cargos_id`, `acessos_id`) VALUES
(4, 'admin', 'admin@eneylton.com', '$2y$10$mZ.QuTVOWHefiG58kSk2K.BW3VDnDFu/l1fhYaBmRhQ5eJTJImThm', 1, 1),
(7, 'Eneylton Barros', 'eneylton@hotmail.com', '$2y$10$JZR7X2ZpplGhF4dtchAhJedF/Y0/4ynAOd8VBlR4ehJfLOKHX4mLG', 1, 2),
(13, 'enexs', 'enex@gmail.com.br', '$2y$10$QOY9tsU49c0vK86BUx34peirngMXyhbktyuv1F3/b2i5He7a.IdIC', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `nome`) VALUES
(1, 'MOTO'),
(2, 'CARRO'),
(3, 'CAMINHÃO'),
(5, 'BIKE');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `carteira`
--
ALTER TABLE `carteira`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carteira_entregadores1_idx` (`entregadores_id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_clientes_servicos1_idx` (`servicos_id`),
  ADD KEY `fk_clientes_setores1_idx` (`setores_id`);

--
-- Índices para tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_devolucao_ocorrencias1_idx` (`ocorrencias_id`),
  ADD KEY `fk_devolucao_logisticas1_idx` (`logisticas_id`),
  ADD KEY `fk_devolucao_entregadores1_idx` (`entregadores_id`);

--
-- Índices para tabela `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entrada_logisticas1_idx` (`logisticas_id`),
  ADD KEY `fk_entrega_entregadores1_idx` (`entregadores_id`);

--
-- Índices para tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entregador_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_entregadores_rotas1_idx` (`rotas_id`),
  ADD KEY `fk_entregadores_regioes1_idx` (`regioes_id`),
  ADD KEY `fk_entregadores_veiculos1_idx` (`veiculos_id`);

--
-- Índices para tabela `logisticas`
--
ALTER TABLE `logisticas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_logistica_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_logistica_entregadores1_idx` (`entregadores_id`),
  ADD KEY `fk_logisticas_servicos1_idx` (`servicos_id`),
  ADD KEY `fk_logisticas_regioes1_idx` (`regioes_id`);

--
-- Índices para tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ocorrencias_usuarios1_idx` (`usuarios_id`);

--
-- Índices para tabela `regioes`
--
ALTER TABLE `regioes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cidades_rotas1_idx` (`rotas_id`);

--
-- Índices para tabela `rotas`
--
ALTER TABLE `rotas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuarios_cargos_idx` (`cargos_id`),
  ADD KEY `fk_usuarios_acessos1_idx` (`acessos_id`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `carteira`
--
ALTER TABLE `carteira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `devolucao`
--
ALTER TABLE `devolucao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `logisticas`
--
ALTER TABLE `logisticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `regioes`
--
ALTER TABLE `regioes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `rotas`
--
ALTER TABLE `rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carteira`
--
ALTER TABLE `carteira`
  ADD CONSTRAINT `fk_carteira_entregadores1` FOREIGN KEY (`entregadores_id`) REFERENCES `entregadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_servicos1` FOREIGN KEY (`servicos_id`) REFERENCES `servicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_setores1` FOREIGN KEY (`setores_id`) REFERENCES `setores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `fk_devolucao_entregadores1` FOREIGN KEY (`entregadores_id`) REFERENCES `entregadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_devolucao_logisticas1` FOREIGN KEY (`logisticas_id`) REFERENCES `logisticas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_devolucao_ocorrencias1` FOREIGN KEY (`ocorrencias_id`) REFERENCES `ocorrencias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `fk_entrada_logisticas1` FOREIGN KEY (`logisticas_id`) REFERENCES `logisticas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrega_entregadores1` FOREIGN KEY (`entregadores_id`) REFERENCES `entregadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD CONSTRAINT `fk_entregador_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entregadores_regioes1` FOREIGN KEY (`regioes_id`) REFERENCES `regioes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entregadores_rotas1` FOREIGN KEY (`rotas_id`) REFERENCES `rotas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entregadores_veiculos1` FOREIGN KEY (`veiculos_id`) REFERENCES `veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `logisticas`
--
ALTER TABLE `logisticas`
  ADD CONSTRAINT `fk_logistica_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logistica_entregadores1` FOREIGN KEY (`entregadores_id`) REFERENCES `entregadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logisticas_regioes1` FOREIGN KEY (`regioes_id`) REFERENCES `regioes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logisticas_servicos1` FOREIGN KEY (`servicos_id`) REFERENCES `servicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `fk_ocorrencias_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `regioes`
--
ALTER TABLE `regioes`
  ADD CONSTRAINT `fk_cidades_rotas1` FOREIGN KEY (`rotas_id`) REFERENCES `rotas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_acessos1` FOREIGN KEY (`acessos_id`) REFERENCES `acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_cargos` FOREIGN KEY (`cargos_id`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
