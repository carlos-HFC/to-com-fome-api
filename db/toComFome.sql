-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 02/06/2023 às 17:28
-- Versão do servidor: 8.0.33
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `toComFome`
--
CREATE DATABASE IF NOT EXISTS `toComFome`;
USE `toComFome`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `donnation`
--

DROP TABLE IF EXISTS `donnation`;
CREATE TABLE IF NOT EXISTS `donnation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `typeDonnationId` int NOT NULL,
  `typeFoodId` int DEFAULT NULL,
  `value` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `typeDonnationId` (`typeDonnationId`),
  KEY `typeFoodId` (`typeFoodId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `donnation`
--

INSERT INTO `donnation` (`id`, `userId`, `typeDonnationId`, `typeFoodId`, `value`) VALUES
(1, 1, 1, NULL, 1000000.00),
(2, 1, 1, NULL, 500000.00),
(3, 1, 1, NULL, 98050.00),
(4, 1, 1, NULL, 50000.00),
(5, 2, 1, NULL, 750000.00),
(6, 2, 1, NULL, 500000.00),
(7, 2, 1, NULL, 10000.00),
(8, 3, 2, 1, 10.00),
(9, 3, 2, 1, 15.00),
(10, 3, 2, 2, 20.00),
(11, 3, 2, 2, 50.00),
(12, 4, 2, 1, 5.00),
(13, 4, 2, 1, 2.00),
(14, 4, 2, 2, 45.00),
(15, 4, 2, 2, 70.00),
(16, 5, 2, 1, 80.00),
(17, 5, 2, 1, 100.00),
(18, 5, 2, 2, 25.00),
(19, 5, 2, 2, 30.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `typeNewsId` int NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `typeNewsId` (`typeNewsId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `news`
--

INSERT INTO `news` (`id`, `userId`, `typeNewsId`, `message`) VALUES
(1, 2, 1, 'Região leste está com muita demanda, devido ao alto número de desabrigados'),
(2, 1, 2, 'Obrigado a todos que estão ajudando, juntos estamos salvando muitas vidas'),
(3, 8, 3, 'Distribuição de Comida em Diadema essa semana'),
(4, 5, 2, 'Obrigada à todas as ONGs que estão recebendo nossa doação de alimentos. Isso ajuda muito quem mais precisa'),
(5, 3, 1, 'Tomem cuidado com as fortes chuvas no sul de Goiás'),
(6, 10, 3, 'Distribuição de roupas e alimentos próximo ao Bosque do Povo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Empresa'),
(2, 'Agricultor'),
(3, 'Voluntário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `typeDonnation`
--

DROP TABLE IF EXISTS `typeDonnation`;
CREATE TABLE IF NOT EXISTS `typeDonnation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `typeDonnation`
--

INSERT INTO `typeDonnation` (`id`, `name`) VALUES
(1, 'Dinheiro'),
(2, 'Alimento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `typeFood`
--

DROP TABLE IF EXISTS `typeFood`;
CREATE TABLE IF NOT EXISTS `typeFood` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `typeFood`
--

INSERT INTO `typeFood` (`id`, `name`) VALUES
(1, 'Alimento não perecível'),
(2, 'Alimento perecível');

-- --------------------------------------------------------

--
-- Estrutura para tabela `typeNews`
--

DROP TABLE IF EXISTS `typeNews`;
CREATE TABLE IF NOT EXISTS `typeNews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `typeNews`
--

INSERT INTO `typeNews` (`id`, `name`) VALUES
(1, 'Atenção'),
(2, 'Agradecimento'),
(3, 'Aviso');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `document` varchar(14) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `address` varchar(255) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `uf` char(2) NOT NULL,
  `latitude` decimal(9,7) DEFAULT NULL,
  `longitude` decimal(9,7) DEFAULT NULL,
  `level` int DEFAULT NULL,
  `experience` int DEFAULT NULL,
  `roleId` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `document` (`document`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `document`, `phone`, `cep`, `address`, `district`, `city`, `uf`, `latitude`, `longitude`, `level`, `experience`, `roleId`) VALUES
(1, 'Microsoft', 'contato@microsoft.com', '82deecd5f8de0412c4a15d4f2226fbc8919522ba4b08cffff5e8ff695e4f869e367fbc7852825668c1cdd744e696f376bef522fa351772632b4049adb0653f61', '67396205000109', '1155042155', '04543907', 'Avenida Presidente Juscelino Kubitscheck, 1909', 'Vila Nova Conceição', 'São Paulo', 'SP', NULL, NULL, 8, 120, 1),
(2, 'Kraft Heinz', 'contato@kraftheinz.com', '27115bf704ca5ac5e16981528cd2ebad0b126d78b6a08b35181f656669b44f709655c4409214df60d684226afc81e92db532df93cf1b46970b2a64737b84a886', '80449862000135', '1139511380', '05425070', 'Avenida Rebouças, 3970', 'Pinheiros', 'São Paulo', 'SP', NULL, NULL, 7, 50, 1),
(3, 'Raimundo Carlos Eduardo Lopes', 'rai.lopes@gmail.com', '091d890d88a4a483561e032986ee3d2f2eaa2d68da8f4a044122676ab9469e8b5833c14b22eee3efb71d703506201d7cfd667441379680637b49a80fd2466ff6', '46302695090', '6236941225', '74343640', 'Travessa 4, 113', 'Jardim Atlântico', 'Goiânia', 'GO', NULL, NULL, 6, 95, 2),
(4, 'Isabel Flávia Alesandra Novaes', 'isa.novaes@gmail.com', '6c20695ed1d9fb04c65de8c4ac11d5dbe65491314172aaa7223cbcbb04ea253c3b07b67254f01be785fafa19c5ebccc9050bd884ac10a3ea5f5522092be5b238', '08189143190', '6739607388', '79096280', 'Rua Pará, 993', 'Portal Caiobá', 'Campo Grande', 'MS', NULL, NULL, 5, 45, 2),
(5, 'Carlos Oliver Martin Aparício', 'carlos.oli@gmail.com', '6314becbf587b82b328d7425ce100e2ec880c439a779a21f5d88aa5d28591f00fb5dbdba09f81c29d0199ab434f74182eff14ca68ab67ef8757d499058ea36a3', '85861319030', '55993931523', '97571680', 'Rua Amaral Moreira, 358', 'Parquer das Águias', 'Santana do Livramento', 'RS', NULL, NULL, 7, 25, 2),
(6, 'Mariah e Ruan', 'mariah.ruan@gmail.com', '0c506bdb104f460cf1e234421af0004a3a13e043774aaa3f5f5e72c8d321b695684c1c4fb9dc123bc0803de69c256cd500aaf89a5676dca8dc09f3147664dbd2', '70978883004', '11994529311', '07143450', 'Rua Munhoz Melo, 873', 'Jardim Paraíso', 'Guarulhos', 'SP', -23.4999100, -46.5038800, NULL, NULL, 3),
(7, 'Centro Espírita da Stella', 'espirita.stella@gmail.com', '4bddbf5a132b66da021cdb46f5ae090a71ae3c6607d22b9ccff6786254a73f48acbb40fff8ca39c726725a3dcebbeabf432acc8e3da6ca7c8294c8d6ca6a7b14', '91285892038', '11983531505', '05160030', 'Rua Coronel José Venâncio Dias, 537', 'Jaraguá', 'São Paulo', 'SP', -23.4824400, -46.7620100, NULL, NULL, 3),
(8, 'Gael Julio Vitor da Paz', 'gael-dapaz@gmail.com', '716f8974beb7e56799daec42e5c2b140cbff6ed1b200877941517532f8e6c00847d9d1d35e78ba94b5d690d91514cb9df28e0dae6cc36bf288603240f52a1ef6', '77493818720', '21987161245', '09921270', 'Rua Santiago, 227', 'Taboão', 'Diadema', 'SP', -23.6757600, -46.6126100, NULL, NULL, 3),
(9, 'Isabella Camila Oliveira', 'isa.camilla@gmail.com', '5b9aee75e28e5ce73a26ea7515d761764688abaaab4557698b2f6546fb65e01dee54068b4774ce4c0fe9886e3d8d67c5edc66cd48d3f342bce063991ae401e1e', '92157246800', '11991523222', '04177300', 'Rua Matteo Di Giovanni, 918', 'Jardim Clímax', 'São Paulo', 'SP', -23.6421800, -46.6114710, NULL, NULL, 3),
(10, 'Thales Enzo Martins', 'thales.enzo.martins@gmail.com', 'ef414665c0b88b0d8762831909473d38617069db184b5347d5c5ed0524e222d49220104cc17504399cf6a53463fef5cf61109858b4ad5b037457581d763ebe7c', '83128819807', '11986298507', '09550470', 'Rua Garça, 116', 'Prosperidade', 'São Caetano do Sul', 'SP', -23.6079400, -46.5492700, NULL, NULL, 3),
(11, 'Guilherme e Eduarda Advocacia ME', 'gui.eduarda@gmail.com', '822daf104aec191f934123366537a5d51a5be05262d368bdc694c211ae18b9cd575bac9378769aad5c0ebe7bdc7d341f2a72b6861ceb6dad360a6b036b14a03f', '85633935000168', '11985646963', '09862100', 'Rua Hélio Mitica, 638', 'Independência', 'São Bernardo do Campo', 'SP', -23.6961700, -46.5825670, NULL, NULL, 3),
(12, 'Eduardo Bento Brito', 'eduardo.brito@gmail.com', 'df7d542feb317f16f0ea6e0fda00550371ed515adf05a5252e8c7e66c574115f9504847a2c9be4dae6f27fff7b5a35a46ad42645510ed9b64321ad3616ecd90f', '57359802890', '11989228345', '07192130', 'Rua Ubaí, 747', 'Vila Barros', 'Guarulhos', 'SP', -23.4524300, -46.5080800, NULL, NULL, 3),
(13, 'Luzia Rayssa da Silva', 'luzia.rayssa@gmail.com', '4067cff044eeb168ef43223b83a99c33268bba9eebb41a8b7b5364b29b1acf981d21e8f619fe0194f9516613671b2b727b261a1d9d0a963c9b6668644f64f331', '82529032823', '11997880403', '03570120', 'Rua Monésia, 607', 'Parque Savoy City', 'São Paulo', 'SP', -23.5634400, -46.4854200, NULL, NULL, 3),
(14, 'Emilly Sophie Monteiro', 'emilly.monteiro@gmail.com', 'b3ee1480402005c9ab3ecd3e2f92565feeb6e4fc855d49a641abe263178f99b5c95b46d4fc472f29d7135e18a36135d75d6c51c2ea8ed0865f9f5d50f17e3d8d', '20877225877', '11981307588', '08041430', 'Travessa Eduardo Kendal, 714', 'Jardim Lucinda', 'São Paulo', 'SP', -23.5171300, -46.4396800, NULL, NULL, 3),
(15, 'Cesta da Economia', 'cesta.economia@gmail.com', 'cafe5dad20524c1f46c2d0dcafd98057198251468922e1c7ff5aafb09fb325528f2befa60644b999e9e1ca7ec5ba3382f5bce9edbecdeea79da98a90e99a3b49', '18364692000112', '11964096868', '08280190', 'Avenida Maria Luiza Americano, 2741', 'Cidade Líder', 'São Paulo', 'SP', -23.5586700, -46.4780500, NULL, NULL, 3),
(16, 'Heloisa Carla Daiane Vieira', 'heloisa.vieira@gmail.com', 'e068c87c70f690df932e4c9b29d39d5ac55875139a458f49b4c1c9a11d7a7a33605b61186c7dc1c0b1a118b489212866fc2debb3f88ba92c8b6e4a0cfcd7d716', '53509573846', '11982691929', '04203001', 'Rua Bom Pastor, 194', 'Ipiranga', 'São Paulo', 'SP', -23.5871200, -46.6073900, NULL, NULL, 3),
(17, 'Adriana Luana Rodrigues', 'ariana.rodrigues@gmail.com', '28505e8364e7ae9f82b88292c6349f9387b69f77684c3edbb7d492f26d235d7b9c106460a4bf9888191ead0d90ebda88d3cc98da8f130a966f0b947356e74911', '43418627820', '11983074304', '03164010', 'Rua dos Trilhos, 51', 'Mooca', 'São Paulo', 'SP', -23.5523400, -46.6096900, NULL, NULL, 3);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `donnation`
--
ALTER TABLE `donnation`
  ADD CONSTRAINT `donnation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `donnation_ibfk_2` FOREIGN KEY (`typeDonnationId`) REFERENCES `typeDonnation` (`id`),
  ADD CONSTRAINT `donnation_ibfk_3` FOREIGN KEY (`typeFoodId`) REFERENCES `typeFood` (`id`);

--
-- Restrições para tabelas `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`typeNewsId`) REFERENCES `typeNews` (`id`);

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
