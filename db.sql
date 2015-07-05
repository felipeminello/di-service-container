-- --------------------------------------------------------
-- Servidor:                     192.168.1.4
-- Versão do servidor:           5.6.24-0ubuntu2 - (Ubuntu)
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para di-service-container
CREATE DATABASE IF NOT EXISTS `di-service-container` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `di-service-container`;


-- Copiando estrutura para tabela di-service-container.fornecedores
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Copiando dados para a tabela di-service-container.fornecedores: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` (`id`, `nome`, `email`) VALUES
	(1, 'Joao dos Santos', 'joao@santos.com.br'),
	(2, 'Amanda Carvalho', 'amanda@carvalho.com.br'),
	(3, 'Jassinto Leite Akino Rego', 'jassinto@rego.com.br');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;


-- Copiando estrutura para tabela di-service-container.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int(5) NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `unidade` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_fk1` (`id_fornecedor`),
  CONSTRAINT `produtos_fk1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Copiando dados para a tabela di-service-container.produtos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `id_fornecedor`, `nome`, `unidade`) VALUES
	(1, 1, 'Quebra-cabeça', '23'),
	(2, 3, 'Calçados', '8'),
	(3, 3, 'Mapa', '85');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
