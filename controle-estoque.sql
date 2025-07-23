-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Jul-2025 às 03:06
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste-montink`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE `cupom` (
  `cupom_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `percentual` tinyint(1) NOT NULL,
  `vencimento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cupom`
--

INSERT INTO `cupom` (`cupom_id`, `produtos_id`, `codigo`, `valor`, `percentual`, `vencimento`) VALUES
(2, 4, 'DESCONTA15', '15.00', 1, '2025-07-22 21:05:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `estoque_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`estoque_id`, `produtos_id`, `quantidade`) VALUES
(1, 2, 0),
(4, 7, 6),
(9, 4, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pedidos_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `frete` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('feito','cancelado') NOT NULL DEFAULT 'feito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`pedidos_id`, `produtos_id`, `cep`, `email`, `quantidade`, `frete`, `valor_total`, `status`) VALUES
(2, 2, '07260-460', 'eduardo00000000408@gmail.com', 1, '15.00', '57.80', 'cancelado'),
(3, 2, '07260-460', 'eduardo00000000408@gmail.com', 1, '15.00', '57.80', 'feito'),
(4, 2, '07260-460', 'eduardo00000000408@gmail.com', 1, '15.00', '72.80', 'feito'),
(5, 7, '07260-460', 'eduardo00000000408@gmail.com', 2, '15.00', '130.60', 'feito'),
(6, 7, '07260-460', 'eduardo00000000408@gmail.com', 2, '15.00', '130.60', 'feito'),
(7, 2, '07260-460', 'eduardo00000000408@gmail.com', 1, '15.00', '57.80', 'feito'),
(8, 2, '07260-460', 'eduardo00000000408@gmail.com', 1, '15.00', '67.95', 'feito'),
(9, 7, '07260-460', 'eduardo00000000408@gmail.com', 1, '15.00', '67.95', 'feito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtos_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `variacoes` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produtos_id`, `nome`, `variacoes`, `preco`) VALUES
(2, 'calça moletom', 'verde', '57.80'),
(4, 'calça jeans', 'verde', '57.80'),
(7, 'calça moletom', 'verde', '57.80');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`cupom_id`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`estoque_id`),
  ADD KEY `produto` (`produtos_id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedidos_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtos_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cupom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `estoque_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedidos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `produto` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`produtos_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
