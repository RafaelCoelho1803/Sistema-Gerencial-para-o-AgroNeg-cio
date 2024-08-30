-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/08/2024 às 05:52
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
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adicao`
--

CREATE TABLE `adicao` (
  `id_adicao` int(10) NOT NULL,
  `produto_id` int(10) DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `hora_adicao` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adicao`
--

INSERT INTO `adicao` (`id_adicao`, `produto_id`, `quantidade`, `hora_adicao`, `user_id`) VALUES
(1, 3, 2, '2024-08-27 16:11:23', NULL),
(2, 3, 2, '2024-08-27 16:12:25', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_estoque` int(10) NOT NULL,
  `produto_id` int(10) NOT NULL,
  `quantidade_atual` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `frete`
--

CREATE TABLE `frete` (
  `id_frete` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `peso` int(11) NOT NULL,
  `oculta` char(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `frete`
--

INSERT INTO `frete` (`id_frete`, `user_id`, `placa`, `cor`, `estado`, `peso`, `oculta`) VALUES
(3, 1, 'GWR2134', 'AZUL', 'MT', 500, 'N'),
(4, 2, 'HRSET78', 'ROXO', 'GO', 213, 'N'),
(6, 2, 'abc@a', 'VERMEIO', 'GO', 213, 'N'),
(7, 2, 'SUJ2901', 'amarelo', 'MT', 435, 'N');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pesagem`
--

CREATE TABLE `pesagem` (
  `id_pesagem` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `talhao_id` int(11) NOT NULL,
  `frete_id` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `produto` char(1) NOT NULL,
  `peso_bruto` int(11) NOT NULL,
  `hora` timestamp NULL DEFAULT NULL,
  `desconto` int(11) DEFAULT 0,
  `peso_liquido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pesagem`
--

INSERT INTO `pesagem` (`id_pesagem`, `user_id`, `talhao_id`, `frete_id`, `ano`, `produto`, `peso_bruto`, `hora`, `desconto`, `peso_liquido`) VALUES
(26, 1, 1, 3, 24, 'S', 1000, '2024-06-05 17:23:21', 3, 485),
(27, 1, 1, 3, 24, 'S', 1000, '2024-08-12 20:09:07', 4, 480);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(10) NOT NULL,
  `Quantidade` int(10) NOT NULL,
  `UnidadeMedida` char(2) NOT NULL,
  `Marca` varchar(11) NOT NULL,
  `Validade` date NOT NULL,
  `Classificacao` varchar(10) NOT NULL,
  `Fornecedor` varchar(10) NOT NULL,
  `imagem_path` varchar(255) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `Quantidade`, `UnidadeMedida`, `Marca`, `Validade`, `Classificacao`, `Fornecedor`, `imagem_path`, `Nome`) VALUES
(3, 1, 'L', 'AmeriBras', '2025-12-07', 'Insumos', 'Singenta', 'upload/Glifosato.jpg', NULL),
(4, 6, 'L', 'teasd', '3322-03-12', 'Insumos', '12', 'upload/Glifosato.jpg', 'Teste'),
(5, 23, 'L', 'we', '2024-08-03', 'Insumos', '12', 'upload/AFD_1029.jpg', 'tes'),
(6, 23, 'L', 'sdsd', '2024-08-03', 'Insumos', 'sd', 'upload/Glifosato.jpg', 'tes'),
(7, 1, 'L', 'qwe', '2024-08-21', 'Insumos', 'q', 'upload/Glifosato.jpg', 'qwe');

-- --------------------------------------------------------

--
-- Estrutura para tabela `talhoes`
--

CREATE TABLE `talhoes` (
  `id_talhao` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `talhoes`
--

INSERT INTO `talhoes` (`id_talhao`, `area`, `user_id`) VALUES
(1, 150, 1),
(2, 175, 1),
(3, 138, 1),
(4, 65, 1),
(5, 135, 1),
(6, 116, 1),
(7, 175, 1),
(8, 215, 1),
(9, 70, 1),
(10, 100, 1),
(11, 123, 1),
(12, 84, 1),
(13, 35, 1),
(14, 147, 1),
(15, 80, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` char(1) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id_user`, `nome`, `email`, `usuario`, `senha`, `tipo`, `data`) VALUES
(1, 'Rafael Coelho', 'rcoelho@hotmail', 'rafa', '123', '1', '2024-03-13 15:44:52'),
(2, 'test', 'test1', 'test', 'test', '1', '2024-03-14 14:26:24');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adicao`
--
ALTER TABLE `adicao`
  ADD PRIMARY KEY (`id_adicao`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_estoque`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `frete`
--
ALTER TABLE `frete`
  ADD PRIMARY KEY (`id_frete`);

--
-- Índices de tabela `pesagem`
--
ALTER TABLE `pesagem`
  ADD PRIMARY KEY (`id_pesagem`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `talhoes`
--
ALTER TABLE `talhoes`
  ADD PRIMARY KEY (`id_talhao`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adicao`
--
ALTER TABLE `adicao`
  MODIFY `id_adicao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_estoque` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `frete`
--
ALTER TABLE `frete`
  MODIFY `id_frete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pesagem`
--
ALTER TABLE `pesagem`
  MODIFY `id_pesagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `talhoes`
--
ALTER TABLE `talhoes`
  MODIFY `id_talhao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `adicao`
--
ALTER TABLE `adicao`
  ADD CONSTRAINT `adicao_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id_produto`),
  ADD CONSTRAINT `adicao_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
